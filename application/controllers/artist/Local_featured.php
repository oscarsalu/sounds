<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Local_featured extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_local_featured');
        $this->load->model('M_user');
        $this->load->model('M_audio_song');
        $ac = $this->session->userdata('access');
      
         $data['redirect_url']=$this->curPageURL();
        if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }
        $this->load->model('M_user');
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
     * View local featured.
     **/
    public function index()
    {
        $this->load->library('geoplugin');

        $this->geoplugin->locate();

        $city = $this->geoplugin->city;
        $data['cityartist'] = $this->geoplugin->city;
        $data['country'] = $this->geoplugin->countryName;

        $data['city'] = $this->M_local_featured->get_all_artist_city_home($city, 0);
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/local_featured', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * load more local.
     **/
    public function local_featured_load_more()
    {
        $xml = simplexml_load_file('http://www.geoplugin.net/xml.gp?ip='.$this->getRealIpAddr());
        $city = $xml->geoplugin_city;
        $limit = $this->input->post('page') * 6;
        $data['city'] = $this->M_local_featured->get_all_artist_city($city, $limit);
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('artist/local_featured_load_more', $data);
    }
    /**
     * get real ip address.
     **/
    public function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
        $this->index();
    }
}
