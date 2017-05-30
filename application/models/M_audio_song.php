<?php

class M_audio_song extends CI_Model
{
    public function __construct()
    {

        // Call the Model constructor

        parent::__construct();
    }
    /**
     * Count number songs.
     *
     * @param int $user_id
     *
     * @return int
     **/
    public function num_songs($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->count_all_results('audio_song');
    }
    /**
     * List songs on FLP.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return array
     **/
    public function list_songs_flp($user_id, $limit)
    {
        return $this->db->where('user_id', $user_id)
            ->limit($limit)->order_by('id', 'DESC')
            ->get('audio_song')->result_array();
    }
    /**
     * List songs on ALP.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return array
     **/
    public function list_songs_alp($user_id, $limit)
    {
        return $this->db->where('user_id', $user_id)
            ->group_start()
            ->like('availability', 2)
            ->or_like('availability', 4)
            ->or_like('availability', 5)
            ->group_end()
            ->limit($limit)->order_by('id', 'DESC')
            ->get('audio_song')->result_array();
    }
    /**
     * List songs on EPK.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return array
     **/
    public function list_songs_epk($user_id, $limit)
    {
        return $this->db->where('user_id', $user_id)
            ->where('availability !=', '6')
            ->limit($limit)->order_by('id', 'DESC')
            ->get('audio_song')->result_array();
    }
    /**
     * List songs Download.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return array
     **/
    public function list_songs_download($user_id, $limit)
    {
        return $this->db->where('user_id', $user_id)
            ->group_start()
            ->like('availability', '2')
            ->group_end()
            ->limit($limit)->order_by('id', 'DESC')
            ->get('audio_song')->result_array();
    }
    /**
     * count songs on EPK.
     *
     * @param int $user_id
     *
     * @return int
     **/
    public function num_songs_epk($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->group_start()
            ->like('availability', '3')
            ->group_end()
            ->get('audio_song')->num_rows();
    }
    /**
     * Get Name song.
     *
     * @param int $id
     *
     * @return string
     **/
    public function get_name_song($id)
    {
        $res = $this->db->where('id', $id)->get('audio_song')->row();
        if (isset($res)) {
            return $res->song_name;
        } else {
            return 'Null';
        }
    }
    /**
     * Get ID user.
     *
     * @param int $id
     *
     * @return int
     **/
    public function get_artist_id($id)
    {
        $res = $this->db->where('id', $id)->get('audio_song')->row();
        if (isset($res)) {
            return $res->user_id;
        } else {
            return 'Null';
        }
    }
    /**
     * Get cover image playlist.
     *
     * @param int $id
     *
     * @return string $url 
     **/
    public function get_cover_playlist($id)
    {
        $this->db->where('id', $id);
        $data_album = $this->db->get('album_song')->row_array();
        if (empty($data_album['image_file'])) {
            return base_url().'assets/images/bgr_body_dalp.jpg';
        }
            else if($data_album['image_file']=="music.jpg"){
                return base_url().'assets/images/music.jpg';
            
        } else {
            return  base_url().'uploads/'.$data_album['user_id'].'/img_playlist/'.$data_album['image_file'];
        }
    }
    
     /**
     * Get cover image playlist.
     *
     * @param int $id
     *
     * @return string $url 
     **/
    public function get_cover_playlist_new($id)
    {
        $this->db->where('id', $id);
        $data_album = $this->db->get('album_song')->row_array();
        if (empty($data_album['image_file'])) {
            return FCPATH.'assets/images/bgr_body_dalp.jpg';
        }
            else if($data_album['image_file']=="music.jpg"){
                return FCPATH.'assets/images/music.jpg';
            
        } else {
            return  FCPATH.'uploads/'.$data_album['user_id'].'/img_playlist/'.$data_album['image_file'];
        }
    }
    
    /**
     * Get cover image Path playlist.
     *
     * @param int $id
     *
     * @return string $url 
     **/
    
    public function get_cover_playlist_path_new($id){ 
        
        $this->db->where('id', $id);
        $data_album = $this->db->get('album_song')->row_array();
        if (empty($data_album['image_file'])) {
            return base_url().'assets/images/';
        }
            else if($data_album['image_file']=="music.jpg"){
                return base_url().'assets/images/';
            
        } else {
            return  base_url().'uploads/'.$data_album['user_id'].'/img_playlist/';
        }
    }
    
