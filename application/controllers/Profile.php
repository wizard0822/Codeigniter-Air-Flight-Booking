<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Profile extends UI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('common_model');
        require_once(APPPATH.'libraries/Mailin.php');
	}

	public function index(){

		$userData=$this->session->userdata('login_data');
	    $user_id=$userData['id'];
        
        // t($user_id,1);
    	if(!empty($user_id)){
                $this->session->unset_userdata('new_email');
                $this->session->unset_userdata('new_fname');
                $this->session->unset_userdata('new_lname');
                $this->session->unset_userdata('new_phone');
                $this->session->unset_userdata('new_country_code');
    	    	$cond="AND id='$user_id' AND active=1";
    	    	$userDetails=$this->common_model->fetch('customer_tbl',$cond);
    	    	$cus_id= $userDetails[0]['id'];
    	    	$cond1="AND id='$cus_id' AND active=1";
          //        t($userDetails,1);
                if($this->input->post('submit'))
                {
                    $this->session->set_userdata('tab', $this->input->post('tab1'));
                    // t($this->session->userdata(),1);
                    $fname=$this->input->post('fname');
                    $lname=$this->input->post('lname');
                    $email=$this->input->post('email');
                    $phone=$this->input->post('phone');
                    $country_code=$this->input->post('country_code');
                    if(substr( $phone, 0, 1 ) === "0")
                    {
                        $phone =ltrim($phone, 0);
                    }
                    // if(strlen($country_code)==2)
                    // {
                    //     //echo 1;
                    //     $phone2 = substr($phone1, 2);
                    // }
                    // else if(strlen($country_code)==3)
                    // {
                    //     //echo 1;
                    //     $phone2 = substr($phone1, 3);
                    // }
                    // else if(strlen($country_code)==4)
                    // {
                    //     //echo 1;
                    //     $phone2 = substr($phone1, 4);
                    // }
                    // else if(strlen($country_code)==5)
                    // {
                    //     //echo 1;
                    //     $phone2 = substr($phone1, 5);
                    // }
                    // $phone = ltrim($phone2, ' ');
                      // t($phone,1);
                    $data_field['firstname']=$fname;
                    $data_field['lastname']=$lname;
                    $data_field['email_address']= $email;
                    $data_field['telephone']= $phone;
                    $data_field['country_code']= $country_code;
                    // t($edit,1);
                    //echo $this->db->last_query();die;
                        if($userDetails[0]['email_address']!=$email)
                        { 
                            $this->session->set_userdata('new_email', $email);
                            $this->session->set_userdata('new_fname', $fname);
                            $this->session->set_userdata('new_lname', $lname);
                            $this->session->set_userdata('new_phone', $phone);
                            $this->session->set_userdata('new_country_code', $country_code);
                            $vcode=rand(1000,9999);
                            $data_field1['verification_code']=$vcode; 
                            $edit = $this->common_model->edit_cond('customer_tbl', $data_field1, $cond); 
                            $id=md5($userDetails[0]['id']);

                            $mailin = new Mailin("https://api.sendinblue.com/v2.0", "6ytcSmUvpTAMs28W");
                            $data = array(
                           "to" => array($userDetails[0]['email_address']=>"Skybound Profile Email Change Verification"),
                            "from" => array("noreply@skybound.taxi", "Skybound"),
                            "bcc" => array("royshaheli@gmail.com"=>"Skybound"),
                            // "bcc" =>array("bcc@example.net"=>"Anita's Housekeeping"),
                            // "replyto" => array("risingsun2k19dummy@gmail.com","reply to!"),
                            "subject" => "Skybound Profile Email Change Verification",
                            "html" => "<table width='700' align='center' cellpadding='0' cellspacing='0'>
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
                                                                    <font size='2' face='Arial, Helvetica, Geneva, SunSans-Regular, sans-serif'>&nbsp;
                                                      
                                                        <p style='margin-bottom: 20px; font-size:14px; text-align:justify;'>
                                                       <p style='font-size:14px;'>Hello"." ".$fname.", </p>
                                                       <p>Please enter this verification code to verify your email.</p><p>Your Verification Code is: ".$vcode."</p>
                                                        
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
                    );


                // Send email
                        if(!$mailin->send_email($data)){
                            $this->session->set_flashdata('reg_err_message', "Something Went Wrong!");
                            redirect("profile");
                        }else{
                            $this->session->set_flashdata('err_message', 'Email has been changed. You will receive an verification code from Skybound. Enter the code to complete the email verification.');
                                    redirect("verify-register-account/".$id);
                        }


                            // $resend_otp_link =base_url()."signup/resend_verification_code/".$id;
                            // $this->session->set_userdata('resend_otp_link',$resend_otp_link);
                            
                        }

                        else
                        {
                            $edit = $this->common_model->edit_cond('customer_tbl', $data_field, $cond);
                            if($edit)
                            {
                                $userDetails = $this->common_model->fetch('customer_tbl', $cond1);
        	                    $this->session->unset_userdata('login_data');
        	                    $this->session->set_userdata('login_data',$userDetails[0]);
        	                    $userData=$this->session->userdata('login_data');
        	    				$user_id=$userData['id'];
                                $this->session->set_flashdata('sess_message', 'Profile data has been updated successfully.');
                                redirect('profile');
                            }
                            else
                            {
                                $this->session->set_flashdata('sess_message', 'Error to update data.');
                                redirect('profile');
                            }
                        }
                }
        }
        else
        {
            redirect("signin");
        }
        $this->data['details']=$userDetails[0];
        // t($userDetails[0],1);
       	$this->get_include();
        $this->load->view($this->viewDir.'profile/index',$this->data);
    }
    public function verify_register_account($id){
        // $this->session->unset_userdata('resend_otp_link');
        $user_id=$id;
        $this->data['id']=$id;

        if($this->input->post('submit')){

                $code=$this->input->post('verification_code');
                $cond="AND verification_code='$code' AND md5(id)='$user_id' AND active=1";
                $loginDataExists=$this->common_model->fetch('customer_tbl',$cond);
                
                if(count($loginDataExists)>0){
                    $data_field['verification_code']='';
                    $data_field['email_address']=$this->session->userdata('new_email');
                    $data_field['firstname']=$this->session->userdata('new_fname');
                    $data_field['lastname']=$this->session->userdata('new_lname');
                    $data_field['telephone']=$this->session->userdata('new_phone');
                    $data_field['country_code']=$this->session->userdata('new_country_code');
                    //$data_field['active'] = 1;
                    $cond1 = "AND md5(id)='$user_id'";
                    $this->common_model->edit_cond('customer_tbl', $data_field,$cond1);
                    $this->session->set_flashdata('sess_message', 'Account Verified! Please login with your credential');
                    $userdetails = $loginDataExists[0];
                    // if(!empty($this->session->userdata('redirect_url_new')))
                    // {
                        $this->session->set_userdata('login_data',$userdetails);
                        redirect('home');
                    // }
                    // else
                    // {
                    //     redirect('signin');
                    // }
                }
                else if($code!=$loginDataExists[0]['verification_code'])
                {
                    $this->session->set_flashdata('err_message', 'Verification code does not match. Please try again.');
                }
                else{
                    $this->session->set_flashdata('err_message', 'Please Verify Your Account');
                }           
        }
        $this->get_include();
        $this->load->view($this->viewDir.'profile/verify-register-account',$this->data);
    }
    public function email_exists($email)
    {
        $userData=$this->session->userdata('login_data');
	    $user_id=$userData['id'];
        $cond ="AND email_address='$email' AND active=1 AND id!=$user_id";
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
    public function change_password(){

    	$userData=$this->session->userdata('login_data');
	    $user_id=$userData['id'];
    	
    	if($this->input->post('submit')){
        $this->session->set_userdata('tab', $this->input->post('tab2'));
        $cond = "AND id='$user_id'";
        $user_data=$this->common_model->fetch('customer_tbl', $cond);
        $password = $this->input->post('new_password');
        $con_password = $this->input->post('confirm_password');
        $old_password = $this->input->post('old_password');
        $user_password = $user_data[0]['password'];
        
        if ($password != '' && $password != $con_password) {
                $msg = "Please enter same confirm password.";
                $this->session->set_flashdata('err_message', 'Please enter same confirm password.');
                redirect('profile');
                exit;
            }
        else if ($old_password != '' && md5($old_password) != $user_password) {
                $msg = "Please enter proper old password.";
                $this->session->set_flashdata('err_message', 'You have entered an incorrect old passowrd, please try again.');
                redirect('profile');
                exit;
            }
            $password = md5($password);

            $data = array(
                'password' => $password,
            );

        	$edit = $this->common_model->edit_cond('customer_tbl',$data, $cond);
            if ($edit) {
                $msg = 'You have successfully modified your password.';
                $this->session->set_flashdata('sess_message', 'You have successfully modified your password.');
                redirect('profile');
            } else {
                $msg = 'Something wrong while update.';
                $this->session->set_flashdata('err_message', 'Something wrong while update.');
                redirect('profile');
            }
        }

        $this->get_include();
        $this->load->view($this->viewDir.'profile/change-password',$this->data);
    }

}