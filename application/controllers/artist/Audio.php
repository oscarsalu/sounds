<?php

defined('BASEPATH') or exit('No direct script access allowed');
use Aws\S3\Exception\S3Exception;

class Audio extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_audio_song');
        $this->load->model('M_album_song');
        $this->load->model('M_text');
        if ($this->session->userdata('loged_in') == false) {
            redirect('account/login');
        } else {
            $id = $this->session->userdata('loged_in');
            $user_data = $this->db->where('id='.$id)->get('users')->row_array();
            if ($user_data['role'] != 1) {
                redirect('');
            }
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
     * View Upload new song.
     *
     * @param int $playlist_id
     **/
    public function view_upload_song($playlist_id)
    {
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] = $this->session->userdata('user_data');
        $data['playlist_id'] = $playlist_id;
        $data_playlist=$this->db->where('id='.$playlist_id)->get('album_song')->row_array();
        $data['attribute']=$data_playlist['attribute'];
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/new_song', $data);
        $this->load->view('includes/footer', $data);
    }
    
    /** Currency Converter
     * @param int $from
     * @param int $to
     * @param int $amount
     * 
    **/
    public function convert_currency(){
        $amount=$this->input->post('amount');
        $to=$this->input->post('to');
        $from=$this->input->post('from');
    $url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
    $data = file_get_contents($url);
  
 preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
 
 //echo json_encode($output);
    $converted1 = preg_replace("/[^0-9.]/", "", $converted[0]);
    $output="<b>Currency Converter :</b><div class='alert alert-info'>".$amount." ".$from."="." ".round($converted1, 3)." ".$to."</div>"."<input type='hidden' value='".round($converted1, 3)."' name='amount' id='amount'>";
    echo json_encode($output);
}
    
    /**
     * View Edit song.
     *
     * @param int $playlist_id
     * @param int $song_id
     **/
    public function view_edit_song($playlist_id, $song_id)
    {
        $user_id = $this->session->userdata('loged_in');
        $data['data_song'] = $this->db->where('id', $song_id)
            ->where('user_id', $user_id)
            ->get('audio_song')->row();
        if (isset($data['data_song'])) {
            $data['user_data'] = $this->session->userdata('user_data');
            $data['playlist_id'] = $playlist_id;
            $data['song_id']=$song_id;
            $data['duration'] = explode(',', $data['data_song']->time_duration);
            $data_playlist=$this->db->where('id='.$playlist_id)->get('album_song')->row_array();
        $data['attribute']=$data_playlist['attribute'];
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('artist/edit_song', $data);
            $this->load->view('includes/footer', $data);
        } else {
            redirect('artist/playlist/'.$playlist_id);
        }
    }
    
    /**
     * View Edit Lyric.
     *
     * @param int $playlist_id
     * @param int $song_id
     **/
    public function view_edit_lyric($playlist_id, $song_id)
    {
        $user_id = $this->session->userdata('loged_in');
        $data['data_song'] = $this->db->where('id', $song_id)
            ->where('user_id', $user_id)
            ->get('audio_song')->row();
        if (isset($data['data_song'])) {
            $data['user_data'] = $this->session->userdata('user_data');
            $data['playlist_id'] = $playlist_id;
            $data['song_id']=$song_id;
            $data['duration'] = explode(',', $data['data_song']->time_duration);
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('artist/edit_lyric', $data);
            $this->load->view('includes/footer', $data);
        } else {
            redirect('artist/playlist/'.$playlist_id);
        }
    }
    
    
    
    /**
     * View Manager Playlist.
     **/
    public function manager()
    {
        $user_id = $this->session->userdata('loged_in');
        $data['genres'] = $this->db->get('genres')->result_array();
        $data['user_data'] = $this->session->userdata('user_data');
        // pagintion config
        $config['per_page'] = 12;
        $config['base_url'] = base_url().'artist/managersong/';
        $start = $this->input->get('per_page');
        if (empty($start)) {
            $start = 0;
        }
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->M_album_song->total_albums($user_id);

        $this->load->library('pagination', $config);
        $this->pagination->initialize($config);
       
        $data['playlist'] = $this->M_album_song->list_album_songs($user_id, $config['per_page'], $start);
        
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/playlist', $data);
        $this->load->view('includes/footer', $data);
    }
    
    
    
    
    
    /**
     * View Manager songs.
     *
     * @param $playlist_id
     **/
    public function manager_song($playlist_id)
    {
        $user_id = $this->session->userdata('loged_in');
        $playlist = $this->M_album_song->get_data_album($playlist_id);
        if (!empty($playlist) && $playlist['user_id'] == $user_id) {
            $data = array();
            $data['listsong'] = $this->M_audio_song->get_data_songs($playlist_id);
            $data['cloudfront_url']='https://d1oc632jh12ao7.cloudfront.net/';
            $data['user_data'] = $this->session->userdata('user_data');
            $data['data_playlist'] = $playlist;
            $data['loged_in'] = $this->session->userdata('loged_in');
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('artist/listsong', $data);
            $this->load->view('includes/footer', $data);
        } else {
            redirect('artist/managersong');
        }
    }
    public function lyrics($playlist_id)
    {
        $user_id = $this->session->userdata('loged_in');
        $playlist = $this->M_album_song->get_data_album($playlist_id);
        if (!empty($playlist) && $playlist['user_id'] == $user_id) {
            $data = array();
            $data['listsong'] = $this->M_audio_song->get_data_songs($playlist_id);
            $data['user_data'] = $this->session->userdata('user_data');
            $data['data_playlist'] = $playlist;
            $data['loged_in'] = $this->session->userdata('loged_in');
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('artist/listlyric', $data);
            $this->load->view('includes/footer', $data);
        } else {
            redirect('artist/lyricmanager');
        }
    }
    
    /**
     * Get Lyrics
     */
    
    public function get_lyric(){
        
        $user_id = $this->session->userdata('loged_in');
        $data['genres'] = $this->db->get('genres')->result_array();
        $data['user_data'] = $this->session->userdata('user_data');
        // pagintion config
        $config['per_page'] = 12;
        $config['base_url'] = base_url().'artist/managersong/';
        $start = $this->input->get('per_page');
        if (empty($start)) {
            $start = 0;
        }
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->M_album_song->total_albums($user_id);

        $this->load->library('pagination', $config);
        $this->pagination->initialize($config);
       
        $data['playlist'] = $this->M_album_song->list_album_songs($user_id, $config['per_page'], $start);
        
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/get_lyric', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View Get Video Song Demo.
     *
     * @param $playlist_id
     **/
    public function get_video_song_by_id($song_id,$playlist_id){
        
        $user_id = $this->session->userdata('loged_in');
        $playlist = $this->M_album_song->get_data_album($playlist_id);
        $data['data_playlist'] = $playlist;
        $data['video']=$this->db->where(array('id'=>$song_id))->get('audio_song')->row_array();
        $data['cloudfront_url']='https://d1oc632jh12ao7.cloudfront.net/';
        $this->load->view('artist/jplayer_video', $data);
    }
    /**
     * Ajax Upload file audio.
     *
     * @return string html
     **/
    public function upload_file_audio()
    {
        $user_id = $this->session->userdata('loged_in');
        $id_playlist = $this->input->post('id_playlist');
        $this->load->library('upload');
        if (!empty($_FILES['file_audio1']['name'])) {
            $this->upload->initialize($this->set_upload_type('tmp_audio1'));
      
            if (!$this->upload->do_upload('file_audio1')) {
                $data['update_error'] = $this->upload->display_errors();
                echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='none';</script>";
            } else {
                $datafile = $this->upload->data();
                 if($datafile['file_type']=="audio/webm" or $datafile['file_type']=="audio/webma"){
                echo  '<input type="hidden" id="file_audio_ext1" value="'.$datafile['file_ext'].'"/>';
                echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                echo  '<h4><strong>'.$datafile['client_name'].'.</strong></h4>';
                echo  '<p> Size: '.formatSizeUnits($_FILES['file_audio1']['size']).'</p>';
                echo  '<p> Type: '.$datafile['file_type'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='block';</script>";
            }else {
                $data['update_error']="this file type is not allowed";
            
                 echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='none';</script>";
            }
            }
        }
            if (!empty($_FILES['file_audio2']['name'])) {
            $this->upload->initialize($this->set_upload_type('tmp_audio2'));
      
            if (!$this->upload->do_upload('file_audio2')) {
                $data['update_error'] = $this->upload->display_errors();
                echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='none';</script>";
            } else {
                $datafile = $this->upload->data();
                if($datafile['file_type']=="audio/ogg" or $datafile['file_type']=="audio/oga"){
                echo  '<input type="hidden" id="file_audio_ext2" value="'.$datafile['file_ext'].'"/>';
                echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                echo  '<h4><strong>'.$datafile['client_name'].'.</strong></h4>';
                echo  '<p> Size: '.formatSizeUnits($_FILES['file_audio2']['size']).'</p>';
                echo  '<p> Type: '.$datafile['file_type'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='block';</script>";
               
            }
            else {
                $data['update_error']="this file type is not allowed";
            
                 echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                echo  '</div>';
               echo "<script>var form = document.getElementById('next');
        form.style.display='none';</script>";
            }
        }
            }
        if (!empty($_FILES['file_audio3']['name'])) {
            $this->upload->initialize($this->set_upload_type('tmp_audio3'));
      
            if (!$this->upload->do_upload('file_audio3')) {
                $data['update_error'] = $this->upload->display_errors();
                echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='none';</script>";
            } else {
                $datafile = $this->upload->data();
                 if($datafile['file_type']=="audio/m4a" or $datafile['file_type']=="audio/mp4"){
                echo  '<input type="hidden" id="file_audio_ext3" value="'.$datafile['file_ext'].'"/>';
                echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                echo  '<h4><strong>'.$datafile['client_name'].'.</strong></h4>';
                echo  '<p> Size: '.formatSizeUnits($_FILES['file_audio3']['size']).'</p>';
                echo  '<p> Type: '.$datafile['file_type'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='block';</script>";
            }else {
                $data['update_error']="this file type is not allowed";
            
                 echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='none';</script>";
            }
            }
        }
        if (!empty($_FILES['file_audio4']['name'])) {
            $this->upload->initialize($this->set_upload_type('tmp_audio4'));
      
            if (!$this->upload->do_upload('file_audio4')) {
                $data['update_error'] = $this->upload->display_errors();
                echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='none';</script>";
            } else {
                $datafile = $this->upload->data();
                if($datafile['file_type']=="audio/mp3" or $datafile['file_type']=="audio/mpeg" or  $datafile['file_type']=="audio/mpg" or $datafile['file_type']=="audio/mpeg3"){
                echo  '<input type="hidden" id="file_audio_ext4" value="'.$datafile['file_ext'].'"/>';
                echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                echo  '<h4><strong>'.$datafile['client_name'].'.</strong></h4>';
                echo  '<p> Size: '.formatSizeUnits($_FILES['file_audio4']['size']).'</p>';
                echo  '<p> Type: '.$datafile['file_type'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='block';</script>";
            }else {
                $data['update_error']="this file type is not allowed";
            
                 echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='none';</script>";
            }
            }
        }
          if (!empty($_FILES['file_audio5']['name'])) {
            $this->upload->initialize($this->set_upload_type('tmp_audio5'));
      
            if (!$this->upload->do_upload('file_audio5')) {
                $data['update_error'] = $this->upload->display_errors();
                echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='none';</script>";
            } else {
                $datafile = $this->upload->data();
                if($datafile['file_type']=="audio/x-wav" ){
                echo  '<input type="hidden" id="file_audio_ext5" value="'.$datafile['file_ext'].'"/>';
                echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                echo  '<h4><strong>'.$datafile['client_name'].'.</strong></h4>';
                echo  '<p> Size: '.formatSizeUnits($_FILES['file_audio5']['size']).'</p>';
                echo  '<p> Type: '.$datafile['file_type'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='block';</script>";
            }else {
                $data['update_error']="this file type is not allowed";
            
                 echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                  echo  '<p> Type: '.$datafile['file_type'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='none';</script>";
            }
            }
        }
          if (!empty($_FILES['file_audio6']['name'])) {
            $this->upload->initialize($this->set_upload_type('tmp_audio6'));
      
            if (!$this->upload->do_upload('file_audio6')) {
                $data['update_error'] = $this->upload->display_errors();
                echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='none';</script>";
            } else {
                $datafile = $this->upload->data();
                if($datafile['file_type']=="audio/x-flac" ){
                echo  '<input type="hidden" id="file_audio_ext6" value="'.$datafile['file_ext'].'"/>';
                echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                echo  '<h4><strong>'.$datafile['client_name'].'.</strong></h4>';
                echo  '<p> Size: '.formatSizeUnits($_FILES['file_audio6']['size']).'</p>';
                echo  '<p> Type: '.$datafile['file_type'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='block';</script>";
            }else {
                $data['update_error']="this file type is not allowed";
            
                 echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                echo  '</div>';
                echo "<script>var form = document.getElementById('next');
        form.style.display='none';</script>";
            }
            }
        }
    }
    /**
     * Ajax Upload file video.
     *
     * @return string html
     **/
    public function upload_file_video()
    {
        $user_id = $this->session->userdata('loged_in');
        $id_playlist = $this->input->post('id_playlist');
        $this->load->library('upload');
        
        if (!empty($_FILES['file_video1']['name'])) {
            $this->upload->initialize($this->set_upload_type('tmp_video1'));
            if (!$this->upload->do_upload('file_video1')) {
                   
                $data['update_error'] = $this->upload->display_errors();
              
                
                echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                echo  '</div>';
                
                
            } else {
                $datafile = $this->upload->data();
                echo  '<input type="hidden" id="file_video_ext1" value="'.$datafile['file_ext'].'"/>';
                echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                echo  '<h4><strong>'.$datafile['client_name'].'.</strong></h4>';
                echo  '<p> Size: '.formatSizeUnits($_FILES['file_video1']['size']).'</p>';
                echo  '<p> Type: '.$datafile['file_type'].'</p>';
                echo  '';
                echo  '</div>';
            }
        }
         
        if (!empty($_FILES['file_video2']['name'])) {
            $this->upload->initialize($this->set_upload_type('tmp_video2'));
            if (!$this->upload->do_upload('file_video2')) {
                   
                $data['update_error'] = $this->upload->display_errors();
              
                
                echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                echo  '</div>';
                
                
            } else {
                $datafile = $this->upload->data();
                echo  '<input type="hidden" id="file_video_ext2" value="'.$datafile['file_ext'].'"/>';
                echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                echo  '<h4><strong>'.$datafile['client_name'].'.</strong></h4>';
                echo  '<p> Size: '.formatSizeUnits($_FILES['file_video2']['size']).'</p>';
                echo  '<p> Type: '.$datafile['file_type'].'</p>';
                echo  '';
                echo  '</div>';
            }
        }
          if (!empty($_FILES['file_video3']['name'])) {
            $this->upload->initialize($this->set_upload_type('tmp_video3'));
            if (!$this->upload->do_upload('file_video3')) {
                   
                $data['update_error'] = $this->upload->display_errors();
              
                
                echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                echo  '<h4><strong>Error!</strong></h4>';
                echo  '<p> '.$data['update_error'].'</p>';
                echo  '</div>';
                
                
            } else {
                $datafile = $this->upload->data();
                echo  '<input type="hidden" id="file_video_ext3" value="'.$datafile['file_ext'].'"/>';
                echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                echo  '<h4><strong>'.$datafile['client_name'].'.</strong></h4>';
                echo  '<p> Size: '.formatSizeUnits($_FILES['file_video3']['size']).'</p>';
                echo  '<p> Type: '.$datafile['file_type'].'</p>';
                echo  '';
                echo  '</div>';
            }
        }
    }
    /**
     * Ajax Delete Tmp video.
     **/
    public function delete_file_video()
    {
        $loged_in = $this->session->userdata('loged_in');
        $link = 'uploads/'.$loged_in.'/tmp_video.mp4';
        if (file_exists($link)) {
            unlink($link);
        }
    }
    /**
     * Ajax caculation duration 
     * audio - video.
     *
     * @return json
     **/
    public function load_duration()
    {
        $loged_in = $this->session->userdata('loged_in');
        $audio_ext = $this->input->post('audio_ext');
        $audio_path = $this->input->post('audio_path');
        $audio_file=$this->input->post('audio_file');
        $video_file=$this->input->post('video_file');
        $song_id=$this->input->post('song_id');
        $song_old = $this->db->where('id', $song_id)->get('audio_song')->row();
        require FCPATH.'vendor/autoload.php';
        require FCPATH.'vendor/aws/aws-sdk-php/src/Aws/app/start.php';
        if (!empty($audio_ext)) {
           // echo "audio_ext";
            $tmp_path_audio = 'uploads/'.$loged_in.'/'.$audio_file.$audio_ext;
            $time_total_audio = exec_ffmeg("-i $tmp_path_audio 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
           
            $response['audio'] = time_to_seconds($time_total_audio);
            
        } elseif (!empty($audio_path)) {
           // echo "audio_path";
            $tmp_path_audio = $config['cloudfront']['url'].'uploads/'.$loged_in.'/audio/'.$audio_path;
            $time_total_audio = exec_ffmeg("-i $tmp_path_audio 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
            $response['audio'] = $song_old->time_total;
        }
     
        //video 
        $video_ext = $this->input->post('video_ext');
        $video_path = $this->input->post('video_path');
        if (!empty($video_ext)) {
            $tmp_path_video = 'uploads/'.$loged_in.'/'.$video_file.$video_ext;
            $time_total_audio = exec_ffmeg("-i $tmp_path_video 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
            $response['video'] = time_to_seconds($time_total_audio);
        } elseif (!empty($video_path)) {
            $tmp_path_audio = $config['cloudfront']['url'].'uploads/'.$loged_in.'/audio/'.$video_path;
            $time_total_audio = exec_ffmeg("-i $tmp_path_audio 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
            $response['video'] = $song_old->time_total;
        } else {
            $response['video'] = 0;
        }
       if (!check_live_server()) {
            $response['video'] = 1000;
            $response['audio'] = 400;
           
        } 
        echo json_encode($response);
    }
    /**
     * Finish create new song 
     * insert database.
     *
     * @return json
     **/
    public function finish_upload_song()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_song', 'name_song', 'trim|required');
        $this->form_validation->set_rules('availability[]', 'availability', 'required');
        $this->form_validation->set_rules('id_paylist', 'id_paylist', 'required');
        if ($this->form_validation->run() != false) {
            $user_id = $this->session->userdata('loged_in');
            $check = $this->M_audio_song->check_user_playlist($user_id, $_POST['id_paylist']);
            if ($check) {
                require FCPATH.'vendor/autoload.php';
                require FCPATH.'vendor/aws/aws-sdk-php/src/Aws/app/start.php';
                $artist_name=$this->M_user->get_name($user_id);
                if(!empty($_POST['file_audio_ext1'])){
                    
                 $audio_name1 = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext1'];
                  $tmp_path_audio1 = 'uploads/'.$user_id.'/tmp_audio1'.$_POST['file_audio_ext1'];
                  $key_audio1 = 'uploads/'.$user_id.'/audio/'.$audio_name1;
                }
                else {
                     $audio_name1 ='';
                }
                if(!empty($_POST['file_audio_ext2'])){
                 $audio_name2 = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext2'];
                  $tmp_path_audio2 = 'uploads/'.$user_id.'/tmp_audio2'.$_POST['file_audio_ext2'];
                  $key_audio2 = 'uploads/'.$user_id.'/audio/'.$audio_name2;
                }
                else {
                    $audio_name2 ='';
                }
                if(!empty($_POST['file_audio_ext3'])){
                 $audio_name3 = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext3'];
                  $tmp_path_audio3 = 'uploads/'.$user_id.'/tmp_audio3'.$_POST['file_audio_ext3'];
                  $key_audio3 = 'uploads/'.$user_id.'/audio/'.$audio_name3;
                } else { 
                $audio_name3 =''; 
                }
               
                
                if(!empty($_POST['file_audio_ext4'])){
                    
                 $audio_name4 = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext4'];
                  $tmp_path_audio4 = 'uploads/'.$user_id.'/tmp_audio4'.$_POST['file_audio_ext4'];
                  $key_audio4 = 'uploads/'.$user_id.'/audio/'.$audio_name4;
                } else {
                    
                    $audio_name4 =''; 
                }
                if(!empty($_POST['file_audio_ext5'])){
                    
                 $audio_name5 = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext5'];
                  $tmp_path_audio5 = 'uploads/'.$user_id.'/tmp_audio5'.$_POST['file_audio_ext5'];
                  $key_audio5 = 'uploads/'.$user_id.'/audio/'.$audio_name5;
                } else {
                $audio_name5 =''; 
                }
                if(!empty($_POST['file_audio_ext6'])){
                    
                 $audio_name6 = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext6'];
                  $tmp_path_audio6 = 'uploads/'.$user_id.'/tmp_audio5'.$_POST['file_audio_ext6'];
                  $key_audio6 = 'uploads/'.$user_id.'/audio/'.$audio_name6;
                }
               else {
                $audio_name6 =''; 
                }
               

                //upload s3 video
                if (!empty($_POST['file_video_ext1'])) {
                    $video_name1 = $_POST['name_song']."-".$artist_name.$_POST['file_video_ext1'];
                    $tmp_path_video1 = 'uploads/'.$user_id.'/tmp_video1'.$_POST['file_video_ext1'];
                    $key_video1 = 'uploads/'.$user_id.'/audio/'.$video_name1;
                } else {
                    $video_name1 = '';
                }
            if (!empty($_POST['file_video_ext2'])) {
                    $video_name2 = $_POST['name_song']."-".$artist_name.$_POST['file_video_ext2'];
                    $tmp_path_video2 = 'uploads/'.$user_id.'/tmp_video2'.$_POST['file_video_ext2'];
                    $key_video2 = 'uploads/'.$user_id.'/audio/'.$video_name2;
                } else {
                    $video_name2 = '';
                }
                if (!empty($_POST['file_video_ext3'])) {
                    $video_name3 = $_POST['name_song']."-".$artist_name.$_POST['file_video_ext3'];
                    $tmp_path_video3 = 'uploads/'.$user_id.'/tmp_video3'.$_POST['file_video_ext3'];
                    $key_video3 = 'uploads/'.$user_id.'/audio/'.$video_name3;
                } else {
                    $video_name3 = '';
                }
               if ($_POST['options_demo'] == '1') {
                    //audio
                   if(!empty($_POST['file_audio_ext1'])){
                    $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext1'];
                    $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $array_duration = explode(',', $_POST['duration_audio']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    $cmd = '-ss '.gmdate('H:i:s', $start).'  -i "'.$tmp_path_audio1.'" -t '.gmdate('H:i:s', $duration_end).' "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_audio1 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                   } 
                   
                   else if(!empty($_POST['file_audio_ext2'])){
                       $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext2'];
                    $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $array_duration = explode(',', $_POST['duration_audio']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    $cmd = '-ss '.gmdate('H:i:s', $start).'  -i "'.$tmp_path_audio2.'" -t '.gmdate('H:i:s', $duration_end).' "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_audio2 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                   }
                   else if(!empty($_POST['file_audio_ext3'])) {
                        $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext3'];
                    $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $array_duration = explode(',', $_POST['duration_audio']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    $cmd = '-ss '.gmdate('H:i:s', $start).'  -i "'.$tmp_path_audio3.'" -t '.gmdate('H:i:s', $duration_end).' "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_audio3 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                   }
                  else if(!empty($_POST['file_audio_ext4'])){
                       $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext4'];
                    $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $array_duration = explode(',', $_POST['duration_audio']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    $cmd = '-ss '.gmdate('H:i:s', $start).'  -i "'.$tmp_path_audio4.'" -t '.gmdate('H:i:s', $duration_end).' "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_audio4 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                  }
                  else if(!empty($_POST['file_audio_ext5'])){
                      $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext5'];
                    $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $array_duration = explode(',', $_POST['duration_audio']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    $cmd = '-ss '.gmdate('H:i:s', $start).'  -i "'.$tmp_path_audio5.'" -t '.gmdate('H:i:s', $duration_end).' "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_audio5 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                  }
                    
                } else {
                    //video
                    if(!empty($_POST['file_video_ext1'])){
                    $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_video_ext1'];
                    $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $cmd = '-ss 00:00:00  -i "'.$tmp_path_video1.'" -t 00:00:15 "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_video1 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                    $array_duration = explode(',', $_POST['duration_video']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    } else if(!empty($_POST['file_video_ext2'])){
                         $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_video_ext2'];
                    $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $cmd = '-ss 00:00:00  -i "'.$tmp_path_video2.'" -t 00:00:15 "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_video2 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                    $array_duration = explode(',', $_POST['duration_video']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    }
                    else {
                        $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_video_ext3'];
                    $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $cmd = '-ss 00:00:00  -i "'.$tmp_path_video3.'" -t 00:00:15 "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_video3 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                    $array_duration = explode(',', $_POST['duration_video']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    }
                }
               exec_ffmeg($cmd);
 //echo exec_ffmeg($cmd);
                 try {
                     
                     
                     //Audio 
                     if(!empty($_POST['file_audio_ext1'])){
                    $s3->putObject(array(
                        'Bucket' => $config['s3']['bucket'],
                        'Key' => $key_audio1,
                        'Body' => fopen(FCPATH.$tmp_path_audio1, 'rb'),
                        'ACL' => 'public-read',
                    ));
                    unlink($tmp_path_audio1);
                     }
                     if(!empty($_POST['file_audio_ext2'])){
                     $s3->putObject(array(
                        'Bucket' => $config['s3']['bucket'],
                        'Key' => $key_audio2,
                        'Body' => fopen(FCPATH.$tmp_path_audio2, 'rb'),
                        'ACL' => 'public-read',
                    ));
                     
                    unlink($tmp_path_audio2);
                     }
                     if(!empty($_POST['file_audio_ext3'])){
                     $s3->putObject(array(
                        'Bucket' => $config['s3']['bucket'],
                        'Key' => $key_audio3,
                        'Body' => fopen(FCPATH.$tmp_path_audio3, 'rb'),
                        'ACL' => 'public-read',
                    ));
                    unlink($tmp_path_audio3);
                     }
                     if(!empty($_POST['file_audio_ext4'])){
                     $s3->putObject(array(
                        'Bucket' => $config['s3']['bucket'],
                        'Key' => $key_audio4,
                        'Body' => fopen(FCPATH.$tmp_path_audio4, 'rb'),
                        'ACL' => 'public-read',
                    ));
                    unlink($tmp_path_audio4);
                     }
                     if(!empty($_POST['file_audio_ext5'])){
                     $s3->putObject(array(
                        'Bucket' => $config['s3']['bucket'],
                        'Key' => $key_audio5,
                        'Body' => fopen(FCPATH.$tmp_path_audio5, 'rb'),
                        'ACL' => 'public-read',
                    ));
                    unlink($tmp_path_audio5);
                     }
                    
                    //Video
                    if (!empty($_POST['file_video_ext1'])) {
                        $s3->putObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => $key_video1,
                            'Body' => fopen(FCPATH.$tmp_path_video1, 'rb'),
                            'ACL' => 'public-read',
                        ));
                        unlink($tmp_path_video1);
                    }
                       
                    
                    
                    if (!empty($_POST['file_video_ext2'])) {
                        $s3->putObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => $key_video2,
                            'Body' => fopen(FCPATH.$tmp_path_video2, 'rb'),
                            'ACL' => 'public-read',
                        ));
                        unlink($tmp_path_video2);
                    }
                         if (!empty($_POST['file_video_ext3'])) {
                        $s3->putObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => $key_video3,
                            'Body' => fopen(FCPATH.$tmp_path_video3, 'rb'),
                            'ACL' => 'public-read',
                        ));
                        unlink($tmp_path_video3);
                    }
                    $s3->putObject(array(
                        'Bucket' => $config['s3']['bucket'],
                        'Key' => $key_demo,
                        'Body' => fopen($path_demo, 'rb'),
                        'ACL' => 'public-read',
                    ));
                    unlink($path_demo); 
                } catch (S3Exception $e) {
                    echo json_encode(array($e->getMessage()));
                  
                    die;
                } 
                if (!check_live_server()) {
                    $time_total_sec = 100;
                } else {
                    $time_total_sec = time_to_seconds($time_total);
                }
if(!empty($_POST['lyric'])){
    $date_add_lyrics = date('d-m-Y H:i:s');
}
else {
    $date_add_lyrics = "";
}
if($_POST['availability']=="6"){
                    $data_attr=$this->db->where(array('attribute'=>'0','user_id'=>$user_id))->get('album_song')->row_array();
                 $id_playlist=$data_attr['id'];
                    
                }
                else {
                   
                   $id_playlist=$_POST['id_paylist'];  
                }
                //store database 
                $insertArr = array(
                    'song_name' => strip_tags($_POST['name_song']),
                    'song_name_auth'=>$_POST['name_song_auth'],
                    'video_name'=>strip_tags($_POST['name_video']),
                    'video_name_auth'=>$_POST['name_video_auth'],
                    'filename' => $name_file_demo,
                    'user_id' => $user_id,
                    'availability' => $_POST['availability'],
                    'price' => number_format((float) $_POST['price'], 2, '.', ''),
                    'currency' => $_POST['currency'],
                    'lyrics'=>$_POST['lyric'],
                    'date_lyrics_add'=>$date_add_lyrics,
                    'album_id' => $id_playlist,
                    'audio_file1' => $audio_name1,
                    'video_file1' => $video_name1,
                    'audio_file2' => $audio_name2,
                    'video_file2' => $video_name2,
                     'audio_file3' => $audio_name3,
                    'video_file3' => $video_name3,
                    'audio_file4' => $audio_name4,
                    'audio_file5' => $audio_name5,
                     'audio_file6' => $audio_name6,
                    'time_start' => $start,
                    'time_duration' => $duration_end,
                    'time_total' => $time_total_sec,
                    'option_type' => $_POST['options_demo'],
                    
                );
                
                $this->db->insert('audio_song', $insertArr);
                $song_id = $this->db->insert_id();
                
                $this->M_audio_song->add_new_song_amp($song_id, $id_playlist);
                $album_song = $this->db->where('id', $_POST['id_paylist'])->get('album_song')->row_array();
                $updateArr = array(
                    'num_song' => $album_song['num_song'] + 1,
                );
                $this->db->update('album_song', $updateArr, 'id ='.$id_playlist);
              
                     
                $this->session->set_flashdata('message_msg', ' Upload Song completed');
                 
                echo json_encode($insertArr); 
                die;
               
                
            } else {
                header('HTTP/1.1 401  Error Auth');
            }
        } else {
            header('HTTP/1.1 500  Error form validation');
        }
    }
    /**
     * Finish edit song 
     * update database.
     *
     * @return json
     **/
    public function finish_edit_song()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_song', 'name_song', 'trim|required');
        $this->form_validation->set_rules('availability[]', 'availability', 'required');
        $this->form_validation->set_rules('id_paylist', 'id_paylist', 'required');
        //$this->form_validation->set_rules('audio_path', 'audio_path', 'required');
        if ($this->form_validation->run() != false) {
            //echo json_encode($_POST);die;
            $user_id = $this->session->userdata('loged_in');
            $check = $this->M_audio_song->check_user_playlist($user_id, $_POST['id_paylist']);
            $song_old = $this->db->where('id', $_POST['song_id'])->get('audio_song')->row();
            $artist_name=$this->M_user->get_name($user_id);
            if ($check && isset($song_old)) {
                require FCPATH.'vendor/autoload.php';
                require FCPATH.'vendor/aws/aws-sdk-php/src/Aws/app/start.php';
                
                //Audio 1
                if (!empty($_POST['file_audio_ext1'])) {
                    $audio_name1 = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext1'];
                     $tmp_path_audio1 = 'uploads/'.$user_id.'/tmp_audio1'.$_POST['file_audio_ext1'];
                     $key_audio1 = 'uploads/'.$user_id.'/audio/'.$audio_name1;
                } else {
                    $tmp_path_audio1 = $config['cloudfront']['url'].'uploads/'.$user_id.'/audio/'.$_POST['audio_path1'];
               
                    }
                    
                   //Audio 2 
                   if (!empty($_POST['file_audio_ext2'])) {
                    $audio_name2 = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext2'];
                     $tmp_path_audio2 = 'uploads/'.$user_id.'/tmp_audio2'.$_POST['file_audio_ext2'];
                     $key_audio2 = 'uploads/'.$user_id.'/audio/'.$audio_name2;
                } else {
                    $tmp_path_audio2 = $config['cloudfront']['url'].'uploads/'.$user_id.'/audio/'.$_POST['audio_path2'];
               
                    } 
                    
                    //Audio 3 
                   if (!empty($_POST['file_audio_ext3'])) {
                    $audio_name3 = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext3'];
                     $tmp_path_audio3 = 'uploads/'.$user_id.'/tmp_audio3'.$_POST['file_audio_ext3'];
                     $key_audio3 = 'uploads/'.$user_id.'/audio/'.$audio_name3;
                } else {
                    $tmp_path_audio3 = $config['cloudfront']['url'].'uploads/'.$user_id.'/audio/'.$_POST['audio_path3'];
               
                    } 
                    
                    
                    //Audio 4 
                   if (!empty($_POST['file_audio_ext4'])) {
                    $audio_name4 = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext4'];
                     $tmp_path_audio4 = 'uploads/'.$user_id.'/tmp_audio4'.$_POST['file_audio_ext4'];
                     $key_audio4 = 'uploads/'.$user_id.'/audio/'.$audio_name4;
                } else {
                    $tmp_path_audio4 = $config['cloudfront']['url'].'uploads/'.$user_id.'/audio/'.$_POST['audio_path4'];
               
                    } 
                    
                    //Audio 5 
                   if (!empty($_POST['file_audio_ext5'])) {
                    $audio_name5 = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext5'];
                     $tmp_path_audio5 = 'uploads/'.$user_id.'/tmp_audio5'.$_POST['file_audio_ext5'];
                     $key_audio5 = 'uploads/'.$user_id.'/audio/'.$audio_name5;
                } else {
                    $tmp_path_audio5 = $config['cloudfront']['url'].'uploads/'.$user_id.'/audio/'.$_POST['audio_path5'];
               
                    } 
                    
                    
                    //Audio 6 
                   if (!empty($_POST['file_audio_ext6'])) {
                    $audio_name6 = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext6'];
                     $tmp_path_audio6 = 'uploads/'.$user_id.'/tmp_audio6'.$_POST['file_audio_ext6'];
                     $key_audio6 = 'uploads/'.$user_id.'/audio/'.$audio_name6;
                } else {
                    $tmp_path_audio6 = $config['cloudfront']['url'].'uploads/'.$user_id.'/audio/'.$_POST['audio_path6'];
               
                    } 
                    
                    
                    
                    
                //upload s3 video
                if (!empty($_POST['file_video_ext1'])) {
                    $video_name1 = $_POST['name_song']."-".$artist_name.$_POST['file_video_ext1'];
                    $tmp_path_video1 = 'uploads/'.$user_id.'/tmp_video1'.$_POST['file_video_ext1'];
                    $key_video1 = 'uploads/'.$user_id.'/audio/'.$video_name1;
                } elseif (!empty($_POST['video_path1'])) {
                    $tmp_path_video1 = $config['cloudfront']['url'].'uploads/'.$user_id.'/audio/'.$_POST['video_path1'];
                }
               
                 if (!empty($_POST['file_video_ext2'])) {
                    $video_name2 = $_POST['name_song']."-".$artist_name.$_POST['file_video_ext2'];
                    $tmp_path_video2 = 'uploads/'.$user_id.'/tmp_video2'.$_POST['file_video_ext2'];
                    $key_video2 = 'uploads/'.$user_id.'/audio/'.$video_name2;
                } elseif (!empty($_POST['video_path2'])) {
                    $tmp_path_video2 = $config['cloudfront']['url'].'uploads/'.$user_id.'/audio/'.$_POST['video_path2'];
                }
                
                 if (!empty($_POST['file_video_ext3'])) {
                    $video_name3 = $_POST['name_song']."-".$artist_name.$_POST['file_video_ext3'];
                    $tmp_path_video3 = 'uploads/'.$user_id.'/tmp_video3'.$_POST['file_video_ext3'];
                    $key_video3 = 'uploads/'.$user_id.'/audio/'.$video_name3;
                } elseif (!empty($_POST['video_path3'])) {
                    $tmp_path_video3 = $config['cloudfront']['url'].'uploads/'.$user_id.'/audio/'.$_POST['video_path3'];
                }
                if ($_POST['options_demo'] == '1') {
                    //audio demo
                    if (!empty($_POST['file_audio_ext1'])) {
                        //echo "file_audio_ext1";
                        $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext1'];
                        $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $array_duration = explode(',', $_POST['duration_audio']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    $cmd = '-ss '.gmdate('H:i:s', $start).'  -i "'.$tmp_path_audio1.'" -t '.gmdate('H:i:s', $duration_end).' "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_audio1 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                    exec_ffmeg($cmd);
                    
                    } 
                    
                   
                   else  if (!empty($_POST['file_audio_ext2'])) {
                       //echo "file_audio_ext2";
                        $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext2'];
                        $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $array_duration = explode(',', $_POST['duration_audio']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    $cmd = '-ss '.gmdate('H:i:s', $start).'  -i "'.$tmp_path_audio2.'" -t '.gmdate('H:i:s', $duration_end).' "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_audio2 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                    exec_ffmeg($cmd);
                    
                   } 
                  
                     else  if (!empty($_POST['file_audio_ext3'])) {
                       //echo "file_audio_ext";
                        $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext3'];
                        $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $array_duration = explode(',', $_POST['duration_audio']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    $cmd = '-ss '.gmdate('H:i:s', $start).'  -i "'.$tmp_path_audio2.'" -t '.gmdate('H:i:s', $duration_end).' "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_audio2 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                    exec_ffmeg($cmd);
                    
                   } 
                    
                   else  if (!empty($_POST['file_audio_ext4'])) {
                      // echo "file_audio_ext4";
                        $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext4'];
                        $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $array_duration = explode(',', $_POST['duration_audio']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    $cmd = '-ss '.gmdate('H:i:s', $start).'  -i "'.$tmp_path_audio4.'" -t '.gmdate('H:i:s', $duration_end).' "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_audio4 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                    exec_ffmeg($cmd);
                    
            } 
                    
                 
                    
                    
                  else   if (!empty($_POST['file_audio_ext5'])) {
                        
                       //echo "file_audio_ext5";
                      $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext5'];
                        $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $array_duration = explode(',', $_POST['duration_audio']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    $cmd = '-ss '.gmdate('H:i:s', $start).'  -i "'.$tmp_path_audio5.'" -t '.gmdate('H:i:s', $duration_end).' "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_audio5 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                    exec_ffmeg($cmd);
                    
                  } 
                    
                 
                  else   if (!empty($_POST['file_audio_ext6'])) {
                      //echo "file_audio_ext6";
                      
                        $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_audio_ext6'];
                        $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $array_duration = explode(',', $_POST['duration_audio']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    $cmd = '-ss '.gmdate('H:i:s', $start).'  -i "'.$tmp_path_audio6.'" -t '.gmdate('H:i:s', $duration_end).' "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_audio6 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                       exec_ffmeg($cmd);  
                    
                  } 
                  else {
                      $name_file_demo=$song_old->filename;
                      $start=$song_old->time_start;
                      $duration_end=$song_old->time_duration;
                      $time_total_sec=$song_old->time_total;
                  }
                    
                    
                    
               
                    
                } else {
                    //video demo
                    if (!empty($_POST['file_video_ext1'])) {
                        $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_video_ext1'];
                        $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $array_duration = explode(',', $_POST['duration_video']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    $cmd = '-ss '.gmdate('H:i:s', $start).'  -i "'.$tmp_path_video1.'" -t '.gmdate('H:i:s', $duration_end).' "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_video1 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                    exec_ffmeg($cmd);
                    
                    }  
                   else if (!empty($_POST['file_video_ext2'])) {
                        $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_video_ext2'];
                        $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $array_duration = explode(',', $_POST['duration_video']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    $cmd = '-ss '.gmdate('H:i:s', $start).'  -i "'.$tmp_path_video2.'" -t '.gmdate('H:i:s', $duration_end).' "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_video2 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                   exec_ffmeg($cmd);
                    
                    } 
                    
                  else  if (!empty($_POST['file_video_ext3'])) {
                        $name_file_demo = $_POST['name_song']."-".$artist_name.$_POST['file_video_ext3'];
                        $path_demo = FCPATH.'uploads/tmp/demo_'.$name_file_demo;
                    $key_demo = 'uploads/'.$user_id.'/audio/'.$name_file_demo;
                    $array_duration = explode(',', $_POST['duration_video']);
                    $start = $array_duration[0];
                    $duration_end = $array_duration[1] - $start;
                    $cmd = '-ss '.gmdate('H:i:s', $start).'  -i "'.$tmp_path_video3.'" -t '.gmdate('H:i:s', $duration_end).' "'.$path_demo.'"';
                    $time_total = exec_ffmeg("-i $tmp_path_video3 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
                    exec_ffmeg($cmd);
                      
                    
                  }
                  else {
                      $name_file_demo=$song_old->filename;
                      $start=$song_old->time_start;
                      $duration_end=$song_old->time_duration;
                      $time_total_sec=$song_old->time_total;
                   
                  }
                     
                }
               
                try {
                    if ($_POST['options_demo'] == '1') {
                    if( !empty($_POST['file_audio_ext1'])  or !empty($_POST['file_audio_ext2']) or !empty($_POST['file_audio_ext3']) or !empty($_POST['file_audio_ext4']) or !empty($_POST['file_audio_ext5']) or !empty($_POST['file_audio_ext6']))
                        {
                    $s3->deleteObject(array(
                        'Bucket' => $config['s3']['bucket'],
                        'Key' => 'uploads/'.$user_id.'/audio/'.$song_old->filename,
                    ));
                    $s3->putObject(array(
                        'Bucket' => $config['s3']['bucket'],
                        'Key' => $key_demo,
                        'Body' => fopen($path_demo, 'rb'),
                        'ACL' => 'public-read',
                    ));
                    unlink($path_demo);
                }
                    }
                    else {
                        if(!empty($_POST['file_video_ext1']) or (!empty($_POST['file_video_ext2'])) or (!empty($_POST['file_video_ext3']))){ 
                              $s3->deleteObject(array(
                        'Bucket' => $config['s3']['bucket'],
                        'Key' => 'uploads/'.$user_id.'/audio/'.$song_old->filename,
                    ));
                    $s3->putObject(array(
                        'Bucket' => $config['s3']['bucket'],
                        'Key' => $key_demo,
                        'Body' => fopen($path_demo, 'rb'),
                        'ACL' => 'public-read',
                    ));
                    unlink($path_demo);
                        }
                    }
                    if (!empty($_POST['file_audio_ext1'])) {
                        if(!empty($song_old->audio_file1)){
                        $s3->deleteObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => 'uploads/'.$user_id.'/audio/'.$song_old->audio_file1,
                        ));
                        }
                        $s3->putObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => $key_audio1,
                            'Body' => fopen(FCPATH.$tmp_path_audio1, 'rb'),
                            'ACL' => 'public-read',
                        ));
                        $this->db->update('audio_song', array('audio_file1' => $audio_name1), 'id='.$_POST['song_id']);
                        unlink($tmp_path_audio1);
                    }
                    
                         if (!empty($_POST['file_audio_ext2'])) {
                        if(!empty($song_old->audio_file2)){
                        $s3->deleteObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => 'uploads/'.$user_id.'/audio/'.$song_old->audio_file2,
                        ));
                        }
                        $s3->putObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => $key_audio2,
                            'Body' => fopen(FCPATH.$tmp_path_audio2, 'rb'),
                            'ACL' => 'public-read',
                        ));
                        $this->db->update('audio_song', array('audio_file2' => $audio_name2), 'id='.$_POST['song_id']);
                        unlink($tmp_path_audio2);
                    }
                    
                       if (!empty($_POST['file_audio_ext3'])) {
                        if(!empty($song_old->audio_file3)){
                        $s3->deleteObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => 'uploads/'.$user_id.'/audio/'.$song_old->audio_file3,
                        ));
                        }
                        $s3->putObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => $key_audio3,
                            'Body' => fopen(FCPATH.$tmp_path_audio3, 'rb'),
                            'ACL' => 'public-read',
                        ));
                        $this->db->update('audio_song', array('audio_file2' => $audio_name3), 'id='.$_POST['song_id']);
                        unlink($tmp_path_audio3);
                    }
                    
                    if (!empty($_POST['file_audio_ext4'])) {
                        if(!empty($song_old->audio_file4)){
                        $s3->deleteObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => 'uploads/'.$user_id.'/audio/'.$song_old->audio_file4,
                        ));
                        }
                        $s3->putObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => $key_audio4,
                            'Body' => fopen(FCPATH.$tmp_path_audio4, 'rb'),
                            'ACL' => 'public-read',
                        ));
                        $this->db->update('audio_song', array('audio_file4' => $audio_name4), 'id='.$_POST['song_id']);
                        unlink($tmp_path_audio4);
                    }
                    
                    if (!empty($_POST['file_audio_ext5'])) {
                        if(!empty($song_old->audio_file5)){
                        $s3->deleteObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => 'uploads/'.$user_id.'/audio/'.$song_old->audio_file5,
                        ));
                        }
                        $s3->putObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => $key_audio5,
                            'Body' => fopen(FCPATH.$tmp_path_audio5, 'rb'),
                            'ACL' => 'public-read',
                        ));
                        $this->db->update('audio_song', array('audio_file5' => $audio_name5), 'id='.$_POST['song_id']);
                        unlink($tmp_path_audio5);
                    }
                    
                    if (!empty($_POST['file_audio_ext6'])) {
                        if(!empty($song_old->audio_file6)){
                        $s3->deleteObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => 'uploads/'.$user_id.'/audio/'.$song_old->audio_file6,
                        ));
                        }
                        $s3->putObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => $key_audio6,
                            'Body' => fopen(FCPATH.$tmp_path_audio6, 'rb'),
                            'ACL' => 'public-read',
                        ));
                        $this->db->update('audio_song', array('audio_file6' => $audio_name6), 'id='.$_POST['song_id']);
                        unlink($tmp_path_audio6);
                    }
                    
                   
                    if (!empty($_POST['file_video_ext1'])) {
                        $s3->putObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => $key_video1,
                            'Body' => fopen(FCPATH.$tmp_path_video1, 'rb'),
                            'ACL' => 'public-read',
                        ));
                        $this->db->update('audio_song', array('video_file1' => $video_name1), 'id='.$_POST['song_id']);
                        unlink($tmp_path_video1);
                    }
                    
                    if (!empty($_POST['file_video_ext2'])) {
                        $s3->putObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => $key_video2,
                            'Body' => fopen(FCPATH.$tmp_path_video2, 'rb'),
                            'ACL' => 'public-read',
                        ));
                        $this->db->update('audio_song', array('video_file2' => $video_name2), 'id='.$_POST['song_id']);
                        unlink($tmp_path_video2);
                    }
                    if (!empty($_POST['file_video_ext3'])) {
                        $s3->putObject(array(
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => $key_video3,
                            'Body' => fopen(FCPATH.$tmp_path_video3, 'rb'),
                            'ACL' => 'public-read',
                        ));
                        $this->db->update('audio_song', array('video_file3' => $video_name3), 'id='.$_POST['song_id']);
                        unlink($tmp_path_video3);
                    }
                } catch (S3Exception $e) {
                    echo json_encode(array($e->getMessage()));
                    die;
                }
                if (!check_live_server()) {
                    $time_total_sec = 100;
                } else {
                    $time_total_sec = time_to_seconds($time_total);
                }
                if(isset($_POST['lyric']) && !empty($_POST['lyric'])){
    $date_add_lyrics = date('d-m-Y H:i:s');
}
else {
    $date_add_lyrics = "";
}

