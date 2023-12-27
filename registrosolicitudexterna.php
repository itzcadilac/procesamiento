<?php
require_once "./conf.php";
header("Content-Type: text/html;charset=utf-8");
?>
<!DOCTYPE html>


<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="UTF-8" />
		<title>Training Soft</title>

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
								Registro de Solicitudes Externas
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

<form class="form-horizontal" method="post">
							<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="ruc"> Ingrese su RUC:  </label>

										<div class="col-sm-9">
											<input type="text" name="ruc" class="ruc" id="ruc" placeholder="" required/>
											<button id="botoncito" class="botoncito"><i class="fa fa-search"></i> Buscar</button>
											<img src="ajax.gif" class="ajaxgif hide">
										</div>
							</div>
</form>

<form class="form-horizontal" role="form" id="frm" name="formregistrar" action="registrosolicitudexternaservices.php" method="post" enctype="multipart/form-data">
<input type="hidden" id="idAutorizador"  name="idAutorizador" />
<input type="hidden" id="numruc" name="numruc" />
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

$sql = "SELECT tip.idecapacitacion, tip.desccapacitacion 
FROM calendcapacitaciones calend 
INNER JOIN tipcapacitaciones tip 
ON calend.idecapacitacion = tip.idecapacitacion 
WHERE tip.estado = 1 
AND calend.estado = 1
-- AND DATE_FORMAT(calend.hora, '%Y-%m-%d') = CURDATE() 
AND tip.ideempresa = 3
AND calend.hora >= DATE_SUB(NOW(),INTERVAL 1 DAY) 
GROUP BY 1, 2 
ORDER BY calend.idecalendcapacitaciones DESC;";

$result = $conexion->query($sql); 

