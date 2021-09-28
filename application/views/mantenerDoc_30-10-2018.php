 <!-- Content Wrapper. Contains page content -->
 <?php $trans=$this->session->userdata('transp');?>
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<h1>Flota transportista<small>Documentos Mantenedor</small></h1>
 		<ol class="breadcrumb">
 			<li><a href='<?php echo site_url() ?>'><span class='glyphicon glyphicon-folder-open'></span>Transportista</a></li>
 			<li class='active'><a>Documentos</a></li>
 		</ol>
 	</section>

 	<!-- Main content -->
 	<section class="content">
 		<!-- Default box -->
 		<div class="box box-primary">
 			<div class="box-header">
 				<div class="form-group col-sm-4">
 					<label for="id_proveedor">Código</label>
 					<input type="input" class="form-control " id="id_proveedor" value="<?php print $trans->ID_PROVEEDOR?>" readonly="true">
 					<input type="input" class="form-control hidden" id="oficina" value="<?php print $trans->OFICINA?>" readonly="true">
 				</div>
 				<div class="form-group col-sm-4">
 					<label>Rut</label>
 					<input type="input" id='rut_prov' name='rut_prov' class="form-control" value="<?php print $trans->RUT_TANSPORTISTA?>" readonly="true">
 				</div>
 				<div class="form-group col-sm-4">
 					<label for="nombre">Razon social</label>
 					<input type="input" class="form-control" value="<?php print $trans->RAZON_SOCIAL?>" readonly="true">
 				</div>

 				<div class="form-group col-sm-4">
 					<label>Ficha transportista</label>
 					<a class="btn btn-default btn-block" id='verFichaTransp' data-toggle="tooltip" data-placement="bottom" title="Ver ficha"><i class="glyphicon glyphicon-list-alt pull-left"></i>Detalle</a>
 				</div>
 				<div class="row">
 					<div class="col-xs-12">
 						<div class="col-md-12">
 							<div class="form-group">
 								<label></label>
 								<a href="javascript:window.history.back();" class="btn btn-default pull-right"><i class="fa fa-reply"></i> Volver atrás</a>
 							</div>
 						</div>

 					</div>
 				</div>
 			</div>

 			<!-- /.box-footer-->
 		</div>
 		<!-- /.box -->
 		<div class="box box-solid">
 			<div class="box-header ui-sortable-handle bg-primary" style="cursor: move;">
 				<i class="fa fa-user" style="color: white;"></i>
 				<h3 class="box-title" style="color: white;">Documentos transportista</h3>

 				<div class="box-tools pull-right">
 					<button type="button" class="btn bg-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
 					</button>
 					<button type="button" class="btn bg-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i>
 					</button>
 				</div>
 			</div>
 			<!-- /.box-header -->
 			<div class="box-body no-padding"><br/>
 				<div class="container-fluid">
 					<div class="row">
 						<div class="col-sm-4">
 							<a id='btNuevoDocTransp' data-toggle="tooltip" data-placement="right" title="Transportista" class="btn btn-primary form-control"><i class="fa fa-upload pull-left"></i>Subir documento</a>
 						</div>
 						<div class="col-sm-12">
 							<div class="row table-responsive no-left-right-margin">
 								<table id='docTransp' class="display table table-hover table-striped">
 									<thead class="">
 										<tr>
 											<td><b>Tipo documento</b></td>
 											<td><b>Estado(fecha vigencia)</b></td>
 											<td><b>Documentos</b></td>
 										</tr>
 									</thead>
 									<tbody id='tdocTransp'></tbody>
 								</table>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 			<!-- /.box-body -->
 			<div class="box-footer text-black">

 			</div>
 			<!--footer box-->
 		</div>
 		<!--CAMION-->
 		<div class="box box-solid">
 			<div class="box-header ui-sortable-handle bg-primary" style="cursor: move;">
 				<i class="fa fa-truck" style="color: white;"></i>
 				<h3 class="box-title" style="color: white;">Documentos camión</h3>

 				<div class="box-tools pull-right">
 					<button type="button" class="btn bg-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
 					</button>
 					<button type="button" class="btn bg-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i>
 					</button>
 				</div>
 			</div>
 			<!-- /.box-header -->
 			<div class="box-body no-padding"><br/>
 				<div class="container-fluid">
 					<div class="row">
 						<div class="col-sm-4">
 							<div class="form-group">
 								<label>Subir nuevo documento</label>
 								<a id='btNuevoDocCamion' data-toggle="tooltip" data-placement="bottom" title="Camión" class="btn btn-primary form-control"><i class="fa fa-upload pull-left"></i>Subir documento</a>
 							</div>	
 						</div>
 						<div class="col-sm-4">
 							<div class="form-group">
 								<label>Patente camión</label>
 								<select class="form-control select2 " id='patenteCamion'>
 								</select>
 							</div>
 						</div>
 						<div class="col-sm-4">
 							<div class="form-group">
 								<label>Ficha camión</label>
 								<a class="btn btn-default btn-block" id='verFichaCamion' data-toggle="tooltip" data-placement="bottom" title="Ver ficha"><i class="glyphicon glyphicon-list-alt pull-left"></i>Detalle camión</a>
 							</div>
 						</div>

 					</div>
 					<div class="row table-responsive no-left-right-margin">
 						<table id='docCamion' class="table table-hover table-striped">
 							<thead class="">
 								<tr><td><b>Tipo documento</b></td><td><b>Estado(fecha vigencia)</b></td><td><b>Documentos</b></td></tr>
 							</thead>
 							<tbody id='tbDocCamiones'></tbody>
 						</table>
 					</div>
 				</div>
 			</div>
 			<!-- /.box-body -->
 			<div class="box-footer text-black">

 			</div>
 			<!--footer box-->
 		</div>
 		<!-- CHOFER-->
 		<!-- /.box -->
 		<div class="box box-solid">
 			<div class="box-header ui-sortable-handle bg-primary" style="cursor: move;">
 				<i class="fa fa-user" style="color: white;"></i>
 				<h3 class="box-title" style="color: white;">Documentos chofer</h3>

 				<div class="box-tools pull-right">
 					<button type="button" class="btn bg-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
 					</button>
 					<button type="button" class="btn bg-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i>
 					</button>
 				</div>
 			</div>
 			<!-- /.box-header -->
 			<div class="box-body no-padding"><br/>
 				<div class="container-fluid">
 					<div class="row">
 						<div class="col-sm-4">
 							<div class="form-group">
 								<label>Subir nuevo documento</label>
 								<a id='btNuevoDocChofer' data-toggle="tooltip" data-placement="bottom" title="Chofer" class="btn btn-primary form-control"><i class="fa fa-upload pull-left"></i>Subir documento</a>
 							</div>	
 						</div>
 						<div class="col-sm-4">
 							<div class="form-group">
 								<label>Rut y nombre chofer</label>
 								<select class="form-control select2" id='rut_chofer'>
 								</select>
 							</div>
 						</div>
 						<div class="col-sm-4">
 							<div class="form-group">
 								<label>Ficha chofer</label>
 								<a class="btn btn-default btn-block" href="" id='verFichaChofer' data-toggle="tooltip" data-placement="bottom" title="Ver ficha"><i class="glyphicon glyphicon-list-alt pull-left"></i>Detalle chofer</a>
 							</div>
 						</div>
 					</div>
 					<div class="row table-responsive no-left-right-margin">
 						<table id='docChofer' class="table table-responsive table-hover table-striped">
 							<thead class="">
 								<tr><td><b>Tipo documento</b></td><td><b>Estado(fecha vigencia)</b></td><td><b>Documentos</b></td></tr>
 							</thead>
 							<tbody id='tbChofer'></tbody>
 						</table>
 					</div>
 				</div>
 			</div>
 		</div>


 		<!--AYUDANTE-->
 		<!-- /.box -->
 		<div class="box box-solid">
 			<div class="box-header ui-sortable-handle bg-primary" style="cursor: move;">
 				<i class="fa fa-users" style="color: white;"></i>
 				<h3 class="box-title" style="color: white;">Documentos ayudante</h3>
 				<div class="box-tools pull-right">
 					<button type="button" class="btn bg-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
 					</button>
 					<button type="button" class="btn bg-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i>
 					</button>
 				</div>
 			</div>
 			<!-- /.box-header -->
 			<div class="box-body no-padding"><br/>
 				<div class="container-fluid">
 					<div class="row">
 						<div class="col-sm-4">
 							<div class="form-group">
 								<label>Subir nuevo documento</label>
 								<a id='btNuevoDocAyudante' data-toggle="tooltip" data-placement="bottom" title="Ayudante" class="btn btn-primary form-control"><i class="fa fa-upload pull-left"></i>Subir documento</a>
 							</div>	
 						</div>
 						<div class="col-sm-4">
 							<div class="form-group">
 								<label>Rut y nombre ayudante</label>
 								<select class="select2 form-control" id='rut_ayudante'>
 								</select>
 							</div>
 						</div>
 						<div class="col-sm-4">
 							<div class="form-group">
 								<label>Ficha ayudante</label>
 								<a class="btn btn-default btn-block" id='verFichaAyudante' href="" data-toggle="tooltip" data-placement="bottom" title="Ver ficha"><i class="glyphicon glyphicon-list-alt pull-left"></i>Detalle ayudante</a>
 							</div>
 						</div>
 					</div>
 					<div class="row table-responsive no-left-right-margin">
 						<table id='docAyudante' class="table table-responsive table-hover table-striped">
 							<thead class="">
 								<tr><td><b>Tipo documento</b></td><td><b>Estado(fecha vigencia)</b></td><td><b>Documentos</b></td></tr>
 							</thead>
 							<tbody id='tbAyudante'></tbody>
 						</table>
 					</div>
 				</div>
 			</div>
 		</div>
 		<!-- /.box-body -->
 		<div class="box-footer text-black">

 		</div>
 		<!--footer box-->
 	</div>
 </section>
 <!-- /.content -->
