<?php
    require_once '../models/Inventario.php';
    switch ($_GET["op"]) {
      case 'listarTodos':
        $producto_login = new productoModel();
        $objProducto = $producto_login -> ListarTodosDb();
        data = array();
        foreach ($objProductos as $reg) {
          $data[] = array(
            "0" => $reg->getCodigo(),
            "1" => $reg->getNombre(),
            "2" => $reg->getPrecio(),
            "3" => $reg->getInventario(),
            "4" => $reg->getImagenUrl(), 
          );
        }
        
        $resultados = array(
          "sEcho" => 1, ##informacion para datatables
          "iTotalRecords" =>count($data), ## total de registros al datatable
          "iTotalDisplayRecords" => count($data), ## enviamos el total de registros a visualizar
          "aaData" => $data
        );
        echo json_encode($resultados);
      break;
      case 'insertar':
          $codigo = isset($_POST["codigo"]) ? trim($_POST["codigo"]) : "";  
          $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
          $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";
          $inventario = isset($_POST["inventario"]) ? trim($_POST["inventario"]) : "";
          $imagen_url = isset($_POST["imagen_url"]) ? trim($_POST["imagen_url"]) : "";
            
          $objProducto = new productoModel();
          $objProducto->setNombre($nombre);
          $encontrado = $objProducto->verificarExistenciaDb()
          if ($encontrado == false) {
            $objProducto->setNombre($nombre);
            $objProducto->setPrecio($precio);
            $objProducto->setInventario($inventario);
            $objProducto->setImagenUrl($imagen_url);
            $objProducto->guardarEnDb();
            $rspta = array("status" => "OK", "msg" => "Producto fue insertado exitosamente");
              echo json_encode($rspta);
          } else {
              $rspta = array("status" => "FAIL", "msg" => "Producto no pudo ser insertado");
              echo json_encode($rspta);
          }
      break;
      case 'editar':
        $codigo = isset($_POST["codigo"]) ? trim($_POST["codigo"]) : "";  
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";
        $inventario = isset($_POST["inventario"]) ? trim($_POST["inventario"]) : "";
        $imagen_url = isset($_POST["imagen_url"]) ? trim($_POST["imagen_url"]) : "";
        
        $objProducto = new productoModel();
        $objProducto->setNombre($nombre);
        $encontrado = $objProducto->verificarExistenciaDb();
        if ($encontrado == 1) {
          $objProducto->llenarCampos($codigo);
          $objProducto->setPrecio($precio);
          $objProducto->setNombre($nombre);
          $objProducto->setInventario($inventario);
          $objProducto->setImagenUrl($imagen_url);
          $modificados = $objProducto->actualizarProducto();
            if ($modificados > 0) {
              $rspta = array("status" => "OK", "msg" => "Producto fue editado exitosamente");
              echo json_encode($rspta);
            } else {
              $rspta = array("status" => "FAIL", "msg" => "Producto no pudo ser editado");
              echo json_encode($rspta);
            }
          }else{
            $rspta = array("status" => "FAIL", "msg" => "No se logro encontrar el producto");
            echo json_encode($rspta);;	
          }
        
      break;
      case 'eliminar':
        $codigo = isset($_POST["codigo"]) ? trim($_POST["codigo"]) : "";  
        
        $objProducto = new productoModel();
        $objProducto->eliminarProducto();
        $rspta = array("status" => "OK", "msg" => "Producto fue eliminado exitosamente");
        echo json_encode($rspta);
      break;
      

    }
?>

