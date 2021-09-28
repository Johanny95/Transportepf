<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check_session extends CI_Controller{

  public function __construct() {
      parent::__construct();
  }

  public function checkSession() {
    $timout = '+' . $this->config->item('pf_sess_time') . ' minutes' ;                        // Timeout de la sesion
    $sessionRenew = date('Y-m-d H:i:s',$this->session->userdata("last_visited"));             // Ultimo timestamp de cuando se renovó la sesión
    $sessionExpire = date("Y-m-d H:i:s", strtotime($timout, strtotime($sessionRenew)));       // Timestamp de cuando caducará la sesión
    $sessionNow = date("Y-m-d H:i:s");                                                        // Timestamp de este instante

    // Si estamos en un instante anterior a la caducidad de la sesion solo retornamos true
    if( $sessionNow < $sessionExpire ){
        $r['logged'] = true;
    }
    // Sino devolvemos FALSE y cerramos la sesión
    else{
        $r['logged'] = false;
        $this->session->set_userdata('login') == NULL;
        redirect(site_url('login'), 'refresh');
    }

    echo json_encode($r);
  }

}
