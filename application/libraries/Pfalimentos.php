<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pfalimentos
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function export_excel($params)
	{
		$filename = "Exportar.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
		$this->exportExcelData($params);
	}

 	public function exportExcelData($records)
	{
		$heading = false;
	    if (!empty($records))
	        foreach ($records as $row) {
	            if (!$heading) {
	                echo implode("\t", array_keys($row)) . "\n";
	                $heading = true;
	            }
	            echo implode("\t", ($row)) . "\n";
	    }
	}

	public function remove_mark($cadena) {
		$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
		$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
		$texto = str_replace($no_permitidas, $permitidas ,$cadena);
		return $texto;
	}

	public function send_email($email,$subject,$message)
	{
	   	$ci =& get_instance();
    	$ci->load->model('Email_model','email');
    	$body = null;
		$data = array(
			'title'    => $subject,
			'menssage' => $message,
		);
		$body = $ci->load->view('email/email', $data, TRUE);
		$result = $ci->email->send_email($email,$body,$subject);
	}

	public function upper_lower($string)
	{
		$data = ucwords(mb_strtolower($string));
		return $data;
	}

	public function upperuc_lower($string)
	{
		$data = ucfirst(strtolower($string));
		return $data;
	}

	public function upper($string)
	{
		$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
		$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
		$texto = str_replace($no_permitidas, $permitidas ,$string);
		$data = strtoupper($texto);
		return $data;
	}

	public function get_desde($string)
	{
		$data = substr($string, 0, 10);
		return $data;
	}

	public function get_hasta($string)
	{
		$data = substr($string, -10);
		return $data;
	}

	public function cal_margen($costo,$precio_venta)
	{
		$precio_venta = ($precio_venta == 0) ? 1 : $precio_venta;
		$cal = ((($precio_venta - $costo) / $precio_venta) * 100);
		return round($cal,1).'%';
	}

	public function convert_to_date($string)
	{
		$date = date("d/m/Y",strtotime($string));
		return $date;
	}

    public function get_age($date)
    {
        $dob= $date;
        $diff = (date('Y') - date('Y',strtotime($dob)));
        return $diff;
    }

    public function cut_rut($string)
    {
        $upper_rut = strtoupper($string);   //cast rut to upper case
	    $upper_rut = substr($upper_rut, 0, -1).'-'.substr($upper_rut, -1);  //add dash '-' to rut
	    return $upper_rut;
    }

    public function validateDate($date)
    {
        $d = DateTime::createFromFormat('d/m/Y', $date);
        return $d && $d->format('d/m/Y') === $date;
    }

    public function get_one_mes()
    {
    	$query_date = date("d-m-Y");
    	$date = date('01-m-Y',strtotime ( '-1 month' , strtotime($query_date)));
    	return $date;
    }

    public function get_two_mes()
    {
    	$query_date = date("d-m-Y");
    	$date = date('01-m-Y',strtotime ( '-2 month' , strtotime($query_date)));
    	return $date;
    }

    public function get_tree_mes()
    {
    	$query_date = date("d-m-Y");
    	$date = date('01-m-Y',strtotime ( '-3 month' , strtotime($query_date)));
    	return $date;
    }

    public function get_primer_dia_semana()
    {
		$date = date('w');
		$first_week = date('d/m/Y', strtotime('-'.$date.' days'));
		return $first_week;
    }

    public function get_ultimo_dia_semana()
    {
		$date = date('w');
		$last_week = date('d/m/Y', strtotime('+'.(6-$date).' days'));
		return $last_week;
    }

    public function get_date()
    {
    	$query_date = date("d-m-Y");
    	return $query_date;
    }

    public function check_oficina_spr($string)
    {
	   	$ci =& get_instance();
    	$ci->load->model('Model_Meta','meta');
    	$meta = $ci->meta->get_oficina_supervisor($string);
    	if (!empty($meta)) {
    		return $string;
    	}
    	return 'ALL';
    }

    public function convert_float_withComman($string)
    {
    	$data = floatval(str_replace(",",".",$string));
    	$data = str_replace(".",",",$data);
    	return $data;
    }

    public function convert_number($string)
    {
    	$data = str_replace("$","",$string);
    	$data = str_replace(".","",$data);
    	return (int) $data;
    }

	public function strip_price($price)
	{
		$price = str_replace('.', '',substr($price, 0, -3)) . substr($price, -3);
		$price = preg_replace('/[\$,]/', '', $price);
		return $price;
	}

	public function strip_procentage($por)
	{
		$por = str_replace('%', '', $por);
		$por = str_replace('.', ',', $por);
		return $por;
	}

	public function get_margen($venta,$costo)
	{
		$venta = ($venta == 0) ? 1 : $venta;
		$resta = $venta - $costo;
		$div   = $resta / $venta;
		$mul   = $div * 100;
		return round($mul,1).'%';
	}

	public function convert_number_price($string)
	{
		$data = '$'.number_format($string, 0, ',', '.');
		return $data;
	}

	public function replace_guion_espacio($string)
	{
		$data = str_replace('_', ' ', $string);
		return $this->upper_lower($data); 
	}

  	public function id_dir($path)
  	{
	    if (!is_dir($path)) {
	      mkdir($path);
	    }
  	}

    public function check_on($string)
    {
    	if ($string == 'on') {
    		return 1;
    	}
    	return 0;
    }

    public function string_with_commad($array)
    {
    	if ($array != null) {
	    	if (is_array($array)) {
	    		$data = implode(',',$array);
	    		return $data;
	    	}
	    	return null;
    	}
    	return null;
    }

    public function is_null($string)
    {
    	if (!empty($string)) {
    		return $string;
    	}
    	return null;
    }

    function remove_charater($string) { 
    	$string = $this->upperuc_lower($this->remove_mark($string));
    	// $string = preg_replace('/\v+|\\\r\\\n/','<br />',$this->upperuc_lower($this->remove_mark($string)));
    	// $string = str_replace(PHP_EOL,"<br />",$string);
    	// 
    	// $string = nl2br("One line.\n Another line.");
    	// $string = $this->upper_lower($this->remove_mark($string));
    	// $string = nl2br((string)$string);
    	// $string = str_replace('<br />','',$string);
    	// $string =  nl2br(htmlentities($string, ENT_QUOTES, 'UTF-8'));
    	// $string = preg_replace('/\v+|\\\r\\\n/','<br />',$this->upperuc_lower($this->remove_mark($string)));
    	// $html = htmlentities($string, ENT_QUOTES, "UTF-8");
    	// $string = nl2br("Bienvenido\r\nEste es mi documento HTML", false);
		return $string; 
	}

	function get_id_obs()
	{
		return array('JO','AM','GG','SP');
	}

	public function is_mayor($number)
	{
		return ($number >= 100 ) ? 100 : $number;
	}

}

/* End of file PfAlimentos.php */
/* Location: ./application/libraries/PfAlimentos.php */
