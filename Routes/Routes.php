<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

$arrayRutas = explode('/', $_SERVER['REQUEST_URI']);

/*=============================================
Cuando se hace una peticion a la api       
=============================================*/
if (count(array_filter($arrayRutas)) == 1) {

    

    echo $_ENV['API_VERSION'];
    
    /*$json = array(

        "detalle"=>"no encontrado"
    );

    echo json_encode($json, true);*/

    return;

}else{

    if (count(array_filter($arrayRutas)) == 2) {

        $consulta = explode('?', array_filter($arrayRutas)[1]);

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

                $leads = new ControladorUsuarios();
                $leads->ctrIndex();

                // try {
                //     //code...
                // } catch (\Throwable $th) {
                //     //throw $th;
                // }
                // echo 'entt';

               
               
            }

            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

                $data = json_decode(file_get_contents('php://input'), true);

                // echo json_encode($data);
                $leads = new ControladorUsuarios();
                $leads->ctrCreate( $data );
            }

    
        }
    
    }


}
