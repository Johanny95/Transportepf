<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_transporte extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function addTipoDoc($n,$a,$d,$dias,$user,$compartido,$oficinas){
		$this->db->trans_start();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_ADDTIPODOC", array
			(
				array('name' =>':nombre'		,'value'=>$n 			,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':afectado'		,'value'=>$a 			,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':descripcion'	,'value'=>$d 			,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':dias'			,'value'=>$dias 		,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':user'			,'value'=>$user 		,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':compartido'	,'value'=>$compartido 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':oficinas'		,'value'=>$oficinas 	,'type'=>SQLT_CHR, 'length'=>-1)
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

	public function eliminar_documento($codigo, $afectado){
		$user=$this->session->userdata('usuario');
		$this->db->trans_start();
		$this->db->set('ESTADO' 			 , 'Historico');
		$this->db->set('LAST_UPDATE_DATE'    , date('d/m/Y'));
		$this->db->set('UPDATED_BY'     	 , $user[0]['USUID']);
		$this->db->set('LAS_UPDATE_BY'   	 , $user[0]['USUID']);
		$this->db->set('DELETED_BY'     	 , $user[0]['USUID']);
		$this->db->set('DELETED_DATE'   	 , 'SYSDATE',false);
		if($afectado =='TRANSP'){
			$this->db->where('COD_DOC_TRANS'  	 	, $codigo);
			$this->db->update('SFLOTA_DOC_TRANSP');
		}elseif ($afectado =='CAMION') {
			$this->db->where('COD_DOC_CAMION'  		, $codigo);
			$this->db->update('SFLOTA_DOC_CAMION');
		}elseif ($afectado =='CHOFER') {
			$this->db->where('COD_DOC_CHOFER'   	, $codigo);
			$this->db->update('SFLOTA_DOC_CHOFER');
		}elseif ($afectado =='AYUDANTE') {
			$this->db->where('COD_DOC_AYUDANTE'   	, $codigo);
			$this->db->update('SFLOTA_DOC_AYUDANTE');
		}	elseif ($afectado =='RAMPLA') {
			$this->db->where('COD_DOC_RAMPLA'   	, $codigo);
			$this->db->update('SFLOTA_DOC_RAMPLA');
		}	
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function updateTransportista($id_proveedor,$telefono,$direccion,$correo,$propietario,$sitioweb,$oficina){
		$user=$this->session->userdata('usuario');
		$this->db->trans_start();
		$this->db->set('TELEFONO'   		 , $telefono);
		$this->db->set('DIRECCION' 			 , $direccion);
		$this->db->set('CORREO'       		 , $correo);
		$this->db->set('PROPIETARIO'         , $propietario);
		$this->db->set('SITIOWEB'       	 , $sitioweb);
		$this->db->set('LAST_UPDATE_DATE'    , date('d/m/Y'));
		$this->db->set('UPDATED_BY'     	 , $user[0]['USUID']);
		$this->db->set('LAS_UPDATE_BY'   	 , $user[0]['USUID']);
		$this->db->where('ID_PROVEEDOR'   	 , $id_proveedor);
		$this->db->where('OFICINA'   	     , $oficina);		
		$this->db->update('SFLOTA_TRANSPORTISTA');
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return $this->getTransp($id_proveedor,$oficina);
		}
	}

	public function getResumenOficina(){
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_RESUMEN_OFICINA", array
			(
				array('name' => ':TRANSPOR_CHOF_CUR','value' => $curs,'type' => OCI_B_CURSOR,'length' => -1)
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
	/*se modifica proceso el 02-10-2019*/
	public function editTipoDoc($cod,$nombre,$afectado,$descrip,$dias_aviso,$user,$oficinas,$estado){
		$this->db->trans_start();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_SET_TIPO_DOCUMENTO", array
			(
				array('name' =>':VAR_ID_TIPO_DOC'	,'value'=>$cod 			,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_NOMBRE'		,'value'=>$nombre		,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_AFECTADO'		,'value'=>$afectado		,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_DESC'			,'value'=>$descrip 		,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_DIAS'			,'value'=>$dias_aviso	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':ID_USER'			,'value'=>$user 	 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_OFICINAS'		,'value'=>$oficinas 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_ESTADO'		,'value'=>$estado 	 	,'type'=>SQLT_CHR, 'length'=>-1)
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

	public function getTiposDocsAll(){
		$this->db->select("ID_TIPO_DOC,
			NOMBREDOC, nvl(LEGISLACION,'Sin descripción') as DESCRIP,
			decode(AFECTADO,'T','Transportista','C','Camion','CH','Chofer','A','Ayudante','R','Rampla') as AFECTADO,
			RANGO_DIAS_ESTADO, NVL(to_char(DELETED_DATE,'DD-MM-RRRR'),'ACTIVO') FECHA_ELIMINACION");
		$this->db->from('SFLOTA_TIPO_DOC');
		$data=$this->db->get()->result();
		return $data;	
	}

	public function tipoDocsTransp($tipo){
		$this->db->select('ID_TIPO_DOC,NOMBREDOC');
		$this->db->from('SFLOTA_TIPO_DOC');
		$this->db->where('AFECTADO',$tipo);
		$this->db->where('DELETED_DATE IS NULL');
		$data=$this->db->get()->result();
		return $data;
	}

	public function getTransportistas()
	{
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_SELECT_TRANSPORTISTAS", array
			(
				array('name' => ':TRANSPOR_CHOF_CUR','value' => $curs,'type' => OCI_B_CURSOR,'length' => -1)
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

	public function getDoctransportista($codigo,$oficina){
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GETDOCS_TRANSP", array
			(
				array('name' => ':TRANSPOR_CHOF_CUR','value' => $curs,'type' => OCI_B_CURSOR,'length' => -1),
				array('name' => ':ID_PROVEEDOR','value' => $codigo,'type' => SQLT_CHR,'length' => -1),
				array('name' => ':OFICINA','value' => $oficina,'type' => SQLT_CHR,'length' => -1)
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

	public function getTransp($id_prov,$oficina){
		$this->db->select('*');
		$this->db->from('SFLOTA_TRANSPORTISTA');
		$this->db->where('ID_PROVEEDOR',$id_prov);
		$this->db->where('OFICINA',$oficina);
		$data=$this->db->get()->result();
		return $data;
	}

	public function getHistDocTransp($id_prov,$oficina,$tipoDoc){
		$str_sql="SELECT * 
		FROM      		(SELECT DISTINCT C.PATH_DOC,
		C.FULL_PATH,
		C.ESTADO,
		TO_DATE(C.CREATION_DATE,'DD/MM/RRRR') FECHACREACION,
		C.CREATION_DATE
		FROM   SFLOTA_TRANSPORTISTA T, SFLOTA_DOC_TRANSP C, SFLOTA_TIPO_DOC TC
		WHERE  T.ID_PROVEEDOR    = C.COD_TRANS
		AND    C.ID_TIPO_DOC     = TC.ID_TIPO_DOC
		AND    T.OFICINA         = '".$oficina."'
		AND    C.ID_TIPO_DOC     = '".$tipoDoc."'
		AND    C.COD_TRANS       = '".$id_prov."'
		ORDER BY C.CREATION_DATE DESC)
		WHERE ROWNUM <=12";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}
	
	public function getValidadorVigencia($cod){
		$this->db->select('NVL(RANGO_DIAS_ESTADO,-1) VALIDADOR');
		$this->db->from('SFLOTA_TIPO_DOC');
		$this->db->where('ID_TIPO_DOC',$cod);
		$data=$this->db->get()->result();
		return $data;
	}

	public function getValidadorDocCompartido($cod){
		$this->db->select("NVL(COMPARTIDO,'NO') COMPARTIDO");
		$this->db->from('SFLOTA_TIPO_DOC');
		$this->db->where('ID_TIPO_DOC',$cod);
		$data=$this->db->get()->result();
		return $data;
	}

	public function getChoferAyudantes($id_transportista,$oficina){
		$str_sql="SELECT 	CODCHOFER, 
		RUTCHOFER, 
		NOMBRECHOFER,
		'CHOFER' AS TIPO
		FROM 		SFLOTA_CHOFERES
		WHERE 	ID_TRANSPORTISTA=".$id_transportista."
		AND     OFICINA_TRANSP  =".$oficina."
		AND     ESTADO_CHOFER  = 'H'
		AND     VER_EN_OFI     = 'S'
		UNION ALL
		SELECT    CODAYUDANTE,
		RUTAYUDATE,
		NOMBREAYUDANTE,
		'AYUDANTE' AS TIPO
		FROM		SFLOTA_AYUDANTES
		WHERE 	ID_TRANSPORTISTA=".$id_transportista."
		AND     ESTADO_AYUDANTE = 'H'
		AND     VER_OFICINA_EDIT = 'S'
		AND     OFICINA_TRANSP  =".$oficina;
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

	public function addDocTransp($idTransp,$oficina,$tipoDoc,$path,$full_path,$fecha,$id_usuario,$choferes,$ayudantes){
		$this->db->trans_start();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_ADDDOC_TRANSP", array
			(
				array('name' =>':ID_TRANSP','value'=>$idTransp,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_OFICINA','value'=>$oficina,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':TIPODOC','value'=>$tipoDoc,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':PATH','value'=>$path,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':FULL_PATH','value'=>$full_path,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':FECHA_V','value'=>$fecha,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':ID_USUARIO','value'=>$id_usuario,'type'=>SQLT_CHR, 'length'=>-1)
			)
		);
		if($choferes[0] != ""){
			$this->db->from('SFLOTA_TIPO_DOC');
			$this->db->where('COMPARTIDO',$tipoDoc);
			$this->db->where('AFECTADO','CH');
			$data=$this->db->get()->result();
			$codDocChofer=$data[0]->ID_TIPO_DOC;
			//ciclo insert Docs choferes
			foreach ($choferes as $key) {
				$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_ADDDOC_CHOFER", array
					(
						array('name' =>':COD_CHOFER','value'=>$key,'type'=>SQLT_CHR, 'length'=>-1),
						array('name' =>':TIPODOC','value'=>$codDocChofer,'type'=>SQLT_CHR, 'length'=>-1),
						array('name' =>':PATH','value'=>$path,'type'=>SQLT_CHR, 'length'=>-1),
						array('name' =>':FULL_PATH','value'=>$full_path,'type'=>SQLT_CHR, 'length'=>-1),
						array('name' =>':FECHA_V','value'=>$fecha,'type'=>SQLT_CHR, 'length'=>-1),
						array('name' =>':ID_USUARIO','value'=>$id_usuario,'type'=>SQLT_CHR, 'length'=>-1),
						array('name' =>':DUENNO','value'=>'N','type'=>SQLT_CHR, 'length'=>-1),
						array('name' =>':ID_PTOVEEDOR_VAR','value'=>$idTransp,'type'=>SQLT_CHR, 'length'=>-1),
						array('name' =>':OFICINA_VAR','value'=>$oficina,'type'=>SQLT_CHR, 'length'=>-1)
					)
				);
			}

		}
		//INSERT DOC AYUDANTE
		if($ayudantes[0] != ""){
			$this->db->from('SFLOTA_TIPO_DOC');
			$this->db->where('COMPARTIDO',$tipoDoc);
			$this->db->where('AFECTADO','A');
			$data=$this->db->get()->result();
			$codDocAyudante=$data[0]->ID_TIPO_DOC;
			//insert docs ayudantes
			foreach ($ayudantes as $key) {
				$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_ADDDOC_AYUDANTE", array
					(
						array('name' =>':COD_AYUDANTE','value'=>$key,'type'=>SQLT_CHR, 'length'=>-1),
						array('name' =>':TIPODOC','value'=>$codDocAyudante,'type'=>SQLT_CHR, 'length'=>-1),
						array('name' =>':PATH','value'=>$path,'type'=>SQLT_CHR, 'length'=>-1),
						array('name' =>':FULL_PATH','value'=>$full_path,'type'=>SQLT_CHR, 'length'=>-1),
						array('name' =>':FECHA_V','value'=>$fecha,'type'=>SQLT_CHR, 'length'=>-1),
						array('name' =>':ID_USUARIO','value'=>$id_usuario,'type'=>SQLT_CHR, 'length'=>-1)
					)
				);
			}
		}
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

	/** 06/04/2018 **/

	public function get_transportista($oficina)
	{
		$this->db->select('ID_PROVEEDOR');
		$this->db->select('RUT_TANSPORTISTA');
		$this->db->select('RAZON_SOCIAL');
		$this->db->from('SFLOTA_TRANSPORTISTA');
		$this->db->where('OFICINA',$oficina);
		$this->db->where('ESTADO_TRANSPORTISTA','H');
		$this->db->where('OFICINA IS NOT NULL');
		$this->db->where('OFICINA_FLOTA','S');
		$query = $this->db->get();
		return $query->result();
	}

	public function check_oficinas($oficina)
	{
		$string = " SELECT *
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
		AND  ID_OFICINA = ".$oficina."
		ORDER BY ID_OFICINA";
		$query = $this->db->query($string);
		return $query->result();
	}

	public function get_oficinas_documento($id_tipo_documento){
		$this->db->select("CODIGO_OFICINA ID_OFICINA");
		$this->db->select("ID_TIPO_DOC");
		$this->db->from('SFLOTA_DOCUMENTO_OFICINA');
		$this->db->where('ESTADO','S');
		$this->db->where('ID_TIPO_DOC',$id_tipo_documento);
		$data=$this->db->get()->result();
		return $data;
	}



}
