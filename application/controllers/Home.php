<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	private $maintenance = 'errors/html/maintenance';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		$this->load->library('login');
		if ($this->agent->browser() == 'Internet Explorer' && $this->agent->version() <= 11) {
			redirect(base_url().'index.php/Welcome', 'refresh');
		}else{
			$this->load->model('model_t_user');	
			$this->load->library('limpiar_log');
		}		
		//Do your magic here
	}


	public function inicio(){
		if($this->session->userdata('usuario') > 0){
			redirect(base_url().'index.php/index','refresh');
		}else{
			$this->menuLogin();
		}
	}

	public function menuLogin(){		
		$this->load->view('login');
	}

	public function login()
	{		
		if ($this->input->post()) {
			$usu          = $this->input->post('user');
			$pass         = $this->input->post('pass');
			$result       = $this->model_t_user->check($usu,$pass);
			$msg['status']="";
			if (!empty($result)) {
				// die(var_dump($result));
				$this->session->set_userdata('usuario',$result);
				$this->session->set_userdata('login', true);

				$usuario = $this->model_t_user->get_usuario($this->login->limpiar_rut($result[0]['RUT_USUARIO']));
				foreach ($usuario as $key) {
					$this->session->set_userdata('nombre', $this->login->mayucula_minuscula($key->USUNOM));
					$this->session->set_userdata('oficina_origen', $key->OF_ORIGEN);
					$this->session->set_userdata('oficina_codigo', $key->OFICOD);
					$this->session->set_userdata('oficina_nombre', $this->login->mayucula_minuscula($key->NOMBRE_OFICINA));
					$this->session->set_userdata('departamento', $this->login->mayucula_minuscula($key->NOM_DEPTO));
					// $this->session->set_userdata('rol', $key->ROLID);
				}
				foreach ($usuario as $key) {
					$rol[] = $key->ROLID;
				}
				$this->session->set_userdata('rol', $rol);
				$this->session->set_userdata('rut', $this->login->limpiar_rut($result[0]['RUT_USUARIO']));
            	$this->session->set_userdata('login', true);
            	$this->session->set_userdata('last_visited' , time());
				$msg['status']=TRUE;
			}else{
				$msg['status']= FALSE;
			}
			echo json_encode($msg);
		}else{
			redirect(base_url().'index.php/sin_acceso', 'refresh');
		}
	}

	public function no_login (){
		$this->load->view('login');
	}


	public function logout(){
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('usuario');
		$this->session->sess_destroy();
		redirect(base_url().'index.php/index','refresh');
		
	}

  	public function maintenance()
  	{
	    $this->output->set_status_header('503'); 
	    $this->load->view($this->maintenance);
  	}

}
