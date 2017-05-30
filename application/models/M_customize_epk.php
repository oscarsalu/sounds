<?php

class M_customize_epk extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //Function to get user customise data
    public function get_customize_user_data($user_id)
    {
       return $this->db->where('user_id', $user_id)->get('customize_epk')->row_array();
    }
    //Function to update bios in customize_epk
    public function update_bio($user_id, $data)
    {
        $data_update = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
        return $data_update;
    }
    
    //Function to set photo to display on epk photo section
    public function set_epk_photo($user_id, $photo_id)
    {
        $epk_data = $this->db->where(array('user_id'=> $user_id))->get('customize_epk')->row_array();
        if($epk_data)
        {
            if(!empty($epk_data['epk_photo']))
            {
                $allPhotos = explode(',', $epk_data['epk_photo']);
                if (!(in_array($photo_id, $allPhotos))) 
                {
                    array_push($allPhotos, $photo_id);
                    $allPhotos = implode(',', $allPhotos);
                    $data = array('epk_photo'=> $allPhotos);
                    $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
                }
            }
            else
            {
                $data = array('epk_photo'=> $photo_id);
                $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
            }
        }
    }

    //Function to set Show in Customize EPK table
    public function set_epk_show($event_id, $user_id)
    {
        $epk_data = $this->db->where(array('user_id'=> $user_id))->get('customize_epk')->row_array();
        if($epk_data)
        {
            if(!empty($epk_data['epk_shows']))
            {
                $allShows = explode(',', $epk_data['epk_shows']);
                if (!(in_array($event_id, $allShows))) 
                {
                    array_push($allShows, $event_id);
                    $allShows = implode(',', $allShows);
                    $data = array('epk_shows'=> $allShows);
                    $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
                }
            }
            else
            {
                $data = array('epk_shows'=> $event_id);
                $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
            }
        }
    }

    //Function to set Show in Customize EPK table
    public function set_epk_video($video_id, $user_id)
    {
        $epk_data = $this->db->where(array('user_id'=> $user_id))->get('customize_epk')->row_array();
        if($epk_data)
        {
            if(!empty($epk_data['epk_video']))
            {
                $allVideos = explode(',', $epk_data['epk_video']);
                if (!(in_array($video_id, $allVideos))) 
                {
                    array_push($allVideos, $video_id);
                    $allVideos = implode(',', $allVideos);
                    $data = array('epk_video'=> $allVideos);
                    $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
                }
            }
            else
            {
                $data = array('epk_video'=> $video_id);
                $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
            }
        }
    }

    public function delete_epk_photo($photo_id, $user_id)
    {
        $epk_data = $this->db->where(array('user_id'=> $user_id))->get('customize_epk')->row_array();
        if($epk_data)
        {
            if(!empty($epk_data['epk_photo']))
            {
                $allPhotos = explode(',', $epk_data['epk_photo']);
                if (in_array($photo_id, $allPhotos)) 
                {
                    unset($allPhotos[array_search($photo_id, $allPhotos)]);
                    $allPhotos = implode(',', $allPhotos);
                    $data = array('epk_photo'=> $allPhotos);
                    $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
                }
            }
        }
    }

    public function save_content_limit($data)
    {
        $epk_data = $this->db->where(array('user_id'=> $data['user_id']))->get('customize_epk')->row_array();
        if($epk_data)
        {
            $data = array('photo_limit'=> $data['photo_limit'], 'video_limit'=> $data['video_limit'], 'show_limit'=> $data['show_limit'], 'song_limit'=> $data['song_limit'], 'download_song_limit'=> $data['download_song_limit'], 'press_limit'=> $data['press_limit']);
            $returnArray = $this->db->where(array('user_id'=> $epk_data['user_id']))->update('customize_epk', $data);
        }
    }


    public function delete_epk_video($video_id, $user_id)
    {
        $epk_data = $this->db->where(array('user_id'=> $user_id))->get('customize_epk')->row_array();
        if($epk_data)
        {
            if(!empty($epk_data['epk_video']))
            {
                $allVideos = explode(',', $epk_data['epk_video']);
                if (in_array($video_id, $allVideos)) 
                {
                    unset($allVideos[array_search($video_id, $allVideos)]);
                    $allVideos = implode(',', $allVideos);
                    $data = array('epk_video'=> $allVideos);
                    $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
                    return $returnArray;
                }
            }
        }
    }

    public function save_epk_info_display($user_id)
    {
        $data_custom = $this->db->where('user_id', $user_id)->get('customize_epk')->row_array();
        $epk_info_display_arr = array(
            'comments_counts' => 'on',
            'video_counts' => 'on',
            'fan_counts' => 'on',
            'song_counts' => 'on',
            'blog_counts' => 'on',
            'show_counts' => 'on',
            'age_break_down_display'=> 'on'
        );
        $epk_info_display_json = json_encode($epk_info_display_arr);
        if(empty($data_custom['epk_display_info']))
        {
            $data = array('epk_display_info'=> $epk_info_display_json);
            $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
        }
        return json_decode($epk_info_display_json);
    }

    public function update_epk_display_info($dataArray, $user_id)
    {
        $data = array('epk_display_info'=> json_encode($dataArray));
        $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
    }

    public function delete_epk_event($event_id, $user_id)
    {
        $epk_data = $this->db->where(array('user_id'=> $user_id))->get('customize_epk')->row_array();
        if($epk_data)
        {
            if(!empty($epk_data['epk_shows']))
            {
                $allShows = explode(',', $epk_data['epk_shows']);
                if (in_array($event_id, $allShows)) 
                {
                    unset($allShows[array_search($event_id, $allShows)]);
                    $allShows = implode(',', $allShows);
                    $data = array('epk_shows'=> $allShows);
                    $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
                    return $returnArray;
                }
            }
        }
    }

    public function delete_epk_blog($blog_id, $user_id)
    {
        $epk_data = $this->db->where(array('user_id'=> $user_id))->get('customize_epk')->row_array();
        if($epk_data)
        {
            if(!empty($epk_data['epk_blog']))
            {
                $allBlogs = explode(',', $epk_data['epk_blog']);
                if (in_array($blog_id, $allBlogs)) 
                {
                    unset($allBlogs[array_search($blog_id, $allBlogs)]);
                    $allBlogs = implode(',', $allBlogs);
                    $data = array('epk_blog'=> $allBlogs);
                    $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
                    return $returnArray;
                }
            }
        }
    }
    
    //Function to set Blog in Customize EPK table
    public function set_epk_blog($blog_id, $user_id)
    {
        $epk_data = $this->db->where(array('user_id'=> $user_id))->get('customize_epk')->row_array();
        if($epk_data)
        {
            if(!empty($epk_data['epk_blog']))
            {
                $allBlogs = explode(',', $epk_data['epk_blog']);
                if (!(in_array($blog_id, $allBlogs))) 
                {
                    array_push($allBlogs, $blog_id);
                    $allBlogs = implode(',', $allBlogs);
                    $data = array('epk_blog'=> $allBlogs);
                    $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
                }
            }
            else
            {
                $data = array('epk_blog'=> $blog_id);
                $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
            }
        }
    }

    //Function to set Press in Customize EPK table
    public function select_epk_press($press_id, $user_id)
    {
        $epk_data = $this->db->where(array('user_id'=> $user_id))->get('customize_epk')->row_array();
        if($epk_data)
        {
            if(!empty($epk_data['epk_press']))
            {
                $allPress = explode(',', $epk_data['epk_press']);
                if (!(in_array($press_id, $allPress))) 
                {
                    array_push($allPress, $press_id);
                    $allPress = implode(',', $allPress);
                    $data = array('epk_press'=> $allPress);
                    $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
                }
            }
            else
            {
                $data = array('epk_press'=> $press_id);
                $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
            }
        }
    }
    
    
    public function delete_epk_press($press_id, $user_id)
    {
        $epk_data = $this->db->where(array('user_id'=> $user_id))->get('customize_epk')->row_array();
        if($epk_data)
        {
            if(!empty($epk_data['epk_press']))
            {
                $allpress = explode(',', $epk_data['epk_press']);
                if (in_array($press_id, $allpress)) 
                {
                    unset($allpress[array_search($press_id, $allpress)]);
                    $allpress = implode(',', $allpress);
                    $data = array('epk_press'=> $allpress);
                    $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
                    return $returnArray;
                }
            }
        }
    }


    public function select_epk_song($song_id, $user_id)
    {
        $epk_data = $this->db->where(array('user_id'=> $user_id))->get('customize_epk')->row_array();
        if($epk_data)
        {
            if(!empty($epk_data['epk_song']))
            {
                $allSongs = explode(',', $epk_data['epk_song']);
                if (!(in_array($song_id, $allSongs))) 
                {
                    array_push($allSongs, $song_id);
                    $allSongs = implode(',', $allSongs);
                    $data = array('epk_song'=> $allSongs);
                    $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
                }
            }
            else
            {
                $data = array('epk_song'=> $song_id);
                $returnArray = $this->db->where(array('user_id'=> $user_id))->update('customize_epk', $data);
            }
        }
    }
}
