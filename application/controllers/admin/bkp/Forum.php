<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('login_model');

	}
	public function index(){
        $usertype=$this->session->userdata('admin_data');
        $cond = "AND status < 5 order by id desc";
        $forums = $this->login_model->fetch('discussion_forum', $cond);
        foreach ($forums as $key => $value) {
            # code...
            $user_id = $value['user_id'];
            $cond2 = "AND id='$user_id' AND status < 5";
            $user = $this->login_model->fetch('users', $cond2);
            $forums[$key]['user_name']=$user[0]['display_name'];
        }
        $this->data['list'] = $forums;
        $this->get_include();
        $this->load->view($this->viewDir."forum/listing",$this->data);
    }

    public function view_answers($id){
        $id=base64_decode($id);
        $cond1="AND id='$id'";
        $forum=$this->login_model->fetch('discussion_forum',$cond1);
        $cond="AND question_id='$id' AND status<5";
        $answers=$this->login_model->fetch('discussion_forum_answer',$cond);
        foreach ($answers as $key => $value) {
            # code...
            $user_id = $value['user_id'];
            $cond2 = "AND id='$user_id' AND status < 5";
            $user = $this->login_model->fetch('users', $cond2);
            $answers[$key]['user_name']=$user[0]['display_name'];
        }
       
        $this->data['list'] = $answers;
        $this->data['forum'] = $forum[0];
        $this->get_include();
        $this->load->view($this->viewDir."forum/view_answers",$this->data);
    }
    
    public function delete($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $cond1="AND question_id='$id'";
        $data=array(
            'status'=>5
            );
        $delete=$this->login_model->edit_cond('discussion_forum',$data,$cond);
        $delete1=$this->login_model->edit_cond('discussion_forum_answer',$data,$cond1);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Forum deleted successfully!');
            redirect('admin/forum');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete forum!');
            redirect('admin/forum');
        }
    }
    public function inactivate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array( 
            'status'=>2,
            'admin_inactive' => 1
            );
        $delete=$this->login_model->edit_cond('discussion_forum',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Forum deactivated successfully!');
            redirect('admin/forum');
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate forum!');
            redirect('admin/forum');
        }
    }
    public function activate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array(
            'status'=>1,
            'admin_inactive' => 0
            );
        $delete=$this->login_model->edit_cond('discussion_forum',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Forum activated successfully!');
            redirect('admin/forum');
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate forum!');
            redirect('admin/forum');
        }
    }

    public function answer_delete($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $fetch = $this->login_model->fetch('discussion_forum_answer',$cond);
        $question_id = $fetch[0]['question_id'];
        $data=array(
            'status'=>5
            );
        $delete=$this->login_model->edit_cond('discussion_forum_answer',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Answer deleted successfully!');
            redirect('admin/forum/view_answers/'.base64_encode($question_id));
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete answer!');
            redirect('admin/forum/view_answers/'.base64_encode($question_id));
        }
    }
    public function answer_inactivate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $fetch = $this->login_model->fetch('discussion_forum_answer',$cond);
        $question_id = $fetch[0]['question_id'];
        $data=array( 
            'status'=>2
            );
        $delete=$this->login_model->edit_cond('discussion_forum_answer',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Forum deactivated successfully!');
            redirect('admin/forum/view_answers/'.base64_encode($question_id));
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate forum!');
            redirect('admin/forum/view_answers/'.base64_encode($question_id));
        }
    }
    public function answer_activate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $fetch = $this->login_model->fetch('discussion_forum_answer',$cond);
        $question_id = $fetch[0]['question_id'];
        $data=array(
            'status'=>1
            );
        $delete=$this->login_model->edit_cond('discussion_forum_answer',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Forum activated successfully!');
            redirect('admin/forum/view_answers/'.base64_encode($question_id));
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate forum!');
            redirect('admin/forum/view_answers/'.base64_encode($question_id));
        }
    }
    
}
