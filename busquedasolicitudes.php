<?php
// require 'conexion.php';
require_once "conf.php";
$busqueda=$_POST['idecalendcapacitaciones'];

if ($busqueda != ''){
	
	$conexion = @new mysqli($servid, $user, $passw, $bdsist);
	mysqli_set_charset($conexion, 'utf8');

	$sqlautorizador = "SELECT sc.ruc, sc.razons, sc.idesolicitud FROM solicitudcapac sc WHERE sc.idecalendcapacitaciones = '$busqueda' and estadosolic <> 4 order by sc.ruc, sc.idesolicitud  asc ;";
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
	echo "No se envío idecalendcapacitacion.";
}	
?>
