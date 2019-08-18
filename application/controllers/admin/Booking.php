<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require $_SERVER['DOCUMENT_ROOT'].'/skybound-main/Judo/vendor/autoload.php';
class Booking extends MY_Controller {
	function __construct()
	{
		parent::__construct();
        $this->load->model('common_model');
         require_once(APPPATH.'libraries/Mailin.php');
	}
	public function index(){
        $usertype=$this->session->userdata('admin_data');
        $cond = "AND trip_id!='' AND status < 5 GROUP BY payment_reference order by id desc";
        $list = $this->common_model->fetch('booking_tbl', $cond);
        foreach ($list as $key1 => $value1) {
                    $vehicle_id = $value1['id_vehicletype'];
                    $customer_id = $value1['id_customer'];
                    $cond12="AND id ='$vehicle_id' AND status=1";
                    $vehicle_details=$this->common_model->fetch('vehicle_type_tbl',$cond12);
                    $list[$key1]['vehicle_name'] = $vehicle_details[0]['name'];
                    $cond10 = "AND id=$customer_id";
                    $user_details=$this->common_model->fetch('customer_tbl',$cond10);
                    $list[$key1]['customer_name'] = $user_details[0]['firstname'].' '.$user_details[0]['lastname'];
        }  
        $this->data['list'] = $list;
        $this->data['time'] = date("G:i");
        $this->data['date'] = date('m/d/Y');

        $date1 = strtotime($this->data['date']);
        $date1 = strtotime("+7 day", $date1);
        $this->data['date2'] =date('m/d/Y', $date1);
        $this->get_include();
        $this->load->view($this->viewDir."booking/index",$this->data);
    }
    public function details($id){
        $id = ltrim($id,"booking-");
        $this->data['time'] = date("G:i");
        $this->data['date'] = date('m/d/Y');
        $this->data['date1'] = date('m/d/Y',strtotime('+1 day'));
        $this->data['time1'] = date('m/d/Y G:i', strtotime('+0 hours'));
        $this->data['time2'] = date('m/d/Y G:i', strtotime('+24 hours'));
          // t($this->data['time2'],1);

        $date1 = strtotime($this->data['date']);
        $date1 = strtotime("+7 day", $date1);
        $this->data['date2'] =date('m/d/Y', $date1);
    
                $cond="AND md5(id)='$id'";
                $bookingDetails=$this->common_model->fetch('booking_tbl',$cond);
                foreach ($bookingDetails as $key => $value) {
                    # code...
                    $airport_id = $value['pickup_address'];
                    $vehicle_id = $value['id_vehicletype'];
                    $cond1="AND id ='$airport_id' AND status=1";
                    $airport_details=$this->common_model->fetch('airport_tbl',$cond1);
                    $bookingDetails[$key]['airport_name'] = $airport_details[0]['name'];
                    $cond3 = "AND id=$vehicle_id";
                    $vehicle_details = $this->common_model->fetch('vehicle_type_tbl',$cond3);
                    $bookingDetails[$key]['vehicle_name'] = $vehicle_details[0]['name'];
                    $bookingDetails[$key]['total'] = $value['tips'] + $value['tip_price'];
                }
                $booking_id = $bookingDetails[0]['booking_id'];
                $cond2="AND booking_id ='$booking_id'";
                $return_bookingDetails=$this->common_model->fetch('booking_tbl',$cond2);
                foreach ($return_bookingDetails as $key1 => $value1) {
                    # code...
                    $airport_id = $value1['pickup_address'];
                    $vehicle_id = $value1['id_vehicletype'];
                    $cond11="AND id ='$airport_id' AND status=1";
                    $airport_details1=$this->common_model->fetch('airport_tbl',$cond11);
                    $return_bookingDetails[$key1]['airport_name'] = $airport_details1[0]['name'];
                    $cond13 = "AND id=$vehicle_id";
                    $vehicle_details1 = $this->common_model->fetch('vehicle_type_tbl',$cond13);
                    $return_bookingDetails[$key1]['vehicle_name'] = $vehicle_details1[0]['name'];
                    $return_bookingDetails[$key1]['total'] = $value1['tips'] + $value1['tip_price'];
                }
                //t($return_bookingDetails);
                 // t($bookingDetails,1);
                $this->data['bookingDetails']=$bookingDetails;
                $this->data['return_bookingDetails']=$return_bookingDetails;

        $this->get_include();
        $this->load->view($this->viewDir.'booking/view',$this->data);
    }

