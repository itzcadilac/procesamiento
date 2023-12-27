<?php

class CargaFotosVO{
  var $idfotosoliccapacitacion;
  var $idesolicitud;
  var $idecalendcapacitaciones;
  var $idecapacitacion;
  var $ruc;
  var $razons;
  var $fotoasist;
  var $fotocurso;
  var $estado;
  var $fec_registro;
  var $fec_modificacion;
  var $idecapacitador_registro;
  var $idecapacitador_modificacion;

  function __construct(
    $idfotosoliccapacitacion,
    $idesolicitud,
    $idecalendcapacitaciones,
    $idecapacitacion,
    $ruc,
    $razons,
    $fotoasist,
    $fotocurso,
    $estado,
    $fec_registro,
    $fec_modificacion,
    $idecapacitador_registro,
    $idecapacitador_modificacion
    
  ){
    $this->idfotosoliccapacitacion = $idfotosoliccapacitacion;
    $this->idesolicitud = $idesolicitud;
    $this->idecalendcapacitaciones = $idecalendcapacitaciones;
    $this->idecapacitacion = $idecapacitacion;
    $this->ruc = $ruc;
    $this->razons = $razons;
    $this->fotoasist = $fotoasist;
    $this->fotocurso = $fotocurso;
    $this->estado = $estado;
    $this->fec_registro = $fec_registro;
    $this->fec_modificacion = $fec_modificacion;
    $this->idecapacitador_registro = $idecapacitador_registro;
    $this->idecapacitador_modificacion = $idecapacitador_modificacion;
  }
}
?>