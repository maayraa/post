/* Cargando tabla dinamica*/
var table = $(".tablaProductos").DataTable({
    "ajax":"ajax/products.ajax.php",
    "columnDefs": [
        {
            "targets": -9,
            "data": null,
            "defaultContent": '<img class="img-thumbnail imgTabla" width="40px">'

        },

        {
            "targets": -1,
            "data": null,
            "defaultContent": '<div class="btn-group"><button class="btn btn-warning btnEditProduct"idProduct><i class="fa fa-pencil"></i></button><button class="btn btn-danger btnDeleteProduct"idProduct><i class="fa fa-times"></i></button></div>'

        }

    ]
})

/* Activar los botones con los ID correspondientes*/

$('.tablaProductos tbody').on( 'click', 'button', function () {
    var data = table.row( $(this).parents('tr') ).data();
    $(this).attr("idProduct", data[9])
   
} );

/* Funcion para cargar las imagenes*/
setTimeout(function(){
    var imgTabla= $(".imgTabla");
    for(var i =0; i < imgTabla.length; i++){
        var data = table.row($(imgTabla[i]).parents("tr")).data();
        $(imgTabla[i]).attr("src", data[1]);
    }

}, 300)