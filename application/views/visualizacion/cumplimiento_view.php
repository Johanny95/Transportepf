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
		<h1>Oficinas <small> Cumplimiento de documentacion</small></h1>
		<ol class="breadcrumb">
			<li><a ><span class='fa fa-check'></span>Aprocación</a></li>
			<li class='active'><a>Listado de documentos</a></li>
		</ol>

	</section>
	<!-- Main content -->
	<section class="content">
		
		<div class="box box-default">
			<div class="box-header ">
				<i class="fa fa-line-chart"></i>
				<h3 class="box-title">Porcentajes de cumplimiento</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">

				<div class="row">
					
					<div class="container-fluid">
						<div class="col-sm-3 well well-sm">
							
							<div class="form-group div_oficina">
								<label>Buscar por oficina</label>
								<select id='oficina' name='oficina' class="form-control selectpicker" multiple data-actions-box="true" data-selected-text-format="count" style="width: 100%">
									<?php foreach ($oficinas_usuario as $key): ?>
										<option selected value="<?php echo $key->ID_OFICINA?>"><?php echo ucwords(mb_strtolower($key->OFICINA))?></option>
									<?php endforeach ?>
								</select>
							</div>

							<div class="form-group div_oficina">
								<label>Tipo de Documento</label>
								<select class="form-control selectpicker show-tick" multiple data-placeholder="Seleccione Tipo de Documento"
								style="width: 100%;" id="tipoDocumento" name="tipoDocumento" data-actions-box="true" data-selected-text-format="count"> 
								<?php foreach ($documentos_usuario as $key): ?>
									<option selected data-subtext="<?php echo ucwords(mb_strtolower($key->AFECTADO)) ?>" value="<?php echo $key->ID_TIPO_DOC?>"><?php echo ucwords(mb_strtolower($key->NOMBREDOC))?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-primary btn-block" style="margin-top: 24px" id="btn_click">Aplicar Filtro</button>
						</div>
					</div>
					<div class="col-sm-9">
						<div class="col-sm-12">	
							<div class=" table-responsive">
								<table id='tablaOficinas' class="table table-striped table-bordered table-hover" style="width: 100%">
									<thead class="bg-navy">
										<tr>
											<th>Código</th>
											<th>Oficina</th>
											<th>D. Tra</th>
											<th>D. Cam</th>	
											<th>D. Cho</th>	
											<th>D. Ayu</th>	
											<th>Total</th>
											<th>Acción</th>
										</tr>
									</thead>
									<tbody id='tbodyTransportistas'>

									</tbody>
									<tfoot class="bg-navy">
										<tr>
											<th colspan="2">Totales</th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</tfoot>
								</table>

							</div>
						</div>
						<div class="col-sm-12">
							<h3>Cumplimiento ramplas</h3>
							<div class=" table-responsive">
								<table id='tabla_cumplimiento_rampa' class="table table-striped table-bordered table-hover" style="width: 100%">
									<thead class="bg-navy">
										<tr>
											<th>Código</th>
											<th>Oficina</th>
											<th>Cumplimiento</th>
											<th>Acción</th>
										</tr>
									</thead>
									<tbody id='tbody_rampa'>

									</tbody>
									<tfoot class="bg-navy">
										<tr>
											<th colspan="2">Totales</th>
											<th></th>
										</tr>
									</tfoot>
								</table>

							</div>
						</div>
					</div>
				</div>

			</div>

		</div>
		<!-- /.box -->

	</div>
</section>


