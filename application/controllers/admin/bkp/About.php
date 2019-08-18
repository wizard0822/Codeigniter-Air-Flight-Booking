<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class About extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('about_model');
        ini_set('post_max_size', '64M');
        ini_set('upload_max_filesize', '64M');

	}

	public function index(){

		  $cond = "AND status < 5  order by id desc";
		 $about_us=$this->about_model->fetch('about_us',$cond);
		
		$this->data['list']=$about_us;
       	$this->get_include();
        $this->load->view($this->viewDir.'about/listing',$this->data);
    }
   public function add(){

   		if($this->input->post('submit')){
            $data_field['title']=$this->input->post('title_name');
            $data_field['alt_name']=$this->input->post('optional_title_name');
            // $data_field['added_date']=date('Y-m-d H:i:s');

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
            $data_field['status']=1;
            $data_field['added_date']=time();

            $this->about_model->add('about_us', $data_field);
            $this->session->set_flashdata('sess_message', 'About content added successfully!');
            redirect('admin/about');
            
        }
        $this->get_include();
        $this->load->view($this->viewDir."about/add",$this->data);
   }
   public function edit($id){
   		$id=base64_decode($id);
        $cond="AND id='$id'";
        $list=$this->about_model->fetch('about_us',$cond);
        $this->data['list']=$list;
        if($this->input->post('submit')){
            $data_field['title']=$this->input->post('title_name');
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
	            //$data_field['status']=$this->input->post('status');

	            $cond = "AND id=$id";
	            $this->about_model->edit_cond('about_us', $data_field,$cond);
	            $this->session->set_flashdata('sess_message', 'About content Updated successfully!');
	            redirect('admin/about');
	        }else{
	        	$data_field['image']=$list[0]['image'];
	            $data_field['description']=$this->input->post('editor1');
	            //$data_field['status']=$this->input->post('status');

	            $cond = "AND id=$id";
	            $this->about_model->edit_cond('about_us', $data_field,$cond);
	            $this->session->set_flashdata('sess_message', 'About content Updated successfully!');
	            redirect('admin/about');
	        }
            
        }
        $this->get_include();
        $this->load->view($this->viewDir."about/edit",$this->data);
   }

   public function delete($id){
    	$id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>5
            );
        $delete=$this->about_model->edit_cond('about_us',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'About deleted successfully!');

            redirect('admin/about');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete About!');

            redirect('admin/about');
        }
    }
    public function inactivate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            
            'status'=>0
            );
        $delete=$this->about_model->edit_cond('about_us',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'About deactivated successfully!');

            redirect('admin/about');
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate About!');

            redirect('admin/about');
        }
        

    }
    public function activate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>1
            );
        $delete=$this->about_model->edit_cond('about_us',$s,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'About activated successfully!');

            redirect('admin/about');
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate About!');

            redirect('admin/about');
        }
    }
}