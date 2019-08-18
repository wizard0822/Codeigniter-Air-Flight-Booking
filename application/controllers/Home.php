<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends UI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('common_model');

	}

	public function index(){
        $this->session->unset_userdata('tab');
		$this->session->unset_userdata('viaAddress1');
        $this->session->unset_userdata('viaLattitude1');
        $this->session->unset_userdata('viaLognitude1');
        $this->session->unset_userdata('viaAddress2');
        $this->session->unset_userdata('viaLattitude2');
        $this->session->unset_userdata('viaLognitude2');
        $this->session->unset_userdata('viaAddress3');
        $this->session->unset_userdata('viaLattitude3');
        $this->session->unset_userdata('viaLognitude3');
        $this->session->unset_userdata('id_vehicletype');
        $this->session->unset_userdata('no_passengers');
        $this->session->unset_userdata('no_large_cases');
        $this->session->unset_userdata('no_cabin_cases');
        $this->session->unset_userdata('airport_id');
        $this->session->unset_userdata('desAddress');
        $this->session->unset_userdata('desLattitude');
        $this->session->unset_userdata('desLognitude');
        $this->session->unset_userdata('pickup_date');
        $this->session->unset_userdata('pickup_minute');
        $this->session->unset_userdata('pickup_hour');
        $this->session->unset_userdata('arrival_minute');
        $this->session->unset_userdata('arrival_hour');
        $this->session->unset_userdata('pickAddress');
        $this->session->unset_userdata('pickLattitude');
        $this->session->unset_userdata('pickLognitude');
        $this->session->unset_userdata('flight_number');
        $this->session->unset_userdata('airline_name');
        $this->session->unset_userdata('originName');
        $this->session->unset_userdata('destinationName');
        $this->session->unset_userdata('airport_select');
        $this->session->unset_userdata('terminal_orig');
        $this->session->unset_userdata('terminal_dest');
        $this->session->unset_userdata('redirect_url_new');
        $this->session->unset_userdata('last_id');
        $this->session->unset_userdata('booking_details');
        $this->session->unset_userdata('payment_details');
        $this->session->unset_userdata('notes');
        $this->session->unset_userdata('tips');
        $this->session->unset_userdata('customer_price');
        $this->session->unset_userdata('driver_price');
        $this->session->unset_userdata('distance');
        $this->session->unset_userdata('zone_id');

        $this->session->unset_userdata('out_viaAddress1');
        $this->session->unset_userdata('out_viaLattitude1');
        $this->session->unset_userdata('out_viaLognitude1');
        $this->session->unset_userdata('out_viaAddress2');
        $this->session->unset_userdata('out_viaLattitude2');
        $this->session->unset_userdata('out_viaLognitude2');
        $this->session->unset_userdata('out_viaAddress3');
        $this->session->unset_userdata('out_viaLattitude3');
        $this->session->unset_userdata('out_viaLognitude3');
        $this->session->unset_userdata('out_id_vehicletype');
        $this->session->unset_userdata('out_no_passengers');
        $this->session->unset_userdata('out_no_large_cases');
        $this->session->unset_userdata('out_no_cabin_cases');
        $this->session->unset_userdata('out_airport_id');
        $this->session->unset_userdata('out_desAddress');
        $this->session->unset_userdata('out_desLattitude');
        $this->session->unset_userdata('out_desLognitude');
        $this->session->unset_userdata('out_pickup_date');
        $this->session->unset_userdata('out_pickup_minute');
        $this->session->unset_userdata('out_pickup_hour');
        $this->session->unset_userdata('out_arrival_minute');
        $this->session->unset_userdata('out_arrival_hour');
        $this->session->unset_userdata('out_pickAddress');
        $this->session->unset_userdata('out_pickLattitude');
        $this->session->unset_userdata('out_pickLognitude');
        $this->session->unset_userdata('out_flight_number');
        $this->session->unset_userdata('out_airline_name');
        $this->session->unset_userdata('out_originName');
        $this->session->unset_userdata('out_destinationName');
        $this->session->unset_userdata('out_airport_select');
        $this->session->unset_userdata('out_terminal_orig');
        $this->session->unset_userdata('out_terminal_dest');
        $this->session->unset_userdata('out_redirect_url_new');
        $this->session->unset_userdata('out_last_id');
        $this->session->unset_userdata('out_booking_details');
        $this->session->unset_userdata('out_payment_details');
        $this->session->unset_userdata('out_notes');
        $this->session->unset_userdata('out_tips');
        $this->session->unset_userdata('out_customer_price');
        $this->session->unset_userdata('out_driver_price');
        $this->session->unset_userdata('out_distance');
        $this->session->unset_userdata('out_zone_id');

        $this->session->unset_userdata('in_viaAddress1');
        $this->session->unset_userdata('in_viaLattitude1');
        $this->session->unset_userdata('in_viaLognitude1');
        $this->session->unset_userdata('in_viaAddress2');
        $this->session->unset_userdata('in_viaLattitude2');
        $this->session->unset_userdata('in_viaLognitude2');
        $this->session->unset_userdata('in_viaAddress3');
        $this->session->unset_userdata('in_viaLattitude3');
        $this->session->unset_userdata('in_viaLognitude3');
        $this->session->unset_userdata('in_id_vehicletype');
        $this->session->unset_userdata('in_no_passengers');
        $this->session->unset_userdata('in_no_large_cases');
        $this->session->unset_userdata('in_no_cabin_cases');
        $this->session->unset_userdata('in_airport_id');
        $this->session->unset_userdata('in_desAddress');
        $this->session->unset_userdata('in_desLattitude');
        $this->session->unset_userdata('in_desLognitude');
        $this->session->unset_userdata('in_pickup_date');
        $this->session->unset_userdata('in_pickup_minute');
        $this->session->unset_userdata('in_pickup_hour');
        $this->session->unset_userdata('in_pickAddress');
        $this->session->unset_userdata('in_pickLattitude');
        $this->session->unset_userdata('in_pickLognitude');
        $this->session->unset_userdata('in_flight_number');
        $this->session->unset_userdata('in_airline_name');
        $this->session->unset_userdata('in_originName');
        $this->session->unset_userdata('in_destinationName');
        $this->session->unset_userdata('in_airport_select');
        $this->session->unset_userdata('in_terminal_orig');
        $this->session->unset_userdata('in_terminal_dest');
        $this->session->unset_userdata('in_last_id');
        $this->session->unset_userdata('in_booking_details');
        $this->session->unset_userdata('in_payment_details');
        $this->session->unset_userdata('in_notes');
        $this->session->unset_userdata('in_tips');
        $this->session->unset_userdata('in_customer_price');
        $this->session->unset_userdata('in_driver_price');
        $this->session->unset_userdata('in_distance');
        $this->session->unset_userdata('in_zone_id');
       	$this->get_include();
        $this->load->view($this->viewDir.'home/index',$this->data);
  }

}