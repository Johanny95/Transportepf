 <!-- Content Wrapper. Contains page content -->
 <?php $trans=$this->session->userdata('transp');?>

 <style type="text/css">
 	.img-perfil{
 		height : 100px !important;
 		width  : 100px !important ;
 		background: transparent !important;
 	}

 	.img-perfil:hover {
 		opacity: 0.8;
 		filter: alpha(opacity=50); /* For IE8 and earlier */
 		cursor:pointer; cursor: hand
 	}


 </style>
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<h1>Flota transportista<small>Documentos Mantenedor</small></h1>
 		<ol class="breadcrumb">
 			<li><a href='<?php echo site_url() ?>'><span class='glyphicon glyphicon-folder-open'></span>Transportista</a></li>
 			<li class='active'><a>Documentos</a></li>
 		</ol>
 	</section>

 	<!-- Main content --> 
 	<section class="content">
 		<!-- Default box -->
 		<div class="box box-primary">
 			<div class="box-header">
 				<div class="form-group col-sm-4">
 					<label for="id_proveedor">Código</label>
 					<input type="input" class="form-control " id="id_proveedor" value="<?php print $trans->ID_PROVEEDOR?>" readonly="true">
 					<input type="input" class="form-control hidden" id="oficina" value="<?php print $trans->OFICINA?>" readonly="true">
 				</div>
 				<div class="form-group col-sm-4">
 					<label>Rut</label>
 					<input type="input" id='rut_prov' name='rut_prov' class="form-control" value="<?php print $trans->RUT_TANSPORTISTA?>" readonly="true">
 				</div>
 				<div class="form-group col-sm-4">
 					<label for="nombre">Razon social</label>
 					<input type="input" class="form-control" value="<?php print $trans->RAZON_SOCIAL?>" readonly="true">
 				</div>

 				<div class="form-group col-sm-4">
 					<label>Ficha transportista</label>
 					<a class="btn btn-default btn-block" id='verFichaTransp' data-toggle="tooltip" data-placement="bottom" title="Ver ficha"><i class="glyphicon glyphicon-list-alt pull-left"></i>Detalle</a>
 				</div>
 				<div class="form-group col-sm-4">
 					<label for="nombre">Fecha ingreso</label>
 					<input type="input" class="form-control" value="<?php print $trans->CREATION_DATE?>" readonly="true">
 				</div>


 				<div class="row">
 					<div class="col-xs-12">
 						<div class="col-md-12">
 							<div class="form-group">
 								<label></label>
 								<a href="javascript:window.history.back();" class="btn btn-default pull-right"><i class="fa fa-reply"></i> Volver atrás</a>
 							</div>
 						</div>

 					</div>
 				</div>
 			</div>

 			<!-- /.box-footer-->
 		</div>
 		<!-- /.box -->
 		<div class="box box-solid">
 			<div class="box-header ui-sortable-handle bg-primary" style="cursor: move;">
 				<i class="fa fa-user" style="color: white;"></i>
 				<h3 class="box-title" style="color: white;">Documentos transportista</h3>

 				<div class="box-tools pull-right">
 					<button type="button" class="btn bg-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
 					</button>
 					<button type="button" class="btn bg-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i>
 					</button>
 				</div>
 			</div>
 			<!-- /.box-header -->
 			<div class="box-body no-padding"><br/>
 				<div class="container-fluid">
 					<div class="row">
 						<div class="col-sm-4">
 							<a id='btNuevoDocTransp' data-toggle="tooltip" data-placement="right" title="Transportista" class="btn btn-primary form-control"><i class="fa fa-upload pull-left"></i>Subir documento</a>
 						</div>
 						<div class="col-sm-12">
 							<div class="row table-responsive no-left-right-margin">
 								<table id='docTransp' class="display table table-hover table-striped">
 									<thead class="">
 										<tr>
 											<td><b>Tipo documento</b></td>
 											<td><b>Estado Aprobacion</b></td>
 											<td><b>Estado Vigencia</b></td>
 											<td><b>Documentos</b></td>
 										</tr>
 									</thead>
 									<tbody id='tdocTransp'></tbody>
 								</table>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 			<!-- /.box-body -->
 			<div class="box-footer text-black">

 			</div>
 			<!--footer box-->
 		</div>
 		<!--CAMION-->
 		<div class="box box-solid">
 			<div class="box-header ui-sortable-handle bg-primary" style="cursor: move;">
 				<i class="fa fa-truck" style="color: white;"></i>
 				<h3 class="box-title" style="color: white;">Documentos camión</h3>

 				<div class="box-tools pull-right">
 					<button type="button" class="btn bg-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
 					</button>
 					<button type="button" class="btn bg-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i>
 					</button>
 				</div>
 			</div>
 			<!-- /.box-header -->
 			<div class="box-body no-padding"><br/>
 				<div class="container-fluid">
 					<div class="row">
 						<div class="col-sm-4">
 							<div class="form-group">
 								<label>Subir nuevo documento</label>
 								<a id='btNuevoDocCamion' data-toggle="tooltip" data-placement="bottom" title="Camión" class="btn btn-primary form-control"><i class="fa fa-upload pull-left"></i>Subir documento</a>
 							</div>	
 						</div>
 						<div class="col-sm-4">
 							<div class="form-group">
 								<label>Patente camión</label>
 								<select class="form-control select2 " id='patenteCamion'>
 								</select>
 							</div>
 						</div>
 						<div class="col-sm-4">
 							<div class="form-group">
 								<label>Ficha camión</label>
 								<a class="btn btn-default btn-block" id='verFichaCamion' data-toggle="tooltip" data-placement="bottom" title="Ver ficha"><i class="glyphicon glyphicon-list-alt pull-left"></i>Detalle camión</a>
 							</div>
 						</div>
 						<div class="col-sm-6 col-sm-offset-4">
 							<div class="table-responsive">
 								<table>
 									<tbody id="tbodyImgCamion">
 									</tbody>
 								</table>
 							</div>
 						</div>
 					</div>
 					<div class="row table-responsive no-left-right-margin">
 						<table id='docCamion' class="table table-hover table-striped">
 							<thead class="">
 								<tr>
 									<td><b>Tipo documento</b></td>
 									<td><b>Estado Aprobacion</b></td>
 									<td><b>Estado Vigencia</b></td>
 									<td><b>Documentos</b></td>
 								</tr>
 							</thead>
 							<tbody id='tbDocCamiones'></tbody>
 						</table>
 					</div>
 				</div>
 			</div>
 			<!-- /.box-body -->
 			<div class="box-footer text-black">

 			</div>
 			<!--footer box-->
 		</div>

 		<?php if ($trans->OFICINA == 50): ?>
 			<!--RAMPLA OFICINAS 50 Y 52-->
 			<div class="box box-solid">
 				<div class="box-header ui-sortable-handle bg-primary" style="cursor: move;">
 					<i class="fa fa-truck" style="color: white;"></i>
 					<h3 class="box-title" style="color: white;">Documentos rampla</h3>

 					<div class="box-tools pull-right">
 						<button type="button" class="btn bg-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
 						</button>
 						<button type="button" class="btn bg-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i>
 						</button>
 					</div>
 				</div>
 				<!-- /.box-header -->
 				<div class="box-body no-padding"><br/>
 					<div class="container-fluid">
 						<div class="row">
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label>Subir nuevo documento</label>
 									<a id='btNuevoDocRampla' data-toggle="tooltip" data-placement="bottom" title="Rampla" class="btn btn-primary form-control"><i class="fa fa-upload pull-left"></i>Subir documento</a>
 								</div>	
 							</div>
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label>Patente rampla</label>
 									<select class="form-control select2 " id='select_rampla'>
 									</select>
 								</div>
 							</div>
 						</div>
 						<div class="row table-responsive no-left-right-margin">
 							<table id='docRampla' class="table table-hover table-striped">
 								<thead class="">
 									<tr>
 										<td><b>Tipo documento</b></td>
 										<td><b>Estado Aprobacion</b></td>
 										<td><b>Estado Vigencia</b></td>
 										<td><b>Documentos</b></td>
 									</tr>
 								</thead>
 								<tbody id='tbDocRampla'></tbody>
 							</table>
 						</div>
 					</div>
 				</div>
 				<!-- /.box-body -->
 				<div class="box-footer text-black">

 				</div>
 				<!--footer box-->
 			</div>

 		<?php endif ?>

 		<!-- CHOFER-->
 		<!-- /.box -->
 		<div class="box box-solid">
 			<div class="box-header ui-sortable-handle bg-primary" style="cursor: move;">
 				<i class="fa fa-user" style="color: white;"></i>
 				<h3 class="box-title" style="color: white;">Documentos chofer</h3>

 				<div class="box-tools pull-right">
 					<button type="button" class="btn bg-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
 					</button>
 					<button type="button" class="btn bg-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i>
 					</button>
 				</div>
 			</div>
 			<!-- /.box-header -->
 			<div class="box-body no-padding"><br/>
 				<div class="container-fluid">
 					<div class="row">
 						<div class="col-sm-3">
 							<div class="form-group">
 								<label>Subir nuevo documento</label>
 								<a id='btNuevoDocChofer' data-toggle="tooltip" data-placement="bottom" title="Chofer" class="btn btn-primary form-control"><i class="fa fa-upload pull-left"></i>Subir documento</a>
 							</div>	
 						</div>
 						<div class="col-sm-4">
 							<div class="form-group">
 								<label>Rut y nombre chofer</label>
 								<select class="form-control select2" id='rut_chofer'>
 								</select>
 							</div>
 						</div>
 						<div class="col-sm-2">
 							<center><img src="<?php echo base_url()?>/fotos/perfil.png" class="imgchange_chofer img-perfil img-circle" id="fotoChofer"></center>
 						</div>
 						<div class="col-sm-3">
 							<div class="form-group">
 								<label>Ficha chofer</label>
 								<a class="btn btn-default btn-block" href="" id='verFichaChofer' data-toggle="tooltip" data-placement="bottom" title="Ver ficha"><i class="glyphicon glyphicon-list-alt pull-left"></i>Detalle chofer</a>
 							</div>
 						</div>
 					</div>
 					<div class="row table-responsive no-left-right-margin">
 						<table id='docChofer' class="table table-responsive table-hover table-striped">
 							<thead class="">
 								<tr>
 									<td><b>Tipo documento</b></td>
 									<td><b>Estado Aprobacion</b></td>
 									<td><b>Estado Vigencia</b></td>
 									<td><b>Documentos</b></td>
 								</tr>
 							</thead>
 							<tbody id='tbChofer'></tbody>
 						</table>
 					</div>
 				</div>
 			</div>
 		</div>

 		<!--MODAL IMAGEN CHOFER -->
 		<div class="modal fade" id="imgModal_chofer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 			<div class="modal-dialog" role="document">
 				<div class="modal-content">
 					<div class="modal-header btn-primary">
 						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 						<h4 class="modal-title" id="myModalLabel">Subir foto del chofer</h4>
 					</div>
 					<div class="modal-body">
 						<form id='formImgChofer' Method='POST' enctype="multipart/form-data">
 							<div class="row">
 								<div class="col-sm-6">
 									<div class="form-group">
 										<label for="documento">Adjuntar archivo</label>
 										<input type="file" id="imgChofer" name='imgChofer' accept="image/png, .jpeg, .jpg, image/gif">
 									</div>
 								</div>
 							</div>
 						</form>
 					</div>
 					<div class="modal-footer">
 						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
 						<a id='btn_addImage_chofer' class="btn btn-primary">Guardar imagen</a>
 					</div>
 				</div>
 			</div>
 		</div>



 		<!--AYUDANTE-->
 		<!-- /.box -->
 		<div class="box box-solid">
 			<div class="box-header ui-sortable-handle bg-primary" style="cursor: move;">
 				<i class="fa fa-users" style="color: white;"></i>
 				<h3 class="box-title" style="color: white;">Documentos ayudante</h3>
 				<div class="box-tools pull-right">
 					<button type="button" class="btn bg-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
 					</button>
 					<button type="button" class="btn bg-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i>
 					</button>
 				</div>
 			</div>
 			<!-- /.box-header -->
 			<div class="box-body no-padding"><br/>
 				<div class="container-fluid">
 					<div class="row">
 						<div class="col-sm-3">
 							<div class="form-group">
 								<label>Subir nuevo documento</label>
 								<a id='btNuevoDocAyudante' data-toggle="tooltip" data-placement="bottom" title="Ayudante" class="btn btn-primary form-control"><i class="fa fa-upload pull-left"></i>Subir documento</a>
 							</div>	
 						</div>
 						<div class="col-sm-4">
 							<div class="form-group">
 								<label>Rut y nombre ayudante</label>
 								<select class="select2 form-control" id='rut_ayudante'>
 								</select>
 							</div>
 						</div>
 						<div class="col-sm-2">
 							<center><img src="<?php echo base_url()?>/fotos/perfil.png" class="imgchange_ayudante img-perfil img-circle" id="fotoAyudante"></center>
 						</div>
 						<div class="col-sm-3">
 							<div class="form-group">
 								<label>Ficha ayudante</label>
 								<a class="btn btn-default btn-block" id='verFichaAyudante' href="" data-toggle="tooltip" data-placement="bottom" title="Ver ficha"><i class="glyphicon glyphicon-list-alt pull-left"></i>Detalle ayudante</a>
 							</div>
 						</div>
 					</div>
 					<div class="row table-responsive no-left-right-margin">
 						<table id='docAyudante' class="table table-responsive table-hover table-striped">
 							<thead class="">
 								<tr>
 									<td><b>Tipo documento</b></td>
 									<td><b>Estado Aprobacion</b></td>
 									<td><b>Estado Vigencia</b></td>
 									<td><b>Documentos</b></td>
 								</tr>
 							</thead>
 							<tbody id='tbAyudante'></tbody>
 						</table>
 					</div>
 				</div>
 			</div>
 		</div>
 		<!-- /.box-body -->
 		<div class="box-footer text-black">

 		</div>
 		<!--footer box-->
 	</div>
 </section>
 <!-- /.content -->
