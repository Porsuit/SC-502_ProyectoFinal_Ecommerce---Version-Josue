$(function(){
    $("#addOrden").on("submit",function(event){
        event.preventDefault();
        var formData = new FormData($("#addOrden")[0]);
        $.ajax({
            type: "POST",
            url: "../controllers/ordenController.php?op=insertar",
            data: formData,
            processData: false,  // Necesario para enviar FormData correctamente
            contentType: false,  // Necesario para enviar FormData correctamente
            dataType: "json",
            success: function (rsptaAPI) {
                console.log(rsptaAPI);
                if(rsptaAPI.status = "OK"){
                    alert(rsptaAPI.msg + ", orden fue completado")
                }else{
                    alert("Lo sentimos, la orden no pudo ser agregado.")
                }
            },
            error: function(xhr, status){
                console.log("Error procesando la peticion");
            }
        });
    })
});

$(function(){
    $("#editOrden").on("submit",function(event){
        event.preventDefault();
        var formData = new FormData($("#addOrden")[0]);
        $.ajax({
            type: "PUT",
            url: "../controllers/ordenController.php?op=insertar",
            data: formData,
            processData: false,  // Necesario para enviar FormData correctamente
            contentType: false,  // Necesario para enviar FormData correctamente
            dataType: "json",
            success: function (rsptaAPI) {
                console.log(rsptaAPI);
                if(rsptaAPI.status = "OK"){
                    alert(rsptaAPI.msg + ", orden fue completado")
                }else{
                    alert("Lo sentimos, la orden no pudo ser agregado.")
                }
            },
            error: function(xhr, status){
                console.log("Error procesando la peticion");
            }
        });
    })
});

$(function(){
    $("#deleteOrden").on("submit",function(event){
        event.preventDefault();
        var formData = new FormData($("#addOrden")[0]);
        $.ajax({
            type: "DELETE",
            url: "../controllers/ordenController.php?op=eliminarOrden",
            data: formData,
            processData: false,  // Necesario para enviar FormData correctamente
            contentType: false,  // Necesario para enviar FormData correctamente
            dataType: "json",
            success: function (rsptaAPI) {
                console.log(rsptaAPI);
                if(rsptaAPI.status = "OK"){
                    alert(rsptaAPI.msg + ", orden fue completado")
                }else{
                    alert("Lo sentimos, la orden no pudo ser agregado.")
                }
            },
            error: function(xhr, status){
                console.log("Error procesando la peticion");
            }
        });
    })
});