<!-- Content Wrapper. Contains page content -->

<?php $camion=$this->session->userdata('camion');?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Camión<small>Ficha</small></h1>
		<ol class="breadcrumb">
			<li><a href='<?php echo site_url().'/docFlota' ?>'><span class='fa fa-truck'></span>Transportista</a></li>
			<li><a href='<?php echo site_url().'/cargarFichaDoc' ?>'><span class='glyphicon glyphicon-folder-open'></span>Camión</a></li>
			<li class='active'><a>Ficha</a></li>
		</ol>

	</section>
	
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Detalle</h3>
				<div class="box-tools pull-right">
					<div class="btn-group">
						<a href="javascript:window.history.back();" class="btn btn-box-tool"><i class="fa fa-reply"></i> Volver atrás</a>
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				

			</div>
			<div class="box-body">
				<form Method='POST' enctype="multipart/form-data" action="<?php echo site_url();?>/updateCamion" id="formUpdCamion">
					<!--DATOS CAMION-->
					<div class="row">
						<div class="col-sm-12">
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="id_proveedor">Código</label>
										<input type="input" name='cod_camion' class="form-control" id="cod_camion" value="<?php print $camion->CODCAMION?>" readonly="true">
									</div>	
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Patente</label>
										<input type="input" class="form-control" value="<?php print $camion->PATENTE?>" readonly="true">
									</div>	
								</div>
							</div>
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class="form-group">
										<label >Marca</label>
										<input type="input" class="form-control"  value="<?php print $camion->MARCA?>" readonly="true">
									</div>	
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Modelo</label>
										<input type="input" class="form-control" value="<?php print $camion->MODELO?>" readonly="true">
									</div>	
								</div>
							</div>
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class="form-group">
										<label >N° Motor</label>
										<input type="input" class="form-control" id="n_motor" name='n_motor' maxlength="11" value="<?php ($camion->N_MOTOR == null? print 0 : print $camion->N_MOTOR)?>">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>N° Chasis</label>
										<input type="input" class="form-control" id="n_chasis" name="n_chasis" maxlength="11"  value="<?php ($camion->N_CHASIS == null ? print 0 : print $camion->N_CHASIS)?>">
									</div>	
								</div>
							</div>
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class="form-group">
										<label >Año</label>
										<input type="input" class="form-control" name="anno" id="anno" maxlength="4" value="<?php ($camion->ANNO==null? print 1903 : print $camion->ANNO)?>">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Capacidad carga</label>
										<input type="input" class="form-control" value="<?php print $camion->CAPACIDAD_CARG?>" readonly="true">
									</div>	
								</div>
							</div>
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class="form-group">
										<label >Estado camion</label>
										<input type="input" class="form-control"  value="<?php print $camion->ESTADO_CAMION?>" readonly="true">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Tipo camión</label>
										<select class="form-control select2" id='tipoCamion' name='tipoCamion'>
											<option selected="true" value="<?php ($camion->TIPO_CAMION==null? print 'No registrado' : print $camion->TIPO_CAMION)?>" ><?php ($camion->TIPO_CAMION==null? print 'No registrado' : print $camion->TIPO_CAMION) ?></option>
											<option value="Punto a punto">Punto a punto</option>
											<option value='Cobertura'>Cobertura</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Sistema de frio</label>
										<select class="form-control select2" id='sisFrio' name='sisFrio'>
											<option selected="true" value="<?php ($camion->TIPOCOMBUSTIBLE==null? print 'No registrado' : print $camion->TIPOCOMBUSTIBLE)?>" ><?php ($camion->TIPOCOMBUSTIBLE==null? print 'No registrado' : print $camion->TIPOCOMBUSTIBLE) ?></option>
											<option value="Vencina">Bencina</option>
											<option value="Autonoma">Autonoma</option>
											<option value="Petroleo">Petroleo</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Estado camión</label>
										<select class="form-control select2" id='estadoCamion' name='estadoCamion'>
											<option selected="true" value="<?php ($camion->ESTADO_CAMION==null? print 'No registrado' : print $camion->ESTADO_CAMION)?>" ><?php ($camion->ESTADO_CAMION==null? print 'No registrado' : print $camion->ESTADO_CAMION) ?></option>
											<option value="H">H</option>
											<option value="D">D</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Uni. de frio</label><br/>
										<?php
										if($camion->UNIDADFRIO!='SI'){
											print "<input type='checkbox' class='minimal icheckbox_flat-green' id='uniFrio' name='uniFrio' value='NO'/>";
										}else{
											print "<input type='checkbox' class='minimal icheckbox_flat-green' checked id='uniFrio' name='uniFrio' value='SI'/>";
										}
										?>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Separador</label><br/>
										<?php
										if($camion->SEPARADOR=='SI'){
											print "<input type='checkbox' class='minimal icheckbox_flat-green' name='separador' checked id='separador' value='SI'/>";
										}else{
											print "<input type='checkbox' class='minimal icheckbox_flat-green' id='separador' name='separador' value='NO'/>";
										}
										?>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Fijo</label><br/>
										<?php
										if($camion->FIJO=='SI'){
											print "<input type='checkbox' class='minimal icheckbox_flat-green' checked id='fijo' name='fijo' value='SI'/>";
										}else{
											print "<input type='checkbox' class='minimal icheckbox_flat-green' id='fijo' name='fijo' value='NO'/>";
										}
										?>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>GPS</label><br/>
										<?php
										if($camion->GPS=='SI'){
											print "<input type='checkbox' class='minimal icheckbox_flat-green' checked id='gps' name='gps' value='SI'/>";
										}else{
											print "<input type='checkbox' class='minimal icheckbox_flat-green' id='gps' name='gps' value='NO'/>";
										}
										?>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class="form-group">
										<label>SDL</label><br/>
										<?php
										if($camion->SDL=='SI'){
											print "<input type='checkbox' class='minimal icheckbox_flat-green' checked id='sdl' name='sdl' value='SI'/>";
										}else{
											print "<input type='checkbox' class='minimal icheckbox_flat-green' id='sdl' name='sdl' value='NO'/>";
										}
										?>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Publicidad</label><br/>
										<?php
										if($camion->PUBLICIDAD=='SI'){
											print "<input type='checkbox' class='minimal icheckbox_flat-green' checked name='publicidad' id='publicidad' value='SI'/>";
										}else{
											print "<input type='checkbox' class='minimal icheckbox_flat-green' name='publicidad' id='publicidad' value='NO'/>";
										}
										?>
									</div>
								</div>
							</div>
							<div class="col-sm-12 well well-sm">
								<div class='col-sm-6'>
									<div class="form-group">
										<label>Dimensiones carroceria</label><br/>
										<div class="">
											<div class="col-sm-6">
												<label>Laterales[m]</label><br/>
												<input type='number' maxlength="4" min="0" max="500" class='form-control col-sm-3' value="<?php ($camion->LATERALES_ANCHO==null? print 0 : print $camion->LATERALES_ANCHO)?>" name='latAncho'/>
												<input type='number' maxlength="4" min="0" max="500" class='form-control col-sm-3'  value="<?php ($camion->LATERALES_ALTO==null? print 0 : print $camion->LATERALES_ALTO)?>" name='latAlto'/>
											</div>
											<div class="col-sm-6">
												<label>BackTrack[m]</label><br/>
												<input type='number' class='form-control col-sm-3' maxlength="4" min="0" max="500" value="<?php ($camion->BACKTRACK_ANCHO==null? print 0 : print $camion->BACKTRACK_ANCHO)?>" name='BTAncho'/>
												<input type='number' class='form-control col-sm-3' maxlength="4" min="0" max="500" value="<?php ($camion->BACKTRACK_ALTO==null? print 0 : print $camion->BACKTRACK_ALTO)?>" name='BTAlto'/>
											</div>
										</div>
									</div>										
								</div>
							</div>
							<div class="col-sm-12 well well-sm">
								<div class="form-group">
									<label>Inventario camión</label>
									<div class="col-sm-12">
										<div class='form-group col-sm-3'>
											<label>Gata</label><br/>
											<?php
											if($camion->GATA=='SI'){
												print "<input type='checkbox' class='minimal icheckbox_flat-green' checked name='gata' id='gata' value='SI'/>";
											}else{
												print "<input type='checkbox' class='minimal icheckbox_flat-green' name='gata' id='gata' value='NO'/>";
											}
											?>
										</div>
										<div class='form-group col-sm-3'>
											<label>Llave rueda</label><br/>
											<?php
											if($camion->LLAVE_RUEDA=='SI'){
												print "<input type='checkbox' class='minimal icheckbox_flat-green' checked name='llave_rueda' id='llave_rueda' value='SI'/>";
											}else{
												print "<input type='checkbox' class='minimal icheckbox_flat-green' name='llave_rueda' id='llave_rueda' value='NO'/>";
											}
											?>
										</div>
										<div class='form-group col-sm-3'>
											<label>Triangulos</label><br/>
											<?php
											if($camion->TRIANGULOS=='SI'){
												print "<input type='checkbox' class='minimal icheckbox_flat-green' checked name='triangulo' id='triangulo' value='SI'/>";
											}else{
												print "<input type='checkbox' class='minimal icheckbox_flat-green' name='triangulo' id='triangulo' value='NO'/>";
											}
											?>
										</div>
										<div class='form-group col-sm-3'>
											<label>Llave contacto</label><br/>
											<?php
											if($camion->LLAVE_CONTACTO=='SI'){
												print "<input type='checkbox' class='minimal icheckbox_flat-green' checked name='llave_contacto' id='llave_contacto' value='SI'/>";
											}else{
												print "<input type='checkbox' class='minimal icheckbox_flat-green' name='llave_contacto' id='llave_contacto' value='NO'/>";
											}
											?>
										</div>
										<div class='form-group col-sm-3'>
											<label>Extintor</label><br/>
											<?php
											if($camion->EXTINTOR=='SI'){
												print "<input type='checkbox' class='minimal icheckbox_flat-green' checked name='extintor' id='extintor' value='SI'/>";
											}else{
												print "<input type='checkbox' class='minimal icheckbox_flat-green' name='extintor' id='extintor' value='NO'/>";
											}
											?>
										</div>
										<div class='form-group col-sm-3'>
											<label>Radio</label><br/>
											<?php
											if($camion->RADIO=='SI'){
												print "<input type='checkbox' class='minimal icheckbox_flat-green' checked name='radio' id='radio' value='SI'/>";
											}else{
												print "<input type='checkbox' class='minimal icheckbox_flat-green' name='radio' id='radio' value='NO'/>";
											}
											?>
										</div>
										<div class='form-group col-sm-3'>
											<label>Rueda repuesto</label><br/>
											<?php
											if($camion->RUEDA_REPUESTO=='SI'){
												print "<input type='checkbox' class='minimal icheckbox_flat-green' checked name='rueda_repuesto' id='rueda_repuesto' value='SI'/>";
											}else{
												print "<input type='checkbox' class='minimal icheckbox_flat-green' name='rueda_repuesto' id='rueda_repuesto' value='NO'/>";
											}
											?>
										</div>
										<div class='form-group col-sm-3'>
											<label>Botiquin</label><br/>
											<?php
											if($camion->BOTIQUIN=='SI'){
												print "<input type='checkbox' class='minimal icheckbox_flat-green' checked name='botiquin' id='botiquin' value='SI'/>";
											}else{
												print "<input type='checkbox' class='minimal icheckbox_flat-green' name='botiquin' id='botiquin' value='NO'/>";
											}
											?>
										</div>
										<div id='fechaVigencia' class="form-group col-sm-3 hidden">
											<label>Fecha vigencia:</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" readonly="TRUE" id="dateVig" name='dateVig' value='<?php ($camion->FECHA_VIGENCIA==null? print "" : print $camion->FECHA_VIGENCIA) ?>'>

											</div>
											<!-- /.input group -->
										</div>
									</div>
								</div>
								
							</div>
							<div class="col-sm-12 well well-sm">
								<div class="form-group col-sm-12">
									<label>Imagenes del vehiculo</label>
									<div class="col-sm-12">
										<div class="table-responsive">
											<table>
												<tbody id="tbodyImgCamion">
												</tbody>
											</table>
										</div>
										
									</div>
								</div>
							</div>
							
							<div class="col-sm-4">
								<a class="btn btn-primary btn-block col-sm-3" data-toggle="modal" data-target="#imgModal"><i class="pull-left glyphicon glyphicon-camera"></i> Nueva imagen</a>
							</div>
							<div class="col-sm-4">
								<a href="javascript:window.history.back();" class="btn btn-default btn-block"><i class="fa fa-reply"></i> Volver atrás</a>
							</div>
							<div class=" col-sm-4">
								<a class="btn btn-block btn-success" id='btn_guardar'><i class="pull-left fa fa-save"></i>Guardar cambios</a>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- /.box-body -->
			<div class="box-footer text-center">

			</div>
		</div>
		<!-- BOX HISTORIAL-->
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title"></i>Historial documentos</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<div class="form-group col-sm-8">
								<label>Tipo de documento</label>
								<select class="form-control select2" id='tipoDocCamion' name='tipoDocCamion' ata-toggle="tooltip" data-placement="bottom" title="Seleccionar para historial">
								</select>
							</div>
							<div class="form-group col-sm-4">
								<label>Descargar seleccionados</label>
								<a class="btn btn-success form-control" id='btDescargar'>Descargar<i class="fa fa-download pull-left"></i></a>
							</div>
							<div class="form-group col-md-12">
								<table id='tablaHistoCamion' class="table table-hover table-bordered table-responsive">
									<thead class="btn-success">
										<tr>
											<td>Fecha Ingreso</td>
											<td>Estado</td>
											<td>Selección  | <input type='checkbox' class='minimal icheckbox_flat-green' id='checkAll' checked>
											</td>
											<td>Documento</td>
										</tr>
									</thead>
									<tbody id='tbHisCamion'></tbody>
								</table>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group col-sm-12">
								<label></label><br/>
								<div id='alertDownload' class="callout callout-danger hidden">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer text-center">

			</div>
			<!-- /.box-footer -->
		</div>
		
		<!-- /.box-footer-->
	</div>
	<!-- /.box -->
