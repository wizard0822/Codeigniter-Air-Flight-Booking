<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Footer extends MY_Controller 
{

	function __construct()
	{
		parent::__construct();
        $this->load->helper(array('form','url','file','date'));
        $this->load->model('footer_model');   
        $this->load->model('logo_model');   
        ini_set('post_max_size', '64M');
		ini_set('upload_max_filesize', '64M');
	}
	public function index(){
		$this->get_include();
        $this->load->view('backend/footer/listing',$this->data);
	}
}