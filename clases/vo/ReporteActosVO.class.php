<?php

class ReporteActosVO{
  var $idreporteaccon;
  var $idusuario;
  var $tipreporte;
  var $idlugar;
  var $fecharegistrouser;
  var $horaregistrouser;
  var $rutaimagenes;
  var $dscreporte;
  var $catriesgo;
  
  function __construct(
    $idreporteaccon,
    $idusuario,
    $tipreporte,
    $idlugar,
    $fecharegistrouser,
    $horaregistrouser,
    $rutaimagenes,
    $dscreporte,
    $catriesgo

  ){
    $this->idreporteaccon = $idreporteaccon;
    $this->idusuario = $idusuario;
    $this->tipreporte = $tipreporte;
    $this->idlugar = $idlugar;
    $this->fecharegistrouser = $fecharegistrouser;
    $this->horaregistrouser = $horaregistrouser;
    $this->rutaimagenes = $rutaimagenes;
    $this->dscreporte = $dscreporte;
    $this->catriesgo = $catriesgo;
  }
}
?>