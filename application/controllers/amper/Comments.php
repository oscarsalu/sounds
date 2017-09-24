<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Comments extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_comment');
        $this->load->model('M_audio_song');
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
            }
        } else {
            if (!isset($U_map)) {
                header('HTTP/1.1 401 	Unauthorized');
                die;
            }
        }
    }
    /**
     * Memember comment on FLP
     * insert comment to database table comments.
     **/
    public function membercomment()
    {
        $user_id = $this->session->userdata('loged_in');
        if (!isset($user_id)) {
            redirect('account/login');
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('comment', 'comment', 'required|max_length[1000]');
            $this->form_validation->set_rules('id_flp', 'id_flp', 'required');
            $id_flp = $this->input->post('id_flp');
            $home_page = $this->M_user->get_home_page($id_flp);
            if ($this->form_validation->run() != false) {
                $insertArr = array(
                    'user_id' => $id_flp,
                    'client' => $user_id,
                    'comment' => strip_tags($this->input->post('comment'), '<p><b>'),
                    'approve' => 1,
                    'type' => 'FLP',
                    'time' => time(),
                );
                $this->db->insert('comments', $insertArr);
                $this->session->set_flashdata('message_msg', 'comment success');
                //add notifycation
                if ($id_flp != $user_id) {
                    $this->M_notify->addnotify($id_flp, 'You have comment on FLP', 'flp_comment');
                }
            } else {
                $this->session->set_flashdata('message_error', validation_errors());
            }
            redirect('amp/'.$home_page);
        }
    }
    /**
     * Memember comment on page allcomment
     * insert comment to database table comments.
     **/
    public function member_post_comment()
    {
        $user_id = $this->session->userdata('loged_in');
        if (!isset($user_id)) {
            redirect('account/login');
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('comment', 'comment', 'required|max_length[1000]');
            $this->form_validation->set_rules('id_flp', 'id_flp', 'required');
            $id_flp = $this->input->post('id_flp');
            $home_page = $this->M_user->get_home_page($id_flp);
            if ($this->form_validation->run() != false) {
                $insertArr = array(
                    'user_id' => $id_flp,
                    'client' => $user_id,
                    'comment' => strip_tags($this->input->post('comment'), '<p><b>'),
                    'approve' => 1,
                    'type' => 'FLP',
                );
                $this->db->insert('comments', $insertArr);
                $this->session->set_flashdata('message_msg', 'comment success');
                //add notifycation
                if ($id_flp != $user_id) {
                    $this->M_notify->addnotify($id_artist, 'You have comment on FLP', 'flp_comment');
                }
            } else {
                $this->session->set_flashdata('message_error', validation_errors());
            }
            redirect('amper/allcomment/'.$home_page);
        }
    }
    /**
     * view 
     * show all comment on FLP.
     **/
    public function allcomment($home_page)
    {
        $data['user_current'] = $this->M_user->get_user_by_homepage($home_page);
        if (!empty($data['user_current'])) {
            $config['per_page'] = 12;
            $config['base_url'] = base_url().'amper/allcomment/'.$home_page;
            $start = $this->input->get('per_page');
            if (empty($start)) {
                $start = 0;
            }
            $config['total_rows'] = $this->M_comment->num_comments_flp($data['user_current']->id);
            $this->load->library('pagination', $config);
            $this->pagination->initialize($config);
            $data['comments'] = $this->M_comment->all_comment_flp($data['user_current']->id, $config['per_page'], $start);
            $data['user_data'] = $this->session->userdata('user_data');
            $data['homepage'] = $home_page;
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('amper/all_comment', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->session->set_flashdata('message_error', 'can not find data'.$home_page);
            redirect();
        }
    }
}
