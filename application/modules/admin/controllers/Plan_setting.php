<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Plan_setting extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('M_user');   
        $this->load->model('M_zoho');
        $this->check_access();
    }  
    function check_access(){
        if($this->session->userdata('loged_in') != null){
            $id = $this->session->userdata('loged_in');
            // check role setting amper = 18
            $check = $this->M_user->check_role(18,$id);
            if(!$check){
                $this->session->set_flashdata('message_error', 'account can not access');
                redirect('admin/dashboard');
            }
		}else{
		  redirect('account/logout');
		}
    }
    /**
    * View all setting global plan subcriptions
    **/
    public function index()
    {         
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] =  $this->session->userdata('user_data');
		$data['settings_global'] = $this->db->get('settings_global')->row_array();
        $data['plan_list'] = $this->M_zoho->get_plan_list();
    
        $this->template->load('admin_template', 'plan_setting', $data); 
    }   
     /**
    * Update setting global
    **/
    public function update()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('artist_basic_fee', 'Artist Basic fee', 'required|numeric');
        $this->form_validation->set_rules('fee_mds', 'MDS fee', 'required|numeric');
        $this->form_validation->set_rules('time_trial', 'trial time', 'required|numeric');
        $this->form_validation->set_rules('commissions_99sound', 'AMP fee', 'required|numeric');
        if ($this->form_validation->run() != FALSE){
            $fee = array(
                'week1'=>$this->input->post('1week'),
                'week2'=>$this->input->post('2week'),
                'week3'=>$this->input->post('3week'),
                'week4'=>$this->input->post('1month'),
                'week8'=>$this->input->post('2month'),
                'week12'=>$this->input->post('3month'),
            );
            $fee = json_encode($fee);
            
            $data_update = array(
                'premium_artists_fee' => $fee,
                'artist_basic_fee' => $this->input->post('artist_basic_fee'),
                'time_trial' => $this->input->post('time_trial'),
                'commissions_99sound' => $this->input->post('commissions_99sound'),
                'fee_mds'    => $this->input->post('fee_mds'),
            );
            $this->db->update('settings_global',$data_update);
            if(check_live_server()){
                $tes = $this->M_zoho->update_plan_artist($this->input->post('artist_basic_fee'),$this->input->post('time_trial'));
                $this->M_zoho->update_price_plan('MDS',$this->input->post('fee_mds'));
            }
            $this->session->set_flashdata('message_success','update data complete');
            redirect('admin/plan_setting');
        }else{
            $this->session->set_flashdata('message_error','Can\'t update data!');
            $this->index();
        }
    }
    
    public function get_plan(){
        
        $plan_code=$this->input->post('plan_code');
       $data = $this->M_zoho->get_plan($plan_code);
        if(isset($data)){
 $plan=$data->plan;
 echo json_encode($plan);
     }
    }
    
    public function update_plan(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Plan_name', 'Plan Name', 'required');
        $this->form_validation->set_rules('Plan_price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('interval', 'Interval', 'required|numeric');
         $this->form_validation->set_rules('interval_unit', 'Interval Unit', 'required');
         $this->form_validation->set_rules('status', 'Status', 'required');
          if ($this->form_validation->run() != FALSE){  
              $plan_code=$this->input->post('plan_code');
              $product_id=$this->input->post('product_id');
              $plan_name=$this->input->post('Plan_name');
              $price=$this->input->post('Plan_price');
              $interval=$this->input->post('interval');
              $interval_unit=$this->input->post('interval_unit');
                $status=$this->input->post('status');
              $setting_global = $this->db->get('settings_global')->row_array();
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken = $setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8',
              
            );
       $param_post='{
               "plan_code":"'.$plan_code.'",
            "product_id":"'.$product_id.'",
            "name":"'.$plan_name.'",
          
            "interval":"'.$interval.'",
            "interval_unit":"'.$interval_unit.'",
            "recurring_price":"'.$price.'"
               }';
       
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/plans/'.$plan_code);
         
        // set URL and other appropriate options
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
         
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        
        //curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,array());
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_post);
       
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);
        
        if($status=="active"){
            $ch1 = curl_init('https://subscriptions.zoho.com/api/v1/plans/'.$plan_code."/markasactive");
        // set URL and other appropriate options
         curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch1, CURLOPT_HTTPHEADER, $hdrarray);
         
         
        curl_setopt($ch1, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,array());
      
       
         curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, 0);
        $response1 = curl_exec($ch1);
        $data_json1 = json_decode($response1);
        curl_close($ch1);
            
            
        } else {
            $ch1 = curl_init('https://subscriptions.zoho.com/api/v1/plans/'.$plan_code."/markasinactive");
        // set URL and other appropriate options
         curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch1, CURLOPT_HTTPHEADER, $hdrarray);
         
         
        curl_setopt($ch1, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,array());
      
       
         curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, 0);
        $response1 = curl_exec($ch1);
        $data_json1 = json_decode($response1);
        curl_close($ch1);
            
        }
       
$this->session->set_flashdata('message_success',$data_json->message);
$this->session->set_flashdata('status_message',$data_json1->message);
            redirect('admin/plan_setting');
        } else {
             $this->session->set_flashdata('message_error','All fields are required,Can\'t update data!');
            $this->index();
        }
         
    }
      public function delete_plan($plan_code){ 
          $setting_global = $this->db->get('settings_global')->row_array();
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken = $setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8',
              
            );
          $ch = curl_init('https://subscriptions.zoho.com/api/v1/plans/'.$plan_code);
         
        // set URL and other appropriate options
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
         
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        
        //curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,array());
        
       
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);
        
        if($data_json->code==0){
        $this->session->set_flashdata('status_message',$data_json->message);
        } else {
              $this->session->set_flashdata('delete_error',$data_json->message);
        }
         redirect('admin/plan_setting');
      }
      
    
    }
  