if($_POST['availability']=="6"){
                     $data_attr=$this->db->where(array('attribute'=>'0','user_id'=>$user_id))->get('album_song')->row_array();
                 $id_playlist=$data_attr['id'];
                 
                }
                else {
                   
                   $id_playlist=$_POST['id_paylist'];  
                  
                }
                //store database 
                $updateArr = array(
                    'song_name' => strip_tags($_POST['name_song']),
                    'song_name_auth'=>$_POST['name_song_auth'],
                    'filename' => $name_file_demo,
                    'user_id' => $user_id,
                    'availability' => $_POST['availability'],
                    'price' => number_format((float) $_POST['price'], 2, '.', ''),
                    'currency' => $_POST['currency'],
                    'lyrics'=>$_POST['lyric'],
                    'date_lyrics_add'=>$date_add_lyrics,
                    'album_id' => $id_playlist,
                    'time_start' => $start,
                    'time_duration' => $duration_end,
                    'time_total' => $time_total_sec,
                    'option_type' => $_POST['options_demo']
                    
                );
                $this->db->where('id', $_POST['song_id'])->update('audio_song', $updateArr);
                $this->session->set_flashdata('message_msg', ' Edit Song completed');
                echo json_encode($updateArr);
                die;
            } else {
                header('HTTP/1.1 401  Error Auth');
            }
        } else {
            header('HTTP/1.1 500  Error form validation');
        }
    }
    /**
     * Config upload song tmp.
     *
     * @return array $config 
     **/
    private function set_upload_options()
    {
        $loged_in = $this->session->userdata('loged_in');
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/tmp/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        } else {
            chmod($config['upload_path'], 0777);
        }
        $config['allowed_types'] = '*';
        $config['max_size'] = '104857600';
        $config['overwrite'] = false;
        $config['file_name'] = uniqid();

        return $config;
    }
    /**
     * Config upload song.
     *
     * @return array $config 
     **/
    private function set_upload_type($file_name)
    {
        $loged_in = $this->session->userdata('loged_in');
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/'.$loged_in.'/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        } else {
            chmod($config['upload_path'], 0777);
        }
          if(!empty($_FILES['file_audio1']['name']) or !empty($_FILES['file_audio2']['name']) or !empty($_FILES['file_audio3']['name']) or !empty($_FILES['file_audio4']['name']) or !empty($_FILES['file_audio5']['name']) or !empty($_FILES['file_audio5']['name'])){ 
              
               $config['allowed_types'] = array('webm','ogg','oga','mp4','m4a','mp3','wav','flac');
               
          }
       
        if(!empty($_FILES['file_video1']['name']) or !empty($_FILES['file_video2']['name']) or !empty($_FILES['file_video3']['name'])){
        $config['allowed_types'] = array('mp4','m4v','webmv','webm','ogg','ogv');
        
        }
         
        
        $config['max_size'] = '41943040';
        $config['overwrite'] = true;

        $config['file_name'] = $file_name;

        return $config;
    }

    /**
     * Update lyrics.
     **/
    public function updatelyrics()
    {
        $id = $this->input->post('id_song');
        $lyrics = $this->input->post('lyrics');
        $updateArr = array(
            'lyrics' => $lyrics,
            'date_lyrics_add'=>date('d-m-Y H:i:s'),
        );
        $this->db->update('audio_song', $updateArr, 'id ='.$id);

        redirect('artist/profile');
    }
     /**
     * Update lyrics.
     **/
    public function update_lyrics()
    {
         $id = $this->input->post('id_song');
        $playlist_id=$this->input->post('playlist_id');
        $lyrics = $this->input->post('lyrics');
        $updateArr = array(
            'lyrics' => $lyrics,
            'date_lyrics_add'=>date('d-m-Y H:i:s'),
        );
        $this->db->update('audio_song', $updateArr, 'id ='.$id);

        redirect('artist/edit_lyric/'.$playlist_id.'/'.$id);
    }
    /**
     * Download song.
     *
     * @param $song_id
     **/
    public function downloadsong($song_id)
    {
        $row = $this->db->where('id', $song_id)->get('audio_song')->row_array();
        if (!empty($row)) {
            $array_avai = explode(',', $row['availability']);
            if (in_array('2', $array_avai)) {
                $this->load->helper('download');
                $data = file_get_contents('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file']);
                $name = $row['audio_file'];
                force_download($name, $data);
            }
        }
    }
    /**
     * Delete song.
     *
     * @param $song_id
     **/
    public function deletesong()
    {
        $user_id = $this->session->userdata('loged_in');
        $id = $this->input->post('delete_id');
        $id_playlist = $this->input->post('playlist');
        $response = $this->remove_song($id);
        /*if ($response==true) {
            $this->session->set_flashdata('message_msg', ' Delete playlist completed');
            json_encode($response);
        } else {
            $this->session->set_flashdata('message_error', 'Can not delete playlist!');
        }
       // redirect('artist/playlist/'.$id_playlist); */
    } 
    /**
     * Remove song amazon s3
     * Remove song database
     * Remove song AMP.
     *
     * @param $song_id
     **/
    private function remove_song($id)
    {
        $user_id = $this->session->userdata('loged_in');
        if (isset($user_id)) {
            require FCPATH.'vendor/autoload.php';
            require FCPATH.'vendor/aws/aws-sdk-php/src/Aws/app/start.php';
            $data = $this->db->where('id=', $id)->get('audio_song')->row_array();
            $path_publish = 'uploads/'.$user_id.'/audio/'.$data['filename'];
           
           //Delete Published Files
            
            $s3->deleteObject(array(
                'Bucket' => $config['s3']['bucket'],
                'Key' => $path_publish,
            ));
            
            if(!empty($data['audio_file1'])){
            $path_audio1 = 'uploads/'.$user_id.'/audio/'.$data['audio_file1'];
            $s3->deleteObject(array(
                'Bucket' => $config['s3']['bucket'],
                'Key' => $path_audio1,
            ));
            }
            if(!empty($data['audio_file2'])){
            $path_audio2 = 'uploads/'.$user_id.'/audio/'.$data['audio_file2'];
             $s3->deleteObject(array(
                'Bucket' => $config['s3']['bucket'],
                'Key' => $path_audio2,
            ));
            }
            if(!empty($data['audio_file3'])){
            $path_audio3 = 'uploads/'.$user_id.'/audio/'.$data['audio_file3'];
             $s3->deleteObject(array(
                'Bucket' => $config['s3']['bucket'],
                'Key' => $path_audio3,
            ));
            }
            if(!empty($data['audio_file4'])){
            $path_audio4 = 'uploads/'.$user_id.'/audio/'.$data['audio_file4'];
             $s3->deleteObject(array(
                'Bucket' => $config['s3']['bucket'],
                'Key' => $path_audio4,
            ));
            }
            if(!empty($data['audio_file5'])){
            $path_audio5 = 'uploads/'.$user_id.'/audio/'.$data['audio_file5'];
             $s3->deleteObject(array(
                'Bucket' => $config['s3']['bucket'],
                'Key' => $path_audio5,
            ));
            }
            if(!empty($data['audio_file6'])){
            $path_audio6 = 'uploads/'.$user_id.'/audio/'.$data['audio_file6'];
             $s3->deleteObject(array(
                'Bucket' => $config['s3']['bucket'],
                'Key' => $path_audio6,
            ));
            }

            
           
            if (!empty($data['video_file1'])) {
                $s3->deleteObject(array(
                    'Bucket' => $config['s3']['bucket'],
                    'Key' => 'uploads/'.$user_id.'/audio/'.$data['video_file1'],
                ));
            }
             if (!empty($data['video_file2'])) {
                $s3->deleteObject(array(
                    'Bucket' => $config['s3']['bucket'],
                    'Key' => 'uploads/'.$user_id.'/audio/'.$data['video_file2'],
                ));
            }
            if (!empty($data['video_file3'])) {
                $s3->deleteObject(array(
                    'Bucket' => $config['s3']['bucket'],
                    'Key' => 'uploads/'.$user_id.'/audio/'.$data['video_file3'],
                ));
            }
            if(isset($id)){
            $album_song = $this->db->where('id', $id)->get('album_song')->row_array();
            
            $updateArr = array(
                'num_song' => $album_song['num_song'] - 1,
            );
            $this->db->delete('audio_song', array('id' => $id));
            //delete data amp
            $this->db->delete('audio_amp', array('audio_song_id' => $id));
            //update album
            $this->db->update('album_song', $updateArr, 'id ='.$id);
            $this->session->set_flashdata('message_msg', ' Song Deleted');
            echo json_encode($updateArr);
            }
            else {
                $this->session->set_flashdata('message_error', 'Can not delete playlist!');
            }
        } else {
            return false;
        }
    }
    /**
     * Create new Playlist
     * Insert database.
     **/
    public function new_playsit()
    {
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('playlist_name', 'playlist_name', 'required|max_length[200]');
        $this->form_validation->set_rules('genre', 'genre', 'required|max_length[255]');
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
                        'name' => strip_tags($this->input->post('playlist_name')),
                        'image_file' => $datafile['file_name'],
                        'genre' => $this->input->post('genre'),
                        'decs' => strip_tags($this->input->post('desc'), '<p><b>'),
                        'user_id' => $user_id,
                        'time' => time(),
                    );
                    $this->db->insert('album_song', $insertArr);
                    $id_playlist = $this->db->insert_id();
                    $this->M_audio_song->add_new_option_playlist($user_id, $id_playlist);
                    echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                    echo  '<h4><strong>Success!</strong></h4>';
                    echo  '<p> Create playlist completed</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_msg', ' Create playlist completed');
                }
            } else {
                $this->session->set_flashdata('message_error', validation_errors());
            }
        }
    }
    /**
     * config upload image cover playlist.
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
        $config['max_size'] = '5242880';
        $config['max_width'] = '*';
        $config['max_height'] = '*';
        $config['file_name'] = uniqid();

        return $config;
    }
    /**
     * Edit playlist
     * Update database.
     **/
    public function editplaylist()
    {
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('playlist_name', 'playlist_name', 'required|max_length[200]');
        $this->form_validation->set_rules('genre', 'genre', 'required');
        $this->form_validation->set_rules('desc', 'desc', 'max_length[1000]');
        $user_id = $this->session->userdata('loged_in');
        $id = $this->input->post('id');
        if ($this->form_validation->run() != false) {
            if (!empty($_FILES['image']['name'])) {
                $this->upload->initialize($this->set_up_img_cover());
                if (!$this->upload->do_upload('image')) {
                    $data['update_error'] = $this->upload->display_errors();
                    echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                    echo  '<h4><strong>Error!</strong></h4>';
                    echo  '<p> '.$data['update_error'].'</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_error', $data['update_error']);
                    die;
                } else {
                    $datafile = $this->upload->data();
                    $updateArr = array('image_file' => $datafile['file_name'],'name' => $this->input->post('playlist_name'),
                'genre' => $this->input->post('genre'),
                'decs' => $this->input->post('desc'),
                'user_id' => $user_id,);
                    $playlistArray=array(
            'name' =>  $this->input->post('playlist_name'),
            'image_file' => $datafile['file_name'],
            'decs' => $this->input->post('desc'),
            'user_id' => $user_id ,
            'time' => time(),
           
        );
                    $upload_path = './uploads/'.$user_id.'/img_playlist/';
                    //delete image albums old
                    $album_data = $this->db->where('id', $id)->get('album_song')->row_array();
                    $filename = $album_data['image_file'];
                    unlink($upload_path.$filename);
                    $this->db->update('album_song', $updateArr, 'id ='.$id);
                    $this->db->update('playlist_amp', $playlistArray, 'album_root ='.$id);
                    //delete image playlsit amp old
                    /*$playlist_amp = $this->db->where('album_root', $id)->get('playlist_amp')->result_array();
                    foreach ($playlist_amp as $playlist) {
                        $filename = $playlist['image_file'];
                        $upload_path_amp = './uploads/'.$playlist['user_id'].'/img_playlist/';
                        unlink($upload_path_amp.$filename);
                        if (!is_dir($upload_path_amp)) {
                            mkdir($upload_path_amp, 0777, true);
                        } else {
                            chmod($upload_path_amp, 0777);
                        }
                        $content = file_get_contents($upload_path.$datafile['file_name']);
                        //Store in the filesystem.
                        file_put_contents($upload_path_amp.$datafile['file_name'], $content);
                    } */
                    }
                }
            else {
                $album_data = $this->db->where('id', $id)->get('album_song')->row_array();
                    $filename = $album_data['image_file'];
                $updateArr = array('image_file' => $filename);
                 $this->db->update('album_song', $updateArr, 'id ='.$id);
            
            $updateArr = array(
                'name' => $this->input->post('playlist_name'),
                'genre' => $this->input->post('genre'),
                'decs' => $this->input->post('desc'),
                'user_id' => $user_id,
            );
            $playlistArray=array(
            'name' => $this->input->post('playlist_name'),
            'image_file' => $filename,
            'decs' => $this->input->post('desc'),
            'user_id' => $user_id ,
            'time' => time(),
           
        );
            $this->db->update('album_song', $updateArr, 'id ='.$id);
             $this->db->update('playlist_amp', $playlistArray, 'album_root ='.$id);
            echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
            echo  '<h4><strong>Success!</strong></h4>';
            echo  '<p> Update playlist completed</p>';
            echo  '</div>';
            $this->session->set_flashdata('message_msg', 'Update playlist completed');
        }
        }
    }
    /**
     * Delete playlist
     * Delete all songs in playlist
     * Delete data amp.
     **/
    public function deleteplaylist()
    {
        $user_data = $this->session->userdata('user_data');
        $id = $this->input->post('delete_id');
        $data = $this->db->where('id=', $id)->get('album_song')->row_array();
        if ($data['user_id'] == $user_data['id']) {
            //delete song
            $arrsong = $this->db->where('album_id', $id)->get('audio_song')->result_array();

            foreach ($arrsong as $row) {
                $this->remove_song($row['id']);
            }
            $this->db->delete('audio_song', array('album_id' => $id));
            //delete playlist
            $upload_path = './uploads/'.$data['user_id'].'/img_playlist/';
            unlink($upload_path.$data['image_file']);
            $this->db->delete('album_song', array('id' => $id));
            //delete playlist amp
            $this->db->delete('playlist_amp', array('album_root' => $id));
            $this->session->set_flashdata('message_msg', 'Success! The Playlist and its Songs Were Deleted');
            echo json_encode("success");
        } else {
            $this->session->set_flashdata('message_error', 'Error! The Playlist and its Songs can not be Deleted');
      echo json_encode( "error");
            }
        
    }
    /**
     * Ajax get data song.
     *
     * @return json $data_song
     **/
    public function call_ajax_data_song()
    {
        $id_song = $this->input->post('id');
        $data_song = $this->db->where('id', $id_song)->get('audio_song')->row();
        if (isset($data_song)) {
            header('HTTP/1.1 200 OK');
            echo json_encode($data_song);
        } else {
            header('HTTP/1.1 500 JSON Error');
        }
    }
	
	
	
	/*my code added by sunil */
	 public function test($playlist_id)
	 {
		  
         $user_id = $this->session->userdata('loged_in');
         $playlist = $this->M_album_song->get_data_album($playlist_id);
        if (!empty($playlist) && $playlist['user_id'] == $user_id) {
             $data['listsong'] = $this->M_audio_song->get_list_songs($playlist_id);
 
		  	     $this->load->view('artist/epksonglist', $data);   

 
        } else {
            redirect('artist/managersong');
}
	 } 
	 
	 
	 
	 
	 
	  public function album_list()
	 {
	       //$playlist_id=2;
         $user_id = $this->session->userdata('loged_in');
        $data['user_id'] = $user_id;
         $data['playlist'] = $this->M_audio_song->fetch_albums_id($user_id);
        $dataPlalist =  $this->db->select('set_primary_song')->where('id', $user_id)->get('users')->row_array();
        $data['playlist_id'] = $dataPlalist['set_primary_song'];
	     $this->load->view('artist/epkalbumlist', $data);   

	 }
	 
	 
	 /*my code clsoe*/

	 /* update song id in user table  */
	 
	        public function update_primary_song_user($albumid)
		   {
		      
			   $user_id = $this->session->userdata('loged_in');
        $this->db->select('id');
        $this->db->from("playlist_amp");
        $this->db->where("album_root", $albumid);
        $query = $this->db->get();
			   
        $playlist_id = $query->row_array();
        if(empty($playlist_id)) {
            $this->M_audio_song->add_new_option_playlist($user_id, $albumid);
        }else{
            $data['song'] = $this->M_audio_song->update_song_id($playlist_id['id'], $user_id);
			  
			    $userid=$user_id;
					 
            $playlist_id=$playlist_id['id'];
				    
$options ='{"scheme_name":"Style Custome","background_color":"rgba(31,30,30,0.35)","color_time_loaded":"#000000","color_track_front":"#000000","color_font":"#ffffff","affiliatetext":"To Become An Affiliate",
"ordertext":"CLICK HERE TO ORDER","playlistAlbumIds":"'.$playlist_id.'"}';
					 $Update_array = array(
                'option_widget' => $options
            );
					
					  $this->M_audio_song->update_json($userid,$Update_array);
        }
			   
	       }
		   
               
               public function change_option_type(){
                   $id=$this->input->post('id');
                   $option_type=$this->input->post('option_type');
                   $updateArr=array('option_type'=>$option_type);
                    $this->db->update('audio_song', $updateArr, 'id ='.$id);
                    
               }
		   public function get_playlist()
    {
        $id=$this->input->post('id');
        
        
        $data_album = $this->db->where('id', $id)->get('album_song')->result_array();

        echo json_encode($data_album);
    }
	
	
