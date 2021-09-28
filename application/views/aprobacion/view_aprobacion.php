<?php $user = $this->session->userdata('usuario'); ?>

<style type="text/css">
	.bootstrap-select > .dropdown-toggle.bs-placeholder, .bootstrap-select > .dropdown-toggle.bs-placeholder:hover, .bootstrap-select > .dropdown-toggle.bs-placeholder:focus, .bootstrap-select > .dropdown-toggle.bs-placeholder:active {
		color: #212121;
	}

	.text-muted {
		color: black !important ;
	}
	.mayuscula {
		text-transform: capitalize;
	}
	.grab {
		cursor: -webkit-grab; 
		cursor: grab;
	}
	.grab:active {
		cursor: -webkit-grabbing; 
		cursor: grabbing;
	}
</style>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Aprobación Documentos<small> Sistema Documentación Flota</small></h1>
		<ol class="breadcrumb">
			<li><a ><span class='fa fa-check'></span>Aprocación</a></li>
			<li class='active'><a>Listado de documentos</a></li>
		</ol>

	</section>
	<!-- Main content -->
	<section class="content">
		
		<div class="box box-default">
			<div class="box-header ">
				<i class="fa fa-bookmark-o"></i>
				<h3 class="box-title">Documentación pendiente de aprobación</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="col-sm-6">
					<div class="form-group div_oficina">
						<label>Buscar por oficina</label>
						<select id='oficina' name='oficina' class="form-control selectpicker" multiple data-actions-box="true" data-selected-text-format="count" style="width: 100%">
							<?php foreach ($oficinas_usuario as $key): ?>
								<option selected value="<?php echo $key->ID_OFICINA?>"><?php echo ucwords(mb_strtolower($key->OFICINA))?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group div_oficina">
						<label>Tipo de Documento</label>
						<select class="form-control selectpicker show-tick" multiple data-placeholder="Seleccione Tipo de Documento"
						style="width: 100%;" id="tipodoc" name="tipodoc" data-actions-box="true" data-selected-text-format="count"> 
						<?php foreach ($documentos_usuario as $key): ?>
							<option selected data-subtext="<?php echo ucwords(mb_strtolower($key->AFECTADO)) ?>" value="<?php echo $key->ID_TIPO_DOC?>"><?php echo ucwords(mb_strtolower($key->NOMBREDOC))?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
		</div>

	</div>
	<!-- /.box -->


	<!-- <section class="connectedSortable"> -->

		<div id="box_transp" class="box box-solid">
			<div class="box-header bg-primary" >
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
			<div class="box-body">
				<!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label>Busqueda</label>
							<div class="input-group">
								<input id='search_transportista' type="text" class="form-control" placeholder="Buscar por palabra clave...">
								<span class="input-group-addon"><i class="fa fa-search"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table id='tabla_transportista' class="table table-responsive table-bordered">
						<thead >
							<tr>
								<th>Documento</th>
								<th>Perteneciente</th>
								<th>Oficina</th>
								<!-- <th>Estado</th> -->
								<th>Estado V.</th>
								<th>Fecha V.</th>
								<th>Fecha C.</th>
								<th>Acción</th>
								<th>Visualización</th>
							</tr>
						</thead>
						<tbody id='tbodyDocs' >

						</tbody>
					</table>
				</div>

			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix no-border">
				<!-- <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button> -->
			</div>
		</div>
		<!-- /.box -->

		<div id="box_camion" class="box box-solid">
			<div class="box-header  bg-primary" >
				<i class="fa fa-truck" style="color: white;"></i>
				<h3 class="box-title" style="color: white;">Documentos Camión</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn bg-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn bg-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label>Busqueda</label>
							<div class="input-group">
								<input id='search_camion' type="text" class="form-control" placeholder="Buscar por palabra clave...">
								<span class="input-group-addon"><i class="fa fa-search"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table id='tabla_camion' class="table table-responsive table-bordered">
						<thead >
							<tr>
								<th>Documento</th>
								<th>Perteneciente</th>
								<th>Oficina</th>
								<!-- <th>Estado</th> -->
								<th>Estado V.</th>
								<th>Fecha V.</th>
								<th>Fecha C.</th>
								<th>Acción</th>
								<th>Visualización</th>
							</tr>
						</thead>
						<tbody id='tbodyDocs' >

						</tbody>
					</table>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix no-border">
				<!-- <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button> -->
			</div>
		</div>
		<!-- /.box -->

		<div id="box_rampa" class="box box-solid">
			<div class="box-header  bg-primary" >
				<i class="glyphicon glyphicon-road" style="color: white;"></i>
				<h3 class="box-title" style="color: white;">Documentos Ramplas</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn bg-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn bg-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label>Busqueda</label>
							<div class="input-group">
								<input id='search_rampa' type="text" class="form-control" placeholder="Buscar por palabra clave...">
								<span class="input-group-addon"><i class="fa fa-search"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table id='tabla_rampa' class="table table-responsive table-bordered">
						<thead >
							<tr>
								<th>Documento</th>
								<th>Perteneciente</th>
								<th>Oficina</th>
								<!-- <th>Estado</th> -->
								<th>Estado V.</th>
								<th>Fecha V.</th>
								<th>Fecha C.</th>
								<th>Acción</th>
								<th>Visualización</th>
							</tr>
						</thead>
						<tbody id='tbodyDocs' >

						</tbody>
					</table>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix no-border">
				<!-- <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button> -->
			</div>
		</div>
		<!-- /.box -->

		<div id="box_chofer" class="box box-solid">
			<div class="box-header  bg-primary" >
				<i class="fa fa-users" style="color: white;"></i>
				<h3 class="box-title" style="color: white;">Documentos Chofer</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn bg-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn bg-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label>Busqueda</label>
							<div class="input-group">
								<input id='search_chofer' type="text" class="form-control" placeholder="Buscar por palabra clave...">
								<span class="input-group-addon"><i class="fa fa-search"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table id='tabla_chofer' class="table table-responsive table-bordered">
						<thead >
							<tr>
								<th>Documento</th>
								<th>Perteneciente</th>
								<th>Oficina</th>
								<!-- <th>Estado</th> -->
								<th>Estado V.</th>
								<th>Fecha V.</th>
								<th>Fecha C.</th>
								<th>Acción</th>
								<th>Visualización</th>
							</tr>
						</thead>
						<tbody id='tbodyDocs' >

						</tbody>
					</table>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix no-border">
				<!-- <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button> -->
			</div>
		</div>
		<!-- /.box -->

		<div id="box_ayudante" class="box box-solid">
			<div class="box-header  bg-primary" >
				<i class="fa fa-user-plus" style="color: white;"></i>
				<h3 class="box-title" style="color: white;">Documentos Ayudantes</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn bg-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn bg-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label>Busqueda</label>
							<div class="input-group">
								<input id='search_ayudante' type="text" class="form-control" placeholder="Buscar por palabra clave...">
								<span class="input-group-addon"><i class="fa fa-search"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table id='tabla_ayudantes' class="table table-responsive table-bordered">
						<thead >
							<tr>
								<th>Documento</th>
								<th>Perteneciente</th>
								<th>Oficina</th>
								<!-- <th>Estado</th> -->
								<th>Estado V.</th>
								<th>Fecha V.</th>
								<th>Fecha C.</th>
								<th>Acción</th>
								<th>Visualización</th>
							</tr>
						</thead>
						<tbody id='tbodyDocs' >

						</tbody>
					</table>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix no-border">
				<!-- <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button> -->
			</div>
		</div>
		<!-- /.box -->


	</section>
