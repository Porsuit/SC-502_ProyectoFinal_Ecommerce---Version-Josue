<?php

require_once "global.php";

class Conexion
{
    function __construct()
    {
        # code...
    }
    public static function conectar(){
        //conexion mysql
        try {
            $cn = new PDO("mysql:host=".DB_HOST_MYSQL.";dbname=".DB_NAME_MYSQL.";charset=utf8",DB_USER_MYSQL,DB_PASSWORD_MYSQL);
            $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $cn;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

}

//var_dump(Conexion::conectar());

/* Conexion antigua
// Database credentials
$host = "localhost";
$user = "ecommerce_user";
$password = "passwordDebilPrueba";
$dbname = "ecommerce";

try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    die("Error connecting to the database: " . $e->getMessage());
}
*/
?>