<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Signin extends UI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
        require_once(APPPATH.'libraries/Mailin.php');
    }

    public function index(){
        if($this->input->post('signin'))
        {
            $email=$this->input->post('email');
            $password=md5($this->input->post('password'));
            $cond=" AND email_address='$email' AND password='$password' AND active=1";
            $loginDataExists=$this->common_model->fetch('customer_tbl',$cond);
            // t($loginDataExists,1);
            // t($this->session->userdata('redirect_url_new_new'),1);
            $userdetails = $loginDataExists[0];
            $cond1=" AND email_address='$email'";
            $loginDataExists1=$this->common_model->fetch('customer_tbl',$cond1);
            if($password!=$loginDataExists1[0]['password'])
            {
                $this->session->set_flashdata('err_message', 'Login failed, please check your details and try again.');
                if(empty($this->session->userdata('redirect_url_new')))
                {
                    redirect('signin');
                }
            }
            else if($loginDataExists1[0]['active']==0)
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
            else if(count($loginDataExists)>0){
                $data_field2['lastused_datetime']= time();
                $this->common_model->edit_cond('customer_tbl', $data_field2, $cond);
                $remember = $this->input->post('remember_me');
                if ($remember) {
                // Set remember me value in session
                $this->session->set_userdata('remember_me', TRUE);
                }
                $this->session->set_userdata('login_data',$userdetails);
                if(empty($this->session->userdata('redirect_url_new')))
                {
                    redirect('home');
                }
                else
                {

                    $booking_id1= $this->session->userdata('last_id');
                    $booking_id2= $this->session->userdata('out_last_id');
                    $booking_id3= $this->session->userdata('in_last_id');
                    if(!empty($booking_id1))
                    {
                        $booking_id = $booking_id1;
                    }
                    else if(!empty($booking_id2))
                    {
                        $booking_id = $booking_id2;
                    }
                    else if(!empty($booking_id3))
                    {
                        $booking_id3 = $booking_id3;
                    }
                    else
                    {
                        $booking_id = $booking_id;
                    }
                    // t($booking_id,1);
                    $cond1 = "AND id=$booking_id";
                    $cond2 = "AND id=$booking_id3";
                    $data_field1['id_customer']= $userdetails['id'];
                    $data_field1['customer_name']= $userdetails['firstname'].' '.$userdetails['lastname'];
                    $data_field1['customer_telephone']= $userdetails['telephone'];
                    $data_field1['customer_email']= $userdetails['email_address'];
                    $data_field1['customer_country_code']= $userdetails['country_code'];
                    $this->common_model->edit_cond('booking_tbl', $data_field1, $cond1);
                    $this->common_model->edit_cond('booking_tbl', $data_field1, $cond2);
                    $data_field2['lastused_datetime']= time();
                    $this->common_model->edit_cond('customer_tbl', $data_field2, $cond);
                     // echo $this->db->last_query();die;
                    redirect($this->session->userdata('redirect_url_new'));
                }
            }else{
                $this->session->set_flashdata('err_message', 'Login failed, please check your details and try again.');
                if(empty($this->session->userdata('redirect_url_new')))
                {
                    redirect('signin');
                }
                // else
                // {
                //     redirect($this->session->userdata('redirect_url_new'));
                // }
                  //redirect('signin');
            }
        }       
        $this->get_include();
        $this->load->view($this->viewDir.'signin/index',$this->data);
    }
    public function forgot_password(){
        if($this->input->post('forgotpass')){

            $email=$this->input->post('email');
            $cond="AND email_address='$email' AND active=1";
            $loginDataExists=$this->common_model->fetch('customer_tbl',$cond);
            $id=md5($loginDataExists[0]['id']);
			$fname= $loginDataExists[0]['firstname'];
			$url=base_url()."reset-password/".$id;
            if(count($loginDataExists)>0){
            
            /*===sending email to the user to reset password===*/

               //  $this->load->library('phpmailer_lib');  
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
               //  $mail->addAddress($email);
                
               //  // Add cc or bcc 
               //  //$mail->addCC('risingsun2k19dummy@gmail.com');
               //  //$mail->addBCC('risingsundummy2k19@gmail.com');
                
               //  // Email subject
               //  $mail->Subject = 'Reset Password';
                
               //  // Set email format to HTML
               //  $mail->isHTML(true);
                

                
               //  // Email body content
                 
               //  $mailContent = "<h1>Hello"." ".$fname.", </h1>
               //      <p>Please click on the link to reset your password. <a href =\"".$url."\">Reset Password</a></p>";

               //  $mail->Body = $mailContent;



                $mailin = new Mailin("https://api.sendinblue.com/v2.0", "6ytcSmUvpTAMs28W");
                        $data = array( 
                            "to" => array($email=>"SkyBound Reset Password"),
                            "from" => array("noreply@SkyBound.taxi", "SkyBound"),
                            "bcc" => array("royshaheli@gmail.com"=>"SkyBound"),
                            // "bcc" =>array("bcc@example.net"=>"Anita's Housekeeping"),
                            //"replyto" => array("bitpasteldev5@gmail.com","reply to!"),
                            "subject" => "Reset Password",
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
                                                           <p style='font-size:14px;'>Hello"." ".$fname." </p>
                    <p>Please click on the link to reset your password.<a href =\"".$url."\">Reset Password</a></p>
                                                            
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
                       //$mailin->send_email($data);

			//t($mailin->send_email($data),1);
                         // Send email
                if(!$mailin->send_email($data)){
                   $this->session->set_flashdata('err_message', "Something Went Wrong!");
                   redirect('forgot-password');
                }else{
                        $this->session->set_flashdata('sess_message', "Password reset link is sent to your email id"." ".$email."");
                        redirect('forgot-password');
                        //echo "send";
                }


                
                // Send email
                // if(!$mail->send()){
                //     echo 'Message could not be sent.';
                //     echo 'Mailer Error: ' . $mail->ErrorInfo;
                // }else{
                //         $this->session->set_flashdata('sess_message', "Password reset link is sent to your email id"." ".$email."");
                //         redirect('forgot-password');
                //         //echo "send";
                // }
            
           }
           else
           {
                $this->session->set_flashdata('err_message', 'This email id does not exist');
                redirect('forgot-password');
                //echo "no email";
            }
        } 
        $this->get_include();
        $this->load->view($this->viewDir.'signin/forgot-password',$this->data);
    }
    public function reset_password($id){
        $this->data['id']=$id;
        if($this->input->post('resetpass')){

                $password=md5($this->input->post('password'));
                $cond="AND md5(id)='$id' AND active=1";
                $loginDataExists=$this->common_model->fetch('customer_tbl',$cond);
                
                if(count($loginDataExists)>0){
                    $data_field['password']=$password;
                    $cond1 = "AND md5(id)='$id'";
                    $this->common_model->edit_cond('customer_tbl', $data_field,$cond1);
                    //echo $this->db->last_query();die;
                    $this->session->set_flashdata('sess_message', 'Password Updated Successfully! Please login with your credential');
                    redirect('signin');
                }
                
                else{
                    $this->session->set_flashdata('sess_message', 'Please Verify Your Account');
                    redirect('signin');
                }           
        }
       
        $this->get_include();
        $this->load->view($this->viewDir.'signin/reset-password',$this->data);
    }
    public function logout(){
        $this->session->unset_userdata('login_data');
        $this->session->sess_destroy();
        redirect(base_url('home'));
    }   
}