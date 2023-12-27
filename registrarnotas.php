<?php
require_once "./conf.php";
header("Content-Type: text/html;charset=utf-8");
$tpl = new Plantilla();

$BD = new ConexionDB();

$pagina = $_GET['pagina'];
session_start();
$tpl->assign('tipo', $_SESSION['tipo']);
$tpl->assign('acceso', $_SESSION['acceso']);

//controlar el tiempo de sesion
$se = new ValidacionDAO();
$vari = $se->TiempoSesion();

/* Abrimos la base de datos */
$conx = mysqli_connect($servid, $user, $passw, $bdsist);
if (!$conx) {
    die("Error al abrir la base <br/>" . mysqli_error());
}

//mysqli_select_db($bdsist,$conx) OR die("Connection Error to Database");
$sql1 = 'SET lc_time_names = "es_ES"';
$sql2 = 'SELECT tc.desccapacitacion as desccapacitacion,
cc.hora as hora,
concat(cp.apepaterno, " ", cp.apematerno, ", ", cp.nombres) as nombresape,
cc.cupos as cupos,
cc.cuposdispo as cuposdispo
FROM calendcapacitaciones cc
INNER JOIN tipcapacitaciones tc on cc.idecapacitacion = tc.idecapacitacion
LEFT JOIN capacitador cp on cc.idecapacitador = cp.idecapacitador
ORDER BY idecalendcapacitaciones DESC';

$result1 = mysqli_query($conx, $sql1) or die(mysqli_error());
$result2 = mysqli_query($conx, $sql2) or die(mysqli_error());

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
		<link rel="stylesheet" href="assets/css/ui.jqgrid.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-timepicker.min.css" />
		<script type="text/javascript" src="busqueda/funciones.js"></script>
		<link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />


		<script src="assets/js/ace-extra.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

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
include $_SESSION['menu'];
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

					</div>
				<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">
   						<div class="ace-settings-box clearfix" id="ace-settings-box">

							</div>	<!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->

						<div class="page-header">
							<h1>
								Registrar Notas
								<small>
								<!--	<i class="ace-icon fa fa-angle-double-right"></i>-->

								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">


<script type="text/javascript">

window.onload = function() {
	
	/*
	var myInput = document.getElementById('form-field-1');
  myInput.onpaste = function(e) {
    e.preventDefault();
    alert("esta acción está prohibida");
  }

  myInput.oncopy = function(e) {
    e.preventDefault();
    alert("esta acción está prohibida");
  }
  */
}

var numero = 0;

// Funciones comunes
c= function (tag) { // Crea un elemento
   return document.createElement(tag);
}
d = function (id) { // Retorna un elemento en base al id
   return document.getElementById(id);
}
e = function (evt) { // Retorna el evento
   return (!evt) ? event : evt;
}
f = function (evt) { // Retorna el objeto que genera el evento
   return evt.srcElement ?  evt.srcElement : evt.target;
}

addField = function () {
   container = d('files');

   span = c('SPAN');
   span.className = 'file';
   span.id = 'file' + (++numero);

   field = c('INPUT');
   field.name = 'archivos[]';
   field.type = 'file';

   a = c('A');
   a.name = span.id;
   a.href = '#';
   a.onclick = removeField;
   a.innerHTML = 'Quitar';

   span.appendChild(field);
   span.appendChild(a);
   container.appendChild(span);
}
removeField = function (evt) {
   lnk = f(e(evt));
   span = d(lnk.name);
   span.parentNode.removeChild(span);
}

function spacio(e){
	tecla=(document.all) ? e.keyCode : e.which;
	return tecla!=32;
}
</script>

<form class="form-horizontal" role="form" id="frm" name="formregistrar" action="cierrenotas.php" method="post" enctype="multipart/form-data">
<script language="javascript">
   function solonumero(e){
var keynum = window.event ? window.event.keyCode : e.which;
if((keynum==8) || (keynum==46))
return true;

return /\d/.test(String.fromCharCode(keynum));
}

</script>

							<div class="form-group">
							<fieldset >
							<div id="resultcontra" >
							</div>
							</fieldset>
							</div>

							<div class="clearfix form-actions">
							<div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tipo de Capacitación:  </label>

<?php
$conexion = @new mysqli($servid, $user, $passw, $bdsist);

if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
}
mysqli_set_charset($conexion, 'utf8');
//$sql = "SELECT * from tipcapacitaciones where estado = 1";
$sql = 'SELECT calend.idecapacitacion, tip.desccapacitacion, tip.ideempresa 
FROM calendcapacitaciones calend
INNER JOIN tipcapacitaciones tip
ON calend.idecapacitacion = tip.idecapacitacion
WHERE tip.estado = 1
AND calend.hora >= DATE_SUB(NOW(),INTERVAL 2 DAY)
AND calend.asistenciascerradas = 1 
AND calend.notascerradas = 0 
AND calend.idecapacitador = ' . $_SESSION['idecapacitador'] . ' 
GROUP BY 1, 2 
ORDER BY calend.idecalendcapacitaciones DESC;';
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

