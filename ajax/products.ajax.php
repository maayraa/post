<?php

require_once "../controllers/ProductsController.php";
require_once "../models/products.php";

require_once "../controllers/CategoriesController.php";
require_once "../models/categories.php";

class AjaxProducts{
    
  /* Generar codigo a partir de Id categoria*/
  public $idCategory;
  public function ajaxCreateProductCode(){
    $item = "id";
    $value = $this->idCategory;
    $respuesta = ProductsController::ctrViewProducts($item, $valor);
    echo json_encode($respuesta);

  }
}

/* Generar codigo a partir de ID categoria*/
if(isset($_POST["idCategory"])){
  $productCode = new AjaxProducts();
  $productCode -> idCategory = $_POST["idCategory"];
  $productCode -> ajaxCreateProductCode();

}


