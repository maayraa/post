
/* Editar Categoria*/

$(".btnEditarCategoria").click(function(){
    var idCategory = $(this).attr("idCategory");
    var datos = new FormData();
    datos.append("idCategory", idCategory);
    $.ajax({
        url:"ajax/categories.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){
            $("#editarCategoria").val(respuesta["category"]);
            $("#idCategory").val(respuesta["id"]);

           
        }
    })
})

/* Eliminar Categoria */
$(".btnEliminarCategoria").click(function(){
    var idCategory = $(this).attr("idCategory");
    swal({
        title: '¿Estas seguro de borrar esta categoria?',
        text: 'Puede cancelar esta accion',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, deseo borrar esta categoria!!'
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=categories&idCategory="+idCategory;
        }

    })
})

