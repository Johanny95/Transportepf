<!-- Content Wrapper. Contains page content -->

<?php $chofer=$this->session->userdata('chofer');?>
<style type="text/css">
.perfil{
	background: transparent !important;
	height: 300px !important;
	width : 300px !important ;
}
.perfil:hover {
	opacity: 0.8;
	filter: alpha(opacity=50); /* For IE8 and earlier */
	cursor:pointer; cursor: hand
}
</style>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Chofer<small>Ficha</small></h1>
		<ol class="breadcrumb">
			<li><a href='<?php echo site_url().'/index' ?>'><span class='glyphicon glyphicon-folder-open'></span>Chofer</a></li>
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
				<form Method='POST' enctype="multipart/form-data" action="<?php echo site_url();?>/updateChofer" id="updateChofer">
					<div class=" well well-sm">
						<div class="row">
							<div class="col-md-4">
								<?php if ( $chofer->FOTO != null ): ?>
									<img src="<?php print base_url().'/fotos/chofer/'.$chofer->FOTO?>" class="imgchange img-circle perfil" data-toggle="tooltip" title="Click para cambiar" >
									<?php else: ?>
										<img src="<?php print base_url().'fotos/perfil.png'?>" class="imgchange img-circle perfil img-responsive" data-toggle="tooltip" title="Click para cambiar" >
									<?php endif ?>
									<!--<button type="button" class="imgchange btn btn-block btn-primary">Cambiar</button>-->
								</div>
								<div class="col-md-8">
									<div class="col-md-6">
										<div class="form-group">
											<label for="id_proveedor">Código</label>
											<input type="input" class="form-control" id="cod_Chofer" name='cod_chofer' value="<?php print $chofer->CODCHOFER?>" readonly="true">
										</div>							
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Rut</label>
											<input type="input" class="form-control" value="<?php print $chofer->RUTCHOFER?>" readonly="true">
										</div>	
									</div>
								</div>

								<div class="col-md-8">
									<div class="col-md-6">
										<div class="form-group">
											<label for="nombre">Razon social</label>
											<input type="input" class="form-control" value="<?php print $chofer->NOMBRECHOFER?>" readonly="true">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="nombre">Oficina</label>
											<input type="input" class="form-control" value="<?php print $chofer->OFICINA?>" readonly="true">
										</div>
									</div>
								</div>

								<div class="col-md-8">
									<div class="col-md-6">
										<div class="form-group">
											<label for="nombre">Estado</label>
											<input type="input" class="form-control" value="<?php print $chofer->ESTADO_CHOFER?>" readonly="true">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Telefono</label>
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-phone"></i>
												</div>
												<input type="text" name='telefono' class="form-control" value="<?php echo $chofer->FONOCHOFER?>" data-inputmask='"mask": "(9) 9999-9999"' data-mask>
											</div>
										</div>

									</div>
								</div>

								<div class="col-md-8">
									<div class="col-md-6">
										<div class="form-group">
											<label>Licencia</label>
											<select class="form-control select2" id='licencia' name='licencia'>
												<option selected="true" value="<?php ($chofer->LICENCIA==null? print 'No registrado' : print $chofer->LICENCIA)?>" ><?php ($chofer->LICENCIA==null? print 'No registrado' : print $chofer->LICENCIA) ?></option>
												<option value="Profesional A-4">Profesional A-4</option>
												<option value='Profesional A-3'>Profesional A-3</option>
												<option value='Profesional A-2'>Profesional A-2</option>
												<option value='Profesional A-1'>Profesional A-1</option>
												<option value='Profesional A-5'>Profesional A-5</option>
												<option value='No profesional B'>No profesional B</option>
												<option value='No profesional C'>No profesional C</option>
												<option value='Especial D'>Especial D</option>
												<option value='Especial E'>Especial E</option>
												<option value='Especial F'>Especial F</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Estado chofer</label>
											<select class="form-control select2" id='estado' name='estado'>
												<option selected="true" value="<?php ($chofer->ESTADO_CHOFER==null? print 'No registrado' : print $chofer->ESTADO_CHOFER)?>" ><?php ($chofer->ESTADO_CHOFER==null? print 'No registrado' : print $chofer->ESTADO_CHOFER) ?></option>
												<option value="H">H</option>
												<option value="D">D</option>
											</select>
										</div>
									</div>
									 <div class="col-md-12">
										<div class="form-group">
											<label>Correo</label>
											<input type="text" name="correo" id="correo" class="form-control" value="<?php echo $chofer->CORREO?>">
										</div>
									</div>
								</div>
							</div>

						</div>

					</form>
				</div>
				<!-- /.box-body -->
				<div class="box-footer text-center">
					<div class="col-sm-6">
						<a href="javascript:window.history.back();" class="btn btn-default btn-block"><i class="fa fa-reply"></i> Volver atrás</a>
					</div>
					<div class=" col-sm-6">
						<a class="btn btn-block btn-success" id='btn_guardar'><i class="pull-left fa fa-save"></i>Guardar cambios</a>
					</div>
				</div>
			</div>
			<!-- BOX HISTORIAL-->
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Historial documentos</h3>
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
									<select class="form-control select2" id='tipoDocChofer' name='tipoDocTransp' ata-toggle="tooltip" data-placement="bottom" title="Seleccionar para historial">
									</select>
								</div>
								<div class="form-group col-sm-4">
									<label>Descargar seleccionados</label>
									<a class="btn btn-success form-control" id='btDescargar'>Descargar<i class="fa fa-download pull-left"></i></a>
								</div>
								<div class="form-group col-md-12">
									<table id='tablaHisto' class="table table-hover table-bordered table-responsive">
										<thead class="btn-success">
											<tr>
												<td>Fecha Ingreso</td>
												<td>Estado</td>
												<td>Selección | <input type='checkbox' class='minimal icheckbox_flat-green' id='checkAll' checked></td></td>
												<td>Documento</td>
											</tr>
										</thead>
										<tbody id='tbHistChofer'></tbody>
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
				<h4 class="modal-title" id="myModalLabel">Subir foto del chofer</h4>
			</div>
			<div class="modal-body">
				<form id='formImgChofer' Method='POST' enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-12 hidden">
							<div class="form-group">
								<label for="id_proveedor">Código</label>
								<input type="input" class="form-control " id="img_cod_Chofer" name='img_cod_Chofer' value="<?php print $chofer->CODCHOFER?>" readonly="true">
							</div>							
						</div>						
						<div class="col-sm-6">
							<div class="form-group">
								<label for="documento">Adjuntar archivo</label>
								<input type="file" id="imgChofer" name='imgChofer' accept="image/png, .jpeg, .jpg, image/gif">
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




