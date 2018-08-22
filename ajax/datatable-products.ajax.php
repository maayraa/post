<?php

require_once "../controllers/ProductsController.php";
require_once "../models/products.php";
require_once "../controllers/CategoriesController.php";
require_once "../models/categories.php";

class TableProducts{
  /* Mostrar tabla producto */
  public function ViewTable(){
        $item = null;
        $value = null;

        $products = new ProductsController();
        $respuesta = $products->ctrViewProducts($item, $value);
        echo '{
          "data": [';
          for($i = 0; $i < count($respuesta)-1; $i++){
            $item = "id";
            $value = $respuesta[$i]["id"];
            $categories = CategoriesController::ctrViewCategory($item, $value);
    
             echo '[
                "'.($i+1).'",
                "'.$respuesta[$i]['image'].'",
                "'.$respuesta[$i]['code'].'",
                "'.$respuesta[$i]['description'].'",
                "'.$categories['category'].'",
                "'.$respuesta[$i]['stock'].'",
                "$ '.number_format($respuesta[$i]['purchase_p']).'",
                "$ '.number_format($respuesta[$i]['sale_p']).'",
                "'.$respuesta[$i]['date'].'",
                "'.$respuesta[$i]['id_p'].'"
              ],';
    
          }
    
          $item = "id";
          $value = $respuesta[count($respuesta)-1]["id"];
    
          $categories = CategoriesController::ctrViewCategory($item, $value);
    
    
          echo '[
            "'.count($respuesta).'",
            "'.$respuesta[count($respuesta)-1]["image"].'",
            "'.$respuesta[count($respuesta)-1]["code"].'",
            "'.$respuesta[count($respuesta)-1]["description"].'",
            "'.$categories["category"].'",
            "'.$respuesta[count($respuesta)-1]["stock"].'",
            "$ '.number_format($respuesta[count($respuesta)-1]["purchase_p"]).'",
            "$ '.number_format($respuesta[count($respuesta)-1]["sale_p"]).'",
            "'.$respuesta[count($respuesta)-1]["date"].'",
            "'.$respuesta[count($respuesta)-1]["id_p"].'"
          ]
        ]
      }';
    }
}

/* Activar tabla de productso*/
$activar = new TableProducts();
$activar->ViewTable();