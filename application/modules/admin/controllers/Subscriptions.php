<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptions extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->check_access();  
        $this->load->model('M_subscription'); 
        $this->load->model('M_zoho');
    }   
    function check_access(){
        //check  admin master
        if($this->session->userdata('loged_in') == null){
            redirect('account/logout');
        } 
    }
    /**
    * View show all subscriptions
    **/
    public function index()
    {                
        $user_id = $this->session->userdata('loged_in');
        $page = $this->input->get('page');
        $filter = $this->input->get('filter');
        if(empty($page)){
            $page = 1;
        }
        $response = $this->M_subscription->get_subscriptions($page,$filter);
        
        if(isset($response)&&$response->code==0){
            $data['subscriptions'] = $response->subscriptions;
            //$data['subscriptions'] = array();
            $data['page_context'] = $response->page_context;
            $data['user_data'] =  $this->session->userdata('user_data');  
            $this->template->load('admin_template', 'subscriptions', $data);       
        }else{
            die;
        }
        
        
    }
    
    
    
    
}
