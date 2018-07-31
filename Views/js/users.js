/*Subiendo la foto del Usuario */

$(".nuevaFoto").change(function(){
    var image = this.files[0];
    console.log(image);
    /* validando el formato de la imagen jpg*/

    if(image["type"] != "image/jpeg" && image["type"] != "image/png" ){
        $(".nuevaFoto").val("");
            swal({
                title:"Error al subir la imagen",
                text:"La imagen debe ser en formato JPG o PNG",
                type: "error",
                confirmButtonText: "¡Cerrar!"
            });

        }else if(image["size"] > 2000000){
            $(".nuevaFoto").val("");
            swal({
                title:"Error al subir la imagen",
                text:"La imagen no debe pesar mas de 2MB",
                type: "error",
                confirmButtonText: "¡Cerrar!"
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

/* Editar Usuario */
$('.btnEditarUsuario').click(function(){
    var idUsuario = $(this).attr("idUsuario");
    console.log("idUsuario", idUsuario);
     var data = new FormData();
     data.append("idUsuario", idUsuario);

     $.ajax({
         url:"ajax/users.ajax.php",
         method: "POST",
         data: data,
         cache:false,
         contentType: false,
         processData: false,
         dataType:"json",
         success:function(respuesta){
             $("#editarNombre").val(respuesta["name"]);
             $("#editarUsuario").val(respuesta["user"]);
             $("#editarPerfil").val(respuesta["profile"]);
             $("#editarPerfil").html(respuesta["profile"]);
             $("#editarPassword").val(respuesta["pass"]);
             $("#fotoActual").val(respuesta["avatar"]);

             if(respuesta["avatar"] != ""){
                 $(".previsualizar").attr("src", respuesta["avatar"]);
             }
        }
    });
})
  /** 
 * ACTIVAR USUARIO
*/
 $('.btnActivar').click(function() {
    var idUser = $(this).attr('idUsuario');
    var statusUser = $(this).attr('status');
     var datos = new FormData();
     datos.append('activarId', idUser)
    datos.append('activarUsuario', statusUser)
     $.ajax({
        url: 'ajax/users.ajax.php',
        method: 'POST',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
         }
    })
     if (statusUser == 0) {
        $(this).removeClass('btn-success')
        $(this).addClass('btn-danger')
        $(this).html('Desactivado')
        $(this).attr('status', 1)
    } else {
        $(this).removeClass('btn-danger')
        $(this).addClass('btn-success')
        $(this).html('Activado')
        $(this).attr('status', 0)
    }
})

$('.btnDeleteUser').click(function(){
    var idUser = $(this).attr('idUsuario');
    var fotouser = $(this).attr('fotoUsuario');
    var user = $(this).attr('usuario');

    swal({
        title: '¿Estas seguro de eliminar este usuario?',
        type: 'warning',
        showCancelButton:true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText:'cancelar',
        confirmButtonText:'Si, estoy seguro de borrar este usuario'
    }).then((result) => {
        if(result.value){
            window.location = 'index.php?ruta=users&idUser='+idUser+'&fotoUser='+fotouser+'&user='+user
        }
    })
})
    