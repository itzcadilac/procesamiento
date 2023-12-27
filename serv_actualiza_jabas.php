<?php
require_once 'config.php'; 
 
 $oper = $_POST['oper'];
 $select = $_POST['id'];
 $idtipjaba = $_POST['idtipjaba'];
 $descripcionjaba = $_POST['descripcionjaba'];
 $peso = $_POST['peso'];
 /*
 $codificacion = $_POST['codificacion'];
 $ideempresa = $_POST['ideempresa'];
 $costo = $_POST['costo'];
 $orden = $_POST['orden'];
 $image = $_POST['image'];*/
 $estado = $_POST['estado'];
 
 if($oper=='edit'){
 mysql_query("UPDATE tipo_jaba SET descripcionjaba=UPPER('".$descripcionjaba."'), peso=UPPER('".$peso."'), estado='".$estado."' where idtipjaba='".$idtipjaba."'")
 or die(mysql_error());
 //mysql_close($db);
 }
/*
 else if($oper=='del'){
 mysql_query("delete from documentos where iddocumento='".$select."'")
 or die(mysql_error());
 //mysql_close($db);
 }
 else if($oper=='add'){
 mysql_query("insert into documentos(iddocumento,detalledocumento) values('".$iddocumento."','".$detalledocumento."')")
 or die(mysql_error());	
 }*/
?>