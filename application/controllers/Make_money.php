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
class Make_Money extends CI_Controller
{
    /**
     * Auth construct.
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->model('M_make_money');
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
     * View make money.
     */
    public function index()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $data['background'] = $this->M_make_money->get_background();
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('make_money', $data);
        $this->load->view('includes/footer', $data);
    }
}
