<?php

require_once "./conf.php";
require_once ADODB_BASEFILE;

class ConexionDB {

    public $dbLink;

    public function __construct(){
        

        $this->dbLink = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
        if ($this->dbLink->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
        {
            die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
        }
      
    }    

    public function ejecutar($sentence){
        $result=$this->dbLink->query($sentence) or die($this->dbLink->error.__LINE__);    //el error es en este línea//
        return $result;
    }

    public function cerrar(){
        $this->dbLink->close();
    }
}
?>
