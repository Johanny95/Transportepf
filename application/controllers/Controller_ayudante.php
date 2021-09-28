<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_ayudante extends PF_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 11) {
			redirect(base_url().'index.php/Welcome', 'refresh');
		}else{
			$this->load->model('model_ayudante');
			$this->load->model('model_transporte');
		}
	}

	public function getTipoDocAyudante(){
		if($this->session->userdata('usuario')>0){
			$datos=$this->model_transporte->tipoDocsTransp('A');
			echo json_encode($datos);
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function getListAyudante(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$id=$this->input->post('id_transp');
				$transp = $this->session->userdata('transp');
				$data=$this->model_ayudante->getListAyudante($id,$transp->OFICINA);
				echo json_encode($data);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function getDocsAyudante(){
		if($this->session->userdata('usuario')>0){

			if($this->input->post()){
				$id_ayudante 	= $this->input->post('cod_ayudante');
				$transp 		= $this->session->userdata('transp');				
				$data 			= $this->model_ayudante->getDocsAyudante($id_ayudante,$transp->OFICINA);
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

	public function datos_ayudante(){
		if($this->session->userdata('usuario')>0){			
			if($this->input->post()){
				$cod  = $this->input->post('cod_ayudante');
				$data = $this->model_ayudante->getAyudante($cod);
				if(count($data[0])>0){
					$msg['status'] = true;
					$msg['ayudante'] = $data[0];
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

	public function verHistAyudante(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$codAyudante=$this->input->post('codAyudante');
				$tipoDoc=$this->input->post('tipoDoc');
				$msg=$this->model_ayudante->getHistDocsAyudante($codAyudante,$tipoDoc);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode(array('msg'=>$msg));
	}

	public function addDocAyudante(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$msg['status']=TRUE;
				$msg['error']='';
				$this->form_validation->set_rules('codAyudante', 'codigo ayudante', 'trim|required');
				$this->form_validation->set_rules('FechaDocAyudante', 'Fecha', 'trim');
				$this->form_validation->set_rules('rut_ayudanteDoc', 'Rut ayudante', 'trim|required');
				$this->form_validation->set_rules('TipoDocAyudante', 'Tipo documento', 'required');
				if($this->form_validation->run()==FALSE){
					$msg['error']=validation_errors();
					$msg['status']=FALSE;
				}else{
					$codAyudante = $this->input->post('codAyudante');
					$fecha       = (string)$this->input->post('FechaDocAyudante');

					$tipoDoc     = $this->input->post('TipoDocAyudante');
					$rutAyudante = $this->input->post('rut_ayudanteDoc');
					$user        = $this->session->userdata('usuario');
					$user_id     = $user[0]['USUID'];
					$pathname    = 'doc/'.$rutAyudante;
					if (!is_dir($pathname)) {
					// die(var_dump($pathname));
						mkdir('doc/'.$rutAyudante);
					}
					$config['upload_path']   = $pathname;
					$config['allowed_types'] = '*';
					$config['max_size']      = 1024*1000;
					$config['file_name']     = $rutAyudante.'_'.date('Y-m-d_h_i_s').'_type_'.$tipoDoc;
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('docAyudante')){
						$doc  = array('upload_data' => $this->upload->data());
						$ruta = $rutAyudante.'/'.$doc['upload_data']['file_name'];
						$fullruta=$doc['upload_data']['full_path'];
						$res  = $this->model_ayudante->addDocAyudante($codAyudante,$tipoDoc,$ruta,$fullruta,$fecha,$user_id);
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



	public function updateAyudante(){
		$msg['status']=TRUE;
		$msg['error']='';
		if($this->input->post()){
			if($this->session->userdata('usuario')>0){
				$this->form_validation->set_rules('cod_ayudante', 'Código', 'trim|required|max_length[9]');
				$this->form_validation->set_rules('direccion', 'Dirección', 'max_length[100]');
				$this->form_validation->set_rules('telefono', 'Telefono', 'trim|max_length[20]');
				$this->form_validation->set_rules('estado', 'estado ayudante', 'trim|max_length[2]');
				if (!empty($correo)) {
					$this->form_validation->set_rules('correo', 'Correo', 'valid_email');
				}
				if($this->form_validation->run()==FALSE){
					$msg['error'] = validation_errors();
					$msg['status']= FALSE;
				}else{
					$cod_ayudante = $this->input->post('cod_ayudante');
					$telefono     = $this->input->post('telefono');
					$direccion    = $this->input->post('direccion');
					$estado       = $this->input->post('estado');
					$correo       = $this->input->post('correo');

					$data = $this->model_ayudante->updateAyudante($cod_ayudante,$telefono,$direccion,$estado,$correo);
					if($data!=false){
						$msg['status']=TRUE;
						$this->session->set_userdata('ayudante',$data[0]);
					}else{
						$msg['status']=FALSE;
					}
				}
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
				$msg['status'] = false;
				$msg['error']  = 'Sesión caducada, porfavor ingresar nuevamente';
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode($msg);
	}

	public function addImgAyudante(){
		if($this->input->post()){
			$this->form_validation->set_rules('img_cod_ayudante', 'Código', 'trim|required');			
			if($this->form_validation->run()==FALSE){
				$msg['error']=validation_errors();
			}else{
				$codigo_ayudante = $this->input->post('img_cod_ayudante');
				$user      = $this->session->userdata('usuario');
				$user_id   = $user[0]['USUID'];
				$pathname  = 'fotos/ayudantes/'.$codigo_ayudante;
				if (!is_dir($pathname)) {
					// die(var_dump($pathname));
					mkdir('fotos/ayudantes/'.$codigo_ayudante);
				}
				$config['upload_path']   = $pathname;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = 1024*1000;
				$config['file_name']     = $codigo_ayudante.'_IMG_'.date('d_m_Y_h_i_s');
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('imgAyudante')) {
					$doc  = array('upload_data' => $this->upload->data());
					$ruta = $codigo_ayudante.'/'.$doc['upload_data']['file_name'];
					$data  = $this->model_ayudante->addImgAyudante($codigo_ayudante,$ruta,$user_id);
					if($data!=false){
						$msg['status']=TRUE;
						$this->session->set_userdata('ayudante',$data[0]);
					}else{
						$msg['status']=FALSE;
					}
				}else{
					$msg['status']=FALSE;
					$msg['error']='Adjunte archivo o de tipo imagen...';
				}
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode($msg);
	}

}