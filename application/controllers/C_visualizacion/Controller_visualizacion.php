<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_visualizacion extends PF_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		$this->load->library('pfalimentos');
		if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 11) {
			redirect(base_url().'index.php/Welcome', 'refresh');
		}else{
			$this->load->model('M_mantenedor_roles');
			$this->load->model('model_informe');
			$this->load->model('model_transporte');
			$this->load->model('model_visualizacion');
		}
	} 


	public function view_cumplimiento(){
		$user 						= $this->session->userdata('usuario');
		$data['oficinas_usuario'] 	= $this->model_visualizacion->get_oficinas_oficinas_view($user[0]['USUID'], 62);
		$data['documentos_usuario'] = $this->model_visualizacion->get_tipo_view($user[0]['USUID'], 62);

		$this->load->view('template/header');
		$this->load->view('visualizacion/cumplimiento_view', $data);
		$this->load->view('template/footer');
	}


	public function view_detalle_documentacion( $oficina ){
		$user 						= $this->session->userdata('usuario');
		$data['oficinas_usuario'] 	= $this->model_visualizacion->get_oficinas_oficinas_view($user[0]['USUID'], 62);
		$data['documentos_usuario'] = $this->model_visualizacion->get_tipo_view($user[0]['USUID'], 62);
		$data['filter_oficina']		= $oficina;
		$this->load->view('template/header');
		$this->load->view('visualizacion/view_detalle_documentacion',$data);
		$this->load->view('template/footer');
	}


	public function get_cumplimiento_oficinas()
	{
		$element = array();
		if ($this->input->is_ajax_request()) {
			$fecha           = substr($this->input->post('fecha'), 0, 10);
			$array = array();
			$array[] = 0;
			$documento = implode(",",($this->input->post('tipo_doc') ? $this->input->post('tipo_doc') : $array  ));
			$oficina   = implode(",",($this->input->post('oficina') ? $this->input->post('oficina') : $array  ));

			
			$fecha = date("d/m/Y");
			
			// die(var_dump($oficina));

			$field = $this->model_informe->get_informe_nacional($oficina,$documento,$fecha);

			foreach ($field as $key) {
				$row = array();
				$row['codigo_oficina'] = $key->OFICINA;
				$row['nombre_oficina'] = ucwords(mb_strtolower($key->NOMBRE_OFICINA));
				$row['promedio']       = $this->is_mayor(floatval($this->is_null($key->DOC_TRANS)));
				$row['porccamion']     = $this->is_mayor(floatval($this->is_null($key->PORCCAMION)));
				$row['porcchofer']     = $this->is_mayor(floatval($this->is_null($key->PORCCHOFER)));
				$row['porcayudante']   = $this->is_mayor(floatval($this->is_null($key->PORCAYUDANTE)));
				$row['total_oficina']  = $this->calcular_porcentaje_inf($key->DOC_TRANS,$key->PORCCAMION,$key->PORCCHOFER,$key->PORCAYUDANTE).'%';
				$row['button']  = '<a class="btn btn-sm bg-navy btn-block" href="'.site_url('view_det_documentacion/').$key->OFICINA.'" >Ver detalle</a>';
				$element[]             = $row;
			}
		}

		$this->output->set_output(json_encode($element));
	}


	public function get_detalle_doc(){
		$data = array();
		if ($this->input->is_ajax_request()) {
			$array = array();
			$array[] = 0;
			$user 						= $this->session->userdata('usuario');
			$element            = new stdClass;
			$element->fecha     = $this->input->post('fecha');
			$element->estado    = $this->input->post('estado');
			$element->duenno    = $this->input->post('propietario');
			$element->est_aprob = $this->input->post('est_aprobacion');
			$element->documento = implode(",",($this->input->post('tipoDocumento') ? $this->input->post('tipoDocumento') : $array ));
			$element->oficina   = implode(",",($this->input->post('oficina') ? $this->input->post('oficina') : $array ));
			$element->buscar    = $this->input->post('buscar');
			$element->usuario 	= $user[0]['USUID'];
			$elementObj         = (object) $element;
			// die(var_dump($elementObj));
			$elemento = $this->model_visualizacion->get_det_documentos($elementObj);
			if (!empty($elemento)) {
				foreach ($elemento as $key) {
					$row = array();
					$row[] = $key->PERTENECIENTE;
					$row[] = $key->IDENTIFICADOR;
					$row[] = $key->OFICINA;
					$row[] = $key->NOMBREDOC;
					$row[] = $key->DUENNO;
					$row[] = $key->ESTADO;
					$row[] = $key->FECHAVIGENCIA;
					$row[] = $key->TRABAJADOR;
					$rampla = ($key->DUENNO == 'Rampla' ? 'ramplas/' : ''); 
					if(empty($key->PATH_DOC)){
						$row[] = $key->FULL_PATH;
						$url   = $key->FULL_PATH;
					}else{
						$row[] = base_url().'doc/'.$rampla.$key->PATH_DOC;
						$url   = base_url().'doc/'.$rampla.$key->PATH_DOC;
					}
					$row[] = array('USUARIO_APROBADOR'   => $key->USUARIO_APROBACION,
						'MOTIVO_RECHAZO'      => $key->MOTIVO_RECHAZO,
						'OBSERVACION_RECHAZO' => $key->OBSERVACION_RECHAZO,
						'URL'				 => $url,
						'ESTADO_APROBACION'   => $key->ESTADO_APROBACION,
						'FECHA_APROBACION'	 => $key->FECHA_APROBACION
					);
					$row[] = $key->ESTADO_APROBACION;
					
					$data[]  = $row;
				}	
			}
		}
		$this->output->set_output(json_encode($data));
	}


	private function is_empty($post)
	{
		if (!empty($post)) {
			return $post;
		}else{
			return 'ALL';
		}
	}

	private function is_null($string)
	{
		if (empty($string)) {
			return 0;
		}
		return $string;
	}
	
	public function is_mayor($number)
	{
		return ($number >= 100 ) ? 100 : $number;
	}


	private function calcular_porcentaje_inf($doc_trans,$por_camion,$por_chofer,$por_ayudante)
	{
		$suma=0;
		$div = 0;
		if (!empty($doc_trans)) {
			$div ++;
		} 
		if (!empty($por_camion)) {
			$div ++;
		}
		if (!empty($por_chofer)) {
			$div ++;
		}
		if (!empty($por_ayudante)) {
			$div ++;
		}

		if ($div == 0) {
			$div = 1;
		}

		$suma += ($this->is_mayor(floatval($doc_trans))+$this->is_mayor(floatval($por_camion))+$this->is_mayor(floatval($por_chofer))+$this->is_mayor(floatval($por_ayudante)));
		$totalPorcentaje = round((($suma*100)/($div * 100)),1);
		return $this->is_mayor($totalPorcentaje);
	}


	public function get_cumplimiento_rampas_view()
	{
		$element = array();
		if ($this->input->is_ajax_request()) {
			$array = array();
			$array[] = 0;
			$documento = implode(",",($this->input->post('tipo_doc') ? $this->input->post('tipo_doc') :$array  ));
			$oficina   = implode(",",($this->input->post('oficina') ? $this->input->post('oficina') : $array  ));
			 // die(var_dump($documento));

			$field = $this->model_visualizacion->get_cumplimiento_rampas($oficina,$documento);

			foreach ($field as $key) {
				$row = array();
				$row['codigo_oficina'] = $key->CODIGO_OFICINA;
				$row['nombre_oficina'] = ucwords(mb_strtolower($key->NOMBRE_OFICINA));
				$row['promedio']       = $this->is_mayor(floatval($this->is_null($key->PORCENTAJE_RAMPA)));
				$row['button']  = '<a class="btn btn-sm bg-navy btn-block" href="'.site_url('view_det_documentacion/').$key->CODIGO_OFICINA.'" >Ver detalle</a>';
				$element[]             = $row;
			}
		}

		$this->output->set_output(json_encode($element));
	}



}