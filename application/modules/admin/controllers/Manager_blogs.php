<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Manager_blogs extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->is_login();
        $this->load->model('M_manager_blogs');          
    }  
    
    function is_login(){
        if($this->session->userdata('loged_in') == false && $this->session->userdata('is_admin') != 1){
            redirect('login');
		}
    }
    /**
    * View manager blogs
    **/ 
    public function index()
    {   
        $config['base_url'] = base_url()."admin/blogs";
        $config['per_page'] = 12; 
        $config['total_rows'] = $this->M_manager_blogs->num_blog_admin();
        $this->load->library('pagination', $config);
        $start  = $this->input->get('per_page');    
        if(empty($start)){
            $start = 1;
        }
        $data['listblogs']  = $this->M_manager_blogs->list_blog($config['per_page'],$start-1);              
        $user_id = $this->session->userdata('loged_in');        
        $data['user_data']  = $this->session->userdata('user_data');        
		$data['users']      = $this->M_manager_blogs->users($user_id);                               
        $data['list_users'] = $this->M_manager_blogs->list_users();                                    
        $data['genres']     =  $this->db->get('genres')->result_array();
        
        $blogs = $this->M_manager_blogs->getAllBlog();
        $data['spam_blogs'] = $this->M_manager_blogs->all_spam(12,0);  
        $data['blocked_blogs'] = $this->M_manager_blogs->getBlogBlocked(12,0);                     		  
        $this->template->load('admin_template', 'manager_blogs', $data); 
    }   
    /**
    * show all blog spam
    **/  
    public function all_spam(){
        $config['base_url'] = base_url()."admin/manager_blogs/all_spam";
        $config['per_page'] = 12; 
        $config['total_rows'] = $this->M_manager_blogs->num_spam();
        $this->load->library('pagination', $config);
        $start  = $this->input->get('per_page');    
        if(empty($start)){
            $start = 1;
        }
        $data['listblogs']  = $this->M_manager_blogs->all_spam($config['per_page'],$start-1);             
        $user_id = $this->session->userdata('loged_in');        
        $data['user_data']  = $this->session->userdata('user_data');
        $this->template->load('admin_template', 'blogs/all_blogs_spam', $data); 
    }
    /**
    * All blog blocked
    **/
    public function all_blocked(){
        $config['base_url'] = base_url()."admin/manager_blogs/all_blocked";
        $config['per_page'] = 1; 
        $config['total_rows'] = $this->M_manager_blogs->numBlogBlocked();
        $this->load->library('pagination', $config);
        $start  = $this->input->get('per_page');    
        if(empty($start)){
            $start = 1;
        }
        $data['listblogs']  = $this->M_manager_blogs->getBlogBlocked($config['per_page'],$start-1);             
        $user_id = $this->session->userdata('loged_in');        
        $data['user_data']  = $this->session->userdata('user_data');
        $this->template->load('admin_template', 'blogs/all_blogs_blocked', $data); 
    }
    /**
    * Create blogs 99sound
    **/
    public function create_blogs(){
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'max_length[255]|required');
        $this->form_validation->set_rules('introduction', 'Introduction', 'required|max_length[1500]');
        $this->form_validation->set_rules('content', 'Content', 'required|max_length[25000]');//max_length[1000]|required
        $user_id = $this->session->userdata('loged_in');
        $data = array();          
        if(!empty($_FILES['image_rep']['name']))
        {              
            $this->upload->initialize($this->config());
            if ($this->form_validation->run() != FALSE){   
                if (!$this->upload->do_upload('image_rep')){   
                    $data['update_error'] = $this->upload->display_errors();
                    echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                    echo  '<h4><strong>Error!</strong></h4>';
                    echo  '<p> '.$data['update_error'].'</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_error', $data['update_error']);
                    redirect('admin/blogs');
                } else{ 
                    $datafile = $this->upload->data();                    
                    $updateArr	= array(		                                        
                        'title'	             => $this->input->post('title'),
                        'introduction'	     => $this->input->post('introduction'),
                        'content'	         => $this->input->post('content'),
                        'time'		         => time(),
                        'user_id'	         => $user_id,
                        'image_rep'          => $datafile['file_name'],
                        'type'               => "admin"
        		    );
                    $this->db->insert('blogs',$updateArr);                 
                    echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                    echo  '<h4><strong>Succces!</strong></h4>';
                    echo  '<p> Post blog completed</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_msg', ' Post blog completed');  
                }                
            }else{
                 $this->session->set_flashdata('message_error', 'You enter the characters over limit'); 
            }
        }else{
            $this->session->set_flashdata('message_error', 'error');  
        }    
        redirect('admin/blogs');
    }
    /**
    * Update blogs
    **/
    public function update_blogs(){
        $user_id = $this->session->userdata('loged_in');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'max_length[255]|required');
        $this->form_validation->set_rules('introduction', 'Introduction', 'required|max_length[1500]');
        $this->form_validation->set_rules('content', 'Content', 'required|max_length[25000]');
        if ($this->form_validation->run() != FALSE){
            $id    =   $this->input->post('id');
            $updateArr	=array(		                                        
                'title'	     => $this->input->post('title'),
                'introduction'	     => $this->input->post('introduction'),
                'content'		 => $this->input->post('content'),
                'user_id'		 => $user_id,
		    );
            $this->db->update('blogs',$updateArr,'id ='.$id);
            $this->session->set_flashdata('message_msg', 'Edit successful blog'); 
        }
        redirect('admin/blogs');    
    }
    /**
    * Take down blog
    **/
    public function take_down(){ 
        $id = $this->input->post('id_blog');
        $redirect_url = $this->input->post('redirect');
        if(isset($id)){
            $this->M_manager_blogs->take_down($id);
            $this->session->set_flashdata('message_msg', 'success take down blog');    
        }else{
            $this->session->set_flashdata('message_erroe', 'error id');    
        }
        redirect($redirect_url);
    }  
    /**
    * Delete blog 
    **/
    public function delete_blogs(){   
        $id = $this->input->get_post('id');
        if(isset($id))
        {
            $this->db->where('id',$id)->delete('blogs');
            $this->session->set_flashdata('message_msg', 'delete successful blog');
        }else{
            $this->session->set_flashdata('message_erroe', 'error id');   
        }redirect('admin/blogs');   
    }   
    /**
    * Read details blogs
    **/    
    public function read_blog(){   
        $id = $this->input->get('id_blog');
        if(isset($id))
        {
            $data['user_data']  = $this->session->userdata('user_data');    
            $data['blog'] = $this->db->where('id',$id)->get('blogs')->row_array();
            $this->template->load('admin_template', 'blogs/read_blog', $data);
        }else{
            redirect('admin/blogs');
        }   
    }       
    /**
    * Config upload image blog
    **/
    public function config()
    {
        $loged_in = $this->session->userdata('loged_in');
        $config = array();
        $config['upload_path'] = './uploads/'.$loged_in.'/photo/blogs/';        
        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0777, true);
        }else{
            chmod($config['upload_path'], 0777);
        }
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '80000';
		//$config['max_width']  = '2000';
		//$config['max_height']  = '1080';
        $config['file_name'] = uniqid();
        
		return $config;
    }
    /**
    * Set keyword spam
    **/
    public function set_keyword(){
        $key = trim($this->input->post('keyword'));
        $check_key = $this->db->where('keyword',$key)->get('blogs_keyword')->result_array();
        if(!empty($check_key)){
            echo 'exist';
        }else{
            if(isset($key)){
                $insert = array(
                    'keyword' => $key,
                );
                $this->db->insert('blogs_keyword',$insert);
                echo 'sc'; 
            }                   
        }        
    }
    /**
    * Ajax Load data keyword blog
    **/
    public function loaddata(){
        $result = $this->M_manager_blogs->get_keyword();
        echo $result;
    }
    /**
    * Update keyword spam
    **/
    public function update_key(){
        $key    = trim($this->input->post('keyword'));
        $key_id = $this->input->post('id_key');              
        if(isset($key)){
            $updateArr = array(
                'keyword' => $key,
            );             
            if($this->db->where('id', $key_id)->update('blogs_keyword', $updateArr)){
                echo 'sc';    
            }
            
        }    
    }
    /**
    * Delete keyword
    **/
    public function delete_key(){
        $key_id = $this->input->post('id_key');              
        if(isset($key_id)){            
            if($this->db->where('id', $key_id)->delete('blogs_keyword')){
                echo 'sc';    
            }
        }    
    }
    /**
    * Unblock blog
    **/
    public function unblock(){
        $id = $this->input->post('id_blog');
        $redirect_url = $this->input->post('redirect');
        if(isset($id)){
            $this->M_manager_blogs->unblock($id);
            $this->session->set_flashdata('message_msg', 'success unblocked');    
        }else{
            $this->session->set_flashdata('message_erroe', 'error id');    
        }
        redirect($redirect_url);
    }
    /**
    * Accept blog
    **/
    public function accept(){
        $id = $this->input->get('id_blog');
        if(isset($id)){
            $updateArr = array(
                'blocked' => "2",
            );
            $this->db->update('blogs',$updateArr,array('id' => $id));
            $this->session->set_flashdata('message_msg', 'success accept blog');    
        }else{
            $this->session->set_flashdata('message_erroe', 'error id');    
        }
        redirect('admin/manager_blogs/all_spam');
    }
    
}