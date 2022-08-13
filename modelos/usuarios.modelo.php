<?php

require_once 'conexion.php';

class ModeloUsuarios{

    /*=============================================
    Ver información usuarios      
    =============================================*/
    static public function mdlIndex($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt -> close();

        $stmt = null;
    }

    /*=============================================
    Ver información usuarios      
    =============================================*/
    static public function mdlShow($tabla, $correo, $password){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE correo = '$correo' AND password = '$password'");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;
    }

    /*======================================
    =            Crear usuario            =
    ======================================*/
   static public function mdlCreate( $table, $data)
   {
   		$stmt = Conexion::conectar()->prepare("INSERT INTO $table( nombre ) VALUES ( :nombre )");

   		$stmt->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;
   }

   /*======================================
    =         Actualizar pregunta         =
    ======================================*/
   static public function mdlUpdateQuestion( $table, $data)
   {
   		$stmt = Conexion::conectar()->prepare("UPDATE $table SET pregunta = :pregunta, opciones = :opciones, genero = :genero, formula_auto = :formula, longitud = :longitud  WHERE id = :id");

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