<?php
require_once 'config.php'; 
 
 $oper = $_POST['oper'];
 $select = $_POST['id'];
 $idecapacitacion = $_POST['idecapacitacion'];
 $desccapacitacion = $_POST['desccapacitacion'];
 $nombrecorto = $_POST['nombrecorto'];
 $codificacion = $_POST['codificacion'];
 $ideempresa = $_POST['ideempresa'];
 $costo = $_POST['costo'];
 $orden = $_POST['orden'];
 $image = $_POST['image'];
 $estado = $_POST['estado'];
 
 if($oper=='edit'){
 mysql_query("UPDATE tipcapacitaciones SET desccapacitacion=UPPER('".$desccapacitacion."'), nombrecorto=UPPER('".$nombrecorto."'), codificacion=UPPER('".$codificacion."'), ideempresa='".$ideempresa."', costo='".$costo."', orden='".$orden."', image='".$image."', estado='".$estado."' where idecapacitacion='".$idecapacitacion."'")
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