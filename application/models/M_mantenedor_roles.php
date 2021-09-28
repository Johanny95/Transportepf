<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mantenedor_roles extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_usuario_rol_transp($autocompletar){
		// die(var_dump($autocompletar));
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_USUARIO_TRANSPORTE_ROL", array
			(
				array('name' => ':AUTOCOMPLETAR', 'value' => $autocompletar,'type' => SQLT_CHR,'length' => -1),
				array('name' => ':CUR_USU',		  'value' => $curs,'type' => OCI_B_CURSOR,'length' => -1)
			)
		);
		oci_execute($curs);
		$data = array();
		while (($row = oci_fetch_object($curs)) != false) {
			$data[] = $row;
		}
		oci_free_statement($curs);
		$result = $data;
		return $result; 
	}

	public function get_roles(){
		// die(var_dump($autocompletar));
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_ROLES_SISTEMA_FLOTA", array
			(
				array('name' => ':CUR_USU', 'value' => $curs,'type' => OCI_B_CURSOR,'length' => -1)
			)
		);
		oci_execute($curs);
		$data = array();
		while (($row = oci_fetch_object($curs)) != false) {
			$data[] = $row;
		}
		oci_free_statement($curs);
		$result = $data;
		return $result; 
	}

	public function get_usurol_flota($filtro_tipo_rol){
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_ROLES_SISTEMA", array
			(
				array('name' => ':FILTRO_TIPO_ROL'  , 'value' => $filtro_tipo_rol 	, 'type' => SQLT_CHR 		,'length' => -1),
				array('name' => ':CUR_USU' 			, 'value' => $curs 				, 'type' => OCI_B_CURSOR 	,'length' => -1)
			)
		);
		oci_execute($curs);
		$data = array();
		while (($row = oci_fetch_object($curs)) != false) {
			$data[] = $row;
		}
		oci_free_statement($curs);
		$result = $data;
		return $result; 
	}

	public function add_usu_rol($elemento){
		$aux = array();
		$sp = oci_parse($this->db->conn_id, "BEGIN PF_SFLOTA_TRANSPORTE.SP_ADD_USUROL(:P_USUID,:P_IDROL,:P_OFICINAS,:VAR_DOCUMENTOS,:P_ID_USUARIO,:P_ESTADO_PROCESO); END;");
		oci_bind_by_name($sp, ":P_USUID"			,    $elemento['USUARIO']			, 1000);
		oci_bind_by_name($sp, ":P_IDROL"			,    $elemento['IDROL']				, 1000);
		oci_bind_by_name($sp, ":P_OFICINAS"			,    $elemento['OFICINAS']			, 1000);
		oci_bind_by_name($sp, ":VAR_DOCUMENTOS"		,    $elemento['DOCUMENTOS']		, 1000);
		oci_bind_by_name($sp, ":P_ID_USUARIO"		,    $elemento['USUARIO_SESSION']	, 1000);
		oci_bind_by_name($sp, ":P_ESTADO_PROCESO"	,    $aux[]	);

		oci_execute($sp, OCI_DEFAULT);
		return (!empty($aux[0])) ? $aux[0] : 0;
	}

	public function upd_usu_rol($elemento){
		$aux = array();
		$sp = oci_parse($this->db->conn_id, "BEGIN PF_SFLOTA_TRANSPORTE.SP_UDP_USUROL(:P_USUID,:P_IDROL,:P_OFICINAS,:VAR_DOCUMENTOS,:VAR_ESTADO_ROL,:P_ID_USUARIO,:P_ESTADO_PROCESO); END;");
		oci_bind_by_name($sp, ":P_USUID"			,    $elemento['USUARIO']			, 1000);
		oci_bind_by_name($sp, ":P_IDROL"			,    $elemento['IDROL']				, 1000);
		oci_bind_by_name($sp, ":P_OFICINAS"			,    $elemento['OFICINAS']			, 1000);
		oci_bind_by_name($sp, ":VAR_DOCUMENTOS"		,    $elemento['DOCUMENTOS']		, 1000);
		oci_bind_by_name($sp, ":VAR_ESTADO_ROL"		,    $elemento['ESTADO_ROL']		, 1000);
		oci_bind_by_name($sp, ":P_ID_USUARIO"		,    $elemento['USUARIO_SESSION']	, 1000);
		oci_bind_by_name($sp, ":P_ESTADO_PROCESO"	,    $aux[]	);
		oci_execute($sp, OCI_DEFAULT);
		return (!empty($aux[0])) ? $aux[0] : 0;
	}

	

	public function get_oficinas_usuario($usuid, $rolid){
		$this->db->select("CODIGO_OFICINA ID_OFICINA");
		$this->db->select("ID_TIPO_DOC");
		$this->db->from('SFLOTA_DOC_OFICINA_USUARIO');
		$this->db->where('ESTADO','S');
		$this->db->where('USUID',$usuid);
		$this->db->where('ROLID',$rolid);
		$data=$this->db->get()->result();
		return $data;
	}


	public function get_usuoficina($usuid){
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_OFICINAS_USUARIO", array
			(
				array('name' => ':USUID'  			, 'value' => $usuid 			, 'type' => SQLT_CHR 		,'length' => -1),
				array('name' => ':CUR_USU' 			, 'value' => $curs 				, 'type' => OCI_B_CURSOR 	,'length' => -1)
			)
		);
		oci_execute($curs);
		$data = array();
		while (($row = oci_fetch_object($curs)) != false) {
			$data[] = $row;
		}
		oci_free_statement($curs);
		$result = $data;
		return $result; 
	}


	public function get_usudocumentos($usuid){
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_TIPODOC_USUARIO", array
			(
				array('name' => ':USUID'  			, 'value' => $usuid 			, 'type' => SQLT_CHR 		,'length' => -1),
				array('name' => ':CUR_USU' 			, 'value' => $curs 				, 'type' => OCI_B_CURSOR 	,'length' => -1)
			)
		);
		oci_execute($curs);
		$data = array();
		while (($row = oci_fetch_object($curs)) != false) {
			$data[] = $row;
		}
		oci_free_statement($curs);
		$result = $data;
		return $result; 
	}

	

}