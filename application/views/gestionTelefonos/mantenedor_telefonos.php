<?php $user=$this->session->userdata('usuario');?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Telefonos<small>Mantenedor de teléfonos</small></h1>
		<ol class="breadcrumb">
			<li><a href='<?php echo site_url().'/mantenedor_telefono'?>'><span class='fa fa-mobile'></span>Teléfonos</a></li>
			<li class='active'><a><span class="fa fa-edit"></span> Mantenedor</a></li>
		</ol>

	</section>
	
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Gestion teléfonos</h3>
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
						<form id='formAddTelefono'>
							<div class="col-sm-4 well well-sm">														
								<div id='form_imei' class="form-group">
									<label>IMEI celular</label>
									<input type="text" id='imei' class="form-control imei" data-toggle="tooltip" data-placement="top" title="Para visualizar el IMEI del teléfono ingrese *#06# en el dispositivo"
									data-inputmask='"mask": "9999-9999-9999-999"' data-mask>
									<label id='info_imei' class="hidden"></label>
								</div>
								<div class="form-group">
									<label>Marca</label>
									<input  type="text" class="form-control" name='marca' id='marca' placeholder="Ej: Samsung..." /> 
								</div>
								<div class="form-group">
									<label>Modelo</label>
									<input  type="text" class="form-control" name="modelo" id='modelo' placeholder="Ej: j2 prime, s4..." /> 
								</div>								
								<div class="form-group">
									<label>Descripción teléfono</label>
									<textarea class="form-control center-block" name='descrip' id='descrip' rows="3" placeholder="Descripción del teléfono..."></textarea>
								</div>
								<hr/>
								<div class="col-sm-6">
									<a href="javascript:window.history.back();" class="btn bg-gray btn-block"><i class="fa fa-reply"></i> Volver atrás</a>
								</div>
								<div class="col-sm-6">									
									<button type="button" id='bt_addTelefono' class="btn btn-primary btn-block"><i class="fa fa-check"></i>Aceptar</button>
								</div>
							</div>							
						</form>
						<div class="col-sm-8" >
							<div class="table-responsive" id='div_tablaTelefonos'>
								
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

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Editar telefono</h4>
			</div>
			<div class="modal-body">
				<form id='formUpdate' method="POST" enctype="multipart/form-data">
					<div class="row">						
						<div class="col-sm-12">						
							<div class="form-group">
								<label for="recipient-name" class="control-label">IMEI</label>
								<input type="text" class="form-control" id="imei_edit" name='imei_edit' readonly="true">
							</div>
						</div>						
						<div class="col-sm-6 ">
							<div class="form-group">
								<label>Estado</label>
								<input type="text" id='estado_edit' class='form-control' readonly="true">
							</div>							
						</div>
						<div class="col-sm-6 ">
							<div class="form-group">
								<label>Fecha de creación</label>
								<input type="text" id='fecha_creacion' class='form-control' readonly="true">
							</div>							
						</div>
						<div class="col-sm-6">						
							<div class="form-group">
								<label for="message-text" class="control-label">Marca</label>
								<input type="text" id='marca_edit' name='marca_edit' class='form-control' >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="message-text"  class="control-label">Modelo</label>
								<input type="text" id='modelo_edit' name='modelo_edit' class='form-control' >
							</div>
						</div>
						<div class="col-sm-12">
							<label>Descripción</label>
							<textarea class="form-control " name='desc_edit' id='desc_edit' rows="3" placeholder="Descripción del teléfono..."></textarea>
						</div>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-remove pull-left'></i>Cancelar</button>
				<button type="button" id='updateTelefono' class="btn btn-primary"><i class="fa fa-check pull-left"></i>Guardar cambios</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal_des" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Deshabilitar teléfono</h4>
			</div>
			<div class="modal-body">
				<form id='formUpdate' method="POST" enctype="multipart/form-data">
					<div class="row">						
						<div class="col-sm-6">						
							<div class="form-group">
								<label for="recipient-name" class="control-label">IMEI</label>
								<input type="text" class="form-control" id="imei_des" name='imei_edit' readonly="true">
							</div>
						</div>
						<div class="col-sm-6">						
							<div class="form-group">
								<label for="recipient-name" class="control-label">Teléfono</label>
								<input type="text" class="form-control" id='marca_des' readonly="true">
							</div>
						</div>
						<div class="col-sm-12">
							<label>Descripción</label>
							<textarea class="form-control " name='motivo_des' id='motivo_des' rows="4" placeholder="Motivo deshabilitación del teléfono... Ej: Pantalla rota, bateria deficiente, etc."></textarea>
						</div>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-remove pull-left'></i>Cancelar</button>
				<button type="button" id='confirmacion' class="btn btn-primary"><i class="fa fa-check pull-left"></i>Deshabilitar</button>
			</div>
		</div>
	</div>
