<?php
require_once "./conf.php";
//next example will recieve all messages for specific conversation
    $horario = $_POST['horario'];

    $BD = new ConexionDB();
    //$fec = new Fecha();

    $query="SELECT ideempresa from tipcapacitaciones where  order by idesolicitud DESC";
    
    $recordSet = $BD->ejecutar($query);
    $bandeja = array();

    while($fila=$recordSet->fetch_assoc()) {

    console.log($fila['ideempresa']);
    $bandeja[] = new CapacitacionVO("","","","","","",$fila['ideempresa']);
    }

    return $bandeja;

?>