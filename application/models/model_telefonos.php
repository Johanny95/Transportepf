<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class model_telefonos extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function addTelefono($imei,$marca,$modelo,$desc,$id_usuario){
		$this->db->trans_start();
		$telefono=array('IMEI'=>$imei,'MARCA'=>$marca,'MODELO'=>$modelo,'DESCRIPCION'=>$desc,'ESTADO'=>'H',
			'CREATION_DATE'=>date('d/m/Y h:i:s'),'CREATE_BY'=>$id_usuario);
		$this->db->insert('SFLOTA_TELEFONO',$telefono);
		if ($this->db->trans_status() === FALSE ){
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return true;
		}
	}

	public function updateEstadoTelefono($imei,$motivo,$id_usuario){
		$this->db->set('DESCRIPCION', $motivo);
		$this->db->set('ESTADO', 'D');
		$this->db->set('DELETE_BY', $id_usuario);			
		$this->db->set('DELETE_DATE', date('d/m/Y h:i:s'));			
		$this->db->where('IMEI',$imei);
		$this->db->update('SFLOTA_TELEFONO');
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE ){
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return true;
		}
	}

	public function des_relacion_tel_chof($imei,$codchofer,$estado,$fecha,$motivo,$id_usuario){
		$this->db->set('ESTADO', 'D');
		$this->db->set('MOTIVO', $motivo);
		$this->db->set('FECHA_DESACTIVO', date('d/m/Y h:i:s'));			
		$this->db->set('DELETE_BY', $id_usuario);			
		$this->db->set('DELETE_DATE', date('d/m/Y h:i:s'));			
		$this->db->where('IMEI',$imei);
		$this->db->where('COD_CHOFER',$codchofer);
		$this->db->where('ESTADO',$estado);
		$this->db->where('FECHA_INGRESO',$fecha);
		$this->db->update('SFLOTA_TELEFONO_CAM_CHOF');
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE ){
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return true;
		}	
	}

	public function validarImei($imei){
		$this->db->select(' COUNT(*) VALIDADOR');
		$this->db->from('SFLOTA_TELEFONO');
		$this->db->where('IMEI',$imei);
		$data=$this->db->get()->result_array();		
		return $data;
	}	

	public function updateTelefono($imei,$marca,$modelo,$desc,$id_usuario){
		$this->db->trans_start();
		$this->db->set('MARCA', $marca);
		$this->db->set('MODELO', $modelo);
		$this->db->set('DESCRIPCION', $desc);
		$this->db->set('UPDATE_BY', $id_usuario);
		$this->db->set('DESCRIPCION', $desc);		
		$this->db->where('IMEI',$imei);
		$this->db->update('SFLOTA_TELEFONO');
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE ){
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return true;
		}
	}

	public function getTelefonos(){
		$this->db->select('IMEI,
			MARCA,
			MODELO,
			DESCRIPCION,
			ESTADO, 
			CREATION_DATE');
		$this->db->from('SFLOTA_TELEFONO');
		$data=$this->db->get()->result();
		return $data;
	}

	public function getChoferTelefonos($oficina){
		$this->db->select('CODCHOFER,
			NOMBRECHOFER,
			RUTCHOFER
			');
		$this->db->from('SFLOTA_CHOFERES');
		$this->db->where('CODOFICINA',$oficina);
		$this->db->where('VER_EN_OFI','S');	
		$this->db->where('ESTADO_CHOFER','H');			
		$data=$this->db->get()->result();
		return $data; 
	}

	public function getCamionesTelefono($oficina){
		$this->db->select('CODCAMION,
			PATENTE						   
			');
		$this->db->from('SFLOTA_CAMION');
		$this->db->where('OFICINA',$oficina);
		$this->db->where('ESTADO_CAMION','H');	
		$data=$this->db->get()->result();
		return $data; 
	}

	public function validar_relacion($nombreCampo,$imei){
		$this->db->select('COUNT(*) VALIDADOR');
		$this->db->from('SFLOTA_TELEFONO_CAM_CHOF');
		$this->db->where($nombreCampo,$imei);
		$this->db->where('ESTADO','H');
		$data=$this->db->get()->result();		
		return $data; 
	}

	public function addRelacion($imei,$chofer,$oficina,$camion,$patente,$numero,$ruta,$id_usuario){
		$this->db->trans_start();
		$relacion=array('IMEI'          =>$imei,
			'COD_CHOFER'    =>$chofer,
			'OFICINACHOFER' =>$oficina,
			'CODCAMION'	    =>$camion,
			'PATENTE'       =>$patente,
			'ESTADO'        =>'H',
			'NUM_TELEFONO'	=>$numero,
			'PATH_DOC'		=>$ruta,
			'FECHA_INGRESO' =>date('d/m/Y h:i:s'),
			'CREATE_BY'     =>$id_usuario
		);
		$this->db->insert('SFLOTA_TELEFONO_CAM_CHOF',$relacion);
		if ($this->db->trans_status() === FALSE ){
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return true;
		}		
	}

	public function getRelaciones(){				
		$str_sql ="SELECT   DISTINCT T.IMEI,
		CH.RUTCHOFER,
		R.COD_CHOFER,
		CH.NOMBRECHOFER,
		R.PATENTE,
		T.MARCA,
		R.ESTADO,
		R.NUM_TELEFONO,
		R.PATH_DOC,
		R.FECHA_INGRESO,
		TO_DATE(TO_DATE(R.FECHA_INGRESO,'DD/MM/RRRR HH12:MI:SS'),'DD/MM/RRRR') FECHA,
		TO_DATE(TO_DATE(R.FECHA_DESACTIVO,'DD/MM/RRRR HH12:MI:SS'),'DD/MM/RRRR') FECHA_DESACTIVO,
		R.MOTIVO,
		R.OFICINACHOFER,
		O.OFICINA
		FROM 
		SFLOTA_TELEFONO T,
		SFLOTA_CHOFERES CH,
		SFLOTA_TELEFONO_CAM_CHOF R,
		(SELECT ID_OFICINA,
		OFICINA
		FROM  SGT_OFICINAS@PPFERI 
		WHERE NVL(FECHA_DESACTIVO,SYSDATE)>=SYSDATE
		AND    ID_OFICINA IN ('10','15','20','25','30','35','38','40','48','52','60','62','65','80','81','90')                                                                                  
		ORDER BY ID_OFICINA) O                       
		WHERE  	 
		CH.CODCHOFER  = R.COD_CHOFER
		AND     T.IMEI        = R.IMEI
		AND     O.ID_OFICINA  = R.OFICINACHOFER";
		$query   = $this->db->query($str_sql);
		$result  = $query->result_array();
		return $result;
	}

	public function getHistorialTelefonos($codChofer){
		$str_sql ="SELECT 
                IMEI,
                TO_DATE(TO_DATE(FECHA_INGRESO,'DD/MM/RRRR HH12:MI:SS'),'DD/MM/RRRR') FECHA,
                TO_DATE(TO_DATE(FECHA_DESACTIVO,'DD/MM/RRRR HH12:MI:SS'),'DD/MM/RRRR') FECHA_DESACTIVO,
                ESTADO,
                NUM_TELEFONO,
                PATENTE,
                MOTIVO,
                PATH_DOC
        FROM 
        SFLOTA_TELEFONO_CAM_CHOF
        WHERE COD_CHOFER = '".$codChofer."'
        ORDER BY FECHA_INGRESO DESC";
		$query   = $this->db->query($str_sql);
		$result  = $query->result_array();
		return $result;	
	}

	public function getHistoFonos($imei){
		$str_sql ="SELECT
                DISTINCT C.CODCHOFER,
                C.NOMBRECHOFER,
                TO_DATE(TO_DATE(R.FECHA_INGRESO,'DD/MM/RRRR HH12:MI:SS'),'DD/MM/RRRR') FECHA,
                TO_DATE(TO_DATE(R.FECHA_DESACTIVO,'DD/MM/RRRR HH12:MI:SS'),'DD/MM/RRRR') FECHA_DESACTIVO,
                R.ESTADO,
                R.NUM_TELEFONO,
                R.PATENTE,
                R.MOTIVO,
                R.PATH_DOC
        FROM 
        SFLOTA_TELEFONO_CAM_CHOF R,
        SFLOTA_CHOFERES          C
        WHERE R.IMEI       = '".$imei."'
        AND   R.COD_CHOFER = C.CODCHOFER
        ORDER BY R.ESTADO DESC";
		$query   = $this->db->query($str_sql);
		$result  = $query->result_array();
		return $result;		
	}

}