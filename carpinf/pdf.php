<?php
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
session_start();

//header('Content-Type: text/html; charset=UTF-8');  

$v1=$_SESSION['titulodoc'];
$v2=$_SESSION['remitente'];
$v3=$_SESSION['cargoremitente'];
$v4=$_SESSION['razonsoc'];
$v5=$_SESSION['asunto'];
$v6=$_SESSION['fecha'];
$v7=$_SESSION['introduccion'];
$v8=$_SESSION['objetivo'];
$v9=$_SESSION['metodologia'];
$v10=$_SESSION['temario'];
$v11=$_SESSION['fecharesultados'];
$v12=$_SESSION['canthoras'];
$v13=$_SESSION['lugar'];
$v14=$_SESSION['instructor'];
$v15=$_SESSION['cargoinstructor'];

$html = '
<html>
    <head>
        <style>
    @page {
        margin: 0cm 0cm;
    }			

    /** Define now the real margins of every page in the PDF **/
    body {
        margin-top: 4.5cm;
        margin-left: 2cm;
        margin-right: 2cm;
        margin-bottom: 2cm;
		font-family: Helvetica;
    }

    /** Define the header rules **/
    header {
        position: fixed;
        top: 0.5cm;
        left: 0.5cm;
        right: 0cm;
        height: 50px;
		width: 100%;
    }
	


    /** Define the footer rules **/
    footer {
        position: fixed; 
        bottom: 0.5cm; 
        left: 0cm; 
        right: 0cm;
        height: 50px;
		width: 100%;
    }
			
		.vertical {
			border-right: 2px solid #438eb9;
			height: 50px;
		}


.titulo{
	margin:0 0 0 0;
	font-size:17px;
	text-decoration:underline;
	text-align:center;
	color:#373643;
	font-weight:bold;
	text-transform:uppercase!important;
}

.complementario{
	margin:5px 0 0 0;
	font-size:12px;
	text-transform:uppercase;
	color:#373643;
	font-weight:400;
	text-align:justify;
	text-transform:uppercase!important;
}
#watermark { position: absolute; bottom: 0px; right: 0px; text-align: center; opacity: .2; }

/*
.fecha{margin:5px;font-size:16px;color:#373643;font-weight:400;text-align:center;}
.tabla_sismo th{background:#CCC;font-weight: 400;}

.tabla_pacientes{text-align:center;width:300pt;text-transform:uppercase!important;font-size: 11px;font-family: Helvetica;}
.tabla_pacientes th{border:0.5px solid #000000;color:#FFFFFF;background:#477de0;padding:5px;font-size:11px;font-weight: 400;}
.tabla_pacientes td{border:0.5px solid #000000;padding:5px;font-size:11px;}

.tabla_fallecidos{margin:auto;text-align:center;font-size: 11px;font-family: Helvetica;}
.tabla_fallecidos th{border:0.5px solid #000000;color:#FFFFFF;background:#477de0;padding:5px;font-weight: 400;}
.tabla_fallecidos td{border:0.5px solid #000000;padding:5px;}
.tabla_fallecidos th.alternativo{background:#7AAEe4;}

.tabla_observaciones{margin:auto;text-align:center;font-size: 11px;font-family: Helvetica;}
.tabla_observaciones th{border:0.5px solid #000000;color:#FFFFFF;background:#477de0;padding:5px;font-weight: 400;}
.tabla_observaciones td{border:0.5px solid #000000;padding:5px;}

.lesionados{width: 100%;padding:0;border:0px;text-transform:uppercase!important;font-size: 11px;font-family: Helvetica;}
.lesionados th{border:0px;padding:1px 5px;text-transform:uppercase!important;font-weight: 400;}
.lesionados td{border:0px;padding:1px 5px;text-transform:uppercase!important;}
.movilizados{margin-left: 20px;padding:1px 5px;border:0px;text-transform:uppercase!important;font-size: 11px;font-family: Helvetica;}
.movilizados th{border:0px;padding:1px 5px;text-align:left;text-transform:uppercase!important;font-weight: 400;}

.tabla_acciones { margin-bottom: 5px;font-family: Helvetica;}
.tabla_acciones .acciones_content {margin-bottom: 10px;font-size: 11px;}
.tabla_acciones .acciones-cabecera{padding: 2px 10px 2px 10px;font-weight: bold;text-align: left;font-size:11px;background:#CDDFF8;font-weight: 400;}
.tabla_acciones .acciones-descripcion{padding: 2px 10px 10px 10px;font-size:11px;text-align: justify;}

.galeria{margin:auto;width:404px;text-transform:uppercase!important;}
*/

