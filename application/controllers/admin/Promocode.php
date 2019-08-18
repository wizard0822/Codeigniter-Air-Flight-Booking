<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Promocode extends MY_Controller {
	function __construct()
	{
		parent::__construct();
        $this->load->model('common_model');
    }
    public function index(){
        $usertype=$this->session->userdata('admin_data');
        $cond = "";
        $list = $this->common_model->fetch('promocodes_tbl', $cond);
        foreach ($list as $key => $value) {
            # code...

            $list[$key]['id'] = $value['id'];
            $list[$key]['code'] = $value['code'];
            $list[$key]['fixed_customer_amount'] = $value['fixed_customer_amount'];
            $list[$key]['fixed_driver_amount'] = $value['fixed_driver_amount'];
            $list[$key]['percent_customer_amount'] = $value['percent_customer_amount'];
            $list[$key]['percent_driver_amount'] = $value['percent_driver_amount'];
            $list[$key]['expiry_date'] = $value['expiry_date'];
            $list[$key]['expiry_count'] = $value['expiry_count'];
        }
        $this->data['list'] = $list;
	//t($list,1);
        $this->get_include();

        $this->load->view($this->viewDir."promocode/listing",$this->data);
    }
    public function add(){

        if($this->input->post('submit')){
            $data_field['code']=$this->input->post('code');
            $data_field['fixed_customer_amount']=$this->input->post('fixed_customer_amount');
            $data_field['fixed_driver_amount']=$this->input->post('fixed_driver_amount');
            $data_field['percent_customer_amount']=$this->input->post('percent_customer_amount');
            $data_field['percent_driver_amount']=$this->input->post('percent_driver_amount');
            $data_field['expiry_date']=$this->input->post('expiry_date');
            $data_field['expiry_count']=$this->input->post('expiry_count');
            // $data_field['added_date'] =time();

            // t($id);
            $this->common_model->add('promocodes_tbl', $data_field);
                // echo $this->db->last_query();die;
            $this->session->set_flashdata('sess_message', 'Promo Code Added successfully!');
            redirect('admin/promocode');
        }

        $this->get_include();
        $this->load->view($this->viewDir."promocode/add",$this->data);
    }
    public function edit($id){
        $usertype=$this->session->userdata('admin_data');

        $id=base64_decode($id);

        $cond="AND id='$id'";

        $details=$this->common_model->fetch('promocodes_tbl',$cond);

        $this->data['promocode']=$details;
        if($this->input->post('submit')){
            $data_field['code']=$this->input->post('code');
            $data_field['fixed_customer_amount']=$this->input->post('fixed_customer_amount');
            $data_field['fixed_driver_amount']=$this->input->post('fixed_driver_amount');
            $data_field['percent_customer_amount']=$this->input->post('percent_customer_amount');
            $data_field['percent_driver_amount']=$this->input->post('percent_driver_amount');
            $data_field['expiry_date']=$this->input->post('expiry_date');
            $data_field['expiry_count']=$this->input->post('expiry_count');

                // $cond = "AND id=$id";
            // t($id);
            $this->common_model->edit_cond('promocodes_tbl', $data_field,$cond);
                // echo $this->db->last_query();die;
            $this->session->set_flashdata('sess_message', 'Promo Code Updated successfully!');
            redirect('admin/promocode');
        }

        $this->get_include();
        $this->load->view($this->viewDir."promocode/edit",$this->data);
    }

    public function delete($id){
        $usertype=$this->session->userdata('admin_data');
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $delete=$this->common_model->delete_cond('promocodes_tbl', $cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Promo Code deleted successfully!');

            redirect('admin/promocode');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete Promo Code!');

            redirect('admin/promocode');
        }
    }

}