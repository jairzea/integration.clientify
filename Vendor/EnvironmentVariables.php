<?php

namespace Vendor;

class EnvironmentVariables

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

            $key = $this->remove_character($vars[0]);
            $val = $this->remove_character($vars[1]);

            $_ENV[$key]=$val;
            
        }
        fclose($fp);

    }

    public function remove_character($str)
    {
        $str= str_replace('"', '', str_replace("'", '', $str));
        return trim($str, " \t\n\r\0\x0B");
    }
}