</div>


<!--MODAL SUBIR ARCHIVO TRANSPORTISTA-->
<div class="modal fade" id="modalDocTransp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form Method='POST' enctype="multipart/form-data"  id="formTransp">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Subir documento transportista</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							
							<input type="text" readonly="true" class="form-control hidden" id='codigoTransp' name='codigoTransp'></input>
							<input type="text" readonly="true" class="form-control hidden" id='rutprov' name='rutprov'></input>
							<div class="form-group col-sm-6">
								<label>Tipo de documento</label><br/>
								<select class="form-control select2 col-sm-12" id='tipoDocTransp' name='tipoDocTransp'>
								</select>
							</div>
							<div id='datediv' class="form-group col-sm-6 hidden">
								<label>Fecha de vigencia</label>
								<div class="input-group date" >
									<input id='fechaDocTransp' type="text" class="form-control"  name="fechaDocTransp" class="date" readonly>
									<div class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</div>
								</div>
							</div>
							<diV class='col-sm-6 hidden' id='divCompartido'>
								<div class="form-group">
									<label>Documento compartido</label>
								</div>
								<input type="text" name='docCompartido' class="form-control" id="docCompartido" value='NO'/>
							</diV>
							
							<div class="col-sm-12">
								<div class="form-group">
									<label for="documento">Adjuntar archivo</label>
									<input type="file" id="docTransp" name='docTransp'>
								</div>
							</div>


						</div>
						
						<div class="row">
							<div id='SeleccionPersonal' class="hidden">
								
								<div class="col-sm-6">
									<div class="form-group">
										<label>Chofer</label>
										<select class="selectpicker col-sm-12 form-control" id='selectChofer' name="selectChofer_doc" multiple data-actions-box="true" data-selected-text-format="count">

										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Ayudantes</label>
										<select class="selectpicker col-sm-12 form-control" id='selectAyudante' name="selectAyudante_doc" multiple data-actions-box="true"  data-selected-text-format="count">

										</select>
									</div>
								</div>

							</div>
							<div class="col-sm-12">
								<div id='alertErrorTransp' class="alert alert-danger hidden" role="alert">

								</div>
							</div>
							
						</div>
						

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" id='btaddDocTransp' class="btn btn-primary">Subir</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--MODAL SUBIR ARCHIVO CAMION-->
<div class="modal fade" id="modalDocCamion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form Method='POST' enctype="multipart/form-data" action="<?php echo site_url();?>/addDocCamion" id="formDocCamion">
				<div class="modal-header btn-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Subir documento camion</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="col-sm-12">
							<div id='alertErrorCamion' class="alert alert-danger hidden" role="alert">

							</div>
							<input type="text" readonly="true" class="form-control hidden" id='CodCamion' name='CodCamion'></input>
							<input type="text" readonly="true" class="form-control hidden" id='patenteDocCamion' name='patenteDocCamion'></input>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Tipo de documento</label><br/>
									<select class="form-control select2" id='TipoDocCamion' name='TipoDocCamion'>
									</select>
								</div>
							</div>
							
							<div id='datedivcamion' class="form-group col-sm-6 hidden">
								<label>Fecha de vigencia</label>
								<div class="input-group date" >
									<input id='FechaDocCamion' type="text" class="form-control"  name="FechaDocCamion" class="date" readonly>
									<div class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</div>
								</div>
							</div>	
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="documento">Adjuntar archivo</label>
									<input type="file" id="docCamion" name='docCamion'>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type='button' id='btAddDocCamion' class="btn btn-primary">Subir</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--MODAL SUBIR ARCHIVO CHOFER-->
