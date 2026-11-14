<?php
/**
 * includes/header.php
 * En-tête commun à toutes les pages (début du HTML + menu de navigation).
 * La variable $titrePage doit être définie dans la page avant l'inclusion.
 */
require_once __DIR__ . '/fonctions.php';

// Nom du fichier de la page en cours (pour mettre en évidence le menu actif)
$pageCourante = basename($_SERVER['SCRIPT_NAME']);
if ($pageCourante === 'detail.php') {
    // La page détail fait partie de la section « Catalogue »
    $pageCourante = 'catalogue.php';
}

$menu = [
    'index.php'     => 'Accueil',
    'catalogue.php' => 'Catalogue',
    'apropos.php'   => 'À propos',
];

$titreOnglet = isset($titrePage) ? $titrePage . ' – Médiathèque IPNET' : 'Médiathèque IPNET';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= echapper($titreOnglet) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="entete">
        <div class="conteneur entete-contenu">
            <a class="logo" href="index.php">Médiathèque <span>IPNET</span></a>
            <nav aria-label="Navigation principale">
                <ul class="menu">
                    <?php foreach ($menu as $fichier => $libelle): ?>
                        <li>
                            <a href="<?= echapper($fichier) ?>"<?= $fichier === $pageCourante ? ' class="actif"' : '' ?>><?= echapper($libelle) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="conteneur">