     /**
      * Get cover image playlist on AMP.
      *
      * @param int $id
      *
      * @return string $url 
      **/
     public function get_cover_playlist_amp($id)
     {
         $this->db->where('id', $id);
         $data_album = $this->db->get('playlist_amp')->row_array();
         if (empty($data_album['image_file'])) {
             return base_url().'assets/images/bgr_body_dalp.jpg';
         } else {
             return  base_url().'uploads/'.$data_album['user_id'].'/img_playlist/'.$data_album['image_file'];
         }
     }
    /**
     * Check playlist is of user.
     *
     * @param int $id_user
     * @param int $id_playlist
     *
     * @return bool
     **/
    public function check_user_playlist($id_user, $id_playlsit)
    {
        $this->db->where('id', $id_playlsit);
        $data_album = $this->db->get('album_song')->row_array();
        if ($data_album['user_id'] == $id_user) {
            return true;
        } else {
            return  false;
        }
    }
    /**
     * List album song.
     *
     * @param int $id_user
     *
     * @return array
     **/
    public function get_data_playlist($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('num_song >', 0);
        $this->db->where('attribute !=', 0);
        $data_album = $this->db->get('album_song')->result_array();
        return $data_album;
    }
    
   
    /**
     * List album song AMP.
     *
     * @param int $id_user
     *
     * @return array
     **/
    public function get_data_playlist_amp($user_id)
    {
        $this->db->where('user_id', $user_id);
        $data_album = $this->db->get('playlist_amp')->result_array();

        return $data_album;
    }
    /**
     * List songs by $album_id.
     *
     * @param int $album_id
     *
     * @return array
     **/
    public function get_data_songs($album_id)
    {
        $data_songs = $this->db->where('album_id', $album_id)->get('audio_song')->result_array();

        return $data_songs;
    }
    /**
     * List songs by ID.
     *
     * @param int $id
     *
     * @return array
     **/
    public function get_albums_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->where('num_song >', 0);
        $data_album = $this->db->get('album_song')->row_array();

