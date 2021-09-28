
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Resumen<small> Oficinas</small></h1>
		<ol class="breadcrumb">
			<li><a href='<?php echo site_url().'/index' ?>'><span class='fa fa-folder'></span>Oficinas</a></li>
			<li class='active'><a>listado</a></li>
		</ol>
	</section>
	
	<!-- Main content -->
	<section class="content">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Resumen grafico</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="chart" >
							<canvas id="areaChart" style="height:250px;"></canvas>
						</div>
						<div class="col-sm-2">
							<button type="button" id='bt_export' class="btn bg-navy">Exportar</button>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<h4>Porcentajes actuales</h4>	
							</div>
							
							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-green" id='divTotal'>
									<div class="inner">
										<h3 id='porcentaje_actual'></h3>
										<p>Total actual</p>
									</div>
									<div class="icon">
										<i class="ion ion-stats-bars"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-green" id='divTransp'>
									<div class="inner">
										<h3 id='porcentaje_transp'></h3>
										<p>Total Transportistas</p>
									</div>
									<div class="icon">
										<i class="fa fa-user"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-green" id='divCamion'>
									<div class="inner">
										<h3 id='porcentaje_camion'></h3>
										<p>Total camion</p>
									</div>
									<div class="icon">
										<i class="fa fa-truck"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-green" id='divChofer'>
									<div class="inner">
										<h3 id='porcentaje_chofer'></h3>
										<p>Total chofer</p>
									</div>
									<div class="icon">
										<i class="fa fa-users"></i>
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
		
		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Porcentajes oficinas</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body">					
				<div class="row">
					<div class="col-md-4">
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
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Buscar</label>
							<div class="input-group">
								<input id='buscar' type="text" class="form-control" placeholder="Ej: Talca">
								<span class="input-group-addon"><i class="fa fa-search"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row table-responsive no-left-right-margin">
					<div class="col-xs-12">
						<table id='tablaOficinas' class="display table table-bordered table-hover">
							<thead class="bg-navy">
								<tr>
									<th>Código</th>
									<th>Nombre</th>									
									<th>Total</th>
									<th>D. Transportista</th>
									<th>D. Camiones</th>
									<th>D. Chofer</th>
									<th>D. Ayudante</th>
									<th>Ver detalles</th>
								</tr>
							</thead>
							<tbody id='tbodyTransportistas'>
								<?php foreach ($oficinas as $key): 
								$suma=0;
								$suma+=($this->pfalimentos->is_mayor($key->DOC_TRANS)+$this->pfalimentos->is_mayor($key->PORCCAMION)+$this->pfalimentos->is_mayor($key->PORCCHOFER)+$this->pfalimentos->is_mayor($key->PORCAYUDANTE));
								$totalPorcentaje=round((($suma*100)/400),1);
								?>
								<tr>
									<td><?php echo $key->CODIGO_OFICINA?> </td>
									<td><?php echo $key->NOMBRE_OFICINA?> </td>									
									<td><?php echo $totalPorcentaje?> %</td>
									<td><?php echo $this->pfalimentos->is_mayor(floatval($key->DOC_TRANS))?> %</td>
									<td><?php echo $this->pfalimentos->is_mayor(floatval($key->PORCCAMION))?> %</td>
									<td><?php echo $this->pfalimentos->is_mayor(floatval($key->PORCCHOFER))?> %</td>
									<td><?php echo $this->pfalimentos->is_mayor(floatval($key->PORCAYUDANTE))?> %</td>
									<td>
										<a href="<?php echo site_url() ;?>/seleccionarOficina/<?php echo $key->CODIGO_OFICINA?>" class="btn btn-sm bg-navy btn-block"><i class="glyphicon glyphicon-log-in"></i></a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
						<tfoot class="bg-navy">
							<tr>
								<th colspan="2">Totales</th>
								<th></th>
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
		<!-- /.box-body -->
		<div class="box-footer">

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
<!-- /.content-wrapper -->

