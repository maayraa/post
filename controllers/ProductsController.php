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

                    /* Validar Imagen */
                $ruta = "views/img/products/default/anonymous.png";
                if(isset($_FILES["nuevaImagen"]["tmp_name"])){
                    list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;
                        
                    /* Creamos el directorio donde vamos a guardar la foto del usuario*/
                    $directorio = "views/img/products/".$_POST["nuevoCodigo"];
                    mkdir($directorio, 0755);

                    /* de acuerdo al tipo de imagen aplicamos las funciones por defecto de php*/
                    if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){
                    
                        /* Guardamos la imagen en el directorio*/
                        $random = mt_rand(100, 999);
                        $ruta = "views/img/products/".$_POST["nuevoCodigo"]."/".$random.".jpg";
                        $origin = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);
                        $destination = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destination, $origin, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destination, $ruta);
                    }

                    if($_FILES["nuevaImagen"]["type"] == "image/png"){
                    
                        /* Guardamos la imagen en el directorio*/
                        $random = mt_rand(100, 999);
                        $ruta = "views/img/products/".$_POST["nuevoCodigo"]."/".$random.".png";
                        $origin = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);
                        $destination = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destination, $origin, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destination, $ruta);
                    }
                }

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
