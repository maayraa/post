<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Adminsitrar Productos
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i>Inicio</a></li>
            <li class="active">Administrar Productos</li>
        </ol>
    </section>

    
    <section class="content">

      
      <div class="box">
        <div class="box-header with-border">
            <button class="btn btn-primary" data-toggle="modal" data-target=" #ModalAgregarProducto" style="color: white; background: #16A085">
                Agregar Producto
            </button>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive dtable" width="100%">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Imagen</th>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Categoria</th>
                        <th>Stock</th>
                        <th>Precio de compra</th>
                        <th>Precio de venta</th>
                        <th>Agregado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $item = null;
                        $valor = null;
                        $products = ProductsController::ctrViewProducts($item, $valor);
                        foreach($products as $key => $valor){
                            echo ' <tr>
                                <td>'.($key+1).'</td>
                                <td><img src="views/img/products/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                                <td>'.$valor["code"].'</td>
                                <td>'.$valor["description"].'</td>';

                                $item = "id";
                                $value = $valor["id"];

                                $categories = CategoriesController::ctrViewCategory($item, $value);

                                echo '<td>'.$categories["category"].'</td>
                                <td>'.$valor["stock"].'</td>
                                <td>$ '.$valor["purchase_p"].'</td>
                                <td>$ '.$valor["sale_p"].'</td>
                                <td>'.$valor["date"].'</td>
                                <td>
                                
                                <div class="btn-group">
                                    <button class="btn btn-warning btnEditarUsuario" " data-toggle="modal" data-target="#ModalEditUser"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger btnDeleteUser" ><i class="fa fa-times"></i></button>
                                </div>
                                </td>
                            </tr>';
                        }
                    ?>

                </tbody>

            </table>

        </div>

      </div>

    </section>
    
</div>

<!-- Modal Agregar Producto -->
<div id="ModalAgregarProducto" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form rol="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background-color: #3c8dbc; color: white ">
                    <button type="button" class="close" data-dismiss="modal" >&times;</button>
                    <h4 class="modal-title">Agregar Producto</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-code"></i></span>
                            <input type="text" name="nuevoCodigo" class="form-control input-lg" placeholder="Introducir Codigo" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                            <input type="text" name="nuevaDescripcion" class="form-control input-lg" placeholder="Introducir Descripcion" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
                            <select name="nuevaCategoria" class="form-control input-lg">
                                <option value="">Seleccionar Categoria</option>
                                <option value="Taladros">Taladros</option>
                                <option value="Andamios">Andamios</option>
                                <option value="Equipos para construccion">Equipos para Construccion</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-check"></i></span>
                            <input type="number" name="nuevoStock" class="form-control input-lg"  min="0" placeholder="Cantidad disponible" required>
                        </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                            <input type="number" name="nuevoPrecioCompra" class="form-control input-lg"  min="0" placeholder="Precio de Compra" required>
                        </div>
                    </div>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                <input type="number" name="nuevoPrecioVenta" class="form-control input-lg" min="0" placeholder="Precio de venta" required>
                            </div>
                            <br>
                            Checkbox para Porcentaje
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" class="minimal pocentaje" checked>
                                        Utilizar Porcentaje
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-6" style="padding:0">
                                <div class="input-group">
                                    <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="panel">Subir imagen </div>
                            <input type="file" class="nuevaImagen" name="nuevaImagen" id="nuevaImagen">
                            <p class="help-block">Peso maximo de la imagen 2MB</p>
                            <img src="views/img/products/default/anonymous.png" class="img-thumbnail" width="70px" alt="Foto" style="background:slategrey">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary"> Guardar Producto</button>
                </div>
            </form>
        </div>
    </div>
</div>

