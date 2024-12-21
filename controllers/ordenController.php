<?php
    require_once '../models/Orden.php';
    switch ($_GET["op"]) {
        case 'insertar':
          $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";
          $fecha_orden = isset($_POST["fecha_orden"]) ? trim($_POST["fecha_orden"]) : "";
          $cliente_id = isset($_POST["cliente_id"]) ? trim($_POST["cliente_id"]) : "";
          $cantidad_total = isset($_POST["cantidad_total"]) ? trim($_POST["cantidad_total"]) : "";  
          $estado = isset($_POST["estado"]) ? trim($_POST["estado"]) : "";
            
          $objOrden = new ordenModel();
          $objOrden->setFechaOrden($fecha_orden);
          $objOrden->setClienteId($cliente_id);
          $objOrden->setCantidadTotal($cantidad_total);
          $objOrden->setEstado($estado);
          $objOrden->guardarEnDb();

          $rspta = array("status" => "OK", "msg" => "Orden fue guardado exitosamente");
          echo json_encode($rspta);
        break;
        case 'editar':
          $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";
          $fecha_orden = isset($_POST["fecha_orden"]) ? trim($_POST["fecha_orden"]) : "";
          $cliente_id = isset($_POST["cliente_id"]) ? trim($_POST["cliente_id"]) : "";
          $cantidad_total = isset($_POST["cantidad_total"]) ? trim($_POST["cantidad_total"]) : "";  
          $estado = isset($_POST["estado"]) ? trim($_POST["estado"]) : "";
          
          $objOrden = new ordenModel();
          $objOrden->setFechaOrden($fecha_orden);
          $objOrden->setClienteId($cliente_id);
          $objOrden->setCantidadTotal($cantidad_total);
          $objOrden->setEstado($estado);
          $objOrden->actualizarOrden();


          $rspta = array("status" => "OK", "msg" => "Orden fue editado exitosamente");
          echo json_encode($rspta);
        break;
        case 'eliminar':
          $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";
          $fecha_orden = isset($_POST["fecha_orden"]) ? trim($_POST["fecha_orden"]) : "";
          $cliente_id = isset($_POST["cliente_id"]) ? trim($_POST["cliente_id"]) : "";
          $cantidad_total = isset($_POST["cantidad_total"]) ? trim($_POST["cantidad_total"]) : "";  
          $estado = isset($_POST["estado"]) ? trim($_POST["estado"]) : "";
          
          $objOrden = new ordenModel();
          $objOrden->eliminarOrden();

          $rspta = array("status" => "OK", "msg" => "Orden fue eliminado exitosamente");
          echo json_encode($rspta);
        break;
        case 'listarTodos':
          $id = isset($_GET["id"]) ? trim($_GET["id"]) : "";  
          $fecha_orden = isset($_GET["fecha_orden"]) ? trim($_GET["fecha_orden"]) : "";
          $cliente_id = isset($_GET["cliente_id"]) ? trim($_GET["cliente_id"]) : "";
          $cantidad_total = isset($_GET["cantidad_total"]) ? trim($_GET["cantidad_total"]) : "";
          $estado = isset($_GET["estado"]) ? trim($_GET["estado"]) : "";
          
          
          $objOrden = new ordenModel();
          $objOrden->setFechaOrden($fecha_orden);
          $objOrden->setClienteId($cliente_id);
          $objOrden->setCantidadTotal($cantidad_total);
          $objOrden->setEstado($estado);
          $objOrden->listarTodosDb();

          $rspta = array("status" => "OK", "msg" => "Orden mostrado exitosamente");
          echo json_encode($rspta);
        break;
        

      }
      
?>

