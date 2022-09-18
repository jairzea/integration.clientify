<?php

namespace Models;
use PDO;

define('DRIVER',  $_ENV['DB_CONNECTION']);
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_NAME', $_ENV['DB_DATABASE']);
define('DB_USER', $_ENV['DB_USERNAME']);
define('DB_PASS', $_ENV['DB_PASSWORD']);

class Conection{

    static public function connect(){

        $dsn = sprintf( '%s:host=%s;dbname=%s', DRIVER, DB_HOST, DB_NAME );

        $link = new PDO($dsn, DB_USER, DB_PASS);

        $link ->exec('set names utf8');

        return $link;

    }

}