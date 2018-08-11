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
function loadImages(){
    var imgTabla= $(".imgTabla");
    for(var i =0; i < imgTabla.length; i++){
        var data = table.row($(imgTabla[i]).parents("tr")).data();
        $(imgTabla[i]).attr("src", data[1]);
    }
}
 /* Cargamos imagenes cundo entramos a la pagina por primera vez*/
setTimeout(function(){
    loadImages();
/* Cargamos imagenes cundo interactuamos con el paginador */

}, 300)

$(".dataTables_paginate").click(function(){
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
