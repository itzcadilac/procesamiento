<?php
require_once "conf.php";
define('DB_HOST', $servid);
define('DB_NAME', $bdsist);
define('DB_USER',$user);
define('DB_PASSWORD',$passw);

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

?>