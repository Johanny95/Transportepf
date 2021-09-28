<?php $user=$this->session->userdata('usuario');?>
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
<div class="col-sm-3">
	<div class="form-group">
		<label>Buscar</label>
		<div class="input-group">
			<input id='buscar' type="text" class="form-control" placeholder="Ej: juan perez">
			<span class="input-group-addon"><i class="fa fa-search"></i></span>
		</div>
	</div>
</div>
<div class="col-sm-3">
	<div class="form-group">
		<label>Estado</label>
		<select id="estado" class="form-control">	
			<option value="">Todos</option>
			<option value="Activo">Activo</option>
			<option value="Deshabilitado">Deshabilitado</option>
		</select>
	</div>
</div>


<div class="col-sm-3">
	<div class="form-group">
		<?php if ($user[0]['OFICOD']==='ALL'|| $user[0]['USUID']==='100793'): ?>
			<label>Buscar por oficina</label>
			<select id='oficinas_select' class="form-control select2">
				<option value="" selected="true">Ver todos</option>
				<?php foreach ($oficinas as $key): ?>
					<option value="<?php echo $key->NOMBRE_OFICINA?>"><?php echo $key->NOMBRE_OFICINA?></option>
					
				<?php endforeach ?>
			</select>
		<?php else: ?>

		<?php endif ?>
	</div>
</div>




<div class="col-sm-12">	
	<div class="table-responsive">
		<table id="tablaTelefonos" class="table table-striped table-bordered table-hover">
			<thead class='btn-primary'>
				<tr >
					<th></th>
					<th>[IMEI]</th>
					<th>Chofer</th>
					<th>camión</th>
					<th>Estado</th>					
					<th>Fechas</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($user[0]['OFICOD']==='ALL'|| $user[0]['USUID']==='100793'): ?>
					<?php foreach ($registros as $key): ?>						
						<tr>
							<td>
								<a class='btn btn-sm btn-info' data-toggle="tooltip" title='Documento' target="_blank" rel="ligthbox" href="<?php print base_url().'telefonos/'.$key['PATH_DOC'] ?>"><i class="fa  fa-file"></i></a>
							</td>
							<td>
								<span data-toggle="tooltip" 
								title="<?php ($key['ESTADO'] == 'H' ? print 'Habilitado' : print 'Deshabilitado' )?>" >
								<?php print $key['IMEI']?>
							</span>
							<br/>
							<?php print $key['NUM_TELEFONO']?>						
						</td>
						<td><?php print $key['RUTCHOFER']?><br/><?php print $key['NOMBRECHOFER']?></td>
						<td>
							<?php print $key['PATENTE']?><br/>
							<?php print $key['OFICINA']?>							
						</td>
						<td>
							<?php if ($key['ESTADO'] =='H'): ?>
								<label class="label label-success center-block">Activo</label>
							<?php else: ?>
								<label class="label label-danger center-block">Deshabilitado</label>
							<?php endif ?>
						</td>
						<td>De : <?php print $key['FECHA'] ?><br/>
							A : <?php ($key['FECHA_DESACTIVO']=='' ? print 'Actualidad'  : print $key['FECHA_DESACTIVO']) ?>
						</td>
						<td>
							<?php if ($key['ESTADO'] == 'H'){ ?>								
							<button id='bt_edit' type="button" data-toggle="tooltip" title="Editar" class='btn btn-sm bg-yellow' value='<?php print $key["IMEI"]."|".$key["COD_CHOFER"]."|".$key["ESTADO"]."|".$key["FECHA_INGRESO"].'|'.$key['NOMBRECHOFER'].'|'.$key['PATENTE'].'|'.$key['NUM_TELEFONO'] ?>'>
								<i class="fa fa-ban"></i>
							</button>
							<button id='historial' type="button" data-toggle="tooltip" title="Historial" value='<?php print $key['COD_CHOFER'].'|'.$key['RUTCHOFER'].'|'.$key['NOMBRECHOFER'].'|'.$key['OFICINA']?>' class='btn btn-sm bg-teal' >
								<i class="fa fa-book"></i>
							</button>
						</button>
						<?php } else{ ?>
						<center>
							<button id='historial' type="button" data-toggle="tooltip" title="Historial" value='<?php print $key['COD_CHOFER'].'|'.$key['RUTCHOFER'].'|'.$key['NOMBRECHOFER'].'|'.$key['OFICINA']?>' class='btn btn-sm bg-teal' >
								<i class="fa fa-book"></i>
							</button>
						</center>
						<?php }?>
					</td>
				</tr>
			<?php endforeach ?>

		<?php else: ?>

			<?php foreach ($registros as $key): ?>						
				<?php if ($key['OFICINACHOFER']== $user[0]['OFICOD']){ ?>
				<tr>
					<td>
						<a class='btn btn-sm btn-info' data-toggle="tooltip" title='Documento' target="_blank" rel="ligthbox" href="<?php print base_url().'telefonos/'.$key['PATH_DOC'] ?>"><i class="fa fa-file"></i></a>
					</td>
					<td>
						<span data-toggle="tooltip" 
						title="<?php ($key['ESTADO'] == 'H' ? print 'Habilitado' : print 'Desactivo' )?>" >
						<?php print $key['IMEI']?>
					</span>
					<br/>
					<?php print $key['NUM_TELEFONO']?>						
				</td>
				<td><?php print $key['RUTCHOFER']?><br/><?php print $key['NOMBRECHOFER']?></td>
				<td>
					<?php print $key['PATENTE']?>
				</td>
				<td>
					<?php if ($key['ESTADO'] =='H'): ?>
						<label class="label label-success center-block">Activo</label>
					<?php else: ?>
						<label class="label label-danger  center-block">Desactivo</label>
					<?php endif ?>
				</td>
				<td>Desde : <?php print $key['FECHA'] ?><br/>
					Hasta : <?php ($key['FECHA_DESACTIVO']=='' ? print 'Actualidad'  : print $key['FECHA_DESACTIVO']) ?>
				</td>
				<td>
					<?php if ($key['ESTADO'] == 'H'){ ?>		
					<!--boton editar-->						
					<button id='bt_edit' type="button" data-toggle="tooltip" title="Editar" class='btn btn-sm bg-yellow' value='<?php print $key["IMEI"]."|".$key["COD_CHOFER"]."|".$key["ESTADO"]."|".$key["FECHA_INGRESO"]?>'>
						<i class="fa fa-ban"></i>
					</button>
					<button id='historial' type="button" data-toggle="tooltip" title="Historial" value='<?php print $key['COD_CHOFER'].'|'.$key['RUTCHOFER'].'|'.$key['NOMBRECHOFER'].'|'.$key['OFICINA']?>' class='btn btn-sm bg-teal' >
						<i class="fa fa-book"></i>
					</button>
					<!--boton deshabilitar-->						
					<?php } else{ ?>
					<!--boton alerta de desactivo-->						
					<center>					
						<button id='historial' type="button" data-toggle="tooltip" title="Historial" value='<?php print $key['COD_CHOFER'].'|'.$key['RUTCHOFER'].'|'.$key['NOMBRECHOFER'].'|'.$key['OFICINA']?>' class='btn btn-sm bg-teal' >
							<i class="fa fa-book"></i>
						</button>
					</center>
					<?php }?>
				</td>
			</tr>
			<?php } ?>
		<?php endforeach ?>
	<?php endif ?>
