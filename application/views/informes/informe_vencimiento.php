<?php $user=$this->session->userdata('usuario');?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Informe<small>Vigencia de documentos</small></h1>
		<ol class="breadcrumb">
			<li><a href='<?php echo site_url().'/index' ?>'><span class='glyphicon glyphicon-list-alt'></span>Informes</a></li>
			<li class='active'><a><span class="fa fa-clock-o"></span> Vencimiento</a></li>
		</ol>

	</section>
	
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Informe documentos</h3>
				<div class="box-tools pull-right">
					<div class="box-tools pull-right">
						<div class="btn-group">
							<a href="javascript:window.history.back();" class="btn btn-box-tool"><i class="fa fa-reply"></i> Volver atrás</a>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
				</div>

			</div>
			<div class="box-body">
				<div class="container-fluid">
					<form id='formulario_informe' Method='POST' enctype="multipart/form-data">
						<div class="row">
							<div class="well well-sm col-sm-6">
								<div class="form-group col-sm-12">
									<label>Fecha a buscar</label>
									<div class="input-group date">
										<input id='fecha' name='fecha' type="text" class="form-control"  name="FechaDocAyudante" readonly>
										<div class="input-group-addon">
											<span class="fa fa-calendar"></span>
										</div>	
									</div>							
								</div>
								<?php if ($user[0]['OFICOD']==='ALL'): ?>
									<div class="form-group col-sm-12">
										<label>Buscar por oficina</label>
										<select id='oficina' name='oficina' class="form-control select2">
											<option value="-1">VER TODOS</option>
											<?php foreach ($getOficinas as $key): ?>
												<?php if ($key->CODIGO_OFICINA == ( !isset($oficina) ? "" : $oficina )) : ?>
													<option  selected="TRUE" value="<?php echo $key->CODIGO_OFICINA?>"><?php echo $key->NOMBRE_OFICINA?></option>
												<?php else: ?>
													<option value="<?php echo $key->CODIGO_OFICINA?>"><?php echo $key->NOMBRE_OFICINA?></option>
												<?php endif ?>
											<?php endforeach ?>
										</select>
									</div>
								<?php else: ?>
									<div class="form-group col-sm-6">
										<label>Oficina</label>
										<input class="form-control" value="<?php print $user[0]['OFICOD']?>" readonly="true" name='oficina' id='oficina'/>	
									</div>
									<div class="form-group col-sm-6"> 
										<label>Nombre Oficina</label>
										<input class="form-control" value="<?php print $user[0]['NOMBRE_OFICINA']?>" readonly="true"/>	
									</div>
								<?php endif ?>
								
								<div class="form-group col-sm-6">
									<label>Busqueda</label>
									<button type="button" class="btn btn-success btn-block" id="bt_buscar"><i class="fa fa-search"></i> Buscar</button>
								</div>
								<div class="form-group col-sm-6">
									<label>Volver</label>										
									<a href="javascript:window.history.back();" class="btn btn-default btn-block"><i class="fa fa-reply"></i> atrás</a>
								</div>
							</div>
						</div>						
					</form>
					<div class="row well well-sm">
						<div class="tabla" id="divTabla">

						</div>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer text-center">

			</div>
		</div>


	</section>
	<!-- /.content -->
</div>

</section>
<!-- /.content -->
</div>

<script type="text/javascript">
	$(function(){
		$('.date').datepicker({
			format: 'dd/mm/yyyy',
			language : 'es'
		});


		$('#bt_buscar').click(function(){
			var fecha=$('#fecha').val();
			$(this).prop('disabled','disabled');
			Pace.track(function(){
				$.ajax({
					url: '<?php print site_url().'/get_informe_vigencia';?>',
					type: 'POST',
					dataType:'JSON',
					data: $('#formulario_informe').serialize()
				}).done(function(data){
					if(data.status){
						$('#divTabla').empty().append(data.vista);
						$('#bt_buscar').prop('disabled' , false);
					}else{
						$('#divTabla').empty();
						$.notify(
							{	icon:"fa fa-ban",
							title: "<strong>Error:</strong> <br/>",
							message: data.error
						},{
							type: "danger",
							showProgressbar: false,
							placement: {
								from: "bottom",
								align: "right"
							},
							delay: 4000,
							timer: 3000,
							animate: {
								enter: 'animated fadeInDown',
								exit: 'animated fadeOutUp'
							}
						});
						$('#bt_buscar').prop('disabled' , false);
					}
				});
			});
		});







	});
</script>