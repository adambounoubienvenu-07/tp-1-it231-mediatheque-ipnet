# Médiathèque IPNET – Catalogue dynamique (TP 1 – PHP)

**Unité d'enseignement :** IT 231 – Développement Web I
**Chargé du cours :** M. EDOU Dodji
**Étudiant :** Eyram ADAMBOUNOU
**Filière :** GL – Licence
**Année académique :** 2026-2027

## Description du projet

Ce projet est un premier site web pour la médiathèque de l'IPNET Institute of Technology.
Il permet d'afficher le catalogue de livres, de filtrer les livres par catégorie, de consulter
la fiche détaillée d'un livre et de lire une page de présentation de la médiathèque.

À ce stade, **aucune base de données n'est utilisée** : les livres sont stockés dans un
tableau associatif PHP (`data/livres.php`). Le projet est écrit en **PHP 8+ pur**, sans framework,
dans le but de maîtriser les bases du langage et la génération de pages dynamiques.

## Prérequis

- **PHP 8.0 ou plus** (vérifier avec `php -v`)
- Un serveur local au choix : **XAMPP**, **WAMP**, **MAMP** ou le serveur intégré de PHP
- Un navigateur web récent
- Git (pour récupérer le dépôt)

## Installation et lancement

### Option 1 – Avec XAMPP / WAMP / MAMP

1. Récupérer le projet : `git clone <adresse-du-depot>` (ou décompresser l'archive du TP).
2. Copier le dossier `mediatheque-mp1` dans le dossier web du serveur
   (`htdocs` pour XAMPP, `www` pour WAMP).
3. Démarrer **Apache** depuis le panneau de contrôle.
4. Ouvrir dans le navigateur : <http://localhost/mediatheque-mp1/>

### Option 2 – Avec PHP natif (sans XAMPP)

1. Ouvrir un terminal dans le dossier du projet :
   ```bash
   cd mediatheque-mp1
   ```
2. Lancer le serveur intégré de PHP :
   ```bash
   php -S localhost:8000
   ```
3. Ouvrir dans le navigateur : <http://localhost:8000/>

## Structure du projet

```
mediatheque-mp1/
├── index.php              # Page d'accueil
├── catalogue.php          # Catalogue + filtrage par catégorie
├── detail.php             # Détail d'un livre (detail.php?id=3)
├── apropos.php            # Page « À propos »
├── includes/
│   ├── header.php         # En-tête et menu (commun à toutes les pages)
│   ├── footer.php         # Pied de page (commun à toutes les pages)
│   └── fonctions.php      # Fonctions PHP du projet
├── data/
│   └── livres.php         # Tableau $livres (10 livres)
├── css/
│   └── style.css          # Feuille de style
└── README.md
```

## Fonctionnalités réalisées

- [x] **Page d'accueil** : message de bienvenue, lien vers le catalogue, nombre total de livres
      et nombre de livres disponibles (calculés en PHP à partir du tableau).
- [x] **Catalogue** : tableau HTML avec titre, auteur, année, catégorie, prix et disponibilité,
      et affichage du nombre de livres affichés.
- [x] **Filtrage par catégorie** via le paramètre d'URL `categorie`
      (ex. `catalogue.php?categorie=roman`), avec message d'erreur si la catégorie n'existe pas
      et lien pour revenir à l'affichage complet.
- [x] **Page détail** (`detail.php?id=3`) : informations complètes du livre, avec message d'erreur
      propre si l'identifiant est absent, invalide ou inexistant.
- [x] **Page « À propos »** : présentation statique et date du jour affichée grâce à une fonction PHP.
- [x] **Structure en plusieurs fichiers** avec `require_once` / `include` (en-tête, pied de page, fonctions).

## Fonctions (includes/fonctions.php)

| Fonction | Rôle |
|----------|------|
| `afficherLivre(array $livre): string` | Retourne la ligne de tableau HTML d'un livre |
| `filtrerParCategorie(array $livres, string $categorie): array` | Retourne les livres d'une catégorie |
| `trouverLivreParId(array $livres, int $id): ?array` | Retourne un livre à partir de son id, ou `null` |
| `compterLivresDisponibles(array $livres): int` | Compte les livres disponibles |

Fonctions utilitaires ajoutées : `echapper()` (appelle `htmlspecialchars()`), `libelleCategorie()`,
`listerCategories()`, `formaterPrix()`, `badgeDisponibilite()` et `dateDuJour()`.

## Sécurité de base

- Toute donnée affichée (tableau de livres, paramètres de l'URL) est échappée avec
  `htmlspecialchars()` (flags `ENT_QUOTES` et `UTF-8`) grâce à la fonction `echapper()`.
- Le paramètre `categorie` est nettoyé (`trim`, `strtolower`), vérifié avec `is_string()`
  et comparé à la liste des catégories existantes.
- Le paramètre `id` est validé avec `filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)`,
  puis on vérifie que le livre existe.

## Tests effectués

Le site a été testé avec le serveur intégré de PHP 8.3 (`php -S`) : aucune erreur, aucun
*warning* et aucune *notice* PHP n'apparaît sur les pages.

| URL | Résultat obtenu |
|-----|-----------------|
| `catalogue.php` | Les 10 livres, « 10 livres affichés » |
| `catalogue.php?categorie=roman` | Les 3 romans |
| `catalogue.php?categorie=cuisine` | Message « La catégorie « cuisine » n'existe pas » |
| `catalogue.php?categorie=<script>…` | Le texte est affiché tel quel (échappé), le code n'est pas exécuté |
| `detail.php?id=3` | Fiche du livre n° 3 |
| `detail.php?id=1` | Le titre contenant une apostrophe s'affiche correctement |
| `detail.php?id=99` | Message « Aucun livre ne correspond à l'identifiant 99 » |
| `detail.php?id=abc`, `detail.php` | Message d'erreur sur l'identifiant (absent ou invalide) |

## Dépôt GitHub

Le dépôt public associé au projet est [tp-1-it231-mediatheque-ipnet](https://github.com/adambounoubienvenu-07/tp-1-it231-mediatheque-ipnet). Pour publier cette copie locale et son historique, depuis ce dossier :

```bash
git push -u origin main
```

