<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Airport extends MY_Controller {
	function __construct()
	{
		parent::__construct();
        $this->load->model('common_model');
	}
	public function index(){
        $usertype=$this->session->userdata('admin_data');
        $cond = "AND status < 5 order by status desc";
        $list = $this->common_model->fetch('airport_tbl', $cond);
        $this->data['list'] = $list;
	//t($list,1);
        $this->get_include();
        $this->load->view($this->viewDir."airport/listing",$this->data);
    }
	public function add(){
        $usertype=$this->session->userdata('admin_data');
		$this->data['ICAO']=$this->input->post('ICAO');
        $this->data['name']=$this->input->post('name');
        $this->data['type']=$this->input->post('type');
        $this->data['address']=$this->input->post('address');
        $this->data['latitude']=$this->input->post('latitude');
        $this->data['longitude']=$this->input->post('longitude');
        $this->data['status']=$this->input->post('status');
        if($this->input->post('submit')){
            $data_field['ICAO']=$this->input->post('ICAO');
            $data_field['name']=$this->input->post('name');
            $data_field['type']=$this->input->post('type');
            $data_field['address']=$this->input->post('address');
            $data_field['latitude']=$this->input->post('latitude');
            $data_field['longitude']=$this->input->post('longitude');
            $data_field['status']=$this->input->post('status');

                // $cond = "AND id=$id";
            // t($id);
                $this->common_model->add('airport_tbl', $data_field);
                // echo $this->db->last_query();die;
                $this->session->set_flashdata('sess_message', 'Airport Added successfully!');
                redirect('admin/airport');
            }
            
        $this->get_include();
        $this->load->view($this->viewDir."airport/add",$this->data);
   }
    public function edit($id){
        $usertype=$this->session->userdata('admin_data');
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $details=$this->common_model->fetch('airport_tbl',$cond);
        // t($details,1);
        $this->data['details']=$details;
        if($this->input->post('submit')){
            $data_field['ICAO']=$this->input->post('ICAO');
            $data_field['name']=$this->input->post('name');
            $data_field['type']=$this->input->post('type');
            $data_field['address']=$this->input->post('address');
            $data_field['latitude']=$this->input->post('latitude');
            $data_field['longitude']=$this->input->post('longitude');
            $data_field['status']=$this->input->post('status');

                // $cond = "AND id=$id";
            // t($id);
                $this->common_model->edit_cond('airport_tbl', $data_field,$cond);
                // echo $this->db->last_query();die;
                $this->session->set_flashdata('sess_message', 'Airport Updated successfully!');
                redirect('admin/airport');
            }
            
        $this->get_include();
        $this->load->view($this->viewDir."airport/edit",$this->data);
   }
   public function delete($id){
        $usertype=$this->session->userdata('admin_data');
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>5,
            );
        $delete=$this->common_model->edit_cond('airport_tbl',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Airport deleted successfully!');

            redirect('admin/airport');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete Airport!');

            redirect('admin/airport');
        }
    }
    public function inactivate($id){
        $usertype=$this->session->userdata('admin_data');
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            
            'status'=>0
            );
        $delete=$this->common_model->edit_cond('airport_tbl',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Airport deactivated successfully!');

            redirect('admin/airport');
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate Airport!');

            redirect('admin/airport');
        }
        

    }
    public function activate($id){
        $usertype=$this->session->userdata('admin_data');
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>1,
            );
        $delete=$this->common_model->edit_cond('airport_tbl',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Airport activated successfully!');

            redirect('admin/airport');
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate Airport!');

            redirect('admin/airport');
        }
    }
}