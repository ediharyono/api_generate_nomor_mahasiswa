<?php
//use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
//require APPPATH . '/libraries/REST_Controller.php';
class Rmsmhs_max extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Rmsmhs_model_api', 'mdlmhs');
			$this->load->library('Uuid');
    }
    public function index_get_1()
    {
		$kdpst = $this->get('kdpst');
//        $thsms = $this->get('thsms');        
        $angkatan = $this->get('angkatan');              
			$mhs_max = $this->mdlmhs->get_nimhs_maks($kdpst,$angkatan);	   		 
			//$mhs_max = $this->mdlmhs->get_nimhs_maks($kdpst);
			
        $this->response($mhs_max, REST_Controller::HTTP_OK);
		
    }
	
	public function index_get()
    {
		$fakultas = $this->get('fakultas');
//        $thsms = $this->get('thsms');        
			//$angkatan = $this->get('angkatan');              
			$mhs_max = $this->mdlmhs->get_nimhs_maks1($fakultas);	   		  
			$coba = json_encode($mhs_max);
			//echo $coba;
						 

// Example JSON array
//$json_array = '[{"nimbaru":"5607","kode_fakultas":"03","fakultas":"ILMU SOSIAL DAN ILMU POLITIK"}]';
// Decode the JSON array
$data = json_decode($coba, true);
// Access the first element (index 0) in the array
$first_element = $data[0];
// Access the "nimbaru" key and retrieve its value
$nimbaru_value = $first_element["nimbaru"];
// Print the value
echo $nimbaru_value;
//$this->response($nimbaru_value, REST_Controller::HTTP_OK);

			//echo json_decode($coba[1]);
			//$array = json_decode($mhs_max); 	
			 
		//respon OK	
        $this->response($mhs_max, REST_Controller::HTTP_OK);
    }
	
	function nim_terakhir($fakultas) 
	{
			$mhs_max = $this->mdlmhs->get_nimhs_maks1($fakultas);	   		  
			$coba = json_encode($mhs_max);
			$data = json_decode($coba, true);
			$first_element = $data[0];
			$nimbaru_value = $first_element["nimbaru"];
			return $nimbaru_value;

	}
	
	public function index_post_ok()
    {
			
    $data = array(		
		'id_masternim'=>$this->uuid->v4(),				
		'nimhsmsmhs'=> $this->post('tahun_akademik').$this->post('jalur').$this->post('prodi').$this->nim_terakhir($this->post('nomor_urut')),
		'nmmhsmsmhs'=> $this->post('nmmhsmsmhs'),
		'nomor_registrasi'=> $this->post('nomor_registrasi'),
		'tahun_akademik'=> $this->post('tahun_akademik'),
		'jalur'=> $this->post('jalur'),
		'prodi'=> $this->post('prodi'),
		'nomor_urut'=> $this->nim_terakhir($this->post('nomor_urut')),
		'kode_fakultas'=> $this->post('kode_fakultas'), 
		'fakultas'=> $this->post('fakultas'),
		'kdpstmsmhs'=> $this->post('kdpstmsmhs'),
		'smawlmsmhs'=> $this->post('smawlmsmhs'),
		'tglhrmsmhs'=> $this->post('tglhrmsmhs'),
		'tplhrmsmhs'=> $this->post('tplhrmsmhs'),
		'nmibumsmhs'=> $this->post('nmibumsmhs'));
        //$this->db->insert('items',$input);
     
	$insert = $this->mdlmhs->insert_data($data);	
		
		if($insert) {
	
 			//echo json_encode(array("status" => TRUE));
		 			
            $this->response([
                'status' => false,
                'error' => 'Ada Kesalahan Input'
            ], REST_Controller::HTTP_BAD_REQUEST);	
		} else {
			
			$this->response([
                'status' => true,
                'error' => 'Berhasil'
            ], REST_Controller::HTTP_OK);	
			
			   
		}			
    } 
	
    public function index_post_2()
    {
        // Retrieve data from the POST request
        $data = array();
		
        // Perform any necessary validations or processing on the data
        if (empty($data)) {
            $this->response([
                'status' => false,
                'error' => 'No data provided'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        // Example response
        $response = [
            'status' => true,
            'message' => 'Data received',
            'data' => $data
        ];

        // Send the response
        $this->response($response, REST_Controller::HTTP_OK);
    }
 
///return nomor terakhir
 
///
function index_post()
	{
	 $data = array(
		
		'id_masternim'=>$this->uuid->v4(),				
		'nimhsmsmhs'=> $this->post('tahun_akademik').$this->post('jalur').$this->post('prodi').$this->nim_terakhir($this->post('kode_fakultas')),
		'nmmhsmsmhs'=> $this->post('nmmhsmsmhs'),
		'nomor_registrasi'=> $this->post('nomor_registrasi'),
		'tahun_akademik'=> $this->post('tahun_akademik'),
		'jalur'=> $this->post('jalur'),
		'prodi'=> $this->post('prodi'),
		'nomor_urut'=>  $this->nim_terakhir($this->post('kode_fakultas')),
		'kode_fakultas'=> $this->post('kode_fakultas'), 
		'fakultas'=> $this->post('fakultas'),
		'kdpstmsmhs'=> $this->post('kdpstmsmhs'),
		'smawlmsmhs'=> $this->post('smawlmsmhs'),
		'tglhrmsmhs'=> $this->post('tglhrmsmhs'),
		'tplhrmsmhs'=> $this->post('tplhrmsmhs'),
		'nmibumsmhs'=> $this->post('nmibumsmhs'));
		
		extract($data);
		if ($this->check_id($nomor_registrasi)) {
	            $this->response([
                'status' => false,
                'error' => 'Nomor Registrasi Sudah Terdaftar'
            ], REST_Controller::HTTP_BAD_REQUEST);
 
		} else {
			$this->mdlmhs->insert_data($data);
			$this->response($data, REST_Controller::HTTP_OK);
		}
	}
	
function check_id($nomor_registrasi)
	{
			$this->db->select();
			$query = $this->db->get_where('masternim', array(
			
				'nomor_registrasi' => $nomor_registrasi	 		
			));
				$result = $query->result_array();
				$count = count($result);
			if(empty($count)){
				return false;
			}
			else{
				return true;
			}
	}

    function index_post1() {
		 
		   
        $data = array(
		
		'id_masternim'=> $this->post('id_masternim'),
		'nimhsmsmhs'=> $this->post('nimhsmsmhs'),
		'nmmhsmsmhs'=> $this->post('nmmhsmsmhs'),
		'nomor_registrasi'=> $this->post('nomor_registrasi'),
		'tahun_akademik'=> $this->post('tahun_akademik'),
		'jalur'=> $this->post('jalur'),
		'prodi'=> $this->post('prodi'),
		'nomor_urut'=> $this->post('nomor_urut'),
		'kode_fakultas'=> $this->post('kode_fakultas'), 
		'fakultas'=> $this->post('fakultas'),
		'kdpstmsmhs'=> $this->post('kdpstmsmhs'),
		'smawlmsmhs'=> $this->post('smawlmsmhs'),
		'tglhrmsmhs'=> $this->post('tglhrmsmhs'),
		'tplhrmsmhs'=> $this->post('tplhrmsmhs'),
		'nmibumsmhs'=> $this->post('nmibumsmhs'));
		

        $insert = $this->load->database()->insert('masternim', $data);
        if ($insert) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
		
					
        //$insert = $this->mdlmhs->post_insert($data);
		
        //if ($insert) {
					//$this->response($data, REST_Controller::HTTP_OK);
        //} else {
			        //$this->response($data, REST_Controller::HTTP_OK);
            //$this->response(array('status' => 'fail', 502));
        //}
    }
	
}
?>