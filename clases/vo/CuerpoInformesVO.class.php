<?php

class CuerpoInformesVO{
  var $iddocumento_cabecera;
  var $idesolicitud;
  var $idecalendcapacitaciones;
  var $idremitente;
  var $idecapacitador;
  var $razonsocialdestino;
  var $ruc;
  var $asunto_documento;
  var $tip_documento;
 
  function __construct(
    $iddocumento_cabecera,
    $idesolicitud,
    $idecalendcapacitaciones,
    $idremitente,
    $idecapacitador,
    $razonsocialdestino,
    $ruc,
    $asunto_documento,
    $tip_documento    
  ){
    
    $this->iddocumento_cabecera = $iddocumento_cabecera;
    $this->idesolicitud = $idesolicitud;
    $this->idecalendcapacitaciones = $idecalendcapacitaciones;
    $this->idremitente = $idremitente;
    $this->idecapacitador = $idecapacitador;
    $this->razonsocialdestino = $razonsocialdestino;
    $this->ruc = $ruc;
    $this->asunto_documento = $asunto_documento;
    $this->tip_documento = $tip_documento;    
    
  }
}
?>