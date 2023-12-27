<?php
require('conexion.php');
header('Content-Type: text/html; charset=UTF-8');  
$busqueda=$_POST['busqueda'];

if ($busqueda<>''){
	
	$trozos=explode(" ",$busqueda);
	$numero=count($trozos);

	if ($numero==1) {
		
		$cadbusca="SELECT pi.documento, pi.ape_paterno,pi.ape_materno,pi.nombres, pi.cargo,pi.empresa, pi.foto,pi.ruc
		from personal_induccion pi, tipcapacitaciones tc
		where pi.idecapacitacion = tc.idecapacitacion
		and pi.documento = '$busqueda' GROUP BY pi.documento;";
		
		$foto=" SELECT pi.fecha, pi.nota,	tc.desccapacitacion, tc.nombrecorto, tc.codificacion, tc.image, pi.documento, 
		CONCAT_WS(' ',pi.ape_paterno, pi.ape_materno, pi.nombres) as nombcompleto, 
		pi.empresa, pi.ruc, tc.texto_cert, pi.horas,
		CONCAT(DATE_FORMAT(pi.fecha, '%d'), (DATE_FORMAT(pi.fecha, '%m'))) as diames, 
		CONCAT(DATE_FORMAT(pi.fecha, '%d'), ' de ', DATE_FORMAT(pi.fecha, '%M'), ' de ', YEAR(pi.fecha)) as fecini, 
		CONCAT(DATE_FORMAT(pi.fecha, '%d'), ' de ', DATE_FORMAT(pi.fecha, '%M'), ' de ', YEAR(pi.fecha)+1) as fecfin 
		FROM personal_induccion pi 
		INNER JOIN tipcapacitaciones tc ON tc.idecapacitacion = pi.idecapacitacion WHERE pi.estado = 1 
		AND pi.documento = '$busqueda';";
	}
	function limitarPalabras($cadena, $longitud, $elipsis = "..."){
		$palabras = explode(' ', $cadena);
		if (count($palabras) > $longitud)
			return implode(' ', array_slice($palabras, 0, $longitud)) . $elipsis;
		else
			return $cadena;
	}
?>

					<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
<?php
	$result2=mysqli_query($con,$cadbusca);
	$k=1;
	while ($row2 = mysqli_fetch_array($result2)){
?>
								<div class="hr dotted"></div>
								<div>
									<div id="user-profile-1" class="user-profile row">
										<div class="col-xs-12 col-sm-3 center">
											<div>
												<span class="profile-picture">
													<img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src= "<?php echo $row2['foto'] ?>" />
												</span>

												<div class="space-4"></div>

<!--											<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
												</div>
												-->
												<div class="inline position-relative">
												</div>
											</div>
											<div class="space-6"></div>
											<div class="profile-contact-info">
												<div class="space-6"></div>
												<div class="profile-social-links align-center">
												</div>
											</div>
											<div class="hr hr12 dotted"></div>
											<div class="clearfix">
											</div>
										</div>

										<div class="col-xs-12 col-sm-9">
											<div class="center">
								<ul class='ace-thumbnails clearfix'>
<?php $k++; }?>

<?php
	
	mysqli_query($con, "SET lc_time_names = 'es_PE'" );
	mysqli_query($con, "SET NAMES 'utf8'");
	$result1=mysqli_query($con,$foto);
	$j=1;
	while ($row1 = mysqli_fetch_array($result1)){
	
     echo "	 
		
		 <li style='border: 0px;'>
			  <div class='inline position-fixed'>
			     <div> 
		 	 	   <img width='150' height='150' alt='150x150' src=" .$row1['image']." border='0'/>
			     </div>
			     <div class='tags'>
					<span class='label-holder'>
						 <span class='label label-info'>" .$row1['nombrecorto']. "</span>
					</span>
					<span class='label-holder'>
						 <span class='label label-danger'>Nota: " .$row1['nota']. "</span>
					</span>
					<span class='label-holder'>
						 <span class='label label-success'>Fecha: " .$row1['fecha']. "</span>
					</span>
				 </div>
			 
			  </div>
			  <div>
			  <!--
			  	<a href='Infcertifica.php?variable1=".$row1['desccapacitacion']."&variable2=".$row1['documento']."&variable3=".$row1['empresa']."&variable4=".$row1['nombcompleto']."&variable5=".$row1['codificacion']."&variable6=".$row1['texto_cert']."&variable7=".$row1['diames']."&variable8=".$row1['fecini']."&variable9=".$row1['fecfin']."&variable10=".$row1['horas']."' class='btn btn-app btn-success btn-xs'>
			  		<i class='ace-icon fa fa-download bigger-120'></i>
			  	</a>
			  -->
			  </div>
		 </li>


		 
	 ";
	$j++; } ?>
</ul>
											
											</div>


<?php
	
	$result=mysqli_query($con, $cadbusca);
	
	$i=1;
	while ($row = mysqli_fetch_array($result)){
?>

											<div class="space-12"></div>

											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Nombres </div>

													<div class="profile-info-value">
														<span class="editable" id="name"><?php echo $row['nombres'] ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Ap. Paterno </div>

													<div class="profile-info-value">
														<span class="editable" id="appaterno"><?php echo $row['ape_paterno'] ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Ap. Materno </div>

													<div class="profile-info-value">
														<span class="editable" id="apmaterno"><?php echo $row['ape_materno'] ?></span>
													</div>
												</div>																								
												<!--<div class="profile-info-row">
													<div class="profile-info-name"> T. Documento </div>

													<div class="profile-info-value">
														<span class="editable" id="tipdoc"></span>
													</div>
												</div>-->
												<div class="profile-info-row">
													<div class="profile-info-name"> Documento </div>

													<div class="profile-info-value">
														<span class="editable" id="numdoc"><?php echo $row['documento'] ?></span>
													</div>
												</div>												
												<div class="profile-info-row">
													<div class="profile-info-name"> Empresa </div>

													<div class="profile-info-value">
														<span class="editable" id="empresa"><?php echo $row['empresa'] ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> RUC </div>

													<div class="profile-info-value">
														<span class="editable" id="ruc"><?php echo $row['ruc'] ?></span>
													</div>
												</div>
											</div>
<?php $i++; }?>
											<div class="space-20"></div>

											<div class="widget-box transparent">
												</div>

												<div class="widget-body">
													
												</div>
											</div>

											<div class="hr hr2 hr-double"></div>

											<div class="space-6"></div>

											<div class="center">
											</div>
										</div>
									</div>
								</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
<?php
}
	else{
		echo "Ingrese un Documento Válido.";
	}
?>