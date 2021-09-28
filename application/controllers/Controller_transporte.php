<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_transporte extends PF_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		$this->load->library('Pfalimentos');
		
		if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 11) {
			redirect(base_url().'index.php/Welcome', 'refresh');
		}else{
			$this->load->model('model_transporte');
			$this->load->model('model_informe');
		}
	}

	public function dashbord(){
		if($this->session->userdata('usuario')>0){
			$this->menuOficinas();			
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function menuTransportista(){		
		if($this->session->userdata('usuario')>0){
			$data['getOficinas']        = $this->model_informe->get_oficinas();
			$data['transp_lista']       = $this->model_transporte->getTransportistas();
			$this->load->view('template/header');
			$this->load->view('transportistas', $data);
			$this->load->view('template/footer');
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function menuOficinas(){
		if($this->session->userdata('usuario')>0){
			$user= $this->session->userdata('usuario');
			$rol = $this->session->userdata('rol');
			/*Pendiente*/
			$data['getOficinas']        = $this->model_informe->get_oficinas();
			$data['transp_lista']       = $this->model_transporte->getTransportistas();
			$data['oficinas'] 			= $this->model_transporte->getResumenOficina();
			$this->load->view('template/header');

			if (in_array(59, $rol)) { //administrador
				$this->load->view('oficinasResumen',$data);
			}else if (in_array(60, $rol)){ //acceso a modulos de mantencion de documentacion
				$this->load->view('transportistas',$data);
			}else if (in_array(61, $rol)){ //acceso a aprobacion de documentos
				$this->load->view('home/home',$data);
			}else{
				$this->load->view('home/home',$data);
			}
			
			$this->load->view('template/footer');
			
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function seleccionarOficina($id_oficina){
		if($this->session->userdata('usuario')>0){
			$data['oficina']		= $id_oficina;
			$data['getOficinas']	= $this->model_informe->get_oficinas();
			$data['transp_lista']   = $this->model_transporte->getTransportistas();
			// die(var_dump($data));
			$this->load->view('template/header');
			$this->load->view('transportistas',$data);
			$this->load->view('template/footer');
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	/*30-09-2019 se agrega*/
	public function get_oficinas(){
		if($this->session->userdata('usuario')>0){
			$data['getOficinas']=$this->model_informe->get_oficinas();
			echo json_encode($data);
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function get_ofi_doc(){
		if($this->session->userdata('usuario')>0){
			$id_tipo_doc 					= $this->input->post('id_tipo_doc');
			// die(var_dump($id_tipo_doc));
			$array = array();
			$data['oficinas_documento']		= $this->model_transporte->get_oficinas_documento($id_tipo_doc);
			echo json_encode($data);
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}	
	}
	/*30-09-2019 se agrega*/

	public function mantenedorTipoDoc(){
		if($this->session->userdata('usuario')>0){
			$user= $this->session->userdata('usuario');
			$data['getOficinas']        = $this->model_informe->get_oficinas();
			$data['transp_lista']       = $this->model_transporte->getTransportistas();
			if($user[0]['OFICOD']==='ALL'){
				$this->load->view('template/header');
				$this->load->view('tipoDocMantenedor',$data);
				$this->load->view('template/footer');
			}else{
				$this->load->view('template/header');
				$this->load->view('transportistas',$data);
				$this->load->view('template/footer');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}



	public function getAllTipoDocs(){
		if($this->session->userdata('usuario')>0){
			$data=$this->model_transporte->getTiposDocsAll();
			echo json_encode(array('msg'=>$data));
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function addTipoDocumento(){
		$msg['status']=true;
		$msg['error']='';
		if($this->input->post()){
			$this->form_validation->set_rules('nombreDoc', 'Nombre de documento', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('afectado', 'afectado o propietario', 'required|trim|max_length[3]');
			$this->form_validation->set_rules('descrip', 'Descripción', 'required|trim|max_length[255]');
			$this->form_validation->set_rules('diasAviso', 'Numero de dias', 'trim|max_length[3]');
			$this->form_validation->set_rules('oficinas', 'Oficinas', 'required|trim|max_length[1000]');
			if($this->form_validation->run()==FALSE){
				$msg['status']=FALSE;
				$msg['error']=validation_errors();
			}else{
				$nombre     = $this->input->post('nombreDoc');
				$afectado   = $this->input->post('afectado');
				$descrip    = $this->input->post('descrip');
				$diasAviso  = ($this->input->post('diasAviso')==null? '' : $this->input->post('diasAviso'));
				$compartido = ($this->input->post('checkDependencia') == null? 'NO' : $this->input->post('checkDependencia'));
				$user       = $this->session->userdata('usuario');
				$oficinas   = $this->input->post('oficinas');
				// die(var_dump($oficinas));
				if($compartido=='SI' && $afectado=='T'){
					$msg['status']=$this->model_transporte->addTipoDoc($nombre,$afectado,$descrip,$diasAviso,$user[0]['USUID'],$compartido,$oficinas);
				}else if($compartido == 'SI' && $afectado!='T'){
					$msg['status']=false;
					$msg['error']='<p>Solo el transportista podra tener documentos compartidos</p></br>';
				}else{
					$msg['status']=$this->model_transporte->addTipoDoc($nombre,$afectado,$descrip,$diasAviso,$user[0]['USUID'],$compartido,$oficinas);
				}
			}
		}else{
			$msg['status']=false;
		}
		echo json_encode($msg);
	}

	public function editTipoDoc(){
		$msg['status']=true;
		$msg['error']='';
		if($this->input->post()){
			$this->form_validation->set_rules('codDoc' 			, 'codigo documento', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('nombreDocEdit'	, 'Nombre de documento', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('afectadoEdit'	, 'afectado o propietario', 'required|trim|max_length[3]');
			$this->form_validation->set_rules('descripEdit'		, 'Descripción', 'required|trim|max_length[255]');
			$this->form_validation->set_rules('diasAvisoEdit'	, 'Numero de dias', 'trim|max_length[3]');
			$this->form_validation->set_rules('oficinas'		, 'Oficinas' , 'trim|required|max_length[255]');
			if($this->form_validation->run()==FALSE){
				$msg['status']=FALSE;
				$msg['error']=validation_errors();
			}else{
				$cod 		= $this->input->post('codDoc');
				$nombre     = $this->input->post('nombreDocEdit');
				$afectado   = $this->input->post('afectadoEdit');
				$descrip    = $this->input->post('descripEdit');
				$diasAviso  = ($this->input->post('diasAvisoEdit')==null? '' : $this->input->post('diasAvisoEdit'));
				$user       = $this->session->userdata('usuario');
				$oficinas 	= $this->input->post('oficinas');
				$estado     = ($this->input->post('activo_edit') == 'SI' ? 'ACTIVO' : 'DESHABILITADO');
				// die(var_dump($estado));
				$msg['status']=$this->model_transporte->editTipoDoc($cod,$nombre,$afectado,$descrip,$diasAviso,$user[0]['USUID'],$oficinas,$estado);
			}
		}else{
			$msg['status']=false;
		}
		echo json_encode($msg);
	}

	public function insertDocumento(){
		$msg['status']='';
		$msg['error'] ='';
		if($this->session->userdata('usuario') > 0){
			if($this->input->post()){
				$this->form_validation->set_rules('codigoTransp', 'codigo', 'trim|required');
				$this->form_validation->set_rules('fechaDocTransp', 'Fecha', 'trim');
				$this->form_validation->set_rules('rutprov', 'Rut', 'trim|required');
				$this->form_validation->set_rules('tipoDocTransp', 'Tipo documento', 'required');
				if($this->form_validation->run()==FALSE){
					$msg['error']   = validation_errors();
					$msg['status']  = FALSE;
				}else{				
					$transp = $this->session->userdata('transp');
					$cod          = $this->input->post('codigoTransp');
					$fecha        = $this->input->post('fechaDocTransp');
					$tipoDoc      = $this->input->post('tipoDocTransp');
					$rut          = $this->input->post('rutprov');
					$user         = $this->session->userdata('usuario');
					$choferes     = $this->input->post('choferes');
					$ayudantes    = $this->input->post('ayudantes');
				//convertir string en array
					$arrChofer    = explode(',', $choferes);
					$arrAyudantes = explode(',',$ayudantes);
					$user_id=$user[0]['USUID'];
					$pathname = 'doc/'.$rut;
					if (!is_dir($pathname)) {
					// die(var_dump($pathname));
						mkdir('doc/'.$rut);
					} 
					$config['upload_path']   = $pathname;
					$config['allowed_types'] = '*';
					$config['max_size']      = 1024*1000;
					$config['file_name']     = $cod.'_'.date('Y-m-d_h_i_s').'_type_'.$tipoDoc;
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('docTransp')) {
						$doc       = array('upload_data' => $this->upload->data());
						$ruta      = $rut.'/'.$doc['upload_data']['file_name'];
						$fullruta  = $doc['upload_data']['full_path'];
						$res       = $this->model_transporte->addDocTransp($cod,$transp->OFICINA,$tipoDoc,$ruta,$fullruta,$fecha,$user_id,$arrChofer,$arrAyudantes);
						if($res==TRUE){
							$msg['status']=TRUE;
						}else{
							$msg['status']=FALSE;
						}
					}else{
						$msg['status']=FALSE;
						$msg['error'] = 'Adjunte archivo...';
					}
				}
			}else{
				$msg['status']=FALSE;
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			$msg['status']   = FALSE;
			$msg['error']    = 'Sesión caducada, porfavor ingresar nuevamente...';
			//redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode($msg);
	}


	public function docFlota(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			if(count($this->session->userdata('transp'))>0){
				$this->load->view('mantenerDoc');
			}else{
				$this->load->view('transportistas');				
			}
			$this->load->view('template/footer');
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function cargarFlota(){
		if($this->input->post()){
			$id_prov=$this->input->post('codigo');
			$oficina=$this->input->post('oficina');
			$data=$this->model_transporte->getTransp($id_prov , $oficina);			
			$this->session->set_userdata('transp',$data[0]);
			echo json_encode(array('msg'=>TRUE));
		}else{
			echo json_encode(array('msg'=>FALSE));
		}
	}

	public function eliminar_documento(){
		$msg['status']=TRUE;
		$msg['error']='';
		if($this->input->post()){
			if($this->session->userdata('usuario')>0){
				$this->form_validation->set_rules('codigo_doc', 'Código', 'trim|required');
				$this->form_validation->set_rules('afectado', 'Afectado', 'trim|required|max_length[30]');
				if($this->form_validation->run()==FALSE){
					$msg['error'] = validation_errors(); 
					$msg['status']= FALSE;
				}else{
					$codigo_doc = $this->input->post('codigo_doc');
					$afectado 	= $this->input->post('afectado');
					$data = $this->model_transporte->eliminar_documento($codigo_doc,$afectado);
					if($data!=false){
						$msg['status']= TRUE;
					}else{
						$msg['status']= FALSE;
						$msg['error'] = 'Error de base de datos';
					}
				}
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode($msg);
	}

	public function updateTransportista(){
		$msg['status']=TRUE;
		$msg['error']='';
		if($this->input->post()){
			if($this->session->userdata('usuario')>0){
				$this->form_validation->set_rules('id_proveedor', 'Código', 'trim|required|max_length[9]');
				$this->form_validation->set_rules('correo', 'Correo electronico', 'trim|max_length[30]');
				$this->form_validation->set_rules('direccion', 'Dirección', 'max_length[100]');
				$this->form_validation->set_rules('propietario', 'propietario', 'max_length[50]');
				$this->form_validation->set_rules('sitioweb', 'sitioweb', 'max_length[50]');
				$this->form_validation->set_rules('telefono', 'telefono', 'max_length[14]');
				if($this->form_validation->run()==FALSE){
					$msg['error'] = validation_errors(); 
					$msg['status']= FALSE;
				}else{
					$id_proveedor = $this->input->post('id_proveedor');
					$telefono     = $this->input->post('telefono');
					$direccion    = $this->input->post('direccion');
					$correo       = $this->input->post('correo');
					$propietario  = $this->input->post('propietario');
					$sitioweb     = $this->input->post('sitioweb');
					$oficina     = $this->input->post('oficina');					
					$data = $this->model_transporte->updateTransportista($id_proveedor,$telefono,$direccion,$correo,$propietario,$sitioweb,$oficina);
					if($data!=false){
						$msg['status']=TRUE;
						$this->session->set_userdata('transp',$data[0]);
					}else{
						$msg['status']=FALSE;
					}
				}
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode($msg);
	}

	public function getTransportistas(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$datos=$this->model_transporte->getTransportistas();
				echo json_encode($datos);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function getDocs_transp(){
		if($this->session->userdata('usuario')>0){	 		
			if($this->input->post()){
				$cod=$this->input->post('id');
				$transp = $this->session->userdata('transp');
				$data=$this->model_transporte->getDoctransportista($cod,$transp->OFICINA);
				echo json_encode(array('msg'=>$data));
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');		 
		}
	}

	public function getTipoDocTransp(){
		if($this->session->userdata('usuario')>0){
			$datos=$this->model_transporte->tipoDocsTransp('T');
			echo json_encode($datos);			 
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function getValidadorFechaV(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$cod=$this->input->post('id_tipoDoc');
				$data=$this->model_transporte->getValidadorVigencia($cod);
				// die(var_dump($data));
				echo json_encode(array('msg'=>$data[0]));
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}		
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');			
		}
	}

	public function getValidadorCompartido(){
		$msg['status']=true;
		$msg['data']='';
		if($this->input->post()){
			$cod=$this->input->post('codigo');
			$dato=$this->model_transporte->getValidadorDocCompartido($cod);
			if($dato[0]->COMPARTIDO==='SI'){
				$msg['status']=TRUE;
			}else{
				$msg['status']=FALSE;
			}
		}else{
			$msg['status']=false;
		}
		echo json_encode($msg);
	}

	public function getChoferAyudantes(){
		if($this->input->post()){
			$id_transportista= $this->input->post('id_proveedor');
			$oficina         = $this->input->post('oficina');
			$msg=$this->model_transporte->getChoferAyudantes($id_transportista,$oficina);
			$cC=0;
			$cA=0;
			$datos=array();
			foreach ($msg as $key ) {
				if($key->TIPO=='CHOFER'){
					$datos['CHOFER'][$cC]=$key;
					$cC++;
				}else if($key->TIPO=='AYUDANTE'){
					$datos['AYUDANTES'][$cA]=$key;
					$cA++;
				}
			}
			echo json_encode($datos);
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function verFicha(){
		if($this->session->userdata('usuario')){
			$this->load->view('template/header');
			if(count($this->session->userdata('transp'))>0){
				$this->load->view('transportista/fichaTransp');
			}else{
				$this->load->view('transportistas');
			}
			$this->load->view('template/footer');
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function getHistorialTransp(){
		if($this->input->post()){
			$id_prov= $this->input->post('id_prov');
			$tipoDoc= $this->input->post('tipoDoc');
			$transp = $this->session->userdata('transp');
			$msg=$this->model_transporte->getHistDocTransp($id_prov,$transp->OFICINA,$tipoDoc);
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode(array('msg'=>$msg));
	}

	public function getDocData(){
		if($this->input->post()){
			$ruta=$this->input->post('rutas');
			$documents=array();
			foreach ($ruta as $key => $var) {
				$path = 'doc/'.$var;
				$type = pathinfo($path, PATHINFO_EXTENSION);
				$data = file_get_contents($path);
				$base64 =  base64_encode($data);
				$datos['tipo']=$type;
				$datos['dataDoc']=$base64;
				$documents[$key]=$datos;
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode($documents);
	}

	public function get_transportista()
	{
		$data = array('datos' => array(),'error' => '','status' => FALSE);
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('id_oficina', 'Oficina', 'trim|required|callback_check_oficinas');
			if ($this->form_validation->run()) {
				$element = $this->model_transporte->get_transportista($this->input->post('id_oficina'));
				if (!empty($element)) {
					foreach ($element as $value) {
						$data['datos'][] = array(
							'id_proveedor' => $value->ID_PROVEEDOR,
							'rut_tansportista' => $value->RUT_TANSPORTISTA,
							'razon_social' => $value->RAZON_SOCIAL
						);
					}	
				}
				$data['status'] = TRUE;
			} else {
				$data['error'] = validation_errors();
				$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
			}
		}
		$this->output->set_output(json_encode($data));
	}


	public function check_oficinas($oficina)
	{
		$data = $this->model_transporte->check_oficinas($oficina);
		if (!empty($data)) {
			return TRUE;	
		}
		$this->form_validation->set_message('check_oficinas', 'El campo {field} debe ser único.');
		return FALSE;
	}

}
