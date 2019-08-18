<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Category extends MY_Controller {

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
        $category = $this->login_model->fetch('category', $cond);
        $this->data['list'] = $category;
        $this->get_include();
        $this->load->view($this->viewDir."category/listing",$this->data);
    }
    public function add(){
        if($this->input->post('submit'))
        {
            $data_field['status']=$this->input->post('status');
            $data_field['category_name']=$this->input->post('category_name');
            $data_field['slug_name'] = strtolower(preg_replace("/\s+/", '-', $this->input->post('category_name')));
            $data_field['added_date']=time();
            $cond = "AND id=$id";
            $this->login_model->add('category', $data_field);
            // $url =$filename; 
            $this->session->set_flashdata('sess_message', 'Category added successfully!');
            redirect('admin/category');    
        }
        $this->get_include();
        $this->load->view($this->viewDir."category/add",$this->data);
    }
    public function edit($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $list=$this->login_model->fetch('category',$cond);
        $this->data['list']=$list;
        if($this->input->post('submit'))
        {
            $data_field['status']=$this->input->post('status');
            $data_field['category_name']=$this->input->post('category_name');
            $data_field['slug_name'] = strtolower(preg_replace("/\s+/", '-', $this->input->post('category_name')));
            $cond = "AND id=$id";
            $this->login_model->edit_cond('category', $data_field,$cond);
            $this->session->set_flashdata('sess_message', 'Category updated successfully!');
            redirect('admin/category'); 
        }
        $this->get_include();
        $this->load->view($this->viewDir."category/edit",$this->data);

    }
    public function delete($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array( 
            'status'=>5
            );
        $delete=$this->login_model->edit_cond('category',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Category deleted successfully!');
            redirect('admin/category');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete Category!');

            redirect('admin/category');
        }  
    }
    public function inactivate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array( 
            'status'=>0
            );
        $delete=$this->login_model->edit_cond('category',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Category deactivated successfully!');
            redirect('admin/category');
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate Category!');
            redirect('admin/category');
        }
    }
    public function activate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array(  
            'status'=>1
            );
        $delete=$this->login_model->edit_cond('category',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Category activated successfully!');

            redirect('admin/category');
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate Category!');

            redirect('admin/category');
        }
    }
    
}
