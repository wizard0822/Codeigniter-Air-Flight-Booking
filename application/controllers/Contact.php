<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Contact extends UI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('common_model');
        require_once(APPPATH.'libraries/Mailin.php');

	}
	public function index(){
		if($this->input->post('submit'))
        {
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$name= $first_name.' '.$last_name;
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$message = $this->input->post('message');
			$mailin = new Mailin("https://api.sendinblue.com/v2.0", "6ytcSmUvpTAMs28W");
                        $data = array( 
                            "to" => array('custserv@skybound.taxi'=>"SkyBound Contact Form"),
                            //"to" => array('royshaheli@gmail.com'=>"SkyBound Contact Form"),
                            "from" => array("noreply@SkyBound.taxi", "SkyBound"),
                            "bcc" => array("bitpasteldev5@gmail.com"=>"SkyBound"),
                            // "bcc" =>array("bcc@example.net"=>"Anita's Housekeeping"),
                            //"replyto" => array("bitpasteldev5@gmail.com","reply to!"),
                            "subject" => "SkyBound Contact Form",
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
                                                           <p style='font-size:14px;'>Hello Admin</p>
                    										<p>You have received new contact request</p>
                    										<div style='width: 100%;float:left;'>
                    										<div style='float: left;margin-right:2%;'>
                    										<p>Name: </p>
                    										</div>
                    										<div style='float: left;'>
                    										<p>"." ".$name."</p>
                    										</div>
                    										</div>
                    										<div style='width:100%;float:left;'>
                    										<div style='float: left;margin-right:2%;'>
                    										<p>Email: </p>
                    										</div>
                    										<div style='float: left;'>
                    										<p>"." ".$email." </p>
                    										</div>
                    										</div>
                    										<div style='width:100%;float:left;'>
                    										<div style='margin-right:2%;float: left;'>
                    										<p>Phone: </p>
                    										</div>
                    										<div style='float: left;'>
                    										<p>"." ".$phone." </p>
                    										</div>
                    										</div>
                    										<div style='width:100%;float:left;'>
                    										<div style='margin-right:2%;float: left;'>
                    										<p>Message: </p>
                    										</div>
                    										<div style='float: left;'>
                    										<p>"." ".$message." </p>
                    										</div>
                    										</div>
                                                            <p>Thanks & Regards,</p>
                                                            <p>SkyBound</p>
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
                   if(!$mailin->send_email($data)){
                   $this->session->set_flashdata('err_message', "Something Went Wrong!");
                   redirect('forgot-password');
	                }else{
	                        $this->session->set_flashdata('sess_message', "Mail has been send successfully");
	                        redirect('contact');
                        //echo "send";
                	}
        }
		$this->get_include();
        $this->load->view($this->viewDir.'contact/index',$this->data);
  }

}