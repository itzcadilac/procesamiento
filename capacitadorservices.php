<?php
session_start();
require_once "./conf.php";

$daocap = new CapacitadorDAO();

$capVO = new CapacitadorVO(
    "",
    $_POST['nombres'],
    $_POST['apepaterno'],
    $_POST['apematerno'],
    $_POST['tipdocumento'],
    $_POST['numdocu'],
    $_POST['correo'],
    $_POST['celular'],
    "",
    $_POST['usuario']
    );

$daocap->RegistrarCapacitador($capVO);

header ("Location: capacitadores.php");
           
         
?>