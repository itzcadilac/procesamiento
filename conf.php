<?php
session_start();

// Archivo de configuracion de la aplicacion
define("APP_BASEDIR", dirname(__FILE__));
define('SMARTY_BASEFILE', APP_BASEDIR . '/lib/Smarty-2.6.14/Smarty.class.php');
define('ADODB_BASEFILE', APP_BASEDIR . '/lib/adodb-492/adodb.inc.php');

require(APP_BASEDIR . '/vendor/autoload.php');
//ini_set('session.gc_maxlifetime','1800'); // 30 minutos
//ini_set('error_reporting', 'E_ALL');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//ini_set('session.gc_maxlifetime','1800'); // 30 minutos
//ini_set('error_reporting', 'E_ALL');

require_once APP_BASEDIR . "/clases/util/ConexionDB.class.php";
require_once APP_BASEDIR . "/clases/util/Constantes.class.php";
require_once APP_BASEDIR . "/clases/util/Constantes.php";
require_once APP_BASEDIR . "/clases/util/Plantilla.class.php";
require_once APP_BASEDIR . "/clases/util/Fecha.class.php";
require_once APP_BASEDIR . "/clases/util/Debug.class.php";

require_once APP_BASEDIR . "/clases/dao/GeneraCombos.class.php";
require_once APP_BASEDIR . "/clases/dao/ValidacionDAO.class.php";
require_once APP_BASEDIR . "/clases/dao/SolicitudDAO.class.php";
require_once APP_BASEDIR . "/clases/dao/SolicitudRecDAO.class.php";
require_once APP_BASEDIR . "/clases/dao/CapacitacionDAO.class.php";
require_once APP_BASEDIR . "/clases/dao/UsuarioDAO.class.php";
require_once APP_BASEDIR . "/clases/dao/ReporteActosDAO.class.php";
require_once APP_BASEDIR . "/clases/dao/CapacitadorDAO.class.php";
require_once APP_BASEDIR . "/clases/dao/PersonalxCapacitacionDAO.class.php";
require_once APP_BASEDIR . "/clases/dao/CargaFotosDAO.class.php";
require_once APP_BASEDIR . "/clases/dao/ParihuelaDAO.class.php";
require_once APP_BASEDIR . "/clases/dao/JabaDAO.class.php";
require_once APP_BASEDIR . "/clases/dao/ClientesDAO.class.php";

require_once APP_BASEDIR . "/clases/vo/UsuarioVO.class.php";
require_once APP_BASEDIR . "/clases/vo/SolicitudVO.class.php";
require_once APP_BASEDIR . "/clases/vo/SolicitudRecVO.class.php";
require_once APP_BASEDIR . "/clases/vo/CapacitacionVO.class.php";
require_once APP_BASEDIR . "/clases/vo/CapacitadorVO.class.php";
require_once APP_BASEDIR . "/clases/vo/ReporteActosVO.class.php";
require_once APP_BASEDIR . "/clases/vo/PersonalxCapacitacionVO.class.php";
require_once APP_BASEDIR . "/clases/vo/CuposVO.class.php";
require_once APP_BASEDIR . "/clases/vo/CargaFotosVO.class.php";
require_once APP_BASEDIR . "/clases/vo/DatosInformesVO.class.php";
require_once APP_BASEDIR . "/clases/vo/CuerpoInformesVO.class.php";
require_once APP_BASEDIR . "/clases/vo/ParihuelaVO.class.php";
require_once APP_BASEDIR . "/clases/vo/JabaVO.class.php";
require_once APP_BASEDIR . "/clases/vo/ClientesVO.class.php";

?>