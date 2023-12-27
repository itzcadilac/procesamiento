<?php

//next example will recieve all messages for specific conversation
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

$datos = array(
	0 => $decoded['numeroDocumento'],
	1 => $decoded['nombres'],
	2 => $decoded['apellidoPaterno'],
	3 => $decoded['apellidoMaterno'],
	4 => $decoded['tipoDocumento']
	
);
	echo json_encode($datos);
?>