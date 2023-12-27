<?php
session_start();
require_once "./conf.php";

$daosol = new CapacitacionDAO();

$solVO = new CapacitacionVO(
    "",
    $_POST['tipcapacitacion'],
    $_POST['diacapacitacion'],
    $_POST['horacapacitacion'],
    "",
    $_POST['capacity'],
    "",
    $_POST['lugar_capacitacion']);

$daosol->AgendarCapacitacion($solVO);

header ("Location: agendarcapacitacion.php");
           
         
?>