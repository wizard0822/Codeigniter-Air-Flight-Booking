<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Logo extends MY_Controller 
{

	function __construct()
	{
		parent::__construct();
        $this->load->model('logo_model');   
        ini_set('post_max_size', '64M');
		ini_set('upload_max_filesize', '64M');
	}
	public function index(){
        $usertype=$this->session->userdata('admin_data');
        $cond = "AND status < 5  order by id asc";
        $logos = $this->logo_model->fetch('logo', $cond);
        $this->data['list'] = $logos;
        $this->get_include();
        $this->load->view('backend/logos/listing',$this->data);
    }
    public function add(){
        if($this->input->post('submit')){
            $data_field['logo_title']=$this->input->post('logo_name');
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
            $store="assets/upload/logo_image/".$newfilename;
            // echo $store;
            move_uploaded_file($temp_name, $store);

            $data_field['logo_image']=$newfilename;
            $data_field['status']=$this->input->post('status');


            $cond = "AND id=$id";
            $this->logo_model->add('logo', $data_field);
            $this->session->set_flashdata('sess_message', 'Logo added successfully!');
            redirect('admin/logo');
            
        }
        $this->get_include();
        $this->load->view('backend/logos/add');
    }
    public function edit($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $list=$this->logo_model->fetch('logo',$cond);
        $this->data['list']=$list;

        if($this->input->post('submit')){
            $data_field['logo_title']=$this->input->post('logo_name');
            $data_field['added_date']=date('Y-m-d H:i:s');

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
                $store="assets/upload/logo_image/".$newfilename;
                // echo $store;
                move_uploaded_file($temp_name, $store);

                $data_field['logo_image']=$newfilename;
                $data_field['status']=$this->input->post('status');


                $cond = "AND id=$id";
                $this->logo_model->edit_cond('logo', $data_field,$cond);
                $this->session->set_flashdata('sess_message', 'Logo Updated successfully!');
                redirect('admin/logo');
            }else{
                $data_field['logo_image']=$list[0]['logo_image'];
                $data_field['status']=$this->input->post('status');


                $cond = "AND id=$id";
                $this->logo_model->edit_cond('logo', $data_field,$cond);
                $this->session->set_flashdata('sess_message', 'Logo Updated successfully!');
                redirect('admin/logo');
            } 
        }
        $this->get_include();
        $this->load->view($this->viewDir."logos/edit",$this->data);
    }
    
    public function delete_logo($id){
    	 $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>5
        );
        $delete=$this->logo_model->edit_cond('logo',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Logo deleted successfully!');

            redirect('admin/logo');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete Logo!');

            redirect('admin/logo');
        }
    }

    public function inactivate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array(
            
            'status'=>0
            );
        $delete=$this->logo_model->edit_cond('logo',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Logo deactivated successfully!');

            redirect('admin/logo');
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate Logo!');

            redirect('admin/logo');
        }
        

    }
    public function activate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            
            'status'=>1
            );
        $delete=$this->logo_model->edit_cond('logo',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Logo activated successfully!');

            redirect('admin/logo');
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate Logo!');

            redirect('admin/logo');
        }
        

    }
}