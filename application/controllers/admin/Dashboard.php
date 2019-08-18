<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('common_model');
        ini_set('post_max_size', '64M');
		ini_set('upload_max_filesize', '64M');
	}


	public function index(){
        $this->get_include();
        $this->load->view('backend/dashboard/index');
    }
    public function logout(){
        $this->session->unset_userdata('admin_data');
        $this->session->sess_destroy();
        $this->session->set_flashdata('sess_message', 'You have logged out successfully');
        redirect('admin/login/');
    }
    public function change_password(){
        $this->load->model('common_model');
        $usertype=$this->session->userdata('admin_data');
        $admin_id =$usertype[0]['id'];
        if($this->input->post('submit')){
        $cond = "AND (id)='$admin_id'";
        $user_data=$this->common_model->fetch('admin_tbl', $cond);
        $password = $this->input->post('new_password');
        $con_password = $this->input->post('confirm_password');
        $old_password = $this->input->post('old_password');
        $user_password = $user_data[0]['password'];
        
        if ($password != '' && $password != $con_password) {
                $msg = "Please enter same confirm password.";
                $this->session->set_flashdata('err_message', 'Please enter same confirm password.');
                redirect('admin/dashboard/change_password');
                exit;
            }
        else if ($old_password != '' && md5($old_password) != $user_password) {
                $msg = "Please enter proper password.";
                $this->session->set_flashdata('err_message', 'Please enter proper password.');
                redirect('admin/dashboard/change_password');
                exit;
            }
            $password = md5($password);

            $data = array(
                'password' => $password,
            );

        $add = $this->common_model->edit_cond('admin_tbl',$data, $cond);
            if ($add) {
                $msg = 'You have successfully modified your password.';
                $this->session->set_flashdata('sess_message', 'You have successfully modified your password.');
                redirect('admin/dashboard/change_password');
            } else {
                $msg = 'Something wrong while update.';
                $this->session->set_flashdata('err_message', 'Something wrong while update.');
                redirect('admin/dashboard/change_password');
            }
        }
        $this->get_include();
        $this->load->view('backend/dashboard/change_password');
    }
}