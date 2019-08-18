<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Contact extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('contact_model');
	}

	public function index(){

		$cond = "AND status < 5  order by id desc";
		$contact_us=$this->contact_model->fetch('contact_us',$cond);
		
		$this->data['list']=$contact_us;
       	$this->get_include();
        $this->load->view($this->viewDir.'contact/listing',$this->data);
    }
   public function add(){

   		if($this->input->post('submit')){
            $data_field['about_us_title']=$this->input->post('title_name');
            $data_field['alt_name']=$this->input->post('optional_title_name');
            $img_name=$_FILES['imagefile']['name'];
             //echo $img_name."<br>";
            $temp_name=$_FILES['imagefile']['tmp_name'];
            // echo $temp_name."<br>";
            $img_type=explode('.',$img_name);
            // echo "Image type".$img_type."<br>";
            $img_extension=strtolower(end($img_type));
            // echo "Extension: ".$img_extension."<br>";
            $newfilename=uniqid(rand()).".".$img_extension;
            // echo "New file name".$newfilename."<br>";
            $store="assets/upload/contact_us/".$newfilename;
            // echo $store;
            move_uploaded_file($temp_name, $store);

            $data_field['image']=$newfilename;
            $data_field['description']=$this->input->post('editor1');
            $data_field['status']=$this->input->post('status');

            $cond = "AND id=$id";
            $this->contact_model->add('contact_us', $data_field);
            $this->session->set_flashdata('sess_message', 'About content added successfully!');
            redirect('admin/contact');
            
        }
        $this->get_include();
        $this->load->view($this->viewDir."contact/add",$this->data);
   }
   public function edit($id){
   		$id=base64_decode($id);
        $cond="AND id='$id'";
        $list=$this->contact_model->fetch('contact_us',$cond);
        $this->data['list']=$list;
        if($this->input->post('submit')){
            $data_field['about_us_title']=$this->input->post('title_name');
            $data_field['alt_name']=$this->input->post('optional_title_name');
            // $data_field['added_date']=date('Y-m-d H:i:s');
            if ($_FILES['imagefile']['name']!=='') {
	            $img_name=$_FILES['imagefile']['name'];
	             //echo $img_name."<br>";
	            $temp_name=$_FILES['imagefile']['tmp_name'];
	            // echo $temp_name."<br>";
	            $img_type=explode('.',$img_name);
	            // echo "Image type".$img_type."<br>";
	            $img_extension=strtolower(end($img_type));
	            // echo "Extension: ".$img_extension."<br>";
	            $newfilename=uniqid(rand()).".".$img_extension;
	            // echo "New file name".$newfilename."<br>";
	            $store="assets/upload/about_us/".$newfilename;
	            // echo $store;
	            move_uploaded_file($temp_name, $store);

	            $data_field['image']=$newfilename;
	            $data_field['description']=$this->input->post('editor1');
	            $data_field['status']=$this->input->post('status');

	            $cond = "AND id=$id";
	            $this->contact_model->edit_cond('contact_us', $data_field,$cond);
	            $this->session->set_flashdata('sess_message', 'About content Updated successfully!');
	            redirect('admin/contact');
	        }else{
	        	$data_field['image']=$list[0]['image'];
	            $data_field['description']=$this->input->post('editor1');
	            $data_field['status']=$this->input->post('status');

	            $cond = "AND id=$id";
	            $this->contact_model->edit_cond('contact_us', $data_field,$cond);
	            $this->session->set_flashdata('sess_message', 'About content Updated successfully!');
	            redirect('admin/contact');
	        }  
        }
        $this->get_include();
        $this->load->view($this->viewDir."contact/edit",$this->data);
   }

   public function delete($id){
    	$id=base64_decode($id);
        $cond="AND id='$id'"; 
        $data=array(
            'status'=>5
            );
        $delete=$this->contact_model->edit_cond('contact_us',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Contact deleted successfully!');

            redirect('admin/contact');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete Contact!');

            redirect('admin/contact');
        }
    }
    public function inactivate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array(
            
            'status'=>0
            );
        $delete=$this->contact_model->edit_cond('contact_us',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'About deactivated successfully!');

            redirect('admin/contact');
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate About!');

            redirect('admin/contact');
        }
    }
    public function activate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>1
            );
        $delete=$this->contact_model->edit_cond('contact_us',$s,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'About activated successfully!');

            redirect('admin/contact');
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate About!');

            redirect('admin/contact');
        }
    }
}