<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vehicle_type extends MY_Controller {
	function __construct()
	{
		parent::__construct();
        $this->load->model('common_model');
	}
	public function index(){
        $usertype=$this->session->userdata('admin_data');
        $cond = "AND status < 5 order by status desc";
        $list = $this->common_model->fetch('vehicle_type_tbl', $cond);
        $this->data['list'] = $list;
	//t($list,1);
        $this->get_include();
        $this->load->view($this->viewDir."vehicle-type/listing",$this->data);
    }
	public function add(){
        $usertype=$this->session->userdata('admin_data');
		$this->data['name']=$this->input->post('name');
        $this->data['type']=$this->input->post('type');
        $this->data['capacity']=$this->input->post('capacity');
        $this->data['case_capacity']=$this->input->post('case_capacity');
        $this->data['notice_period']=$this->input->post('notice_period');
        $this->data['customer_pricepermile']=$this->input->post('customer_pricepermile');
        $this->data['driver_pricepermile']=$this->input->post('driver_pricepermile');
        $this->data['status']=$this->input->post('status');
        if($this->input->post('submit')){
            $data_field['name']=$this->input->post('name');
            $data_field['type']=$this->input->post('type');
            $data_field['capacity']=$this->input->post('capacity');
            $data_field['case_capacity']=$this->input->post('case_capacity');
            $data_field['notice_period']=$this->input->post('notice_period');
            $data_field['customer_pricepermile']=$this->input->post('customer_pricepermile');
            $data_field['driver_pricepermile']=$this->input->post('driver_pricepermile');
            $data_field['status']=$this->input->post('status');
            $data_field['added_date'] =time();

                // $cond = "AND id=$id";
            // t($id);
                $this->common_model->add('vehicle_type_tbl', $data_field);
                // echo $this->db->last_query();die;
                $this->session->set_flashdata('sess_message', 'Vehicle Type Added successfully!');
                redirect('admin/vehicle-type');
            }
            
        $this->get_include();
        $this->load->view($this->viewDir."vehicle-type/add",$this->data);
   }
    public function edit($id){
        $usertype=$this->session->userdata('admin_data');
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $details=$this->common_model->fetch('vehicle_type_tbl',$cond);
        // t($details,1);
        $this->data['details']=$details;
        if($this->input->post('submit')){
            $data_field['name']=$this->input->post('name');
            $data_field['type']=$this->input->post('type');
            $data_field['capacity']=$this->input->post('capacity');
            $data_field['case_capacity']=$this->input->post('case_capacity');
            $data_field['notice_period']=$this->input->post('notice_period');
            $data_field['customer_pricepermile']=$this->input->post('customer_pricepermile');
            $data_field['driver_pricepermile']=$this->input->post('driver_pricepermile');
            $data_field['status']=$this->input->post('status');

                // $cond = "AND id=$id";
            // t($id);
                $this->common_model->edit_cond('vehicle_type_tbl', $data_field,$cond);
                // echo $this->db->last_query();die;
                $this->session->set_flashdata('sess_message', 'Vehicle Type Updated successfully!');
                redirect('admin/vehicle-type');
            }
            
        $this->get_include();
        $this->load->view($this->viewDir."vehicle-type/edit",$this->data);
   }
   public function delete($id){
        $usertype=$this->session->userdata('admin_data');
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>5,
            );
        $delete=$this->common_model->edit_cond('vehicle_type_tbl',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Vehicle Type deleted successfully!');

            redirect('admin/vehicle-type');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete Vehicle Type!');

            redirect('admin/vehicle-type');
        }
    }
    public function inactivate($id){
        $usertype=$this->session->userdata('admin_data');
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            
            'status'=>0
            );
        $delete=$this->common_model->edit_cond('vehicle_type_tbl',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Vehicle Type deactivated successfully!');

            redirect('admin/vehicle-type');
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate Vehicle Type!');

            redirect('admin/vehicle-type');
        }
        

    }
    public function activate($id){
        $usertype=$this->session->userdata('admin_data');
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>1,
            );
        $delete=$this->common_model->edit_cond('vehicle_type_tbl',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Vehicle Type activated successfully!');

            redirect('admin/vehicle-type');
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate Vehicle Type!');

            redirect('admin/vehicle-type');
        }
    }
}