</div>
<!--MODAL SUBIR IMAGEN AYUDANTE-->
<div class="modal fade" id="imgModal_ayudante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header btn-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Subir foto del ayudante</h4>
			</div>
			<div class="modal-body">
				<form id='formImgAyudante' Method='POST' enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="documento">Adjuntar archivo</label>
								<input type="file" id="imgAyudante" name='imgAyudante' accept="image/png, .jpeg, .jpg, image/gif">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<a id='btn_addImage_ayudante' class="btn btn-primary">Guardar imagen</a>
			</div>
		</div>
	</div>
</div>



<!--MODAL SUBIR ARCHIVO TRANSPORTISTA-->
<div class="modal fade" id="modalDocTransp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form Method='POST' enctype="multipart/form-data"  id="formTransp">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Subir documento transportista</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							
							<input type="text" readonly="true" class="form-control hidden" id='codigoTransp' name='codigoTransp'></input>
							<input type="text" readonly="true" class="form-control hidden" id='rutprov' name='rutprov'></input>
							<div class="form-group col-sm-6">
								<label>Tipo de documento</label><br/>
								<select class="form-control select2 col-sm-12" id='tipoDocTransp' name='tipoDocTransp'>
								</select>
							</div>
							<div id='datediv' class="form-group col-sm-6 hidden">
								<label>Fecha de vigencia</label>
								<div class="input-group date" >
									<input id='fechaDocTransp' type="text" class="form-control"  name="fechaDocTransp" class="date" readonly>
									<div class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</div>
								</div>
							</div>
							<diV class='col-sm-6 hidden' id='divCompartido'>
								<div class="form-group">
									<label>Documento compartido</label>
								</div>
								<input type="text" name='docCompartido' class="form-control" id="docCompartido" value='NO'/>
							</diV>
							
							<div class="col-sm-12">
								<div class="form-group">
									<label for="documento">Adjuntar archivo</label>
									<input type="file" id="docTransp" name='docTransp'>
								</div>
							</div>


						</div>
						
						<div class="row">
							<div id='SeleccionPersonal' class="hidden">
								
								<div class="col-sm-6">
									<div class="form-group">
										<label>Chofer</label>
										<select class="selectpicker col-sm-12 form-control" id='selectChofer' name="selectChofer_doc" multiple data-actions-box="true" data-selected-text-format="count">

										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Ayudantes</label>
										<select class="selectpicker col-sm-12 form-control" id='selectAyudante' name="selectAyudante_doc" multiple data-actions-box="true"  data-selected-text-format="count">

										</select>
									</div>
								</div>

							</div>
							<div class="col-sm-12">
								<div id='alertErrorTransp' class="alert alert-danger hidden" role="alert">

								</div>
							</div>
							
						</div>
						

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" id='btaddDocTransp' class="btn btn-primary">Subir</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--MODAL SUBIR ARCHIVO CAMION-->
<div class="modal fade" id="modalDocCamion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form Method='POST' enctype="multipart/form-data" action="<?php echo site_url();?>/addDocCamion" id="formDocCamion">
				<div class="modal-header btn-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Subir documento camion</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="col-sm-12">
							<div id='alertErrorCamion' class="alert alert-danger hidden" role="alert">

							</div>
							<input type="text" readonly="true" class="form-control hidden" id='CodCamion' name='CodCamion'></input>
							<input type="text" readonly="true" class="form-control hidden" id='patenteDocCamion' name='patenteDocCamion'></input>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Tipo de documento</label><br/>
									<select class="form-control select2" id='TipoDocCamion' name='TipoDocCamion'>
									</select>
								</div>
							</div>
							
							<div id='datedivcamion' class="form-group col-sm-6 hidden">
								<label>Fecha de vigencia</label>
								<div class="input-group date" >
									<input id='FechaDocCamion' type="text" class="form-control"  name="FechaDocCamion" class="date" readonly>
									<div class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</div>
								</div>
							</div>	
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="documento">Adjuntar archivo</label>
									<input type="file" id="docCamion" name='docCamion'>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type='button' id='btAddDocCamion' class="btn btn-primary">Subir</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--MODAL SUBIR ARCHIVO CHOFER-->
<div class="modal fade" id="modalDocChofer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form Method='POST' enctype="multipart/form-data" action="<?php echo site_url();?>/addDocChofer" id="formDocChofer">
				<div class="modal-header btn-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Subir documento chofer</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="col-sm-12">
							<div id='alertErrorChofer' class="alert alert-danger hidden" role="alert">
							</div>
							<input type="text" readonly="true" class="form-control hidden" id='codChofer' name='codChofer'></input>
							<input type="text" readonly="true" class="form-control hidden" id='rut_choferDoc' name='rut_choferDoc'></input>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Tipo de documento</label><br/>
									<select class="form-control select2" id='TipoDocChofer' name='TipoDocChofer'>
									</select>
								</div>
							</div>
							
							<div id='datedivchofer' class="form-group col-sm-6 hidden">
								<label>Fecha de vigencia</label>
								<div class="input-group date" >
									<input id='FechaDocChofer' type="text" class="form-control"  name="FechaDocChofer" class="date" readonly>
									<div class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</div>
								</div>
							</div>	
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="documento">Adjuntar archivo</label>
									<input type="file" id="docChofer" name='docChofer'>
								</div>
							</div>
						</div>
						<div class="col-sm-12 hidden" id="divduenno">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="documento">Transportista dueño </label><small> (opcional, solo cuando el chofer es dueño de la empresa)</small><br/>
									<input type='checkbox' data-toggle="tooltip" title="Chofer es dueño de la empresa transportista" class='minimal icheckbox_flat-green' name='checkDuenno' id='checkDuenno' />
									<p>Se debe adjuntar, carnet de identidad en el caso de que el chofer sea el dueño de la empresa transportista</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" id='btAddDocChofer' class="btn btn-primary">Subir</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--MODAL SUBIR ARCHIVO AYUDANTE-->
<div class="modal fade" id="modalDocAyudante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form Method='POST' enctype="multipart/form-data" action="<?php echo site_url();?>/addDocAyudante" id="formDocAyudante">
				<div class="modal-header btn-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Subir documento ayudante</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="col-sm-12">
							<div id='alertErrorAyudante' class="alert alert-danger hidden" role="alert">
							</div>
							<input type="text" readonly="true" class="form-control hidden" id='codAyudante' name='codAyudante'></input>
							<input type="text" readonly="true" class="form-control hidden" id='rut_ayudanteDoc' name='rut_ayudanteDoc'></input>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Tipo de documento</label><br/>
									<select class="form-control select2" id='TipoDocAyudante' name='TipoDocAyudante'>
									</select>
								</div>
							</div>
							
							<div id='datedivayudante' class="form-group col-sm-6 hidden">
								<label>Fecha de vigencia</label>
								<div class="input-group date" >
									<input id='FechaDocAyudante' type="text" class="form-control"  name="FechaDocAyudante" class="date" readonly>
									<div class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</div>
								</div>
							</div>	
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="documento">Adjuntar archivo</label>
									<input type="file" id="docAyudante" name='docAyudante'>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" id='btAddDocAyudante' class="btn btn-primary">Subir</button>
				</div>
			</form>
		</div>
	</div>
</div>



<div class="modal fade bs-example-modal-sm modal_eliminar" id='modal_conf' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header bg-red">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Confirmación</h4>
			</div>
			<div class="container-fluid">
				
				<div class="row">
					<div class="col-sm-12">
						<h5>¿Esta seguro de continuar la eliminación del documento?</h5>
						<input type="text" readonly id="cod_eliminar" class="hidden">
						<input type="text" readonly id="afectado_doc" class="hidden">		
					</div>	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-remove pull-left'></i>Cancelar</button>
					<button type="button" id='bt_eliminar_doc' class="btn btn-primary" ><i class='fa fa-check pull-left'></i>Aceptar</button>		
				</div>			
			</div>
		</div>
	</div>
</div>

<!--MODAL SUBIR ARCHIVO rampla-->
<div class="modal fade" id="modalDocRampla" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form Method='POST' enctype="multipart/form-data" action="<?php echo site_url();?>/addDocRampla" id="formDocRampla">
				<div class="modal-header btn-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Subir documento Rampla</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="col-sm-12">
							<div id='alertErrorRampla' class="alert alert-danger hidden" role="alert">
							</div>
							<input type="text" readonly="true" class="form-control hidden" id='codRampla' name='codRampla'></input>
							<input type="text" readonly="true" class="form-control hidden" id='patente_rampla_Doc' name='patente_rampla_Doc'></input>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Tipo de documento</label><br/>
									<select class="form-control select2" id='TipoDocRampla' name='TipoDocRampla'>
									</select>
								</div>
							</div>
							
							<div id='datedivRampla' class="form-group col-sm-6 hidden">
								<label>Fecha de vigencia</label>
								<div class="input-group date" >
									<input id='FechaDocRampla' type="text" class="form-control"  name="FechaDocRampla" class="date" readonly>
									<div class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</div>
								</div>
							</div>	
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="documento">Adjuntar archivo</label>
									<input type="file" id="docRampla" name='docRampla'>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" id='btAddDocRampla' class="btn btn-primary">Subir</button>
				</div>
			</form>
		</div>
	</div>
</div>




</section>
<!-- /.content -->
</div>


