<?php
require_once 'config.php'; 
require_once "./conf.php";
require_once './carpinf/Dom.php';

require_once './carpinf/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

session_start();
$daocap = new CapacitacionDAO();
$daocap1 = new CapacitacionDAO();
$BD = new ConexionDB();
$idecalendcapacitaciones = $_GET['id'];

$conx = mysqli_connect ($servid,$user,$passw,$bdsist);
 /*
 //$oper = $_POST['oper'];
 //$select = $_POST['id'];
 
 //$asistencia = $_POST['asistencia'];
 //$observaciones = $_POST['observaciones'];

 $query='SELECT 
 per.idesolicitud AS idesolicitud, 
 cal.idecalendcapacitaciones AS idecalendcapacitaciones, 
 cap.idecapacitador AS idecapacitador, 
 per.empresa AS empresa, 
 per.ruc AS ruc, 
 CONCAT("Informe de Servicio ", tip.desccapacitacion) AS asunto_documento, 
 1 AS tip_documento, 
 tip.desccapacitacion, 
 tip.nombrecorto, 
 cal.hora 
 from 
 personal per, 
 tipcapacitaciones tip, 
 calendcapacitaciones cal, 
 capacitador cap 
 where cal.idecalendcapacitaciones = per.idecalendcapacitaciones 
 AND tip.idecapacitacion = cal.idecapacitacion 
 AND cap.idecapacitador = cal.idecapacitador 
 AND per.idecalendcapacitaciones = '.$idecalendcapacitaciones.'  
 GROUP BY per.ruc;
 ';
 
 if ($recordSet = $BD->ejecutar($query)){
     while ($fila = $recordSet->fetch_assoc()) {
          
 $query2 = 'INSERT INTO documentos_cabecera (numdocumento) 
 VALUES ("'.$idecalendcapacitaciones.'")';  
 $response = $BD->ejecutar($query2);
 $id =  $BD->dbLink->insert_id;

         $solVO = new CuerpoInformesVO(
             $id,
             $fila['idesolicitud'],
             $fila['idecalendcapacitaciones'],
             $_SESSION['idecapacitador'],
             $fila['idecapacitador'],
             $fila['empresa'],
             $fila['ruc'],
             $fila['asunto_documento'],
             $fila['tip_documento']         
             );
         
         $daocap->Registro_Doc_Cuerpo($solVO);    
     
     }
 
     $recordSet->close();
 }

 //if($oper=='edit'){
 mysql_query("UPDATE calendcapacitaciones SET estado = 0 where idecalendcapacitaciones = '".$idecalendcapacitaciones."'")
 or die(mysql_error());
*/
 //mysql_query("UPDATE personal SET fecha = DATE_FORMAT(CURDATE(), '%Y-%m-%d') where idecalendcapacitaciones = '".$idecalendcapacitaciones."'")
 //or die(mysql_error());

$sql1 = 'SET lc_time_names = "es_ES"';
$query1='SELECT CONCAT(par.dscparametro, " N° ", LPAD(dca.iddocumento_cabecera,4,"0"), "-", LPAD(MONTH(dcu.fec_registro),2,"0"), "-", YEAR(dcu.fec_registro), " SST") AS titulodoc, 
CONCAT_WS(" ", cap1.apepaterno, cap1.apematerno, cap1.nombres) AS remitente, 
cap1.cargo as cargoremitente, 
dcu.razonsocialdestino as razonsoc, 
dcu.asunto_documento as asunto, 
CONCAT(LPAD(DAY(cal.hora),2,"0")," de ", MONTHNAME(cal.hora)," del ",YEAR(cal.hora)) as fecha, 
tip.introduccion as introduccion, 
tip.objetivo as objetivo, 
tip.metodologia as metodologia, 
tip.temario as temario, 
CONCAT(LPAD(DAY(dcu.fec_registro),2,"0")," de ", MONTHNAME(dcu.fec_registro)," de ",YEAR(dcu.fec_registro)) as fecharesultados, 
tip.canthoras as canthoras, 
cal.lugar_capacitacion as lugar, 
CONCAT_WS(" ", cap.apepaterno, cap.apematerno, cap.nombres) AS instructor, 
tip.desccapacitacion as desccapacitacion, 
cap.cargo as cargoinstructor 
FROM documentos_cuerpo dcu 
INNER JOIN documentos_cabecera dca ON dca.iddocumento_cabecera = dcu.iddocumento_cabecera 
INNER JOIN solicitudcapac sol ON sol.idesolicitud = dcu.idesolicitud 
INNER JOIN calendcapacitaciones cal ON cal.idecalendcapacitaciones = sol.idecalendcapacitaciones 
INNER JOIN capacitador cap ON cap.idecapacitador = dcu.idecapacitador 
INNER JOIN capacitador cap1 ON cap1.idecapacitador = dcu.idremitente 
INNER JOIN tipcapacitaciones tip ON tip.idecapacitacion = cal.idecapacitacion 
-- INNER JOIN personal per ON per.idecalendcapacitaciones = cal.idecalendcapacitaciones 
INNER JOIN parametro par ON par.codparametro = dcu.tip_documento 
WHERE par.idetipparametro = "TIP_INFORME"
AND dcu.iddocumento_cuerpo = '.$idecalendcapacitaciones.'
';

