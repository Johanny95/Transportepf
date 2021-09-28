<?php $user=$this->session->userdata('usuario');?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Gestión <small>camiones y choferes</small></h1>
		<ol class="breadcrumb">
			<li><a href='<?php echo site_url().'/relacion'?>'><span class='fa fa-exchange'></span>Asociación</a></li>
			<li class='active'><a><span class="fa fa-truck"></span> chofer y camion</a></li>
		</ol>

	</section>
	
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Gestion telefonos</h3>
				<div class="box-tools pull-right">
					<div class="box-tools pull-right">
						<div class="btn-group">
							<a href="javascript:window.history.back();" class="btn btn-box-tool"><i class="fa fa-reply"></i> Volver atrás</a>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
				</div>

			</div>
			<div class="box-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-4 well well-sm">							
							<form Method='POST' enctype="multipart/form-data" id="form_relacion">
								<?php if ($user[0]['OFICOD']==='ALL' || $user[0]['USUID']==='100793'): ?>
									<div class="form-group col-sm-12">
										<label>Seleccionar oficina</label>
										<select id='oficina' name='oficina' class="form-control select">
											<option disabled="true" selected="true">Seleccionar</option>
											<?php foreach ($getOficinas as $key): ?>
												<?php if ($key->CODIGO_OFICINA == ( !isset($oficina) ? "" : $oficina )) : ?>
													<option  selected="TRUE" value="<?php echo $key->CODIGO_OFICINA?>"><?php echo $key->NOMBRE_OFICINA?></option>
												<?php else: ?>
													<option value="<?php echo $key->CODIGO_OFICINA?>"><?php echo $key->NOMBRE_OFICINA?></option>
												<?php endif ?>
											<?php endforeach ?>
										</select>
									</div>
								<?php else: ?>
									<div class="form-group col-sm-6">
										<label>Oficina</label>
										<input class="form-control" value="<?php print $user[0]['OFICOD']?>" readonly="true" name='oficina' id='oficina'/>	
									</div>
									<div class="form-group col-sm-6"> 
										<label>Nombre Oficina</label>
										<input class="form-control" value="<?php print $user[0]['NOMBRE_OFICINA']?>" readonly="true"/>	
									</div>
								<?php endif ?>
								<div class="col-sm-12">
									<div class="form-group" id="div_imei" >
										<label>IMEI Teléfono</label>
										<select class="form-control select2" name='telefonos' id='telefonos' style="width: 100%;">
											<option  disabled="true" selected="true">Seleccionar</option>
											<?php foreach ($telefonos as $key): ?>
												<?php if ($key->ESTADO == 'H'): ?>											
													<option value="<?php echo $key->IMEI?>" ><?php print $key->IMEI?></option>	
												<?php endif ?>	
											<?php endforeach ?>
										</select>	
										<div id='label_imei'></div>
									</div>
								</div>
								<div class="col-sm-12">
									<div id='div_chofer' class="form-group">
										<label>Chofer</label>
										<select class="form-control select2" id='choferes' style="width: 100%;" name='choferes'>
											<option selected="selected" disabled="true">Seleccionar chofer</option>
										</select>
										<div id='label_chofer'></div>
									</div>								
								</div>
								<div class="col-sm-12">
									<div id='div_camion' class="form-group">
										<label>Camión</label>
										<select class="form-control select2" id='camiones' style="width: 100%;" name='camiones'>
											<option selected="selected" disabled="true">Seleccionar camión</option>
										</select>
										<div id='label_camion'></div>
									</div>								
								</div>	
								<div class="col-sm-12">
									<div id='div_numero' class="form-group">
										<label>Numero teléfono</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-phone"></i>
											</div>
											<input type="text" name='numero' id='numero'  class="form-control" value="" data-inputmask='"mask": "(9) 9999-9999"' data-mask>
										</div>
									</div>				
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<div class="form-group">
											<label for="documento">Adjuntar comodato (IMPORTANTE)</label>
											<input type="file" id="docRelacion" name='docRelacion'>
										</div>
									</div>
								</div>
								<hr/>
								<div class="col-sm-12">
									<button type="button" id="bt_addRelacion" class="btn-block btn btn-primary">Guardar</button>
								</div>

							</form>
						</div>


						<div class="col-sm-8">
							<div class="table-responsive" id='div_tabla_relacion'>

							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer text-center">

			</div>
		</div>


	</section>
	<!-- /.content -->
