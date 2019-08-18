<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Price_management extends MY_Controller {
	function __construct()
	{
		parent::__construct();
        $this->load->model('common_model');
	}
	public function index(){
        $usertype=$this->session->userdata('admin_data');
        $cond = "AND status < 5 order by status desc";
        $list = $this->common_model->fetch('price_tbl', $cond);
        foreach ($list as $key => $value) {
            # code...
            $airport_id = $value['id_airport'];
            $vehicle_id = $value['id_vehicletype'];
            $zone_id = $value['id_zone'];
            $cond1 = "AND id='$airport_id' AND status=1";
            $airport_list = $this->common_model->fetch('airport_tbl', $cond1);
            $cond2 = "AND id='$vehicle_id' AND status=1";
            $vehicle_list = $this->common_model->fetch('vehicle_type_tbl', $cond2);
            $cond3 = "AND ID_Zone='$zone_id'";
            $zone_list = $this->common_model->fetch('Zone_tbl', $cond3);
            $list[$key]['airport_name'] = $airport_list[0]['name'];
            $list[$key]['airport_id'] = $airport_list[0]['id'];
            $list[$key]['vehicle_name'] = $vehicle_list[0]['name'];
            $list[$key]['zone_name'] = $zone_list[0]['Name'];
        }
        $this->data['list'] = $list;
	//t($list,1);
        $this->get_include();
        $this->load->view($this->viewDir."price/listing",$this->data);
    }
	public function add(){
        $cond1 = "AND status=1";
        $this->data['airport_list'] = $this->common_model->fetch('airport_tbl', $cond1);
        $cond2 = "AND status=1";
        $this->data['vehicle_list'] = $this->common_model->fetch('vehicle_type_tbl', $cond2);
        $this->data['zone_list'] = $this->common_model->fetch('Zone_tbl');
        $usertype=$this->session->userdata('admin_data');
		$this->data['id_airport']=$this->input->post('id_airport');
        $this->data['id_zone']=$this->input->post('id_zone');
        $this->data['id_vehicletype']=$this->input->post('id_vehicletype');
        $this->data['flight_pickup']=$this->input->post('flight_pickup');
        $this->data['customer_price']=$this->input->post('customer_price');
        $this->data['driver_price']=$this->input->post('driver_price');
        $this->data['status']=$this->input->post('status');
        if($this->input->post('submit')){
            $data_field['id_airport']=$this->input->post('id_airport');
            $data_field['id_zone']=$this->input->post('id_zone');
            $data_field['id_vehicletype']=$this->input->post('id_vehicletype');
            $data_field['flight_pickup']=$this->input->post('flight_pickup');
            $data_field['customer_price']=$this->input->post('customer_price');
            $data_field['driver_price']=$this->input->post('driver_price');
            $data_field['status']=$this->input->post('status');
            // $data_field['added_date'] =time();

                // $cond = "AND id=$id";
            // t($id);
                $this->common_model->add('price_tbl', $data_field);
                // echo $this->db->last_query();die;
                $this->session->set_flashdata('sess_message', 'Price Added successfully!');
                redirect('admin/price-management');
            }
            
        $this->get_include();
        $this->load->view($this->viewDir."price/add",$this->data);
   }
    public function edit($id){
        $usertype=$this->session->userdata('admin_data');
        $cond1 = "AND status=1";
        $this->data['airport_list'] = $this->common_model->fetch('airport_tbl', $cond1);
        $cond2 = "AND status=1";
        $this->data['vehicle_list'] = $this->common_model->fetch('vehicle_type_tbl', $cond2);
        $this->data['zone_list'] = $this->common_model->fetch('Zone_tbl');
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $details=$this->common_model->fetch('price_tbl',$cond);
        // t($details,1);
        $this->data['details']=$details;
        if($this->input->post('submit')){
            $data_field['id_airport']=$this->input->post('id_airport');
            $data_field['id_zone']=$this->input->post('id_zone');
            $data_field['id_vehicletype']=$this->input->post('id_vehicletype');
            $data_field['flight_pickup']=$this->input->post('flight_pickup');
            $data_field['customer_price']=$this->input->post('customer_price');
            $data_field['driver_price']=$this->input->post('driver_price');
            $data_field['status']=$this->input->post('status');

                // $cond = "AND id=$id";
            // t($id);
                $this->common_model->edit_cond('price_tbl', $data_field,$cond);
                // echo $this->db->last_query();die;
                $this->session->set_flashdata('sess_message', 'Price Updated successfully!');
                redirect('admin/price-management');
            }
            
        $this->get_include();
        $this->load->view($this->viewDir."price/edit",$this->data);
   }
   public function delete($id){
        $usertype=$this->session->userdata('admin_data');
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>5,
            );
        $delete=$this->common_model->edit_cond('price_tbl',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Price deleted successfully!');

            redirect('admin/price-management');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete Price!');

            redirect('admin/price-management');
        }
    }
    public function inactivate($id){
        $usertype=$this->session->userdata('admin_data');
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            
            'status'=>0
            );
        $delete=$this->common_model->edit_cond('price_tbl',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Price deactivated successfully!');

            redirect('admin/price-management');
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate Price!');

            redirect('admin/price-management');
        }
        

    }
    public function activate($id){
        $usertype=$this->session->userdata('admin_data');
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'status'=>1,
            );
        $delete=$this->common_model->edit_cond('price_tbl',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Price activated successfully!');

            redirect('admin/price-management');
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate Price!');

            redirect('admin/price-management');
        }
    }
}