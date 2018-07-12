<?php

    class UsersController

    {

        public function ctrlLoginUser(){

            if (isset($_POST['ingUsuario'])) {

                if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingUsuario']) &&

                    preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])) {

                    

                    $item = 'user';

                    $value = $_POST['ingUsuario'];



                    $respuesta = Users::findUser($item, $value);



                    if ($respuesta['pass'] == $_POST['ingPassword']) {

                        $_SESSION['iniciarSesion'] = 'ok';



                        echo '<script> window.location = "home"; </script>';

                    } else {

                        echo '<br><div class="alert alert-danger">Error al ingresar, intente de nuevo</div>';

                    }

                }

            }

        }

    }