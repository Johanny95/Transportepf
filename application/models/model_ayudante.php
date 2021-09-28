<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_ayudante extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function getListAyudante($id_transportista,$oficina){
		$this->db->select('CODAYUDANTE,RUTAYUDATE,NOMBREAYUDANTE');
		$this->db->from('SFLOTA_AYUDANTES');
		$this->db->where('ID_TRANSPORTISTA',$id_transportista);
		$this->db->where('OFICINA',$oficina);
		$this->db->where('ESTADO_AYUDANTE','H');			
		$this->db->where('VER_OFICINA_EDIT','S');//where ver oficina perteneciente
		$data=$this->db->get()->result();
		return $data;
	}

	public function getAyudante($codAyudante){
		$this->db->select('*');
		$this->db->from('SFLOTA_AYUDANTES');
		$this->db->where('CODAYUDANTE',$codAyudante);
		$data=$this->db->get()->result();
		return $data;
	}

	public function updateAyudante($cod_ayudante,$telefono,$direccion,$estado,$correo){
		$user=$this->session->userdata('usuario');
		$this->db->trans_start();
		$this->db->set('FONO_AYUDANTE'   , $telefono);
		$this->db->set('ESTADO_AYUDANTE' , $estado);
		$this->db->set('LAST_UPDATE_DATE', date('d/m/Y'));
		$this->db->set('UPDATED_BY'      , $user[0]['USUID']);
		$this->db->set('LAS_UPDATE_BY'   , $user[0]['USUID']);
		$this->db->set('CORREO' , $correo);
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

	public function getDocsAyudante($codigo,$oficina){
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GETDOCS_AYUDANTE", array
			(
				array('name' => ':TRANSPOR_CHOF_CUR' 	,'value' => $curs  	 ,'type' => OCI_B_CURSOR , 'length' => -1),
				array('name' => ':CODAYUDANTE' 			,'value' => $codigo  ,'type' => SQLT_CHR 	, 'length' => -1),
				array('name' => ':P_OFICINA' 		 	,'value' => $oficina ,'type' => SQLT_CHR 	, 'length' => -1)
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

	public function addDocAyudante($codAyudante,$tipoDoc,$path,$full_path,$fecha,$user_id){
		// die(var_dump($fecha));
		$this->db->trans_start();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_ADDDOC_AYUDANTE", array
			(
				array('name' =>':COD_CAMION','value'=>$codAyudante,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':TIPODOC','value'=>$tipoDoc,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':PATH','value'=>$path,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':FULL_PATH','value'=>$full_path,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':FECHA_V','value'=>$fecha,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':ID_USUARIO','value'=>$user_id,'type'=>SQLT_CHR, 'length'=>-1)
			)
		);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return TRUE;
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