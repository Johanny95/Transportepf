<style type="text/css">
.bootstrap-select > .dropdown-toggle.bs-placeholder, .bootstrap-select > .dropdown-toggle.bs-placeholder:hover, .bootstrap-select > .dropdown-toggle.bs-placeholder:focus, .bootstrap-select > .dropdown-toggle.bs-placeholder:active {
	color: #212121;
}
.text-muted {
	color: black !important ;
}
</style>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1> Informe gestion certificados previsionales <small> Oficinas</small></h1>
		<ol class="breadcrumb">
			<li><a href='<?php echo site_url().'/index' ?>'><span class='fa fa-folder'></span>Informes</a></li>
			<li class='active'><a>Informe gestion certificados previsionales</a></li>
		</ol>
	</section>
	
	<!-- Main content -->
	<section class="content">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Formulario para el  Informe</h3>
				<div class="note pull-right" style="margin-right: 5px;margin-top: 15px">
					<span class="pull-left margin-right-5">
						<small class="label bg-aqua pull-right"> <i class="fa fa-info padding-top-3"></i></small> 
					</span>
					<strong>Nota:</strong> El reporte se visualiza a partir de la fecha actual.
				</div>
			</div>
			<div class="box-body">
				<div class="container-fluid">
					<div class="row">

						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Nivel transportista</a></li>
							<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Nivel tripulación</a></li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<!--Nivel transportista-->
							<div role="tabpanel" class="tab-pane active" id="home">

								<div class="row"><br>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Oficinas</label>
											<select class="form-control selectpicker show-tick" multiple="multiple" data-placeholder="Seleccione Oficina"
											style="width: 100%;" id="id_oficina_transp" name="id_oficina[]" data-live-search="true" data-actions-box="true" data-selected-text-format="count">
											<?php foreach ($getOficinas as $key): ?>
												<?php if ($this->session->usuario[0]['OFICOD'] == 'ALL'): ?>
													<option selected="true" value="<?php echo $key->CODIGO_OFICINA?>"><?php echo ucwords(mb_strtolower($key->NOMBRE_OFICINA))?></option>
													<?php else :?>
														<option selected="true" value="<?php echo $key->CODIGO_OFICINA?>"><?php echo ucwords(mb_strtolower($key->NOMBRE_OFICINA))?></option>
													<?php endif ?>

												<?php endforeach ?>
											</select>
										</div>
										<div class="form-group">
											<label>Buscar por</label>
											<div class="input-group">
												<input id='buscar' type="text" class="form-control" placeholder=".....">
												<span class="input-group-addon"><i class="fa fa-search"></i></span>
											</div>
										</div>
										<div class="form-group">
											<label>Mostrar</label>
											<select id="show_record" class="form-control">	
												<option value="10">10 registros</option>
												<option value="25">25 registros</option>
												<option value="50">50 registros</option>
												<option value="100">100 registros</option>
												<option value="-1" selected>Todos los registros</option>
											</select>
										</div>
										<div class="form-group">
											<button type="button" class="btn btn-primary btn-block" style="margin-top: 24px" id="bt_transp">Aplicar Filtro</button>
										</div>
									</div>

									<div class="col-sm-9">
										<div class="col-sm-12">
											<div class="row table-responsive no-left-right-margin">
												<div class="col-xs-12">
													<table id='tabla_transp' class="display table table-bordered table-hover">
														<thead class="bg-navy">
															<tr>
																<th>Código</th>
																<th>Nombre</th>
																<th>Pagado</th>
																<th>No pagado</th>	
																<th>Total</th>	
																<th>% Pagado</th>	
																<th>% No pagado</th>
															</tr>
														</thead>
														<tbody id='tbodytripulación'>

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
										</div>
									</div>
								</div>


							</div>
							<!--Nivel tripulacion-->
							<div role="tabpanel" class="tab-pane" id="profile">
								<div class="row"><br>
									<div class="col-sm-3">

										<div class="form-group">
											<label>Oficinas</label>
											<select class="form-control selectpicker show-tick" multiple="multiple" data-placeholder="Seleccione Oficina"
											style="width: 100%;" id="id_oficina" name="id_oficina[]" data-live-search="true" data-actions-box="true" data-selected-text-format="count">
											<?php foreach ($getOficinas as $key): ?>
												<?php if ($this->session->usuario[0]['OFICOD'] == 'ALL'): ?>
													<option selected="true" value="<?php echo $key->CODIGO_OFICINA?>"><?php echo ucwords(mb_strtolower($key->NOMBRE_OFICINA))?></option>
													<?php else :?>
														<option selected="true" value="<?php echo $key->CODIGO_OFICINA?>"><?php echo ucwords(mb_strtolower($key->NOMBRE_OFICINA))?></option>
													<?php endif ?>

												<?php endforeach ?>
											</select>
										</div>
										<div class="form-group">
											<label>Buscar por</label>
											<div class="input-group">
												<input id='buscar_trip' type="text" class="form-control" placeholder=".....">
												<span class="input-group-addon"><i class="fa fa-search"></i></span>
											</div>
										</div>
										<div class="form-group">
											<label>Mostrar</label>
											<select id="show_record_trip" class="form-control">	
												<option value="10">10 registros</option>
												<option value="25">25 registros</option>
												<option value="50">50 registros</option>
												<option value="100">100 registros</option>
												<option value="-1" selected>Todos los registros</option>
											</select>
										</div>
										<div class="form-group">
											<button type="button" class="btn btn-primary btn-block" style="margin-top: 24px" id="bt_tripulacion">Aplicar Filtro</button>
										</div>

									</div>
									<div class="col-sm-9">
										<div class="col-sm-12">
											<div class="row table-responsive no-left-right-margin">
												<div class="col-xs-12">
													<table id='tabla_tripulacion' class="display table table-bordered table-hover">
														<thead class="bg-navy">
															<tr>
																<th>Código</th>
																<th>Nombre</th>
																<th>Pagado</th>
																<th>No pagado</th>	
																<th>Total</th>	
																<th>% Pagado</th>	
																<th>% No pagado</th>
															</tr>
														</thead>
														<tbody id='tbodytripulación'>

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
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>



				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</section>
	<!-- /.content -->
