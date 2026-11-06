<?php

/**
 * Page Contact : admissions + formulaire.
 * Tout est ici : affichage, vérification du captcha, envoi du mail. Aucun JavaScript nécessaire.
 * Secrets SMTP : fichier .env à la racine (voir .env.example), jamais publié.
 */

// ---------------------------------------------------------------------------
// Réglages
// ---------------------------------------------------------------------------
$env = [];
$fichierEnv = __DIR__ . '/../.env';
if (is_file($fichierEnv)) {
  foreach (file($fichierEnv, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $ligne) {
    $ligne = trim($ligne);
    if ($ligne === '' || $ligne[0] === '#' || strpos($ligne, '=') === false) continue;
    [$k, $v] = explode('=', $ligne, 2);
    $env[trim($k)] = trim(trim($v), "\"'"); // retire les guillemets éventuels
  }
}
// Clé qui signe le calcul du captcha (à définir dans .env : APP_SECRET=une-longue-phrase-au-hasard)
$secret = $env['APP_SECRET'] ?? hash('sha256', __FILE__ . 'slinck');

// ---------------------------------------------------------------------------
// Captcha : calcul généré ici, vérifié ici (le navigateur ne peut pas tricher)
// ---------------------------------------------------------------------------
function captcha_creer(string $secret): array
{
  $mots = ['zéro', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf'];
  $a  = random_int(0, 9);
  $b  = random_int(0, 9);
  $op = ['plus', 'moins', 'fois'][random_int(0, 2)];
  if ($op === 'moins' && $a < $b) {
    [$a, $b] = [$b, $a]; // pas de résultat négatif
  }
  $reponse = $op === 'plus' ? $a + $b : ($op === 'moins' ? $a - $b : $a * $b);
  $ts = time();
  return [
    'question' => $mots[$a] . ' ' . $op . ' ' . $mots[$b],
    'ts'       => $ts,
    'jeton'    => hash_hmac('sha256', $reponse . '|' . $ts, $secret),
  ];
}

function captcha_valide(string $secret, string $saisie, int $ts, string $jeton): bool
{
  $age = time() - $ts;
  if ($age < 3 || $age > 3600) return false; // trop rapide (robot) ou périmé
  return hash_equals(hash_hmac('sha256', (int) $saisie . '|' . $ts, $secret), $jeton);
}

// ---------------------------------------------------------------------------
// Traitement du formulaire
// ---------------------------------------------------------------------------
$erreur = '';
$nom = $mail = $message = '';

$succes = ($_GET['envoi'] ?? '') === 'ok';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom     = trim(strip_tags($_POST['nom'] ?? ''));
  $mail    = trim($_POST['mail'] ?? '');
  $message = trim(strip_tags($_POST['message'] ?? ''));

  if (!empty($_POST['website_check'])) {
    // Piège à robots (champ invisible rempli) : on fait semblant que tout va bien
    header('Location: /contact?envoi=ok#formulaire');
    exit;
  }

  if ($nom === '' || $message === '' || !filter_var($mail, FILTER_VALIDATE_EMAIL) || mb_strlen($nom) > 100 || mb_strlen($message) > 5000) {
    $erreur = 'Veuillez vérifier les informations saisies.';
  } elseif (!captcha_valide($secret, (string) ($_POST['captcha'] ?? ''), (int) ($_POST['ts'] ?? 0), (string) ($_POST['jeton'] ?? ''))) {
    $erreur = 'Le calcul est incorrect (ou le formulaire est resté ouvert trop longtemps). Merci de réessayer.';
  } else {
    try {
      require __DIR__ . '/../vendor/PHPMailer/Exception.php';
      require __DIR__ . '/../vendor/PHPMailer/PHPMailer.php';
      require __DIR__ . '/../vendor/PHPMailer/SMTP.php';

      $m = new \PHPMailer\PHPMailer\PHPMailer(true);
      $m->isSMTP();
      $m->Host       = $env['SMTP_HOST'] ?? '';
      $m->SMTPAuth   = true;
      $m->Username   = $env['SMTP_USER'] ?? '';
      $m->Password   = $env['SMTP_PASS'] ?? '';
      $port          = (int) ($env['SMTP_PORT'] ?? 587);
      $m->Port       = $port;
      // Port 465 = SSL direct ; tout autre port (587...) = STARTTLS
      $m->SMTPSecure = $port === 465 ? \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS : \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
      $m->CharSet    = 'UTF-8';

      $m->setFrom($env['MAIL_FROM'] ?? '', $env['MAIL_FROM_NAME'] ?? 'Site Web');
      $m->addAddress($env['MAIL_TO'] ?? '');
      $m->addReplyTo($mail, str_replace(["\r", "\n"], ' ', $nom));

      $m->isHTML(true);
      $m->Subject = 'Contact slinck.com : ' . str_replace(["\r", "\n"], ' ', $nom);
      $m->Body    = '<p><strong>Nom :</strong> ' . h($nom) . '</p>'
        . '<p><strong>Courriel :</strong> ' . h($mail) . '</p>'
        . '<p><strong>Message :</strong></p><p>' . nl2br(h($message)) . '</p>';
      $m->AltBody = "Nom : $nom\nCourriel : $mail\n\n$message";
      $m->send();

      header('Location: /contact?envoi=ok#formulaire'); // évite le renvoi du formulaire si on actualise la page
      exit;
    } catch (\Throwable $e) {
      error_log('Contact slinck.com : ' . $e->getMessage());
      $erreur = "Le message n'a pas pu être envoyé. Vous pouvez réessayer ou m'écrire directement par courriel.";
      // Diagnostic : mettre APP_DEBUG=1 dans .env pour afficher la vraie cause (à retirer ensuite)
      if (($env['APP_DEBUG'] ?? '') === '1') {
        $detail = $e->getMessage();
        if (isset($m)) {
          $smtp = $m->getSMTPInstance()->getError(); // cause précise (réseau, certificat...)
          $detail .= ' | ' . ($smtp['detail'] ?? '') . ' ' . ($smtp['smtp_code'] ?? '') . ' ' . ($smtp['smtp_code_ex'] ?? '');
        }
        // ASCII imprimable uniquement : une erreur réseau peut contenir des octets binaires
        $detail  = preg_replace('/[^\x20-\x7E]/', '', $detail);
        $erreur .= ' [Détail : ' . substr(trim($detail), 0, 300) . ']';
      }
    }
  }
}

$captcha = captcha_creer($secret);
?>
<div class="bento-grid">
  <article class="card span-3 card-c2">
    <h3>Calendrier des Admissions en LP Métiers du Numérique</h3>
    <p>
      La sélection des candidats s'appuie sur la diversité des parcours (BTS SIO, NDRC, MCO, BUT Informatique, MMI, ou
      Infographie) pour créer des promotions polyvalentes.
    </p>
    <div class="split-content">
      <div>
        <h4>Campagnes de Candidature</h4>
        <ul>
          <li><strong>Session 1 :</strong> Février - Mars (Ouverture des dossiers)</li>
          <li><strong>Session 2 :</strong> Avril - Juin (Complémentaire selon places)</li>
        </ul>
      </div>
      <div>
        <h4>Profils recherchés</h4>
        <ul>
          <li>Tempérament <strong>curieux</strong>, <strong>passionné</strong> et prêt à s'investir.</li>
          <li>Évaluation de la <strong>motivation</strong> et de la <strong>cohérence du projet professionnel</strong>.</li>
        </ul>
      </div>
    </div>
  </article>
  <article class="card span-3 card-c1">
    <h3>Modalités : Initiale, Alternance & Continue</h3>
    <p>
      La Licence Professionnelle <strong>"Métiers du numérique : Conception, Rédaction et Réalisation Web"</strong>
      s'adapte aux différents profils et aux besoins des recruteurs.
    </p>

    <div class="split-content">
      <div>
        <h4>Formation Initiale (avec Stage)</h4>
        <ul>
          <li><strong>Format :</strong> Cursus académique classique avec une immersion professionnelle finale.</li>
          <li><strong>Stage :</strong> Durée de 12 à 16 semaines.</li>
          <li><strong>Disponibilité :</strong> Départ en entreprise à partir de <strong>mi-mars</strong> pour une
            mission
            de fin d'études.</li>
        </ul>
      </div>

      <div>
        <h4>Alternance (Apprentissage)</h4>
        <ul>
          <li><strong>Rythme :</strong> Alternance hebdomadaire entre l'EiSINe et l'entreprise durant l'année
            pédagogique.
          </li>
          <li>Passage en <strong>Full-Entreprise</strong> dès la
            <strong>mi-mars</strong>.
          </li>
          <li><strong>Avantage :</strong> Une présence continue en entreprise durant toute la phase finale du diplôme.
          </li>
        </ul>
      </div>

      <div>
        <h4>Formation Continue & Reprise d'études</h4>
        <p>
          Nous accueillons les professionnels en <strong>reprise d'études</strong> ou en <strong>montée en
            compétences</strong>. </p>
        <p>Ce dispositif permet d'adapter nos enseignements aux projets de transition
          professionnelle ou de spécialisation.
        </p>
      </div>
    </div>
  </article>
  <article class="card span-1 card-c2 centered">
    <img class="img-avatar" src="img/linck.webp" alt="Sébastien Linck" loading="lazy" />
    <h3>Sébastien Linck</h3>
    <p>
      EiSINe<br />
      Campus Sup Ardenne<br />
      9A rue Claude Chrétien<br />
      08000 Charleville-Mézières<br />
    </p>
    <p>contact(@)slinck(.)com</p>
    <div class="social-links">
      <a target="_blank" href="https://www.linkedin.com/in/slinck/" aria-label="LinkedIn">
        <img src="img/linkedin.svg" alt="LinkedIn" width="40" style="filter: brightness(0) invert(1)" />
      </a>
      <a target="_blank" href="https://www.researchgate.net/profile/Sebastien-Linck" aria-label="ResearchGate">
        <img src="img/researchgate.svg" alt="ResearchGate" width="40" style="filter: brightness(0) invert(1)" />
      </a>
    </div>
  </article>
  <article class="card span-2 card-c3" id="formulaire">
    <h3>Envoyer un message</h3>

    <?php if ($succes) : ?>
      <p class="alerte alerte-ok" role="status">Votre message a été envoyé, merci. Je vous répondrai rapidement.</p>
    <?php elseif ($erreur !== '') : ?>
      <p class="alerte alerte-erreur" role="alert"><?= h($erreur) ?></p>
    <?php endif; ?>

    <form method="post" action="/contact#formulaire">
      <div style="position: absolute; left: -9999px" aria-hidden="true">
        <label for="website_check">Ne remplissez pas ce champ si vous êtes humain :</label>
        <input type="text" id="website_check" name="website_check" autocomplete="off" tabindex="-1" value="" />
      </div>

      <label for="nom">Votre nom</label>
      <input type="text" id="nom" name="nom" placeholder="Nom Prénom" required maxlength="100" value="<?= h($nom) ?>" />

      <label for="mail">Votre courriel</label>
      <input type="email" id="mail" name="mail" placeholder="email@exemple.com" required value="<?= h($mail) ?>" />

      <label for="message">Message</label>
      <textarea id="message" rows="6" name="message" placeholder="Votre message..." required maxlength="5000"><?= h($message) ?></textarea>

      <div class="captcha-container">
        <label for="captcha">Résolvez ce calcul simple (en chiffres) :</label>
        <div class="captcha-question">
          <span><?= h($captcha['question']) ?></span>
          <span>=</span>
          <input type="text" id="captcha" name="captcha" inputmode="numeric" autocomplete="off" required />
        </div>
        <input type="hidden" name="ts" value="<?= (int) $captcha['ts'] ?>">
        <input type="hidden" name="jeton" value="<?= h($captcha['jeton']) ?>">
      </div>

      <input type="submit" value="Envoyer le message" />
    </form>
  </article>
</div>