<div class="modal fade" id="modalDocChofer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form Method='POST' enctype="multipart/form-data" action="<?php echo site_url();?>/addDocChofer" id="formDocChofer">
				<div class="modal-header btn-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Subir documento chofer</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="col-sm-12">
							<div id='alertErrorChofer' class="alert alert-danger hidden" role="alert">
							</div>
							<input type="text" readonly="true" class="form-control hidden" id='codChofer' name='codChofer'></input>
							<input type="text" readonly="true" class="form-control hidden" id='rut_choferDoc' name='rut_choferDoc'></input>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Tipo de documento</label><br/>
									<select class="form-control select2" id='TipoDocChofer' name='TipoDocChofer'>
									</select>
								</div>
							</div>
							
							<div id='datedivchofer' class="form-group col-sm-6 hidden">
								<label>Fecha de vigencia</label>
								<div class="input-group date" >
									<input id='FechaDocChofer' type="text" class="form-control"  name="FechaDocChofer" class="date" readonly>
									<div class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</div>
								</div>
							</div>	
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="documento">Adjuntar archivo</label>
									<input type="file" id="docChofer" name='docChofer'>
								</div>
							</div>
						</div>
						<div class="col-sm-12 hidden" id="divduenno">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="documento">Transportista dueño </label><small> (opcional, solo cuando el chofer es dueño de la empresa)</small><br/>
									<input type='checkbox' data-toggle="tooltip" title="Chofer es dueño de la empresa transportista" class='minimal icheckbox_flat-green' name='checkDuenno' id='checkDuenno' />
									<p>Se debe adjuntar, carnet de identidad en el caso de que el chofer sea el dueño de la empresa transportista</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" id='btAddDocChofer' class="btn btn-primary">Subir</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--MODAL SUBIR ARCHIVO AYUDANTE-->
<div class="modal fade" id="modalDocAyudante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form Method='POST' enctype="multipart/form-data" action="<?php echo site_url();?>/addDocAyudante" id="formDocAyudante">
				<div class="modal-header btn-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Subir documento ayudante</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="col-sm-12">
							<div id='alertErrorAyudante' class="alert alert-danger hidden" role="alert">
							</div>
							<input type="text" readonly="true" class="form-control hidden" id='codAyudante' name='codAyudante'></input>
							<input type="text" readonly="true" class="form-control hidden" id='rut_ayudanteDoc' name='rut_ayudanteDoc'></input>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Tipo de documento</label><br/>
									<select class="form-control select2" id='TipoDocAyudante' name='TipoDocAyudante'>
									</select>
								</div>
							</div>
							
							<div id='datedivayudante' class="form-group col-sm-6 hidden">
								<label>Fecha de vigencia</label>
								<div class="input-group date" >
									<input id='FechaDocAyudante' type="text" class="form-control"  name="FechaDocAyudante" class="date" readonly>
									<div class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</div>
								</div>
							</div>	
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="documento">Adjuntar archivo</label>
									<input type="file" id="docAyudante" name='docAyudante'>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" id='btAddDocAyudante' class="btn btn-primary">Subir</button>
				</div>
			</form>
		</div>
	</div>
</div>





</section>
<!-- /.content -->
</div>

<!-- /.content-wrapper -->

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
		$('#verFichaTransp').click(function(e){
			e.preventDefault();
			var codigo  = $('#id_proveedor').val();
			var oficina = $('#oficina').val();
			var url='<?php print site_url().'/seleccionar'?>';		
			$.post(url, {codigo: codigo,oficina:oficina}, function(data, textStatus, xhr) {
				if(data.msg===false){
					alert('Error de servidor');
				}else{
					window.location = '<?php print site_url()?>' + '/verFicha';
				}
			},'json');
		});
	});
