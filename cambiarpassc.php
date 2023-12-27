<?php
// require 'conexion.php';
require_once "conf.php";

$passact=$_POST['passact'];
$newpass=$_POST['newpass'];
$repass=$_POST['repass'];

$passenc=md5($repass);

$idecapacitador = $_POST['idecapacitador'];
/*
echo "nro_p: " .$nro_p;
echo "newpass: " .$newpass;
echo "repass: " .$repass;
echo "passenc: " .$passenc;
echo "nro_personal: " .$nro_p;
echo "nro_personal: " .$_SESSION['nro_personal'];
*/
if ($newpass != ''){
	
	$conexion = @new mysqli($servid, $user, $passw, $bdsist);
	mysqli_set_charset($conexion, 'utf8');
	
	$querycup = "UPDATE capacitador cap SET cap.password= '$passenc' WHERE cap.idecapacitador = '$idecapacitador';";
	$ret4 = $conexion->query($querycup);
		/*
	if (!$ret4){
        $this->error=mysql_error();
            $BD->dbLink->Execute("ROLLBACK");
            //mysql_close();
            return 0;
    }
   		
		$BD->dbLink->Execute("COMMIT");*/
        //mysql_close();//echo 1;
		header ("Location: changepassc.php");  
		//return 1;
		
}
else{
	echo "No se envío la contraseña Actual.";
}	
?>
