<?php
declare(strict_types=1);

/**
 * includes/fonctions.php
 * Fonctions utilitaires de la médiathèque IPNET.
 */

// Fuseau horaire du Togo : sert pour l'affichage de la date du jour
date_default_timezone_set('Africa/Lome');

/**
 * Échappe un texte avant de l'afficher dans la page (protection contre le XSS).
 * On utilise ENT_QUOTES pour échapper aussi les apostrophes
 * (ex. : « Le Monde s'effondre »).
 */
function echapper(string $texte): string
{
    return htmlspecialchars($texte, ENT_QUOTES, 'UTF-8');
}

/**
 * Retourne le nom lisible d'une catégorie à partir de son code.
 * Ex. : 'poesie' => 'Poésie'
 */
function libelleCategorie(string $categorie): string
{
    $libelles = [
        'roman'           => 'Roman',
        'poesie'          => 'Poésie',
        'science-fiction' => 'Science-fiction',
        'histoire'        => 'Histoire',
        'essai'           => 'Essai',
        'informatique'    => 'Informatique',
    ];

    // Si la catégorie n'est pas dans la liste, on met juste la première lettre en majuscule
    return $libelles[$categorie] ?? ucfirst($categorie);
}

/**
 * Retourne la liste des catégories présentes dans le tableau de livres
 * (sans doublons, triées par ordre alphabétique).
 */
function listerCategories(array $livres): array
{
    $categories = array_unique(array_column($livres, 'categorie'));
    sort($categories);

    return $categories;
}

/**
 * Met un prix en forme. Ex. : 4500 => '4 500 FCFA'
 * (espaces insécables pour éviter les retours à la ligne au milieu du prix).
 */
function formaterPrix(int $prix): string
{
    return number_format($prix, 0, ',', "\u{00A0}") . "\u{00A0}FCFA";
}

/**
 * Retourne le badge HTML indiquant si un livre est disponible ou non.
 */
function badgeDisponibilite(bool $disponible): string
{
    if ($disponible) {
        return '<span class="badge badge-dispo">Disponible</span>';
    }

    return '<span class="badge badge-indispo">Emprunté</span>';
}

/**
 * Retourne la ligne de tableau HTML (<tr>) d'un livre.
 * Toutes les valeurs affichées sont échappées avec htmlspecialchars()
 * (via la fonction echapper()).
 */
function afficherLivre(array $livre): string
{
    $id        = (int) $livre['id'];
    $titre     = echapper($livre['titre']);
    $auteur    = echapper($livre['auteur']);
    $annee     = echapper((string) $livre['annee']);
    $categorie = echapper(libelleCategorie($livre['categorie']));
    $prix      = echapper(formaterPrix((int) $livre['prix']));
    $badge     = badgeDisponibilite((bool) $livre['disponible']);

    return <<<HTML
        <tr>
            <td><a href="detail.php?id={$id}">{$titre}</a></td>
            <td>{$auteur}</td>
            <td>{$annee}</td>
            <td>{$categorie}</td>
            <td class="prix">{$prix}</td>
            <td>{$badge}</td>
        </tr>
    HTML;
}

/**
 * Retourne uniquement les livres d'une catégorie donnée.
 */
function filtrerParCategorie(array $livres, string $categorie): array
{
    $resultat = [];

    foreach ($livres as $livre) {
        if ($livre['categorie'] === $categorie) {
            $resultat[] = $livre;
        }
    }

    return $resultat;
}

/**
 * Cherche un livre à partir de son identifiant.
 * Retourne le livre (tableau) s'il existe, sinon null.
 */
function trouverLivreParId(array $livres, int $id): ?array
{
    foreach ($livres as $livre) {
        if ($livre['id'] === $id) {
            return $livre;
        }
    }

    return null;
}

/**
 * Compte le nombre de livres disponibles (disponible = true).
 */
function compterLivresDisponibles(array $livres): int
{
    $compteur = 0;

    foreach ($livres as $livre) {
        if ($livre['disponible']) {
            $compteur++;
        }
    }

    return $compteur;
}

/**
 * Retourne la date du jour en français. Ex. : 'samedi 14 novembre 2026'
 */
function dateDuJour(): string
{
    $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
    $mois  = [
        'janvier', 'février', 'mars', 'avril', 'mai', 'juin',
        'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre',
    ];

    $nomJour  = $jours[(int) date('N') - 1];   // date('N') : 1 (lundi) à 7 (dimanche)
    $numero   = (int) date('j');
    $nomMois  = $mois[(int) date('n') - 1];    // date('n') : 1 à 12
    $annee    = date('Y');

    // Le premier jour du mois s'écrit « 1er »
    $jourTexte = ($numero === 1) ? '1er' : (string) $numero;

    return $nomJour . ' ' . $jourTexte . ' ' . $nomMois . ' ' . $annee;
}
