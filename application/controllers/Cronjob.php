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
class Cronjob extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * http://example.com/index.php/welcome
     * - or -
     * http://example.com/index.php/welcome/index
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
         $data['redirect_url']=$this->curPageURL();
        if (!isset($ac)) {
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
        
        $this->premiumArtistsHasExpires();
        exit;
    }
    /**
     * Auth::premiumArtistsHasExpires().
     * 
     * @return response
     */
    public function premiumArtistsHasExpires()
    {
        $admin_name = $this->config->item('admin_name');
        $email_from = $this->config->item('admin_email');
        $packs = $this->db->where('active', 1)->where('end_day <', date('Y-m-d H:i:s'))->get('premium_pack')->result_array();
        if (isset($packs) && count($packs) > 0) {
            foreach ($packs as $pack) {
                $this->db->where('id', $pack['id'])->update('premium_pack', array('active' => 0));
                $user = $this->db->where('id', $pack['user_id'])->get('users')->row_array();
                $to_email = $user['email'];
                $this->load->library('email');

                $this->load->helper('string');
                $data['user'] = $user;
                $data['pack'] = $pack;
                $data['encrypted_string'] = random_string('alpha', 16);
                $message = $this->load->view('email/premiumArtistsHasExpires', $data, true);
                $config['protocol'] = 'smtp';
                $config['charset'] = 'utf-8';
                $config['mailtype'] = 'html';
                $config['newline'] = "\r\n";
                $subject = 'Our Featured / Premium Artists has Expires';
                $this->email->initialize($config);
                $this->email->clear();
                $this->email->from($email_from, $admin_name);
                $this->email->reply_to($email_from, $admin_name);
                $this->email->to($to_email);
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();
            }
        }
    }
}
