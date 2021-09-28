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
		<h1>Mis aprobaciones<small> Sistema Documentación Flota</small></h1>
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
				<h3 class="box-title">Documentación</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="col-sm-3">
					<div class="form-group div_oficina">
						<label>Buscar por oficina</label>
						<select id='oficina' name='oficina' class="form-control selectpicker" multiple data-actions-box="true" data-selected-text-format="count" style="width: 100%">
							<?php foreach ($oficinas_usuario as $key): ?>
								<option selected value="<?php echo $key->ID_OFICINA?>"><?php echo ucwords(mb_strtolower($key->OFICINA))?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="col-sm-3">
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
			<div class="col-sm-3">
				<div class="form-group div_oficina">
					<label>Estado Aprobación</label>
					<select class="form-control selectpicker show-tick" multiple data-placeholder="Seleccione Tipo de Documento"
					style="width: 100%;" id="estado_aprobacion" name="estado_aprobacion" data-actions-box="true" data-selected-text-format="count"> 
					<option selected value="APROBADO" >Aprobado</option>
					<option selected value="RECHAZADO">Rechazado</option>
				</select>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label>Filtro fecha aprobación</label>

				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="text" class="form-control pull-right" id="fecha_rango">
				</div>
				<!-- /.input group -->
			</div>
		</div>
	</div>

</div>
<!-- /.box -->


<!-- <section class="connectedSortable"> -->

	<div class="box box-solid">
		<div class="box-header bg-primary" >
			<i class="fa fa-file" style="color: white;"></i>
			<h3 class="box-title" style="color: white;">Documentos</h3>

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
						<label>Filtrar por estado vigencia</label>
						<select class="form-control" id="filter_estado">
							<option value="">Ver todos</option>
							<option value="VIGENTE">Vigente</option>
							<option value="PROXIMO A VENCER">Próximo a vencer</option>
							<option value="Historico">Historico</option>
						</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Buscar por</label>
						<div class="input-group">
							<input id='filter_search' type="text" class="form-control" placeholder="patente, rut, nombre, etc">
							<span class="input-group-addon"><i class="fa fa-search"></i></span>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Filtrar por afectado</label>
						<select class="form-control" id="filter_afectado">
							<option value="">Ver todos</option>
							<option value="Transportista">Transportista</option>
							<option value="Chofer">Chofer</option>
							<option value="Ayudante">Ayudante</option>
							<option value="Camion">Camion</option>
							<option value="Rampla">Rampla</option>
						</select>
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
							<th>Afectado</th>
							<th>Estado V.</th>
							<th>F Vig</th>
							<th>F Aprob</th>
							<th>Estado Aprob</th>
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
		</div>
	</div>



</section>
</div>


<div class="modal fade " id="modal_info_aprob" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
					<h4 class="modal-title">Detalle de rechazo documento</h4>
				</div>
				<div class="modal-body">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="">Motivo de rechazo</label>
							<input type="text" id="motivo_view" readonly="true" class="form-control" />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="">Fecha de rechazo</label>
							<input type="text" id="fecha_rechazo" readonly="true" class="form-control" />
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label>Observación</label>
							<textarea id="obsrechazo" readonly="true" rows="4" cols="50" class="form-control" maxlength="350" placeholder="Caracteres maximo 350"></textarea>
						</div>
					</div>
					<div class="col-sm-12">
						<iframe id="iframe_rechazo" style="width:100%; height:250px" frameborder="0" src=""></iframe>	
					</div>
				</div>
				<div class="modal-footer">
					<div class="col-sm-12">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal" >Cerrar</button>
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
	var minDateFilter;
	var maxDateFilter;
	$(function(){

		$('body').addClass('sidebar-collapse');

		$('#fecha_rango').daterangepicker({
			"locale": {
				"format": "DD-MM-YYYY",
				"separator": " - ",
				"applyLabel": "Filtrar",
				"cancelLabel": "Cancel",
				"fromLabel": "From",
				"toLabel": "To",
				"customRangeLabel": "Custom",
				"weekLabel": "W",
				"daysOfWeek": [
				"Do",
				"Lu",
				"Ma",
				"Mi",
				"Ju",
				"Vi",
				"Sa"
				],
				"monthNames": [
				"Enero",
				"Febrero",
				"Marzo",
				"Abril",
				"Mayo",
				"Junio",
				"Julio",
				"Agosto",
				"Septiembre",
				"Octubre",
				"Noviembre",
				"Diciembre"
				],
				"firstDay": 1
			},
			"opens": "center",
		}, function(start, end, label) {
			minDateFilter = start.format('DD-MM-YYYY');
			maxDateFilter = end.format('DD-MM-YYYY');
			t_documentos.ajax.reload();
		});

	})
</script>





