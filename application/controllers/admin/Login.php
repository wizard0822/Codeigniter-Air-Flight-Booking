<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	 function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }
	public function index()
	{
		$this->load->view('backend/login/index', $this->data);
	}

	public function submit_login(){
		$username=$this->input->post('username');
		$pass=md5($this->input->post('password'));
		$cond=" AND email='$username' AND password='$pass'";
		$loginDataExists=$this->common_model->fetch('admin_tbl',$cond);

		if(count($loginDataExists)>0){
			$this->session->set_userdata('admin_data', $loginDataExists);
			redirect($this->data['base_url'].'admin/dashboard');
		}else{
			$this->session->set_flashdata('err_message', 'Wrong username/password.');
              redirect($this->data['base_url'].'admin/login');
		}
	}

}





