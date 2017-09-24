<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {
    public function index()
    {
        $data = array(
            // 'custom_header' => $this->_header(),
        );
        
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar');
        $this->load->view('account/login');
        $this->load->view('includes/footer');
    }
}
