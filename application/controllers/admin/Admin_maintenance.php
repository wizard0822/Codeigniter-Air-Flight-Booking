<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_maintenance extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('common_model');
        ini_set('post_max_size', '64M');
		ini_set('upload_max_filesize', '64M');
	}
	public function index(){
        $usertype=$this->session->userdata('admin_data');
        // t($usertype,1);
        $cond = "AND status < 5  order by id asc";
        $list = $this->common_model->fetch('admin_tbl', $cond);
        $this->data['list'] = $list;
        $this->get_include();
        $this->load->view($this->viewDir."admin-maintenance/index",$this->data);
    }
    public function add(){
    	$usertype=$this->session->userdata('admin_data');
        $admin_id= $usertype[0]['id'];
        $f_name=$this->input->post('f_name');
        $l_name=$this->input->post('l_name');
        $email=$this->input->post('email');
        $username=$this->input->post('username');
        $status=$this->input->post('status');
        $password=md5($this->input->post('password'));
        if($this->input->post('submit'))
        {
            $data_field['f_name']=$f_name;
            $data_field['l_name']=$l_name;
            $data_field['email']= $email;
            $data_field['username']= $username;
            $data_field['password']= $password;
            $data_field['status']= $status;
            $data_field['type']= "au";
            $data_field['add_admin_id']= $admin_id;
            $data_field['added_date']=time();

            $result=$this->common_model->add('admin_tbl', $data_field);
            // echo $this->db->last_query();
            // t($result,1);
            if($result)
            {
            	$this->session->set_flashdata('sess_message', 'Adnin added successfully!');
            	redirect('admin/admin-maintenance');  
            }
            else
            {
            	$this->session->set_flashdata('err_message', 'Something went wrong!');
            	redirect('admin/admin-maintenance');  
            }
        }
    	$this->get_include();
        $this->load->view($this->viewDir."admin-maintenance/add",$this->data);
    }
     public function edit($id){
        $usertype=$this->session->userdata('admin_data');
        $admin_id= $usertype[0]['id'];
   		$id=base64_decode($id);
        $cond="AND id='$id'";
        $details=$this->common_model->fetch('admin_tbl',$cond);
        // t($details,1);
        $this->data['details']=$details;
        if($this->input->post('submit')){
            $data_field['f_name']=$this->input->post('f_name');
            $data_field['l_name']=$this->input->post('l_name');
	        $data_field['username']=$this->input->post('username');
	        $data_field['email']=$this->input->post('email');
	        $data_field['status']=$this->input->post('status');
            $data_field['modify_admin_id']= $admin_id;

	            // $cond = "AND id=$id";
	        // t($id);
	            $this->common_model->edit_cond('admin_tbl', $data_field,$cond);
	            // echo $this->db->last_query();die;
	            $this->session->set_flashdata('sess_message', 'Admin Updated successfully!');
	            redirect('admin/admin-maintenance');
	        }
            
        $this->get_include();
        $this->load->view($this->viewDir."admin-maintenance/edit",$this->data);
   }
       public function change_password($id){
        $usertype=$this->session->userdata('admin_data');
        $id =$id;
		$this->data['id'] = $id;
		$admin_id = base64_decode($id);
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
                redirect('admin/admin-maintenance');
                exit;
            }
        else if ($old_password != '' && md5($old_password) != $user_password) {
                $msg = "Please enter proper password.";
                $this->session->set_flashdata('err_message', 'Please enter proper password.');
                redirect('admin/admin-maintenance');
                exit;
            }
            $password = md5($password);

            $data = array(
                'password' => $password,
            );

        $add = $this->common_model->edit_cond('admin_tbl',$data, $cond);
            if ($add) {
                $msg = 'You have successfully modified your password.';
                $this->session->set_flashdata('sess_message', 'Admin password has been chenged successfully.');
                redirect('admin/admin-maintenance');
            } else {
                $msg = 'Something wrong while update.';
                $this->session->set_flashdata('err_message', 'Something wrong while update.');
                redirect('admin/admin-maintenance');
            }
        }
        $this->get_include();
        $this->load->view('backend/admin-maintenance/change-password');
    }
    public function email_exists($email)
    {
        // $this->db->where('email_address', $email,'active',1);
        // $query = $this->db->get('customer_tbl');
        $cond ="AND email='$email' AND status=1 AND type='au'";
        $query = $this->common_model->fetch('admin_tbl',$cond);
        // echo $this->db->last_query();die;
        if(count($query)>0)
        { return TRUE; } else { return FALSE; }
    }
    public function register_email_exists()
    {
        if (array_key_exists('email',$_POST)) {
            if ( $this->email_exists($this->input->post('email')) == TRUE ) {
                echo json_encode(FALSE);
            } else {
                echo json_encode(TRUE);
            }
        }
    }
     public function edit_email_exists($email,$id)
    {
        // $this->db->where('email_address', $email,'active',1);
        // $query = $this->db->get('customer_tbl');
        $cond ="AND email='$email' AND status=1 AND type='au' AND id!=$id";
        $query = $this->common_model->fetch('admin_tbl',$cond);
         // echo $this->db->last_query();die;
        if(count($query)>1)
        { return TRUE; } else { return FALSE; }
    }
    public function register_edit_email_exists($id)
    {
        if (array_key_exists('email',$_POST)) {
            if ( $this->edit_email_exists($this->input->post('email'),$id) == TRUE ) {
                echo json_encode(FALSE);
            } else {
                echo json_encode(TRUE);
            }
        }
    }
    public function delete($id){
        $usertype=$this->session->userdata('admin_data');
        $admin_id= $usertype[0]['id'];
    	$id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>5,
            'modify_admin_id'=>$admin_id,
            );
        $delete=$this->common_model->edit_cond('admin_tbl',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Admin deleted successfully!');

            redirect('admin/admin-maintenance');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete Admin!');

            redirect('admin/admin-maintenance');
        }
    }
    public function inactivate($id){
        $usertype=$this->session->userdata('admin_data');
        $admin_id= $usertype[0]['id'];
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            
            'status'=>0,
            'modify_admin_id'=>$admin_id,
            );
        $delete=$this->common_model->edit_cond('admin_tbl',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Admin deactivated successfully!');

            redirect('admin/admin-maintenance');
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate Admin!');

            redirect('admin/admin-maintenance');
        }
        

    }
    public function activate($id){
        $usertype=$this->session->userdata('admin_data');
        $admin_id= $usertype[0]['id'];
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>1,
            'modify_admin_id'=>$admin_id,
            );
        $delete=$this->common_model->edit_cond('admin_tbl',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Admin activated successfully!');

            redirect('admin/admin-maintenance');
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate Admin!');

            redirect('admin/admin-maintenance');
        }
    }

}





