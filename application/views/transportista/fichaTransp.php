<!-- Content Wrapper. Contains page content -->

<?php $trans=$this->session->userdata('transp');?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Transportista<small>Ficha</small></h1>
		<ol class="breadcrumb">
			<li><a href='<?php echo site_url().'/index' ?>'><span class='glyphicon glyphicon-folder-open'></span>Transportista</a></li>
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
				<form  method="POST" id="formUpdateTransp" >
					<div class="row">
						<div class="col-xs-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="id_proveedor">Código</label>
									<input type="input" class="form-control" name="id_proveedor" id="id_proveedor" value="<?php print $trans->ID_PROVEEDOR?>" readonly="true">
								</div>							
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Rut</label>
									<input type="input" class="form-control" value="<?php print $trans->RUT_TANSPORTISTA?>" readonly="true">
								</div>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nombre">Razon social</label>
									<input type="input" class="form-control" value="<?php print $trans->RAZON_SOCIAL?>" readonly="true">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="nombre">Oficina</label>
									<input type="input" name='oficina' id='oficina' class="form-control" value="<?php print $trans->OFICINA?>" readonly="true">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nombre">Ciudad</label>
									<input type="input" class="form-control" value="<?php print $trans->CIUDAD?>" readonly="true">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label for="id_proveedor">Correo electrónico</label>
									<div class="input-group">
										<div class="input-group-addon">
											@
										</div>
										<input type="input" disabled="true" class="form-control" name='correo' value="<?php print $trans->CORREO?>" >
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="col-md-6">
								<div class="form-group">
									<label>Dirección</label>
									<input type="input" class="form-control" name="direccion" readonly="<?php ($trans->DIRECCION ==null? print false : print true)?>" value="<?php print $trans->DIRECCION?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="nombre">Propietario</label>
									<input type="input" class="form-control" name="propietario" value="<?php print $trans->PROPIETARIO?>">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="col-md-6">
								<div class="form-group">
									<label>Página web</label>
									<input type="input" class="form-control" name='sitioweb' value="<?php print $trans->SITIOWEB?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Teléfono</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-phone"></i>
										</div>
										<input type="text" name='telefono' class="form-control" value="<?php echo $trans->TELEFONO?>" data-inputmask='"mask": "(9) 9999-9999"' data-mask>
									</div>
								</div>
							</div>

						</div>
					</div>
				</form>
			</div>
			<!-- /.box-body -->
			<div class="box-footer text-center">
				<div class="row">
					<div class="col-xs-12">
						<div class="col-md-6">
							<div class="form-group">
								<label></label><br/>
								<a href="javascript:window.history.back();" class="btn btn-block bg-gray"><i class="fa fa-reply"></i> Volver atrás</a>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label></label><br/>
								<a class="btn btn-success btn-block" id="btn_guardar" >Guardar cambios</a>
							</div>
						</div>
					</div>
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
								<select class="form-control select2" id='tipoDocTransp' name='tipoDocTransp' ata-toggle="tooltip" data-placement="bottom" title="Seleccionar para historial">
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
									<tbody id='tbHisTransp'></tbody>
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

<script type="text/javascript" src="<?php echo base_url(); ?>resources/bootstrap/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/bootstrap/js/FileSaver.js"></script>

<!--jszip.min-->

<script type="text/javascript">
	$(function(){
		$('[data-mask]').inputmask();
		$('[data-toggle="tooltip"]').tooltip();
		selectTrasnportista(-1);
		function selectTrasnportista(activo){
			var url = '<?php print site_url().'/getTiposDoc'?>';
			$('#tipoDocTransp').empty();
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
				$('#tipoDocTransp').append(fila);
				$('#codigoTransp').val($('#id_proveedor').val());
			});
		}
	});
</script>

<script type="text/javascript">
	$(function(){
		$('#btn_guardar').click(function(){
			var url='<?php print site_url().'/updateTransp'?>';
			$.ajax({
				url: url,
				type: 'post',
				dataType: 'json',
				data: new FormData(document.getElementById("formUpdateTransp")),
				processData: false,
				contentType: false,
				cache: false,
				async: false
			}).done(function(data){
				if(data.status){
					location.reload();
					$.notify(
						{	icon:"fa fa-check",
						title: "<strong>Datos editados correctamente:</strong> <br/>",
						message: data.error
					},{
						type: "success",
						showProgressbar: false,
						placement: {
							from: "bottom",
							align: "right"
						},
						delay: 4000,
						timer: 3000,
						animate: {
							enter: 'animated fadeInDown',
							exit: 'animated fadeOutUp'
						}
					});
				}else{
					$.notify(
						{	icon:"fa fa-ban",
						title: "<strong>Error:</strong> <br/>",
						message: data.error
					},{
						type: "danger",
						showProgressbar: false,
						placement: {
							from: "bottom",
							align: "right"
						},
						delay: 4000,
						timer: 3000,
						animate: {
							enter: 'animated fadeInDown',
							exit: 'animated fadeOutUp'
						}
					});
				}
			});
			
		});
	});
</script>

<script type="text/javascript">
	$(function(){
		
		$('#tipoDocTransp').change(function(){
			var cod=$('#tipoDocTransp').val();
			var codigo=$('#id_proveedor').val();
			var url = '<?php print site_url().'/verHistTransp'?>';
			$('#tbHisTransp').empty();
			$.post(url, {id_prov:codigo,tipoDoc:cod}, function(data, textStatus, xhr) {
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
						fila     +=" <td><center><input type='checkbox'  disabled='true' class='minimal  icheckbox_flat-green' 'value='"+obj.PATH_DOC+"'></center></td>";
					}
					
					fila     += "<td><center><a class='btn btn-success fancybox' href='"+ruta_doc+"' target='_blank' rel='ligthbox'><i class='glyphicon glyphicon-eye-open center'></i></a></center></td></tr>";
					$("#tbHisTransp").append(fila);
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
			var url = '<?php print site_url().'/getDataDoc'?>';
			
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
				
			}
		});
	});
</script>