<!-- Estado de documentación aprobaciones-->

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



	<!-- /.content-wrapper -->

	<script type="text/javascript">
		$(function(){

			$('body').on('click','.bt_desc_rechazo',function(){
				var motivo 			= $(this).data('motivo');
				var obs_rechazo 	= $(this).data('obsrechazo');
				var fecha_rechazo   = $(this).data('fechaaprobacion');
				var url 			= $(this).data('url');
				// iframe_rechazo
				$('#motivo_view').val(motivo);
				$('#obsrechazo').val(obs_rechazo);
				$('#fecha_rechazo').val(fecha_rechazo);
				$('#iframe_rechazo').attr('src',url);
				
				$('#modal_info_aprob').modal('show');
			})

			$('[data-toggle="tooltip"]').tooltip();
			$('.date').datepicker({
				autoclose: true,
				format: "dd/mm/yyyy",
				language: "es",
				todayHighlight: true,
				startDate: "today"
			});
			$('#verFichaTransp').click(function(e){
				e.preventDefault();
				var codigo  = $('#id_proveedor').val();
				var oficina = $('#oficina').val();
				var url='<?php print site_url().'/seleccionar'?>';		
				$.post(url, {codigo: codigo,oficina:oficina}, function(data, textStatus, xhr) {
					if(data.msg===false){
						alert('Error de servidor');
					}else{
						window.location = '<?php print site_url()?>' + '/verFicha';
					}
				},'json');
			});
		});
	</script>



	<!--transportista-->
	<script type="text/javascript">
		$(function(){
			var t = $('#docTransp').DataTable({
				"columnDefs": [
				{ targets: 'no-sort', orderable: false },
				{ className: "text-center", "targets": [1,3]},
				{ "width": "35%",  "targets":  0 },
				{ "width": "15%",  "targets":  1 },
				{ "width": "20%",  "targets":  2 },
				{ "width": "30%", "targets":   3 }
				],
				"paging": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
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
				jQuery("#docTransp_length").addClass('hidden');
				jQuery("#docTransp_filter").addClass('hidden');
			});

			cargarDocsTransp();
			function cargarDocsTransp(){
				var url = '<?php print site_url().'/verDocTransp'?>';
				t.clear();
				var codigo=$('#id_proveedor').val();
				$.post(url, {id:codigo}, function(data, textStatus, xhr) {
					if(data.msg===false){
						alert('Error servidor, recargar página');
					}else{
						$.each(data.msg, function (i, obj) {
							var doc 		= '';
							var estado_aprobacion = '';
							var fecha=obj.FECHAVIGENCIA;
							var estado='';
							var ruta_doc="";
							if(obj.PATH_DOC !=null){
								 ruta_doc="<?php print base_url()."doc/"?>"+obj.PATH_DOC;
								//ruta_doc="http://intranet_prod/Transporte_pf/doc/"+obj.PATH_DOC;
							}else{
								ruta_doc=obj.FULL_PATH;
							}
							if(obj.ESTADO.toLowerCase() == 'faltante'){
								doc='<button id="btmodal_transp" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button>  ';
								fecha='No registrada';
								estado="<p class='text-danger'><strong><span class='label center-block label-danger'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
							}else{
								if(obj.FECHAVIGENCIA==null){
									fecha='No aplica'
								}
								var btn='btn-success';
								if(obj.ESTADO.toLowerCase() == 'proximo a vencer'){
									estado="<p class='text-warning'><span class='label center-block label-warning'><strong>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
									btn='btn-warning';
									doc+='<button id="btmodal_transp" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button> ';
								}else{
									estado="<p class='text-success'><strong><span class='label center-block label-success'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
								}

								switch(obj.ESTADO_APROBACION) {
									case 'APROBADO':
									estado_aprobacion = '<button class="btn btn-success btn-sm" data-toggle="tooltip" title="Fecha Aprobacion: '+obj.FECHA_APROBACION+' Aprobado por: '+obj.USUARIO_APROBACION+'"><i class="fa fa-check"></i></button>';
									break;
									case 'RECHAZADO':
									estado_aprobacion = '<button class="btn btn-danger btn-sm bt_desc_rechazo" data-toggle="tooltip" data-url="'+ruta_doc+'"  data-motivo="'+obj.MOTIVO_RECHAZO+'" data-obsrechazo="'+obj.OBSERVACION_RECHAZO+'" data-useraprobacion="'+obj.USUARIO_APROBACION+'" data-fechaaprobacion="'+obj.FECHA_APROBACION+'" title="Fecha rechazo: '+obj.FECHA_APROBACION+' Rechazado por: '+obj.USUARIO_APROBACION+'"><i class="fa fa-close"></i></button>';
									estado="<p class='text-danger'><strong><span class='label center-block label-danger'>Documento Rechazado</span></strong></p>";
									btn='btn-warning';
									doc+='<button id="btmodal_transp" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button> ';
									break;
									default:
									estado_aprobacion = '<button class="btn btn-warning btn-sm" data-toggle="tooltip" title="Documento pendiente de Aprobación"><i class="fa fa-clock-o"></i></button>  ';
								}

							//documento
							doc+='<button class="'+btn+' btn detalle" data-toggle="tooltip" title="Ver documento" value="'+ruta_doc+'" ><i class="fa fa-search"></i></button>  ';
							// fin documento

							doc+='<button value="'+obj.COD_DOC_TRANS+'" class="bt_eliminar_transp btn btn-primary" data-toggle="tooltip" title="Eliminar documento"><i class="fa fa-trash-o"></i></button>  ';
							//doc+='<iframe src="'+ruta_doc+'" style="width:300px; height:300px;" frameborder="0"></iframe>';


						}
						t.row.add([obj.NOMBREDOC,estado_aprobacion , estado, doc]).draw( true );
						$("a.fancybox").fancybox();
						$('[data-toggle="tooltip"]').tooltip();
					})
					}
				},'json');
			}


		// Add event listener for opening and closing details
		$('#docTransp tbody').on('click', '.detalle', function () {
			var tr = $(this).closest('tr');
			var row = t.row( tr );
			if ( row.child.isShown() ) {
            		// This row is already open - close it
            		row.child.hide();
            		tr.removeClass('shown');
            	}
            	else {
            		// Open this row
            		row.child( format($(this).val()) ).show();
            		tr.addClass('shown');
            	}
            });

		function format ( d ) {
   			 	// `d` is the original data object for the row
   			 	return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
   			 	'<tr>'+
   			 	'<td><iframe style="width:850px; height:600px;" frameborder="0" src="'+d+'"></iframe></td>'+
   			 	'</tr>'+
   			 	'</table>';
   			 }

   			 $("body").on("click", "#btmodal_transp", function (e) {
   			 	e.preventDefault();
   			 	var datos = $(this).val();
   			 	selectTrasnportista(datos);
   			 	verificarDependencia(datos);
   			 	$('#alertErrorTransp').removeClass('show');
   			 	$('#alertErrorTransp').addClass('hidden');
   			 	$('#modalDocTransp').modal('show');
   			 });

		//eliminar documentos transportistas
		$("body").on("click", ".bt_eliminar_transp", function (e) {
			var id_documento = $(this).val();
			$('#cod_eliminar').val(id_documento);
			$('#afectado_doc').val('TRANSP');
			$('.modal_eliminar').modal('show');
		});

		$('body').on('click','#bt_eliminar_doc', function(e){
			var id_doc 	=	$('#cod_eliminar').val();
			var afectado=	$('#afectado_doc').val();
			if(afectado == 'TRANSP'){
				eliminar_documento(id_doc,afectado);
			}
		});

		//eliminar documentos desde mantenedor
		function eliminar_documento(codigo_doc, afectado){
			$.ajax({
				url: '<?php print site_url().'/eliminar_documento'?>',
				type: 'POST',
				dataType: 'json',
				data: {codigo_doc: codigo_doc, afectado : afectado},
			}).done(function(msg) {
				if(msg.status == true){
					pf_notify('Documento eliminado','La acción ha sido realizada con exito','success');
					$('.modal_eliminar').modal('hide');
					cargarDocsTransp()
				}else{
					pf_notify('Error',error,'danger');
				}
					//cargarDocsCamion($('#patenteCamion').val());
				}).fail(function() {
					console.log("error");
				}).always(function() {
					console.log("complete");
				});
			}

			var dependencia_var='';
			function verificarDependencia(codigo){
				$.ajax({
					url: '<?php print site_url().'/verDocCompartido' ?>',
					type: 'POST',
					dataType: 'json',
					data: {codigo:codigo},
				})
				.done(function(data) {
					if(data.status){
						$('#docCompartido').val('SI');
						dependencia_var='SI';
						cargarSelectChoferAyudante();
						$('#SeleccionPersonal').removeClass('hidden');
						$('#SeleccionPersonal').addClass('show');
					}else{
						$('#docCompartido').val('NO');
						dependencia_var='NO';
						$('#SeleccionPersonal').removeClass('show');
						$('#SeleccionPersonal').addClass('hidden');
					}	
				})
				.fail(function() {						
					location.reload();
				}).always(function() {
					console.log("complete");
				});
			}

			function cargarSelectChoferAyudante(){
				var id_trans =$('#id_proveedor').val();
				var oficina  =$('#oficina').val();
				$.ajax({
					url: '<?php print site_url().'/getChoferAyudantes'?>',
					type: 'POST',
					dataType: 'json',
					data: {id_proveedor: id_trans, oficina:oficina},
				})
				.done(function(data) {
					$('#selectChofer').empty();
					$('#selectAyudante').empty();
					var filaAyudante='';
					var filaChofer='';
					$.each(data.CHOFER, function(i, obj) {
						filaChofer+='<option value="'+obj.CODCHOFER+'">'+obj.RUTCHOFER+' | '+obj.NOMBRECHOFER+'</option>';
					});
					$.each(data.AYUDANTES, function(i, obj) {
						filaAyudante+='<option value="'+obj.CODCHOFER+'">'+obj.RUTCHOFER+' | '+obj.NOMBRECHOFER+'</option>';
					});
					$('#selectChofer').append(filaChofer);
					$('#selectAyudante').append(filaAyudante);
					$('.selectpicker').selectpicker('refresh');
				})
				.fail(function() {						
					location.reload();
				})
				.always(function() {
					console.log("complete");
				});
			}

			$('#btNuevoDocTransp').click(function(e){
				e.preventDefault();
				selectTrasnportista(-1);
				$('#modalDocTransp').modal('show');
			});
			function selectTrasnportista(activo){
				var url = '<?php print site_url().'/getTiposDoc'?>';
				$('#tipoDocTransp').empty();
				var fila="<option selected disabled>Seleccionar tipo</option>";
				$.getJSON(url, function (objetos) {
					$.each(objetos, function (i, obj) {
						if(activo==-1){
							fila+='<option value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
						}else{
							if(obj.ID_TIPO_DOC==activo){
								fila+='<option selected value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
							}else{
								fila+='<option value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
							}
						}
					});
					$('#tipoDocTransp').append(fila);
					mostrarFechaVigencia();
					$('#codigoTransp').val($('#id_proveedor').val());
					$('#rutprov').val($('#rut_prov').val());
				});
			}

			$("#tipoDocTransp").change(function(){
				mostrarFechaVigencia();
				verificarDependencia($(this).val());
			});

			function mostrarFechaVigencia(){
				var cod =$('#tipoDocTransp').val();			
				var url='<?php print site_url().'/getFechaDoc'?>';
				$.post(url, {id_tipoDoc:cod}, function(data, textStatus, xhr) {
					if(data.msg.VALIDADOR!=-1){
						$('#datediv').removeClass('hidden');
						$('#datediv').addClass('show');
					}else{
						$('#datediv').removeClass('show');
						$('#datediv').addClass('hidden');
						$('#fechaDocTransp').val('');
					}
				},'json');
			}

			$('#btaddDocTransp').click(function(e){			
				$('#btaddDocTransp').prop('disabled', true);
				var cod =$('#tipoDocTransp').val();
				var fecha=$('#fechaDocTransp').val();
				if(cod!=null){
					Pace.track(function(){
						$.post('<?php print site_url().'/getFechaDoc'?>', {id_tipoDoc:cod}, function(data, textStatus, xhr) {
							if(data.msg.VALIDADOR!=-1 && fecha==''){
								$('#alertErrorTransp').removeClass('hidden');
								$('#alertErrorTransp').html('Error, ingrese fecha.').focus();
								$('#alertErrorTransp').addClass('show');							
								$('#btaddDocTransp').prop('disabled', false);
						//alertErrorTransp
					}else{
						var compartido     =$('#docCompartido').val();
						var selectChofer   =$('#selectChofer').val();
						var selectAyudante =$('#selectAyudante').val();
						if(dependencia_var=='SI' && (selectChofer=='' || selectAyudante=='')){
							$('#alertErrorTransp').removeClass('hidden');
							$('#alertErrorTransp').removeClass('alert-success');
							$('#alertErrorTransp').html('<h4>IMPORTANTE!</h4>Esta a punto de subir un documento compartido, se ha detectado que no ha seleccionado chofer o ayudantes.<br/>¿Desea continuar de todas formas?<br/>');
							$('#alertErrorTransp').append('<br/><button id="btn_aceptar_doc" class="btn text-black bg-gray">Aceptar</button>');
							$('#alertErrorTransp').addClass('show');
							$('#alertErrorTransp').addClass('alert-danger');							
							$('#btaddDocTransp').prop('disabled', false);
						}else{
							subirDocMetodo();
						}
					}
				},'json').fail(function() {						
					location.reload();
				}); 
			});
				}else{
					$('#alertErrorTransp').removeClass('hidden');
					$('#alertErrorTransp').removeClass('alert-success');
					$('#alertErrorTransp').html('Seleccionar tipo documento');
					$('#alertErrorTransp').addClass('show');
					$('#alertErrorTransp').addClass('alert-danger');				
					$('#btaddDocTransp').prop('disabled', false);
				}
			});

			$("body").on("click", "#btn_aceptar_doc", function (e) {
				e.preventDefault();
				subirDocMetodo();
			});


			function subirDocMetodo(){			
				var url2           = '<?php echo site_url();?>/addDocTransp';
				var formulario     = new FormData(document.getElementById("formTransp"));
				var selectChofer   = $('#selectChofer').val();
				var selectAyudante = $('#selectAyudante').val();	
				formulario.append('choferes',selectChofer);
				formulario.append('ayudantes',selectAyudante);
				Pace.track(function(){
					$.ajax({
						url: url2,
						type: 'POST',
						data: formulario,
						processData: false,
						contentType: false,
						dataType:'JSON',
						cache: false,
						async: false
					}).done(function(data){
						if(data.status==true){
							$('#modalDocTransp').modal('hide');						
							$('#btaddDocTransp').prop('disabled', false);
							location.reload();
						}else{
							$('#alertErrorTransp').removeClass('hidden');
							$('#alertErrorTransp').removeClass('alert-success');
							$('#alertErrorTransp').html(data.error);
							$('#alertErrorTransp').addClass('show');
							$('#alertErrorTransp').addClass('alert-danger');						
							$('#btaddDocTransp').prop('disabled', false);
						}
					}).fail(function() {						
						location.reload();
					});
				});			
			}


		});
	</script>


	<!--CAMIOOON-->
	<script type="text/javascript">


		$(function(){
			$('#patenteCamion').select2();
			var t = $('#docCamion').DataTable({
				"paging": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"columnDefs": [
				{ targets: 'no-sort', orderable: false },
				{ className: "text-center", "targets": [1,3]},
				{ "width": "35%",  "targets":  0 },
				{ "width": "15%",  "targets":  1 },
				{ "width": "20%",  "targets":  2 },
				{ "width": "30%", "targets":   3 }
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
				jQuery("#docCamion_length").addClass('hidden');
				jQuery("#docCamion_filter").addClass('hidden');
			});

		//cargar patentes
		//patenteCamion
		seletcPatentes();
		function seletcPatentes(){
			var url = '<?php print site_url().'/getPatentes'?>';
			var id_transp=$('#id_proveedor').val();
			console.log(id_transp);
			$('#patenteCamion').empty();
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {id_transp: id_transp},
			}).done(function(data) {
				if(data.length==0){
					var fila="<option selected disabled>Seleccionar patente</option>";
				}else{
					var cod_camion;
					$.each(data, function (i, obj) {
						console.log(data)
						if(i==0){
							fila+='<option value="'+obj.CODCAMION+'" selected>'+obj.PATENTE+' | '+obj.FECHA_INGRESO+'</option>';
							cod_camion=obj.CODCAMION;
							
						}else{
							fila+='<option value="'+obj.CODCAMION+'">'+obj.PATENTE+' | '+obj.FECHA_INGRESO+'</option>';
						}
					});
					cargarDocsCamion(cod_camion);
					cargarImagenesCamion(cod_camion);
				}
				$('#patenteCamion').append(fila);
			}).fail(function() {						
				location.reload();
			});

		}

		$('#verFichaCamion').click(function(){
			var patente=$('#patenteCamion').val();
			var url='<?php print site_url().'/seleccionarCamion'?>';
			if(patente!=null){
				$.post(url, {patente:patente}, function(data) {
					if(data.msg===false){
						alert('Error de servidor');
					}else{
						window.location = '<?php print site_url()?>' + '/cargarFichaDoc';
					}
				},'json').fail(function() {						
					location.reload();
				});
			}else{
				pf_notify("Error","No hay registros de camiones","danger");
			}
		});

		function cargarDocsCamion(camion){
			var url='<?php print site_url()."/getDocsCamiones"?>';
			var oficina = $('#oficina').val();
			t.clear();
			$.post(url, {camion:camion}, function(data) {
				$.each(data, function (i, obj) {
					var doc='';
					var estado_aprobacion = '';
					var fecha=obj.FECHAVIGENCIA;
					var estado='';
					var ruta_doc='';

					if(obj.PATH_DOC !=null){
						ruta_doc="<?php print base_url()."doc/"?>"+obj.PATH_DOC;
						//ruta_doc="http://intranet_prod/Transporte_pf/doc/"+obj.PATH_DOC;
					}else{
						ruta_doc=obj.FULL_PATH;
					}
					if(obj.ESTADO.toLowerCase()=='faltante'){
						doc='<button id="btmodal_camion" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button>  '
						fecha='No registrada';
						estado="<p class='text-danger'><strong><span class='label center-block label-danger'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
					}else{
						if(obj.FECHAVIGENCIA==null){
							fecha='No aplica'
						}
						var btn='btn-success';
						if(obj.ESTADO.toLowerCase()=='proximo a vencer'){
							estado="<p class='text-warning'><strong><span class='label center-block label-warning'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
							btn='btn-warning';
							doc='<button id="btmodal_camion" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button>  ';
						}else{
							estado="<p class='text-success'><strong><span class='label center-block label-success'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
						}


						switch(obj.ESTADO_APROBACION) {
							case 'APROBADO':
							estado_aprobacion = '<button class="btn btn-success btn-sm" data-toggle="tooltip" title="Fecha Aprobacion: '+obj.FECHA_APROBACION+' Aprobado por: '+obj.USUARIO_APROBACION+'"><i class="fa fa-check"></i></button>';
							break;
							case 'RECHAZADO':
							estado_aprobacion = '<button class="btn btn-danger btn-sm bt_desc_rechazo" data-toggle="tooltip" data-url="'+ruta_doc+'"  data-motivo="'+obj.MOTIVO_RECHAZO+'" data-obsrechazo="'+obj.OBSERVACION_RECHAZO+'" data-useraprobacion="'+obj.USUARIO_APROBACION+'" data-fechaaprobacion="'+obj.FECHA_APROBACION+'" title="Fecha rechazo: '+obj.FECHA_APROBACION+' Rechazado por: '+obj.USUARIO_APROBACION+'"><i class="fa fa-close"></i></button>';
							estado="<p class='text-danger'><strong><span class='label center-block label-danger'>Documento Rechazado</span></strong></p>";
							btn='btn-warning';
							doc='<button id="btmodal_camion" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button> ';
							break;
							default:
							estado_aprobacion = '<button class="btn btn-warning btn-sm" data-toggle="tooltip" title="Documento pendiente de Aprobación"><i class="fa fa-clock-o"></i></button>  ';
						}

						//documento
						doc+='<button class="'+btn+' btn detalle" data-toggle="tooltip" title="Ver documento" value="'+ruta_doc+'" ><i class="fa fa-search"></i></button>    ';
						// fin documento

						doc+='<button value="'+obj.COD_DOC_CAMION+'" class="bt_eliminar_camion btn btn-primary" data-toggle="tooltip" title="Eliminar documento"><i class="fa fa-trash-o"></i></button>  ';

					}
					t.row.add([obj.NOMBREDOC,estado_aprobacion,estado,doc]).draw( true );
					$("a.fancybox").fancybox();
					$('[data-toggle="tooltip"]').tooltip();
					
				})
			},'json').fail(function() {						
				location.reload();
			});
		}

			// Add event listener for opening and closing details
			$('#docCamion tbody').on('click', '.detalle', function () {
				var tr = $(this).closest('tr');
				var row = t.row( tr );
				if ( row.child.isShown() ) {
            		// This row is already open - close it
            		row.child.hide();
            		tr.removeClass('shown');
            	}
            	else {
            		// Open this row
            		row.child( format($(this).val()) ).show();
            		tr.addClass('shown');
            	}
            });

			function format ( d ) {
   			 	// `d` is the original data object for the row
   			 	return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
   			 	'<tr>'+
   			 	'<td><iframe style="width:850px; height:600px;" frameborder="0" src="'+d+'"></iframe></td>'+
   			 	'</tr>'+
   			 	'</table>';
   			 }


		//eliminar documentos camion
		$("body").on("click", ".bt_eliminar_camion", function (e) {
			var id_documento = $(this).val();
			$('#cod_eliminar').val(id_documento);
			$('#afectado_doc').val('CAMION');
			$('.modal_eliminar').modal('show');
		});
		
		$('body').on('click','#bt_eliminar_doc', function(e){
			var id_doc 	=	$('#cod_eliminar').val();
			var afectado=	$('#afectado_doc').val();
			if(afectado == 'CAMION'){
				eliminar_documento(id_doc,afectado);
			}
		});

		//eliminar documentos desde mantenedor
		function eliminar_documento(codigo_doc, afectado){
			$.ajax({
				url: '<?php print site_url().'/eliminar_documento'?>',
				type: 'POST',
				dataType: 'json',
				data: {codigo_doc: codigo_doc, afectado : afectado},
			}).done(function(msg) {
				if(msg.status == true){
					pf_notify('Documento eliminado','La acción ha sido realizada con exito','success');
					$('.modal_eliminar').modal('hide');
					cargarDocsCamion($('#patenteCamion').val());
				}else{
					pf_notify('Error',error,'danger');
				}
			}).fail(function() {
				console.log("error");
			}).always(function() {
				console.log("complete");
			});
		}
		

		$("body").on("click", "#btmodal_camion", function (e) {			
			e.preventDefault();
			var datos = $(this).val();
			$('#alertErrorCamion').addClass('hidden');
			$('#alertErrorCamion').removeClass('show');
			selectDocCamion(datos);
			$('#modalDocCamion').modal('show');
		});
		$("#TipoDocCamion").change(function(){
			mostrarFechaVigenciaCamion();
		});
		//Change patente para ver docs del camion seleccionado
		$("#patenteCamion").change(function(){
			cargarDocsCamion($('#patenteCamion').val());
			cargarImagenesCamion($('#patenteCamion').val());
		});

		$('#btNuevoDocCamion').click(function(){
			var cod_camion=$('#patenteCamion').val();
			if(cod_camion!=null){
				selectDocCamion(-1);
				$('#modalDocCamion').modal('show');
			}else{
				pf_notify('Error','No hay registros de camiones con el transportista','danger');				
			}
		});

		function selectDocCamion(activo){
			var url = '<?php print site_url().'/getTiposDocCamion'?>';
			$('#TipoDocCamion').empty();
			var fila="<option selected disabled>Seleccionar tipo</option>";
			$.getJSON(url, function (objetos) {
				$.each(objetos, function (i, obj) {
					if(activo==-1){
						fila+='<option value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
					}else{
						if(obj.ID_TIPO_DOC==activo){
							fila+='<option selected value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
						}else{
							fila+='<option value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
						}
					}
				});
				$('#TipoDocCamion').append(fila);
				mostrarFechaVigenciaCamion();
				$('#CodCamion').val($('#patenteCamion').val());
				var arr = $("#patenteCamion :selected").text().split(' | ');
				$('#patenteDocCamion').val(arr[0]);
			}).fail(function() {						
				location.reload();
			});
		}
		
		function mostrarFechaVigenciaCamion(){
			var cod =$('#TipoDocCamion').val();
			var url='<?php print site_url().'/getFechaDoc'?>';
			$.post(url, {id_tipoDoc:cod}, function(data, textStatus, xhr) {
				if(data.msg.VALIDADOR!=-1){
					$('#datedivcamion').removeClass('hidden');
					$('#datedivcamion').addClass('show');
				}else{
					$('#datedivcamion').removeClass('show');
					$('#datedivcamion').addClass('hidden');
					$('#FechaDocCamion').val('');
				}
			},'json');
		}

		//BOTON SUBIR ARCHIVO CAMION
		$('#btAddDocCamion').click(function(e){			
			$('#btAddDocCamion').prop('disabled', true);
			var cod =$('#TipoDocCamion').val();
			var fecha=$('#FechaDocCamion').val();
			if(cod!=null){
				Pace.track(function(){
					$.post('<?php print site_url().'/getFechaDoc'?>', {id_tipoDoc:cod}, function(data, textStatus, xhr) {
						if(data.msg.VALIDADOR!=-1 && fecha==''){
							$('#alertErrorCamion').removeClass('hidden');
							$('#alertErrorCamion').html('Error, ingrese fecha.').focus();
							$('#alertErrorCamion').addClass('show');
							$('#btAddDocCamion').prop('disabled', false);
						//alertErrorTransp
					}else{
						var url2 = $('#formDocCamion').attr('action');
						$.ajax({
							url: url2,
							type: 'POST',
							dataType:'JSON',
							data: new FormData(document.getElementById("formDocCamion")),
							processData: false,
							contentType: false,
							cache: false,
							async: false
						}).done(function(data){
							if(data.status==true){
								cargarDocsCamion($('#patenteCamion').val());
								$('#fechaDocCamion').val("");
								$('#modalDocCamion').modal('hide');
								$('#formDocCamion')[0].reset();
								$('#alertErrorCamion').addClass('hidden');
								$('#alertErrorCamion').removeClass('show');
								$('#btAddDocCamion').prop('disabled', false);
							}else{
								if(data.error==''){
									$('#alertErrorCamion').removeClass('hidden');
									$('#alertErrorCamion').removeClass('alert-success');
									$('#alertErrorCamion').html('Adjunte archivo...');
									$('#alertErrorCamion').addClass('show');
									$('#alertErrorCamion').addClass('alert-danger');
									$('#btAddDocCamion').prop('disabled', false);
								}else{
									$('#alertErrorCamion').removeClass('hidden');
									$('#alertErrorCamion').removeClass('alert-success');
									$('#alertErrorCamion').html(data.error);
									$('#alertErrorCamion').addClass('show');
									$('#alertErrorCamion').addClass('alert-danger');
									$('#btAddDocCamion').prop('disabled', false);
								}
							}
						}).fail(function() {						
							location.reload();
						});
					}
				},'json').fail(function() {						
					location.reload();
				});
			});
			}else{
				$('#alertErrorCamion').removeClass('hidden');
				$('#alertErrorCamion').removeClass('alert-success');
				$('#alertErrorCamion').html('Seleccionar tipo documento');
				$('#alertErrorCamion').addClass('show');
				$('#alertErrorCamion').addClass('alert-danger');
				$('#btAddDocCamion').prop('disabled', false);
			}
		});

		//carga de fotos en mantenedor de flota
		
		function cargarImagenesCamion(cod_camion){
			var base_url  =  '<?php print base_url()?>';
			$.ajax({
				url: '<?php print site_url()?>/getImg',
				type: 'POST',
				dataType: 'json',
				data: {cod_camion: cod_camion},
			}).done(function(data) {
				$('#tbodyImgCamion').empty();
				var fila='<tr>';
				if(data.length>0){
					var cont=1;
					var prueba = '';
					$.each(data, function(i, obj) {
						var ruta_imagen = "";

						if( isEmpty(obj.PATH_IMG_CAMION) ){
							ruta_imagen = obj.FULL_PATH;
							fila+='<td><img class="camionIMG-mantenedor img-responsive fancybox img-thumbnail" src="'+obj.FULL_PATH+'" href="'+obj.FULL_PATH+'"/></td>';

						}else{
							ruta_imagen = base_url+'imgCamion/'+obj.PATH_IMG_CAMION;
							fila+='<td><img class="camionIMG-mantenedor img-responsive fancybox img-thumbnail" src="'+ruta_imagen+'" href="'+ruta_imagen+'"/></td>';
						}
						
						if(cont==5){
							fila+='</tr>'
							cont=0;
						}
						cont++;
					});
					$('#tbodyImgCamion').append(fila);
				}
				$(".fancybox").fancybox();
			})
		}

		function isEmpty(val){
			return (val === undefined || val == null || val.length <= 0) ? true : false;
		}

	});
