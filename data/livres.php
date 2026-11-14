<?php
/**
 * data/livres.php
 * Données du catalogue de la médiathèque IPNET.
 * À ce stade, il n'y a pas de base de données : les livres sont stockés
 * dans un tableau associatif PHP.
 *
 * Clés de chaque livre :
 *   id         : identifiant unique (entier)
 *   titre      : titre du livre
 *   auteur     : nom de l'auteur
 *   annee      : année de publication
 *   categorie  : catégorie (en minuscules, sans accent, utilisée dans l'URL)
 *   prix       : prix en FCFA
 *   disponible : true si le livre peut être emprunté, false sinon
 */
$livres = [
    [
        'id'         => 1,
        'titre'      => "Le Monde s'effondre",
        'auteur'     => 'Chinua Achebe',
        'annee'      => 1958,
        'categorie'  => 'roman',
        'prix'       => 4500,
        'disponible' => true,
    ],
    [
        'id'         => 2,
        'titre'      => 'Une si longue lettre',
        'auteur'     => 'Mariama Bâ',
        'annee'      => 1979,
        'categorie'  => 'roman',
        'prix'       => 3500,
        'disponible' => true,
    ],
    [
        'id'         => 3,
        'titre'      => "L'Enfant noir",
        'auteur'     => 'Camara Laye',
        'annee'      => 1953,
        'categorie'  => 'roman',
        'prix'       => 3000,
        'disponible' => false,
    ],
    [
        'id'         => 4,
        'titre'      => "Cahier d'un retour au pays natal",
        'auteur'     => 'Aimé Césaire',
        'annee'      => 1939,
        'categorie'  => 'poesie',
        'prix'       => 4000,
        'disponible' => true,
    ],
    [
        'id'         => 5,
        'titre'      => 'Fahrenheit 451',
        'auteur'     => 'Ray Bradbury',
        'annee'      => 1953,
        'categorie'  => 'science-fiction',
        'prix'       => 5000,
        'disponible' => true,
    ],
    [
        'id'         => 6,
        'titre'      => 'Le Meilleur des mondes',
        'auteur'     => 'Aldous Huxley',
        'annee'      => 1932,
        'categorie'  => 'science-fiction',
        'prix'       => 4800,
        'disponible' => false,
    ],
    [
        'id'         => 7,
        'titre'      => "Sapiens : une brève histoire de l'humanité",
        'auteur'     => 'Yuval Noah Harari',
        'annee'      => 2011,
        'categorie'  => 'histoire',
        'prix'       => 8500,
        'disponible' => true,
    ],
    [
        'id'         => 8,
        'titre'      => 'Les Damnés de la terre',
        'auteur'     => 'Frantz Fanon',
        'annee'      => 1961,
        'categorie'  => 'essai',
        'prix'       => 5500,
        'disponible' => true,
    ],
    [
        'id'         => 9,
        'titre'      => 'Clean Code',
        'auteur'     => 'Robert C. Martin',
        'annee'      => 2008,
        'categorie'  => 'informatique',
        'prix'       => 15000,
        'disponible' => true,
    ],
    [
        'id'         => 10,
        'titre'      => "Introduction à l'algorithmique",
        'auteur'     => 'Thomas H. Cormen',
        'annee'      => 2009,
        'categorie'  => 'informatique',
        'prix'       => 25000,
        'disponible' => false,
    ],
];
