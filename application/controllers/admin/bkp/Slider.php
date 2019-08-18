<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Slider extends MY_Controller 
{

	function __construct()
	{
		parent::__construct();
         $this->load->model('slider_model');   
        ini_set('post_max_size', '64M');
		ini_set('upload_max_filesize', '64M');
	}
	public function index(){
        $usertype=$this->session->userdata('admin_data');
        $cond = "AND status < 5  order by id asc";
        $sliders = $this->slider_model->fetch('slider', $cond);
        $this->data['list'] = $sliders;
        $this->get_include();
        $this->load->view('backend/slider/listing',$this->data);
    }
    public function add(){
        if($this->input->post('submit')){
            $data_field['title']=$this->input->post('slider_name');
            $data_field['alt_title']=$this->input->post('optional_slider_name');
            $data_field['added_date']=time();

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
            $store="assets/upload/slider_images/".$newfilename;
            // echo $store;
            move_uploaded_file($temp_name, $store);

            $data_field['image']=$newfilename;
            $data_field['short_description']=$this->input->post('editor1');
            $data_field['status']=$this->input->post('status');
            $this->slider_model->add('slider', $data_field);
            $this->session->set_flashdata('sess_message', 'Slider image added successfully!');
            redirect('admin/slider');
            
        }
        $this->get_include();
        $this->load->view('backend/slider/add',$this->data);
    }
    public function edit($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $list=$this->slider_model->fetch('slider',$cond);
        $this->data['list']=$list;
        if($this->input->post('submit')){
            $data_field['title']=$this->input->post('slider_name');
            $data_field['alt_title']=$this->input->post('optional_slider_name');
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
                $store="assets/upload/slider_images/".$newfilename;
                // echo $store;
                move_uploaded_file($temp_name, $store);

                $data_field['image']=$newfilename;
                $data_field['short_description']=$this->input->post('editor1');
                $data_field['status']=$this->input->post('status');


                $cond = "AND id=$id";
                $this->slider_model->edit_cond('slider', $data_field,$cond);
                $this->session->set_flashdata('sess_message', 'Slider image updated successfully!');
                redirect('admin/slider');
            }else{
                
                $data_field['image']=$list[0]['image'];
                $data_field['short_description']=$this->input->post('editor1');
                $data_field['status']=$this->input->post('status');
                $cond = "AND id=$id";
                $this->slider_model->edit_cond('slider', $data_field,$cond);
                $this->session->set_flashdata('sess_message', 'Slider image updated successfully!');
                redirect('admin/slider');
            }    
        }

        $this->get_include();
        $this->load->view($this->viewDir."slider/edit",$this->data);

    }
    
    public function delete($id){
    	$id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>5
            );
        $delete=$this->slider_model->edit_cond('slider',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Slider image deleted successfully!');

            redirect('admin/slider');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete Slider image!');

            redirect('admin/slider');
        }
    }
    public function inactivate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>0
            );
        $delete=$this->slider_model->edit_cond('slider',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Slider image deactivated successfully!');

            redirect('admin/slider');
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate Slider image!');

            redirect('admin/slider');
        }
    }
    public function activate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>1
            );
        $delete=$this->slider_model->edit_cond('slider',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Slider image activated successfully!');

            redirect('admin/slider');
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate Slider image!');

            redirect('admin/slider');
        }
    }
    
}