<?php

require_once "../controllers/ProductsController.php";
require_once "../models/products.php";

class ProductsTable{
    /* Mostrar tabla producto */
    public function mdViewTable(){
        $item = null;
        $value = null;

        $products = ProductsController::ctrViewProducts($item, $value);
        echo '{
            "data": [
              [
                "1",
                "views/img/products/default/anonymous.png",
                "101",
                "Aspiradora Industrial ",
                "EQUIPOS ELECTROMECANICOS",
                "20",
                "$5.00 ",
                "$10.00",
                "2018-08-10 19:41:39",
                "1"
              ],
              [
                "1",
                "views/img/products/default/anonymous.png",
                "101",
                "Aspiradora Industrial ",
                "EQUIPOS ELECTROMECANICOS",
                "20",
                "$5.00 ",
                "$10.00",
                "2018-08-10 19:41:39",
                "2"
              ]
            ]
          }';
    }
}

/* Activar tabla de productso*/
$activar = new ProductsTable();
$activar -> mdViewTable();


