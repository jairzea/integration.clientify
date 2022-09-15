<?php

require('./Settings.php');

class RouteController
{

    public function index(){

        if(class_exists('Settings'))
            $created_var = new Settings();

        include 'Routes/Routes.php';
    }
}