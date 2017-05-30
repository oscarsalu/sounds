<?php
/**
 * PHP_CodeSniffer tokenizes PHP code and detects violations of a
 * defined set of coding standards.
 *
 * PHP version 5
 *
 * @category  PHP
 *
 * @author    sound99 <author@example.com>
 * @copyright 2016 99SOUND
 * @license   http://www.99SOUND.COM  PHP License 3.01   
 *
 * @link      http://pear.php.net/package/PackageName
 */
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Auth.
 * 
 * @category  PHP
 *
 * @author    sound99 <author@example.com>
 * @copyright 2016 GallerySoft
 * @license   http://www.99SOUND.COM  PHP License 3.01
 *
 * @version   2016
 *
 * @link      http://pear.php.net/package/PackageName
 */
class Chat_Members extends MX_Controller
{
    /**
     * Auth construct.
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->model('M_tour');
        $this->load->model('M_find_location');
        $this->load->model('Events_model');
        $this->load->model('M_notify');
        $this->load->model('M_channel');
        $this->load->helper('string');
        $this->load->model('M_text');
        $this->load->model('M_affiliate');
        
        $ac = $this->session->userdata('access');
        $data['redirect_url']=$this->curPageURL();
        if (!isset($ac)) {
            redirect("access?redirect_url=".$data['redirect_url']);
        }
        if ($this->session->userdata('loged_in') == false) {
            redirect('account/login');
        } else {
            $this->user_id = $this->session->userdata('loged_in');
            $user_data = $this->db->where('id='.$this->user_id)->get('users')->row_array();
        }
        $this->U_map = $this->session->userdata('U_map');
        if (!isset($ac)) {
            //redirect('access');
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
     * Auth::checkUser().
     * 
     * @param int $tour_id something
     * 
     * @return response
     */
    public function checkUser($tour_id)
    {
        $tour_data = $this->db->where('tour_id', $tour_id)->where('user_member', $this->user_id)->where('active', 1)->get('tours_member')->row_array();
        if (!isset($tour_data)) {
            redirect('the_total_tour');
        }
    }
    /**
     * Auth::index().
     * 
     * @param int $tour_id something
     * 
     * @return response
     */
    public function index($tour_id)
    {
        
       
        $this->checkUser($tour_id);
        $data['user_data'] = $this->session->userdata('user_data');
        
        $check = $this->M_tour->check_member_tour($data['user_data']['id'], $tour_id);
        if ($check == true) {
           
            $data['data_search'] = $this->session->tempdata('data_search');
            $this->session->unset_tempdata('data_search');
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
            echo $this->load->view('chat/new_chat', $data, true);
        } else {
            redirect('the_total_tour');
        }
    }
    /**
     * Auth::ajaxMessages().
     * 
     * @param int $with_id something
     * 
     * @return response
     */
    public function ajaxMessages($with_id)
    {
        include "APPPATH.'libraries/jchat/tour_chat/loader.php'";
        $post = $this->input->post('clientID');
        if (isset($post)) {
            // Get The Messages ID of the logged in clientID (user_id) and the one he sends to serverID (receiver)
            $messages_ids = $chat->get_messages_id($chat->clientID, $chat->serverID);
            if (!empty($messages_ids)) {
                foreach ($messages_ids as $message_id) {
                    if ($message_id['user_id'] == $chat->clientID) {
                        $class = 'client';
                        $user_id = $chat->clientID;
                        $username = $chat->client;
                    } else {
                        $class = 'server';
                        $user_id = $message_id['user_id'];
                        $username = $this->M_user->get_name($user_id);
                    }
                    $avata = $this->M_user->get_avata($user_id); ?>
                    <li class="<?php echo $class; ?>" id="<?php echo $message_id['id']; ?>">
                        <a href="#" title=""><img  alt="" width="50" height="50" src="<?php echo $avata; ?>" /> </a>
                        <div class="message-area">
                            <span class="pointer"></span>
                            <div class="info-row">
                                <span class="user-name"><a href="#"><strong><?php echo $username; ?></strong></a> says:</span>
                                <span class="time" id="<?php echo $message_id['id']; ?>"><?php echo $chat->get_messages_time($message_id['id']); ?></span>
                                <div class="clear"></div>
                            </div>
                            <p>
                                <?php echo $chat->get_messages($message_id['id']); ?>
                            </p>
                        </div>
                        <div class="clear"></div>
                    </li>
                    <?php

                }
            }
        }
    }
    /**
     * Auth::ajaxUpdate().
     * 
     * @param int $with_id something
     * 
     * @return response
     */
    public function ajax_update($with_id)
    {
        include "APPPATH.'libraries/jchat/tour_chat/loader.php'";
        $post = $this->input->post('update');
        if (isset($post)) {
            // Get Last Message
            $message = $chat->get_last_message();
            //var_dump($message);die;
            if (!isset($_SESSION['Channel_requested_id'][$with_id])) {
                $_SESSION['Channel_requested_id'][$with_id] = 0;
            }
            //echo $chat->clientID;
            //var_dump ($chat->clientID);			
            if (strlen($message['id']) !== 0 && $_SESSION['Channel_requested_id'][$with_id] !== $message['id']) {
                // Get Messages
                $messages_ids = $chat->get_messages_id($chat->clientID, $chat->serverID);
                // Check if is client or server
                if (!empty($messages_ids)) {
                    foreach ($messages_ids as $message_id) {
                        if ($message['id'] == $message_id['id']) {
                            if ($message_id['user_id'] == $chat->clientID) {
                                $class = 'client';
                                $user_id = $chat->clientID;
                                $username = $chat->client;
                            } else {
                                $class = 'server';
                                $user_id = $message_id['user_id'];
                                $username = $this->M_user->get_name($user_id);
                            }
                        }
                    }
                    $avata = $this->M_user->get_avata($user_id);
                    echo
                    '
					<li class="'.$class.'" id="'.$message['id'].'">
                        <a href="#" title=""><img height="50" width ="50" src="'.$avata.'" /></a>
                        <div class="message-area">
                            <span class="pointer"></span>
                            <div class="info-row">
                                <span class="user-name"><a href="#"><strong>'.$username.'</strong></a> says:</span>
                                <span class="time" id="'.$message['id'].'">'.$chat->get_messages_time($message['id']).'</span>
                                <div class="clear"></div>
                            </div>
    						<p>
                                '.$chat->get_messages($message['id']).'
    						</p>
                        </div>
                        <div class="clear"></div>
                    </li>';
                }
            }
            $_SESSION['Channel_requested_id'][$with_id] = $message['id'];
        }
    }
    /**
     * Auth::ajaxSend().
     * 
     * @param int $with_id something
     * 
     * @return response
     */
    public function ajaxSend($with_id)
    {
        include "APPPATH.'libraries/jchat/tour_chat/loader.php'";
        $post = $this->input->post('message');
        if (isset($post)) {
            // Insert Message
            $message = $post;
            $message_set_id = $chat->set_message($post);
            // Get Messages
            $messages_ids = $chat->get_messages_id($chat->clientID, $chat->serverID);
            // Check if is client or server
            if (!empty($messages_ids)) {
                foreach ($messages_ids as $message_id) {
                    if ($message_id['id'] == $message_set_id) {
                        if ($message_id['user_id'] == $chat->clientID) {
                            $class = 'client';
                            $user_id = $chat->clientID;
                            $username = $chat->client;
                        } else {
                            $class = 'server';
                            $user_id = $message_id['user_id'];
                            $username = $this->M_user->get_name($user_id);
                        }
                    }
                }
                $avata = $this->M_user->get_avata($user_id);
                echo
                '
                <li class="'.$class.'" id="'.$message_set_id.'">
                    <a href="#" title="'.$username.'"><img width="50" height="50" src="'.$avata.'" alt="'.$username.'" /></a>
                    <div class="message-area">
                        <span class="pointer"></span>
                        <div class="info-row">
                            <span class="user-name"><a href="#"><strong>'.$username.'</strong></a> says:</span>
                            <span class="time" id="'.$message_set_id.'">'.$chat->get_messages_time($message_set_id).'</span>
                            <div class="clear"></div>
                        </div>
                        <p>
                            '.$chat->get_messages($message_set_id).'
                        </p>
                    </div>
                    <div class="clear"></div>
                </li>
                ';
            }
        }
    }
}
