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
                        $_SESSION['nombre'] = $respuesta['nombre'];
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
        static public function ctrCreateUser()
        {
    
            if (isset($_POST['nuevoUsuario'])) {
    
                if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoNombre']) &&
                        preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoUsuario']) &&
                        preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoPassword'])) {

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
                        
            
            $route='';

            $encrypt = crypt($_POST['nuevoPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        
            $datos = [
                'nombre' => $_POST['nuevoNombre'],
                'usuario' => $_POST['nuevoUsuario'],
                'password' => $encrypt,
                'perfil' => $_POST['nuevoPerfil']
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
                        }

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
            static public function ctrUsersView($item, $value){
                $item = 'user';
                $respuesta = Users::findUser($item, $value);
                return $respuesta;
            }
    }
    