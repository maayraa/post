<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Adminsitrar Usuarios
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i>Inicio</a></li>
            <li class="active">Administrar usuarios</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
            <button class="btn btn-primary" data-toggle="modal" data-target=" #ModalAgregarUsuario" style="color: white; background: #16A085">
                Agregar Usuario
            </button>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive dtable" width="100%">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Foto</th>
                        <th>Perfil</th>
                        <th>Estado</th>
                        <th>Ultimo login</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $item = null;
                    $value = null;
                    $respuesta = new UsersController();
                    $users = $respuesta->ctrUsersView($item, $value);
                    // var_dump($users);  
                    foreach ($users as $key => $value){
                       echo '<tr>
                       <td>'.$value['id_user'].'</td>
                       <td>'.$value['name'].'</td>
                       <td>'.$value['user'].'</td>';
                       
                       if ($value['avatar'] != '') {
                           echo '<td><img src="'.$value['avatar'].'"class="img-thumbnail" width="40px"></td>"';
                       }else{
                        echo '<td><img src="views/img/users/default/anonymous.png" width="40px"></td>';

                       }

                       echo '<td>'.$value['profile'].'</td>
                       <td><button class="btn btn-success btn-xs">Activado</button></td>
                       <td>'.$value['lt_login'].'</td>
                       <td>
                           <div class="btn-group">
                               <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value['id_user'] .'" data-toggle="modal" data-target="#ModalEditUser"><i class="fa fa-pencil"></i></button>
                               <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                           </div>
                       </td>
                   </tr>';
                    }
                    ?>
                    
                    
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
</div>

<!-- Modal -->
<div id="ModalAgregarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
        <!-- Modal content-->
        <div class="modal-content">
            <form rol="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background-color: #3c8dbc; color: white ">
                    <button type="button" class="close" data-dismiss="modal" >&times;</button>
                    <h4 class="modal-title">Agregar Usuario</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body"></div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="nuevoNombre" class="form-control input-lg" placeholder="Introducir Nombre" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="text" name="nuevoUsuario" class="form-control input-lg" placeholder="Introducir Usuario" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="text" name="nuevoPassword" class="form-control input-lg" placeholder="Introducir Contraseña" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            <select name="nuevoPerfil" class="form-control input-lg">
                                <option value="">Seleccionar Perfil</option>
                                <option value="1">Administrador</option>
                                <option value="2">Especial</option>
                                <option value="3">Vendedor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="panel">Subir foto </div>
                            <input type="file" class="nuevaFoto" name="nuevaFoto" id="nuevaFoto">
                            <p class="help-block">Peso maximo de la imagen 2MB</p>
                            <img src="views/img/users/default/anonymous.png" class="img-thumbnail previsualizar" width="70px" alt="Foto" style="background:slategrey">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary"> Guardar Usuario</button>
                </div>
                <?php
                    $createUser = new UsersController();
                    $createUser->ctrCreateUser();
                ?>
            </form>
        </div>
    </div>
</div>

<!--modal Editar Usuario -->

<div id="ModalEditUser" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
        <!-- Modal content-->
        <div class="modal-content">
            <form rol="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background-color: #3c8dbc; color: white ">
                    <button type="button" class="close" data-dismiss="modal" >&times;</button>
                    <h4 class="modal-title">Editar Usuario</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body"></div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="editarNombre" id="editarNombre" class="form-control input-lg">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="text" name="editarUsuario" id="editarUsuario" class="form-control input-lg" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="text" name="editarPassword" class="form-control input-lg" placeholder="Introducir la nueva Contraseña">
                            <input type="hidden" id="editarPassword" name="passwordActual" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            <select name="editarPerfil" class="form-control input-lg">
                                <option value="" id="editarPerfil"></option>
                                <option value="1">Administrador</option>
                                <option value="2">Especial</option>
                                <option value="3">Vendedor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="panel">Subir foto </div>
                            <input type="file" class="" name="editarFoto" id="nuevaFoto">
                            <p class="help-block">Peso maximo de la imagen 2MB</p>
                            <img src="views/img/users/default/anonymous.png" class="img-thumbnail previsualizar" width="70px" alt="Foto" style="background:slategrey">
                            <input type="hidden" name="fotoActual">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary"> Actualizar Usuario</button>
                </div>
                <?php
                     $editUser = new UsersController();
                     $editUser->ctrEditUser();
                ?> 
               
            </form>
        </div>
    </div>
</div>