<?php
require_once 'config.php'; 
 
 $oper = $_POST['oper'];
 $select = $_POST['id'];
 $idecapacitador = $_POST['idecapacitador'];
 $nombres = $_POST['nombres'];
 $apepaterno = $_POST['apepaterno'];
 $apematerno = $_POST['apematerno'];
 $tipdocumento = $_POST['tipdocumento'];
 $numdocumento = $_POST['numdocumento'];
 $correo = $_POST['correo'];
 $celular = $_POST['celular'];
 $estado = $_POST['estado'];
 
 if($oper=='edit'){
 mysql_query("UPDATE capacitador SET nombres=UPPER('".$nombres."'), apepaterno=UPPER('".$apepaterno."'), apematerno=UPPER('".$apematerno."'), tipdocumento='".$tipdocumento."', numdocumento='".$numdocumento."', correo='".$correo."', celular='".$celular."', estado='".$estado."' where idecapacitador='".$idecapacitador."'")
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