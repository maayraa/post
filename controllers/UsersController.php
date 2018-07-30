<?php

    class UsersController
    {

        static public function ctrlLoginUser()
        {
            if (isset($_POST['ingUsuario'])) {
                if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingUsuario']) &&
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])) {
                    $encrypt = crypt($_POST['ingPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    $item = 'user';
                    $value = $_POST['ingUsuario'];
                    $respuesta = Users::findUser($item, $value);
                    if ($respuesta['pass'] == $_POST['ingPassword']) {
                        $_SESSION['iniciarSesion'] = 'ok';
                        $_SESSION['id'] = $respuesta['id'];
                        $_SESSION['nombre'] = $respuesta['name'];
                        $_SESSION['user'] = $respuesta['user'];
                        $_SESSION['avatar'] = $respuesta['avatar'];
                        $_SESSION['profile'] = $respuesta['profile'];
                        echo '<script> window.location = "home"; </script>';
                    } else {
                        echo '<br><div class="alert alert-danger">Error al ingresar, intente de nuevo</div>';
                    }
                }
            }
        }

        /** 
         * CREAR USUARIO
        */
        public function ctrCreateUser()
        {
    
            if (isset($_POST['nuevoUsuario'])) {
    
                if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoNombre']) &&
                        preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoUsuario']) &&
                        preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoPassword'])) {

                    $route = '';

                    /* Validar imagen */
                    if(isset($_FILES["nuevaFoto"]["tmp_name"])){
                        list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
                        $nuevoAncho = 500;
                        $nuevoAlto = 500;
                            
                        /* Creamos el directorio donde vamos a guardar la foto del usuario*/
                        $directorio = "views/img/users/".$_POST["nuevoUsuario"];
                        mkdir($directorio, 0755);

                        /* de acuerdo al tipo de imagen aplicamos las funciones por defecto de php*/
                        if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){
                        
                            /* Guardamos la imagen en el directorio*/
                            $random = mt_rand(100, 999);
                            $route = "views/img/users/".$_POST["nuevoUsuario"]."/".$random.".jpg";
                            $origin = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
                            $destination = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destination, $origin, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagejpeg($destination, $route);
                        }

                        if($_FILES["nuevaFoto"]["type"] == "image/png"){
                        
                            /* Guardamos la imagen en el directorio*/
                            $random = mt_rand(100, 999);
                            $route = "views/img/users/".$_POST["nuevoUsuario"]."/".$random.".png";
                            $origin = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
                            $destination = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destination, $origin, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagepng($destination, $route);
                        }
                    }
                    $encrypt = crypt($_POST['nuevoPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        
                    $datos = [
                        'nombre' => $_POST['nuevoNombre'],
                        'usuario' => $_POST['nuevoUsuario'],
                        'password' => $encrypt,
                        'perfil' => $_POST['nuevoPerfil'],
                        'ruta' => $route
                    ];
                    $respuesta = Users::addUser($datos);
                    if ($respuesta) {
                        echo '<script>
                            swal({
                                type: "success",
                                title: "¡El usuario ha sido guardado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }).then((result)=> {
                                if (result.value) {
                                    window.location = "users";
                                }
                            });
                        </script>';
                    } else {
                        echo '<script>
                            swal({
                                type: "error",
                                title: "¡El usuario no se pudo guardar!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }).then((result)=> {
                                if (result.value) {
                                    window.location = "users";
                                }
                            });
                        </script>';
                    }

                } else {
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then((result)=> {
                            if (result.value) {
                                window.location = "users";
                            }
                        });
                    </script>';
                }
            }
        }

        /* Mostrar Usuario */
        public function ctrUsersView($item, $value){
            // $item = 'user';
            $respuesta = Users::findUser($item, $value);
            return $respuesta;
        }
        
        public function ctrEditUser()
        {
            if(isset($_POST['editarUsuario'])){
                if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarNombre'])) {
                    $route = $_POST['fotoActual'];
                    if (isset($_FILES['editarFoto']['tmp_name']) && !empty($_FILES['editarFoto']['tmp_name'])) {
                        list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
                        $nuevoAncho = 500;
                        $nuevoAlto = 500;
                            
                        /* Creamos el directorio donde vamos a guardar la foto del usuario*/
                        $directorio = "views/img/users/".$_POST["editarUsuario"];
                        mkdir($directorio, 0755);

                        /* de acuerdo al tipo de imagen aplicamos las funciones por defecto de php*/
                        if($_FILES["editarFoto"]["type"] == "image/jpeg"){
                        
                            /* Guardamos la imagen en el directorio*/
                            $random = mt_rand(100, 999);
                            $route = "views/img/users/".$_POST["editarUsuario"]."/".$random.".jpg";
                            $origin = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
                            $destination = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destination, $origin, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagejpeg($destination, $route);
                        }

                        if($_FILES["editarFoto"]["type"] == "image/png"){
                        
                            /* Guardamos la imagen en el directorio*/
                            $random = mt_rand(100, 999);
                            $route = "views/img/users/".$_POST["editarUsuario"]."/".$random.".png";
                            $origin = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
                            $destination = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destination, $origin, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagejpeg($destination, $route);
                        }
                    }

                    if ($_POST['editarPassword'] != '') {
                        if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['editarPassword'])) {
                            $encrypt = crypt($_POST['editarPassword'], '$2a$07$usesomesillystringforsalt$');
                        } else {
                            echo '<script>
                                    swal({
                                        type: "error",
                                        title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false
                                    }).then((result)=> {
                                        if (result.value) {
                                            window.location = "users";
                                        }
                                    });
                                </script>';
                        }
                    } else {
                        $encrypt = $_POST['passwordActual'];
                    }

                    $datos = [
                        'name' => $_POST['editarNombre'],
                        'user' => $_POST['editarUsuario'],
                        'password' => $encrypt,
                        'profile' => $_POST['editarPerfil'],
                        'ruta' => $route
                    ];

                    $respuesta = Users::editUser($datos);

                    if ($respuesta) {
                        echo '<script>
                            swal({
                                type: "success",
                                title: "¡El usuario ha sido guardado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }).then((result)=> {
                                if (result.value) {
                                    window.location = "users";
                                }
                            });
                        </script>';
                    } else {
                        echo '<script>
                                swal({
                                    type: "error",
                                    title: "¡El usuario no se pudo guardar!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                }).then((result)=> {
                                    if (result.value) {
                                        window.location = "users";
                                    }
                                });
                            </script>';
                    }
                } else {
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then((result)=> {
                            if (result.value) {
                                window.location = "users";
                            }
                        });
                    </script>';
                }
            }
        }
}



    