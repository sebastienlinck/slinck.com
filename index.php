<?php

/**
 * Routeur + gabarit du site.
 * 1. Chaque page est un fichier de pages/ (logique PHP en haut, contenu HTML en dessous).
 * 2. La page est exécutée AVANT l'affichage du gabarit : elle peut donc rediriger (header + exit).
 * 3. Ajouter une page = une ligne dans $pages + un fichier dans pages/.
 */
ini_set('display_errors', '0');
error_reporting(E_ALL);

const SITE = 'https://www.slinck.com';

// ---------------------------------------------------------------------------
// 1. Les pages : slug => infos. 'menu' = libellé dans la navigation (null = pas dans le menu)
// ---------------------------------------------------------------------------
$pages = [
	'accueil' => [
		'title' => 'Sébastien Linck – Enseignant & responsable de formation (EiSINe)',
		'h1'    => 'Sébastien Linck',
		'h2'    => 'Enseignant & Responsable de formation',
		'desc'  => "Sébastien Linck, enseignant en informatique et responsable de la Licence Pro Métiers du Numérique à l'EiSINe (Charleville-Mézières).",
		'menu'  => 'Accueil',
		'icon'  => 'home',
	],
	'enseignements' => [
		'title' => 'Enseignements – Sébastien Linck',
		'h1'    => 'Enseignements',
		'h2'    => 'Modules pédagogiques détaillés',
		'desc'  => "Modules enseignés par Sébastien Linck : développement web, SEO, PWA, réseaux et sécurité, de la licence aux écoles d'ingénieurs.",
		'menu'  => 'Cours',
		'icon'  => 'lesson',
	],
	'recherche' => [
		'title' => 'Recherche – Sébastien Linck',
		'h1'    => 'Recherche',
		'h2'    => 'Réseaux, Mobilité & Innovation Pédagogique',
		'desc'  => "Travaux de recherche de Sébastien Linck : réseaux hétérogènes, EIAH et projet AlgoPath, un serious game 3D pour apprendre l'algorithmique.",
		'menu'  => 'Recherche',
		'icon'  => 'network-analytic',
	],
	'publications' => [
		'title' => 'Publications – Sébastien Linck',
		'h1'    => 'Publications',
		'h2'    => 'Articles, Conférences & Thèse',
		'desc'  => 'Articles de revues, conférences internationales et thèse de doctorat de Sébastien Linck, avec liens PDF.',
		'menu'  => 'Publi',
		'icon'  => 'books',
	],
	'contact' => [
		'title' => 'Contact et admissions – Sébastien Linck',
		'h1'    => 'Contact',
		'h2'    => 'Coordonnées, admissions & formulaire',
		'desc'  => "Contacter Sébastien Linck et s'informer sur la Licence Pro Métiers du Numérique : admissions, alternance, formation continue.",
		'menu'  => 'Contact',
		'icon'  => 'envelope',
	],
	'mentions-legales' => [
		'title' => 'Mentions légales – Sébastien Linck',
		'h1'    => 'Mentions légales',
		'h2'    => 'Informations juridiques & CGU',
		'desc'  => 'Mentions légales, conditions d\'utilisation et données personnelles du site slinck.com.',
		'menu'  => null,
	],
];

// Page affichée quand l'adresse n'existe pas (hors du tableau : /erreur n'est pas une vraie page)
$erreur = [
	'title' => 'Page introuvable – Sébastien Linck',
	'h1'    => 'Erreur 404',
	'h2'    => 'Page introuvable',
	'desc'  => 'Page introuvable.',
	'menu'  => null,
];

// ---------------------------------------------------------------------------
// 2. Quelle page ? (aucun risque d'inclusion : on ne garde que les slugs connus)
// ---------------------------------------------------------------------------
$brut = (isset($_GET['page']) && is_string($_GET['page'])) ? $_GET['page'] : '';
$slug = trim($brut, '/');

if ($slug === '') {
	$slug = 'accueil';
}

if (isset($pages[$slug])) {
	$page = $pages[$slug];
	// Une seule adresse par page : /accueil, /contact/ ... redirigent vers l'adresse officielle
	$officielle = ($slug === 'accueil') ? '/' : '/' . $slug;
	if ($brut !== '' && $brut !== ltrim($officielle, '/')) {
		header('Location: ' . $officielle, true, 301);
		exit;
	}
} else {
	$slug = 'erreur';
	$page = $erreur;
	http_response_code(404);
}

