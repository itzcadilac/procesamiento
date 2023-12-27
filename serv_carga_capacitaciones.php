<?php
 session_start();
 error_reporting(0);
 require_once 'config.php';

 $page = $_GET['page']; // get the requested page
 $limit = $_GET['rows']; // get how many rows we want to have into the grid
 $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
 $sord = $_GET['sord']; // get the direction
 if(!$sidx) $sidx =1; // connect to the database
 $result = mysql_query("SELECT COUNT(*) AS count FROM calendcapacitaciones cc INNER JOIN tipcapacitaciones tc on cc.idecapacitacion = tc.idecapacitacion LEFT JOIN capacitador cp on cc.idecapacitador = cp.idecapacitador WHERE cc.hora >= DATE_SUB(NOW(),INTERVAL 7 DAY) ");
 $row = mysql_fetch_array($result,MYSQL_ASSOC);
 $count = $row['count'];

 if( $count >0 ) { 
 $total_pages = ceil($count/$limit);
 //$total_pages = ceil($count/1);
 } else {
 $total_pages = 0; 
 } if ($page > $total_pages) 
 $page=$total_pages; 
 $start = $limit*$page - $limit; // do not put $limit*($page - 1) 
 $SQL = "SELECT cc.idecalendcapacitaciones as idecalendcapacitaciones, tc.desccapacitacion as desccapacitacion, cc.hora as hora, concat(cp.apepaterno, ' ', cp.apematerno, ', ', cp.nombres) as nombresape, cc.cupos as cupos, cc.cuposdispo as cuposdispo, cc.lugar_capacitacion as lugar_capacitacion, cc.estado as estado FROM calendcapacitaciones cc INNER JOIN tipcapacitaciones tc on cc.idecapacitacion = tc.idecapacitacion LEFT JOIN capacitador cp on cc.idecapacitador = cp.idecapacitador WHERE cc.hora >= DATE_SUB(NOW(),INTERVAL 7 DAY)  ORDER BY 3 DESC LIMIT $start, $limit"; 
 $result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
 $response->page = $page;
 $response->total = $total_pages;
 $response->records = $count; 
 $i=0;
 while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
 //$response->rows[$i]['id']=$row[EmployeeID];
 $response->rows[$i]['cell']=array("",utf8_encode($row['idecalendcapacitaciones']),$row['desccapacitacion'],utf8_encode($row['hora']),$row['nombresape'],utf8_encode($row['cupos']),utf8_encode($row['cuposdispo']),$row['lugar_capacitacion'],$row['estado']); $i++;
 } 
 echo json_encode($response);

?>