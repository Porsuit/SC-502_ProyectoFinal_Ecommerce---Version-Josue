<?php
require_once '../config/Conexion.php';

class Orden extends Conexion
{
    /*Atributos de la Clase*/
        protected static $cnx;
		private $id=null;
		private $cliente_id=null;
		private $fecha_orden= null;
        private $cantidad_total=null;
        private $estado=null;

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
        public function getClienteId()
        {
            return $this->cliente_id;
        }
        public function setClienteId($cliente_id)
        {
            $this->cliente_id = $cliente_id;
        }
        
        public function getFechaOrden()
        {
            return $this->fecha_orden;
        }
        public function setFechaOrden($fecha_orden)
        {
            $this->fecha_orden = $fecha_orden;
        }
        public function getCantidadTotal()
        {
            return $this->cantidad_total;
        }
        public function setCantidadTotal($cantidad_total)
        {
            $this->cantidad_total = $cantidad_total;
        }
        public function getEstado()
        {
            return $this->estado;
        }
        public function setEstado($estado)
        {
            $this->estado = $estado;
        }

    /*Metodos de la Clase*/
        public static function getConexion(){
            self::$cnx = Conexion::conectar();
        }

        public static function desconectar(){
            self::$cnx = null;
        }
        /*Lista todos los resultados de ordenes en el cantidad_total*/
        public function listarTodosDb(){
            $query = "SELECT * FROM ordenes";
            $arr = array();
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);
                $resultado->execute();
                self::desconectar();
                foreach ($resultado->fetchAll() as $encontrado) {
                    $order = new Orden();
                    $order->setId($encontrado['id']);
                    $order->setClienteId($encontrado['cliente_id']);
                    $order->setFechaOrden($encontrado['fecha_orden']);
                    $order->setCantidadTotal($encontrado['CantidadTotal']);
                    $order->setId($encontrado['estado']);
                    $arr[] = $order;
                }
                return $arr;
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );;
                return json_encode($error);
            }
        }
        /*Verifica la existencia de los resultados de ordenes en el cantidad_total*/
        public function verificarExistenciaDb(){
            $query = "SELECT * FROM ordenes where cliente_id=:cliente_id";
         try {
             self::getConexion();
                $resultado = self::$cnx->prepare($query);		
                $cliente_id= $this->getClienteId();	
                $resultado->bindParam(":cliente_id",$cliente_id,PDO::PARAM_STR);
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
        /*Guarda un orden en el cantidad_total*/
        public function guardarEnDb(){
            $query = "INSERT INTO `ordenes`(`cliente_id`, `fecha_orden`,`cantidad_total`) VALUES (:cliente_id,:fecha_orden,:cantidad_total)";
         try {
             self::getConexion();
             $cliente_id=$this->getClienteId();
             $fecha_orden=$this->getFechaOrden();
             $cantidad_total=$this->getCantidadTotal();
    
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":cliente_id",$cliente_id,PDO::PARAM_STR);
            $resultado->bindParam(":fecha_orden",$fecha_orden,PDO::PARAM_DATE);
            $resultado->bindParam(":cantidad_total",$cantidad_total,PDO::PARAM_INT);
            $resultado->bindParam(":estado",$estado,PDO::PARAM_STR);
                $resultado->execute();
                self::desconectar();
               } catch (PDOException $Exception) {
                   self::desconectar();
                   $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );;
                 return json_encode($error);
               }
        }
        
        /*Muestra el cliente id de un orden en el cantidad_total*/
        public static function mostrar($cliente_id){
            $query = "SELECT * FROM ordenes where cliente_id =:id";
            $id = $cliente_id;
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":id",$id,PDO::PARAM_STR);
                $resultado->execute();
                self::desconectar();
                return $resultado->fetch();
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                return $error;
            }
    
        }
        
        /*Actualiza la informacion de un orden en el cantidad_total*/
        public function actualizarOrden(){
            $query = "update ordenes set cliente_id=:cliente_id,fecha_orden=:fecha_orden,cantidad_total=:cantidad_total where id=:id and cliente_id=:cliente_id";
            try {
                self::getConexion();
                $id=$this->getId();
                $cliente_id=$this->getClienteId();
                $fecha_orden=$this->getFechaOrden();
                $cantidad_total=$this->getCantidadTotal();
                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":estado",$id,PDO::PARAM_STR);
                $resultado->bindParam(":cantidad_total",$cantidad_total,PDO::PARAM_INT);
                $resultado->bindParam(":fecha_orden",$fecha_orden,PDO::PARAM_INT);
                $resultado->bindParam(":cliente_id",$cliente_id,PDO::PARAM_INT);
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
        
        /*Elimina un orden en el cantidad_total*/
        public function eliminarOrden(){
            $query = "delete ordenes where id=:id and cliente_id=:cliente_id";
            try {
                self::getConexion();
                $id=$this->getId();
                $cliente_id=$this->getClienteId();
                $fecha_orden=$this->getFechaOrden();
                $estado=$this->getFechaOrden();
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