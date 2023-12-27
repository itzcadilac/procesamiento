<?php

class JabaVO{
  var $idtipjaba;
  var $descripcionjaba;
  var $peso;
  var $estado;

  function __construct(
    $idtipjaba,
    $descripcionjaba,
    $peso,
    $estado
  ){
    $this->idtipjaba = $idtipjaba;
    $this->descripcionjaba = $descripcionjaba;
    $this->peso = $peso;
    $this->estado = $estado;
  }
}
?>