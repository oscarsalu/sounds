<?php

defined('BASEPATH') or exit('No direct script access allowed'); 

class Find_an_artist extends CI_Controller{
    function __construct(){
        parent::__construct();
        $ac = $this->session->userdata('access');
        if(!isset($ac)){            
           // redirect('access');           
        } 
        $this->load->model('M_user');
        $this->load->model('M_text');
        $this->load->model('features/M_features_artist');
    }
    
    function index()
    {
        $admin = $this->session->userdata('is_admin');
        if(isset($admin) && $admin == 1){
            $data['is_admin'] = $admin;
        }
        $data['user_data'] = $this->session->userdata('user_data');
        $data['showall'] = $this->M_features_artist->showall();     
        $data['top_hot_artist'] = $this->M_features_artist->top_hot_artist();     
        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data);
        $this->load->view('features/find_an_artist',$data);
        $this->load->view('includes/footer',$data);
    }
    
    public function artist_search()
    {
        $key = $this->input->post('search_text');  
        if($key!="")
        {
            $result = $this->M_features_artist->search($key);
            
            if($result != false)
            {
                $data['result_display'] = $result;
                
            }else{
                
                $data['result_display'] = "No found!";
                
            }
            
        }else{
            $data['error_msg'] = "* enter in the field looking";
        }
        $data['user_data'] = $this->session->userdata('user_data');
        $data['top_hot_artist'] = $this->M_features_artist->top_hot_artist();     
        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data);
        $this->load->view('features/find_an_artist',$data);
        $this->load->view('includes/footer',$data);
    }
}