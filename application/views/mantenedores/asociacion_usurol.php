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
</style>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Asignación de roles<small> usuarios</small></h1>
		<ol class="breadcrumb">
			<li><a ><span class='fa fa-folder'></span>Mantenedores</a></li>
			<li class='active'><a>Asignación de resposabilidad </a></li>
		</ol>

	</section>
	<!-- Main content -->
	<section class="content">
		
		<div class="box">
			<div class="box-header">
				
			</div>
			<div class="box-body">
				<!--Registro de usuarios por area-->
				<div class="col-sm-4 well well-sm">
					<form id="form_rol_usuario">
						<div class="form-group">
							<label data-toggle="tooltip" title="Usuarios con acceso a Sistema Flota">Usuario</label>
							<select class="form-control" id="usuarios" name="usuarios">
								<option value="" selected disabled="true">Seleccionar usuario</option>
							</select>
						</div>

						<div class="form-group">
							<label>Seleccionar rol</label>
							<select name="roles" id='roles' class="form-control select2" required="true" style="width: 100%">
								<option value="" selected disabled="true">Seleccionar rol</option>							
							</select>
						</div>

						<div class="form-group hidden div_oficina">
							<label>seleccionar oficina</label>
							<select id='oficina' name='oficina' class="form-control selectpicker" multiple data-actions-box="true" data-selected-text-format="count" style="width: 100%">
								<?php foreach ($getOficinas as $key): ?>
									<option value="<?php echo $key->CODIGO_OFICINA?>"><?php echo ucwords(mb_strtolower($key->NOMBRE_OFICINA))?></option>
								<?php endforeach ?>
							</select>

						</div>
						
						<div class="form-group hidden div_oficina">
							<label>Tipo de Documento</label>
							<select class="form-control selectpicker show-tick" multiple data-placeholder="Seleccione Tipo de Documento"
							style="width: 100%;" id="id_tipo_doc" name="id_tipo_doc" data-actions-box="true" data-selected-text-format="count"> 
							<?php foreach ($tipo_doc as $key): ?>
								<option data-subtext="<?php echo ucwords(mb_strtolower($key->AFECTADO)) ?>" value="<?php echo $key->ID_TIPO_DOC?>"><?php echo ucwords(mb_strtolower($key->NOMBREDOC))?></option>
							<?php endforeach ?>
						</select>
					</div>

					<button class="btn btn-primary btn-block" type="button" id='bt_guardar'><i class="fa fa-save pull-left"></i>Guardar</button>

				</form>
			</div>
			<!--Tabla de usuarios-->

			<div class="col-sm-8">
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label>Mostrar</label>
							<select id="show_record" class="form-control">
								<option value="10">10 registros</option>
								<option value="25">25 registros</option>
								<option value="50">50 registros</option>
								<option value="100">100 registros</option>
								<option value="-1">Todos los registros</option>
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label>Filtrar por</label>
							<select name="roles_filter" id='roles_filter' class="form-control select2" required="true" style="width: 100%">
								<option value="">Todos</option>
							</select>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="form-group">
							<label>Buscar</label>
							<div class="input-group">
								<input id='search_filter' type="text" class="form-control" placeholder="Ej: S.N.S">
								<span class="input-group-addon"><i class="fa fa-search"></i></span>
							</div>
						</div>
					</div>
				</div>

				<div class="table-responsive">
					<table id='tabla_usurol' class="table table-responsive table-bordered">
						<thead class="bg-navy" >
							<tr>
								<th>Usuid</th>
								<th>Nombre Usuario</th>
								<th>Rut</th>
								<th>Rol Id</th>
								<th>Rol</th>
								<th>Estado</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody id='tbodyDocs' >

						</tbody>
					</table>
				</div>
			</div>

			<div class="box-footer">

			</div>
		</div>

	</section>
	<!-- /.content -->
</div>



