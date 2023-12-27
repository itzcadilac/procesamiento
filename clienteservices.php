<?php
session_start();
require_once "./conf.php";

$daosol = new ClientesDAO();

$solVO = new ClientesVO(
    "",
    $_POST['tipdocumento'],
    $_POST['numdocu'],
    $_POST['nombres'],
    $_POST['apepaterno'],
    $_POST['apematerno'],
    ""
    );

$daosol->RegistrarClientes($solVO);

header ("Location: regclientes.php");
?>