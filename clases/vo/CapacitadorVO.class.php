<?php

class CapacitadorVO{
  var $idecapacitador;
  var $nombres;
  var $apepaterno;
  var $apematerno;
  var $tipdocumento;
  var $numdocumento;
  var $correo;
  var $celular;
  var $estado;
  var $usuario;

  function __construct(
    $idecapacitador,
    $nombres,
    $apepaterno,
    $apematerno,
    $tipdocumento,
    $numdocumento,
    $correo,
    $celular,
    $estado,
    $usuario

  ){
    $this->idecapacitador = $idecapacitador;
    $this->nombres = $nombres;
    $this->apepaterno = $apepaterno;
    $this->apematerno = $apematerno;
    $this->tipdocumento = $tipdocumento;
    $this->numdocumento = $numdocumento;
    $this->correo = $correo;
    $this->celular = $celular;
    $this->estado = $estado;
    $this->usuario = $usuario;
  }
}
?>