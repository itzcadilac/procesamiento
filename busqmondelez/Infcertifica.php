<?php
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
header('Content-Type: text/html; charset=UTF-8');  
// Introducimos HTML de prueba
$v1=$_GET['variable1'];
$v2=$_GET['variable2'];
$v3=$_GET['variable3'];
$v4=$_GET['variable4'];
$v5=$_GET['variable5'];
$v6=$_GET['variable6'];
$v7=$_GET['variable7'];
$v8=$_GET['variable8'];
$v9=$_GET['variable9'];
$v10=$_GET['variable10'];
$html = '
<head>

<style>   
      body{
        font-family: Myriad Pro;
      }
</style>

<style>
    #watermark { position: fixed; bottom: 0px; right: 0px; width: 800px; height: 800px; text-align: center; opacity: .6; }
</style>

</head>

<body>
<div id="watermark"><img src="draft.png" height="100%" width="100%"></div>
<div style="position: fixed; left: 0px; top: -45px; right: 0px; bottom: 50px; text-align: center;z-index: -1000; ">
  <img src="certific.jpeg" style="width: 1120px;">
</div>

  <div style="margin-top: 250px;font-size: 32px;text-align: center;font-weight: 700;"><strong><b>' .$v3. '</b></strong></div>
  <div style="position: relative; margin-top: 5px;font-size: 35px; margin-left: 290px; font-weight: 700;"><b>' .$v4.  '</b></div>
  <div style="margin-top: 10px;font-size: 16px;text-align: center; margin-left: 160px;margin-right: 110px;">' .$v6.  '</div>
  <div style="margin-top: 82px;font-size: 14px; margin-left: 730px; text-align: center;">' .$v8.  ' </div>
  <div style="position: absolute; margin-top: 0px;margin-bottom: 0px;font-size: 14px; margin-left: 840px; text-align: center;">' .$v9.  ' </div>
  <div style="position: absolute; margin-top: 160px;font-size: 12px; margin-left: 875px; text-align: center;">' .$v5.  ' - ' .$v7.  ' - ' .$v2.  '</div>


</body>
';
 
// Instanciamos un objeto de la clase DOMPDF.
$pdf = new DOMPDF();
 
// Definimos el tamaño y orientación del papel que queremos.
$pdf->set_paper("A4", "landscape");
 
// Cargamos el contenido HTML.
//$pdf->load_html(utf8_decode($html));
$pdf->load_html($html);
 
// Renderizamos el documento PDF.
$pdf->render();
 
// Enviamos el fichero PDF al navegador.
$pdf->stream('Certificado.pdf');