<?php
 session_start();
 error_reporting(0);
 require_once 'config.php';

 $page = $_GET['page']; // get the requested page
 $limit = $_GET['rows']; // get how many rows we want to have into the grid
 $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
 $sord = $_GET['sord']; // get the direction
 if(!$sidx) $sidx =1; // connect to the database
 $result = mysql_query("SELECT COUNT(*) AS count FROM capacitador");
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
 $SQL = "SELECT * FROM capacitador ORDER BY 1 ASC LIMIT $start, $limit"; 
 $result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
 $response->page = $page;
 $response->total = $total_pages;
 $response->records = $count; 
 $i=0;
 while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
 //$response->rows[$i]['id']=$row[EmployeeID];
 $response->rows[$i]['cell']=array("",utf8_encode($row['idecapacitador']),utf8_encode($row['usuario']),$row['nombres'],$row['apepaterno'],$row['apematerno'],utf8_encode($row['tipdocumento']),utf8_encode($row['numdocumento']),utf8_encode($row['correo']),utf8_encode($row['celular']),utf8_encode($row['estado'])); $i++;
 } 
 echo json_encode($response);

?>