.tabla_ubicacion,.tabla_sismo{width: 100%;text-align:center;text-transform:uppercase!important;font-size: 11px;font-family: Helvetica;}
.tabla_ubicacion th,.tabla_sismo th{text-transform: capitalize;border:0.5px solid #000000;color:#FFFFFF;background:#477de0;padding:5px;font-weight: 400;}
.tabla_ubicacion td,.tabla_sismo td{border:0.5px solid #000000;padding:5px;}

.bold{font-weight:bold;}

 .footer-margin {
    margin: 1px 1px 3px 1px;
 }

</style>
</head>

    <body>
	
		<header>
			
			<table cellspacing="0" style="width: 100%;font-size: 9px;border-top:0.0px solid #AAA;">
			<tr>
            <td style="margin:0 0 10px 0;padding-top: 10px;width: 40%;text-align:center" rowspan="2">
           		<img src="logo.png" border="0" />
            </td>
			</tr>
			</table>
        </header>

        <footer>
			
            <table cellspacing="0" style="width: 100%;font-size: 10px;height: 50px;border-top:0.5px solid #438eb9;">
				<tr>
					<td style="padding-top: 5px;">
					</td>
											
					<td style="padding-left: 5px;padding-top: 5px;">
					<p class="footer-margin">Calle General Artigas 960</p>
					<p class="footer-margin">Pueblo Libre</p>
					<a href="http://www.sstasesores.pe/" target="_blank" style="margin-top:0px;">www.sstasesores.pe</a>
					</td>
					<td style="vertical-align: top;margin-top:0;padding-top: 5px;">
						<div class="vertical"></div>
					</td>
					<td style="padding-left: 10px;padding-top: 5px;">
					<p class="footer-margin" style="margin-top:0px;">info@sstasesores.pe</p>
					<p class="footer-margin">T: (01) 396-7112</p>
					<p class="footer-margin">Telf. (511) 611 9930</p>
					</td>
				</tr>

    		</table>
			<table >
				<tr>
					<td>
						<img src="imgfooter.png" border="0"  />
					</td>
				</tr>
			</table>    
			
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
		
	<div style="text-align:center">
		<div id="watermark"><img src="logo.png" ></div>
		<h4 style="margin:0 0 0 0;font-size:23px;text-decoration:underline;text-align:center">
			<strong>' .$v1. '</strong>
		</h4>
		<br />
		<table>
			<tbody>
				<tr HEIGHT = "15">
					<td WIDTH="15%"><b>DE</b></td>
					<td WIDTH="10%"><b>:</b></td>
					<td WIDTH="85%"><b>' .$v2. '</b></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><b>' .$v3. '</b></td>
				</tr>
				<tr>
					<td><b>PARA</b></td>
					<td><b>:</b></td>
					<td><b>' .$v4. '</b></td>
				</tr>
				<tr>
					<td><b>ASUNTO</b></td>
					<td><b>:</b></td>
					<td><b>' .$v5. '</b></td>
				</tr>
				<tr>
					<td><b>FECHA</b></td>
					<td><b>:</b></td>
					<td><b>' .$v6. '</b></td>
				</tr>
			</tbody>
		</table>
	<div>
	<hr>

	<table border="0" cellpadding="0" cellspacing="0" style="position: relative;">
		<tr>
			<td style="width: 500px;vertical-align: top;">
				<h4>1. INTRODUCCIÓN</h4>
				 ' .$v7. '
			</td>
		</tr>
	</table>
	
	<table border="0" cellpadding="0" cellspacing="0" style="position: relative;">
		<tr>
			<td style="width: 500px;vertical-align: top;">
            	<h4>2. OBJETIVO DEL SERVICIO</h4>
				' .$v8. '
			</td>
		</tr>
	</table>
	<table border="0" cellpadding="0" cellspacing="0" style="position: relative;">
		<tr>
			<td style="width: 500px;vertical-align: top;">
            	<h4>3. METODOLOGÍA</h4>
				' .$v9. '
			</td>
		</tr>
	</table>	
	<table border="0" cellpadding="0" cellspacing="0" style="position: relative;">
		<tr>
			<td style="width: 500px;vertical-align: top;">			
				<h4>4. TEMARIO</h4>
				' .$v10. '
			</td>
		</tr>
	</table>
	<table border="0" cellpadding="0" cellspacing="0" style="position: relative;">
		<tr>
			<td style="width: 500px;vertical-align: top;">
				<h4>5. RESULTADOS</h4>
				<p style="font-size:12px;text-align:justify;width: 100%;">
				<h2 class="complementario"><b>FECHA: </b> ' .$v11. '</h2>
				<h2 class="complementario"><b>DURACIÓN: </b> ' .$v12. '</h2>
				<h2 class="complementario"><b>LUGAR: </b> ' .$v13. '</h2>
				<h2 class="complementario"><b>INSTRUCTOR: </b>' .$v14. '</h2>
				</p>
				
				<p style="font-size:12px;text-align:justify;width: 100%;">
					Se contó con la participación de ' .$v15. ' colaborador(es) capacitado(s) y aprobado(s):
				</p>
								
				<table cellpadding="0" cellspacing="0" class="tabla_ubicacion" style="margin: auto;position: relative;">
            		<thead>
            			<tr>
							<th>N°</th>
                			<th>DOCUMENTO</th>
                			<th>APELLIDO PATERNO</th>
                			<th>APELLIDO MATERNO</th>
							<th>NOMBRES</th>
                			<th>FECHA</th>
                			<th>NOTA</th>
                		</tr>
            		</thead>
            		<tbody>
            			<tr>
            				<td>1</td>
            				<td>003089602</td>
            				<td>HERNANDEZ</td>
							<td>MUÑOZ</td>
            				<td>KENDALL NINIBETH</td>
            				<td>03/11/2023</td>
							<td>20</td>
            			</tr>
            		</tbody>
            	</table>
			</td>
		</tr>
	</table>		
	<table border="0" cellpadding="0" cellspacing="0" style="position: relative;">
		<tr>
			<td style="width: 500px;vertical-align: top;">
				
				<h4>6. EVIDENCIA FOTOGRÁFICA</h4>

			</td>
		</tr>
	</table>


			<!--
			<td style="width: 210px;position: relative;">
				<table style="width:202px;height: 282px;position: relative;">
					<tr>
					<td>
						<img style="border: 1px solid #ccc;" src="" width="200" height="280" />
						<img style="position: absolute;bottom:0;right:0;" src="" width="80" height="112" />
					</td>
					</tr>
				</table>
			</td>
			-->
	
        </main>
    </body>
</html>	
';

?>
<?php

// Instanciamos un objeto de la clase DOMPDF.
$pdf = new DOMPDF();

//ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
$pdf->set_option('isRemoteEnabled', TRUE);

// Cargamos el contenido HTML.
//$pdf->load_html(utf8_decode($html));
$pdf->load_html($html);

// Definimos el tamaño y orientación del papel que queremos.
$pdf->set_paper('A4', 'portrait');
 
// Renderizamos el documento PDF.
$pdf->render();
 
// Enviamos el fichero PDF al navegador.
//$pdf->stream('Informe.pdf');

$pdf->stream("Informe", array("Attachment" => true));


unset($_SESSION['titulodoc']);
unset($_SESSION['remitente']);
unset($_SESSION['cargoremitente']);
unset($_SESSION['razonsoc']);
unset($_SESSION['asunto']);
unset($_SESSION['fecha']);
unset($_SESSION['introduccion']);
unset($_SESSION['objetivo']);
unset($_SESSION['metodologia']);
unset($_SESSION['temario']);
unset($_SESSION['fecharesultados']);
unset($_SESSION['canthoras']);
unset($_SESSION['lugar']);
unset($_SESSION['instructor']);
unset($_SESSION['cargoinstructor']);



?>