<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edición de usuario-rol</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="formEdit" method="POST">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Id Usuario</label>
								<input type="text" class="form-control" id='idusuario_edit' name='idusuario_edit' required="true" readonly="true">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Nombre usuario</label>
								<input type="text" class="form-control" id="usunom_edit" name='usunom_edit' required="true" readonly="true">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">								
								<label>Id rol</label>
								<input type="text" class="form-control" id="rolid_edit" name='rolid_edit' required="true" readonly="true">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">								
								<label>Nombre Rol</label>
								<input type="text" class="form-control" id="rolname_edit" name='rolname_edit' required="true" readonly="true">
							</div>
						</div>
						<div class="col-sm-6 div_oficina">
							<div class="form-group">
								<label for="">Tipos de documentos</label>
								<select id='tipodoc_edit' name='tipodoc_edit' class="form-control selectpicker" multiple data-actions-box="true" data-selected-text-format="count" style="width: 100%">
								</select>
							</div>
						</div>
						<div class="col-sm-6 div_oficina">
							<div class="form-group">
								<label for="">Oficinas</label>
								<select id='oficina_edit' name='oficina_edit' class="form-control selectpicker" multiple data-actions-box="true" data-selected-text-format="count" style="width: 100%">
								</select>
							</div>
						</div>
						<!--SE AGREGA 02-10-2019-->
						<div class="col-sm-6">
							<div class="form-group">
								<label>Estado usuario</label>
								<div class="input-group" >
									<span class="input-group-addon" >
										<input type='checkbox' class='minimal icheckbox_flat-green' id='activo_edit' value='SI' name='activo_edit'>
									</span>
									<input id="texto_activo_edit" value="Activo" class="form-control" readonly="true" />
								</div>

							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default bg-gray" data-dismiss="modal">Cerrar</button>
				<a type="button" id='btnEdit' class="btn btn-primary bg-navy"><i class="fa pull-left fa-check"></i>Guardar cambios</a>
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
	var arreglo_oficina 	= [];
	var arreglo_documentos  = [];
	$(function(){

		$('[data-toggle="tooltip"]').tooltip();
		$('.select2').select2();

		cargar_select('#usuarios' 	  ,'get_usuario_rol');
		cargar_select('#roles' 	      ,'get_roles');
		cargar_select('#roles_filter' ,'get_roles');
		$('body').on('change','#roles',function(){
			if(this.value == 61 ||  this.value == 62){ 
				$('.div_oficina').removeClass('hidden').addClass('show');
			}else{
				$('.div_oficina').removeClass('show').addClass('hidden');
			}
		});

		$('body').on('click','.bt_editar',function(e){
			e.preventDefault();
			var usuid 	= $(this).data('usuid');
			var usunom 	= $(this).data('usunom');
			var rolid 	= $(this).data('rolid');
			var rolname = $(this).data('rolname');
			var estado  = $(this).data('estado');
			$('#texto_activo_edit').val(estado);
			$('#idusuario_edit').val( usuid );
			$('#usunom_edit').val(usunom);
			$('#rolid_edit').val(rolid);
			$('#rolname_edit').val(rolname);
			$("#activo_edit").prop( "checked", (estado == 'ACTIVO' ? true : false ) );
			if( rolid == 61 || rolid == 62){
				cargar_select_oficina(usuid,rolid);
				cargar_select_documentos(usuid,rolid);
				$('.div_oficina').removeClass('hidden').addClass('show');
			}else{
				$('.div_oficina').removeClass('show').addClass('hidden');
			}
			$('#modal_edit').modal('show');
		})

		$.post("<?php echo site_url('get_oficinas')?>", {'':''} , function(data) {
			arreglo_oficina = data.getOficinas;
		},'json');

		$.post("<?php echo site_url('get_tipo_documentos')?>", {'':''} , function(data) {
			arreglo_documentos = data.tipo_doc;
		},'json');

	});

	function cargar_select(id_elemento, url){
		$(id_elemento).select2({
			'ajax': {
				url: "<?php echo site_url('"+url+"')?>",
				type: "POST",
				dataType: 'json',
				data: function(params) {
					return {
						autocompletar: params.term
					};
				},
				processResults: function(data) {
					return {
						results: $.map(data, function (item) {
							return {
								text : item.nombre,
								id   : item.id
							}
						})
					};
				}
			},'width' 			   : '100%',
			'language' 		   : 'es',
			'minimumInputLength' : 0
		});

	}

</script>

