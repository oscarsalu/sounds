<?php

class M_home extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Get Video Background.
     *
     * @param string $video
     *
     * @return array
     **/
    public function get_background()
    {
        $results = $this->db->where('page_name', 'home')->get('backgrounds')->result_array();

        return $results;
    }
    /**
     * Get Video Background.
     *
     * @param string $video
     *
     * @return array
     **/
    public function get_video_background()
    {
        $results = $this->db->where('page_name', 'home')->get('background_videos')->result_array();

        return $results;
    }
    /**
     * Get Video.
     *
     * @param string $video
     *
     * @return array
     **/
    public function get_vid_type($video)
    {
        $parse = parse_url($video);
        if (isset($parse['host']) && $parse['host'] == 'www.youtube.com') {
            $result = $video;
        } else {
            $result = base_url().'uploads/home/videos/'.$video;
        }
        echo $result;
    }
    /**
     *LIST RANDOM  artist.
     *
     * @param int
     *
     * @return array
     **/
    public function random_artist($limit)
    {
        return $this->db->select('*,u.id,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
            ->from('users as u')
            ->where('u.role', 1)
            ->where('u.lock ', 0)
            ->where('u.is_admin ', 0)
            ->join('photos as p', 'u.id = p.user_id', 'left')
            ->join('audio_song as a', 'u.id = a.user_id', 'left')
            ->join('genres as g', 'u.genre = g.id')
            ->join('countries as c', 'u.countries = c.id')
            ->group_by('u.id')
            ->order_by('u.id', 'RANDOM')
            ->limit($limit)
            ->get()->result_array();
    }
    /**
     *LIST RANDOM  Fan.
     *
     * @param int
     *
     * @return array
     **/
    public function random_fans($limit)
    {
        return $this->db->select('*,u.id,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
            ->from('users as u')
            ->where('u.role', 1)
            ->where('u.lock ', 0)
            ->where('u.is_admin ', 0)
            ->join('photos as p', 'u.id = p.user_id', 'left')
            ->join('audio_song as a', 'u.id = a.user_id', 'left')
            ->join('genres as g', 'u.genre = g.id')
            ->join('countries as c', 'u.countries = c.id')
            ->group_by('u.id')
            ->order_by('u.id', 'RANDOM')
            ->limit($limit)
            ->get()->result_array();
    }
    /**
     *LIST Video.
     *
     * @param int
     *
     * @return array
     **/
    public function list_videos($limit)
    {
        return $this->db->select('*, v.user_id as u_id')
            ->from('videos as v')
            ->where('v.link_video !=', '')
            ->where('v.type !=', 'file')
            ->join('photos as p', 'v.user_id = p.user_id', 'left')
            ->join('users as u', 'v.user_id = u.id')
            ->where('u.role', 1)
            ->where('u.lock ', 0)
            ->where('u.is_admin != ', 1)
            ->group_by('v.user_id')
            ->limit($limit)
            ->order_by('v.id', 'asc')
            ->get()->result_array();
    }
    /**
     *LIST Worldwide Artists.
     *
     * @param int
     *
     * @return array
     **/
    public function worldwide_artists($limit)
    {
        return $this->db->select('*,u.id,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
            ->from('users as u')
            ->where('u.role', 1)
            ->where('u.lock ', 0)
            ->where('u.is_admin ', 0)
            ->where('pk.active', 1)
            ->join('premium_pack as pk', 'u.id = pk.user_id', 'left')
            ->join('photos as p', 'u.id = p.user_id', 'left')
            ->join('audio_song as a', 'u.id = a.user_id', 'left')
            ->join('genres as g', 'u.genre = g.id')
            ->join('countries as c', 'u.countries = c.id')
            ->group_by('pk.id')
            ->limit($limit)
            ->order_by('pk.id', 'DESC')
            ->get()->result_array();
    }
    /**
     * template landings page.
     **/
    public function template_lands()
    {
        return $this->db->where('type', 'landing')
            ->where('active', 1)
            ->order_by('position', 'ASC')
            ->get('template_lands')->result_array();
    }
    /**
     * template EPK page.
     **/
    public function template_epk()
    {
        return $this->db->where('type', 'epk')
            ->where('active', 1)
            ->order_by('position', 'ASC')
            ->get('template_lands')->result_array();
    }
}
