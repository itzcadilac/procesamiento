<?php
// require 'conexion.php';
require_once "conf.php";
$busqueda=$_POST['tipcapacitaciones'];

if ($busqueda != ''){
	
	$conexion = @new mysqli($servid, $user, $passw, $bdsist);
	mysqli_set_charset($conexion, 'utf8');

	$sqlautorizador = "SELECT cal.idecalendcapacitaciones, cal.hora, tc.ideempresa FROM calendcapacitaciones cal, tipcapacitaciones tc WHERE cal.idecapacitacion = tc.idecapacitacion AND cal.hora >= DATE_SUB(NOW(),INTERVAL 10 DAY) AND cal.idecapacitacion = '$busqueda' AND cal.estado = 1 AND cal.notascerradas = 1 order by cal.hora asc ;";
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
