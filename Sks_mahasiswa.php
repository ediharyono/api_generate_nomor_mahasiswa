<?php
//use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
//require APPPATH . '/libraries/REST_Controller.php';
class Sks_mahasiswa extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Rtrkrs_model_api', 'mdlkrs');
    }
    public function index_post()
    {
       $id = $this->post('nimhstrkrs');
       $thsms = $this->post('thsmstrkrs');	   
        if ( $thsms == '') {
            $krs = $this->mdlkrs->get_by_id($id);
        } else {

			$teori = $this->mdlkrs->get_rtrkrs_tagihan_teori($id,$thsms);			
			$praktikum = $this->mdlkrs->get_rtrkrs_tagihan_praktikum($id,$thsms);		
			
			$json = array(
						"teori" =>$praktikum,
						"teori" =>$teori,						
						);
        }
        $this->response($json, REST_Controller::HTTP_OK);
    }
}
