<?php

class CargaFotosDAO{
 
    
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

function RegistrarFotos($requestVO){
    session_start();
    $BD = new ConexionDB();

    $pdetail = 1;
    $idcarpeta = $requestVO->idesolicitud;
    $path = "imgdocumentos/". $idcarpeta . "/";
    
    //Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($path)){
				mkdir($path, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
			}
			
    //mkdir($path);
    //chmod($path, 0755);

    $query = 'INSERT INTO foto_solic_capacitacion (idesolicitud, idecalendcapacitaciones, idecapacitacion, ruc, razons, dirfotos, idecapacitador_registro) 
    VALUES ("'.$requestVO->idesolicitud.'", "'.$requestVO->idecalendcapacitaciones.'", "'.$requestVO->idecapacitacion.'", "'.$requestVO->ruc.'", "'.$requestVO->razons.'", "'.$path.'", "'.$requestVO->idecapacitador_registro.'")';
    $response = $BD->ejecutar($query);
    //echo $query;
    if (!$response){
        $this->error=mysql_error();
         
        mysql_close();
        return 0;
    }
    
    $idfotosoliccapacitacion = $BD->dbLink->insert_id;
    //print_r("Último Registro: " . $last_id);

    
    $this->agregarFoto($idfotosoliccapacitacion, $requestVO->ruc, $requestVO->idesolicitud, $_SESSION['fotoasist']);
    $this->agregarFoto1($idfotosoliccapacitacion, $requestVO->ruc, $requestVO->idesolicitud, $_SESSION['fotocurso']);
    //$this->RegistrarFotos2($last_id, $nomfoto);

    //mysql_close();
    return 1;
}

