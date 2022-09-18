<?php

namespace Controllers;

use Models\Users;

class UsersController{
    
    /*=============================================
    Mostrar toda los leads      
    =============================================*/
    public function ctrIndex(){

        try {
            
            $tabla = 'leads';

            $usuarios = Users::mdlIndex($tabla);

            if (count($usuarios)==0) {
                
                $datosJson = '{"data":[]}';

                echo $datosJson;

                return;
            }

            if (!empty($usuarios)) {

                $respuesta = array(
                    "status"    => 200,
                    "hc:length" => count($usuarios),
                    "_rel"      => "leads",
                    "_embeddeb"      => array(
                        "leads" => $usuarios
                    )
                );

            }else{
                $respuesta = array(
                    'status' => 400,
                    'message' => 'No hay registros',
                    'value' => '',
                    'messages' => ''
                );
            }

            echo json_encode($respuesta, true);
            
            return;

        } catch (Exception $e) {

            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            
            return;
        }
    }

  
    /*=============================================
    Mostrar toda la información de la pagina       
    =============================================*/

    public function ctrStore( $values ){

        if ( isset( $values ) && !empty( $values )) {

            try {
                
                $table = 'leads';

                $data = array( 
                    'first_name' => $values['first_name'],
                    'id' => $values['id'],
                    'email' => $values['emails'][0]['email'],
                    'response_object' => json_encode($values),
                );

                $answer = Users::mdlStore( $table, $data );

                if ( $answer == 'ok' ) {

                    $ans = array(
                        "status" => 200,
                        "detalle"=>"Leads almacenado correctamente"
                    );

                    echo json_encode($ans, true); 

                }else{

                    $ans = array(
                        "status" => 400,
                        "detalle"=> "No se pudo almacenar la pregunta"
                    );

                    echo json_encode($ans, true); 

                }

            } catch (Exception $e) {
                
                new Helpers\ExceptionHandling($e);
                
            }
            
        }
        
        return;

    }

    /*=============================================
    Editar información de la pagina       
    =============================================*/

    public function ctrUpdateQuestion( $values ){

        if ( isset( $values['pregunta'] ) && !empty( $values['pregunta'] )) {
            
            $table = 'preguntas';

            $data = array( 'pregunta'       => $values['pregunta'], 
                           'opciones'       => $values['opciones'], 
                           'modulo'         => $values['modulo'], 
                           'longitud'       => $values['longitud'],
                           'formula'        => $values['formula'],
                           'id'             => $values['id'] );

            $answer = UsersModel::mdlUpdateQuestion( $table, $data );

            if ( $answer == 'ok' ) {

                $ans = array(
                    "status" => 200,
                    "detalle"=>"Pregunta actualizadas correctamente"
                );

                echo json_encode($ans, true); 

            }else{

                $ans = array(
                    "status" => 400,
                    "detalle"=> json_encode($answer)
                );

                echo json_encode($ans, true); 

            }
        }
        
        return;

    }

    /*=============================================
    Ver un solo recurso de la pagina       
    =============================================*/

    public function ctrShow($datos){

        $tabla = 'usuarios';
        $correo = $datos['correo'];
        $password = $datos['password'];

        $usuarios = UsersModel::mdlShow($tabla, $correo, $password);

        if (!empty($usuarios)) {

            $respuesta = array(
                "status"=>200,
                "detalle"=> $usuarios
            );

        }else{
            $respuesta = array(
                'status' => 400,
                'message' => 'No hay registros que coincidan',
                'value' => '',
                'messages' => ''
            );
        }

        

        echo json_encode($respuesta, true);
        
        return;

    }

    /*=============================================
    Borrar un solo recurso de la pagina       
    =============================================*/

    public function delete($id){

        $json = array(
        
            "detalle"=>"Se ah borrado el recurso: ". $id
        );

        echo json_encode($json, true);
        
        return;

    }

}