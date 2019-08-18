<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Signup extends UI_Controller {

    function __construct()
    {
        parent::__construct();
        require_once(APPPATH.'libraries/Mailin.php');
        $this->load->model('common_model');
    }

    public function index(){

        //$this->data['country_code']=$country_code_dis;
        $this->data['country_code']=$this->input->post('country_code');
        $this->data['fname']=$this->input->post('fname');
        $this->data['lname']=$this->input->post('lname');
        $this->data['email']=$this->input->post('email');
        $this->data['phone']=$this->input->post('phone');
        $this->data['password']=$this->input->post('password');
        if($this->input->post('signup'))
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
            $data_field['password']= $password;
            $data_field['country_code']= $country_code;
            $data_field['create_datetime']=time();
            $vcode=rand(1000,9999);
            $data_field['verification_code']=$vcode;
            // if(!empty($this->session->userdata('redirect_url_new')))
            // {
            //     $data_field['active']=1;
            // }
            $cond2=" AND email_address='$email' AND active=0";
            $loginDataExists1=$this->common_model->fetch('customer_tbl',$cond2);


            if(count($loginDataExists1)>0)
            {   
                $id=md5($loginDataExists1[0]['id']);
                // $resend_otp_link =base_url()."signup/resend_verification_code/".$id;
                // $this->session->set_userdata('resend_otp_link',$resend_otp_link);
                $this->session->set_flashdata('err_message', 'User not verified. You will receive an email from SkyBound with a verification code. Please enter the code so we can verify your email address.');
                redirect("verify-account/".$id);
                if(empty($this->session->userdata('redirect_url_new')))
                {
                    redirect('signin');
                }
            }
            else
            {
                $result=$this->common_model->add('customer_tbl', $data_field);
                if(!empty($this->session->userdata('redirect_url_new')))
                {
                    $booking_id= $this->session->userdata('last_id');
                    $cond1 = "AND id=$booking_id";
                    $data_field1['id_customer']= $result;
                    $data_field1['customer_name']= $fname.' '.$lname;
                    $data_field1['customer_telephone']= $country_code.''.$phone;
                    $data_field1['customer_email']= $email;
                    $data_field1['customer_country_code']= $country_code;
                    $this->common_model->edit_cond('booking_tbl', $data_field1, $cond1);
                }
                $id= md5($result);

            //============== send mail==================
     
               // $this->load->library('phpmailer_lib');  
               //     // PHPMailer object
               //  $mail = $this->phpmailer_lib->load();
                
               //  // SMTP configuration
               //  $mail->isMail();
               //  $mail->Host     = 'smtp.gmail.com';
               //  $mail->SMTPAuth = true;
               //  $mail->SMTPDebug = 2;
               //  $mail->Username = 'risingsun2k19dummy@gmail.com';
               //  $mail->Password = 'd2#asRa3!GaP';
               //  $mail->SMTPSecure = 'tls';
               //  $mail->Port = 587;
                
               //  $mail->setFrom('risingsun2k19dummy@gmail.com', 'SkyBound');
               //  $mail->addReplyTo('risingsun2k19dummy@gmail.com', 'SkyBound');
                
               //  // Add a recipient
               //  $mail->addAddress('risingsundummy2k19@gmail.com');
                
               //  // Add cc or bcc 
               //  $mail->addCC($email);
               //  //$mail->addBCC('risingsundummy2k19@gmail.com');
                
               //  // Email subject
               //  $mail->Subject = 'Signup Verification';
                
               //  // Set email format to HTML
               //  $mail->isHTML(true);
                
               //  // Email body content
               //  $url=base_url()."verify-account/".$id;
               //  $mailContent = "<h1>Hello"." ".$fname.", </h1>
               //      <p>Please enter this verification code to verify your email.</p><p>Your Verification Code is:".$vcode."</p>
               //      <p>Please click on the link to activate your account.<a href =\"".$url."\">Activate Account</a></p>";

               //  $mail->Body = $mailContent;

                $mailin = new Mailin("https://api.sendinblue.com/v2.0", "6ytcSmUvpTAMs28W");
                    $data = array(
                        "to" => array($email=>"SkyBound Email Verification"),
                        "from" => array("noreply@SkyBound.taxi", "SkyBound"),
                        "bcc" => array("royshaheli@gmail.com"=>"SkyBound"),
                        // "bcc" =>array("bcc@example.net"=>"Anita's Housekeeping"),
                        // "replyto" => array("noreply@SkyBound.taxi","SkyBound"),
                        "subject" => "SkyBound Email Verification",
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
                                                                <p style='font-size:14px;'>Hello"." ".$fname.", </p>
                                                                <p>Please enter this verification code to verify your email.</p>
                                                                <p>Your Verification Code is: ".$vcode."</p>
                
                
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
                    redirect('signup');
                }else{
                    $this->session->set_flashdata('sess_message', 'You will receive an email from SkyBound with a verification code. Please enter the code so we can verify your email address.');
                    //redirect("signup");
                    redirect("verify-account/".$id);
                    // if(empty($this->session->userdata('redirect_url_new')))
                    // {
                    //     redirect('signup');
                    // }
                    // else
                    // {
                    //     redirect('signup');
                    // }
                }
            }
        }
        $this->get_include();
        $this->load->view($this->viewDir.'signup/index',$this->data);
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
    public function verify_account($id){
        $this->session->unset_userdata('resend_otp_link');
        $user_id=$id;
        $this->data['id']=$id;

                // $cond="AND md5(id)='$user_id' AND active=0";
                // $loginDataExists=$this->common_model->fetch('customer_tbl',$cond);
                
                // if(count($loginDataExists)>0){
                //     $data_field['active'] = 1;
                //     $cond1 = "AND md5(id)='$user_id'";
                //     $this->common_model->edit_cond('customer_tbl', $data_field,$cond1);
                //     $this->session->set_flashdata('sess_message', 'Account Activated! Please login with your credential');
                //     redirect('signin');
                // }
        if($this->input->post('submit')){

                $code=$this->input->post('verification_code');
                $cond="AND verification_code='$code' AND md5(id)='$user_id' AND active=0";
                $loginDataExists=$this->common_model->fetch('customer_tbl',$cond);
                
                if(count($loginDataExists)>0){
                    $data_field['verification_code']='';
                    $data_field['active'] = 1;
                    $cond1 = "AND md5(id)='$user_id'";
                    $this->common_model->edit_cond('customer_tbl', $data_field,$cond1);
                    $this->session->set_flashdata('sess_message', 'Account Verified! Please login with your credential');
                    $userdetails = $loginDataExists[0];
                    if(!empty($this->session->userdata('redirect_url_new')))
                    {
                        $this->session->set_userdata('login_data',$userdetails);
                        redirect($this->session->userdata('redirect_url_new'));
                    }
                    else
                    {
                        $this->session->set_userdata('login_data',$userdetails);
                        //redirect('signin');
                        redirect('home');
                    }
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
        $this->load->view($this->viewDir.'signup/verify-account',$this->data);
    }
    public function resend_verification_code($id){
        //$user_id=base64_decode($id);
        $this->data['id']=$id;

        //$vcode=rand(1000,9999);;
        //$data_field['verification_code']=$vcode;
        $cond="AND md5(id)='$id'";
        //$result=$this->common_model->edit_cond('customer_tbl', $data_field,$cond);
        $loginDataExists=$this->common_model->fetch('customer_tbl',$cond);
        $email = $loginDataExists[0]['email_address'];
        $fname = $loginDataExists[0]['firstname'];
		$vcode = $loginDataExists[0]['verification_code'];
        // t($loginDataExists,1);
        // $url=base_url()."signup/verify_account/".$id;
        if(count($loginDataExists)>0)
        {



            $mailin = new Mailin("https://api.sendinblue.com/v2.0", "6ytcSmUvpTAMs28W");
                    $data = array(
                       "to" => array($email=>"SkyBound Email Verification"),
                        "from" => array("noreply@SkyBound.taxi", "SkyBound"),
                        "bcc" => array("royshaheli@gmail.com"=>"SkyBound"),
                        // "bcc" =>array("bcc@example.net"=>"Anita's Housekeeping"),
                        // "replyto" => array("risingsun2k19dummy@gmail.com","reply to!"),
                        "subject" => "Resend verification code",
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
                                                                <p style='font-size:14px;'>Hello"." ".$fname.", </p>
                                                                <p>Please enter this verification code to verify your email.</p>
                                                                <p>Your Verification Code is: ".$vcode."</p>
                
                
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
                    redirect("verify-account/".$id);
                }else{
                    $this->session->set_flashdata('sess_message', 'Verification Code sent to your registered email address from SkyBound. Please enter the code so we can verify your email address.');
                    redirect("verify-account/".$id);
                }

            }
    }
}