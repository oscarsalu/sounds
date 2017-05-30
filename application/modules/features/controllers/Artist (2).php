<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist extends MX_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('M_features_artist');   
    }  
    
    public function index()
    {
        $data['background'] = $this->M_features_artist->get_background();
        
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('features/artist', $data);
        $this->load->view('includes/footer', $data);
    }
}
