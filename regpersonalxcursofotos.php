<?php
require_once "./conf.php";
header("Content-Type: text/html;charset=utf-8");
?>
<!DOCTYPE html>


<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="UTF-8" />
		<title>Procesamiento Soft</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />
    	<link rel="stylesheet" href="assets/css/chosen.min.css" />
    	<link rel="stylesheet" href="assets/css/datepicker.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="assets/css/ui.jqgrid.min.css" />
		<link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<script type="text/javascript" src="busqueda/funciones.js"></script>
		<script src="assets/js/ace-extra.min.js"></script>
		<script src="assets/js/jquery.min.js"></script>
	</head>

	<body class="no-skin">
	<?php
include "cabecera_general.php";
?>
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>
		<?php
include($_SESSION['menu']);
?>
				<div class="main-content">
				<div class="main-content-inner">
				<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Inicio</a>
							</li>
							<li class="active">Principal</li>
						</ul><!-- /.breadcrumb -->
<!--
						<div class="nav-search" id="nav-search">
							<form class="form-search" action="controlador.php?pagina=5" method="post">
								<span class="input-icon">
									<input type="text" name="busqueda" placeholder="Ingresar Solicitud a Buscar ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div>--><!-- /.nav-search -->
					</div>
				<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">
   						<div class="ace-settings-box clearfix" id="ace-settings-box">

							</div>	<!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->

						<div class="page-header">
							<h1>
								Carga de Fotos por Empresa
								<small>
								<!--	<i class="ace-icon fa fa-angle-double-right"></i>-->
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">

<script type="text/javascript">
function spacio(e){
	tecla=(document.all) ? e.keyCode : e.which;
	return tecla!=32;
}
</script>

<!-- <form class="form-horizontal" name="frmbusquedacontra" action="" onsubmit="buscarContratista(); return false">
							<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ingrese su RUC:  </label>

										<div class="col-sm-9">
											<input type="text" name="ruc" id="form-field-1" placeholder="" class="col-xs-10 col-sm-5" onkeypress="return spacio(event);"/>
										</div>
							</div>
</form> 

		<form class="form-horizontal" method="post">
			<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="ruc"> Ingrese DNI: </label>
					<div class="col-sm-9">
						<input type="text" name="dni" class="dni" id="dni" placeholder="" required/>
						<button id="botoncito" class="botoncito"><i class="fa fa-search"></i> Buscar</button>
						<img src="ajax.gif" class="ajaxgif hide">
					</div>
			</div>
		</form>
-->
		<!--
		<form class="form-horizontal" method="post">
			<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="ruc"> RUC Empresa: </label>
					<div class="col-sm-9">
						<input type="text" name="doc" class="ruc" id="doc" placeholder="" required/>
						<button id="botoncito2" class="botoncito2"><i class="fa fa-search"></i> Buscar</button>
						<img src="ajax.gif" class="ajaxgif hide">
					</div>
			</div>
		</form>
		-->

<form class="form-horizontal" role="form" id="frm" name="formregistrar" action="personalxcapacitacionfotosservices.php" method="post" enctype="multipart/form-data">

<script language="javascript">
   function solonumero(e){
var keynum = window.event ? window.event.keyCode : e.which;
if((keynum==8) || (keynum==46))
return true;

return /\d/.test(String.fromCharCode(keynum));
}

</script>


<?php
$conexion = @new mysqli($servid, $user, $passw, $bdsist);

if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
}
mysqli_set_charset($conexion, 'utf8');
/*
$sql = "SELECT calend.idecalendcapacitaciones, tip.desccapacitacion, tip.image, tip.costo, calend.fecha, calend.hora 
FROM calendcapacitaciones calend 
INNER JOIN tipcapacitaciones tip 
ON calend.idecapacitacion = tip.idecapacitacion 
WHERE tip.estado = 1 
AND DATE_FORMAT(calend.hora, '%Y-%m-%d') >= CURDATE() 
-- AND calend.hora >= DATE_SUB(NOW(),INTERVAL 7 DAY) 
ORDER BY calend.idecalendcapacitaciones DESC;";
*/

