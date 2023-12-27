<?php
//session_start();
require_once "./conf.php";

$daosol = new SolicitudDAO();
$BD = new ConexionDB();
$horario = $_POST['horario_r'];
$autorizador = $_POST['idAutorizador'];
$cuposdispo = $_POST['cuposdispo'];
$numeropart = $_POST['numpart'];

$querycup="SELECT cuposdispo FROM calendcapacitaciones WHERE idecalendcapacitaciones = '$horario';";

if ($recordSet = $BD->ejecutar($querycup)){
    while ($fila = $recordSet->fetch_assoc()) {
        $cantdispo=$fila['cuposdispo'];
    }
    
    $recordSet->close();
}

if($cantdispo < $numeropart){
    header ("Location: registrosolicitud.php?registro=false"); 
}
else{

$query1="SELECT tip.desccapacitacion, cal.hora FROM tipcapacitaciones tip, calendcapacitaciones cal WHERE tip.idecapacitacion = cal.idecapacitacion AND cal.idecalendcapacitaciones='$horario'";

if ($recordSet = $BD->ejecutar($query1)){
    while ($fila = $recordSet->fetch_assoc()) {
        $desccapacitacion=$fila['desccapacitacion'];
        $horario=$fila['hora'];
    }

    $recordSet->close();
}

if($_POST['idAutorizador'] > 0){

    $query2="SELECT aut.correo_autorizador, aut.nombres FROM autorizadores aut WHERE aut.id_autorizador='$autorizador'";
    if ($recordSet1 = $BD->ejecutar($query2)){
        while ($fila1 = $recordSet1->fetch_assoc()) {
            $correo_autorizador=$fila1['correo_autorizador'];
            $nombres=$fila1['nombres'];
        }
    
        $recordSet1->close();
    }

}

$_SESSION['tipcapacitaciones'] = $_POST['tipcapacitaciones'];
$_SESSION['numpart'] = $_POST['numpart'];
$_SESSION['horario'] = $horario;
$_SESSION['email'] = $_POST['email'];
$_SESSION['numcontac'] = $_POST['numcontac'];
$_SESSION['razons'] = $_POST['razons'];
$_SESSION['numruc'] = $_POST['numruc'];
$_SESSION['nombres'] = $_POST['nombres'];
$_SESSION['correo_destino'] = $correo_autorizador;
$_SESSION['idAutorizador'] = $_POST['idAutorizador'];
$_SESSION['nombre_aut'] = $nombres;
$_SESSION['numoc'] = $_POST['numoc'];
$_SESSION['desccapacitacion'] = $desccapacitacion;

$solVO = new SolicitudVO("",
                        $_POST['idecontratista'],
                        $_POST['numpart'],
                        $_POST['numcontac'],
                        $_POST['email'],
                        $_POST['tippago'],
                        "",
                        "",
                        "",
                        "",
                        $_POST['tipcapacitaciones'],
                        //$capacitaciones,
                        $_POST['contratista'],
                        $_POST['numruc'],
                        $_POST['razons'],
                        $_POST['idAutorizador'],
                        $_POST['horario_r'],
                        $_POST['cuposdispo'],
                        $_POST['numoc'],
                        $desccapacitacion
                        );

$daosol->RegistrarSolicitud($solVO);
}

?>