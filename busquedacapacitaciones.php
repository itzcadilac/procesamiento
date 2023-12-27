<?php
// require 'conexion.php';
require_once "conf.php";
$busqueda=$_POST['contratista'];

if ($busqueda != ''){
	
	$conexion = @new mysqli($servid, $user, $passw, $bdsist);
	mysqli_set_charset($conexion, 'utf8');

	$sqlautorizador = "SELECT idecapacitacion, desccapacitacion FROM tipcapacitaciones WHERE ideempresa = '$busqueda' and estado = 1 order by idecapacitacion asc ;";
	$resultautorizador = $conexion->query($sqlautorizador);
	$myArray = $resultautorizador->fetch_all(MYSQLI_ASSOC);
	
	//$myArray = json_encode($myArray);
	$data = array(
		"status" => 200,
		"data" => $myArray
	);
	echo json_encode($data);
}
else{
	echo "No se envío empresa.";
}	
?>
