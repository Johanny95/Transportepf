<?php 	
$this->load->library('Pfalimentos');
$user    = $this->session->userdata('usuario');
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Resumen<small>Transportista</small></h1>
		<ol class="breadcrumb">
			<li><a href='<?php echo site_url().'/index' ?>'><span class='fa fa-folder'></span>Transportista</a></li>
			<li class='active'><a>listado</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
			</div>
			<div class="box-body">
				
				<?php if ($user[0]['OFICOD'] !== 'ALL'){ ?>
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
				<?php } ?>


				<div class="col-sm-2">
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
						<label>Buscar</label>
						<div class="input-group">
							<input id='buscar' type="text" class="form-control" placeholder="Ej: juan perez">
							<span class="input-group-addon"><i class="fa fa-search"></i></span>
						</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-group">
						<?php if ($user[0]['OFICOD']==='ALL'): ?>
							<label>Buscar por oficina</label>
							<select id='oficodigo' class="form-control select2">
								<option value="">VER TODOS</option>
								<?php foreach ($getOficinas as $key): ?>
									<?php if ($key->CODIGO_OFICINA == ( !isset($oficina) ? "" : $oficina )) : ?>
										<option  selected="TRUE" value="<?php echo $key->CODIGO_OFICINA?>"><?php echo $key->NOMBRE_OFICINA?></option>
										<?php else: ?>
											<option value="<?php echo $key->CODIGO_OFICINA?>"><?php echo $key->NOMBRE_OFICINA?></option>
										<?php endif ?>
									<?php endforeach ?>
								</select>
								<?php else: ?>
									<input type="text" id="oficodigo" name="oficodigo" class="form-control hidden" value="<?php echo $user[0]['OFICOD']?>">
								<?php endif ?>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="">
								<?php if ($user[0]['OFICOD']==='ALL'){ ?>
									<div class="form-group">
										<label></label><br/>
										<a href="javascript:window.history.back();" class="btn btn-default pull-right">
											<i class="fa fa-reply"></i> Volver atrás
										</a>
									</div>
								<?php } ?>
							</div>
						</div>


						<div class="col-sm-12">
							<div class="row table-responsive no-left-right-margin">
								<table id='tabla1' class="table table-bordered table-responsive table-hover">
									<thead class="btn-primary">
										<tr>
											<th>código</th>
											<th>Rut</th>
											<th>R. Social</th>
											<th>C°</th>
											<th>Oficina</th>
											<th>Total</th>
											<th>Transportista</th>
											<th>Camiones</th>
											<th>Chofer</th>
											<th>Ayudantes</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody id='tbodyTransportistas'>
										<?php if ($user[0]['OFICOD']==='ALL'): ?>
											<?php foreach ($transp_lista as $key):
												$suma=0;
												$por_ayudante = 0;

												if ($key->CON_AYUDANTE == 'SI') {
													$por_ayudante = $key->PORCAYUDANTE;
												}else{
													$por_ayudante = 100;
												}

												$suma+=($this->pfalimentos->is_mayor($key->PROMEDIO)+$this->pfalimentos->is_mayor($key->PORCCAMION)+$this->pfalimentos->is_mayor($key->PORCCHOFER)+$this->pfalimentos->is_mayor($por_ayudante));
												$totalPorcentaje=round((($suma*100)/400),2);

												?><tr>
													<td><?php echo $key->ID_PROVEEDOR?></td>
													<td><?php echo $key->RUT_TANSPORTISTA?></td>
													<td><?php echo $key->RAZON_SOCIAL?></td>
													<td><?php echo $key->CODIGO_OFICINA?></td>
													<td><?php echo $key->NOMBRE_OFICINA?></td>
													<td><?php echo $this->pfalimentos->is_mayor(floatval($totalPorcentaje))?> %</td>
													<td><?php echo $this->pfalimentos->is_mayor(floatval($key->PROMEDIO))?> %</td>
													<td><?php echo $this->pfalimentos->is_mayor(floatval($key->PORCCAMION))?> %</td>
													<td><?php echo $this->pfalimentos->is_mayor(floatval($key->PORCCHOFER))?> %</td>
													<?php if ($key->CON_AYUDANTE == 'SI'): ?>
														<td><?php echo $this->pfalimentos->is_mayor(floatval($key->PORCAYUDANTE))?> %</td>
														<?php else: ?>
															<td><?php echo $this->pfalimentos->is_mayor(floatval(100))?> %</td>
														<?php endif ?>
														<td><button id='verFicha' data-toggle='tooltip' title='Ver ficha' class='btn btn-success btn-sm' value='<?php echo $key->ID_PROVEEDOR.','.$key->CODIGO_OFICINA?>'><span class='fa fa-list-alt'></span></button>  <button id='seleccionar' data-toggle='tooltip' title='Ver flota' class='btn btn-primary btn-sm' value='<?php echo $key->ID_PROVEEDOR.','.$key->CODIGO_OFICINA?>'><span class='fa fa-truck'></span></button></td>
													</tr>
												<?php endforeach ?>
												<?php else: ?>
													<?php foreach ($transp_lista as $key):
														$suma=0;
														$por_ayudante = 0;

														if ($key->CON_AYUDANTE == 'SI') {
															$por_ayudante = $key->PORCAYUDANTE;
														}else{
															$por_ayudante = 100;
														}
														$suma+=($this->pfalimentos->is_mayor($key->PROMEDIO)+$this->pfalimentos->is_mayor($key->PORCCAMION)+$this->pfalimentos->is_mayor($key->PORCCHOFER)+$this->pfalimentos->is_mayor($por_ayudante));
														$totalPorcentaje=round((($suma*100)/400),2);
														?>
														<?php if ($key->CODIGO_OFICINA=== $user[0]['OFICOD']){ ?>
															<tr>
																<td><?php echo $key->ID_PROVEEDOR?></td>
																<td><?php echo $key->RUT_TANSPORTISTA?></td>
																<td><?php echo $key->RAZON_SOCIAL?></td>
																<td><?php echo $key->CODIGO_OFICINA?></td>
																<td><?php echo $key->NOMBRE_OFICINA?></td>
																<td><?php echo $this->pfalimentos->is_mayor($totalPorcentaje)?> %</td>
																<td><?php echo $this->pfalimentos->is_mayor($key->PROMEDIO)?> %</td>
																<td><?php echo $this->pfalimentos->is_mayor($key->PORCCAMION)?> %</td>
																<td><?php echo $this->pfalimentos->is_mayor($key->PORCCHOFER)?> %</td>
																<?php if ($key->CON_AYUDANTE == 'SI'): ?>
																	<td><?php echo $this->pfalimentos->is_mayor(floatval($key->PORCAYUDANTE))?> %</td>
																	<?php else: ?>
																		<td><?php echo $this->pfalimentos->is_mayor(floatval(100))?> %</td>
																	<?php endif ?>
																	<td>
																		<button id='verFicha' data-toggle='tooltip' title='Ver ficha' class='btn btn-success btn-sm' value='<?php echo $key->ID_PROVEEDOR.','.$key->CODIGO_OFICINA?>'>
																			<span class='fa fa-list-alt'></span>
																		</button>
																		<button id='seleccionar' data-toggle='tooltip' title='Ver flota' class='btn btn-primary btn-sm' value='<?php echo $key->ID_PROVEEDOR.','.$key->CODIGO_OFICINA?>'>
																			<span class='fa fa-truck'></span>
																		</button>
																	</td>
																</tr>
															<?php } ?>

														<?php endforeach ?>
													<?php endif ?>

												</tbody>
												<tfoot class="bg-primary">
													<tr>
														<th colspan="5"><center>Totales</center></th>
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

			<script>
				$(function(){

		//cargartabla();
		var t = $('#tabla1').DataTable({
			"paging"     : true,
			"ordering"   : true,
			"iDisplayLength": 10,
			"order": [[ 3, "asc" ]],
			"info"       : true,
			dom: 'Bfrtip',
			buttons: [
			'csv', 'excel', 'print'
			],
			"autoWidth"  : false,
			"columnDefs" : [
			{ targets    : 'no-sort'     , orderable: false        },
			{ className  : "text-right"  , "targets": [3,5,6,7,8,9]  },
			{ className  : "dt-nowrap"   , "targets": [0,1]        },
			{ className  : "text-center" , "targets": [10] 		   },
			{ "width": "5%"  , "targets": 0 },
			{ "width": "8%"  , "targets": 1 },
			{ "width": "23%" , "targets": 2 },
			{ "width": "5%"  , "targets": 3 },
			{ "width": "6%"  , "targets": 4 },
			{ "width": "12%" , "targets": 5 },
			{ "width": "12%" , "targets": 6 },
			{ "width": "10%" , "targets": 7 },
			{ "width": "11%" , "targets": 8 },
			{ "width": "8%"  , "targets": 9 },
			{ targets: 'no-sort', orderable: false }
			],
			"createdRow": function ( row, data, index ) {
				if ( data[5].replace(/[\%,]/g, '') * 1 < 50 ) {
					$('td',row).eq(5).empty();
					$('td',row).eq(5).append("<span class='label label-danger center-block lead'>"+data[5]+"</span>");
				}else if ( data[5].replace(/[\%,]/g, '') * 1 < 90 ) {
					$('td',row).eq(5).empty();
					$('td',row).eq(5).append("<span class='label label-warning center-block lead'>"+data[5]+"</span>");
				}else if ( data[5].replace(/[\%,]/g, '') * 1 >=90 ) {
					$('td',row).eq(5).empty();
					$('td',row).eq(5).append("<span class='label label-success center-block lead'>"+data[5]+"</span>");
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
				
				//PORCENTAJE TOTAL DOCS TRANSPORTISTAS
				$i = 0;
				total_docsTransp = api
				.column( 6 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace(',','.').replace('%','')) + intVal(b.toString().replace(',','.').replace('%',''));
				}, 0 );
				var calculo_transp = ((parseFloat(total_docsTransp.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				if(calculo_transp<40){
					$('#divTransp').removeClass('bg-green');
					$('#divTransp').addClass('bg-red');
				}else if(calculo_transp<=80){
					$('#divTransp').removeClass('bg-green');
					$('#divTransp').addClass('bg-yellow');
				}
				$( api.column(6).footer()).html(calculo_transp+"%");				
				$("#porcentaje_transp").empty().append(calculo_transp+'<sup style="font-size: 20px">%</sup>');
				//Total docs Camion
				$i = 0;
				total_camion = api
				.column( 7 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace(',','.').replace('%','')) + intVal(b.toString().replace(',','.').replace('%',''));
				}, 0 );
				var calculo_camion = ((parseFloat(total_camion.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				if(calculo_camion<40){
					$('#divCamion').removeClass('bg-green');
					$('#divCamion').addClass('bg-red');
				}else if(calculo_camion<=80){
					$('#divCamion').removeClass('bg-green');
					$('#divCamion').addClass('bg-yellow');
				}
				$( api.column(7).footer()).html(calculo_camion+"%");				
				$("#porcentaje_camion").empty().append(calculo_camion+'<sup style="font-size: 20px">%</sup>');
				//PORCENTAJE TOTAL DOCS CHOFER
				$i = 0;
				total_chofer = api
				.column( 8 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace(',','.').replace('%','')) + intVal(b.toString().replace(',','.').replace('%',''));
				}, 0 );
				var calculo_chofer = ((parseFloat(total_chofer.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				if(calculo_chofer<40){
					$('#divChofer').removeClass('bg-green');
					$('#divChofer').addClass('bg-red');
				}else if(calculo_chofer<=80){
					$('#divChofer').removeClass('bg-green');
					$('#divChofer').addClass('bg-yellow');
				}
				$( api.column(8).footer()).html(calculo_chofer+"%");				
				$("#porcentaje_chofer").empty().append(calculo_chofer+'<sup style="font-size: 20px">%</sup>');
				//PORCENTAJE TOTAL DOCS CHOFER
				$i = 0;
				total_ayudante = api
				.column( 9 , { page: 'current'} )
				.data()
				.reduce( function (a, b) {
					$i ++;
					return intVal(a.toString().replace(',','.').replace('%','')) + intVal(b.toString().replace(',','.').replace('%',''));
				}, 0 );
				var calculo_ayudante = ((parseFloat(total_ayudante.toFixed(2)) * 100 ) / ( 100 * $i )).toFixed(2);
				$( api.column(9).footer()).html(calculo_ayudante+"%");				
				$("#porcentaje_ayudante").empty().append(calculo_ayudante+'<sup style="font-size: 20px">%</sup>');



				
				var calculo = (( parseFloat(calculo_transp)+parseFloat(calculo_camion)+parseFloat(calculo_chofer)+parseFloat(calculo_ayudante) ) / 4).toFixed(1) ;
				if(calculo<40){
					$('#divTotal').removeClass('bg-green');
					$('#divTotal').addClass('bg-red');
				}else if(calculo<=80){
					$('#divTotal').removeClass('bg-green');
					$('#divTotal').addClass('bg-yellow');
				}
				$( api.column(5).footer()).html(calculo+"%");				
				$("#porcentaje_actual").empty().append(calculo+'<sup style="font-size: 20px">%</sup>');



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
	jQuery("#tabla1_length").addClass('hidden');
	jQuery("#tabla1_filter").addClass('hidden');
	jQuery("#tabla1_info").addClass('hidden');
	jQuery("#footer-left").text(jQuery("#tabla1_info").text());
	jQuery("#tabla1_paginate").appendTo(jQuery("#footer-right"));
});


function cargarTablita(){
	var ofi=$("#oficodigo").val();
	var oficina_cod=ofi == "VER TODOS" ? "" : ofi ;
			// t.search(oficina_cod+" "+$('#buscar').val(), true, false).draw();		// Regex: true, SmartSearch: false
			var buscar = oficina_cod+" "+$('#buscar').val();
			t
			.columns( 3 )
			.search( buscar.trim() )
	        .draw();	// Regex: true, SmartSearch: false
	    }

	    $('#buscar').keyup(function(){
	    	var ofi=$("#oficodigo").find(":selected").text();
	    	var oficina_cod=ofi == "VER TODOS" ? "" : ofi ;
	    	t.search($(this).val()+" "+oficina_cod).draw() ;
	    });
	    $('#show_record').change(function() {
	    	t.page.len($('#show_record').val()).draw();
	    	jQuery("#footer-left").text(jQuery("#tabla1_info").text());
	    });

	    $('#oficodigo').change(function(){
	    	var ofi=$("#oficodigo").val();
	    	var oficina_cod=ofi == "VER TODOS" ? "" : ofi ;
			// t.search(oficina_cod+" "+$('#buscar').val(), true, false).draw();		// Regex: true, SmartSearch: false
			var buscar = oficina_cod+" "+$('#buscar').val();
			t
			.columns( 3 )
			.search( buscar.trim() )
			.draw();
		});

	    cargarTablita();

	});
</script>

<script type="text/javascript">
	$(function(){
		$("body").on("click", "#seleccionar", function (e) {
			var datos = $(this).val().split(',');
			var codigo= datos[0];
			var oficina= datos[1];
			var url='<?php print site_url().'/seleccionar'?>';

			$.post(url, {codigo: codigo,oficina:oficina}, function(data, textStatus, xhr) {
				if(data.msg===false){
					alert('Error de servidor');
				}else{
					window.location = '<?php print site_url()?>' + '/docFlota';
				}
			},'json')
			.fail( function () {
				pf_notify('Error','Ingrese sesión nuevamente','danger');
				window.location.href = '<?php echo site_url('login')?>';

			});

		});

		$("body").on("click", "#verFicha", function (e) {
			var datos = $(this).val().split(',');
			var codigo= datos[0];
			var oficina= datos[1];
			var url='<?php print site_url().'/seleccionar'?>';

			$.post(url, {codigo: codigo, oficina:oficina}, function(data, textStatus, xhr) {
				if(data.msg===false){
					alert('Error de servidor');
				}else{
					window.location = '<?php print site_url()?>' + '/verFicha';
				}
			},'json')
			.fail( function () {
				pf_notify('Error','Ingrese sesión nuevamente','danger');
				window.location.href = '<?php echo site_url('login')?>';
			});

		});

	});
</script>