public function checkSongName(){
    $song_id=$this->input->post('song_id');
    if(!empty($song_id)){
        $songname=$this->input->post('song_name');
        $data=$this->db->where(array('id'=>$song_id,'song_name'=>$songname))->get('audio_song')->num_rows();
        if($data==1){ 
            
            echo json_encode(http_response_code(200));
            
            
        } else {
        $rows= $this->db->where('song_name',$songname)->get('audio_song')->num_rows();
    if($rows==0){
        echo json_encode(http_response_code(200));
    
}
else {
    echo json_encode(http_response_code(403));
}
        }
    
        
    } else {
    $songname=$this->input->post('song_name');
    $rows= $this->db->where('song_name',$songname)->get('audio_song')->num_rows();
    if($rows==0){
        echo json_encode(http_response_code(200));
    
}
else {
    echo json_encode(http_response_code(403));
}
    }
}
    

public function checkVideoName(){
    $song_id=$this->input->post('song_id');
    if(!empty($song_id)){
        $songname=$this->input->post('video_name');
        $data=$this->db->where(array('id'=>$song_id,'video_name'=>$songname))->get('audio_song')->num_rows();
        if($data==1){ 
            
            echo json_encode(http_response_code(200));
            
            
        } else {
        $rows= $this->db->where('video_name',$songname)->get('audio_song')->num_rows();
    if($rows==0){
        echo json_encode(http_response_code(200));
    
}
else {
    echo json_encode(http_response_code(403));
}
        }
    
        
    } else {
    $songname=$this->input->post('video_name');
    $rows= $this->db->where('video_name',$songname)->get('audio_song')->num_rows();
    if($rows==0){
        echo json_encode(http_response_code(200));
    
}
else {
    echo json_encode(http_response_code(403));
}
    }
}
}//final

