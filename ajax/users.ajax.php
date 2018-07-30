<?php
require_once "../controllers/UsersController.php";
require_once "../models/Users.php";
class AjaxUsers{
    /* Editar Usuario */
    public $idUsuario;
    public function ajaxEditUser(){
        $item = "id_user";
        $valor = $this->idUsuario;
        $repuesta = UsersController::ctrUsersView($item, $valor);
        echo json_encode($repuesta);
        // echo '<script>console.log("hola")</script>';
    }
}

if(isset($_POST['idUsuario'])){
    $edit = new AjaxUsers();
    $edit -> idUsuario = $_POST['idUsuario'];
    $edit -> ajaxEditUser();
}