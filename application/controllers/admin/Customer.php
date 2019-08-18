<?php


defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends MY_Controller {
	function __construct()
	{
		parent::__construct();
        $this->load->model('common_model');
        require_once(APPPATH.'libraries/Mailin.php');
	}
	public function index(){
        $usertype=$this->session->userdata('admin_data');
        $cond = "AND active < 5 order by active desc";
        $customers = $this->common_model->fetch('customer_tbl', $cond);
        $this->data['list'] = $customers;
    
        $this->get_include();
        $this->load->view($this->viewDir."customer/listing",$this->data);
    }
    public function add(){
        $this->data['country_code']=$this->input->post('country_code');
        $this->data['fname']=$this->input->post('fname');
        $this->data['lname']=$this->input->post('lname');
        $this->data['email']=$this->input->post('email');
        $this->data['phone']=$this->input->post('phone');
        if($this->input->post('submit'))
        {
            // t($this->input->post(),1);
            $fname=$this->input->post('fname');
            $lname=$this->input->post('lname');
            $email=$this->input->post('email');
            $phone=$this->input->post('phone');
            $country_code=$this->input->post('country_code');
            if(substr( $phone, 0, 1 ) === "0")
            {
                $phone =ltrim($phone, 0);
            }
            // if(substr( $country_code1, 0, 1 ) === "+")
            // {
            //     $country_code1 =ltrim($country_code1, '+');
            //     $country_code =$country_code1;
            //     // $country_code =ltrim($country_code, '+');
            // }
            // if($this->input->post('country_code')=="+44")
            // {
            //     $country_code = "+0044";
            // }
            //else if($this->input->post('country_code')=="44 (GG)")
            //{
           //     $country_code = "0044 (GG)";
            //}
            //else if($this->input->post('country_code')=="44 (IM)")
           // {
           //     $country_code = "0044 (IM)";
           // }
            //else if($this->input->post('country_code')=="44 (JE)")
           // {
            //    $country_code = "0044 (JE)";
            //}
            // else
            // {
            //     $country_code = $this->input->post('country_code');
            // }
             // t($country_code,1);
            $password=md5($this->input->post('password'));

            $data_field['firstname']=$fname;
            $data_field['lastname']=$lname;
            $data_field['email_address']= $email;
            $data_field['telephone']= $phone;
            $data_field['country_code']= $country_code;
            $data_field['create_datetime']=time();
            //$vcode=rand(1000,9999);
            //$data_field['verification_code']=$vcode;
            $data_field['active']=1;
            // if(!empty($this->session->userdata('redirect_url_new')))
            // {
            //     $data_field['active']=1;
            // }
            // $cond2=" AND email_address='$email' AND active=0";
            // $loginDataExists1=$this->common_model->fetch('customer_tbl',$cond2);


            // if(count($loginDataExists1)>0)
            // {   
            //     $id=md5($loginDataExists1[0]['id']);
            //     // $resend_otp_link =base_url()."signup/resend_verification_code/".$id;
            //     // $this->session->set_userdata('resend_otp_link',$resend_otp_link);
            //     $this->session->set_flashdata('err_message', 'User not verified. You will receive an email from SkyBound with a verification code. Please enter the code so we can verify your email address.');
            //     redirect("admin/customer/add");
            // }
            // else
            // {
                $result=$this->common_model->add('customer_tbl', $data_field);
                $id= md5($result);

            //============== send mail==================
     
               
                $url=base_url()."reset-password/".$id;
                $mailin = new Mailin("https://api.sendinblue.com/v2.0", "6ytcSmUvpTAMs28W");
                    $data = array(
                        "to" => array($email=>"SkyBound Set Password"),
                        "from" => array("noreply@SkyBound.taxi", "SkyBound"),
                        "bcc" => array("royshaheli@gmail.com"=>"SkyBound"),
                        // "bcc" =>array("bcc@example.net"=>"Anita's Housekeeping"),
                        // "replyto" => array("noreply@SkyBound.taxi","SkyBound"),
                        "subject" => "SkyBound Set Password",
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
                                                                <h1>Hello"." ".$fname." </h1>
                                                                <p>Please click on the link to set your password.<a href =\"".$url."\">Set Password</a></p>
                
                
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
                        // "attachment" => array("https://domain.com/path-to-file/filename1.pdf", "https://domain.com/path-to-file/filename2.jpg")
                                // <p>Please click on the link to activate your account.<a href =\"".$url."\">Activate Account</a></p>
                    );
                // t($mailin->send_email($data),1);
                // Send email
                // if(!$mail->send()){
                //     echo 'Message could not be sent.';
                //     echo 'Mailer Error: ' . $mail->ErrorInfo;
                if(!$mailin->send_email($data)){
                    $this->session->set_flashdata('reg_err_message', "Something Went Wrong!");
                    redirect('admin/customer/add');
                }else{
                    $this->session->set_flashdata('sess_message', 'Customer has been added sccessfully.They will receive an email from SkyBound with a set password link');
                    //redirect("signup");
                    redirect("admin/customer");
                    // if(empty($this->session->userdata('redirect_url_new')))
                    // {
                    //     redirect('signup');
                    // }
                    // else
                    // {
                    //     redirect('signup');
                    // }
                }
            //}
        }
            
        $this->get_include();
        $this->load->view($this->viewDir."customer/add",$this->data);
   }

   public function email_exists($email)
    {
        // $this->db->where('email_address', $email,'active',1);
        // $query = $this->db->get('customer_tbl');
        $cond ="AND email_address='$email' AND active=1";
        $query = $this->common_model->fetch('customer_tbl',$cond);
        // echo $this->db->last_query();die;
        if(count($query)>0)
        { return TRUE; } else { return FALSE; }
    }
    public function register_email_exists()
    {
        if (array_key_exists('email',$_POST)) {
            if ( $this->email_exists($this->input->post('email')) == TRUE ) {
                echo json_encode(FALSE);
            } else {
                echo json_encode(TRUE);
            }
        }
    }
    public function edit($id){
        $usertype=$this->session->userdata('admin_data');
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $details=$this->common_model->fetch('customer_tbl',$cond);
        // t($details,1);
        $this->data['details']=$details;
        if($this->input->post('submit')){
            $fname=$this->input->post('fname');
            $lname=$this->input->post('lname');
            $phone=$this->input->post('phone');
            $country_code=$this->input->post('country_code');
            if(substr( $phone, 0, 1 ) === "0")
            {
                $phone =ltrim($phone, 0);
            }

            $data_field['firstname']=$fname;
            $data_field['lastname']=$lname;
            $data_field['telephone']= $phone;
            $data_field['country_code']= $country_code;

                // $cond = "AND id=$id";
            // t($id);
                $this->common_model->edit_cond('customer_tbl', $data_field,$cond);
                // echo $this->db->last_query();die;
                $this->session->set_flashdata('sess_message', 'Customer Updated successfully!');
                redirect('admin/customer');
            }
            
        $this->get_include();
        $this->load->view($this->viewDir."customer/edit",$this->data);
   }
    public function view($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $view=$this->common_model->fetch('customer_tbl',$cond);
        $this->data['value'] = $view[0];

        $this->get_include();
        $this->load->view($this->viewDir."customer/view",$this->data);
    }

    public function view_flight_list($id){
        $id=base64_decode($id);
        $cond="AND id_customer='$id'";
        $list=$this->common_model->fetch('booking_tbl',$cond);
        foreach ($list as $key1 => $value1) {
                    $airport_id = $value1['pickup_address'];
                    $vehicle_id = $value1['id_vehicletype'];
                    $customer_id = $value1['id_customer'];
                    $cond3="AND id ='$airport_id' AND status=1";
                    $airport_details=$this->common_model->fetch('airport_tbl',$cond3);
                    $list[$key1]['airport_name'] = $airport_details[0]['name'];
                    $cond12="AND id ='$vehicle_id' AND status=1";
                    $vehicle_details=$this->common_model->fetch('vehicle_type_tbl',$cond12);
                    $list[$key1]['vehicle_name'] = $vehicle_details[0]['name'];
                    $cond10 = "AND id=$customer_id";
                    $user_details=$this->common_model->fetch('customer_tbl',$cond10);
                    $list[$key1]['customer_name'] = $user_details[0]['firstname'].' '.$user_details[0]['lastname'];
        }  
        $this->data['list'] = $list;

        $this->get_include();
        $this->load->view($this->viewDir."customer/view-flight-list",$this->data);
    }
    
    public function delete($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $cond1="AND user_id='$id'";
        $cond2="AND user_id='$id'";
        $cond3="AND post_user_id='$id'";
        $cond4="AND question_user_id='$id'";
        
        $data=array(
            'active'=>5
            );
        $delete=$this->common_model->edit_cond('customer_tbl',$data,$cond);
        $delete1=$this->common_model->edit_cond('posts',$data,$cond1);
        $delete2=$this->common_model->edit_cond('discussion_forum',$data,$cond2);
        $delete3=$this->common_model->edit_cond('comment',$data,$cond3);
        $delete4=$this->common_model->edit_cond('discussion_forum_answer',$data,$cond4);
        if($delete){
            $this->session->set_flashdata('sess_message', 'User deleted successfully!');

            redirect('admin/customer/');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete User!');

            redirect('admin/customer/');
        }
    }
    public function inactivate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        
        $data=array(
            'active'=>0
            );
        $delete=$this->common_model->edit_cond('customer_tbl',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Your account is deactivated!');

            redirect('admin/customer/');
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate account!');

            redirect('admin/customer/');
        }
    }
    public function activate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array(  
            'active'=>1
            );
        $delete=$this->common_model->edit_cond('customer_tbl',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Your account is activated!');
            redirect('admin/customer/');
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate account!');
            redirect('admin/customer/');
        }
    }

    
}