</div>

</section>
<!-- /.content -->
</div>


<div class="modal fade" id='modalEdit' tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Des-habilitar teléfono chofer</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="">Código chofer</label>
							<input type="text" readonly="true" class="form-control" name="cod_chofer_edit" id='cod_chofer_edit'>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Nombre chofer</label>
							<input type="text" readonly="true" class='form-control' name="chofer_edit" id='chofer_edit'>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class="col-sm-6">
						<div class="form-group">
							<label>IMEI</label>
							<input type="text" readonly="true" class='form-control' name="imei_edit" id='imei_edit'>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Patente</label>
							<input type="text" readonly="true" class='form-control' name="patente_edit" id='patente_edit'>
						</div>
					</div>	
					<div class="col-sm-6">
						<div class="form-group">
							<label>Estado</label>
							<input type="text" readonly="true" class='form-control' name="estado_edit" id='estado_edit'>
						</div>
					</div>									
					<div class="col-sm-6">
						<div class="form-group">
							<label>Fecha ingreso</label>
							<input type="text" readonly="true" class='form-control' name="fecha_edit" id='fecha_edit'>
						</div>
					</div>
					<div class="col-sm-6">
						<div id='div_num_edit' class="form-group">
							<label>Numero teléfono</label>							
							<input type="text" readonly="true" name='numero_edit' id='numero_edit'  class="form-control" data-inputmask='"mask": "(9) 9999-9999"' data-mask/>
						</div>				
					</div>
					<div class="col-sm-6">
						<div id='div_num_edit' class="form-group">
							<label>Deshabilitar asociación</label>
							<div class="input-group" >
								<span class="input-group-addon" >
									<input type='checkbox' class='minimal icheckbox_flat-green' id='deshabilitar' value='SI' name='deshabilitar'>
								</span>
								<input value="Deshabilitar asociación teléfono " class="form-control" disabled="TRUE"/>
							</div>
						</div>				
					</div>
					<div class="col-sm-12" >
						<div class="form-group" >
							<label>Motivo de deshabilitación</label>
							<textarea disabled="true" class="form-control center-block" name='motivo' id='motivo' rows="2" placeholder="Ej: pantalla rota, robo, etc..."></textarea>
						</div>		
					</div>
				</div>	
			</div>		
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" id='bt_guardar_edit' class="btn btn-danger">Deshabilitar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade bs-example-modal-sm" id='modal_conf' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header bg-red">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Confirmación</h4>
			</div>
			<div class="container-fluid">
				
				<div class="row">
					<div class="col-sm-12">
						<h5>¿Esta seguro de continuar?</h5>		
					</div>	
				</div>				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-remove pull-left'></i>Cancelar</button>
					<button type="button" id='bt_desactivo' class="btn btn-primary" ><i class='fa fa-check pull-left'></i>Aceptar</button>		
				</div>			
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(function(){
		$('.select2').select2();
		$('[data-mask]').inputmask();
		$("a.fancybox").fancybox();
	})