</div>


</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript" src="<?php echo base_url(); ?>resources/bootstrap/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/bootstrap/js/FileSaver.js"></script>

<script type="text/javascript">
	$(function(){

		$(document).ajaxStart(function() {
			pf_blockUI();
		}).ajaxStop(function() {
			pf_unblockUI();
		});

	})
</script>

<script type="text/javascript">
	$(function(){
		


		var t = $('#tabla_transp').DataTable({
			"paging": true,
			"searching": true,
			"ordering": true,
			"iDisplayLength": -1, 
			"info": true,
			"autoWidth": false,
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-right", "targets": [2,3,4]},
			{ className: "text-center", "targets": [2]}
			],
			"createdRow": function ( row, data, index ) {
				if ( data[5].replace(/[\%,]/g, '') * 1 < 50 ) {
					$('td',row).eq(5).empty();
					$('td',row).eq(5).append("<span class='label label-danger center-block lead'>"+data[5]+" %</span>");
				}else if ( data[5].replace(/[\%,]/g, '') * 1 < 90 ) {
					$('td',row).eq(5).empty();
					$('td',row).eq(5).append("<span class='label label-warning center-block lead'>"+data[5]+" %</span>")
				}else if ( data[5].replace(/[\%,]/g, '') * 1 >=90 ) {
					$('td',row).eq(5).empty();
					$('td',row).eq(5).append("<span class='label label-success center-block'>"+data[5]+" %</span>")
				} 
				if (data[6].replace(/[\%,]/g, '') * 1 < 10 ) {
					$('td',row).eq(6).empty();
					$('td',row).eq(6).append("<span class='label label-success center-block lead'>"+data[6]+" %</span>");
				} else if (data[6].replace(/[\%,]/g, '') * 1 < 50 ) {
					$('td',row).eq(6).empty();
					$('td',row).eq(6).append("<span class='label label-warning center-block lead'>"+data[6]+" %</span>");
				} else if (data[6].replace(/[\%,]/g, '') * 1 <= 100 ) {
					$('td',row).eq(6).empty();
					$('td',row).eq(6).append("<span class='label label-danger center-block lead'>"+data[6]+" %</span>");
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
				//suma columna pagados previsionales
				pagados = api
				.column( 2 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				var calculo = ((parseFloat(pagados.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				if(calculo<40){
					$('#divTotal').removeClass('bg-green');
					$('#divTotal').addClass('bg-red');
				}else if(calculo<=80){
					$('#divTotal').removeClass('bg-green');
					$('#divTotal').addClass('bg-yellow');
				}
				$( api.column(2).footer()).html(pagados);				
				//suma columna no pagados previsionales
				$i = 0;
				nopagados = api
				.column( 3 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				
				$( api.column(3).footer()).html(nopagados);				
				//Total pagados y no pagados
				$i = 0;
				total = api
				.column( 4 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				$( api.column(4).footer()).html(total);	

				//total pagados en porcentaje
				$i = 0;
				total_porciento = api
				.column( 5 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				var calculo = ((parseFloat(total_porciento.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				$( api.column(5).footer()).html(calculo+"%");							
				//total pagados en porcentaje
				$i = 0;
				total_porciento = api
				.column( 6 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				var calculo = ((parseFloat(total_porciento.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				$( api.column(6).footer()).html(calculo+"%");			

			},  
			"iDisplayLength": -1,		
			dom: 'Bfrtip',
			buttons: [
			'csv', 'excel', 'print'
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
	jQuery("#tabla_transp_length").addClass('hidden');
	jQuery("#tabla_transp_filter").addClass('hidden');
	jQuery("#tabla_transp_info").addClass('hidden');
	jQuery("#footer-left").text(jQuery("#tabla_transp_info").text());
	jQuery("#tabla_transp_paginate").appendTo(jQuery("#footer-right"));
});

$('#buscar').keyup(function(){
	var buscar = $(this).val();
	t.search(buscar).draw() ;
});
$('#show_record').change(function() {
	t.page.len($('#show_record').val()).draw();
	jQuery("#footer-left").text(jQuery("#tabla_transp_info").text());
});


	//informe_transp
	setTimeout(cargarTabla_transp($('#id_oficina_transp').val()) , 10);
	function cargarTabla_transp( oficinas){
		$('#bt_transp').attr({disabled: 'true'});
		var url='<?php print site_url()."/informe_transp"?>';
		t.clear();
		$.post(url, { oficinas : oficinas }, function(data) {
			$.each(data, function (i, obj) {
				var total_doc  		= parseInt(obj.DOCS_TRANSP);
				var tripulacion 	= parseInt(obj.TOTAL_TRANSP);
				var porcpagado		= ((parseInt(total_doc)/parseInt(tripulacion))*100).toFixed();
				var porcnopagado 	= (((parseInt(tripulacion)-parseInt(total_doc))/parseInt(tripulacion))*100).toFixed();
				var no_pagado       = tripulacion-total_doc;

				if (no_pagado < 0) {
					no_pagado = 0;
				}
				if (porcpagado > 100) {
					porcpagado = '100';
				}
				if (porcnopagado > 100) {
					porcnopagado = '100';
				}

				if (total_doc > tripulacion) {
					total_doc = tripulacion;
				}

				if (porcnopagado < '0') {
					porcnopagado = '0';
				}

				t.row.add([obj.ID_OFICINA,
					obj.OFICINA,
					total_doc,
					no_pagado,
					tripulacion,
					porcpagado,
					porcnopagado
					]).draw( true );
				$('[data-toggle="tooltip"]').tooltip();
				total_doc=0;
			})
			$("#bt_transp").removeAttr("disabled");
		},'json').fail(function() {						
		//location.reload();
	});
	}

	$('body').on('click','#bt_transp',function(e){		
		var oficinas 	= $('#id_oficina_transp').val();
		if(oficinas != '' ){
			cargarTabla_transp( oficinas);
		}else{
			pf_notify('Error de filtro','Debe por lo menos seleccionar una oficina y fecha','info');
		}
	})



})
</script>


<!--Script de tripulacion para informe-->
<script type="text/javascript">
	function pf_dayMonthYears(separador) {
		var tdate = new Date();
		var dd = tdate.getDate();
		var MM = ((tdate.getMonth()+1)>=10)? (tdate.getMonth()+1) : '0' + (tdate.getMonth()+1);;

		var yyyy = tdate.getFullYear(); 
		var currentDate= dd + separador +  MM + separador + yyyy;
		return currentDate;
	}

	$(function(){
		

		var t = $('#tabla_tripulacion').DataTable({
			"paging": true,
			"searching": true,
			"ordering": true,
			"iDisplayLength": -1, 
			"info": true,
			"autoWidth": false,
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-right", "targets": [2,3,4]},
			{ className: "text-center", "targets": [2]}
			],
			"createdRow": function ( row, data, index ) {
				if ( data[5].replace(/[\%,]/g, '') * 1 < 50 ) {
					$('td',row).eq(5).empty();
					$('td',row).eq(5).append("<span class='label label-danger center-block lead'>"+data[5]+" %</span>");
				}else if ( data[5].replace(/[\%,]/g, '') * 1 < 90 ) {
					$('td',row).eq(5).empty();
					$('td',row).eq(5).append("<span class='label label-warning center-block lead'>"+data[5]+" %</span>")
				}else if ( data[5].replace(/[\%,]/g, '') * 1 >=90 ) {
					$('td',row).eq(5).empty();
					$('td',row).eq(5).append("<span class='label label-success center-block'>"+data[5]+" %</span>")
				} 
				if (data[6].replace(/[\%,]/g, '') * 1 < 10 ) {
					$('td',row).eq(6).empty();
					$('td',row).eq(6).append("<span class='label label-success center-block lead'>"+data[6]+" %</span>");
				} else if (data[6].replace(/[\%,]/g, '') * 1 < 50 ) {
					$('td',row).eq(6).empty();
					$('td',row).eq(6).append("<span class='label label-warning center-block lead'>"+data[6]+" %</span>");
				} else if (data[6].replace(/[\%,]/g, '') * 1 <= 100 ) {
					$('td',row).eq(6).empty();
					$('td',row).eq(6).append("<span class='label label-danger center-block lead'>"+data[6]+" %</span>");
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
				//suma columna pagados previsionales
				pagados = api
				.column( 2 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				var calculo = ((parseFloat(pagados.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				if(calculo<40){
					$('#divTotal').removeClass('bg-green');
					$('#divTotal').addClass('bg-red');
				}else if(calculo<=80){
					$('#divTotal').removeClass('bg-green');
					$('#divTotal').addClass('bg-yellow');
				}
				$( api.column(2).footer()).html(pagados);				
				//suma columna no pagados previsionales
				$i = 0;
				nopagados = api
				.column( 3 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				
				$( api.column(3).footer()).html(nopagados);				
				//Total pagados y no pagados
				$i = 0;
				total = api
				.column( 4 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				$( api.column(4).footer()).html(total);	

				//total pagados en porcentaje
				$i = 0;
				total_porciento = api
				.column( 5 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				var calculo = ((parseFloat(total_porciento.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				$( api.column(5).footer()).html(calculo+"%");							
				//total pagados en porcentaje
				$i = 0;
				total_porciento = api
				.column( 6 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				var calculo = ((parseFloat(total_porciento.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				$( api.column(6).footer()).html(calculo+"%");			

			},  
			"iDisplayLength": -1,		
			dom: 'Bfrtip',
			buttons: [
			'csv', 'excel', 'print'
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
	jQuery("#tabla_tripulacion_length").addClass('hidden');
	jQuery("#tabla_tripulacion_filter").addClass('hidden');
	jQuery("#tabla_tripulacion_info").addClass('hidden');
	jQuery("#footer-left").text(jQuery("#tabla_tripulacion_info").text());
	jQuery("#tabla_tripulacion_paginate").appendTo(jQuery("#footer-right"));
});

$('#buscar_trip').keyup(function(){
	var buscar = $(this).val();
	t.search(buscar).draw() ;
});
$('#show_record_trip').change(function() {
	t.page.len($('#show_record_trip').val()).draw();
	jQuery("#footer-left").text(jQuery("#tabla_tripulacion_info").text());
});

setTimeout(cargarTabla_tripulacion($('#id_oficina').val()) , 10);
function cargarTabla_tripulacion( oficinas){
	$('#bt_tripulacion').attr({disabled: 'true'});
	var url='<?php print site_url()."/informe_tripulacion"?>';
	t.clear();
	$.post(url, { oficinas : oficinas }, function(data) {
		$.each(data, function (i, obj) {
			console.log(obj);
			var total_doc  		= parseInt(obj.DOCS_AYUDANTE)+parseInt(obj.DOCS_CHOFER);
			var tripulacion 	= parseInt(obj.TOTAL_CHOFER)+ parseInt(obj.TOTAL_AYUDANTE);
			var porcpagado		= ((parseInt(total_doc)/parseInt(tripulacion))*100).toFixed();
			var porcnopagado 	= (((parseInt(tripulacion)-parseInt(total_doc))/parseInt(tripulacion))*100).toFixed();
			var no_pagado       = tripulacion-total_doc;
			if (no_pagado < 0) {
				no_pagado = 0;
			}
			if (porcpagado > 100) {
				porcpagado = '100';
			}
			if (porcnopagado > 100) {
				porcnopagado = '100';
			}
			t.row.add([obj.ID_OFICINA,
				obj.OFICINA,
				total_doc,
				no_pagado,
				tripulacion,
				porcpagado,
				porcnopagado
				]).draw( true );
			$('[data-toggle="tooltip"]').tooltip();
			total_doc=0;
		})
		$("#bt_tripulacion").removeAttr("disabled");
	},'json').fail(function() {						
		//location.reload();
	});
}

$('body').on('click','#bt_tripulacion',function(e){
	
	var oficinas 	= $('#id_oficina').val();
	if(oficinas != ''){
		cargarTabla_tripulacion( oficinas);
	}else{
		pf_notify('Error de filtro','Debe por lo menos seleccionar una oficina y fecha','info');
	}
})

})
</script>

<script>
	$('#btn_click').click(function(event) {
		event.preventDefault();
		t.ajax.reload(); 
	});
</script>
<script>
	$("#checkbox_oficina").click(function(){
		if($("#checkbox_oficina").is(':checked') ){
			$("#id_oficina > option").prop("selected","selected");
			$("#id_oficina").trigger("change");
		}else{
			$("#id_oficina > option").removeAttr("selected");
			$("#id_oficina").trigger("change");
		}
	});
</script>
