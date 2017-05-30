<?php

defined('BASEPATH') or exit('No direct script access allowed');

class All_artist extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_video');
        $this->load->model('M_text');
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
     * View all artist.
     **/
    public function index()
    {
        $data['artists'] = $this->db->select('*')
                ->from('users')
                ->where('users.role', 1)->where('users.lock', 0)
                ->where('users.is_admin', 0)
                ->count_all_results();

        $data['videos'] = $this->db->select('*')
                        ->limit(12)->order_by('id', 'DESC')
                        ->get('videos')->result_array();

        $data['countries'] = $this->db->select('*')
                             ->from('countries')
                             ->get()->result_array();
        $data['user_data'] = $this->session->userdata('user_data');

        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/all_artist', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * Ajax load data artist.
     **/
    public function load_ajax()
    {
        $page = $this->input->get('page');
        if (isset($page)) {
            $data['artists'] = $this->db->select('u.id,a.filename , u.genre')
                ->from('users as u')
                ->where('u.role', 1)->where('u.lock', 0)->where('u.is_admin', 0)
                ->join('audio_song as a', 'u.id = a.user_id', 'left')
                ->group_by('u.id')
                ->order_by('u.id', 'desc')
                ->limit($page, 12)
                ->get()->result_array();
            $this->load->view('artist/all_artists/auto_load_artist', $data);
            //echo json_encode($artists);                              
        }
    }
    /**
     * search artist.
     **/
    public function search_artists()
    {
        $page = $this->input->get('page');
        if (isset($page)) {
            $fields = array('home_page', 'genre', 'countries', 'instrument');
            $conditions = array();

            foreach ($fields as $field) {
                $value = $this->input->get($field);
                if (isset($value) && $value != '') {
                    $conditions[] = "`$field` LIKE '%".$this->db->escape_str($value)."%'";
                }
            }
            $query = '';
            if (count($conditions) > 0) {
                $query .= implode(' AND ', $conditions);
            }

            $data['artists'] = $this->db->select('u.id, a.filename, u.genre')
                        ->from('users as u')
                        ->where('u.role', 1)->where('u.lock', 0)->where('u.is_admin', 0)
                        ->where($query)
                        ->join('audio_song as a', 'u.id = a.user_id', 'left')
                        ->group_by('u.id')
                        ->order_by('u.id', 'desc')
                        ->limit($page, 12)
                        ->get()->result_array();
            $this->load->view('artist/all_artists/result_load_search', $data);
        }
    }
    /**
     * get total rows.
     **/
    public function get_total_rows()
    {
        $fields = array('home_page', 'genre', 'countries', 'instrument');
        $conditions = array();

        foreach ($fields as $field) {
            $value = $this->input->get($field);
            if (isset($value) && $value != '') {
                $conditions[] = "`$field` LIKE '%".mysql_real_escape_string($value)."%'";
            }
        }
        $query = '';
        if (count($conditions) > 0) {
            $query .= implode(' AND ', $conditions);
        }

        $total = $this->db->from('users')
                    ->where('users.role', 1)->where('users.lock', 0)->where('users.is_admin', 0)
                    ->where($query)
                    ->count_all_results();
        echo $total;
    }
}
