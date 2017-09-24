<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/third_party/OAuth.php');
Class Pritteer{
    
    public function __construct()
    {
        
        $CI =& get_instance();
        
		$CI->config->load('pritteer');
				
		require APPPATH .'third_party/pritteer/autoload.php';
		
		$pritteer_app_id = $CI->config->item('pritteer_app_id');
        $pritteer_app_secret = $CI->config->item('pritteer_app_secret');
        $this->pinterest = new DirkGroenen\Pinterest\Pinterest($pritteer_app_id, $pritteer_app_secret);
        
        if (isset($_GET["code"])) {
            $token = $this->pinterest->auth->getOAuthToken($_GET["code"]);
            $this->pinterest->auth->setOAuthToken($token->access_token);
            setcookie("access_token", $token->access_token);
        } else if (isset($_GET["access_token"])) {
            $this->pinterest->auth->setOAuthToken($_GET["access_token"]);
        } else if (isset($_COOKIE["access_token"])) {
            $this->pinterest->auth->setOAuthToken($_COOKIE["access_token"]);
        }
        
        
    }
    public function callback($code){

            if(isset($code) && !empty($code)){
                
        	$token = $this->pinterest->auth->getOAuthToken($code);
            var_dump($token);exit;
        	$this->pinterest->auth->setOAuthToken($token->access_token);
            
            $this->session->set_userdata('access_token_pritteer',$token->access_token);
        }else{
            $url = $this->pinterest->auth->getLoginUrl(base_url('social_media/callback_pinterest'), array('read_public', 'write_public'));
            redirect($url);
        }
    }
}
