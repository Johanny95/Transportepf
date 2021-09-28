<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_aprobacion extends PF_Controller {

	private $user;
	private $rol;



	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		//sessiones
		$user= $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');

		if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 11) {
			redirect(base_url().'index.php/Welcome', 'refresh');
		}else if (in_array(61, $rol)){ //acceso a aprobacion de documentos
			$this->load->model('M_mantenedor_roles');
			$this->load->model('model_informe');
			$this->load->model('model_transporte');
			$this->load->model('M_aprobacion_documentos');
		}else{
			redirect(base_url().'index.php/Welcome', 'refresh');
		}
	}


	public function view_aprobacion(){
		$user 						= $this->session->userdata('usuario');
		$data['getOficinas']        = $this->model_informe->get_oficinas();
		$data['transp_lista']       = $this->model_transporte->getTransportistas();
		$data['tipo_doc'] 			= $this->model_informe->get_tipo_documento();
		$data['oficinas_usuario'] 	= $this->M_mantenedor_roles->get_usuoficina($user[0]['USUID']);
		$data['documentos_usuario'] = $this->M_mantenedor_roles->get_usudocumentos($user[0]['USUID']);
		$this->load->view('template/header');
		$this->load->view('aprobacion/view_aprobacion', $data);
		$this->load->view('template/footer');
	}

	public function get_usuoficina(){
		$usuid = $this->input->post('usuid');
		$array = array();
		$data['oficinas_usuario'] = $this->M_mantenedor_roles->get_usuoficina($usuid);
		echo json_encode($data);	
	}

	public function get_usudocumentos(){
		$usuid = $this->input->post('usuid');
		$array = array();
		$data['documentos_usuario'] = $this->M_mantenedor_roles->get_usudocumentos($usuid);
		echo json_encode($data);	
	}


	public function  get_usuario_documentos_transp(){
		$data = array();
		if ($this->input->is_ajax_request()) {
			$user 	  	   = $this->session->userdata('usuario');
			$array = array();
			$array[] = 0;

			$elemento_post = array(
				'OFICINA' => ($this->input->post('oficina') ? $this->input->post('oficina') : $array  ) ,
				'TIPODOC' => ($this->input->post('tipodoc') ? $this->input->post('tipodoc') : $array  ),
				'USERID'  => $user[0]['USUID']
			);
			// die(var_dump($elemento_post)); 
			$elemento = $this->M_aprobacion_documentos->get_documentos_usuario_transp($elemento_post);
			if (!empty($elemento)) {
				foreach ($elemento as $key) {
					if( in_array($key->CODIGO_OFICINA , $elemento_post['OFICINA']) && in_array($key->ID_TIPO_DOC, $elemento_post['TIPODOC']) ){
						$url = ( empty($key->PATH_DOC) ? $key->FULL_PATH : base_url().'doc/'.$key->PATH_DOC );
						// $url = ( empty($key->PATH_DOC) ? $key->FULL_PATH : 'http://intranet_prod/Transporte_pf/doc/'.$key->PATH_DOC );
						

						$row = array();
						$row[] = $key->NOMBREDOC;
						$row[] = $key->IDENTIFICADOR.' | '.$key->PERTENECIENTE;
						$row[] = $key->OFICINA;
					// $row[] = $key->ESTADO_APROBACION;
						$row[] = $key->ESTADO;
					// $row[] = $key->DUENNO;
						$row[] = $key->FECHAVIGENCIA;
						$row[] = $key->CREATION_DATE;
						$row[] = array( 'DOCID' 			=> $key->COD_DOC_TRANS,
							'NOMBREDOC' 		=> $key->NOMBREDOC, 
							'OFICINA' 			=> $key->OFICINA , 
							'URL' 				=> $url,
							'IDENTIFICADOR'  	=> $key->IDENTIFICADOR,
							'PERTENECIENTE'  	=> $key->PERTENECIENTE,
							'FECHA_VIGENCIA' 	=> $key->FECHAVIGENCIA,
							'ESTADO'			=> $key->ESTADO
						);
						if(empty($key->PATH_DOC)){
							$row[] = $key->FULL_PATH;	
						}else{
							$row[] = base_url().'doc/'.$key->PATH_DOC;
							// $row[] = 'http://intranet_prod/Transporte_pf/doc/'.$key->PATH_DOC;
						}
						$data[]  = $row;
					}
					
				}	
			}
		}
		$this->output->set_output(json_encode($data));
	}

	public function  get_usuario_documentos_camion(){
		$data = array();
		if ($this->input->is_ajax_request()) {
			$user 	  	   = $this->session->userdata('usuario');
			
			$array = array();
			$array[] = 0;

			$elemento_post = array(
				'OFICINA' => ($this->input->post('oficina') ? $this->input->post('oficina') : $array  ) ,
				'TIPODOC' => ($this->input->post('tipodoc') ? $this->input->post('tipodoc') : $array  ),
				'USERID'  => $user[0]['USUID']
			);
			// die(var_dump($elemento_post));
			$elemento = $this->M_aprobacion_documentos->get_documentos_usuario_camion($elemento_post);
			if (!empty($elemento)) {
				foreach ($elemento as $key) {
					if( in_array($key->CODIGO_OFICINA , $elemento_post['OFICINA']) && in_array($key->ID_TIPO_DOC, $elemento_post['TIPODOC']) ){
						$url = ( empty($key->PATH_DOC) ? $key->FULL_PATH : base_url().'doc/'.$key->PATH_DOC );
						// $url = ( empty($key->PATH_DOC) ? $key->FULL_PATH : 'http://intranet_prod/Transporte_pf/doc/'.$key->PATH_DOC );
						

						$row = array();
						$row[] = $key->NOMBREDOC;
						$row[] = $key->IDENTIFICADOR.' | '.$key->PERTENECIENTE;
						$row[] = $key->OFICINA;
					// $row[] = $key->ESTADO_APROBACION;
						$row[] = $key->ESTADO;
					// $row[] = $key->DUENNO;
						$row[] = $key->FECHAVIGENCIA;
						$row[] = $key->CREATION_DATE;
						$row[] = array( 'DOCID' 			=> $key->COD_DOC_TRANS,
							'NOMBREDOC' 		=> $key->NOMBREDOC, 
							'OFICINA' 			=> $key->OFICINA , 
							'URL' 				=> $url,
							'IDENTIFICADOR'  	=> $key->IDENTIFICADOR,
							'PERTENECIENTE'  	=> $key->PERTENECIENTE,
							'FECHA_VIGENCIA' 	=> $key->FECHAVIGENCIA,
							'ESTADO'			=> $key->ESTADO
						);
						if(empty($key->PATH_DOC)){
							$row[] = $key->FULL_PATH;	
						}else{
							$row[] = base_url().'doc/'.$key->PATH_DOC;
							// $row[] = 'http://intranet_prod/Transporte_pf/doc/'.$key->PATH_DOC;
						}
						$data[]  = $row;
					}
					
				}	
			}
		}
		$this->output->set_output(json_encode($data));
	}

	public function  get_usuario_documentos_chofer(){
		$data = array();
		if ($this->input->is_ajax_request()) {
			$user 	  	   = $this->session->userdata('usuario');
			$array = array();
			$array[] = 0;

			$elemento_post = array(
				'OFICINA' => ($this->input->post('oficina') ? $this->input->post('oficina') : $array  ) ,
				'TIPODOC' => ($this->input->post('tipodoc') ? $this->input->post('tipodoc') : $array ),
				'USERID'  => $user[0]['USUID']
			);
			// die(var_dump($elemento_post));
			$elemento = $this->M_aprobacion_documentos->get_documentos_usuario_chofer($elemento_post);
			if (!empty($elemento)) {
				foreach ($elemento as $key) {
					if( in_array($key->CODIGO_OFICINA , $elemento_post['OFICINA']) && in_array($key->ID_TIPO_DOC, $elemento_post['TIPODOC']) ){
						$url = ( empty($key->PATH_DOC) ? $key->FULL_PATH : base_url().'doc/'.$key->PATH_DOC );
						// $url = ( empty($key->PATH_DOC) ? $key->FULL_PATH : 'http://intranet_prod/Transporte_pf/doc/'.$key->PATH_DOC );
						

						$row = array();
						$row[] = $key->NOMBREDOC;
						$row[] = $key->IDENTIFICADOR.' | '.$key->PERTENECIENTE;
						$row[] = $key->OFICINA;
					// $row[] = $key->ESTADO_APROBACION;
						$row[] = $key->ESTADO;
					// $row[] = $key->DUENNO;
						$row[] = $key->FECHAVIGENCIA;
						$row[] = $key->CREATION_DATE;
						$row[] = array( 'DOCID' 			=> $key->COD_DOC_TRANS,
							'NOMBREDOC' 		=> $key->NOMBREDOC, 
							'OFICINA' 			=> $key->OFICINA , 
							'URL' 				=> $url,
							'IDENTIFICADOR'  	=> $key->IDENTIFICADOR,
							'PERTENECIENTE'  	=> $key->PERTENECIENTE,
							'FECHA_VIGENCIA' 	=> $key->FECHAVIGENCIA,
							'ESTADO'			=> $key->ESTADO
						);
						if(empty($key->PATH_DOC)){
							$row[] = $key->FULL_PATH;	
						}else{
							$row[] = base_url().'doc/'.$key->PATH_DOC;
							// $row[] = 'http://intranet_prod/Transporte_pf/doc/'.$key->PATH_DOC;
						}
						$data[]  = $row;
					}
					
				}	
			}
		}
		$this->output->set_output(json_encode($data));
	}

	public function  get_usuario_documentos_ayudante(){
		$data = array();
		if ($this->input->is_ajax_request()) {
			$user 	  	   = $this->session->userdata('usuario');

			$array = array();
			$array[] = 0;

			$elemento_post = array(
				'OFICINA' => ($this->input->post('oficina') ? $this->input->post('oficina') : $array  ) ,
				'TIPODOC' => ($this->input->post('tipodoc') ? $this->input->post('tipodoc') : $array  ),
				'USERID'  => $user[0]['USUID']
			);
			// die(var_dump($elemento_post));
			$elemento = $this->M_aprobacion_documentos->get_documentos_usuario_ayudante($elemento_post);
			if (!empty($elemento)) {
				foreach ($elemento as $key) {
					if( in_array($key->CODIGO_OFICINA , $elemento_post['OFICINA']) && in_array($key->ID_TIPO_DOC, $elemento_post['TIPODOC']) ){
						$url = ( empty($key->PATH_DOC) ? $key->FULL_PATH : base_url().'doc/'.$key->PATH_DOC );
						// $url = ( empty($key->PATH_DOC) ? $key->FULL_PATH : 'http://intranet_prod/Transporte_pf/doc/'.$key->PATH_DOC );
						

						$row = array();
						$row[] = $key->NOMBREDOC;
						$row[] = $key->IDENTIFICADOR.' | '.$key->PERTENECIENTE;
						$row[] = $key->OFICINA;
					// $row[] = $key->ESTADO_APROBACION;
						$row[] = $key->ESTADO;
					// $row[] = $key->DUENNO;
						$row[] = $key->FECHAVIGENCIA;
						$row[] = $key->CREATION_DATE;
						$row[] = array( 'DOCID' 			=> $key->COD_DOC_TRANS,
							'NOMBREDOC' 		=> $key->NOMBREDOC, 
							'OFICINA' 			=> $key->OFICINA , 
							'URL' 				=> $url,
							'IDENTIFICADOR'  	=> $key->IDENTIFICADOR,
							'PERTENECIENTE'  	=> $key->PERTENECIENTE,
							'FECHA_VIGENCIA' 	=> $key->FECHAVIGENCIA,
							'ESTADO'			=> $key->ESTADO
						);
						if(empty($key->PATH_DOC)){
							$row[] = $key->FULL_PATH;	
						}else{
							$row[] = base_url().'doc/'.$key->PATH_DOC;
							// $row[] = 'http://intranet_prod/Transporte_pf/doc/'.$key->PATH_DOC;
						}
						$data[]  = $row;
					}
					
				}	
			}
		}
		$this->output->set_output(json_encode($data));
	}

	public function  sp_get_doc_usu_rampa(){
		$data = array();
		if ($this->input->is_ajax_request()) {
			$user 	  	   = $this->session->userdata('usuario');

			$array = array();
			$array[] = 0;

			$elemento_post = array(
				'OFICINA' => ($this->input->post('oficina') ? $this->input->post('oficina') : $array  ) ,
				'TIPODOC' => ($this->input->post('tipodoc') ? $this->input->post('tipodoc') : $array  ),
				'USERID'  => $user[0]['USUID']
			);
			// die(var_dump($elemento_post));
			$elemento = $this->M_aprobacion_documentos->sp_get_doc_usu_rampa($elemento_post);
			if (!empty($elemento)) {
				foreach ($elemento as $key) {
					if( in_array($key->CODIGO_OFICINA , $elemento_post['OFICINA']) && in_array($key->ID_TIPO_DOC, $elemento_post['TIPODOC']) ){
						$url = ( empty($key->PATH_DOC) ? $key->FULL_PATH : base_url().'doc/ramplas/'.$key->PATH_DOC );
						// $url = ( empty($key->PATH_DOC) ? $key->FULL_PATH : 'http://intranet_prod/Transporte_pf/doc/ramplas/'.$key->PATH_DOC );
						

						$row = array();
						$row[] = $key->NOMBREDOC;
						$row[] = $key->IDENTIFICADOR.' | '.$key->PERTENECIENTE;
						$row[] = $key->OFICINA;
					// $row[] = $key->ESTADO_APROBACION;
						$row[] = $key->ESTADO;
					// $row[] = $key->DUENNO;
						$row[] = $key->FECHAVIGENCIA;
						$row[] = $key->CREATION_DATE;
						$row[] = array( 'DOCID' 			=> $key->COD_DOC_TRANS,
							'NOMBREDOC' 		=> $key->NOMBREDOC, 
							'OFICINA' 			=> $key->OFICINA , 
							'URL' 				=> $url,
							'IDENTIFICADOR'  	=> $key->IDENTIFICADOR,
							'PERTENECIENTE'  	=> $key->PERTENECIENTE,
							'FECHA_VIGENCIA' 	=> $key->FECHAVIGENCIA,
							'ESTADO'			=> $key->ESTADO
						);
						if(empty($key->PATH_DOC)){
							$row[] = $key->FULL_PATH;	
						}else{
							$row[] = $url;
							// $row[] = 'http://intranet_prod/Transporte_pf/doc/'.$key->PATH_DOC;
						}
						$data[]  = $row;
					}
					
				}	
			}
		}
		$this->output->set_output(json_encode($data));
	}

	

	public function get_motivos_recha_documento(){
		$data['motivos_rechazo'] = $this->M_aprobacion_documentos->get_motivos_recha_documento();
		echo json_encode($data);	
	}


	public function aprobar_documento(){
		$data = array('status' => FALSE,
			'error'  => '');
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('afectado' 			, 'Afectado de documento' 	, 'trim|required|max_length[50]');
			$this->form_validation->set_rules('docid'				, 'Documento id' 		, 'trim|required|max_length[50]');
			if($this->form_validation->run() == FALSE){
				$data['status']=FALSE;
				$data['error']=validation_errors();
			}else{
				$user     = $this->session->userdata('usuario');
				$elemento = array( 'AFECTADO' => $this->input->post('afectado'),
					'DOCID' 	  => $this->input->post('docid'),
					'USUARIO'  => $user[0]['USUID']
				);

				switch ($elemento['AFECTADO']) {
					case 'T':
					$result   = $this->M_aprobacion_documentos->aprob_documenento_transp($elemento);
					break;
					case 'C':
					$result   = $this->M_aprobacion_documentos->aprob_documenento_camion($elemento);
					break;
					case 'CH':
					$result   = $this->M_aprobacion_documentos->aprob_documenento_chofer($elemento);
					break;
					case 'A':
					$result   = $this->M_aprobacion_documentos->aprob_documenento_ayudante($elemento);
					break;
					case 'R':
					$result   = $this->M_aprobacion_documentos->aprob_documenento_rampla($elemento);
					break;
					default:
					$data['status'] = FALSE;
					$result 		= 0;
					break;
				}

				if ($result == 1 ) {
					$data['status'] = true;
				}else{
					$data['status'] 	= false;
					$data['error'] 		= 'Error en el proceso de aprobación, contactarse con informática...';
				}

			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}


	public function rechazar_documento(){
		$data = array('status' => FALSE,
			'error'  => '');
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('afectado' 			, 'Afectado de documento' 		, 'trim|required|max_length[50]');
			$this->form_validation->set_rules('motivo' 				, 'Motivo de rechazo' 		, 'trim|required|max_length[50]');
			$this->form_validation->set_rules('observacion' 		, 'Observación de documento' 	, 'trim|max_length[350]');
			$this->form_validation->set_rules('docid'				, 'Documento id' 				, 'trim|required|max_length[50]');
			if($this->form_validation->run() == FALSE){
				$data['status']=FALSE;
				$data['error']=validation_errors();
			}else{
				$user     = $this->session->userdata('usuario');
				$elemento = array( 'AFECTADO' 			=> $this->input->post('afectado'),
					'DOCID' 	  			=> $this->input->post('docid'),
					'MOTIVO'     		=> $this->input->post('motivo'),
					'OBSERVACION' 	  	=> $this->input->post('observacion'),
					'USUARIO'  			=> $user[0]['USUID']
				);

				switch ($elemento['AFECTADO']) {
					case 'T':
					$result   = $this->M_aprobacion_documentos->rechazar_documenento_transp($elemento);
					break;
					case 'C':
					$result   = $this->M_aprobacion_documentos->rechazar_documenento_camion($elemento);
					break;
					case 'CH':
					$result   = $this->M_aprobacion_documentos->rechazar_documenento_chofer($elemento);
					break;
					case 'A':
					$result   = $this->M_aprobacion_documentos->rechazar_documenento_ayudante($elemento);
					break;
					case 'R':
					$result   = $this->M_aprobacion_documentos->rechazar_documenento_rampla($elemento);
					break;
					default:
					$data['status'] = FALSE;
					$result 		= 0;
					break;
				}

				if ($result == 1 ) {
					$data['status'] = true;
				}else{
					$data['status'] 	= false;
					$data['error'] 		= 'Error en el proceso de aprobación, contactarse con informática...';
				}

			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	
	public function view_mis_aprobaciones(){
		$user 						= $this->session->userdata('usuario');
		$data['oficinas_usuario'] 	= $this->M_mantenedor_roles->get_usuoficina($user[0]['USUID']);
		$data['documentos_usuario'] = $this->M_mantenedor_roles->get_usudocumentos($user[0]['USUID']);
		$this->load->view('template/header');
		$this->load->view('aprobacion/view_mis_aprobaciones', $data);
		$this->load->view('template/footer');
	}

	public function get_mis_aprobaciones_doc(){
		$data = array();
		if ($this->input->is_ajax_request()) {
			$user 	  	   = $this->session->userdata('usuario');

			$array = array();
			$array[] = 0;

			$elemento_post = array(
				'OFICINA' 			=> implode(",",($this->input->post('oficina') ? $this->input->post('oficina') : $array ) ) ,
				'TIPODOC' 			=> implode(",",($this->input->post('tipodoc') ? $this->input->post('tipodoc') : $array ) ),
				'ESTADO_APROBACION'	=> implode(",",($this->input->post('estado_aprobacion') ? $this->input->post('estado_aprobacion') : $array ) ),
				'FECHA_DESDE'		=> $this->input->post('fecha_desde'),
				'FECHA_HASTA'		=> $this->input->post('fecha_hasta'),
				'USERID'  			=> $user[0]['USUID']
			);
			// die(var_dump($elemento_post));
			$elemento = $this->M_aprobacion_documentos->get_mis_aprobaciones_doc($elemento_post);
			if (!empty($elemento)) {
				foreach ($elemento as $key) {
					// if( in_array($key->CODIGO_OFICINA , $elemento_post['OFICINA']) && in_array($key->ID_TIPO_DOC, $elemento_post['TIPODOC']) ){

					$rampla = ($key->DUENNO == 'Rampla' ? 'ramplas/' : ''); 
					$url = ( empty($key->PATH_DOC) ? $key->FULL_PATH : base_url().'doc/ramplas/'.$key->PATH_DOC );
					// $url = ( empty($key->PATH_DOC) ? $key->FULL_PATH : 'http://intranet_prod/Transporte_pf/doc/'.$rampla.$key->PATH_DOC );


					$row = array();
					$row[] = $key->NOMBREDOC;
					$row[] = $key->IDENTIFICADOR.' | '.$key->PERTENECIENTE;
					$row[] = $key->OFICINA;
					$row[] = $key->DUENNO;
					$row[] = $key->ESTADO;
					$row[] = $key->FECHAVIGENCIA;
					$row[] = $key->FECHA_APROBACION;
					$row[] = $key->ESTADO_APROBACION;
					$row[] = array( 'DOCID' 				=> $key->CODIGO_DOCUMENTO,
						'NOMBREDOC' 			=> $key->NOMBREDOC, 
						'OFICINA' 				=> $key->OFICINA , 
						'URL' 					=> $url,
						'IDENTIFICADOR'  		=> $key->IDENTIFICADOR,
						'PERTENECIENTE'  		=> $key->PERTENECIENTE,
						'FECHA_VIGENCIA' 		=> $key->FECHAVIGENCIA,
						'ESTADO'				=> $key->ESTADO,
						'MOTIVO_RECHAZO'	 	=> $key->MOTIVO_RECHAZO,
						'FECHA_APROBACION'	 	=> $key->FECHA_APROBACION,
						'OBSERVACION_RECHAZO'	=> $key->OBSERVACION_RECHAZO
					);
					if(empty($key->PATH_DOC)){
						$row[] = $key->FULL_PATH;	
					}else{
						$row[] = base_url().'doc/'.$key->PATH_DOC;
						// $row[] = 'http://intranet_prod/Transporte_pf/doc/'.$rampla.$key->PATH_DOC;

					}
					$data[]  = $row;
					// }
					
				}	
			}
		}
		$this->output->set_output(json_encode($data));
	}


}