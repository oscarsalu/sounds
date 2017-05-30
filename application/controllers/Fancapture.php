<?php
/**
 * Fancapture File Doc Comment.
 *
 * @category Fancapture
 *
 * @author   99sound <admin@99sound.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 *
 * @link     http://www.99Sound.com/
 */
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Fancapture Class Doc Comment.
 *
 * @category Fancapture
 *
 * @author   99sound <admin@99sound.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 *
 * @link     http://www.99Sound.com/
 */
class Fancapture extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *     http://example.com/index.php/welcome
     * - or -
     *     http://example.com/index.php/welcome/index
     * - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_audio_song');
        $this->load->model('M_affiliate');
        $ac = $this->session->userdata('access');
        $this->load->model('M_text');
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
     * Function index to View Fancapture.
     *
     * @return nothing, loads views.
     */
    public function index()
    {
        $data['genres'] = $this->db->get('genres')->result_array();
        $data['user_data'] = $this->session->userdata('user_data');
        $data['list_artist'] = $this->db
            ->where('role', 1)->where('lock', 0)
            ->limit(12, 0)
            ->get('users')->result_array();
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('fan_capture/index', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * Function to Filter by genre.
     *
     * @param int $id_genres the id of record needed
     * 
     * @return nothing, loads views.
     */
    public function filter_genre($id_genres)
    {
        $data['genres'] = $this->db->get('genres')->result_array();
        $data['current_genre'] = $id_genres;
        $data['user_data'] = $this->session->userdata('user_data');
        $data['list_artist'] = $this->db
            ->where('role', 1)->where('lock', 0)
            ->where('genre', $id_genres)
            ->limit(12, 0)
            ->get('users')->result_array();
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('fan_capture/filter_genres', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * Function to ajax load more artist.
     *
     * @return list of artist.
     */
    public function load_list_artist()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $per_page = $this->input->post('page');
        $list_artist = $this->db
            ->where('role', 1)->where('lock', 0)
            ->limit(12, 12 * ($per_page - 1) - 1)
            ->get('users')->result_array();
        echo json_encode($list_artist);
    }
    /**
     * Function to ajax load more artist by genre.
     *
     * @return artist by genre.
     */
    public function load_list_artist_genre()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $per_page = $this->input->post('page');
        $genre = $this->input->post('genre');
        $list_artist = $this->db
            ->where('role', 1)->where('lock', 0)
            ->where('genre', $genre)
            ->limit(12, 12 * ($per_page - 1) - 1)
            ->get('users')->result_array();
        echo json_encode($list_artist);
    }
    /**
     * Function to ajax load list search artist.
     *
     * @return list of search artist
     */
    public function load_list_artist_search()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $per_page = $this->input->post('page');
        $get = $this->input->post('get');
        if (empty($key['name'])) {
            $list_artist = $this->db
                ->where('role', 1)
                ->where_in('genre', $genre)
                ->where('lock', 0)
                ->limit(12, 0)
                ->get('users')->result_array();
        } else {
            $list_artist = $this->db
                ->where('role', 1)
                ->where_in('genre', $get['genre'])
                ->where('lock', 0)
                ->group_start()
                ->like('artist_name', $get['name'])
                ->or_like('home_page', $get['name'])
                ->group_end()
                ->limit(12, 0)
                ->get('users')->result_array();
        }
        $list_artist = $this->db
            ->where('role', 1)->where('lock', 0)
            ->where('genre', $genre)
            ->limit(12, 12 * ($per_page - 1) - 1)
            ->get('users')->result_array();
        echo json_encode($list_artist);
    }
    /**
     * Function to ajax load print.
     *
     * @return print
     */
    public function call_print()
    {
        $user_data = $this->session->userdata('user_data');
        $data = $this->input->post('data'); ?>
        <li>
            <div class="remix_items grid clearfix four_col">
                <a class="item" data-gal="photo" href="<?php echo base_url($data['home_page'])?>" title="" rel="bookmark">

                    <figure class="effect-bubba">
                        <img width="500" height="360" src="<?php echo $this->M_user->get_avata($data['id'])?>" class="attachment-type_cover wp-post-image" alt="" />
                        <figcaption>
                            <h2><?php echo $this->M_user->get_genre_name($data['genre'])?></h2>
                            <p>Pay 50%<br />
                                <?php echo $data['artist_name']?>
                            </p>
                        </figcaption>
                    </figure>
                </a>
            </div>
            <div>
                <a class="fixedposion btn_view_shortcode myButton" href="#" data-toggle="modal" data-target="#viewshortcode">Short-Code</a><br />
                <?php
                if (!$this->M_affiliate->check_connect_affiliate($data['id'], $user_data['id'])) {
                    ?>
                    <a class="fixedposion btn_view_shortcode myButton become_affiliate" data-affiliateId="<?php echo $this->M_audio_song->get_affiliate_id($data['id'])?>" >To become an affiliate</a>
                    <?php

                } ?>
                <input class="hide_shortcode" type="hidden" value="<?php echo htmlentities($this->M_audio_song->get_shortcode_AMP($data['id']))?>"/>
                <input class="hide_name_artist" type="hidden" value="<?php echo $data['artist_name']?>"/>
                <input class="hide_affiliate_id" type="hidden" value="<?php echo $this->M_audio_song->get_affiliate_id($data['id'])?>"/>
            </div>
        </li> 
        <?php

    }
    /**
     * Function to view search artist.
     *
     * @return nothing, loads views.
     */
    public function search()
    {
        $data['genres'] = $this->db->get('genres')->result_array();
        $data['user_data'] = $this->session->userdata('user_data');
        $key = $this->input->get('name');
        $genre = $this->input->get('genre');
        $location = $this->input->get('location');
        $instrument = $this->input->get('instrument');
        if (empty($key)) {
            $data['list_artist'] = $this->db
                ->where('role', 1)
                ->where_in('genre', $genre)
                ->where('lock', 0)
                ->limit(12, 0)
                ->get('users')->result_array();
        } else {
            $data['list_artist'] = $this->db
                ->where('role', 1)
                ->where_in('genre', $genre)
                ->where('lock', 0)
                ->group_start()
                ->like('artist_name', $key)
                ->or_like('home_page', $key)
                ->group_end()
                ->limit(12, 0)
                ->get('users')->result_array();
        }
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('fan_capture/search', $data);
        $this->load->view('includes/footer', $data);
    }
}
