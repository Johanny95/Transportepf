<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_aprobacion_documentos extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_documentos_usuario_transp($elemento){

		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_DOCUMENTOS_USU_TRANSP", array
			(
				array('name' => ':USERID' , 'value' => $elemento['USERID']  ,'type' => SQLT_CHR 	,'length' => -1),
				// array('name' => ':OFICINA', 'value' => $elemento['OFICINA'] ,'type' => SQLT_CHR 	,'length' => -1),
				// array('name' => ':TIPODOC', 'value' => $elemento['TIPODOC'] ,'type' => SQLT_CHR  	,'length' => -1),
				array('name' => ':OFICINA', 'value' => '' ,'type' => SQLT_CHR 	,'length' => -1),
				array('name' => ':TIPODOC', 'value' => '' ,'type' => SQLT_CHR  	,'length' => -1),
				array('name' => ':CUR_USU',	'value' => $curs 				,'type' => OCI_B_CURSOR ,'length' => -1)
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

	public function get_documentos_usuario_camion($elemento){

		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_DOC_USU_CAMION", array
			(
				array('name' => ':USERID' , 'value' => $elemento['USERID']  ,'type' => SQLT_CHR 	,'length' => -1),
				// array('name' => ':OFICINA', 'value' => $elemento['OFICINA'] ,'type' => SQLT_CHR 	,'length' => -1),
				// array('name' => ':TIPODOC', 'value' => $elemento['TIPODOC'] ,'type' => SQLT_CHR  	,'length' => -1),
				array('name' => ':OFICINA', 'value' => '' ,'type' => SQLT_CHR 	,'length' => -1),
				array('name' => ':TIPODOC', 'value' => '' ,'type' => SQLT_CHR  	,'length' => -1),
				array('name' => ':CUR_USU',	'value' => $curs 				,'type' => OCI_B_CURSOR ,'length' => -1)
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

	public function get_documentos_usuario_chofer($elemento){

		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_DOC_USU_CHOFER", array
			(
				array('name' => ':USERID' , 'value' => $elemento['USERID']  ,'type' => SQLT_CHR 	,'length' => -1),
				// array('name' => ':OFICINA', 'value' => $elemento['OFICINA'] ,'type' => SQLT_CHR 	,'length' => -1),
				// array('name' => ':TIPODOC', 'value' => $elemento['TIPODOC'] ,'type' => SQLT_CHR  	,'length' => -1),
				array('name' => ':OFICINA', 'value' => '' ,'type' => SQLT_CHR 	,'length' => -1),
				array('name' => ':TIPODOC', 'value' => '' ,'type' => SQLT_CHR  	,'length' => -1),
				array('name' => ':CUR_USU',	'value' => $curs 				,'type' => OCI_B_CURSOR ,'length' => -1)
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
	
	public function get_documentos_usuario_ayudante($elemento){

		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_DOC_USU_AYUDANTE", array
			(
				array('name' => ':USERID' , 'value' => $elemento['USERID']  ,'type' => SQLT_CHR 	,'length' => -1),
				// array('name' => ':OFICINA', 'value' => $elemento['OFICINA'] ,'type' => SQLT_CHR 	,'length' => -1),
				// array('name' => ':TIPODOC', 'value' => $elemento['TIPODOC'] ,'type' => SQLT_CHR  	,'length' => -1),
				array('name' => ':OFICINA', 'value' => '' ,'type' => SQLT_CHR 	,'length' => -1),
				array('name' => ':TIPODOC', 'value' => '' ,'type' => SQLT_CHR  	,'length' => -1),
				array('name' => ':CUR_USU',	'value' => $curs 				,'type' => OCI_B_CURSOR ,'length' => -1)
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

	public function sp_get_doc_usu_rampa($elemento){

		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_DOC_USU_RAMPA", array
			(
				array('name' => ':USERID' , 'value' => $elemento['USERID']  ,'type' => SQLT_CHR 	,'length' => -1),
				// array('name' => ':OFICINA', 'value' => $elemento['OFICINA'] ,'type' => SQLT_CHR 	,'length' => -1),
				// array('name' => ':TIPODOC', 'value' => $elemento['TIPODOC'] ,'type' => SQLT_CHR  	,'length' => -1),
				array('name' => ':OFICINA', 'value' => '' ,'type' => SQLT_CHR 	,'length' => -1),
				array('name' => ':TIPODOC', 'value' => '' ,'type' => SQLT_CHR  	,'length' => -1),
				array('name' => ':CUR_USU',	'value' => $curs 				,'type' => OCI_B_CURSOR ,'length' => -1)
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

	public function get_motivos_recha_documento(){
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_MOTIVOS_RECHAZO_DOC", array
			(
				array('name' => ':CUR',	'value' => $curs 				,'type' => OCI_B_CURSOR ,'length' => -1)
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




	public function aprob_documenento_transp($elemento){
		$aux = array();
		$sp = oci_parse($this->db->conn_id, "BEGIN PF_SFLOTA_TRANSPORTE.SP_APROBACION_DOC_TRANSP(:DOCID, :USUARIO, :P_ESTADO_PROCESO); END;");
		oci_bind_by_name($sp, ":DOCID"				,    $elemento['DOCID']		, 1000);
		oci_bind_by_name($sp, ":USUARIO"			,    $elemento['USUARIO']	, 1000);
		oci_bind_by_name($sp, ":P_ESTADO_PROCESO"	,    $aux[]	);
		oci_execute($sp, OCI_DEFAULT);
		return (!empty($aux[0])) ? $aux[0] : 0;
	}



	public function aprob_documenento_camion($elemento){
		$aux = array();
		$sp = oci_parse($this->db->conn_id, "BEGIN PF_SFLOTA_TRANSPORTE.SP_APROBACION_DOC_CAMION(:DOCID, :USUARIO, :P_ESTADO_PROCESO); END;");
		oci_bind_by_name($sp, ":DOCID"				,    $elemento['DOCID']		, 1000);
		oci_bind_by_name($sp, ":USUARIO"			,    $elemento['USUARIO']	, 1000);
		oci_bind_by_name($sp, ":P_ESTADO_PROCESO"	,    $aux[]	);
		oci_execute($sp, OCI_DEFAULT);
		return (!empty($aux[0])) ? $aux[0] : 0;
	}

	public function aprob_documenento_chofer($elemento){
		$aux = array();
		$sp = oci_parse($this->db->conn_id, "BEGIN PF_SFLOTA_TRANSPORTE.SP_APROBACION_DOC_CHOFER(:DOCID, :USUARIO, :P_ESTADO_PROCESO); END;");
		oci_bind_by_name($sp, ":DOCID"				,    $elemento['DOCID']		, 1000);
		oci_bind_by_name($sp, ":USUARIO"			,    $elemento['USUARIO']	, 1000);
		oci_bind_by_name($sp, ":P_ESTADO_PROCESO"	,    $aux[]	);
		oci_execute($sp, OCI_DEFAULT);
		return (!empty($aux[0])) ? $aux[0] : 0;
	}

	public function aprob_documenento_ayudante($elemento){
		$aux = array();
		$sp = oci_parse($this->db->conn_id, "BEGIN PF_SFLOTA_TRANSPORTE.SP_APROBACION_DOC_AYUDANTE(:DOCID, :USUARIO, :P_ESTADO_PROCESO); END;");
		oci_bind_by_name($sp, ":DOCID"				,    $elemento['DOCID']		, 1000);
		oci_bind_by_name($sp, ":USUARIO"			,    $elemento['USUARIO']	, 1000);
		oci_bind_by_name($sp, ":P_ESTADO_PROCESO"	,    $aux[]	);
		oci_execute($sp, OCI_DEFAULT);
		return (!empty($aux[0])) ? $aux[0] : 0;
	}

	public function aprob_documenento_rampla($elemento){
		$aux = array();
		$sp = oci_parse($this->db->conn_id, "BEGIN PF_SFLOTA_TRANSPORTE.SP_APROBACION_DOC_RAMPLA(:DOCID, :USUARIO, :P_ESTADO_PROCESO); END;");
		oci_bind_by_name($sp, ":DOCID"				,    $elemento['DOCID']		, 1000);
		oci_bind_by_name($sp, ":USUARIO"			,    $elemento['USUARIO']	, 1000);
		oci_bind_by_name($sp, ":P_ESTADO_PROCESO"	,    $aux[]	);
		oci_execute($sp, OCI_DEFAULT);
		return (!empty($aux[0])) ? $aux[0] : 0;
	}
	
	
	public function rechazar_documenento_transp($elemento){
		$aux = array();
		$sp = oci_parse($this->db->conn_id, "BEGIN PF_SFLOTA_TRANSPORTE.SP_RECHAZAR_DOC_TRANSP(:DOCID, :MOTIVO, :OBSERVACION, :USUARIO, :P_ESTADO_PROCESO); END;");
		oci_bind_by_name($sp, ":DOCID"				,    $elemento['DOCID']			, 1000);
		oci_bind_by_name($sp, ":MOTIVO"				,    $elemento['MOTIVO']		, 1000);
		oci_bind_by_name($sp, ":OBSERVACION"		,    $elemento['OBSERVACION']	, 1000);
		oci_bind_by_name($sp, ":USUARIO"			,    $elemento['USUARIO']		, 1000);
		oci_bind_by_name($sp, ":P_ESTADO_PROCESO"	,    $aux[]	);
		oci_execute($sp, OCI_DEFAULT);
		return (!empty($aux[0])) ? $aux[0] : 0;
	}

	public function rechazar_documenento_camion($elemento){
		$aux = array();
		$sp = oci_parse($this->db->conn_id, "BEGIN PF_SFLOTA_TRANSPORTE.SP_RECHAZAR_DOC_CAMION(:DOCID, :MOTIVO, :OBSERVACION, :USUARIO, :P_ESTADO_PROCESO); END;");
		oci_bind_by_name($sp, ":DOCID"				,    $elemento['DOCID']			, 1000);
		oci_bind_by_name($sp, ":MOTIVO"				,    $elemento['MOTIVO']		, 1000);
		oci_bind_by_name($sp, ":OBSERVACION"		,    $elemento['OBSERVACION']	, 1000);
		oci_bind_by_name($sp, ":USUARIO"			,    $elemento['USUARIO']		, 1000);
		oci_bind_by_name($sp, ":P_ESTADO_PROCESO"	,    $aux[]	);
		oci_execute($sp, OCI_DEFAULT);
		return (!empty($aux[0])) ? $aux[0] : 0;
	}

	public function rechazar_documenento_chofer($elemento){
		$aux = array();
		$sp = oci_parse($this->db->conn_id, "BEGIN PF_SFLOTA_TRANSPORTE.SP_RECHAZAR_DOC_CHOFER(:DOCID, :MOTIVO, :OBSERVACION, :USUARIO, :P_ESTADO_PROCESO); END;");
		oci_bind_by_name($sp, ":DOCID"				,    $elemento['DOCID']			, 1000);
		oci_bind_by_name($sp, ":MOTIVO"				,    $elemento['MOTIVO']		, 1000);
		oci_bind_by_name($sp, ":OBSERVACION"		,    $elemento['OBSERVACION']	, 1000);
		oci_bind_by_name($sp, ":USUARIO"			,    $elemento['USUARIO']		, 1000);
		oci_bind_by_name($sp, ":P_ESTADO_PROCESO"	,    $aux[]	);
		oci_execute($sp, OCI_DEFAULT);
		return (!empty($aux[0])) ? $aux[0] : 0;
	}

	public function rechazar_documenento_ayudante($elemento){
		$aux = array();
		$sp = oci_parse($this->db->conn_id, "BEGIN PF_SFLOTA_TRANSPORTE.SP_RECHAZAR_DOC_AYUDANTE(:DOCID, :MOTIVO, :OBSERVACION, :USUARIO, :P_ESTADO_PROCESO); END;");
		oci_bind_by_name($sp, ":DOCID"				,    $elemento['DOCID']			, 1000);
		oci_bind_by_name($sp, ":MOTIVO"				,    $elemento['MOTIVO']		, 1000);
		oci_bind_by_name($sp, ":OBSERVACION"		,    $elemento['OBSERVACION']	, 1000);
		oci_bind_by_name($sp, ":USUARIO"			,    $elemento['USUARIO']		, 1000);
		oci_bind_by_name($sp, ":P_ESTADO_PROCESO"	,    $aux[]	);
		oci_execute($sp, OCI_DEFAULT);
		return (!empty($aux[0])) ? $aux[0] : 0;
	}
	
	public function rechazar_documenento_rampla($elemento){
		$aux = array();
		$sp = oci_parse($this->db->conn_id, "BEGIN PF_SFLOTA_TRANSPORTE.SP_RECHAZAR_DOC_RAMPA(:DOCID, :MOTIVO, :OBSERVACION, :USUARIO, :P_ESTADO_PROCESO); END;");
		oci_bind_by_name($sp, ":DOCID"				,    $elemento['DOCID']			, 1000);
		oci_bind_by_name($sp, ":MOTIVO"				,    $elemento['MOTIVO']		, 1000);
		oci_bind_by_name($sp, ":OBSERVACION"		,    $elemento['OBSERVACION']	, 1000);
		oci_bind_by_name($sp, ":USUARIO"			,    $elemento['USUARIO']		, 1000);
		oci_bind_by_name($sp, ":P_ESTADO_PROCESO"	,    $aux[]	);
		oci_execute($sp, OCI_DEFAULT);
		return (!empty($aux[0])) ? $aux[0] : 0;
	}

	/*QUERYS MIS APROBACIONES Y RECHAZADOS*/

	

	public function get_mis_aprobaciones_doc($elemento){
		// die(var_dump( $elemento['FECHA_DESDE']));
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_MISDOCUMENTOS_APROB", array
			(
				array('name' => ':USERID' 			, 'value' => $elemento['USERID']      ,'type' => SQLT_CHR 		,'length' => -1),
				array('name' => ':OFICINA'			, 'value' => $elemento['OFICINA']     ,'type' => SQLT_CHR 		,'length' => -1),
				array('name' => ':VAR_DOC'			, 'value' => $elemento['TIPODOC'] 	  ,'type' => SQLT_CHR 		,'length' => -1),
				array('name' => ':VAR_FECHA_DESDE'	, 'value' => $elemento['FECHA_DESDE'] ,'type' => SQLT_CHR 		,'length' => -1),
				array('name' => ':VAR_FECHA_HASTA'	, 'value' => $elemento['FECHA_HASTA'] ,'type' => SQLT_CHR 		,'length' => -1),
				array('name' => ':VAR_ESTADO'		, 'value' => $elemento['ESTADO_APROBACION'] ,'type' => SQLT_CHR 		,'length' => -1),
				array('name' => ':CUR_USU'			, 'value' => $curs 				      ,'type' => OCI_B_CURSOR 	,'length' => -1)
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