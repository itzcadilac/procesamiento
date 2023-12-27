<?php
// require 'conexion.php';
require_once "conf.php";
$busqueda=$_POST['horario'];

if ($busqueda != ''){
	
	$conexion = @new mysqli($servid, $user, $passw, $bdsist);
	mysqli_set_charset($conexion, 'utf8');

	$sqlautorizador = "SELECT idepersonal, documento, nombres, CONCAT_WS(' ',ape_paterno, ape_materno) as apellidos, empresa, documento as fotos, 'http://software.sstasesores.pe/busqueda/' as qr FROM personal where asistencia = 1 and idecalendcapacitaciones = '$busqueda'  ORDER BY 1 ASC ;";
	//echo $sqlautorizador;
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
