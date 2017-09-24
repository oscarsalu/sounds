<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Channel extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_photo');
        $this->load->model('M_user');
        $this->load->model('M_channel');
        $this->load->model('M_chat_keyword');
        $this->load->model('M_notify');
        $this->load->model('M_affiliate');
        
        $this->U_map = $this->session->userdata('U_map');
        if ($this->session->userdata('loged_in') == false) {
            redirect('account/login');
        }
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
     * View Chat publish.
     *
     * @param int $key_artist
     */
    public function index($id)
    {

        $data['with_id'] = $id;
        $data['user_data'] = $this->session->userdata('user_data');
        $_SESSION['jChat_username'] = 'Channel '.$this->M_channel->get_channel_name($id);
        $_SESSION['jChat_type'] = $this->M_channel->get_channel_type($id);
        $_SESSION['jChat_nameclient'] = $this->M_user->get_name($data['user_data']['id']);
        $_SESSION['artist_id'] = $this->M_channel->get_channel_user_id($id);
        $_SESSION['jChat_idclient'] = $data['user_data']['id'];
        $this->load->view('includes/header', $data);
        $this->load->view('chat/channel', $data);
        
    }
    /**
     * Ajax load messages.
     *
     * @param int $with_id
     */
    public function ajax_messages($with_id)
    {
        include APPPATH.'libraries/jchat/channel/loader.php';
        $post = $this->input->post('clientID');
        $loged_in = $this->session->userdata('loged_in');

        if (isset($post)) {
            // Get The Messages ID of the logged in clientID (user_id) and the one he sends to serverID (receiver)
            $messages_ids = $chat->get_messages_id($chat->clientID, $chat->serverID);
            if (!empty($messages_ids)) 
            {
                foreach ($messages_ids as $message_id) 
                {
                    if ($message_id['user_id'] == $chat->clientID) 
                    {
                        $class = 'client';
                        $user_id = $chat->clientID;
                        $username = $chat->client;
                        $class_new = 'right';
                        $class_new_image = 'profile-photo-sm  pull-right';
                    } else 
                    {
                        $class = 'server';
                        $user_id = $message_id['user_id'];
                        $username = $this->M_user->get_name($user_id);
                        $class_new = 'left';
                        $class_new_image = 'profile-photo-sm  pull-left';
                        
                    }
                    if($this->M_user->get_user_role($user_id) == 1)
                    {
                        $avata = $this->M_user->get_avata($user_id);
                    }
                    else{
                        $avata = $this->M_user->get_avata_flp($user_id);
                    }
                    if($chat->type == 'affiliates')
                    {
                        if($chat->artist_id == $loged_in)
                        {

                     ?>
                     <!-- <li class="<?php echo $class; ?>" id="<?php echo $message_id['id']; ?>">
                        <a href="#" title=""><img  alt="" class="img img-circle" width="50" height="50" src="<?php echo $avata; ?>" /> </a>   
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
                    </li> -->
                    <li class="<?php echo $class_new; ?>"> 
                        <img src="<?php echo $avata; ?>" alt="" class="<?php echo $class_new_image; ?>" />
                        <div class="chat-item">
                            <div class="chat-item-header">
                                <h5 style="text-align:justify;"><?php echo $username; ?></h5>
                                <small class="text-muted"><?php echo $chat->get_messages_time($message_id['id']); ?></small>
                            </div>
                            <p><?php echo $chat->get_messages($message_id['id']); ?></p>
                        </div>
                    </li>
                    <?php }
                    else
                    { 
                        ?>
                   <!--  <li class="<?php echo $class; ?>" style="<?php if(($chat->clientID != $message_id['user_id']) && ($chat->artist_id != $message_id['user_id'])){echo "display: none;";}?>" id="<?php echo $message_id['id']; ?>">
                        <a href="#" title=""><img  alt="" class="img img-circle" width="50" height="50" src="<?php echo $avata; ?>" /> </a>   
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
                    </li> -->
                    <li class="<?php echo $class_new; ?>" style="<?php if(($chat->clientID != $message_id['user_id']) && ($chat->artist_id != $message_id['user_id'])){echo "display: none;";}?>> 
                        <img src="<?php echo $avata; ?>" alt="" class="<?php echo $class_new_image; ?>" />
                        <div class="chat-item">
                            <div class="chat-item-header">
                                <h5 style="text-align:justify;"><?php echo $username; ?></h5>
                                <small class="text-muted"><?php echo $chat->get_messages_time($message_id['id']); ?></small>
                            </div>
                            <p><?php echo $chat->get_messages($message_id['id']); ?></p>
                        </div>
                        
                    </li>
                    <?php
                    } 
                    }else{ //affilaites
                    ?>
    				<!-- <li class="<?php echo $class; ?>" id="<?php echo $message_id['id']; ?>">
                        <a href="#" title=""><img  alt="" class="img img-circle" width="50" height="50" src="<?php echo $avata; ?>" /> </a>   
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
    				</li> -->
                    <li class="<?php echo $class_new; ?>" > 
                        <img src="<?php echo $avata; ?>" alt="" class="<?php echo $class_new_image; ?>" />
                        <div class="chat-item">
                            <div class="chat-item-header">
                                <h5 style="text-align:justify;"><?php echo $username; ?></h5>
                                <small class="text-muted"><?php echo $chat->get_messages_time($message_id['id']); ?></small>
                            </div>
                            <p><?php echo $chat->get_messages($message_id['id']); ?></p>
                        </div>
                        
                    </li>
    				<?php
                    }
                }
            }
        }
    }
     /**
      * Ajax update messages.
      *
      * @param int $with_id
      */
     public function ajax_update($with_id)
     {

         include APPPATH.'libraries/jchat/channel/loader.php';
         $post = $this->input->post('update');
         if (!empty($post)) 
         {
             // Get Last Message
            $message = $chat->get_last_message();
            //var_dump($message);die;
            if (!isset($_SESSION['Channel_requested_id'][$with_id])) 
            {
                $_SESSION['Channel_requested_id'][$with_id] = 0;
            }
            //echo $chat->clientID;
            //var_dump ($chat->clientID);			
            if (strlen($message['id']) !== 0 && $_SESSION['Channel_requested_id'][$with_id] !== $message['id']) 
            {
                // Get Messages
                $messages_ids = $chat->get_messages_id($chat->clientID, $chat->serverID);

                // Check if is client or server
                if (!empty($messages_ids)) 
                {
                    foreach ($messages_ids as $message_id) 
                    {
                        if ($message['id'] == $message_id['id']) {
                            if ($message_id['user_id'] == $chat->clientID) {
                                $class = 'client';
                                $user_id = $chat->clientID;
                                $username = $chat->client;
                                $class_new = 'right';
                                $class_new_image = 'profile-photo-sm pull-right';
                            } else {
                                $class = 'server';
                                $user_id = $message_id['user_id'];
                                $username = $this->M_user->get_name($user_id);
                                $class_new = 'left';
                                $class_new_image = 'profile-photo-sm pull-left';
                            }
                        }
                    }
                    if($this->M_user->get_user_role($user_id) == 1)
                    {
                        $avata = $this->M_user->get_avata($user_id);
                    }
                    else{
                        $avata = $this->M_user->get_avata_flp($user_id);
                        }

                    if($chat->type == 'affiliates')
                    {
                        if($chat->artist_id == $loged_in)
                        {
                            //  echo
                            // '
                            // <li class="'.$class.'" id="'.$message['id'].'">
                            //     <a href="" title=""><img class="img img-circle" height="50" width ="50" src="'.$avata.'" /></a>
                            //     <div class="message-area">
                            //         <span class="pointer"></span>
                            //         <div class="info-row">
                            //             <span class="user-name"><a href="#"><strong>'.$username.'</strong></a> says:</span>
                            //             <span class="time" id="'.$message['id'].'">'.$chat->get_messages_time($message['id']).'</span>
                            //             <div class="clear"></div>
                            //         </div>
                            //         <p>
                            //             '.$chat->get_messages($message['id']).'
                            //         </p>
                            //     </div>
                            //     <div class="clear"></div>
                            // </li>
                            // '; 
                            echo '<li class="'.$class_new.'" > 
                                <img src="'.$avata.'" alt="" class="'.$class_new_image.'" />
                                <div class="chat-item">
                                    <div class="chat-item-header">
                                        <h5 style="text-align:justify;">'.$username.'</h5>
                                        <small class="text-muted">'.$chat->get_messages_time($message['id']).'</small>
                                    </div>
                                    <p>'.$chat->get_messages($message['id']).'</p>
                                </div>
                                
                            </li>';
                        }
                        else
                        { 
                            if(($chat->clientID != $message_id['user_id']) && ($chat->artist_id != $message_id['user_id'])){$style =  "display: none;";}
                            //    echo
                            // '
                            // <li class="'.$class.'" id="'.$message['id'].'" style="'.$style.'">
                            //     <a href="" title=""><img class="img img-circle" height="50" width ="50" src="'.$avata.'" /></a>
                            //     <div class="message-area">
                            //         <span class="pointer"></span>
                            //         <div class="info-row">
                            //             <span class="user-name"><a href="#"><strong>'.$username.'</strong></a> says:</span>
                            //             <span class="time" id="'.$message['id'].'">'.$chat->get_messages_time($message['id']).'</span>
                            //             <div class="clear"></div>
                            //         </div>
                            //         <p>
                            //             '.$chat->get_messages($message['id']).'
                            //         </p>
                            //     </div>
                            //     <div class="clear"></div>
                            // </li>
                            // ';
                            echo '<li class="'.$class_new.'" style="'.$style.'"> 
                                <img src="'.$avata.'" alt="" class="'.$class_new_image.'" />
                                <div class="chat-item">
                                    <div class="chat-item-header">
                                        <h5 style="text-align:justify;">'.$username.'</h5>
                                        <small class="text-muted">'.$chat->get_messages_time($message['id']).'</small>
                                    </div>
                                    <p>'.$chat->get_messages($message['id']).'</p>
                                </div>
                            </li>';
                            
                        } 
                    }else
                    {  
        //             echo
        //             '
    				// <li class="'.$class.'" id="'.$message['id'].'">
    				// 	<a href="" title=""><img height="50" width ="50" src="'.$avata.'" /></a>
    				// 	<div class="message-area">
    				// 		<span class="pointer"></span>
    				// 		<div class="info-row">
    				// 			<span class="user-name"><a href="#"><strong>'.$username.'</strong></a> says:</span>
    				// 			<span class="time" id="'.$message['id'].'">'.$chat->get_messages_time($message['id']).'</span>
    				// 			<div class="clear"></div>
    				// 		</div>
    				// 		<p>
    				// 			'.$chat->get_messages($message['id']).'
    				// 		</p>
    				// 	</div>
    				// 	<div class="clear"></div>
    				// </li>
    				// ';
                    echo '<li class="'.$class_new.'" id="'.$message['id'].'"> 
                                <img src="'.$avata.'" alt="" class="'.$class_new_image.'" />
                                <div class="chat-item">
                                    <div class="chat-item-header">
                                        <h5 style="text-align:justify;">'.$username.'</h5>
                                        <small class="text-muted">'.$chat->get_messages_time($message['id']).'</small>
                                    </div>
                                    <p>'.$chat->get_messages($message['id']).'</p>
                                </div>
                            </li>';
                }
 }
            }
             $_SESSION['Channel_requested_id'][$with_id] = $message['id'];
         }
     }
     /**
      * Ajax send messages.
      *
      * @param int $with_id
      */
     public function ajax_send($with_id)
     {
        include APPPATH.'libraries/jchat/channel/loader.php';
         $post = $this->input->post('message');
         $channel_info = $this->M_channel->get_channel_type_group_type_name($with_id);

         if (isset($post)) {
             // Insert Message
            $message = $post;
            $message_set_id = $chat->set_message($post);
            $user_ids = array();
            // Get Messages
            $messages_ids = $chat->get_messages_id($chat->clientID, $chat->serverID);
            // Check if is client or serve r
            if (!empty($messages_ids)) {
                foreach ($messages_ids as $message_id) {
                    if ($message_id['id'] == $message_set_id) {
                        if ($message_id['user_id'] == $chat->clientID) {
                            $class = 'client';
                            $user_id = $chat->clientID;
                            $username = $chat->client;
                            $class_new = 'right';
                            $class_new_image = 'profile-photo-sm pull-right';
                        } else {
                            $class = 'server';
                            $user_id = $message_id['user_id'];
                            $username = $this->M_user->get_name($user_id);
                            $class_new = 'left';
                            $class_new_image = 'profile-photo-sm pull-left';
                        }
                        
                    }  
                }
                
                if($channel_info && $channel_info['type'] == 'private')
                {
                    if ($channel_info['type'] == 'private' && $channel_info['group_type'] == 'tour') 
                    {
                        $messages = 'There is a new message in  “'.$channel_info['name'].'” Channel';
                        $type = 'tour';
                        $user_ids = $this->M_channel->get_group_user_id($chat->clientID, $channel_info['group_id'], $type);
                        
                    }
                    elseif ($channel_info['type'] == 'private' && $channel_info['group_type'] == 'band') 
                    {
                        $messages = 'There is a new message in “'.$channel_info['name'].'”  Channel';
                        $type = 'band';
                        $user_ids = $this->M_channel->get_group_user_id($channel_info['group_id'], $channel_info['group_id'], $type);
                       

                    }
                    elseif ($channel_info['type'] == 'private' && $channel_info['group_type'] == 'affiliates') 
                    {

                        $messages = 'There is a new message in “'.$channel_info['name'].'” from ';
                        $type = 'affiliates';
                        $user_ids = $this->M_affiliate->get_connected_affilates_user_id($channel_info['group_id']);
                        $user_ids = array_unique($user_ids);
                    }
                    foreach ($user_ids as $key => $value) {
                        if($chat->clientID != $value)
                        {
                            $this->M_notify->addnotify($value, $messages, $type);
                        }
                    }
                }
                if($this->M_user->get_user_role($user_id) == 1)
                {
                    $avata = $this->M_user->get_avata($user_id);
                }
                else
                {
                    $avata = $this->M_user->get_avata_flp($user_id);
                }
                
                echo '<li class="'.$class_new.'" id="'.$message['id'].'"> 
                    <img src="'.$avata.'" alt="" class="'.$class_new_image.'" />
                    <div class="chat-item">
                        <div class="chat-item-header">
                            <h5 style="text-align:justify;">'.$username.'</h5>
                            <small class="text-muted" id="'.$message_set_id.'">'.$chat->get_messages_time($message_set_id).'</small>
                        </div>
                        <p>'.$chat->get_messages($message_set_id).'</p>
                    </div>
                </li>';
            }
         }
     }


     public function ajax_word_check($word)
     {
        $result = $this->M_chat_keyword->check_spam_word($word);
        if(is_null($result) || $result === 'NULL')
        {
            echo json_encode("success");
        }
        else
        {
            $word = "You cannot use that word "."'".$word."'";
            echo json_encode($word);
        }
        
     }
}