$canonical = SITE . (($slug === 'accueil' || $slug === 'erreur') ? '/' : '/' . $slug);
$fichier   = __DIR__ . '/pages/' . $slug . '.php';

// ---------------------------------------------------------------------------
// 3. On exécute la page dans un tampon (elle peut rediriger), puis on affiche le gabarit
// ---------------------------------------------------------------------------
ob_start();
require $fichier;
$contenu = ob_get_clean();

// Date de « mise à jour » = dernière modification du fichier de la page
$mois = ['', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
$ts   = @filemtime($fichier) ?: time();
$maj  = $mois[(int) date('n', $ts)] . ' ' . date('Y', $ts);

function h(string $s): string
{
	return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); // SUBSTITUTE : un octet invalide ne vide plus toute la chaîne
}
?>
<!doctype html>
<html lang="fr" data-theme="dark">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= h($page['title']) ?></title>
	<meta name="description" content="<?= h($page['desc']) ?>">
	<meta name="author" content="Sébastien Linck">
	<?php if ($slug === 'erreur') : ?>
		<meta name="robots" content="noindex">
	<?php endif; ?>
	<link rel="canonical" href="<?= h($canonical) ?>">
	<base href="/">

	<meta property="og:type" content="website">
	<meta property="og:site_name" content="Sébastien Linck">
	<meta property="og:title" content="<?= h($page['title']) ?>">
	<meta property="og:description" content="<?= h($page['desc']) ?>">
	<meta property="og:url" content="<?= h($canonical) ?>">
	<meta property="og:image" content="<?= SITE ?>/img/linck.webp">
	<meta name="twitter:card" content="summary">

	<meta name="theme-color" content="#0A1F44">
	<link rel="manifest" href="slinck.webmanifest">
	<link rel="icon" type="image/svg+xml" href="img/favicon.svg">
	<link rel="stylesheet" href="css/style.css?v=<?= @filemtime(__DIR__ . '/css/style.css') ?>">
	<?php /* Mesure d'audience (Matomo) : coller ici le script fourni si vous l'installez */ ?>
	<?php /* Script volontairement dans <head> et sans "defer" : il applique le thème avant l'affichage (pas de flash) */ ?>
	<script src="js/app.js?v=<?= @filemtime(__DIR__ . '/js/app.js') ?>"></script>
	<?php if ($slug === 'accueil') : ?>
		<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "Person",
				"name": "Sébastien Linck",
				"jobTitle": "Enseignant en informatique, responsable de la Licence Pro Métiers du Numérique",
				"worksFor": {
					"@type": "CollegeOrUniversity",
					"name": "EiSINe – École d'ingénieurs en Sciences Industrielles et Numérique"
				},
				"url": "<?= SITE ?>/",
				"sameAs": [
					"https://www.linkedin.com/in/slinck/",
					"https://www.researchgate.net/profile/Sebastien-Linck"
				]
			}
		</script>
	<?php endif; ?>
</head>

<body>
	<div class="app-container">

		<nav class="sidebar" aria-label="Navigation principale">
			<div class="logo-area">SL</div>

			<div class="nav-links">
				<?php foreach ($pages as $s => $p) : ?>
					<?php if ($p['menu'] === null) continue; ?>
					<a href="<?= $s === 'accueil' ? '/' : '/' . $s ?>" class="nav-item<?= $s === $slug ? ' active' : '' ?>" <?= $s === $slug ? 'aria-current="page"' : '' ?>>
						<img class="icons" src="img/<?= $p['icon'] ?>.svg" alt="" aria-hidden="true"><span><?= h($p['menu']) ?></span>
					</a>
				<?php endforeach; ?>
			</div>

			<button id="theme-toggle" class="theme-toggle" type="button" aria-label="Changer de thème (clair / sombre)">
				<img src="img/moon.svg" class="icon-moon" alt="" aria-hidden="true">
				<img src="img/sun.svg" class="icon-sun" alt="" aria-hidden="true">
			</button>
		</nav>

		<main class="main-content">
			<header>
				<h1><?= h($page['h1']) ?></h1>
				<h2><?= h($page['h2']) ?></h2>
			</header>

			<?= $contenu ?>

			<footer>
				<span>&copy; Sébastien Linck</span>
				<div>Mise à jour : <strong><?= h($maj) ?></strong></div>
				<a href="/mentions-legales" rel="nofollow">Mentions légales</a>
			</footer>
		</main>
	</div>
</body>

</html>