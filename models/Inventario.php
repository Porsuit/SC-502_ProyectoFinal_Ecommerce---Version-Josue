<?php
require_once '../config/Conexion.php';

class Producto extends Conexion
{
    /*Atributos de la Clase*/
        protected static $cnx;
		private $codigo=null;
		private $nombreProducto=null;
		private $precio= null;
        private $inventario=null;

    /*Contructores de la Clase*/
        public function __construct(){}

    /*Encapsuladores de la Clase*/
        public function getCodigo()
        {
            return $this->codigo;
        }
        public function setCodigo($codigo)
        {
            $this->codigo = $codigo;
        }
        public function getNombreProducto()
        {
            return $this->nombreProducto;
        }
        public function setNombreProducto($nombreProducto)
        {
            $this->nombreProducto = $nombreProducto;
        }
        
        public function getPrecio()
        {
            return $this->precio;
        }
        public function setPrecio($precio)
        {
            $this->precio = $precio;
        }
        public function getInventario()
        {
            return $this->inventario;
        }
        public function setInventario($inventario)
        {
            $this->inventario = $inventario;
        }

    /*Metodos de la Clase*/
        public static function getConexion(){
            self::$cnx = Conexion::conectar();
        }

        public static function desconectar(){
            self::$cnx = null;
        }
        /*Lista todos los resultados de productos en el inventario*/
        public function listarTodosDb(){
            $query = "SELECT * FROM productos";
            $arr = array();
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);
                $resultado->execute();
                self::desconectar();
                foreach ($resultado->fetchAll() as $encontrado) {
                    $product = new Producto();
                    $product->setCodigo($encontrado['codigo']);
                    $product->setNombreProducto($encontrado['nombreProducto']);
                    $product->setPrecio($encontrado['precio']);
                    $product->setInventario($encontrado['Inventario']);
                    $arr[] = $product;
                }
                return $arr;
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );;
                return json_encode($error);
            }
        }
        /*Verifica la existencia de los resultados de productos en el inventario*/
        public function verificarExistenciaDb(){
            $query = "SELECT * FROM productos where nombreProducto=:nombreProducto";
         try {
             self::getConexion();
                $resultado = self::$cnx->prepare($query);		
                $nombreProducto= $this->getNombreProducto();	
                $resultado->bindParam(":nombreProducto",$nombreProducto,PDO::PARAM_STR);
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
        /*Guarda un producto en el inventario*/
        public function guardarEnDb(){
            $query = "INSERT INTO `productos`(`nombreProducto`, `precio`,`inventario`) VALUES (:nombreProducto,:precio,:inventario)";
         try {
             self::getConexion();
             $nombreProducto=strtoupper($this->getNombreProducto());
             $precio=$this->getPrecio();
             $inventario=$this->getInventario();
    
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":nombreProducto",$nombreProducto,PDO::PARAM_STR);
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
        /*Activa un producto en el inventario*/
        public function activar(){
            $codigo = $this->getCodigo();
            $query = "UPDATE productos SET estado='1' WHERE codigo=:codigo";
           try {
             self::getConexion();
              $resultado = self::$cnx->prepare($query);
              $resultado->bindParam(":codigo",$codigo,PDO::PARAM_INT);
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
        /*Desactiva un producto en el inventario*/
        public function desactivar(){
            $codigo = $this->getCodigo();
            $query = "UPDATE productos SET estado='0' WHERE codigo=:codigo";
            try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":codigo",$codigo,PDO::PARAM_INT);
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
        /*Muestra el precio de un producto en el inventario*/
        public static function mostrar($precio){
            $query = "SELECT * FROM productos where nombreProducto=:codigo";
            $codigo = $precio;
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":codigo",$codigo,PDO::PARAM_STR);
                $resultado->execute();
                self::desconectar();
                return $resultado->fetch();
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                return $error;
            }
    
        }
        /*Muestra la cantidad disponible de un producto en el inventario*/
        public static function mostrar($inventario){
            $query = "SELECT * FROM productos where nombreProducto=:codigo";
            $codigo = $inventario;
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":codigo",$codigo,PDO::PARAM_STR);
                $resultado->execute();
                self::desconectar();
                return $resultado->fetch();
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                return $error;
            }
    
        }
        /*Actualiza la informacion de un producto en el inventario*/
        public function actualizarProducto(){
            $query = "update productos set nombreProducto=:nombreProducto,precio=:precio,inventario=:inventario where codigo=:codigo and nombreProducto=:nombreProducto";
            try {
                self::getConexion();
                $codigo=$this->getCodigo();
                $nombreProducto=$this->getNombreProducto();
                $precio=$this->getPrecio();
                $inventario=$this->getInventario();
                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":inventario",$inventario,PDO::PARAM_INT);
                $resultado->bindParam(":precio",$precio,PDO::PARAM_INT);
                $resultado->bindParam(":nombreProducto",$nombreProducto,PDO::PARAM_STR);
                $resultado->bindParam(":codigo",$codigo,PDO::PARAM_INT);
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
        /*Verifica la existencia de un productos en el inventario*/
        public function verificarExistenciaNombreProducto(){
            $query = "SELECT nombreProducto,codigo,precio,inventario FROM productos where nombreProducto=:nombreProducto and estado =1";
            try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);		
            $nombreProducto= $this->getNombreProducto();		
            $resultado->bindParam(":nombreProducto",$nombreProducto,PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
            $encontrado = false;
            $arr=array();
            foreach ($resultado->fetchAll() as $reg) {
                $arr[]=$reg['codigo'];
                $arr[]=$reg['nombreProducto'];   
            }
            return $arr;
            return $encontrado;
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            return $error;
            }
        }
        /*Elimina un producto en el inventario*/
        public function eliminarProducto(){
            $query = "delete productos where codigo=:codigo and nombreProducto=:nombreProducto";
            try {
                self::getConexion();
                $codigo=$this->getCodigo();
                $nombreProducto=$this->getNombreProducto();
                $precio=$this->getPrecio();
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