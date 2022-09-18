<?php

header('Content-type: application/json');

use Controllers\RoutesController;

spl_autoload_register(function ($class) {
    require_once str_replace('\\', '/', $class) . '.php';
});

$routes = new RoutesController();
$routes -> index();
