<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdrawals extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('model_user');   
        $this->load->model('M_user');  
        $this->load->model('M_photo'); 
        $this->load->model('M_audio_song'); 
        $this->load->model('M_zoho'); 
        $this->check_access();
    }  
     
    function check_access(){
        //check  admin master
        if($this->session->userdata('loged_in') == null){
            redirect('account/logout');
        } elseif( $this->session->userdata('is_admin') != 1){
            $this->session->set_flashdata('message_error', 'account can not access');
            redirect('admin/dashboard');
		}
    }
    /**
    * View Withdrawals
    **/
    public function index()
    {                
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] =  $this->session->userdata('user_data'); 
        $config['base_url'] = base_url()."admin/withdrawals";
        $config['per_page'] = 12; 
        
        
        $start=$this->input->get('per_page');
        if(empty($start)){
            $start = 1;
        }
         
        // check role manager users id = 11
        $check = $this->M_user->check_role(11,$user_id);  
        if($check && $data['user_data']['is_admin']==2){
            $config['total_rows'] = $this->db->where('is_admin',0)->get('transactions')->num_rows();
            $this->load->library('pagination', $config);
            $data['list_withdrawals'] =   $this->db->where('is_admin',0)->limit($config['per_page'], $start-1)->get('transactions')->result_array(); 
            
        }elseif($data['user_data']['is_admin']==1){
           
            $config['total_rows'] = $this->db->where('type','withdraw')->get('transactions')->num_rows();
            $this->load->library('pagination', $config);
            $data['list_withdrawals'] =   $this->db
            ->where('type','withdraw')->limit($config['per_page'], $start-1)->get('transactions')->result_array();
           
        }      
        
       
      
       

        $this->template->load('admin_template', 'withdrawals', $data);       
    }
    
    
    public function withdraw_process(){
        $id = $this->input->post('id');
        $user_id=$this->input->post('user_id');
        $withdraw=$this->input->post('withdraw');
        
       $withdraw_data=array('status'=>1);
        $data=$this->get_user_details($user_id);
        if(isset($data)){
      
      $balance=$data->balance-$withdraw;
      
        }
       
       $balance_data=array('balance'=>$balance);
                     $data1= $this->db->where('id', $id); 
                    $data1=  $this->db->update('transactions',$withdraw_data);
                  $data1=$this->db->where('id',$user_id);
                 
                  
                  $data1=$this->db->update('users',$balance_data);
         
         if($data1==TRUE){
           
          
            echo json_encode("success");
        } else{
            echo json_encode("error");
        } 
    }
    
   public function withdraw_pending(){
        $id = $this->input->post('id');
      $user_id=$this->input->post('user_id');
        $withdraw=$this->input->post('withdraw');
       $withdraw_data=array('status'=>0);
       $data=$this->get_user_details($user_id);
        if(isset($data)){
      
      $balance=$data->balance + $withdraw;
      
        }
             $balance_data=array('balance'=>$balance);
                     $data1= $this->db->where('id', $id); 
                    $data1=  $this->db->update('transactions',$withdraw_data);
                  $data1=$this->db->where('id',$user_id);
                 
                  
                  $data1=$this->db->update('users',$balance_data);
         
         if($data1==TRUE){
           
          
            echo json_encode("success");
        } else{
            echo json_encode("error");
        } 
    }
    
    public function get_user_details($user_id){
        
        return $this->db->where("id",$user_id)->get("users")
                ->row();
    }
    
}
