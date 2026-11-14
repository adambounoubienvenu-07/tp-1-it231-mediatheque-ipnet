<?php
declare(strict_types=1);

/**
 * detail.php – Informations complètes d'un livre
 * Exemple : detail.php?id=3
 */
require_once __DIR__ . '/data/livres.php';
require_once __DIR__ . '/includes/fonctions.php';

$titrePage     = 'Détail du livre';
$livre         = null;
$messageErreur = null;

// filter_input() retourne :
//   - null  si le paramètre « id » est absent
//   - false si la valeur n'est pas un entier valide (ex. : id=abc)
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === null) {
    $messageErreur = "Aucun identifiant de livre n'a été fourni.";
    http_response_code(400);
} elseif ($id === false) {
    $messageErreur = "L'identifiant fourni est invalide : il doit être un nombre entier.";
    http_response_code(400);
} else {
    $livre = trouverLivreParId($livres, $id);

    if ($livre === null) {
        $messageErreur = "Aucun livre ne correspond à l'identifiant " . $id . ".";
        http_response_code(404);
    } else {
        $titrePage = $livre['titre'];
    }
}

include __DIR__ . '/includes/header.php';
?>

<?php if ($livre !== null): ?>

    <article class="fiche">
        <h1><?= echapper($livre['titre']) ?></h1>
        <p class="fiche-auteur">de <?= echapper($livre['auteur']) ?></p>

        <dl class="fiche-liste">
            <dt>Identifiant</dt>
            <dd><?= echapper((string) $livre['id']) ?></dd>

            <dt>Année de publication</dt>
            <dd><?= echapper((string) $livre['annee']) ?></dd>

            <dt>Catégorie</dt>
            <dd>
                <a href="catalogue.php?categorie=<?= echapper(urlencode($livre['categorie'])) ?>"><?= echapper(libelleCategorie($livre['categorie'])) ?></a>
            </dd>

            <dt>Prix</dt>
            <dd><?= echapper(formaterPrix((int) $livre['prix'])) ?></dd>

            <dt>Disponibilité</dt>
            <dd><?= badgeDisponibilite((bool) $livre['disponible']) ?></dd>
        </dl>

        <p><a href="catalogue.php">&larr; Retour au catalogue</a></p>
    </article>

<?php else: ?>

    <h1>Livre introuvable</h1>
    <div class="alerte alerte-erreur" role="alert">
        <p><?= echapper($messageErreur) ?></p>
        <p><a href="catalogue.php">&larr; Retour au catalogue</a></p>
    </div>

<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
