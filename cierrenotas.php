<?php
require_once 'config.php'; 
require_once "./conf.php";

$daocap = new CapacitacionDAO();
$BD = new ConexionDB();
 
 //$oper = $_POST['oper'];
 //$select = $_POST['id'];
 $idecalendcapacitaciones = $_POST['horario_r'];
 //$asistencia = $_POST['asistencia'];
 //$observaciones = $_POST['observaciones'];
 
 //if($oper=='edit'){
 mysql_query("UPDATE calendcapacitaciones SET notascerradas = 1 where idecalendcapacitaciones = '".$idecalendcapacitaciones."'")
 or die(mysql_error());

 mysql_query("UPDATE personal SET fecha = DATE_FORMAT(CURDATE(), '%Y-%m-%d') where idecalendcapacitaciones = '".$idecalendcapacitaciones."'")
 or die(mysql_error());

$query1="SELECT pe.*, cc.hora as fechacapa, cc.idecapacitacion FROM personal pe, calendcapacitaciones cc WHERE pe.idecalendcapacitaciones = cc.idecalendcapacitaciones AND pe.idecalendcapacitaciones = '".$idecalendcapacitaciones."' AND pe.nota_final > 14 ";

$query='SELECT 
 per.idesolicitud AS idesolicitud, 
 cal.idecalendcapacitaciones AS idecalendcapacitaciones, 
 cap.idecapacitador AS idecapacitador, 
 per.empresa AS empresa, 
 per.ruc AS ruc, 
 CONCAT("Informe de Servicio ", tip.desccapacitacion) AS asunto_documento, 
 1 AS tip_documento, 
 tip.desccapacitacion, 
 tip.nombrecorto, 
 cal.hora 
 from 
 personal per, 
 tipcapacitaciones tip, 
 calendcapacitaciones cal, 
 capacitador cap 
 where cal.idecalendcapacitaciones = per.idecalendcapacitaciones 
 AND tip.idecapacitacion = cal.idecapacitacion 
 AND cap.idecapacitador = cal.idecapacitador 
 AND per.idecalendcapacitaciones = '.$idecalendcapacitaciones.'  
 GROUP BY per.ruc;
 ';
 
 if ($recordSet = $BD->ejecutar($query)){
     while ($fila = $recordSet->fetch_assoc()) {
          
 $query2 = 'INSERT INTO documentos_cabecera (numdocumento) 
 VALUES ("'.$idecalendcapacitaciones.'")';  
 $response = $BD->ejecutar($query2);
 $id =  $BD->dbLink->insert_id;

 $result = mysql_query("SELECT cap.idecapacitador as idecoordinador FROM capacitador cap WHERE tipo = 80 ");

 $row = mysql_fetch_array($result,MYSQL_ASSOC);
 $idecoordinador = $row['idecoordinador'];

         $solVO = new CuerpoInformesVO(
             $id,
             $fila['idesolicitud'],
             $fila['idecalendcapacitaciones'],
             $idecoordinador,
             $fila['idecapacitador'],
             $fila['empresa'],
             $fila['ruc'],
             $fila['asunto_documento'],
             $fila['tip_documento']         
             );
         
         $daocap->Registro_Doc_Cuerpo($solVO);    
     
     }
 
     $recordSet->close();
 }

 //if($oper=='edit'){
 //mysql_query("UPDATE calendcapacitaciones SET estado = 0 where idecalendcapacitaciones = '".$idecalendcapacitaciones."'")
 //or die(mysql_error());

if ($recordSet = $BD->ejecutar($query1)){
    while ($fila = $recordSet->fetch_assoc()) {
        //$desccapacitacion=$fila['desccapacitacion'];
        //$horario=$fila['hora'];
    
        $solVO = new PersonalxCapacitacionVO(
            "",
            $fila['documento'],
            $fila['nombres'],
            $fila['ape_paterno'],
            $fila['ape_materno'],
            $fila['cargo'],
            $fila['ruc'],
            $fila['empresa'],
            "",
            "",
            $fila['nota_final'],
            $fila['idecapacitacion'],
            $fila['fechacapa'],
            "",
            "",
            "",
            "",
            "",
            "",
            ""
            );
        
        $daocap->CierreNotas_GuardarPI($solVO);    
    
    }

    $recordSet->close();
}

?>