</tbody>
</table>
</div>
</div>





<div class="modal fade bs-example-modal-lg" tabindex="-1" id='modal_historial' role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Historial chofer</h4>
			</div>
			<div class="modal-body">

				<div class="row">
					<div class="col-sm-6">
						<div id='div_num_edit' class="form-group">
							<label>Código chofer</label>
							<input type="text" readonly="true" id='codigoChofer'  class="form-control"/>
						</div>				
					</div>
					<div class="col-sm-6">
						<div id='div_num_edit' class="form-group">
							<label>Rut</label>
							<input type="text" readonly="true" id='rut'  class="form-control"/>
						</div>				
					</div>
					<div class="col-sm-6">
						<div id='div_num_edit' class="form-group">
							<label>Nombre</label>
							<input type="text" readonly="true" id='nombre'  class="form-control"/>
						</div>				
					</div>
					<div class="col-sm-6">
						<div id='div_num_edit' class="form-group">
							<label>Oficina</label>
							<input type="text" readonly="true" id='ofi'  class="form-control"/>
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead class="btn-primary">
									<tr>
										<td>Teléfono</td>
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
		$("a.fancybox").fancybox();
		$('[data-mask]').inputmask();
		$('[data-toggle="tooltip"]').tooltip(); 
		var t = $('#tablaTelefonos').DataTable({
			"paging"     : true,
			"ordering"   : true,
			"order": [[ 4, "asc" ]],
			"info"       : true,
			"autoWidth"  : true,
			"iDisplayLength": 10, 				
			"columnDefs" : [
			{ targets    : 'no-sort'     , orderable: false},			
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
			t.search($(this).val()+" "+$('#estado').val()+" "+$('#oficinas_select').val()).draw();
		});
		$('#show_record').change(function() {
			t.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tablaTelefonos_info").text());
		});	

		$('#estado').change(function(){
			var est=$(this).find(":selected").val();
			est+=" "+$('#buscar').val()+" "+$('#oficinas_select').val();
			t.search(est).draw();
		});

		$('#oficinas_select').change(function(){
			var est=$(this).find(":selected").val();
			est+=" "+$('#buscar').val()+" "+$('#estado').val();
			t.search(est).draw();
		});

		

	});
</script>
