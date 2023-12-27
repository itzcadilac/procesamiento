<?php
class SolicitudDAO{
   
    function ListarSolicitudes(){
        session_start();
        $BD = new ConexionDB();
        $fec = new Fecha();
        $query="SELECT * from solicitudcapac order by idesolicitud ASC";	 
        $recordSet = $BD->ejecutar($query);
        $bandeja = array();
        while($fila=$recordSet->fetch_assoc()) {    
          $bandeja[] = new SolicitudVO($fila['idesolicitud'],$fila['idecontratista'],$fila['numparticipantes'],$fila['numcontacto'],"",$fila['correo'],$fila['idetipopago'],$fila['estadosolic'],$fila['numoperpago'],$fila['fechapago'],$fila['horapago']);
        }
          return $bandeja;
   }

    function RegistrarSolicitud($solVO){
        session_start();

        $BD = new ConexionDB();        
        if($_SESSION['idAutorizador'] == null || $_SESSION['idAutorizador'] == 0){
          $query = 'INSERT INTO solicitudcapac (idecontratista,numparticipantes,numcontacto,correo,idetipopago,estadosolic, ideempresa, ruc, razons, id_autorizador, idecalendcapacitaciones, numoc) 
          VALUES ("'.$solVO->idecontratista.'", "'.$solVO->numparticipantes.'", "'.$solVO->numcontacto.'", "'.$solVO->correo.'", "'.$solVO->idetipopago.'", 6, '.$solVO->ideempresa.', "'.$solVO->ruc.'", "'.$solVO->razons.'", 0, '.$solVO->horario_r.', "'.$solVO->numoc.'")';
          $queryback = 'INSERT INTO solicitudcapac_back (idecontratista,numparticipantes,numcontacto,correo,idetipopago,estadosolic, ideempresa, ruc, razons, id_autorizador, idecalendcapacitaciones, numoc) 
          VALUES ("'.$solVO->idecontratista.'", "'.$solVO->numparticipantes.'", "'.$solVO->numcontacto.'", "'.$solVO->correo.'", "'.$solVO->idetipopago.'", 6, '.$solVO->ideempresa.', "'.$solVO->ruc.'", "'.$solVO->razons.'", 0, '.$solVO->horario_r.', "'.$solVO->numoc.'")';
        }
        else{
          $query = 'INSERT INTO solicitudcapac (idecontratista,numparticipantes,numcontacto,correo,idetipopago,estadosolic, ideempresa, ruc, razons, id_autorizador, idecalendcapacitaciones, numoc) 
          VALUES ("'.$solVO->idecontratista.'", "'.$solVO->numparticipantes.'", "'.$solVO->numcontacto.'", "'.$solVO->correo.'", "'.$solVO->idetipopago.'", 5, '.$solVO->ideempresa.', "'.$solVO->ruc.'", "'.$solVO->razons.'", '.$solVO->idAutorizador.', '.$solVO->horario_r.', "'.$solVO->numoc.'")';  
          $queryback = 'INSERT INTO solicitudcapac_back (idecontratista,numparticipantes,numcontacto,correo,idetipopago,estadosolic, ideempresa, ruc, razons, id_autorizador, idecalendcapacitaciones, numoc) 
          VALUES ("'.$solVO->idecontratista.'", "'.$solVO->numparticipantes.'", "'.$solVO->numcontacto.'", "'.$solVO->correo.'", "'.$solVO->idetipopago.'", 5, '.$solVO->ideempresa.', "'.$solVO->ruc.'", "'.$solVO->razons.'", '.$solVO->idAutorizador.', '.$solVO->horario_r.', "'.$solVO->numoc.'")';  
        } 
        $response = $BD->ejecutar($query);
        $response_back = $BD->ejecutar($queryback);
        $id =  $BD->dbLink->insert_id;

        $id1 = mysqli_insert_id($BD->dbLink);
        $_SESSION['idesolicitud_correo'] = $id;

        $queryCap = 'INSERT INTO soliccapac (idesolicitud, idecapacitacion, idecalendcapacitaciones) VALUES ('.$id.', '.$solVO->idecapacitaciones.', '.$solVO->horario_r.')';
        $responseCapacitation = $BD->ejecutar($queryCap);     
        $numpart = $solVO->numparticipantes;
        $cupsdisp = $solVO->cuposdispo;        
        $varcups =  $cupsdisp - $numpart;        
        $querycup = "UPDATE calendcapacitaciones SET cuposdispo= $varcups WHERE idecalendcapacitaciones = '$solVO->horario_r'";
        $ret3 = $BD->ejecutar($querycup);

        if (!$response){
            $this->error=mysql_error();
                mysqli_close();
                return 0;
        }

        if($_SESSION['idAutorizador'] > 0){
          
          include  './contactos/contactaut.php';
          include  './contactos/contact.php';
          include  './contactos/contactsst_nestle.php';  
      }
      else {
          
          include  './contactos/contact_otro.php';
          include  './contactos/contactsst_otro.php';  
        
      }

      header ("Location: registrosolicitud.php?registro=true");

        return 1;
  } 

  function ConsultaCupos($numpart){
    session_start();
    $BD = new ConexionDB();
    $query="SELECT cuposdispo FROM calendcapacitaciones WHERE idecalendcapacitaciones = '$numpart';";	 
    $recordSet = $BD->ejecutar($query);
    $bandeja = array();
    while($fila=$recordSet->fetch_assoc()) {    
      $bandeja[] = new CuposVO($fila['cuposdispo']);
    }
      return $bandeja;
}

function RegistrarSolicitudExterna($solVO){
  session_start();

  $BD = new ConexionDB();        

    $query = 'INSERT INTO solicitudcapac (numparticipantes,numcontacto,correo,estadosolic, ruc, razons, idecalendcapacitaciones) 
    VALUES ("'.$solVO->numparticipantes.'", "'.$solVO->numcontacto.'", "'.$solVO->correo.'", 5, "'.$solVO->ruc.'", "'.$solVO->razons.'", '.$solVO->horario_r.')';  
    $queryback = 'INSERT INTO solicitudcapac_back (numparticipantes,numcontacto,correo,estadosolic, ruc, razons, idecalendcapacitaciones) 
    VALUES ("'.$solVO->numparticipantes.'", "'.$solVO->numcontacto.'", "'.$solVO->correo.'", 5, "'.$solVO->ruc.'", "'.$solVO->razons.'", '.$solVO->horario_r.')';  
  
  $response = $BD->ejecutar($query);
  $response_back = $BD->ejecutar($queryback);  
  $id =  $BD->dbLink->insert_id;
  $id1 = mysqli_insert_id($BD->dbLink);
  $_SESSION['idesolicitud_correo'] = $id;
  
  $queryCap = 'INSERT INTO soliccapac (idesolicitud, idecapacitacion, idecalendcapacitaciones) VALUES ('.$id.', '.$solVO->idecapacitaciones.', '.$solVO->horario_r.')';
  $responseCapacitation = $BD->ejecutar($queryCap);      

  $numpart = $solVO->numparticipantes;
  $cupsdisp = $solVO->cuposdispo;        
  $varcups =  $cupsdisp - $numpart;        
  $querycup = "UPDATE calendcapacitaciones SET cuposdispo= $varcups WHERE idecalendcapacitaciones = '$solVO->horario_r'";
  $ret3 = $BD->ejecutar($querycup);

  if (!$response){
      $this->error=mysql_error();
          mysqli_close();
          return 0;
  }
   
   // include  './contactos/contact_otro.php';
   // include  './contactos/contactsst_otro.php';  

header ("Location: registrosolicitudexterna.php");

  return 1;
}

}
?>