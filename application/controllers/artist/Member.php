<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->model('M_photo');
        $this->load->model('M_user');
        $this->load->model('M_audio_song');
        $this->load->model('M_video');
        $this->load->model('M_blog');
        $this->load->model('M_affiliate');
        $this->load->model('M_fan');
        $this->load->model('Events_model');
        $this->load->model('M_comment');
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
     * View Artist landing page.
     *
     * @return response
     **/
    public function index($name)
    {
        $results = $this->Member_model->getUserByName('users', array('home_page' => $name));
        foreach ($results as $result) {
            $user_id = $result->id;
            $id_ctry = $result->countries;
            $id_genre = $result->genre;
            $style = $result->template_landing;
            $city = $result->city;
            $role = $result->role;
        }
        if($results){
        
        if (!empty($results) && $role == 1 or $role == 2) {
             // $user = $this->session->userdata('user_data');
            $user = $this->db->where('id', $user_id)->get('users')->row_array();

            $data['user_info'] = $user;
            $data['genres'] = $this->db->where('id', $id_genre)
                    ->get('genres')->result_array();
            $data['country_code'] = $this->db->where('id', $id_ctry)
                ->get('countries')->result_array();
            $data['id'] = $user_id;
            $data['user_id'] = $this->session->userdata('loged_in');
            $data['city'] = $city;
            $data['num_songs'] = $this->M_audio_song->num_songs($user_id);
            $data['num_videos'] = $this->M_video->num_videos($user_id);
            $data['num_events'] = $this->M_user->num_events($user_id);
            $data['num_fands'] = $this->M_fan->num_fans($user_id);
            $data['album_songs'] = $this->M_audio_song->get_data_playlist($user_id);
            $data['photo'] = $this->M_photo->getPhotoProfile($user_id);
            $data['name'] = $this->M_user->get_name($user_id);
            $data['users'] = $results;
            $data['members']=$this->db->where('artist_id',$user_id)
                    ->get('groups_member')->result_array();
            $data['fans'] = $this->M_fan->list_fan_alp($user_id, 12);
            $data['events'] = $this->Events_model->list_event_alp($user_id, 6);
            
            $data['user_data'] = $this->session->userdata('user_data');
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            if($user['role'] == 1)
            {
                $data['num_blogs'] = $this->M_blog->num_blogs_artist($user_id);
                $data['num_comments'] = $this->M_comment->num_comments_alp($user_id);
                $data['comments'] = $this->M_comment->all_comment_alp($user_id, 0, 5);
                $data['videos'] = $this->M_video->list_videos_alp($user_id, 4);
                $data['photos'] = $this->M_photo->list_photos_alp($user_id, 3);
                $data['songs'] = $this->M_audio_song->list_songs_alp($user_id, 5);
            
                $data['blogs'] = $this->M_blog->get_blogs_less_artist($user_id, 6);
                if($data['blogs'])
                {
                    for ($i=0; $i < count($data['blogs']); $i++) { 
                        $data['blogs'][$i]['blog_comments_count'] = count($this->M_blog->getcomment_blog($data['blogs'][$i]['id']));
                    }
                }
                $CounterHits = $this->session->userdata('CounterHits_alp');
                if (!isset($CounterHits)) {
                    $this->session->set_userdata('CounterHits_alp', true);
                    $this->M_user->Counter_hits($user_id, 'alp');
                }
				$this->load->view('landing/landing-page-'.$style, $data);
            }
			else
            {
                $data['num_blogs'] = $this->M_blog->num_blogs_amper($user_id);
                $data['num_comments'] = $this->M_comment->num_comments_flp($user_id);
                $data['comments'] = $this->M_comment->all_comments_flp($user_id, 0, 5);
                $data['videos'] = $this->M_video->list_videos_flp($user_id, 4);
                $data['photos'] = $this->M_photo->list_photos_flp($user_id, 3);
                $data['songs'] = $this->M_audio_song->list_songs_flp($user_id, 5);
                if ($this->M_affiliate->get_switch_stats($user_id)) {
                    $CounterHits = $this->session->userdata('CounterHits_flp');
                    if (!isset($CounterHits)) {
                        $this->session->set_userdata('CounterHits_flp', true);
                        $this->M_user->Counter_hits($user_id, 'flp');
                    }
                }
                $data['blogs'] = $this->M_blog->get_blogs_less_amper($user_id, 6);
                if($data['blogs'])
                {
                   
                    for ($i=0; $i < count($data['blogs']); $i++) { 
                        $data['blogs'][$i]['blog_comments_count'] = count($this->M_blog->getcomment_blog($data['blogs'][$i]['id']));
                    }
                    
                }
                $this->load->view('landing/landing-flp-page-'.$style, $data);
                    }
            $this->load->view('includes/footer', $data);
        } }else {
            show_404();
        }
    }
    /**
     * View All photo.
     *
     * @param string $home_page
     *
     * @return response
     **/
    public function allphoto($name)
    {
        $results = $this->Member_model->getUserByName('users', array('home_page' => $name));
        foreach ($results as $result) {
            $user_id = $result->id;
            $home_page = $result->home_page;
        }
        $data['info_id'] = $user_id;
        // $data['photos'] = $this->db->where('user_id', $user_id)
                          // ->get('photos')->result_array();
        $data['name'] = $name;
        $data['user_data'] = $this->session->userdata('user_data');
        $config['per_page'] = 16;
        $config['base_url'] = base_url().$home_page .'/photos';
        $start = $this->input->get('per_page');
        if (empty($start)) {
            $start = 0;
        }
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->db->get_where('photos', array('user_id' => $user_id))->num_rows();
        $this->load->library('pagination', $config);
        $this->pagination->initialize($config);
        $data['photos'] = $this->db->limit($config['per_page'], $start)->get_where('photos', array('user_id' => $user_id))->result_array();

        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/all_photo', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View all song.
     *
     * @param string $home_page
     *
     * @return response
     **/
    public function allsong($name)
    {
        $results = $this->db->where('home_page', $name)
                          ->get('users')->result_array();
        foreach ($results as $result) {
            $user_id = $result['id'];
        }
        $data = array();
        $data['listsong'] = $this->db->where('user_id', $user_id)
                          ->get('audio_song')->result_array();
        $data['name'] = $name;
        $data['user_data'] = $results[0];
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/allsong', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * Become fan artist.
     *
     * @param int    $id_user
     * @param string $home_page
     *
     * @return response
     **/
    public function becomefan($id = '', $home_page = '')
    {
        if (isset($id) && isset($home_page)) {
            $results = $this->db->where('home_page', $home_page)
                          ->get('users')->result_array();
            foreach ($results as $result) {
                $user_id = $result['id'];
            }
            $isset = $this->db->where('user_id', $user_id)->where('fan_id', $id)->get('fans')->num_rows();
            if ($isset > 0) {
                redirect($home_page);
            } else {
                $insertArr = array(
                            'user_id' => $user_id,
                            'fan_id' => $id,
                        );
                $this->db->insert('fans', $insertArr);
                redirect($home_page);
            }
        } else {
            redirect('account/login');
        }
    }
    /**
     * Memember comment on ALP.
     *
     * @return response
     **/
    public function membercomment()
    {
        $user_id = $this->session->userdata('loged_in');
        if (!isset($user_id)) {
            redirect('account/login');
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('comment', 'comment', 'required|max_length[1000]');
            $this->form_validation->set_rules('id_artist', 'id_artist', 'required');
            $id_artist = $this->input->post('id_artist');
            $home_page = $this->M_user->get_home_page($id_artist);
            if ($this->form_validation->run() != false) {
                $insertArr = array(
                    'user_id' => $id_artist,
                    'client' => $user_id,
                    'comment' => strip_tags($this->input->post('comment'), '<p><b>'),
                    'approve' => 1,
                    'type' => 'ALP',
                );
                $this->db->insert('comments', $insertArr);
                $this->session->set_flashdata('message_msg', 'comment success');
                //add notifycation
                if ($id_artist != $user_id) {
                    $this->M_notify->addnotify($id_artist, 'You have comment on ALP', 'memeber_comment');
                }
            } else {
                $this->session->set_flashdata('message_error', validation_errors());
            }
            redirect($home_page);
        }
    }
    /**
     * View all fans.
     *
     * @param int $user_id
     *
     * @return response
     **/
    public function fans($id)
    {
        $user_id = $this->session->userdata('loged_in');
        $data['fans'] = $this->db->select('*,fans.user_id')
                        ->from('fans')
                        ->where('fans.user_id', $id)
                        ->join('users', 'fans.fan_id = users.id')
                        ->join('photos', 'fans.fan_id = photos.user_id', 'left')
                        ->get()->result_array();
        $data['users'] = $this->db->where('id', $id)
                        ->get('users')->result_array();
        $data['id_user'] = $user_id;
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/all_fans', $data);
        $this->load->view('includes/footer', $data);
    }
}
