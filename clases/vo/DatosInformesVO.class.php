<?php

class DatosInformesVO{
  var $titulodoc;
  var $remitente;
  var $cargoremitente;
  var $razonsoc;
  var $asunto;
  var $fecha;
  var $introduccion;
  var $objetivo;
  var $metodologia;
  var $temario;
  var $fecharesultados;
  var $canthoras;
  var $lugar;
  var $instructor;
  var $cargoinstructor;  

  function __construct(
    $titulodoc,
    $remitente,
    $cargoremitente,
    $razonsoc,
    $asunto,
    $fecha,
    $introduccion,
    $objetivo,
    $metodologia,
    $temario,
    $fecharesultados,
    $canthoras,
    $lugar,
    $instructor,
    $cargoinstructor  
  ){
    
    $this->titulodoc = $titulodoc;
    $this->remitente = $remitente;
    $this->cargoremitente = $cargoremitente;
    $this->razonsoc = $razonsoc;
    $this->asunto = $asunto;
    $this->fecha = $fecha;
    $this->introduccion = $introduccion;
    $this->objetivo = $objetivo;
    $this->metodologia = $metodologia;
    $this->temario = $temario;
    $this->fecharesultados = $fecharesultados;
    $this->canthoras = $canthoras;
    $this->lugar = $lugar;
    $this->instructor = $instructor;
    $this->cargoinstructor = $cargoinstructor;
    
  }
}
?>