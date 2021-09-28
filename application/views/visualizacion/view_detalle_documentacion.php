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
		<h1>Detalle <small> Documentación</small></h1>
		<ol class="breadcrumb">
			<li><a ><span class='fa fa-list'></span>Visualizacion</a></li>
			<li class='active'><a>Listado de documentos</a></li>
		</ol>

	</section>
	<!-- Main content -->
	<section class="content">
		
		<div class="box box-default">
			<div class="box-header ">
				<i class="fa  fa-newspaper-o"></i>
				<h3 class="box-title">Visualización de documentos</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">

				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Fecha a buscar</label>
							<div class="input-group date">
								<input id='fecha' name='fecha' type="text" class="form-control"  name="FechaDocAyudante" readonly value="<?php echo date('d/m/Y');?>">
								<div class="input-group-addon">
									<span class="fa fa-calendar"></span>
								</div>	
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group div_oficina">
							<label>Buscar por oficina</label>
							<select id='oficina' name='oficina' class="form-control selectpicker" multiple data-actions-box="true" data-selected-text-format="count" style="width: 100%">
								<?php foreach ($oficinas_usuario as $key): ?>
									

									<?php if ($key->ID_OFICINA == $filter_oficina) { ?>
										<option selected value="<?php echo $key->ID_OFICINA?>"><?php echo ucwords(mb_strtolower($key->OFICINA))?></option>
									<?php } else { ?>

										<?php if ( $filter_oficina == -1) { ?>
											<option selected value="<?php echo $key->ID_OFICINA?>"><?php echo ucwords(mb_strtolower($key->OFICINA))?></option>
										<?php }else { ?>

											<option value="<?php echo $key->ID_OFICINA?>"><?php echo ucwords(mb_strtolower($key->OFICINA))?></option>
										<?php }  ?>
									<?php }  ?>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group div_oficina">
							<label>Tipo de Documento</label>
							<select class="form-control selectpicker show-tick" multiple data-placeholder="Seleccione Tipo de Documento"
							style="width: 100%;" id="tipoDocumento" name="tipoDocumento" data-actions-box="true" data-selected-text-format="count"> 
							<?php foreach ($documentos_usuario as $key): ?>
								<option selected data-subtext="<?php echo ucwords(mb_strtolower($key->AFECTADO)) ?>" value="<?php echo $key->ID_TIPO_DOC?>"><?php echo ucwords(mb_strtolower($key->NOMBREDOC))?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Buscar por</label>
						<div class="input-group">
							<input id='buscar' type="text" class="form-control" placeholder="patente, rut, nombre, etc">
							<span class="input-group-addon"><i class="fa fa-search"></i></span>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Propietario</label>
						<select class="form-control select2" id="propietario" style="width: 100%">
							<option value="" selected>Ver todos</option>
							<option value="TRANSPORTISTA">Transportista</option>
							<option value="CAMION">Camión</option>
							<option value="CHOFER">Chofer</option>
							<option value="AYUDANTE">Ayudante</option>
							<option value="RAMPLA">Rampla</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Filtrar por estado</label>
						<select class="form-control select2" id="estado" style="width: 100%">
							<option value="" selected>Ver todos</option>
							<option value="VIGENTE">Vigente</option>
							<option value="PROXIMO A VENCER">Próximo a vencer</option>
							<option value="VENCIDO">Vencido</option>
							<option value="FALTANTE">Faltante</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Filtrar por estado aprobación</label>
						<select class="form-control select2" id="est_aprobacion" style="width: 100%">
							<option value="" selected>Ver todos</option>
							<option value="APROBADO">Aprobado</option>
							<option value="RECHAZADO">Rechazado</option>
							<option value="PENDIENTE">Pendiente</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
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
			</div>
			

			<div class="row">
				<div class="tabla" id="divTabla">
					<div class="col-sm-12">	
						<div class="table-responsive">
							<table id="tablaInformeVigencia" class="table-striped table-bordered table-hover">
								<thead class="bg-navy">
									<tr>
										<th>Propietario</th>
										<th>Rut | Patente</th>
										<th>Oficina</th>
										<th>Nombre D.</th>
										<th>Tipo </th>
										<th>Estado</th>
										<th>F. Vigencia</th>
										<th>Transportista</th>
										<th>Documento</th>
										<th>Est</th>
										<th>E. Aprob</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			

		</div> 

	</div>
	<!-- /.box -->


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



	<script>
		$(function(){
			$('.select2').select2();

			$('.date').datepicker({
				format: 'dd/mm/yyyy',
				language : 'es'
			});

			$('body').on('click','.bt_desc_rechazo',function(){
				var motivo 			= $(this).data('motivo');
				var obs_rechazo 	= $(this).data('obsrechazo');
				var fecha_rechazo   = $(this).data('fechaaprobacion');
				var url 			= $(this).data('url');

				$('#motivo_view').val(motivo);
				$('#obsrechazo').val(obs_rechazo);
				$('#fecha_rechazo').val(fecha_rechazo);
				$('#iframe_rechazo').attr('src',url);

				$('#modal_info_aprob').modal('show');
			})

		})
	</script>

	<script>
		$(document).ajaxStart(function() {
			pf_blockUI();
		}).ajaxStop(function() {
			pf_unblockUI();
		});	

		var t 
		$(function(){

			$('[data-toggle="tooltip"]').tooltip();
			var buttonCommon = {
				exportOptions: {
					format: {
						body: function ( data, row, column, node ) {
		                    // Strip $ from salary column to make it numeric
		                    return data
		                }
		            }
		        }
		    };

		    // Add event listener for opening and closing details
		    $('#tablaInformeVigencia tbody').on('click', '.documento', function () {

		    	var tr = $(this).closest('tr');
		    	var row = t.row( tr );
		    	if ( row.child.isShown() ) {
            		// This row is already open - close it
            		row.child.hide();
            		tr.removeClass('shown');
            		$(this).removeClass('btn-danger').addClass('btn btn-primary');
            	}
            	else {
            		// Open this row
            		row.child( format(row.data()) ).show();
            		tr.addClass('shown');
            		$(this).removeClass('btn-primary').addClass('btn btn-danger');
            	}
            } );
		    function format ( d ) {
		    	console.log(d)
    			// `d` is the original data object for the row
    			var fila= '<table cellpadding="8" cellspacing="0" border="0" style="padding-left:50px;">'
    			fila+='<tr>';
    			fila+='<td><iframe style="width:850px; height:600px;" frameborder="0" src="'+d[8]+'"></iframe></td></tr></table>';
    			return fila;
    		}


    		t = $('#tablaInformeVigencia').DataTable({
    			"ajax": {
    				"url": "<?php echo site_url() ;?>/get_detalle_doc_view",
    				'type': 'POST',
    				"dataSrc":"",
    				"data": function ( d ) {
    					d.oficina 		= $('#oficina').val();
    					d.fecha 		= $('#fecha').val();
    					d.propietario 	= $('#propietario').val();
    					d.tipoDocumento = $('#tipoDocumento').val();
    					d.estado 		= $('#estado').val();
    					d.buscar 		= $('#buscar').val();
    					d.est_aprobacion 		= $('#est_aprobacion').val();
    				}
    			},
    			"paging"     : true,
    			"ordering"   : true,
    			"info"       : true,
    			"autoWidth"  : false,
    			"iDisplayLength": 20, 
    			"processing " : true,
    			dom: 'Bfrtip',
    			buttons: [
    			$.extend( true, {}, buttonCommon, {
    				extend: 'csvHtml5'
    			} ),
    			$.extend( true, {}, buttonCommon, {
    				extend: 'excelHtml5'
    			} ),
    			$.extend( true, {}, buttonCommon, {
    				extend: 'pdfHtml5'
    			} )
    			],
    			"columnDefs" : [
    			{ targets    : 'no-sort'     , orderable: false },
    			{ className  : "dt-nowrap"   , "targets": [0,1]	},
    			{className   : "text-center"  , "targets": [6,8,9]	},
    			{ "width": "15%"  , "targets": 0 },
    			{ "width": "15%"  , "targets": 1 },
    			{ "width": "10%" , "targets": 2 },
    			{ "width": "14%"  , "targets": 3 },
    			{ "width": "15%"  , "targets": 4 },
    			{ "width": "10%" , "targets": 5 },
    			{ "width": "10%" , "targets": 6 },
    			{ "width": "10%" , "targets": 7 },
    			{ "width": "10%" , "targets": 8 },
    			{ targets: 'no-sort', orderable: false }
    			], 
    			"createdRow": function ( row, data, index ) {
    				var doc = "<?php print base_url().'doc/'?>"+data[8];

    				if ( data[5] == "VENCIDO" ) {
    					$('td',row).eq(5).empty();
    					$('td',row).eq(5).append("<span class='label label-danger center-block lead'>"+data[5]+"</span>");
    				}else if ( data[5] == "PROXIMO A VENCER" ) {
    					$('td',row).eq(5).empty();
    					$('td',row).eq(5).append("<span class='label label-warning center-block lead'>"+data[5]+"</span>");
    				}else if ( data[5] == "VIGENTE" ) {
    					$('td',row).eq(5).empty();
    					$('td',row).eq(5).append("<span class='label label-success center-block lead'>"+data[5]+"</span>");
    				}else if ( data[5] == "FALTANTE") {
    					$('td',row).eq(5).empty();
    					$('td',row).eq(5).append("<span class='label label-danger center-block lead'>"+data[5]+"</span>");
    				}else if ( data[5] == "VIGENTE (No aplica)") {
    					$('td',row).eq(5).empty();
    					$('td',row).eq(5).append("<span class='label label-success center-block lead'>"+data[5]+"</span>");
    				}else {
    					$('td',row).eq(5).empty();
    					$('td',row).eq(5).append("<span class='label label-success center-block lead'>"+data[5]+"</span>");
    				}

    				$('td',row).eq(8).empty();
    				$('td',row).eq(8).append('<button type="button" class="btn btn-primary documento" value="'+doc+'"><i class="fa fa-level-down"></i></button>');

    				// alert(data[9].ESTADO_APROBACION);
    				switch (data[9].ESTADO_APROBACION) {
    					case 'APROBADO':
    					$('td',row).eq(9).empty();
    					$('td',row).eq(9).append("<button class='btn btn-success btn-sm' data-toggle='tooltip' title='Fecha Aprobacion: "+data[9].FECHA_APROBACION+" Aprobado por: "+data[9].USUARIO_APROBADOR+"'><i class='fa fa-check'></i></button>");

    					$('td',row).eq(10).empty();
    					$('td',row).eq(10).append("<span class='label label-success center-block lead'>"+data[10]+"</span>");
    					break;
    					case 'RECHAZADO':
    					$('td',row).eq(9).empty();
    					$('td',row).eq(9).append("<button class='btn btn-danger btn-sm center-block lead bt_desc_rechazo' data-toggle='tooltip' title='Click para detalle' data-url='"+data[9].URL+"'  data-motivo='"+data[9].MOTIVO_RECHAZO+"' data-obsrechazo='"+data[9].OBSERVACION_RECHAZO+"' data-useraprobacion='"+data[9].USUARIO_APROBADOR+"' data-fechaaprobacion='"+data[9].FECHA_APROBACION+"'><i class='fa fa-close'></i></button>");
    					$('td',row).eq(10).empty();
    					$('td',row).eq(10).append("<span class='label label-danger center-block lead'>"+data[10]+"</span>");
    					
    					break;
    					case 'PENDIENTE':
    					$('td',row).eq(9).empty();
    					$('td',row).eq(9).append("<button class='btn btn-warning btn-sm' data-toggle='tooltip' title='Documento pendiente de Aprobación'><i class='fa fa-clock-o'></i></button>");
    					$('td',row).eq(10).empty();
    					$('td',row).eq(10).append("<span class='label label-warning center-block lead'>"+data[10]+"</span>");
    					
    					if( data[5] == "FALTANTE" ){
    						$('td',row).eq(8).empty();
    						$('td',row).eq(9).empty();
    						$('td',row).eq(10).empty();
    					}
    					break;
    					default:

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
	jQuery("#tablaInformeVigencia_length").addClass('hidden');
	jQuery("#tablaInformeVigencia_filter").addClass('hidden');
	jQuery("#tablaInformeVigencia_info").addClass('hidden');
	jQuery("#footer-left").text(jQuery("#tablaInformeVigencia_info").text());
	jQuery("#tablaInformeVigencia_paginate").appendTo(jQuery("#footer-right"));
});

$('#buscar').keyup(function(){
	// t.ajax.reload();
	t.search($(this).val()).draw();
});
$('#show_record').change(function() {
	t.page.len($('#show_record').val()).draw();
	jQuery("#footer-left").text(jQuery("#tablaInformeVigencia_info").text());
});

$('#fecha').change(function(event) {
	t.ajax.reload();
});

$('#oficina').change(function(event) {
	t.ajax.reload();
});

$('#propietario').change(function(){
	t.ajax.reload();
});

$('#tipoDocumento').change(function(){
	t.ajax.reload();
});

$('#estado').change(function(){
	t.ajax.reload();
});

$('#est_aprobacion').change(function(){
	t.ajax.reload();
});


});
</script>