$query2='SELECT LPAD(COUNT(1),2,"0") as total 
FROM personal per 
INNER JOIN calendcapacitaciones cal ON cal.idecalendcapacitaciones = per.idecalendcapacitaciones 
INNER JOIN documentos_cuerpo dcu ON dcu.idecalendcapacitaciones = per.idecalendcapacitaciones
INNER JOIN solicitudcapac sol ON sol.idesolicitud = dcu.idesolicitud 
WHERE cal.idecalendcapacitaciones = dcu.idecalendcapacitaciones 
AND per.idesolicitud = sol.idesolicitud 
AND per.idesolicitud = dcu.idesolicitud 
AND dcu.iddocumento_cuerpo = '.$idecalendcapacitaciones.'
';

$query3='SELECT per.documento, per.ape_paterno, per.ape_materno, per.nombres, per.nota_final, per.fecha
FROM personal per 
INNER JOIN calendcapacitaciones cal ON cal.idecalendcapacitaciones = per.idecalendcapacitaciones 
INNER JOIN documentos_cuerpo dcu ON dcu.idecalendcapacitaciones = per.idecalendcapacitaciones
INNER JOIN solicitudcapac sol ON sol.idesolicitud = dcu.idesolicitud 
WHERE cal.idecalendcapacitaciones = dcu.idecalendcapacitaciones 
AND per.idesolicitud = sol.idesolicitud 
AND per.idesolicitud = dcu.idesolicitud 
AND dcu.iddocumento_cuerpo = '.$idecalendcapacitaciones.'
';

$query4='SELECT fsc.dirfotos as dirfotos, fsca.nomfoto as nomfoto, fsca.tipo as tipo 
FROM foto_solic_capacitacion fsc 
INNER JOIN foto_solic_capa fsca ON fsca.idfotosoliccapacitacion = fsc.idfotosoliccapacitacion
INNER JOIN documentos_cuerpo dcu ON dcu.idesolicitud = fsc.idesolicitud
WHERE dcu.iddocumento_cuerpo = '.$idecalendcapacitaciones.' AND tipo = 1
';

$query5='SELECT fsc.dirfotos as dirfotos, fsca.nomfoto as nomfoto, fsca.tipo as tipo 
FROM foto_solic_capacitacion fsc 
INNER JOIN foto_solic_capa fsca ON fsca.idfotosoliccapacitacion = fsc.idfotosoliccapacitacion
INNER JOIN documentos_cuerpo dcu ON dcu.idesolicitud = fsc.idesolicitud
WHERE dcu.iddocumento_cuerpo = '.$idecalendcapacitaciones.' AND tipo = 2
';

$query6='SELECT cap.firma as firmaremitente, cap1.firma as firmainstructor 
FROM documentos_cuerpo dcu 
INNER JOIN capacitador cap ON cap.idecapacitador = dcu.idremitente 
INNER JOIN capacitador cap1 ON cap1.idecapacitador = dcu.idecapacitador 
WHERE dcu.iddocumento_cuerpo = '.$idecalendcapacitaciones.' 
';

