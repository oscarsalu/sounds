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
class social_ttt extends CI_Controller
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
        $this->tour_id = 0;
        $this->location = 0;

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
        $this->load->model('M_user');
        $this->load->model('M_tour');
        $this->load->model('Events_model');
        $this->load->helper('string');
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
    public function index($tour_id, $location_id)
    {
        $this->session->set_userdata('target', 'target0');
        $user_id = $this->session->userdata('loged_in');
        $data['url_data'] = $this->facebook->login_url_ttt();
        if (isset($tour_id) && $tour_id) {
            $this->session->set_userdata('tour_id_ss', $tour_id);
            if ($this->session->userdata('tour_id_ss')) {
                $tour_id = $this->session->userdata('tour_id_ss');
            }

            $locations = $this->db->select('*')
            ->from('location as l')
            ->where('l.tour_id', $tour_id)
            ->distinct()
            ->order_by('l.location_id', 'desc')
            ->get()->result_array();
            if (isset($locations) && count($locations) > 0) {
                if (empty($location_id)) {
                    $location_id = $locations[0]['location_id'];
                }
            } else {
                echo " ";
            }
            $this->tour_id = $tour_id;
            $this->location = $location_id;

            $this->session->set_userdata('tour_id_ss', $tour_id);
            $this->session->set_userdata('location_id_ss', $location_id);

            $events = $this->db->select('*')
                ->from('events as e')
                ->where('e.tour_id', $tour_id)
                ->where('e.location_id', $location_id)
                ->join('location as l', 'e.location_id = l.location_id')
                ->join('users as u', 'e.user_id = u.id', 'left')
                ->order_by('e.event_start_date', 'asc')
                ->get()->result_array();
            $date_events = array();
            foreach ($events as $event) {
                $event['event_start_date'] = date('m/d/Y', strtotime($event['event_start_date']));
                $event['event_end_date'] = date('m/d/Y', strtotime($event['event_end_date']));
                $date_events[] = $event;
            }
            $data['events'] = $date_events;
            $tour_data = $this->db->where('tour_id', $tour_id)->get('tour')->row_array();
            //$own = $this->db->where('id',$tour_data['user_id'])->get('users')->row_array();

            $data['check_member'] = $this->db->where('user_member', $this->user_id)->where('tour_id', $tour_id)->get('tours_member')->row_array();

            $members = $this->db->select('tm.*,u.*,u.id as user_id,tm.id as tm_id,tm.active as tm_active')
            ->from('tours_member as tm')
            ->join('users as u', 'tm.user_member = u.id', 'left')
            ->join('tour as t', 'u.id = t.user_id', 'left')
            //->or_where('t.tour_id',$tour_id)
            ->where('tm.tour_id', $tour_id)

            //->where('tm.active ',1)
            ->distinct()
            ->order_by('tm.id')
            ->get()->result_array();
            $show_member = array();
            //var_dump($members);exit;
            foreach ($members as $member) {
                $check = $this->db->select('t.*')->from('tour as t')->where('t.tour_id', $tour_id)->where('t.user_id', $member['user_id'])->get()->result_array();
                if (isset($check) && count($check) > 0) {
                    $member['own'] = 1;
                } else {
                    $member['own'] = 0;
                }
                $show_member[] = $member;
            }
            usort($show_member, array($this, 'cmp'));
            usort($show_member, array($this, 'active_sort'));

            $genres = $this->db->select('*')->from('genres')->get()->result_array();
        } else {
            echo " ";
        }

        $data['locations'] = $locations;
        $data['location_id'] = $location_id;
        $data['members'] = $show_member;
        $data['tour_id'] = $tour_id;
        $data['tour'] = $tour_data;
        $data['genres'] = $genres;
        $data['user_data'] = $this->session->userdata('user_data');

        // $this->load->view('includes/header', $data);
        // $this->load->view('includes/navbar', $data);
        // $this->load->view('ttt/header_ttt', $data);
        // $this->load->view('ttt/social_media', $data);
        // $this->load->view('includes/footer', $data);
         $this->load->view('ttt_new/social_media', $data);
    }

    public function cmp($a, $b)
    {
        return 1 * strcmp($a['own'], $b['own']);
    }
    public function active_sort($a, $b)
    {
        return -1 * strcmp($a['active'], $b['active']);
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

    public function social_share($tour_id, $location_id)
    {
		/*
        if ($this->input->post('twitter_check') && $this->input->post('image')) {
            if ($this->input->post('description') != '') {
                if ($this->input->post('image') != '') {
                    $this->session->set_userdata('image_url', $this->input->post('image'));
                }
                $this->session->set_userdata('post_data', $this->input->post('description'));
                if ($this->input->post('twitter_check')) {
                    $this->auth($tour_id, $location_id);
                }
            }
        }
		*/
		$id = $this->input->post('event_id');
		$message = $this->input->post('twitterMsg_'.$id);
		$this->session->set_userdata('post_data',$message);
		//$this->session->set_userdata('image_url',"https://static.pexels.com/photos/58557/pexels-photo-58557-medium.jpeg");
		$this->auth($tour_id, $location_id);
        //redirect(base_url("the_total_tour/social_media")."$tour_id/$location_id");
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
    public function auth($tour_id, $location_id)
    {
        $this->session->set_userdata('tour_id_ss', $tour_id);
        $this->session->set_userdata('location_id_ss', $location_id);

        if ($this->session->userdata('access_token') && $this->session->userdata('access_token_secret')) {
            // User is already authenticated. Add your user notification code here.
            redirect(base_url('social_ttt/postMsg'));
        } else {
            // Making a request for request_token
            $request_token = $this->connection->getRequestToken(base_url('social_media/callback'));

            $this->session->set_userdata('request_token', $request_token['oauth_token']);
            $this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);

            if ($this->connection->http_code == 200) {
                $url = $this->connection->getAuthorizeURL($request_token);
                //echo json_encode(array('url' => $url));
               // redirect(base_url('the_total_tour/social_media')."/$tour_id/$location_id");
               redirect($url);
            } else {
                // An error occured. Make sure to put your error notification code here.
                redirect(base_url('the_total_tour/social_media')."/$tour_id/$location_id");
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
            redirect(base_url('social_ttt/auth'));
        } else {
            $access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));

            if ($this->connection->http_code == 200) {
                $this->session->set_userdata('access_token', $access_token['oauth_token']);
                $this->session->set_userdata('access_token_secret', $access_token['oauth_token_secret']);
                $this->session->set_userdata('twitter_user_id', $access_token['user_id']);
                $this->session->set_userdata('twitter_screen_name', $access_token['screen_name']);
                $this->session->unset_userdata('request_token');
                $this->session->unset_userdata('request_token_secret');

                redirect(base_url('social_ttt/postMsg'));
            } else {
                ob_start();
                redirect(base_url('social_ttt'));
                ob_end_clean();
            }
        }
    }

    public function postMsg()
    {
        $message = $this->session->userdata('post_data');
        if (!$message || mb_strlen($message) > 140 || mb_strlen($message) < 1) {
            // Restrictions error. Notification here.
            redirect(base_url('the_total_tour/social_media').'/'.$this->session->userdata('tour_id_ss').'/'.$this->session->userdata('location_id_ss'));
        } else {
            if ($this->session->userdata('access_token') && $this->session->userdata('access_token_secret')) {
                $content = $this->connection->get('account/verify_credentials');
                if (isset($content->errors)) {
                    // Most probably, authentication problems. Begin authentication process again.
                    $this->reset_session();
                    redirect(base_url('the_total_tour/social_media').'/'.$this->session->userdata('tour_id_ss').'/'.$this->session->userdata('location_id_ss'));
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
                        redirect(base_url('the_total_tour/social_media').'/'.$this->session->userdata('tour_id_ss').'/'.$this->session->userdata('location_id_ss'));
                    } else {
                        //echo "msg post";
                        // Error, message hasn't been published
                        redirect(base_url('the_total_tour/social_media').'/'.$this->session->userdata('tour_id_ss').'/'.$this->session->userdata('location_id_ss'));
                    }
                }
            } else {
                // User is not authenticated.
                redirect(base_url('the_total_tour/social_media').'/'.$this->session->userdata('tour_id_ss').'/'.$this->session->userdata('location_id_ss'));
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
        if ($this->input->post('message') != '' && $this->input->post('imge_url') != '') {
            $linkData = array(
                'link' => base_url('the_total_tour/social_media').'/'.$this->session->userdata('tour_id_ss').'/'.$this->session->userdata('location_id_ss'),
                'picture' => $this->input->post('imge_url'),
                'name' => $this->input->post('message'),
                'caption' => $this->input->post('location_share'),
                'description' => $this->input->post('description_share'),
                //'message' => ,
            );

            $result = $this->sharefbdata($linkData);
            //$result = $this->facebook->share_photos($this->input->post('imge_url'),$this->input->post('message'));
            echo json_encode($result);
        }
    }
    public function shareFb()
    {
		/*$linkData = array(
            //'link' => 'http://demo99sound.com/',
            'picture' => 'http://demo99sound.com/uploads/119/photo/avatar.png',
            'name' => 'title jejeje',
            'caption' => 'http://demo99sound.com/',
            //'description' => 'hehehehe',
            'message' => "11111",
        );*/
        
        $linkData = array(
           // 'link' => 'http://demo99sound.com/',
            //'picture' => $this->input->post('img'),
            'name' => $this->input->post('title'),
            'caption' => 'http://demo99sound.com/',
            'description' => $this->input->post('loc'),
            'message' => "11111",
        );
        //print_r($linkData);
        header('Content-Type: application/json');
        //$fb_access_token = $this->session->userdata('fb_access_token');
        $result = $this->facebook->request('post', '/me/feed', $linkData);

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
        $tour_id = $this->tour_id;
        $location_id = $this->location;
        redirect(base_url('the_total_tour/social_media').'/'.$tour_id.'/'.$location_id);
        
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