</div>


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
						<h5>¿Esta seguro de continuar con desactivo del teléfono?</h5>		
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
		$('[data-toggle="tooltip"]').tooltip();	
		$('[data-mask]').inputmask();

		$( "#imei" ).keyup(function() {
			var imei = $('#imei').val();	
			$('#info_imei').empty();			
			imei = imei.replace(/[-\_]/g,'');
			if(imei.length >= 15){
				$.post('<?php print site_url().'/validarImei'?>', { 'imei' : imei }, function(data) {
					if(data.VALIDADOR==0){						
						$('#form_imei').removeClass('has-error has-feedback');
						$('#form_imei').addClass('has-success has-feedback');
						$('#info_imei').empty();								
						$('#info_imei').removeClass('hidden');
						$('#info_imei').addClass('show');
						$('#info_imei').append('Correcto <i class="fa fa-check"></i>');
					}else{
						$('#form_imei').removeClass('has-success has-feedback');
						$('#form_imei').addClass('has-error has-feedback');
						$('#info_imei').empty();		
						$('#info_imei').removeClass('hidden');
						$('#info_imei').addClass('show');							
						$('#info_imei').append('IMEI ya registrado <i class="fa fa-ban"></i>');
					}
				},'json');

			}else{
				$('#form_imei').removeClass('has-success has-feedback');
				$('#form_imei').addClass('has-error has-feedback');
				$('#info_imei').empty();	
			}

		});
		

	})
</script>


