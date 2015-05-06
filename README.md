# phpgc

phpgc is the PHP wrapper class which provides a flexible way to build chart. phpgc is using Google Chart api to draw chart. This is actually working as wrapper of google chart api. With this phpgc you can easily visualise your data into your web application.

Installation
============
Write ``` "sohelrana820/phpgc": "dev-master" ``` file in your composer.json file to install. If you want to manual install then download this repository and paste somewhere in your project.

Usage
=====
Create a instance of phpgc class ``` $chart = new \src\phpgc(); ``` Now you can create chart by using this $chart object. Here I am showing example code for creating a pie chart.

```php

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

```

Please [click here](https://github.com/sohelrana820/phpgc) for see the full chart list.