</script>
<script type="text/javascript">
	$(function(){
		var t = $('#docTransp').DataTable({
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-center", "targets": [2]},
			{ "width": "50%",  "targets":  0 },
			{ "width": "20%",  "targets":  1 },
			{ "width": "30%", "targets":   2 }
			],
			"paging": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por página",
				"zeroRecords": "Busqueda no encontrada",
				"info": "",
				"infoEmpty": "Busqueda",
				"infoFiltered": "(entre _MAX_ registro totales)",
				"sLoadingRecords": "Cargando...",        
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				}, 
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		});


		jQuery("#footer").ready(function(){
			jQuery("#docTransp_length").addClass('hidden');
			jQuery("#docTransp_filter").addClass('hidden');
		});
		cargarDocsTransp();
		function cargarDocsTransp(){
			var url = '<?php print site_url().'/verDocTransp'?>';
			t.clear();
			var codigo=$('#id_proveedor').val();
			$.post(url, {id:codigo}, function(data, textStatus, xhr) {
				if(data.msg===false){
					alert('Error servidor, recargar página');
				}else{
					$.each(data.msg, function (i, obj) {
						var doc='';
						var fecha=obj.FECHAVIGENCIA;
						var estado='';
						var ruta_doc="";
						if(obj.PATH_DOC !=null){
							ruta_doc="<?php print base_url()."doc/"?>"+obj.PATH_DOC;
						}else{
							ruta_doc=obj.FULL_PATH;
						}
						if(obj.ESTADO.toLowerCase() == 'faltante'){
							doc='<button id="btmodal_transp" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button>  ';
							fecha='No registrada';
							estado="<p class='text-danger'><strong><span class='label center-block label-danger'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
						}else{
							if(obj.FECHAVIGENCIA==null){
								fecha='No aplica'
							}
							var btn='btn-success';
							if(obj.ESTADO.toLowerCase() == 'proximo a vencer'){
								estado="<p class='text-warning'><span class='label center-block label-warning'><strong>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
								btn='btn-warning';
								doc+='<button id="btmodal_transp" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button> ';
							}else{
								estado="<p class='text-success'><strong><span class='label center-block label-success'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
							}
							doc+='<a class="btn '+btn+' fancybox" data-toggle="tooltip" title="Ver documento" target="_blank" rel="ligthbox" href="'+ruta_doc+'" ><i class="fa fa-search"></i></a>';
							
						}
						t.row.add([obj.NOMBREDOC,estado,doc]).draw( true );
						$("a.fancybox").fancybox();
						$('[data-toggle="tooltip"]').tooltip();
					})


				}
			},'json');
		}
		$("body").on("click", "#btmodal_transp", function (e) {
			e.preventDefault();
			var datos = $(this).val();
			selectTrasnportista(datos);
			verificarDependencia(datos);
			$('#alertErrorTransp').removeClass('show');
			$('#alertErrorTransp').addClass('hidden');
			$('#modalDocTransp').modal('show');
		});

		var dependencia_var='';
		function verificarDependencia(codigo){
			$.ajax({
				url: '<?php print site_url().'/verDocCompartido' ?>',
				type: 'POST',
				dataType: 'json',
				data: {codigo:codigo},
			})
			.done(function(data) {
				if(data.status){
					$('#docCompartido').val('SI');
					dependencia_var='SI';
					cargarSelectChoferAyudante();
					$('#SeleccionPersonal').removeClass('hidden');
					$('#SeleccionPersonal').addClass('show');
				}else{
					$('#docCompartido').val('NO');
					dependencia_var='NO';
					$('#SeleccionPersonal').removeClass('show');
					$('#SeleccionPersonal').addClass('hidden');
				}	
			})
			.fail(function() {						
				location.reload();
			})
			.always(function() {
				console.log("complete");
			});
		}

		function cargarSelectChoferAyudante(){
			var id_trans =$('#id_proveedor').val();
			var oficina  =$('#oficina').val();
			$.ajax({
				url: '<?php print site_url().'/getChoferAyudantes'?>',
				type: 'POST',
				dataType: 'json',
				data: {id_proveedor: id_trans, oficina:oficina},
			})
			.done(function(data) {
				$('#selectChofer').empty();
				$('#selectAyudante').empty();
				var filaAyudante='';
				var filaChofer='';
				$.each(data.CHOFER, function(i, obj) {
					filaChofer+='<option value="'+obj.CODCHOFER+'">'+obj.RUTCHOFER+' | '+obj.NOMBRECHOFER+'</option>';
				});
				$.each(data.AYUDANTES, function(i, obj) {
					filaAyudante+='<option value="'+obj.CODCHOFER+'">'+obj.RUTCHOFER+' | '+obj.NOMBRECHOFER+'</option>';
				});
				$('#selectChofer').append(filaChofer);
				$('#selectAyudante').append(filaAyudante);
				$('.selectpicker').selectpicker('refresh');
			})
			.fail(function() {						
				location.reload();
			})
			.always(function() {
				console.log("complete");
			});
		}

		$('#btNuevoDocTransp').click(function(e){
			e.preventDefault();
			selectTrasnportista(-1);
			$('#modalDocTransp').modal('show');
		});
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
				mostrarFechaVigencia();
				$('#codigoTransp').val($('#id_proveedor').val());
				$('#rutprov').val($('#rut_prov').val());
			});
		}

		$("#tipoDocTransp").change(function(){
			mostrarFechaVigencia();
			verificarDependencia($(this).val());
		});

		function mostrarFechaVigencia(){
			var cod =$('#tipoDocTransp').val();			
			var url='<?php print site_url().'/getFechaDoc'?>';
			$.post(url, {id_tipoDoc:cod}, function(data, textStatus, xhr) {
				if(data.msg.VALIDADOR!=-1){
					$('#datediv').removeClass('hidden');
					$('#datediv').addClass('show');
				}else{
					$('#datediv').removeClass('show');
					$('#datediv').addClass('hidden');
					$('#fechaDocTransp').val('');
				}
			},'json');
		}

		$('#btaddDocTransp').click(function(e){			
			$('#btaddDocTransp').prop('disabled', true);
			var cod =$('#tipoDocTransp').val();
			var fecha=$('#fechaDocTransp').val();
			if(cod!=null){
				Pace.track(function(){
					$.post('<?php print site_url().'/getFechaDoc'?>', {id_tipoDoc:cod}, function(data, textStatus, xhr) {
						if(data.msg.VALIDADOR!=-1 && fecha==''){
							$('#alertErrorTransp').removeClass('hidden');
							$('#alertErrorTransp').html('Error, ingrese fecha.').focus();
							$('#alertErrorTransp').addClass('show');							
							$('#btaddDocTransp').prop('disabled', false);
						//alertErrorTransp
					}else{
						var compartido     =$('#docCompartido').val();
						var selectChofer   =$('#selectChofer').val();
						var selectAyudante =$('#selectAyudante').val();
						if(dependencia_var=='SI' && (selectChofer=='' || selectAyudante=='')){
							$('#alertErrorTransp').removeClass('hidden');
							$('#alertErrorTransp').removeClass('alert-success');
							$('#alertErrorTransp').html('<h4>IMPORTANTE!</h4>Esta a punto de subir un documento compartido, se ha detectado que no ha seleccionado chofer o ayudantes.<br/>¿Desea continuar de todas formas?<br/>');
							$('#alertErrorTransp').append('<br/><button id="btn_aceptar_doc" class="btn text-black bg-gray">Aceptar</button>');
							$('#alertErrorTransp').addClass('show');
							$('#alertErrorTransp').addClass('alert-danger');							
							$('#btaddDocTransp').prop('disabled', false);
						}else{
							subirDocMetodo();
						}
					}
				},'json').fail(function() {						
					location.reload();
				}); 
			});
			}else{
				$('#alertErrorTransp').removeClass('hidden');
				$('#alertErrorTransp').removeClass('alert-success');
				$('#alertErrorTransp').html('Seleccionar tipo documento');
				$('#alertErrorTransp').addClass('show');
				$('#alertErrorTransp').addClass('alert-danger');				
				$('#btaddDocTransp').prop('disabled', false);
			}
		});

		$("body").on("click", "#btn_aceptar_doc", function (e) {
			e.preventDefault();
			subirDocMetodo();
		});


		function subirDocMetodo(){			
			var url2           = '<?php echo site_url();?>/addDocTransp';
			var formulario     = new FormData(document.getElementById("formTransp"));
			var selectChofer   = $('#selectChofer').val();
			var selectAyudante = $('#selectAyudante').val();	
			formulario.append('choferes',selectChofer);
			formulario.append('ayudantes',selectAyudante);
			Pace.track(function(){
				$.ajax({
					url: url2,
					type: 'POST',
					data: formulario,
					processData: false,
					contentType: false,
					dataType:'JSON',
					cache: false,
					async: false
				}).done(function(data){
					if(data.status==true){
						$('#modalDocTransp').modal('hide');						
						$('#btaddDocTransp').prop('disabled', false);
						location.reload();
					}else{
						$('#alertErrorTransp').removeClass('hidden');
						$('#alertErrorTransp').removeClass('alert-success');
						$('#alertErrorTransp').html(data.error);
						$('#alertErrorTransp').addClass('show');
						$('#alertErrorTransp').addClass('alert-danger');						
						$('#btaddDocTransp').prop('disabled', false);
					}
				}).fail(function() {						
					location.reload();
				});
			});			
		}


	});
</script>

