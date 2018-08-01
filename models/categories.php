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
}