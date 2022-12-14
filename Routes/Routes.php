<?php

use Controllers\UsersController;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

$arrayRutas = explode('/', $_SERVER['REQUEST_URI']);

if($_ENV['TYPE_VHOST'] == 'subdomain'){
    $index = 0;
}else{
    $index = 1;
}

/*=============================================
Cuando se hace una peticion a la api       
=============================================*/
if (count(array_filter($arrayRutas)) == $index) {
    
    $json = array(

        "detalle"=>"no encontrado"
    );

    echo json_encode($json, true);

    return;

}else{

    if (count(array_filter($arrayRutas)) == $index + 1) {
       
        $consulta = explode('/', array_filter($arrayRutas)[2]);

        /*=============================================
        OBTENER TOKEN      
        =============================================*/
        if ($consulta[0] == 'auth') {

            /*-- Obtener todas las Preguntas --*/
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {

                $json = array(

                    "code"=> ( isset($_GET['code']) ) ? $_GET['code'] : '035d01cff788d4c2426b84f79c319a51',
                    "client_id"=>"936dd079-f504-4fc3-b3f1-847ea075f87b",
                    "client_secret"=>"01d9387495554389a028de37480bb530"
                );
            
                echo json_encode($json, true);
            
                return;
               
            }

    
        }

        /*=============================================
        CRUD LEADS - BD INTERNA (ardys)
        =============================================*/
        if ($consulta[0] == 'leads') {

            /*-- Obtener todos los leads --*/
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {

                try {
                   
                    $leads = new UsersController();
                    $leads->ctrIndex();

                } catch (Exception $e) {

                    new Helpers\ExceptionHandling($e);

                }
         
            }

            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

                $data = json_decode(file_get_contents('php://input'), true);

                // echo json_encode($data);
                $leads = new UsersController();
                $leads->ctrStore( $data['data'] );
            }

    
        }else{

            http_response_code(404);

            echo json_encode([$consulta[0] . ", Not Found"]);

        }
    
    }


}
