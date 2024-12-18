<?php
    require_once '../models/Inventario.php';
    switch ($_GET["op"]) {
        case 'insertar':
            $codigo = isset($_POST["codigo"]) ? trim($_POST["codigo"]) : "";  
            $nombreProducto = isset($_POST["nombreProducto"]) ? trim($_POST["nombreProducto"]) : "";
            $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";
            $inventario = isset($_POST["inventario"]) ? trim($_POST["inventario"]) : "";
              
            $objProducto = new indexModel();
            $objProducto->setNombre($nombreProducto);
            $objProducto->setPrecio($precio);
            $objProducto->setInventario($inventario);
            $objProducto->guardarEnDb();

            $rspta = array("status" => "OK", "msg" => "Producto fue guardado exitosamente");
            echo json_encode($rspta);
        break;
        case 'editar':
          $codigo = isset($_PUT["codigo"]) ? trim($_PUT["codigo"]) : "";  
          $nombreProducto = isset($_PUT["nombreProducto"]) ? trim($_PUT["nombreProducto"]) : "";
          $precio = isset($_PUT["precio"]) ? trim($_PUT["precio"]) : "";
          $inventario = isset($_PUT["inventario"]) ? trim($_PUT["inventario"]) : "";
          
          $objProducto = new indexModel();
          $objProducto->setNombre($nombreProducto);
          $objProducto->setPrecio($precio);
          $objProducto->setInventario($inventario);
          $objProducto->actualizarProducto();

          $rspta = array("status" => "OK", "msg" => "Producto fue editado exitosamente");
          echo json_encode($rspta);
        break;
        case 'eliminar':
          $codigo = isset($_POST["codigo"]) ? trim($_POST["codigo"]) : "";  
          $nombreProducto = isset($_POST["nombreProducto"]) ? trim($_POST["nombreProducto"]) : "";
          $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";
          $inventario = isset($_POST["inventario"]) ? trim($_POST["inventario"]) : "";
          
          $objProducto = new indexModel();
          $objProducto->eliminarProducto();

          $rspta = array("status" => "OK", "msg" => "Producto fue eliminado exitosamente");
          echo json_encode($rspta);
        break;
        case 'listarTodos':
          $codigo = isset($_GET["codigo"]) ? trim($_GET["codigo"]) : "";  
          $nombreProducto = isset($_GET["nombreProducto"]) ? trim($_GET["nombreProducto"]) : "";
          $precio = isset($_GET["precio"]) ? trim($_GET["precio"]) : "";
          $inventario = isset($_GET["inventario"]) ? trim($_GET["inventario"]) : "";
          
          $objProducto = new indexModel();
          $objProducto->getNombre($nombreProducto);
          $objProducto->getPrecio($precio);
          $objProducto->getInventario($inventario);
          $objProducto->listarTodosDb();

          $rspta = array("status" => "OK", "msg" => "Producto mostrado exitosamente");
          echo json_encode($rspta);
        break;
        

      }
      
?>