</div>



<div class="modal fade " id="modal_confirmacion" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-green">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
					<h4 class="modal-title">Aprobación de documento</h4>
				</div>
				<div class="modal-body">
					<form id="form_aprobacion" method="POST">
						<div class="col-sm-3">
							<div class="form-group">
								<label>N° Documento</label>
								<input id="docid_aprob" type="text" name="docid_aprob" class="form-control" readonly="true">
							</div>						
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label>Oficina</label>
								<input id="oficina_aprob" type="text" name="oficina_aprob" class="form-control" readonly="true">
							</div>						
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label>Estado vigencia</label>
								<input id="estado" type="text" name="estado" class="form-control" readonly="true">
							</div>						
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label>Fecha Vigencia</label>
								<input id="fecha_vigencia" type="text" name="fecha_vigencia" class="form-control" readonly="true">
							</div>						
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Perteneciente a:</label>
								<input id="perteneciente" type="text" name="perteneciente" class="form-control" readonly="true">
							</div>						
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Nombre documento</label>
								<input id="nombredoc" type="text" name="nombredoc" class="form-control" readonly="true">
							</div>						
						</div>

						<div class="col-sm-12">
							<h5>Está a punto de aprobar un documento. ¿Esta seguro de aprobar?</h5>
							<iframe id="iframe_aprob" style="width:100%; height:250px" frameborder="0" src=""></iframe>	
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<div class="col-sm-12">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal" >Cancelar</button>
						<button type="button" id="bt_aprobar" class="btn btn-success">Aprobar documento</button>	
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<div class="modal fade " id="modal_rechazo" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-red">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
						<h4 class="modal-title">Rechazo de documento</h4>
					</div>
					<div class="modal-body">
						<form id="from_rechazo" method="POST">
							<div class="col-sm-3">
								<div class="form-group">
									<label>N° Documento</label>
									<input id="docid_rechazo" type="text" name="docid_rechazo" class="form-control" readonly="true">
								</div>						
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>Oficina</label>
									<input id="oficina_rechazo" type="text" name="oficina_rechazo" class="form-control" readonly="true">
								</div>						
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>Estado</label>
									<input id="estado_rechazo" type="text" name="" class="form-control" readonly="true">
								</div>						
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>Fecha Vigencia</label>
									<input id="fecha_vigencia_rechazo" type="text" name="" class="form-control" readonly="true">
								</div>						
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>Perteneciente a:</label>
									<input id="perteneciente_rechazo" type="text" name="" class="form-control" readonly="true">
								</div>						
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Nombre documento</label>
									<input id="nombredoc_rechazo" type="text" name="" class="form-control" readonly="true">
								</div>						
							</div>

							<div class="col-sm-12">
								<iframe id="iframe_rechazo" style="width:100%; height:250px" frameborder="0" src=""></iframe>	
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label for="">Motivo de rechazo</label>
									<select id="motivo_rechazo" class="form-control select2" style="width:100%"></select>	
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label>Observación</label>
									<textarea id="obs_rechazo" rows="4" cols="50" class="form-control" maxlength="350" placeholder="Caracteres maximo 350"></textarea>
								</div>
							</div>
							<div class="col-sm-12">
								<h5><b>Está a punto de rechazar un documento. ¿Esta seguro de continuar?</b></h5>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<div class="container-fluid">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal" >Cancelar</button>
							<button type="button" id="bt_rechazar" class="btn btn-danger">Rechazar Documento</button>	
						</div>
					</div>
				</div>
			</div>
		</div>


		<script type="text/javascript">
			$(document).ajaxStart(function() {
				pf_blockUI();
			}).ajaxStop(function() {
				pf_unblockUI();
			});	
		</script>

		<script type="text/javascript">
			var afectado;
			$(function(){

				$('.select2').select2();
				$('body').addClass('sidebar-collapse');

				var usuid = <?php echo $user[0]['USUID'] ?>;
				$(".connectedSortable").sortable();

				$('body').on('click','.btn-aprobar',function(){
					var docid      		= $(this).data('docid');
					afectado   		 	= $(this).data('afectado');
					var url      		= $(this).data('url');
					var perteneciente 	= $(this).data('perteneciente');
					var nombredoc 		= $(this).data('nombredoc');
					var oficina 		= $(this).data('oficina');
					var estado 			= $(this).data('estado');
					var fecha_vigencia  = $(this).data('fechavigencia');
					$('#docid_aprob').val(docid);
					$('#oficina_aprob').val(oficina);
					$('#perteneciente').val(perteneciente);
					$('#nombredoc').val(nombredoc);
					$('#estado').val(estado);
					$('#fecha_vigencia').val(fecha_vigencia);
					$('#iframe_aprob').attr('src',url);

					$('#modal_confirmacion').modal('show');
				});

				$('body').on('click','.bt-rechazar',function(){

					var docid      		= $(this).data('docid');
					afectado   			= $(this).data('afectado');
					var url      		= $(this).data('url');
					var perteneciente 	= $(this).data('perteneciente');
					var nombredoc 		= $(this).data('nombredoc');
					var oficina 		= $(this).data('oficina');
					var estado 			= $(this).data('estado');
					var fecha_vigencia  = $(this).data('fechavigencia');
					$('#docid_rechazo').val(docid);
					$('#oficina_rechazo').val(oficina);
					$('#perteneciente_rechazo').val(perteneciente);
					$('#nombredoc_rechazo').val(nombredoc);
					$('#estado_rechazo').val(estado);
					$('#fecha_vigencia_rechazo').val(fecha_vigencia);
					$('#iframe_rechazo').attr('src',url);
					cargar_motivos_rechazo();

					$('#modal_rechazo').modal('show');
				});



				$('body').on('click','#bt_aprobar',function(){
					var docid = $('#docid_aprob').val();
					aprobar_documento(afectado, docid);
				})

				$('body').on('click','#bt_rechazar',function(){
					var docid 	= $('#docid_rechazo').val();
					var motivo 	= $('#motivo_rechazo').val();
					var obs  	= $('#obs_rechazo').val();
					rechazar_documento(afectado, docid, motivo, obs );
				})

				
			});

			/*Aprobacion de documento*/
			function aprobar_documento(afectado, cod_documento){
				$.ajax({
					url: "<?php echo site_url('aprobar_documento')?>",
					type: 'POST',
					dataType: 'json',
					data: { afectado: afectado,
						docid   : cod_documento },
					}).done(function(data) {
						if(data.status){
							pf_notify('Correcto','Documento aprobado exitosamente','success');
							$('#modal_confirmacion').modal('hide');
							actualiza_tablas();
							
						}else{
							pf_notify('Error',data.error,'danger');
							
						}
					}).fail(function() {
						console.log("error");
					}).always(function() {
						console.log("complete");
					});
				}

				/*Rechazo de documento*/
				function rechazar_documento(afectado, cod_documento, motivo, obs){
					$.ajax({
						url: "<?php echo site_url('rechazar_documento')?>",
						type: 'POST',
						dataType: 'json',
						data: { afectado 	: afectado,
							docid   	: cod_documento,
							motivo  	: motivo,
							observacion : obs
						},
					}).done(function(data) {
						if(data.status){
							pf_notify('Correcto','Documento rechazado exitosamente','success');
							$('#modal_rechazo').modal('hide');
							actualiza_tablas();
							$('#obs_rechazo').val("");
						}else{
							pf_notify('Error',data.error,'danger');
							$('#obs_rechazo').val("");

						}
					}).fail(function() {
						console.log("error");
					}).always(function() {
						console.log("complete");
					});
				}

				function actualiza_tablas(){
					switch (afectado) {
						case 'T':
						t_transportista.ajax.reload();
						break;
						case 'C':
						t_camion.ajax.reload();
						break;
						case 'CH':
						t_chofer.ajax.reload();
						break;
						case 'A':
						t_ayudantes.ajax.reload();
						break;
						case 'R':
						t_rampla.ajax.reload();
						break;
						default:

						break;
					}
				}

				function cargar_motivos_rechazo(){
					$.ajax({
						url: '<?php print site_url("get_motivos_rechazo")?>',
						type: 'POST',
						dataType: 'json'
					})
					.done(function(data) {
						$('#motivo_rechazo').empty();
						$('#motivo_rechazo').append('<option selected disabled >Seleccionar Motivo</option>');
						$.each(data.motivos_rechazo , function(index, val) {
							$('#motivo_rechazo').append('<option value="'+val.CODIGO+'">'+val.NOMBRE+'</option>');
						});
					}).fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});

				}
				/*rechazar_documento*/
			</script>


			<script type="text/javascript">
				var t_transportista;
				$(function(){

					$('#tabla_transportista tbody').on('click', '.documento', function () {
						var tr = $(this).closest('tr');
						var row = t_transportista.row( tr );
						if ( row.child.isShown() ) {
							row.child.hide();
							tr.removeClass('shown');
							$(this).removeClass('btn-danger').addClass('btn btn-primary');
						}
						else {
							row.child( format(row.data()) ).show();
							tr.addClass('shown');
							$(this).removeClass('btn-primary').addClass('btn btn-danger');
						}
					});

					function format ( d ) {

						var fila= '<table cellpadding="8" cellspacing="0" border="0" style="padding-left:50px;">'
						fila+='<tr>';
						fila+='<td><iframe style="width:1080px; height:600px;" frameborder="0" src="'+d[d.length-1]+'"></iframe></td></tr></table>';
						return fila;
					}

					t_transportista = $('#tabla_transportista').DataTable({
						"ajax": {
							"url": "<?php echo site_url() ;?>/get_documentos_transp_usuario",
							'type': 'POST',
							"dataSrc":"",
							"data": function ( d ) {
								d.oficina = $('#oficina').val();
								d.tipodoc = $('#tipodoc').val();
							}
						},
						// "order": [[ 5, "desc" ]],
						"paging"     : true,
						"ordering"   : true,
						"aaSorting"  : [],
						"info"       : true,
						"autoWidth"  : false,
						"iDisplayLength": 7, 
						"processing " : true,
						"columnDefs" : [
						{className   : "text-center"  , "targets": [3,4,5,6,7]	},
						{ "width": "20%"  , "targets": 0 },
						{ "width": "30%"  , "targets": 1 },
						{ "width": "10%"  , "targets": 2 },
						{ "width": "10%"  , "targets": 3 },
						{ "width": "10%"  , "targets": 4 },
						{ "width": "10%"  , "targets": 5 },
						{ "width": "10%"  , "targets": 6 },
						], 
						"drawCallback" : function(settings){
							var api 	= this.api();
							var count = api.rows().data().lengt;

							if (api.rows().data().length  >= 1 ) {
								$('#box_transp').removeClass('hide')
							}else{
								$('#box_transp').addClass('hide')
							}
						},
						"createdRow": function ( row, data, index ) {
							var doc = data[7];
							switch (data[3]) {
								case "Proximo a vencer":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-warning center-block lead'>"+data[3]+"</span>");

								break;
								case "Vigente":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-success center-block lead'>"+data[3]+"</span>");
								break;
								case "Historico":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-info center-block lead'>"+data[3]+"</span>");

								break;
								default:
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-success center-block lead'>"+data[3]+"</span>");

								break;
								break;
							}
							$('td',row).eq(7).empty();
							$('td',row).eq(7).append('<button type="button" class="btn btn-primary documento" value="'+doc+'"><i class="fa fa-level-down"></i></button>');


							$('td',row).eq(6).empty();
							$('td',row).eq(6).append('<button data-docid="'+data[6].DOCID+'" data-oficina="'+data[6].OFICINA+'" data-estado="'+data[6].ESTADO+'" data-nombredoc="'+data[6].NOMBREDOC+'" data-afectado="T" data-url="'+data[6].URL+'" data-perteneciente="'+data[6].PERTENECIENTE+'" data-fechavigencia="'+data[6].FECHA_VIGENCIA+'" class="btn btn-sm btn-success btn-aprobar"><i class="fa fa-thumbs-up"></i></button> ');

							$('td',row).eq(6).append('<button data-docid="'+data[6].DOCID+'" data-oficina="'+data[6].OFICINA+'" data-estado="'+data[6].ESTADO+'" data-nombredoc="'+data[6].NOMBREDOC+'" data-afectado="T" data-url="'+data[6].URL+'" data-perteneciente="'+data[6].PERTENECIENTE+'" data-fechavigencia="'+data[6].FECHA_VIGENCIA+'" class="btn btn-sm btn-danger bt-rechazar"><i class="fa fa-thumbs-down"></i></button> ');

						},
						"language": {
							"lengthMenu": "Mostrar _MENU_ registros por página",
							"zeroRecords": "Busqueda no encontrada",
							"info": "Página _PAGE_ de _PAGES_",
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
						jQuery("#tabla_transportista_length").addClass('hidden');
						jQuery("#tabla_transportista_filter").addClass('hidden');
						jQuery("#tabla_transportista_info").addClass('hidden');
						jQuery("#footer-left").text(jQuery("#tabla_transportista_info").text());
						jQuery("#tabla_transportista_paginate").appendTo(jQuery("#footer-right"));
					});


					$('#show_record').change(function() {
						t_transportista.page.len($('#show_record').val()).draw();
						jQuery("#footer-left").text(jQuery("#tablaInformeVigencia_info").text());
					});

					$('#tipodoc').change(function(event) {
						t_transportista.ajax.reload();
					});

					$('#oficina').change(function(event) {
						t_transportista.ajax.reload();
					});


					$('#search_transportista').keyup(function(){
						var buscar = $(this).val();
						t_transportista.search(buscar).draw() ;
					});

				});


			</script>




			<script type="text/javascript">
				var t_camion;
				$(function(){

					$('#tabla_camion tbody').on('click', '.documento', function () {
						var tr = $(this).closest('tr');
						var row = t_camion.row( tr );
						if ( row.child.isShown() ) {
							row.child.hide();
							tr.removeClass('shown');
							$(this).removeClass('btn-danger').addClass('btn btn-primary');
						}
						else {
							row.child( format(row.data()) ).show();
							tr.addClass('shown');
							$(this).removeClass('btn-primary').addClass('btn btn-danger');
						}
					});

					function format ( d ) {

						var fila= '<table cellpadding="8" cellspacing="0" border="0" style="padding-left:50px;">'
						fila+='<tr>';
						fila+='<td><iframe style="width:1080px; height:600px;" frameborder="0" src="'+d[d.length-1]+'"></iframe></td></tr></table>';
						return fila;
					}

					t_camion = $('#tabla_camion').DataTable({
						"ajax": {
							"url": "<?php echo site_url() ;?>/get_documentos_camion_usuario",
							'type': 'POST',
							"dataSrc":"",
							"data": function ( d ) {
								d.oficina = $('#oficina').val();
								d.tipodoc = $('#tipodoc').val();
							}
						},
						"paging"     : true,
						"ordering"   : true,
						"info"       : true,
						"aaSorting"  : [],
						"autoWidth"  : false,
						"iDisplayLength": 7, 
						"processing " : true,
						"columnDefs" : [
						{ targets    : 'no-sort'     , orderable: false },
						{ className  : "dt-nowrap"   , "targets": [0,1]	},
						{className   : "text-center"  , "targets": [3,4,5,6,7]	},
						{ "width": "20%"  , "targets": 0 },
						{ "width": "30%"  , "targets": 1 },
						{ "width": "10%"  , "targets": 2 },
						{ "width": "10%"  , "targets": 3 },
						{ "width": "10%"  , "targets": 4 },
						{ "width": "10%"  , "targets": 5 },
						{ "width": "10%"  , "targets": 6 },
						{ targets: 'no-sort', orderable: false }
						], 
						"drawCallback" : function(settings){
							var api 	= this.api();
							var count = api.rows().data().lengt;

							if (api.rows().data().length  >= 1 ) {
								$('#box_camion').removeClass('hide')
							}else{
								$('#box_camion').addClass('hide')
							}
						},
						"createdRow": function ( row, data, index ) {
							
							var doc = data[7];
							switch (data[3]) {
								case "Proximo a vencer":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-warning center-block lead'>"+data[3]+"</span>");

								break;
								case "Vigente":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-success center-block lead'>"+data[3]+"</span>");
								break;
								case "Historico":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-info center-block lead'>"+data[3]+"</span>");

								break;
								default:
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-success center-block lead'>"+data[3]+"</span>");

								break;
								break;
							}
							$('td',row).eq(7).empty();
							$('td',row).eq(7).append('<button type="button" class="btn btn-primary documento" value="'+doc+'"><i class="fa fa-level-down"></i></button>');


							$('td',row).eq(6).empty();
							$('td',row).eq(6).append('<button data-docid="'+data[6].DOCID+'" data-oficina="'+data[6].OFICINA+'" data-estado="'+data[6].ESTADO+'" data-nombredoc="'+data[6].NOMBREDOC+'" data-afectado="C" data-url="'+data[6].URL+'" data-perteneciente="'+data[6].PERTENECIENTE+'" data-fechavigencia="'+data[6].FECHA_VIGENCIA+'" class="btn btn-sm btn-success btn-aprobar"><i class="fa fa-thumbs-up"></i></button> ');

							$('td',row).eq(6).append('<button data-docid="'+data[6].DOCID+'" data-oficina="'+data[6].OFICINA+'" data-estado="'+data[6].ESTADO+'" data-nombredoc="'+data[6].NOMBREDOC+'" data-afectado="C" data-url="'+data[6].URL+'" data-perteneciente="'+data[6].PERTENECIENTE+'" data-fechavigencia="'+data[6].FECHA_VIGENCIA+'" class="btn btn-sm btn-danger bt-rechazar"><i class="fa fa-thumbs-down"></i></button> ');

						},
						"language": {
							"lengthMenu": "Mostrar _MENU_ registros por página",
							"zeroRecords": "Busqueda no encontrada",
							"info": "Página _PAGE_ de _PAGES_",
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
						jQuery("#tabla_camion_length").addClass('hidden');
						jQuery("#tabla_camion_filter").addClass('hidden');
						jQuery("#tabla_camion_info").addClass('hidden');
						jQuery("#footer-left").text(jQuery("#tabla_camion_info").text());
						jQuery("#tabla_camion_paginate").appendTo(jQuery("#footer-right"));
					});


					$('#show_record').change(function() {
						t_camion.page.len($('#show_record').val()).draw();
						jQuery("#footer-left").text(jQuery("#tablaInformeVigencia_info").text());
					});

					$('#tipodoc').change(function(event) {
						t_camion.ajax.reload();
					});

					$('#oficina').change(function(event) {
						t_camion.ajax.reload();
					});

					$('#search_camion').keyup(function(){
						var buscar = $(this).val();
						t_camion.search(buscar).draw() ;
					});


				});


			</script>


			<script type="text/javascript">
				var t_chofer;
				$(function(){

					$('#tabla_chofer tbody').on('click', '.documento', function () {
						var tr = $(this).closest('tr');
						var row = t_chofer.row( tr );
						if ( row.child.isShown() ) {
							row.child.hide();
							tr.removeClass('shown');
							$(this).removeClass('btn-danger').addClass('btn btn-primary');
						}
						else {
							row.child( format(row.data()) ).show();
							tr.addClass('shown');
							$(this).removeClass('btn-primary').addClass('btn btn-danger');
						}
					});

					function format ( d ) {

						var fila= '<table cellpadding="8" cellspacing="0" border="0" style="padding-left:50px;">'
						fila+='<tr>';
						fila+='<td><iframe style="width:1080px; height:600px;" frameborder="0" src="'+d[d.length-1]+'"></iframe></td></tr></table>';
						return fila;
					}

					t_chofer = $('#tabla_chofer').DataTable({
						"ajax": {
							"url": "<?php echo site_url() ;?>/get_documentos_chofer_usuario",
							'type': 'POST',
							"dataSrc":"",
							"data": function ( d ) {
								d.oficina = $('#oficina').val();
								d.tipodoc = $('#tipodoc').val();
							}
						},
						"paging"     : true,
						"ordering"   : true,
						"info"       : true,
						"aaSorting"  : [],
						"autoWidth"  : false,
						"iDisplayLength": 7, 
						"processing " : true,
						"columnDefs" : [
						{ targets    : 'no-sort'     , orderable: false },
						{ className  : "dt-nowrap"   , "targets": [0,1]	},
						{className   : "text-center"  , "targets": [3,4,5,6,7]	},
						{ "width": "20%"  , "targets": 0 },
						{ "width": "30%"  , "targets": 1 },
						{ "width": "10%"  , "targets": 2 },
						{ "width": "10%"  , "targets": 3 },
						{ "width": "10%"  , "targets": 4 },
						{ "width": "10%"  , "targets": 5 },
						{ "width": "10%"  , "targets": 6 },
						{ targets: 'no-sort', orderable: false }
						], 
						"drawCallback" : function(settings){
							var api 	= this.api();
							var count = api.rows().data().lengt;

							if (api.rows().data().length  >= 1 ) {
								$('#box_chofer').removeClass('hide')
							}else{
								$('#box_chofer').addClass('hide')
							}
						},
						"createdRow": function ( row, data, index ) {
							var doc = data[7];
							switch (data[3]) {
								case "Proximo a vencer":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-warning center-block lead'>"+data[3]+"</span>");

								break;
								case "Vigente":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-success center-block lead'>"+data[3]+"</span>");
								break;
								case "Historico":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-info center-block lead'>"+data[3]+"</span>");

								break;
								default:
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-success center-block lead'>"+data[3]+"</span>");

								break;
								break;
							}
							$('td',row).eq(7).empty();
							$('td',row).eq(7).append('<button type="button" class="btn btn-primary documento" value="'+doc+'"><i class="fa fa-level-down"></i></button>');


							$('td',row).eq(6).empty();
							$('td',row).eq(6).append('<button data-docid="'+data[6].DOCID+'" data-oficina="'+data[6].OFICINA+'" data-estado="'+data[6].ESTADO+'" data-nombredoc="'+data[6].NOMBREDOC+'" data-afectado="CH" data-url="'+data[6].URL+'" data-perteneciente="'+data[6].PERTENECIENTE+'" data-fechavigencia="'+data[6].FECHA_VIGENCIA+'" class="btn btn-sm btn-success btn-aprobar"><i class="fa fa-thumbs-up"></i></button> ');

							$('td',row).eq(6).append('<button data-docid="'+data[6].DOCID+'" data-oficina="'+data[6].OFICINA+'" data-estado="'+data[6].ESTADO+'" data-nombredoc="'+data[6].NOMBREDOC+'" data-afectado="CH" data-url="'+data[6].URL+'" data-perteneciente="'+data[6].PERTENECIENTE+'" data-fechavigencia="'+data[6].FECHA_VIGENCIA+'" class="btn btn-sm btn-danger bt-rechazar"><i class="fa fa-thumbs-down"></i></button> ');

						},
						"language": {
							"lengthMenu": "Mostrar _MENU_ registros por página",
							"zeroRecords": "Busqueda no encontrada",
							"info": "Página _PAGE_ de _PAGES_",
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
						jQuery("#tabla_chofer_length").addClass('hidden');
						jQuery("#tabla_chofer_filter").addClass('hidden');
						jQuery("#tabla_chofer_info").addClass('hidden');
						jQuery("#footer-left").text(jQuery("#tabla_chofer_info").text());
						jQuery("#tabla_chofer_paginate").appendTo(jQuery("#footer-right"));
					});


					$('#show_record').change(function() {
						t_chofer.page.len($('#show_record').val()).draw();
						jQuery("#footer-left").text(jQuery("#tablaInformeVigencia_info").text());
					});

					$('#tipodoc').change(function(event) {
						t_chofer.ajax.reload();
					});

					$('#oficina').change(function(event) {
						t_chofer.ajax.reload();
					});

					$('#search_chofer').keyup(function(){
						var buscar = $(this).val();
						t_chofer.search(buscar).draw() ;
					});

				});

			</script>



			<script type="text/javascript">
				var t_ayudantes;
				$(function(){

					$('#tabla_ayudantes tbody').on('click', '.documento', function () {
						var tr = $(this).closest('tr');
						var row = t_ayudantes.row( tr );
						if ( row.child.isShown() ) {
							row.child.hide();
							tr.removeClass('shown');
							$(this).removeClass('btn-danger').addClass('btn btn-primary');
						}
						else {
							row.child( format(row.data()) ).show();
							tr.addClass('shown');
							$(this).removeClass('btn-primary').addClass('btn btn-danger');
						}
					});

					function format ( d ) {

						var fila= '<table cellpadding="8" cellspacing="0" border="0" style="padding-left:50px;">'
						fila+='<tr>';
						fila+='<td><iframe style="width:1080px; height:600px;" frameborder="0" src="'+d[d.length-1]+'"></iframe></td></tr></table>';
						return fila;
					}

					t_ayudantes = $('#tabla_ayudantes').DataTable({
						"ajax": {
							"url": "<?php echo site_url() ;?>/get_documentos_ayudante_usuario",
							'type': 'POST',
							"dataSrc":"",
							"data": function ( d ) {
								d.oficina = $('#oficina').val();
								d.tipodoc = $('#tipodoc').val();
							}
						},
						"drawCallback" : function(settings){
							var api 	= this.api();
							var count = api.rows().data().lengt;

							if (api.rows().data().length  >= 1 ) {
								$('#box_ayudante').removeClass('hide')
							}else{
								$('#box_ayudante').addClass('hide')
							}
						},
						"paging"     : true,
						"ordering"   : true,
						"info"       : true,
						"aaSorting"  : [],
						"autoWidth"  : false,
						"iDisplayLength": 7, 
						"processing " : true,
						"columnDefs" : [
						{ targets    : 'no-sort'     , orderable: false },
						{ className  : "dt-nowrap"   , "targets": [0,1]	},
						{className   : "text-center"  , "targets": [3,4,5,6,7]	},
						{ "width": "20%"  , "targets": 0 },
						{ "width": "30%"  , "targets": 1 },
						{ "width": "10%"  , "targets": 2 },
						{ "width": "10%"  , "targets": 3 },
						{ "width": "10%"  , "targets": 4 },
						{ "width": "10%"  , "targets": 5 },
						{ "width": "10%"  , "targets": 6 },
						{ targets: 'no-sort', orderable: false }
						], 
						"createdRow": function ( row, data, index ) {
							var doc = data[7];
							switch (data[3]) {
								case "Proximo a vencer":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-warning center-block lead'>"+data[3]+"</span>");

								break;
								case "Vigente":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-success center-block lead'>"+data[3]+"</span>");
								break;
								case "Historico":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-info center-block lead'>"+data[3]+"</span>");

								break;
								default:
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-success center-block lead'>"+data[3]+"</span>");

								break;
								break;
							}
							$('td',row).eq(7).empty();
							$('td',row).eq(7).append('<button type="button" class="btn btn-primary documento" value="'+doc+'"><i class="fa fa-level-down"></i></button>');


							$('td',row).eq(6).empty();
							$('td',row).eq(6).append('<button data-docid="'+data[6].DOCID+'" data-oficina="'+data[6].OFICINA+'" data-estado="'+data[6].ESTADO+'" data-nombredoc="'+data[6].NOMBREDOC+'" data-afectado="A" data-url="'+data[6].URL+'" data-perteneciente="'+data[6].PERTENECIENTE+'" data-fechavigencia="'+data[6].FECHA_VIGENCIA+'" class="btn btn-sm btn-success btn-aprobar"><i class="fa fa-thumbs-up"></i></button> ');

							$('td',row).eq(6).append('<button data-docid="'+data[6].DOCID+'" data-oficina="'+data[6].OFICINA+'" data-estado="'+data[6].ESTADO+'" data-nombredoc="'+data[6].NOMBREDOC+'" data-afectado="A" data-url="'+data[6].URL+'" data-perteneciente="'+data[6].PERTENECIENTE+'" data-fechavigencia="'+data[6].FECHA_VIGENCIA+'" class="btn btn-sm btn-danger bt-rechazar"><i class="fa fa-thumbs-down"></i></button> ');

						},
						"language": {
							"lengthMenu": "Mostrar _MENU_ registros por página",
							"zeroRecords": "Busqueda no encontrada",
							"info": "Página _PAGE_ de _PAGES_",
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
						jQuery("#tabla_ayudantes_length").addClass('hidden');
						jQuery("#tabla_ayudantes_filter").addClass('hidden');
						jQuery("#tabla_ayudantes_info").addClass('hidden');
						jQuery("#footer-left").text(jQuery("#tabla_ayudantes_info").text());
						jQuery("#tabla_ayudantes_paginate").appendTo(jQuery("#footer-right"));
					});

					$('#show_record').change(function() {
						t_ayudantes.page.len($('#show_record').val()).draw();
						jQuery("#footer-left").text(jQuery("#tabla_ayudantes_info").text());
					});

					$('#tipodoc').change(function(event) {
						t_ayudantes.ajax.reload();
					});

					$('#oficina').change(function(event) {
						t_ayudantes.ajax.reload();
					});

					$('#search_ayudante').keyup(function(){
						var buscar = $(this).val();
						t_ayudantes.search(buscar).draw() ;
					});

				});

			</script>

			<script type="text/javascript">
				var t_rampla;
				$(function(){

					$('#tabla_rampa tbody').on('click', '.documento', function () {
						var tr = $(this).closest('tr');
						var row = t_rampla.row( tr );
						if ( row.child.isShown() ) {
							row.child.hide();
							tr.removeClass('shown');
							$(this).removeClass('btn-danger').addClass('btn btn-primary');
						}
						else {
							row.child( format(row.data()) ).show();
							tr.addClass('shown');
							$(this).removeClass('btn-primary').addClass('btn btn-danger');
						}
					});

					function format ( d ) {

						var fila= '<table cellpadding="8" cellspacing="0" border="0" style="padding-left:50px;">'
						fila+='<tr>';
						fila+='<td><iframe style="width:1080px; height:600px;" frameborder="0" src="'+d[d.length-1]+'"></iframe></td></tr></table>';
						return fila;
					}

					t_rampla = $('#tabla_rampa').DataTable({
						"ajax": {
							"url": "<?php echo site_url() ;?>/get_documentos_rampla_usuario",
							'type': 'POST',
							"dataSrc":"",
							"data": function ( d ) {
								d.oficina = $('#oficina').val();
								d.tipodoc = $('#tipodoc').val();
							}
						},
						"paging"     : true,
						"ordering"   : true,
						"info"       : true,
						"aaSorting"  : [],
						"autoWidth"  : false,
						"iDisplayLength": 7, 
						"processing " : true,
						"columnDefs" : [
						{ targets    : 'no-sort'     , orderable: false },
						{ className  : "dt-nowrap"   , "targets": [0,1]	},
						{className   : "text-center"  , "targets": [3,4,5,6,7]	},
						{ "width": "20%"  , "targets": 0 },
						{ "width": "30%"  , "targets": 1 },
						{ "width": "10%"  , "targets": 2 },
						{ "width": "10%"  , "targets": 3 },
						{ "width": "10%"  , "targets": 4 },
						{ "width": "10%"  , "targets": 5 },
						{ "width": "10%"  , "targets": 6 },
						{ targets: 'no-sort', orderable: false }
						], 
						"drawCallback" : function(settings){
							var api 	= this.api();
							var count = api.rows().data().lengt;

							if (api.rows().data().length  >= 1 ) {
								$('#box_rampa').removeClass('hide')
							}else{
								$('#box_rampa').addClass('hide')
							}
						},
						"createdRow": function ( row, data, index ) {
							var doc = data[7];
							switch (data[3]) {
								case "Proximo a vencer":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-warning center-block lead'>"+data[3]+"</span>");

								break;
								case "Vigente":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-success center-block lead'>"+data[3]+"</span>");
								break;
								case "Historico":
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-info center-block lead'>"+data[3]+"</span>");

								break;
								default:
								$('td',row).eq(3).empty();
								$('td',row).eq(3).append("<span class='label label-success center-block lead'>"+data[3]+"</span>");

								break;
								break;
							}
							$('td',row).eq(7).empty();
							$('td',row).eq(7).append('<button type="button" class="btn btn-primary documento" value="'+doc+'"><i class="fa fa-level-down"></i></button>');


							$('td',row).eq(6).empty();
							$('td',row).eq(6).append('<button data-docid="'+data[6].DOCID+'" data-oficina="'+data[6].OFICINA+'" data-estado="'+data[6].ESTADO+'" data-nombredoc="'+data[6].NOMBREDOC+'" data-afectado="R" data-url="'+data[6].URL+'" data-perteneciente="'+data[6].PERTENECIENTE+'" data-fechavigencia="'+data[6].FECHA_VIGENCIA+'" class="btn btn-sm btn-success btn-aprobar"><i class="fa fa-thumbs-up"></i></button> ');

							$('td',row).eq(6).append('<button data-docid="'+data[6].DOCID+'" data-oficina="'+data[6].OFICINA+'" data-estado="'+data[6].ESTADO+'" data-nombredoc="'+data[6].NOMBREDOC+'" data-afectado="R" data-url="'+data[6].URL+'" data-perteneciente="'+data[6].PERTENECIENTE+'" data-fechavigencia="'+data[6].FECHA_VIGENCIA+'" class="btn btn-sm btn-danger bt-rechazar"><i class="fa fa-thumbs-down"></i></button> ');

						},
						"language": {
							"lengthMenu": "Mostrar _MENU_ registros por página",
							"zeroRecords": "Busqueda no encontrada",
							"info": "Página _PAGE_ de _PAGES_",
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
						jQuery("#tabla_rampa_length").addClass('hidden');
						jQuery("#tabla_rampa_filter").addClass('hidden');
						jQuery("#tabla_rampa_info").addClass('hidden');
						jQuery("#footer-left").text(jQuery("#tabla_rampa_info").text());
						jQuery("#tabla_rampa_paginate").appendTo(jQuery("#footer-right"));
					});


					$('#show_record').change(function() {
						t_rampla.page.len($('#show_record').val()).draw();
						jQuery("#footer-left").text(jQuery("#tabla_rampa_info").text());
					});

					$('#tipodoc').change(function(event) {
						t_rampla.ajax.reload();
					});

					$('#oficina').change(function(event) {
						t_rampla.ajax.reload();
					});

					$('#search_rampa').keyup(function(){
						var buscar = $(this).val();
						t_rampla.search(buscar).draw() ;
					});

				});

			</script>