</script>

<!--chofer-->
<script type="text/javascript">
	$(function(){
		$('#rut_chofer').select2();
		selectChofer();
		$('body').on('click','.imgchange_chofer',function(){
			$('#imgModal_chofer').modal('show');
		})

		var t = $('#docChofer').DataTable({
			
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-center", "targets": [1,3]},
			{ "width": "35%",  "targets":  0 },
			{ "width": "15%",  "targets":  1 },
			{ "width": "20%",  "targets":  2 },
			{ "width": "30%", "targets":   3 }
			], 
			"paging": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por página",
				"zeroRecords": "Busqueda no encontrada",
				"info": "",
				"infoEmpty": "",
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
			jQuery("#docChofer_length").addClass('hidden');
			jQuery("#docChofer_filter").addClass('hidden');
		});

		function selectChofer(){
			var url = '<?php print site_url().'/getListChofer'?>';
			var id_transp=$('#id_proveedor').val();
			$('#rut_chofer').empty();
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {id_transp: id_transp},
			}).done(function(data) {
				if(data.length==0){
					var fila="<option selected disabled>Seleccionar chofer</option>";
				}else{
					var cod_chofer;
					$.each(data, function (i, obj) {						
						if(i==0){
							fila+='<option value="'+obj.CODCHOFER+'" selected>'+obj.RUTCHOFER+' | '+obj.NOMBRECHOFER+'</option>';
							cod_chofer=obj.CODCHOFER;
						}else{
							fila+='<option value="'+obj.CODCHOFER+'">'+obj.RUTCHOFER+' | '+obj.NOMBRECHOFER+'</option>';
						}
					});
					cargarDocsChofer(cod_chofer);
					cargarFotosChofer(cod_chofer);
				}
				$('#rut_chofer').append(fila);
			}).fail(function() {						
				location.reload();
			});
		}
		//imagen chofer 09-11-2018
		function cargarFotosChofer(cod_chofer){
			var url='<?php print site_url()."/datos_chofer"?>';
			$.post(url, {cod_chofer: cod_chofer}, function(data) {
				if(data.chofer.FOTO != null){
					$('#fotoChofer').attr('src', '<?php echo base_url()?>/fotos/chofer/'+data.chofer.FOTO);
				}else{
					$('#fotoChofer').attr('src', '<?php echo base_url()?>/fotos/perfil.png');
				}
			},'json');
		}

		$('#btn_addImage_chofer').click(function(){
			var url='<?php print site_url().'/addImgChofer'?>';
			var formulario     = new FormData(document.getElementById("formImgChofer"));
			var cod_chofer     = $('#rut_chofer').val();
			formulario.append('img_cod_Chofer',cod_chofer);
			Pace.track(function(){
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
					data: formulario,
					processData: false,
					contentType: false,
					cache: false,
					async: false
				}).done(function(data){
					if(data.status){
						$('#imgModal_chofer').modal('hide');
						cargarFotosChofer(cod_chofer);
						$('#formImgChofer')[0].reset();
					}else{
						pf_notify('Error',data.error,'danger');
					}
				}).fail(function(){
					alert('servidor');
				});
			});
		});

		function cargarDocsChofer(chofer){
			var url='<?php print site_url()."/docsChofer"?>';
			t.clear();
			$.post(url, {cod_chofer:chofer}, function(data) {
				$.each(data, function (i, obj) {
					var doc='', estado_aprobacion = '', fecha=obj.FECHAVIGENCIA, estado='|', ruta_doc='';
					if(obj.PATH_DOC !=null){
						ruta_doc="<?php print base_url()."doc/"?>"+obj.PATH_DOC;
						//ruta_doc="http://intranet_prod/Transporte_pf/doc/"+obj.PATH_DOC;
					}else{
						ruta_doc=obj.FULL_PATH;
					}
					if(obj.ESTADO.toLowerCase()=='faltante'){
						doc='<button id="bt_modalChofer" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button>  '
						fecha='No registrada';
						estado="<p class='text-danger'><strong><span class='label center-block label-danger'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
					}else{
						if(obj.FECHAVIGENCIA==null){
							fecha='No aplica'
						}
						var btn='btn-success';
						if(obj.ESTADO.toLowerCase()=='proximo a vencer'){
							estado="<p class='text-warning'><strong><span class='label center-block label-warning'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
							btn='btn-warning';
							doc='<button id="bt_modalChofer" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button>  ';
						}else{
							estado="<p class='text-success'><strong><span class='label center-block label-success'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
						}

						switch(obj.ESTADO_APROBACION) {
							case 'APROBADO':
							estado_aprobacion = '<button class="btn btn-success btn-sm" data-toggle="tooltip" title="Fecha Aprobacion: '+obj.FECHA_APROBACION+' Aprobado por: '+obj.USUARIO_APROBACION+'"><i class="fa fa-check"></i></button>';
							break;
							case 'RECHAZADO':
							estado_aprobacion = '<button class="btn btn-danger btn-sm bt_desc_rechazo" data-toggle="tooltip" data-url="'+ruta_doc+'"  data-motivo="'+obj.MOTIVO_RECHAZO+'" data-obsrechazo="'+obj.OBSERVACION_RECHAZO+'" data-useraprobacion="'+obj.USUARIO_APROBACION+'" data-fechaaprobacion="'+obj.FECHA_APROBACION+'" title="Fecha rechazo: '+obj.FECHA_APROBACION+' Rechazado por: '+obj.USUARIO_APROBACION+'"><i class="fa fa-close"></i></button>';
							estado="<p class='text-danger'><strong><span class='label center-block label-danger'>Documento Rechazado</span></strong></p>";
							btn='btn-warning';
							doc='<button id="bt_modalChofer" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button> ';
							break;
							default:
							estado_aprobacion = '<button class="btn btn-warning btn-sm" data-toggle="tooltip" title="Documento pendiente de Aprobación"><i class="fa fa-clock-o"></i></button>  ';
						}

						//documento
						doc+='<button class="'+btn+' btn detalle" data-toggle="tooltip" title="Ver documento" value="'+ruta_doc+'" ><i class="fa fa-search"></i></button>    ';
						// fin documento
						doc+='  <button value="'+obj.COD_DOC_CHOFER+'" class="bt_eliminar_chofer btn btn-primary" data-toggle="tooltip" title="Eliminar documento"><i class="fa fa-trash-o"></i></button>  ';
					}
					t.row.add([obj.NOMBREDOC, estado_aprobacion, estado, doc]).nodes().draw( true );
					$("a.fancybox").fancybox();
					$('[data-toggle="tooltip"]').tooltip();
				})

			},'json').fail(function() {						
				pf_notify('Ha Ocurrido un Error...','Se ha producido un error de servidor, favor de comunicarse con departamento de informática','error');
			});
		}

			// Add event listener for opening and closing details
			$('#docChofer tbody').on('click', '.detalle', function () {
				var tr = $(this).closest('tr');
				var row = t.row( tr );
				if ( row.child.isShown() ) {
            		// This row is already open - close it
            		row.child.hide();
            		tr.removeClass('shown');
            	}
            	else {
            		// Open this row
            		row.child( format($(this).val()) ).show();
            		tr.addClass('shown');
            	}
            });

			function format ( d ) {
   			 	// `d` is the original data object for the row
   			 	return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
   			 	'<tr>'+
   			 	'<td><iframe style="width:850px; height:600px;" frameborder="0" src="'+d+'"></iframe></td>'+
   			 	'</tr>'+
   			 	'</table>';
   			 }


		//eliminar documentos chofer
		$("body").on("click", ".bt_eliminar_chofer", function (e) {
			var id_documento = $(this).val();
			$('#cod_eliminar').val(id_documento);
			$('#afectado_doc').val('CHOFER');
			$('.modal_eliminar').modal('show');
		});

		$('body').on('click','#bt_eliminar_doc', function(e){
			var id_doc 	=	$('#cod_eliminar').val();
			var afectado=	$('#afectado_doc').val();
			if(afectado == 'CHOFER'){
				eliminar_documento(id_doc,afectado);
			}
		});

		//eliminar documentos desde mantenedor
		function eliminar_documento(codigo_doc, afectado){
			$.ajax({
				url: '<?php print site_url().'/eliminar_documento'?>',
				type: 'POST',
				dataType: 'json',
				data: {codigo_doc: codigo_doc, afectado : afectado},
			}).done(function(msg) {
				if(msg.status == true){
					pf_notify('Documento eliminado','La acción ha sido realizada con exito','success');
					$('.modal_eliminar').modal('hide');
					cargarDocsChofer($('#rut_chofer').val());
				}else{
					pf_notify('Error',error,'danger');
				}
			}).fail(function() {
				console.log("error");
			}).always(function() {
				console.log("complete");
			});
		}


		$("body").on("click", "#bt_modalChofer", function (e) {
			e.preventDefault();
			var datos = $(this).val();
			selectDocChofer(datos);
			verificarDuenno();
			$('#alertErrorChofer').removeClass('show');
			$('#alertErrorChofer').addClass('hidden');
			$('#modalDocChofer').modal('show');
		});

		$('#btNuevoDocChofer').click(function(){
			var cod_camion=$('#rut_chofer').val();
			verificarDuenno();
			if(cod_camion!=null){
				selectDocChofer(-1);
				$('#modalDocChofer').modal('show');
			}else{
				pf_notify('Error','No hay registros de choferes con el transportista','danger');				
			}
		});

		function verificarDuenno(){
			var cod_chofer= $('#rut_chofer').val();
			var oficina   = $('#oficina').val();			
			$.ajax({
				url: '<?php print site_url()?>/verificarDuenno',
				type: 'POST',
				dataType: 'json',
				data: {'codChofer': cod_chofer,'oficina':oficina},
			})
			.done(function(data) {
				if(data.status){
					$('#checkDuenno').prop('checked',true);				
				}else{
					$('#checkDuenno').prop('checked',false);
				}
			})
			.fail(function() {
				alert('Error, recargar página');
			})
			.always(function() {
				console.log("complete");
			});
			
		}

		function selectDocChofer(activo){
			var url = '<?php print site_url().'/getTiposDocChofer'?>';
			$('#TipoDocChofer').empty();
			var fila="<option selected disabled>Seleccionar tipo</option>";
			$.getJSON(url, function (objetos) {
				$.each(objetos, function (i, obj) {
					if(activo==-1){
						fila+='<option value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
					}else{
						if(obj.ID_TIPO_DOC==activo){
							fila+='<option selected value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
						}else{
							fila+='<option value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
						}
					}
				});
				$('#TipoDocChofer').append(fila);
				mostrarFechaVigenciaChofer();
				$('#codChofer').val($('#rut_chofer').val());
				var arr=$("#rut_chofer :selected").text().split(' ');
				$('#rut_choferDoc').val(arr[0]);
			}).fail(function() {						
				location.reload();
			});;
		}

		function mostrarFechaVigenciaChofer(){
			var cod =$('#TipoDocChofer').val();			
			var url='<?php print site_url().'/getFechaDoc'?>';
			$.post(url, {id_tipoDoc:cod}, function(data, textStatus, xhr) {
				if(cod == 9 || cod==30){
					$('#divduenno').removeClass('hidden');
					$('#divduenno').addClass('show');
				}else{
					$('#divduenno').removeClass('show');
					$('#divduenno').addClass('hidden');
				}
				if(data.msg.VALIDADOR!=-1){
					$('#datedivchofer').removeClass('hidden');
					$('#datedivchofer').addClass('show');
				}else{
					$('#datedivchofer').removeClass('show');
					$('#datedivchofer').addClass('hidden');
					$('#datedivchofer').val('');
				}
			},'json');
		}

		$("#TipoDocChofer").change(function(){
			mostrarFechaVigenciaChofer();
		});

		$("#rut_chofer").change(function(){
			cargarDocsChofer($('#rut_chofer').val());
			cargarFotosChofer($('#rut_chofer').val());//carga fotos
		});

		$('#btAddDocChofer').click(function(e){
			$('#btAddDocChofer').prop('disabled', true);
			var cod        =$('#TipoDocChofer').val();
			var fecha      =$('#FechaDocChofer').val();
			var formulario = new FormData(document.getElementById("formDocChofer"));
			var oficina    = $('#oficina').val();
			var id_proveedor = $('#id_proveedor').val();
			var duenno = 'NO';
			if($('#checkDuenno').prop('checked')){
				duenno = 'SI';
			}
			formulario.append('duenno',duenno);
			formulario.append('oficina',oficina);
			formulario.append('id_proveedor',id_proveedor);
			if(cod!=null){				
				Pace.track(function(){
					$.post('<?php print site_url().'/getFechaDoc'?>', {id_tipoDoc:cod}, function(data, textStatus, xhr) {
						if(data.msg.VALIDADOR!=-1 && fecha==''){
							$('#alertErrorChofer').removeClass('hidden');
							$('#alertErrorChofer').html('Error, ingrese fecha.').focus();
							$('#alertErrorChofer').addClass('show');
							$('#btAddDocChofer').prop('disabled', false);					
						}else{
							var url2 = $('#formDocChofer').attr('action');
							$.ajax({
								url: url2,
								type: 'POST',
								dataType:'JSON',
								data: formulario,
								processData: false,
								contentType: false,
								cache: false,
								async: false
							}).done(function(data){
								if(data.status==true){
									cargarDocsChofer($('#rut_chofer').val());
									$('#modalDocChofer').modal('hide');
									$('#formDocChofer')[0].reset();
									$('#alertErrorChofer').addClass('hidden');
									$('#alertErrorChofer').removeClass('show');
									$('#btAddDocChofer').prop('disabled', false);
								}else{
									if(data.error==''){
										$('#alertErrorChofer').removeClass('hidden');
										$('#alertErrorChofer').removeClass('alert-success');
										$('#alertErrorChofer').html('Adjunte archivo...');
										$('#alertErrorChofer').addClass('show');
										$('#alertErrorChofer').addClass('alert-danger');
										$('#btAddDocChofer').prop('disabled', false);
									}else{
										$('#alertErrorChofer').removeClass('hidden');
										$('#alertErrorChofer').removeClass('alert-success');
										$('#alertErrorChofer').html(data.error);
										$('#alertErrorChofer').addClass('show');
										$('#alertErrorChofer').addClass('alert-danger');
										$('#btAddDocChofer').prop('disabled', false);
									}
								}
							}).fail(function() {						
								location.reload();
							});
						}
					},'json').fail(function() {						
						location.reload();
					});
				});			
			}else{
				$('#alertErrorChofer').removeClass('hidden');
				$('#alertErrorChofer').removeClass('alert-success');
				$('#alertErrorChofer').html('Seleccionar tipo documento');
				$('#alertErrorChofer').addClass('show');
				$('#alertErrorChofer').addClass('alert-danger');
				$('#btAddDocChofer').prop('disabled', false);
			}
		});


		$('#verFichaChofer').click(function(){
			var codigo=$('#rut_chofer').val();
			var url='<?php print site_url().'/ficha_chofer'?>';
			if(codigo!=null){
				$.post(url, {codigo:codigo}, function(data) {
					if(data.msg===false){
						alert('Error de servidor');
					}else{
						window.location = '<?php print site_url()?>' + '/cargarFichaChofer';
					}
				},'json').fail(function() {						
					location.reload();
				});
			}else{
				pf_notify('Error','No hay registros de chofer','danger');
			}
		});

	})
