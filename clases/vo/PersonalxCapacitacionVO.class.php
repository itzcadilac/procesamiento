<?php

class PersonalxCapacitacionVO{
  var $idepersonal;
  var $documento;
  var $nombres;
  var $ape_paterno;
  var $ape_materno;
  var $cargo;
  var $ruc;
  var $empresa;
  var $nota_teorica;
  var $nota_practica;
  var $nota_final;
  var $idecalendcapacitaciones;
  var $fecha;
  var $registro;
  var $asistencia;
  var $foto;
  var $horas;
  var $estado;
  var $observaciones;
  var $idesolicitud;

  function __construct(
    $idepersonal,
    $documento,
    $nombres,
    $ape_paterno,
    $ape_materno,
    $cargo,
    $ruc,
    $empresa,
    $nota_teorica,
    $nota_practica,
    $nota_final,
    $idecalendcapacitaciones,
    $fecha,
    $registro,
    $asistencia,
    $foto,
    $horas,
    $estado,
    $observaciones,
    $idesolicitud
   
  ){
    
    $this->idepersonal=$idepersonal;
    $this->documento=$documento;
    $this->nombres=$nombres;
    $this->ape_paterno=$ape_paterno;
    $this->ape_materno=$ape_materno;
    $this->cargo=$cargo;
    $this->ruc=$ruc;
    $this->empresa=$empresa;
    $this->nota_teorica=$nota_teorica;
    $this->nota_practica=$nota_practica;
    $this->nota_final=$nota_final;
    $this->idecalendcapacitaciones=$idecalendcapacitaciones;
    $this->fecha=$fecha;
    $this->registro=$registro;
    $this->asistencia=$asistencia;
    $this->foto=$foto;
    $this->horas=$horas;
    $this->estado=$estado;
    $this->observaciones=$observaciones;
    $this->idesolicitud=$idesolicitud;
    
  }
}
?>