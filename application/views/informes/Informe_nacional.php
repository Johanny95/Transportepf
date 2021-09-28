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
		<h1> Informe Nacional <small> Oficinas</small></h1>
		<ol class="breadcrumb">
			<li><a href='<?php echo site_url().'/index' ?>'><span class='fa fa-folder'></span>Informes</a></li>
			<li class='active'><a>Informe Nacional Transporte</a></li>
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
	                <strong>Nota:</strong> El reporte se visualiza a partir de la fecha actual. Debe elegir la Fecha para obtener más información.
              	</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="container-fluid">
						<div class="col-sm-3 well well-sm">
							<div class="form-group">
								<label>Oficinas</label>
	                        	<?php if ($this->session->usuario[0]['OFICOD'] == 'ALL'): ?>
									<select class="form-control selectpicker show-tick" multiple="multiple" data-placeholder="Seleccione Oficina"
			                        style="width: 100%;" id="id_oficina" name="id_oficina[]" data-live-search="true" data-actions-box="true" data-selected-text-format="count">
			                        <?php foreach ($oficina as $key): ?>
		                        		<option value="<?php echo $key->CODIGO_OFICINA?>"><?php echo ucwords(mb_strtolower($key->NOMBRE_OFICINA))?></option>
			                        <?php endforeach ?>
			                        </select>
			                    <?php else :?>
			                    	<input type="hidden" name="id_oficina" id="id_oficina" value="<?php echo ucwords(mb_strtolower($this->session->usuario[0]['OFICOD'])) ?>">
			                    	<input type="text" class="form-control" name="id_oficina[]" id="id_oficina" value="<?php echo ucwords(mb_strtolower($this->session->usuario[0]['NOMBRE_OFICINA'])) ?>" readonly>
	                        	<?php endif ?>
							</div>
							<div class="form-group">
								<label>Tipo de Documento</label>
								<select class="form-control selectpicker show-tick" multiple="multiple" data-placeholder="Seleccione Tipo de Documento"
		                        style="width: 100%;" id="id_tipo_doc" name="id_tipo_doc[]" data-live-search="true" data-actions-box="true" data-selected-text-format="count"> 
			                        <?php foreach ($tipo_doc as $key): ?>
			                        	<option data-subtext="<?php echo ucwords(mb_strtolower($key->AFECTADO)) ?>" value="<?php echo $key->ID_TIPO_DOC?>"><?php echo ucwords(mb_strtolower($key->NOMBREDOC))?></option>
			                        <?php endforeach ?>
		                        </select>
							</div>
	                        <div class="form-group margin-btm-5">
	                            <label>Filtro por fecha</label>
								<div class="input-group date">
				                  	<div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
				                  	</div>
				                  	<input type="text" class="form-control pull-right" id="datepicker">
				                </div>
	                        </div>
							<div class="form-group">
								<label>Mostrar</label>
								<select id="show_record" class="form-control">
									<option value="10">10 registros</option>
									<option value="25">25 registros</option>
									<option value="50">50 registros</option>
									<option value="100">100 registros</option>
									<option value="-1" selected="true">Todos los registros</option>
								</select>
							</div>
							<div class="form-group">
								<label>Buscar</label>
								<div class="input-group">
									<input id='buscar' type="text" class="form-control" placeholder="Ej: Talca">
									<span class="input-group-addon"><i class="fa fa-search"></i></span>
								</div>
							</div>
	                    	<div class="form-group">
	                    		<button type="button" class="btn btn-primary btn-block" style="margin-top: 24px" id="btn_click">Aplicar Filtro</button>
	                    	</div>
						</div>
						<div class="col-sm-9">
							<div class="col-sm-12">
								<div class="row table-responsive no-left-right-margin">
									<div class="col-xs-12">
										<table id='tablaOficinas' class="display table table-bordered table-hover">
											<thead class="bg-navy">
												<tr>
													<th>Código</th>
													<th>Nombre</th>
													<th>D. Tra</th>
													<th>D. Cam</th>	
													<th>D. Cho</th>	
													<th>D. Ayu</th>	
													<th>Total</th>
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
	                "url": "<?php echo site_url('get_informe_nacional') ;?>",
	                "dataSrc":"",
	                "type" : "POST",
	                "data" : function ( d ) {
	                	d.oficina = $('#id_oficina').val();
	                	d.tipo_doc = $('#id_tipo_doc').val();
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
	                {data : "total_oficina" , width : "20%" }
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

	$('#buscar').keyup(function(){
		t.search($(this).val()).draw() ;
	});
	$('#show_record').click(function() {
		t.page.len($('#show_record').val()).draw();
		jQuery("#footer-left").text(jQuery("#tablaOficinas_info").text());
	});
});
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