$sql = 'SELECT calend.idecapacitacion,calend.idecalendcapacitaciones, tip.desccapacitacion, tip.ideempresa, tip.image, tip.costo, calend.fecha, calend.hora  
FROM calendcapacitaciones calend
INNER JOIN tipcapacitaciones tip
ON calend.idecapacitacion = tip.idecapacitacion
WHERE tip.estado = 1
AND calend.hora >= DATE_SUB(NOW(),INTERVAL 2 DAY)
AND calend.asistenciascerradas = 1 
AND calend.notascerradas = 0 
AND calend.idecapacitador = ' . $_SESSION['idecapacitador'] . '
AND tip.ideempresa = 3
GROUP BY 1, 2 
ORDER BY calend.idecalendcapacitaciones DESC;';

$result = $conexion->query($sql); 

if ($result->num_rows > 0)
{
    $combobit = "<option value=''></option>";
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $combobit .= " <option value='" . $row['idecalendcapacitaciones'] . "'>" .$row['desccapacitacion']. " " .$row['hora']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
    }
} else {
    echo "";
}

$trainerQuery = "SELECT * FROM capacitador where estado = 1";
$trainerData = $conexion->query($trainerQuery);

if ($trainerData->num_rows > 0) {
    $trainerCombo = "<option value=''></option>";
    while ($row = $trainerData->fetch_array(MYSQLI_ASSOC)) {
        $trainerCombo .= " <option value='" . $row['idecapacitador'] . "'>" . $row['nombres'] . " " . $row['apepaterno'] . " " . $row['apematerno'] . "</option>";
    }
} else {
    echo "";
}

$conexion->close();
?>
<?php
$conexion = new mysqli($servid, $user, $passw, $bdsist);

//$myArray = array();

if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
}

mysqli_set_charset($conexion, 'utf8');

$sqlautorizador = "SELECT id_autorizador, nombres from autorizadores";
$resultautorizador = $conexion->query($sqlautorizador);
$myArray = $resultautorizador->fetch_all(MYSQLI_ASSOC);

$myArray = json_encode($myArray);

$sqlcontra = "SELECT * from parametro where idetipparametro = 'TIP_DOCUMENTO' AND stsparametro = 1 ORDER BY codparametro ASC";
$resultcontra = $conexion->query($sqlcontra); //usamos la conexion para dar un resultado a la variable

