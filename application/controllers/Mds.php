<?php
/**
 * Mds File Doc Comment.
 *
 * @category Mds
 *
 * @author   99sound <admin@99sound.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 *
 * @link     http://www.99Sound.com/
 */
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Mds Class Doc Comment.
 *
 * @category Mds
 *
 * @author   99sound <admin@99sound.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 *
 * @link     http://www.99Sound.com/
 */
class Mds extends MX_Controller
{
    /**
     * Function constructor to initiate values & load data.
     * 
     * @return nothing.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
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
     * Function to MDS.
     * 
     * @return nothing.
     */
    public function index()
    {
        $data = array(
            'custom_header' => $this->_header(),
        );
        $data['user_data'] = $this->session->userdata('user_data');

        $this->load->view('includes/header', $data);
        //$this->load->view('includes/navbar', $data);
        $this->load->view('mds', $data);
    }
    /**
     * Function to add header.
     * 
     * @return nothing.
     */
    private function _header()
    {
        $html = '
        <link href="/assets/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/lightbox.css">
        <style>
        img.example-image { width: 100%!important; }
        </style>
        ';

        return $html;
    }
}
