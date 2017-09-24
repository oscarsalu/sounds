<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Manager_chat extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->is_login();
        $this->load->model('M_manager_chat');   
        $this->load->model('M_user');     
        $this->load->model('M_channel');        
    }  
    
    function is_login(){
        if($this->session->userdata('loged_in') == false && $this->session->userdata('is_admin') != 1){
            redirect('login');
		}
    }
    /**
    * View Manager chat
    **/
    public function index()
    {   
        $config['base_url'] = base_url()."admin/manager_chat";
        $config['per_page'] = 12; 
        $config['total_rows'] = $this->M_manager_chat->num_spam_chat();
        $this->load->library('pagination', $config);
        $start  = $this->input->get('per_page');    
        if(empty($start)){
            $start = 1;
        }
        $data['spams']  = $this->M_manager_chat->all_spam($config['per_page'],$start-1);        
        $data['users_report']  = $this->M_manager_chat->users_report($config['per_page'],0);
        $data['channel_data']  = $this->M_channel->get_all_channels();           
        $user_id = $this->session->userdata('loged_in');        
        $data['user_data']  = $this->session->userdata('user_data');  
        $this->template->load('admin_template', 'spam_chat', $data); 
    } 
    /**
    * Show all users report
    **/
    public function all_users_report()
    {   
        $config['base_url'] = base_url()."admin/manager_chat/all_users_report";
        $config['per_page'] = 12; 
        $config['total_rows'] = $this->M_manager_chat->num_users_report();
        $this->load->library('pagination', $config);
        $start  = $this->input->get('per_page');    
        if(empty($start)){
            $start = 1;
        }        
        $data['users_report']  = $this->M_manager_chat->users_report($config['per_page'],$start-1);           
        $user_id = $this->session->userdata('loged_in');        
        $data['user_data']  = $this->session->userdata('user_data');  
        $this->template->load('admin_template', 'chat/all_users_report', $data); 
    }  
    /**
    * Read message spam
    **/ 
    public function read_message(){ 
        $id = $this->input->get('id_chat');
        $data['message_current']  = $this->M_manager_chat->read_message_current($id);
        if(isset($data['message_current'])){
            $data['message_before']  = $this->M_manager_chat->read_message_before($id,5); 
            $data['message_last']  = $this->M_manager_chat->read_message_last($id,5);         
            $data['user_data']  = $this->session->userdata('user_data'); 
            $this->template->load('admin_template', 'chat/read_message', $data);     
        }else{
            $this->session->set_flashdata('message_error', 'error id');
            redirect('admin/manager_chat');    
        }
        
    } 
    /**
    * Ajax Load message before
    **/
    public function load_message_before(){ 
        $id = $this->input->post('id_chat');
        $message_before = $this->M_manager_chat->read_message_before($id,5);  
        $array_res = array();
        foreach($message_before as $message){
            $array_res[] = array(
                'avata' => $this->M_user->get_avata($message->user_id),
                'date'  => date('h:i:s d.m.Y',$message->time),
                'name'  => $this->M_user->get_name($message->user_id),
                'messages'  => $message->messages,
                'id'    => $message->id,
                'user_id' => $message->user_id 
            ); 
        }
        echo json_encode($array_res);
        
    }
    /**
    * Ajax Load message last
    * @return json
    **/
    public function load_message_last(){ 
        $id = $this->input->post('id_chat');
        $message_last = $this->M_manager_chat->read_message_last($id,5);  
        $array_res = array();
        foreach($message_last as $message){
            $array_res[] = array(
                'avata' => $this->M_user->get_avata($message->user_id),
                'date'  => date('h:i:s d.m.Y',$message->time),
                'name'  => $this->M_user->get_name($message->user_id),
                'messages'  => $message->messages,
                'id'    => $message->id,
                'user_id' => $message->user_id 
            ); 
        }
        echo json_encode($array_res);   
    }
    /**
    * Load delete message
    **/
    public function delete_mesage(){ 
        $id = $this->input->post('id_chat');
        if(isset($id)){
            $this->M_manager_chat->delete_mesage($id);
            $this->session->set_flashdata('message_msg', 'Success delete message chat');    
        }else{
            $this->session->set_flashdata('message_error', 'error id');    
        }
        redirect('admin/manager_chat');
    }  
    /**
    * Set keyword spam chat
    **/
    public function set_keyword(){
        $key = trim($this->input->post('keyword'));
        $check_key = $this->db->where('keyword',$key)->get('chat_keyword')->result_array();
        if(!empty($check_key)){
            echo 'exist';
        }else{
            if(isset($key)){
                $insert = array(
                    'keyword' => $key,
                );
                $this->db->insert('chat_keyword',$insert);
                echo 'sc'; 
            }                   
        }        
    }
    /**
    * Ajax Load all keyword
    **/
    public function loaddata(){
        $result = $this->M_manager_chat->get_keyword();
        echo $result;
    }
    /**
    * Ajax update keyword
    **/
    public function update_key(){
        $key    = trim($this->input->post('keyword'));
        $key_id = $this->input->post('id_key');              
        if(isset($key)){
            $updateArr = array(
                'keyword' => $key,
            );             
            if($this->db->where('id', $key_id)->update('chat_keyword', $updateArr)){
                echo 'sc';    
            }
            
        }    
    }
    /**
    * Ajax delete keyword
    **/
    public function delete_key(){
        $key_id = $this->input->post('id_key');              
        if(isset($key_id)){            
            if($this->db->where('id', $key_id)->delete('chat_keyword')){
                echo 'sc';    
            }
        }    
    }
    /**
    * Accept keyword
    **/
    public function accept(){
        $id = $this->input->get('id_chat');
        if(isset($id)){
            $updateArr = array(
                'accept' => "1",
            );
            $this->db->update('messages_channel',$updateArr,array('id' => $id));
            $this->session->set_flashdata('message_msg', 'success accept message chat');    
        }else{
            $this->session->set_flashdata('message_erroe', 'error id');    
        }
        redirect('admin/manager_chat');
    }
    /**
    * Refresh
    **/
    public function refresh(){
        $id = $this->input->post('id_user');
        $updateArr = array(
            'num_down_chat' => 0
        );
        $this->db->update('users',$updateArr,'id='.$id);
        $this->session->set_flashdata('message_msg', 'success restart take down message chat');
    }

    public function add_new_channel(){
        $channel_name = $this->input->post('channel_name');
        $dataArray = array('name'=> $channel_name, 'user_id'=> $this->session->userdata('loged_in'), 'type' =>'public', 'time'=> time(), 'is_admin'=> $this->session->userdata('is_admin'));
        $data = $this->M_channel->save($dataArray);
        echo json_encode("success");
    }

    public function get_all_channels()
    {
        $data = $this->M_channel->get_all_channels();
        echo json_encode($data);
    }

    public function edit_channel()
    {
        $channel_name = $this->input->post('edit_channel_name');
        $channel_type = $this->input->post('edit_channel_type');
        $channel_id = $this->input->post('id_channel');
        
        $data = $this->M_channel->update($channel_id, $channel_name, $channel_type);
        echo json_encode("success");
    }

    public function delete_channel()
    {
        $channel_id = $this->input->post('id_channel');
        $data = $this->M_channel->delete($channel_id);
        echo json_encode("success");
    }
}