<script type="text/javascript" src="<?php echo base_url(); ?>resources/bootstrap/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/bootstrap/js/FileSaver.js"></script>
<script type="text/javascript">
	$(function(){
//--------------
    //- AREA CHART -
    //--------------
    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)
    var mes = [], porcentaje = [];

    $.ajax({
    	url: '<?php echo site_url()?>/getDataChart',
    	type: 'POST',
    	dataType: 'json'
    })
    .done(function(data) {
    	$.each(data,function(index, el) {
    		mes.push(String(el.MES));
    		porcentaje.push(parseFloat(el.TOTAL_MES));
    	});

    	var areaChartData = {
    		labels  : mes,
    		datasets: [
    		{
    			label               : 'Control de documentación',
    			fillColor           : 'rgba(4, 40, 84, 1)',
    			strokeColor         : 'rgba(210, 214, 222, 1)',
    			pointColor          : 'rgba(0, 0, 0, 1)',
    			pointStrokeColor    : '#c1c7d1',
    			pointHighlightFill  : '#fff',
    			pointHighlightStroke: 'rgba(220,220,220,1)',
    			data                : porcentaje
    		}
    		]
    	}

    	var areaChartOptions = {
	      //Boolean - If we should show the scale at all
	      showScale               : true,
	      //Boolean - Whether grid lines are shown across the chart
	      scaleShowGridLines      : false,
	      //String - Colour of the grid lines
	      scaleGridLineColor      : 'rgba(0,0,0,.05)',
	      //Number - Width of the grid lines
	      scaleGridLineWidth      : 1,
	      //Boolean - Whether to show horizontal lines (except X axis)
	      scaleShowHorizontalLines: true,
	      //Boolean - Whether to show vertical lines (except Y axis)
	      scaleShowVerticalLines  : true,
	      //Boolean - Whether the line is curved between points
	      bezierCurve             : true,
	      //Number - Tension of the bezier curve between points
	      bezierCurveTension      : 0.3,
	      //Boolean - Whether to show a dot for each point
	      pointDot                : false,
	      //Number - Radius of each point dot in pixels
	      pointDotRadius          : 4,
	      //Number - Pixel width of point dot stroke
	      pointDotStrokeWidth     : 1,
	      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
	      pointHitDetectionRadius : 20,
	      //Boolean - Whether to show a stroke for datasets
	      datasetStroke           : true,
	      //Number - Pixel width of dataset stroke
	      datasetStrokeWidth      : 2,
	      //Boolean - Whether to fill the dataset with a color
	      datasetFill             : true,
	      //String - A legend template
	      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
	      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
	      maintainAspectRatio     : true,
	      //Boolean - whether to make the chart responsive to window resizing
	      responsive              : true
	  }
	    //Create the line chart
	    areaChart.Line(areaChartData, areaChartOptions);

	    $('#bt_export').click(function(){
	    	$('#areaChart').get(0).toBlob(function(blod){
	    		saveAs(blod,'chart_1.png');
	    	})
	    });


	})

})
</script>

