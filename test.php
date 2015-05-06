<?php
require 'vendor/autoload.php';
$chart = new \src\phpgc();

$pieColumns = array(
    'Country' => array(
        'type' => 'string',
        'label' => 'Name of Country'
    ),
    'Population' => array(
        'type' => 'number',
        'label' => 'Population'
    )
);

$pieRows = array(
    array(
        0 => 'Germany',
        1 => 100000,
    ),
    array(
        0 => 'United States',
        1 => 120000,
    ),
    array(
        0 => 'Brazil',
        1 => 80000,
    ),
    array(
        0 => 'Canada',
        1 => 70000,
    ),
    array(
        0 => 'France',
        1 => 50000,
    ),
    array(
        0 => 'BD',
        1 => 100000,
    ),
    array(
        0 => 'RU',
        1 => 90000,
    ),
);
$pieOptions = array(
    'title' => 'Population',
    'width' => 'autometic',
    'height' => '250',
    'widget' => true,
    'class' => 'custom',
    'div' => 'pie_chart_1',
);
echo $chart->pieChart($pieColumns, $pieRows, $pieOptions);


