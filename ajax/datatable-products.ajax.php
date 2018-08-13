<?php

require_once "../controllers/ProductsController.php";
require_once "../models/products.php";

require_once "../controllers/CategoriesController.php";
require_once "../models/categories.php";

class TableProducts{
    /* Mostrar tabla producto */
    public function mdViewTable(){
        $item = null;
        $value = null;

        $products = ProductsController::ctrViewProducts($item, $value);
        echo '{
                "data": [';
               for($i = 0; $i < count($products)-1; $i++){
                 $item = "id";
                 $value = $products[$i]["id"];
                $categories = CategoriesController::ctrViewCategory($item, $value);

                echo '[
                  "'.($i+1).'",
                  "'.$products[$i]["image"].'",
                  "'.$products[$i]["code"].'",
                  "'.$products[$i]["description"].'",
                  "'.$categories["category"].'",
                  "'.$products[$i]["stock"].'",
                  "$ '.number_format($products[$i]["purchase_p"],2).'",
                  "$ '.number_format($products[$i]["sale_p"],2).'",
                  "'.$products[$i]["date"].'",
                  "'.$products[$i]["id_p"].'"
                ],';
               }
              
              echo '[
                    "'.count($products).'",
                    "'.($i+1).'",
                    "'.$products[count($products)-1]["image"].'",
                    "'.$products[count($products)-1]["code"].'",
                    "'.$products[count($products)-1]["description"].'",
                    "'.$categories["category"].'",
                    "'.$products[count($products)-1]["stock"].'",
                    "$ '.number_format($products[count($products)-1]["purchase_p"],2).'",
                    "$ '.number_format($products[count($products)-1]["sale_p"],2).'",
                    "'.$products[count($products)-1]["date"].'",
                    "'.$products[count($products)-1]["id_p"].'"
                  ]
                ]
              }';
    }
  
}

/* Activar tabla de productso*/
$activar = new TableProducts();
$activar -> mdViewTable();


