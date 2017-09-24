<?php

defined('BASEPATH') or exit('No direct script access allowed'); 

class New_trending extends CI_Controller
{
    function construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        $data['user_data'] = $this->session->userdata('user_data');  
        $data['a'] = 123;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data);
        $this->load->view('features/new_trending',$data);
        $this->load->view('includes/footer',$data);
    }
}