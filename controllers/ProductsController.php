<?php 
class ProductsController{
    /* Mostrar Productos*/
    public function ctrViewProducts($item, $value){
        $respuesta = Products::mdViewProducts($item, $value);
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
               
                $datos = array("id" => $_POST["nuevaCategoria"],
                               "code" => $_POST["nuevoCodigo"],
                               "description" => $_POST["nuevaDescripcion"],
                               "stock" => $_POST["nuevoStock"],
                               "purchase_p" => $_POST["nuevoPrecioCompra"],
                               "sale_p" => $_POST["nuevoPrecioVenta"],
                               "image" => $ruta);

            $respuesta = Products::mdEnterProduct($datos);
             if($respuesta){
                echo '<script>
                swal({
                    type: "success",
                    title: "El producto se ha agregado correctamente",
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

     /* Editar Producto*/
     static public function ctrEditProduct(){
        if(isset($_POST["editarDescripcion"])){
            if(preg_match("/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/", $_POST["editarDescripcion"])&&
                preg_match("/^[0-9]+$/", $_POST["editarStock"])&&
                preg_match("/^[0-9]+$/", $_POST["editarPrecioCompra"])&&
                preg_match("/^[0-9]+$/", $_POST["editarPrecioVenta"])){

                    /* Validar Imagen */
                $ruta = $_POST["imagenActual"];
                if(isset($_FILES["editarImagen"]["tmp_name"])){
                    list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;
                        
                    /* Creamos el directorio donde vamos a guardar la foto del usuario*/
                    $directorio = "views/img/products/".$_POST["editarCodigo"];
                   
                    /* Preguntamos si esxiste una imagen en la BD*/
                   if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "views/img/products/default/anonymous.png"){
                       unlink($_POST["imagenActual"]);
                   }else{
                       mkdir($directorio, 0755);
                   }

                    /* de acuerdo al tipo de imagen aplicamos las funciones por defecto de php*/
                    if($_FILES["editarImagen"]["type"] == "image/jpeg"){
                    
                        /* Guardamos la imagen en el directorio*/
                        $random = mt_rand(100, 999);
                        $ruta = "views/img/products/".$_POST["editarCodigo"]."/".$random.".jpg";
                        $origin = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);
                        $destination = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destination, $origin, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destination, $ruta);
                    }

                    if($_FILES["editarImagen"]["type"] == "image/png"){
                    
                        /* Guardamos la imagen en el directorio*/
                        $random = mt_rand(100, 999);
                        $ruta = "views/img/products/".$_POST["editarCodigo"]."/".$random.".png";
                        $origin = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);
                        $destination = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destination, $origin, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destination, $ruta);
                    }
                }

                $datos = array("id" => $_POST["editarCategoria"],
                               "code" => $_POST["editarCodigo"],
                               "description" => $_POST["editarDescripcion"],
                               "stock" => $_POST["editarStock"],
                               "purchase_p" => $_POST["editarPrecioCompra"],
                               "sale_p" => $_POST["editarPrecioVenta"],
                               "image" => $ruta);

            $respuesta = Products::mdEditProduct($datos);
             if($respuesta){
                echo '<script>
                swal({
                    type: "success",
                    title: "El producto se ha editado correctamente",
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
   
    /* Borrar el producto */
    public function ctrDeleteProduct()
    {
			if (isset($_GET['idProduct'])) {
 				$datos = $_GET['idProduct'];
 				if($_GET["image"] != "" && $_GET["image"] != "views/img/products/default/anonymous.png"){
					unlink($_GET["image"]);
					rmdir('views/img/products/'.$_GET["code"]);
				}
				$respuesta = Products::mdDeleteProduct($datos);
				if($respuesta){
					echo'<script>
					swal({
						  type: "success",
						  title: "El producto ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then((result) => {
									if (result.value) {
	
									window.location = "products";
	
									}
								})
	
					</script>';
	
				}
			}
    }
}
