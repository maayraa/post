<?php

require_once "Dbconnect.php";
class Categories{
    /* Crear categoria */
    static public function mdIngresarCategoria($table, $datos){
        $stmt = DbConnect::connect()->prepare("INSERT INTO $table(category) VALUES (:category)");
        $stmt->bindParam(":category", $datos, PDO::PARAM_STR);
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    /* Mostrar Categorias */

    static public function mdMostrarCategoria($table, $item, $value){
        if($item != null){
            $stmt = DBconnect::connect()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetch();

        }else{
            $stmt = DBconnect::connect()->prepare("SELECT * FROM $table");
            $stmt->execute();
            return $stmt -> fetchAll();
        }
        
        $stmt->close();
        $stmt = null;
    }
}