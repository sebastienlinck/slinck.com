# Site personnel - Sébastien Linck

Site PHP séquentiel, sans framework ni base de données.

## Structure

```
index.php      routeur + gabarit (menu, titres, SEO, pied de page)
.htaccess      HTTPS, www, routage, protection, en-têtes de sécurité
pages/         une page = un fichier (logique PHP en haut, contenu HTML dessous)
css/ js/ img/  ressources (js/app.js = thème + service worker)
articles/      PDF (non indexés : voir robots.txt)
vendor/        PHPMailer (envoi SMTP du formulaire)
sw.js          service worker maison (hors ligne)
```

## Ajouter une page

1. Ajouter une entrée dans le tableau `$pages` de `index.php` (titre, description, menu, icône).
2. Créer `pages/<nom>.php`.
3. L'ajouter dans `sitemap.xml`.

## Configuration du formulaire de contact

```bash
cp .env.example .env   # puis renseigner SMTP_* et APP_SECRET
```

Le fichier `.env` n'est jamais versionné (`.gitignore`) ni accessible depuis le web (`.htaccess`).

## Développement local

Le site suppose d'être servi à la racine d'un domaine (`<base href="/">`) avec la réécriture Apache activée
(XAMPP, Laragon, MAMP...).
