<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Adminsitrar Categorias
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i>Inicio</a></li>
            <li class="active">Administrar Categorias</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
            <button class="btn btn-primary" data-toggle="modal" data-target=" #ModalAgregarCategoria" style="color: white; background: #16A085">
                Agregar Categoria
            </button>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive dtable" width="100%">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Categoria</th>
                        <th>Acciones</th>  
                    </tr>
                </thead>
                <tbody>

                <?php
                    $item = null;
                    $value = null;
                    $categories = CategoriesController::ctrViewCategory($item, $value);
                    
                    foreach($categories as $key => $value){
                        echo '</tr>
                        <tr>
                            <td>'.($key+1).'</td>
                            <td class="text-uppercase">'.$value["category"].'</td>
                            <td>
                             <div class="btn-group">
                                 <button class="btn btn-warning btnEditarCategoria" idCategory="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>
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

<!-- Modal Agregar Categoria -->
<div id="ModalAgregarCategoria" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
        <!-- Modal content-->
        <div class="modal-content">
            <form rol="form" method="post">
                <div class="modal-header" style="background-color: #3c8dbc; color: white ">
                    <button type="button" class="close" data-dismiss="modal" >&times;</button>
                    <h4 class="modal-title">Agregar Categoria</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body"></div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="nuevaCategoria" class="form-control input-lg" placeholder="Ingresar categoria" required>
                        </div>
                    </div>
                </div>
            </div>
<!-- Pie del modal -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary"> Guardar Categoria</button>
                </div>
                <?php
                    $crearCategoria = new CategoriesController();
                    $crearCategoria-> ctrCreateCategory();
                ?>
               
            </form>
        </div>
    </div>
</div>

 <!-- Modal Editar Categoria -->
<div id="modalEditarCategoria" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
        <!-- Modal content-->
        <div class="modal-content">
            <form rol="form" method="post">
                <div class="modal-header" style="background-color: #3c8dbc; color: white ">
                    <button type="button" class="close" data-dismiss="modal" >&times;</button>
                    <h4 class="modal-title">Editar Categoria</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body"></div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="editarCategoria" id="editarCategoria" class="form-control input-lg" required>
                            <input type="hidden" name="idCategory" id="idCategory" required>
                        </div>
                    </div>
                </div>
            </div>
<!-- Pie del modal -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary"> Guardar Cambios</button>
                </div>
                 <?php
                    $editCategory = new CategoriesController();
                    $editCategory -> ctreditCategory();
                 ?>
               
            </form>
        </div>
    </div>
</div>

 