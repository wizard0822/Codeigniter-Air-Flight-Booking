<?php


defined('BASEPATH') OR exit('No direct script access allowed');



class Blogs extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('login_model');
	}
	public function index(){
        $usertype=$this->session->userdata('admin_data');
        $cond = "AND status < 5 order by id desc";
        $blogs = $this->login_model->fetch('blogs', $cond);
        foreach ($blogs as $key => $value) {
            # code...
            $user_id = $value['user_id'];
            $cond2 = "AND id='$user_id' AND status < 5";
            $user = $this->login_model->fetch('users', $cond2);
            $blogs[$key]['user_name']=$user[0]['first_name'].' '.$user[0]['last_name'];
        }
        $this->data['list'] = $blogs;
        $this->get_include();
        $this->load->view($this->viewDir."blogs/listing",$this->data);
    }
    public function view($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $view=$this->login_model->fetch('blogs',$cond);

        $user_id = $view[0]['user_id'];
        $cond2 = "AND id='$user_id' AND status < 5";
        $user = $this->login_model->fetch('users', $cond2);
        $view[0]['user_name']=$user[0]['first_name'].' '.$user[0]['last_name'];
        $this->data['value'] = $view[0];
        $this->get_include();        
        $this->load->view($this->viewDir."blogs/view",$this->data);
    }
    public function delete($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            
            'status'=>5
            );
        $delete=$this->login_model->edit_cond('blogs',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Blog deleted successfully!');

            redirect('admin/blogs');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete blog!');

            redirect('admin/blogs');
        }
    }
    public function inactivate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array( 
            'status'=>0
            );
        $delete=$this->login_model->edit_cond('blogs',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Blog deactivated successfully!');

            redirect('admin/blogs');
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate Blog!');

            redirect('admin/blogs');
        }
    }
    public function activate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            
            'status'=>1
            );
        $delete=$this->login_model->edit_cond('blogs',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Blog activated successfully!');

            redirect('admin/blogs');
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate Blog!');

            redirect('admin/blogs');
        }
    }
    
}
