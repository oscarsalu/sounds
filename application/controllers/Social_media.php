<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of social_media.
 *
 * @author Tran
 */
class social_media extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $ac = $this->session->userdata('access');
         $data['redirect_url']=$this->curPageURL();
        if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }
        $this->load->model('M_text');
        $this->load->model('M_audio_song');
        // Your own constructor code
        //header("Access-Control-Allow-Methods: GET, OPTIONS, POST");
        //header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->load->library('facebook');
        $this->load->helper('url');
        //$this->load->library('pritteer');
        // Loading TwitterOauth library. Delete this line if you choose autoload method.
        $this->load->library('twitteroauth');
        // Loading twitter configuration.
        $this->config->load('twitter');
        $this->config->load('googleplus');
        //$this->load->library('instagram_api');
        //$this->load->library('googleplus');
        // Enabling debug will show you any errors in the calls you're making, e.g:
        //$this->tweet->enable_debug(TRUE);

        if ($this->session->userdata('access_token') && $this->session->userdata('access_token_secret')) {
            // If user already logged in
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('access_token'),  $this->session->userdata('access_token_secret'));
        } elseif ($this->session->userdata('request_token') && $this->session->userdata('request_token_secret')) {
            // If user in process of authentication
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
        } else {
            // Unknown user
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
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
     * View social media.
     */
    public function index()
    {
		
		$this->U_map = $this->session->userdata('U_map');
		$data['U_map'] = $this->db->where('id', $this->U_map['id'])->get('affiliates')->row_array();
        $user_id = $this->session->userdata('loged_in');
        $data['url_data'] = $this->facebook->login_url();
        $data['user_data'] = $this->session->userdata('user_data');
        $data['lists'] = $this->db->where('user_id', $user_id)
                        ->order_by('id', 'DESC')
                        ->get('social_medias')->result_array();
		$data['listsong'] = $this->M_audio_song->list_songs_flp($user_id,10);
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('social/social_media', $data);
        $this->load->view('includes/footer', $data);
    }
    public function pinterest()
    {
        if ($this->session->userdata('access_token_pritteer') && $this->session->userdata('access_token_pritteer')) {
            $pinterest->auth->setOAuthToken($this->session->userdata('access_token_pritteer'));

            $list_board = $pinterest->users->getMeBoards(array());

            var_dump(json_decode($list_board));
            exit;
        } else {
            $this->callback_pinterest();
        }
    }
    public function callback_pinterest()
    {
        $this->pritteer->callback($this->input->get('code', true));
        var_dump($this->session->userdata('access_token_pritteer'));
        exit;
    }
    public function share()
    {
		$user_id = $this->session->userdata('loged_in');
        if ($this->input->post('type') == 'video' && $this->input->post('facebook') && $this->input->post('video_post') == 'upload_video') {
            if (!empty($_FILES['url_video_upload']['name'])) {
                $this->load->library('upload');
                $this->upload->initialize($this->set_upload_options());
                if (!$this->upload->do_upload('url_video_upload')) {
                    $data['update_error'] = $this->upload->display_errors();
                    $this->session->set_flashdata('message_error', $data['update_error']);
                    redirect(base_url('social_media'));
                } else {
                    $datafile = $this->upload->data();
                    $user_id = $this->session->userdata('loged_in');
                    $path = base_url().'/uploads/'.$user_id.'/social/'.$datafile['file_name'];
                    $insertArr = array(
                            'user_id' => $user_id,
                            'message' => '',
                            'facebook' => 1,
                            'twitter' => 0,
                            'google' => 0,
                            'type' => 'video',
                            'path' => $path,
                    );
                    $this->db->insert('social_medias', $insertArr);
                    //$path = './uploads/'.$user_id.'/social/'.$datafile['file_name'];
                    $result = $this->facebook->fbPost_video($path);
                    $this->session->set_flashdata('message_msg', ' Post video completed');
                }
            }
            redirect(base_url('social_media'));
        }
        if ($this->input->post('type') == 'video' && $this->input->post('facebook') && $this->input->post('video_post') == 'url_video') {
            if ($this->input->post('url_video_input') != '') {
                $path = $this->input->post('url_video_input');
                $user_id = $this->session->userdata('loged_in');
                $insertArr = array(
                        'user_id' => $user_id,
                        'message' => '',
                        'facebook' => 1,
                        'twitter' => 0,
                        'google' => 0,
                        'type' => 'video',
                        'path' => $path,
                );
                $this->db->insert('social_medias', $insertArr);
                $result = $this->facebook->fbPost_video($path);

                $this->session->set_flashdata('message_msg', ' Post video completed');
            }
            redirect(base_url('social_media'));
        }
        if ($this->input->post('type') == 'image' && $this->input->post('twitter_check') && $this->input->post('post_photo') == 'url_photo') {
            if ($this->input->post('post_data') != '') {
                if ($this->input->post('url_post_photo_input') != '') {
                    $this->session->set_userdata('image_url', $this->input->post('url_post_photo_input'));
                }
                $this->session->set_userdata('post_data', $this->input->post('post_data'));
                if ($this->input->post('twitter_check')) {
                    $this->auth();
                }
            }
        }
        if ($this->input->post('type') == 'image' && ($this->input->post('twitter_check') || $this->input->post('facebook')) && $this->input->post('post_photo') == 'upload_photo') {
            if ($this->input->post('post_data') != '') {
                if (!empty($_FILES['url_photo_upload']['name'])) {
                    $this->load->library('upload');
                    $user_id = $this->session->userdata('loged_in');
                    $this->upload->initialize($this->config());
                    if (!$this->upload->do_upload('url_photo_upload')) {
                        $data['update_error'] = $this->upload->display_errors();

                        $this->session->set_flashdata('message_error', $data['update_error']);
                        redirect(base_url('social_media'));
                    } else {
                        if ($this->input->post('twitter_check') == 'on') {
                            $twitter = 1;
                        } else {
                            $twitter = 0;
                        }
                        if ($this->input->post('facebook') == 'on') {
                            $facebook = 1;
                        } else {
                            $facebook = 0;
                        }
                        $datafile = $this->upload->data();
                        $path = base_url().'uploads/'.$user_id.'/social/'.$datafile['file_name'];
                        $insertArr = array(
                        'user_id' => $user_id,
                        'message' => $this->input->post('post_data'),
                        'facebook' => $facebook,
                        'twitter' => $twitter,
                        'google' => 0,
                        'type' => 'image',
                        'path' => $path,
                        );
                        $this->db->insert('social_medias', $insertArr);
                        $this->session->set_flashdata('message_msg', ' Upload Photo completed');
                        if ($facebook) {
                            $result = $this->facebook->share_photos($path, $this->input->post('post_data'));
                        }
                        if ($twitter) {
                            $this->session->set_userdata('post_data', $this->input->post('post_data'));
                            $this->session->set_userdata('image_url', $path);
                            $this->auth();
                        }
                    }
                } else {
                    $this->session->set_flashdata('message_error', 'Please upload Photo');
                    redirect(base_url('social_media'));
                }
            }
        }
        if ($this->input->post('type') == 'field' && ($this->input->post('twitter_check') || $this->input->post('facebook'))) {
            if ($this->input->post('post_data') != '') {
                if (!empty($_FILES['upload_field_upload']['name'])) {
                    $this->load->library('upload');
                    $user_id = $this->session->userdata('loged_in');
                    $this->upload->initialize($this->config());
                    if (!$this->upload->do_upload('upload_field_upload')) {
                        $data['update_error'] = $this->upload->display_errors();
                        $this->session->set_flashdata('message_error', $data['update_error']);
                        redirect(base_url('social_media'));
                    } else {
                        $datafile = $this->upload->data();
                        $path = base_url().'uploads/'.$user_id.'/social/'.$datafile['file_name'];
                    }
                } else {
                    if ($this->input->post('no_upload_field_fb') == 'upload_field_fb') {
                        $this->session->set_flashdata('message_error', 'Please upload Photo');
                        redirect(base_url('social_media'));
                    }
                }
                if ($this->input->post('facebook') == 'on') {
                    $facebook = 1;
                    $link = base_url();
                    if ($this->input->post('share_link_url') != '') {
                        $link = $this->input->post('share_link_url');
                    }
                    $caption = base_url();
                    if ($this->input->post('share_caption') != '') {
                        $caption = $this->input->post('share_caption');
                    }
                    $description = '99sound';
                    if ($this->input->post('share_description') != '') {
                        $description = $this->input->post('share_description');
                    }
                    if ($this->input->post('no_upload_field_fb') == 'upload_field_fb') {
                        $linkData = array(
                            'link' => $link,
                            'picture' => $path,
                            'name' => $this->input->post('post_data'),
                            'caption' => $caption,
                            'description' => $description,
                            //'message' => ,
                        );
                    } elseif ($this->input->post('no_upload_field_fb') == 'url_field_fb') {
                        if ($this->input->post('url_post_field_input') != '') {
                            $linkData = array(
                                'link' => $link,
                                'picture' => $this->input->post('url_post_field_input'),
                                'name' => $this->input->post('post_data'),
                                'caption' => $caption,
                                'description' => $description,
                                //'message' => ,
                            );
                        } else {
                            $linkData = array(
                                'link' => $link,
                                'name' => $this->input->post('post_data'),
                                'caption' => $caption,
                                'description' => $description,
                                //'message' => ,
                            );
                        }
                    } elseif ($this->input->post('no_upload_field_fb') == 'no_upload_field_fb') {
                        $linkData = array(
                            'link' => $link,
                            'name' => $this->input->post('post_data'),
                            'caption' => $caption,
                            'description' => $description,
                        );
                    }
                    $result = $this->sharefbdata($linkData);
                    if ($result['error'] && $result['error'] != '') {
                        $this->session->set_flashdata('message_error', ' Upload post facenook not completed');
                    } else {
                        $this->session->set_flashdata('message_msg', ' Upload post completed');
                    }
                } else {
                    $facebook = 0;
                }
                //var_dump('xzzx');exit;
                if ($this->input->post('twitter_check') == 'on') {
                    $twitter = 1;
                    $this->session->set_userdata('post_data', $this->input->post('post_data'));

                    if ($this->input->post('no_upload_field_fb') == 'upload_field_fb') {
                        $this->session->set_userdata('image_url', $path);
                    } elseif ($this->input->post('no_upload_field_fb') == 'url_field_fb') {
                        $this->session->set_userdata('image_url', $this->input->post('url_post_field_input'));
                    } elseif ($this->input->post('no_upload_field_fb') == 'no_upload_field_fb') {
                    }
                    $this->auth();
                } else {
                    $twitter = 0;
                }
            }
        }
        redirect(base_url('social_media'));
        //if($this->input->post('post_data') !="")
//		{
//            if($this->input->post('image_url') != ""){
//                $this->session->set_userdata('image_url',$this->input->post('image_url'));
//            }
//			$this->session->set_userdata('post_data',$this->input->post('post_data'));
//			if($this->input->post("twitter"))
//			{
//				$this->auth();
//			}
//		}
    }

    public function config()
    {
        $loged_in = $this->session->userdata('loged_in');
        $config = array();
        $config['upload_path'] = './uploads/'.$loged_in.'/social/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        } else {
            chmod($config['upload_path'], 0777);
        }
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '80000';
        //$config['max_width']  = '2000';
        //$config['max_height']  = '1080';
        $config['file_name'] = uniqid();

        return $config;
    }

    private function set_upload_options()
    {
        $loged_in = $this->session->userdata('loged_in');
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/'.$loged_in.'/social/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        } else {
            chmod($config['upload_path'], 0777);
        }
        $config['allowed_types'] = 'mp4|avi|mov|flv';
        $config['max_size'] = '200000000';
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        $config['file_name'] = uniqid();

        return $config;
    }
    public function instagramShare($code)
    {
        if (isset($_GET['code']) && $_GET['code'] != '') {
            $auth_response = $this->instagram_api->authorize($_GET['code']);
            echo 'code: '.$_GET['code'];
            print_r($auth_response);
            // Set up session variables containing some useful Instagram data
            $this->session->set_userdata('instagram-token', $auth_response->access_token);
            $this->session->set_userdata('instagram-username', $auth_response->user->username);
            $this->session->set_userdata('instagram-profile-picture', $auth_response->user->profile_picture);
            $this->session->set_userdata('instagram-user-id', $auth_response->user->id);
            $this->session->set_userdata('instagram-full-name', $auth_response->user->full_name);

            if ($user_id === false) {
                $user_id = $this->session->userdata('instagram-user-id');
            }
            redirect(base_url('social_media'));
        } else {
            // There was no GET variable so redirect back to the homepage
            redirect(base_url('social_media'));
        }
    }
    /**
     * Here comes authentication process begin.
     */
    public function auth()
    {
        if ($this->session->userdata('access_token') && $this->session->userdata('access_token_secret')) {
            // User is already authenticated. Add your user notification code here.
            redirect(base_url('social_media/postMsg'));
        } else {
            // Making a request for request_token
            $request_token = $this->connection->getRequestToken(base_url('social_media/callback'));

            $this->session->set_userdata('request_token', $request_token['oauth_token']);
            $this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);

            if ($this->connection->http_code == 200) {
                $url = $this->connection->getAuthorizeURL($request_token);
                //echo json_encode(array('url' => $url));
                redirect($url);
            } else {
                // An error occured. Make sure to put your error notification code here.
                redirect(base_url('social_media'));
            }
        }
    }

    /**
     * Callback function, landing page for twitter.
     */
    public function callback()
    {
        if ($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token')) {
            $msg = $this->session->userdata('post_data');
            $this->reset_session();
            $this->session->set_userdata('post_data', $msg);
            redirect(base_url('social_media/auth'));
        } else {
            $access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));

            if ($this->connection->http_code == 200) {
                $this->session->set_userdata('access_token', $access_token['oauth_token']);
                $this->session->set_userdata('access_token_secret', $access_token['oauth_token_secret']);
                $this->session->set_userdata('twitter_user_id', $access_token['user_id']);
                $this->session->set_userdata('twitter_screen_name', $access_token['screen_name']);
                $this->session->unset_userdata('request_token');
                $this->session->unset_userdata('request_token_secret');

                redirect(base_url('social_media/postMsg'));
            } else {
                ob_start();
                redirect(base_url('social_media'));
                ob_end_clean();
            }
        }
    }

    public function postMsg()
    {
        $message = $this->session->userdata('post_data');
        if (!$message || mb_strlen($message) > 140 || mb_strlen($message) < 1) {
            // Restrictions error. Notification here.
            redirect(base_url('social_media'));
        } else {
            if ($this->session->userdata('access_token') && $this->session->userdata('access_token_secret')) {
                $content = $this->connection->get('account/verify_credentials');
                if (isset($content->errors)) {
                    // Most probably, authentication problems. Begin authentication process again.
                    $this->reset_session();
                    redirect(base_url('social_media'));
                } else {
                    if ($this->session->userdata('image_url')) {
                        $user_id = $this->session->userdata('loged_in');
                        $image_url = $this->session->userdata('image_url');
                        $media_ids = $this->connection->testMediaUpload($image_url);
                        $data = array(
                            'status' => $message,
                            'media_ids' => $media_ids,
                        );
                    } else {
                        $data = array(
                            'status' => $message,
                        );
                    }
                    $this->session->unset_userdata('image_url');
                    $this->session->unset_userdata('post_data');
                    $result = $this->connection->post('statuses/update', $data);
                    $this->session->set_flashdata('message_msg', ' Post completed');
                    if (!isset($result->errors)) {
                        // Everything is OK
                        //echo "msg post";
                        redirect(base_url('social_media'));
                    } else {
                        //echo "msg post";
                        // Error, message hasn't been published
                        redirect(base_url('social_media'));
                    }
                }
            } else {
                // User is not authenticated.
                redirect(base_url('social_media'));
            }
        }
    }

    /**
     * Reset session data.
     */
    private function reset_session()
    {
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('access_token_secret');
        $this->session->unset_userdata('request_token');
        $this->session->unset_userdata('request_token_secret');
        $this->session->unset_userdata('twitter_user_id');
        $this->session->unset_userdata('twitter_screen_name');
    }
    public function fbPost_video()
    {
		$user_id = $this->session->userdata('loged_in');
		 $this->session->set_userdata('fb_access_token',$this->input->post('token'));
        if ($this->input->post('imge_url') != '') {
            $result = $this->facebook->fbPost_video($this->input->post('imge_url'));

            $user_id = $this->session->userdata('loged_in');
            $insertArr = array(
                    'user_id' => $user_id,
                    'message' => '',
                    'facebook' => 1,
                    'twitter' => 0,
                    'google' => 0,
                    'type' => 'video',
                    'path' => strip_tags($this->input->post('imge_url'), '<p><b>'),
            );
            $this->db->insert('social_medias', $insertArr);
        }
        echo json_encode($result);
    }

    public function fbpost_insert_photo()
    {
        $user_id = $this->session->userdata('loged_in');
        $insertArr = array(
                'user_id' => $user_id,
                'message' => strip_tags($this->input->post('message'), '<p><b>'),
                'facebook' => $this->input->post('fbCheck'),
                'twitter' => $this->input->post('twitterCheck'),
                'google' => $this->input->post('googleCheck'),
        );
        $this->db->insert('social_medias', $insertArr);
        echo json_encode($insertArr);
    }
    public function fbpost_photo()
    {
		$user_id = $this->session->userdata('loged_in');
		 $this->session->set_userdata('fb_access_token',$this->input->post('token'));
        if ($this->input->post('message') != '' && $this->input->post('imge_url') != '') {
            $result = $this->facebook->share_photos($this->input->post('imge_url'), $this->input->post('message'));
            
            
             $insertArr = array(
                    'user_id' => $user_id,
                    'message' => $this->input->post('message'),
                    'facebook' => 1,
                    'twitter' => 0,
                    'google' => 0,
                    'type' => 'image',
                    'path' => strip_tags($this->input->post('imge_url'), '<p><b>'),
            );
            $this->db->insert('social_medias', $insertArr);
            
            echo json_encode($result);
        }
    }
    public function shareFb()
    {
		$user_id = $this->session->userdata('loged_in');
        $linkData = array(
            'link' => $this->input->post('link'),
            //'picture' => 'http://demo99sound.com/uploads/119/photo/avatar.png',
            //'name' => 'title jejeje',
            'caption' => $this->input->post('caption'),
            'description' => $this->input->post('msg'),
            'message' => $this->input->post('desc'),
        );
        header('Content-Type: application/json');
        $this->session->set_userdata('fb_access_token',$this->input->post('token'));
        $fb_access_token = $this->session->userdata('fb_access_token');
        $result = $this->facebook->request('post', '/me/feed', $linkData, $fb_access_token);
		$insertArr = array(
				'user_id' => $user_id,
				'message' => $this->input->post('desc'),
				'facebook' => 1,
				'twitter' => 0,
				'google' => 0,
				'type' => 'text',
				'path' => strip_tags($this->input->post('link'), '<p><b>'),
		);
		$this->db->insert('social_medias', $insertArr);
		
        echo json_encode($result);
    }
    public function sharefbdata($linkData)
    {
        //$linkData = array(
//            'link' => 'http://demo99sound.com/',
//            'picture' => 'http://demo99sound.com/uploads/119/photo/avatar.png',
//            'name' => 'title jejeje',
//            'caption' => 'http://demo99sound.com/',
//            'description' => 'hehehehe',
//            'message' => $this->input->post('message'),
//        );
        header('Content-Type: application/json');
        $fb_access_token = $this->session->userdata('fb_access_token');
        $result = $this->facebook->request('post', '/me/feed', $linkData, $fb_access_token);

        return $result;
    }
    public function backfacebook()
    {
        $this->facebook->login_url();
    }
    public function fbPost()
    {
        $this->load->library('facebook');
        $helper = $this->facebook->getRedirectLoginHelper11();
        redirect(base_url('social_media'));
    }
    public function insert_db()
    {
        $user_id = $this->session->userdata('loged_in');
        $image = $this->input->post('image');
        if ($image && !empty($image)) {
            $insertArr = array(
                'user_id' => $user_id,
                'message' => strip_tags($this->input->post('message'), '<p><b>'),
                'facebook' => $this->input->post('fbCheck'),
                'twitter' => $this->input->post('twitterCheck'),
                'google' => $this->input->post('googleCheck'),
                'type' => 'image',
                'path' => $image,
            );
        } else {
            $insertArr = array(
                'user_id' => $user_id,
                'message' => strip_tags($this->input->post('message'), '<p><b>'),
                'facebook' => $this->input->post('fbCheck'),
                'twitter' => $this->input->post('twitterCheck'),
                'google' => $this->input->post('googleCheck'),

            );
        }

        $this->db->insert('social_medias', $insertArr);
        echo json_encode($insertArr);
    }
}
