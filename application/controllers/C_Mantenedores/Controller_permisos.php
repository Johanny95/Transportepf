<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_permisos extends PF_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 11) {
			redirect(base_url().'index.php/Welcome', 'refresh');
		}else{
			$this->load->model('M_mantenedor_roles');
			$this->load->model('model_informe');
			$this->load->model('model_transporte');
		}
	}

	public function view_mantenedor_usurol(){
		$data['getOficinas']        = $this->model_informe->get_oficinas();
		$data['transp_lista']       = $this->model_transporte->getTransportistas();
		$data['tipo_doc'] = $this->model_informe->get_tipo_documento();
		$this->load->view('template/header');
		$this->load->view('mantenedores/asociacion_usurol', $data);
		$this->load->view('template/footer');
	}

	public function get_usuarios_rol(){
		$data = array();
		if ($this->input->is_ajax_request()) {
			$autocompletar = $this->input->post('autocompletar');
			$get = $this->M_mantenedor_roles->get_usuario_rol_transp($autocompletar);
			if (!empty($get)) {
				foreach ($get as $value) {
					$row = array();
					$row['id'] = $value->ID_USUARIO;
					$row['nombre'] = $value->NOMBRE;
					$data[] = $row;
				}
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));

	}

	public function get_roles(){
		$data = array();
		if ($this->input->is_ajax_request()) {
			$get = $this->M_mantenedor_roles->get_roles();
			if (!empty($get)) {
				foreach ($get as $value) {
					$row = array();
					$row['id'] = $value->ROLID;
					$row['nombre'] = $value->NOMBRE;
					$data[] = $row;
				}
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_usurol_flota(){
		$data = array();
		if ($this->input->is_ajax_request()) {
			$filter   = $this->input->post('search_filter');
			$result 		= $this->M_mantenedor_roles->get_usurol_flota($filter);
			if (!empty($result)) {
				foreach ($result as $key) {
					$row = array();
					$row[] = $key->USUID;
					$row[] = $key->USUNOM;
					$row[] = $key->RUT_USUARIO;
					$row[] = $key->ROLID;
					$row[] = $key->NOMBRE;
					$row[] = $key->ESTADO;
					$row[] = array('USUID' => $key->USUID , 'USUNOM' => $key->USUNOM, 'RUT_USUARIO' => $key->RUT_USUARIO, 'ROLID' => $key->ROLID, 'NOMBRE_ROL' => $key->NOMBRE, 'ESTADO' => $key->ESTADO);
					$data[]  = $row;
				}	
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));	
	}

	public function add_usu_rol(){
		$msg['status']=true;
		$msg['error']='';
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('usuarios' 			, 'Usuario' 	, 'trim|required|max_length[50]');
			$this->form_validation->set_rules('roles'				, 'Rol' 		, 'trim|required|max_length[50]');

			if($this->form_validation->run() == FALSE){
				$msg['status']=FALSE;
				$msg['error']=validation_errors();
			}else{
				$user       	= $this->session->userdata('usuario');
				$elemento   	= array(
					'USUARIO' 			=> $this->input->post('usuarios'),
					'IDROL' 			=> $this->input->post('roles'),
					'OFICINAS'			=> $this->input->post('oficinas'),
					'DOCUMENTOS'		=> $this->input->post('id_tipo_doc'),
					'USUARIO_SESSION'	=> $user[0]['USUID']
				);

				if ( ( empty($elemento['OFICINAS']) || empty($elemento['DOCUMENTOS']) ) && ($elemento['IDROL'] == 61 || $elemento['IDROL'] == 62 ) ) {
					$msg['status'] = false ;
					$msg['error']  = 'Debe seleccionar una oficina y documento por lo menos...';
				}else{
					$msg['result'] 	= $this->M_mantenedor_roles->add_usu_rol($elemento);
					switch ($msg['result']) {
						case 0:
						$msg['status'] = false;
						$msg['error']  = 'Error de base de datos. Contactarse con informática...';
						break;
						case 1:
						$msg['status'] = true;
						break;
						case 2:
						$msg['status'] = false;
						$msg['error']  = 'El usuario ya se encuentra asignado a ese rol';
						break;
					}
				}
			}
		}else{
			$msg['status']=false;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($msg));
	}

	public function upd_usu_rol(){
		$msg['status']=true;
		$msg['error']='';
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('idusuario_edit' 			, 'Usuario' 				, 'trim|required|max_length[50]');
			$this->form_validation->set_rules('rolid_edit'				, 'Rol' 					, 'trim|required|max_length[50]');

			if($this->form_validation->run() == FALSE){
				$msg['status']=FALSE;
				$msg['error']=validation_errors();
			}else{
				$user       	= $this->session->userdata('usuario');
				$elemento   	= array(
					'USUARIO' 			=> $this->input->post('idusuario_edit'),
					'IDROL' 			=> $this->input->post('rolid_edit'),
					'OFICINAS'			=> ($this->input->post('oficina_edit') ? $this->input->post('oficina_edit') : '0' ),
					'DOCUMENTOS'		=> ($this->input->post('id_tipo_doc_edit') ? $this->input->post('id_tipo_doc_edit') : '0' ),
					'ESTADO_ROL'		=> ($this->input->post('activo_edit') == 'SI' ? 'S' : 'N'),
					'USUARIO_SESSION'	=> $user[0]['USUID']
				);
				$msg['result'] 	= $this->M_mantenedor_roles->upd_usu_rol($elemento);
				switch ($msg['result']) {
					case 0:
					$msg['status'] = false;
					$msg['error']  = 'Error de base de datos. Contactarse con informática...';
					break;
					case 1:
					$msg['status'] = true;
					break;
					case 2:
					$msg['status'] = false;
					$msg['error']  = 'El usuario ya se encuentra asignado a ese rol';
					break;
				}
			}
		}else{
			$msg['status']=false;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($msg));
	}

	public function get_oficinas_usuario(){
		$usuid 					= $this->input->post('usuid');
		$rolid 					= $this->input->post('rolid');
			// die(var_dump($id_tipo_doc));
		$data['oficinas_usuario'] = $this->M_mantenedor_roles->get_oficinas_usuario($usuid,$rolid);
		echo json_encode($data);

	}

	public function get_documentos_tipo(){
		$data['tipo_doc'] = $this->model_informe->get_tipo_documento();
		echo json_encode($data);
	}



	

}