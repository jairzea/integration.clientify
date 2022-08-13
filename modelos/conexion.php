<?php

class Conexion{

    static public function conectar(){

        $link = new PDO('mysql:host=localhost;dbname=ardyssecuador_db_salesforce',
        'ardyssecuador_user_salesforce',
        '#MYB#,nB+#hQ');

        $link ->exec('set names utf8');

        return $link;

    }

}