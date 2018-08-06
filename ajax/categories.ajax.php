<?php

require_once "../controllers/CategoriesController.php";
require_once "../models/categories.php";

class AjaxCategories{
    /*Editar Categorias */
    public $idCategory;
    public function ajaxEditCategory(){
        $item = "id";
        $value = $this->idCategory;
        $respuesta = CategoriesController::ctrViewCategory($item, $value);
        echo json_encode($respuesta);

    }
}

/* Editar Categoria*/
if(isset($_POST['idCategory'])){
    $category = new AjaxCategories();
    $category -> idCategory = $_POST['idCategory'];
    $category -> ajaxEditCategory();
}
