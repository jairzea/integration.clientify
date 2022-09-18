<?php

namespace Helpers;

class ExceptionHandling
{

    public $excepction;

    public function __construct($e)
    {
        http_response_code(500);

        $this->exception = [
            "message" => $e->getMessage(),
            "file" => $e->getFile(),
            "line" => $e->getLine()
        ];

        //Crear y ecribir archivo log
        $logFile = fopen("log.txt", 'a') or die("Error creando archivo");

        fwrite(
            $logFile, 
            "\n\n" . date("d/m/Y H:i:s") . 
            "\n"   . "message => " . $e->getMessage() .
            "\n"   . "file => " . $e->getFile() .
            "\n"   . "line => " . $e->getLine()
        ) or die("Error escribiendo en el archivo");
        
        fclose($logFile);


        echo json_encode($this->exception);

    }

    public function getException()
    {
        return $this->exception;
    }
}