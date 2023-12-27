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
 $result = mysql_query("SELECT COUNT(*) AS count FROM personal where idecalendcapacitaciones = '".$busqueda."' and asistencia = 1");
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
 $SQL = "SELECT * FROM personal where idecalendcapacitaciones = '".$busqueda."' and asistencia = 1 ORDER BY 1 ASC LIMIT $start, $limit"; 
 $result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
 $response->page = $page;
 $response->total = $total_pages;
 $response->records = $count; 
 $i=0;
 while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
 //$response->rows[$i]['id']=$row[EmployeeID];
 $response->rows[$i]['cell']=array("",utf8_encode($row['idepersonal']),utf8_encode($row['documento']),utf8_encode($row['nombres']),utf8_encode($row['ape_paterno']),utf8_encode($row['ape_materno']),utf8_encode($row['cargo']),utf8_encode($row['nota_teorica']),utf8_encode($row['nota_practica']),utf8_encode($row['nota_final']),utf8_encode($row['empresa']),utf8_encode($row['observaciones'])); $i++;
 } 
 echo json_encode($response);

?>