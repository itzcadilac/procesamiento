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
    $query = 'INSERT INTO personal_induccion (documento, ape_paterno, ape_materno, nombres, cargo, ruc, empresa, fecha, nota, idecapacitacion) 
    VALUES ("'.$requestVO->documento.'", "'.$requestVO->ape_paterno.'", "'.$requestVO->ape_materno.'", "'.$requestVO->nombres.'", "'.$requestVO->cargo.'", "'.$requestVO->ruc.'", "'.$requestVO->empresa.'", "'.$requestVO->fecha.'", "'.$requestVO->nota_final.'", "'.$requestVO->idecalendcapacitaciones.'")';
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

  function Registro_Doc_Cuerpo($requestVO){
    session_start();
    $BD = new ConexionDB();

    //$pdetail = 1;
    $query = 'INSERT INTO documentos_cuerpo (iddocumento_cabecera, idesolicitud, idecalendcapacitaciones, idremitente, idecapacitador, razonsocialdestino, ruc, asunto_documento, tip_documento) 
    VALUES ("'.$requestVO->iddocumento_cabecera.'", "'.$requestVO->idesolicitud.'", "'.$requestVO->idecalendcapacitaciones.'", "'.$requestVO->idremitente.'", "'.$requestVO->idecapacitador.'", "'.$requestVO->razonsocialdestino.'", "'.$requestVO->ruc.'", "'.$requestVO->asunto_documento.'", "'.$requestVO->tip_documento.'")';
    $response = $BD->ejecutar($query);
    //echo $query;
    if (!$response){
        $this->error=mysql_error();
         
        mysql_close();
        return 0;
    }
  
    return 1;
  }

  function Emitir_Informe($requestVO){
    session_start();

    
    /*
    $BD = new ConexionDB();

    //$pdetail = 1;
    $query = 'INSERT INTO personal_induccion (documento, ape_paterno, ape_materno, nombres, cargo, ruc, empresa, fecha, nota, idecapacitacion) 
    VALUES ("'.$requestVO->documento.'", "'.$requestVO->ape_paterno.'", "'.$requestVO->ape_materno.'", "'.$requestVO->nombres.'", "'.$requestVO->cargo.'", "'.$requestVO->ruc.'", "'.$requestVO->empresa.'", "'.$requestVO->fecha.'", "'.$requestVO->nota_final.'", "'.$requestVO->idecalendcapacitaciones.'")';
    $response = $BD->ejecutar($query);
    //echo $query;
    if (!$response){
        $this->error=mysql_error();
         
        mysql_close();
        return 0;
    }
     
     // include  './contactos/contact_otro.php';
     // include  './contactos/contactsst_otro.php';  
  */
  /*
   echo $requestVO->titulodoc;
   echo $requestVO->remitente;
   echo $requestVO->cargoremitente;
   echo $requestVO->razonsoc;
   echo $requestVO->asunto;
   echo $requestVO->fecha;
   echo $requestVO->introduccion;
   echo $requestVO->objetivo;
   echo $requestVO->metodologia;
   echo $requestVO->temario;
   echo $requestVO->fecharesultados;
   echo $requestVO->canthoras;
   echo $requestVO->lugar;
   echo $requestVO->instructor;
   echo $requestVO->cargoinstructor;

 // header ('Location: pdf.php?variable1=".$requestVO->iddocumento_cabecera."&variable2=".$requestVO->iddocumento_cabecera."&variable3=".$requestVO->iddocumento_cabecera."&variable4=".$requestVO->iddocumento_cabecera."&variable5=".$requestVO->iddocumento_cabecera."&variable6=".$requestVO->iddocumento_cabecera."&variable7=".$requestVO->iddocumento_cabecera."&variable8=".$requestVO->iddocumento_cabecera."&variable9=".$requestVO->iddocumento_cabecera."&variable10=".$requestVO->iddocumento_cabecera."');
    header("Location: pdf.php?variable1=".$requestVO->titulodoc."&variable2=".$requestVO->remitente."&variable3=".$requestVO->cargoremitente."&variable4=".$requestVO->razonsoc."&variable5=".$requestVO->asunto."&variable6=".$requestVO->fecha."&variable7=".$requestVO->introduccion."&variable8=".$requestVO->objetivo."&variable9=".$requestVO->metodologia."&variable10=".$requestVO->temario."&variable11=".$requestVO->fecharesultados."&variable12=".$requestVO->canthoras."&variable13=".$requestVO->lugar."&variable14=".$requestVO->instructor."&variable15=".$requestVO->cargoinstructor);

    return 1;
    */
  }

}
?>