<?php

namespace Models;

use Models\Conection;
use PDO;

class Users{

    /*=============================================
    Ver información usuarios      
    =============================================*/
    static public function mdlIndex($tabla){

        $stmt = Conection::connect()->prepare("SELECT * FROM $tabla");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }

    /*=============================================
    Ver información usuarios      
    =============================================*/
    static public function mdlShow($tabla, $correo, $password){

        $stmt = Conection::connect()->prepare("SELECT * FROM $tabla WHERE correo = '$correo' AND password = '$password'");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;
    }

    /*======================================
    =            Crear leads            =
    ======================================*/
   static public function mdlStore( $table, $data)
   {

        try {
            
            $stmt = Conection::connect()->prepare("INSERT INTO $table( name, email, id_clientify, response_object ) VALUES ( :first_name, :email, :id, :response_object )");

            $stmt->bindParam(":first_name", $data['first_name'], PDO::PARAM_STR);
            $stmt->bindParam(":id", $data['id'], PDO::PARAM_STR);
            $stmt->bindParam(":email", $data['email'], PDO::PARAM_STR);
            $stmt->bindParam(":response_object", $data['response_object'], PDO::PARAM_STR);

            if($stmt->execute()){

                return "ok";

            }else{

                return $stmt->errorInfo();
            
            }

            $stmt->close();
            $stmt = null;
            
        } catch (Exception $e) {
                
            new Helpers\ExceptionHandling($e);
            
        }

   }

   /*======================================
    =         Actualizar pregunta         =
    ======================================*/
   static public function mdlUpdateQuestion( $table, $data)
   {
   		$stmt = Conection::connect()->prepare("UPDATE $table SET pregunta = :pregunta, opciones = :opciones, genero = :genero, formula_auto = :formula, longitud = :longitud  WHERE id = :id");

		$stmt->bindParam(":pregunta", $data['pregunta'], PDO::PARAM_STR);
		$stmt->bindParam(":opciones", $data['opciones'], PDO::PARAM_STR);
		$stmt->bindParam(":genero", $data['modulo'], PDO::PARAM_STR);
		$stmt->bindParam(":formula", $data['formula'], PDO::PARAM_STR);
		$stmt->bindParam(":longitud", $data['longitud'], PDO::PARAM_STR);
		$stmt->bindParam(":id", $data['id'], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;
   }
   
}