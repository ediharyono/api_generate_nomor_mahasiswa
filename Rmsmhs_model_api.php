<?php 
//File in controller Rtrkrs_model.php and save highchart in assets folder 

defined('BASEPATH') OR exit('No direct script access allowed');

class Rmsmhs_model_api extends CI_Model {
public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->db = $this->load->database('widyama2_simakol_live', TRUE);
	}
//import excel

function insert($data)
    {
		$this->load->database('widyama2_simakol_live', TRUE)->insert_batch('rmsmhs', $data);
    }
	
//get All
public function get_rmsmks()
	{
    $sql = $this->db->query("SELECT * FROM rmsmhs");
    return $sql->result();
	}
//get one record

//get By BIM

public function get_mhs_id($id)
	{
		
	$this->db->from('rmsmhs');
	$this->db->where('nimhsmsmhs',$id);
 
	$sql = $this->db->get();
	return $sql->result();
	}

public function get_mhs_thsms($thsms)
	{
    $sql = $this->db->query("	
	SELECT * 
	FROM rmsmhs
	WHERE thsmsmsmhs = '$thsms' 
	");
    return $sql->result();
	}
//get chart
public function get_nimhs_maks($kdpst,$angkatan)
	{
	//	SELECT MAX(mid(nimhsmsmhs,6, 4)), nimhsmsmhs 	
	$akt = substr($angkatan,2,4);	
	
	
    $sql = $this->db->query("	
	SELECT MAX(mid(nimhsmsmhs,6, 4))+1 as nimbaru, kdpstmsmhs, left(nimhsmsmhs,2) as angkatan	
	FROM rmsmhs
	WHERE kdpstmsmhs = '$kdpst' 
	AND 	
	left(nimhsmsmhs,2) = '$akt' 	
	");
    return $sql->result();
	}

//mendapatkan nomor mahasiswa terakhir

public function get_nimhs_maks1($fakultas)
	{
	//	SELECT MAX(mid(nimhsmsmhs,6, 4)), nimhsmsmhs 	
	//$akt = substr($angkatan,2,4);	
	 
    $sql = $this->db->query("	
			SELECT MAX(nomor_urut)+1 as nimbaru, kode_fakultas, fakultas
			FROM masternim
			WHERE kode_fakultas = '$fakultas' 	
	");
    return $sql->result();
	}
	

function post_insert($data)
    {
		$this->load->database('widyama2_simakol_live', TRUE)->insert_batch('masternim', $data);
    }	
	
function insert_data($data)
    {
		$insert = $this->load->database('widyama2_simakol_live', TRUE)->insert('masternim', $data);	
    }		
	
}	

?>