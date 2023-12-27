<?php
session_start();
require_once "./conf.php";

$daosol = new CargaFotosDAO();

$BD = new ConexionDB();

$idecalendcapacitaciones = $_POST['idecalendcapacitaciones'];

$querycup="SELECT idecapacitacion FROM calendcapacitaciones WHERE idecalendcapacitaciones = '$idecalendcapacitaciones';";

if ($recordSet = $BD->ejecutar($querycup)){
    while ($fila = $recordSet->fetch_assoc()) {
        $idecapacitacion=$fila['idecapacitacion'];
    }
    
    $recordSet->close();
}
$_SESSION['fotoasist'] = $_FILES['fotoasist'];
$_SESSION['fotocurso'] = $_FILES['fotocurso'];

$solVO = new CargaFotosVO(
    "",
    $_POST['idesolicitud'],
    $_POST['idecalendcapacitaciones'],
    $idecapacitacion,
    $_POST['ruc'],
    $_POST['empresa'],
    "",
    "",
    "",
    "",
    "",
    $_SESSION['idecapacitador'],
    ""
    );

$daosol->RegistrarFotos($solVO);

header ("Location: regpersonalxcursofotos.php");
?>