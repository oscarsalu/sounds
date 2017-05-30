<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_local_featured extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Get all artirt in city.
     *
     * @param string $city
     * @param int    $limit
     *
     * @return array
     **/
    public function get_all_artist_city($city, $limit)
    {
        $worldwide_artists = $this->db->select('*,g.name as genre_name,u.id as usid')
            ->from('users as u')
            ->where('u.role', 1)
            ->where('u.is_admin != ', 1)
            ->where('u.city', $city)
            ->join('genres as g', 'u.genre = g.id')
            ->group_by('u.id')
            ->limit(6, $limit)
            ->order_by('u.id', 'DESC')
            ->get()->result_array();

        return $worldwide_artists;
    }
    /**
     * Get all artirt in city.
     *
     * @param string $city
     * @param int    $limit
     *
     * @return array
     **/
    public function get_all_artist_city_home($city)
    {
        $worldwide_artists = $this->db->select('*,g.name as genre_name,u.id as usid')
            ->from('users as u')
            ->where('u.role', 1)
            ->where('u.is_admin != ', 1)
            ->where('u.city', $city)
            ->join('genres as g', 'u.genre = g.id')
            ->group_by('u.id')
            ->limit(12, 0)
            ->order_by('u.id', 'DESC')
            ->get()->result_array();

        return $worldwide_artists;
    }
    /**
     * Get genre.
     *
     * @param int $genre
     *
     * @return array
     **/
    public function get_genre($genre)
    {
        $this->db->where('genres.id', $genre);
        $this->db->where('users.genre', 'genres.id');

        return $this->db->get('users', 'genres')->result_array();
    }
}