<script type="text/javascript">
	$(function(){
		$('#patenteCamion').select2();
		var t = $('#docCamion').DataTable({
			"paging": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-center", "targets": [2]},
			{ "width": "50%",  "targets":  0 },
			{ "width": "20%",  "targets":  1 },
			{ "width": "30%", "targets":   2 }
			],
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por página",
				"zeroRecords": "Busqueda no encontrada",
				"info": "",
				"infoEmpty": "Busqueda",
				"infoFiltered": "(entre _MAX_ registro totales)",
				"sLoadingRecords": "Cargando...",        
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				}, 
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		});
		jQuery("#footer").ready(function(){
			jQuery("#docCamion_length").addClass('hidden');
			jQuery("#docCamion_filter").addClass('hidden');
		});

		//cargar patentes
		//patenteCamion
		seletcPatentes();
		function seletcPatentes(){
			var url = '<?php print site_url().'/getPatentes'?>';
			var id_transp=$('#id_proveedor').val();
			$('#patenteCamion').empty();
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {id_transp: id_transp},
			}).done(function(data) {
				if(data.length==0){
					var fila="<option selected disabled>Seleccionar patente</option>";
				}else{
					var cod_camion;
					$.each(data, function (i, obj) {
						if(i==0){
							fila+='<option value="'+obj.CODCAMION+'" selected>'+obj.PATENTE+'</option>';
							cod_camion=obj.CODCAMION;
						}else{
							fila+='<option value="'+obj.CODCAMION+'">'+obj.PATENTE+'</option>';
						}
					});
					cargarDocsCamion(cod_camion);
				}
				$('#patenteCamion').append(fila);
			}).fail(function() {						
				location.reload();
			});
		}

		$('#verFichaCamion').click(function(){
			var patente=$('#patenteCamion').val();
			var url='<?php print site_url().'/seleccionarCamion'?>';
			if(patente!=null){
				$.post(url, {patente:patente}, function(data) {
					if(data.msg===false){
						alert('Error de servidor');
					}else{
						window.location = '<?php print site_url()?>' + '/cargarFichaDoc';
					}
				},'json').fail(function() {						
					location.reload();
				});
			}else{
				pf_notify("Error","No hay registros de camiones","danger");
			}
		});

		function cargarDocsCamion(camion){
			var url='<?php print site_url()."/getDocsCamiones"?>';
			t.clear();
			$.post(url, {camion:camion}, function(data) {
				$.each(data, function (i, obj) {
					var doc='';
					var fecha=obj.FECHAVIGENCIA;
					var estado='';
					var ruta_doc='';
					if(obj.PATH_DOC !=null){
						ruta_doc="<?php print base_url()."doc/"?>"+obj.PATH_DOC;
					}else{
						ruta_doc=obj.FULL_PATH;
					}
					if(obj.ESTADO.toLowerCase()=='faltante'){
						doc='<button id="btmodal_camion" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button>  '
						fecha='No registrada';
						estado="<p class='text-danger'><strong><span class='label center-block label-danger'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
					}else{
						if(obj.FECHAVIGENCIA==null){
							fecha='No aplica'
						}
						var btn='btn-success';
						if(obj.ESTADO.toLowerCase()=='proximo a vencer'){
							estado="<p class='text-warning'><strong><span class='label center-block label-warning'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
							btn='btn-warning';
							doc+='<button id="btmodal_transp" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button>  ';
						}else{
							estado="<p class='text-success'><strong><span class='label center-block label-success'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
						}
						doc+='  <a class="btn '+btn+' fancybox" data-toggle="tooltip" title="Ver documento" target="_blank" rel="ligthbox" href="'+ruta_doc+'" ><i class="fa fa-search"></i></a>';
					}
					t.row.add([obj.NOMBREDOC,estado,doc]).draw( true );
					$("a.fancybox").fancybox();
					$('[data-toggle="tooltip"]').tooltip();
				})
			},'json').fail(function() {						
				location.reload();
			});
		}

		$("body").on("click", "#btmodal_camion", function (e) {			
			e.preventDefault();
			var datos = $(this).val();
			$('#alertErrorCamion').addClass('hidden');
			$('#alertErrorCamion').removeClass('show');
			selectDocCamion(datos);
			$('#modalDocCamion').modal('show');
		});
		$("#TipoDocCamion").change(function(){
			mostrarFechaVigenciaCamion();
		});
		//Change patente para ver docs del camion seleccionado
		$("#patenteCamion").change(function(){
			cargarDocsCamion($('#patenteCamion').val());
		});

		$('#btNuevoDocCamion').click(function(){
			var cod_camion=$('#patenteCamion').val();
			if(cod_camion!=null){
				selectDocCamion(-1);
				$('#modalDocCamion').modal('show');
			}else{
				pf_notify('Error','No hay registros de camiones con el transportista','danger');				
			}
		});

		function selectDocCamion(activo){
			var url = '<?php print site_url().'/getTiposDocCamion'?>';
			$('#TipoDocCamion').empty();
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
				$('#TipoDocCamion').append(fila);
				mostrarFechaVigenciaCamion();
				$('#CodCamion').val($('#patenteCamion').val());
				$('#patenteDocCamion').val($("#patenteCamion :selected").text());
			}).fail(function() {						
				location.reload();
			});
		}

		function mostrarFechaVigenciaCamion(){
			var cod =$('#TipoDocCamion').val();
			var url='<?php print site_url().'/getFechaDoc'?>';
			$.post(url, {id_tipoDoc:cod}, function(data, textStatus, xhr) {
				if(data.msg.VALIDADOR!=-1){
					$('#datedivcamion').removeClass('hidden');
					$('#datedivcamion').addClass('show');
				}else{
					$('#datedivcamion').removeClass('show');
					$('#datedivcamion').addClass('hidden');
					$('#FechaDocCamion').val('');
				}
			},'json');
		}

		//BOTON SUBIR ARCHIVO CAMION
		$('#btAddDocCamion').click(function(e){			
			$('#btAddDocCamion').prop('disabled', true);
			var cod =$('#TipoDocCamion').val();
			var fecha=$('#FechaDocCamion').val();
			if(cod!=null){
				Pace.track(function(){
					$.post('<?php print site_url().'/getFechaDoc'?>', {id_tipoDoc:cod}, function(data, textStatus, xhr) {
						if(data.msg.VALIDADOR!=-1 && fecha==''){
							$('#alertErrorCamion').removeClass('hidden');
							$('#alertErrorCamion').html('Error, ingrese fecha.').focus();
							$('#alertErrorCamion').addClass('show');
							$('#btAddDocCamion').prop('disabled', false);
						//alertErrorTransp
					}else{
						var url2 = $('#formDocCamion').attr('action');
						$.ajax({
							url: url2,
							type: 'POST',
							dataType:'JSON',
							data: new FormData(document.getElementById("formDocCamion")),
							processData: false,
							contentType: false,
							cache: false,
							async: false
						}).done(function(data){
							if(data.status==true){
								cargarDocsCamion($('#patenteCamion').val());
								$('#fechaDocCamion').val("");
								$('#modalDocCamion').modal('hide');
								$('#formDocCamion')[0].reset();
								$('#alertErrorCamion').addClass('hidden');
								$('#alertErrorCamion').removeClass('show');
								$('#btAddDocCamion').prop('disabled', false);
							}else{
								if(data.error==''){
									$('#alertErrorCamion').removeClass('hidden');
									$('#alertErrorCamion').removeClass('alert-success');
									$('#alertErrorCamion').html('Adjunte archivo...');
									$('#alertErrorCamion').addClass('show');
									$('#alertErrorCamion').addClass('alert-danger');
									$('#btAddDocCamion').prop('disabled', false);
								}else{
									$('#alertErrorCamion').removeClass('hidden');
									$('#alertErrorCamion').removeClass('alert-success');
									$('#alertErrorCamion').html(data.error);
									$('#alertErrorCamion').addClass('show');
									$('#alertErrorCamion').addClass('alert-danger');
									$('#btAddDocCamion').prop('disabled', false);
								}
							}
						}).fail(function() {						
							location.reload();
						});
					}
				},'json').fail(function() {						
					location.reload();
				});
			});
			}else{
				$('#alertErrorCamion').removeClass('hidden');
				$('#alertErrorCamion').removeClass('alert-success');
				$('#alertErrorCamion').html('Seleccionar tipo documento');
				$('#alertErrorCamion').addClass('show');
				$('#alertErrorCamion').addClass('alert-danger');
				$('#btAddDocCamion').prop('disabled', false);
			}
		});


	});
