<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_camion extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getPatentes($id_transportista,$oficina){
		// $this->db->select('CODCAMION,PATENTE');
		$this->db->select('CODCAMION,PATENTE, CREATION_DATE FECHA_INGRESO');
		$this->db->from('SFLOTA_CAMION');
		$this->db->where('ID_TRANSPORTISTA',$id_transportista);
		$this->db->where('OFICINA_TRANSP',$oficina);
		$this->db->where('ESTADO_CAMION','H');		
		$data=$this->db->get()->result();
		return $data;
	}

	function getCamion($patente){
		$this->db->select('*');
		$this->db->from('SFLOTA_CAMION C, SFLOTA_INVENTARIO_CAMION I');
		$this->db->where('C.CODCAMION =I.COD_CAMION(+)');
		$this->db->where('CODCAMION',$patente);
		$data=$this->db->get()->result();
		return $data;
	}

	public function getDocCamiones($codigo){
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GETDOCS_CAMION", array
			(
				array('name' => ':TRANSPOR_CHOF_CUR','value' => $curs,'type' => OCI_B_CURSOR,'length' => -1),
				array('name' => ':CODCAMION','value' => $codigo,'type' => SQLT_CHR,'length' => -1)
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

	public function getImagenes($codcamion){
		$this->db->select('PATH_IMG_CAMION');
		$this->db->select('FULL_PATH');
		$this->db->from('SFLOTA_IMAGEN_CAMION');
		$this->db->where('CODCAMION',$codcamion);
		$data=$this->db->get()->result();
		return $data;
	}

	public function addImgCamion($cod_camion,$path,$id_usuario){
		$this->db->trans_start();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_ADDIMG_CAMION", array
			(
				array('name' =>':CODCAMION','value'=>$cod_camion,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':PATH_IMG','value'=>$path,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':USUARIO','value'=>$id_usuario,'type'=>SQLT_CHR, 'length'=>-1)
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

	function updateCamion($cod_camion,$tipo_camion,$sisFrio,$estadoCamion,$uniFrio,$separador,$fijo,$gps,$sdl,$publicidad,$latAncho,$latAlto,$BTAlto,$BTAncho,$gata,$llave_rueda,$triangulo,$llave_contacto,$extintor,$radio,$rueda_repuesto,$botiquin,$fecha_vigencia,$n_motor,$n_chasis,$anno){
		$user    = $this->session->userdata('usuario');
		$user_id = $user[0]['USUID'];
		$this->db->trans_start();
		//update Camion
		$this->db->set('TIPO_CAMION', $tipo_camion);
		$this->db->set('TIPOCOMBUSTIBLE', $sisFrio);
		$this->db->set('ESTADO_CAMION', $estadoCamion);
		$this->db->set('UNIDADFRIO', $uniFrio);
		$this->db->set('SEPARADOR', $separador);
		$this->db->set('FIJO', $fijo);
		$this->db->set('GPS', $gps);
		$this->db->set('SDL', $sdl);
		$this->db->set('N_MOTOR', $n_motor);
		$this->db->set('N_CHASIS', $n_chasis);
		$this->db->set('ANNO', $anno );
		$this->db->set('PUBLICIDAD', $publicidad);
		$this->db->set('LATERALES_ANCHO', $latAncho);
		$this->db->set('LATERALES_ALTO', $latAlto);
		$this->db->set('BACKTRACK_ALTO',$BTAlto);
		$this->db->set('BACKTRACK_ANCHO',$BTAncho);
		$this->db->set('LAST_UPDATE_DATE', date('d/m/Y'));
		$this->db->set('UPDATED_BY', $user_id);
		$this->db->set('LAS_UPDATE_BY', $user_id);
		$this->db->where('CODCAMION',$cod_camion);
		$this->db->update('SFLOTA_CAMION');
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			//UPDATE INVENTARIO CAMION			
			$this->db->select('COUNT(*) as VALIDADOR');
			$this->db->from('SFLOTA_INVENTARIO_CAMION');
			$this->db->where('COD_CAMION',$cod_camion);
			$data=$this->db->get()->result();
			if($data[0]->VALIDADOR>0){
				$this->db->trans_start();
				$this->db->set('GATA', $gata);
				$this->db->set('LLAVE_RUEDA', $llave_rueda);
				$this->db->set('TRIANGULOS', $triangulo);
				$this->db->set('LLAVE_CONTACTO', $llave_contacto);
				$this->db->set('BOTIQUIN', $botiquin);
				$this->db->set('RADIO', $radio);
				$this->db->set('RUEDA_REPUESTO', $rueda_repuesto);
				$this->db->set('EXTINTOR', $extintor);
				$this->db->set('FECHA_VIGENCIA',$fecha_vigencia);
				$this->db->where('COD_CAMION',$cod_camion);
				$this->db->update('SFLOTA_INVENTARIO_CAMION');
				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					return FALSE;
				}else{
					$this->db->trans_commit();
					return $this->getCamion($cod_camion);
				}
			}else{				
				$this->db->trans_start();
				$inventario=array('COD_CAMION'=>$cod_camion,'GATA'=>$gata,'LLAVE_RUEDA'=>$llave_rueda,'TRIANGULOS'=>$triangulo,'LLAVE_CONTACTO'=>$llave_contacto,'BOTIQUIN'=>$botiquin,'RADIO'=>$radio,'RUEDA_REPUESTO'=>$rueda_repuesto,'EXTINTOR'=>$extintor,'FECHA_VIGENCIA'=>$fecha_vigencia);
				$this->db->insert('SFLOTA_INVENTARIO_CAMION',$inventario);
				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					return FALSE;
				}else{
					$this->db->trans_commit();
					return $this->getCamion($cod_camion);
				}
			}
			
		}
		return true;
	}

	function getHistDocsCamion($codCamion,$tipo_doc){
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GETHIST_CAMION", array
			(
				array('name' => ':TRANSPOR_CAM_CUR','value' => $curs,'type' => OCI_B_CURSOR,'length' => -1),
				array('name' => ':CODCAMION','value' => $codCamion,'type' => SQLT_CHR,'length' => -1),
				array('name' => ':TIPO_DOC','value' => $tipo_doc,'type' => SQLT_CHR,'length' => -1)
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

	function addDocCamion($codCamion,$tipoDoc,$path,$full_path,$fecha,$user_id){
		//die($codCamion.' '.$tipoDoc.' '.$path.' '.$full_path.' '.$fecha.' '.$user_id);
		$this->db->trans_start();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_ADDDOC_CAMION", array
			(
				array('name' =>':COD_CAMION','value'=>$codCamion,'type'=>SQLT_CHR, 'length'=>-1),
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




}