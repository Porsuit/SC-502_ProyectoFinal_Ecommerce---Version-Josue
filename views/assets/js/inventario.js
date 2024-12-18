$(function(){
    $("#addProducto").on("submit",function(event){
        event.preventDefault();
        var formData = new FormData($("#addProducto")[0]);
        $.ajax({
            type: "POST",
            url: "../controllers/inventarioController.php?op=insertar",
            data: formData,
            processData: false,  // Necesario para enviar FormData correctamente
            contentType: false,  // Necesario para enviar FormData correctamente
            dataType: "json",
            success: function (rsptaAPI) {
                console.log(rsptaAPI);
                if(rsptaAPI.status = "OK"){
                    alert(rsptaAPI.msg + ", producto fue completado")
                }else{
                    alert("Lo sentimos, el producto no pudo ser agregado.")
                }
            },
            error: function(xhr, status){
                console.log("Error procesando la peticion");
            }
        });
    })
});

$(function(){
    $("#editProducto").on("submit",function(event){
        event.preventDefault();
        var formData = new FormData($("#addProducto")[0]);
        $.ajax({
            type: "POST",
            url: "../controllers/inventarioController.php?op=insertar",
            data: formData,
            processData: false,  // Necesario para enviar FormData correctamente
            contentType: false,  // Necesario para enviar FormData correctamente
            dataType: "json",
            success: function (rsptaAPI) {
                console.log(rsptaAPI);
                if(rsptaAPI.status = "OK"){
                    alert(rsptaAPI.msg + ", producto fue completado")
                }else{
                    alert("Lo sentimos, el producto no pudo ser agregado.")
                }
            },
            error: function(xhr, status){
                console.log("Error procesando la peticion");
            }
        });
    })
});

$(function(){
    $("#deleteProducto").on("submit",function(event){
        event.preventDefault();
        var formData = new FormData($("#addProducto")[0]);
        $.ajax({
            type: "POST",
            url: "../controllers/inventarioController.php?op=eliminarProducto",
            data: formData,
            processData: false,  // Necesario para enviar FormData correctamente
            contentType: false,  // Necesario para enviar FormData correctamente
            dataType: "json",
            success: function (rsptaAPI) {
                console.log(rsptaAPI);
                if(rsptaAPI.status = "OK"){
                    alert(rsptaAPI.msg + ", producto fue completado")
                }else{
                    alert("Lo sentimos, el producto no pudo ser agregado.")
                }
            },
            error: function(xhr, status){
                console.log("Error procesando la peticion");
            }
        });
    })
});