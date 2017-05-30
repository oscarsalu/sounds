<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('M_user');   
        $this->load->model('M_zoho');
        $this->check_access();
    }  
    function check_access(){
        if($this->session->userdata('loged_in') != null){
            $id = $this->session->userdata('loged_in');
            // check role setting info id = 16
            $check = $this->M_user->check_role(2,$id);
            if(!$check){
                $this->session->set_flashdata('message_error', 'account can not access');
                redirect('admin/dashboard');
            }
		}else{
		  redirect('account/logout');
		}
    }
    /**
    * View setting global
    **/
    public function index()
    {            
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] =  $this->session->userdata('user_data');
		$data['settings_global'] = $this->db->get('settings_global')->row_array();
        $this->template->load('admin_template', 'settings_global', $data); 
    }        
    /**
    * Update setting global
    **/
    public function update()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email_support', 'Email Support', 'required');
        $this->form_validation->set_rules('paypal_clientId', 'paypal clientId', 'required');
        $this->form_validation->set_rules('paypal_clientSecret', 'paypal clientSecret', 'required');
        $this->form_validation->set_rules('zoho_organization_id', 'Email Support', 'required');
        $this->form_validation->set_rules('zoho_authtoken', '99sound fee', 'required');
        if ($this->form_validation->run() != FALSE){
            
            $data_update = array(
                'email_support'=> $this->input->post('email_support'),
                'paypal_clientId' =>  $this->input->post('paypal_clientId'),
                'paypal_clientSecret' =>  $this->input->post('paypal_clientSecret'),
                'zoho_organization_id' => $this->input->post('zoho_organization_id'),
                'zoho_authtoken' => $this->input->post('zoho_authtoken'),
            );
            $this->db->update('settings_global',$data_update);
            $this->session->set_flashdata('message_success','update data complete');
            redirect('admin/setting');
        }else{
            $this->session->set_flashdata('message_error','Can\'t update data!');
            $this->index();
        }
    }
    /**
    * Check live
    **/
    public function check_live_server()
	{ 
	   $whitelist = array('127.0.0.1', "::1");
        if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
            return true;
        }else{
            return false;
        }                         
          
	}
   
}    