<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Find_a_show extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('M_text');
         $this->load->model('M_user');
        $ac = $this->session->userdata('access');
        if(!isset($ac)){            
            redirect('access');           
        } 
       
    }
    function index()
    {

        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data);
        $this->load->view('features/find_a_show',$data);
        $this->load->view('includes/footer',$data);
    }
}