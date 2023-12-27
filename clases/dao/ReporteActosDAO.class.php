<?php

class ReporteActosDAO{
 
    
function ListarReportesActos($idusuario){
    session_start();
    $BD = new ConexionDB();
    $fec = new Fecha();

    $query="SELECT * from reporteaccon where idusuario = '$idusuario' order by fecregistro DESC";
    
    $recordSet = $BD->ejecutar($query);
    $bandeja = array();

    while($fila=$recordSet->fetch_assoc()) {

    $bandeja[] = new SolicitudVO($fila['idesolicitud'],$fila['idecontratista'],$fila['numparticipantes'],$fila['numcontacto'],"",$fila['correo'],$fila['idetipopago'],$fila['estadosolic'],$fila['numoperpago'],$fila['fechapago'],$fila['horapago']);
    }

    return $bandeja;
}

function RegistrarCapacitacion($requestVO){
    session_start();
    $BD = new ConexionDB();
     
    $query = 'UPDATE calendcapacitaciones SET idecapacitador="'.$requestVO->idecapacitador.'" 
    WHERE idecalendcapacitaciones="'.$requestVO->idecalendcapacitaciones.'"';
    $response = $BD->ejecutar($query);
    //echo $query;
    if (!$response){
        $this->error=mysql_error();
         
        mysql_close();
        return 0;
    }
 

   // mysql_close();
    return 1;
}

function RegistroReporteAct($requestVO){
    session_start();
    $BD = new ConexionDB();

    
     
    $pdetail = 1;
    $query = 'INSERT INTO reporteaccon (descripcion, tip_reporte, idlugar, fecharegistrouser, idusuario, rutaimagenes) 
    VALUES ("'.$requestVO->dscreporte.'", "'.$requestVO->tipreporte.'", "'.$requestVO->idlugar.'", "'.$requestVO->fecharegistrouser.' '.$requestVO->horaregistrouser.'", "'.$requestVO->idusuario.'", "'.$requestVO->rutaimagenes.'")';
    $response = $BD->ejecutar($query);
    //echo $query;
    if (!$response){
        $this->error=mysql_error();
         
        mysql_close();
        return 0;
    }
 

    //mysql_close();
    return 1;
}
}
?>