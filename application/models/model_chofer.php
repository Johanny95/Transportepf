<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_chofer extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function getListChofer($id_transportista,$oficina){		
		$this->db->select('CODCHOFER,RUTCHOFER,NOMBRECHOFER');
		$this->db->from('SFLOTA_CHOFERES');
		$this->db->where('ID_TRANSPORTISTA',$id_transportista);
		$this->db->where('OFICINA_TRANSP',$oficina);
		$this->db->where('ESTADO_CHOFER','H');		
		$this->db->where('VER_EN_OFI','S');	
		$data=$this->db->get()->result();
		return $data;
	}

	public function getDocsChofer($codigo,$oficina){
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GETDOCS_CHOFER", array
			(
				array('name' => ':TRANSPOR_CHOF_CUR' 	,'value' => $curs 	 	,'type' => OCI_B_CURSOR ,'length' => -1),
				array('name' => ':CODCHOFER' 			,'value' => $codigo 	,'type' => SQLT_CHR 	,'length' => -1),
				array('name' => ':OFICINA_ID' 			,'value' => $oficina 	,'type' => SQLT_CHR 	,'length' => -1)
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

	public function addDocChofer($codChofer,$tipoDoc,$path,$full_path,$fecha,$user_id,$duenno,$id_proveedor,$oficina){
		$this->db->trans_start();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_ADDDOC_CHOFER", array
			(
				array('name' =>':COD_CAMION' 	,'value'=>$codChofer 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':TIPODOC'		,'value'=>$tipoDoc 		,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':PATH'			,'value'=>$path 		,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':FULL_PATH'		,'value'=>$full_path 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':FECHA_V'		,'value'=>$fecha 		,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':ID_USUARIO'	,'value'=>$user_id 	 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':DUENNO'		,'value'=>$duenno 		,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':ID_PROVEEDOR'	,'value'=>$id_proveedor ,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':OFICINA'		,'value'=>$oficina 		,'type'=>SQLT_CHR, 'length'=>-1)
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

	public function getChofer($cod){
		// $curs = $this->db->get_cursor();
		// $this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GETCHOFER", array
		// 	(
		// 		array('name' => ':TRANSPOR_CHOF_CUR','value' => $curs,'type' => OCI_B_CURSOR,'length' => -1),
		// 		array('name' => ':CODCHOFER','value' => $cod,'type' => SQLT_CHR,'length' => -1)
		// 	)
		// );
		// oci_execute($curs);
		// $data = array();
		// while (($row = oci_fetch_object($curs)) != false) {
		// 	$data[] = $row;
		// }
		// oci_free_statement($curs);
		// $result = $data;
		// return $result; 
		$str_sql="SELECT 
			            C.CODCHOFER,
			            C.NOMBRECHOFER,
			            C.FONOCHOFER,
			            C.ESTADO_CHOFER,
			            C.RUTCHOFER,
			            C.LICENCIA,
			            O.OFICINA ,
			            C.CREATION_DATE,
			            C.FOTO,
			            C.CORREO
			       FROM SFLOTA_CHOFERES C, 
			            ( SELECT *
                         FROM  SGT_OFICINAS@PPFERI 
                         WHERE NVL(FECHA_DESACTIVO,SYSDATE)>=SYSDATE
                                     AND   
                          ID_OFICINA IN (
                            SELECT  DLC.CODIGO
                            FROM    DEV_LOOKUP_TYPES@PPFERI DLT,
                                DEV_LOOKUP_CODES@PPFERI  DLC
                            WHERE   DLT.DEV_LOOKUP_TYPE_ID = DLC.DEV_LOOKUP_TYPE_ID
                                AND DLT.FLAG = 'S'
                                AND DLC.FLAG = 'S'
                                AND DLT.TYPE_NAME = 'PF_OFICINAS_MANT_FLOTA'
                         )                                                                             
                         ORDER BY ID_OFICINA) O 
			       WHERE 
			            C.CODOFICINA = O.ID_OFICINA
			       AND  '".$cod."' =C.CODCHOFER";
		// die(print_r($str_sql));
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

	public function validarDuenno($cod,$ofi){
		$this->db->select('DUENNO VALIDADOR');
		$this->db->from('SFLOTA_CHOFERES');
		$this->db->where('CODCHOFER',$cod);
		$this->db->where('CODOFICINA',$ofi);
		$data=$this->db->get()->result_array();		
		return $data;
	}

	public function updateChofer($codChofer,$telefono,$licencia,$estado,$correo){
		$user=$this->session->userdata('usuario');
		$this->db->trans_start();
		$this->db->set('FONOCHOFER', $telefono);
		$this->db->set('LICENCIA', $licencia);
		$this->db->set('ESTADO_CHOFER', $estado);
		$this->db->set('LAST_UPDATE_DATE', date('d/m/Y'));
		$this->db->set('UPDATED_BY',$user[0]['USUID']);
		$this->db->set('LAS_UPDATE_BY',$user[0]['USUID']);
		$this->db->set('CORREO', $correo);
		$this->db->where('CODCHOFER',$codChofer);
		$this->db->update('SFLOTA_CHOFERES');
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return $this->getChofer($codChofer);
		}
	}

	public function getHistDocsChofer($codChofer, $tipoDoc){
		$str_sql="SELECT * 
		FROM      		(SELECT DISTINCT 
		C.PATH_DOC,
		C.FULL_PATH,
		C.ESTADO,
		TO_DATE(C.CREATION_DATE,'DD/MM/RRRR') FECHACREACION,
		C.CREATION_DATE
		FROM   SFLOTA_CHOFERES T, SFLOTA_DOC_CHOFER C, SFLOTA_TIPO_DOC TC
		WHERE  T.CODCHOFER   = C.COD_CHOFER
		AND    C.ID_TIPO_DOC = TC.ID_TIPO_DOC 
		AND    C.ID_TIPO_DOC = '".$tipoDoc."'
		AND    C.COD_CHOFER  = '".$codChofer."'
		ORDER BY C.CREATION_DATE DESC)
		WHERE ROWNUM <=12";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
// 		   select * from (select C.PATH_DOC,C.ESTADO,to_date(C.CREATION_DATE,'DD/MM/RRRR') FECHACREACION 
//             from sflota_camion t, sflota_doc_camion c, sflota_tipo_doc tc 
//             where t.CODCAMION=C.COD_CAMION
//             and C.ID_TIPO_DOC=TC.ID_TIPO_DOC
//             and c.ID_TIPO_DOC=ID_TYPE_DOC
//             and c.COD_CAMION=COD_CAMION
//             order by FECHACREACION DESC)where
//             rownum <= 12;
	}


	public function addImgChofer($codigo_chofer,$ruta,$user_id){
		$this->db->trans_start();
			$this->db->set('FOTO', $ruta);
			$this->db->set('LAST_UPDATE_DATE', date('d/m/Y'));
			$this->db->set('LAS_UPDATE_BY',$user_id);
			$this->db->where('CODCHOFER',$codigo_chofer);
			$this->db->update('SFLOTA_CHOFERES');
			if ($this->db->trans_status() === FALSE)
			{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return $this->getChofer($codigo_chofer);
		}
	}
}