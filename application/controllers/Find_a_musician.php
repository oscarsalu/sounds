<?php
/**
 * PHP_CodeSniffer tokenizes PHP code and detects violations of a
 * defined set of coding standards.
 *
 * PHP version 5
 *
 * @category  PHP
 *
 * @author    sound99 <author@example.com>
 * @copyright 2016 99SOUND
 * @license   http://www.99SOUND.COM  PHP License 3.01   
 *
 * @link      http://pear.php.net/package/PackageName
 */
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Auth.
 * 
 * @category  PHP
 *
 * @author    sound99 <author@example.com>
 * @copyright 2016 GallerySoft
 * @license   http://www.99SOUND.COM  PHP License 3.01
 *
 * @version   2016
 *
 * @link      http://pear.php.net/package/PackageName
 */
class Find_A_Musician extends MX_Controller
{
    /**
     * Auth construct.
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_genre');
        $this->load->model('M_photo');
        $this->load->model('M_find_musician');
        $this->load->model('Member_model');
        $this->load->model('M_text');
        $ac = $this->session->userdata('access');
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
     * Auth::index().
     * 
     * @return response
     */
    public function index()
    {
        $this->load->library('pagination');
        $data['musicians'] = $this->M_find_musician->rand_musician(12);
        $data['genres'] = $this->M_genre->get_all_genres();
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('find_a_musician', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * Auth::search().
     * 
     * @return response
     */
    public function search()
    {
        $city = $this->input->get('city');
        $genre = $this->input->get('genre');
        $config['per_page'] = 12;
        $config['base_url'] = base_url()."find-a-musician/search?city=$city&genre=$genre";
        $start = $this->input->get('per_page');
        if (empty($start)) {
            $start = 0;
        }
        $config['total_rows'] = $this->M_find_musician->num_search($city, $genre);
        $this->load->library('pagination', $config);
        $this->pagination->initialize($config);
        $data['musicians'] = $this->M_find_musician->search($city, $genre, $start, $config['per_page']);
        $data['genres'] = $this->M_genre->get_all_genres();
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('find_a_musician', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View result resultmusicians.
     *
     * @param string $name something
     *
     * @return response
     **/
    public function musicians($name)
    {
        $results = $this->Member_model->getUserByName('users', array('home_page' => $name));
        foreach ($results as $result) {
            $user_id = $result->id;
            $id_ctry = $result->countries;
            $id_genre = $result->genre;
            $style = $result->template_landing;
            $city = $result->city;
        }
        if (!empty($results)) {
            $data['loged'] = $this->session->userdata('loged_in');
            $data['genres'] = $this->db->where('id', $id_genre)
                ->get('genres')->result_array();
            $data['country_code'] = $this->db->where('id', $id_ctry)
                ->get('countries')->result_array();
            $data['id'] = $user_id;
            $data['user_id'] = $this->session->userdata('loged_in');
            $data['city'] = $city;
            $data['songs'] = $this->db->where('user_id', $user_id)
                ->limit(10)->order_by('id', 'DESC')
                ->get('audio_song')->result_array();
            $data['photos'] = $this->db->where('user_id', $user_id)
                ->limit(20)->order_by('id', 'DESC')
                ->get('photos')->result_array();
            $data['home_page'] = $name;
            $data['photo'] = $this->M_photo->getPhotoProfile($user_id);
            $data['users'] = $results;
            $data['videos'] = $this->db->where('user_id', $user_id)
                ->limit(4)->order_by('id', 'DESC')
                ->get('videos')->result_array();
            $data['music_list'] = $this->db->select('*')
                ->from('music_list')
                ->where('music_list.user_id', $user_id)
                ->join('users', 'music_list.music_user_id = users.id')
                ->join('photos', 'music_list.music_user_id = photos.user_id', 'left')
                ->group_by('music_list.user_id')
                ->limit(10)->order_by('music_list.id', 'DESC')
                ->get()->result_array();
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('artist/findmusicians/resultmusicians', $data);
            $this->load->view('includes/footer', $data);
        }
    }
    /**
     * Add music list.
     *
     * @param int    $id        id
     * @param string $home_page home_page
     *
     * @return response
     **/
    public function addMusicList($id, $home_page)
    {
        if (isset($id) && isset($home_page)) {
            $results = $this->db->where('home_page', $home_page)
                ->get('users')->result_array();
            foreach ($results as $result) {
                $id_music = $result['id'];
            }
            $isset = $this->db->where('user_id', $id)->where('music_user_id', $id_music)->get('music_list')->num_rows();
            if ($isset > 0) {
                redirect('findamusician/'.$home_page);
            } else {
                $insertArr = array('user_id' => $id, 'music_user_id' => $id_music);
                $this->db->insert('music_list', $insertArr);
                redirect('findamusician/'.$home_page);
            }
        } else {
            redirect('account/login');
        }
    }
}
