$(function(){
    $("#addCategoria").on("submit",function(event){
        event.preventDefault();
        var formData = new FormData($("#addCategoria")[0]);
        $.ajax({
            type: "POST",
            url: "../controllers/categoriaController.php?op=insertar",
            data: formData,
            processData: false,  // Necesario para enviar FormData correctamente
            contentType: false,  // Necesario para enviar FormData correctamente
            dataType: "json",
            success: function (rsptaAPI) {
                console.log(rsptaAPI);
                if(rsptaAPI.status = "OK"){
                    alert(rsptaAPI.msg + ", categoria fue completado")
                }else{
                    alert("Lo sentimos, la categoria no pudo ser agregado.")
                }
            },
            error: function(xhr, status){
                console.log("Error procesando la peticion");
            }
        });
    })
});

$(function(){
    $("#editCategoria").on("submit",function(event){
        event.preventDefault();
        var formData = new FormData($("#addCategoria")[0]);
        $.ajax({
            type: "PUT",
            url: "../controllers/categoriaController.php?op=insertar",
            data: formData,
            processData: false,  // Necesario para enviar FormData correctamente
            contentType: false,  // Necesario para enviar FormData correctamente
            dataType: "json",
            success: function (rsptaAPI) {
                console.log(rsptaAPI);
                if(rsptaAPI.status = "OK"){
                    alert(rsptaAPI.msg + ", categoria fue completado")
                }else{
                    alert("Lo sentimos, la categoria no pudo ser agregado.")
                }
            },
            error: function(xhr, status){
                console.log("Error procesando la peticion");
            }
        });
    })
});

$(function(){
    $("#deleteCategoria").on("submit",function(event){
        event.preventDefault();
        var formData = new FormData($("#addCategoria")[0]);
        $.ajax({
            type: "DELETE",
            url: "../controllers/categoriaController.php?op=eliminarCategoria",
            data: formData,
            processData: false,  // Necesario para enviar FormData correctamente
            contentType: false,  // Necesario para enviar FormData correctamente
            dataType: "json",
            success: function (rsptaAPI) {
                console.log(rsptaAPI);
                if(rsptaAPI.status = "OK"){
                    alert(rsptaAPI.msg + ", categoria fue completado")
                }else{
                    alert("Lo sentimos, la categoria no pudo ser agregado.")
                }
            },
            error: function(xhr, status){
                console.log("Error procesando la peticion");
            }
        });
    })
});