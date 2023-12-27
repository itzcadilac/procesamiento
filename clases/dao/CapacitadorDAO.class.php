<?php

class CapacitadorDAO{
 
    
function ListarCapacitadores(){
    session_start();
    $BD = new ConexionDB();
    $fec = new Fecha();

    $query="SELECT * from solicitudcapac order by idesolicitud DESC";
    
    $recordSet = $BD->ejecutar($query);
    $bandeja = array();

    while($fila=$recordSet->fetch_assoc()) {

    $bandeja[] = new SolicitudVO($fila['idesolicitud'],$fila['idecontratista'],$fila['numparticipantes'],$fila['numcontacto'],"",$fila['correo'],$fila['idetipopago'],$fila['estadosolic'],$fila['numoperpago'],$fila['fechapago'],$fila['horapago']);
    }

    return $bandeja;
}

function ActualizarCapacitador($requestVO){
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

function RegistrarCapacitador($requestVO){
    session_start();
    $BD = new ConexionDB();

     
    $pdetail = 1;
    $query = 'INSERT INTO capacitador (nombres, apepaterno, apematerno, tipdocumento, numdocumento, correo, celular,usuario) 
    VALUES (UPPER("'.$requestVO->nombres.'"), UPPER("'.$requestVO->apepaterno.'"), UPPER("'.$requestVO->apematerno.'"), "'.$requestVO->tipdocumento.'", "'.$requestVO->numdocumento.'", "'.$requestVO->correo.'", "'.$requestVO->celular.'", "'.$requestVO->usuario.'")';
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