<?php

class ParihuelaVO{
  var $idtipoparihuela;
  var $descripcionparihuela;
  var $peso;
  var $estado;

  function __construct(
    $idtipoparihuela,
    $descripcionparihuela,
    $peso,
    $estado
  ){
    $this->idtipoparihuela = $idtipoparihuela;
    $this->descripcionparihuela = $descripcionparihuela;
    $this->peso = $peso;
    $this->estado = $estado;
  }
}
?>