$conexion->close();
?>
             <div class="col-sm-9">
                <select class="chosen-select form-control" id="tipcapacitaciones" name="tipcapacitaciones" id="form-field-select-3" data-placeholder="Seleccione la capacitación" required>
                  <?php echo $combobit; ?>
                </select>
              </div>

              </div>
			  <div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Elige el horario:</label>

							<div class="col-sm-9" id="content_horario">
								<select class="form-control" name="horario_r" id="horario_r" required>
								<option value="0">---Seleccione---</option>
								</select>
							</div>
			   </div>
			   <div class="col-md-offset-3 col-md-9">
										<button class="btn btn-info" type="submit" id="postback" name="postback" accesskey="6">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Cerrar Notas
										</button>
										</div>
					</div>

					</form>

					<script>
							var ideempresa;
							$(function(){
								
								$('#tipcapacitaciones').on('change', function(){
								var tipcapacitaciones = $('#tipcapacitaciones').val();
								var url = 'busquedahorariosnotas.php';
								
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
									ideempresa = item.ideempresa;
									console.log(`${item.ideempresa}`);
									console.log(ideempresa);
									});
									
									$('#horario_r').get(0).innerHTML = output.join('');
								}
								});
								return false;
								});
							});

							$(function(){
								$('#horario_r').on('change', function(){
									var horario = $('#horario_r').val();
									/*
									var ideempresa;
									//var url = `serv_carga_notas.php?horario=${horario}`;
									var url1 = 'consulta_tipempresa.php';
									$.ajax({
										type:'POST',
										url:url1,
										data:'horario='+horario,
										success: function(datos_dni){
											$('.ajaxgif').addClass('hide');
											var datos = eval(datos_dni);
												var nada ='nada';
												if(datos[0]==nada){
													alert('DNI o RUC no válido o no registrado');
												}else{
													ideempresa = datos[0];
												}		
										}
										});*/
									console.log(ideempresa);
									
									if(ideempresa == 1 || ideempresa == 2)
									{
										var url = `serv_carga_notasint.php?horario=${horario}`;
										$("#tablanotasint").show();
									 	$("#tablanotasext").hide();
										$("#grid-tableint").jqGrid('setGridParam', { url: url });
    									$("#grid-tableint").trigger("reloadGrid");										
									}
									else if(ideempresa == 3)
									{
										var url = `serv_carga_notasext.php?horario=${horario}`;
										$("#tablanotasext").show();
									 	$("#tablanotasint").hide();
										$("#grid-tableext").jqGrid('setGridParam', { url: url });
    									$("#grid-tableext").trigger("reloadGrid");
									}
									
									return false;
								});
							});
					</script>

										<div class="row" id="tablanotasint">
											<div class="col-xs-12">
											<table id="grid-tableint">
											</table>
											<div id="grid-pagerint">
											</div>
											</div><!-- /.col -->
										</div><!-- /.row -->

										<div class="row" id="tablanotasext">
											<div class="col-xs-12">
											<table id="grid-tableext">
											</table>
											<div id="grid-pagerext">
											</div>
											</div><!-- /.col -->
										</div><!-- /.row -->

								<div class="hr hr32 hr-dotted"></div>
								<div id="table1"></div>
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
		<script src="assets/js/jquery.easypiechart.min.js"></script>
		<script src="assets/js/jquery.sparkline.min.js"></script>
		<script src="assets/js/jquery.flot.min.js"></script>
		<script src="assets/js/jquery.flot.pie.min.js"></script>
		<script src="assets/js/jquery.flot.resize.min.js"></script>
    	<script src="assets/js/chosen.jquery.min.js"></script>
    	<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/bootstrap-timepicker.min.js"></script>
		<script src="assets/js/jquery.jqGrid.min.js"></script>
		<script src="assets/js/grid.locale-en.js"></script>
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		<script type="text/javascript">
			$("#tablanotasint").hide();
			$("#tablanotasext").hide();
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

			var rowsToColor=[];
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
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
						size: size
					});
				})

				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html',
									 {
										tagValuesAttribute:'data-values',
										type: 'bar',
										barColor: barColor ,
										chartRangeMin:$(this).data('min') || 0
									 });
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

			  //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;

			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  /*
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne",
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);*/

			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 //placeholder.data('draw', drawPieChart);


			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;

			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}

			 });

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

				/*
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});*/


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

			var grid_selector = "#grid-tableint";
			var pager_selector = "#grid-pagerint";

			var grid_selector1 = "#grid-tableext";
			var pager_selector1 = "#grid-pagerext";

				//resize to fit page size
				$(window).on('resize.jqGrid', function () {
					$(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
			    });
				//resize on sidebar collapse/expand
				var parent_column = $(grid_selector).closest('[class*="col-"]');
				$(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
					if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
						//setTimeout is for webkit only to give time for DOM changes and then redraw!!!
						setTimeout(function() {
							$(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
						}, 0);
					}
			    });

				//resize to fit page size
				$(window).on('resize.jqGrid', function () {
					$(grid_selector1).jqGrid( 'setGridWidth', $(".page-content").width() );
			    });
				//resize on sidebar collapse/expand
				var parent_column = $(grid_selector1).closest('[class*="col-"]');
				$(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
					if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
						//setTimeout is for webkit only to give time for DOM changes and then redraw!!!
						setTimeout(function() {
							$(grid_selector1).jqGrid( 'setGridWidth', parent_column.width() );
						}, 0);
					}
			    });				
				
				jQuery(grid_selector1).jqGrid({
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
					
					url:'serv_carga_notasext.php',
					data: grid_data,
					datatype: "json",
					height: 400,
					colNames:['', 'Código', 'Num. Documento',  'Nombres','Ape. Paterno', 'Ape. Materno', 'Cargo', 'Nota T.', 'Nota P.', 'Nota F.', 'Empresa', 'Observaciones'],
					colModel:[
						{name:'select',index:'select', width:80, fixed:true, sortable:false, resize:false,
							formatter:'actions',
							formatoptions:{
								keys:true,
								delbutton: false,//disable delete button
								delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback,type: 'POST',datatype: 'json'},
								editOptions:{recreateForm: true, beforeShowForm:beforeEditCallback,type: 'POST',datatype: 'json'}
							}
						},
						{name:'idepersonal',index:'idepersonal', width:20, editable: true, hidden: true },
						{name:'documento', index:'documento', width:30,editable: false,editoptions:{size:"60",maxlength:"150"}},
						{name:'nombres',index:'nombres', width:35, editable: false},
						{name:'ape_paterno', index:'ape_paterno', width:35,editable: false,editoptions:{size:"60",maxlength:"150"}},
						{name:'ape_materno', index:'ape_materno', width:35,editable: false,editoptions:{size:"60",maxlength:"150"}},
						{name:'cargo', index:'cargo', width:35,editable: true,editoptions:{size:"60",maxlength:"150"}},
						{name:'nota_teorica', index:'nota_teorica', width:20,editable: true,editoptions:{size:"60",maxlength:"150"}},
						{name:'nota_practica', index:'nota_practica', width:20,editable: true,editoptions:{size:"60",maxlength:"150"}},
						{name:'nota_final', index:'nota_final', width:20, formatter: rowcolor, sortable:true, editable: false,editoptions:{size:"60",maxlength:"150"}},
						{name:'empresa', index:'empresa', width:70,editable: false,editoptions:{size:"60",maxlength:"150"}},
						{name:'observaciones', index:'observaciones', width:60,editable: true,editoptions:{size:"60",maxlength:"150"}}
//						{name: "closed", width: 70, align: "center", formatter: "checkbox", formatoptions: { disabled: false},edittype: "checkbox", editoptions: {value: "Yes:No", defaultValue: "Yes"}, stype: "select", searchoptions: { sopt: ["eq", "ne"], value: ":Any;true:Yes;false:No" } }
					],
					viewrecords : true,
					rowNum:15,
					rowList:[10,20,30],
					pager : pager_selector1,
					altRows: true,
					//toppager: true,

					multiselect: false,
					//multikey: "ctrlKey",
			        multiboxonly: false,

					loadComplete : function() {
						var table = this;
						var rowsToColor = [];
						setTimeout(function(){
							styleCheckbox(table);
							updateActionIcons(table);
							updatePagerIcons(table);
							enableTooltips(table);
						}, 0);
						/*
						for(var i=0;i<rowsToColor.lenght; i++)
						{
							var nota = $("#" + rowsToColor[i]).find("td").eq(9).html();
							if(nota < 11){
								$("#" + rowsToColor[i]).find("td").css("background-color", "red");
							}
							else
								$("#" + rowsToColor[i]).find("td").css("background-color", "blue");

						}
						for (var i = 0; i < rowsToColor.length; i++) {
							$("#" + rowsToColor[i]).find("td").not(':eq(0)').css("background-color", "#FF7F7F");
							$("#" + rowsToColor[i]).find("td").not(':eq(0)').css("color", "black");
							}*/
					},

					editurl: "serv_actualiza_notasext.php",
					caption: "Registro de Notas",

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
					gridComplete: function(){
						var rows = $("#grid-tableext").getDataIDs(); 
						for (var i = 0; i < rows.length; i++){
						var nota_final = $("#grid-tableext").getCell(rows[i],"nota_final");
							if(nota_final < 11){
							$("#grid-tableext").jqGrid('setRowData',rows[i],false, {       
									color:'white',weightfont:'bold',background:'#a94442' });            
							}
							else {
							$("#grid-tableext").jqGrid('setRowData',rows[i],false, {       
									color:'black',weightfont:'bold',background: '#C7D3A9' });  	
							}
							}
					}
				});


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
					
					url:'serv_carga_notasint.php',
					data: grid_data,
					datatype: "json",
					height: 400,
					colNames:['', 'Código', 'Num. Documento',  'Nombres','Ape. Paterno', 'Ape. Materno', 'Cargo', 'Nota F.', 'Empresa', 'Observaciones'],
					colModel:[
						{name:'select',index:'select', width:80, fixed:true, sortable:false, resize:false,
							formatter:'actions',
							formatoptions:{
								keys:true,
								delbutton: false,//disable delete button
								delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback,type: 'POST',datatype: 'json'},
								editOptions:{recreateForm: true, beforeShowForm:beforeEditCallback,type: 'POST',datatype: 'json'}
							}
						},
						{name:'idepersonal',index:'idepersonal', width:20, editable: true, hidden: true },
						{name:'documento', index:'documento', width:30,editable: false,editoptions:{size:"60",maxlength:"150"}},
						{name:'nombres',index:'nombres', width:60, editable: false},
						{name:'ape_paterno', index:'ape_paterno', width:60,editable: false,editoptions:{size:"60",maxlength:"150"}},
						{name:'ape_materno', index:'ape_materno', width:60,editable: false,editoptions:{size:"60",maxlength:"150"}},
						{name:'cargo', index:'cargo', width:60,editable: true,editoptions:{size:"60",maxlength:"150"}},
						//{name:'nota_teorica', index:'nota_teorica', width:20,editable: true,editoptions:{size:"60",maxlength:"150"}},
						//{name:'nota_practica', index:'nota_practica', width:20,editable: true,editoptions:{size:"60",maxlength:"150"}},
						{name:'nota_final', index:'nota_final', width:20, formatter: rowcolor, sortable:true, editable: true,editoptions:{size:"60",maxlength:"150"}},
						{name:'empresa', index:'empresa', width:60,editable: false,editoptions:{size:"60",maxlength:"150"}},
						{name:'observaciones', index:'observaciones', width:60,editable: true,editoptions:{size:"60",maxlength:"150"}}
