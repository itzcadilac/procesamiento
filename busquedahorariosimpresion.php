<?php
// require 'conexion.php';
require_once "conf.php";
$busqueda=$_POST['tipcapacitaciones'];

if ($busqueda != ''){
	
	$conexion = @new mysqli($servid, $user, $passw, $bdsist);
	mysqli_set_charset($conexion, 'utf8');

	$sqlautorizador = "SELECT idecalendcapacitaciones, hora FROM calendcapacitaciones WHERE hora >= DATE_SUB(NOW(),INTERVAL 10 DAY) AND idecapacitacion = '$busqueda' order by hora asc ;";
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
	echo "No se envío tipo de capacitación.";
}	
?>
