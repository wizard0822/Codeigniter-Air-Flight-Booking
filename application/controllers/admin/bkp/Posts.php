<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('login_model');

	}
	public function index(){
        $usertype=$this->session->userdata('admin_data');
        $cond = "AND status < 5 order by id desc";
        $posts = $this->login_model->fetch('posts', $cond);
        foreach ($posts as $key => $value) {
            # code...
            $cat_id = $value['cat_id'];
            $cond1 = "AND id='$cat_id' AND status < 5";
            $category = $this->login_model->fetch('category', $cond1);
            $user_id = $value['user_id'];
            $cond2 = "AND id='$user_id' AND status < 5";
            $user = $this->login_model->fetch('users', $cond2);
            $posts[$key]['category_name']=$category[0]['category_name'];
            $posts[$key]['user_name']=$user[0]['display_name'];
        }
        $this->data['list'] = $posts;
        $this->get_include();
        $this->load->view($this->viewDir."posts/listing",$this->data);
    }

    public function view($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $view=$this->login_model->fetch('posts',$cond);

        $cat_id = $view[0]['cat_id'];
        $cond1 = "AND id='$cat_id' AND status < 5";
        $category = $this->login_model->fetch('category', $cond1);

        $user_id = $view[0]['user_id'];
        $cond2 = "AND id='$user_id' AND status < 5";
        $user = $this->login_model->fetch('users', $cond2);
        $view[0]['category_name']=$category[0]['category_name'];
        $view[0]['user_name']=$user[0]['display_name'];
        $this->data['value'] = $view[0];
        $this->get_include();
        $this->load->view($this->viewDir."posts/view",$this->data);
    }

    public function view_comments($id){
        $id=base64_decode($id);
        $cond1="AND id='$id'";
        $post=$this->login_model->fetch('posts',$cond1);
        $cond="AND post_id='$id' AND status<5";
        $comments=$this->login_model->fetch('comment',$cond);
        foreach ($comments as $key => $value) {
            # code...
            $user_id = $value['user_id'];
            $cond2 = "AND id='$user_id' AND status < 5";
            $user = $this->login_model->fetch('users', $cond2);
            $comments[$key]['user_name']=$user[0]['display_name'];
        }
       
        $this->data['list'] = $comments;
        $this->data['post'] = $post[0];
        $this->get_include();
        $this->load->view($this->viewDir."posts/view_comments",$this->data);
    }
    
    public function delete($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $cond1="AND post_id='$id'";
        $data=array(
            'status'=>5
            );
        $delete=$this->login_model->edit_cond('posts',$data,$cond);
        $delete1=$this->login_model->edit_cond('comment',$data,$cond1);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Post deleted successfully!');
            redirect('admin/posts');
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete post!');
            redirect('admin/posts');
        }
    }
    public function inactivate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array( 
            'status'=>2,
            'admin_inactive' => 1
            );
        $delete=$this->login_model->edit_cond('posts',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Post deactivated successfully!');
            redirect('admin/posts');
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate Post!');
            redirect('admin/posts');
        }
    }
    public function activate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array(
            'status'=>1,
            'admin_inactive' => 0
            );
        $delete=$this->login_model->edit_cond('posts',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Post activated successfully!');
            redirect('admin/posts');
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate Post!');
            redirect('admin/posts');
        }
    }
    public function unfeatured($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array(
            'featured'=>0
            );
        $delete=$this->login_model->edit_cond('posts',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Post unfeatured successfully!');
            redirect('admin/posts');
        }else{
            $this->session->set_flashdata('err_message', 'Error to unfeatured Post!');
            redirect('admin/posts');
        }
    }
    public function featured($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $data=array(
            'featured'=>1
            );
        $delete=$this->login_model->edit_cond('posts',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Post featured successfully!');

            redirect('admin/posts');
        }else{
            $this->session->set_flashdata('err_message', 'Error to featured Post!');

            redirect('admin/posts');
        }
    }

    public function comment_delete($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $fetch = $this->login_model->fetch('comment',$cond);
        $post_id = $fetch[0]['post_id'];
        $data=array(
            'status'=>5
            );
        $delete=$this->login_model->edit_cond('comment',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Comment deleted successfully!');
            redirect('admin/posts/view_comments/'.base64_encode($post_id));
        }else{
            $this->session->set_flashdata('err_message', 'Error to delete comment!');
            redirect('admin/posts/view_comments/'.base64_encode($post_id));
        }
    }
    public function comment_inactivate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $fetch = $this->login_model->fetch('comment',$cond);
        $post_id = $fetch[0]['post_id'];
        $data=array( 
            'status'=>2
            );
        $delete=$this->login_model->edit_cond('comment',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Comment deactivated successfully!');
            redirect('admin/posts/view_comments/'.base64_encode($post_id));
        }else{
            $this->session->set_flashdata('err_message', 'Error to deactivate Comment!');
            redirect('admin/posts/view_comments/'.base64_encode($post_id));
        }
    }
    public function comment_activate($id){
        $id=base64_decode($id);
        $cond="AND id='$id'";
        $fetch = $this->login_model->fetch('comment',$cond);
        $post_id = $fetch[0]['post_id'];
        $data=array(
            'status'=>1
            );
        $delete=$this->login_model->edit_cond('comment',$data,$cond);
        if($delete){
            $this->session->set_flashdata('sess_message', 'Comment activated successfully!');
            redirect('admin/posts/view_comments/'.base64_encode($post_id));
        }else{
            $this->session->set_flashdata('err_message', 'Error to activate Comment!');
            redirect('admin/posts/view_comments/'.base64_encode($post_id));
        }
    }
    
}
