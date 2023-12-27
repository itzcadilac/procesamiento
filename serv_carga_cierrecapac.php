<?php
 session_start();
 error_reporting(0);
 require_once 'config.php';

 $busqueda=$_GET['horario'];
 $page = $_GET['page']; // get the requested page
 $limit = $_GET['rows']; // get how many rows we want to have into the grid
 $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
 $sord = $_GET['sord']; // get the direction
 if(!$sidx) $sidx =1; // connect to the database
 //$result = mysql_query("SELECT COUNT(*) AS count FROM personal where idecalendcapacitaciones = '".$busqueda."' ");

 $result = mysql_query("SELECT COUNT(*) AS count 
 FROM documentos_cuerpo dcu 
 INNER JOIN documentos_cabecera dca ON dca.iddocumento_cabecera = dcu.iddocumento_cabecera 
 INNER JOIN solicitudcapac sol ON sol.idesolicitud = dcu.idesolicitud 
 INNER JOIN calendcapacitaciones cal ON cal.idecalendcapacitaciones = sol.idecalendcapacitaciones 
 INNER JOIN capacitador cap ON cap.idecapacitador = dcu.idecapacitador 
 INNER JOIN capacitador cap1 ON cap1.idecapacitador = dcu.idremitente 
 INNER JOIN tipcapacitaciones tip ON tip.idecapacitacion = cal.idecapacitacion 
 -- INNER JOIN personal per ON per.idecalendcapacitaciones = cal.idecalendcapacitaciones 
 INNER JOIN parametro par ON par.codparametro = dcu.tip_documento 
 WHERE par.idetipparametro = 'TIP_INFORME'
 AND dcu.idecalendcapacitaciones = ".$busqueda." 
 ");

 $row = mysql_fetch_array($result,MYSQL_ASSOC);
 $count = $row['count'];

 if( $count > 0 ) { 
 $total_pages = ceil($count/$limit);
 //$total_pages = ceil($count/1);
 } else {
 $total_pages = 0; 
 } if ($page > $total_pages) 
 $page=$total_pages; 
 $start = $limit*$page - $limit; // do not put $limit*($page - 1) 
 //$SQL = "SELECT * FROM personal where idecalendcapacitaciones = '".$busqueda."'  ORDER BY 7, 11 DESC LIMIT $start, $limit"; 

 $SQL = " SELECT CONCAT(par.dscparametro, ' N° ', LPAD(dca.iddocumento_cabecera,4,'0'), '-', LPAD(MONTH(dcu.fec_registro),2,'0'), '-', YEAR(dcu.fec_registro), ' SST') AS titulodoc, 
 CONCAT_WS(' ', cap1.apepaterno, cap1.apematerno, cap1.nombres) AS remitente, 
 cap1.cargo as cargoremitente, 
 dcu.razonsocialdestino as razonsoc, 
 dcu.asunto_documento as asunto, 
 CONCAT(LPAD(DAY(cal.hora),2,'0'),' de ', MONTHNAME(cal.hora),' del ',YEAR(cal.hora)) as fecha, 
 /*tip.introduccion as introduccion, 
 tip.objetivo as objetivo, 
 tip.metodologia as metodologia, 
 tip.temario as temario, 
 CONCAT(LPAD(DAY(dcu.fec_registro),2,'0'),' de ', MONTHNAME(dcu.fec_registro),' de ',YEAR(dcu.fec_registro)) as fecharesultados, */
 tip.canthoras as canthoras, 
 cal.lugar_capacitacion as lugar, 
 CONCAT_WS(' ', cap.apepaterno, cap.apematerno, cap.nombres) AS instructor, 
 dcu.iddocumento_cuerpo as iddocumento_cuerpo
 -- cap.cargo as cargoinstructor 
 FROM documentos_cuerpo dcu 
 INNER JOIN documentos_cabecera dca ON dca.iddocumento_cabecera = dcu.iddocumento_cabecera 
 INNER JOIN solicitudcapac sol ON sol.idesolicitud = dcu.idesolicitud 
 INNER JOIN calendcapacitaciones cal ON cal.idecalendcapacitaciones = sol.idecalendcapacitaciones 
 INNER JOIN capacitador cap ON cap.idecapacitador = dcu.idecapacitador 
 INNER JOIN capacitador cap1 ON cap1.idecapacitador = dcu.idremitente 
 INNER JOIN tipcapacitaciones tip ON tip.idecapacitacion = cal.idecapacitacion 
 -- INNER JOIN personal per ON per.idecalendcapacitaciones = cal.idecalendcapacitaciones 
 INNER JOIN parametro par ON par.codparametro = dcu.tip_documento 
 WHERE par.idetipparametro = 'TIP_INFORME'
 AND dcu.idecalendcapacitaciones = ".$busqueda." ORDER BY 5 ASC LIMIT $start, $limit
 "; 
 $result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
 $response->page = $page;
 $response->total = $total_pages;
 $response->records = $count; 
 $i=0;
 while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
 //$response->rows[$i]['id']=$row[EmployeeID];
 //$response->rows[$i]['cell']=array("",utf8_encode($row['idepersonal']),utf8_encode($row['documento']),utf8_encode($row['nombres']),utf8_encode($row['ape_paterno']),utf8_encode($row['ape_materno']),utf8_encode($row['cargo']),utf8_encode($row['nota_teorica']),utf8_encode($row['nota_practica']),utf8_encode($row['nota_final']),utf8_encode($row['empresa']),utf8_encode($row['observaciones'], utf8_encode($row['idepersonal']))); $i++;
 $response->rows[$i]['cell']=array("",$row['iddoc'],$row['titulodoc'],$row['remitente'],$row['cargoremitente'],$row['razonsoc'],$row['fecha'],$row['fecharesultados'],$row['lugar'],$row['instructor'],$row['iddocumento_cuerpo']); $i++;
 } 
 echo json_encode($response);

?>