if ($resultcontra->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobitcontra = "";
    while ($rowcontra = $resultcontra->fetch_array(MYSQLI_ASSOC)) {
        $combobitcontra .= " <option value='" . $rowcontra['codparametro'] . "'>" . $rowcontra['dscparametro'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
    }
} else {
    echo "";
}
?>
				<div class="form-group">
				<fieldset >
				<div id="resultcontra" >
				</div>
				</fieldset>
				</div>
				<!--
				<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tipo de Documento: </label>
						<div class="col-sm-9">
							<select class="form-control" name="tipdocumento" id="tipdocumento" required>
								<option value="0">---Seleccione---</option>
								<?php echo $combobitcontra; ?>
							</select>
						</div>
				</div>					
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Número Documento: </label>
					<div class="col-sm-9">
						<input type="text" name="numdocu" id="numdocu" placeholder="" class="form-control" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nombres: </label>
					<div class="col-sm-9">
						<input type="text" name="nombres" id="nombres"  placeholder="" class="form-control" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Apellido Paterno: </label>
					<div class="col-sm-9">
						<input type="text" name="apepaterno" id="apepaterno"  placeholder="" class="form-control" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Apellido Materno: </label>
					<div class="col-sm-9">
						<input type="text" name="apematerno" id="apematerno"  placeholder="" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Cargo: </label>
					<div class="col-sm-9">
						<input type="text" name="cargo" id="cargo"  placeholder="" class="form-control" />
					</div>
				</div>	
				-->	
				<div class="form-group">
              	   <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Capacitación:  </label>
            		 <div class="col-sm-9">
              	  	<select class="chosen-select form-control" name="idecalendcapacitaciones" id="idecalendcapacitaciones" data-placeholder="Seleccione la capacitación">
              	  	  <?php echo $combobit; ?>
              	  	</select>
              		 </div>
              	</div>	
				<div class="form-group">
              	   <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Solicitudes:  </label>
            		 <div class="col-sm-9">
					 <select class="form-control" name="idesolicitud" id="idesolicitud" data-placeholder="Seleccione la Empresa..." required>
						<option value="0">---Seleccione---</option>
              	  	</select>
              		 </div>
              	</div>					
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> RUC: </label>
					<div class="col-sm-9">
						<input type="text" name="ruc" id="ruc" placeholder="" class="form-control" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Razón Social: </label>
					<div class="col-sm-9">
						<input type="text" name="empresa" id="empresa"  placeholder="" class="form-control" required/>
					</div>
				</div>				
              	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Día de capacitación: </label>
					<div class="col-sm-9">
                      <div class="input-group">
                        <input class="form-control date-picker" name="diacapacitacion" disabled id="diacapacitacion" type="text" data-date-format="dd-mm-yyyy" />
                        <span class="input-group-addon">
                          <i class="fa fa-calendar bigger-110"></i>
                        </span>
                      </div>
					</div>
			   	</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hora de capacitación: </label>
					<div class="col-sm-9">
                      <div class="input-group bootstrap-timepicker">
                        <input id="horacapacitacion" type="text" class="form-control" name="horacapacitacion" disabled/>
                        <span class="input-group-addon">
                          <i class="fa fa-clock-o bigger-110"></i>
                        </span>
                      </div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Carga de Fotos: </label>
					<div class="col-sm-9">
						<div class="widget-box">
							<div class="widget-header">
								<h4 class="widget-title">Selecciona tus Fotos</h4>

								<div class="widget-toolbar">
									<a href="#" data-action="collapse">
										<i class="ace-icon fa fa-chevron-up"></i>
									</a>

									<a href="#" data-action="close">
										<i class="ace-icon fa fa-times"></i>
									</a>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<div class="form-group">
										<div class="col-xs-12">
											<input type="file" name="fotoasist" id="id-input-file-2" />
										</div>
									</div>

									<div class="form-group">
										<div class="col-xs-12">
											<input multiple="" type="file" name="fotocurso[]" id="id-input-file-3" />
										</div>
									</div>
									
									<label>
										<!--<input type="checkbox" name="file-format" id="id-file-format" class="ace" />-->
										<span class="lbl"> Solo imágenes permitidas.</span>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div  class="form-group" >
        					<dl>
        					<dt>
        					<label>
        					<!-- <span style="font-family:verdana">
        					<b>Si los datos ingresados son los correctos, proceda a seleccionar Solicitar Capacitaciones</b>
        					</span> -->
        					</label>
							<!-- <br><a href="#" onclick="addField()" accesskey="5"> -->
        					<dd><span style="font-family:verdana"><div id="files"></div></span></dd>
							</div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
										<button class="btn btn-info" type="submit" id="postback" name="postback" accesskey="6">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Registrar Capacitación
										</button>

											&nbsp; &nbsp; &nbsp;
										<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Limpiar
											</button>
										</div>
									</div>
							</dl>
							</form>
								<!--
								<div class="hr hr32 hr-dotted"></div>
										<div class="row">
											<div class="col-xs-12">
											<table id="grid-table">
											</table>
											<div id="grid-pager">
											</div>
											</div>
										</div>
								<div class="hr hr32 hr-dotted"></div>-->


								<script>
									$(function(){
										$('#botoncito').on('click', function(){
										var dni = $('#dni').val();
										var url = 'consulta_dni.php';
										$('.ajaxgif').removeClass('hide');
										$.ajax({
										type:'POST',
										url:url,
										data:'dni='+dni,
										success: function(datos_dni){
											$('.ajaxgif').addClass('hide');
											var datos = eval(datos_dni);
												var nada ='nada';
												if(datos[0]==nada){
													alert('DNI no válido o no registrado');
												}else{
													//$('#numero_ruc').text(datos[0]);
													$('#numdocu').val(datos[0]);
													$('#nombres').val(datos[1]);
													$('#apepaterno').val(datos[2]);
													$('#apematerno').val(datos[3]);
													$('#tipdocumento').val(datos[4]);
												}		
										}
										});
										return false;
										});
									});
								</script>
								<script>
									$(function(){
										$('#botoncito2').on('click', function(){
										var ruc = $('#doc').val();
										var url = 'consulta_sunat.php';
										$('.ajaxgif').removeClass('hide');
										$.ajax({
										type:'POST',
										url:url,
										data:'ruc='+ruc,
										success: function(datos_dni){
											$('.ajaxgif').addClass('hide');
											var datos = eval(datos_dni);
												var nada ='nada';
												if(datos[0]==nada){
													alert('DNI o RUC no válido o no registrado');
												}else{
													//$('#numero_ruc').text(datos[0]);
													$('#empresa').val(datos[0]);
													$('#ruc').val(datos[1]);
												}		
										}
										});
										return false;
										});
									});

									$(function(){
									$('#idecalendcapacitaciones').on('change', function(){
									var idecalendcapacitaciones = $('#idecalendcapacitaciones').val();
									var url = 'busquedasolicitudes.php';
									var text = ''
									//$('.ajaxgif').removeClass('hide');
									$.ajax({
									type:'POST',
									url:url,
									data:'idecalendcapacitaciones='+idecalendcapacitaciones,
									success: function(response){
										var datos = JSON.parse(response);
										var output = ['<option value="0">---Seleccione---</option>']
										datos.data.forEach(item => {
										output.push(`<option value="${item.idesolicitud}">${item.ruc} - ${item.razons} - ${item.idesolicitud}</option>`);				
										});
										//console.log($('#idesolicitud').get(0));
										$('#idesolicitud').get(0).innerHTML = output.join('');
									}
									});
									return false;
									});
									});
								</script>
						</div>

								<div class="hr hr32 hr-dotted"></div>
								<div class="hr hr32 hr-dotted"></div>

							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="footer">
			<?php
				include "footer.php";
			?>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div>
		<script src="assets/js/jquery.2.1.1.min.js"></script>
		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    	<script src="assets/js/chosen.jquery.min.js"></script>
    	<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/bootstrap-timepicker.min.js"></script>
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		<script src="assets/js/jquery.jqGrid.min.js"></script>
		<script src="assets/js/grid.locale-en.js"></script>

		<script type="text/javascript">
			
			var rucdato = document.getElementById("ruc");
			var razonsdato = document.getElementById("empresa");			

			document.getElementById("idesolicitud").onchange = function(){
				var opt = this.options[this.selectedIndex];
				var textContent = opt.text.split("-");
				rucdato.value = opt.text.slice(0,11);
				razonsdato.value = textContent.slice(-2)[0];
			}
			
				var dayTag = document.getElementById("diacapacitacion");
				var houtTag = document.getElementById("horacapacitacion");

				document.getElementById("idecalendcapacitaciones").onchange = function(){
				var opt = this.options[this.selectedIndex];
				var textContent = opt.text.split(" ");
				houtTag.value = textContent.slice(-1);
				dayTag.value = textContent.slice(-2)[0];
				$('#ruc').val("");
				$('#empresa').val("");
				
				var horario = $('#idecalendcapacitaciones').val();
				var url = `serv_carga_personal_asistencia.php?horario=${horario}`;
				//console.log(horario);
				$("#grid-table").jqGrid('setGridParam', { url: url });
    			$("#grid-table").trigger("reloadGrid");				
			}
		</script>
		<script type="text/javascript">
			jQuery(function($) {
        		$('.date-picker').datepicker({
					format: 'yyyy-mm-dd',
					autoclose: true,
					todayHighlight: true,
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});

        		$('#timepicker1').timepicker({
					timeFormat: "HH:mm:ss",
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true});
					//resize the chosen on window resize

					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});


					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
						 else $('#form-field-select-4').removeClass('tag-input-style');
					});
				}

				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});

				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}

				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}

				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}

				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();

					var off2 = $source.offset();
					//var w2 = $source.width();

					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}


				$('.dialogs,.comments').ace_scroll({
					size: 300
			    });


				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				});

				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {
						//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});

				//chosen plugin inside a modal will have a zero width because the select element is originally hidden
				//and its width cannot be determined.
				//so we set the width after modal is show
				$('#modal-form').on('shown.bs.modal', function () {
					if(!ace.vars['touch']) {
						$(this).find('.chosen-container').each(function(){
							$(this).find('a:first-child').css('width' , '210px');
							$(this).find('.chosen-drop').css('width' , '210px');
							$(this).find('.chosen-search input').css('width' , '200px');
						});
					}
				})
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/

				//show the dropdowns on top or bottom depending on window height and menu position
				$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					var offset = $(this).offset();

					var $w = $(window)
					if (offset.top > $w.scrollTop() + $w.innerHeight() - 100)
						$(this).addClass('dropup');
					else $(this).removeClass('dropup');
				});

				//inicio dropdown
				$('#id-input-file-1 , #id-input-file-2').ace_file_input({
					no_file:'Seleccione foto de Assitencia ...',
					btn_choose:'Elegir',
					btn_change:'Cambiar',
					droppable:false,
					onchange:null,
					thumbnail:true, //| true | large
					allowExt:  ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff', 'bmp'],
    				allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif', 'image/tif', 'image/tiff', 'image/bmp']
					//maxSize: 100000, //~100 KB
					//onchange:''
					//
				});
				//pre-show a file name, for example a previously selected file
				//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
			
			
				$('#id-input-file-3').ace_file_input({
					style:'well',
					//btn_choose:'Suelte los archivos aquí o haga clic para elegir.',
					btn_change:null,
					//no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					maxFilesize: 4,
					//maxfilesexceeded: 4,
					btn_choose: "Suelta imágenes aquí o haz clic para elegir.",
					no_icon: "ace-icon fa fa-picture-o",
					allowExt: ["jpeg", "jpg", "png", "gif" , "bmp"],
					allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"],
					thumbnail:'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				
				//$('#id-input-file-3')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);
			
				
				
			
				//dynamically change allowed formats by changing allowExt && allowMime function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var whitelist_ext, whitelist_mime;
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Suelta imágenes aquí o haz clic para elegir.";
						no_icon = "ace-icon fa fa-picture-o";
			
						whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
						whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
					}
					else {
						btn_choose = "Suelte los archivos aquí o haga clic para elegir.";
						no_icon = "ace-icon fa fa-cloud-upload";
						
						whitelist_ext = null;//all extensions are acceptable
						whitelist_mime = null;//all mimes are acceptable
					}
					var file_input = $('#id-input-file-3');
					file_input
					.ace_file_input('update_settings',
					{
						'btn_choose': btn_choose,
						'no_icon': no_icon,
						'allowExt': whitelist_ext,
						'allowMime': whitelist_mime
					})
					file_input.ace_file_input('reset_input');
					
					file_input
					.off('file.error.ace')
					.on('file.error.ace', function(e, info) {
						//console.log(info.file_count);//number of selected files
						//console.log(info.invalid_count);//number of invalid files
						//console.log(info.error_list);//a list of errors in the following format
						
						//info.error_count['ext']
						//info.error_count['mime']
						//info.error_count['size']
						
						//info.error_list['ext']  = [list of file names with invalid extension]
						//info.error_list['mime'] = [list of file names with invalid mimetype]
						//info.error_list['size'] = [list of file names with invalid size]
						
						
						/**
						if( !info.dropped ) {
							//perhapse reset file field if files have been selected, and there are invalid files among them
							//when files are dropped, only valid files will be added to our file array
							e.preventDefault();//it will rest input
						}
						*/
						
						
						//if files have been selected (not dropped), you can choose to reset input
						//because browser keeps all selected files anyway and this cannot be changed
						//we can only reset file field to become empty again
						//on any case you still should check files with your server side script
						//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
					});
				
				});
			})
		</script>
		<script type="text/javascript">			
			var grid_data = 
			[ 
				{id:"1",name:"Desktop Computer",note:"note",stock:"Yes",ship:"FedEx", sdate:"2007-12-03"},
				{id:"2",name:"Laptop",note:"Long text ",stock:"Yes",ship:"InTime",sdate:"2007-12-03"},
				{id:"3",name:"LCD Monitor",note:"note3",stock:"Yes",ship:"TNT",sdate:"2007-12-03"},
				{id:"4",name:"Speakers",note:"note",stock:"No",ship:"ARAMEX",sdate:"2007-12-03"},
				{id:"5",name:"Laser Printer",note:"note2",stock:"Yes",ship:"FedEx",sdate:"2007-12-03"},
				{id:"6",name:"Play Station",note:"note3",stock:"No", ship:"FedEx",sdate:"2007-12-03"},
				{id:"7",name:"Mobile Telephone",note:"note",stock:"Yes",ship:"ARAMEX",sdate:"2007-12-03"},
				{id:"8",name:"Server",note:"note2",stock:"Yes",ship:"TNT",sdate:"2007-12-03"},
				{id:"9",name:"Matrix Printer",note:"note3",stock:"No", ship:"FedEx",sdate:"2007-12-03"},
				{id:"10",name:"Desktop Computer",note:"note",stock:"Yes",ship:"FedEx", sdate:"2007-12-03"},
				{id:"11",name:"Laptop",note:"Long text ",stock:"Yes",ship:"InTime",sdate:"2007-12-03"},
				{id:"12",name:"LCD Monitor",note:"note3",stock:"Yes",ship:"TNT",sdate:"2007-12-03"},
				{id:"13",name:"Speakers",note:"note",stock:"No",ship:"ARAMEX",sdate:"2007-12-03"},
				{id:"14",name:"Laser Printer",note:"note2",stock:"Yes",ship:"FedEx",sdate:"2007-12-03"},
				{id:"15",name:"Play Station",note:"note3",stock:"No", ship:"FedEx",sdate:"2007-12-03"},
				{id:"16",name:"Mobile Telephone",note:"note",stock:"Yes",ship:"ARAMEX",sdate:"2007-12-03"},
				{id:"17",name:"Server",note:"note2",stock:"Yes",ship:"TNT",sdate:"2007-12-03"},
				{id:"18",name:"Matrix Printer",note:"note3",stock:"No", ship:"FedEx",sdate:"2007-12-03"},
				{id:"19",name:"Matrix Printer",note:"note3",stock:"No", ship:"FedEx",sdate:"2007-12-03"},
				{id:"20",name:"Desktop Computer",note:"note",stock:"Yes",ship:"FedEx", sdate:"2007-12-03"},
				{id:"21",name:"Laptop",note:"Long text ",stock:"Yes",ship:"InTime",sdate:"2007-12-03"},
				{id:"22",name:"LCD Monitor",note:"note3",stock:"Yes",ship:"TNT",sdate:"2007-12-03"},
				{id:"23",name:"Speakers",note:"note",stock:"No",ship:"ARAMEX",sdate:"2007-12-03"}
			];
			
			var subgrid_data = 
			[
			 {id:"1", name:"sub grid item 1", qty: 11},
			 {id:"2", name:"sub grid item 2", qty: 3},
			 {id:"3", name:"sub grid item 3", qty: 12},
			 {id:"4", name:"sub grid item 4", qty: 5},
			 {id:"5", name:"sub grid item 5", qty: 2},
			 {id:"6", name:"sub grid item 6", qty: 9},
			 {id:"7", name:"sub grid item 7", qty: 3},
			 {id:"8", name:"sub grid item 8", qty: 8}
			];

			jQuery(function($) {
			var grid_selector = "#grid-table";
			var pager_selector = "#grid-pager";
			
				//resize to fit page size
				$(window).on('resize.jqGrid', function () {
					$(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
			    })
				//resize on sidebar collapse/expand
				var parent_column = $(grid_selector).closest('[class*="col-"]');
				$(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
					if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
						//setTimeout is for webkit only to give time for DOM changes and then redraw!!!
						setTimeout(function() {
							$(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
						}, 0);
					}
			    })

			
				jQuery(grid_selector).jqGrid({
					//direction: "rtl",
			
					//subgrid options
					subGrid : false,
					//subGridModel: [{ name : ['No','Item Name','Qty'], width : [55,200,80] }],
					//datatype: "xml",
					subGridOptions : {
						plusicon : "ace-icon fa fa-plus center bigger-110 blue",
						minusicon  : "ace-icon fa fa-minus center bigger-110 blue",
						openicon : "ace-icon fa fa-chevron-right center orange"
					},
					//for this example we are using local data
					subGridRowExpanded: function (subgridDivId, rowId) {
						var subgridTableId = subgridDivId + "_t";
						$("#" + subgridDivId).html("<table id='" + subgridTableId + "'></table>");
						$("#" + subgridTableId).jqGrid({
							datatype: 'local',
							data: subgrid_data,
							colNames: ['No','Item Name','Qty'],
							colModel: [
								{ name: 'id', width: 50 },
								{ name: 'name', width: 150 },
								{ name: 'qty', width: 50 }
							]
						});
					},
					
			
					url:'serv_carga_personal_asistencia.php',
					data: grid_data,
					datatype: "json",
					height: 400,
					colNames:['Acciones', 'Código', 'Documento','Nombres','Ap. Paterno','Ap. Materno','RUC', 'Empresa'],
					colModel:[
						{name:'select',index:'select', width:70, fixed:true, hidden: true, sortable:false, resize:false,
							formatter:'actions', 
							formatoptions:{ 
								keys:true,
								delbutton: false,//disable delete button							
								delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback,type: 'POST',datatype: 'json'},
								editOptions:{recreateForm: true, beforeShowForm:beforeEditCallback,type: 'POST',datatype: 'json'}
							}
						},
						{name:'idepersonal',index:'idepersonal', width:10, editable: false, hidden: true },
						{name:'documento',index:'documento', width:20, editable: false},
						{name:'nombres', index:'nombres', width:60,editable: false,editoptions:{size:"60",maxlength:"150"}},
						{name:'ape_paterno', index:'ape_paterno', width:60,editable: false,editoptions:{size:"60",maxlength:"150"}},
						{name:'ape_materno', index:'ape_materno', width:60,editable: false,editoptions:{size:"60",maxlength:"150"}},
						{name:'ruc', index:'ruc', width:20,editable: false,editoptions:{size:"60",maxlength:"150"}},
						{name:'empresa', index:'empresa', width:60,editable: false,editoptions:{size:"60",maxlength:"150"}}
						//{name:'numadjuntocargo', index:'numadjuntocargo', width:60,editable: true,editoptions:{size:"60",maxlength:"150"}}						
						//{name:'nombrecarpeta',index:'nombrecarpeta', width:150,editable: true,editoptions:{size:"150",maxlength:"150"}}
						
					], 
			
					viewrecords : true,
					rowNum:15,
					rowList:[10,20,30],
					pager : pager_selector,
					altRows: true,
					//toppager: true,
					
					multiselect: false,
					//multikey: "ctrlKey",
			        multiboxonly: false,
			
					loadComplete : function() {
						var table = this;
						setTimeout(function(){
							styleCheckbox(table);							
							updateActionIcons(table);
							updatePagerIcons(table);
							enableTooltips(table);
						}, 0);
					},
					
					editurl: "#",
					caption: "Listado de Capacitaciones por Capacitador"
			
					//,autowidth: true,
			
			
					/**
					,
					grouping:true, 
					groupingView : { 
						 groupField : ['name'],
						 groupDataSorted : true,
						 plusicon : 'fa fa-chevron-down bigger-110',
						 minusicon : 'fa fa-chevron-up bigger-110'
					},
					caption: "Grouping"
					*/
			
				});
				$(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size

				//enable search/filter toolbar
				//jQuery(grid_selector).jqGrid('filterToolbar',{defaultSearch:true,stringResult:true})
				//jQuery(grid_selector).filterToolbar({});
			
			
				//switch element when editing inline
				function aceSwitch( cellvalue, options, cell ) {
					setTimeout(function(){
						$(cell) .find('input[type=checkbox]')
							.addClass('ace ace-switch ace-switch-5')
							.after('<span class="lbl"></span>');
					}, 0);
				}
				//enable datepicker
				function pickDate( cellvalue, options, cell ) {
					setTimeout(function(){
						$(cell) .find('input[type=text]')
								.datepicker({format:'yyyy-mm-dd' , autoclose:true}); 
					}, 0);
				}

			//navButtons
			jQuery(grid_selector).jqGrid('navGrid',pager_selector,
					{ 	//navbar options
						edit: false,
						editicon : 'ace-icon fa fa-pencil blue',
						add: false,
						addicon : 'ace-icon fa fa-plus-circle purple',
						del: false,
						delicon : 'ace-icon fa fa-trash-o red',
						search: true,
						searchicon : 'ace-icon fa fa-search orange',
						refresh: true,
						refreshicon : 'ace-icon fa fa-refresh green',
						view: false,
						viewicon : 'ace-icon fa fa-search-plus grey',
					},
					{
						//edit record form
						//closeAfterEdit: true,
						//width: 700,
						recreateForm: true,
						beforeShowForm : function(e) {
							var form = $(e[0]);
							form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
							style_edit_form(form);
						}
					},
					{
						//new record form
						width: 700,
						closeAfterAdd: true,
						recreateForm: true,
						viewPagerButtons: false,
						beforeShowForm : function(e) {
							var form = $(e[0]);
							form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
							.wrapInner('<div class="widget-header" />')
							style_edit_form(form);
						}
					},
					{
						//delete record form
						recreateForm: true,
						beforeShowForm : function(e) {
							var form = $(e[0]);
							if(form.data('styled')) return false;
							
							form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
							style_delete_form(form);
							
							form.data('styled', true);
						},
						onClick : function(e) {
							//alert(1);
						}
					},
					{
						//search form
						recreateForm: true,
						afterShowSearch: function(e){
							var form = $(e[0]);
							form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
							style_search_form(form);
						},
						afterRedraw: function(){
							style_search_filters($(this));
						}
						,
						multipleSearch: true,
						/**
						multipleGroup:true,
						showQuery: true
						*/
					},
					{
						//view record form
						recreateForm: true,
						beforeShowForm: function(e){
							var form = $(e[0]);
							form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
						}
					}
				)

				function style_edit_form(form) {
					//enable datepicker on "sdate" field and switches for "stock" field
					form.find('input[name=sdate]').datepicker({format:'yyyy-mm-dd' , autoclose:true})
					
					form.find('input[name=stock]').addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
							   //don't wrap inside a label element, the checkbox value won't be submitted (POST'ed)
							  //.addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');
			
							
					//update buttons classes
					var buttons = form.next().find('.EditButton .fm-button');
					buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
					buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
					buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')
					
					buttons = form.next().find('.navButton a');
					buttons.find('.ui-icon').hide();
					buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
					buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');		
				}
			
				function style_delete_form(form) {
					var buttons = form.next().find('.EditButton .fm-button');
					buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
					buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
					buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
				}
				
				function style_search_filters(form) {
					form.find('.delete-rule').val('X');
					form.find('.add-rule').addClass('btn btn-xs btn-primary');
					form.find('.add-group').addClass('btn btn-xs btn-success');
					form.find('.delete-group').addClass('btn btn-xs btn-danger');
				}
				function style_search_form(form) {
					var dialog = form.closest('.ui-jqdialog');
					var buttons = dialog.find('.EditTable')
					buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
					buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
					buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
				}
				
				function beforeDeleteCallback(e) {
					var form = $(e[0]);
					if(form.data('styled')) return false;
					
					form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
					style_delete_form(form);
					
					form.data('styled', true);
				}
				
				function beforeEditCallback(e) {
					var form = $(e[0]);
					form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
					style_edit_form(form);
				}
			
			
			
				//it causes some flicker when reloading or navigating grid
				//it may be possible to have some custom formatter to do this as the grid is being created to prevent this
				//or go back to default browser checkbox styles for the grid
				function styleCheckbox(table) {
				/**
					$(table).find('input:checkbox').addClass('ace')
					.wrap('<label />')
					.after('<span class="lbl align-top" />')
			
			
					$('.ui-jqgrid-labels th[id*="_cb"]:first-child')
					.find('input.cbox[type=checkbox]').addClass('ace')
					.wrap('<label />').after('<span class="lbl align-top" />');
				*/
				}
				
			
				//unlike navButtons icons, action icons in rows seem to be hard-coded
				//you can change them like this in here if you want
				function updateActionIcons(table) {
					/**
					var replacement = 
					{
						'ui-ace-icon fa fa-pencil' : 'ace-icon fa fa-pencil blue',
						'ui-ace-icon fa fa-trash-o' : 'ace-icon fa fa-trash-o red',
						'ui-icon-disk' : 'ace-icon fa fa-check green',
						'ui-icon-cancel' : 'ace-icon fa fa-times red'
					};
					$(table).find('.ui-pg-div span.ui-icon').each(function(){
						var icon = $(this);
						var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
						if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
					})
					*/
				}
				
				//replace icons with FontAwesome icons like above
				function updatePagerIcons(table) {
					var replacement = 
					{
						'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
						'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
						'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
						'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
					};
					$('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
						var icon = $(this);
						var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
						
						if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
					})
				}
			
				function enableTooltips(table) {
					$('.navtable .ui-pg-button').tooltip({container:'body'});
					$(table).find('.ui-pg-div').tooltip({container:'body'});
				}
			
				//var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');
			
				$(document).one('ajaxloadstart.page', function(e) {
					$(grid_selector).jqGrid('GridUnload');
					$('.ui-jqdialog').remove();
				});

			})
		</script>

	</body>
</html>
