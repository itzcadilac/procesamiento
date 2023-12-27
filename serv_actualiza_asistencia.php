<?php
require_once 'config.php'; 
 
 $oper = $_POST['oper'];
 $select = $_POST['id'];
 $idepersonal = $_POST['idepersonal'];
 $asistencia = $_POST['asistencia'];
 $observaciones = $_POST['observaciones'];
 
 if($oper=='edit'){
 mysql_query("UPDATE personal SET asistencia='".$asistencia."',observaciones='".$observaciones."'  where idepersonal='".$idepersonal."'")
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