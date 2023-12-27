<?php

class CapacitacionVO{
  var $idecalendcapacitaciones;
  var $idecapacitacion;
  var $fecha;
  var $hora;
  var $idecapacitador;
  var $cupos;
  var $ideempresa;  
  var $lugar_capacitacion;

  function __construct(
    $idecalendcapacitaciones,
    $idecapacitacion,
    $fecha,
    $hora,
    $idecapacitador,
    $cupos,
    $ideempresa,
    $lugar_capacitacion
  ){
    $this->idecalendcapacitaciones = $idecalendcapacitaciones;
    $this->idecapacitacion = $idecapacitacion;
    $this->fecha = $fecha;
    $this->hora = $hora;
    $this->idecapacitador = $idecapacitador;
    $this->cupos = $cupos;
    $this->ideempresa = $ideempresa;
    $this->lugar_capacitacion = $lugar_capacitacion;
  }
}
?>