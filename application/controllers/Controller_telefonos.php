<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_telefonos extends PF_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->library('user_agent');
		if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 11) {
			redirect(base_url().'index.php/Welcome', 'refresh');
		}else{
			$this->load->model('model_telefonos');
		}
	}

	public function mantenedorTelefono(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$this->load->view('gestionTelefonos/mantenedor_telefonos');
			$this->load->view('template/footer');
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function validarImei(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$imei      = $this->input->post('imei');
				$validador = $this->model_telefonos->validarImei($imei);
				echo json_encode($validador[0]);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function updateTelefono(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$msg['status']="";
				$msg['error']="";
				$this->form_validation->set_rules('imei_edit','IMEI','trim|max_length[18]|required');
				$this->form_validation->set_rules('marca_edit','Marca','max_length[100]|required');
				$this->form_validation->set_rules('modelo_edit','Modelo','max_length[100]|required');
				$this->form_validation->set_rules('desc_edit','Descripcion','max_length[255]|required');
				if($this->form_validation->run()==FALSE){
					$msg['error']  =validation_errors();
					$msg['status'] =FALSE;
				}else{
					$imei          = $this->input->post('imei_edit');
					$marca         = $this->input->post('marca_edit');
					$modelo   	   = $this->input->post('modelo_edit');
					$descripcion   = $this->input->post('desc_edit');
					$user   	   = $this->session->userdata('usuario');
					$id_usuario    = $user[0]['USUID'];
					$res = $this->model_telefonos->updateTelefono($imei,$marca,$modelo,$descripcion,$id_usuario);				
					if($res==TRUE){
						$msg['status']=TRUE;					
					}else{
						$msg['status']=FALSE;
						$msg['error'] ='Error al realizar modificación, recarge página...';
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

	
	

	public function getTablaTelefonos(){
		if($this->session->userdata('usuario')>0){			
			$datos['registros'] = $this->model_telefonos->getTelefonos();
			if(count($datos['registros'])>0){
				$msg['vista']       = $this->load->view('gestionTelefonos/tabla_telefonos',$datos,true);
				$msg['status']		= true;
			}else{					
				$msg['status']      = false;
			}			
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode($msg);
	}



	public function updateEstadoTelefono(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$msg['status']= "";
				$msg['error'] = "";
				$this->form_validation->set_rules('imei_des','IMEI','trim|max_length[15]|required');
				$this->form_validation->set_rules('motivo_des','Marca','max_length[100]|required');
				if($this->form_validation->run()==FALSE){
					$msg['error']  =validation_errors();
					$msg['status'] =FALSE;
				}else{
					$imei   	   = $this->input->post('imei_des');
					$desc   	   = $this->input->post('motivo_des');
					$user   	   = $this->session->userdata('usuario');
					$id_usuario    = $user[0]['USUID'];
					$res  = $this->model_telefonos->updateEstadoTelefono($imei,$desc,$id_usuario);
					if($res==true){
						$msg['status'] = true;							
					}else{
						$msg['status'] = false;
						$msg['error']  = 'No se pudo registrar';	
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

	public function agregarTelefono(){
		if($this->session->userdata('usuario')>0){			
			if($this->input->post()){
				$msg['error'] = "";
				$msg['status']= "";
				$this->form_validation->set_rules('imei','IMEI','trim|max_length[15]|min_length[15]|required');
				$this->form_validation->set_rules('marca','Marca','max_length[100]|required');
				$this->form_validation->set_rules('modelo','Modelo','max_length[100]|required');
				$this->form_validation->set_rules('desc','Descripcion','max_length[255]|required');
				if($this->form_validation->run()==FALSE){
					$msg['error']  =validation_errors();
					$msg['status'] =FALSE;
				}else{
					$imei          = $this->input->post('imei');
					$marca         = $this->input->post('marca');
					$modelo   	   = $this->input->post('modelo');
					$descripcion   = $this->input->post('desc');
					$user   	   = $this->session->userdata('usuario');
					$id_usuario    = $user[0]['USUID'];
					$imei          = str_replace('-', "", $imei);
					$validador     = $this->model_telefonos->validarImei($imei);
					if($validador[0]['VALIDADOR']=='0'){
						$res  = $this->model_telefonos->addTelefono($imei,$marca,$modelo,$descripcion,$id_usuario);
						if($res==true){
							$msg['status'] = true;							
						}else{
							$msg['status'] = false;
							$msg['error']  = 'No se pudo registrar';	
						}
					}else{
						$msg['status']=false;
						$msg['error'] ='El imei ya se encuentra registrado';
					}								
				}
				echo json_encode($msg);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');	
			}	
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');	
		}
	}

	public function get_lista_chofer(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$oficina  = $this->input->post('oficina');
				$res['choferes']      = $this->model_telefonos->getChoferTelefonos($oficina);
				$res['camiones'] 	  = $this->model_telefonos->getcamionesTelefono($oficina);
				echo json_encode($res);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');	
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');	
		}
	}
	

	public function getHistorialFonos(){
		if($this->session->userdata('usuario')>0){
			$imei = $this->input->post('imei');
			$msg['status']=TRUE;
			$msg['data']  = $this->model_telefonos->getHistoFonos($imei);
			echo json_encode($msg);
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');	
		}
	}


}