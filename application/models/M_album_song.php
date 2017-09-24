<?php

class M_album_song extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Get data  Album.
     *
     * @param int $playlist_id
     *
     * @return array
     **/
    public function get_data_album($playlist_id)
    {
        return $this->db->where('id', $playlist_id)
            ->get('album_song')->row_array();
    }
    /**
     * List Album.
     *
     * @param int $user_id
     *
     * @return array objcet
     **/
    public function list_albums($user_id)
    {
        return $this->db->where('user_id', $user_id)->get('album_song')->result_array();
    }
    /**
     * Total Album song.
     *
     * @param int $user_id
     *
     * @return int
     **/
    public function total_albums($user_id)
    {
        return $this->db->where('user_id', $user_id)->get('album_song')->num_rows();
    }
    /**
     * List Album song.
     *
     * @param int $user_id
     * @param int $per_page
     * @param int $start
     *
     * @return array objcet
     **/
    public function list_album_songs($user_id, $per_page, $start)
    {
        return $this->db->limit($per_page, $start)
            ->get_where('album_song', array('user_id' => $user_id))
            ->result_array();
    }
}
