<div class="bento-grid">
  <article class="card hero">
    <img class="img-avatar" src="img/linck.webp" alt="Sébastien Linck" width="400" height="400" fetchpriority="high" />
    <div>
      <p class="lead">
        Ingénieur et docteur en informatique, j'enseigne le développement web
        et les réseaux, et je dirige une licence professionnelle du numérique.
      </p>
      <div class="chips">
        <span class="chip">Développement web</span>
        <span class="chip">Réseaux</span>
        <span class="chip">Pédagogie</span>
      </div>
    </div>
  </article>

  <article class="card tile-accent tile-k1">
    <p class="eyebrow">Depuis 2014</p>
    <h3>Responsable de la licence professionnelle Métiers du numérique</h3>
    <p>EiSINe, Charleville-Mézières</p>
    <a class="btn" href="/contact">Me contacter</a>
  </article>

  <article class="card stat tile-k2">
    <?php
    $annees = round(date_diff(date_create('2007-09-01'), date_create())->days / 365.25);
    ?>
    <b><?= $annees ?></b>
    <span>d'enseignement, depuis septembre 2007</span>
  </article>

  <article class="card stat tile-k3">
    <b>10</b>
    <span>formations dans 5 établissements</span>
  </article>

  <a class="card tile-link" href="/enseignements">
    <span class="ic tile-k1"><img src="img/lesson.svg" alt="" /></span>
    <b>Cours</b><small>Modules enseignés</small>
  </a>
  <a class="card tile-link" href="/recherche">
    <span class="ic tile-k2"><img src="img/network-analytic.svg" alt="" /></span>
    <b>Recherche</b><small>Réseaux et EIAH</small>
  </a>
  <a class="card tile-link" href="/publications">
    <span class="ic tile-k3"><img src="img/books.svg" alt="" /></span>
    <b>Publications</b><small>Articles et thèse</small>
  </a>
  <a class="card tile-link" href="/contact">
    <span class="ic tile-k1"><img src="img/envelope.svg" alt="" /></span>
    <b>Contact</b><small>Admissions et questions</small>
  </a>

  <article class="card span-3 card-c3">
    <h3>Qui suis-je ?</h3>
    <p>
      Après un parcours académique en ingénierie informatique, ponctué d'un DEA
      et d'un doctorat toujours dans le domaine informatique et plus précisément
      des réseaux, j'ai consacré ma carrière à l'enseignement.
    </p>
    <p>
      J'ai eu l'opportunité d'enseigner dans différentes universités et à divers
      niveaux, nourrissant ainsi ma passion pour la transmission des
      connaissances.
    </p>
    <p>
      Mon engagement envers l'éducation et la formation des futures générations
      est au cœur de mes motivations.
    </p>
  </article>
  <div class="span-3 cols-2">
    <article class="card card-c2">
      <h3>Formation Académique</h3>
      <ul>
        <li>
          <strong>Doctorat en Informatique</strong> – Université de
          Franche-Comté (2008)<br />
          <em>Recherches axées sur l'<strong>Optimisation et l'adaptation des communications dans les réseaux
              hétérogènes</strong>
            (gestion de la congestion, transmissions sans-fil, systèmes vidéo
            adaptatifs en temps réel).</em>
        </li>
        <li><strong>DEA Systèmes Distribués et Réseaux</strong> (2004).</li>
        <li>
          <strong>Diplôme d'Ingénieur en Informatique</strong> – UTBM (2003).
        </li>
      </ul>
    </article>

    <article class="card card-c1">
      <h3>Missions actuelles</h3>
      <p>
        Je suis, depuis 2014, responsable d'une licence professionnelle mention
        <strong>"Métiers du numérique : Conception, Rédaction et Réalisation
          Web"</strong>
        avec le parcours "Intégration et WebDesign" au sein de l'EiSINe.
      </p>
      <p>
        Cette formation donne aux étudiants les compétences nécessaires pour
        exercer les différents métiers liés à la conception de sites web et à la
        communication digitale, et favorise leur insertion professionnelle.
      </p>
    </article>
  </div>
  <article class="card span-3 card-c3">
    <h3>Compétences Clés (Hard Skills)</h3>
    <p>
      Mon expertise technique se concentre sur le développement numérique Full Stack et les fondamentaux
      systèmes/réseaux.
    </p>
    <div class="split-content">
      <div>
        <h4>Développement Web Full Stack</h4>
        <ul>
          <li><strong>Intégration Web :</strong> Maîtrise de HTML5, CSS3 (SASS, Bootstrap), JavaScript et PHP.</li>
          <li><strong>Animation Web :</strong> Expertise en animation avec CSS, SMIL, WAAPI et GSAP.</li>
          <li><strong>Développement Frontend :</strong> Compétences en JavaScript, Vue.js et JQuery.</li>
          <li><strong>Développement Backend :</strong> Expérience en développement PHP.</li>
        </ul>
      </div>
      <div>
        <h4>Écosystème &amp; Outils Techniques</h4>
        <ul>
          <li><strong>Bases de Données :</strong> Maîtrise du Modèle Conceptuel de Données et SQL.</li>
          <li><strong>Frameworks CSS :</strong> Utilisation de Bootstrap, Tailwind et préprocesseurs CSS
            (SASS).</li>
          <li><strong>SEO et CMS :</strong> Expertise en référencement et systèmes de gestion de contenu
            (Wordpress, Prestashop, ...).</li>
          <li><strong>Outils Collaboratifs :</strong> Maîtrise de Git pour le versionnage et le travail collaboratif.
          </li>
        </ul>
      </div>
    </div>
  </article>

  <article class="card span-3 card-c2">
    <h3>Leadership &amp; Pédagogie (Soft Skills)</h3>
    <p>
      En tant que responsable de formation, je combine transmission et management.
    </p>
    <div class="split-content">
      <div>
        <h4>Gestion et Coordination</h4>
        <ul>
          <li><strong>Management des Vacataires et Enseignants :</strong> Supervision et coordination des intervenants
            pour assurer la qualité de la formation.</li>
          <li><strong>Gestion de l'Emploi du Temps :</strong> Organisation des plannings et des ressources pour
            optimiser
            le déroulement des cours.</li>
          <li><strong>Contact avec les Entreprises :</strong> Négociation et suivi des partenariats pour les
            alternances,
            assurant une adéquation entre les besoins des entreprises et les compétences des étudiants.</li>
        </ul>
      </div>
      <div>
        <h4>Pédagogie Adaptée</h4>
        <ul>
          <li><strong>Transmission des Connaissances :</strong> Capacité à expliquer des notions techniques complexes
            (algorithmique, langages) de manière claire et accessible.</li>
          <li><strong>Encadrement des Projets :</strong> Encadrement des projets tutorés et promotion du travail
            collaboratif via Git.</li>
          <li><strong>Innovation Éducative :</strong> Développement d'outils éducatifs innovants comme AlgoPath pour
            rendre l'apprentissage de l'algorithmique plus engageant et accessible.</li>
        </ul>
      </div>
    </div>
  </article>
</div>