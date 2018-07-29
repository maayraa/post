/*Subiendo la foto del Usuario */

$(".nuevaFoto").change(function(){
    var image = this.files[0];
    
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