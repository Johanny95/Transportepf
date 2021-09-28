<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_chofer extends PF_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 11) {
			redirect(base_url().'index.php/Welcome', 'refresh');
		}else{
			$this->load->model('model_chofer');
			$this->load->model('model_transporte');
		}
	}

	public function getListChofer(){
		if($this->session->userdata('usuario')>0){			
			if($this->input->post()){
				$id=$this->input->post('id_transp');				
				$transp=$this->session->userdata('transp');
				$data=$this->model_chofer->getListChofer($id,$transp->OFICINA);
				echo json_encode($data);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			$msg['status']=FALSE;
			$msg['error']='Sesión caducada, porfavor ingresar nuevamente';
			redirect(base_url().'index.php/sin_acceso', 'refresh');
			echo json_encode($msg);			
		}
	}

	public function fichaChofer(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			if(count($this->session->userdata('chofer'))>0){
				$this->load->view('chofer/fichaChofer');
			}else{
				$this->load->view('transportistas');
			}
			$this->load->view('template/footer');
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function updateChofer(){
		if($this->session->userdata('usuario')>0){
			$msg['status']=TRUE;
			$msg['error']='';
			if($this->input->post()){
				$this->form_validation->set_rules('cod_chofer', 'codigo', 'trim|required|max_length[9]');
				$this->form_validation->set_rules('telefono', 'telefono', 'trim|max_length[13]');
				$this->form_validation->set_rules('licencia', 'Licencia', 'trim|max_length[20]');
				$this->form_validation->set_rules('estado', 'estado chofer', 'trim|max_length[2]');
				$correo = $this->input->post('correo');
				
				if (!empty($correo)) {
					$this->form_validation->set_rules('correo', 'Correo', 'valid_email');
				}

				if($this->form_validation->run()==FALSE){
					$msg['error'] = validation_errors();
					$msg['status']= FALSE;
				}else{
					$cod_chofer   = $this->input->post('cod_chofer');
					$telefono     = $this->input->post('telefono');
					$licencia     = $this->input->post('licencia');
					$estadoChofer = $this->input->post('estado');
					$correo       = $this->input->post('correo');

					$data = $this->model_chofer->updateChofer($cod_chofer,$telefono,$licencia,$estadoChofer, $correo);
					if($data!=false){
						$msg['status']=TRUE;
						$this->session->set_userdata('chofer',$data[0]);
					}else{
						$msg['status']=FALSE;
					}
				}
			}else{
				$msg['status']=FALSE;
			}
		}else{
			$msg['status']=FALSE;
			$msg['error']='Sesión caducada, porfavor ingresar nuevamente';
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode($msg);
	}

	public function verFichaChofer(){
		if($this->session->userdata('usuario')>0){			
			if($this->input->post()){
				$cod=$this->input->post('codigo');
				$data=$this->model_chofer->getChofer($cod);
				// die(var_dump($data));
				$this->session->set_userdata('chofer',$data[0]);
				if(count($data[0])>0){
					echo json_encode(array('msg'=>TRUE));
				}else{
					echo json_encode(array('msg'=>FALSE));
				}
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			$msg['status']=FALSE;
			$msg['error']='Sesión caducada, porfavor ingresar nuevamente';
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function datos_chofer(){
		if($this->session->userdata('usuario') > 0){			
			if($this->input->post()){
				$cod  = $this->input->post('cod_chofer');
				$data = $this->model_chofer->getChofer($cod);
				if(count($data[0])>0){
					$msg['status'] = true;
					$msg['chofer'] = $data[0];
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

	public function verHistChofer(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$codChofer  =$this->input->post('codChofer');
				$tipoDoc    =$this->input->post('tipoDoc');
				$msg        =$this->model_chofer->getHistDocsChofer($codChofer,$tipoDoc);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			$msg['status']=FALSE;
			$msg['error']='Sesión caducada, porfavor ingresar nuevamente';
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode(array('msg'=>$msg));
	}

	public function docsChofer(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$id_chofer 	= $this->input->post('cod_chofer');
				$transp = $this->session->userdata('transp');//se agrega 08-10-2019
				$data 		= $this->model_chofer->getDocsChofer($id_chofer,$transp->OFICINA);

				echo json_encode($data);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			$msg['status']=FALSE;
			$msg['error']='Sesión caducada, porfavor ingresar nuevamente';
			redirect(base_url().'index.php/sin_acceso', 'refresh');
			echo json_encode($msg);
		}		
	}

	public function getTipoDocChofer(){
		if($this->session->userdata('usuario')>0){
			$datos=$this->model_transporte->tipoDocsTransp('CH');
			echo json_encode($datos);
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function insertDocChofer(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$msg['status']=TRUE;
				$msg['error']='';
				$this->form_validation->set_rules('codChofer', 'codigo chofer', 'trim|required');
				$this->form_validation->set_rules('FechaDocChofer', 'Fecha', 'trim');
				$this->form_validation->set_rules('rut_choferDoc', 'Rut chofer', 'trim|required');
				$this->form_validation->set_rules('TipoDocChofer', 'Tipo documento', 'required');
				if($this->form_validation->run()==FALSE){
					$msg['error']=validation_errors();
					$msg['status']=FALSE;
				}else{
					$codChofer   = $this->input->post('codChofer');
					$fecha       = $this->input->post('FechaDocChofer');
					$tipoDoc     = $this->input->post('TipoDocChofer');
					$rutChofer   = $this->input->post('rut_choferDoc');
					$user        = $this->session->userdata('usuario');
					$duenno      = $this->input->post('duenno');
					$oficina     = $this->input->post('oficina');
					$id_proveedor= $this->input->post('id_proveedor');
					$user_id   = $user[0]['USUID'];
					$pathname  = 'doc/'.$rutChofer;
					if (!is_dir($pathname)) {
					// die(var_dump($pathname));
						mkdir('doc/'.$rutChofer);
					}
					$config['upload_path']   = $pathname;
					$config['allowed_types'] = '*';
					$config['max_size']      = 1024*1000;
					$config['file_name']     = $rutChofer.'_'.date('Y-m-d_h_i_s').'_type_'.$tipoDoc;
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('docChofer')){
						$doc  = array('upload_data' => $this->upload->data());
						$ruta = $rutChofer.'/'.$doc['upload_data']['file_name'];
						$fullruta=$doc['upload_data']['full_path'];
						$res  = $this->model_chofer->addDocChofer($codChofer,$tipoDoc,$ruta,$fullruta,$fecha,$user_id,$duenno,$id_proveedor,$oficina);
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

	public function verificarDuenno(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$oficina   = $this->input->post('oficina');
				$codChofer = $this->input->post('codChofer');
				$res       = $this->model_chofer->validarDuenno($codChofer,$oficina);
				if($res[0]['VALIDADOR'] == 'S'){
					$msg['status'] = true;
				}else{
					$msg['status'] = false;
				}
				echo json_encode($msg);
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}
	
	public function addImgChofer(){
		if($this->input->post()){
			$this->form_validation->set_rules('img_cod_Chofer', 'Código', 'trim|required');			
			if($this->form_validation->run()==FALSE){
				$msg['error']=validation_errors();
			}else{
				$codigo_chofer = $this->input->post('img_cod_Chofer');
				$user      = $this->session->userdata('usuario');
				$user_id   = $user[0]['USUID'];
				$pathname  = 'fotos/chofer/'.$codigo_chofer;
				if (!is_dir($pathname)) {
					// die(var_dump($pathname));
					mkdir('fotos/chofer/'.$codigo_chofer);
				}
				$config['upload_path']   = $pathname;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = 1024*1000;
				$config['file_name']     = $codigo_chofer.'_IMG_'.date('d_m_Y_h_i_s');
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('imgChofer')) {
					$doc  = array('upload_data' => $this->upload->data());
					$ruta = $codigo_chofer.'/'.$doc['upload_data']['file_name'];
					$data  = $this->model_chofer->addImgChofer($codigo_chofer,$ruta,$user_id);
					if($data!=false){
						$msg['status']=TRUE;
						$this->session->set_userdata('chofer',$data[0]);
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