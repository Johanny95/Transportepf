<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PF_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		if($this->session->login == FALSE || $this->session->login == NULL ) {
			redirect(site_url('login'),'refresh');
		}
		$this->session->set_userdata(array('last_visited' => time()));
	}

}

/* End of file  */
/* Location: ./application/controllers/ */