<?php
    
    require_once "Dbconnect.php";
class Products{

    /* Mostrar Productos */
    static public function mdViewProducts($item, $value){
        if($item != null){
            $stmt = Dbconnect::connect()->prepare("SELECT * FROM products WHERE $item = :$item ORDER BY id_p DESC");
            $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt->fetch();
       
        }else{
            $stmt = Dbconnect::connect()->prepare("SELECT * FROM products");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt -> close();
        $stmt = null;
    }
 /* Registro de productos */
 static public function mdEnterProduct($datos){
    $stmt = Dbconnect::connect()->prepare("INSERT INTO products (id, code, description, image, stock, purchase_p, sale_p) VALUES (:id, :code, :description, :image, :stock, :purchase_p, :sale_p)"); 
    $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
    $stmt -> bindParam(":code", $datos["code"], PDO::PARAM_STR);
    $stmt -> bindParam(":description", $datos["description"], PDO::PARAM_STR);
    $stmt -> bindParam(":image", $datos["image"], PDO::PARAM_STR);
    $stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
    $stmt -> bindParam(":purchase_p", $datos["purchase_p"], PDO::PARAM_STR);
    $stmt -> bindParam(":sale_p", $datos["sale_p"], PDO::PARAM_STR);

    if($stmt->execute()){
        return true;
    }else{
        return false;
    }

    $stmt-> close();
    $stmt = null;
}

 /* Editar productos */
 static public function mdEditProduct($datos){
    $stmt = Dbconnect::connect()->prepare("UPDATE products SET id = :id, description = :description, image = :image, stock = :stock, purchase_p = :purchase_p, sale_p = :sale_p WHERE code = :code"); 
    $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
    $stmt -> bindParam(":code", $datos["code"], PDO::PARAM_STR);
    $stmt -> bindParam(":description", $datos["description"], PDO::PARAM_STR);
    $stmt -> bindParam(":image", $datos["image"], PDO::PARAM_STR);
    $stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
    $stmt -> bindParam(":purchase_p", $datos["purchase_p"], PDO::PARAM_STR);
    $stmt -> bindParam(":sale_p", $datos["sale_p"], PDO::PARAM_STR);

    if($stmt->execute()){
        return true;
    }else{
        return false;
        }
    }  

    /* Borrar Productos */
    static public function mdDeleteProduct($datos){
        $stmt = DbConnect::connect()->prepare('DELETE FROM products WHERE id_p = :id_p');
        $stmt->bindParam(':id_p', $datos, PDO::PARAM_INT);
         if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

