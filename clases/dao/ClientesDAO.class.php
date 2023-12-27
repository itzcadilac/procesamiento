<?php

class ClientesDAO{
 
    
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

function RegistrarClientes($requestVO){
    session_start();
    $BD = new ConexionDB();

     
    $pdetail = 1;
    $query = 'INSERT INTO clientes (tipdocumento, documento, nombres, ape_paterno, ape_materno) 
    VALUES ("'.$requestVO->tipdocumento.'", "'.$requestVO->documento.'", UPPER("'.$requestVO->nombres.'"), UPPER("'.$requestVO->ape_paterno.'"), UPPER("'.$requestVO->ape_materno.'"))';
    //echo $query;
    $response = $BD->ejecutar($query);
    
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