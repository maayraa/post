/* Cargando tabla dinamica*/
var table = $(".tablaProductos").DataTable({
    "ajax":"ajax/datatable-products.ajax.php",
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
    ],
    "language": {
        // jquery.dataTables.js cambio de lenguage #11340
        "paginate": {
            "next": "Siguiente",
            "previous": "Anterior"
        },
        // jquery.dataTables.js cambio de lenguage #11418
        "info": "Ver de _START_ - _END_ de _TOTAL_ entradas",
        // jquery.dataTables.js cambio de lenguage #11434
        "infoEmpty": "Ver 0 - 0 de 0 entradas",
        // jquery.dataTables.js cambio de lenguage #11579
        "lengthMenu": 'Mostrar <select>'+
                    '<option value="2">2</option>'+
                    '<option value="10">10</option>'+
                    '<option value="20">20</option>'+
                    '<option value="-1">Todo</option>'+
                    '</select> entradas',
        // jquery.dataTables.js cambio de lenguage #11659
        "search": "Buscar:",
        // jquery.dataTables.js cambio de lenguage #11381
        "emptyTable": "No hay datos disponibles en la tabla",
        // jquery.dataables.js cambio de lenguage #11461
        "infoFiltered": "(Filtrado de _MAX_ entradas totales)",
        // jquery.dataables.js cambio de lenguage #11717
        "zeroRecords": "No se encontraron registros"
    },
    responsive: true

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
                var nuevoCodigo = idCategory + "01";
                $("#nuevoCodigo").val(nuevoCodigo);
                console.log("respuesta", respuesta);
            }else{
                var nuevoCodigo = Number($respuesta["code"]) + 1;
                $("#nuevoCodigo").val(nuevoCodigo);
            }
        }

    })
})
