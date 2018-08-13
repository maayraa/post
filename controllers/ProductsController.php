<?php 
class ProductsController{
    /* Mostrar Productos*/
    static public function ctrViewProducts($item, $value){
        $table = "products";
        $respuesta = Products::mdViewProducts($table, $item, $value);
        return $respuesta;
    }

    /* Crear Producto*/
    static public function ctrCreateProduct(){
        if(isset($_POST["nuevaDescripcion"])){
            if(preg_match("/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/", $_POST["nuevaDescripcion"])&&
                preg_match("/^[0-9]+$/", $_POST["nuevoStock"])&&
                preg_match("/^[0-9]+$/", $_POST["nuevoPrecioCompra"])&&
                preg_match("/^[0-9]+$/", $_POST["nuevoPrecioVenta"])){

                $ruta = "views/img/products/default/anonymous.png";
                $table = "products";
                $datos = array("id" => $_POST["nuevaCategoria"],
                               "code" => $_POST["nuevoCodigo"],
                               "description" => $_POST["nuevaDescripcion"],
                               "stock" => $_POST["nuevoStock"],
                               "purchase_p" => $_POST["nuevoPrecioCompra"],
                               "sale_p" => $_POST["nuevoPrecioVenta"],
                               "image" => $ruta);

            $respuesta = Products::mdEnterProduct($table, $datos);
             if($respuesta == "ok"){
                echo '<script>
                swal({
                    type: "success",
                    title: "El producto no puede estar vacio o llevar caracteres especiales",
                    showConfirmButton: true,
                    confirmButtonText: "cerrar"
                    }).then((result) => {
                        if(result.value) {
                            window.location = "products";
                        }
                    })
                </script>';
             }

            }else{
                echo '<script>
                    swal({
                        type: "error",
                        title: "El producto no puede estar vacio o llevar caracteres especiales",
                        showConfirmButton: true,
                        confirmButtonText: "cerrar"
                        }).then((result) => {
                            if(result.value) {
                                window.location = "products";
                            }
                        })
                    </script>';
            }

        }
    }
}
