<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model'); 
        $this->load->model('M_user');
        $this->load->model('M_audio_song');
        $this->load->model('M_affiliate');
        $this->load->model('M_blog');
        $this->load->model('M_channel');
        
        $this->load->model('M_text');
        $this->load->model('M_notify');
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
     * View chat on AMPER.
     **/
    public function index()
    {
       
        $data['user_data'] = $this->session->userdata('user_data');
        $data['avata'] = $this->M_user->get_avata($data['user_data']['id']);
        $data['friends'] = $this->M_user->friends($data['user_data']['id']);
        $data['groups'] = $this->M_user->groups($data['user_data']['id']);
        $data['invite_contacts'] = $this->M_user->invite_contact($data['user_data']['id'], 0);
        $data['U_map'] = $this->U_map;
        $data['recent_chat'] = $this->M_affiliate->get_recent_chat($data['user_data']['id']);
        $data['public_channels'] = $this->M_channel->get_all_public_channels();
        $data['tour_channels'] = $this->M_channel->get_private_channel_user_id($data['user_data']['id'], 'tour');
        $data['band_channel'] = $this->M_channel->get_private_channel_user_id($data['user_data']['id'], 'band');
        $data['affiliates_channel'] = $this->M_channel->check_artist_affiliates_channel($data['user_data']['id'], 'affiliates');
        $data['list_artist'] = $this->M_affiliate->get_list_artist($data['U_map']['affiliate_id'], 12, 0);
        $data['list_level_1'] = $this->M_affiliate->get_list_level(1, $data['user_data']['id'], 12, 0);
        $data['list_level_2'] = $this->M_affiliate->get_list_level(2, $data['user_data']['id'], 12, 0);
        $data['list_level_3'] = $this->M_affiliate->get_list_level(3, $data['user_data']['id'], 12, 0);
        $data['list_level_4'] = $this->M_affiliate->get_list_level(4, $data['user_data']['id'], 12, 0);
        $data['list_chat']    = $this->M_affiliate->get_recent_chat($data['user_data']['id']);
        
        $get_affilate = $this->M_affiliate->get_affilaite_id($data['user_data']['id']);
        
        $data['dataChannel1'] = $this->M_channel->get_affilaiate($data['user_data']['id'], 1);
        
        $data['dataChannel2'] = $this->M_channel->get_affilaiate($data['user_data']['id'], 2);
        $data['dataChannel3'] = $this->M_channel->get_affilaiate($data['user_data']['id'], 3);
        $data['dataChannel4'] = $this->M_channel->get_affilaiate($data['user_data']['id'], 4);
        
        $datareturn = array();
        $data['link_content'] = 'chat1.php';
        
        if ($this->input->is_ajax_request()) {
            // check if request comes from an ajax
            // $this->load->view('amper/chat.php', $data);
            $this->load->view('chat/new_chat', $data, true);
        } else {
            $data['user_data'] = $this->db->get_where('users', array('id' => $this->U_map['user_id']))->row_array();
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('amper/dashboard_amper.php', $data);
            $this->load->view('includes/footer', $data);
        }
    }
    /**
     * Ajax load list affliate.
     **/
    public function load_list_level()
    {
        $id_level = $this->input->post('level');
        $page = $this->input->post('page');
        $user_id = $this->U_map['user_id'];
        $data = $this->M_affiliate->get_list_level($id_level, $user_id, $page, 12);
        $res = array();
        foreach ($data as $row) {
            $res[] =
            '<li>'.
                '<a href="javascript:;" onclick="load_iframe(\''.$row->id.'\');" >'.
                '<div class="media">'.
                        '<div class="media-left thumb thumb-sm">'.
                            '<img class="media-object img-circle" src="'.$this->M_user->get_avata($row->id).'">'.
                        '</div>'.
                        '<div class="media-body">'.
                            '<p class="media-heading">'.
                                '<span class="text-strong">'.$this->M_user->get_name($row->id).'</span>'.
                                '<small class="text-muted pull-right">16:54, 24.11.2014</small>'.
                            '</p>'.
                            '<div class="chat-actions pull-right">
								<span class="mark-readed"><i class="fa fa-circle-o"></i></span>
								<span class="archive"><i class="fa fa-times"></i></span>
							</div>
                        </div>'.
                    '</div>'.
                '</a>'.
            '</li>';
        }
        if (count($res)) {
            echo json_encode($res);
        } else {
            header('HTTP/1.1 500 ');
        }
    }
    /**
     * Ajax load list artist.
     **/
    public function load_artist_chat()
    {
        $id_level = $this->input->post('level');
        $page = $this->input->post('page');
        $user_id = $this->U_map['user_id'];
        $data = $this->M_affiliate->get_list_artist($this->U_map['affiliate_id'], $page, 12);
        $res = array();
        foreach ($data as $row) {
            $res[] =
            '<li>'.
                '<a href="javascript:;" onclick="load_iframe_artist(\''.$this->M_affiliate->get_affilaite_id($row).'\');" >'.
                '<div class="media">'.
                        '<div class="media-left thumb thumb-sm">'.
                            '<img class="media-object img-circle" src="'.$this->M_user->get_avata($row).'">'.
                        '</div>'.
                        '<div class="media-body">'.
                            '<p class="media-heading">'.
                                '<span class="text-strong">'.$this->M_user->get_name($row).'</span>'.
                                '<small class="text-muted pull-right">16:54, 24.11.2014</small>'.
                            '</p>'.
                            '<div class="chat-actions pull-right">
								<span class="mark-readed"><i class="fa fa-circle-o"></i></span>
								<span class="archive"><i class="fa fa-times"></i></span>
							</div>
                        </div>'.
                    '</div>'.
                '</a>'.
            '</li>';
        }
        if (count($res)) {
            echo json_encode($res);
        } else {
            header('HTTP/1.1 500 ');
        }
    }
     /**
      * Ajax load recent chat.
      **/
     public function load_recent_chat()
     {
         $page = $this->input->post('page');
         $user_id = $this->U_map['user_id'];
         $data = $this->M_affiliate->get_recent_chat($user_id, $page, 12);
         $res = array();
         foreach ($data as $row) {
             if ($user_id == $row->receiver) {
                 $num_unread = $this->M_affiliate->total_chat_unread($row->user_id, $row->receiver);
                 $res[] =
                '<li>'.
                    '<a href="javascript:;" onclick="load_iframe(\''.$row->user_id.'\');" >'.
                    '<div class="media">'.
                            '<div class="media-left thumb thumb-sm">'.
                                '<img class="media-object img-circle" src="'.$this->M_user->get_avata($row->user_id).'">'.
                            '</div>'.
                            '<div class="media-body">'.
                                '<p class="media-heading">'.
                                    '<span class="text-strong">'.$this->M_user->get_name($row->user_id).'</span>'.
                                    '<span class="badge bg-lightred">'.$num_unread.'</span>'.
                                    '<small class="text-muted pull-right">'.time_calculation($row->max_time).'</small>'.
                                '</p>'.
                                '<div class="chat-actions pull-right">
    								<span class="mark-readed"><i class="fa fa-circle-o"></i></span>
    								<span class="archive"><i class="fa fa-times"></i></span>
    							</div>
                            </div>'.
                        '</div>'.
                    '</a>'.
                '</li>';
             } else {
                 $res[] =
                '<li>'.
                    '<a href="javascript:;" onclick="load_iframe(\''.$row->receiver.'\');" >'.
                    '<div class="media">'.
                            '<div class="media-left thumb thumb-sm">'.
                                '<img class="media-object img-circle" src="'.$this->M_user->get_avata($row->receiver).'">'.
                            '</div>'.
                            '<div class="media-body">'.
                                '<p class="media-heading">'.
                                    '<span class="text-strong">'.$this->M_user->get_name($row->receiver).'</span>'.
                                    '<small class="text-muted pull-right">'.time_calculation($row->max_time).'</small>'.
                                '</p>'.
                                '<div class="chat-actions pull-right">
    								<span class="mark-readed"><i class="fa fa-circle-o"></i></span>
    								<span class="archive"><i class="fa fa-times"></i></span>
    							</div>
                            </div>'.
                        '</div>'.
                    '</a>'.
                '</li>';
             }
         }
         if (count($res)) {
             echo json_encode($res);
         } else {
             header('HTTP/1.1 500 ');
         }
     }
}
