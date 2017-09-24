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
class Mailchimp extends CI_Controller{
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
        $this->load->library('mcapi');
        
         $ac = $this->session->userdata('access');
        $data['redirect_url']=$this->curPageURL();
        if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }
       
    
    }
    public function add_subscriber(){
    $list_id = '6fd3dd79df';
    $email=$this->input->post('email');
    $name=$this->input->post('name');
    $result =  $this->mcapi->listSubscribe($list_id, $email);
if($result){
   echo "success"; 
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
}