</script>

<script type="text/javascript">
	$(function(){
		$('#rut_chofer').select2();
		selectChofer();


		var t = $('#docChofer').DataTable({
			
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-center", "targets": [2]},
			{ "width": "50%",  "targets":  0 },
			{ "width": "20%",  "targets":  1 },
			{ "width": "30%", "targets":   2 }
			], 
			"paging": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por página",
				"zeroRecords": "Busqueda no encontrada",
				"info": "",
				"infoEmpty": "",
				"infoFiltered": "(entre _MAX_ registro totales)",
				"sLoadingRecords": "Cargando...",        
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				}, 
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		});
		jQuery("#footer").ready(function(){
			jQuery("#docChofer_length").addClass('hidden');
			jQuery("#docChofer_filter").addClass('hidden');
		});

		function selectChofer(){
			var url = '<?php print site_url().'/getListChofer'?>';
			var id_transp=$('#id_proveedor').val();
			$('#rut_chofer').empty();
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {id_transp: id_transp},
			}).done(function(data) {
				if(data.length==0){
					var fila="<option selected disabled>Seleccionar chofer</option>";
				}else{
					var cod_chofer;
					$.each(data, function (i, obj) {						
						if(i==0){
							fila+='<option value="'+obj.CODCHOFER+'" selected>'+obj.RUTCHOFER+' | '+obj.NOMBRECHOFER+'</option>';
							cod_chofer=obj.CODCHOFER;
						}else{
							fila+='<option value="'+obj.CODCHOFER+'">'+obj.RUTCHOFER+' | '+obj.NOMBRECHOFER+'</option>';
						}
					});
					cargarDocsChofer(cod_chofer);
				}
				$('#rut_chofer').append(fila);
			}).fail(function() {						
				location.reload();
			});
		}



		function cargarDocsChofer(chofer){
			var url='<?php print site_url()."/docsChofer"?>';
			t.clear();
			$.post(url, {cod_chofer:chofer}, function(data) {
				$.each(data, function (i, obj) {
					var doc='';
					var fecha=obj.FECHAVIGENCIA;
					var estado='|';
					var ruta_doc='';
					if(obj.PATH_DOC !=null){
						ruta_doc="<?php print base_url()."doc/"?>"+obj.PATH_DOC;
					}else{
						ruta_doc=obj.FULL_PATH;
					}
					if(obj.ESTADO.toLowerCase()=='faltante'){
						doc='<button id="bt_modalChofer" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button>  '
						fecha='No registrada';
						estado="<p class='text-danger'><strong><span class='label center-block label-danger'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
					}else{
						if(obj.FECHAVIGENCIA==null){
							fecha='No aplica'
						}
						var btn='btn-success';
						if(obj.ESTADO.toLowerCase()=='proximo a vencer'){
							estado="<p class='text-warning'><strong><span class='label center-block label-warning'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
							btn='btn-warning';
							doc+='<button id="bt_modalChofer" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button>  ';
						}else{
							estado="<p class='text-success'><strong><span class='label center-block label-success'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
						}
						doc+='<a class="'+btn+' btn fancybox" target="_blank" data-toggle="tooltip" title="Ver documento" rel="ligthbox" href="'+ruta_doc+'" ><i class="fa fa-search"></i></a>';
					}
					t.row.add([obj.NOMBREDOC,estado,doc]).nodes().draw( true );
					$("a.fancybox").fancybox();
					$('[data-toggle="tooltip"]').tooltip();
				})

			},'json').fail(function() {						
				location.reload();
			});
		}


		$("body").on("click", "#bt_modalChofer", function (e) {
			e.preventDefault();
			var datos = $(this).val();
			selectDocChofer(datos);
			verificarDuenno();
			$('#alertErrorChofer').removeClass('show');
			$('#alertErrorChofer').addClass('hidden');
			$('#modalDocChofer').modal('show');
		});

		$('#btNuevoDocChofer').click(function(){
			var cod_camion=$('#rut_chofer').val();
			verificarDuenno();
			if(cod_camion!=null){
				selectDocChofer(-1);
				$('#modalDocChofer').modal('show');
			}else{
				pf_notify('Error','No hay registros de choferes con el transportista','danger');				
			}
		});

		function verificarDuenno(){
			var cod_chofer= $('#rut_chofer').val();
			var oficina   = $('#oficina').val();			
			$.ajax({
				url: '<?php print site_url()?>/verificarDuenno',
				type: 'POST',
				dataType: 'json',
				data: {'codChofer': cod_chofer,'oficina':oficina},
			})
			.done(function(data) {
				if(data.status){
					$('#checkDuenno').prop('checked',true);				
				}else{
					$('#checkDuenno').prop('checked',false);
				}
			})
			.fail(function() {
				alert('Error, recargar página');
			})
			.always(function() {
				console.log("complete");
			});
			
		}

		function selectDocChofer(activo){
			var url = '<?php print site_url().'/getTiposDocChofer'?>';
			$('#TipoDocChofer').empty();
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
				$('#TipoDocChofer').append(fila);
				mostrarFechaVigenciaChofer();
				$('#codChofer').val($('#rut_chofer').val());
				var arr=$("#rut_chofer :selected").text().split(' ');
				$('#rut_choferDoc').val(arr[0]);
			}).fail(function() {						
				location.reload();
			});;
		}

		function mostrarFechaVigenciaChofer(){
			var cod =$('#TipoDocChofer').val();			
			var url='<?php print site_url().'/getFechaDoc'?>';
			$.post(url, {id_tipoDoc:cod}, function(data, textStatus, xhr) {
				if(cod == 9 || cod==30){
					$('#divduenno').removeClass('hidden');
					$('#divduenno').addClass('show');
				}else{
					$('#divduenno').removeClass('show');
					$('#divduenno').addClass('hidden');
				}
				if(data.msg.VALIDADOR!=-1){
					$('#datedivchofer').removeClass('hidden');
					$('#datedivchofer').addClass('show');
				}else{
					$('#datedivchofer').removeClass('show');
					$('#datedivchofer').addClass('hidden');
					$('#datedivchofer').val('');
				}
			},'json');
		}

		$("#TipoDocChofer").change(function(){
			mostrarFechaVigenciaChofer();
		});

		$("#rut_chofer").change(function(){
			cargarDocsChofer($('#rut_chofer').val());
		});

		$('#btAddDocChofer').click(function(e){
			$('#btAddDocChofer').prop('disabled', true);
			var cod        =$('#TipoDocChofer').val();
			var fecha      =$('#FechaDocChofer').val();
			var formulario = new FormData(document.getElementById("formDocChofer"));
			var oficina    = $('#oficina').val();
			var id_proveedor = $('#id_proveedor').val();
			var duenno = 'NO';
			if($('#checkDuenno').prop('checked')){
				duenno = 'SI';
			}
			formulario.append('duenno',duenno);
			formulario.append('oficina',oficina);
			formulario.append('id_proveedor',id_proveedor);
			if(cod!=null){				
				Pace.track(function(){
					$.post('<?php print site_url().'/getFechaDoc'?>', {id_tipoDoc:cod}, function(data, textStatus, xhr) {
						if(data.msg.VALIDADOR!=-1 && fecha==''){
							$('#alertErrorChofer').removeClass('hidden');
							$('#alertErrorChofer').html('Error, ingrese fecha.').focus();
							$('#alertErrorChofer').addClass('show');
							$('#btAddDocChofer').prop('disabled', false);					
						}else{
							var url2 = $('#formDocChofer').attr('action');
							$.ajax({
								url: url2,
								type: 'POST',
								dataType:'JSON',
								data: formulario,
								processData: false,
								contentType: false,
								cache: false,
								async: false
							}).done(function(data){
								if(data.status==true){
									cargarDocsChofer($('#rut_chofer').val());
									$('#modalDocChofer').modal('hide');
									$('#formDocChofer')[0].reset();
									$('#alertErrorChofer').addClass('hidden');
									$('#alertErrorChofer').removeClass('show');
									$('#btAddDocChofer').prop('disabled', false);
								}else{
									if(data.error==''){
										$('#alertErrorChofer').removeClass('hidden');
										$('#alertErrorChofer').removeClass('alert-success');
										$('#alertErrorChofer').html('Adjunte archivo...');
										$('#alertErrorChofer').addClass('show');
										$('#alertErrorChofer').addClass('alert-danger');
										$('#btAddDocChofer').prop('disabled', false);
									}else{
										$('#alertErrorChofer').removeClass('hidden');
										$('#alertErrorChofer').removeClass('alert-success');
										$('#alertErrorChofer').html(data.error);
										$('#alertErrorChofer').addClass('show');
										$('#alertErrorChofer').addClass('alert-danger');
										$('#btAddDocChofer').prop('disabled', false);
									}
								}
							}).fail(function() {						
								location.reload();
							});
						}
					},'json').fail(function() {						
						location.reload();
					});
				});			
			}else{
				$('#alertErrorChofer').removeClass('hidden');
				$('#alertErrorChofer').removeClass('alert-success');
				$('#alertErrorChofer').html('Seleccionar tipo documento');
				$('#alertErrorChofer').addClass('show');
				$('#alertErrorChofer').addClass('alert-danger');
				$('#btAddDocChofer').prop('disabled', false);
			}
		});


		$('#verFichaChofer').click(function(){
			var codigo=$('#rut_chofer').val();
			var url='<?php print site_url().'/ficha_chofer'?>';
			if(codigo!=null){
				$.post(url, {codigo:codigo}, function(data) {
					if(data.msg===false){
						alert('Error de servidor');
					}else{
						window.location = '<?php print site_url()?>' + '/cargarFichaChofer';
					}
				},'json').fail(function() {						
					location.reload();
				});
			}else{
				pf_notify('Error','No hay registros de chofer','danger');
			}
		});

	})
