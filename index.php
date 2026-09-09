<?php
error_reporting(E_ALL);
ini_set('display_errors', FALSE);

// --- GESTION SESSION &amp; COOKIES ---
// Gestion des cookies déplacée entièrement côté client (JS)

$host = $_SERVER['HTTP_HOST'] ?? 'slinck.com';
$host = preg_replace('/[^a-z0-9\.\-:]/i', '', $host);

// --- ROUTING ---
$auth_pages = array(
	'accueil' => array(
		'url' => './views/accueil.html',
		'nom' => 'Site personnel',
		'titre_h1' => 'Sébastien Linck',
		'sous_titre' => 'Enseignant &amp; Responsable de formation'
	),
	'enseignements' => array(
		'url' => './views/enseignements.html',
		'nom' => 'Enseignements',
		'titre_h1' => 'Enseignements',
		'sous_titre' => 'Modules pédagogiques détaillés'
	),
	'recherche' => array(
		'url' => './views/recherche.html',
		'nom' => 'Recherche',
		'titre_h1' => 'Recherche',
		'sous_titre' => 'Réseaux, Mobilité &amp; Innovation Pédagogique'
	),
	'publications' => array(
		'url' => './views/publications.html',
		'nom' => 'Publications',
		'titre_h1' => 'Publications',
		'sous_titre' => 'Articles, Conférences &amp; Thèse'
	),
	'contact' => array(
		'url' => './views/contact.html',
		'nom' => 'Contact',
		'titre_h1' => 'Contact',
		'sous_titre' => 'Coordonnées &amp; Formulaire'
	),
	'mentions-legales' => array(
		'url' => './views/mentions-legales.html',
		'nom' => 'Mentions légales',
		'titre_h1' => 'Mentions Légales',
		'sous_titre' => 'Informations juridiques &amp; CGU'
	),
	'erreur' => array(
		'url' => './views/erreur.html',
		'nom' => 'Erreur',
		'titre_h1' => 'Erreur 404',
		'sous_titre' => 'Page introuvable'
	)
);

// Détection de la page
if (!isset($_GET['page'])) {
	$page = 'accueil';
	$is404 = false;
} elseif (array_key_exists($_GET['page'], $auth_pages)) {
	$page = $_GET['page'];
	$is404 = false;
} else {
	$page = 'erreur';
	$is404 = true;
}

if ($is404) {
	http_response_code(404);
}

$canonicalPage = $page !== 'accueil' ? '/' . htmlspecialchars($page, ENT_QUOTES, 'UTF-8') : '';
?>
<!doctype html>
<html lang="fr" data-theme="light">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sébastien Linck - <?= $auth_pages[$page]['sous_titre'] ?></title>
	<meta name="keywords" content="Sébastien Linck, Enseignant Informatique URCA, Responsable Licence Pro Web, Métiers du Numérique, EiSINe, Développement Front End, SEO, HTML, CSS, JS, PHP, Projets tutorés, Doctorat Réseaux" />
	<meta name="description" content="<?= $auth_pages[$page]['nom'] ?> - Sébastien Linck - <?= $auth_pages[$page]['sous_titre'] ?> - École d’ingénieurs en Sciences Industrielles et Numérique - EiSINe">
	<meta name="author" content="Sebastien Linck">
	<link rel="canonical" href="<?= 'https://' . $host . $canonicalPage; ?>">
	<link rel="manifest" href="./slinck.webmanifest">
	<link rel="icon" type="image/svg" sizes="256x256" href="./img/favicon.svg">

	<meta name="theme-color" content="#0A1F44">
	<meta property="og:title" content="Sébastien Linck – Enseignant en sciences du numérique | EiSINe">
	<meta property="og:description" content="Site web de Sébastien Linck, enseignant à l’École d’ingénieurs en Sciences Industrielles et Numérique (EiSINe) : formations, enseignements et travaux de recherche.">
	<meta property="og:type" content="website">
	<meta property="og:url" content="https://www.slinck.com/">
	<meta property="og:image" content="https://www.slinck.com/img/linck.webp">
	<meta property="og:site_name" content="Sébastien Linck">
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-CX6WD4QDPN"></script>

	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'G-CX6WD4QDPN');
	</script>
	<link rel="stylesheet" href="./css/style.min.css">
	<script>
		// On vérifie le stockage local immédiatement
		// Si 'dark' est trouvé, on applique l'attribut au HTML avant même l'affichage
		(function() {
			const savedTheme = localStorage.getItem('theme');
			if (savedTheme === 'dark') {
				document.documentElement.setAttribute('data-theme', 'dark');
			}
		})();
	</script>
</head>

<body>
	<div class="app-container">

		<nav class="sidebar">
			<div class="logo-area">SL</div>

			<div class="nav-links">
				<a href="./" class="nav-item <?= $page == 'accueil' ? 'active' : '' ?>">
					<img class="icons" src="./img/home.svg" alt="Accueil" /><span>Accueil</span>
				</a>
				<a href="enseignements" class="nav-item <?= $page == 'enseignements' ? 'active' : '' ?>">
					<img class="icons" src="./img/lesson.svg" alt="Cours" /><span>Cours</span>
				</a>
				<a href="recherche" class="nav-item <?= $page == 'recherche' ? 'active' : '' ?>">
					<img class="icons" src="./img/network-analytic.svg" alt="Recherche" /><span>Recherche</span>
				</a>
				<a href="publications" class="nav-item <?= $page == 'publications' ? 'active' : '' ?>">
					<img class="icons" src="./img/books.svg" alt="Publi" /><span>Publi</span>
				</a>
				<a href="contact" class="nav-item <?= $page == 'contact' ? 'active' : '' ?>">
					<img class="icons" src="./img/envelope.svg" alt="Contact" /><span>Contact</span>
				</a>
			</div>

			<button id="theme-toggle" class="theme-toggle" aria-label="Changer le thème">
				<img src="img/moon.svg" class="icon-moon" alt="Mode Sombre">
				<img src="img/sun.svg" class="icon-sun" alt="Mode Clair">
			</button>
		</nav>

		<main class="main-content">
			<header>
				<h1><?= $auth_pages[$page]['titre_h1'] ?></h1>
				<h2><?= $auth_pages[$page]['sous_titre'] ?></h2>
			</header>

			<?php
			if (file_exists($auth_pages[$page]['url'])) {
				include($auth_pages[$page]['url']);
			} else {
				include('./views/erreur.html');
			}
			?>

			<?php include('./views/footer.php'); ?>

		</main>
	</div>

	<section id="cookie">
		<h3>Cookies &amp; Confidentialité</h3>
		<p>Ce site utilise des cookies pour assurer son bon fonctionnement.</p>
		<button id="cookie-button" type="button">J'ai compris</button>
	</section>
	<script src="./js/scripts.min.js?v=<?= @filemtime('./js/scripts.min.js') ?>"></script>
	<script>
		if (typeof navigator.serviceWorker !== 'undefined') {
			navigator.serviceWorker.register('sw.js');
		}
	</script>
</body>

</html>