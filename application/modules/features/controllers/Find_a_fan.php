<?php

defined('BASEPATH') or exit('No direct script access allowed'); 

class Find_a_fan extends CI_Controller
{
    function __contruct()
    {
        parent::__construct();
        $this->load->model('features/M_features_fan');   
        $this->load->model('features/M_text');
        $this->load->model('features/M_user');  
        $this->load->model('M_user');
        $this->load->model('M_text');
        if(!isset($ac)){            
            //redirect('access');           
        } 
    }
    function index()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $data['show_table'] = $this->view_table();        
        $data['show'] = $this->M_features_fan->show_all();
        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data);
        $this->load->view('features/find_a_fan',$data);
        $this->load->view('includes/footer',$data);
    }
    public function view_table()
    {
        $this->load->model('features/M_features_fan');   
        
        $result = $this->M_features_fan->show_all();
        if($result != false)
        {
            return $result;
        } else{
            return "Database is empty!";
        }
    }
    
    public $_customkey;
    public function fan_search()
    {
        $this->load->model('features/M_features_fan');   
        $this->_customkey = $key = $this->input->post('search_text');
        
        if($key != "")
        {
            $result = $this->M_features_fan->search($key);
        
            if($result != false){
                $data['result_display']= $result;
            }else{
                $data['result_display'] = "No found !";
            }
        }else{
            $data = array('id_error_message' => "* enter in the field looking");
        }
        $data['user_data'] = $this->session->userdata('user_data');
        $data['show_table'] = $this->view_table();
        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data);
        $this->load->view('features/find_a_fan',$data);
        $this->load->view('includes/footer',$data);
    }
    

    
    public function fan_search_more()
    {
        $this->load->model('features/M_features_fan');   
        if($this->input->post('page'))    
        {
            //$key = $this->input->post('search_text');
            //$this->$result$this->$key=;
            $limit = $this->input->post('page')*12;
            $result = $this->M_features_fan->search_more($this->_customkey,$limit);
            $data['result_display'] = $result;
            $this->load->view('features/find_a_fan_more',$data);
        }
        
    }
}