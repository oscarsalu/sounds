<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class World_Wide_Featured extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->model('M_world_wide_featured');		
        $this->load->model('M_text');		  
        $ac = $this->session->userdata('access');
        if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        } 
	} 
    public function index()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        
        $data['background'] = $this->M_world_wide_featured->get_background();
        
        
        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data);
        $this->load->view('world_wide_featured',$data);
        $this->load->view('includes/footer',$data);
    }
}
