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
      $respuesta = ProductsController::ctrViewProducts($item, $value);
      echo json_encode($respuesta);
  
    }
  
    /* Editar Producto*/
    public $idProduct;
    public function ajaxEditProduct(){
      $item ="id_p";
      $value = $this-> idProduct;
      $respuesta = ProductsController::ctrViewProducts($item, $value);
      echo json_encode($respuesta);
    }
  
  }
  
  /* Generar codigo a partir de ID categoria*/
  if(isset($_POST["idCategory"])){
    $productCode = new AjaxProducts();
    $productCode->idCategory = $_POST["idCategory"];
    $productCode->ajaxCreateProductCode();
  
  }
  
  /* editar producto*/
  if(isset($_POST["idProduct"])){
    $productCode = new AjaxProducts();
    $productCode->idProduct = $_POST["idProduct"];
    $productCode->ajaxEditProduct();
  }
