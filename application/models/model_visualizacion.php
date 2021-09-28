<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_visualizacion extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function get_det_documentos($elemento){
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","GET_DETALLE_DOCUMENTOS", array
			(
				array('name' =>':VAR_FECHA'				,'value'=>$elemento->fecha		,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_ESTADO'			,'value'=>$elemento->estado 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_DOC'				,'value'=>$elemento->documento  ,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_DUE'				,'value'=>$elemento->duenno 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_OFI'				,'value'=>$elemento->oficina 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_BUSCAR'			,'value'=>$elemento->buscar 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_ESTADO_APROBACION' ,'value'=>$elemento->est_aprob 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_USUARIO'			,'value'=>$elemento->usuario 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_CUR'				,'value'=> $curs 				,'type'=>OCI_B_CURSOR,'length' => -1)
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


	public function get_oficinas_oficinas_view($usuid, $rolid){
		$str_sql = "SELECT ID_OFICINA ID_OFICINA, 
					         OFICINA
					    FROM SGT_OFICINAS@PPFERI
					   WHERE     NVL (FECHA_DESACTIVO, SYSDATE) >= SYSDATE
					         AND ID_OFICINA IN
					                (SELECT DLC.CODIGO
					                   FROM DEV_LOOKUP_TYPES@PPFERI DLT,
					                        DEV_LOOKUP_CODES@PPFERI DLC
					                  WHERE     DLT.DEV_LOOKUP_TYPE_ID = DLC.DEV_LOOKUP_TYPE_ID
					                        AND DLT.FLAG = 'S'
					                        AND DLC.FLAG = 'S'
					                        AND DLT.TYPE_NAME = 'PF_OFICINAS_MANT_FLOTA')
					         AND ID_OFICINA IN
					                (SELECT UOFI.CODIGO_OFICINA
					                   FROM SFLOTA_DOC_OFICINA_USUARIO UOFI
					                  WHERE     UOFI.ESTADO = 'S'
					                        AND UOFI.USUID = $usuid
					                        AND UOFI.ROLID = $rolid)
					ORDER BY ID_OFICINA
                                     ";
		$query   = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}


	publiC function get_tipo_view($usuid , $rolid){
		$str_sql = "SELECT ID_TIPO_DOC , NOMBREDOC, AFECTADO
					FROM SFLOTA_TIPO_DOC
					WHERE ID_TIPO_DOC IN (SELECT DISTINCT uofi.id_tipo_doc
					                   FROM SFLOTA_DOC_OFICINA_USUARIO UOFI
					                   WHERE     UOFI.ESTADO = 'S'
					                          AND UOFI.USUID = $usuid
					                          AND UOFI.ROLID = $rolid)";
		$query   = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;	
	}

	public function get_cumplimiento_rampas($oficinas , $documento){
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_CUMPLIMIENTO_RAMPAS", array
			(
				array('name' =>':VAR_OFICINA'			,'value'=>$oficinas		,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_DOCUMENTO'			,'value'=>$documento 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_CUR'				,'value'=> $curs 		,'type'=>OCI_B_CURSOR,'length' => -1)
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