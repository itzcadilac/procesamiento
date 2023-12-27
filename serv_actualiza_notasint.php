<?php
require_once 'config.php'; 
 
 $oper = $_POST['oper'];
 $select = $_POST['id'];
 $idepersonal = $_POST['idepersonal'];
 $cargo = $_POST['cargo'];
 $observaciones = $_POST['observaciones'];
 //$nota_teorica = $_POST['nota_teorica'];
 //$nota_practica = $_POST['nota_practica'];
 $nota_final = $_POST['nota_final'];

 //$nota_final = ($nota_teorica + $nota_practica)/2;

 
 if($oper=='edit'){
 mysql_query("UPDATE personal SET nota_final='".$nota_final."', cargo=UPPER('".$cargo."'), observaciones=UPPER('".$observaciones."') where idepersonal='".$idepersonal."'")
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