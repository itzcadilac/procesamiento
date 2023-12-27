<?php
require_once 'config.php'; 
 
 $oper = $_POST['oper'];
 $select = $_POST['id'];
 $idecalendcapacitaciones = $_POST['idecalendcapacitaciones'];
 $cupos = $_POST['cupos'];
 $cuposdispo = $_POST['cuposdispo'];
 $lugar_capacitacion = $_POST['lugar_capacitacion'];
 $estado = $_POST['estado'];
 
 if($oper=='edit'){
 mysql_query("UPDATE calendcapacitaciones SET cupos='".$cupos."', cuposdispo='".$cuposdispo."', lugar_capacitacion='".$lugar_capacitacion."', estado='".$estado."'  where idecalendcapacitaciones='".$idecalendcapacitaciones."'")
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