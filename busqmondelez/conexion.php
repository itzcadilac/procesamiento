<?php 

define("APP_BASEDIR", dirname(__DIR__));
require(APP_BASEDIR . '/vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(APP_BASEDIR);
$dotenv->load();

$bd_host = $_ENV['DB_HOST']; 
$bd_usuario = $_ENV['DB_USER']; 
$bd_password = $_ENV['DB_PASS']; 
$bd_base = $_ENV['DB_NAME'];
//$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
$con = mysqli_connect($bd_host, $bd_usuario, $bd_password, $bd_base); 
//mysql_select_db($bd_base, $con); 
//mysqli_select_db($bd_base, $con); 
?>