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

}