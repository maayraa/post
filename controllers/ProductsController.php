<?php 
class ProductsController{
    /* Mostrar Productos*/
    static public function ctrViewProducts($item, $value){
        $table = "products";
        $respuesta = Products::mdViewProducts($table, $item, $value);
        return $respuesta;
    }

}