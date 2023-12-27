<?php
include('importar/dbconect.php');
include('conf.php');
require_once('upload/php-excel-reader/excel_reader2.php');
require_once('upload/SpreadsheetReader.php');
session_start();
$BD = new ConexionDB();
//if (isset($_POST["import"]))
//{

$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'cargas/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);

        $sheetCount = count($Reader->sheets());
        echo $sheetCount;
        //for($i=0;$i<$sheetCount;$i++)
        //{
            
            $Reader->ChangeSheet(0);
            
            $primera = true;
            $segunda = true;
            $tercera = true;
            $cuarta = true;

            foreach ($Reader as $Row)
            {          
                /*
                $idesolcapac = "";
                if(isset($Row[0])) {
                    $idesolcapac = mysqli_real_escape_string($con,$Row[0]);
                    echo "idesolcapac: " .$idesolcapac. "</br>";
                }
                
                $idepersonal = "";
                if(isset($Row[0])) {
                    $idepersonal = mysqli_real_escape_string($con,$Row[0]);
                    echo "idepersonal: " .$idepersonal. "</br>";
                }
				*/

                if($primera){
                    $primera = false;
                    continue;
                }
                if($segunda){
                    $segunda = false;
                    continue;
                }
                if($tercera){
                    $tercera = false;
                    continue;
                }
                if($cuarta){
                    $cuarta = false;
                    continue;
                }

                $documento = "";
                if(isset($Row[0])) {
                    $documento = mysqli_real_escape_string($con,$Row[1]);
                    echo "documento: " .$documento. "</br>";
                }

                $ape_paterno = "";
                if(isset($Row[1])) {
                    $ape_paterno = mysqli_real_escape_string($con,$Row[2]);
                    echo "ape_paterno: " .$ape_paterno. "</br>";
                }

                $ape_materno = "";
                if(isset($Row[2])) {
                    $ape_materno = mysqli_real_escape_string($con,$Row[3]);
                    echo "ape_materno: " .$ape_materno. "</br>";
                }

                $nombres = "";
                if(isset($Row[3])) {
                    $nombres = mysqli_real_escape_string($con,$Row[4]);
                    echo "nombres: " .$nombres. "</br>";
                }

                $cargo = "";
                if(isset($Row[4])) {
                    $cargo = mysqli_real_escape_string($con,$Row[5]);
                    echo "cargo: " .$cargo. "</br>";
                }

                $ruc = "";
                if(isset($Row[5])) {
                    $ruc = mysqli_real_escape_string($con,$Row[6]);
                    echo "ruc: " .$ruc. "</br>";
                }

                $empresa = "";
                if(isset($Row[6])) {
                    $empresa = mysqli_real_escape_string($con,$Row[7]);
                    echo "empresa: " .$empresa. "</br>";
                }

                $fecha = "";
                if(isset($Row[7])) {
                    $fecha = mysqli_real_escape_string($con,$Row[8]);
                    //$var = $feccapac;
                    //$fechacapac = date_format("Y-m-d H:i:s", $feccapac);                  
                    echo "fecha: " .$fecha. "</br>";
                    //echo "var: " .$var. "</br>";
                    //echo "fechacapac: " .$fechacapac. "</br>";
                }

                $nota = "";
                if(isset($Row[8])) {
                    $nota = mysqli_real_escape_string($con,$Row[9]);
                    echo "nota: " .$nota. "</br>";
                }

                $idecapacitacion = "";
                if(isset($Row[9])) {
                    $idecapacitacion = mysqli_real_escape_string($con,$Row[10]);
                    echo "idecapacitacion: " .$idecapacitacion. "</br>";
                }

				/*
                $estadocapac = "";
                if(isset($Row[3])) {
                    $estadocapac = mysqli_real_escape_string($con,$Row[3]);
                    echo "estadocapac: " .$estadocapac. "</br>";
                }
                */
                       
                if ( !empty($idepersonal) || !empty($idecapacitacion)) {
                    //$BD->dbLink->Execute("BEGIN");
                        $query = "insert into personal_induccion(documento, ape_paterno, ape_materno, nombres, cargo, ruc, empresa, fecha, nota, idecapacitacion) 
                        values('".$documento."','".$ape_paterno."','".$ape_materno."','".$nombres."','".$cargo."','".$ruc."','".$empresa."','".$fecha."',".$nota.",".$idecapacitacion.");";
                    //$ret = $BD->dbLink->Execute($query);

                    $ret = $BD->ejecutar($query);

                    echo "query: " .$query. "</br>";
                    
                    if (!$ret){
                        $this->error=mysql_error();
                            //$BD->ejecutar("ROLLBACK");
                           // mysqli_close();
                            return 0;
                    }

                    //mysqli_close();//echo 1;
                    //return 1;

                    /*                                        
                    //$resultados = mysqli_query($con, $query);
                    //$query->execute();
                    echo "notacapac: " .$resultados. "</br>";
                    if (!empty($ret)) {
                        echo "inserción correcta</br>";                        
                        $BD->dbLink->Execute("COMMIT");
                        //mysql_close();//echo 1;
                        //return 1;                        
                        $type = "success";
                        $message = "Excel importado correctamente";

                    } else {
                        echo "inserción errónea</br>";
                        $this->error=mysql_error();
                        $BD->dbLink->Execute("ROLLBACK");
                        //mysql_close();
                        //return 0;
                        $type = "error";
                        $message = "Hubo un problema al importar registros";

                    }
                    */
                }
             }
        
         //}
  }
  else
  { 
        $type = "error";
        $message = "El archivo enviado es invalido. Por favor vuelva a intentarlo";
  }
//}
?>