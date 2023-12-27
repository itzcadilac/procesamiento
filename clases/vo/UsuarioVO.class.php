<?php
//clase usuarioVO

class UsuarioVO{
  var $idusuario;
  var $usuario;
  var $password;
  var $nomape;
  var $tipo;
  var $razonsocial;
  var $ruc;
  var $nro_personal;
  var $id_autorizador;
  var $nombres;
  var $apepaterno;
  var $apematerno;
  var $menu;

  function __construct($id,$usu,$pass,$nom,$tip,$razonsocial,$ruc,$nro_personal,$id_autorizador,$nombres,$apepaterno,$apematerno,$menu){
    $this->idusuario = $id;
    $this->usuario = $usu;
    $this->password = $pass;
    $this->nomape = $nom;
    $this->tipo = $tip;
	  $this->razonsocial = $razonsocial;
    $this->ruc = $ruc;
    $this->nro_personal = $nro_personal;
    $this->id_autorizador = $id_autorizador;
    $this->nombres = $nombres;
    $this->apepaterno = $apepaterno;
    $this->apematerno = $apematerno;
    $this->menu = $menu;
  }
}
?>