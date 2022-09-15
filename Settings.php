<?php

class Settings
{
    public function __construct()
    {
        $fp = fopen(".env", "r");

        while (!feof($fp)){

            $linea = fgets($fp);
            $vars = explode("=", $linea);

            if(count($vars) <= 1){
                continue;
            }

            $key = $this->remove_quotes($vars[0]);
            $val = $this->remove_quotes($vars[1]);

            $_ENV[$key]=$val;
            
        }
        fclose($fp);

    }

    public function remove_quotes($str)
    {
        return str_replace('"', '', str_replace("'", '', $str));
    }
}