<script>
	$(function(){
		$('[data-mask]').inputmask();
	});
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/bootstrap/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/bootstrap/js/FileSaver.js"></script>
<script type="text/javascript">
	$(function(){
		$('[data-toggle="tooltip"]').tooltip();
		$('#btn_guardar').click(function(){
			var url='<?php print site_url().'/updateChofer'?>';
			$.ajax({
				url: url,
				type: 'post',
				dataType: 'json',
				data: new FormData(document.getElementById("updateChofer")),
				processData: false,
				contentType: false,
				cache: false,
				async: false
			}).done(function(data){
				if(data.status){
					location.reload();
					pf_notify('Datos editatos correctamente:','Acción exitosa','success');
				}else{
					pf_notify('Error:',data.error,'danger');
				}
			});
			
		});

	});
</script>

<script type="text/javascript">
	$(function(){
		selectTrasnportista(-1);
		function selectTrasnportista(activo){
			var url = '<?php print site_url().'/getTiposDocChofer'?>';
			$('#tipoDocChofer').empty();
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
				$('#tipoDocChofer').append(fila);
			});
		}


		$('#tipoDocChofer').change(function(){
			var cod=$('#tipoDocChofer').val();
			var codigo=$('#cod_Chofer').val();
			var url = '<?php print site_url().'/verHistChofer'?>';
			$('#tbHistChofer').empty();
			$.post(url, {codChofer:codigo,tipoDoc:cod}, function(data, textStatus, xhr) {
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
					$("#tbHistChofer").append(fila);
					$("a.fancybox").fancybox();
				})
				$('#alertDownload').addClass('hidden');
				$('#alertDownload').removeClass('show');
			},'json');
		});
		$("#checkAll").click(function(){
			$('.checkmio').not(this).prop('checked', this.checked);
		});

		$('#btDescargar').click(function(){
			var url = '<?php print site_url().'/getDocDataCamion'?>';
			if(document.getElementById('tablaHisto').rows.length>1){
				var datos=[];
				for (var i=0;i < document.getElementById('tablaHisto').rows.length -1; i++){
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
					pf_notify('Error','No hay archivos seleccionados','danger');
				}
			}else{
				pf_notify('Error','Seleccione tipo documento','danger');
			}
		});


	});
</script>
<!--jszip.min-->

<!--04-11-2018-->
<script type="text/javascript">
	$(function(){
		$('body').on('click','.imgchange',function(){
			$('#imgModal').modal('show');
		})

		$('#btn_addImage').click(function(){
			var url='<?php print site_url().'/addImgChofer'?>';
			Pace.track(function(){
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
					data: new FormData(document.getElementById("formImgChofer")),
					processData: false,
					contentType: false,
					cache: false,
					async: false
				}).done(function(data){
					if(data.status){
						$('#imgModal').modal('hide');
						location.reload();
					}else{
						pf_notify('Error',data.error,'danger');
					}
				}).fail(function(){
					alert('servidor');
				});
			});
		});

	})
</script>