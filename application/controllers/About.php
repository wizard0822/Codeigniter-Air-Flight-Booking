<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class About extends UI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('common_model');

	}
	public function index(){

		log_message('error', 'Some variable did not contain a value.');
		$this->get_include();
        $this->load->view($this->viewDir.'about/index',$this->data);
  }

}