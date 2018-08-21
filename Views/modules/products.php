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
            <button class="btn btn-primary" data-toggle="modal" data-target=" #ModalAgregarProducto" >
                Agregar Producto
            </button>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive tablaProductos"  width="100%">
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
                
            </table>

        </div>

      </div>

    </section>
    
</div>

<!-- Modal Agregar Producto -->
<div id="ModalAgregarProducto" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background-color: #3c8dbc; color: white ">
                    <button type="button" class="close" data-dismiss="modal" >&times;</button>
                    <h4 class="modal-title">Agregar Producto</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
                            <select class="form-control input-lg" name="nuevaCategoria" id="nuevaCategoria"  required>
                                <option value="">Seleccionar Categoria</option>
                                <?php
                                $item = null;
                                $value = null;
                                $cat = new CategoriesController();
                                $categories = $cat->ctrViewCategory($item, $value);
                                    foreach ($categories as $key => $value) {
                                        echo '<option value="'.$value["id"].'">'.$value["category"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-code"></i></span>
                            <input type="text" name="nuevoCodigo" id="nuevoCodigo" class="form-control input-lg" placeholder="Introducir Codigo" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                            <input type="text"  class="form-control input-lg" name="nuevaDescripcion" placeholder="Introducir Descripcion" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-check"></i></span>
                            <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Cantidad disponible" required>
                        </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                            <input type="number" class="form-control input-lg" name="nuevoPrecioCompra" id="nuevoPrecioCompra"   min="0" placeholder="Precio de Compra" required>
                        </div>
                    </div>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                <input type="number" class="form-control input-lg" name="nuevoPrecioVenta" id="nuevoPrecioVenta"  min="0" placeholder="Precio de venta" required>
                            </div>
                            <br>
                            Checkbox para Porcentaje
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" class="minimal porcentaje" checked>
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
                            <input type="file" class="nuevaImagen" name="nuevaImagen">
                            <p class="help-block">Peso maximo de la imagen 2MB</p>
                            <img src="views/img/products/default/anonymous.png" class="img-thumbnail previsualizar" width="70px">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary"> Guardar Producto</button>
                </div>
            </form>
            <?php
                $CreateProduct = new ProductsController();
                $CreateProduct -> ctrCreateProduct();
            ?>

        </div>
    </div>
</div>

<!-- Modal Editar Producto -->
<div id="ModalEditarProducto" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" style="background-color: #3c8dbc; color: white ">
                    <button type="button" class="close" data-dismiss="modal" >&times;</button>
                    <h4 class="modal-title">Editar Producto</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
                            <select class="form-control input-lg" name="editarCategoria"  readonly>
                                <option id="editarCategoria">Seleccionar Categoria</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-code"></i></span>
                            <input type="text" class="form-control input-lg" name="editarCodigo" id="editarCodigo"  readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                            <input type="text"  class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-check"></i></span>
                            <input type="number" class="form-control input-lg" name="editarStock" id="editarStock"   min="0" required>
                        </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                            <input type="number" class="form-control input-lg" name="editarPrecioCompra" id="editarPrecioCompra"   min="0" required>
                        </div>
                    </div>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                <input type="number" class="form-control input-lg" name="editarPrecioVenta" id="editarPrecioVenta"  min="0" required readonly>
                            </div>
                            <br>
                            Checkbox para Porcentaje
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" class="minimal porcentaje" checked>
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
                            <input type="file" class="nuevaImagen" name="editarImagen">
                            <p class="help-block">Peso maximo de la imagen 2MB</p>
                            <img src="views/img/products/default/anonymous.png" class="img-thumbnail previsualizar" width="70px">
                            <input type="hidden" name="imagenActual" id="imagenActual">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary"> Guardar Cambios</button>
                </div>
            </form>
            <?php
                $editProduct = new ProductsController();
                $editProduct -> ctrEditProduct();

            ?>
        </div>
    </div>
</div>
<?php
    $deleteProduct = new ProductsController();
    $deleteProduct->ctrDeleteProduct();
?> 

