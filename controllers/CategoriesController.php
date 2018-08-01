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
}