</section>
<!-- /.content -->
</div>

</section>
<!-- /.content -->
</div>

<div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header btn-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Subir foto del vehiculo</h4>
			</div>
			<div class="modal-body">
				<form id='formImgCamion' Method='POST' enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-6 hidden">
							<div class="form-group">
								<label>Código Camion</label>
								<input type="text" class="form-control" name="imgCodCamion" value="<?php print $camion->CODCAMION?>" readonly>
							</div>
						</div>
						<div class="col-sm-6 hidden">
							<div class="form-group">
								<label>Patente</label>
								<input class="form-control" type="text" name="imgPatente" value="<?php print $camion->PATENTE?>" readonly>
							</div>
						</div>
					</div>
					<div class="row">						
						<div class="col-sm-6">
							<div class="form-group">
								<label for="documento">Adjuntar archivo</label>
								<input type="file" id="imgCamion" name='imgCamion' accept="image/png, .jpeg, .jpg, image/gif">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div id='alertImg' class="callout callout-danger hidden">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<a id='btn_addImage' class="btn btn-primary">Guardar imagen</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/bootstrap/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/bootstrap/js/FileSaver.js"></script>
<!--jszip.min-->
<script type="text/javascript">
	$(function(){
		$('[data-toggle="tooltip"]').tooltip();
		$('.date').datepicker({
			autoclose: true,
			format: "dd/mm/yyyy",
			language: "es",
			todayHighlight: true,
			startDate: "today"
		});

		vigExtintor();
		function vigExtintor(){
			if($('#extintor').prop('checked')){
				$('#fechaVigencia').removeClass('hidden');
				$('#fechaVigencia').removeClass('show');
			}else{
				$('#fechaVigencia').addClass('hidden');
				$('#dateVig').val('');
			}
		}

		$('#extintor').change(function() {
			vigExtintor();
		});
		
		$('#btn_guardar').click(function(){
			var url='<?php print site_url().'/updateCamion'?>';
			if($('#extintor').prop('checked') && $('#dateVig').val()==''){
				pf_notify('Error','Ingrese fecha de vigencia del extintor...','danger');				
			}else{
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
					data: new FormData(document.getElementById("formUpdCamion")),
					processData: false,
					contentType: false,
					cache: false,
					async: false
				}).done(function(data){
					if(data.status){
						location.reload();
						pf_notify('Error','Datos editatos correctamente','succes');				
					}else{
						pf_notify('Error',data.error,'danger');				
					}
				});
			}
		})
	});