</script>
<!--VALIDACIONES-->
<script type="text/javascript">
	$(function(){
		$("a.fancybox").fancybox();
		validar('telefonos','IMEI','validar_imei','#div_imei','#label_imei');		
		validar('choferes','Chofer','validar_chofer_r','#div_chofer','#label_chofer');
		validar('camiones','Camión','validar_camion_r','#div_camion','#label_camion');

		$('#numero').keyup(function (e){
			e.preventDefault();		
			var numer      = $(this).val().replace(/[-\_\ \()]/g,'');	
			var realnumero = $(this).val();
			if(numer.length >=9){
				$.post('<?php print site_url().'/validar_numero_r'?>', { 'elemento' : realnumero }, function(data) {
					if(data.status==true){						
						$('#div_numero').removeClass('has-error has-feedback');
						$('#div_numero').addClass('has-success has-feedback');
					}else{
						pf_notify('Error','Teléfono ya se encuentra utilizado','danger');
						$('#div_numero').removeClass('has-success has-feedback');
						$('#div_numero').addClass('has-error has-feedback');
					}
				},'json');				
			}else{				
				$('#div_numero').removeClass('has-success has-feedback');
				$('#div_numero').addClass('has-error has-feedback');
			}			
		})		

		function validar(elemento,nombre,ruta,div,label){				
			$("#"+elemento).change(function(e){
				e.preventDefault();
				var value = $('#'+elemento).val();								
				$.ajax({
					url:'<?php print site_url().'/'?>'+ruta,
					type: 'POST',
					dataType: 'json',
					data: {elemento: value},
				})
				.done(function(data) {
					if(data.status){						
						$(label).empty();						
						$(div).removeClass('has-error has-feedback');
						$(div).addClass('has-success has-feedback');
						$(label).removeClass('hidden').addClass('show');
						$(label).append('<label class="has-success lab">Disponile</label>');						
					}else{						
						$(label).empty();
						$(div).removeClass('has-success has-feedback');
						$(div).addClass('has-error has-feedback');
						$(label).removeClass('hidden').addClass('show');						
						$(label).append('<label class="has-error lab">No disponile, verificar</label>');
					}
				})
				.fail(function() {
					//location.reload();
					pf_notify('Error','Error de servidor, porfavor recargar página...','danger');
				})
				.always(function() {
					console.log("complete");
				});
				
			});	
			
		}







	});
</script>
<!--CARGA DE DATOS CAMION Y CHOFER-->
<script type="text/javascript">
	$(function(){
		
		$('#oficina').change(function(){
			cargarChoferes();
		});
		var oficina = $('#oficina').val();
		if(oficina != null){
			cargarChoferes();
		}

		function cargarChoferes(){
			var oficina = $('#oficina').val();
			$('#choferes').empty();
			$('#camiones').empty();			
			$.ajax({
				url: '<?php print site_url().'/get_choferes'?>',
				type: 'POST',
				dataType: 'json',
				data: {oficina: oficina},
			})
			.done(function(data) {
				var fila="<option selected='true' disabled='true'>Seleccionar chofer</option>";
				$.each(data.choferes, function(index, obj) {
					fila+='<option value="'+obj.CODCHOFER+'">'+obj.RUTCHOFER+'  | '+obj.NOMBRECHOFER+'</option>';
				});
				$('#choferes').append(fila);
				var filaCamion='<option selected="true" disabled="true">Seleccionar camión</option>';
				$.each(data.camiones, function(index, obj) {
					filaCamion+='<option value="'+obj.CODCAMION+'">'+obj.PATENTE+'</option>';
				});
				$('#camiones').append(filaCamion);
			})
			.fail(function() {
				pf_notify('Error','Error de servidor, porfavor recargar página...','danger');
			})
			.always(function() {
				console.log("complete");
			});
			
		}

	})
</script>

