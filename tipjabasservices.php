<?php
session_start();
require_once "./conf.php";

$daosol = new JabaDAO();

$solVO = new JabaVO(
    "",
    $_POST['descripcionjaba'],
    $_POST['peso'],
    ""
);

$daosol->RegistrarJaba($solVO);

header ("Location: jabas.php");
           
         
?>