</script>

<script type="text/javascript">
	$(function(){
		cargarImgsCamion();
		function cargarImgsCamion(){
			var cod_camion=$('#cod_camion').val();
			if(cod_camion!=''){
				var url='<?php print site_url().'/getImg'?>';
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'JSON',
					data: {cod_camion: cod_camion},
				}).done(function(data) {
					$('#tbodyImgCamion').empty();
					var fila='<tr>';
					if(data.length>0){
						var cont=1;
						$.each(data, function(i, obj) {
							var ruta_imagen;
							if(isEmpty(obj.PATH_IMG_CAMION)){
								ruta_imagen=obj.FULL_PATH;
							}else{
								ruta_imagen="<?php print base_url().'imgCamion/'?>"+obj.PATH_IMG_CAMION;
							}
							fila+='<td><img class="camionIMG img-responsive fancybox img-thumbnail" src="'+ruta_imagen+'" href="'+ruta_imagen+'"/>';
							if(cont==4){
								fila+='</tr>'
								cont=0;
							}
							cont++;
						});
						$('#tbodyImgCamion').append(fila);
					}else{
						fila+='<tr><td><img class="camionIMG img-responsive fancybox img-thumbnail" src="<?php print base_url()?>/imgCamion/pf_accua.jpg" href="<?php print base_url()?>/imgCamion/pf_accua.jpg"/></td>';
						fila+='<td><img class="camionIMG img-responsive fancybox img-thumbnail" src="<?php print base_url()?>/imgCamion/pf_accua.jpg" href="<?php print base_url()?>/imgCamion/pf_accua.jpg"/></td>';
						fila+='<td><img class="camionIMG img-responsive fancybox img-thumbnail" src="<?php print base_url()?>/imgCamion/pf_accua.jpg" href="<?php print base_url()?>/imgCamion/pf_accua.jpg"/></td>';
						fila+='<td><img class="camionIMG img-responsive fancybox img-thumbnail" src="<?php print base_url()?>/imgCamion/pf_accua.jpg" href="<?php print base_url()?>/imgCamion/pf_accua.jpg"/></td></tr>';
						$('#tbodyImgCamion').append(fila);
					}
					$(".fancybox").fancybox();
				})
				.fail(function() {
					alert('Error servidor');
				});
			}else{
				alert('COD_CAMION');
			}
		}

		function isEmpty(val){
			return (val === undefined || val == null || val.length <= 0) ? true : false;
		}

		
		$("#select_all").click( function(){
			$("#tbHisCamion input[type='checkbox'].child").attr ( "checked" , $(this).attr("checked"));
		});

		$('#btn_addImage').click(function(){
			var url='<?php print site_url().'/addImgCamion'?>';
			Pace.track(function(){
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
					data: new FormData(document.getElementById("formImgCamion")),
					processData: false,
					contentType: false,
					cache: false,
					async: false
				}).done(function(data){
					if(data.status){
						cargarImgsCamion();
						$('#imgModal').modal('hide');
						$.notify(
						{
							icon:"fa fa-check-circle",
							title: "<strong>Foto adjuntada:</strong><br/> ",
							message: "Foto adjuntada correctamente"
						},{
							type: "success",
							placement: {
								from: "bottom",
								align: "right"
							},
							delay: 2000,
							timer: 300,
							animate: {
								enter: 'animated fadeInDown',
								exit: 'animated fadeOutUp'
							},
							z_index: 2000
						});
					}else{
						$.notify(
							{	icon:"fa fa-ban",
							title: "<strong>Error:</strong><br/> ",
							message: ""+data.error
						},{
							type: "danger",
							placement: {
								from: "bottom",
								align: "right"
							},
							delay: 2000,
							timer: 300,
							animate: {
								enter: 'animated fadeInDown',
								exit: 'animated fadeOutUp'
							},
							z_index: 2000
						});
					}
				}).fail(function(){
					alert('servidor');
				});
			});
		});


	});
