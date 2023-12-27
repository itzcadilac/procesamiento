<?php

class ClientesVO{
  var $idecliente;
  var $tipdocumento;
  var $documento;
  var $nombres;
  var $ape_paterno;
  var $ape_materno;
  var $estado;

  function __construct(
    $idecliente,
    $tipdocumento,
    $documento,
    $nombres,
    $ape_paterno,
    $ape_materno,
    $estado

  ){
    
    $this->idecliente=$idecliente;
    $this->tipdocumento=$tipdocumento;
    $this->documento=$documento;
    $this->nombres=$nombres;
    $this->ape_paterno=$ape_paterno;
    $this->ape_materno=$ape_materno;
    $this->estado=$estado;
    
  }
}
?>