<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_informe extends PF_Controller {

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


	public function indexInformeVencimiento(){
		if($this->session->userdata('usuario')>0){
			// $data['grafico'] = $this->datos_grafico();
			// die(var_dump($data['grafico']));
			$this->load->view('template/header');
			$data['getOficinas']= $this->model_informe->get_oficinas();
			$this->load->view('informes/informe_vencimiento',$data);
			$this->load->view('template/footer');
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}


	public function get_informe_vigencia(){
		$msg['status']="";
		$msg['error']="";
		if($this->input->post()){
			if($this->session->userdata('usuario')>0){
				$this->form_validation->set_rules('oficina', 'Oficina', 'required|max_length[3]|trim');
				$this->form_validation->set_rules('fecha', 'Fecha', 'trim|required|max_length[12]');
				if($this->form_validation->run()==FALSE){
					$msg['status']=FALSE;
					$msg['error']=validation_errors();
				}else{
					$oficina = $this->input->post('oficina');
					$fecha   = $this->input->post('fecha');
					$datos['documentos']= $this->model_informe->getTiposDocsConFechaVig();
					if($oficina == -1){
						$datos['registros']= $this->model_informe->get_informe_ALLOFI($fecha);
					}else{
						$datos['registros']= $this->model_informe->get_informe_vigencia($oficina,$fecha);
					}
					if(count($datos['registros'])>0){
						$msg['vista'] = $this->load->view('informes/tabla_resumen', $datos , true);
						$msg['status']= TRUE;
					}else{
						$msg['stauts']=FALSE;
						$msg['error']='No existen documentos en la oficina seleccionada';
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

	public function datos_grafico(){
		$datos=$this->model_informe->get_porcentajes_grafico();			
		echo json_encode( $datos );
	}

	public function get_informe_nacional_view()
	{
		$data['oficina'] = $this->model_informe->get_oficinas();
		$data['tipo_doc'] = $this->model_informe->get_tipo_documento();
		$this->load->view('template/header');
		$this->load->view('informes/informe_nacional',$data);
		$this->load->view('template/footer');
	}

	public function get_informe_nacional()
	{
		$element = array();
		if ($this->input->post()) {
        	$fecha           = substr($this->input->post('fecha'), 0, 10);

            $oficina         = $this->input->post('oficina');
            $oficina_str     = '';
            $tipo_doc        = $this->input->post('tipo_doc');
            $tipo_doc_str    = '';

            if ($this->validateDate($fecha)) {
            	$fecha = $fecha;
            }else{
                $fecha = date("d/m/Y");
            }

			if (is_array($oficina)) {
				foreach ($oficina as $key) {
					$oficina_str .= $key.' ';
				}

				$oficina_str = $this->addLast_comma($oficina_str);
				$oficina_str = $this->subString($oficina_str);
				$oficina_str = $this->is_empty($oficina_str);
			}else{
				if (!empty($oficina)) {
					$oficina_str = $oficina;
				}else{
					$oficina_str = 'ALL';
				}
			}
			if (!empty($tipo_doc)) {
				foreach ($tipo_doc as $key) {
					$tipo_doc_str .= $key.' ';
				}

				$tipo_doc_str = $this->addLast_comma($tipo_doc_str);
				$tipo_doc_str = $this->subString($tipo_doc_str);
				$tipo_doc_str = $this->is_empty($tipo_doc_str);
			}else{
				$tipo_doc_str = 'ALL';
			}

			$field = $this->model_informe->get_informe_nacional($oficina_str,$tipo_doc_str,$fecha);

			foreach ($field as $key) {
				$row = array();
				$row['codigo_oficina'] = $key->OFICINA;
				$row['nombre_oficina'] = ucwords(mb_strtolower($key->NOMBRE_OFICINA));
				$row['promedio']       = $this->is_mayor(floatval($this->is_null($key->DOC_TRANS)));
				$row['porccamion']     = $this->is_mayor(floatval($this->is_null($key->PORCCAMION)));
				$row['porcchofer']     = $this->is_mayor(floatval($this->is_null($key->PORCCHOFER)));
				$row['porcayudante']   = $this->is_mayor(floatval($this->is_null($key->PORCAYUDANTE)));
				$row['total_oficina']  = $this->calcular_porcentaje_inf($key->DOC_TRANS,$key->PORCCAMION,$key->PORCCHOFER,$key->PORCAYUDANTE).'%';
				$element[]             = $row;
			}
		}

		$this->output->set_output(json_encode($element));
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

    private function validateDate($date)
    {
        $d = DateTime::createFromFormat('d/m/Y', $date);
        return $d && $d->format('d/m/Y') === $date;
    }


	private function addLast_comma($string)
	{
		$temp = implode(",", preg_split("/[\s]+/", $string)); 
		return $temp;
	}

	private function subString($string)
	{
		$temp = substr ($string, 0, strlen($string) - 1);
		return $temp;	
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

	public function indexInformeVencimientoBeta(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$data['getOficinas']= $this->model_informe->get_oficinas();
			$data['documentos']= $this->model_informe->get_tipo_documento();
			$this->load->view('informes/informe_vencimiento_beta',$data);
			$this->load->view('template/footer');
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function get_informe_doc_vigente()
	{
		$data = array();
		if ($this->input->is_ajax_request()) {
			// die(var_dump($this->input->post()));
			// $estado = $this->input->post('estado');
			// $buscar = $this->input->post('buscar');
			// $tipoDocumento = $this->input->post('tipoDocumento');
			// $propietario = $this->input->post('propietario');

			// $estado = (!empty($estado)) ? $estado : 'VIGENTE';
			// $tipoDocumento = (!empty($tipoDocumento)) ? $tipoDocumento : '1';
			// $propietario = (!empty($propietario)) ? $propietario : 'ALL';
			// $buscar = (!empty($buscar)) ? $buscar : NULL;
			$oficina = $this->input->post('oficina');
			// die(var_dump($this->input->post()));
			if (is_numeric($oficina)) {
				$oficina = $this->model_informe->get_oficinas_row($oficina);
				$oficina = $oficina->NOMBRE_OFICINA;
			}

			$element            = new stdClass;
			$element->fecha     = $this->input->post('fecha');
			$element->estado    = $this->input->post('estado');;
			$element->documento = $this->input->post('tipoDocumento');;
			$element->duenno    = $this->input->post('propietario');;
			$element->est_aprob = $this->input->post('est_aprobacion');
			$element->oficina   = $oficina;
			$element->buscar    = $this->input->post('buscar');
			$elementObj         = (object) $element;
			// die(var_dump($elementObj));
			$elemento = $this->model_informe->Get_Informe_doc_vigente($elementObj);
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
}