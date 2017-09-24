<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Social_media.
 *
 * @author utkarsh
 */
class My_location extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->model('M_tour');
        $this->load->model('Events_model');
    }
    /**
     * View my location.
     **/
    public function index()
    {
        $data = null;
        $admin = $this->session->userdata('is_admin');
       //$this->load->view('includes/header', $data);
       // $this->load->view('includes/navbar', $data);
        $this->load->view('artist/my_location', $data);
       // $this->load->view('includes/footer', $data);
    }
}
