<?php 
//File in controller Rtrkrs_model.php and save highchart in assets folder 

defined('BASEPATH') OR exit('No direct script access allowed');

class Rtrkrs_model_api extends CI_Model {
public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->db = $this->load->database('widyama2_simakol_live', TRUE);
	}
//import excel

function insert($data)
    {
		$this->load->database('widyama2_simakol', TRUE)->insert_batch('rtrkrs', $data);
    }
	
//get All
public function get_rtrkrs()
	{
    $sql = $this->db->query("SELECT * FROM rtrkrs");
    return $sql->result();
	}
//get one record

//get By BIM
public function get_rtrkrs_mahasiswa()
	{
	$nimhs = $this->session->userdata('id');	
	$thsms = $this->session->userdata('thsms');	
	//$thsms = '20201';	
    $sql = $this->db->query("SELECT * FROM rtrkrs WHERE nimhstrkrs ='$nimhs' AND thsmstrkrs ='$thsms' ORDER BY hrrentrkrs DESC");
    return $sql->result();
	}
//get one record

public function get_by_id($id)
	{
		
	$this->db->from('rtrkrs');
	$this->db->where('nimhstrkrs',$id);
 
	$sql = $this->db->get();
	return $sql->result();
	}

//get chart
public function get_smt_krs($id,$thsms)
	{
    $sql = $this->db->query("	
	SELECT pakettrkrs, nimhstrkrs, thsmstrkrs, SUM(sksmktrkrs) as jumlahkrs 
	FROM rtrkrs
	WHERE nimhstrkrs = '$id' AND thsmstrkrs = '$thsms' 
	");
    return $sql->result();
	}

//csv_model_sdm

///

public function get_rtrkrs_kartu_ujian($nimhs,$thsms)
	{
    $sql = $this->db->query("SELECT * FROM rtrkrs WHERE nimhstrkrs ='$nimhs' AND thsmstrkrs ='$thsms' ORDER BY hrrentrkrs DESC");
    return $sql->result();
	}
///

//tambah krs tagihan
public function get_rtrkrs_paket($nimhs,$thsms)
	{
    $sql = $this->db->query("SELECT * FROM rtrkrs WHERE nimhstrkrs ='$nimhs' AND thsmstrkrs ='$thsms' AND pakettrkrs = '1'  ORDER BY hrrentrkrs DESC");
    return $sql->result();
	}
	
//split praktikum dan non praktikum 
public function get_rtrkrs_tagihan_praktikum($nimhs,$thsms)
	{
    $sql = $this->db->query("SELECT * FROM rtrkrs WHERE nimhstrkrs ='$nimhs' AND thsmstrkrs ='$thsms' AND nmkmktrkrs LIKE '%praktik%'  ORDER BY hrrentrkrs DESC");
    return $sql->result();
	}
//
//split praktikum dan non praktikum 
public function get_rtrkrs_tagihan_teori($nimhs,$thsms)
	{
    $sql = $this->db->query("SELECT * FROM rtrkrs WHERE nimhstrkrs ='$nimhs' AND thsmstrkrs ='$thsms' AND nmkmktrkrs NOT LIKE '%praktik%'  ORDER BY hrrentrkrs DESC");
    return $sql->result();
	}
//

public function get_praktikum($nimhs,$thsms)
	{
    $sql = $this->db->query("SELECT * FROM rtrkrs WHERE thsmstrkrs ='$thsms' AND nmkmktrkrs LIKE '%praktik%' ORDER BY hrrentrkrs DESC");
    return $sql->result();
	}	
//get one record

//tambah krs tagihan
public function get_rtrkrs_praktikum($nimhs,$thsms)
	{
    $sql = $this->db->query("SELECT * FROM rtrkrs WHERE nimhstrkrs ='$nimhs' AND thsmstrkrs ='$thsms' AND nmkmktrkrs LIKE '%praktik%' ORDER BY hrrentrkrs DESC");
    return $sql->result();
	}	
//get one record

///

}
?>