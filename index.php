<?php
declare(strict_types=1);

/**
 * index.php – Page d'accueil de la médiathèque IPNET
 */
require_once __DIR__ . '/data/livres.php';
require_once __DIR__ . '/includes/fonctions.php';

$titrePage = 'Accueil';

// Statistiques calculées à partir du tableau $livres
$totalLivres      = count($livres);
$totalDisponibles = compterLivresDisponibles($livres);

include __DIR__ . '/includes/header.php';
?>

<section class="accueil">
    <h1>Bienvenue à la médiathèque IPNET</h1>
    <p class="intro">
        Retrouvez ici le catalogue des livres mis à la disposition des étudiants
        de l'IPNET Institute of Technology : romans, essais, ouvrages d'informatique et bien plus encore.
    </p>

    <div class="stats">
        <div class="stat">
            <span class="stat-nombre"><?= $totalLivres ?></span>
            <span class="stat-texte">livres au catalogue</span>
        </div>
        <div class="stat">
            <span class="stat-nombre"><?= $totalDisponibles ?></span>
            <span class="stat-texte">livres disponibles</span>
        </div>
    </div>

    <p><a class="bouton" href="catalogue.php">Consulter le catalogue</a></p>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