//						{name: "closed", width: 70, align: "center", formatter: "checkbox", formatoptions: { disabled: false},edittype: "checkbox", editoptions: {value: "Yes:No", defaultValue: "Yes"}, stype: "select", searchoptions: { sopt: ["eq", "ne"], value: ":Any;true:Yes;false:No" } }
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
						for (var i = 0; i < rowsToColor.length; i++) {
                                $("#" + rowsToColor[i]).find("td").css("background-color", "#FF7F7F");
                                $("#" + rowsToColor[i]).find("td").css("color", "black");
                    	}
					},

					editurl: "serv_actualiza_notasint.php",
					caption: "Registro de Notas",

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
					gridComplete: function(){
						var rows = $("#grid-tableint").getDataIDs(); 
						for (var i = 0; i < rows.length; i++){
						var nota_final = $("#grid-tableint").getCell(rows[i],"nota_final");
							if(nota_final < 11){
							$("#grid-tableint").jqGrid('setRowData',rows[i],false, {       
									color:'white',weightfont:'bold',background:'#a94442' });            
							}
							else {
							$("#grid-tableint").jqGrid('setRowData',rows[i],false, {       
									color:'black',weightfont:'bold',background: '#C7D3A9' });  	
							}
							}
							
					}
				});

				$(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size

				//enable search/filter toolbar
				//jQuery(grid_selector).jqGrid('filterToolbar',{defaultSearch:true,stringResult:true})
				//jQuery(grid_selector).filterToolbar({});

				
				function rowcolor(cellValue, options, rowObject) {
						if (cellValue < 11)
							rowsToColor[rowsToColor.length] = options.rowId;
						return cellValue;
				}

				function rowColorFormatter(cellVallue, options, cell){
					if(cellVallue < 11)
					{
						$(cell).addClass("red");
						//$("#" + rowsToColor[i]).find("td").css("background-color", "red");
					}
					else
						$("#" + rowsToColor[i]).find("td").css("background-color", "blue");

					//if(cellVallue > 0)
						//rowsToColor[rowsToColor.lenght] = options.rowId;
					return cellVallue;
				}

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
				
				jQuery(grid_selector1).jqGrid('navGrid',pager_selector1,
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
					$(grid_selector1).jqGrid('GridUnload');
					$('.ui-jqdialog').remove();
				});


			})
		</script>
	</body>
</html>