<script type="text/javascript">
	var t_documentos;
	$(function(){
		$('[data-toggle="tooltip"]').tooltip();

		$('body').on('click','.bt_desc_rechazo',function(){
				var motivo 			= $(this).data('motivo');
				var obs_rechazo 	= $(this).data('obsrechazo');
				var fecha_rechazo   = $(this).data('fechaaprobacion');
				var url 			= $(this).data('url');
				// iframe_rechazo
				$('#motivo_view').val(motivo);
				$('#obsrechazo').val(obs_rechazo);
				$('#fecha_rechazo').val(fecha_rechazo);
				$('#iframe_rechazo').attr('src',url);
				
				$('#modal_info_aprob').modal('show');
			})


		$('#tabla_transportista tbody').on('click', '.documento', function () {
			var tr = $(this).closest('tr');
			var row = t_documentos.row( tr );
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

		t_documentos = $('#tabla_transportista').DataTable({
			"ajax": {
				"url": "<?php echo site_url() ;?>/get_mis_aprobacion",
				'type': 'POST',
				"dataSrc":"",
				"data": function ( d ) {
					d.oficina = $('#oficina').val();
					d.tipodoc = $('#tipodoc').val();
					d.fecha_desde = minDateFilter;
					d.fecha_hasta = maxDateFilter;
					d.estado_aprobacion = $('#estado_aprobacion').val();
				}
			},
			"paging"     : true,
			"ordering"   : true,
			"info"       : true,
			"autoWidth"  : false,
			"iDisplayLength": 25, 
			dom: 'Bfrtip',
			buttons: [
			'csv', 'excel', 'print'
			],
			"processing " : true,
			"columnDefs" : [
			{ targets    : 'no-sort'     , orderable: false },
			{ className  : "dt-nowrap"   , "targets": [0,1]	},
			{className   : "text-center"  , "targets": [3,4,5,6,7,8]	},
			{ "width": "25%"  , "targets": 0 },
			{ "width": "25%"  , "targets": 1 },
			{ "width": "10%"  , "targets": 2 },
			{ "width": "10%"  , "targets": 3 },
			{ "width": "10%"  , "targets": 4 },
			{ "width": "10%"  , "targets": 5 },
			{ "width": "10%"  , "targets": 6 },
			{ "width": "10%"  , "targets": 7 },
			{ targets: 'no-sort', orderable: false }
			], 
			"createdRow": function ( row, data, index ) {
				var doc = data[6];

				switch (data[4]) {
					case "Proximo a vencer":
						$('td',row).eq(4).empty();
						$('td',row).eq(4).append("<span class='label label-warning center-block lead'>"+data[4]+"</span>");
						
						break;
					case "Vigente":
						$('td',row).eq(4).empty();
						$('td',row).eq(4).append("<span class='label label-success center-block lead'>"+data[4]+"</span>");
						break;
					case "Historico":
						$('td',row).eq(4).empty();
						$('td',row).eq(4).append("<span class='label label-info center-block lead'>"+data[4]+"</span>");
						
						break;
					default:
						$('td',row).eq(4).empty();
						$('td',row).eq(4).append("<span class='label label-success center-block lead'>"+data[4]+"</span>");
						
						break;
						break;
				}
				$('td',row).eq(8).empty();
				$('td',row).eq(8).append('<button type="button" class="btn btn-primary documento" value="'+doc+'"><i class="fa fa-level-down"></i></button>');

				switch (data[7]) {
					case 'APROBADO':
						$('td',row).eq(7).empty();
						$('td',row).eq(7).append("<button class='btn btn-success btn-sm center-block lead'><i class='fa fa-check'></i></button>");
						break;
					case 'RECHAZADO':
						$('td',row).eq(7).empty();
						$('td',row).eq(7).append("<button class='btn btn-danger btn-sm center-block lead bt_desc_rechazo' data-toggle='tooltip' title='Click para detalle' data-url='"+data[8].URL+"'  data-motivo='"+data[8].MOTIVO_RECHAZO+"' data-obsrechazo='"+data[8].OBSERVACION_RECHAZO+"' data-useraprobacion='"+data[8].USUARIO_APROBACION+"' data-fechaaprobacion='"+data[8].FECHA_APROBACION+"'><i class='fa fa-close'></i></button>");
						break;
					default:
						// statements_def
						break;
				}
				$('[data-toggle="tooltip"]').tooltip();

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
			t_documentos.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tablaInformeVigencia_info").text());
		});

		$('#tipodoc').change(function(event) {
			t_documentos.ajax.reload();
		});

		$('#oficina').change(function(event) {
			t_documentos.ajax.reload();
		});

		$('#estado_aprobacion').change(function(event) {
			t_documentos.ajax.reload();
		});

		$('#filter_search').keyup(function(){
			var buscar = $(this).val();
			buscar += " "+$('#filter_afectado').val()+" "+$('#filter_estado').val();
			t_documentos.search(buscar).draw() ;
		});

		$('#filter_estado').change(function(event) {
			var buscar = $(this).val();
			buscar += " "+$('#filter_search').val()+" "+$('#filter_afectado').val();
			t_documentos.search(buscar).draw() ;
		});

		$('#filter_afectado').change(function(event) {
			var buscar = $(this).val();
			buscar += " "+$('#filter_search').val()+" "+$('#filter_estado').val();
			t_documentos.search(buscar).draw() ;
		});

		

	});


</script>
