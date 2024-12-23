/*Funcion para limpieza de los formularios*/
function limpiarForms() {
    $('#addProducto').trigger('reset');
    $('#editProducto').trigger('reset');
  }
  
  /*Funcion para cancelacion del uso de formulario de modificación*/
function cancelarForm() {
    limpiarForms();
    $('#addProducto').show();
    $('#editProducto').hcodigoe();
}
function listarProductos() {
    tabla = $('#tbllistado').dataTable({
      aProcessing: true, 
      aServerScodigoe: true, 
      dom: 'Bfrtip', 
      buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
      ajax: {
        url: '../controllers/inventarioController.php?op=listarTodos',
        type: 'get',
        dataType: 'json',
        error: function (e) {
          console.log(e.responseText);
        },
        bDestroy: true,
        iDisplayLength: 5,
      },
    });
  }

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
            type: "PUT",
            url: "../controllers/inventarioController.php?op=editar",
            data: formData,
            processData: false,  // Necesario para enviar FormData correctamente
            contentType: false,  // Necesario para enviar FormData correctamente
            dataType: "json",
            success: function (rsptaAPI) {
                console.log(rsptaAPI);
                if(rsptaAPI.status = "OK"){
                    alert(rsptaAPI.msg + ", producto fue actualizado")
                }else{
                    alert("Lo sentimos, el producto no pudo ser actualizado.")
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
            type: "DELETE",
            url: "../controllers/inventarioController.php?op=eliminar",
            data: formData,
            processData: false,  // Necesario para enviar FormData correctamente
            contentType: false,  // Necesario para enviar FormData correctamente
            dataType: "json",
            success: function (rsptaAPI) {
                console.log(rsptaAPI);
                if(rsptaAPI.status = "OK"){
                    alert(rsptaAPI.msg + ", producto fue eliminado")
                }else{
                    alert("Lo sentimos, el producto no pudo ser eliminado.")
                }
            },
            error: function(xhr, status){
                console.log("Error procesando la peticion");
            }
        });
    })
});