    function agregarFoto($idfotosoliccapacitacion, $ruc, $idesolicitud, $fotoasist)
    {
    $BD = new ConexionDB();
    //$path = getenv('PATH_DOC_AVISOS');
    $idcarpeta = $idesolicitud;
    $path = "imgdocumentos/". $idcarpeta . "/";
    
    $estado = 0;
    $imagen = "";
    

    if ($fotoasist["error"] === 0) {

        $permitidos = array("image/png", "image/jpg", "image/jpeg", "application/pdf");
        $limite_kb = 1024; //1 MB
    
        //if (in_array($fotoasist["type"], $permitidos) && $fotoasist["size"] <= $limite_kb * 1024) {
    if ($fotoasist["type"] == "image/jpeg" || $fotoasist["type"] == "image/jpg" || $fotoasist["type"] == "image/png" || $fotoasist["type"] == "image/svg") {
            //$ruta = 'files/' . $id_insert . '/';
            $archivoNombre = $fotoasist["name"];
            
            $extension = pathinfo($archivoNombre, PATHINFO_EXTENSION);
            $imagen = 'A' . $idesolicitud . '-'. $ruc .'.' . $extension;
            //$archivo = $path . uniqid() . '.' . $extension;
    
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
    
            if (!file_exists($archivo)) {
    
                $resultado = move_uploaded_file($fotoasist["tmp_name"], $path. $imagen);
                //move_uploaded_file($tmp_dir,$path."/".$imagen);
    
                if ($resultado) {
                    $query = 'INSERT INTO foto_solic_capa (idfotosoliccapacitacion, nomfoto, tipo) 
                    VALUES ("'.$idfotosoliccapacitacion.'", "'.$imagen.'", 1)';
                    $response = $BD->ejecutar($query);
                    //echo "Archivo Guardado";
                } else {
                    //echo "Error al guardar archivo";
                }
            } else {
                echo "Archivo ya existe";
            }
        } else {
            echo "Archivo no permitido o excede el tamaño";
        }
    }

    /*
    if (filesize($fotoasist["tmp_name"]) > 0) {            

        if ($fotoasist["type"] == "image/jpeg" || $fotoasist["type"] == "image/jpg" || $fotoasist["type"] == "image/png" || $fotoasist["type"] == "image/svg") {
            
            $name = date("Ymdhis");
            
            $data = $fotoasist['name'];
            $tmp_dir = $fotoasist['tmp_name'];
            $ext = pathinfo($data, PATHINFO_EXTENSION);
            $imagen = $name. '-A' . $idesolicitud . '-'. $ruc .'.' . $ext;
            //redim($fotoasist["tmp_name"], $path.$name.'.'.$ext, 375, 508);
            
            //move_uploaded_file($imagen, $path);
            move_uploaded_file($tmp_dir,$path."/".$imagen);
            chmod($path."/".$imagen, 0645);
            $query = 'INSERT INTO foto_solic_capa (idfotosoliccapacitacion, nomfoto) 
            VALUES ("'.$idfotosoliccapacitacion.'", "'.$imagen.'")';
            $response = $BD->ejecutar($query);
            //echo $query;
            if (!$response){
                $this->error=mysql_error();
                 
                mysql_close();
                return 0;
            }

        } else {
            return 0;
        }
    } else {
        continue;
    }
    */

    return 1;
    
}

function agregarFoto1($idfotosoliccapacitacion, $ruc, $idesolicitud, $fotocurso)
    {
    $BD = new ConexionDB();
    //$path = getenv('PATH_DOC_AVISOS');
    $idcarpeta = $idesolicitud;
    $path = "imgdocumentos/". $idcarpeta ."/";
    
    $estado = 0;
    $imagen = "";
    

    //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
	foreach($fotocurso["tmp_name"] as $key => $tmp_name)
	{
		//Validamos que el archivo exista
		if($fotocurso["name"][$key]) {
			$filename = $fotocurso["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $fotocurso["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
			
            $numcorr = $key + 1;
            $name = date("Ymdhis");

			$directorio = $path; //Declaramos un  variable con la ruta donde guardaremos los archivos
			
			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($directorio)){
				mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
			}
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $imagen = 'C'. $numcorr . '-' . $idesolicitud . '-'. $ruc .'.' . $extension;

			$dir=opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio . $imagen; //Indicamos la ruta de destino, así como el nombre del archivo
			
			//Movemos y validamos que el archivo se haya cargado correctamente
			//El primer campo es el origen y el segundo el destino
			if(move_uploaded_file($source, $target_path)) {	
                $query = 'INSERT INTO foto_solic_capa (idfotosoliccapacitacion, nomfoto, tipo) 
                VALUES ("'.$idfotosoliccapacitacion.'", "'.$imagen.'", 2)';
                $response = $BD->ejecutar($query);

				echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
				} else {	
				echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
			}
			closedir($dir); //Cerramos el directorio de destino
		}
	}



    /*
    if (filesize($fotocurso["tmp_name"]) > 0) {            

        if ($fotocurso["type"] == "image/jpeg" || $fotocurso["type"] == "image/jpg" || $fotocurso["type"] == "image/png" || $fotocurso["type"] == "image/svg") {
            
            $name = date("Ymdhis");
            
            $data = $fotocurso['name'];
            $tmp_dir = $fotocurso['tmp_name'];
            $ext = pathinfo($data, PATHINFO_EXTENSION);
            $imagen = $name. '-C' . $idesolicitud . '-'. $ruc .'.' . $ext;
            //redim($fotocurso["tmp_name"], $path.$name.'.'.$ext, 375, 508);
            
            //move_uploaded_file($imagen, $path);
            move_uploaded_file($tmp_dir,$path."/".$imagen);
            chmod($path."/".$imagen, 0645);
            $query = 'INSERT INTO foto_solic_capa (idfotosoliccapacitacion, nomfoto) 
            VALUES ("'.$idfotosoliccapacitacion.'", "'.$imagen.'")';
            $response = $BD->ejecutar($query);
            //echo $query;
            if (!$response){
                $this->error=mysql_error();
                 
                mysql_close();
                return 0;
            }

        } else {
            return 0;
        }
    } else {
        continue;
    }
    */
    return 1;
    
}

function SubirFotos($idfotosoliccapacitacion,$idesolicitud, $fotoasist, $fotocurso){
    //mandar imagenes
    $postback=$_POST['postback'];
    $idcarpeta = $idesolicitud;
    $ruta = "imgdocumentos/". $idcarpeta;
    if ($postback) {
       extract($_POST);
       $archivos = '';
       $msg = "Mensaje Enviado";
       $cout=0;    
       if (isset ($_FILES["archivos"])) {
//              $msg .= "<ul>";
          
          $BD = new ConexionDB();
//              $query2="select ruta from expediente where idexpediente=".$idexpediente;
//              $result2 = $BD->ejecutar($query2);             
//              $fila = $result2->fetch_assoc();
         if(!file_exists($ruta))
            {
            //chmod($ruta,0777); 
            mkdir ($ruta);
            foreach ($_FILES["archivos"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
              $tmp_name = $_FILES["archivos"]["tmp_name"][$key];
              $name = $_FILES["archivos"]["name"][$key];
              $name = $_SESSION['idexpediente']."-".$name;
              $msg .= "<li>$name</li>";
              move_uploaded_file($tmp_name, "imgdocumentos/$idcarpeta/$name");
              $query = "INSERT INTO imagenes(idexpediente,nomfoto) VALUES ('".$_SESSION['idexpediente']."','".$name."')";
              $result = $BD->ejecutar($query); 
            //echo "Se ha creado el directorio: " . $ruta;
            } 
            }
            }
            
        else {
            //echo "la ruta: " . $ruta . " ya existe ";
        foreach ($_FILES["archivos"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
              $tmp_name = $_FILES["archivos"]["tmp_name"][$key];
              $name = $_FILES["archivos"]["name"][$key];
              $name = $_SESSION['idexpediente']."-".$name;
              $msg .= "<li>$name</li>";
              move_uploaded_file($tmp_name, "imgdocumentos/$idcarpeta/$name");
              $query = "INSERT INTO imagenes(idexpediente,nomfoto) VALUES ('".$_SESSION['idexpediente']."','".$name."')";
              $result = $BD->ejecutar($query);             
            //  echo $query;                    
            } #if
            
          }
            } 
# foreach

       } # if
    }
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