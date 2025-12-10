<?php
// Outputs an array describing inheritance relationships between key classes.

require_once __DIR__ . '/spaceShip.php';
require_once __DIR__ . '/Entiteiten/canon.php';
require_once __DIR__ . '/Entiteiten/shield.php';
require_once __DIR__ . '/Entiteiten/Entiteit.php';

$classes = [
    'Entiteit',
    'Spaceship',
    'Canon',
    'Shield'
];

$inheritance = [];

foreach ($classes as $c) {
    if (!class_exists($c)) {
        $inheritance[$c] = [
            'exists' => false,
            'parent' => null,
            'implements' => []
        ];
        continue;
    }

    $parent = get_parent_class($c);
    $interfaces = class_implements($c);

    $inheritance[$c] = [
        'exists' => true,
        'parent' => $parent ?: null,
        'implements' => array_values($interfaces)
    ];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($inheritance, JSON_PRETTY_PRINT);

?>
