<?php defined('BASEPATH') OR exit('No direct script access allowed');

class model_rampla extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function get_ramplas($id_transportista,$oficina){
		//query
		$this->db->select('RUT_TRANSPORTISTA');
		$this->db->select('RAZON_SOCIAL_TRANSPORTISTA');
		$this->db->select('OFICINA_TRANSP');
		$this->db->select('OFICINA_TRANSPORTISTA');
		$this->db->select('CODRAMPLA');
		$this->db->select('PATENTE');
		$this->db->select('DESCRIPCION_CARRO');
		$this->db->select('REND_LTS_POR_HORA');
		$this->db->select('OFICINA');
		$this->db->select('OFICINA_DESC');
		$this->db->select('ESTADO_ACTIVO');
		$this->db->select('CREATION_DATE');
		$this->db->select('FECHA_ELIMINACION');
		$this->db->from('SFLOTA_RAMPLAS_ACTIVAS');
		$this->db->where('ID_TRANSPORTISTA',$id_transportista);
		$this->db->where('OFICINA',$oficina);
		$data = $this->db->get()->result();
		return $data;
	}




	public function getRampla($cod){
		$this->db->select('*');
		$this->db->from('SFLOTA_RAMPLA');
		$this->db->where('CODRAMPLA',$cod);
		$data=$this->db->get()->result();
		return $data;
	}

	public function updateAyudante($cod_ayudante,$telefono,$direccion,$estado){
		$user=$this->session->userdata('usuario');
		$this->db->trans_start();
		$this->db->set('FONO_AYUDANTE'   , $telefono);
		$this->db->set('ESTADO_AYUDANTE' , $estado);
		$this->db->set('LAST_UPDATE_DATE', date('d/m/Y'));
		$this->db->set('UPDATED_BY'      , $user[0]['USUID']);
		$this->db->set('LAS_UPDATE_BY'   , $user[0]['USUID']);
		$this->db->where('CODAYUDANTE'   , $cod_ayudante);
		$this->db->update('SFLOTA_AYUDANTES');
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return $this->getAyudante($cod_ayudante);
		}
	}

	public function getHistDocsAyudante($codAyudante, $tipoDoc){
		$str_sql="SELECT * 
		FROM      		(SELECT 
		DISTINCT C.PATH_DOC,
		C.FULL_PATH,
		C.ESTADO,
		TO_DATE(C.CREATION_DATE,'DD/MM/RRRR') FECHACREACION,
		C.CREATION_DATE
		FROM   SFLOTA_AYUDANTES T, SFLOTA_DOC_AYUDANTE C, SFLOTA_TIPO_DOC TC
		WHERE  T.CODAYUDANTE   = C.COD_AYUDANTE
		AND    C.ID_TIPO_DOC = TC.ID_TIPO_DOC 
		AND    C.ID_TIPO_DOC = '".$tipoDoc."'
		AND    C.COD_AYUDANTE  = '".$codAyudante."'
		ORDER BY C.CREATION_DATE DESC)
		WHERE ROWNUM <=12";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

	public function getDocsRampla($codigo,$oficina){
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_DOCUMENTOS_RAMPLA", array
			(
				array('name' => ':P_RAMPLA_ID','value' 		 => $codigo 	,'type' => SQLT_CHR 	,'length' => -1),
				array('name' => ':P_OFICINA_ID','value' 	 => $oficina 	,'type' => SQLT_CHR 	,'length' => -1),
				array('name' => ':TRANSPOR_CHOF_CUR','value' => $curs 		,'type' => OCI_B_CURSOR ,'length' => -1)
				
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

	public function addDocRampla($cod,$tipoDoc,$path,$full_path,$fecha,$user_id){
		// die(var_dump($fecha));
		$this->db->trans_start();
		$str_sql="SELECT (TO_NUMBER(NVL(MAX(COD_DOC_RAMPLA),0))+1) id FROM SFLOTA_DOC_RAMPLA";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		$new_id  = $result[0]->ID;
		$this->db->set('COD_DOC_RAMPLA', 	(int)$new_id);
		$this->db->set('COD_RAMPLA', 		$cod);
		$this->db->set('ID_TIPO_DOC',		(int)$tipoDoc);
		$this->db->set('PATH_DOC', 			$path);
		$this->db->set('FULL_PATH', 		$full_path);
		$this->db->set('FECHAVIGENCIA', 	$fecha);
		$this->db->set('ESTADO', 			'Vigente');
		$this->db->set('CREATION_DATE', 	'SYSDATE',FALSE);
		$this->db->set('CREATED_BY', 		$user_id);
		$this->db->set('ESTADO_APROBACION', 'PENDIENTE');
		$this->db->insert('SFLOTA_DOC_RAMPLA');		
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_start();
			$this->db->set('ESTADO', 'Historico');
			$this->db->where('ID_TIPO_DOC',$tipoDoc);
			$this->db->where('COD_RAMPLA',$cod);
			$this->db->where('COD_DOC_RAMPLA !=',$new_id, false );
			$this->db->update('SFLOTA_DOC_RAMPLA');
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return FALSE;
			}else{
				$this->db->trans_commit();
				return TRUE;
			}
		}

	}


	public function addImgAyudante($codigo_ayudante,$ruta,$user_id){
		
		$this->db->trans_start();
		$this->db->set('FOTO', $ruta);
		$this->db->set('LAST_UPDATE_DATE', date('d/m/Y'));
		$this->db->set('LAS_UPDATE_BY',$user_id);
		$this->db->where('CODAYUDANTE',$codigo_ayudante);
		$this->db->update('SFLOTA_AYUDANTES');
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return $this->getAyudante($codigo_ayudante);
		}
	}

}