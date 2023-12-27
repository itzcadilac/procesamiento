<?php
 require_once 'config.php';
//next example will recieve all messages for specific conversation
$tipdocumento = $_POST['tipdocumento'];
$dni = $_POST['dni'];
$token = 'apis-token-6281.DCrPSXGnIC3jVCRvBL4xZiFBZCFM4vro';
/*
$service_url = 'https://api.apis.net.pe/v2/reniec/dni?numero='. $dni;
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_HTTPHEADER,array("Authorization: Bearer apis-token-1.aTSI1U7KEuT-6bbbCguH-4Y8TI6KS73N","Content-Type: application/json"));
*/

//Validar si existe el dato en BD
$result = mysql_query("SELECT COUNT(*) AS count FROM clientes where documento = '".$dni."'");
$row = mysql_fetch_array($result,MYSQL_ASSOC);
$count = $row['count'];

if( $count > 0 ) 
{

 $SQL = "SELECT * FROM clientes where documento = '".$dni."'"; 
 $result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error()); 

 $i=0;
 while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
 //$response->rows[$i]['id']=$row[EmployeeID];
 //$datos->rows[$i]['cell']=array($row['documento'],$row['nombres'],$row['ape_paterno'],utf8_encode($row['ape_materno']),$row['tipdocumento']); $i++;

 $datos = array(
	0 => $row['documento'],
	1 => $row['nombres'],
	2 => $row['ape_paterno'],
	3 => $row['ape_materno'],
	4 => $row['tipdocumento']
);
}

 echo json_encode($datos);

}
else 
{

// Iniciar llamada a API
$curl = curl_init();

// Buscar dni
curl_setopt_array($curl, array(
  // para user api versión 2
  CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 2,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Referer: https://apis.net.pe/consulta-dni-api',
    'Authorization: Bearer ' . $token
  ),
));

$curl_response = curl_exec($curl);

if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additional info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response,true);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}

mysql_query("insert into clientes(tipdocumento,documento,nombres,ape_paterno,ape_materno) values('".$decoded['tipoDocumento']."','".$decoded['numeroDocumento']."','".$decoded['nombres']."','".$decoded['apellidoPaterno']."','".$decoded['apellidoMaterno']."')")
or die(mysql_error());	

$datos = array(
	0 => $decoded['numeroDocumento'],
	1 => $decoded['nombres'],
	2 => $decoded['apellidoPaterno'],
	3 => $decoded['apellidoMaterno'],
	4 => $decoded['tipoDocumento']
	
);
	echo json_encode($datos);

}
?>