if ($result->num_rows > 0)
{
    $combobit = "<option value=''></option>";
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $combobit .= " <option value='" . $row['idecapacitacion'] . "'>" .$row['desccapacitacion']. "</option>"; //concatenamos el los options para luego ser insertado en el HTML
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
				<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nombre de empresa: </label>

										<div class="col-sm-9">
											<input type="text" name="razons" id="razons" placeholder="" readonly='true' class="form-control col-xs-10 col-sm-5" required/>
										</div>
				</div>

				<div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tipo de Capacitación:  </label>
	
				<?php
				/*
				$conexion = @new mysqli($servid, $user, $passw, $bdsist);

				if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
				{
					die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
				}
				mysqli_set_charset($conexion, 'utf8');
				$sql = "SELECT * from tipcapacitaciones where estado = 1 and empresa = 3;";
				$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable

				if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
				{
					$combobit = "<option value=''></option>";
					while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
						$combobit .= " <option value='" . $row['idecapacitacion'] . "'>" . $row['desccapacitacion'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
					}
				} else {
					echo "";
				}

				$conexion->close();*/
				?>
            	<div class="col-sm-9">
                	<select class="form-control" name="tipcapacitaciones" id="tipcapacitaciones" data-placeholder="Seleccione la capacitación" required>
                	  <?php echo $combobit; ?>
                	</select>
              	</div>
              </div>

			  <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Elige tu horario:</label>

								<div class="col-sm-9" id="content_horario">
									<select class="form-control" name="horario_r" id="horario_r" required>	
									<option value="0">---Seleccione---</option>							
									</select>
								</div>
							</div>
							<div class="form-group" id="cuposdispo">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Cupos Disponibles: </label>

										<div class="col-sm-9" id="cuposlibres">
											<input type="text" name="cuposdispo" id="cuposdispo" placeholder="" class="col-xs-10 col-sm-5" readonly required/>
										</div>
							</div>
							<div class="form-group" id="numpart">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> N&uacute;mero de Participantes: </label>

										<div class="col-sm-9" id="numparticip">
											<input type="number" name="numpart" id="numpart" onkeypress="return solonumero(event);" readonly required/>
										</div>
							</div>
							
							<div class="form-group alert alert-danger" id="sin_cupos" name="sin_cupos" hidden>
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">.</label>
								<div class="col-sm-9">
									<strong>
										<i class="ace-icon fa fa-times"></i>
										Alerta! 
									</strong>
										No hay cupos para la fecha seleccionada, verifique en el Módulo de Capacitaciones.
									<br />
								</div>
							</div>							

							<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Correo: </label>

										<div class="col-sm-9">
											<input type="email" name="email" id="email" placeholder="" class="col-xs-10 col-sm-5" />
										</div>
							</div>
							<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Número de Contacto (celular): </label>

										<div class="col-sm-9">
											<input type="text" name="numcontac" id="numcontac" placeholder="" class="col-xs-10 col-sm-5"  onkeypress="return solonumero(event);" required/>
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
								<div class="hr hr32 hr-dotted"></div>
							-->

								<script>
								$(function(){
									$('#botoncito').on('click', function(){
									var ruc = $('#ruc').val();
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
												$('#razons').val(datos[0]);
												$('#numruc').val(datos[1]);
											}		
									}
									});
									return false;
									});
								});
								</script>
								<script>
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

									$(function(){
										$('#tipcapacitaciones').on('change', function(){
										var tipcapacitaciones = $('#tipcapacitaciones').val();
										var url = 'busquedahorarios.php';
										var text = ''
										//$('.ajaxgif').removeClass('hide');
										$.ajax({
										type:'POST',
										url:url,
										data:'tipcapacitaciones='+tipcapacitaciones,
										success: function(response){
											var datos = JSON.parse(response);
											$('#cuposlibres').html(` 
											<input type="text" name="cuposdispo" id="form-field-1" placeholder="" class="col-xs-10 col-sm-5" value="" readonly />
											`);
											var output = ['<option value="0">---Seleccione---</option>']
											datos.data.forEach(item => {
											output.push(`<option value="${item.idecalendcapacitaciones}">${item.hora}</option>`);				
											});
											console.log($('#horario_r').get(0));
											$('#horario_r').get(0).innerHTML = output.join('');
										}
										});
										return false;
										});
										});	
									
										$(function(){
											$('#horario_r').on('change', function(){
											var horario = $('#horario_r').val();
											//console.log(horario);
											var url = 'busquedacupos.php';
											var text = '';
											var cantmax = '';
											//$('.ajaxgif').removeClass('hide');
											$.ajax({
											type:'POST',
											url:url,
											data:'horario='+horario,
											success: function(response){
												//$('.ajaxgif').addClass('hide');
												var datos = JSON.parse(response);
												datos.data.forEach(item => {
												text += `${item.cuposdispo}`

												if(text >= 10)
													{cantmax = 10;}
												else 
													{cantmax = text;}
												});

												if (text <= 0)
												{		
													$("#cuposdispo").hide();
													$("#numpart").hide();
													$("#sin_cupos").show();
												}
												else 
												{
													$("#cuposdispo").show();
													$("#numpart").show();
													$("#sin_cupos").hide();

												$('#cuposlibres').html(` 
												<input type="text" name="cuposdispo" id="form-field-1" placeholder="" class="col-xs-10 col-sm-5" value="${text}" readonly />
												`);

												$('#numparticip').html(`
												<input type="number" name="numpart" id="numpart"  min="1" max="${cantmax}" onkeypress="return solonumero(event);" pattern="^[0-${text}]+" autocomplete="off" onpaste="return false" value="${cantmax}"/>
												`);
												}


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
			/*
			document.getElementById("idesolicitud").onchange = function(){
				var opt = this.options[this.selectedIndex];
				var textContent = opt.text.split("-");
				rucdato.value = opt.text.slice(0,11);
				razonsdato.value = textContent.slice(-2)[0];
			}
				
				var dayTag = document.getElementById("diacapacitacion");
				var houtTag = document.getElementById("horacapacitacion");

				document.getElementById("tipcapacitaciones").onchange = function(){
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
			*/
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