<script>
	var t;
	$(function(){

		$(document).ajaxStart(function() {
			pf_blockUI();
		}).ajaxStop(function() {
			pf_unblockUI();
		});	

		function pf_dayMonthYears(separador) {
			var tdate = new Date();
			var dd = tdate.getDate();
			var MM = ((tdate.getMonth()+1)>=10)? (tdate.getMonth()+1) : '0' + (tdate.getMonth()+1);;

			var yyyy = tdate.getFullYear(); 
			var currentDate= dd + separador +  MM + separador + yyyy;
			return currentDate;
		}


		function replace_number(num) {
			num = num.replace(/[\%,]/g, '');
			return num;
		}

		$('#datepicker').datepicker({
			autoClose : true,
			language : 'es',
			dateFormat :  'dd/mm/yyyy' 
		});

		$('#datepicker').val(pf_dayMonthYears('/'));

		$('.select2').select2()
		$('[data-toggle="tooltip"]').tooltip(); 

		t = $('#tablaOficinas').DataTable({
			"paging" : true,
			"ordering" : true,
			"info" : true,
			"autoWidth" : true,
			"iDisplayLength": -1,		
			dom: 'Bfrtip',
			buttons: [
			'csv', 'excel', 'print'
			],
			"ajax": {
				"url": "<?php echo site_url('get_cumplimiento_oficinas') ;?>",
				"dataSrc":"",
				"type" : "POST",
				"data" : function ( d ) {
					d.oficina = $('#oficina').val();
					d.tipo_doc = $('#tipoDocumento').val();
					d.fecha = $('#datepicker').val();
				}
			},
			"columns":[
			{data : "codigo_oficina"},
			{data : "nombre_oficina"},
			{data : "promedio"},
			{data : "porccamion"},
			{data : "porcchofer"},
			{data : "porcayudante"},
			{data : "total_oficina" , width : "20%" },
			{data : "button" }
			],
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-right", "targets": [2,3,4,5,6] },
			{ className: "dt-nowrap", "targets": [0,1] }
			],
			"createdRow": function ( row, data, index ) {
				var total = data['total_oficina'];
				if ( total.toString().replace(/[\%,]/g, '') * 1 < 50 ) {
					$('td',row).eq(6).empty();
					$('td',row).eq(6).append("<span class='label label-danger center-block lead'>"+total+"</span>");
				}else if ( total.toString().replace(/[\%,]/g, '') * 1 < 90 ) {
					$('td',row).eq(6).empty();
					$('td',row).eq(6).append("<span class='label label-warning center-block lead'>"+total+"</span>")
				}else if ( total.toString().replace(/[\%,]/g, '') * 1 >=90 ) {
					$('td',row).eq(6).empty(); 
					$('td',row).eq(6).append("<span class='label label-success center-block'>"+total+"</span>")
				}
			},
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api(), data;
				var $i = 0;
				var intVal = function ( i ) {
					return typeof i === 'string' ?
					i.replace(/[\$,]/g, '')*1 :
					typeof i === 'number' ?
					i : 0;
				};
					//PORCENTAJE TOTAL ACTUAL DE TODAS LAS OFICINAS
					total_porciento = api
					.column( 6 , { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						$i ++;
						return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
					}, 0 );
					var calculo = ((parseFloat(total_porciento.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
					$( api.column(6).footer()).html(calculo+"%");

					//PORCENTAJE TOTAL ACTUAL DE TODAS LAS OFICINAS
					$i = 0;
					total_ayudante = api
					.column( 5 , { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						$i ++;
						return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
					}, 0 );
					var calculo_ayu = ((parseFloat(total_ayudante.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
					$( api.column(5).footer()).html(calculo_ayu+"%");


					//PORCENTAJE TOTAL ACTUAL DE TODAS LAS OFICINAS
					$i = 0;
					total_chofer = api
					.column( 4 , { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						$i ++;
						return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
					}, 0 );
					var calculo_cho = ((parseFloat(total_chofer.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
					$( api.column(4).footer()).html(calculo_cho+"%");


					//PORCENTAJE TOTAL ACTUAL DE TODAS LAS OFICINAS
					$i = 0;
					total_camion = api
					.column( 3 , { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						$i ++;
						return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
					}, 0 );
					var calculo_cam = ((parseFloat(total_camion.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
					$( api.column(3).footer()).html(calculo_cam+"%");


					//PORCENTAJE TOTAL ACTUAL DE TODAS LAS OFICINAS
					$i = 0;
					total_trans = api
					.column( 2 , { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						$i ++;
						return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
					}, 0 );
					var calculo_trans = ((parseFloat(total_trans.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
					$( api.column(2).footer()).html(calculo_trans+"%");
				},  
				"paging": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true,
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
	jQuery("#tablaOficinas_length").addClass('hidden');
	jQuery("#tablaOficinas_filter").addClass('hidden');
});

$('#show_record').click(function() {
	t.page.len($('#show_record').val()).draw();
	jQuery("#footer-left").text(jQuery("#tablaOficinas_info").text());
});

});
</script>
<script>
	//get_cumplimiento_rampas
	$('#btn_click').click(function(event) {
		event.preventDefault();
		t.ajax.reload(); 
		tabla_rampas.ajax.reload();
	});
</script>


<script type="text/javascript">
	var tabla_rampas;
	$(function(){


		tabla_rampas = $('#tabla_cumplimiento_rampa').DataTable({
			"paging" : true,
			"ordering" : true,
			"info" : true,
			"autoWidth" : true,
			"iDisplayLength": -1,		
			dom: 'Bfrtip',
			buttons: [
			'csv', 'excel', 'print'
			],
			"ajax": {
				"url": "<?php echo site_url('get_cumplimiento_rampas') ;?>",
				"dataSrc":"",
				"type" : "POST",
				"data" : function ( d ) {
					d.oficina = $('#oficina').val();
					d.tipo_doc = $('#tipoDocumento').val();
				}
			},
			"columns":[
			{data : "codigo_oficina"},
			{data : "nombre_oficina"},
			{data : "promedio"},
			{data : "button" }
			],
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-right", "targets": [2] },
			{ className: "dt-nowrap", "targets": [0,1] }
			],
			"createdRow": function ( row, data, index ) {
				var total = data['promedio'];
				if ( total.toString().replace(/[\%,]/g, '') * 1 < 50 ) {
					$('td',row).eq(2).empty();
					$('td',row).eq(2).append("<span class='label label-danger center-block lead'>"+total+"</span>");
				}else if ( total.toString().replace(/[\%,]/g, '') * 1 < 90 ) {
					$('td',row).eq(2).empty();
					$('td',row).eq(2).append("<span class='label label-warning center-block lead'>"+total+"</span>")
				}else if ( total.toString().replace(/[\%,]/g, '') * 1 >=90 ) {
					$('td',row).eq(2).empty(); 
					$('td',row).eq(2).append("<span class='label label-success center-block'>"+total+"</span>")
				}
			},
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api(), data;
				var $i = 0;
				var intVal = function ( i ) {
					return typeof i === 'string' ?
					i.replace(/[\$,]/g, '')*1 :
					typeof i === 'number' ?
					i : 0;
				};

					//PORCENTAJE TOTAL ACTUAL DE TODAS LAS OFICINAS
					$i = 0;
					total_trans = api
					.column( 2 , { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						$i ++;
						return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
					}, 0 );
					var calculo_trans = ((parseFloat(total_trans.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
					$( api.column(2).footer()).html(calculo_trans+"%");
				},  
				"paging": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true,
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
	jQuery("#tabla_cumplimiento_rampa_length").addClass('hidden');
	jQuery("#tabla_cumplimiento_rampa_filter").addClass('hidden');
});

	})
</script>


