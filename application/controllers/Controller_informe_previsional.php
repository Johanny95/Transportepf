<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_informe_previsional extends PF_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		$this->load->library('pfalimentos');
		if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 11) {
			redirect(base_url().'index.php/Welcome', 'refresh');
		}else{
			$this->load->model('model_informe');
			$this->load->model('model_transporte');
		}
	}

	public function get_informe_cert_provi(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$data['getOficinas']= $this->model_informe->get_oficinas();
			$data['documentos']= $this->model_informe->get_tipo_documento();
			$this->load->view('informes/informe_previsional',$data);
			$this->load->view('template/footer');
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	//datos de previsional tripulacion
	public function informe_tripulacion_previsional(){
		$oficinas = $this->input->post('oficinas');
		$datos    = $this->model_informe->get_informe_previsional_tripulacion($oficinas);			
		echo json_encode( $datos );
	}
	//datos de previsional transp
	
	public function informe_transp_previsional(){
		$oficinas = $this->input->post('oficinas');
		$datos    = $this->model_informe->get_informe_previsional_transp($oficinas);			
		echo json_encode( $datos );
	}


}