 public function cancel_trips($trip_id,$trip_id1){
        $time1 = date('m/d/Y G:i', strtotime('+0 hours'));
        $time2 = date('m/d/Y G:i', strtotime('+24 hours'));
        $cond ="AND trip_id='$trip_id'";
        $details = $this->common_model->fetch('booking_tbl', $cond);
        $cond1 ="AND trip_id='$trip_id1'";
        $details1 = $this->common_model->fetch('booking_tbl', $cond1);
        $id = md5($details[0]['id']);
        //t($details[0]['id'],1);

        $paymentReference = $details[0]['payment_reference'];
        $id = md5($details[0]['id']);
        $booking_id = $details[0]['booking_id'];
        // if($details[0]['tips']=='')
        // {
        //     $amount = $details[0]['tip_price'];
        // }
        // else
        // {
            $amount = $details[0]['tip_price']+$details[0]['tips']+$details1[0]['tip_price']+$details1[0]['tips'];
        // }
            // t($amount,1);
        //if($details[0]['pickup_date'].' '.$details[0]['pickup_time']>=$time1 && $details[0]['pickup_date'].' '.$details[0]['pickup_time']<= $time2){
        if($details[0]['pickup_date'].' '.$details[0]['pickup_time']>$time1 && $details[0]['pickup_date'].' '.$details[0]['pickup_time']> $time2){
         //echo 1;die;
                $judopay = new \Judopay(
                        array(
                            'apiToken' => 'OgGvlwZRHHMau0Zu',
                            'apiSecret' => '471819f583bbe1a7a628118a718e01bbadf9800cf876104c9a053cf50bc83d30',
                            'judoId' => '100085-067',
                            //Set to true on production, defaults to false which is the sandbox
                            'useProduction' => false
                            )
                            // array(
                            // 'apiToken' => 'clo5HIkQo6FDMMaN',
                            // 'apiSecret' => '90814fa0e563aceb94243a027fed807e1546a288c7db7e21e7bd9273ec34a69b',
                            // 'judoId' => '100757-426',
                            // //Set to true on production, defaults to false which is the sandbox
                            // 'useProduction' => false
                            // )
                        );
                        $refund = $judopay->getModel('Refund');
                        $refund->setAttributeValues(
                        array(
                            'receiptId' => $booking_id,
                            'yourPaymentReference' =>$booking_id,
                            'amount' => $amount,
                        )
                    );
                         // t($refund);
                        $response = $refund->create();
                         // t($response,1);
            if ($response['result'] === 'Success') {
                echo 'Refund successfully';
                $url = "https://api.icabbidispatch.com/icd5/bookings/cancel/".$trip_id;
                $url1 = "https://api.icabbidispatch.com/icd5/bookings/cancel/".$trip_id1;
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

                        $result = curl_exec($ch);
                        curl_close($ch);
                        $data = json_decode($result, true);

                        $ch1 = curl_init();

                        curl_setopt($ch1, CURLOPT_URL, $url1);
                        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch1, CURLOPT_POST, true);
                        curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);

                        $result1 = curl_exec($ch1);
                        curl_close($ch1);
                        $data1 = json_decode($result1, true);
                        // t($data,1);
                //$cond = "AND trip_id='$trip_id'";
                $data_field['refund_status'] = 1;
                $data_field['status'] = 2;
                $edit = $this->common_model->edit_cond('booking_tbl', $data_field, $cond);
                //echo $this->db->last_query();
                $edit1 = $this->common_model->edit_cond('booking_tbl', $data_field, $cond1);
                //echo $this->db->last_query();die;
                if($edit || $edit1)
                {
                    $mailin = new Mailin("https://api.sendinblue.com/v2.0", "6ytcSmUvpTAMs28W");
                    $data10 = array(
                        "to" => array($details[0]['customer_email']=>"SkyBound Booking Cancelled and Refund Successfully"),
                        "from" => array("noreply@SkyBound.taxi", "SkyBound"),
                        "bcc" => array("royshaheli@gmail.com"=>"SkyBound"),
                        // "bcc" =>array("bcc@example.net"=>"Anita's Housekeeping"),
                        // "replyto" => array("noreply@SkyBound.taxi","SkyBound"),
                        "subject" => "SkyBound Booking Cancelled and Refund Successfully",
                        "html" => "  <table width='700' align='center' cellpadding='0' cellspacing='0'>
                        <tr>
                            <td width='700'>
                                <div style='width:700px' align='center'>
                                    <div style='width:600px;' align='left'>
                                        <img src='http://www.bitpastel.org/skybound-main/assets/frontend/images/logo.png' alt='logo'>
                                    </div>
                                </div>
                                <table width='700' height='400' border='0' align='center' cellpadding='0' cellspacing='0' id='Table_01'>
                
                                    <tr>
                
                                        <td width='700' align='center' valign='top'>
                                            <table width='600' border='0' cellspacing='0' cellpadding='0'>
                                                <tr>
                                                    <td>
                                                        <font size='2' face='Arial, Helvetica, Geneva, SunSans-Regular, sans-serif'>
                                                            &nbsp;
                
                
                                                            <p style='margin-bottom: 20px; font-size:14px; text-align:justify;'>
                                                                <p style='font-size:14px;>Hello"." ".$details[0]['customer_name'].", </p>
                                                                <p>Your booking ids are: ".$trip_id." and ".$trip_id1." have been cancelled and refund process created successfully.</p>
                                                            </p>
                                                        </font>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>"
                    );
               $mailin->send_email($data10);

                    $this->session->set_flashdata('sess_message', 'Your booking has been cancelled successfully. <b>Note: Your refund of £'.$amount. ' has been successfully processed</b>');
                        //redirect("my-booking/details/booking-".$id);
                    // $this->session->set_userdata('message','Note: We have initiated a refund for the booking amount')
                    redirect("admin/booking");
                }
                } else {
                    $this->session->set_flashdata('err_message', 'There were some problems while processing your refund');
                    redirect("admin/booking");
                }
    }
    else
    {
        //echo 2;die;
        $url = "https://api.icabbidispatch.com/icd5/bookings/cancel/".$trip_id;
        $url1 = "https://api.icabbidispatch.com/icd5/bookings/cancel/".$trip_id1;

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

                $result = curl_exec($ch);
                curl_close($ch);
                $data = json_decode($result, true);

                $ch1 = curl_init();

                curl_setopt($ch1, CURLOPT_URL, $url1);
                curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch1, CURLOPT_POST, true);
                curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);

                $result1 = curl_exec($ch1);
                curl_close($ch1);
                $data1 = json_decode($result1, true);
                //t($data,1);
        $data_field['refund_status'] = 2; 
        $data_field['status'] = 2;
        $edit = $this->common_model->edit_cond('booking_tbl', $data_field, $cond);

        $edit1 = $this->common_model->edit_cond('booking_tbl', $data_field, $cond1);
        if($edit || $edit1)
        {
            $mailin = new Mailin("https://api.sendinblue.com/v2.0", "6ytcSmUvpTAMs28W");
                    $data10 = array(
                        "to" => array($details[0]['customer_email']=>"SkyBound Booking Cancelled Successfully"),
                        "from" => array("noreply@SkyBound.taxi", "SkyBound"),
                        "bcc" => array("royshaheli@gmail.com"=>"SkyBound"),
                        // "bcc" =>array("bcc@example.net"=>"Anita's Housekeeping"),
                        // "replyto" => array("noreply@SkyBound.taxi","SkyBound"),
                        "subject" => "SkyBound Booking Cancelled Successfully",
                        "html" => "  <table width='700' align='center' cellpadding='0' cellspacing='0'>
                        <tr>
                            <td width='700'>
                                <div style='width:700px' align='center'>
                                    <div style='width:600px;' align='left'>
                                        <img src='http://www.bitpastel.org/skybound-main/assets/frontend/images/logo.png' alt='logo'>
                                    </div>
                                </div>
                                <table width='700' height='400' border='0' align='center' cellpadding='0' cellspacing='0' id='Table_01'>
                
                                    <tr>
                
                                        <td width='700' align='center' valign='top'>
                                            <table width='600' border='0' cellspacing='0' cellpadding='0'>
                                                <tr>
                                                    <td>
                                                        <font size='2' face='Arial, Helvetica, Geneva, SunSans-Regular, sans-serif'>
                                                            &nbsp;
                
                
                                                            <p style='margin-bottom: 20px; font-size:14px; text-align:justify;'>
                                                                <p>Hello"." ".$details[0]['customer_name'].", </p>
                                                                <p>Your booking ids are: ".$trip_id." and ".$trip_id1." have been cancelled successfully.</p>
                                                            </p>
                                                        </font>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>"
                    );
               $mailin->send_email($data10);
               $this->session->set_flashdata('sess_message', 'Your booking has been cancelled successfully. <b>Note: Your cancellation is not eligible for refund</b>');
                //redirect("my-booking/details/booking-".$id);
               //$this->session->set_userdata('message','Note: Your cancellation is not eligible for refund')
                    redirect("admin/booking");
             // redirect("my-booking");
        }
    }
}
public function cancel_trips1($trip_id){
        $time1 = date('m/d/Y G:i', strtotime('+0 hours'));
        $time2 = date('m/d/Y G:i', strtotime('+24 hours'));
        $cond ="AND trip_id='$trip_id'";
        $details = $this->common_model->fetch('booking_tbl', $cond);
        // t($details[0]['id'],1);
        $id = md5($details[0]['id']);


        $paymentReference = $details[0]['payment_reference'];
        $id = md5($details[0]['id']);
        $booking_id = $details[0]['booking_id'];
        if($details[0]['tips']=='')
        {
            $amount = $details[0]['tip_price'];
        }
        else
        {
            $amount = $details[0]['tip_price']+$details[0]['tips'];
        }
        //if($details[0]['pickup_date'].' '.$details[0]['pickup_time']>=$time1 && $details[0]['pickup_date'].' '.$details[0]['pickup_time']<= $time2){
        if($details[0]['pickup_date'].' '.$details[0]['pickup_time']>$time1 && $details[0]['pickup_date'].' '.$details[0]['pickup_time']> $time2){
         //echo 1;die;
                $judopay = new \Judopay(
                        array(
                            'apiToken' => 'OgGvlwZRHHMau0Zu',
                            'apiSecret' => '471819f583bbe1a7a628118a718e01bbadf9800cf876104c9a053cf50bc83d30',
                            'judoId' => '100085-067',
                            //Set to true on production, defaults to false which is the sandbox
                            'useProduction' => false
                            )
                            // array(
                            // 'apiToken' => 'clo5HIkQo6FDMMaN',
                            // 'apiSecret' => '90814fa0e563aceb94243a027fed807e1546a288c7db7e21e7bd9273ec34a69b',
                            // 'judoId' => '100757-426',
                            // //Set to true on production, defaults to false which is the sandbox
                            // 'useProduction' => false
                            // )
                        );
                        $refund = $judopay->getModel('Refund');
                        $refund->setAttributeValues(
                        array(
                            'receiptId' => $booking_id,
                            'yourPaymentReference' =>$booking_id,
                            'amount' => $amount,
                        )
                    );
                         // t($refund);
                        $response = $refund->create();
                         // t($response,1);
            if ($response['result'] === 'Success') {
                echo 'Refund successfully';
                $url = "https://api.icabbidispatch.com/icd5/bookings/cancel/".$trip_id;
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

                        $result = curl_exec($ch);
                        curl_close($ch);
                        $data = json_decode($result, true);

                        //t($data,1);
                //$cond = "AND trip_id='$trip_id'";
                $data_field['refund_status'] = 1;        
                $data_field['status'] = 2;
                $edit = $this->common_model->edit_cond('booking_tbl', $data_field, $cond);
                //echo $this->db->last_query();die;
                if($edit)
                {
                    $mailin = new Mailin("https://api.sendinblue.com/v2.0", "6ytcSmUvpTAMs28W");
                    $data10 = array(
                        "to" => array($details[0]['customer_email']=>"SkyBound Booking Cancelled and Refund Successfully"),
                        "from" => array("noreply@SkyBound.taxi", "SkyBound"),
                        "bcc" => array("royshaheli@gmail.com"=>"SkyBound"),
                        // "bcc" =>array("bcc@example.net"=>"Anita's Housekeeping"),
                        // "replyto" => array("noreply@SkyBound.taxi","SkyBound"),
                        "subject" => "SkyBound Booking Cancelled and Refund Successfully",
                        "html" => "  <table width='700' align='center' cellpadding='0' cellspacing='0'>
                        <tr>
                            <td width='700'>
                                <div style='width:700px' align='center'>
                                    <div style='width:600px;' align='left'>
                                        <img src='http://www.bitpastel.org/skybound-main/assets/frontend/images/logo.png' alt='logo'>
                                    </div>
                                </div>
                                <table width='700' height='400' border='0' align='center' cellpadding='0' cellspacing='0' id='Table_01'>
                
                                    <tr>
                
                                        <td width='700' align='center' valign='top'>
                                            <table width='600' border='0' cellspacing='0' cellpadding='0'>
                                                <tr>
                                                    <td>
                                                        <font size='2' face='Arial, Helvetica, Geneva, SunSans-Regular, sans-serif'>
                                                            &nbsp;
                
                
                                                            <p style='margin-bottom: 20px; font-size:14px; text-align:justify;'>
                                                                <p>Hello"." ".$details[0]['customer_name'].", </p>
                                                                <p>Your booking id is: ".$trip_id." has been cancelled and refund process created successfully.</p>
                                                            </p>
                                                        </font>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>"
                    );
                    $mailin->send_email($data10);
                    $this->session->set_flashdata('sess_message', 'Your booking has been cancelled successfully. <b>Note: Your refund of £'.$amount. ' has been successfully processed</b>');
                        //redirect("my-booking/details/booking-".$id);
                    //$this->session->set_userdata('message','Note: We have initiated a refund for the booking amount')
                    redirect("admin/booking");
                }
                } else {
                    $this->session->set_flashdata('err_message', 'There were some problems while processing your refund');
                    redirect("admin/booking");
                }
    }
    else
    {
        // echo 2;die;
        $url = "https://api.icabbidispatch.com/icd5/bookings/cancel/".$trip_id;
        //$url1 = "https://api.icabbidispatch.com/icd5/bookings/cancel/".$trip_id1;

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

                $result = curl_exec($ch);
                curl_close($ch);
                $data = json_decode($result, true);

                //t($data,1);
        $data_field['refund_status'] = 2;        
        $data_field['status'] = 2;
        $edit = $this->common_model->edit_cond('booking_tbl', $data_field, $cond);
        if($edit)
        {
            $mailin = new Mailin("https://api.sendinblue.com/v2.0", "6ytcSmUvpTAMs28W");
                    $data10 = array(
                        "to" => array($details[0]['customer_email']=>"SkyBound Booking Cancelled Successfully"),
                        "from" => array("noreply@SkyBound.taxi", "SkyBound"),
                        "bcc" => array("royshaheli@gmail.com"=>"SkyBound"),
                        // "bcc" =>array("bcc@example.net"=>"Anita's Housekeeping"),
                        // "replyto" => array("noreply@SkyBound.taxi","SkyBound"),
                        "subject" => "SkyBound Booking Cancelled Successfully",
                        "html" => "  <table width='700' align='center' cellpadding='0' cellspacing='0'>
                        <tr>
                            <td width='700'>
                                <div style='width:700px' align='center'>
                                    <div style='width:600px;' align='left'>
                                        <img src='http://www.bitpastel.org/skybound-main/assets/frontend/images/logo.png' alt='logo'>
                                    </div>
                                </div>
                                <table width='700' height='400' border='0' align='center' cellpadding='0' cellspacing='0' id='Table_01'>
                
                                    <tr>
                
                                        <td width='700' align='center' valign='top'>
                                            <table width='600' border='0' cellspacing='0' cellpadding='0'>
                                                <tr>
                                                    <td>
                                                        <font size='2' face='Arial, Helvetica, Geneva, SunSans-Regular, sans-serif'>
                                                            &nbsp;
                
                
                                                            <p style='margin-bottom: 20px; font-size:14px; text-align:justify;'>
                                                                <p>Hello"." ".$details[0]['customer_name'].", </p>
                                                                <p>Your booking id is: ".$trip_id." has been cancelled successfully.</p>
                                                            </p>
                                                        </font>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>"
                    );
                    $mailin->send_email($data10);
             $this->session->set_flashdata('sess_message', 'Your booking has been cancelled successfully. <b>Note:Your cancellation is not eligible for refund</b>');
                //redirect("my-booking/details/booking-".$id);
             redirect("admin/booking");
        }
    }
}
    public function cancel_refund_trips($trip_id,$trip_id1){
        $cond ="AND trip_id='$trip_id'";
        $details = $this->common_model->fetch('booking_tbl', $cond);

        $cond1 ="AND trip_id='$trip_id1'";
        $details1 = $this->common_model->fetch('booking_tbl', $cond1);
        // t($details,1);
        $paymentReference = $details[0]['payment_reference'];
        $id = md5($details[0]['id']);
        $booking_id = $details[0]['booking_id'];
        if($details[0]['tips']=='')
        {
            $amount = $details[0]['tip_price'];
        }
        else
        {
            $amount = $details[0]['tip_price']+$details[0]['tips'];
        }
        $judopay = new \Judopay(
                array(
                    'apiToken' => 'OgGvlwZRHHMau0Zu',
                    'apiSecret' => '471819f583bbe1a7a628118a718e01bbadf9800cf876104c9a053cf50bc83d30',
                    'judoId' => '100085-067',
                    //Set to true on production, defaults to false which is the sandbox
                    'useProduction' => false
                    )
                    // array(
                    // 'apiToken' => 'clo5HIkQo6FDMMaN',
                    // 'apiSecret' => '90814fa0e563aceb94243a027fed807e1546a288c7db7e21e7bd9273ec34a69b',
                    // 'judoId' => '100757-426',
                    // //Set to true on production, defaults to false which is the sandbox
                    // 'useProduction' => false
                    // )
                );
                $refund = $judopay->getModel('Refund');
                $refund->setAttributeValues(
                array(
                    'receiptId' => $booking_id,
                    'yourPaymentReference' =>$paymentReference,
                    'amount' => $amount,
                )
            );
                 // t($refund);
                $response = $refund->create();
                // t($response,1);
    if ($response['result'] === 'Success') {
        echo 'Refund successfully';
        $url = "https://api.icabbidispatch.com/icd5/bookings/cancel/".$trip_id;
        $url1 = "https://api.icabbidispatch.com/icd5/bookings/cancel/".$trip_id1;
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

                $result = curl_exec($ch);
                curl_close($ch);
                $data = json_decode($result, true);

                $ch1 = curl_init();

                curl_setopt($ch1, CURLOPT_URL, $url1);
                curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch1, CURLOPT_POST, true);
                curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);

                $result1 = curl_exec($ch1);
                curl_close($ch1);
                $data1 = json_decode($result1, true);
                //t($data,1);
        //$cond = "AND trip_id='$trip_id'";
        $data_field['status'] = 2;
        $edit = $this->common_model->edit_cond('booking_tbl', $data_field, $cond);
        //echo $this->db->last_query();
        $edit1 = $this->common_model->edit_cond('booking_tbl', $data_field, $cond1);
        //echo $this->db->last_query();die;
        if($edit || $edit1)
        {
            $this->session->set_flashdata('sess_message', 'You refund process created successfully and trip has been cancelled successfully.');
                //redirect("my-booking/details/booking-".$id);
            redirect("booking");
        }
        } else {
            $this->session->set_flashdata('err_message', 'There were some problems while processing your refund');
            redirect("booking");
        }

        
    }
}