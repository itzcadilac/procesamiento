<?php

class TipCapacitacionVO{
  var $idecapacitacion;
  var $desccapacitacion;
  var $image;
  var $costo;
  var $estado;
  var $orden;
  var $nombrecorto;
  var $codificacion;
  var $texto_cert;
  var $ideempresa;
  var $introduccion;
  var $objetivo;
  var $metodologia;
  var $temario;
  var $canthoras;

  function __construct(
    $idecapacitacion,
    $desccapacitacion,
    $image,
    $costo,
    $estado,
    $orden,
    $nombrecorto,
    $codificacion,
    $texto_cert,
    $ideempresa,
    $introduccion,
    $objetivo,
    $metodologia,
    $temario,
    $canthoras
  ){
    $this->idecapacitacion = $idecapacitacion;
    $this->desccapacitacion = $desccapacitacion;
    $this->image = $image;
    $this->costo = $costo;
    $this->estado = $estado;
    $this->orden = $orden;
    $this->nombrecorto = $nombrecorto;
    $this->codificacion = $codificacion;
    $this->texto_cert = $texto_cert;
    $this->ideempresa = $ideempresa;
    $this->introduccion = $introduccion;
    $this->objetivo = $objetivo;
    $this->metodologia = $metodologia;
    $this->temario = $temario;
    $this->canthoras = $canthoras;
    
  }
}
?>