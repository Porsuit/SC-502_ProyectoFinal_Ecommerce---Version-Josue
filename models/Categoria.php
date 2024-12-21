<?php
require_once '../config/Conexion.php';

class Categoria extends Conexion
{
    /*Atributos de la Clase*/
        protected static $cnx;
		private $id=null;
		private $nombre=null;
		private $precio= null;
        private $inventario=null;

    /*Contructores de la Clase*/
        public function __construct(){}

    /*Encapsuladores de la Clase*/
        public function getId()
        {
            return $this->id;
        }
        public function setId($id)
        {
            $this->id = $id;
        }
        public function getNombre()
        {
            return $this->nombre;
        }
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
        
        

    /*Metodos de la Clase*/
        public static function getConexion(){
            self::$cnx = Conexion::conectar();
        }

        public static function desconectar(){
            self::$cnx = null;
        }
        /*Lista todos los resultados de categorias en el inventario*/
        public function listarTodosDb(){
            $query = "SELECT * FROM categorias";
            $arr = array();
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);
                $resultado->execute();
                self::desconectar();
                foreach ($resultado->fetchAll() as $encontrado) {
                    $cat = new Categoria();
                    $cat->setId($encontrado['id']);
                    $cat->setNombre($encontrado['nombre']);
                    $arr[] = $cat;
                }
                return $arr;
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );;
                return json_encode($error);
            }
        }
        /*Verifica la existencia de los resultados de categorias en el inventario*/
        public function verificarExistenciaDb(){
            $query = "SELECT * FROM categorias where nombre=:nombre";
         try {
             self::getConexion();
                $resultado = self::$cnx->prepare($query);		
                $nombre= $this->getNombre();	
                $resultado->bindParam(":nombre",$nombre,PDO::PARAM_STR);
                $resultado->execute();
                self::desconectar();
                $encontrado = false;
                foreach ($resultado->fetchAll() as $reg) {
                    $encontrado = true;
                }
                return $encontrado;
               } catch (PDOException $Exception) {
                   self::desconectar();
                   $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                 return $error;
               }
        }
        /*Guarda un categoria en el inventario*/
        public function guardarEnDb(){
            $query = "INSERT INTO `categorias`(`nombre`, `precio`) VALUES (:nombre,:precio,:inventario)";
         try {
             self::getConexion();
             $nombre=strtoupper($this->getNombre());
             $precio=$this->getPrecio();
             $inventario=$this->getInventario();
    
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":nombre",$nombre,PDO::PARAM_STR);
            $resultado->bindParam(":precio",$precio,PDO::PARAM_INT);
            $resultado->bindParam(":inventario",$inventario,PDO::PARAM_INT);
                $resultado->execute();
                self::desconectar();
               } catch (PDOException $Exception) {
                   self::desconectar();
                   $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );;
                 return json_encode($error);
               }
        }
        /*Activa un categoria en el inventario*/
        public function activar(){
            $id = $this->getId();
            $query = "UPDATE categorias SET estado='1' WHERE id=:id";
           try {
             self::getConexion();
              $resultado = self::$cnx->prepare($query);
              $resultado->bindParam(":id",$id,PDO::PARAM_INT);
              self::$cnx->beginTransaction();//desactiva el autocommit
              $resultado->execute();
              self::$cnx->commit();//realiza el commit y vuelve al modo autocommit
              self::desconectar();
              return $resultado->rowCount();
             } catch (PDOException $Exception) {
               self::$cnx->rollBack();
               self::desconectar();
               $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
               return $error;
             }
        }
        /*Desactiva un categoria en el inventario*/
        public function desactivar(){
            $id = $this->getId();
            $query = "UPDATE categorias SET estado='0' WHERE id=:id";
            try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id",$id,PDO::PARAM_INT);
            self::$cnx->beginTransaction();//desactiva el autocommit
            $resultado->execute();
            self::$cnx->commit();//realiza el commit y vuelve al modo autocommit
            self::desconectar();
            return $resultado->rowCount();
            } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            return $error;
            }
        }
        
        
        /*Actualiza la informacion de un categoria en el inventario*/
        public function actualizarCategoria(){
            $query = "update categorias set nombre=:nombre where id=:id";
            try {
                self::getConexion();
                $id=$this->getId();
                $nombre=$this->getNombre();
                $precio=$this->getPrecio();
                $inventario=$this->getInventario();
                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":nombre",$nombre,PDO::PARAM_STR);
                $resultado->bindParam(":id",$id,PDO::PARAM_INT);
                self::$cnx->beginTransaction();//desactiva el autocommit
                $resultado->execute();
                self::$cnx->commit();//realiza el commit y vuelve al modo autocommit
                self::desconectar();
                return $resultado->rowCount();
            } catch (PDOException $Exception) {
                self::$cnx->rollBack();
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                return $error;
            }
        }
        /*Verifica la existencia de un categorias en el inventario*/
        public function verificarExistenciaNombre(){
            $query = "SELECT nombre,id,precio,inventario FROM categorias where nombre=:nombre and estado =1";
            try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);		
            $nombre= $this->getNombre();		
            $resultado->bindParam(":nombre",$nombre,PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
            $encontrado = false;
            $arr=array();
            foreach ($resultado->fetchAll() as $reg) {
                $arr[]=$reg['id'];
                $arr[]=$reg['nombre'];   
            }
            return $arr;
            return $encontrado;
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            return $error;
            }
        }
        /*Elimina un categoria en el inventario*/
        public function eliminarCategoria(){
            $query = "delete categorias where id=:id and nombre=:nombre";
            try {
                self::getConexion();
                $id=$this->getId();
                $nombre=$this->getNombre();
                $resultado = self::$cnx->prepare($query);
                self::$cnx->beginTransaction();//desactiva el autocommit
                $resultado->execute();
                self::$cnx->commit();//realiza el commit y vuelve al modo autocommit
                self::desconectar();
                return $resultado->rowCount();
            } catch (PDOException $Exception) {
                self::$cnx->rollBack();
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                return $error;
            }
        }
}
?>