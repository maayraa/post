/*Subiendo la foto del Usuario */

$(".nuevaFoto").change(function(){
    var image = this.files[0];
    console.log(image);
    /* validando el formato de la imagen jpg*/

    // if(image["type"] != "image/jpeg" && image["type"] != "image/png" ){
    //     $(".nuevaFoto").val("");
    //         swal({
    //             title:"Error al subir la imagen",
    //             text:"La imagen debe ser en formato JPG o PNG",
    //             type: "error",
    //             confirmButtonText: "¡Cerrar!"
    //         });

    //     }else if(image["size"] > 2000000){
    //         $(".nuevaFoto").val("");
    //         swal({
    //             title:"Error al subir la imagen",
    //             text:"La imagen no debe pesar mas de 2MB",
    //             type: "error",
    //             confirmButtonText: "¡Cerrar!"
    //         });

    //     }else{
    //         var datosImagen = new FileReader;
    //         datosImagen.readAsDataURL(image);
    //         $(datosImagen).on("load", function(event){
    //             var routeImage = event.target.result;
    //             $(".previsualizar").attr("src", routeImage);

    //         })
    //     }
})

/* Editar Usuario */
// $('.btnEditUser').click(function(){
//     var idUsuario = $(this).attr("idUsuario");
//     console.log("idUsuario", idUsuario);
//     var data = new FormData();
//     data.append("idUsuario", idUsuario);

//     $.ajax({
//         url:"ajax/users.ajax.php",
//         method: "POST",
//         data: data,
//         cache:false,
//         contentType: false,
//         processData: false,
//         dataType:"json",
//         success:function(respuesta){
//             $("#editarNombre").val(respuesta["name"]);
//             $("#editarUsuario").val(respuesta["user"]);
//             $("#editarPerfil").html(respuesta["profile"]);
//             $("#editarPerfil").val(respuesta["profile"]);
//             $("#fotoActual").html(respuesta["Foto"]);

//             $("#passwordActual").html(respuesta["pass"]);

            


//             if(respuesta["Foto"] != ""){
//                 $(".previsualizar").attr("src", respuesta["Foto"]);
//             }
            
//         }

//     });
// })

console.log("te oreo")