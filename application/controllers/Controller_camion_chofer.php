<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_camion_chofer extends PF_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 11) {
			redirect(base_url().'index.php/Welcome', 'refresh');
		}else{
			$this->load->model('model_informe');
			$this->load->model('model_telefonos');
		}
	}

	public function mantenedorChoferCamion(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$data['getOficinas']= $this->model_informe->get_oficinas();
			$data['telefonos']  = $this->model_telefonos->getTelefonos();
			$this->load->view('gestionTelefonos/mantenedorChoferCamion',$data);
			$this->load->view('template/footer');
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}
	

	public function validar_imei_relacion(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$imei           = $this->input->post('elemento');
				$res  			= $this->model_telefonos->validar_relacion('IMEI',$imei);
				if($res[0]->VALIDADOR>0){
					$data['status']  = FALSE;
				}else{
					$data['status']  = TRUE;
				}
				echo json_encode($data);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function validar_chofer_relacion(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$chofer           = $this->input->post('elemento');				
				$res 			  = $this->model_telefonos->validar_relacion('COD_CHOFER',$chofer);				
				if($res[0]->VALIDADOR>0){
					$data['status']  = FALSE;
				}else{
					$data['status']  = TRUE;
				}
				echo json_encode($data);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}	
	}

	public function validar_camion_relacion(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$codCamion        = $this->input->post('elemento');
				$res 			  = $this->model_telefonos->validar_relacion('CODCAMION',$codCamion);				
				if($res[0]->VALIDADOR>0){
					$data['status']  = FALSE;
				}else{
					$data['status']  = TRUE;
				}
				echo json_encode($data);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}	
	}

	public function validar_numero_relacion(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$numero           = $this->input->post('elemento');
				$res 			  = $this->model_telefonos->validar_relacion('NUM_TELEFONO',$numero);
				//die(var_dump($res));
				if($res[0]->VALIDADOR>0){
					$data['status']  = FALSE;
				}else{
					$data['status']  = TRUE;
				}
				//die(var_dump($data));
				echo json_encode($data);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}		
	}

	public function addRelacion_tel_chof(){
		$msg['status']="";
		$msg['error']="";
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){			
				$this->form_validation->set_rules('telefonos','IMEI','trim|max_length[18]|required');
				$this->form_validation->set_rules('camiones','Camión','max_length[100]|required');
				$this->form_validation->set_rules('choferes','Chofer','max_length[100]|required');
				$this->form_validation->set_rules('oficina','Oficina','max_length[255]|required');
				$this->form_validation->set_rules('patente','Patente','max_length[255]|required');
				$this->form_validation->set_rules('numero','Numero','max_length[13]|required');
				if($this->form_validation->run()==FALSE){
					$msg['error']  =validation_errors();
					$msg['status'] =FALSE;
				}else{
					$imei          = $this->input->post('telefonos');
					$chofer        = $this->input->post('choferes');
					$camion   	   = $this->input->post('camiones');
					$oficina       = $this->input->post('oficina');
					$patente       = $this->input->post('patente');
					$numero        = $this->input->post('numero');
					$user   	   = $this->session->userdata('usuario');
					$id_usuario    = $user[0]['USUID'];
					$pathname  = 'telefonos/'.$imei;
					if (!is_dir($pathname)) {
					// die(var_dump($pathname));
						mkdir('telefonos/'.$imei);
					}
					$config['upload_path']   = $pathname;
					$config['allowed_types'] = '*';
					$config['max_size']      = 1024*1000;
					$config['file_name']     = $imei.'_'.date('Y-m-d_h_i_s').'_'.$chofer.'_'.$patente;
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('docRelacion')){
						$doc  = array('upload_data' => $this->upload->data());
						$ruta = $imei.'/'.$doc['upload_data']['file_name'];						
						$res = $this->model_telefonos->addRelacion($imei,$chofer,$oficina,$camion,$patente,$numero,$ruta,$id_usuario);
						if($res==TRUE){
							$msg['status']=TRUE;
						}else{
							$msg['status']=FALSE;
						}
					}else{
						$msg['status']=FALSE;
						$msg['error'] ='Adjunte documento...';
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

	public function getTablaRelaciones(){
		if($this->session->userdata('usuario')>0){			
			$datos['registros'] = $this->model_telefonos->getRelaciones();
			$datos['oficinas']  = $this->model_informe->get_oficinas();
			if(count($datos['registros'])>0){
				$msg['vista']       = $this->load->view('gestionTelefonos/tabla_relacion',$datos,true);
				$msg['status']		= true;
			}else{					
				$msg['status']      = false;
			}			
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode($msg);
	}

	public function des_telefono_chofer(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$msg['status']="";
				$msg['error']="";
				$this->form_validation->set_rules('imei','IMEI','trim|max_length[18]|required');
				$this->form_validation->set_rules('codchofer','Marca','max_length[100]|required');
				$this->form_validation->set_rules('estado','Modelo','max_length[100]|required');
				$this->form_validation->set_rules('fecha','Descripcion','max_length[255]|required');
				$this->form_validation->set_rules('motivo','Motivo','max_length[255]|required');
				if($this->form_validation->run()==FALSE){
					$msg['error']  =validation_errors();
					$msg['status'] =FALSE;
				}else{
					$imei          = $this->input->post('imei');
					$codchofer     = $this->input->post('codchofer');
					$estado   	   = $this->input->post('estado');
					$fecha         = $this->input->post('fecha');
					$motivo        = $this->input->post('motivo');
					$user   	   = $this->session->userdata('usuario');
					$id_usuario    = $user[0]['USUID'];
					$res = $this->model_telefonos->des_relacion_tel_chof($imei,$codchofer,$estado,$fecha,$motivo,$id_usuario);
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


	public function getHistorialTelefonos(){
		if($this->input->post()){
			$codChofer = $this->input->post('codChofer');
			$msg['status']=TRUE;
			$msg['data']  = $this->model_telefonos->getHistorialTelefonos($codChofer);
			echo json_encode($msg);
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}


}