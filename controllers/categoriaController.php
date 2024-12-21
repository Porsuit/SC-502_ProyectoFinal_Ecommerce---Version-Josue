<?php
    require_once '../models/Categoria.php';
    switch ($_GET["op"]) {
        case 'insertar':
            $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";  
            $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";              
            $objCategoria = new indexModel();
            $objCategoria->setNombre($nombre);
            
            $objCategoria->guardarEnDb();

            $rspta = array("status" => "OK", "msg" => "Categoria fue guardado exitosamente");
            echo json_encode($rspta);
        break;
        case 'editar':
          $id = isset($_PUT["id"]) ? trim($_PUT["id"]) : "";  
          $nombre = isset($_PUT["nombre"]) ? trim($_PUT["nombre"]) : "";
          
          $objCategoria = new indexModel();
          $objCategoria->setNombre($nombre);
          $objCategoria->actualizarCategoria();

          $rspta = array("status" => "OK", "msg" => "Categoria fue editado exitosamente");
          echo json_encode($rspta);
        break;
        case 'eliminar':
          $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";  
          $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
          
          $objCategoria = new indexModel();
          $objCategoria->eliminarCategoria();

          $rspta = array("status" => "OK", "msg" => "Categoria fue eliminado exitosamente");
          echo json_encode($rspta);
        break;
        case 'listarTodos':
          $id = isset($_GET["id"]) ? trim($_GET["id"]) : "";  
          $nombre = isset($_GET["nombre"]) ? trim($_GET["nombre"]) : "";
          
          $objCategoria = new indexModel();
          $objCategoria->getNombre($nombre);
          $objCategoria->listarTodosDb();

          $rspta = array("status" => "OK", "msg" => "Categoria mostrado exitosamente");
          echo json_encode($rspta);
        break;
        

      }
      
?>

