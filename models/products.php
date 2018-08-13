<?php
    
    require_once "Dbconnect.php";
class Products{

    /* Mostrar Productos */
    static public function mdViewProducts($table, $item, $value){
        if($item != null){
            $stmt = DBconnect::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id_p DESC");
            $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetch();

        }else{
            $stmt = DBconnect::connect()->prepare("SELECT * FROM $table");
            $stmt ->execute();
            return $stmt -> fetchAll();
        }

        $stmt -> close();
        $stmt = null;
    }

    /* Registro de productos */
    static public function mdEnterProduct($table, $datos){
        $stmt = DBconnect::connect()->prepare("INSERT INTO $table(id, code, description, image, stock, purchase_p, sale_p) VALUES (:id, :code, :description, :image, :stock, :purchase_p, :sale_p)"); 
        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt -> bindParam(":code", $datos["code"], PDO::PARAM_STR);
        $stmt -> bindParam(":description", $datos["description"], PDO::PARAM_STR);
        $stmt -> bindParam(":image", $datos["image"], PDO::PARAM_STR);
        $stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
        $stmt -> bindParam(":purchase_p", $datos["purchase_p"], PDO::PARAM_STR);
        $stmt -> bindParam(":sale_p", $datos["sale_p"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }
}