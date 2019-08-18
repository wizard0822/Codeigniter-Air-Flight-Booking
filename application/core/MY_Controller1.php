<?php

class MY_Controller extends CI_Controller {

    public $data = array();
    public $viewDir;

    function __construct() {
        parent::__construct();
        $this->viewDir = "backend/";
        
        # Setting The Base Url And other
        $baseUrl = $this->config->item('base_url');
        
        $this->data['base_url'] = $baseUrl;
        $this->data['css_path'] = $baseUrl . "assets/css/";
        $this->data['js_path'] = $baseUrl . "assets/js/";
        $this->data['images_path'] = $baseUrl . "assets/images/";
        $this->data['email_template_path'] = $baseUrl . 'assets/email/';
        $this->data['controller_name']=$this->router->fetch_class();
        $this->data['method_name']=$this->router->fetch_method();
        $this->data['back_url']=$_SERVER['HTTP_REFERER'];
        // $this->viewDir = "";
        if($this->router->fetch_class() != 'login'){
            
            $this->data['admin_id']=$this->checkSessionForUser();
       
        
        }
    }
    function get_include() {
       $usertype=$this->session->userdata('admin_data');
       $this->data['admin_details']=$usertype[0];
        
        
        
       $this->data['header']         = $this->load->view($this->viewDir . "template/header", $this->data, true);
       $this->data['footer']         = $this->load->view($this->viewDir . "template/footer", $this->data, true);
       $this->data['top_menu']       = $this->load->view($this->viewDir . "template/top_menu", $this->data, true);
       $this->data['left_nav']       = $this->load->view($this->viewDir . "template/left_nav", $this->data, true);
       $this->data['footer_content']       = $this->load->view($this->viewDir . "template/footer_content", $this->data, true);
       // $this->data['general_menu']       = $this->load->view($this->viewDir . "home_banner/general_menu", $this->data, true);
        // $this->data['content']        = $this->load->view($this->viewDir . "template/content", $this->data, true);
    }
    function checkSessionForUser(){
        $userSession = $this->session->userdata;
        
        if(isset($userSession['admin_data'][0]['email'])){
            return $userSession['admin_data'][0]['id'];
        }else{
            redirect("login");
        }
    }

    public function email_send($to, $subject, $message, $from = 0, $smtp = 0,$cc='') {
        $this->load->library('email');
        
        $from_name="hello@careercompanionship.com";
        $from_email="Career Companion";
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: '.$from_name.'<'.$from_email.'>' . "\r\n";
        // $headers .= 'Cc: kasturi@bitpastel.in' . "\r\n";
        // t($message,1);
        mail($to,$subject,$message,$headers);

        return $sendEmail;
    }

    
}

class UI_Controller extends CI_Controller {

    public $data = array();
    public $viewDir;

    function __construct() {
        parent::__construct();
        $this->viewDir = "frontend/";
        
        # Setting The Base Url And other
        $baseUrl = $this->config->item('base_url');
        
        $this->data['base_url'] = $baseUrl;
        $this->data['css_path'] = $baseUrl . "assets/css/";
        $this->data['js_path'] = $baseUrl . "assets/js/";
        $this->data['images_path'] = $baseUrl . "assets/img/";
        $this->data['email_template_path'] = $baseUrl . 'assets/email/';
        $this->data['controller_name']=$this->router->fetch_class();
        $this->data['method_name']=$this->router->fetch_method();
        $this->data['back_url']=$_SERVER['HTTP_REFERER'];
        // $this->viewDir = "";
        
    }
    function get_include() {
       $this->data['header']         = $this->load->view($this->viewDir . "template/header", $this->data, true);
       $this->data['footer']         = $this->load->view($this->viewDir . "template/footer", $this->data, true);
       $this->data['top_menu']       = $this->load->view($this->viewDir . "template/top_menu", $this->data, true);
       
       
       // $this->data['general_menu']       = $this->load->view($this->viewDir . "home_banner/general_menu", $this->data, true);
        // $this->data['content']        = $this->load->view($this->viewDir . "template/content", $this->data, true);
    }
    

    public function email_send($to, $subject, $message, $from = 0, $smtp = 0,$cc='') {
        $this->load->library('email');
        
        $from_name="hello@mannacapital.com";
        $from_email="Manna Capital";
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: '.$from_name.'<'.$from_email.'>' . "\r\n";
        // $headers .= 'Cc: kasturi@bitpastel.in' . "\r\n";
        // t($message,1);
        mail($to,$subject,$message,$headers);

        return $sendEmail;
    }

    
}