$recordSet = $BD->ejecutar($sql1);
$recordSet1 = $BD->ejecutar($query2);
$dat = $recordSet1->fetch_assoc();
$cantidad = $dat['total'];


/** Inicio Fotos Asistencia*/

$recordSet4 = $BD->ejecutar($query4);
$fotoasist = $recordSet4->fetch_assoc();
$dirfotoasist = $fotoasist['dirfotos'];
$nomfotoasist = $fotoasist['nomfoto'];

/** Fin Fotos Asistencia*/

/** Inicio Fotos Fotos Capacitación*/

$recordSet5 = $BD->ejecutar($query5);
$fotocapa = $recordSet5->fetch_assoc();
$dirfotocapa = $fotocapa['dirfotos'];
$nomfotocapa = $fotocapa['nomfoto'];

/** Fin Fotos Fotos Capacitación*/

/** Inicio Firmas*/

$recordSet6 = $BD->ejecutar($query6);
$fotofirmas = $recordSet6->fetch_assoc();
$firmaremitente = $fotofirmas['firmaremitente'];
$firmainstructor = $fotofirmas['firmainstructor'];

/** Fin Firmas*/

$file_to_save = './carpinf/pdf/';

if ($recordSet = $BD->ejecutar($query1)){
    while ($fila = mysqli_fetch_array($recordSet)) {
        $_SESSION['titulodoc'] = $fila['titulodoc'];
        $_SESSION['remitente'] = $fila['remitente'];
        $_SESSION['cargoremitente'] = $fila['cargoremitente'];
        $_SESSION['razonsoc'] = $fila['razonsoc'];
        $_SESSION['asunto'] = $fila['asunto'];
        $_SESSION['fecha'] = $fila['fecha'];
        $_SESSION['introduccion'] = $fila['introduccion'];
        $_SESSION['objetivo'] = $fila['objetivo'];
        $_SESSION['metodologia'] = $fila['metodologia'];
        $_SESSION['temario'] = $fila['temario'];
        $_SESSION['fecharesultados'] = $fila['fecharesultados'];
        $_SESSION['canthoras'] = $fila['canthoras'];
        $_SESSION['lugar'] = $fila['lugar'];
        $_SESSION['instructor'] = $fila['instructor'];
        $_SESSION['desccapacitacion'] = $fila['desccapacitacion']; 
		$_SESSION['cargoinstructor'] = $fila['cargoinstructor'];
              
        //$desccapacitacion=$fila['desccapacitacion'];
        //$horario=$fila['hora'];
        /*
        $datosVO = new DatosInformesVO(
            $fila['titulodoc'],
            $fila['remitente'],
            $fila['cargoremitente'],
            $fila['razonsoc'],
            $fila['asunto'],
            $fila['fecha'],
            $fila['introduccion'],
            $fila['objetivo'],
            $fila['metodologia'],
            $fila['temario'],
            $fila['fecharesultados'],
            $fila['canthoras'],
            $fila['lugar'],
            $fila['instructor'],
            $fila['cargoinstructor']            
            );
        */

        //$daocap1->Emitir_Informe($datosVO);    
        //include  './carpinf/pdf.php';
        
        //$html = include '.carpinf/pdf.php';
       // for($i=0; $i<$cantidad; $i++)
        //{
         
       $dompdf = new Dompdf();

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
        $v15=$cantidad;
		$v16=$_SESSION['desccapacitacion'];
		$v17=$_SESSION['cargoinstructor'];


		$result= mysqli_query($conx,$query3) or die(mysql_error());

		$html2 =''; 
		
		while($row=mysqli_fetch_array($result))
		{
		$html2.= ' 
			<tbody>
			<tr>
				<td> <a>'.$row[documento].'</a> </td>								
				<td> <a>'.$row[ape_paterno].'</a> </td>	
				<td> <a>'.$row[ape_materno].'</a> </td>	
				<td> <a>'.$row[nombres].'</a> </td>	
				<td> <a>'.$row[nota_final].'</a> </td>	
				<td> <a>'.$row[fecha].'</a> </td>	
			</tr>
			</tbody>	
			';
		}
		//console.log($html2);
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
.table_firmas {break-after: page; }
.table_firmas td {font-size: 11px;font-family: Helvetica;text-align:center; }
.tabla_ubicacion,.tabla_sismo{width: 100%;text-align:center;text-transform:uppercase!important;font-size: 11px;font-family: Helvetica;}
.tabla_ubicacion th,.tabla_sismo th{text-transform: capitalize;border:0.5px solid #000000;color:#FFFFFF;background:#0F243E;padding:5px;font-weight: bold;}
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
						<th rowspan="2">DOCUMENTO</th>
						<th rowspan="2">APELLIDO PATERNO</th>
						<th rowspan="2">APELLIDO MATERNO</th>
						<th rowspan="2">NOMBRES</th>
						<th colspan="2">' .$v16. '</th>
					  </tr>
					  <tr>
						<th>FECHA</th>
						<th>NOTA</th>
					  </tr>

            		</thead>

						' .$html2. ' 

            	</table>
			</td>
		</tr>
	</table>	

	<div style="page-break-after: always"></div>

	<table border="0" cellpadding="0" cellspacing="0" style="position: relative;">
		<tr>
			<td style="width: 500px;vertical-align: top;">
				
				<h4>6. EVIDENCIA FOTOGRÁFICA</h4>

			</td>
		</tr>
		<tr>
			<td style="width: 500px;vertical-align: top;">
				<img src=./'. $dirfotocapa . $nomfotocapa .' border="0"   width="516" height="290"/>
			</td>
		</tr>	
		
	</table>

	<br />

	<table border="0" cellpadding="0" cellspacing="0" style="position: relative;">
		<tr>
			<td style="width: 500px;vertical-align: top;">
			 Sin otro particular, entregamos el presente informe como evidencia de los servicios de entrenamiento brindados a su personal.
			</td>
		</tr>
	</table>

	<br />
	<table class="table_firmas" style="width: 624px; position: relative;" border="1" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td style="width: 302px; height: 23px;">Elaborado por: '. $v14 .'</td>
				<td style="width: 302px; height: 23px;">Revisado por: '. $v2 .'</td>
			</tr>
			<tr>
				<td style="width: 302px; height: 151px;"> <img src=./imagenes/firmas/'. $firmainstructor .' border="0"  width="295" height="145"/> </td>
				<td style="width: 302px; height: 151px;"> <img src=./imagenes/firmas/'. $firmaremitente .' border="0"   width="295" height="145"/> </td>
			</tr>
			<tr>
				<td style="width: 302px; height: 23px;">'. $v17 .'</td>
				<td style="width: 302px; height: 23px;">'. $v3 .'</td>
			</tr>
		</tbody>
	</table>

	<div style="page-break-after: always"></div>

	<table border="0" cellpadding="0" cellspacing="0" style="position: relative;">
		<tr>
			<td style="width: 500px;vertical-align: top;">
				<h4 style="text-align:center">ANEXOS</h4>
			</td>
		</tr>
		<tr>
			<td style="width: 500px;vertical-align: top;">
				<h4 style="text-align:left">1. LISTA DE ASISTENCIA</h4>
			</td>
		</tr>	
		<tr>
			<td style="width: 500px;vertical-align: top;">
				<img src=./'. $dirfotoasist . $nomfotoasist .' border="0"   width="480" height="720"/>
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
 	
	//$dompdf = new Dompdf();
	$dompdf->set_option('isRemoteEnabled', TRUE);
	
	$dompdf->loadHtml($html);
	
	$dompdf->setPaper('A4', 'portrait');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream($v1 .'-'. $v4 .'-'. $v5, array("Attachment" => true));
/*
$dompdf->load_html($i);
$dompdf->set_paper('A4', 'portrait');
$dompdf->render();
file_put_contents($file_to_save."file".$i.".pdf", $dompdf->output());*/
      // $rep->generate("portrait", "informe", $html, "Informe");
    //}
      // sleep(10);
       //header ("Location: cerrarcapacitaciones.php");
        
    }

    $recordSet->close();
  //  header ("Location: cerrarcapacitaciones.php");
}




?>