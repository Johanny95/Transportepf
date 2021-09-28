<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_camion extends PF_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 11) {
			redirect(base_url().'index.php/Welcome', 'refresh');
		}else{
			$this->load->model('model_camion');
			$this->load->model('model_transporte');
		}
	}

	public function patentes(){
		if($this->session->userdata('usuario')>0){			
			if($this->input->post()){
				$id_transp=$this->input->post('id_transp');			
				$transp= $this->session->userdata('transp');
				$data=$this->model_camion->getPatentes($id_transp,$transp->OFICINA);
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

	public function verFichaCamion(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			if(count($this->session->userdata('camion'))>0){
				$this->load->view('camion/fichaCamion');
			}else{
				$this->load->view('transportistas');
			}
			$this->load->view('template/footer');
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function cargarFicha(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$id=$this->input->post('patente');
				$data=$this->model_camion->getCamion($id);
				$this->session->set_userdata('camion',$data[0]);
				echo json_encode(array('msg'=>TRUE));
			}else{
				redirect(base_url().'index.php/sin_acceso', 'refresh');
			}
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}	
	}

	public function getImagenesCamion(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				if(count($this->session->userdata('camion'))>0){
					$cod_camion=$this->input->post('cod_camion');
					$data = $this->model_camion->getImagenes($cod_camion);
					echo json_encode($data);
				}else{
					redirect(base_url().'index.php/sin_acceso', 'refresh');
				}
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

	public function getTiposDocCamion(){
		if($this->session->userdata('usuario')>0){
			$datos=$this->model_transporte->tipoDocsTransp('C');
			echo json_encode($datos);
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function addDocCamion(){
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$msg['status']=TRUE;
				$msg['error']='';
				$this->form_validation->set_rules('CodCamion', 'codigo', 'trim|required');
				$this->form_validation->set_rules('FechaDocCamion', 'Fecha', 'trim');
				$this->form_validation->set_rules('patenteDocCamion', 'Patente', 'trim|required');
				$this->form_validation->set_rules('TipoDocCamion', 'Tipo documento', 'required');
				if($this->form_validation->run()==FALSE){
					$msg['error']=validation_errors();
					$msf['status']=FALSE;
				}else{
					$codCamion = $this->input->post('CodCamion');
					$fecha     = $this->input->post('FechaDocCamion');
					$tipoDoc   = $this->input->post('TipoDocCamion');
					$patente   = $this->input->post('patenteDocCamion');
					$user      = $this->session->userdata('usuario');
					$user_id   = $user[0]['USUID'];
					$pathname  = 'doc/'.$patente;
					if (!is_dir($pathname)) {
					// die(var_dump($pathname));
						mkdir('doc/'.$patente);
					}
					$config['upload_path']   = $pathname;
					$config['allowed_types'] = '*';
					$config['max_size']      = 1024*1000;
					$config['file_name']     = $codCamion.'_'.date('Y-m-d_h_i_s').'_type_'.$tipoDoc;
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('docCamion')){
						$doc  = array('upload_data' => $this->upload->data());
						$ruta = $patente.'/'.$doc['upload_data']['file_name'];
						$fullruta=$doc['upload_data']['full_path'];
						$res  = $this->model_camion->addDocCamion($codCamion,$tipoDoc,$ruta,$fullruta,$fecha,$user_id);
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

	public function updateCamion(){
		$msg['status']=TRUE;
		$msg['error']='';
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$this->form_validation->set_rules('cod_camion', 'codigo', 'trim|required');
				$this->form_validation->set_rules('tipoCamion', 'Tipo camion', 'trim|required');
				$this->form_validation->set_rules('sisFrio', 'sistema frio', 'trim');
				$this->form_validation->set_rules('estadoCamion', 'Estado Camion', 'trim|required');
				$this->form_validation->set_rules('uniFrio','Unidad de frio','trim|max_length[2]');
				$this->form_validation->set_rules('separador','Separador','trim|max_length[2]');
				$this->form_validation->set_rules('fijo','fijo','trim|max_length[2]');
				$this->form_validation->set_rules('gps','gps','trim|max_length[2]');
				$this->form_validation->set_rules('sdl','sdl','trim|max_length[2]');
				$this->form_validation->set_rules('publicidad','publicidad','trim|max_length[2]');
				$this->form_validation->set_rules('latAncho','Lateral ancho','trim|required|max_length[9]');
				$this->form_validation->set_rules('latAlto','Lateral alto','trim|required|max_length[9]');
				$this->form_validation->set_rules('BTAncho','Back Track Ancho','trim|required|max_length[9]');
				$this->form_validation->set_rules('BTAlto','Back Track Alto','trim|required|max_length[9]');
				$this->form_validation->set_rules('gata','Gata','trim|max_length[2]');
				$this->form_validation->set_rules('llave_rueda','Llave de rueda','trim|max_length[2]');
				$this->form_validation->set_rules('triangulo','Triangulo','trim|max_length[2]');
				$this->form_validation->set_rules('llave_contacto','Llave de contacto','trim|max_length[2]');
				$this->form_validation->set_rules('extintor','Extintor','trim|max_length[2]');
				$this->form_validation->set_rules('radio','radio','trim|max_length[2]');
				$this->form_validation->set_rules('rueda_repuesto','Rueda de repuesto','trim|max_length[2]');
				$this->form_validation->set_rules('botiquin','Botiquin','trim|max_length[2]');
				$this->form_validation->set_rules('fecha_vigencia','Fecha de vigencia','trim|max_length[12]');
				$this->form_validation->set_rules('n_motor','N° motor','trim|max_length[20]|required');
				$this->form_validation->set_rules('n_chasis','N° chasis','trim|max_length[20]|required');
				$this->form_validation->set_rules('anno','Año','trim|max_length[11]|required');
				if($this->form_validation->run()==FALSE){
					$msg['error']=validation_errors();
					$msg['status']=FALSE;
				}else{
					$cod_camion   =$this->input->post('cod_camion');
					$tipo_camion  =$this->input->post('tipoCamion');
					$sisfrio      =$this->input->post('sisFrio');
					$estadoCamion =$this->input->post('estadoCamion');
					$uniFrio      =($this->input->post('uniFrio')=='' ? 'NO' : 'SI');
					$separador    =($this->input->post('separador')=='' ? 'NO' : 'SI');
					$fijo         =($this->input->post('fijo')=='' ? 'NO' : 'SI');
					$gps          =($this->input->post('gps')=='' ? 'NO' : 'SI');
					$sdl          =($this->input->post('sdl')=='' ? 'NO' : 'SI');
					$publicidad   =($this->input->post('publicidad')=='' ? 'NO' : 'SI');
					$latAncho     =$this->input->post('latAncho');
					$latAlto      =$this->input->post('latAlto');
					$BTAncho      =$this->input->post('BTAncho');
					$BTAlto       =$this->input->post('BTAlto');
					$n_chasis     =$this->input->post('n_chasis');
					$n_motor      =$this->input->post('n_motor');
					$anno         =$this->input->post('anno');
				//INVENTARIO
					$gata           =($this->input->post('gata')=='' ? 'NO' : 'SI');
					$llave_rueda	=($this->input->post('llave_rueda')=='' ? 'NO' : 'SI');
					$triangulo      =($this->input->post('triangulo')=='' ? 'NO' : 'SI');
					$llave_contacto =($this->input->post('llave_contacto')=='' ? 'NO' : 'SI');
					$extintor       =($this->input->post('extintor')=='' ? 'NO' : 'SI');
					$radio          =($this->input->post('radio')=='' ? 'NO' : 'SI');
					$rueda_repuesto =($this->input->post('rueda_repuesto')=='' ? 'NO' : 'SI');
					$botiquin       =($this->input->post('botiquin')=='' ? 'NO' : 'SI');
					$fecha_vigencia =$this->input->post('dateVig');

					$data = $this->model_camion->updateCamion($cod_camion,$tipo_camion,$sisfrio,$estadoCamion,$uniFrio,$separador,$fijo,$gps,$sdl,$publicidad,$latAncho,$latAlto,$BTAlto,$BTAncho,$gata,$llave_rueda,$triangulo,$llave_contacto,$extintor,$radio,$rueda_repuesto,$botiquin,$fecha_vigencia,$n_motor,$n_chasis,$anno);
					if($data!=false){
						$msg['status']=TRUE;
						$this->session->set_userdata('camion',$data[0]);
					}else{
						$msg['status']=FALSE;
					}
				}
			}else{
				$msg['status']=false;
			}
		}else{
			$msg['status']=FALSE;
			$msg['error']='Sesión caducada, porfavor ingresar nuevamente';
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode($msg);
	}

	public function getDocsCamiones(){
		if($this->session->userdata('usuario')>0){
			$id=$this->input->post('camion');
			$data=$this->model_camion->getDocCamiones($id);
			echo json_encode($data);
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function addImgCamion(){
		if($this->input->post()){
			$this->form_validation->set_rules('imgCodCamion', 'Codigo', 'trim|required');
			$this->form_validation->set_rules('imgPatente', 'Codigo', 'trim|required');
			if($this->form_validation->run()==FALSE){
				$msg['error']=validation_errors();
			}else{
				$codCamion = $this->input->post('imgCodCamion');
				$patente   = $this->input->post('imgPatente');
				$user      = $this->session->userdata('usuario');
				$user_id   = $user[0]['USUID'];
				$pathname  = 'imgCamion/'.$patente;
				if (!is_dir($pathname)) {
					// die(var_dump($pathname));
					mkdir('imgCamion/'.$patente);
				}
				$config['upload_path']   = $pathname;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = 1024*1000;
				$config['file_name']     = $patente.'_IMG'.date('d_m_Y_h_i_s');
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('imgCamion')) {
					$doc  = array('upload_data' => $this->upload->data());
					$ruta = $patente.'/'.$doc['upload_data']['file_name'];
					$res  = $this->model_camion->addImgCamion($codCamion,$ruta,$user_id);
					if($res==TRUE){
						$msg['status']=TRUE;
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
	
	public function verHistCamion(){
		if($this->input->post()){
			$codCamion=$this->input->post('codCamion');
			$tipoDoc=$this->input->post('tipoDoc');
			$msg=$this->model_camion->getHistDocsCamion($codCamion,$tipoDoc);
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
		echo json_encode(array('msg'=>$msg));
	}

	public function getDocDataCamion(){
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


}