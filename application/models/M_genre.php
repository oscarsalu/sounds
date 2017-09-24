<?php

class M_genre extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Get Genres.
     *
     * @param int $id_genre
     *
     * @return object
     **/
    public function get_genre($id_genre)
    {
        return $this->db->where('id', $id_genre)
            ->get('genres')->row();
    }
    /**
     * Get all Genres.
     *
     * @param int $id_genre
     *
     * @return array object
     **/
    public function get_all_genres()
    {
        return $this->db->get('genres')->result();
    }
}
