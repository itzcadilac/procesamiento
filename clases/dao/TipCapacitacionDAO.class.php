<?php

class CapacitacionDAO{
 
    
function ListarSolicitudes(){
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

function AgendarCapacitacion($requestVO){
    session_start();
    $BD = new ConexionDB();

     
    $pdetail = 1;
    $query = 'INSERT INTO calendcapacitaciones (idecapacitacion, fecha, hora, cupos, cuposdispo, lugar_capacitacion) 
    VALUES ("'.$requestVO->idecapacitacion.'", "'.$requestVO->fecha.' '.$requestVO->hora.'", "'.$requestVO->fecha.' '.$requestVO->hora.'", "'.$requestVO->cupos.'", "'.$requestVO->cupos.'", "'.$requestVO->lugar_capacitacion.'")';
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

function CierreNotas_GuardarPI($requestVO){
    session_start();
    $BD = new ConexionDB();

    //$pdetail = 1;
    $query = 'INSERT INTO personal_induccion (documento, ape_paterno, ape_materno, nombres, ruc, empresa, fecha, nota, idecapacitacion) 
    VALUES ("'.$requestVO->documento.'", "'.$requestVO->ape_paterno.'", "'.$requestVO->ape_materno.'", "'.$requestVO->nombres.'", "'.$requestVO->ruc.'", "'.$requestVO->empresa.'", "'.$requestVO->fecha.'", "'.$requestVO->nota_final.'", "'.$requestVO->idecalendcapacitaciones.'")';
    $response = $BD->ejecutar($query);
    //echo $query;
    if (!$response){
        $this->error=mysql_error();
         
        mysql_close();
        return 0;
    }
     
     // include  './contactos/contact_otro.php';
     // include  './contactos/contactsst_otro.php';  
  
  header ("Location: registrarnotas.php");
  
    return 1;
  }


}
?>