        return $data_album;
    }
    /**
     * List songs by ID album.
     *
     * @param int $id_album
     *
     * @return array
     **/
    public function get_songs_by_album($id_album)
    {
        $this->db->where('album_id', $id_album);
        $this->db->order_by('id', 'DESC');
        $data_album = $this->db->get('audio_song')->result_array();

        return $data_album;
    }
    /**
     * List songs by ID album AMP.
     *
     * @param int $id_album
     *
     * @return array
     **/
    public function get_songs_by_playlist_amp($id_album)
    {
        $data_album = $this->db
            ->select('audio_song.*, audio_amp.id as ID')
            ->where('playlist_amp_id', $id_album)
            ->join('audio_song', 'audio_song.id = audio_amp.audio_song_id ')
            ->get('audio_amp')
            ->result_array();

        return $data_album;
    }
    /**
     * MY song AMP.
     *
     * @param int $id_album
     *
     * @return array
     **/
    public function get_my_song_amp($id_album)
    {
        $data_mysongs = $this->db
            ->select('audio_song.id')
            ->where('playlist_amp_id', $id_album)
            ->join('audio_song', 'audio_song.id = audio_amp.audio_song_id ')
            ->get('audio_amp')
            ->result();
        $res = array();
        foreach ($data_mysongs as $row) {
            $res[] = $row->id;
        }

        return $res;
    }
    /**
     * Hash amazon s3.
     **/
    public function hmacsha1($key, $data)
    {
        $blocksize = 64;
        $hashfunc = 'sha1';
        if (strlen($key) > $blocksize) {
            $key = pack('H*', $hashfunc($key));
        }
        $key = str_pad($key, $blocksize, chr(0x00));
        $ipad = str_repeat(chr(0x36), $blocksize);
        $opad = str_repeat(chr(0x5c), $blocksize);
        $hmac = pack(
                    'H*', $hashfunc(
                        ($key ^ $opad).pack(
                            'H*', $hashfunc(
                                ($key ^ $ipad).$data

                            )
                        )
                    )
                );

        return bin2hex($hmac);
    }
    /**
     * HEX amazon s3.
     **/
    public function hex2b64($str)
    {
        $raw = '';
        for ($i = 0; $i < strlen($str); $i += 2) {
            $raw .= chr(hexdec(substr($str, $i, 2)));
        }

        return base64_encode($raw);
    }
    /**
     * Iframe shortcode amp.
     *
     * @param int $id
     *
     * @return string
     **/
    public function get_shortcode_AMP($id)
    {
        $affiliate_artist = $this->db->where('parent_affiliate', $id)->get('affiliates')->row_array();
        if (!empty($affiliate_artist)) {
            $short_code = '<iframe id="iframe_amp" src="'.base_url().'amp/embed/'.$affiliate_artist['affiliate_id'].'" frameborder="0" scrolling="no" width="100%" height="450px"></iframe>';

            return $short_code;
        } else {
            self::create_shortcode_AMP($id);

            return self::get_shortcode_AMP($id);
        }
    }
    /**
     * Iframe shortcode amp by affilaite.
     *
     * @param int $user_id
     *
     * @return string
     **/
    public function get_AMP_by_affiliate($user_id)
    {
        $affiliate_artist = $this->db->where('user_id', $user_id)->get('affiliates')->row_array();
        if (!empty($affiliate_artist)) {
            $short_code = '<iframe id="iframe_amp" src="'.base_url().'amp/embed/'.$affiliate_artist['affiliate_id'].'" frameborder="0" scrolling="no" width="100%" height="450px"></iframe>';

            return $short_code;
        }
    }
    /**
     * shortcode amp html5.
     *
     * @param int $id
     *
     * @return string
     **/
    public function get_AMP_html5($id)
    {
        $affiliate_artist = $this->db->where('parent_affiliate', $id)->get('affiliates')->row_array();
        if (!empty($affiliate_artist)) {
            $short_code = '<div id="jp_container_2" class="jp-audio">	</div>';
            $short_code .= '<script type="text/javascript" src="'.base_url().'assets/amp/js/setting.playlist.js"> </script>';
            $short_code .= "<script type='text/javascript'>AMP_Load_data('".$affiliate_artist['affiliate_id']."');</script>";

            return $short_code;
        } else {
            self::create_shortcode_AMP($id);

            return self::get_shortcode_AMP($id);
        }
    }
    /**
     * Get affiliate by id_artist.
     *
     * @param int $id_artist
     *
     * @return int $affiliate_id
     **/
    public function get_affiliate_id($id_artist)
    {
        $affiliate_artist = $this->db->where('parent_affiliate', $id_artist)->get('affiliates')->row_array();

        return $affiliate_artist['affiliate_id'];
    }
    /**
     * create data shortcode AMP.
     *
     * @param int $id_user
     **/
    public function create_shortcode_AMP($id)
    {
        $aritist = $this->db->where('id', $id)->get('users')->row_array();
        $this->load->helper('string');
        $allnums = self::get_data_playlist($id);
        $playlistAlbumIds = '';
        foreach ($allnums as $row) {
            $playlistAlbumIds .= $row['id'];
            if (end($allnums) != $row) {
                //$playlistAlbumIds .= ',';
            }
        }
        $options = '{
            "scheme_name":"Style Custome",
            "background_color":"rgba(31,30,30,0.35)",
            "color_time_loaded":"#000000",
            "color_track_front":"#000000",
            "color_font":"#ffffff",
            "affiliatetext":"To Become An Affiliate",
            "ordertext":"CLICK HERE TO ORDER",
            "playlistAlbumIds":"'.$playlistAlbumIds.'",
            "autostart":"false"
        }';
        $ID_UNIWUE = random_string('unique');
        $insertArr = array(
            'affiliate_id' => $ID_UNIWUE,
            'artist_id' => $id,
            'active' => 1,
            'date_create' => time(),
            'parent_affiliate' => $id,
            'option_widget' => $options,
            'user_id' => $id,
            'list_artist' => $id,
        );
        $this->db->insert('affiliates', $insertArr);
        $InsertNewLevel = array(
            'affiliate_id' => $ID_UNIWUE,
            'artist_id' => $id,
            'level' => 0,
            'status' => 1,
        );
        $this->db->insert('affiliate_level', $InsertNewLevel);
    }
    /**
     * get option widget.
     *
     * @param int $id_user
     *
     * @return json
     **/
    public function get_options($user_id)
    {
        $affiliate_artist = $this->db->where('user_id', $user_id)->get('affiliates')->row_array();
        if (!empty($affiliate_artist)) {
            return $affiliate_artist['option_widget'];
        } else {
            return false;
        }
    }
    /**
     * add new song to amp.
     *
     * @param int $id_song
     * @param int $id_playlist
     **/
    public function add_new_song_amp($id_song, $id_playlist)
    {
        $playlit_amp = $this->db->where('album_root', $id_playlist)->get('playlist_amp')->result();
        foreach ($playlit_amp as $playlist) {
            $insertArr = array(
            'audio_song_id' => $id_song,
            'playlist_amp_id' => $playlist->id,
           );
            $this->db->insert('audio_amp', $insertArr);
        }
    }
    /**
     * add new options widget.
     *
     * @param int $id_artist
     * @param int $id_playlist
     **/
    public function add_new_option_playlist($id_artist, $id_playlist)
    {
        //insert playlist Amp
        $album_basic = $this->db->where('id', $id_playlist)->get('album_song')->row();
        $insertArr = array(
            'name' => $album_basic->name,
            'image_file' => $album_basic->image_file,
            'decs' => $album_basic->decs,
            'user_id' => $id_artist,
            'time' => time(),
            'album_root' => $id_playlist,
        );
        $this->db->insert('playlist_amp', $insertArr);
        $id_playlist_amp = $this->db->insert_id();
        //update options
        self::add_new_option_playlist_amp($id_artist, $id_playlist_amp);
    }
    /**
     * add new options playlist.
     *
     * @param int $id_user
     * @param int $id_playlist
     **/
    public function add_new_option_playlist_amp($id_user, $playlist_id)
    {
        $option_widget = self::get_options($id_user);
        if (!empty($option_widget)) {
            //update options
            $decode = json_decode($option_widget);
            if (empty($decode->playlistAlbumIds)) {
                $decode->playlistAlbumIds = strval($playlist_id);
            } else {
                $decode->playlistAlbumIds .= ','.$playlist_id;
            }
            $Update_array = array(
                'option_widget' => json_encode($decode),
            );
            $this->db->update('affiliates', $Update_array, 'user_id='.$id_user);
        } else {
            // create new options
            $options = '{
                "scheme_name":"Style Custome",
                "background_color":"rgba(31,30,30,0.35)",
                "color_time_loaded":"#000000",
                "color_track_front":"#000000",
                "color_font":"#ffffff",
                "affiliatetext":"To Become An Affiliate",
                "ordertext":"CLICK HERE TO ORDER",
                "playlistAlbumIds":"'.$playlist_id.'"
            }';
            $Update_array = array(
                'option_widget' => $options,
            );
            $this->db->where('user_id =', $id_user)->update('affiliates', $Update_array);
        }
    }
    /**
     * create new options affiliate.
     *
     * @param string $id_affiliate
     * @param int    $id_artist
     **/
    public function new_options_aff($id_affiliate, $id_artist)
    {
        $option_widget = self::get_options($id_artist);
        $Update_array = array(
            'option_widget' => $option_widget,
        );
        $this->db->where('affiliate_id =', $id_affiliate)->update('affiliates', $Update_array);
    }
    /**
     * My playlist AMP.
     *
     * @param int $id_user
     * @param int $start
     * @param int $per_page
     *
     * @return object
     **/
    public function get_my_playlist_amp($id_user, $start, $per_page)
    {
        $res = $this->db->where('user_id', $id_user)->limit($start, $per_page)->get('playlist_amp')->result();

        return $res;
    }
    /**
     * Total playlist AMP.
     *
     * @param int $id_user
     *
     * @return int
     **/
    public function total_my_playlist_amp($id_user)
    {
        $res = $this->db->where('user_id', $id_user)->get('playlist_amp')->num_rows();

        return $res;
    }
    /*my code */
	
	public function get_list_songs($album_id)
    {
	
         
		$this->db->select('*');
        $this->db->from("audio_song");
        $this->db->where("album_id", $album_id);
        $query = $this->db->get();
		
 		return $query->result();
     }
	
	
	/* get id by user id  added by sunil */
	 
	 public function fetch_albums_id($id)
    {
 		
		$this->db->select('*');
        $this->db->from("album_song");
		$this->db->where('num_song >', 0);
        $this->db->where("user_id", $id);
        $query = $this->db->get();
 		return $query->result();
    }
	 
	 /* get id by userid  close */
	 
	  /* update function for user tabel song id added by sunil*/
	 
	 public function update_song_id($albumid,$userid)
	 {
	   $data = array(
				   'set_primary_song' => $albumid
				);
	    $array = array('id' => $userid);
		$this->db->where($array);
		$this->db->update('users',$data);
		$this->db->last_query();
		
	 }
	 
	 
	 public function fetch_json($uid)
	 {
	    $this->db->select('*');
        $this->db->from("affiliates");
        $this->db->where("user_id", $uid);
        $query = $this->db->get();
		 
 		return $query->result();
	 }
	 
	 public function update_json($userid,$old_val)
	 {
	 
	    $array = array('user_id' => $userid);
		$this->db->where($array);
		$this->db->update('affiliates',$old_val);
		//$this->db->last_query();
	 }
	 
	 /*video list show */
	 
	  public function list_video_show($userid)
	  {
	    $this->db->select('*');
        $this->db->from("videos");
        $this->db->where("user_id",$userid);
        $query = $this->db->get();
		return $query->result();
 	  }
	 /*video list close*/
	 
	 /*set video as primary */
	 
	  public function setvideoprimary($id,$userid)
   {
		 $data = array(
				   'primary_video' => $id
				);
	    $array = array('id' => $userid);
		$this->db->where($array);
		$this->db->update('users',$data);
   }	
   
   
   function set_primary_video($user_id)
   {
		$video_album = $this->db->query("select videos.name_video,videos.name_file,videos.type,videos.user_id,videos.id,videos.type,videos.create_date,videos.create_date from videos join users on users.primary_video=videos.id where videos.user_id=$user_id"); 
	
		return $video_album->result_array();
    }
		
	 /*set video as primary close */ 
	 
    public function get_data_songs_epk($album_id){
      return  $this->db->where('album_id', $album_id)
            ->order_by('id', 'DESC')
            ->get('audio_song')->result_array();
    }
	 
    public function get_my_song_epk($id_album)
    {
        $data_mysongs = $this->db
            ->select('audio_song.id')
            ->where('playlist_amp_id', $id_album)
            ->group_start()
            ->like('audio_song.availability', '3')
            ->group_end()
            ->join('audio_song', 'audio_song.id = audio_amp.audio_song_id ')
            ->get('audio_amp')
            ->result();
        $res = array();
        foreach ($data_mysongs as $row) {
            $res[] = $row->id;
}
        return $res;
    } 

    public function get_all_epk_songs($user_id, $limit)
    {
        $epk_data = $this->db->where('user_id', $user_id)->select('epk_song')->get('customize_epk')->row_array();
        if($epk_data['epk_song'] && ($limit != 0))
        {
            $dataArray = array_reverse(explode(',', $epk_data['epk_song']));
            return $this->db->where('user_id', $user_id)
            ->limit($limit)
            ->where_in('id', $dataArray)
            ->order_by('id', 'DESC')
            ->get('audio_song')->result_array();
             
        }
        else {
            return $this->db->where('user_id', $user_id)
            ->order_by('id', 'DESC')
            ->get('audio_song')->result_array();
        }
    }
    public function get_epk_songs_id($user_id)
    {
        $epk_data = $this->db->where('user_id', $user_id)->select('epk_song')->get('customize_epk')->row_array();
        if(isset($epk_data))
        {
            $epk_array = explode(',', $epk_data['epk_song']);
        }
        return $epk_array;
    }
    public function get_total_songs($user_id,$album_id)
    {
        return $this->db->get_where('audio_song',array('user_id'=>$user_id,'album_id'=>$album_id))
                ->num_rows();
    }

    public function get_all_albums_epk($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('num_song >', 0);
        $data_album = $this->db->get('album_song')->result_array();
        return $data_album;
    }

    
}
