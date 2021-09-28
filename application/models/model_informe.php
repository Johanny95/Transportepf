<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_informe extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_informe_vigencia($oficina,$fecha){
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_INFORME_VIG_OFICINA", array
			(
				array('name' => ':CUR_INFORME','value' => $curs,'type' => OCI_B_CURSOR,'length' => -1),
				array('name' => ':CODIGO_OFICINA','value' => $oficina,'type' => SQLT_CHR,'length' => -1),				
				array('name' => ':VAR_FECHA','value' => $fecha,'type' => SQLT_CHR,'length' => -1)
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

	public function get_informe_ALLOFI($fecha){
		// die($fecha);
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_INFORME_VIGENCIA", array
			(
				array('name' => ':CUR_INFORME','value' => $curs,'type' => OCI_B_CURSOR,'length' => -1),			
				array('name' => ':VAR_FECHA','value' => $fecha,'type' => SQLT_CHR,'length' => -1)
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

	

	public function getTiposDocsConFechaVig(){
		$str_sql ="SELECT DISTINCT NOMBREDOC
		FROM  SFLOTA_TIPO_DOC					        
		WHERE RANGO_DIAS_ESTADO IS NOT NULL";
		$query   = $this->db->query($str_sql);
		$result  = $query->result_array();
		return $result;
	}

	public function get_oficinas(){
		$str_sql = "SELECT ID_OFICINA AS CODIGO_OFICINA,
                           OFICINA    AS NOMBRE_OFICINA 
                                     FROM  SGT_OFICINAS@PPFERI 
                                     WHERE NVL(FECHA_DESACTIVO,SYSDATE)>=SYSDATE
                                     AND    ID_OFICINA IN (
 										SELECT  DLC.CODIGO
                                        FROM    DEV_LOOKUP_TYPES@PPFERI DLT,
                                            DEV_LOOKUP_CODES@PPFERI  DLC
                                        WHERE   DLT.DEV_LOOKUP_TYPE_ID = DLC.DEV_LOOKUP_TYPE_ID
                                            AND DLT.FLAG = 'S'
                                            AND DLC.FLAG = 'S'
                                            AND DLT.TYPE_NAME = 'PF_OFICINAS_MANT_FLOTA'
                                     )                                                                                  
                                     ORDER BY ID_OFICINA
                                     ";
		$query   = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

  public function get_oficinas_row($id){
    $str_sql = "SELECT OFICINA    AS NOMBRE_OFICINA 
                                     FROM  SGT_OFICINAS@PPFERI 
                                     WHERE NVL(FECHA_DESACTIVO,SYSDATE)>=SYSDATE
                                     AND    ID_OFICINA IN (
                    SELECT  DLC.CODIGO
                                        FROM    DEV_LOOKUP_TYPES@PPFERI DLT,
                                            DEV_LOOKUP_CODES@PPFERI  DLC
                                        WHERE   DLT.DEV_LOOKUP_TYPE_ID = DLC.DEV_LOOKUP_TYPE_ID
                                            AND DLT.FLAG = 'S'
                                            AND DLC.FLAG = 'S'
                                            AND DLT.TYPE_NAME = 'PF_OFICINAS_MANT_FLOTA'
                                     ) 
                                     AND    ID_OFICINA = '".$id."'                                                                            
                                     ORDER BY ID_OFICINA
                                     ";
    $query   = $this->db->query($str_sql);
    $result  = $query->row();
    return $result;
  }

	public function get_porcentajes_grafico(){
		$str_sql = "SELECT * FROM
							        (SELECT TO_DATE(FECHA,'DD-MM-YYYY') FECHA,
							                TRIM(TO_CHAR(TO_DATE(FECHA,'DD-MM-RRRR','NLS_DATE_LANGUAGE=SPANISH'),'MONTH RRRR'))MES_ANO,
							                TRIM(TO_CHAR(TO_DATE(FECHA,'DD-MM-RRRR'),'MONTH','NLS_DATE_LANGUAGE=SPANISH')) MES,
							                ROUND(AVG(TOTAL_PORCENTAJE),2) TOTAL_MES
							        FROM   SFLOTA_PORCENTAJES_HIST
							        GROUP BY FECHA 
							        ORDER BY FECHA DESC)
				    WHERE ROWNUM <=12
				    ORDER BY FECHA ASC";
		$query   = $this->db->query($str_sql);
		$result  = $query->result_array();
		return $result;
	}

	public function get_tipo_documento()
	{
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","GET_DOCUMENTO", array
			(
				array('name' => ':Var_Cur','value' => $curs,'type' => OCI_B_CURSOR,'length' => -1)
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
	
	public function get_informe_nacional($oficina,$tipo_doc,$fecha)
	{
		// die(var_dump($tipo_doc));
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","GET_INF_TRANSPORTE_NACIONAL", array
			(
				array('name' =>':VAR_OFICINA','value'=>$oficina,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_TIPO_DOC','value'=>$tipo_doc,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_FECHA','value'=>$fecha,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':Var_Cur','value' => $curs,'type' => OCI_B_CURSOR,'length' => -1)
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

	public function Get_Informe_doc_vigente($elemento)
	{
		// die(var_dump($elemento));
		$curs = $this->db->get_cursor();
		$this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","GET_INFORME_DOC_VIGENTE", array
			(
				array('name' =>':VAR_FECHA'				,'value'=>$elemento->fecha 		,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_ESTADO'			,'value'=>$elemento->estado 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_DOC'				,'value'=>$elemento->documento  ,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_DUE'				,'value'=>$elemento->duenno 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_OFI'				,'value'=>$elemento->oficina 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_BUSCAR'			,'value'=>$elemento->buscar 	,'type'=>SQLT_CHR, 'length'=>-1),
				array('name' =>':VAR_ESTADO_APROBACION' ,'value'=>$elemento->est_aprob 	,'type'=>SQLT_CHR, 'length'=>-1),
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

	//19-10-2018 QUERY PAGO PREVISIONAL
	public function get_informe_previsional_tripulacion($oficinas){
		
         // die(var_dump($tipo_doc));
        $lista='';
        foreach ($oficinas as $key => $v) {
         $lista.=$v.',';
        }
        $curs = $this->db->get_cursor();
        $this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_INFORME_PREV_TRI", array
            (
                array('name' =>':VAR_OFICINA','value'=> substr($lista, 0,-1) ,'type'=>SQLT_CHR, 'length'=>-1),
                array('name' =>':Var_Cur','value' => $curs,'type' => OCI_B_CURSOR,'length' => -1)
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

	//19-10-2018 QUERY PAGO PREVISIONAL
	public function get_informe_previsional_transp( $oficinas){
        // die(var_dump($tipo_doc));
        $lista='';
        foreach ($oficinas as $key => $v) {
         $lista.=$v.',';
        }
        $curs = $this->db->get_cursor();
        $this->db->stored_procedure("PF_SFLOTA_TRANSPORTE","SP_GET_INFORME_PREV_TRANSP", array
            (
                array('name' =>':VAR_OFICINA','value'=> substr($lista, 0,-1) ,'type'=>SQLT_CHR, 'length'=>-1),
                array('name' =>':Var_Cur','value' => $curs,'type' => OCI_B_CURSOR,'length' => -1)
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