</script>

<!--Ayudantes-->
<script type='text/javascript'>
	$(function(){
		$('#rut_ayudante').select2();
		$('body').on('click','.imgchange_ayudante',function(){
			$('#imgModal_ayudante').modal('show');
		})
		selectAyudante();
		var t = $('#docAyudante').DataTable({
			"order": [],
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-center", "targets": [1,3]},
			{ "width": "35%",  "targets":  0 },
			{ "width": "15%",  "targets":  1 },
			{ "width": "20%",  "targets":  2 },
			{ "width": "30%", "targets":   3 }
			], 
			"paging": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por página",
				"zeroRecords": "Busqueda no encontrada",
				"info": "",
				"infoEmpty": "",
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
			jQuery("#docAyudante_length").addClass('hidden');
			jQuery("#docAyudante_filter").addClass('hidden');
		});


		function selectAyudante(){
			var url = '<?php print site_url().'/getListAyudante'?>';
			var id_transp=$('#id_proveedor').val();
			$('#rut_ayudante').empty();
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {id_transp: id_transp},
			}).done(function(data) {
				if(data.length==0){
					var fila="<option selected disabled>Seleccionar ayudante</option>";
				}else{
					var cod_Ayudante;
					$.each(data, function (i, obj) {
						if(i==0){
							fila+='<option value="'+obj.CODAYUDANTE+'" selected>'+obj.RUTAYUDATE+' | '+obj.NOMBREAYUDANTE+'</option>';
							cod_Ayudante=obj.CODAYUDANTE;
							$("#verFichaAyudante").attr("href", "<?php echo site_url()?>/seleccionarAyudante/"+obj.CODAYUDANTE);
						}else{
							fila+='<option value="'+obj.CODAYUDANTE+'">'+obj.RUTAYUDATE+' | '+obj.NOMBREAYUDANTE+'</option>';
						}
					});
					cargarDocsAyudante(cod_Ayudante);
					cargarFotosAyudantes(cod_Ayudante);
				}
				$('#rut_ayudante').append(fila);
			}).fail(function() {						
				location.reload();
			});
		}

		//imagen chofer 09-11-2018
		function cargarFotosAyudantes(cod_ayudante){
			var url='<?php print site_url()."/datos_ayudante"?>';
			$.post(url, {cod_ayudante: cod_ayudante}, function(data) {
				if(data.ayudante.FOTO != null){
					$('#fotoAyudante').attr('src', '<?php echo base_url()?>/fotos/ayudantes/'+data.ayudante.FOTO);
				}else{
					$('#fotoAyudante').attr('src', '<?php echo base_url()?>/fotos/perfil.png');
				}
			},'json');
		}

		$('#btn_addImage_ayudante').click(function(){
			var url='<?php print site_url().'/addImgAyudante'?>';
			var formulario     = new FormData(document.getElementById("formImgAyudante"));
			var cod_Ayudante    = $('#rut_ayudante').val();
			formulario.append('img_cod_ayudante',cod_Ayudante);
			Pace.track(function(){
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
					data: formulario,
					processData: false,
					contentType: false,
					cache: false,
					async: false
				}).done(function(data){
					if(data.status){
						$('#imgModal_ayudante').modal('hide');
						cargarFotosAyudantes(cod_Ayudante);
						$('#formImgAyudante')[0].reset();
					}else{
						pf_notify('Error',data.error,'danger');
					}
				}).fail(function(){
					alert('servidor');
				});
			});
		});

		function cargarDocsAyudante(ayudante){
			var url='<?php print site_url()."/docsAyudante"?>';
			t.clear();
			$.post(url, {cod_ayudante:ayudante}, function(data) {
				$.each(data, function (i, obj) {
					var doc='', estado_aprobacion = '', fecha=obj.FECHAVIGENCIA, estado='', ruta_doc='';
					if(obj.PATH_DOC !=null){
						ruta_doc="<?php print base_url()."doc/"?>"+obj.PATH_DOC;
						//ruta_doc="http://intranet_prod/Transporte_pf/doc/"+obj.PATH_DOC;
					}else{
						ruta_doc=obj.FULL_PATH;
					}
					if(obj.ESTADO.toLowerCase()=='faltante'){
						doc='<button id="bt_modalAyudante" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload "></i></button> ';
						fecha='No registrada';
						estado="<p class='text-danger'><strong><span class='label center-block label-danger'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
					}else{
						if(obj.FECHAVIGENCIA==null){
							fecha='No aplica'
						}
						var btn='btn-success';
						if(obj.ESTADO.toLowerCase()=='proximo a vencer'){
							estado="<p class='text-warning'><strong><span class='label center-block label-warning'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
							btn='btn-warning';
							doc='<button id="bt_modalAyudante" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button>  ';
						}else{
							estado="<p class='text-success'><strong><span class='label center-block label-success'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
						}
						
						switch(obj.ESTADO_APROBACION) {
							case 'APROBADO':
							estado_aprobacion = '<button class="btn btn-success btn-sm" data-toggle="tooltip" title="Fecha Aprobacion: '+obj.FECHA_APROBACION+' Aprobado por: '+obj.USUARIO_APROBACION+'"><i class="fa fa-check"></i></button>';
							break;
							case 'RECHAZADO':
							estado_aprobacion = '<button class="btn btn-danger btn-sm bt_desc_rechazo" data-toggle="tooltip" data-url="'+ruta_doc+'"  data-motivo="'+obj.MOTIVO_RECHAZO+'" data-obsrechazo="'+obj.OBSERVACION_RECHAZO+'" data-useraprobacion="'+obj.USUARIO_APROBACION+'" data-fechaaprobacion="'+obj.FECHA_APROBACION+'" title="Fecha rechazo: '+obj.FECHA_APROBACION+' Rechazado por: '+obj.USUARIO_APROBACION+'"><i class="fa fa-close"></i></button>';
							estado="<p class='text-danger'><strong><span class='label center-block label-danger'>Documento Rechazado</span></strong></p>";
							btn='btn-warning';
							doc='<button id="bt_modalAyudante" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button> ';
							break;
							default:
							estado_aprobacion = '<button class="btn btn-warning btn-sm" data-toggle="tooltip" title="Documento pendiente de Aprobación"><i class="fa fa-clock-o"></i></button>  ';
						}

						doc+='<button class="'+btn+' btn detalle" data-toggle="tooltip" title="Ver documento" value="'+ruta_doc+'" ><i class="fa fa-search"></i></button>    ';
						// fin documento
						doc+='  <button value="'+obj.COD_DOC_AYUDANTE+'" class="bt_eliminar_ayudante btn btn-primary" data-toggle="tooltip" title="Eliminar documento"><i class="fa fa-trash-o"></i></button>  ';
						
					}
					t.row.add([obj.NOMBREDOC, estado_aprobacion, estado, doc]).draw( true );
					$("a.fancybox").fancybox();
					$('[data-toggle="tooltip"]').tooltip();
				})
			},'json').fail(function() {						
				//
			});
		}

			// Add event listener for opening and closing details
			$('#docAyudante tbody').on('click', '.detalle', function () {
				var tr = $(this).closest('tr');
				var row = t.row( tr );
				if ( row.child.isShown() ) {
            		// This row is already open - close it
            		row.child.hide();
            		tr.removeClass('shown');
            	}
            	else {
            		// Open this row
            		row.child( format($(this).val()) ).show();
            		tr.addClass('shown');
            	}
            });

			function format ( d ) {
   			 	// `d` is the original data object for the row
   			 	return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
   			 	'<tr>'+
   			 	'<td><iframe style="width:850px; height:600px;" frameborder="0" src="'+d+'"></iframe></td>'+
   			 	'</tr>'+
   			 	'</table>';
   			 }

		//eliminar documentos camion
		$("body").on("click", ".bt_eliminar_ayudante", function (e) {
			var id_documento = $(this).val();

			$('#cod_eliminar').val(id_documento);
			$('#afectado_doc').val('AYUDANTE');
			$('.modal_eliminar').modal('show');
		});

		$('body').on('click','#bt_eliminar_doc', function(e){
			var id_doc 	=	$('#cod_eliminar').val();
			var afectado=	$('#afectado_doc').val();
			if(afectado == 'AYUDANTE'){
				eliminar_documento(id_doc,afectado);
			}
		});

		//eliminar documentos desde mantenedor
		function eliminar_documento(codigo_doc, afectado){
			$.ajax({
				url: '<?php print site_url().'/eliminar_documento'?>',
				type: 'POST',
				dataType: 'json',
				data: {codigo_doc: codigo_doc, afectado : afectado},
			}).done(function(msg) {
				if(msg.status == true){
					pf_notify('Documento eliminado','La acción ha sido realizada con exito','success');
					$('.modal_eliminar').modal('hide');
					cargarDocsAyudante($('#rut_ayudante').val());
				}else{
					pf_notify('Error',error,'danger');
				}
			}).fail(function() {
				console.log("error");
			}).always(function() {
				console.log("complete");
			});
		}


		function selectDocAyudante(activo){
			var url = '<?php print site_url().'/getTiposDocAyudante'?>';
			$('#TipoDocAyudante').empty();
			var fila="<option selected disabled>Seleccionar tipo</option>";
			$.getJSON(url, function (objetos) {
				$.each(objetos, function (i, obj) {
					if(activo==-1){
						fila+='<option value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
					}else{
						if(obj.ID_TIPO_DOC==activo){
							fila+='<option selected value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
						}else{
							fila+='<option value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
						}
					}
				});
				$('#TipoDocAyudante').append(fila);
				mostrarFechaVigenciaAyudante();
				$('#codAyudante').val($('#rut_ayudante').val());
				var arr=$("#rut_ayudante :selected").text().split(' ');
				$('#rut_ayudanteDoc').val(arr[0]);
			}).fail(function() {						
				location.reload();
			});
		}

		$("body").on("click", "#bt_modalAyudante", function (e) {
			e.preventDefault();
			var datos = $(this).val();
			selectDocAyudante(datos);			
			$('#alertErrorAyudante').removeClass('show');
			$('#alertErrorAyudante').addClass('hidden');
			$('#modalDocAyudante').modal('show');
		});

		$('#btNuevoDocAyudante').click(function(){
			var ayudante=$('#rut_ayudante').val();
			if(ayudante!=null){
				selectDocAyudante(-1);
				$('#modalDocAyudante').modal('show');
			}else{
				pf_notify('Error','No hay registros de ayudantes con el transportista','danger');				
			}
		});


		function mostrarFechaVigenciaAyudante(){
			var cod =$('#TipoDocAyudante').val();
			var url='<?php print site_url().'/getFechaDoc'?>';
			$.post(url, {id_tipoDoc:cod}, function(data, textStatus, xhr) {
				if(data.msg.VALIDADOR!=-1){
					$('#datedivayudante').removeClass('hidden');
					$('#datedivayudante').addClass('show');
				}else{
					$('#datedivayudante').removeClass('show');
					$('#datedivayudante').addClass('hidden');
					$('#datedivayudante').val('');
				}
			},'json');
		}

		$("#TipoDocAyudante").change(function(){
			mostrarFechaVigenciaAyudante();
		});

		$("#rut_ayudante").change(function(){
			cargarDocsAyudante($('#rut_ayudante').val());
			cargarFotosAyudantes($('#rut_ayudante').val());
			$("#verFichaAyudante").attr("href", "<?php echo site_url()?>/seleccionarAyudante/"+$(this).val());
		});


		$('#btAddDocAyudante').click(function(e){
			$('#btAddDocAyudante').prop('disabled', true);
			var cod =$('#TipoDocAyudante').val();
			var fecha=$('#FechaDocAyudante').val();
			if(cod!=null){
				$.post('<?php print site_url().'/getFechaDoc'?>', {id_tipoDoc:cod}, function(data, textStatus, xhr) {
					if(data.msg.VALIDADOR!=-1 && fecha==''){
						$('#alertErrorAyudante').removeClass('hidden');
						$('#alertErrorAyudante').html('Error, ingrese fecha.').focus();
						$('#alertErrorAyudante').addClass('show');
						$('#btAddDocAyudante').prop('disabled', false);
						//alertErrorTransp
					}else{
						var url2 = $('#formDocAyudante').attr('action');
						Pace.track(function(){
							$.ajax({
								url: url2,
								type: 'POST',
								dataType:'JSON',	
								data: new FormData(document.getElementById("formDocAyudante")),
								processData: false,
								contentType: false,
								cache: false,
								async: false
							}).done(function(data){
								if(data.status==true){
									cargarDocsAyudante($('#rut_ayudante').val());
									$('#fechaDocAyuante').val("");
									$('#cod_ayudante').val("");
									$('#modalDocAyudante').modal('hide');
									$('#formDocAyudante')[0].reset();
									$('#alertErrorAyudante').addClass('hidden');
									$('#alertErrorAyudante').removeClass('show');
									$('#btAddDocAyudante').prop('disabled', false);
								}else{
									if(data.error==''){
										$('#alertErrorAyudante').removeClass('hidden');
										$('#alertErrorAyudante').removeClass('alert-success');
										$('#alertErrorAyudante').html('Adjunte archivo...');
										$('#alertErrorAyudante').addClass('show');
										$('#alertErrorAyudante').addClass('alert-danger');
										$('#btAddDocAyudante').prop('disabled', false);
									}else{
										$('#alertErrorAyudante').removeClass('hidden');
										$('#alertErrorAyudante').removeClass('alert-success');
										$('#alertErrorAyudante').html(data.error);
										$('#alertErrorAyudante').addClass('show');
										$('#alertErrorAyudante').addClass('alert-danger');
										$('#btAddDocAyudante').prop('disabled', false);
									}
								}
							}).fail(function() {						
								location.reload();
							});
						});
					}
				},'json').fail(function() {						
					location.reload();
				});
			}else{
				$('#alertErrorAyudante').removeClass('hidden');
				$('#alertErrorAyudante').removeClass('alert-success');
				$('#alertErrorAyudante').html('Seleccionar tipo documento');
				$('#alertErrorAyudante').addClass('show');
				$('#alertErrorAyudante').addClass('alert-danger');
				$('#btAddDocAyudante').prop('disabled', false);
			}
		});		
	});
