<?php

require_once 'Controllers/Routes.controller.php';
require_once 'Controllers/Users.controller.php';

require_once 'Models/Users.Models.php';

$rutas = new ControladorRutas();
$rutas -> index();