<script>
	$(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
		var t = $('#tablaOficinas').DataTable({
			"paging" : true,
			"ordering" : true,
			"info" : true,
			"autoWidth" : true,
			"iDisplayLength": -1,			
			dom: 'Bfrtip',
			buttons: [
			'csv', 'excel', 'print'
			],
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-right", "targets": [2,3,4,5,6,7]},
			{ className: "dt-nowrap", "targets": [0,1] },
			{ className: "text-center", "targets": [7]},			
			],
			"createdRow": function ( row, data, index ) {
				if ( data[2].replace(/[\%,]/g, '') * 1 < 50 ) {
					$('td',row).eq(2).empty();
					$('td',row).eq(2).append("<span class='label label-danger center-block lead'>"+data[2]+"</span>");
				}else if ( data[2].replace(/[\%,]/g, '') * 1 < 90 ) {
					$('td',row).eq(2).empty();
					$('td',row).eq(2).append("<span class='label label-warning center-block lead'>"+data[2]+"</span>")
				}else if ( data[2].replace(/[\%,]/g, '') * 1 >=90 ) {
					$('td',row).eq(2).empty();
					$('td',row).eq(2).append("<span class='label label-success center-block'>"+data[2]+"</span>")
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
				.column( 2 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				var calculo = ((parseFloat(total_porciento.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				if(calculo<40){
					$('#divTotal').removeClass('bg-green');
					$('#divTotal').addClass('bg-red');
				}else if(calculo<=80){
					$('#divTotal').removeClass('bg-green');
					$('#divTotal').addClass('bg-yellow');
				}
				$( api.column(2).footer()).html(calculo+"%");				
				$("#porcentaje_actual").empty().append(calculo+'<sup style="font-size: 20px">%</sup>');
				//PORCENTAJE TOTAL DOCS TRANSPORTISTAS
				$i = 0;
				total_docsTransp = api
				.column( 3 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				var calculo_transp = ((parseFloat(total_docsTransp.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				if(calculo_transp<40){
					$('#divTransp').removeClass('bg-green');
					$('#divTransp').addClass('bg-red');
				}else if(calculo_transp<=80){
					$('#divTransp').removeClass('bg-green');
					$('#divTransp').addClass('bg-yellow');
				}
				$( api.column(3).footer()).html(calculo_transp+"%");				
				$("#porcentaje_transp").empty().append(calculo_transp+'<sup style="font-size: 20px">%</sup>');
				//Total docs Camion
				$i = 0;
				total_camion = api
				.column( 4 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				var calculo_camion = ((parseFloat(total_camion.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				if(calculo_camion<40){
					$('#divCamion').removeClass('bg-green');
					$('#divCamion').addClass('bg-red');
				}else if(calculo_camion<=80){
					$('#divCamion').removeClass('bg-green');
					$('#divCamion').addClass('bg-yellow');
				}
				$( api.column(4).footer()).html(calculo_camion+"%");				
				$("#porcentaje_camion").empty().append(calculo_camion+'<sup style="font-size: 20px">%</sup>');
				//PORCENTAJE TOTAL DOCS CHOFER
				$i = 0;
				total_chofer = api
				.column( 5 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				var calculo_chofer = ((parseFloat(total_chofer.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				if(calculo_chofer<40){
					$('#divChofer').removeClass('bg-green');
					$('#divChofer').addClass('bg-red');
				}else if(calculo_chofer<=80){
					$('#divChofer').removeClass('bg-green');
					$('#divChofer').addClass('bg-yellow');
				}
				$( api.column(5).footer()).html(calculo_chofer+"%");				
				$("#porcentaje_chofer").empty().append(calculo_chofer+'<sup style="font-size: 20px">%</sup>');
				//PORCENTAJE TOTAL DOCS CHOFER
				$i = 0;
				total_ayudante = api
				.column( 6 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace('%','')) + intVal(b.toString().replace('%',''));
				}, 0 );
				var calculo_ayudante = ((parseFloat(total_ayudante.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				$( api.column(6).footer()).html(calculo_ayudante+"%");				
				$("#porcentaje_ayudante").empty().append(calculo_ayudante+'<sup style="font-size: 20px">%</sup>');
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

		// function cargartabla(){
		// 	var url = '<?php print site_url().'/verTransportistas'?>';
		// 	$("#tbodyTransportistas").empty();
		// 	$.getJSON(url, function (objetos) {

		// 		$.each(objetos, function (i, obj) {
		// 			var total=0;
		// 			total+=parseInt(obj.PROMEDIO)+parseInt(obj.PORCCAMION);
		// 			totalPorcentaje=(total*100)/200;
		// 			t.row.add([obj.ID_PROVEEDOR,obj.RUT_TANSPORTISTA,obj.RAZON_SOCIAL,obj.ESTADO_TRANSPORTISTA,totalPorcentaje+"%",obj.PROMEDIO+'%',obj.PORCCAMION+"%","<button id='verFicha' data-toggle='tooltip' title='Ver ficha' class='btn btn-success' value='"+obj.ID_PROVEEDOR+"'><span class='fa fa-list-alt'></span></button> <button id='seleccionar' class='btn btn-primary' value='"+obj.ID_PROVEEDOR+"'><span class='fa fa-truck'></span></button>"]).draw( true );
		// 		})
		// 	});
		// }
		// 
		// 
	});
</script>
