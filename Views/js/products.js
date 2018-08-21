/* Cargar la tabla dinamica */

var table = $('.tablaProductos').DataTable({
    "ajax": "ajax/datatable-products.ajax.php",
    "columnDefs": [
        {
            "targets": -9,
            "data": null,
            "defaultContent": '<img class="img-thumbnail imgTabla" width="40px">'

        },
        {
            "targets": -1,
            "data": null,
            "defaultContent": '<button class="btn btn-warning btnEditProduct" idProduct="" data-toggle="modal" data-target="#ModalEditarProducto"><i class="fa fa-pencil"></i></button><button class="btn btn-danger btnDeleteProduct" idProduct code image><i class="fa fa-times"></i></button>'

        }
    
    ],
    "language": {
 
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }
})

/* Activar botones con los id correspondientes*/

$('.tablaProductos tbody').on( 'click', 'button', function () {
    var data = table.row( $(this).parents('tr') ).data();
    $(this).attr("idProduct", data[9]);
    $(this).attr('code', data[2])
    $(this).attr('image', data[1])
})

/* Funcion para cargar las imagenes*/
function loadImages(){
    var imgTabla= $(".imgTabla");
    for(let i =0; i < imgTabla.length; i++){
        var data = table.row($(imgTabla[i]).parents("tr")).data();
        $(imgTabla[i]).attr('src', data[1])
        
    }
}

/* Cargamos imagenes cundo entramos a la pagina por primera vez*/
setTimeout(function(){
    loadImages();
}, 300);


$(".dataTables_paginate").click(()=>{
    loadImages();
})

/* Cargamos imagenes cundo interactuamos con el buscador */
$("input[aria-controls='DataTables_Table_0']").focus(function(){
    $(document).keyup(function(event){
        event.preventDefault();
        loadImages();
    })
})

/* Cargamos imagenes cundo interactuamos con el filtro de cantidad */
$("select[name='DataTables_Table_0_length']").change(function(){
    loadImages();
})

/* Cargamos imagenes cundo interactuamos con el filtro de ordenar */
$(".sorting").click(function(){
    loadImages();
})

/* Capturando categoria para mostrar codigo */
$("#nuevaCategoria").change(function(){
    var idCategory = $(this).val();
    var datos = new FormData();
    datos.append("idCategory", idCategory);
    $.ajax({
        url:"ajax/products.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            if(!respuesta){
                var nuevoCodigo = idCategory+"01";
                $("#nuevoCodigo").val(nuevoCodigo);
            }else{
                let nuevoCodigo = Number(respuesta["code"]) + 1;
                console.log("nuevoCodigo", nuevoCodigo);
                $("#nuevoCodigo").val(nuevoCodigo);
            }
        }

    })
})

/* Agregando precio de venta */
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){
    if($(".porcentaje").prop("checked")){
        var valorPorcentaje =$(".nuevoPorcentaje").val();
        var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());
        var editarporcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());
        $("#nuevoPrecioVenta").val(porcentaje);
        $("#nuevoPrecioVenta").prop("readonly", true);
        $("#editarPrecioVenta").val(editarporcentaje);
        $("#editarPrecioVenta").prop("readonly", true);
    }
})

/* Cambio de porcentaje */
$(".nuevoPorcentaje").change(function(){
    if($(".porcentaje").prop("checked")){
        var valorPorcentaje = $(this).val();
        var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());
        var editarporcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());
        $("#nuevoPrecioVenta").val(porcentaje);
        $("#nuevoPrecioVenta").prop("readonly", true);
        $("#editarPrecioVenta").val(editarporcentaje);
        $("#editarPrecioVenta").prop("readonly", true);
    }
})

$(".porcentaje").on("ifUnchecked",function(){

    $("#nuevoPrecioVenta").prop("readonly", false);
    $("#editarPrecioVenta").prop("readonly", false);
})

$(".porcentaje").on("ifChecked",function(){

    $("#nuevoPrecioVenta").prop("readonly",true);
    $("#editarPrecioVenta").prop("readonly",true);
})

/*Subiendo la foto del Producto */

$(".nuevaImagen").change(function(){
    var image = this.files[0];
    console.log("image", image)
    /* validando el formato de la imagen jpg*/

    if(image["type"] != "image/jpeg" && image["type"] != "image/png" ){
        $(".nuevaImagen").val("");
        $('.previsualizar').attr('src', 'views/img/products/default/anonymous.png')
            swal({
                title:"Error al subir la imagen",
                text:"La imagen debe ser en formato JPG o PNG",
                type: "error",
                confirmButtonText: "¡Cerrar!"
            });
            /* validando el tamaño de la imagen*/
        } else if (imagen['size'] > 5000000) {
             $('.nuevaImagen').val('');
             $('.previsualizar').attr('src', 'views/img/products/default/anonymous.png')
             swal({
                type: 'error',
                title: "Error al subir la imagen",
                text: "¡La imagen no debe pesar mas de 200MB!",
                confirmButtonText: '¡Cerrar!'
            });
        }else{
            var datosImagen = new FileReader;
            datosImagen.readAsDataURL(image);
            $(datosImagen).on("load", function(event){
                var routeImage = event.target.result;
                $(".previsualizar").attr("src", routeImage);

            })
        }
})

/* Editar Producto */
$(".tablaProductos tbody").on("click", "button.btnEditProduct", function(){
    let idProduct = $(this).attr("idProduct");
    let datos = new FormData();
    datos.append("idProduct", idProduct);

    $.ajax({
        url:"ajax/products.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            let datosCategoria = new FormData();
            datosCategoria.append("idCategory", respuesta["id"]);
            $.ajax({
                url:"ajax/categories.ajax.php",
                method: "POST",
                data: datosCategoria,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success:function(respuesta){
                    $("#editarCategoria").val(respuesta["id"]);
                    $("#editarCategoria").html(respuesta["category"]);
                }
            })
             $("#editarCodigo").val(respuesta["code"]);
             $("#editarDescripcion").val(respuesta["description"]);
             $("#editarStock").val(respuesta["stock"]);
             $("#editarPrecioCompra").val(respuesta["purchase_p"]);
             $("#editarPrecioVenta").val(respuesta["sale_p"]);
             if(respuesta["image"] != ""){
             $("#imagenActual").val(respuesta["image"]);
             $(".previsualizar").attr("src", respuesta["image"]);
             }
        }
    })
})

/* Eliminar los Productos*/
$('.tablaProductos tbody').on('click', 'button.btnDeleteProduct', function() {
	let idProduct = $(this).attr('idProduct')
	let code = $(this).attr('code')
	let image = $(this).attr('image')
	
	swal({
        title: '¿Estas seguro de borrar el usuario?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
    }).then((result) => {
        if (result.value) {
            window.location = 'index.php?ruta=products&idProduct='+idProduct+'&code='+code+'&image='+image
        }
    })
}) 