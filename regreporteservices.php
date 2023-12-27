<?php
session_start();
require_once "./conf.php";

$daorep = new ReporteActosDAO();

    $num2 = mt_rand(1,100000000);
    $target_path = "";

	
    //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
	foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
	{
		//Validamos que el archivo exista
		if($_FILES["archivo"]["name"][$key]) {
			$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
			
			$directorio = 'fotos'; //Declaramos un  variable con la ruta donde guardaremos los archivos
			
			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($directorio)){
				mkdir($directorio, 0777, true) or die("No se puede crear el directorio de extracci&oacute;n");	
			}
			//chmod($directorio, 0777, true);

			$dir=opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio.'/'.$num2.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
			
			//Movemos y validamos que el archivo se haya cargado correctamente
			//El primer campo es el origen y el segundo el destino
			move_uploaded_file($source, $target_path);
            chmod($directorio, 0777);
				//echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
				
				//echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
			
			closedir($dir); //Cerramos el directorio de destino
		}
	}
    

$repacVO = new ReporteActosVO(
    "",
    $_POST['idusuario'],
    $_POST['tipreporte'],
    $_POST['idlugar'],
    $_POST['diareporte'],
    $_POST['horareporte'],
    $target_path,
    $_POST['dscreporte'],
    "");

$daorep->RegistroReporteAct($repacVO);

header ("Location: registrareporteactos.php");
                  
?>
