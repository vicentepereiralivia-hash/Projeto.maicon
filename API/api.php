<?php
header('Content-Type: application/json; charset=utf-8');

$showsData = [
    [
        'id' => 1,
        'year' => 2024,
        'location' => 'Nova Iorque, EUA',
        'theme' => 'The Tour & O Retorno Oficial',
        'musicalGuests' => ['Cher', 'Tyla', 'Lisa (BLACKPINK)'],
        'iconicModels' => ['Tyra Banks', 'Gigi Hadid', 'Candice Swanepoel', 'Adriana Lima'],
        'description' => 'O grande retorno oficial das passarelas após 6 anos de hiato, celebrando a inclusão, a diversidade e a reunião das supermodelos lendárias da marca.'
    ],
    // ... restantes desfiles
];

echo json_encode($showsData);