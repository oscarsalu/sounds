<?php
/**
 * More_ttt File Doc Comment.
 *
 * @category More_Ttt
 *
 * @author   99sound <admin@99sound.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 *
 * @link     http://www.99Sound.com/
 */
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * More_ttt Class Doc Comment.
 *
 * @category More_Ttt
 *
 * @author   99sound <admin@99sound.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 *
 * @link     http://www.99Sound.com/
 */

class Template extends CI_Controller
{
    /**
     * Function constructor to initiate values & load data.
     * 
     * @return nothing.
     */
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
        $this->load->model('M_channel');
        $this->load->model('Member_model');
        $this->load->helper('url');
        $this->load->model('Events_model');
        $this->load->model('M_customize_epk');
        $ac = $this->session->userdata('access');
        $this->U_map = $this->session->userdata('U_map');
        // $data['redirect_url']=$this->curPageURL();
        // if (!isset($ac)) {
        //     redirect("access?redirect_url=".$data['redirect_url']);
        // }
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

      public function template1(){

        $this->load->view('html_template/template1');
      }

      public function template2(){
       
        $this->load->view('html_template/template2');
      }
      
      public function pdf()
      {
        $results = $this->db->get_where('users', array(
            'home_page' => "shrasti3",
        ))->row_array();
        if (!empty($results)) {
            $user_id = $results['id'];
            $user = $results;
            $CounterHits = $this->session->userdata('CounterHits_epk');
            if (!isset($CounterHits)) {
                $this->session->set_userdata('CounterHits_epk', true);
                $this->M_user->Counter_hits($user_id, 'epk');
            }
            $data['song'] = $this->M_audio_song->list_songs_epk($user_id, 5);
            $data['user_data'] = $user;
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
            $data['albums'] = $this->M_audio_song->get_data_playlist($user_id);
            $data['songs'] = $this->M_audio_song->list_songs_epk($user_id, 10);
            $data['download_songs'] = $this->M_audio_song->list_songs_download($user_id, $data['customize']['download_song_limit']);
            $data['videos'] = $this->M_video->list_videos_epk($user_id, $data['customize']['video_limit']);
            $data['photos'] = $this->M_photo->list_photos_epk($user_id, $data['customize']['photo_limit']);
             $this->load->library('image_lib');
            foreach ($data['photos'] as $key => $value) {
              // echo "<pre>";
              $path = base_url().'uploads/'.$user_id.'/photo/'.$value['filename'];
              $config['image_library'] = 'gd2';
              $config['source_image'] = $path;
              $config['new_image'] = base_url().'uploads/'.$user_id.'/photo/'."shrasti.png";
             
              $config['create_thumb'] = TRUE;
              $config['maintain_ratio'] = TRUE;
              $config['width']         = 100;
              $config['height']       = 100;
              $config['overwrite'] = FALSE;
              $this->load->library('image_lib', $config);
              $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
               // $image =  $this->image_lib->resize()->save();
               // echo $image;
            }
           

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
                  if (file_exists('https://img.youtube.com/vi/'.$videoId.'/maxresdefault.jpg')) {
                        $imageSrc = 'https://img.youtube.com/vi/'.$videoId.'/maxresdefault.jpg';
                    }elseif (file_exists('https://img.youtube.com/vi/'.$videoId.'/sddefault.jpg')){
                       $imageSrc = 'https://img.youtube.com/vi/'.$videoId.'/sddefault.jpg';
                     }else{
                      $imageSrc = 'https://img.youtube.com/vi/'.$videoId.'/default.jpg';
                     }
                  

              }
              elseif($value['type'] == "link-vimeo"){
                  $video_vimeo=basename($value['link_video']);
                 
                  $get_link='http://vimeo.com/api/v2/video/'.$video_vimeo.'.php';
                 
                  $hash = unserialize(file_get_contents($get_link));
                  $image=$hash[0]['thumbnail_large']; 
                  $imageSrc = $image;
              }
              else{
                  $imageSrc = base_url().'uploads/'.$value['user_id'].'/video/'.$value['cover_image'];
              }
              $value['imageSrc'] = $imageSrc;
              $newArray[] = $value;
            }
            $data['videos'] = $newArray;
            
                
               
          }
          // $this->load->view('html_template/pdf', $data);
          $this->load->view('email/presskit2', $data);
      }

      public function pdf_old(){
         $this->load->view('html_template/bg');
      }

      public function emailepk($tpl)
      {
        $view = "presskit".$tpl;
        $this->load->view($view);
      }

    public function sendmail()
    {
            $enc = "bjdhshfkdfk";
            $user_id = 317;
            $email_member = "akashbachhania@gmail.com";
            $message = "<div style='text-align:center;'><h3>shrasti invite you become member, click link below to become member: <br/><br/>".base_url('artist/member/'.$enc.'/'.$user_id)."</h3></div>";
            $this->load->library('email');
            $config['protocol'] = 'smtp';
            $config['charset'] = 'utf-8';
            $config['mailtype'] = 'html';
            $config['newline'] = "\r\n";
            //send email
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->from('info@99sound.com', '99 Sound');
            $this->email->to($email_member);
            $this->email->subject('Added Member in band');
            $this->email->message($message);
            $this->email->send();
    }

    public function chat(){
      // echo CI_VERSION ;
         $this->load->view('html_template/check');
      }

    public function downloadpdf($pdf_type)
    {
      if($pdf_type == 'abuse')
      {
        $filename = base_url()."pdfs/Abuse Form.pdf";
        $nme    =   "Abuse Form.pdf";
      
      }elseif ($pdf_type == 'counter') {
        $filename = base_url()."pdfs/Copyright Infringement Form.pdf";
        $nme    =   "Copyright Infringement Form.pdf";
      
      }else{
        $filename = base_url()."pdfs/Counter NotIfication Form.pdf";
        $nme    =   "Counter NotIfication Form.pdf";
      
      }
      $pth = file_get_contents($filename);
      $this->load->helper('download');
      force_download($nme, $pth);     
    }

   }