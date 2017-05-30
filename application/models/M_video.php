<?php

class M_video extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Count number videos.
     *
     * @param int $user_id
     *
     * @return int
     **/
    public function num_videos($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->count_all_results('videos');
    }
    /**
     * Count number videos epk.
     *
     * @param int $user_id
     *
     * @return int
     **/
    public function num_videos_epk($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->count_all_results('videos');
    }
    /**
     * List Videos on FLP.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return array
     **/
    public function list_videos_flp($user_id, $limit)
    {
        return $this->db->where('user_id', $user_id)
            ->limit($limit)->order_by('id', 'DESC')
            ->get('videos')->result_array();
    }
    /**
     * List Videos on ALP.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return array
     **/
    public function list_videos_alp($user_id, $limit)
    {
        return $this->db->where('user_id', $user_id)
            ->limit($limit)->order_by('id', 'DESC')
            ->get('videos')->result_array();
    }
    /**
     * List Videos on EPK.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return array
     **/
    public function list_videos_epk($user_id, $limit)
    {

        $epk_data = $this->db->where('user_id', $user_id)->select('epk_video')->get('customize_epk')->row_array();
        if(isset($epk_data['epk_video']) || ($limit != 0))
        {
            $dataArray = array_reverse(explode(',', $epk_data['epk_video']));
        return $this->db->where('user_id', $user_id)
            ->where_in('id', $dataArray)
            ->limit($limit)->order_by('id', 'DESC')
            ->get('videos')->result_array();
    }
        else
        {
            return $this->db->where('user_id', $user_id)
            ->order_by('id', 'DESC')
            ->get('videos')->result_array();
        }
        
    }
    /**
     * Cover Image Video.
     *
     * @param int $id_video
     *
     * @return array
     **/
    public function get_image_video($id)
    {
        $video = $this->db->where('id', $id)->get('videos')->row_array();
        if (isset($video)) {
            if ($video['type'] == 'link' or $video['type'] == 'link-vimeo') {
                $parse = parse_url($video['link_video']);
                if ($parse['host'] == 'www.youtube.com') {
                    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video['link_video'], $matches);
                    $id_link = $matches[0];
                    $src = 'http://img.youtube.com/vi/'.$id_link.'/hqdefault.jpg';
                } 
              else  if($parse['host']=='vimeo.com' or $parse['host']=='www.vimeo.com'){
                  $video_vimeo=basename($video['link_video']);
                 
                  $get_link='http://vimeo.com/api/v2/video/'.$video_vimeo.'.php';
                 
                  $hash = unserialize(file_get_contents($get_link));
                  $image=$hash[0]['thumbnail_medium']; 
               $src = $image;
              }
                else {
                    $src = base_url('assets/images/img/play_videos.png');
                }
            } elseif ($video['type'] == 'file') {
                $src = base_url('uploads/'.$video['user_id'].'/video/'.$video['cover_image']);
            } else {
                $src = base_url('assets/images/img/play_videos.png');
            }
        } else {
            $src = base_url('assets/images/img/play_videos.png');
        }

        return $src;
    }

    /*video list show */
     
      public function list_all_video($userid)
      {
        $this->db->select('*');
        $this->db->from("videos");
        $this->db->where("user_id", $userid);
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
    
}

