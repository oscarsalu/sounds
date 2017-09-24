<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Presskit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_photo');
        $this->load->model('M_audio_song');
        $this->load->model('M_video');
        $this->load->model('M_user');
        $this->load->model('M_text');
        $this->load->model('M_blog');
        $this->load->model('M_comment');
        $this->load->model('M_press');
        $this->load->model('M_fan');
        $this->load->model('Member_model');
		$this->load->helper('url');
        $this->load->model('Events_model');
        $this->load->model('M_customize_epk');
       
        $ac = $this->session->userdata('access');
        $this->U_map = $this->session->userdata('U_map');
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

public $U_map;

    /**
     * View Dashborad press kit elactronic.
     **/
    public function presskit()
    {
	      
        $user_id = $this->session->userdata('loged_in');
        $data['U_map'] = $this->db->where('id', $this->U_map['id'])->get('affiliates')->row_array();
        $data['user_id'] = $user_id;
        $data['user_data'] = $this->session->userdata('user_data');
        if (check_live_server()) {
            $page = file_get_contents('http://graph.facebook.com/?id='.base_url('epk/'.$data['user_data']['home_page']));
            $page = json_decode($page, true);
            empty($page['share']['share_count']) ? $share_count_fb = 0 : $share_count_fb = $page['share']['share_count'];
            $view_tats = $this->db->where('artist_id', $user_id)->get('stats_presskit')->row_array();
            if (!empty($view_tats)) {
                $updateArr = array(
                    'share_fb' => $share_count_fb,
                );
                $this->db->update('stats_presskit', $updateArr, 'artist_id = '.$user_id);
            } else {
                $updateArr = array(
                    'artist_id' => $user_id,
                    'share_fb' => $share_count_fb,
                );
                $this->db->insert('stats_presskit', $updateArr);
            }
            /*
            $page = file_get_contents('http://cdn.api.twitter.com/1/urls/count.json?url='.base_url('epk/'.$data['user_data']['home_page']));
            $page = json_decode($page, true);
            empty($page[0]) ? $share_count_tw = 0 : $share_count_tw = $page[0]['count'];
            $view_tats = $this->db->where('artist_id', $user_id)->get('stats_presskit')->row_array();
            if (!empty($view_tats)) {
                $updateArr = array(
                    'share_tw' => $share_count_tw,
                );
                $this->db->update('stats_presskit', $updateArr, 'artist_id = '.$user_id);
            } else {
                $updateArr = array(
                    'artist_id' => $user_id,
                    'share_tw' => $share_count_tw,
                );
                $this->db->insert('stats_presskit', $updateArr);
            }
            */
           
        }
        $this->init_customize_epk($user_id);
            
        $data['avata'] = $this->M_user->get_avata($user_id);
        $data['statsrpk'] = $this->db->where('artist_id', $user_id)->order_by('id', 'DESC')->get('stats_send_rpk')->result_array();
        $data['country_code'] = $this->db->where('id', $data['user_data']['countries'])->get('countries')->row_array();
        $data['genres'] = $this->db->where('id', $data['user_data']['genre'])->get('genres')->row_array();
        $data['message_body'] = 'hoo';
        $data['video'] = $this->db->where('user_id', $user_id)->order_by('id', 'DESC')->limit(4)->get('videos')->row_array();
        $data['view_tats'] = $this->db->where('artist_id', $user_id)->get('stats_presskit')->row_array();
        $data['controller'] = $this;
        $data['epks'] = $this->db->where('type', 'epk')->where('active', 1)->order_by('position', 'ASC')->get('template_lands')->result_array();
		
        $data['epk'] = $this->db->select('id, tpl_epk')->where('id = ', $user_id)->get('users')->row();
		$data['events'] = $this->Events_model->getAllEvents($user_id);
        $data['blogs'] = $this->M_blog->get_artist_blogs($user_id);
        $data['press_data'] = $this->M_press->get_all_press($user_id);
        $data['user_data'] = $this->session->userdata('user_data');
        $data['artist_data']=$this->db->where('id',$user_id)->get('users')->row_array();
        $data_custom = $this->db->where('user_id', $user_id)->get('customize_epk')->row_array();
        $data['data_customize'] = json_decode($data_custom['data_customize']);

        //Code for change Epk bio
        $data['epk_bio'] = (!empty($data_custom['epk_bio'])) ? $data_custom['epk_bio'] : $data['artist_data']['bio'];
        $data['email_contact'] = $data_custom;
		$data['meta_rpk'] = true;
        $data['epk_data'] = $data_custom;
		/* my image code function start added by sunil */
        if(empty($data_custom['epk_display_info']))
        {
            $data_epk = $this->M_customize_epk->save_epk_info_display($user_id);
            $data['epk_display_info'] = $data_epk;
        }
        else
        {
            $data['epk_display_info'] = json_decode($data_custom['epk_display_info']);
            if (!(array_key_exists('age_break_down_display', $data['epk_display_info']))) 
            {
                $data['epk_display_info']->age_break_down_display = 'on';
                $this->M_customize_epk->update_epk_display_info($data['epk_display_info'], $user_id);
            }
        }
         //$data['userpro'] = $this->db->select('filename,user_id')->where('user_id = ', $user_id)->get('photos');
        
		$data['num_songs'] = $this->M_audio_song->num_songs_epk($user_id);
        $data['num_video'] = $this->M_video->num_videos_epk($user_id);
        $data['num_blogs'] = $this->M_blog->num_blogs_artist($user_id);
        $data['num_fans'] = $this->M_fan->num_fans($user_id);
        $data['num_comments'] = $this->M_comment->num_comments_alp($user_id);
        $data['num_events'] =$this->Events_model->num_events($user_id);
             
		$data['epk_photos'] = $this->M_photo->list_photos_epk($user_id, $data_custom['photo_limit']);
        $data['epk_videos'] = $this->M_video->list_videos_epk($user_id, $data_custom['video_limit']);
        $data['epk_events'] = $this->Events_model->get_select_show_epk($user_id);
        $data['epk_blogs'] = $this->M_blog->list_blogs_epk($user_id);
        $data['epk_press'] = $this->M_press->list_press_epk($user_id, $data_custom['press_limit']);
        $data['album_songs'] = $this->M_audio_song->get_all_albums_epk($user_id);
        $data['listsong'] = $this->M_audio_song->get_all_epk_songs($user_id, $data_custom['song_limit']);
        $data['controller'] = $this;

	    $this->db->select('filename,user_id,id');
        $this->db->from("photos");
        $this->db->where("user_id", $user_id);
        $query = $this->db->get();
 		$data['userpro'] = $query->result(); 
 		  
				 
		 
   	    /* my image code function close added by sunil */

        //init data epk
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/new_RPK', $data);
        $this->load->view('includes/footer', $data);
		
		 
    }
    /**
     * View Press kit.
     *
     * @param string $name
     **/
    public function index($name)
    {
      	
		$results = $this->db->get_where('users', array(
            'home_page' => $name,
        ))->row_array();
        if (!empty($results)) {
            $user_id = $results['id'];
            $user = $results;
            $CounterHits = $this->session->userdata('CounterHits_epk');
            if (!isset($CounterHits)) {
                $this->session->set_userdata('CounterHits_epk', true);
                $this->M_user->Counter_hits($user_id, 'epk');
            }
            $data['song'] = $this->M_audio_song->list_songs_epk($user_id, 1);
            $data['user_data'] = $user;
            $data['user_id'] = $user_id;
            $data['country'] = $this->db->where('id', $user['countries'])->get('countries')->row_array();
            $data['genre'] = $this->db->where('id', $user['genre'])->get('genres')->row_array();
            $data['U_map'] = $this->db->where('id', $this->U_map['id'])->get('affiliates')->row_array();
            $data['groups_member'] = $this->db->where('artist_id', $user_id)->order_by('id', 'DESC')->get('groups_member')->result_array();
            $data['customize'] = $this->M_customize_epk->get_customize_user_data($user_id);
            $data['num_songs'] = $this->M_audio_song->num_songs_epk($user_id);
            $data['num_video'] = $this->M_video->num_videos_epk($user_id);
            $data['num_blogs'] = $this->M_blog->num_blogs_artist($user_id);
            $data['num_fans'] = $this->M_fan->num_fans($user_id);
            $data['num_events'] =$this->Events_model->num_events($user_id);
            $data['num_comments'] = $this->M_comment->num_comments_alp($user_id);
            $data['view_tats'] = $this->db->where('artist_id', $user_id)->get('stats_presskit')->row_array();
            $option_widget = $this->M_audio_song->get_options($user_id);
            if($option_widget)
            {
                $optionsArray = json_decode($option_widget);
                $albumId = $optionsArray->playlistAlbumIds;
                $albumroot = $this->db->where('user_id', $user_id)->where('id', $albumId)->get('playlist_amp')->row_array();
                $data['album_song'] = $this->db->where('user_id', $user_id)->where('num_song >', 0)->where('id', $albumroot['album_root'])->get('album_song')->row_array();

            }
            
            $data['songs'] = $this->M_audio_song->list_songs_epk($user_id, $data['customize']['song_limit']);
            $data['download_songs'] = $this->M_audio_song->list_songs_download($user_id, $data['customize']['download_song_limit']);
            $data['videos'] = $this->M_video->list_videos_epk($user_id, $data['customize']['video_limit']);
            $data['photos'] = $this->M_photo->list_photos_epk($user_id, $data['customize']['photo_limit']);

            $data['press'] = $this->M_press->list_press_epk($user_id, $data['customize']['press_limit']);
			$data['photo'] = $this->M_photo->getPhotoProfile($user_id);
            //Code added to display Selected Events on Dashboard
            $data['events'] = $this->Events_model->get_select_show_epk($user_id);

			$data['fans'] = $this->db->select('fans.*,users.birthday,users.gender')->from('fans')->where('fans.user_id', $user_id)->join('users', 'fans.fan_id = users.id')->join('photos', 'fans.fan_id = photos.user_id', 'left')->get()->result_array();
            $data['meta_rpk'] = true;
            $data['avata'] = $this->M_user->get_avata($user_id);
            $data['epk_blogs'] = $this->M_blog->list_blogs_epk($user_id);
            $tpl = $user['tpl_epk'];
            $data['res_data_artist'] = $results;
            $data['epk_bio'] = $data['customize']['epk_bio'];
            $data['data_json'] = json_decode($data['customize']['data_customize']);
            $data['epk_display_info'] = json_decode($data['customize']['epk_display_info']);
            // echo "<div style='border-bottom: 2px solid red;border-color: red;border-width: 2px;font-size: 20px;font-weight: bold;margin-left: auto;margin-right: auto;text-align: center;width: 15%;'>Template ".$tpl."</div>";
            $albumIds = $this->M_audio_song->fetch_albums_id($user_id);
            $idstr = "";
            $i = 0;
            $numcount = count($albumIds);
            foreach ($albumIds as $key => $value) {
                if(++$i === $numcount)
                {
                    $idstr .= $value->id;
                }
                else
                {
                    $idstr .= $value->id.',';
                }
            }
            $data['albumIds'] = $idstr;
            $newArray = array();
            foreach ($data['videos'] as $key => $value) 
            {
              if($value['type'] == "link" && strpos($value['link_video'],"youtube.com"))
              {
                  $videoArr = explode("v=",$value['link_video']);
                  $videoId  = ""; 
                  if(strpos($videoArr[1],'&'))
                  {
                    $temp = explode("&",$videoArr[1]);
                    $videoId = $temp[0];  
                  }
                  else
                    $videoId = $videoArr[1];

                  $imageSrc = 'https://img.youtube.com/vi/'.$videoId.'/default.jpg';
              }
              elseif($value['type'] == "link-vimeo"){
                  $video_vimeo=basename($value['link_video']);
                 
                  $get_link='http://vimeo.com/api/v2/video/'.$video_vimeo.'.php';
                 
                  $hash = unserialize(file_get_contents($get_link));
                  $image=$hash[0]['thumbnail_medium']; 
                  $imageSrc = $image;
              }
              else{
                  $imageSrc = base_url().'uploads/'.$value['user_id'].'/video/'.$value['cover_image'];
              }
              $value['imageSrc'] = $imageSrc;
              $newArray[] = $value;
            }
            $data['videos'] = $newArray;
            $data['affiliatesId'] = $this->db->select('affiliate_id')->where('user_id', $user_id)->get('affiliates')->row()->affiliate_id;
            if($this->input->get('action')){
                
                $html = $this->load->view('html_template/pdf', $data, true);
                //this the the PDF filename that user will get to download
                $pdfFilePath = "$name-epk.pdf";
                
                $this->load->library('m_pdf');
                
                
                //generate the PDF!
                $pdf = $this->m_pdf->load();
                $pdf->SetDisplayMode('fullpage');
                $mpdf->list_indent_first_level = 0;
                // $pdf->showStats = true;
                $pdf->WriteHTML($html);
                //offer it to user via browser download! (The PDF won't be saved on your server HDD)
                $pdf->Output($pdfFilePath, "D");
            }else{
                if($tpl == 1 || $tpl == 2 || $tpl == 3 || $tpl == 4){
                    $this->load->view('artist/presskit/template'.$tpl.'_new', $data);
                }
                else{
                    $this->load->view('artist/presskit/template'.$tpl, $data);
                }
            }

            //stats views 
            $view_tats = $this->db->where('artist_id', $user_id)->get('stats_presskit')->row_array();
            if (!empty($view_tats) || $view_tats['view'] == 0) {
                $updateArr = array(
                    'artist_id' => $user_id,
                    'view' => $view_tats['view'] + 1,
                );
                $this->db->update('stats_presskit', $updateArr, 'artist_id = '.$user_id);
            } else {
                $updateArr = array(
                    'artist_id' => $user_id,
                    'view' => 1,
                );
                $this->db->insert('stats_presskit', $updateArr);
            }
        } else {
            show_404();
        }
    }
	
	public function update_img($id)
	{      
		$user_id = $this->session->userdata('loged_in');
        //code added for saving image in EPK
        $epk_data = $this->M_customize_epk->set_epk_photo($user_id, $id); 
        $data['photo'] = $this->M_photo->changePhotoProfile($id, $user_id);
        echo $epk_data;
        
  	}
	
    /*update video id */
    	
    public function update_video($id)
    {      
       $user_id = $this->session->userdata('loged_in');
       $data['video'] = $this->M_customize_epk->set_epk_video($id, $user_id);
    }
    /*update video close*/	
    /**
     * Send email press kit.
     **/
    public function sendmail()
    {
        $this->load->model('Member_model');
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('from', 'From', 'required');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        if ($this->form_validation->run() != false) {
            $user_id = $this->session->userdata('loged_in');
            $user_data = $this->session->userdata('user_data');
            $email_from = $this->input->post('from');
            $tpl_email = $this->input->post('tpl_email');
            $email_to = array_filter($this->input->post('emailto'));
            $list_email = implode(',', $email_to);
            $name_to = $this->input->post('nameto');
            $message_body = $this->input->post('msg');
            $subject = $this->input->post('subject');
   //          $data['avata'] = $this->M_user->get_avata($user_id);
   //          $data['country_code'] = $this->db->where('id', $user_data['countries'])->get('countries')->row_array();
   //          $data['genres'] = $this->db->where('id', $user_data['genre'])->get('genres')->row_array();
    $data['user_data'] = $user_data;
   $data['message_body'] = $message_body;
   //          $data['songs'] = $this->db->where('user_id', $user_id)->limit(5)->order_by('id', 'DESC')->get('audio_song')->result_array();
   //          $data['photos'] = $this->db->where('user_id', $user_id)->limit(5)->order_by('id', 'DESC')->get('photos')->result_array();
   //          $data['press'] = $this->db->where('artist_id', $user_id)->limit(5)->order_by('id', 'DESC')->get('press')->result_array();
   //          $data['videos'] = $this->db->where('user_id', $user_id)->order_by('id', 'DESC')->get('videos')->result_array();
   //          $data['customize'] = $this->db->where('user_id', $user_id)->get('customize_epk')->row_array();
   //          $data['country'] = $this->db->where('id', $user_data['countries'])->get('countries')->row_array();
   $data['genre'] = $this->db->where('id', $user_data['genre'])->get('genres')->row_array();
   //          $data['groups_member'] = $this->db->where('artist_id', $user_id)->order_by('id', 'DESC')->get('groups_member')->result_array();
   //          $data['num_songs'] = $this->db->where('user_id', $user_id)->count_all_results('audio_song');
   //          $data['songs'] = $this->db->where('user_id', $user_id)->order_by('id', 'DESC')->get('audio_song')->result_array();
   //          $data['videos'] = $this->db->where('user_id', $user_id)->order_by('id', 'DESC')->get('videos')->result_array();
   //          $data['num_video'] = $this->db->where('user_id', $user_id)->count_all_results('videos');
   //          $data['photos'] = $this->db->where('user_id', $user_id)->limit(4)->order_by('id', 'DESC')->get('photos')->result_array();
   //          $data['fans'] = $this->db->select('fans.* ,users.birthday,users.gender')->from('fans')->where('fans.user_id', $user_id)->join('users', 'fans.fan_id = users.id')->join('photos', 'fans.fan_id = photos.user_id', 'left')->get()->result_array();
   //          $data['press'] = $this->db->where('artist_id', $user_id)->order_by('id', 'DESC')->get('press')->result_array();
            
			// $data['photo'] = $this->M_photo->getPhotoProfile($user_id);
   $results = $this->db->get_where('users', array(
                'home_page' => $user_data['home_page'],
            ))->row_array();
            $data['res_data_artist'] = $results;
   //          $data['song'] = $this->M_audio_song->list_songs_epk($user_id, 1);
   //          $data['user_data'] = $user;
   //          $data['user_id'] = $user_id;
            // $data['country'] = $this->db->where('id', $user['countries'])->get('countries')->row_array();
            // $data['genre'] = $this->db->where('id', $user['genre'])->get('genres')->row_array();
            // $data['U_map'] = $this->db->where('id', $this->U_map['id'])->get('affiliates')->row_array();
            // $data['groups_member'] = $this->db->where('artist_id', $user_id)->order_by('id', 'DESC')->get('groups_member')->result_array();
            $data['customize'] = $this->M_customize_epk->get_customize_user_data($user_id);
            $data['num_songs'] = $this->M_audio_song->num_songs_epk($user_id);
            $data['num_video'] = $this->M_video->num_videos_epk($user_id);
            $data['num_blogs'] = $this->M_blog->num_blogs_artist($user_id);
            $data['num_fans'] = $this->M_fan->num_fans($user_id);
            $data['num_events'] =$this->Events_model->num_events($user_id);
            $data['num_comments'] = $this->M_comment->num_comments_alp($user_id);
            $data['view_tats'] = $this->db->where('artist_id', $user_id)->get('stats_presskit')->row_array();
            $option_widget = $this->M_audio_song->get_options($user_id);
            if($option_widget)
            {
                $optionsArray = json_decode($option_widget);
                $albumId = $optionsArray->playlistAlbumIds;
                $albumroot = $this->db->where('user_id', $user_id)->where('id', $albumId)->get('playlist_amp')->row_array();
                $data['album_song'] = $this->db->where('user_id', $user_id)->where('num_song >', 0)->where('id', $albumroot['album_root'])->get('album_song')->row_array();

            }
            
            $data['songs'] = $this->M_audio_song->list_songs_epk($user_id, $data['customize']['song_limit']);
            $data['download_songs'] = $this->M_audio_song->list_songs_download($user_id, $data['customize']['download_song_limit']);
            $data['videos'] = $this->M_video->list_videos_epk($user_id, $data['customize']['video_limit']);
            $data['photos'] = $this->M_photo->list_photos_epk($user_id, $data['customize']['photo_limit']);

            $data['press'] = $this->M_press->list_press_epk($user_id, $data['customize']['press_limit']);
            $data['photo'] = $this->M_photo->getPhotoProfile($user_id);
            //Code added to display Selected Events on Dashboard
            $data['events'] = $this->Events_model->get_select_show_epk($user_id);

            $data['fans'] = $this->db->select('fans.*,users.birthday,users.gender')->from('fans')->where('fans.user_id', $user_id)->join('users', 'fans.fan_id = users.id')->join('photos', 'fans.fan_id = photos.user_id', 'left')->get()->result_array();
            $data['meta_rpk'] = true;
            $data['avata'] = $this->M_user->get_avata($user_id);
            $data['epk_blogs'] = $this->M_blog->list_blogs_epk($user_id);
            $tpl = $user['tpl_epk'];
            $data['res_data_artist'] = $results;
            $data['epk_bio'] = $data['customize']['epk_bio'];
            $data['data_json'] = json_decode($data['customize']['data_customize']);
            $data['epk_display_info'] = json_decode($data['customize']['epk_display_info']);
            // echo "<div style='border-bottom: 2px solid red;border-color: red;border-width: 2px;font-size: 20px;font-weight: bold;margin-left: auto;margin-right: auto;text-align: center;width: 15%;'>Template ".$tpl."</div>";
            $albumIds = $this->M_audio_song->fetch_albums_id($user_id);
            $idstr = "";
            $i = 0;
            $numcount = count($albumIds);
            foreach ($albumIds as $key => $value) {
                if(++$i === $numcount)
                {
                    $idstr .= $value->id;
                }
                else
                {
                    $idstr .= $value->id.',';
                }
            }
            $data['albumIds'] = $idstr;
            $newArray = array();
            foreach ($data['videos'] as $key => $value) 
            {
              if($value['type'] == "link" && strpos($value['link_video'],"youtube.com"))
              {
                  $videoArr = explode("v=",$value['link_video']);
                  $videoId  = ""; 
                  if(strpos($videoArr[1],'&'))
                  {
                    $temp = explode("&",$videoArr[1]);
                    $videoId = $temp[0];  
                  }
                  else
                    $videoId = $videoArr[1];

                  $imageSrc = 'https://img.youtube.com/vi/'.$videoId.'/default.jpg';
              }
              elseif($value['type'] == "link-vimeo"){
                  $video_vimeo=basename($value['link_video']);
                 
                  $get_link='http://vimeo.com/api/v2/video/'.$video_vimeo.'.php';
                 
                  $hash = unserialize(file_get_contents($get_link));
                  $image=$hash[0]['thumbnail_medium']; 
                  $imageSrc = $image;
              }
              else{
                  $imageSrc = base_url().'uploads/'.$value['user_id'].'/video/'.$value['cover_image'];
              }
              $value['imageSrc'] = $imageSrc;
              $newArray[] = $value;
            }
            $data['videos'] = $newArray;
            if ($tpl_email == 1) {
                $message = $this->load->view('email/presskit1', $data, true);
            } elseif ($tpl_email == 2) {
                $message = $this->load->view('email/presskit2', $data, true);
            } elseif ($tpl_email == 3) {
                $message = $this->load->view('email/presskit3', $data, true);
            } elseif ($tpl_email == 4) {
                $message = $this->load->view('email/presskit4', $data, true);
            } elseif ($tpl_email == 5) {
                $message = $this->load->view('email/presskit5', $data, true);
            } elseif ($tpl_email == 6) {
                $message = $this->load->view('email/presskit6', $data, true);
            }
            $this->init_customize_epk($user_id);
            /*   
            if($tpl_email==1){
            $message = $this->load->view('artist/presskit/template1',$data,TRUE); 
            }elseif($tpl_email==2){
            $message = $this->load->view('artist/presskit/template2',$data,TRUE); 
            }elseif($tpl_email==3){
            $message = $this->load->view('artist/presskit/template3',$data,TRUE); 
            }elseif($tpl_email==4){
            $message = $this->load->view('artist/presskit/template4',$data,TRUE); 
            }elseif($tpl_email==5){
            $message = $this->load->view('artist/presskit/template5',$data,TRUE); 
            }elseif($tpl_email==6){
            $message = $this->load->view('artist/presskit/template6',$data,TRUE); 
            }*/
            //$tpl_email = $this->db->query('select tpl_epk from users');
            //var_dump($message);die;
            //config and setup
            $this->load->library('email');
            $config['protocol'] = 'smtp';
            $config['charset'] = 'utf-8';
            $config['mailtype'] = 'html';
            $config['newline'] = "\r\n";
            //send email
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->from($email_from, $data['user_data']['artist_name']);
            $this->email->reply_to($email_from, $data['user_data']['artist_name']);
            $this->email->to($list_email);
            $this->email->subject($subject);
            $this->email->message($message);
            
           if(!$this->email->send()){
               echo "error";
           }
            //update stats
           
           $email_array=new ArrayIterator($email_to);
           $name_array=new ArrayIterator($name_to);
           $array_multiplier=new MultipleIterator;
           $array_multiplier->attachIterator($email_array);
           $array_multiplier->attachIterator($name_array);
      
            foreach ($array_multiplier as $val) {
                $updateArr = array(
                    'artist_id' => $user_id,
                    'email_to' => $val[0],
                    'time' => strtotime('now'),
                    'name_email'=>$val[1],
                    'share_tw'=>"",
                    'share_fb'=>"",
                );
                
                $this->db->insert('stats_send_rpk', $updateArr);
            }
                
                $view_tats = $this->db->where('artist_id', $user_id)->get('stats_presskit')->row_array();
              
                $email_count=$view_tats['send_email']+count($email_to);
                if ($view_tats['send_email']=="") {
                 
                    $updateArr = array(
                        'artist_id' => $user_id,
                        'send_email' => $email_count,
                        'view'=>0,
                        'interactions'=>0,
                        'share_fb'=>0,
                        'share_tw'=>0,
                        'contact'=>0,
                    );
                                        $this->db->insert('stats_presskit', $updateArr);
                    
                } else {
                            
                    $updateArr = array(
                       
                        'send_email' => $email_count,
                    );
                    $this->db->where(array('artist_id'=>$user_id))->update('stats_presskit', $updateArr);
                }
            }
             redirect('artist/dashboard_epk');
        }
       
    
       /**
        * Update Bios
        */ 
        
        public function update_bios(){
            $user_id =$this->input->post('user_id');
            $bios = $this->input->post('bios');
            $data = array('epk_bio'=>$bios);
            $data_update =  $this->M_customize_epk->update_bio($user_id, $data);
            if($data_update){
                echo json_encode(array('msg'=>'Bios Updated Successfully'));
            }
            else {
                echo json_encode("fail");
            }
        }
        
        
    /**
     * Load teamplate email.
     **/
    public function load_tpl_email($tpl_email)
    {
        $user_id = $this->session->userdata('loged_in');
        $user_data = $this->session->userdata('user_data');
        $data['avata'] = $this->M_user->get_avata($user_id);
        $data['country_code'] = $this->db->where('id', $user_data['countries'])->get('countries')->row_array();
        $data['genres'] = $this->db->where('id', $user_data['genre'])->get('genres')->row_array();
        $data['user_data'] = $user_data;
        $data['message_body'] = $this->input->post('msg');
        $data['songs'] = $this->db->where('user_id', $user_id)->limit(5)->order_by('id', 'DESC')->get('audio_song')->result_array();
        $data['photos'] = $this->db->where('user_id', $user_id)->limit(5)->order_by('id', 'DESC')->get('photos')->result_array();
        $data['press'] = $this->db->where('artist_id', $user_id)->limit(5)->order_by('id', 'DESC')->get('press')->result_array();
        $data['videos'] = $this->db->where('user_id', $user_id)->order_by('id', 'DESC')->get('videos')->result_array();
        if ($tpl_email == 1) {
            $message = $this->load->view('email/presskit1', $data, true);
        } elseif ($tpl_email == 2) {
            $message = $this->load->view('email/presskit2', $data, true);
        }
        echo $message;
    }
    /**
     * time calculation.
     **/
    public function time_calculation($timestamp)
    {
        $period = array(
            'second',
            'minute',
            'hour',
            'day',
            'week',
            'month',
            'year',
            'decade',
        );
        $periods = array(
            'seconds',
            'minutes',
            'hours',
            'days',
            'weeks',
            'months',
            'years',
            'decades',
        );
        $lengths = array(
            60,
            60,
            24,
            7,

            4.35,
            12,
            10,
        );
        $timenow = date('Y-m-d H:i:s');
        $now = strtotime('now');
        $difference = $now - $timestamp;
        $tense = 'ago';
        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; ++$j) {
            $difference /= $lengths[$j];
        }
        $difference = round($difference);
        if ($difference != 1) {
            $per = $periods[$j];
        } else {
            $per = $period[$j];
        }
        $string_result = $difference.' '.$per.' ago';

        return $string_result;
    }
    /**
     * Download bio.
     **/
    public function download_bio($id)
    {
        $view_tats = $this->db->where('artist_id', $id)->get('stats_presskit')->row_array();
        if (!empty($view_tats) || $view_tats['interactions'] == 0) {
            $updateArr = array(
                'artist_id' => $id,
                'interactions' => $view_tats['interactions'] + 1,
            );
            $this->db->update('stats_presskit', $updateArr, 'artist_id = '.$id);
        } else {
            $updateArr = array(
                'artist_id' => $id,
                'interactions' => 1,
            );
            $this->db->insert('stats_presskit', $updateArr);
        }

        $epk_data = $this->db->where('user_id='.$id)->get('customize_epk')->row_array();
        $config['upload_path'] = './uploads/'.$id.'/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        } else {
            chmod($config['upload_path'], 0777);
        }
        $myfile = fopen(BASEPATH.'../uploads/'.$id.'/bio.txt', 'w') or die('Unable to open file!');
        $txt = $epk_data['epk_bio'];
        fwrite($myfile, $txt);
        fclose($myfile);
        $this->load->helper('download');
        $data = file_get_contents(BASEPATH.'../uploads/'.$id.'/bio.txt'); // Read the file's contents
        $name = 'bio.txt';
        force_download($name, $data);
        redirect('epk/'.$user_data['home_page']);
    }
    /**
     * Download photo.
     *
     *  @param int $artist_id
     *  @param int $file_name
     **/
    public function download_photo($id, $file)
    {
        $view_tats = $this->db->where('artist_id', $id)->get('stats_presskit')->row_array();
        if (!empty($view_tats) || $view_tats['interactions'] == 0) {
            $updateArr = array(
                'artist_id' => $id,
                'interactions' => $view_tats['interactions'] + 1,
            );
            $this->db->update('stats_presskit', $updateArr, 'artist_id = '.$id);
        } else {
            $updateArr = array(
                'artist_id' => $id,
                'interactions' => 1,
            );
            $this->db->insert('stats_presskit', $updateArr);
        }
        $this->load->helper('download');
        $user_data = $this->db->where('id='.$id)->get('users')->row_array();
        $part = BASEPATH.'../uploads/'.$id.'/photo/'.$file;
        force_download($part, null);
        redirect('epk/'.$user_data['home_page']);
    }

    /**
     * Download photo.
     *
     *  @param int $artist_id
     *  @param int $file_name
     **/
    public function download_video($id, $file)
    {
        $view_tats = $this->db->where('artist_id', $id)->get('stats_presskit')->row_array();
        if (!empty($view_tats) || $view_tats['interactions'] == 0) {
            $updateArr = array(
                'artist_id' => $id,
                'interactions' => $view_tats['interactions'] + 1,
            );
            $this->db->update('stats_presskit', $updateArr, 'artist_id = '.$id);
        } else {
            $updateArr = array(
                'artist_id' => $id,
                'interactions' => 1,
            );
            $this->db->insert('stats_presskit', $updateArr);
        }
        $this->load->helper('download');
        $user_data = $this->db->where('id='.$id)->get('users')->row_array();
        $part = BASEPATH.'../uploads/'.$id.'/video/'.$file;
        force_download($part, null);
        redirect('epk/'.$user_data['home_page']);
    }
    /**
     * Download song.
     **/
    public function download_song($song_id)
    {
        $row = $this->db->where('id', $song_id)->get('audio_song')->row_array();
        if (!empty($row)) {
            $array_avai = explode(',', $row['availability']);
            if (in_array('2', $array_avai)) {
                $view_tats = $this->db->where('artist_id', $row['user_id'])->get('stats_presskit')->row_array();
                if (!empty($view_tats) || $view_tats['interactions'] == 0) {
                    $updateArr = array(
                        'interactions' => $view_tats['interactions'] + 1,
                    );
                    $this->db->update('stats_presskit', $updateArr, 'artist_id = '.$row['user_id']);
                } else {
                    $updateArr = array(
                        'artist_id' => $row['user_id'],
                        'interactions' => 1,
                    );
                    $this->db->insert('stats_presskit', $updateArr);
                }
                $this->load->helper('download');
                $data = file_get_contents('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file']);
                $name = $row['filename'];
                force_download($name, $data);
            }
            $user_data = $this->db->where('id='.$row['user_id'])->get('users')->row_array();
        }
        redirect('epk/'.$user_data['home_page']);
    }
    /**
     * Update tempalte epk.
     **/
    public function update_tplepk()
    {
        $user_id = $this->session->userdata('loged_in');
        $tpl = $this->input->post('template_epk');
        if (isset($tpl)) {
            $updateArr = array(
                'tpl_epk' => $tpl,
            );
            $this->db->update('users', $updateArr, 'id = '.$user_id);
            $user_data = $this->db->where('id='.$user_id)->get('users')->row_array();
            $this->session->set_userdata('user_data', $user_data);
        }
        redirect('artist/dashboard_epk');
    }
    /**
     * Send email contact.
     *
     * @return response
     **/
    public function contact()
    {
        $this->load->library('upload');
        $this->load->library('form_validation');
        $user_id = $this->session->userdata('loged_in');
        $user_data = $this->session->userdata('user_data');
        $this->form_validation->set_rules('from', 'From', 'required');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        //$this->form_validation->set_rules('to', 'To', 'required');
        if ($this->form_validation->run() != false) {
            $email_from = $this->input->post('from');
            $email_to = $this->input->post('to');
            $email1 = $this->input->post('email1');
            $email2 = $this->input->post('email2');
            $email3 = $this->input->post('email3');
            $message_body = $this->input->post('msg');
            $subject = $this->input->post('subject');
            $this->load->library('email');
            $config['protocol'] = 'smtp';
            $config['charset'] = 'utf-8';
            $config['mailtype'] = 'html';
            $config['priority'] = "1";
            $config['newline'] = "\r\n";
            $data_custom = $this->db->where('user_id', $user_id)->get('customize_epk')->row_array();
            //send email
            $this->email->initialize($config);
            if ($email_to['public_email']) {
                $this->email->clear();
                $this->email->from($email_from, $email_from);
                $this->email->to($data_custom['email_artist']);
                $this->email->subject($subject);
                $this->email->message($message_body);
                $this->email->send();
            }
            if ($email_to['booking_email']) {
                $this->email->clear();
                $this->email->from($email_from, $email_from);
                $this->email->to($data_custom['email_booking']);
                $this->email->subject($subject);
                $this->email->message($message_body);
                $this->email->send();
            }
            if ($email_to['mngt_email']) {
                $this->email->clear();
                $this->email->from($email_from, $email_from);
                $this->email->to($data_custom['email_manager']);
                $this->email->subject($subject);
                $this->email->message($message_body);
                $this->email->send();
            }
            if ($email1) {
                $this->email->clear();
                $this->email->from($email_from, $email_from);
                $this->email->to($email1);
                $this->email->subject($subject);
                $this->email->message($message_body);
                $this->email->send();
            }
            if ($email2) {
                $this->email->clear();
                $this->email->from($email_from, $email_from);
                $this->email->to($email2);
                $this->email->subject($subject);
                $this->email->message($message_body);
                $this->email->send();
            }
            if ($email3) {
                $this->email->clear();
                $this->email->from($email_from, $email_from);
                $this->email->to($email3);
                $this->email->subject($subject);
                $this->email->message($message_body);
                $this->email->send();
            }
            //update stats
            $view_tats = $this->db->where('artist_id', $user_id)->get('stats_presskit')->row_array();
            if (!empty($view_tats) || $view_tats['contact'] == 0) {
                $updateArr = array(
                    'artist_id' => $user_id,
                    'contact' => $view_tats['contact'] + 1,
                );
                $this->db->update('stats_presskit', $updateArr, 'artist_id = '.$user_id);
            } else {
                $updateArr = array(
                    'artist_id' => $user_id,
                    'contact' => 1,
                );
                $this->db->insert('stats_presskit', $updateArr);
            }
            $this->session->set_flashdata('message_succsess', ' Send Email Finished!');
        } else {
            $this->session->set_flashdata('message_error', 'Can not send Email!');
        }
        redirect('epk/'.$user_data['home_page']);
    }
    /**
     * Get data customize epk.
     **/
    public function getcustomize()
    {
        $admin = $this->session->userdata('is_admin');
        if (isset($admin) && $admin == 1) {
            $data['is_admin'] = $admin;
        }
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] = $this->session->userdata('user_data');
        $data_custom = $this->db->where('user_id', $user_id)->get('customize_epk')->row_array();
        $data['data_customize'] = json_decode($data_custom['data_customize']);
        $data['email_contact'] = $data_custom;
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/presskit/customize', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * time post customize epk.
     **/
    public function postcustomize()
    {
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] = $this->session->userdata('user_data');
        $array['photo'] = $this->input->post('photo');
        $array['video'] = $this->input->post('video');
        $array['stats'] = $this->input->post('stats');
        $array['song'] = $this->input->post('song');
        $array['press'] = $this->input->post('press');
        $array['show'] = $this->input->post('show');
        $array['dw_photo'] = $this->input->post('dw_photo');
        $array['dw_bios'] = $this->input->post('dw_bios');
        $array['dw_song'] = $this->input->post('dw_song');
        $array['dw_pdf'] = $this->input->post('dw_pdf');
        $array['dw_video'] = $this->input->post('dw_video');
        $array['email_artist'] = $this->input->post('email_artist');
        $array['email_booking'] = $this->input->post('email_booking');
        $array['email_manager'] = $this->input->post('manager_email');
        $json_data = json_encode($array);
        $data_custom = $this->db->where('user_id', $user_id)->get('customize_epk')->row_array();
        if (!empty($data_custom)) {
            $updateArr = array(
                'data_customize	' => $json_data,
            );
            $this->db->update('customize_epk', $updateArr, 'user_id = '.$user_id);
        } else {
            $insertArr = array(
                'user_id' => $user_id,
                'data_customize' => $json_data,
            );
            $this->db->insert('customize_epk', $insertArr);
        }
        redirect('artist/dashboard_epk');
    }
    /**
     * create new custommize epk.
     *
     * @param int $user_id
     **/
    public function init_customize_epk($user_id)
    {
        $arr_json = array(
            'photo' => 'on',
            'video' => 'on',
            'stats' => 'on',
            'song' => 'on',
            'press' => 'on',
            'show' => 'on',
            'dw_photo' => 'on',
            'dw_bios' => 'on',
            'dw_song' => 'on',
            'dw_video' => 'on',
            'dw_pdf' => 'on',
            'email_artist' => null,
            'email_booking' => null,
            'email_manager' => null,
        );
        $json = json_encode($arr_json);
        $epk_info_display_arr = array(
            'comments_counts' => 'on',
            'video_counts' => 'on',
            'fan_counts' => 'on',
            'song_counts' => 'on',
            'blog_counts' => 'on',
            'show_counts' => 'on',
            'age_break_down_display'=> 'on',
        );
        $epk_info_display_json = json_encode($epk_info_display_arr);
        $data_custom = $this->db->where('user_id', $user_id)->get('customize_epk')->row_array();
        $user_data = $this->db->where('id', $user_id)->get('users')->row_array();
        if (empty($data_custom)) {
            $insertArr = array(
                'user_id' => $user_id,
                'data_customize' => $json,
                'email_artist' =>'',
                'email_booking' =>'',
                'email_manager' => '',
                'epk_bio'=> isset($user_data['bio']) ? $user_data['bio'] : '',
                'epk_display_info' => $epk_info_display_json,
            );
            $this->db->insert('customize_epk', $insertArr);
        }
    }
    /**
     * email contact.
     **/
    public function email_contact()
    {
        $user_id = $this->session->userdata('loged_in');
        $updateArr['email_artist'] = $this->input->post('artist_email');
        $updateArr['email_booking'] = $this->input->post('booking_email');
        $updateArr['email_manager'] = $this->input->post('manager_email');
        $data = $this->db->update('customize_epk', $updateArr, 'user_id = '.$user_id);
        if($data)
        {
            echo "Success";
        }
        else
        {
            echo "fails";
        }
        // redirect('artist/presskit/customize');
    }

    public function video_list($user_id)
	{
		$data['video_songs'] = $this->M_video->list_all_video($user_id);
        //Change for video view
	    $this->load->view('artist/epk_video_list', $data);   
    }
        
        function createThumb($path1, $path2, $file_type, $new_w, $new_h, $squareSize = ''){
	/* read the source image */
	$source_image = FALSE;
	
	if (preg_match("/jpg|JPG|jpeg|JPEG/", $file_type)) {
		$source_image = imagecreatefromjpeg($path1);
	}
	elseif (preg_match("/png|PNG/", $file_type)) {
		
		if (!$source_image = @imagecreatefrompng($path1)) {
			$source_image = imagecreatefromjpeg($path1);
		}
	}
	elseif (preg_match("/gif|GIF/", $file_type)) {
		$source_image = imagecreatefromgif($path1);
	}		
	if ($source_image == FALSE) {
		$source_image = imagecreatefromjpeg($path1);
	}

	$orig_w = imageSX($source_image);
	$orig_h = imageSY($source_image);
	
	if ($orig_w < $new_w && $orig_h < $new_h) {
		$desired_width = $orig_w;
		$desired_height = $orig_h;
	} else {
		$scale = min($new_w / $orig_w, $new_h / $orig_h);
		$desired_width = ceil($scale * $orig_w);
		$desired_height = ceil($scale * $orig_h);
	}
			
	if ($squareSize != '') {
		$desired_width = $desired_height = $squareSize;
	}

	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	// for PNG background white----------->
	$kek = imagecolorallocate($virtual_image, 255, 255, 255);
	imagefill($virtual_image, 0, 0, $kek);
	
	if ($squareSize == '') {
		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $orig_w, $orig_h);
	} else {
		$wm = $orig_w / $squareSize;
		$hm = $orig_h / $squareSize;
		$h_height = $squareSize / 2;
		$w_height = $squareSize / 2;
		
		if ($orig_w > $orig_h) {
			$adjusted_width = $orig_w / $hm;
			$half_width = $adjusted_width / 2;
			$int_width = $half_width - $w_height;
			imagecopyresampled($virtual_image, $source_image, -$int_width, 0, 0, 0, $adjusted_width, $squareSize, $orig_w, $orig_h);
		}

		elseif (($orig_w <= $orig_h)) {
			$adjusted_height = $orig_h / $wm;
			$half_height = $adjusted_height / 2;
			imagecopyresampled($virtual_image, $source_image, 0,0, 0, 0, $squareSize, $adjusted_height, $orig_w, $orig_h);
		} else {
			imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $squareSize, $squareSize, $orig_w, $orig_h);
		}
	}
	
	if (@imagejpeg($virtual_image, $path2, 90)) {
		imagedestroy($virtual_image);
		imagedestroy($source_image);
		return TRUE;
	} else {
		return FALSE;
	}
}
        
    public function upload_image() {
            
            /*defined settings - start*/
        ini_set("memory_limit", "99M");
        ini_set('post_max_size', '20M');
        ini_set('max_execution_time', 600);
        /*define('IMAGE_SMALL_DIR', '../images/custom_profile/');
        define('IMAGE_SMALL_SIZE', 250);*/
        define('IMAGE_MEDIUM_DIR',FCPATH.'/uploads/'.$this->session->userdata('loged_in')."/photo/");
        define('IMAGE_MEDIUM_SIZE', 1920);
        /*defined settings - end*/
        if(isset($_FILES['image_upload'])){
        	$output['status']=FALSE;
        	set_time_limit(0);
        	$allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
        	
        	if ($_FILES['image_upload']["error"] > 0) {
        		$output['error']= "Error in File";
        	}
        	elseif (!in_array($_FILES['image_upload']["type"], $allowedImageType)) {
        		$output['error']= "You can only upload JPG, PNG and GIF file";
        	}
        	elseif (round($_FILES['image_upload']["size"] / 1024) > 4096) {
        		$output['error']= "You can upload file size up to 4 MB";
        	} else {
        		/*create directory with 777 permission if not exist - start*/
        		//createDir(IMAGE_SMALL_DIR);
        		//createDir(IMAGE_MEDIUM_DIR);
                if (!file_exists(IMAGE_MEDIUM_DIR)) {
                    mkdir(IMAGE_MEDIUM_DIR, 0777, true);
                }
        		/*create directory with 777 permission if not exist - end*/
        		$path[0] = $_FILES['image_upload']['tmp_name'];
        		$file = pathinfo($_FILES['image_upload']['name']);
                $fileType = $file["extension"];
        		$desiredExt='jpg';
        		$fileNameNew = rand(333, 999) . time() . ".$desiredExt";
        		$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
        		//$path[2] = IMAGE_SMALL_DIR . $fileNameNew;
        		
        		if ($this->createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE)) {
        				$output['status']=TRUE;
        				$output['image_medium']= base_url()."/uploads/".$this->session->userdata('loged_in')."/photo/".$fileNameNew;
        				//$output['image_small']= "profilepic/small/".$fileNameNew;
        			
        		}
                $data = array("user_id"=>$this->session->userdata('loged_in'), "filename"=>$fileNameNew,"caption"=>$file['filename']);
                $this->db->insert('photos', $data);
                $image_id = $this->db->insert_id();
                $this->update_img($image_id);
        	}
        	echo json_encode($output);
        }
    }
        
        
        
    public function get_image(){
        $json=array();
        $this->db->select('filename,user_id,id,caption');
        $this->db->from("photos");
        $this->db->where("user_id", $this->session->userdata('loged_in'));
        $query = $this->db->get();
 		$data = $query->result_array(); 
        foreach($data as $image)
        {
           $img=base_url()."/uploads/".$this->session->userdata('loged_in')."/photo/".$image['filename'];
            array_push($json,array('imgN'=>$image['id'],'image'=>$img, 'caption'=>$image['caption']));
        }
        //  array_push($json,array('image'=>$image));
        echo json_encode(array("json" => $json));
    }

    public function set_show() {
        $event_id = $this->input->post('event_id');
        $user_id = $this->session->userdata('loged_in');
        $this->M_customize_epk->set_epk_show($event_id, $user_id);
    }

    public function get_shows($user_id) {
        $data =  $this->Events_model->get_select_show_epk($user_id);
        foreach ($data as $key => $value) {
            $value['event_title'] = strtolower(str_replace(' ', '-', $value['event_title']));
        }
        
        echo json_encode($data);
    }

    public function delete_epk_photo(){
        $photo_id = $this->input->post('photo_id');
        $user_id = $this->session->userdata('loged_in');
        $this->M_customize_epk->delete_epk_photo($photo_id, $user_id);
    }

    public function get_epk_photo($user_id) {
        $dataCustomise = $this->M_customize_epk->get_customize_user_data($user_id);
        $epk_photos = $this->M_photo->list_photos_epk($user_id, $dataCustomise['photo_limit']);
        echo json_encode($epk_photos);
    }

    public function save_content_limit()
    {
        $photo_limit = $this->input->post('photo_limit');
        $video_limit = $this->input->post('video_limit');
        $show_limit = $this->input->post('show_limit');
        $song_limit = $this->input->post('song_limit');
        $download_song_limit = $this->input->post('download_song_limit');
        $press_limit = $this->input->post('press_limit');
        $user_id = $this->session->userdata('loged_in');
        $data = array(
                'photo_limit'=> $photo_limit,
                'video_limit'=> $video_limit,
                'show_limit'=> $show_limit,
                'song_limit'=> $song_limit,
                'download_song_limit'=> $download_song_limit,
                'press_limit'=> $press_limit,
                'user_id'=>$user_id
            );
        $this->M_customize_epk->save_content_limit($data);
    }

    public function get_epk_video($user_id)
    {
        $dataCustomise = $this->M_customize_epk->get_customize_user_data($user_id);
        $epk_videos = $this->M_video->list_videos_epk($user_id, $dataCustomise['video_limit']);
        echo json_encode($epk_videos);
    }

    
    public function delete_epk_video()
    {
        $video_id = $this->input->post('video_id');
        $user_id = $this->session->userdata('loged_in');
        $data = $this->M_customize_epk->delete_epk_video($video_id, $user_id);
        if($data)
        {
            echo "Success";
        }
        else
        {
            echo "Failed";
        }
    }

    public function delete_epk_event()
    {
        $event_id = $this->input->post('event_id');
        $user_id = $this->session->userdata('loged_in');
        $data = $this->M_customize_epk->delete_epk_event($event_id, $user_id);
        if($data)
        {
            echo "Success";
        }
        else
        {
            echo "Failed";
        }
    }

    public function delete_epk_blog()
    {
        $blog_id = $this->input->post('blog_id');
        $user_id = $this->session->userdata('loged_in');
        $data = $this->M_customize_epk->delete_epk_blog($blog_id, $user_id);
        if($data)
        {
            echo "Success";
        }
        else
        {
            echo "Failed";
        }
    }

    
    public function update_epk_display_info()
    {
        $user_id = $this->session->userdata('loged_in');
        $epk_info_display_arr = array(
            'comments_counts' => $this->input->post('comments_counts'),
            'video_counts' => $this->input->post('video_counts'),
            'fan_counts' => $this->input->post('fan_counts'),
            'song_counts' => $this->input->post('song_counts'),
            'blog_counts' => $this->input->post('blog_counts'),
            'show_counts' => $this->input->post('show_counts'),
            'age_break_down_display'=>  $this->input->post('age_break_down_display'),
        );
        $data = $this->M_customize_epk->update_epk_display_info($epk_info_display_arr, $user_id);
        redirect('artist/dashboard_epk');
    }

    public function set_blog() {
        $blog_id = $this->input->post('blog_id');
        $user_id = $this->session->userdata('loged_in');
        $this->M_customize_epk->set_epk_blog($blog_id, $user_id);
    }

    public function get_blogs($user_id) {
        $data = $this->M_blog->list_blogs_epk($user_id);
        foreach ($data as $key => $blog) {
            $text = strip_tags($blog['introduction']);
            $desLength = strlen($text);
            //var_dump($desLength);exit;            
            $stringMaxLength = 120;
            if ($desLength > $stringMaxLength) {
                $des = substr($text, 0, $stringMaxLength);
                $text = $des.'...';
                $blog['introduction'] = $text;
            } else {
                $blog['introduction'] = $blog['introduction'];
            } 
        }
        
        echo json_encode($data);
    }

    public function select_epk_press(){
        $press_id = $this->input->post('press_id');
        $user_id = $this->session->userdata('loged_in');
        $this->M_customize_epk->select_epk_press($press_id, $user_id);
    }

    public function delete_epk_press()
    {
        $press_id = $this->input->post('press_id');
        $user_id = $this->session->userdata('loged_in');
        $data = $this->M_customize_epk->delete_epk_press($press_id, $user_id);
        if($data)
        {
            echo "Success";
        }
        else
        {
            echo "Failed";
        }
    }

    public function get_press($user_id)
    {
        $dataCustomise = $this->M_customize_epk->get_customize_user_data($user_id);
        $data = $this->M_press->list_press_epk($user_id, $dataCustomise['press_limit']);
        echo json_encode($data);
    }

    public function set_epk_song()
    {
        $song_id = $this->input->post('song_id');
        $user_id = $this->session->userdata('loged_in');
        $this->M_customize_epk->select_epk_song($song_id, $user_id);
    }

    public function get_epk_songs($user_id)
    {
        $dataCustomise = $this->M_customize_epk->get_customize_user_data($user_id);
        $data = $this->M_audio_song->get_all_epk_songs($user_id, $dataCustomise['song_limit']);
        return $data;
        // echo json_encode($data);
    }

    public function get_epk_songs_id($user_id)
    {
        $data = $this->M_audio_song->get_epk_songs_id($user_id);
        return $data;
    }
}
