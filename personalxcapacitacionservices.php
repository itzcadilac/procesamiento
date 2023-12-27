<?php
session_start();
require_once "./conf.php";

$daosol = new PersonalxCapacitacionDAO();

$solVO = new PersonalxCapacitacionVO(
    "",
    $_POST['numdocu'],
    $_POST['nombres'],
    $_POST['apepaterno'],
    $_POST['apematerno'],
    $_POST['cargo'],
    $_POST['ruc'],
    $_POST['empresa'],
    "",
    "",
    "",
    $_POST['idecalendcapacitaciones'],
    "",
    "",
    "",
    "",
    "",
    "",
    "",
    $_POST['idesolicitud']
    );

$daosol->RegistrarPersonalxCapacitacion($solVO);

header ("Location: regpersonalxcurso.php");
?>