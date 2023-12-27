<?php
session_start();
require_once "./conf.php";

$daosol = new SolicitudDAO();

$solVO = new SolicitudVO("",
                        "",
                        $_POST['numpart'],
                        $_POST['numcontac'],
                        $_POST['email'],
                        "",
                        "",
                        "",
                        "",
                        "",
                        $_POST['tipcapacitaciones'],
                        //$capacitaciones,
                        "",
                        $_POST['numruc'],
                        $_POST['razons'],
                        "",
                        $_POST['horario_r'],
                        $_POST['cuposdispo'],
                        "",
                        ""
                        );

$daosol->RegistrarSolicitudExterna($solVO);

/*
$solVO = new PersonalxCapacitacionVO(
    "",
    $_POST['numdocu'],
    $_POST['nombres'],
    $_POST['apepaterno'],
    $_POST['apematerno'],
    "",
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
*/
//header ("Location: regpersonalxcurso.php");
?>