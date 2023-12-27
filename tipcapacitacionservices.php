<?php
session_start();
require_once "./conf.php";

$daosol = new ParihuelaDAO();

$solVO = new ParihuelaVO(
    "",
    $_POST['descripcionparihuela'],
    $_POST['peso'],
    ""
);

$daosol->RegistrarParihuela($solVO);

header ("Location: parihuelas.php");
           
         
?>