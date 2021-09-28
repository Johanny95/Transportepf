<div class="col-sm-4">
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
		<label>Filtrar por estado</label>
		<select class="form-control" id="estado">
			<option value="">Ver todos</option>
			<option value="Habilitado">Habilitado</option>
			<option value="Desactivo">Desactivo</option>
		</select>
	</div>
</div>

<div class="col-md-12">	
	<div class="table-responsive">
		<table id="tablaTelefonos" class="table table-striped table-bordered table-hover">
			<thead class='btn-primary'>
				<tr class="">
					<th></th>
					<th>IMEI</th>										
					<th>Marca</th>
					<th>Estado</th>
					<th>Descripción</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($registros as $key): ?>
					<tr>
						<td><button id='historial' value='<?php print $key->IMEI.'|'.$key->MARCA.'|'.$key->MODELO ?>' class="btn btn-sm btn-info" data-toggle="tooltip" title="Historial"><i class="fa fa-book"></i></button></td>
						<td><?php print $key->IMEI ?></td>
						<td><?php print $key->MARCA." ".$key->MODELO ?></td>	
						<?php if ($key->ESTADO == 'H'): ?>
							<td><span class="label center-block label-success" >Habilitado</span></td>
						<?php else: ?>
							<td><span class='label center-block label-danger' >Desactivo</span></td>
						<?php endif ?>
						<td><?php print $key->DESCRIPCION?></td>
						<td>
							<?php if ($key->ESTADO == 'H'){ ?>								
							<button id='bt_edit'  value="<?php print $key->IMEI.'|'.$key->MARCA.'|'.$key->MODELO.'|'.$key->ESTADO.'|'.$key->CREATION_DATE.'|'.$key->DESCRIPCION ?>" type="button" data-toggle="tooltip" title="Editar" class='btn btn-sm bg-teal'><i class="fa fa-edit"></i></button>
							<button id='bt_des'  value="<?php print $key->IMEI.'|'.$key->MARCA.'|'.$key->MODELO?>" data-toggle="tooltip" title="Deshabilitar" type="button" class='btn btn-sm bg-red'><i class="fa fa-ban"></i></button>
							<?php } else{ ?>								
							<button type='button' class="btn btn-sm bg-red btn-circle"><i class="fa fa-remove"></i> </button>
							<?php }?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" id='modal_historial' role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Historial del teléfono</h4>
			</div>
			<div class="modal-body">

				<div class="row">
					<div class="col-sm-6">
						<div id='div_num_edit' class="form-group">
							<label>IMEI</label>
							<input type="text" readonly="true" id='imei_histo'  class="form-control"/>
						</div>				
					</div>
					<div class="col-sm-6">
						<div id='div_num_edit' class="form-group">
							<label>Marca</label>
							<input type="text" readonly="true" id='marca_histo'  class="form-control"/>
						</div>				
					</div>
					<div class="col-sm-6">
						<div id='div_num_edit' class="form-group">
							<label>Modelo</label>
							<input type="text" readonly="true" id='modelo_histo'  class="form-control"/>
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead class="btn-primary">
									<tr>
										<td>C. chofer</td>
										<td>Nombre</td>
										<td>Fechas</td>
										<td>Número</td>
										<td>Patente</td>
										<td>estado</td>
										<td>Motivo</td>
										<td>Comodato</td>							
									</tr>
								</thead>
								<tbody id='tbody_historial'>
								</tbody>
							</table>	
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>				
			</div>

		</div>
	</div>
</div>





<script type="text/javascript">	
	$(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
		var t = $('#tablaTelefonos').DataTable({
			"paging"     : true,
			"ordering"   : true,
			"order": [[ 4, "asc" ]],
			"info"       : true,
			"autoWidth"  : true,
			"iDisplayLength": 20, 			
			"columnDefs" : [
			{ targets    : 'no-sort'     , orderable: false        },			
			{ targets: 'no-sort', orderable: false },
			{ className   : "text-center"  , "targets": [5]}			
			],  
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
			jQuery("#tablaTelefonos_length").addClass('hidden');
			jQuery("#tablaTelefonos_filter").addClass('hidden');
			jQuery("#tablaTelefonos_info").addClass('hidden');
			jQuery("#footer-left").text(jQuery("#tablaTelefonos_info").text());
			jQuery("#tablaTelefonos_paginate").appendTo(jQuery("#footer-right"));
		});

		$('#buscar').keyup(function(){
			t.search($(this).val()+" "+$('#estado').val()).draw() ;
		});
		$('#show_record').change(function() {
			t.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tablaTelefonos_info").text());
		});	
		$('#estado').change(function(){
			var est=$(this).find(":selected").val();
			est+=" "+$('#buscar').val();
			t.search(est).draw();
		});
	});
</script>