<script type="text/javascript">
	$(function(){		
		$('#bt_addTelefono').click(function(){
			$(this).prop('disabled',true);
			var imei=$('#imei').val();	
			imei=imei.replace(/[-\_]/g,'');		
			var marca=$('#marca').val();			
			var modelo=$('#modelo').val();			
			var desc=$('#descrip').val();			
			$.ajax({
				url: '<?php print site_url().'/addTelefono'?>',
				type: 'POST',
				dataType: 'json',
				data: {
					imei:    imei ,
					marca:  marca,
					modelo: modelo,
					desc:   desc}
				})
			.done(function(data) {
				if(data.status == true){
					$('#bt_addTelefono').prop('disabled',false);
					pf_notify('<strong>Ingreso exitoso:</strong>','Se ha realizado el ingreso del telefono con exito...','success');
					getTablaTelefonos();
					$('#form_imei').removeClass('has-success has-feedback');
					$('#info_imei').removeClass('show').addClass('hidden');
					$('#formAddTelefono')[0].reset();			
				}else{
					$('#bt_addTelefono').prop('disabled',false);					
					pf_notify('Error',data.error,'danger');
				}
			})
			.fail(function() {
				pf_notify('Error',"Error de servidor, recarge página...",'danger');				
				$('#bt_addTelefono').prop('disabled',false);
			})
		})


		getTablaTelefonos();
		function getTablaTelefonos(){
			$.ajax({
				url: '<?php print site_url().'/getTablaTelefonos'?>',
				type: 'POST',
				dataType: 'json'
			})
			.done(function(data) {
				if(data.status==true){
					$('#div_tablaTelefonos').empty().append(data.vista);
				}
			})
			.fail(function() {
				console.log("error");
			})	
		}

		$('#updateTelefono').click(function(){
			$(this).prop('disabled',true);
			$.ajax({
				url: '<?php print site_url().'/updateTelefono'?>',
				type: 'POST',
				dataType: 'json',
				data:  $('#formUpdate').serialize() ,
			})
			.done(function(data) {
				if(data.status==true){
					if(data.error==""){
						getTablaTelefonos();
						$('#modal_edit').modal('hide');
						$('#updateTelefono').prop('disabled',false);						
						pf_notify('Modificado','Se ha realizado la modificación exitosamente...',"success");
					}else{
						pf_notify('Error','El teléfono se mofico exitosamente','danger');
						$('#updateTelefono').prop('disabled',false);
					}
				}else{
					pf_notify('Error',data.error,'danger');				
					$('#updateTelefono').prop('disabled',false);
				}
			})
			.fail(function() {
				console.log("error");
				$('#updateTelefono').prop('disabled',false);						

			})
			.always(function() {
				console.log("complete");
			});			
		});

		$("body").on("click", "#bt_des", function () {
			var datos= $(this).val().split('|');			
			$('#imei_des').val(datos[0]);
			$('#marca_des').val(datos[1]+" "+datos[2]);						
			$('#modal_des').modal('show');
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



		$('#bt_desactivo').click(function(){
			var descr=$('#motivo_des').val();
			var imei =$('#imei_des').val();
			if(descr != "" ){				
				$.ajax({
					url: '<?php print site_url().'/desactivar'?>',
					type: 'POST',
					dataType: 'json',
					data: {imei_des:imei, motivo_des:descr },
				})
				.done(function(data) {
					if(data.status==true){
						pf_notify('Ok','Teléfono deshabilitado','success');
						$('.modal').modal('hide');
						getTablaTelefonos();
					}else{
						pf_notify('Error',data.error,'danger');
					}
				})
				.fail(function() {
					pf_notify('Error','Error de servidor verificar sesión','danger');					
				})
				.always(function() {
					console.log("complete");
				});				
			}else{
				pf_notify('Error','Ingrese movito de deshabilitación','danger');
			}			
		})

		$('#confirmacion').click(function(){
			var descr=$('#motivo_des').val();			
			if(validarCampos('imei_des','validar_imei')){
				if(descr != ""){
					$('#modal_conf').modal('show');
				}else{
					pf_notify('Error','Ingrese movito de deshabilitación','danger');
				}
			}else{
				pf_notify('Error','El teléfono se encuentra con una asocación activa, NO se puede deshabilitar hasta que sea entregado','danger');
			}

		})


		$("body").on("click", "#bt_edit", function () {
			var datos= $(this).val().split('|');			
			$('#imei_edit').val(datos[0]);
			$('#marca_edit').val(datos[1]);			
			$('#modelo_edit').val(datos[2]);
			var estado="";
			if(datos[3]=="H"){
				estado='Habilitado';
			}else{
				estado='Deshabilitado';
			}
			$('#estado_edit').val(estado);
			$('#fecha_creacion').val(datos[4]);
			$('#desc_edit').val(datos[5]);
			$('#modal_edit').modal('show');
		});





		function cargarHistorialTelefono(imei){
			$.ajax({
				url: '<?php print site_url()?>/getHistCelulares',
				type: 'POST',
				dataType: 'json',
				data: {imei: imei},
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
					fila+="<tr><td>"+obj.CODCHOFER+"</td>";
					fila+="<td>"+obj.NOMBRECHOFER+"</td>";
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
			$('#imei_histo').val(datos[0]);
			$('#marca_histo').val(datos[1]);
			$('#modelo_histo').val(datos[2]);			
			cargarHistorialTelefono(datos[0]);
			$('#modal_historial').modal('show');			
		})



	})
</script>