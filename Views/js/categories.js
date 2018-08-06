
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