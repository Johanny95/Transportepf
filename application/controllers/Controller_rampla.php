<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_rampla extends PF_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 11) {
			redirect(base_url().'index.php/Welcome', 'refresh');
		}else{
			$this->load->model('model_rampla');
			$this->load->model('model_transporte');
		}
	}

	public function getTipoDocRampla(){
		if($this->session->userdata('usuario')>0){
			$datos=$this->model_transporte->tipoDocsTransp('R');
			echo json_encode($datos);
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function getListRamplas(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$id=$this->input->post('id_transp');
				$transp = $this->session->userdata('transp');
				$data=$this->model_rampla->get_ramplas($id,$transp->OFICINA);
				echo json_encode($data);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function getDocsRampla(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$id_rampla 		= $this->input->post('cod_rampla');
				$transp 		= $this->session->userdata('transp');
				$data 			= $this->model_rampla->getDocsRampla($id_rampla,$transp->OFICINA);
				echo json_encode($data);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function verFuchaAyudante($codAyudante){
		if($this->session->userdata('usuario')>0){
			$data['getAyudante']=$this->model_ayudante->getAyudante($codAyudante);
			if(count($data['getAyudante']) > 0){
				$this->load->view('template/header');
				$this->load->view('ayudante/ficha_ayudante',$data);
				$this->load->view('template/footer');
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');	
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function datos_rampla(){
		if($this->session->userdata('usuario')>0){			
			if($this->input->post()){
				$cod  = $this->input->post('cod_rampla');
				$data = $this->model_rampla->getRampla($cod);
				if(count($data[0])>0){
					$msg['status'] = true;
					$msg['rampla'] = $data[0];
				}else{
					$msg['status'] = false;
					$msg['error']='No hay datos';
				}
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			$msg['status']=FALSE;
			$msg['error']='Sesión caducada, porfavor ingresar nuevamente';
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode($msg);
	}


	public function addDocRampla(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$msg['status']=TRUE;
				$msg['error']='';
				$this->form_validation->set_rules('codRampla', 'codigo Rampla', 'trim|required');
				$this->form_validation->set_rules('FechaDocRampla', 'Fecha', 'trim');
				$this->form_validation->set_rules('patente_rampla_Doc', 'patente rampla', 'trim|required');
				$this->form_validation->set_rules('TipoDocRampla', 'Tipo documento', 'required');
				if($this->form_validation->run()==FALSE){
					$msg['error']=validation_errors();
					$msg['status']=FALSE;
				}else{
					$cod_rampla 	= $this->input->post('codRampla');
					$fecha      	= (string)$this->input->post('FechaDocRampla');
					$tipoDoc     	= $this->input->post('TipoDocRampla');
					$patente_rampla = $this->input->post('patente_rampla_Doc');
					$user        	= $this->session->userdata('usuario');
					$user_id     	= $user[0]['USUID'];
					$pathname    	= 'doc/ramplas/'.$patente_rampla;
					if (!is_dir($pathname)) {
					// die(var_dump($pathname));
						mkdir('doc/ramplas/'.$patente_rampla);
					}
					$config['upload_path']   = $pathname;
					$config['allowed_types'] = '*';
					$config['max_size']      = 1024*1000;
					$config['file_name']     = $patente_rampla.'_'.date('Y-m-d_h_i_s').'_type_'.$tipoDoc;
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('docRampla')){
						$doc  = array('upload_data' => $this->upload->data());
						$ruta = $patente_rampla.'/'.$doc['upload_data']['file_name'];
						$fullruta=$doc['upload_data']['full_path'];
						$res  = $this->model_rampla->addDocRampla($cod_rampla,$tipoDoc,$ruta,$fullruta,$fecha,$user_id);
						if($res==TRUE){
							$msg['status']=TRUE;
						}else{
							$msg['status']=FALSE;
						}
					}else{
						$msg['status']=FALSE;
					}
				}
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			$msg['status']=FALSE;
			$msg['error']='Sesión caducada, porfavor ingresar nuevamente';
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode($msg);
	}



	

}