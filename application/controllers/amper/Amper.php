<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Amper extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->model('M_photo');
        $this->load->model('M_comment');
        $this->load->model('M_user');
        $this->load->model('M_audio_song');
        $this->load->model('M_affiliate');
        $this->load->model('M_transaction');
        $this->load->model('M_notify');
        $this->load->model('M_channel');

        $this->load->model('M_fan');
        $this->load->model('Events_model');
        $this->load->model('M_fan');
        $this->load->model('M_video');
        $this->load->model('M_blog');
        $this->load->helper('string');
        $ac = $this->session->userdata('access');
      
         $data['redirect_url']=$this->curPageURL();
       if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }
        $this->U_map = $this->session->userdata('U_map');
       
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
    /**
     * View Fan Landing Page.
     **/
    public function index($name)
    {
        $results = $this->Member_model->getUserByName('users', array('home_page' => $name));
        //$results = $this->db->get_where('users',array('home_page' => $name))->row();

        $user_id = $results[0]->id;
        $style = $results[0]->template_landing;
        if (!empty($results)) {
        //     if ($this->M_affiliate->get_switch_stats($user_id)) {
        //         $CounterHits = $this->session->userdata('CounterHits_flp');
        //         if (!isset($CounterHits)) {
        //             $this->session->set_userdata('CounterHits_flp', true);
        //             $this->M_user->Counter_hits($user_id, 'flp');
        //         }
        //     }
            $data['name'] = $name;
            $user = $this->db->where('id', $user_id)->get('users')->row_array();
            
            $data['genres'] = $this->M_user->get_genres($user_id);
            $data['num_sales'] = $this->M_affiliate->count_amp_sales($user_id);
            $data['num_samples'] = $this->M_affiliate->count_amp_samples($this->M_affiliate->get_affilaite_id($user_id));
            $data['num_fands'] = $this->M_fan->num_fans($user_id);
            $data['num_events'] = $this->M_user->num_events($user_id);
            // $data['num_blogs'] = $this->M_blog->num_blogs_amper($user_id);
            // $data['num_comments'] = $this->M_comment->num_comments_flp($user_id);
            $data['id'] = $results[0]->id;
            $data['user_id'] = $this->session->userdata('loged_in');
            $data['user_info'] = $user;
            $data['city'] = $results[0]->city;
            $data['num_videos'] = $this->M_video->num_videos($user_id);
            $data['num_songs'] = $this->M_audio_song->num_songs($user_id);
            // $data['songs'] = $this->M_audio_song->list_songs_flp($user_id, 5);
            // $data['videos'] = $this->M_video->list_videos_flp($user_id, 4);
            // $data['photos'] = $this->M_photo->list_photos_flp($user_id, 3);
            $data['blogs'] = $this->M_blog->get_blogs_less_amper($user_id);
            $data['photo'] = $this->M_photo->getPhotoProfile($user_id);
            // $data['comments'] = $this->M_comment->list_comment_flp($user_id, 5);
            $data['users'] = $results;
            $data['members']=$this->db->where('artist_id',$user_id)
                    ->get('groups_member')->result_array();
            $data['fans'] = $this->M_fan->list_fan_alp($user_id, 12);
            $data['events'] = $this->Events_model->list_event_alp($user_id, 6);
            
            $data['album_songs'] = $this->M_audio_song->get_data_playlist($user_id);
           if($user['role'] == 1)
            {
                $data['avata'] = $this->M_user->get_avata($user_id);
                $data['role']  = 1;
            }else{
                 $data['avata'] = $this->M_user->get_avata_flp($user_id);
                  $data['role']  = 2;
            }
               
            $data['user_data'] = $this->session->userdata('user_data');
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            // if($results[0]->role == 1)
            // {
            //     $data['num_blogs'] = $this->M_blog->num_blogs_artist($user_id);
            //     $data['num_comments'] = $this->M_comment->num_comments_alp($user_id);
            //     $data['comments'] = $this->M_comment->all_comment_alp($user_id, 0, 5);
            //     $data['videos'] = $this->M_video->list_videos_alp($user_id, 4);
            //     $data['photos'] = $this->M_photo->list_photos_alp($user_id, 3);
            //     $data['songs'] = $this->M_audio_song->list_songs_alp($user_id, 5);
            //     $data['members']=$this->db->where('artist_id',$user_id)
            //         ->get('groups_member')->result_array();
            //         $data['fans'] = $this->M_fan->list_fan_alp($user_id, 12);
            
            //     $data['blogs'] = $this->M_blog->get_blogs_less_artist($user_id, 6);
            //     if($data['blogs'])
            //     {
            //         for ($i=0; $i < count($data['blogs']); $i++) { 
            //             $data['blogs'][$i]['blog_comments_count'] = count($this->M_blog->getcomment_blog($data['blogs'][$i]['id']));
            //         }
            //     }
            //     $CounterHits = $this->session->userdata('CounterHits_alp');
            //     if (!isset($CounterHits)) {
            //         $this->session->set_userdata('CounterHits_alp', true);
            //         $this->M_user->Counter_hits($user_id, 'alp');
            //     }
            //         $this->load->view('landing/landing-page-'.$style, $data);
            //     }
            // else
            // {
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
            // }       
            $this->load->view('includes/footer', $data);
        } else {
            redirect('404');
        }
    }
    /**
     * View Affiliate select albums
     * affliate create new playlist custome.
     **/
    public function selectalbums($parent_affiliate)
    {
        $this->is_login();
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] = $this->session->userdata('user_data');
        if (isset($parent_affiliate)) {
            $data['parent_affiliate'] = $this->db
                ->select('u.firstname,u.lastname,a.affiliate_id,a.list_artist,a.user_id')
                ->where('affiliate_id', $parent_affiliate)
                ->join('users u', 'a.user_id = u.id')
                ->get('affiliates a')->row();
            $data['list_artist'] = explode('-', $data['parent_affiliate']->list_artist);
            $playlist = array();
            foreach ($data['list_artist'] as $row) {
                $data_playlist = $this->M_audio_song->get_data_playlist($row);
                  
                foreach ($data_playlist as $val) {
                    $playlist[] = $val['id'];
               
                }
            }
          
            $data['playlist'] = $playlist;
           
            $data['my_albums'] = $this->M_audio_song->get_data_playlist_amp($user_id);
          
        
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('amper/select_albums', $data);
              
            $this->load->view('includes/footer', $data);
        } else {
            echo 'Error!!! do not have data affiliate parent';
        }
    }
    /**
     * Ajax load select song.
     **/
    public function load_changed_songs()
    {
        $songs = $this->input->post('songs');
        if (!empty($songs)) {
            $data_songs = $this->db->where_in('id', $songs)->get('audio_song')->result();
            $SongId = array();
            foreach ($data_songs as $song) {
                $SongsId[] = $song->id; ?>
                <li class="ui-state-default" data-song="<?=$song->id?>">
                    <?=$song->song_name?> by (<?=$this->M_user->get_name($song->user_id)?>)
                </li>
                <?php

            }
            if (!empty($SongsId)) {
                ?><input type="hidden" name="songs" value="<?=implode(',', $SongsId)?>"/><?php 
            }
        }
    }
    /**
     * Create new playlist AMp custom.
     **/
    public function create_album()
    {
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('playlist_name', 'playlist_name', 'required|max_length[200]');
        $this->form_validation->set_rules('desc', 'desc', 'max_length[1000]');
        $user_id = $this->session->userdata('loged_in');
        if (!empty($_FILES['image']['name'])) {
            if ($this->form_validation->run() != false) {
                $this->upload->initialize($this->set_up_img_cover());
                if (!$this->upload->do_upload('image')) {
                    $data['update_error'] = $this->upload->display_errors();
                    echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                    echo  '<h4><strong>Error!</strong></h4>';
                    echo  '<p> '.$data['update_error'].'</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_error', $data['update_error']);
                } else {
                    $datafile = $this->upload->data();
                    $insertArr = array(
                        'name' => $this->input->post('playlist_name'),
                        'image_file' => $datafile['file_name'],
                        'decs' => $this->input->post('desc'),
                        'user_id' => $user_id,
                        'time' => time(),
                      'album_root'=> 0,
                    );
                    $this->db->insert('playlist_amp', $insertArr);
                    $id_playlist = $this->db->insert_id();
                    $this->M_audio_song->add_new_option_playlist_amp($user_id, $id_playlist);
                    $post_songs = $this->input->post('songs');
                    $arr_songs = explode(',', $post_songs);
                    $data_songs = $this->db->where_in('id', $arr_songs)->get('audio_song')->result();
                    foreach ($data_songs as $row) {
                        $data_new = array(
                            'playlist_amp_id' => $id_playlist,
                            'audio_song_id' => $row->id,
                        );
                        $this->db->insert('audio_amp', $data_new);
                    }
                    echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                    echo  '<h4><strong>Succces!</strong></h4>';
                    echo  '<p> Create playlist completed</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_msg', ' Create playlist completed');
                }
            }
        }
    }
    /**
     * Config uploads image cover playlist.
     **/
    private function set_up_img_cover()
    {
        $loged_in = $this->session->userdata('loged_in');
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/'.$loged_in.'/img_playlist/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        } else {
            chmod($config['upload_path'], 0777);
        }
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '3000';
        $config['max_width'] = '2000';
        $config['max_height'] = '1080';
        $config['file_name'] = uniqid();

        return $config;
    }
    /**
     * Finish create new Playlist Custome and select albums.
     **/
    public function create_album_finish()
    {
        $playlits = $this->input->post('playlits');
        if (!empty($playlits)) {
            $user_id = $this->session->userdata('loged_in');
            $arr_playlist = explode(',', $playlits);
            $data_albums = $this->db->where_in('id', $arr_playlist)->get('album_song')->result();
            foreach ($data_albums as $album) {
                //copy image playlist
                $upload_path = './uploads/'.$album->user_id.'/img_playlist/';
                $save_path = './uploads/'.$user_id.'/img_playlist/';
                if (!is_dir($save_path)) {
                    mkdir($save_path, 0777, true);
                } else {
                    chmod($save_path, 0777);
                }

                $content = file_get_contents($upload_path.$album->image_file);
                //Store in the filesystem.
                file_put_contents($save_path.$album->image_file, $content);
                $insertArr = array(
                    'name' => $album->name,
                    'image_file' => $album->image_file,
                    'decs' => $album->decs,
                    'user_id' => $user_id,
                    'time' => time(),
                    
                );
                $this->db->insert('playlist_amp', $insertArr);
                $id_playlist = $this->db->insert_id();
                $this->M_audio_song->add_new_option_playlist_amp($user_id, $id_playlist);
                $data_songs = $this->db->where('album_id', $album->id)->get('audio_song')->result();
                foreach ($data_songs as $song) {
                    $data_new = array(
                        'playlist_amp_id' => $id_playlist,
                        'audio_song_id' => $song->id,
                        
                    );
                    $this->db->insert('audio_amp', $data_new);
                }
            }
            $this->session->set_flashdata('message_msg', ' Create playlist completed');
        }
        redirect('amper/manager_audios');
    }
    /**
     * View to become affiliates.
     **/
    public function become_affiliate($AffiliateRootId)
    {
       
        $affiliate = $this->M_affiliate->get_affiliate($AffiliateRootId);
        
        if (isset($affiliate) && !empty($affiliate)) {
            $check_limit = $this->M_affiliate->check_limit_affiliate($AffiliateRootId);
            if (!$check_limit) {
                echo 'Can\'t register affiliate <br/> limit register';
                die;
            }
            $U_map = $this->U_map;
            if ($U_map['affiliate_id'] == $AffiliateRootId) {
                echo 'Can\'t register affiliate <br/> ';
                die;
            } else {
             
                $ListArtist = explode('-', $affiliate['list_artist']);
                $data['networks'] = $this->db->where('level <', 4)
                    //->where_in('artist_id',$ListArtist)
                    ->where('affiliate_id', $AffiliateRootId)
                    ->get('affiliate_level')->result_array();
    
                $data['user_data'] = $this->session->userdata('user_data');
                $data['U_map'] = $U_map;
                $data['AffiliateRootId'] = $AffiliateRootId;
                $this->load->view('includes/header', $data);
                $this->load->view('includes/navbar', $data);
                $this->load->view('amper/become_affiliate', $data);
                $this->load->view('includes/footer', $data);
            }
        } else {
            echo 'Can\'t register affiliate <br/> contact support 99sound.com :';
            die;
        }
    }
    /**
     * Comfirm became affiliate.
     **/
    public function confirm_register()
    {
        $AffiliateRootId = $this->input->post('AffiliateRootId');
       $list_network = $this->input->post('input_select');
        $affiliate = $this->M_affiliate->get_affiliate($AffiliateRootId);
foreach($list_network as $network) {
        $DataParrent = $this->db->where_in('id',$network)
            ->get('affiliate_level')->result_array();
        $U_map = $this->U_map;
        foreach ($DataParrent as $Parrent) {
            if ($Parrent['level'] == 0) {
                //save relative 2 amper
                $insertArr = array(
                    'affiliate_id' => $U_map['affiliate_id'],
                    'parrent_id' => $Parrent['affiliate_id'],
                );
                $this->db->insert('conect_affiliates', $insertArr);
                $InsertNewLevel = array(
                    'affiliate_id' => $U_map['affiliate_id'],
                    'artist_id' => $Parrent['artist_id'],
                    'level' => 1,
                    'status' => 0,
                );
                $this->db->insert('affiliate_level', $InsertNewLevel);
                $aff_1=array($U_map['affiliate_id']);
                $level = 1;
                
                $channel_id = $this->M_channel->get_channel_id($Parrent['artist_id'], $level);

                if($channel_id)
                {
                    $dataArray = array('channel_id'=> $channel_id, 'affiliate_id'=> $U_map['affiliate_id'], 'level' =>$level);
                    $this->M_channel->save_channel_affilaites($dataArray);
                }else
                {
                    $channel_data = $this->M_channel->check_artist_affiliates_channel($Parrent['artist_id']);
                    if(empty($channel_data))
                    {
                        for ($i=1; $i <= 4; $i++) { 
                            $channel_name = $this->M_user->get_name($Parrent['artist_id']).'-Affilaite-Level'.$i;
                            $dataArray = array('name'=> $channel_name, 'user_id'=> $Parrent['artist_id'], 'type' =>'private', 'time'=> time(), 'is_admin'=> 0, 'group_type'=>'affiliates', 'group_id'=>$Parrent['artist_id'], 'level'=>$i);
                           $channel_id = $this->M_channel->save($dataArray);
                           $dataArray = array('channel_id'=> $channel_id, 'affiliate_id'=> $this->M_affiliate->get_affilaite_id($Parrent['artist_id']), 'level' =>$i);
                           $this->M_channel->save_channel_affilaites($dataArray);
                           if($level == $i)
                           {
                                $dataArray = array('channel_id'=> $channel_id, 'affiliate_id'=> $U_map['affiliate_id'], 'level' =>$level);
                                $this->M_channel->save_channel_affilaites($dataArray);
                           }
                        }
                    }
                }
                
                $this->db->where('affiliate_id', $AffiliateRootId);
                $this->db->update('affiliate_level',array('affiliate_1'=>$U_map['affiliate_id']));
            } else {
                if ($Parrent['level'] == 1) {
                    $InsertNewLevel = array(
                        'affiliate_id' => $U_map['affiliate_id'],
                        'artist_id' => $Parrent['artist_id'],
                        'level' => $Parrent['level'] + 1,
                        'affiliate_1' => $AffiliateRootId,
                        'status' => 0,
                    );
                } elseif ($Parrent['level'] == 2) {
                    $InsertNewLevel = array(
                        'affiliate_id' => $U_map['affiliate_id'],
                        'artist_id' => $Parrent['artist_id'],
                        'level' => $Parrent['level'] + 1,
                        'affiliate_1' => $Parrent['affiliate_1'],
                        'affiliate_2' => $AffiliateRootId,
                        'status' => 0,
                    );
                } elseif ($Parrent['level'] == 3) {
                    $InsertNewLevel = array(
                        'affiliate_id' => $U_map['affiliate_id'],
                        'artist_id' => $Parrent['artist_id'],
                        'level' => $Parrent['level'] + 1,
                        'affiliate_1' => $Parrent['affiliate_1'],
                        'affiliate_2' => $Parrent['affiliate_2'],
                        'affiliate_3' => $AffiliateRootId,
                        'status' => 0,
                    );
                }
                $level = $Parrent['level'] + 1;
                $channel_id = $this->M_channel->get_channel_id($Parrent['artist_id'], $level);
                if($channel_id)
                { 
                    $dataArray = array('channel_id'=> $channel_id, 'affiliate_id'=> $U_map['affiliate_id'], 'level' =>$level);
                    $this->M_channel->save_channel_affilaites($dataArray);
                }
                else
                {
                    $channel_data = $this->M_channel->check_artist_affiliates_channel($Parrent['artist_id']);
                    if(empty($channel_data))
                    {
                        for ($i=1; $i <= 4; $i++) { 
                            $channel_name = $this->M_user->get_name($Parrent['artist_id']).'-Affilaite-Level'.$i;
                            $dataArray = array('name'=> $channel_name, 'user_id'=> $Parrent['artist_id'], 'type' =>'private', 'time'=> time(), 'is_admin'=> 0, 'group_type'=>'affiliates', 'group_id'=>$Parrent['artist_id'], 'level'=>$i);
                           $channel_id = $this->M_channel->save($dataArray);
                           $dataArray = array('channel_id'=> $channel_id, 'affiliate_id'=> $this->M_affiliate->get_affilaite_id($Parrent['artist_id']), 'level' =>$i);
                           $this->M_channel->save_channel_affilaites($dataArray);
                           if($level == $i)
                           {
                                $dataArray = array('channel_id'=> $channel_id, 'affiliate_id'=> $U_map['affiliate_id'], 'level' =>$level);
                                $this->M_channel->save_channel_affilaites($dataArray);
                           }
                        }
                    }
                }

                $insertArr = array(
                    'affiliate_id' => $U_map['affiliate_id'],
                    'parrent_id' => $AffiliateRootId,
                );
                $this->db->insert('conect_affiliates', $insertArr);
                $this->db->insert('affiliate_level', $InsertNewLevel);
            }
            //add notifycation
            $check_notifi = $this->M_user->check_onoff_request($Parrent['artist_id']);
            if ($check_notifi) {
                $this->M_notify->addnotify($Parrent['artist_id'], 'New Request to become an <a href="'.base_url("amper/dashboard_affiliates").'">Affiliate</a> ', 'amper_register');
            }
            //update list artist
            $this->M_affiliate->update_list_artist($U_map['id'], $Parrent['artist_id']);
        }
}
        redirect('amper/selectalbums/affiliate/'.$AffiliateRootId);
        //redirect('amper/dashboard');
    }
    /**
     * Edit prfile affilate
     * update database.
     **/
    public function edit_profile()
    {
        $this->is_login();
        $data['U_map'] = $this->session->userdata('U_map');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'Firstname', 'required|max_length[50]');
        $this->form_validation->set_rules('last_name', 'Lastname', 'required|max_length[50]');
        $this->form_validation->set_rules('email_paypal', 'Paypal', 'required|max_length[255]');
        $this->form_validation->set_rules('phone', 'Phone', 'max_length[20]');
        $this->form_validation->set_rules('address', 'Address', 'max_length[255]');
        $this->form_validation->set_rules('city', 'City', 'max_length[255]');
        $this->form_validation->set_rules('company', 'Company', 'max_length[100]');
        $this->form_validation->set_rules('web_url', 'web_url', 'max_length[100]');
        //added by akash
        $this->form_validation->set_rules('fav_place', 'fav_place', 'max_length[100]');
        $this->form_validation->set_rules('best_friend_name', 'best_friend_name', 'max_length[100]');
        $this->form_validation->set_rules('occupation', 'occupation', 'max_length[100]');
        $this->form_validation->set_rules('age_range', 'age_range', 'max_length[100]');
        

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() != false) {
            $updateArr = array(
                'firstname' => $this->input->post('first_name'),
                'lastname' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'website' => $this->input->post('web_url'),
                'gender' => $this->input->post('gender'),
                'fav_place' => $this->input->post('fav_place'),
                'best_friend_name' => $this->input->post('best_friend_name'),
                'occupation' => $this->input->post('occupation'),
                'age_range' => $this->input->post('age_range'),
                'fav_artist' => $this->input->post('favorite_artist'),
                'genre' => $this->input->post('genre'),
                'facebook_username' => $this->input->post('facebook_url'),
                'youtube_username' => $this->input->post('youtube_url'),
                'twitter_username' => $this->input->post('twitter_url'),
                'instagram_username' => $this->input->post('instagram_url'),
            );
            $this->db->update('users', $updateArr, 'id='.$data['U_map']['user_id']);
            $this->db->update('affiliates', array('paypal' => $this->input->post('email_paypal')), 'id='.$data['U_map']['id']);
            $data_user = $this->db->where('id', $data['U_map']['id'])->get('affiliates')->row_array();
            $this->session->set_userdata('U_map', $data_user);
            echo '<div class="alert alert-success alert-dismissable" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <strong>Success!</strong> Updated account profile
            </div>';
        } else {
            $errors = $this->form_validation->error_array(); ?><div class="alert alert-danger alert-dismissable" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  
                  <strong>Error!</strong>
                  <?php foreach ($errors as $error) {
    echo '<br/> -'.$error;
} ?>
             </div><?php

        }
    }
    /**
     * update bio.
     **/
    public function upload_bios()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('bios', 'Bios', 'max_length[1000]');
        if ($this->form_validation->run() != false) {
            $updateArr = array(
                'bio' => $this->input->post('bios'),
            );
            $data['U_map'] = $this->session->userdata('U_map');
            $this->db->update('users', $updateArr, 'id='.$data['U_map']['user_id']); ?>
            <div class="alert alert-success alert-dismissable" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <strong>Success!</strong> Updated bios
            </div>
            <?php

        } else {
            $errors = $this->form_validation->error_array(); ?><div class="alert alert-danger alert-dismissable" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Error!</strong>
                  <?php foreach ($errors as $error) {
    echo '<br/> -'.$error;
} ?>
             </div><?php

        }
    }
    /**
     * Upload photo.
     **/
    public function upload_photo()
    {
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('caption', 'caption', 'trim|required');
        $this->form_validation->set_rules('check', 'check', 'required');
        if (!empty($_FILES['photo']['name'])) {
            if ($this->form_validation->run() != false) {
                $this->upload->initialize($this->config());
                if (!$this->upload->do_upload('photo')) {
                    $data['update_error'] = $this->upload->display_errors(); ?><div class="alert alert-danger alert-dismissable" role="alert">
                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                          <strong>Error!</strong>
                          <?=$data['update_error']?>
                     </div><?php
                    die;
                } else {
                    $user_id = $this->U_map['user_id'];
                    $datafile = $this->upload->data();
                    $caption = $this->input->post('caption');
                    $updateArr = array(
                        'filename' => $datafile['file_name'],
                        'user_id' => $user_id,
                        'caption' => $caption,
                    );
                    $this->db->insert('photos', $updateArr); ?>
                    <div class="alert alert-success alert-dismissable" role="alert">
                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <strong>Success!</strong> Updated Photo
                    </div>
                    <?php

                }
            } else {
                $errors = $this->form_validation->error_array(); ?><div class="alert alert-danger alert-dismissable" role="alert">
                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <strong>Error!</strong>
                      <?php foreach ($errors as $error) {
    echo '<br/> -'.$error;
} ?>
                 </div><?php

            }
        }
    }
    /**
     * Config upload photo.
     **/
    public function config()
    {
        $loged_in = $this->U_map['user_id'];
        $config = array();
        $config['upload_path'] = './uploads/'.$loged_in.'/photo/';
        echo $loged_in;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        } else {
            chmod($config['upload_path'], 0777);
        }
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '80000';
        $config['file_name'] = uniqid();

        return $config;
    }
    /**
     * Vew dashboard AMP.
     **/
    public function dashboard()
    {
         
        $data['U_map'] = $this->U_map;
        $results = $this->db->get_where('users', array('id' => $this->U_map['user_id']))->row_array();
        $user_id = $results['id'];
        $user = $this->session->userdata('user_data');
        $data['user_data'] = $user;
        $data1=$this->db->where('id', $user_id)->get('users')->row_array();
        $parent_approve=$data1['parental_approve'];
    if($parent_approve==1){
        if (!empty($results)) {
            if ($results['role'] == 1 && $results['plan_status'] == 0) {
                redirect('subscriptions/checkout/Artist_basic');
                die;
            }
            //$data['city'] = $results['city'];  
            $data['photos'] = $this->db->where('user_id', $user_id)
                ->limit(6)->order_by('id', 'DESC')
                ->get('photos')->result_array();
            $data['videos'] = $this->db->where('user_id', $user_id)
                ->limit(3)->order_by('id', 'DESC')
                ->get('videos')->result_array();
            $data['user_data'] = $results;
			//echo "<pre>";print_r($user);echo "</pre>";exit;
			if($user['role'] == 1)
			{
				$data['landings'] = $this->db->where('type', 'landing')->where('active', 1)->order_by('position', 'ASC')->get('template_lands')->result_array();
			}
			else if($user['role'] == 2)
			{
				$data['landings'] = $this->db->where('type', 'landing_flp')->where('active', 1)->order_by('position', 'ASC')->get('template_lands')->result_array();
			}
            $data['langing_select'] = $this->db->where('type', 'landing')->where('active', 1)->where('position', $results['template_landing'])->get('template_lands')->row_array();

            $data['link_content'] = 'dashboard_home.php';
          
            if ($this->input->is_ajax_request()) {
                // check if request comes from an ajax
                $this->load->view('amper/dashboard_home.php', $data);
            } else {
                $this->load->view('includes/header', $data);
                $this->load->view('includes/navbar', $data);
                $this->load->view('amper/dashboard_amper.php', $data);
                $this->load->view('includes/footer', $data);
            }
        }
        } else {
            redirect('auth/amp_form');
        }
    }
    /**
     * Vew Setting widget AMP.
     **/
    public function dashboard_setting_amp()
    {
        $data['U_map'] = $this->db->where('id', $this->U_map['id'])->get('affiliates')->row_array();
        $data['user_data'] = $this->db->get_where('users', array('id' => $this->U_map['user_id']))->row_array();
        $data['Playlist'] = $this->db->where('user_id', $data['U_map']['user_id'])->get('playlist_amp')->result_array();
        $data['Id_artist'] = $this->U_map['artist_id'];

        if (empty($data['U_map']['option_widget'])) {
            $this->M_audio_song->new_options_aff($data['U_map']['affiliate_id'], $this->U_map['artist_id']);
            $data_user = $this->db->where('id', $data['U_map']['id'])->get('affiliates')->row_array();
            $this->session->set_userdata('U_map', $data_user);
        }
        $data_user = $this->db->where('id', $data['U_map']['id'])->get('affiliates')->row_array();
        $data['U_map']['option_widget'] = $data_user['option_widget'];
        $data['link_content'] = 'settingwitdget.php';
        if ($this->input->is_ajax_request()) {
            // check if request comes from an ajax
            $this->load->view('amper/settingwitdget', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('amper/dashboard_amper.php', $data);
            $this->load->view('includes/footer', $data);
        }
    }
    /**
     * Vew profile affiliate.
     **/
    public function profile()
    {
        $this->is_login();
        $data['U_map'] = $this->U_map;
        $data['genres'] = $this->db->get('genres')->result_array();
        $data['list_artist'] = $this->db
            ->where('role', 1)->where('lock', 0)
            ->limit(12, 0)
            ->get('users')->result_array();
        $data['user_data'] = $this->db->where('id', $data['U_map']['user_id'])->get('users')->row_array();
        $data['link_content'] = 'profile.php';
        if ($this->input->is_ajax_request()) {
            // check if request comes from an ajax
            $this->load->view('amper/profile.php', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('amper/dashboard_amper.php', $data);
            $this->load->view('includes/footer', $data);
        }
    }
    /**
     * Vew blogs details.
     *
     * @param string $name
     **/
    public function detailsblogs($name)
    {
        $results = $this->db->get_where('users', array('home_page' => $name))->row();
        if (!empty($results)) {
            $id_blog = $this->input->get('id_blog');
            $data['U_map'] = $this->U_map;
            $data['users'] = $results;
            $data['user_data'] = $this->session->userdata('user_data');
            $data['blog'] = $this->db->where('id', $id_blog)->get('blogs')->row();
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('amper/detail_blog.php', $data);
            $this->load->view('includes/footer', $data);
        }
    }
    /**
     * Ajax Delete photo.
     **/
    public function del_photo($id_photo)
    {
        $user_id = $this->U_map['user_id'];
        $data_photo = $this->db->where('id', $id_photo)->get('photos')->row();
        if (!empty($data_photo) && $data_photo->user_id == $user_id) {
            $this->M_photo->deleteWhere($id_photo);
            $upload_path = './uploads/'.$user_id.'/photos/';
            unlink($upload_path.$data_photo['filename']); ?>
            <div class="alert alert-success alert-dismissable" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <strong>Success!</strong> Delete Photo
            </div>
            <?php

        } else {
            ?><div class="alert alert-danger alert-dismissable" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Error!</strong>
                  Can not delete this photo
             </div><?php 
        }
    }
    /**
     * upload video youtube.
     **/
    public function link_video()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_video', 'Name', 'required|max_length[255]');
        $this->form_validation->set_rules('link_video', 'Link', 'required|max_length[255]');
        $user_id = $this->U_map['user_id'];
        if ($this->form_validation->run() != false) {
            $post_link = $this->input->post('link_video');
            $parse = parse_url($post_link);
               
            if ($parse['host'] == 'www.youtube.com') {
                $updateArr = array(
                    'name_video' => $this->input->post('name_video'),
                    'link_video' => $this->input->post('link_video'),
                    'user_id' => $user_id,
                    'type' => 'link',
                    'create_date' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('videos', $updateArr);
            }
            else if ($parse['host'] == 'vimeo.com' or $parse['host'] == 'www.vimeo.com') {
                $updateArr = array(
                    'name_video' => $this->input->post('name_video'),
                    'link_video' => $this->input->post('link_video'),
                    'user_id' => $user_id,
                    'type' => 'link-vimeo',
                    'create_date' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('videos', $updateArr);
            }
        } else {
            $errors = $this->form_validation->error_array();
            $messg = '';
            foreach ($errors as $error) {
                $messg .= '<br/> -'.$error;
            }
            $this->session->set_flashdata('message_error', $messg);
        }
    }
    /**
     * upload video.
     **/
    public function file_video()
    {
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_video', 'Name', 'required|max_length[255]');
        $user_id = $this->U_map['user_id'];
        if (!empty($_FILES['video_file']['name'])) {
            if ($this->form_validation->run() != false) {
                $this->upload->initialize($this->set_upload_options());
                if (!$this->upload->do_upload('video_file')) {
                    $data['update_error'] = $this->upload->display_errors();
                    echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                    echo  '<h4><strong>Error!</strong></h4>';
                    echo  '<p> '.$data['update_error'].'</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_error', $data['update_error']);
                } else {
                    $datafile = $this->upload->data();
                    $name_file_image = uniqid().'.png';
                    $path_cover_image = FCPATH.'uploads/'.$user_id.'/video/'.$name_file_image;
                    $cmd = '-i '.$datafile['full_path'].' -ss 00:00:03 -vframes 1 '.$path_cover_image;
                    //ffmpeg -i input.flv -ss 00:00:14.435 -vframes 1 out.png
                    exec_ffmeg($cmd);
                    $name = $this->input->post('name_video');
                    $insertArr = array(
                        'name_video' => $name,
                        'name_file' => $datafile['file_name'],
                        'user_id' => $user_id,
                        'type' => 'file',
                        'cover_image' => $name_file_image,
                        'link_video'=>" "
                    );
                    $this->db->insert('videos', $insertArr);
                    echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                    echo  '<h4><strong>Succces!</strong></h4>';
                    echo  '<p> Upload video completed</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_msg', ' Upload video completed');
                }
            }
        }
    }
    /**
     * config upload video.
     **/
    private function set_upload_options()
    {
        $loged_in = $this->U_map['user_id'];
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/'.$loged_in.'/video/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        } else {
            chmod($config['upload_path'], 0777);
        }
        $config['allowed_types'] = 'mp4|avi|mov|flv';
        $config['max_size'] = '160000';
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        $config['file_name'] = uniqid();

        return $config;
    }
    /**
     * delete video.
     **/
    public function del_video($id_video)
    {
        $user_id = $this->U_map['user_id'];
        $data = $this->db->where('id=', $id_video)->get('videos')->row_array();
        if ($data['user_id'] == $user_id) {
            if ($data['type'] == 'file') {
                $this->db->delete('videos', array('id' => $id_video));
                $upload_path = './uploads/'.$data['user_id'].'/video/';
                unlink($upload_path.$data['name_file']);
                unlink($upload_path.$data['cover_image']);
            } else {
                $this->db->delete('videos', array('id' => $id_video));
            } ?>
            <div class="alert alert-success alert-dismissable" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <strong>Success!</strong>  Delete  video completed
            </div>
            <?php

        } else {
            ?>
            <div class="alert alert-danger alert-dismissable" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <strong>Error!</strong>  This is video can not delete
            </div>
            <?php

        }
    }
    /**
     * Change landing page.
     **/
    public function changelayout()
    {
        $user_id = $this->U_map['user_id'];
        $type = $this->input->post('template_landing');

        if (isset($type)) {
            $updateArr = array('template_landing' => $type);
            $this->db->update('users', $updateArr, 'id='.$user_id); ?>
            <div class="alert alert-success alert-dismissable" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <strong>Success!</strong> Layout Change Completed
            </div>
            <?php 
        } else {
            ?>
            <div class="alert alert-danger alert-dismissable" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <strong>Error!</strong> Can Not Change Layout
            </div>
            <?php

        }
    }

    public function post_option_widget()
    {
        $U_map = $this->U_map;
        $data_post = $this->input->post('data');
        $data_post = json_encode($data_post);
        $this->db->update('affiliates', array('option_widget' => $data_post), 'id ='.$U_map['id']);
        $data_user = $this->db->where('id', $U_map['id'])->get('affiliates')->row_array();
    }

    public function is_login()
    {
        $U_map = $this->U_map;
        if (!isset($U_map)) {
            $this->session->set_flashdata('message_error', '<b>Error</b>! You Not Login Account');
            redirect('account/login');
            die;
        }
    }
    public function check_plan_amper()
    {
        $U_map = $this->U_map;
        if (!isset($U_map)) {
            $this->session->set_flashdata('message_error', '<b>Error</b>! You Not Login Account');
            redirect('account/login');
            die;
        } else {
            $check_amp = $this->M_user->check_subscription_amp($U_map['user_id']);
            if (!$check_amp) {
                $this->session->set_flashdata('message_error', '<b>Error</b>! Your Account need subcription Service AMP');
                redirect('subscriptions/upgrade');
            }
        }
    }
}
