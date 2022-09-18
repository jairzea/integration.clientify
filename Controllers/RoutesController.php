<?php

namespace Controllers;

use Vendor\EnvironmentVariables;

class RoutesController
{

    public function index(){

        $create = new EnvironmentVariables();

        include 'Routes/Routes.php';
    }
}

