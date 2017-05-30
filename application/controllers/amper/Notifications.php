<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Notifications extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->model('M_user');
        $this->load->model('M_audio_song');
        $this->load->model('M_affiliate');
        $this->load->model('M_blog');
        $this->load->helper('string');
       $ac = $this->session->userdata('access');
      
         $data['redirect_url']=$this->curPageURL();
       if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }
        $this->U_map = $this->session->userdata('U_map');
        $this->is_login();
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
    public $U_map;
    public function is_login()
    {
        $U_map = $this->U_map;
        $uers_data = $this->session->userdata('user_data');
        if ($this->input->is_ajax_request()) {
            if (!isset($U_map)) {
                $this->session->set_flashdata('message_error', '<b>Error</b>! You Not Login Account');
                redirect('account/login');
                die;
            }
        } else {
            if (!isset($U_map)) {
                header('HTTP/1.1 401 	Unauthorized');
                die;
            }
        }
    }
    /**
     * View notifications on AMPer.
     **/
    public function index()
    {
        $data['U_map'] = $this->U_map;
        $data['link_content'] = 'notifications.php';
        if ($this->input->is_ajax_request()) {
            // check if request comes from an ajax
            $this->load->view('amper/notifications.php', $data);
        } else {
            $data['user_data'] = $this->db->get_where('users', array('id' => $this->U_map['user_id']))->row_array();
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('amper/dashboard_amper.php', $data);
            $this->load->view('includes/footer', $data);
        }
    }
    /**
     * Ajax on off notification.
     **/
    public function onoff_notifi()
    {
        $check = $this->input->post('checked');
        $type = $this->input->post('type');
        if ($type == 'sales') {
            if ($check == 'true') {
                $update['onoffsales'] = '1';
            } else {
                $update['onoffsales'] = '0';
            }
            $this->db->where('id', $this->U_map['user_id'])
            ->update('users', $update);
        } elseif ($type == 'request') {
            if ($check == 'true') {
                $update['onoff_request'] = '1';
            } else {
                $update['onoff_request'] = '0';
            }
            $this->db->where('id', $this->U_map['user_id'])
            ->update('users', $update);
        }
    }
}