</script>


<?php if ($trans->OFICINA == 50): ?>
	<!--SCRIPT mejora flota-->
	<script type="text/javascript">
		$(function(){
			$('#select_rampla').select2();
			var t = $('#docRampla').DataTable({
				"order": [],
				"columnDefs": [
				{ targets: 'no-sort', orderable: false },
				{ className: "text-center", "targets": [1,3]},
				{ "width": "35%",  "targets":  0 },
				{ "width": "15%",  "targets":  1 },
				{ "width": "20%",  "targets":  2 },
				{ "width": "30%", "targets":   3 }
				], 
				"paging": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"language": {
					"lengthMenu": "Mostrar _MENU_ registros por página",
					"zeroRecords": "Busqueda no encontrada",
					"info": "",
					"infoEmpty": "",
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
				jQuery("#docRampla_length").addClass('hidden');
				jQuery("#docRampla_filter").addClass('hidden');
			});

		//getRamplas
		select_rampla();
		function select_rampla(){
			var url = '<?php print site_url().'/getRamplas'?>';
			var id_transp=$('#id_proveedor').val();
			$('#select_rampla').empty();
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {id_transp: id_transp},
			}).done(function(data) {
				if(data.length==0){
					var fila="<option selected disabled>Seleccionar rampla</option>";
				}else{
					var cod_rampla;
					$.each(data, function (i, obj) {
						if(i==0){
							fila+='<option value="'+obj.CODRAMPLA+'" selected>'+obj.PATENTE+' | Fecha ingreso: '+obj.CREATION_DATE+'</option>';
							cod_rampla=obj.CODRAMPLA;
							$("#verFichaRampla").attr("href", "<?php echo site_url()?>/seleccionarRampla/"+obj.CODRAMPLA);
							//$('#fecha_ingreso_rampla').val();
						}else{
							fila+='<option value="'+obj.CODRAMPLA+'">'+obj.PATENTE+' | Fecha ingreso: '+obj.CREATION_DATE+'</option>';
						}
					});
					cargarDocsRampla(cod_rampla);
					//cargarFotosAyudantes(cod_Ayudante);
				}
				$('#select_rampla').append(fila);
			}).fail(function() {						
				//location.reload();
			});
		}

		function cargarDocsRampla(rampla){
			var url='<?php print site_url()."/getDocsRampla"?>';
			t.clear();
			$.post(url, {cod_rampla:rampla}, function(data) {
				$.each(data, function (i, obj) {
					var doc='', estado_aprobacion = '',  fecha = obj.FECHAVIGENCIA, estado='', ruta_doc='';
					if(obj.PATH_DOC !=null){
						ruta_doc="<?php print base_url()."doc/ramplas/"?>"+obj.PATH_DOC;
						//ruta_doc="http://intranet_prod/Transporte_pf/doc/ramplas/"+obj.PATH_DOC;
					}else{
						ruta_doc=obj.FULL_PATH;
					}
					if(obj.ESTADO.toLowerCase()=='faltante'){
						doc='<button id="bt_modalRampla" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload "></i></button> ';
						fecha='No registrada';
						estado="<p class='text-danger'><strong><span class='label center-block label-danger'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
					}else{
						if(obj.FECHAVIGENCIA==null){
							fecha='No aplica'
						}

						var btn='btn-success';
						if(obj.ESTADO.toLowerCase()=='proximo a vencer'){
							estado="<p class='text-warning'><strong><span class='label center-block label-warning'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
							btn='btn-warning';
							doc='<button id="bt_modalRampla" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button>  ';
						}else{
							estado="<p class='text-success'><strong><span class='label center-block label-success'>"+obj.ESTADO+" ("+fecha+")"+"</span></strong></p>";
						}

						switch(obj.ESTADO_APROBACION) {
							case 'APROBADO':
							estado_aprobacion = '<button class="btn btn-success btn-sm" data-toggle="tooltip" title="Fecha Aprobacion: '+obj.FECHA_APROBACION+' Aprobado por: '+obj.USUARIO_APROBACION+'"><i class="fa fa-check"></i></button>';
							break;
							case 'RECHAZADO':
							estado_aprobacion = '<button class="btn btn-danger btn-sm bt_desc_rechazo" data-toggle="tooltip" data-url="'+ruta_doc+'"  data-motivo="'+obj.MOTIVO_RECHAZO+'" data-obsrechazo="'+obj.OBSERVACION_RECHAZO+'" data-useraprobacion="'+obj.USUARIO_APROBACION+'" data-fechaaprobacion="'+obj.FECHA_APROBACION+'" title="Fecha rechazo: '+obj.FECHA_APROBACION+' Rechazado por: '+obj.USUARIO_APROBACION+'"><i class="fa fa-close"></i></button>  ';
							estado="<p class='text-danger'><strong><span class='label center-block label-danger'>Documento Rechazado</span></strong></p>";
							btn='btn-warning';
							doc='<button id="bt_modalRampla" value="'+obj.ID_TIPO_DOC+'" data-toggle="tooltip" title="Subir documento" class="btn btn-danger"><i class="fa fa-upload"></i></button> ';
							break;
							default:
							estado_aprobacion = '<button class="btn btn-warning btn-sm" data-toggle="tooltip" title="Documento pendiente de Aprobación"><i class="fa fa-clock-o"></i></button>  ';
						}

						doc+=' <a class="btn '+btn+' fancybox" target="_blank" rel="ligthbox" data-toggle="tooltip" title="Ver documento" href="'+ruta_doc+'" ><i class="fa fa-search "></i></a>';
						doc+='  <button value="'+obj.COD_DOC_RAMPLA+'" class="bt_eliminar_rampla btn btn-primary" data-toggle="tooltip" title="Eliminar documento"><i class="fa fa-trash-o"></i></button>  ';
					}
					t.row.add([obj.NOMBREDOC,estado_aprobacion,estado,doc]).draw( true );
					$("a.fancybox").fancybox();
					$('[data-toggle="tooltip"]').tooltip();
				})
			},'json').fail(function() {						
				location.reload();
			});
		}

		$("body").on("click", "#bt_modalRampla", function (e) {
			e.preventDefault();
			var datos = $(this).val();
			selectDocRampla(datos);

			$('#alertErrorRampla').removeClass('show');
			$('#alertErrorRampla').addClass('hidden');
			$('#modalDocRampla').modal('show');
		});

		$('#btNuevoDocRampla').click(function(){
			var ayudante=$('#select_rampla').val();
			if(ayudante!=null){
				selectDocRampla(-1);
				$('#modalDocRampla').modal('show');
			}else{
				pf_notify('Error','No hay registros de ayudantes con el transportista','danger');				
			}
		});

		function selectDocRampla(activo){
			var url = '<?php print site_url().'/getTiposDocRampla'?>';
			$('#TipoDocRampla').empty();
			var fila="<option selected disabled>Seleccionar tipo</option>";
			$.getJSON(url, function (objetos) {
				$.each(objetos, function (i, obj) {
					if(activo==-1){
						fila+='<option value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
					}else{
						if(obj.ID_TIPO_DOC==activo){
							fila+='<option selected value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
						}else{
							fila+='<option value="'+obj.ID_TIPO_DOC+'">'+obj.NOMBREDOC+'</option>';
						}
					}
				});
				$('#TipoDocRampla').append(fila);
				mostrarFechaVigenciaRampla();
				$('#codRampla').val($('#select_rampla').val());
				var datos =$("#select_rampla :selected").text().split(' ');
				$('#patente_rampla_Doc').val(datos[0]); //ojitoooo
			}).fail(function() {						
				location.reload();
			});
		}

		function mostrarFechaVigenciaRampla(){
			var cod =$('#TipoDocRampla').val();
			var url='<?php print site_url().'/getFechaDoc'?>';
			$.post(url, {id_tipoDoc:cod}, function(data, textStatus, xhr) {
				if(data.msg.VALIDADOR!=-1){
					$('#datedivRampla').removeClass('hidden');
					$('#datedivRampla').addClass('show');
				}else{
					$('#datedivRampla').removeClass('show');
					$('#datedivRampla').addClass('hidden');
					$('#datedivRampla').val('');
				}
			},'json');
		}

		$("#TipoDocRampla").change(function(){
			mostrarFechaVigenciaRampla();
		});

		$("#select_rampla").change(function(){
			cargarDocsRampla($('#select_rampla').val());
			//$("#verFichaAyudante").attr("href", "<?php echo site_url()?>/seleccionarAyudante/"+$(this).val());
		});

		//eliminar documentos rampla
		$("body").on("click", ".bt_eliminar_rampla", function (e) {
			var id_documento = $(this).val();
			$('#cod_eliminar').val(id_documento);
			$('#afectado_doc').val('RAMPLA');
			$('.modal_eliminar').modal('show');
		});

		$('body').on('click','#bt_eliminar_doc', function(e){
			var id_doc 	=	$('#cod_eliminar').val();
			var afectado=	$('#afectado_doc').val();
			if(afectado == 'RAMPLA'){
				eliminar_documento(id_doc,afectado);
			}
		});

		//eliminar documentos desde mantenedor
		function eliminar_documento(codigo_doc, afectado){
			$.ajax({
				url: '<?php print site_url().'/eliminar_documento'?>',
				type: 'POST',
				dataType: 'json',
				data: {codigo_doc: codigo_doc, afectado : afectado},
			}).done(function(msg) {
				if(msg.status == true){
					pf_notify('Documento eliminado','La acción ha sido realizada con exito','success');
					$('.modal_eliminar').modal('hide');
					cargarDocsRampla($('#select_rampla').val());
				}else{
					pf_notify('Error',error,'danger');
				}
			}).fail(function() {
				console.log("error");
			}).always(function() {
				console.log("complete");
			});
		}

		$('#btAddDocRampla').click(function(e){
			//$('#btAddDocRampla').prop('disabled', true);
			var cod =$('#TipoDocRampla').val();
			var fecha=$('#FechaDocRampla').val();
			if(cod!=null){
				$.post('<?php print site_url().'/getFechaDoc'?>', {id_tipoDoc:cod}, function(data, textStatus, xhr) {
					if(data.msg.VALIDADOR!=-1 && fecha==''){
						$('#alertErrorRampla').removeClass('hidden');
						$('#alertErrorRampla').html('Error, ingrese fecha.').focus();
						$('#alertErrorRampla').addClass('show');
						$('#btAddDocRampla').prop('disabled', false);
						//alertErrorTransp
					}else{
						var url2 = $('#formDocRampla').attr('action');
						Pace.track(function(){
							$.ajax({
								url: url2,
								type: 'POST',
								dataType:'JSON',	
								data: new FormData(document.getElementById("formDocRampla")),
								processData: false,
								contentType: false,
								cache: false,
								async: false
							}).done(function(data){
								if(data.status==true){
									cargarDocsRampla($('#select_rampla').val());
									$('#fechaDoRampla').val("");
									$('#cod_rampla').val("");
									$('#modalDocRampla').modal('hide');
									$('#formDocRampla')[0].reset();
									$('#alertErrorRampla').addClass('hidden');
									$('#alertErrorRampla').removeClass('show');
									$('#btAddDocRampla').prop('disabled', false);
								}else{
									if(data.error==''){
										$('#alertErrorRampla').removeClass('hidden');
										$('#alertErrorRampla').removeClass('alert-success');
										$('#alertErrorRampla').html('Adjunte archivo...');
										$('#alertErrorRampla').addClass('show');
										$('#alertErrorRampla').addClass('alert-danger');
										$('#btAddDocRampla').prop('disabled', false);
									}else{
										$('#alertErrorRampla').removeClass('hidden');
										$('#alertErrorRampla').removeClass('alert-success');
										$('#alertErrorRampla').html(data.error);
										$('#alertErrorRampla').addClass('show');
										$('#alertErrorRampla').addClass('alert-danger');
										$('#btAddDocRampla').prop('disabled', false);
									}
								}
							}).fail(function() {						
								location.reload();
							});
						});
					}
				},'json').fail(function() {						
					location.reload();
				});
			}else{
				$('#alertErrorRampla').removeClass('hidden');
				$('#alertErrorRampla').removeClass('alert-success');
				$('#alertErrorRampla').html('Seleccionar tipo documento');
				$('#alertErrorRampla').addClass('show');
				$('#alertErrorRampla').addClass('alert-danger');
				$('#btAddDocRampla').prop('disabled', false);
			}
		});	


	})
</script>


<?php endif ?>
