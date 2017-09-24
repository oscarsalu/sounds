<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_fan');
        $this->load->model('M_text');
        $ac = $this->session->userdata('access');
      
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
     * View top 100 fans.
     *
     * @param int $with_id
     */
    public function top_100_list()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $data['list_100'] = $this->M_fan->list_100();
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('fan/top_100_list', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * Ajax load more fan.
     */
    public function fan_load_more()
    {
        if ($this->input->post('page')) {
            $page = $this->input->post('page');
            $data['list_100'] = $this->M_fan->list_100($page);
            $this->load->view('fan/top_100_list_more', $data);
        }
    }
    /**
     * View Fan pics.
     */
    public function fan_pics()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('fan/fan_pics', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View Fan FLP.
     */
    public function flp()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $data['fantop'] = $this->db->select('*,u.id,a.filename as filesong, p.filename as filephoto,c.country as ctry')
            ->from('users as u')
            ->where('u.role != ', 1)
            ->where('u.is_admin != ', 1)
            ->join('photos as p', 'u.id = p.user_id', 'left')
            ->join('audio_song as a', 'u.id = a.user_id', 'left')
            ->join('countries as c', 'u.countries = c.id', 'left')
            ->group_by('u.id')
            ->order_by('u.id', 'DESC')
            ->limit(12, 0)
            ->order_by('u.id', 'ASC')
            ->get()->result_array();
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('fan/flp', $data);
        $this->load->view('includes/footer', $data);
    }
}
