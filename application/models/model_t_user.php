<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_t_user extends CI_Model {

	private $id = 'U.USUID';
	private $nombre = 'U.USUNOM';
	private $oficina_origen = 'U.OF_ORIGEN';
	private $oficina_codigo = 'U.OFICOD';
	private $oficina_nombre = 'O.OFIDESCRIP NOMBRE_OFICINA';
	private $id_login = 'U.USULOGIN';
	private $nombre_departamento = 'D.NOM_DEPTO';
	private $rol = 'I.ROLID';

	private $webusuario = 'WEBUSUARIO U';
	private $webdepartamento = 'PF_MA_DEPARTAMENTOS D';
	private $weboficina = 'orden.gcotoficina O';
	private $webrol = 'ITR_USUROL I';

	private $where_departamento = 'U.ID_DEPTO = D.ID_DEPTO';
	private $where_oficina = 'O.OFICODIGO = U.OF_ORIGEN';
	private $where_id = 'I.USUID = U.USUID';
	private $where_usurol_fecha = 'NVL(I.FECHA_DESABILITACION, SYSDATE) >= SYSDATE';

	private $where_login = 'U.RUT_USUARIO';
	private $where_clave = 'USUCLAVE';

	private $dual = 'DUAL';
	private $fecha_srv = "TO_CHAR( SYSDATE , 'DD/MM/RRRR' ) FECHA";
	private $fecha_n_srv = "TO_CHAR( SYSDATE+1 , 'DD/MM/RRRR' ) FECHA";

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getUsuario($user,$pass){
		$str_sql="SELECT DISTINCT U.USUNOM,
								  U.RUT_USUARIO,
								  R.ROLID,
								  U.USUID,
								  U.OFICOD,
								  O.OFIDESCRIP NOMBRE_OFICINA 
				  FROM WEBUSUARIO U,
					   ITR_USUROL R, 
					   orden.gcotoficina O 
				  WHERE USULOGIN='".$user."' 
				  AND USUCLAVE = '".$pass."' 
				  AND (U.OFICOD=O.OFICODIGO OR U.OFICOD='ALL') 
				  AND  R.ROLID= '05'";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

	public function get_usuario($rut)
	{
		$this->db->select($this->id);
		$this->db->select($this->nombre);
		$this->db->select($this->oficina_origen);
		$this->db->select($this->oficina_codigo);
		$this->db->select($this->oficina_nombre);
		$this->db->select($this->id_login);
		$this->db->select($this->nombre_departamento);
		$this->db->select($this->rol);
		$this->db->from($this->webusuario);
		$this->db->join($this->webrol, $this->where_id,NULL, FALSE);
		$this->db->join($this->webdepartamento, $this->where_departamento,'LEFT', FALSE);
		$this->db->join($this->weboficina, $this->where_oficina,'LEFT', FALSE);
		$this->db->where($this->where_login,$rut);
		$this->db->where($this->where_usurol_fecha,null,false);
		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function check($var_user,$pass)
	{
		$str_sql = "SELECT  U.USUID,
                            U.USUNOM,
                            U.RUT_USUARIO,
                            U.OF_ORIGEN,
                            U.OFICOD,
                            O.OFIDESCRIP NOMBRE_OFICINA,
                            U.USULOGIN,
                            D.NOM_DEPTO,
                            I.ROLID
                    FROM 
                            WEBUSUARIO U,
                            PF_MA_DEPARTAMENTOS D,
                            ITR_USUROL I,
                            orden.gcotoficina O
                    WHERE   1=1 
                            AND U.USULOGIN= UPPER('$var_user')
                            AND U.USUCLAVE = '".$pass."'
                            AND I.USUID = U.USUID
                            AND U.ID_DEPTO = D.ID_DEPTO(+)
                            AND O.OFICODIGO = U.OF_ORIGEN(+)
                            AND I.ROLID IN ('44')";
                                    
				// $str_sql ="SELECT   U.USUID,
		  //                           U.USUNOM,
		  //                           U.OF_ORIGEN,
		  //                           U.OFICOD,
		  //                           O.NOMBRE_OFICINA,
		  //                           U.USULOGIN,
		  //                           D.NOM_DEPTO,
		  //                           I.ROLID
		  //                   FROM 
		  //                           WEBUSUARIO U,
		  //                           PF_MA_DEPARTAMENTOS D,
		  //                           ITR_USUROL I,
		  //                           PF_OFICINA@OBIOPER O
		  //                   WHERE   1=1 
		  //                           AND U.USULOGIN= UPPER('$var_user')
		  //                           AND U.USUCLAVE = '".$pass."'
		  //                           AND I.USUID = U.USUID
		  //                           AND U.ID_DEPTO = D.ID_DEPTO(+)
		  //                           AND O.CODIGO_OFICINA = U.OF_ORIGEN(+)
		  //                           AND I.ROLID IN ('44')"; //ROLID  IN 44
		$query   = $this->db->query($str_sql);
		$result  = $query->result_array();
		return $result;
	}



}
