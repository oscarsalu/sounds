<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fan_affiliate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
         $data['redirect_url']=$this->curPageURL();
       if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }
    }
    
     public function curPageURL() {
 $pageURL = 'http';
 if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) {
    $pageURL .= "s";
}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
 
}
    /**
     * View Fan affilaite.
     **/
    public function index()
    {
       
        $data['hhe'] = 10;

        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('fan_affiliate', $data);
        $this->load->view('includes/footer', $data);
    }
}
