<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Contact_us_content extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('login_model');
        ini_set('post_max_size', '64M');
		ini_set('upload_max_filesize', '64M');
	}
	public function index(){
        $usertype=$this->session->userdata('admin_data');
        $cond = "AND status < 5  order by id asc";
        $contact_us_content = $this->login_model->fetch('contact_us_content', $cond);
        $this->data['list'] = $contact_us_content;
        $this->get_include();
        $this->load->view($this->viewDir."contact_us_content/listing",$this->data);
    }
    public function add(){
        if($this->input->post('submit'))
        {
            $data_field['status']=$this->input->post('status');
            $data_field['address']=$this->input->post('address');
            $data_field['email'] = $this->input->post('email');
            $data_field['phone'] = $this->input->post('phone');
            $data_field['business_hours'] = $this->input->post('business_hours');
            $data_field['added_date']=time();
            $cond = "AND id=$id";
            $this->login_model->add('contact_us_content', $data_field);
            // $url =$filename; 
            $this->session->set_flashdata('sess_message', 'Content added successfully!');
            redirect('admin/contact_us_content');    
        }
        $this->get_include();
        $this->load->view($this->viewDir."contact_us_content/add",$this->data);
    }
    public function edit($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $list=$this->login_model->fetch('contact_us_content',$cond);
        $this->data['list']=$list[0];
        if($this->input->post('submit'))
        {
            $data_field['status']=$this->input->post('status');
            $data_field['address']=$this->input->post('address');
            $data_field['email'] = $this->input->post('email');
            $data_field['phone'] = $this->input->post('phone');
            $data_field['business_hours'] = $this->input->post('business_hours');
            $cond = "AND id=$id";
            $this->login_model->edit_cond('contact_us_content', $data_field,$cond);
            $this->session->set_flashdata('sess_message', 'Content updated successfully!');
            redirect('admin/contact_us_content'); 
        }
        $this->get_include();
        $this->load->view($this->viewDir."contact_us_content/edit",$this->data);

    }
    public function delete($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array( 
            'status'=>5
            );
        $delete=$this->login_model->edit_cond('contact_us_content',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Content deleted successfully!');
            redirect('admin/contact_us_content');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete Content!');

            redirect('admin/contact_us_content');
        }  
    }
    public function inactivate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array( 
            'status'=>0
            );
        $delete=$this->login_model->edit_cond('contact_us_content',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Content deactivated successfully!');
            redirect('admin/contact_us_content');
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate Content!');
            redirect('admin/contact_us_content');
        }
    }
    public function activate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array(  
            'status'=>1
            );
        $delete=$this->login_model->edit_cond('contact_us_content',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Content activated successfully!');

            redirect('admin/contact_us_content');
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate Content!');

            redirect('admin/contact_us_content');
        }
    }
    
}
