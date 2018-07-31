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
    /** 
         * ACTIVAR USUARIO
        */
        public $activarUsuario;
        public $activarId;
         public function ajaxActUser()
        {
            $item1 = 'status';
            $value1 = $this->activarUsuario;
             $item2 = 'id_user';
            $value2 = $this->activarId;
            
            $respuesta = Users::ActUser($item1, $value1, $item2, $value2);
        }
}

if(isset($_POST['idUsuario'])){
    $edit = new AjaxUsers();
    $edit -> idUsuario = $_POST['idUsuario'];
    $edit -> ajaxEditUser();
}
/** 
     * ACTIVAR USUARIO
    */
    if (isset($_POST['activarUsuario'])) {
        $activarUsuario = new AjaxUsers();
        $activarUsuario->activarId = $_POST['activarId'];
        $activarUsuario->activarUsuario = $_POST['activarUsuario'];
         $activarUsuario->ajaxActUser();
    }