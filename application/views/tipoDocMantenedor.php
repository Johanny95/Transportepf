<?php $user=$this->session->userdata('usuario');?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Mantenedor<small> tipos de documentos</small></h1>
		<ol class="breadcrumb">
			<li><a href='<?php echo site_url().'/index' ?>'><span class='fa fa-folder'></span>Administración tipo documentos</a></li>
			<li class='active'><a>mantenedor</a></li>
		</ol>
	</section>
	
	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<div class="box-tools pull-right">
					
				</div>
				<div class="box-body">
					<div class='row'>
						<div class="col-sm-4 well well-sm">
							<form id='formTipoDoc' method="POST">
								<div class="form-group">
									<label for="exampleInputEmail1">Nombre documento</label>
									<input type="text" class="form-control" id="nombreDoc" name='nombreDoc' required="true" placeholder="Ingrese nombre documento">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Perteneciente a:</label>
									<select name="afectado" id='afectado' class="form-control select2" required="true" style="width: 100%">
										<option value="" selected disabled="true">Seleccionar opción</option>
										<option value="T"    >Transportista</option>
										<option value="C"    >Camión</option>
										<option value="CH"   >Chofer</option>
										<option value="A"    >Ayudante</option>
										<option value="R"    >Rampla</option>
									</select>
								</div>
								
								<div class="form-group">
									<label>Buscar por oficina</label>
									<select id='oficina' name='oficina' class="form-control selectpicker" multiple data-actions-box="true" data-selected-text-format="count" style="width: 100%">
										<?php foreach ($getOficinas as $key): ?>
											<?php if ($key->NOMBRE_OFICINA == ( !isset($oficina) ? "" : $oficina )) : ?>
												<option  selected="TRUE" value="<?php echo $key->CODIGO_OFICINA?>"><?php echo $key->NOMBRE_OFICINA?></option>
												<?php else: ?>
													<option value="<?php echo $key->CODIGO_OFICINA?>"><?php echo ucwords(mb_strtolower($key->NOMBRE_OFICINA))?></option>
												<?php endif ?>
											<?php endforeach ?>
										</select>

									</div>


									<div class="form-group">
										<label>Descripción del documento</label>
										<textarea class="form-control center-block" name='descrip' id='descrip' rows="2" placeholder="Descripción, legislación ..."></textarea>
									</div>
									<div class="form-group" data-toggle="tooltip" data-placement="bottom" title="Al digitar un numero, esté contará como días para efectuar aviso de próximo a vencer">
										<label>Sujeto a fecha de vigencia</label></br>
										<div class="input-group">
											<span class="input-group-addon">
												<input type='checkbox' class='minimal icheckbox_flat-green' id='checkAviso'>
											</span>
											<input  name="diasAviso" type="number" minlength="1" max="500" placeholder="Días para próximo a vencer" id="diasAviso" class="form-control" disabled="true">
										</div><!-- /input-group -->
									</div>
									<div class="form-group" data-toggle="tooltip" data-placement="bottom" title="Al seleccionar esta casilla, se entenderá que es un documento multiple, al cual sera unido a la flota">
										<label>Compartido</label>
										<div class="input-group" >
											<span class="input-group-addon" >
												<input type='checkbox' class='minimal icheckbox_flat-green' id='checkDependencia' value='SI' name='checkDependencia'>
											</span>
											<input value="Chofer y ayudantes" class="form-control" disabled="TRUE" />
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<button type="button" class="btn bg-navy btn-block" id="btn-add"><i class="fa fa-check pull-left"></i>Aceptar</button>
										</div>
										<div class="col-sm-6">
											<a href="javascript:window.history.back();" class="btn bg-gray btn-block"><i class="fa fa-reply pull-left"></i> Volver atrás</a>
										</div>
									</div>

								</form>
							</div>
							<div class="col-sm-8">
								<div class="row">
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
									<div class="col-sm-4">
										<div class="form-group">
											<label>Filtrar por</label>
											<select name="filtroAfectado" id='filtroAfectado' class="form-control select2" required="true" style="width: 100%">
												<option value="" >Todos</option>
												<option value="transportista">Transportista</option>
												<option value="Camion">Camión</option>
												<option value="Chofer">Chofer</option>
												<option value="Ayudante">Ayudante</option>
												<option value="Rampla">Rampla</option>
											</select>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="form-group">
											<label>Buscar</label>
											<div class="input-group">
												<input id='buscar' type="text" class="form-control" placeholder="Ej: S.N.S">
												<span class="input-group-addon"><i class="fa fa-search"></i></span>
											</div>
										</div>
									</div>
								</div>

								<div class="table-responsive">
									<table id='tablaDocs' class="table table-responsive table-bordered">
										<thead class="bg-navy" >
											<tr>
												<th>Nombre documento</th>
												<th>Perteneciente</th>
												<th>Días aviso</th>
												<th>Acción</th>
											</tr>
										</thead>
										<tbody id='tbodyDocs' >

										</tbody>
									</table>
								</div>

							</div>

						</div>
						<!-- /.box-body -->
						<div class="box-footer">

						</div
						<!-- /.box-footer-->
					</div>
					<!-- /.box -->

				</section>
				<!-- /.content -->
			</div>

			<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Editar documentos</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<form id="formEdit" method="POST">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">Código documento</label>
											<input type="text" class="form-control" id="codDoc" name='codDoc' required="true" readonly="true">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">Nombre documento</label>
											<input type="text" class="form-control" id="nombreDocEdit" name='nombreDocEdit' required="true">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">Oficinas</label>
											<select id='oficina_edit' name='oficina_edit' class="form-control selectpicker" multiple data-actions-box="true" data-selected-text-format="count" style="width: 100%">
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">								
											<label>Perteneciente a:</label>
											<select name="afectadoEdit" id='afectadoEdit' class="form-control select2" required="true" style="width: 100%">

											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Sujeto a fecha de vigencia</label></br>
											<div class="input-group">
												<span class="input-group-addon">
													<input type='checkbox' class='minimal icheckbox_flat-green' id='checkEdit'>
												</span>
												<input data-toggle="tooltip" name="diasAvisoEdit" data-placement="bottom" title="Al digitar un numero, esté contará como días para efectuar aviso de próximo a vencer" type="number" minlength="1" max="500" placeholder="Días para próximo a vencer" id="diasAvisoEdit" class="form-control" disabled="true">
											</div><!-- /input-group -->
										</div>
									</div>
									<!--SE AGREGA 02-10-2019-->
									<div class="col-sm-6">
										<div class="form-group">
											
											<label>Estado tipo documento</label>
											<div class="input-group" >
												<span class="input-group-addon" >
													<input type='checkbox' class='minimal icheckbox_flat-green' id='activo_edit' value='SI' name='activo_edit'>
												</span>
												<input id="texto_activo_edit" value="Activo" class="form-control" readonly="true" />
											</div>

										</div>
									</div>

									<div class="col-sm-12">
										<div class="form-group">
											<label>Textarea</label>
											<textarea class="form-control" name='descripEdit' id='descripEdit' rows="2" placeholder="Descripción, legislación ..."></textarea>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default bg-gray" data-dismiss="modal">Cerrar</button>
							<a type="button" id='btnEdit' class="btn btn-primary bg-navy"><i class="fa pull-left fa-check"></i>Guardar cambios</a>
						</div>
					</div>
				</div>
			</div>


		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<script type="text/javascript">
		$(function(){

			$('.select2').select2();

			$('.selectpicker').selectpicker('refresh');

			$('[data-toggle="tooltip"]').tooltip();

			$('#checkAviso').click(function(){
				if(this.checked){
					$("#diasAviso").prop('disabled', false);
				}else{
					$('#diasAviso').val('');
					$("#diasAviso").prop('disabled', true);
				}
			});
			$('#checkEdit').click(function(){
				if(this.checked){
					$("#diasAvisoEdit").prop('disabled', false);
				}else{
					$('#diasAvisoEdit').val('');
					$("#diasAvisoEdit").prop('disabled', true);
				}
			});

			$("#diasAviso").keypress(function (e){
				var charCode = (e.which) ? e.which : e.keyCode;
				var num=$('#diasAviso').val();
				if (charCode > 31 && (charCode < 48 || charCode > 57 || num.length>2)) {
					return false;
				}
			});
			$("#diasAvisoEdit").keypress(function (e){
				var charCode = (e.which) ? e.which : e.keyCode;
				var num=$('#diasAviso').val();
				if (charCode > 31 && (charCode < 48 || charCode > 57 || num.length>2)) {
					return false;
				}
			});

		})
	</script>

	<script type="text/javascript">
		$(function(){
			var t = $('#tablaDocs').DataTable({
				"columnDefs": [
				{ targets: 'no-sort', orderable: false },
				{ className: "text-center", "targets": [3]},
				{className: "text-right", "targets" : [2]},
				{ "width": "40%", "targets": 0 },
				{ "width": "25%", "targets": 1 },
				{ "width": "15%", "targets": 2 },
				{ "width": "10%", "targets": 2 },
				{ "width": "10%", "targets": 3 }
				],
				"paging": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": false,
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
				jQuery("#tablaDocs_length").addClass('hidden');
				jQuery("#tablaDocs_filter").addClass('hidden');
				jQuery("#tablaDocs_info").addClass('hidden');
				jQuery("#footer-left").text(jQuery("#tablaDocs_info").text());
				jQuery("#tablaDocs_paginate").appendTo(jQuery("#footer-right"));
			});
			$('#buscar').keyup(function(){
				t.search($(this).val()+" "+$('#filtroAfectado').val()).draw() ;
			});
			$('#show_record').change(function() {
				t.page.len($('#show_record').val()).draw();
				jQuery("#footer-left").text(jQuery("#tablaDocs_info").text());
			});
			$('#filtroAfectado').change(function(){
				t.search($(this).val()+" "+$('#buscar').val()).draw();
			});

			cargartabla();
			function cargartabla(){
				t.clear();
				$.getJSON('<?php print site_url()?>/getAllDocs', function (objetos) {
					$.each(objetos.msg, function (i, obj) {
						var vig=0;
						if(obj.RANGO_DIAS_ESTADO!=null){
							vig=obj.RANGO_DIAS_ESTADO;
						}
						t.row.add([obj.NOMBREDOC,
							obj.AFECTADO,
							'<span class="label label-info center-block">'+vig+' Días</span>',
							'<button class="btn btn-sm bg-navy btn-block" id="btedit" data-toggle="tooltip" title="Editar" value="'+obj.ID_TIPO_DOC+'|'+obj.NOMBREDOC+'|'+obj.DESCRIP+'|'+obj.AFECTADO+'|'+obj.RANGO_DIAS_ESTADO+'|'+obj.FECHA_ELIMINACION+'"><i class="fa fa-edit"></i></button>'
							]).draw( true ).node();
						$('[data-toggle="tooltip"]').tooltip();
					});
				});
			}


			$('#btn-add').click(function(){
				$('#btn-add').prop('disabled', true);
				/*se agrega 01-10-2019 documento por oficina*/
				var formulario = new FormData(document.getElementById("formTipoDoc"));
				var selectOficinas   = $('#oficina').val();
				formulario.append('oficinas',selectOficinas);

				var numaviso=$('#diasAviso').val();
				var afectado=$('#afectado').val();
				if($('#checkAviso').prop('checked') & numaviso ==''){
					pf_notify('Error','Ingrese numero de días','danger');
					$('#btn-add').prop('disabled', false);
				}else{
					$.ajax({
						url: '<?php print site_url()?>/addTipoDoc',
						type: 'POST',
						dataType: 'json',
						data: formulario,
						processData: false,
						contentType: false,
						cache: false,
						async: false
					})
					.done(function(data) {
						if(data.status){
							pf_notify('Correcto','Documento agregado exitosamente','success');						
							cargartabla();
							$('#formTipoDoc')[0].reset();
							$('#btn-add').prop('disabled', false);
						}else{
							pf_notify('Error',data.error,'danger');
							$('#btn-add').prop('disabled', false);
						}
					})
					.fail(function() {
						pf_notify('Error','error de servidor, recargar pagina...','danger');	
						$('#btn-add').prop('disabled', false);
					})

				}
			});


			$("body").on("click", "#btedit", function (e) {
				e.preventDefault();
				var datos = $(this).val();
				var fila=datos.split('|');
				$('#codDoc').val(fila[0]);
				$('#nombreDocEdit').val(fila[1]);
				var label=fila[3];
				if(fila[2]=='Sin descripción'){
					$('#descripEdit').val('');
				}else{
					$('#descripEdit').val(fila[2]);
				}
				$('#afectadoEdit').empty();
				var option='';
				if(fila[3]=='Transportista'){
					option='T';
				}else if(fila[3]=='Camion'){
					option='C';
				}else if(fila[3]=='Chofer'){
					option='CH';
				}else if(fila[3]=='Ayudante'){
					option='A';
				}else if (fila[3] == 'Rampla' ) {
					option='R';
				}
				if(!$.isNumeric(fila[4])){
					$("#diasAvisoEdit").prop('disabled', true);
					$('#diasAvisoEdit').val('');
					$("#checkEdit").prop( "checked", false );
				}else{
					$("#diasAvisoEdit").prop('disabled', false);
					$('#diasAvisoEdit').val(fila[4]);
					$("#checkEdit").prop( "checked", true );
				}
				var fila="<option disabled>Seleccionar tipo</option>";
				fila+="<option selected value='"+option+"'>"+label+"</option>";
				fila+="<option value='T'>Transportista</option>";
				fila+="<option value='C'>Camión</option>";
				fila+="<option value='CH'>Chofer</option>";
				fila+="<option value='A'>Ayudante</option>";
				fila+="<option value='R'>Rampla</option>";
				$('#afectadoEdit').append(fila);
				$('#modalEdit').modal('show');
			});


			$('#btnEdit').click(function(e){
				e.preventDefault();
				/*se agrega 01-10-2019 documento por oficina*/
				var formulario 			= new FormData(document.getElementById("formEdit"));
				var selectOficinas   	= $('#oficina_edit').val();
				var numaviso			= $('#diasAvisoEdit').val();
				var afectado 			= $('#afectadoEdit').val();
				formulario.append('oficinas',selectOficinas);
				if($('#checkEdit').prop('checked') & numaviso ==''){
					pf_notify('Error','Ingrese numero de días','danger');
				}else{
					$.ajax({
						url: '<?php print site_url()?>/editTipoDoc',
						type: 'POST',
						dataType: 'json',
						data: formulario,
						processData: false,
						contentType: false,
						cache: false,
						async: false
					})
					.done(function(data) {
						if(data.status){
							pf_notify('Correcto','Documento modificado exitosamente','success');		
							cargartabla();
							$('#modalEdit').modal('hide');
						}else{
							pf_notify('Error',data.error,'danger');
						}
					})
					.fail(function() {
						pf_notify('Error','Error de servidor, recargar pagina...','danger');
					})
				}
			});

		});
	</script>

	<!--SCRIPT NUEVO 30-09-2019-->
	<script type="text/javascript">
		var arreglo_oficina = [];
		$(function(){

			$.post("<?php echo site_url('get_oficinas')?>", {'':''} , function(data) {
				arreglo_oficina = data.getOficinas;
				// console.log(arreglo_oficina);
			},'json');

			$("body").on("click", "#btedit", function (e) {
				e.preventDefault();
				var datos = $(this).val();
				var fila=datos.split('|');
				//Carga oficinas que tenga habilitados ese tipo documento.-
				cargar_select_oficina(fila[0]);
				//se valida estado del documento
				if( fila[5] == 'ACTIVO'){
					$("#activo_edit").prop( "checked", true );
					$('#texto_activo_edit').val('Activo');
				}else{
					$("#activo_edit").prop( "checked", false );
					$('#texto_activo_edit').val('Deshabilitado');
				}
			});

			$('body').on('click','#activo_edit',function(){
				var estado = ($(this).is(':checked') ? 'Activo': 'Deshabilitado');
				$('#texto_activo_edit').val(estado);
			})

		});

		function cargar_select_oficina(id_tipo_documento){
			$('#oficina_edit').empty();
			$.post("<?php echo site_url('get_ofi_doc')?>", {id_tipo_doc : id_tipo_documento} , function(data) {
				$.each(arreglo_oficina, function(index, val) {
					var validador = false;
					$.each( data.oficinas_documento , function(index, el) {
						if(val.CODIGO_OFICINA == el.ID_OFICINA){
							validador = true;
						}
					});
					if (validador) {
						$('#oficina_edit').append('<option selected value="'+val.CODIGO_OFICINA+'" >'+val.NOMBRE_OFICINA+'</option>');
					}else{
						$('#oficina_edit').append('<option value="'+val.CODIGO_OFICINA+'" >'+val.NOMBRE_OFICINA+'</option>');
					}
				});
				$('.selectpicker').selectpicker('refresh');
			},'json');
		}



	</script>