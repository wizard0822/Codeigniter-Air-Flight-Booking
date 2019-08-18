<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require $_SERVER['DOCUMENT_ROOT'].'/Judo/vendor/autoload.php';

class Outbound extends UI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
        require_once(APPPATH.'libraries/Mailin.php');
    }
    public function index(){
        if($this->input->post('submit'))
        {
            $pickup_date1=$this->input->post('pickup_date');
            //t($pickup_date1);
            $myDateTime = DateTime::createFromFormat('d F Y (D)',$pickup_date1);
            $pickup_hour=$this->input->post('pickup_hour');
            $pickup_minute=$this->input->post('pickup_minute');
            $arrival_hour=$this->input->post('arrival_hour');
            $arrival_minute=$this->input->post('arrival_minute');
            $flight_number=$this->input->post('flight_number');
            $airline_name=$this->input->post('airline_name');
            $originName=$this->input->post('originName');
            $destinationName=$this->input->post('destinationName');
            $terminal_orig = $this->input->post('terminal_orig');
            $terminal_dest = $this->input->post('terminal_dest');
            $pickup_date = $myDateTime->format('m/d/Y');
            // t($pickup_date,1);
            if($pickup_minute=='')
            {
                $pickup_minute="00";
            }
            if($arrival_minute=='')
            {
                $arrival_minute="00";
            }

            $data_field['pickup_date']=$pickup_date;
            $data_field['pickup_time']=$pickup_hour.':'.$pickup_minute;
            $data_field['required_arrival_datetime']=$arrival_hour.':'.$arrival_minute;
            $data_field['flight_number']=$flight_number;
            $data_field['airline_name']=$airline_name;
            $data_field['originName']=$originName;
            $data_field['destinationName']=$destinationName;
            $data_field['terminal_orig']=$terminal_orig;
            $data_field['terminal_dest']=$terminal_dest;
            $data_field['book_by_name'] ="Outbound";

            $this->session->set_userdata('flight_number',$this->input->post('flight_number'));
            $this->session->set_userdata('airline_name',$this->input->post('airline_name'));
            $this->session->set_userdata('originName',$this->input->post('originName'));
            $this->session->set_userdata('destinationName',$this->input->post('destinationName'));
            $this->session->set_userdata('airport_select',$this->input->post('airport_select'));
            $this->session->set_userdata('terminal_orig',$this->input->post('terminal_orig'));
            $this->session->set_userdata('terminal_dest',$this->input->post('terminal_dest'));
            $this->session->set_userdata('pickup_date',$this->input->post('pickup_date'));
            $this->session->set_userdata('pickup_date1',$pickup_date);
            $this->session->set_userdata('pickup_minute',$pickup_minute);
            $this->session->set_userdata('pickup_hour',$this->input->post('pickup_hour'));
            $this->session->set_userdata('arrival_hour',$arrival_hour);
            $this->session->set_userdata('arrival_minute',$this->input->post('arrival_minute'));
            $this->session->set_userdata('departuretime',$this->input->post('departuretime'));
            $this->session->set_userdata('arrivaltime',$this->input->post('arrivaltime'));
            if(empty($this->session->userdata('last_id')))
            {
                $result1=$this->common_model->add('booking_tbl', $data_field);
                $last_id = $this->session->set_userdata('last_id',$result1);
                if(!empty($result1))
                {
                    redirect('outbound/step2');
                }
            }
            else
            {   
                $id= $this->session->userdata('last_id');
                $cond1 = "AND id=$id";
                $result2=$this->common_model->edit_cond('booking_tbl', $data_field, $cond1);
                if(!empty($result2))
                {
                    redirect('outbound/step2');
                }
            }
        }
        $this->get_include();

        $this->load->view($this->viewDir.'outbound/step1',$this->data);
    }
    public function fetch_flight_backup(){
        $flight_number_new = strtoupper($this->input->post('flight_number'));
        $flight_airline = substr($flight_number_new, 0, 2);
        $cond_airline="AND InputPrefix='$flight_airline' AND status=1";
        $airline_ICAO=$this->common_model->fetch('airport_exception', $cond_airline);
            // echo $this->db->last_query();
            // t($airline_ICAO,1);
        if(count($airline_ICAO)>0){
            $ICAO_Code=$airline_ICAO[0]['OutputPrefix'];
            $flight_number=$ICAO_Code.substr($flight_number_new,2);
        }else{
            $flight_number=$flight_number_new;
        }
        $url = "http://flightxml.flightaware.com/json/FlightXML2/FlightInfo?ident=".$flight_number."&howMany=1";
        $header = array();
        $header[] = 'Content-type: application/json';
        $header[] = 'Authorization: Basic QW50aG9ueUNhYm1hc3RlcjpmMTczOGYwNzllMGIyMDU3YTJmN2U2NzVjNzE0MDJkMTllZTY2OGQ0';

        $main_url = $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($result, true);
             // t($data,1);
        if($data['error']){
            echo 0;
        }else{
            $airport_code = $data['FlightInfoResult']['flights'][0]['origin'];
                 // t($airport_code);
            $cond11 = "AND ICAO ='$airport_code' AND status=1";
            $airport_data = $this->common_model->fetch('airport_tbl', $cond11);

            $cond12 = "AND st_within(GeomFromText( 'POINT(".$airport_data[0]['latitude'].' '.$airport_data[0]['longitude'].")' ), Zone)";
            $zone_data = $this->common_model->fetch('Zone_tbl', $cond12);
            	// echo $this->db->last_query();
            	  // t(count($zone_data),1);
            	// if(!empty($zone_data))
            	// {
            		// echo 20;die;
            if(count($airport_data)>0)
            {
               $departuretime=$data['FlightInfoResult']['flights'][0]['filed_departuretime'];
               $arrivaltime=$data['FlightInfoResult']['flights'][0]['estimatedarrivaltime'];
	                    ########################################################
               $url_alt = "http://flightxml.flightaware.com/json/FlightXML2/GetFlightID?ident=".$flight_number."&departureTime=".$departuretime."";

               $ch = curl_init();
               curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
               curl_setopt($ch, CURLOPT_URL, $url_alt);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

               $result_alt = curl_exec($ch);
               curl_close($ch);

               $data_alt = json_decode($result_alt, true);
               $flight_id=$data_alt['GetFlightIDResult'];
	                    // t($data_alt);
	                    // t($url_alt,1);
	                    ########################################################
	                    ########################################################
               $url_alt = "http://flightxml.flightaware.com/json/FlightXML2/AirlineFlightInfo?faFlightID=".$flight_id."";

               $ch = curl_init();
               curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
               curl_setopt($ch, CURLOPT_URL, $url_alt);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

               $result_alt = curl_exec($ch);
               curl_close($ch);

               $data_alt = json_decode($result_alt, true);
               $terminal_orig=$data_alt['AirlineFlightInfoResult']['terminal_orig'];
               $terminal_dest=$data_alt['AirlineFlightInfoResult']['terminal_dest'];
	                    ########################################################

               $flight_ident=$data['FlightInfoResult']['flights'][0]['ident'];
               $airlineCode=substr($flight_ident, 0,3);

               $flight_info['flight_number']=$flight_number;
               $flight_info['originName']=$data['FlightInfoResult']['flights'][0]['originName'];
               $flight_info['destinationName']=$data['FlightInfoResult']['flights'][0]['destinationName'];
               $flight_info['airport_select']=$data['FlightInfoResult']['flights'][0]['origin'];
               $flight_info['departuretime']=date('d M Y H:i',$departuretime);
               $flight_info['arrivaltime']=date('d M Y H:i',$arrivaltime);
               if($terminal_orig!=''){
                   $flight_info['terminal_orig']="Terminal ".$terminal_orig;
               }else{
                   $flight_info['terminal_orig']="";
               }

               if($terminal_dest!=''){
                   $flight_info['terminal_dest']="Terminal ".$terminal_dest;
               }else{
                   $flight_info['terminal_dest']="";
               }

               $url_air = "http://flightxml.flightaware.com/json/FlightXML2/AirlineInfo?airlineCode=".$airlineCode;


               $ch = curl_init();
               curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
               curl_setopt($ch, CURLOPT_URL, $url_air);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

               $result_air = curl_exec($ch);
               curl_close($ch);

               $data_air = json_decode($result_air, true);
	                    // t($data_air['AirlineInfoResult']['shortname'],1);
               if($data_air['AirlineInfoResult']['shortname']!=''){
                   $flight_info['airline_name']=$data_air['AirlineInfoResult']['shortname']." - ".$flight_number_new;
               }else{
                   $flight_info['airline_name']=$data_air['AirlineInfoResult']['name']." - ".$flight_number_new;
               }

               echo json_encode($flight_info);
           }

           else
           {
               $cond11 = "AND ICAO ='$airport_code' AND status=0";
               $airport_data = $this->common_model->fetch('airport_tbl', $cond11);
               if(count($airport_data)>0)
               {
                   echo 2;
               }else{
                   echo 1;
               }
           }
	            // }
	            // // else
	            // // {
	            // // 	echo 10;
	            // // }
       }
   }
   public function fetch_flight(){
    $flight_number_new = strtoupper($this->input->post('flight_number'));
    $flight_airline = substr($flight_number_new, 0, 2);
            // $cond_airline="AND InputPrefix='$flight_airline' AND status=1";
            // $airline_ICAO=$this->common_model->fetch('airport_exception', $cond_airline);
            // // echo $this->db->last_query();
            // // t($airline_ICAO,1);
            // if(count($airline_ICAO)>0){
            //     $ICAO_Code=$airline_ICAO[0]['OutputPrefix'];
            //     $flight_number=$ICAO_Code.substr($flight_number_new,2);
            // }else{
    $flight_number=$flight_number_new;
            // }
    $url = "http://flightxml.flightaware.com/json/FlightXML2/FlightInfo?ident=".$flight_number."&howMany=1";
    $header = array();
    $header[] = 'Content-type: application/json';
    $header[] = 'Authorization: Basic QW50aG9ueUNhYm1hc3RlcjpmMTczOGYwNzllMGIyMDU3YTJmN2U2NzVjNzE0MDJkMTllZTY2OGQ0';

    $main_url = $url;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($result, true);
            // t($url);
            // t($data,1);
    if($data['error']){
        $flight_airline_first_three = substr($flight_number_new, 0, 3);
        if ( ctype_alpha($flight_airline_first_three)){
            echo 0;
        }else{
            $FID= ltrim(substr($flight_number_new, 2),'0') ;
            $IATA = substr( $flight_number_new, 0, 2 );
            $cond="AND IATA_ID = '".$IATA."'";
            $fetch_airline=$this->common_model->fetch('airline', $cond);
            if(count($fetch_airline)){
                $flight_number=$fetch_airline[0]['ICAO_ID'].$FID;
                $url = "http://flightxml.flightaware.com/json/FlightXML2/FlightInfo?ident=".$flight_number."&howMany=1";
                $header = array();
                $header[] = 'Content-type: application/json';
                $header[] = 'Authorization: Basic QW50aG9ueUNhYm1hc3RlcjpmMTczOGYwNzllMGIyMDU3YTJmN2U2NzVjNzE0MDJkMTllZTY2OGQ0';

                $main_url = $url;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                $result = curl_exec($ch);
                curl_close($ch);

                $data = json_decode($result, true);

                if($data['error']){
                    echo 0;
                }else{
                    $airport_code = $data['FlightInfoResult']['flights'][0]['origin'];
                             // t($airport_code);
                    $cond11 = "AND ICAO ='$airport_code' AND status=1";
                    $airport_data = $this->common_model->fetch('airport_tbl', $cond11);

                    $cond12 = "AND st_within(GeomFromText( 'POINT(".$airport_data[0]['latitude'].' '.$airport_data[0]['longitude'].")' ), Zone)";
                    $zone_data = $this->common_model->fetch('Zone_tbl', $cond12);
                            // echo $this->db->last_query();
                              // t(count($zone_data),1);
                            // if(!empty($zone_data))
                            // {
                                // echo 20;die;
                    if(count($airport_data)>0)
                    {
                        $departuretime=$data['FlightInfoResult']['flights'][0]['filed_departuretime'];
                        $arrivaltime=$data['FlightInfoResult']['flights'][0]['estimatedarrivaltime'];
                                    ########################################################
                        $url_alt = "http://flightxml.flightaware.com/json/FlightXML2/GetFlightID?ident=".$flight_number."&departureTime=".$departuretime."";

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
                        curl_setopt($ch, CURLOPT_URL, $url_alt);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                        $result_alt = curl_exec($ch);
                        curl_close($ch);

                        $data_alt = json_decode($result_alt, true);
                        $flight_id=$data_alt['GetFlightIDResult'];
                                    // t($data_alt);
                                    // t($url_alt,1);
                                    ########################################################
                                    ########################################################
                        $url_alt = "http://flightxml.flightaware.com/json/FlightXML2/AirlineFlightInfo?faFlightID=".$flight_id."";

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
                        curl_setopt($ch, CURLOPT_URL, $url_alt);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                        $result_alt = curl_exec($ch);
                        curl_close($ch);

                        $data_alt = json_decode($result_alt, true);
                        $terminal_orig=$data_alt['AirlineFlightInfoResult']['terminal_orig'];
                        $terminal_dest=$data_alt['AirlineFlightInfoResult']['terminal_dest'];
                                    ########################################################

                        $flight_ident=$data['FlightInfoResult']['flights'][0]['ident'];
                        $airlineCode=substr($flight_ident, 0,3);

                        $flight_info['flight_number']=$flight_number;
                        $flight_info['originName']=$data['FlightInfoResult']['flights'][0]['originName'];
                        $flight_info['destinationName']=$data['FlightInfoResult']['flights'][0]['destinationName'];
                        $flight_info['airport_select']=$data['FlightInfoResult']['flights'][0]['origin'];
                        $flight_info['departuretime']=date('d M Y H:i',$departuretime);
                        $flight_info['arrivaltime']=date('d M Y H:i',$arrivaltime);
                        if($terminal_orig!=''){
                            $flight_info['terminal_orig']="Terminal ".$terminal_orig;
                        }else{
                            $flight_info['terminal_orig']="";
                        }

                        if($terminal_dest!=''){
                            $flight_info['terminal_dest']="Terminal ".$terminal_dest;
                        }else{
                            $flight_info['terminal_dest']="";
                        }

                        $url_air = "http://flightxml.flightaware.com/json/FlightXML2/AirlineInfo?airlineCode=".$airlineCode;


                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
                        curl_setopt($ch, CURLOPT_URL, $url_air);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                        $result_air = curl_exec($ch);
                        curl_close($ch);

                        $data_air = json_decode($result_air, true);
                                    // t($data_air['AirlineInfoResult']['shortname'],1);
                        if($data_air['AirlineInfoResult']['shortname']!=''){
                            $flight_info['airline_name']=$data_air['AirlineInfoResult']['shortname']." - ".$flight_number_new;
                        }else{
                            $flight_info['airline_name']=$data_air['AirlineInfoResult']['name']." - ".$flight_number_new;
                        }

                        echo json_encode($flight_info);
                    }

                    else
                    {
                        $cond11 = "AND ICAO ='$airport_code' AND status=0";
                        $airport_data = $this->common_model->fetch('airport_tbl', $cond11);
                        if(count($airport_data)>0)
                        {
                            echo 2;
                        }else{
                            echo 1;
                        }
                    }
                            // }
                            // // else
                            // // {
                            // //   echo 10;
                            // // }
                }

            }else{
                echo 0;
            }
        }
    }else{
        $airport_code = $data['FlightInfoResult']['flights'][0]['origin'];
                 // t($airport_code);
        $cond11 = "AND ICAO ='$airport_code' AND status=1";
        $airport_data = $this->common_model->fetch('airport_tbl', $cond11);

        $cond12 = "AND st_within(GeomFromText( 'POINT(".$airport_data[0]['latitude'].' '.$airport_data[0]['longitude'].")' ), Zone)";
        $zone_data = $this->common_model->fetch('Zone_tbl', $cond12);
                // echo $this->db->last_query();
                  // t(count($zone_data),1);
                // if(!empty($zone_data))
                // {
                    // echo 20;die;
        if(count($airport_data)>0)
        {
            $departuretime=$data['FlightInfoResult']['flights'][0]['filed_departuretime'];
            $arrivaltime=$data['FlightInfoResult']['flights'][0]['estimatedarrivaltime'];
                        ########################################################
            $url_alt = "http://flightxml.flightaware.com/json/FlightXML2/GetFlightID?ident=".$flight_number."&departureTime=".$departuretime."";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
            curl_setopt($ch, CURLOPT_URL, $url_alt);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $result_alt = curl_exec($ch);
            curl_close($ch);

            $data_alt = json_decode($result_alt, true);
            $flight_id=$data_alt['GetFlightIDResult'];
                        // t($data_alt);
                        // t($url_alt,1);
                        ########################################################
                        ########################################################
            $url_alt = "http://flightxml.flightaware.com/json/FlightXML2/AirlineFlightInfo?faFlightID=".$flight_id."";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
            curl_setopt($ch, CURLOPT_URL, $url_alt);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $result_alt = curl_exec($ch);
            curl_close($ch);

            $data_alt = json_decode($result_alt, true);
            $terminal_orig=$data_alt['AirlineFlightInfoResult']['terminal_orig'];
            $terminal_dest=$data_alt['AirlineFlightInfoResult']['terminal_dest'];
                        ########################################################

            $flight_ident=$data['FlightInfoResult']['flights'][0]['ident'];
            $airlineCode=substr($flight_ident, 0,3);

            $flight_info['flight_number']=$flight_number;
            $flight_info['originName']=$data['FlightInfoResult']['flights'][0]['originName'];
            $flight_info['destinationName']=$data['FlightInfoResult']['flights'][0]['destinationName'];
            $flight_info['airport_select']=$data['FlightInfoResult']['flights'][0]['origin'];
            $flight_info['departuretime']=date('d M Y H:i',$departuretime);
            $flight_info['arrivaltime']=date('d M Y H:i',$arrivaltime);
            if($terminal_orig!=''){
                $flight_info['terminal_orig']="Terminal ".$terminal_orig;
            }else{
                $flight_info['terminal_orig']="";
            }

            if($terminal_dest!=''){
                $flight_info['terminal_dest']="Terminal ".$terminal_dest;
            }else{
                $flight_info['terminal_dest']="";
            }

            $url_air = "http://flightxml.flightaware.com/json/FlightXML2/AirlineInfo?airlineCode=".$airlineCode;


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
            curl_setopt($ch, CURLOPT_URL, $url_air);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $result_air = curl_exec($ch);
            curl_close($ch);

            $data_air = json_decode($result_air, true);
                        // t($data_air['AirlineInfoResult']['shortname'],1);
            if($data_air['AirlineInfoResult']['shortname']!=''){
                $flight_info['airline_name']=$data_air['AirlineInfoResult']['shortname']." - ".$flight_number_new;
            }else{
                $flight_info['airline_name']=$data_air['AirlineInfoResult']['name']." - ".$flight_number_new;
            }

            echo json_encode($flight_info);
        }

        else
        {
            $cond11 = "AND ICAO ='$airport_code' AND status=0";
            $airport_data = $this->common_model->fetch('airport_tbl', $cond11);
            if(count($airport_data)>0)
            {
                echo 2;
            }else{
                echo 1;
            }
        }
                // }
                // // else
                // // {
                // //   echo 10;
                // // }
    }



}
public function fetch_hour_minute(){
    $selected_date=$this->input->post('selected_date');
        // $current_date=date('m/d/Y');
    $current_date=$this->input->post('current_date');
    $current_hour=$this->input->post('current_hour');
    $current_minute=$this->input->post('current_minute');
    $tomorrow = date("m/d/Y", strtotime("+1 day", strtotime($current_date)));
        // $current_datetime=
    $option_h='';
    $option_m='';
        // t($selected_date);
        // t($tomorrow,1);
        // t($current_date,1);
    if($selected_date==$current_date){
        $newdate=$current_date." ".$current_hour.":".$current_minute;
        $newtime = strtotime($newdate) + (4 * 60 * 60);
        $hour_to_start=date('H',$newtime);
        $minute_to_start=date('i',$newtime);
        if($minute_to_start>55){

            $hour_to_start=$hour_to_start+1;
            $minute_to_start=0;
        }
            // if($hour_to_start==24){
            //     $hour_to_start=0;
            // }


        $option_h='<option value="">Select</option>';
        $option_m='<option value="">Select</option>';
        for ($i=$hour_to_start; $i <= 23; $i++) { 
            $option_h=$option_h."<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
        }

        for ($i=$this->ceilFive($minute_to_start); $i <=55; $i+=5) { 
            $option_m=$option_m."<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
        }
    }else if($selected_date==$tomorrow){

            // t($current_hour,1);
        if($current_hour>=20){
                //echo 2;die;
            $newdate=$current_date." ".$current_hour.":".$current_minute;
            $newtime = strtotime($newdate) + (4 * 60 * 60);
            $hour_to_start=date('H',$newtime);
            $minute_to_start=date('i',$newtime);
            if($minute_to_start>55){
                    //t(1);
                $hour_to_start=$hour_to_start+1;
                $minute_to_start=0;
            }
            if($hour_to_start==24){
                    //t(2);
                $hour_to_start=0;
            }
                // t($hour_to_start,1);
            $option_h='<option value="">Select</option>';
            $option_m='<option value="">Select</option>';
            for ($i=$hour_to_start; $i <= 23; $i++) { 
                    //t($i);
                $option_h=$option_h."<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
                }//die;
                
                for ($i=$this->ceilFive($minute_to_start); $i <=55; $i+=5) { 
                    $option_m=$option_m."<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
                }
            }else{
            //echo 1;die;
                $newtime = 0;
                $hour_to_start=0;
                $minute_to_start=0;
                 //t($minute_to_start,1);
                $option_h='<option value="">Select</option>';
                $option_m='<option value="">Select</option>';
                for ($i=$hour_to_start; $i <= 23; $i++) { 
                    $option_h=$option_h."<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
                }

                for ($i=0; $i <=55; $i+=5) { 
                    $option_m=$option_m."<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
                }
                 // t($option_m,1);
            }
        }else{
            $option_h='<option value="">Select</option>';
            $option_m='<option value="">Select</option>';
            $newtime = '00';
            $hour_to_start='00';
            $minute_to_start='00';
            for ($i=$hour_to_start; $i <= 23; $i++) { 
                $option_h=$option_h."<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
            }

            for ($i=$minute_to_start; $i <=55; $i+=5) { 
                $option_m=$option_m."<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
            }
        }
        $option['hours']=$option_h;
        $option['minute']=$option_m;
        echo json_encode($option);
    }
    public function fetch_minute(){
        $selected_date=$this->input->post('selected_date');
        $selected_hour=$this->input->post('selected_hour');
        $current_hour=$this->input->post('current_hour');
        $current_minute=$this->input->post('current_minute');
        $current_date=$this->input->post('current_date');
        $tomorrow = date("m/d/Y", strtotime("+1 day", strtotime($current_date)));
        // $current_datetime=
        // if($selected_hour=='00'){
        //     $selected_hour=24;
        // }
        $option_h='';
        $option_m='';
        // t($selected_date);
        // t($current_date,1);
        if($selected_date==$current_date){
            $newdate=$current_date." ".$current_hour.":".$current_minute;
            $newtime = strtotime($newdate) + (4 * 60 * 60);
            $hour_to_start=date('H',$newtime);
            $minute_to_start=date('i',$newtime);
            // t(date('Y-m-d H:i',$newtime));
            // t($selected_hour);
            // t($minute_to_start,1);
            $option_m='<option value="">Select</option>';
            if($minute_to_start>55){
                $hour_to_start=$hour_to_start+1;
                $minute_to_start=0;
            }
            if($hour_to_start==24){
                $hour_to_start=0;
            }
            if($hour_to_start >= $selected_hour){
              // t($hour_to_start);
            // t($selected_hour,1);

             for ($i=$this->ceilFive($minute_to_start); $i <=55; $i+=5) { 
                $option_m=$option_m."<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
            }
        }else{


            for ($i=00; $i <=55; $i+=5) { 

                $option_m=$option_m."<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
                

            }
        }

    }else if($selected_date==$tomorrow){
        $newdate=$current_date." ".$current_hour.":".$current_minute;
        $newtime = strtotime($newdate) + (4 * 60 * 60);
        $hour_to_start=date('H',$newtime);
        $minute_to_start=date('i',$newtime);
            // t(date('Y-m-d H:i',$newtime));
            // t($selected_hour);
            // t($hour_to_start);
            // t($minute_to_start,1);
        $newdate1=$selected_date." ".$current_hour.":".$current_minute;
        $newtime1 = strtotime($newdate) + (4 * 60 * 60);

        $option_m='<option value="">Select</option>';
        if($minute_to_start>55){
            $hour_to_start=$hour_to_start+1;
            $minute_to_start=0;
        }
        if($hour_to_start==24){
            $hour_to_start=0;
        }
        if($hour_to_start >= $selected_hour){
              // t($hour_to_start);
            // t($selected_hour,1);

            if($current_hour>=20){
                for ($i=$this->ceilFive($minute_to_start); $i <=55; $i+=5) { 
                    $option_m=$option_m."<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
                }
            }else{
                for ($i=00; $i <=55; $i+=5) { 

                    $option_m=$option_m."<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
                    

                }
            }

        }else{


            for ($i=00; $i <=55; $i+=5) { 

                $option_m=$option_m."<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
                

            }
        }

    }else{
        $newtime = '00';
        $hour_to_start='00';
        $minute_to_start='00';

        $option_m='<option value="">Select</option>';
        for ($i=$minute_to_start; $i <=55; $i+=5) { 
            $option_m=$option_m."<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
        }
    }

    $option['minute']=$option_m;
    echo json_encode($option);
}
function ceilFive($number) {
    $div = floor($number / 5);
    $mod = $number % 5;

    if ($mod > 0){
       $add = 5;
   }else{ $add = 0;
   }

   return $div * 5 + $add;
}
public function fetch_flight_details(){
    $flight_number = $this->input->post('flight_number');
    $url = "http://aviation-edge.com/v2/public/flights?key=f4413c-d274b8&flightIata=".$flight_number;
            //$url = "http://aviation-edge.com/api/public/flights?key=64febe-cebc30&flight[iataNumber]=".$flight_number;
            //t($url);die;
    $main_url = $url;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($result, true);
    t($data,1);
    echo json_encode($data);
}
/*
 * Validate promo code
 @return true or false
*/
public function validate_promo_code() {
    $input_promo_code = strtoupper($this->input->post('promo_code'));
    $cond = "AND code = '$input_promo_code' AND expiry_date > CURDATE() AND expiry_count >= 0";

    $promo_code = $this->common_model->fetch('promocodes_tbl', $cond);

    log_message('debug', $promo_code);

    if (empty($promo_code)) {
        $response_array['status'] = 'error';
        $this->session->set_userdata('promo_code_str', null);
    }else{
        $response_array['status'] = 'success';
        $this->session->set_userdata('promo_code_str', $promo_code[0]['code']);
    }
    echo json_encode($response_array);
} 
public function step2(){
    if($this->session->userdata('last_id')!='')
    {
        $airport_code = $this->session->userdata('airport_select');
        $cond = "AND ICAO='$airport_code' AND status=1";
        $airport_data = $this->common_model->fetch('airport_tbl', $cond);
        $this->data['airport_name'] = $airport_data[0]['name'];
        $this->data['airport_address'] = $airport_data[0]['address'];
        $this->data['airport_latitude'] = $airport_data[0]['latitude'];
        $this->data['airport_longitude'] = $airport_data[0]['longitude'];
        $id= $this->session->userdata('last_id');
        $cond1 = "AND id=$id";


            // echo $this->db->last_query();
            // t($this->session->userdata('last_id'));
            // t($airport_data[0]['latitude']);
            // t($airport_data[0]['longitude']);
            // t($zone_data,1);

        //     $sql = "SELECT * ";
        // 	$sql.=" FROM sb_Zone_tbl";
        //     $where = " where 1=1 AND admin_id=$admin_id and current_status ='Active'  ";

        // $odr = " order by prospect_name asc";

        // $sql1 = $sql . $where . $odr;
        // $query = $this->db->query($sql1);

        if($this->input->post('submit'))
        {
            $airport_id=$airport_data[0]['id'];
            $pickAddress=$this->input->post('pickAddress');
            $pickLattitude=$this->input->post('pickLattitude');
            $pickLognitude=$this->input->post('pickLognitude');
            $desAddress=$this->input->post('desAddress');
            $desLattitude=$this->input->post('desLattitude');
            $desLognitude=$this->input->post('desLognitude');
            $viaAddress1=$this->input->post('viaAddress_1');
            $viaLattitude1=$this->input->post('viaLattitude1');
            $viaLognitude1=$this->input->post('viaLognitude1');
            $viaAddress2=$this->input->post('viaAddress_2');
            $viaLattitude2=$this->input->post('viaLattitude2');
            $viaLognitude2=$this->input->post('viaLognitude2');
            $viaAddress3=$this->input->post('viaAddress_3');
            $viaLattitude3=$this->input->post('viaLattitude3');
            $viaLognitude3=$this->input->post('viaLognitude3');


            $apiKey = 'AIzaSyDmu1Ie1Au-kvOJI64QEuvonXWjkkdX9Uc';
            if(!empty($viaAddress1) && empty($viaAddress2) && empty($viaAddress3))
            { 
                $formattedAddrFrom    =  str_replace(' ', '+', $viaAddress1);
                $formattedAddrTo     = str_replace(' ', '+', $pickAddress);
                $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$formattedAddrTo."&destinations=".$formattedAddrFrom."&units=imperial&mode=driving&language=fr-FR&key=AIzaSyDmu1Ie1Au-kvOJI64QEuvonXWjkkdX9Uc";

                            // $main_url = $url;
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                $result = curl_exec($ch);
                curl_close($ch);

                $data = json_decode($result, true);
                $dis = $data['rows'][0]['elements'][0]['distance']['text'];
                $distance = str_replace(',', '.', $dis);

                $cond2 = "AND st_within(GeomFromText( 'POINT(".$viaLattitude1.' '.$viaLognitude1.")' ), Zone)";
                $zone_data = $this->common_model->fetch('Zone_tbl', $cond2);
                $zone_id = $zone_data[0]['ID_Zone'];
            }
            else if(!empty($viaAddress1) && !empty($viaAddress2) && empty($viaAddress3))
            {
                $formattedAddrFrom1    =  str_replace(' ', '+', $viaAddress1);
                $formattedAddrTo1     = str_replace(' ', '+', $pickAddress);
                $formattedAddrFrom2    =  str_replace(' ', '+', $viaAddress2);
                $formattedAddrTo2     = str_replace(' ', '+', $viaAddress1);
                $url1 = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$formattedAddrTo1."&destinations=".$formattedAddrFrom1."&units=imperial&mode=driving&language=fr-FR&key=AIzaSyDmu1Ie1Au-kvOJI64QEuvonXWjkkdX9Uc";

                            // $main_url = $url;
                $ch1 = curl_init();

                curl_setopt($ch1, CURLOPT_URL, $url1);
                curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);

                $result1 = curl_exec($ch1);
                curl_close($ch1);

                $data1 = json_decode($result1, true);
                $dis1 = $data1['rows'][0]['elements'][0]['distance']['text'];
                $distance1 = str_replace(',', '.', $dis1);

                $url2 = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$formattedAddrTo2."&destinations=".$formattedAddrFrom2."&units=imperial&mode=driving&language=fr-FR&key=AIzaSyDmu1Ie1Au-kvOJI64QEuvonXWjkkdX9Uc";

                            // $main_url = $url;
                $ch2 = curl_init();

                curl_setopt($ch2, CURLOPT_URL, $url2);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);

                $result2 = curl_exec($ch2);
                curl_close($ch2);

                $data2 = json_decode($result2, true);
                $dis2 = $data2['rows'][0]['elements'][0]['distance']['text'];
                $distance2 = str_replace(',', '.', $dis2);
                $distance = $distance1 + $distance2;

                $cond2 = "AND st_within(GeomFromText( 'POINT(".$viaLattitude2.' '.$viaLognitude2.")' ), Zone)";
                $zone_data = $this->common_model->fetch('Zone_tbl', $cond2);
                $zone_id = $zone_data[0]['ID_Zone'];
            }
            else if(!empty($viaAddress1) && !empty($viaAddress2) && !empty($viaAddress3))
            {
                    // echo 1;
                $formattedAddrFrom1    =  str_replace(' ', '+', $viaAddress1);
                $formattedAddrTo1     = str_replace(' ', '+', $pickAddress);
                $formattedAddrFrom2    =  str_replace(' ', '+', $viaAddress2);
                $formattedAddrTo2     = str_replace(' ', '+', $viaAddress1);
                $formattedAddrFrom3    =  str_replace(' ', '+', $viaAddress3);
                $formattedAddrTo3     = str_replace(' ', '+', $viaAddress2);
                $url1 = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$formattedAddrTo1."&destinations=".$formattedAddrFrom1."&units=imperial&mode=driving&language=fr-FR&key=AIzaSyDmu1Ie1Au-kvOJI64QEuvonXWjkkdX9Uc";

                            // $main_url = $url;
                $ch1 = curl_init();

                curl_setopt($ch1, CURLOPT_URL, $url1);
                curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);

                $result1 = curl_exec($ch1);
                curl_close($ch1);

                $data1 = json_decode($result1, true);
                $dis1 = $data1['rows'][0]['elements'][0]['distance']['text'];
                $distance1 = str_replace(',', '.', $dis1);

                $url2 = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$formattedAddrTo2."&destinations=".$formattedAddrFrom2."&units=imperial&mode=driving&language=fr-FR&key=AIzaSyDmu1Ie1Au-kvOJI64QEuvonXWjkkdX9Uc";

                            // $main_url = $url;
                $ch2 = curl_init();

                curl_setopt($ch2, CURLOPT_URL, $url2);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);

                $result2 = curl_exec($ch2);
                curl_close($ch2);

                $data2 = json_decode($result2, true);
                $dis2 = $data2['rows'][0]['elements'][0]['distance']['text'];
                $distance2 = str_replace(',', '.', $dis2);

                $url3 = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$formattedAddrTo3."&destinations=".$formattedAddrFrom3."&units=imperial&mode=driving&language=fr-FR&key=AIzaSyDmu1Ie1Au-kvOJI64QEuvonXWjkkdX9Uc";

                            // $main_url = $url;
                $ch3 = curl_init();

                curl_setopt($ch3, CURLOPT_URL, $url3);
                curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);

                $result3 = curl_exec($ch3);
                curl_close($ch3);

                $data3 = json_decode($result3, true);
                $dis3 = $data3['rows'][0]['elements'][0]['distance']['text'];
                $distance3 = str_replace(',', '.', $dis3);
                $distance = $distance1 + $distance2 + $distance3;

                $cond2 = "AND st_within(GeomFromText( 'POINT(".$viaLattitude3.' '.$viaLognitude3.")' ), Zone)";
                $zone_data = $this->common_model->fetch('Zone_tbl', $cond2);
                $zone_id = $zone_data[0]['ID_Zone'];
            }
            else
            {
               $cond2 = "AND st_within(GeomFromText( 'POINT(".$pickLattitude.' '.$pickLognitude.")' ), Zone)";
               $zone_data = $this->common_model->fetch('Zone_tbl', $cond2);
               $zone_id = $zone_data[0]['ID_Zone'];
           }

                //echo $this->db->last_query();
                 // t($distance,1);

           $data_field['pickup_address']=$airport_id;
           $data_field['address']=$pickAddress;
           $data_field['lat']=$pickLattitude;
           $data_field['long']=$pickLognitude;
           $data_field['destination_address']=$desAddress;
           $data_field['destination_address_lat']=$desLattitude;
           $data_field['destination_address_long']=$desLognitude;
           $data_field['via1_address']= $viaAddress1;
           $data_field['via1_address_lat']= $viaLattitude1;
           $data_field['via1_address_long']= $viaLognitude1;
           $data_field['via2_address']= $viaAddress2;
           $data_field['via2_address_lat']= $viaLattitude2;
           $data_field['via2_address_long']= $viaLognitude2;
           $data_field['via3_address']= $viaAddress3;
           $data_field['via3_address_lat']= $viaLattitude3;
           $data_field['via3_address_long']= $viaLognitude3;

           $this->session->set_userdata('airport_id',$airport_id);
           $this->session->set_userdata('pickAddress',$this->input->post('pickAddress'));
           $this->session->set_userdata('pickLognitude',$this->input->post('pickLognitude'));
           $this->session->set_userdata('pickLattitude',$this->input->post('pickLattitude'));
           $this->session->set_userdata('viaAddress1',$this->input->post('viaAddress_1'));
           $this->session->set_userdata('viaLattitude1',$this->input->post('viaLattitude1'));
           $this->session->set_userdata('viaLognitude1',$this->input->post('viaLognitude1'));
           $this->session->set_userdata('viaAddress2',$this->input->post('viaAddress_2'));
           $this->session->set_userdata('viaLattitude2',$this->input->post('viaLattitude2'));
           $this->session->set_userdata('viaLognitude2',$this->input->post('viaLognitude2'));
           $this->session->set_userdata('viaAddress3',$this->input->post('viaAddress_3'));
           $this->session->set_userdata('viaLattitude3',$this->input->post('viaLattitude3'));
           $this->session->set_userdata('viaLognitude3',$this->input->post('viaLognitude3'));
           $this->session->set_userdata('zone_id',$zone_id);
           $this->session->set_userdata('distance',$distance);
           $edit = $this->common_model->edit_cond('booking_tbl', $data_field, $cond1);
           if(!empty($edit))
           {
            redirect('outbound/step3');
        }
    }
}
else
{
    redirect('outbound');
}
$this->get_include();
$this->load->view($this->viewDir.'outbound/step2',$this->data);
}
public function fetch_zone()
{
   $latitude = $this->input->post('latitude');
   $longitude = $this->input->post('longitude');
    	// t($latitude);
    	// t($longitude);
   $cond2 = "AND st_within(GeomFromText( 'POINT(".$latitude.' '.$longitude.")' ), Zone)";
   $zone_data = $this->common_model->fetch('Zone_tbl', $cond2);
         // echo $this->db->last_query();
   if(!empty($zone_data))
   {
       echo 1;
   }
   else
   {
       echo 0;
   }
        // exit();
        //$zone_id = $zone_data[0]['ID_Zone'];

}
public function step3(){
    if($this->session->userdata('last_id'))
    {
        $cond = "AND status=1";
        $vehicle_data = $this->common_model->fetch('vehicle_type_tbl', $cond);
        $this->data['vehicle_data'] = $vehicle_data;
        $id= $this->session->userdata('last_id');
        $cond1 = "AND id=$id";
        $details = $this->common_model->fetch('booking_tbl',$cond1);
        $userDetails=$this->session->userdata('login_data');
        $this->data['userDetails'] = $userDetails;

        if($this->input->post('submit'))
        {
            $id_vehicletype=$this->input->post('id_vehicletype');
            $no_passengers=$this->input->post('no_passengers');
            $no_large_cases=$this->input->post('no_large_cases');
            $no_cabin_cases=$this->input->post('no_cabin_cases');
            $notes=$this->input->post('notes');

            $data_field['id_vehicletype']=$id_vehicletype;
            $data_field['no_passengers']=$no_passengers;
            $data_field['no_large_cases']= $no_large_cases;
            $data_field['no_cabin_cases']= $no_cabin_cases;
            $data_field['notes']= $notes;
            if($details[0]['id_customer']=='')
            {
                $data_field['id_customer']= $userDetails['id'];
                $data_field['customer_name']= $userDetails['firstname'].' '.$userDetails['lastname'];
                $data_field['customer_telephone']= $userDetails['telephone'];
                $data_field['customer_email']= $userDetails['email_address'];
                $data_field['customer_country_code']= $userDetails['country_code'];
            }
            $edit = $this->common_model->edit_cond('booking_tbl', $data_field, $cond1);

            $this->session->set_userdata('id_vehicletype',$this->input->post('id_vehicletype'));
            $this->session->set_userdata('no_passengers',$this->input->post('no_passengers'));
            $this->session->set_userdata('no_large_cases',$this->input->post('no_large_cases'));
            $this->session->set_userdata('no_cabin_cases',$this->input->post('no_cabin_cases'));
            $this->session->set_userdata('notes',$this->input->post('notes'));


            if(!empty($edit))
            {
                    //t($data,1);

                if(!empty($this->session->userdata('login_data')))
                {
                   redirect('outbound/step4');
               }
               else
               {
                $url =base_url()."outbound/step4";
                        //t($url,1);
                $this->session->set_userdata('redirect_url_new',$url);
                        // t($this->session->userdata('redirect_url'),1);
                redirect('signin');
            }
        }
    }
}
else
{
    redirect('outbound');
}
$this->get_include();
$this->load->view($this->viewDir.'outbound/step3',$this->data);
}
public function fetch_passenger()
{
    $id_vehicletype = $this->input->post('id_vehicletype');
    $cond = "AND id =$id_vehicletype AND status=1";
    $passenger_data = $this->common_model->fetch('vehicle_type_tbl', $cond);
    $capacity = $passenger_data[0]['capacity'];
    echo '<option value="">Please Select</option>';
    for ($i=1; $i <=$capacity ; $i++) { 
            # code...
        if($i==$this->session->userdata('no_passengers'))
        {
            echo '<option value="'.$i.'" selected>'.$i.'</option>';
        }
        else
        {
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
    }
}
public function fetch_large_case()
{
    $id_vehicletype = $this->input->post('id_vehicletype');
    $cond = "AND id =$id_vehicletype AND status=1";
    $case_data = $this->common_model->fetch('vehicle_type_tbl', $cond);
    $case_capacity = $case_data[0]['case_capacity'];
    echo '<option value="">Please Select</option>';
    if($this->session->userdata('no_large_cases')=="0")
    {
        echo '<option value=0 selected>0</option>';
    }
    else
    {
        echo '<option value=0>0</option>';
    }
    for ($i=1; $i <=$case_capacity ; $i++) { 
            # code...
        if($i==$this->session->userdata('no_large_cases'))
        {
            echo '<option value="'.$i.'" selected>'.$i.'</option>';
        }
        else
        {
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
    }
}
public function fetch_small_case()
{
    $id_vehicletype = $this->input->post('id_vehicletype');
    $no_passengers = $this->input->post('no_passengers');
    $no_large_cases = $this->input->post('no_large_cases');
    $cond = "AND id =$id_vehicletype AND status=1";
    $case_data = $this->common_model->fetch('vehicle_type_tbl', $cond);
    $passenger = $case_data[0]['capacity'];
    $large_capacity = $case_data[0]['case_capacity'];
    $small_capacity =  (($large_capacity-$no_large_cases) * 2) + ($passenger-$no_passengers);
    echo '<option value="">Please Select</option>';
    if($this->session->userdata('no_cabin_cases')=="0")
    {
        echo '<option value=0 selected>0</option>';
    }
    else
    {
        echo '<option value=0>0</option>';
    }
    for ($i=1; $i <=$small_capacity ; $i++) { 
            # code...
        if($i==$this->session->userdata('no_cabin_cases'))
        {
            echo '<option value="'.$i.'" selected>'.$i.'</option>';
        }
        else
        {
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
    }
}
public function fetch_notice_period_backup()
{
        // echo 1;
    $id_vehicletype = $this->input->post('id_vehicletype');
    $cond = "AND id =$id_vehicletype AND status=1";
    $case_data = $this->common_model->fetch('vehicle_type_tbl', $cond);
    $notice_period = $case_data[0]['notice_period'];
    $time24 = date('m/d/Y G:i',strtotime('+24 hour'));
    $time48 = date('m/d/Y G:i',strtotime('+48 hour'));
    $time8 = date('m/d/Y G:i',strtotime('+8 hour'));
    $pickup_datetime = $this->session->userdata('pickup_date1').' '.$this->session->userdata('pickup_hour').':'.$this->session->userdata('pickup_minute');
        // t($pickup_datetime);
         // t($time8);die;
    if($notice_period=="8")
    {
        if($pickup_datetime<$time8)
        {

            echo "Pickup time must be at least 8 hours in the future";
        }
        else
        {
            echo 1;
        }
    }
    else if($notice_period=="24")
    {
        if($pickup_datetime<$time24)
        {
            echo "Pickup time must be at least 24 hours in the future";
        }
        else
        {
            echo 1;
        }
    }
    else if($notice_period=="48")
    {
        if($pickup_datetime<$time48)
        {
            echo "Pickup time must be at least 48 hours in the future";
        }
        else
        {
            echo 1;
        }
    }
    else
    {
        echo 1;
    }
}

public function fetch_notice_period()
{
        // echo 1;
    $id_vehicletype = $this->input->post('id_vehicletype');
    $cond = "AND id =$id_vehicletype AND status=1";
    $case_data = $this->common_model->fetch('vehicle_type_tbl', $cond);
    $notice_period = $case_data[0]['notice_period'];
    $time_check = date('m/d/Y G:i',strtotime('+'.$notice_period.' hour'));

    $pickup_datetime = $this->session->userdata('pickup_date1').' '.$this->session->userdata('pickup_hour').':'.$this->session->userdata('pickup_minute');
        // t($pickup_datetime);
         // t($time8);die;
    if(strtotime($pickup_datetime)<strtotime($time_check)){
        echo "Pickup time must be at least ".$notice_period." hours in the future";
    }else{
        echo 1;
    }

}
public function step4(){
    if($this->session->userdata('last_id'))
    {
        $userDetails=$this->session->userdata('login_data');
        $id= $this->session->userdata('last_id');
        $airport_id = $this->session->userdata('airport_id');
        $id_vehicletype = $this->session->userdata('id_vehicletype');
        $zone_id = $this->session->userdata('zone_id');

        $cond1="AND id_airport='$airport_id' AND id_vehicletype='$id_vehicletype' AND flight_pickup=0 AND id_zone='$zone_id' AND status=1";
        $price_details = $this->common_model->fetch('price_tbl',$cond1);

        $cond2 = "AND id='$id_vehicletype' AND status=1";
        $vehicle_data = $this->common_model->fetch('vehicle_type_tbl', $cond2);
            //t($vehicle_data);
        $vehicle_customer_price = round(($vehicle_data[0]['customer_pricepermile'] * $this->session->userdata('distance')),2);
        $vehicle_driver_price = round(($vehicle_data[0]['driver_pricepermile'] * $this->session->userdata('distance')),2);
             // t($this->session->userdata('distance'));
             // t($vehicle_customer_price);
             // t($vehicle_driver_price,1);
              // echo $this->db->last_query();
              // t($price_details,1);
        $customer_price = $price_details[0]['customer_price'] + $vehicle_customer_price;
        $driver_price = $price_details[0]['driver_price'] + $vehicle_driver_price;

        /* Apply Promo Code */

        if ( !$this->input->post("submit") && !empty($this->session->userdata('promo_code_str')) ) {

          $input_promo_code = $this->session->userdata('promo_code_str');
          $cond_fdr = "AND code = '$input_promo_code'";
          $promo_code_obj = $this->common_model->fetch('promocodes_tbl', $cond_fdr);

          if (!empty($promo_code_obj)) {

            log_message('debug', 'applying promode code');

            $fixed_driver_amount = $promo_code_obj[0]['fixed_driver_amount'];
            $percent_driver_amount = $promo_code_obj[0]['percent_driver_amount'];

            $fixed_customer_amount = $promo_code_obj[0]['fixed_customer_amount'];
            $percent_customer_amount = $promo_code_obj[0]['percent_customer_amount'];


            if ($fixed_driver_amount > 0 ) {
              $driver_price -= $fixed_driver_amount;
            }else{
              $driver_price = $driver_price * ((100 - $percent_driver_amount) /100);
            }

            if ($fixed_customer_amount > 0 ) {
              $customer_price -= $fixed_customer_amount;
            }else{
              $customer_price = $customer_price * ((100 - $percent_customer_amount) /100);
            }

            // Update Promo Code Table
            $id = $promo_code_obj[0]['id'];
            $cond_up = "AND id = $id";
            if ($promo_code_obj[0]['expiry_count'] == 1) {
              $data_promocode['expiry_count'] = -1;
            }else{
              $data_promocode['expiry_count'] = $promo_code_obj[0]['expiry_count'] - 1;
            }

            $this->common_model->edit_cond('promocodes_tbl', $data_promocode, $cond_up);

          }
        }
        /* End Promo Code */
        $this->data['customer_price'] = $customer_price;

        if(!empty($id))
        {
            $cond1 = "AND id=$id AND status=0";
            $details = $this->common_model->fetch('booking_tbl',$cond1);
            $id_vehicletype = $details[0]['id_vehicletype'];
            $cond3 = "AND id=$id_vehicletype";
            $vehicle_details = $this->common_model->fetch('vehicle_type_tbl',$cond3);
                //$tips = $this->input->post("tips");
                //$tip_price = 200;
        }
        else
        {
           $details =array();
           $vehicle_details = array();
        }

       if($this->input->post("submit"))
       {
                // $data_field['status']= 1;
                //$data_field['tips']= $tips;
        log_message('debug', 'submit and redirect to step 5');

        /*Start*/
                  $input_promo_code = $this->session->userdata('promo_code_str');
          $cond_fdr = "AND code = '$input_promo_code'";
          $promo_code_obj = $this->common_model->fetch('promocodes_tbl', $cond_fdr);

          if (!empty($promo_code_obj)) {

            log_message('debug', 'applying promode code');

            $fixed_driver_amount = $promo_code_obj[0]['fixed_driver_amount'];
            $percent_driver_amount = $promo_code_obj[0]['percent_driver_amount'];

            $fixed_customer_amount = $promo_code_obj[0]['fixed_customer_amount'];
            $percent_customer_amount = $promo_code_obj[0]['percent_customer_amount'];


            if ($fixed_driver_amount > 0 ) {
              $driver_price -= $fixed_driver_amount;
            }else{
              $driver_price = $driver_price * ((100 - $percent_driver_amount) /100);
            }

            if ($fixed_customer_amount > 0 ) {
              $customer_price -= $fixed_customer_amount;
            }else{
              $customer_price = $customer_price * ((100 - $percent_customer_amount) /100);
            }

          }

        /*End*/
        $data_field['tip_price']= $customer_price;
        $data_field['driver_price']= $driver_price;
        $data_field['added_date']=time();
        $edit = $this->common_model->edit_cond('booking_tbl', $data_field, $cond1);
                //$this->session->set_userdata('tips',$tips);
        $this->session->set_userdata('customer_price',$customer_price);
        $this->session->set_userdata('driver_price',$driver_price);
        redirect('outbound/step5');
        }
    $this->data['details'] = $details;
    $this->data['vehicle_details'] = $vehicle_details;
    $this->data['userDetails'] = $userDetails;
}
else
{
    redirect('outbound');
}
$this->get_include();
$this->load->view($this->viewDir.'outbound/step4',$this->data);
}
public function step5()
{
    if($this->session->userdata('last_id'))
    {
        if($this->input->post("submit"))
        {
            redirect('outbound/step6');
        }
    }
    else
    {
        redirect('outbound');
    }
    $this->get_include();
    $this->load->view($this->viewDir.'outbound/step5',$this->data);
}
public function step6()
{
    if($this->session->userdata('last_id'))
    {
        $id= $this->session->userdata('last_id');
        $cond1 = "AND id=$id AND status=0";
        $tips = $this->input->post("tips");
            // $tip_price = 200;
        if($this->input->post("submit"))
        {
                // $data_field['status']= 1;
            $data_field['tips']= $tips;
                // $data_field['tip_price']= $tip_price;
            $edit = $this->common_model->edit_cond('booking_tbl', $data_field, $cond1);
            $this->session->set_userdata('tips',$tips);
            redirect('outbound/step7');
        }
    }
    else
    {
        redirect('outbound');
    }
    $this->get_include();
    $this->load->view($this->viewDir.'outbound/step6',$this->data);
}
public function step7()
{
    if($this->session->userdata('last_id'))
    {
        $id= $this->session->userdata('last_id');
        $cond1 = "AND id=$id AND status=0";
        $userDetails=$this->session->userdata('login_data');
        $user_id = $userDetails['id'];

        if(!empty($id))
        {
            $cond1 = "AND id=$id AND status=0";
            $details = $this->common_model->fetch('booking_tbl',$cond1);
            $id_vehicletype = $details[0]['id_vehicletype'];
            $cond3 = "AND id=$id_vehicletype";
            $vehicle_details = $this->common_model->fetch('vehicle_type_tbl',$cond3);
            $datetime = new DateTime($details[0]['pickup_date']);
            $date = $datetime->format('c');
        }
        else
        {
           $details =array();
           $vehicle_details = array();
       }
       if($this->input->post("submit"))
       {
        $card_number = $this->input->post("card_number");
        $expiry_date = $this->input->post("expiry_date");
        $cvv = $this->input->post("cvv");
        $tips = $details[0]['tips'];
        $amt = $details[0]['tip_price'];
        $amt1 = $details[0]['driver_price'];
        if($tips!='')
        {
            $amount = $amt + $tips;
            $amount1 = $amt1 + $tips;
        }
        else
        {
            $amount =$amt;
            $amount1 =$amt1;
        }


        $addtess = $details[0]['address'];
        $lat = $details[0]['lat'];
        $long = $details[0]['long'];

        $addtess1 = $details[0]['destination_address'];
        $lat1 = $details[0]['destination_address_lat'];
        $long1 = $details[0]['destination_address_long'];

        $details1['address']['lat'] = $lat;
        $details1['address']['lng'] = $long;
        $details1['address']['formatted'] = $addtess;

        $details1['destination']['lat'] = $lat1;
        $details1['destination']['lng'] = $long1;
        $details1['destination']['formatted'] = $addtess1;

        if(!empty($details[0]['via1_address']) && empty($details[0]['via2_address']) && empty($details[0]['via3_address']))
        {
            $details1['vias'][0]['lat'] = $details[0]['via1_address_lat'];
            $details1['vias'][0]['lng'] = $details[0]['via1_address_long'];
            $details1['vias'][0]['formatted'] = $details[0]['via1_address'];
            $details1['vias'][0]['name'] = $details[0]['customer_name'];
            $details1['vias'][0]['phone'] = $details[0]['customer_country_code'].''.$details[0]['customer_telephone'];
            $details1['vias'][0]['driver_instructions'] = "";
            $details1['vias'][0]['type'] = "PICKUP";
                        //$details1['vias'][0]['pickup_date'] = $date;
        }
        else if(!empty($details[0]['via1_address']) && !empty($details[0]['via2_address']) && empty($details[0]['via3_address']))
        {
           $details1['vias'][0]['lat'] = $details[0]['via1_address_lat'];
           $details1['vias'][0]['lng'] = $details[0]['via1_address_long'];
           $details1['vias'][0]['formatted'] = $details[0]['via1_address'];
           $details1['vias'][0]['name'] = $details[0]['customer_name'];
           $details1['vias'][0]['phone'] = $details[0]['customer_country_code'].''.$details[0]['customer_telephone'];
           $details1['vias'][0]['driver_instructions'] = "";
           $details1['vias'][0]['type'] = "PICKUP";
                        //$details1['vias'][0]['pickup_date'] = $date;

           $details1['vias'][1]['lat'] = $details[0]['via2_address_lat'];
           $details1['vias'][1]['lng'] = $details[0]['via2_address_long'];
           $details1['vias'][1]['formatted'] = $details[0]['via2_address'];
           $details1['vias'][1]['name'] = $details[0]['customer_name'];
           $details1['vias'][1]['phone'] = $details[0]['customer_country_code'].''.$details[0]['customer_telephone'];
           $details1['vias'][1]['driver_instructions'] = "";
           $details1['vias'][1]['type'] = "PICKUP";
                        //$details1['vias'][1]['pickup_date'] = $date;
       }
       else if(!empty($details[0]['via1_address']) && !empty($details[0]['via2_address']) && !empty($details[0]['via3_address']))
       {
           $details1['vias'][0]['lat'] = $details[0]['via1_address_lat'];
           $details1['vias'][0]['lng'] = $details[0]['via1_address_long'];
           $details1['vias'][0]['formatted'] = $details[0]['via1_address'];
           $details1['vias'][0]['name'] = $details[0]['customer_name'];
           $details1['vias'][0]['phone'] = $details[0]['customer_country_code'].''.$details[0]['customer_telephone'];
           $details1['vias'][0]['driver_instructions'] = "";
           $details1['vias'][0]['type'] = "PICKUP";
                        //$details1['vias'][0]['pickup_date'] = $date;

           $details1['vias'][1]['lat'] = $details[0]['via2_address_lat'];
           $details1['vias'][1]['lng'] = $details[0]['via2_address_long'];
           $details1['vias'][1]['formatted'] = $details[0]['via2_address'];
           $details1['vias'][1]['name'] = $details[0]['customer_name'];
           $details1['vias'][1]['phone'] = $details[0]['customer_country_code'].''.$details[0]['customer_telephone'];
           $details1['vias'][1]['driver_instructions'] = "";
           $details1['vias'][1]['type'] = "PICKUP";
                        //$details1['vias'][1]['pickup_date'] = $date;

           $details1['vias'][2]['lat'] = $details[0]['via3_address_lat'];
           $details1['vias'][2]['lng'] = $details[0]['via3_address_long'];
           $details1['vias'][2]['formatted'] = $details[0]['via3_address'];
           $details1['vias'][2]['name'] = $details[0]['customer_name'];
           $details1['vias'][2]['phone'] = $details[0]['customer_country_code'].''.$details[0]['customer_telephone'];
           $details1['vias'][2]['driver_instructions'] = "";
           $details1['vias'][2]['type'] = "PICKUP";
                        //$details1['vias'][2]['pickup_date'] = $date;
       }

       $details1['payment']['tip'] = $tips;
       $details1['payment']['cost'] = $amount1;
       $details1['payment']['price'] = $amount;
       $details1['payment']['total'] = $amount;
       $details1['payment']['order_id'] = $id;
       $details1['account_id'] = "5441";

       $details1['name'] = $details[0]['customer_name'];
       $details1['phone'] = $details[0]['customer_country_code'].''.$details[0]['customer_telephone'];
       $details1['flight_number'] = $details[0]['flight_number'];
       $details1['date'] = $details[0]['pickup_date'].''.$details[0]['pickup_time'];
       $details1['pickup_date'] = $details[0]['pickup_date'].''.$details[0]['pickup_time'];
       $details1['vehicle_type'] = $vehicle_details[0]['type'];
                    //$details1['vehicle_group'] = $vehicle_details[0]['name'];
       if($details[0]['notes']!='')
       {
        if($details[0]['no_large_cases']==1 && $details[0]['no_cabin_cases']==1){
            $ins = "Arrival Time ".$details[0]['required_arrival_datetime'].", 1 Large Case, 1 Small Case, ".$details[0]['notes'];
        } else if($details[0]['no_large_cases']=="0" && $details[0]['no_cabin_cases']=="0"){
            $ins = "Arrival Time ".$details[0]['required_arrival_datetime'].', '.$details[0]['notes'];
        } else if($details[0]['no_large_cases']=="0" && $details[0]['no_cabin_cases']=="1"){
            $ins = "Arrival Time ".$details[0]['required_arrival_datetime'].", 1 Small Case, ".$details[0]['notes'];
        } else if($details[0]['no_large_cases']=="1" && $details[0]['no_cabin_cases']=="0"){
            $ins = "Arrival Time ".$details[0]['required_arrival_datetime'].", 1 Large Case, ".$details[0]['notes'];
        } else if($details[0]['no_large_cases']=="0" && $details[0]['no_cabin_cases']!="1"){
            $ins = "Arrival Time ".$details[0]['required_arrival_datetime'].", ".$details[0]['no_cabin_cases']." Small Cases, ".$details[0]['notes'];
        } else if($details[0]['no_large_cases']!="1" && $details[0]['no_cabin_cases']=="0"){
            $ins = "Arrival Time ".$details[0]['required_arrival_datetime'].", ".$details[0]['no_large_cases']." Large Cases, ".$details[0]['notes'];
        } else { 
            $ins = "Arrival Time ".$details[0]['required_arrival_datetime'].', '.$details[0]['no_large_cases']." Large Cases, ".$details[0]['no_cabin_cases']." Small Cases, ".$details[0]['notes'];
        }
    }
    else
    {
        if($details[0]['no_large_cases']==1 && $details[0]['no_cabin_cases']==1){
            $ins = "Arrival Time ".$details[0]['required_arrival_datetime'].", 1 Large Case, 1 Small Case";
        } else if($details[0]['no_large_cases']=="0" && $details[0]['no_cabin_cases']=="0"){
            $ins = "Arrival Time ".$details[0]['required_arrival_datetime'];
        } else if($details[0]['no_large_cases']=="0" && $details[0]['no_cabin_cases']=="1"){
            $ins = "Arrival Time ".$details[0]['required_arrival_datetime'].", 1 Small Case";
        } else if($details[0]['no_large_cases']=="1" && $details[0]['no_cabin_cases']=="0"){
            $ins = "Arrival Time ".$details[0]['required_arrival_datetime'].", 1 Large Case";
        } else if($details[0]['no_large_cases']=="0" && $details[0]['no_cabin_cases']!="1"){
            $ins = "Arrival Time ".$details[0]['required_arrival_datetime'].", ".$details[0]['no_cabin_cases']." Small Cases";
        } else if($details[0]['no_large_cases']!="1" && $details[0]['no_cabin_cases']=="0"){
            $ins = "Arrival Time ".$details[0]['required_arrival_datetime'].", ".$details[0]['no_large_cases']." Large Cases";
        } else { 
            $ins = "Arrival Time ".$details[0]['required_arrival_datetime'].', '.$details[0]['no_large_cases']." Large Cases, ".$details[0]['no_cabin_cases']." Small Cases";
        }
    }
    $details1['instructions'] = $ins;
    $details1['notes'] = $ins;
    $details1['ppl'] = $details[0]['no_passengers'];
    $details1['payment_type'] = "CARD";

    $fields = json_encode($details1);
                    // t($fields);

    $url = "https://api.icabbidispatch.com/icd5/bookings/add";
    $key="Basic ODhhNTY5ZDc2MzUyNzNiOTRjMmNkMjU5NmQ5Mjk5MWIwZjQzYzI3Yjo2MWVlZjQ0ODNlNTVhYTQ1YzZiZGY0OTJiNTE2NzQzYzEwN2EzZDhj";
    $phone ="00447123456789";
    $headers = array(
        'Authorization:' . $key,
        'Content-Type:application/json',
        'phone:'.$phone
    );
                    //t($url,1);

    $main_url = $url;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result1 = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($result1, true);
                      // t($data,1);
    if($data['body']['booking']['trip_id']!='')
    {
                  //      $paymentReference = $response['yourPaymentReference'];
                  //      $booking_id = $response['receiptId'];
                  //      $refund = $judopay->getModel('Refund');
                  //           $refund->setAttributeValues(
                  //           array(
                  //               'receiptId' => $booking_id,
                  //               'yourPaymentReference' =>$paymentReference,
                  //               'amount' => $amount,
                  //           )
                  //       );
                  //            // t($refund);
                  //           $response1 = $refund->create();
                  //           // t($response,1);
                		// if ($response1['result'] === 'Success') {

    	             //       $this->session->set_flashdata('err_message','There were some problems while processing your booking. We have initiated the refund process for your booking.');
    	             //       redirect('outbound/step7');
    	             //    }


       $judopay = new \Judopay(
        array(
            'apiToken' => 'OgGvlwZRHHMau0Zu',
            'apiSecret' => '471819f583bbe1a7a628118a718e01bbadf9800cf876104c9a053cf50bc83d30',
            'judoId' => '100085-067',
                        //Set to true on production, defaults to false which is the sandbox
            'useProduction' => false
        )
    );
       $payment = $judopay->getModel('Payment');
       $ConsumerReference = rand(10,99);
       $PaymentReference1 = rand(10,99);
       $payment->setAttributeValues(
        array(
            'judoId' => '100085-067',
            'yourConsumerReference' => $user_id.'-'.$ConsumerReference,
            'yourPaymentReference' => $id.'-'.$PaymentReference1,
            'amount' => $amount,
            'currency' => 'GBP',
            'cardNumber' => $card_number,
            'expiryDate' => $expiry_date,
            'cv2' => $cvv
        )
    );
       try {
        $response = $payment->create();
        if ($response['result'] === 'Success') {
            echo 'Payment succesful';


                        //    Mail //
            $mailin = new Mailin("https://api.sendinblue.com/v2.0", "6ytcSmUvpTAMs28W");

            $via_html='';
            if($details[0]['via1_address']!='' || $details[0]['via2_address']!='' || $details[0]['via3_address']!=''){
                $via_html=$via_html."<div class='via_holder'>

                <div class='m_4329680904517645156blue_bar_holder' style='overflow:hidden;padding-bottom:20px'>
                ";

                if($details[0]['via1_address']!=''){
                    $via_html=$via_html."<div class='via_holder1' style='padding:2px;margin:20px 0 0 20px;float:left; '>
                    <div style='margin:10px 0'>
                    <div class='via1'>
                    <p style='color: #888;'>Via 1</p>
                    <p>".$details[0]['via1_address']."</p>
                    </div>
                    </div>
                    </div>"; 

                }
                if($details[0]['via2_address']!=''){
                    $via_html=$via_html."<div class='via_holder2' style='padding:2px;margin:20px 0 0 20px;float:left;'>
                    <div style='margin:10px 0'>
                    <div class='via2'>
                    <p style='color: #888;'>Via 2</p>
                    <p>".$details[0]['via2_address']."</p>
                    </div>
                    
                    </div>
                    </div>";
                }     
                if($details[0]['via3_address']!=''){
                    $via_html=$via_html."<div class='via_holder3' style='padding:2px;margin:20px 0 0 20px;float:left'>
                    <div style='margin:10px 0'>
                    <div class='via3'>
                    <p style='color: #888;'>Via 3</p>
                    <p>".$details[0]['via3_address']."</p>
                    </div>
                    </div>
                    </div>";

                }
                $via_html=$via_html."</div></div>";
            }

            $driver_notes='';
            if($details[0]['notes']!=''){
                $driver_notes=$driver_notes."<div class='driver_notes' style='padding-left:20px;'>
                <p style='color: #888;'>Driver Notes</p>
                <p>".$details[0]['notes']."</p>
                </div>";
            }

            $driver_tip='';
            if($details[0]['tips']!=''){
                $driver_tip=$driver_tip."<div class='contact_holder2' style='padding:2px;margin:20px 0 0 20px;float:left;'>
                <div style='margin:10px 0'>
                <div class='contact2'>
                <p style='color: #888;'> +</p>
                </div>

                </div>
                </div>

                <div class='contact_holder1' style='padding:2px;margin:20px 0 0 20px;float:left; '>
                <div style='margin:10px 0'>
                <div class='contact1'>
                <p style='color: #888;'>Outbound Tip </p>
                <p>£".$details[0]['tips']."</p>


                </div>
                </div>
                </div>";
            }
            $data10 = array(
                "to" => array($details[0]['customer_email']=>"Outbound Booking Confirmation"),
                "from" => array("noreply@SkyBound.taxi", "SkyBound"),
                "bcc" => array("royshaheli@gmail.com"=>"SkyBound"),
                        // "bcc" =>array("bcc@example.net"=>"Anita's Housekeeping"),
                        // "replyto" => array("noreply@SkyBound.taxi","SkyBound"),
                "subject" => "Outbound Booking Confirmation",
                "html" => "  <html>
                <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <meta http-equiv='X-UA-Compatible' content='ie=edge'>
                <title>Document</title>

                <style>
                .date_holder {
                    width: 35%;
                }

                .details_holder {
                    width: 50%;
                }


                @media(max-width:570px) {
                    .date_holder {
                        width: 100%;
                    }
                    
                    .details_holder {
                        width: 80%;
                    }
                }
                </style>


                </head>

                <body>

                <div class='head-section' style='padding: 15px  0;'>

                <h1 style='text-align:center;'><img
                src='http://www.bitpastel.org/skybound-main/assets/frontend/images/logo.png'></h1>
                <p style='margin-bottom: 20px; font-size:14px; text-align:justify;'>
                <h1 style='font-size:16px;margin-bottom:0;font-weight:400;'>Hello"." ".$details[0]['customer_name'].", </h1>
                </p>
                <p style='font-size:16px;margin-top:0;' ;>Please find below your booking details:</p>


                <div class='m_4329680904517645156blue_bar_holder' style='overflow:hidden;'>

                </div>


                </div>

                <div class='wrapper' style='text-align: center;'>
                <div class='main_container1' style='margin: 0 auto; max-width:800px; text-align: left;'>
                <div class='blue_bar' style='background-color: #def5ff;'>
                <div class='m_4329680904517645156blue_bar_holder' style='overflow:hidden;padding-bottom:20px'>
                <div class='date_holder' style='padding:2px;margin:20px 0 0 20px;float:left; '>
                <div style='margin:10px 0'>
                <h1 style='margin:0px;'> ".date("d F Y",strtotime($details[0]['pickup_date']))." </h1>
                <p>".$details[0]['destination_address']."</p>
                </div>
                </div>
                <div class=' details_holder' style='padding:2px;margin:20px 0 0 20px;float:left;'>
                <div style='margin:10px 0'>
                <div class='curve'
                style='width: 200px; padding: 10px 20px; background-color:#888; color: #fff; border-radius:20px; text-align: center; font-weight:bold;'>
                Outbound Booking Details</div>
                </div>
                </div>
                <div class='doller_holder' style='padding:2px;margin:20px 0 0 20px;float:left'>
                <div style='margin:10px 0'>
                <div class='pound' style='padding-top: 10px; font-size: 20px; font-weight:bold;'>
                <span style='margin: 0;'>£".$amount."</span>
                </div>
                </div>
                </div>
                </div>

                </div>

                <div class='flight_details' style='padding: 15px  0; border-bottom: 1px dashed #d5d5d5; padding-left:20px;'>
                <h5 style='margin: 0; color: #1097d6; font-size:18px; '>Flight Details</h5>
                <p>".$details[0]['airline_name']."</p>
                <p>".$details[0]['originName']."</p>
                <p>".$details[0]['terminal_orig']."</p>
                <p style='text-align:right; margin-bottom: 0;'>".$details[0]['destinationName']."</p>
                <p style='text-align:right; margin-bottom: 0;'>".$details[0]['terminal_dest']."</p>
                </div>


                <div class='trip_details' style='padding: 15px  0; border-bottom: 1px dashed #d5d5d5'>

                <div class='other_details' style='margin-top: 30px;'>
                <h5 style='margin: 0; color: #1097d6; font-size:18px; padding-left:20px;'>Trip Details </h5>

                <div class='m_4329680904517645156blue_bar_holder' style='overflow:hidden;'>
                <div class='pickup_location_holder' style='padding:2px;margin:20px 0 0 20px;float:left;'>
                <div style='margin:10px 0'>
                <div class='pickup_location'>
                <p style='color: #888;'>Pickup Loaction</p>
                <p>".$details[0]['address']."</p>
                </div>
                </div>
                </div>

                <div class='destination_location_holder' style='padding:2px;margin:20px 0 0 20px;float:left;'>
                <div style='margin:10px 0'>

                <div class='destination_location'>
                <p style='color: #888;'>Destination Loaction</p>
                <p>".$details[0]['destination_address']."</p>
                </div>


                </div>
                </div>
                <div class='pickup_time_holder' style='padding:2px;margin:20px 0 0 20px;float:left'>
                <div style='margin:10px 0'>
                <div class='pickup_time'>
                <p style='color: #888;'>Pickup Time</p>
                <p>".$details[0]['pickup_time']."</p>
                </div>
                </div>
                </div>

                <div class='pickup_time_holder' style='padding:2px;margin:20px 0 0 20px;float:left'>
                <div style='margin:10px 0'>
                <div class='pickup_time'>
                <p style='color: #888;'>Arrival Time</p>
                <p>".$details[0]['required_arrival_datetime']."</p>
                </div>
                </div>
                </div>



                </div>


                </div>


                ".$via_html."



                <div class='other_details'>
                <h6 style='margin: 0; color: #1097d6; font-size:15px; padding-left: 20px;'>Other Details</h6>

                <div class='m_4329680904517645156blue_bar_holder' style='overflow:hidden;'>
                <div class='other_detail1' style='padding:2px;margin:20px 0 0 20px;float:left; '>
                <div style='margin:10px 0'>
                <div class='other_detail'>
                <p style='color: #888;'>Number of Passanger</p>
                <p>".$details[0]['no_passengers']."</p>
                </div>
                </div>
                </div>
                <div class='other_detail2' style='padding:2px;margin:20px 0 0 20px;float:left;'>
                <div style='margin:10px 0'>
                <div class='other_detail'>
                <p style='color: #888;'>Vehicle Type</p>
                <p>".$vehicle_details[0]['name']."</p>
                </div>

                </div>
                </div>
                <div class='other_detail3' style='padding:2px;margin:20px 0 0 20px;float:left'>
                <div style='margin:10px 0'>
                <div class='other_detail'>
                <p style='color: #888;'>Number of Large Cases</p>
                <p>".$details[0]['no_large_cases']."</p>
                </div>
                </div>
                </div>


                <div class='other_detail4' style='padding:2px;margin:20px 0 0 20px;float:left'>
                <div style='margin:10px 0'>
                <div class='other_detail'>
                <p style='color: #888;'>Number of Cabin cases</p>
                <p>".$details[0]['no_cabin_cases']."</p>
                </div>
                </div>
                </div>
                </div>

                </div>

                ".$driver_notes."
                </div>

                <div class='contact_information' style='padding: 15px  0; border-bottom: 1px dashed #d5d5d5; '>
                <h5 style='margin: 0; color: #1097d6; font-size:18px; padding-left: 20px;'>Contact Information</h5>
                <div class='via_holder'>

                <div class='m_4329680904517645156blue_bar_holder' style='overflow:hidden;padding-bottom:20px'>
                <div class='contact_holder1' style='padding:2px;margin:20px 0 0 20px;float:left; '>
                <div style='margin:10px 0'>
                <div class='contact1'>
                <p style='color: #888;'>".$details[0]['customer_name']."</p>

                </div>
                </div>
                </div>
                <div class='contact_holder2' style='padding:2px;margin:20px 0 0 20px;float:left;'>
                <div style='margin:10px 0'>
                <div class='contact2'>
                <p style='color: #888;'>".$details[0]['customer_email']."</p>
                </div>

                </div>
                </div>
                <div class='contact_holder3' style='padding:2px;margin:20px 0 0 20px;float:left'>
                <div style='margin:10px 0'>
                <div class='contact3'>
                <p style='color: #888;'>".$details[0]['customer_country_code'].' '.$details[0]['customer_telephone']."  </p>
                </div>
                </div>
                </div>

                </div>

                </div>
                </div>

                <div class='flight_details' style='padding: 15px  0;'>
                <h5 style='margin: 0; color: #1097d6; font-size:18px; padding-left:20px;'>Payment Details</h5>
                <div class='m_4329680904517645156blue_bar_holder' style='overflow:hidden;'>
                <div class='contact_holder3' style='padding:2px;margin:20px 0 0 20px;float:left'>
                <div style='margin:10px 0'>
                <div class='contact3'>
                <p style='color: #888;'>Outbound Price </p>
                <p>£".$details[0]['tip_price']."</p>


                </div>
                </div>
                </div>
                ".$driver_tip."


                </div>


                </div>


                <div class='booking_details' style='padding: 15px  20px; border-bottom: 1px dashed #d5d5d5; text-align:left;'>
                <p><span style='color: #888'>Booking Date: </span>".date("d F Y",$details[0]['added_date'])."</p>
                <p><span style='color: #888'>Booking time: </span>".date("H:i",$details[0]['added_date'])."</p>
                <p><span style='color: #888'>Booking Id: </span>".$data['body']['booking']['trip_id']."</p>
                <p><span style='color: #888'>Transaction Id: </span>".$response['receiptId']."</p>
                <p style='color: #888'> Total Amoutnt</p>
                <h5 style='margin: 0; color: #1097d6; font-size:18px; '>£".$amount."</h5>

                </div>
                </div>



                </div>



                </body>

                </html>"
            );

$mailin->send_email($data10);

$this->session->set_userdata('payment_details',$response);
$this->session->set_userdata('booking_details',$data);
redirect('outbound/thank-you');
} else {
  $url = "https://api.icabbidispatch.com/icd5/bookings/cancel/".$data['body']['booking']['trip_id'];
  $key="Basic ODhhNTY5ZDc2MzUyNzNiOTRjMmNkMjU5NmQ5Mjk5MWIwZjQzYzI3Yjo2MWVlZjQ0ODNlNTVhYTQ1YzZiZGY0OTJiNTE2NzQzYzEwN2EzZDhj";
  $phone ="00447123456789";
  $headers = array(
    'Authorization:' . $key,
    'Content-Type:application/json',
    'phone:'.$phone
);
                            //t($url,1);

  $main_url = $url;
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $result1 = curl_exec($ch);
  curl_close($ch);
  $data1 = json_decode($result1, true);
  $this->session->set_flashdata('err_message','There were some problems while processing your payment');
                        //$this->session->set_flashdata('sess_message', 'Adnin added successfully!');
                    //$this->session->set_flashdata('sess_message', 'Invalid card number');
  redirect('outbound/step7');  
}
} catch (\Judopay\Exception\ValidationError $e) {
  $url = "https://api.icabbidispatch.com/icd5/bookings/cancel/".$data['body']['booking']['trip_id'];
  $key="Basic ODhhNTY5ZDc2MzUyNzNiOTRjMmNkMjU5NmQ5Mjk5MWIwZjQzYzI3Yjo2MWVlZjQ0ODNlNTVhYTQ1YzZiZGY0OTJiNTE2NzQzYzEwN2EzZDhj";
  $phone ="00447123456789";
  $headers = array(
    'Authorization:' . $key,
    'Content-Type:application/json',
    'phone:'.$phone
);
                            //t($url,1);

  $main_url = $url;
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $result1 = curl_exec($ch);
  curl_close($ch);
  $data1 = json_decode($result1, true);
  $this->session->set_flashdata('err_message', 'Something went wrong. Please try again.');
  redirect('outbound/step7');
                            //echo $e->getSummary();
} catch (\Judopay\Exception\ApiException $e) {
   $url = "https://api.icabbidispatch.com/icd5/bookings/cancel/".$data['body']['booking']['trip_id'];
   $key="Basic ODhhNTY5ZDc2MzUyNzNiOTRjMmNkMjU5NmQ5Mjk5MWIwZjQzYzI3Yjo2MWVlZjQ0ODNlNTVhYTQ1YzZiZGY0OTJiNTE2NzQzYzEwN2EzZDhj";
   $phone ="00447123456789";
   $headers = array(
    'Authorization:' . $key,
    'Content-Type:application/json',
    'phone:'.$phone
);
                            //t($url,1);

   $main_url = $url;
   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

   $result1 = curl_exec($ch);
   curl_close($ch);
   $data1 = json_decode($result1, true);
   $this->session->set_flashdata('err_message', 'Invalid card number. Please try with valid card number');
   redirect('outbound/step7');
                            //t($e->getSummary(),1);
                             //echo $e->getSummary();
} catch (\Exception $e) {
  $url = "https://api.icabbidispatch.com/icd5/bookings/cancel/".$data['body']['booking']['trip_id'];
  $key="Basic ODhhNTY5ZDc2MzUyNzNiOTRjMmNkMjU5NmQ5Mjk5MWIwZjQzYzI3Yjo2MWVlZjQ0ODNlNTVhYTQ1YzZiZGY0OTJiNTE2NzQzYzEwN2EzZDhj";
  $phone ="00447123456789";
  $headers = array(
    'Authorization:' . $key,
    'Content-Type:application/json',
    'phone:'.$phone
);
                            //t($url,1);

  $main_url = $url;
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $result1 = curl_exec($ch);
  curl_close($ch);
  $data1 = json_decode($result1, true);
  $this->session->set_flashdata('err_message', 'Something went wrong. Please try again.');
                             //echo $e->getMessage();
  redirect('outbound/step7');
}

}      
}
}
else
{
    redirect('outbound');
}
$this->get_include();
$this->load->view($this->viewDir.'outbound/step7',$this->data);
}
public function save_customer_details()
{
    $cName =$this->input->post('cName');
    $cEmail =$this->input->post('cEmail');
    $cPhone =$this->input->post('cPhone');
    $cCode =$this->input->post('cCode');
    if(substr( $cPhone, 0, 1 ) === "0")
    {
        $cPhone =ltrim($cPhone, 0);
    }
    $id= $this->session->userdata('last_id');
    $cond1 = "AND id=$id";
    $data_field['customer_name']=$cName;
    $data_field['customer_email']=$cEmail;
    $data_field['customer_telephone']=$cPhone;
    $data_field['customer_country_code']=$cCode;
    $edit = $this->common_model->edit_cond('booking_tbl', $data_field, $cond1);
    if($edit)
    {
        echo 1;
    }
}
public function thank_you()
{
    if($this->session->userdata('last_id'))
    {
        $booking_details=$this->session->userdata('booking_details');
        $payment_details=$this->session->userdata('payment_details');
        $id= $this->session->userdata('last_id');
        $cond1 = "AND id=$id";
        $data_field['status']= 1;
        $data_field['trip_id']=$booking_details['body']['booking']['trip_id'];
        $data_field['booking_id']=$payment_details['receiptId'];
        $data_field['payment_reference']=$payment_details['yourPaymentReference'];
        $edit = $this->common_model->edit_cond('booking_tbl', $data_field, $cond1);
        if($edit)
        {
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
            $this->session->unset_userdata('pickup_hour');
            $this->session->unset_userdata('pickup_minute');
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
            $this->session->unset_userdata('notes');
            $this->session->unset_userdata('last_id');
            $this->session->unset_userdata('tips');
            $this->session->unset_userdata('customer_price');
            $this->session->unset_userdata('driver_price');
            $this->session->unset_userdata('distance');
            $this->session->unset_userdata('zone_id');
        }
    }
    else
    {
        redirect('outbound');
    }
        //t($booking_details,1);
    $this->data['data'] = $booking_details;
    $this->data['payment_details'] = $payment_details;
    $this->get_include();
    $this->load->view($this->viewDir.'outbound/thank-you',$this->data);
}
public function via1_address_destroy(){
    $this->session->unset_userdata('viaAddress1');
    $this->session->unset_userdata('viaLattitude1');
    $this->session->unset_userdata('viaLognitude1');
    echo 1;
}   
public function via2_address_destroy(){
    $this->session->unset_userdata('viaAddress2');
    $this->session->unset_userdata('viaLattitude2');
    $this->session->unset_userdata('viaLognitude2');
    echo 1;
}   
public function via3_address_destroy(){
    $this->session->unset_userdata('viaAddress3');
    $this->session->unset_userdata('viaLattitude3');
    $this->session->unset_userdata('viaLognitude3');
    echo 1;
}   
}