<!--AGREGAR RELACION CHOFER TELEFONO -->
<script type="text/javascript">
	$(function(){

		$('#estado').change(function(){
			var est=$(this).find(":selected").val();
			est+=" "+$('#buscar').val();
			t.search(est).draw();
		});


		$('#deshabilitar').click(function() {			
			if(this.checked){
				$("#motivo").prop('disabled', false);
			}else{
				$('#motivo').val('');
				$("#motivo").prop('disabled', true);
			}
		});


		function validarCampos(campo,ruta){
			var elemento = $("#"+campo).val();			
			var variable = false;
			Pace.track(function(){
				$.ajax({
					url: '<?php print site_url()?>/'+ruta,
					type: 'POST',
					dataType: 'json',				
					async: false,
					cache: false,
					data: {elemento: elemento},
				})
				.done(function(data) {
					variable = data.status;
				}).fail(function(){
					location.reload();
				})
			});
			return variable;
		}

		$('#bt_addRelacion').click(function(){
			$(this).prop('disabled',true);
			var oficina   = $('#oficina').val();
			var imei      = $('#telefonos').val();
			var chofer    = $('#choferes').val();
			var camion    = $('#camiones').val();
			var telefono  = $('#numero').val().replace(/[-\_\ \()]/g,'');
			if(oficina==null){
				pf_notify('Error','Seleccione oficina','danger');
				$(this).prop('disabled',false);
			}else if(imei == null){
				pf_notify('Error','Ingrese imei del teléfono','danger');
				$(this).prop('disabled',false);
			}else if(chofer==null){
				pf_notify('Error','Seleccione chofer','danger');
				$(this).prop('disabled',false);
			}else if(camion==null){
				pf_notify('Error','Seleccione camion','danger');
				$(this).prop('disabled',false);
			}else if(telefono==""){
				pf_notify('Error','Ingrese numero de telefono','danger');
				$(this).prop('disabled',false);
			}else{
				addRelacionValidacion();
				$(this).prop('disabled',false);				
			}
			
		});


		function addRelacionValidacion(){
			if(validarCampos('telefonos','validar_imei')){
				if(validarCampos('choferes','validar_chofer_r')){
					if(validarCampos('camiones','validar_camion_r')){
						if(validarCampos('numero','validar_numero_r')){
							agregarRelacion();
						}else{
							pf_notify('Error','El numero de teléfono ya se encuentra en un teléfono activo, verificar...','danger');
						}
					}else{
						pf_notify('Error','El camión ya cuenta con un teléfono activo, verificar...','danger');
					}
				}else{
					pf_notify('Error','El chofer ya cuenta con un teléfono asociado activo, verificar...','danger');
				}				
			}else{
				pf_notify('Error','El teléfono ya se encuentra asociado a un chofer, verificar...','danger');
			}
		}

		function agregarRelacion (){
			var formulario     = new FormData(document.getElementById("form_relacion"));
			var patente        = $("#camiones option:selected").text();
			formulario.append('patente',patente);			
			Pace.track(function(){
				$.ajax({
					url: '<?php print site_url()?>/addRelacion',
					type: 'POST',
					data: formulario,
					processData: false,
					contentType: false,
					dataType:'JSON',
					cache: false,
					async: false
				}).done(function(data){
					if(data.status){
						pf_notify('Ingreso exitoso','Se ha creado la asociación correctamente','success');						
						$('#form_relacion')[0].reset();
						$('<div class="lab"></div>').addClass('hidden');
						$('#choferes').empty();						
						$('#camiones').empty();
						$('#label_imei').removeClass('show').addClass('hidden');
						$('#label_chofer').removeClass('show').addClass('hidden');
						$('#label_camion').removeClass('show').addClass('hidden');
						$('#div_imei').removeClass('has-error has-success');
						$('#div_chofer').removeClass('has-error has-success');
						$('#div_camion').removeClass('has-error has-success');
						$('#div_numero').removeClass('has-error has-success');
						getTablaRelaciones();
					}else{
						pf_notify('Error',data.error,'danger');						
					}
				}).fail(function() {						
					location.reload();
				})
			});			

		}

		getTablaRelaciones();
		function getTablaRelaciones(){
			$.ajax({
				url: '<?php print site_url().'/getTablaRelaciones'?>',
				type: 'POST',
				dataType: 'json'
			})
			.done(function(data) {
				if(data.status==true){
					$('#div_tabla_relacion').empty().append(data.vista);
				}
			})
			.fail(function() {
				console.log("error");
			})	
		}


		$('body').on('click','#bt_edit',function(){
			$('#modalEdit').modal('show');
			var datos = $(this).val().split('|');
			$('#imei_edit').val(datos[0]);
			$('#cod_chofer_edit').val(datos[1]);
			$('#estado_edit').val(datos[2]);
			$('#fecha_edit').val(datos[3]);
			$('#chofer_edit').val(datos[4]);
			$('#patente_edit').val(datos[5]);
			$('#numero_edit').val(datos[6]);
		})

		$('body').on('click','#bt_guardar_edit',function(){
			
			if($('#deshabilitar').is(':checked')){
				if( $('#deshabilitar').is(':checked') && $('#motivo').val() == ""){
					pf_notify('Error','Ingrese motivo de deshabilitación','danger');	
				}else{
					$('#modal_conf').modal('show');
				}
			}else{
				pf_notify('Error','Seleccione si desea deshabilitar la asociación','danger');	
			}
			
		})


		$('body').on('click','#bt_desactivo',function(){
			$(this).prop('disabled',true);
			var motivo 	  = $('#motivo').val();
			var imei      = $('#imei_edit').val();
			var codchofer = $('#cod_chofer_edit').val();
			var estado    = $('#estado_edit').val();
			var fecha     = $('#fecha_edit').val();
			$.ajax({
				url: '<?php print site_url()?>/deshabilitar',
				type: 'POST',
				dataType: 'json',
				data: {'motivo'    : motivo,
				'imei'      : imei,
				'codchofer' : codchofer,
				'estado'    : estado,
				'fecha'     : fecha},
			})
			.done(function(data) {
				if(data.status){
					getTablaRelaciones();
					pf_notify('Realizado','Se realizo la modificación con exito','info');
					$('#deshabilitar').prop('checked',false);
					$('#motivo').val('');
					$('#motivo').prop('disabled',true);;
					$('.modal').modal('hide');					
					$('#bt_desactivo').prop('disabled',false);

				}else{
					pf_notify('Error',data.error,'danger');
					$('#bt_desactivo').prop('disabled',false);
				}
			})
			.fail(function() {
				pf_notify('Error','Error de servidor, recargar página','danger');
					//location.reload();
				})
			.always(function() {
				console.log("complete");
			});
		});

		function cargarHistorialChofer(codigo){
			$.ajax({
				url: '<?php print site_url()?>/getHistorialTelefonos',
				type: 'POST',
				dataType: 'json',
				data: {codChofer: codigo},
			})
			.done(function(data) {
				var fila = '';
				$('#tbody_historial').empty();
				$.each(data.data, function (i, obj) {
					var fechadesc = obj.FECHA_DESACTIVO;
					var motivo    = obj.MOTIVO;
					if(obj.FECHA_DESACTIVO == null){
						fechadesc='Actualidad';
					}
					if(motivo == null){
						motivo = '';
					}
					fila+="<tr><td>"+obj.IMEI+"</td>";
					fila+="<td>Desde: "+obj.FECHA+"<br/> Hasta: "+fechadesc+"</td>";
					fila+="<td>"+obj.NUM_TELEFONO+"</td>";
					fila+="<td>"+obj.PATENTE+"</td>";
					if(obj.ESTADO == "H"){
						fila+="<td><span class='label label-success center-block'>Vigente</span></td>";
					}else{
						fila+="<td><span class='label label-danger center-block'>Deshabilitado</span></td>";
					}
					fila+="<td>"+motivo+"</td>";
					fila+="<td><a class='btn btn-sm bg-teal fancybox' href='<?php print base_url()?>/telefonos/"+obj.PATH_DOC+"'><i class='fa fa-file'></i></a></td></tr>";
				});
				$('#tbody_historial').append(fila);
				$("a.fancybox").fancybox();
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});			
		}

		$('body').on('click','#historial',function(){
			var datos = $(this).val().split('|');
			$('#codigoChofer').val(datos[0]);
			$('#rut').val(datos[1]);
			$('#nombre').val(datos[2]);
			$('#ofi').val(datos[3]);
			cargarHistorialChofer(datos[0]);
			$('#modal_historial').modal('show');			
		})




	})
</script>