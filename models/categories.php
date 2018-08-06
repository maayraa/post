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

    static public function mdViewCategory($table, $item, $value){
        if($item != null){
            $stmt = DBconnect::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
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

        /* Editar categoria */
        static public function mdEditCategory($table, $datos){
            $stmt = DbConnect::connect()->prepare("UPDATE $table SET category = :category WHERE id = :id");
            $stmt->bindParam(":category", $datos['category'], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos['id'], PDO::PARAM_INT);
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }
    
            $stmt->close();
            $stmt = null;
        }
    
        /* Borrar Categoria */
        static public function mdDeleteCategory($table, $datos){
            $stmt = DBconnect::connect()->prepare("DELETE FROM $table WHERE id =:id");
            $stmt->bindParam(":id", $datos, PDO::PARAM_INT);
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }
    
            $stmt->close();
            $stmt = null;
        }
}