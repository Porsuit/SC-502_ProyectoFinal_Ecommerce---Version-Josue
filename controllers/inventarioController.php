<?php
    require_once '../models/Inventario.php';
    switch ($_GET["op"]) {
        case 'insertar':
            $codigo = isset($_POST["codigo"]) ? trim($_POST["codigo"]) : "";  
            $nombreProducto = isset($_POST["nombreProducto"]) ? trim($_POST["nombreProducto"]) : "";
              $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";
              $inventario = isset($_POST["inventario"]) ? trim($_POST["inventario"]) : "";
              
              $objComentario = new indexModel();
              $objComentario->setNombre($nombreProducto);
              $objComentario->setPrecio($precio);
              $objComentario->setInventario($inventario);
              $objComentario->guardarEnDb();

              $rspta = array("status" => "OK", "msg" => "Comentario enviado exitosamente");
              echo json_encode($rspta);
        break;
      }
?>