</script>

<script type="text/javascript">
	$(function(){
		$('[data-toggle="tooltip"]').tooltip();
		verTiposDocsCamion(-1);
		function verTiposDocsCamion(activo){
			var url = '<?php print site_url().'/getTiposDocCamion'?>';
			$('#tipoDocCamion').empty();
			var fila="<option selected disabled>Seleccionar tipo</option>";
			$.getJSON(url, function (objetos) {
				$.each(objetos, function (i, obj) {
					if(activo==-1){
						fila+='<option value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
					}else{
						if(obj.ID_TIPO_DOC==activo){
							fila+='<option selected value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
						}else{
							fila+='<option value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
						}
					}
				});
				$('#tipoDocCamion').append(fila);
			});
		}

		$('#tipoDocCamion').change(function(){
			var tipoDoc=$('#tipoDocCamion').val();
			var codigo=$('#cod_camion').val();
			var url = '<?php print site_url().'/verHistCamion'?>';
			$('#tbHisCamion').empty();
			$.post(url, {codCamion:codigo,tipoDoc:tipoDoc}, function(data, textStatus, xhr) {
				if(data.msg===false){
					alert('Error de servidor, recargar página...');
				}
				var contador=0;
				$.each(data.msg, function (i, obj) {
					if(obj.PATH_DOC !=null){
						ruta_doc= "<?php print base_url()."doc/"?>"+obj.PATH_DOC;
					}else{
						ruta_doc= obj.FULL_PATH;
					}

					var fila = "<tr><td>" + obj.FECHACREACION + "</td>";
					fila     += "<td>" + obj.ESTADO + "</td>";

					if(obj.PATH_DOC != null){
						fila     +=" <td><center><input type='checkbox' class='minimal icheckbox_flat-green checkmio' checked id='select"+contador+"' value='"+obj.PATH_DOC+"'></center></td>";
						contador++;
					}else{
						fila     +=" <td><center><input type='checkbox'  disabled='true' class='minimal  icheckbox_flat-green' 		  'value='"+obj.PATH_DOC+"'></center></td>";
					}
					
					fila     += "<td><center><a class='btn btn-success fancybox' href='"+ruta_doc+"' target='_blank' 					 rel='ligthbox'><i class='glyphicon glyphicon-eye-open center'></i></a></center></td></tr>";
					$("#tbHisCamion").append(fila);
					$("a.fancybox").fancybox();
				})
				
			},'json');
			$('#alertDownload').removeClass('show');
			$('#alertDownload').addClass('hidden');
		});

		$("#checkAll").click(function(){
			$('.checkmio').not(this).prop('checked', this.checked);
		});



		$('#btDescargar').click(function(){
			var url = '<?php print site_url().'/getDocDataCamion'?>';
			if(document.getElementById('tablaHistoCamion').rows.length>1){
				var datos=[];
				for (var i=0;i < document.getElementById('tablaHistoCamion').rows.length -1; i++){
					if($('#select'+i).prop('checked')){
						var ruta=$('#select'+i).val();
						datos.push(ruta);
					}
				}
				if(datos.length>0){
					$.notify(
					{	
						icon:"fa fa-check-circle",
						title: "<strong>Comprimiendo archivos</strong><br/>",
						message: "Descarga en un instante..."
					},{
						type: "",
						placement: {
							from: "bottom",
							align: "right"
						},
						allow_dismiss: true,
						newest_on_top: true,
						showProgressbar: true,
						delay: 1000,
						timer: 300,
						animate: {
							enter: 'animated fadeInDown',
							exit: 'animated fadeOutUp',

						},
						template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert bg-gray" role="alert">' +
						'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
						'<span data-notify="icon"></span> ' +
						'<span data-notify="title">{1}</span> ' +
						'<span data-notify="message">{2}</span>' +
						'<div class="progress" data-notify="progressbar">' +
						'<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
						'</div>' +
						'<a href="{3}" target="{4}" data-notify="url"></a>' +
						'</div>' 
					});				
					Pace.track(function(){						
						$.post(url, {rutas:datos}, function(data) {							
							var zip = new JSZip();
							$.each(data,function(i,obj){
								zip.file("documento"+(i+1)+"."+obj.tipo, obj.dataDoc, {base64: true});	
							})
							zip.generateAsync({type:"blob"}).then(function(content) {
								saveAs(content, "documentos.zip");
							});
						},'json');						
					});
				}else{
					$.notify(
						{	icon:"fa fa-ban",
						title: "<strong>Error:</strong> <br/>",
						message: "No hay archivos seleccionados"
					},{
						type: "danger",
						showProgressbar: false,
						placement: {
							from: "bottom",
							align: "right"
						},
						delay: 2000,
						timer: 300,
						animate: {
							enter: 'animated fadeInDown',
							exit: 'animated fadeOutUp'
						}
					});
				}
			}else{
				$.notify(
					{	icon:"fa fa-ban",
					title: "<strong>Error:</strong><br/> ",
					message: "Seleccione tipo documento"
				},{
					type: "danger",
					placement: {
						from: "bottom",
						align: "right"
					},
					delay: 2000,
					timer: 300,
					animate: {
						enter: 'animated fadeInDown',
						exit: 'animated fadeOutUp'
					}
				});
				//
			}
		});
	});
</script>