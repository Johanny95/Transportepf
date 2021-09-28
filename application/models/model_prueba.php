<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_prueba extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function login($usuario,$pass){
		$this->db->select('ID_USUARIO,NOMBREUSUARIO');
		$this->db->from('PF_SG_USUARIO');
		$this->db->where('USULOGIN',$usuario);
		$this->db->where('PASS',$pass);
		$data=$this->db->get();
		return $data->result();
	}

	public function usuarios(){
		$this->db->select('ID_USUARIO,NOMBREUSUARIO,USULOGIN,CREATION_DATE,ESTADO');
		$this->db->from('PF_SG_USUARIO');
		$data=$this->db->get();
		return $data->result();
	}

	public function getTransportistas1(){
		$this->db->select('RUT_PROVEEDOR,RAZON_SOCIAL,ID_PROVEEDOR');
		$this->db->from('VIEW_TRANSPORTISTAS');
		$data=$this->db->get();
		return $data->result();
	}

	public function addDoc($rut,$fecha,$doc,$tipoDoc){
		$this->db->trans_start();
		$this->db->stored_procedure("PF_PRUEBA_TRANSPORTE","SP_INSERT_ARCHIVO", array
			(
				array('name' =>':ARCHIVO_DATA','value'=>$doc,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':RUT_PROVEEDOR','value'=>$rut,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':ESTADO_DOC','value'=>1,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':TIPO_DOC','value'=>$tipoDoc,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':FECHA_VIGENCIA','value'=>$fecha,'type'=>SQLT_CHR, 'length'=>-1)
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

	public function getTransportistas()
	{
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_PRUEBA_TRANSPORTE","SP_SELECT_TRANSPORT", array
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

    public function getArchivos($rut){
    	$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_PRUEBA_TRANSPORTE","SP_SELECT_ARCHIVOS", array
			(array('name' => ':TRANSPOR_CHOF_CUR','value' => $curs,'type' => OCI_B_CURSOR,'length' => -1),
			array('name' =>':RUT_PROVEEDOR','value'=>$rut,'type'=>SQLT_CHR, 'length'=>-1)
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

    public function getTiposDoc(){
    	$this->db->select('ID_TIPO_DOC,TIPO_DOC');
    	$this->db->from('SG_TIPO_DOC_TRANS');
    	$data=$this->db->get();
    	return $data->result();
    }

    public function updateUsuario($id,$nombre,$pass){
    	$data=array("NOMBREUSUARIO"=>$nombre,"PASS"=>$pass);
    	$this->db->where("ID_USUARIO",$id);
    	$this->db->where('PASS',$pass);
    	$this->db->update("PF_SG_USUARIO",$data);
    }

    public function eliminar($id){
    	$data=array('ESTADO'=>0);
    	$this->db->where('ID_USUARIO', $id);
    	$this->db->update('PF_SG_USUARIO',$data);
    }








}
