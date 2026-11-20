<?php

/**
 * Page Enseignements : 1 bloc Bento = 1 cours / matière, filtrable par composante ou par formation.
 */

// Composantes : clé => [classe de couleur de la carte, libellé du badge]
$composantes = [
	'eisine'  => ['card-c1', 'EiSINe (URCA)'],
	'cci'     => ['card-c2', 'CCI des Ardennes'],
	'iut-nfc' => ['card-c3', 'IUT Nord Franche-Comté (UMLP)'],
	'stgi'    => ['card-c4', 'UFR STGI (UMLP)'],
	'utbm'    => ['card-c5', 'UTBM'],
];

// Liste exhaustive des cours (1 entrée = 1 bloc)
$modules = [
	// ==================== EiSINe : LP Métiers du numérique ====================
	[
		'tags' => 'eisine lp-mn',
		'compo' => 'eisine',
		'formation' => 'Licence Professionnelle Métiers du numérique',
		'titre' => 'Intégration web (HTML, CSS)',
	],
	[
		'tags' => 'eisine lp-mn',
		'compo' => 'eisine',
		'formation' => 'Licence Professionnelle Métiers du numérique',
		'titre' => 'Animation (CSS, SMIL, WAAPI, GSAP)',
	],
	[
		'tags' => 'eisine lp-mn',
		'compo' => 'eisine',
		'formation' => 'Licence Professionnelle Métiers du numérique',
		'titre' => 'Développement Frontend (JavaScript, Vue.js, jQuery)',
	],
	[
		'tags' => 'eisine lp-mn',
		'compo' => 'eisine',
		'formation' => 'Licence Professionnelle Métiers du numérique',
		'titre' => 'Développement Backend (PHP)',
	],
	[
		'tags' => 'eisine lp-mn',
		'compo' => 'eisine',
		'formation' => 'Licence Professionnelle Métiers du numérique',
		'titre' => 'Base de données (Modèle Conceptuel de Données et SQL)',
	],
	[
		'tags' => 'eisine lp-mn',
		'compo' => 'eisine',
		'formation' => 'Licence Professionnelle Métiers du numérique',
		'titre' => 'Frameworks & Préprocesseurs CSS (SASS)',
	],
	[
		'tags' => 'eisine lp-mn',
		'compo' => 'eisine',
		'formation' => 'Licence Professionnelle Métiers du numérique',
		'titre' => 'Référencement & SEO',
	],
	[
		'tags' => 'eisine lp-mn',
		'compo' => 'eisine',
		'formation' => 'Licence Professionnelle Métiers du numérique',
		'titre' => 'CMS (WordPress, PrestaShop...)',
	],
	[
		'tags' => 'eisine lp-mn',
		'compo' => 'eisine',
		'formation' => 'Licence Professionnelle Métiers du numérique',
		'titre' => "Extensions pour navigateur & Progressive Web App (PWA)",
	],
	[
		'tags' => 'eisine lp-mn',
		'compo' => 'eisine',
		'formation' => 'Licence Professionnelle Métiers du numérique',
		'titre' => 'Architecture web, réseaux et sécurité',
	],
	[
		'tags' => 'eisine lp-mn',
		'compo' => 'eisine',
		'formation' => 'Licence Professionnelle Métiers du numérique',
		'titre' => 'Communication digitale & réseaux sociaux',
	],
	[
		'tags' => 'eisine lp-mn',
		'compo' => 'eisine',
		'formation' => 'Licence Professionnelle Métiers du numérique',
		'titre' => 'Travail collaboratif & versionning (Git)',
	],

	// ==================== EiSINe : Ingénieur Matériaux et Mécanique ====================
	[
		'tags' => 'eisine ing-mm',
		'compo' => 'eisine',
		'formation' => 'Ingénieur Matériaux et Mécanique (MM1)',
		'titre' => 'Mise à niveau Informatique',
	],
	[
		'tags' => 'eisine ing-mm',
		'compo' => 'eisine',
		'formation' => 'Ingénieur Matériaux et Mécanique (MM2)',
		'titre' => 'Collecte et filtrage des données',
	],
	[
		'tags' => 'eisine ing-mm',
		'compo' => 'eisine',
		'formation' => 'Ingénieur Matériaux et Mécanique (MM3)',
		'titre' => 'Compétences rédactionnelles',
	],
	// ==================== EiSINe : Ingénieur Génie Mécanique ====================
	[
		'tags' => 'eisine ing-gm',
		'compo' => 'eisine',
		'formation' => 'Ingénieur Génie Mécanique (GM1)',
		'titre' => 'Instrumentaton et données',
	],

	// ==================== EiSINe : Licence Sciences pour l'Ingénieur ====================
	[
		'tags' => 'eisine licence-spi',
		'compo' => 'eisine',
		'formation' => "Licence Sciences pour l'Ingénieur (L1)",
		'titre' => 'Algorithmique',
	],
	[
		'tags' => 'eisine licence-spi',
		'compo' => 'eisine',
		'formation' => "Licence Sciences pour l'Ingénieur (L1)",
		'titre' => 'Langage C',
	],
	[
		'tags' => 'eisine licence-spi',
		'compo' => 'eisine',
		'formation' => "Licence Sciences pour l'Ingénieur (L1)",
		'titre' => 'Compétences numériques (Bureautique)',
	],
	[
		'tags' => 'eisine licence-spi',
		'compo' => 'eisine',
		'formation' => "Licence Sciences pour l'Ingénieur (L2)",
		'titre' => 'Langage Java',
	],
	[
		'tags' => 'eisine licence-spi',
		'compo' => 'eisine',
		'formation' => "Licence Sciences pour l'Ingénieur (L2)",
		'titre' => 'Visual Basic for Applications (VBA)',
	],
	[
		'tags' => 'eisine licence-spi',
		'compo' => 'eisine',
		'formation' => "Licence Sciences pour l'Ingénieur (L2)",
		'titre' => 'Architecture machines et réseaux',
	],
	[
		'tags' => 'eisine licence-spi',
		'compo' => 'eisine',
		'formation' => "Licence Sciences pour l'Ingénieur (L3)",
		'titre' => 'Implémentation informatique des méthodes numériques',
	],
	[
		'tags' => 'eisine licence-spi',
		'compo' => 'eisine',
		'formation' => "Licence Sciences pour l'Ingénieur (L3)",
		'titre' => 'Modélisation Orientée Objet, Langage C++',
	],

	// ==================== EiSINe : Master IC ====================
	[
		'tags' => 'eisine master-ic',
		'compo' => 'eisine',
		'formation' => 'Master IC (M1 / M2)',
		'titre' => 'Capteurs et Informatique',
	],

	// ==================== CCI des Ardennes ====================
	[
		'tags' => 'cci',
		'compo' => 'cci',
		'formation' => "Formation Continue - Agence Nationale des Titres Sécurisés (ANTS)",
		'titre' => 'Formation en réseaux et sécurité',
	],

	// ==================== IUT Nord Franche-Comté (UMLP) ====================
	[
		'tags' => 'iut-nfc',
		'compo' => 'iut-nfc',
		'formation' => 'DUT Réseaux & Télécoms (R&T)',
		'titre' => 'Algorithmique (C)',
	],
	[
		'tags' => 'iut-nfc',
		'compo' => 'iut-nfc',
		'formation' => 'DUT Réseaux & Télécoms (R&T)',
		'titre' => 'Sécurité réseau',
	],
	[
		'tags' => 'iut-nfc',
		'compo' => 'iut-nfc',
		'formation' => 'DUT Réseaux & Télécoms (R&T)',
		'titre' => 'IP & Supervision (SNMP)',
	],
	[
		'tags' => 'iut-nfc',
		'compo' => 'iut-nfc',
		'formation' => "DUT Métiers du Multimédia et de l'Internet (MMI)",
		'titre' => 'Architecture des ordinateurs',
	],

	// ==================== UFR STGI (UMLP) ====================
	[
		'tags' => 'stgi',
		'compo' => 'stgi',
		'formation' => 'Master Services et Réseaux en Mobilité (M2)',
		'titre' => 'Simulation Réseau (NS-2) [Cours en anglais]',
	],
	[
		'tags' => 'stgi',
		'compo' => 'stgi',
		'formation' => 'Master Langues et Commerce Électronique (M1)',
		'titre' => 'Création de site web (HTML, CSS)',
	],

	// ==================== UTBM (Sevenans) ====================
	[
		'tags' => 'utbm',
		'compo' => 'utbm',
		'formation' => 'Cycle Préparatoire Ingénieur',
		'titre' => 'Programmation Langage C',
	],
	[
		'tags' => 'utbm',
		'compo' => 'utbm',
		'formation' => 'Cycle Préparatoire Ingénieur',
		'titre' => 'Projets informatiques',
	],
];
?>
<!-- Barre de filtres -->
<div class="filter-bar" hidden>
	<div class="filter-row" role="group" aria-label="Filtrer par composante">
		<span class="filter-label">Composantes</span>
		<button type="button" class="chip" data-filter="all" aria-pressed="true">Tous les cours</button>
		<button type="button" class="chip" data-filter="eisine" aria-pressed="false">EiSINe (URCA)</button>
		<button type="button" class="chip" data-filter="cci" aria-pressed="false">CCI Ardennes</button>
		<button type="button" class="chip" data-filter="iut-nfc" aria-pressed="false">IUT Nord Franche-Comté (UMLP)</button>
		<button type="button" class="chip" data-filter="stgi" aria-pressed="false">UFR STGI (UMLP)</button>
		<button type="button" class="chip" data-filter="utbm" aria-pressed="false">UTBM</button>
	</div>
	<div class="filter-row" role="group" aria-label="Filtrer par formation de l'EiSINe">
		<span class="filter-label">Formations EiSINe</span>
		<button type="button" class="chip" data-filter="lp-mn" aria-pressed="false">LP Métiers du Numérique</button>
		<button type="button" class="chip" data-filter="ing-mm" aria-pressed="false">Ingénieur MM</button>
		<button type="button" class="chip" data-filter="ing-gm" aria-pressed="false">Ingénieur GM</button>
		<button type="button" class="chip" data-filter="licence-spi" aria-pressed="false">Licence SPI</button>
		<button type="button" class="chip" data-filter="master-ic" aria-pressed="false">Master IC</button>
	</div>
	<p class="filter-count" aria-live="polite"></p>
</div>

<div class="bento-grid modules">
	<?php foreach ($modules as $m) : ?>
		<?php [$classe, $badge] = $composantes[$m['compo']]; ?>
		<article class="card <?= $classe ?>" data-tags="<?= h($m['tags']) ?>">
			<div class="module-top">
				<span class="badge"><?= h($badge) ?></span>
				<?php if (!empty($m['niveau'])) : ?>
					<span class="niveau-tag"><?= h($m['niveau']) ?></span>
				<?php endif; ?>
			</div>
			<h3><?= h($m['titre']) ?></h3>
			<p class="formation"><?= h($m['formation']) ?></p>
		</article>
	<?php endforeach; ?>
</div>