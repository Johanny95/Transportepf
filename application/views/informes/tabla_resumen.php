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
<div class="col-sm-3">
	<div class="form-group">
		<label>Buscar por</label>
		<div class="input-group">
			<input id='buscar' type="text" class="form-control" placeholder="patente, rut, nombre, etc">
			<span class="input-group-addon"><i class="fa fa-search"></i></span>
		</div>
	</div>
</div>
<div class="col-sm-2">
	<div class="form-group">
		<label>Propietario</label>
		<select class="form-control" id="propietario">
			<option value="">Ver todos</option>
			<option value="Transportista">Transportista</option>
			<option value="Camion">Camión</option>
			<option value="Chofer">Chofer</option>
			<option value="Ayudante">Ayudante</option>
		</select>
	</div>
</div>
<div class="col-sm-3">
	<div class="form-group">
		<label>Seleccionar tipo documento</label>
		<select id="tipoDocumento" class="form-control">
			<option value="" selected="true">Ver todos</option>
			<?php foreach ($documentos as $key): ?>
				<option value="<?php print $key['NOMBREDOC']?>"> <?php print $key['NOMBREDOC']?></option>
			<?php endforeach ?>
		</select>
	</div>
</div>
<div class="col-sm-2">
	<div class="form-group">
		<label>Filtrar por estado</label>
		<select class="form-control" id="estado">
			<option value="">Ver todos</option>
			<option value="VIGENTE">Vigente</option>
			<option value="PROXIMO A VENCER">Próximo a vencer</option>
			<option value="VENCIDO">Vencido</option>
		</select>
	</div>
</div>


<div class="col-md-12">	
	<div class="table-responsive">
		<table id="tablaInformeVigencia" class="table-striped table-bordered table-hover">
			<thead class="bg-primary">
				<tr>
					<th>Propietario del documento</th>
					<th>Rut | Patente</th>
					<th>Oficina</th>
					<th>Nombre Documento</th>
					<th>Tipo </th>
					<th>Estado</th>
					<th>Fecha vigencia</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($registros as $key): ?>
					<tr>
						<td><?php print $key->PERTENECIENTE ?></td>
						<td><?php print $key->IDENTIFICADOR ?></td>
						<td><?php print $key->OFICINA ?></td>
						<td><?php print $key->NOMBREDOC ?></td>
						<td><?php print $key->DUENNO ?></td>
						<td><?php print $key->ESTADO ?></td>
						<td><?php print $key->FECHAVIGENCIA ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		var t = $('#tablaInformeVigencia').DataTable({
			"paging"     : true,
			"ordering"   : true,
			"info"       : true,
			"autoWidth"  : false,
			"iDisplayLength": 20, 
			dom: 'Bfrtip',
			buttons: [
			'csv', 'excel', 'print'
			],
			"columnDefs" : [
			{ targets    : 'no-sort'     , orderable: false        },
			{ className  : "dt-nowrap"   , "targets": [0,1]        },
			{className   : "text-center"  , "targets": [6]},
			{ "width": "20%"  , "targets": 0 },
			{ "width": "15%"  , "targets": 1 },
			{ "width": "10%" , "targets": 2 },
			{ "width": "20%"  , "targets": 3 },
			{ "width": "15%"  , "targets": 4 },
			{ "width": "10%" , "targets": 5 },
			{ "width": "10%" , "targets": 6 },
			{ targets: 'no-sort', orderable: false }
			], 
			"createdRow": function ( row, data, index ) {
				if ( data[5] == "VENCIDO" ) {
					$('td',row).eq(5).empty();
					$('td',row).eq(5).append("<span class='label label-danger center-block lead'>"+data[5]+"</span>");
				}else if ( data[5] == "PROXIMO A VENCER" ) {
					$('td',row).eq(5).empty();
					$('td',row).eq(5).append("<span class='label label-warning center-block lead'>"+data[5]+"</span>");
				}else if ( data[5] == "VIGENTE" ) {
					$('td',row).eq(5).empty();
					$('td',row).eq(5).append("<span class='label label-success center-block lead'>"+data[5]+"</span>");
				}
			}
			,  
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
			var buscar = $(this).val();
			buscar += " "+$('#tipoDocumento').val()+" "+$("#estado").val()+" "+$('#propietario').val();
			t.search(buscar).draw() ;
		});
		$('#show_record').change(function() {
			t.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tablaInformeVigencia_info").text());
		});


		$('#propietario').change(function(){
			var ofi=$(this).find(":selected").val();
			ofi+=" "+$('#tipoDocumento').val()+" "+$("#estado").val();
			t.search(ofi).draw();
		});
		
		$('#tipoDocumento').change(function(){
			var doc=$(this).find(":selected").val();
			doc+=" "+$('#propietario').val()+" "+$("#estado").val();
			t.search(doc).draw();
		});
		$('#estado').change(function(){
			var est=$(this).find(":selected").val();
			est+=" "+$('#propietario').val()+" "+$('#tipoDocumento').val();
			t.search(est).draw();
		});


	});
</script>