</script>

<script type='text/javascript'>
	$(function(){
		$('#rut_ayudante').select2();
		selectAyudante();
		var t = $('#docAyudante').DataTable({
			"order": [],
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-center", "targets": [2]},
			{ "width": "50%",  "targets":  0 },
			{ "width": "20%",  "targets":  1 },
			{ "width": "30%", "targets":   2 }
			], 
			"paging": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por página",
				"zeroRecords": "Busqueda no encontrada",
				"info": "",
				"infoEmpty": "",
				"infoFiltered": "(entre _MAX_ registro totales)",
				"sLoadingRecords": "Cargando...",        
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				}, 
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		});
		jQuery("#footer").ready(function(){
			jQuery("#docAyudante_length").addClass('hidden');
			jQuery("#docAyudante_filter").addClass('hidden');
		});


		function selectAyudante(){
			var url = '<?php print site_url().'/getListAyudante'?>';
			var id_transp=$('#id_proveedor').val();
			$('#rut_ayudante').empty();
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {id_transp: id_transp},
			}).done(function(data) {
				if(data.length==0){
					var fila="<option selected disabled>Seleccionar ayudante</option>";
				}else{
					var cod_Ayudante;
					$.each(data, function (i, obj) {
						if(i==0){
							fila+='<option value="'+obj.CODAYUDANTE+'" selected>'+obj.RUTAYUDATE+' | '+obj.NOMBREAYUDANTE+'</option>';
							cod_Ayudante=obj.CODAYUDANTE;
							$("#verFichaAyudante").attr("href", "<?php echo site_url()?>/seleccionarAyudante/"+obj.CODAYUDANTE);
						}else{
							fila+='<option value="'+obj.CODAYUDANTE+'">'+obj.RUTAYUDATE+' | '+obj.NOMBREAYUDANTE+'</option>';
						}
					});
					cargarDocsAyudante(cod_Ayudante);
				}
				$('#rut_ayudante').append(fila);
			}).fail(function() {						
				location.reload();
			});
		}



		function cargarDocsAyudante(ayudante){
			var url='<?php print site_url()."/docsAyudante"?>';
			t.clear();
			$.post(url, {cod_ayudante:ayudante}, function(data) {
				$.each(data, function (i, obj) {
					var doc='';
					var fecha=obj.FECHAVIGENCIA;
					var estado='';
					var ruta_doc='';
					if(obj.PATH_DOC !=null){
						ruta_doc="<?php print base_url()."doc/"?>"+obj.PATH_DOC;
					}else{
						ruta_doc=obj.FULL_PATH;
					}
					if(obj.ESTADO.toLowerCase()=='faltante'){
						doc='<button id="bt_modalAyudante" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload "></i></button> ';
						fecha='No registrada';
						estado="<p class='text-danger'><strong><span class='label center-block label-danger'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
					}else{
						if(obj.FECHAVIGENCIA==null){
							fecha='No aplica'
						}
						var btn='btn-success';
						if(obj.ESTADO.toLowerCase()=='proximo a vencer'){
							estado="<p class='text-warning'><strong><span class='label center-block label-warning'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
							btn='btn-warning';
							doc+='<button id="bt_modalAyudante" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button>  ';
						}else{
							estado="<p class='text-success'><strong><span class='label center-block label-success'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
						}
						doc+=' <a class="btn '+btn+' fancybox" target="_blank" rel="ligthbox" data-toggle="tooltip" title="Ver documento" href="'+ruta_doc+'" ><i class="fa fa-search "></i></a>';
					}
					t.row.add([obj.NOMBREDOC,estado,doc]).draw( true );
					$("a.fancybox").fancybox();
					$('[data-toggle="tooltip"]').tooltip();
				})
			},'json').fail(function() {						
				location.reload();
			});
		}

		function selectDocAyudante(activo){
			var url = '<?php print site_url().'/getTiposDocAyudante'?>';
			$('#TipoDocAyudante').empty();
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
				$('#TipoDocAyudante').append(fila);
				mostrarFechaVigenciaAyudante();
				$('#codAyudante').val($('#rut_ayudante').val());
				var arr=$("#rut_ayudante :selected").text().split(' ');
				$('#rut_ayudanteDoc').val(arr[0]);
			}).fail(function() {						
				location.reload();
			});
		}

		$("body").on("click", "#bt_modalAyudante", function (e) {
			e.preventDefault();
			var datos = $(this).val();
			selectDocAyudante(datos);			
			$('#alertErrorAyudante').removeClass('show');
			$('#alertErrorAyudante').addClass('hidden');
			$('#modalDocAyudante').modal('show');
		});

		$('#btNuevoDocAyudante').click(function(){
			var cod_camion=$('#rut_ayudante').val();
			if(cod_camion!=null){
				selectDocAyudante(-1);
				$('#modalDocAyudante').modal('show');
			}else{
				pf_notify('Error','No hay registros de ayudantes con el transportista','danger');				
			}
		});


		function mostrarFechaVigenciaAyudante(){
			var cod =$('#TipoDocAyudante').val();
			var url='<?php print site_url().'/getFechaDoc'?>';
			$.post(url, {id_tipoDoc:cod}, function(data, textStatus, xhr) {
				if(data.msg.VALIDADOR!=-1){
					$('#datedivayudante').removeClass('hidden');
					$('#datedivayudante').addClass('show');
				}else{
					$('#datedivayudante').removeClass('show');
					$('#datedivayudante').addClass('hidden');
					$('#datedivayudante').val('');
				}
			},'json');
		}

		$("#TipoDocAyudante").change(function(){
			mostrarFechaVigenciaAyudante();
		});

		$("#rut_ayudante").change(function(){
			cargarDocsAyudante($('#rut_ayudante').val());
			$("#verFichaAyudante").attr("href", "<?php echo site_url()?>/seleccionarAyudante/"+$(this).val());
		});


		$('#btAddDocAyudante').click(function(e){
			$('#btAddDocAyudante').prop('disabled', true);
			var cod =$('#TipoDocAyudante').val();
			var fecha=$('#FechaDocAyudante').val();
			if(cod!=null){
				$.post('<?php print site_url().'/getFechaDoc'?>', {id_tipoDoc:cod}, function(data, textStatus, xhr) {
					if(data.msg.VALIDADOR!=-1 && fecha==''){
						$('#alertErrorAyudante').removeClass('hidden');
						$('#alertErrorAyudante').html('Error, ingrese fecha.').focus();
						$('#alertErrorAyudante').addClass('show');
						$('#btAddDocAyudante').prop('disabled', false);
						//alertErrorTransp
					}else{
						var url2 = $('#formDocAyudante').attr('action');
						Pace.track(function(){
							$.ajax({
								url: url2,
								type: 'POST',
								dataType:'JSON',	
								data: new FormData(document.getElementById("formDocAyudante")),
								processData: false,
								contentType: false,
								cache: false,
								async: false
							}).done(function(data){
								if(data.status==true){
									cargarDocsAyudante($('#rut_ayudante').val());
									$('#fechaDocAyuante').val("");
									$('#cod_ayudante').val("");
									$('#modalDocAyudante').modal('hide');
									$('#formDocAyudante')[0].reset();
									$('#alertErrorAyudante').addClass('hidden');
									$('#alertErrorAyudante').removeClass('show');
									$('#btAddDocAyudante').prop('disabled', false);
								}else{
									if(data.error==''){
										$('#alertErrorAyudante').removeClass('hidden');
										$('#alertErrorAyudante').removeClass('alert-success');
										$('#alertErrorAyudante').html('Adjunte archivo...');
										$('#alertErrorAyudante').addClass('show');
										$('#alertErrorAyudante').addClass('alert-danger');
										$('#btAddDocAyudante').prop('disabled', false);
									}else{
										$('#alertErrorAyudante').removeClass('hidden');
										$('#alertErrorAyudante').removeClass('alert-success');
										$('#alertErrorAyudante').html(data.error);
										$('#alertErrorAyudante').addClass('show');
										$('#alertErrorAyudante').addClass('alert-danger');
										$('#btAddDocAyudante').prop('disabled', false);
									}
								}
							}).fail(function() {						
								location.reload();
							});
						});
					}
				},'json').fail(function() {						
					location.reload();
				});
			}else{
				$('#alertErrorAyudante').removeClass('hidden');
				$('#alertErrorAyudante').removeClass('alert-success');
				$('#alertErrorAyudante').html('Seleccionar tipo documento');
				$('#alertErrorAyudante').addClass('show');
				$('#alertErrorAyudante').addClass('alert-danger');
				$('#btAddDocAyudante').prop('disabled', false);
			}
		});		
	});
</script>