<script type="text/javascript">
	var t;
	
	$(function(){

		/*agregar rol y asociación*/
		$('body').on('click','#bt_guardar',function(e){
			e.preventDefault();
			$('#bt_guardar').prop('disabled', true);
			var formulario 		 = new FormData(document.getElementById("form_rol_usuario"));
			var selectOficinas   = $('#oficina').val();
			var select_documentos   = $('#id_tipo_doc').val();
			formulario.append('oficinas',selectOficinas);
			formulario.append('id_tipo_doc',select_documentos);
			$.ajax({
				url: '<?php print site_url()?>/add_usu_rol',
				type: 'POST',
				dataType: 'json',
				data: formulario,
				processData: false,
				contentType: false,
				cache: false,
				async: false
			}).done(function(data) {
				if(data.status){
					pf_notify('Correcto','Rol asociado correctamente','success');						
					$('#form_rol_usuario')[0].reset();
					$('#bt_guardar').prop('disabled', false);
					t.ajax.reload();
				}else{
					pf_notify('Error', data.error, 'danger');
					$('#bt_guardar').prop('disabled', false);
				}
			})
		});

		/*update de rol asociacion*/
		$('body').on('click','#btnEdit',function(e){
			e.preventDefault();
			$('#btnEdit').prop('disabled', true);
			var formulario 		 = new FormData(document.getElementById("formEdit"));
			var selectOficinas   = $('#oficina_edit').val();
			var select_documentos   = $('#tipodoc_edit').val();
			formulario.append('oficina_edit',selectOficinas);
			formulario.append('id_tipo_doc_edit',select_documentos);
			$.ajax({
				url: '<?php print site_url()?>/upd_rol_usuario',
				type: 'POST',
				dataType: 'json',
				data: formulario,
				processData: false,
				contentType: false,
				cache: false,
				async: false
			}).done(function(data) {
				if(data.status){
					pf_notify('Correcto','Rol Modificado correctamente','success');						
					$('#form_rol_usuario')[0].reset();
					$('#btnEdit').prop('disabled', false);
					t.ajax.reload();
					$('#modal_edit').modal('hide');
				}else{
					pf_notify('Error', data.error, 'danger');
					$('#btnEdit').prop('disabled', false);
				}
			})
		});


		t = $('#tabla_usurol').DataTable({
			"ajax": {
				"url": "<?php echo site_url() ;?>/tabla_usurol/get_usuarios",
				'type': 'POST',
				"dataSrc":"",
				"data": function ( d ) {
					d.search_filter = $('#search_filter').val();
				}
			},
			"paging"     : true,
			"ordering"   : true,
			"info"       : true,
			"autoWidth"  : false,
			"iDisplayLength": 10, 
			"processing " : true,
			"columnDefs" : [
			{ targets    : "no-sort"     	, orderable: false  },
			{ className  : "dt-nowrap"   	, "targets": [0,1]	},
			{ className  : "text-center"  	, "targets": [0,1,5,6]},
			{ "width": "10%"  , "targets": 0 },
			{ "width": "20%"  , "targets": 1 },
			{ "width": "10%"  , "targets": 2 },
			{ "width": "10%"  , "targets": 3 },
			{ "width": "30%"  , "targets": 4 },
			{ "width": "10%"  , "targets": 5 },
			{ "width": "10%"  , "targets": 6 },
			{ targets: 'no-sort', orderable: false }
			], 
			"createdRow": function ( row, data, index ) {

				var estado = ( data[6].ESTADO == 'ACTIVO' ? 'label-success' : 'label-danger');
				$('td',row).eq(5).empty();
				$('td',row).eq(5).append("<strong><span class='label center-block "+estado+"'>"+data[6].ESTADO+"</span>");

				$('td',row).eq(6).empty();
				$('td',row).eq(6).append('<button type="button" class="bt_editar btn btn-sm bg-teal" data-usuid="'+data[6].USUID+'" data-usunom="'+data[6].USUNOM+'" data-rolid="'+data[6].ROLID+'" data-rolname="'+data[6].NOMBRE_ROL+'" data-estado="'+data[6].ESTADO+'" ><i class="fa fa-edit"></i></button>');
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
			jQuery("#tabla_usurol_length").addClass('hidden');
			jQuery("#tabla_usurol_filter").addClass('hidden');
			jQuery("#tabla_usurol_info").addClass('hidden');
			jQuery("#footer-left").text(jQuery("#tabla_usurol_info").text());
			jQuery("#tabla_usurol_paginate").appendTo(jQuery("#footer-right"));
		});

		$('#search_filter').keyup(function(){
			t.ajax.reload();
		});

		$('#show_record').change(function() {
			t.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tabla_usurol_info").text());
		});

		$('#search_filter').change(function(event) {
			t.ajax.reload();
		});

		$('#roles_filter').change(function(event){
			var buscar = $(this).val();
			t.column(3).search(buscar).draw();
		});

		$('body').on('click','#activo_edit',function(){
			var estado = ($(this).is(':checked') ? 'Activo': 'Deshabilitado');
			$('#texto_activo_edit').val(estado);
		})
	})

/*funcción para cargar select de oficinas por usuario  get_ofi_doc*/
function cargar_select_oficina(usuid, rolid){
	$('#oficina_edit').empty();
	$.post("<?php echo site_url('get_ofi_usu')?>", {usuid : usuid,rolid : rolid} , function(data) {
		$.each(arreglo_oficina, function(index, val) {
			var validador = false;
			$.each( data.oficinas_usuario , function(index, el) {
				if(val.CODIGO_OFICINA == el.ID_OFICINA){
					validador = true;
				}
			});
			if (validador) {
				$('#oficina_edit').append('<option selected value="'+val.CODIGO_OFICINA+'" >'+val.NOMBRE_OFICINA+'</option>');
			}else{
				$('#oficina_edit').append('<option value="'+val.CODIGO_OFICINA+'" >'+val.NOMBRE_OFICINA+'</option>');
			}
		});
		$('.selectpicker').selectpicker('refresh');
	},'json');
}

/*funcción para cargar select de oficinas por usuario  get_ofi_doc*/
function cargar_select_documentos(usuid,rolid){
	$('#tipodoc_edit').empty();
	$.post("<?php echo site_url('get_ofi_usu')?>", {usuid : usuid, rolid : rolid} , function(data) {
		console.log(data);
		$.each(arreglo_documentos, function(index, val) {
			var validador = false;
			$.each( data.oficinas_usuario , function(index, el) {
				if(val.ID_TIPO_DOC == el.ID_TIPO_DOC){
					validador = true;
				}
			});
			if (validador) {
				$('#tipodoc_edit').append('<option selected data-subtext="'+val.AFECTADO+'" value="'+val.ID_TIPO_DOC+'" >'+val.NOMBREDOC+'</option>');
			}else{
				$('#tipodoc_edit').append('<option data-subtext="'+val.AFECTADO+'" value="'+val.ID_TIPO_DOC+'" >'+val.NOMBREDOC+'</option>');
			}
		});
		$('.selectpicker').selectpicker('refresh');
	},'json');
}



</script>