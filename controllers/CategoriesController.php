<?php

class CategoriesController{

    /* Crear Categorias  */

    static public function ctrCreateCategory(){
        if(isset($_POST['nuevaCategoria'])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevaCategoria'])){
                $table = "categories";
                $datos = $_POST['nuevaCategoria'];
                $respuesta = Categories::mdIngresarCategoria($table, $datos);
                if($respuesta == "ok" ){
                    echo '<script>
                    swal({
                        type: "success",
                        title: "¡La Categoria ha sido guardada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        }).then((result)=> {
                        if (result.value) {
                        window.location = "categories";
                        }
                        });
                </script>';
                }

            }else{
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡La categoria no puede ir vacia o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                            }).then((result)=> {
                            if (result.value) {
                            window.location = "categories";
                            }
                            });
                    </script>';
            }
        }
    }

    /* Mostrar Categorias */

    static public function ctrViewCategory($item, $value){
        $table = "categories";
        $respuesta = Categories::mdViewCategory($table, $item, $value);
        return $respuesta;

    }

     /* Editar Categorias  */

     static public function ctrEditCategory(){
        if(isset($_POST['editarCategoria'])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarCategoria'])){
                $table = "categories";
                $datos = array("category"=> $_POST['editarCategoria'], "id" => $_POST["idCategory"]);
                $respuesta = Categories::mdEditCategory($table, $datos);
                if($respuesta == "ok" ){
                    echo '<script>
                    swal({
                        type: "success",
                        title: "¡La Categoria ha sido cambiada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        }).then((result)=> {
                        if (result.value) {
                        window.location = "categories";
                        }
                        });
                </script>';
                }

            }else{
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡La categoria no puede ir vacia o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                            }).then((result)=> {
                            if (result.value) {
                            window.location = "categories";
                            }
                            });
                    </script>';
            }
        }
    }

    /* Borrar Categoria */
    static public function ctrDeleteCategory(){
        if(isset($_GET['idCategory'])){
            $table = "categories";
            $datos = $_GET['idCategory'];
            $respuesta = Categories::mdDeleteCategory($table, $datos);
            if($respuesta == 'ok'){
                echo '<script>
                swal({
                    type: "success",
                    title: "¡La categoria se borro correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result)=> {
                    if (result.value) {
                    window.location = "categories";
                    }
                    });
            </script>';

            }
        }
    }
}