<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
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
    * View manager users
    **/
    public function index()
    {                
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] =  $this->session->userdata('user_data'); 
        $config['base_url'] = base_url()."admin/users";
        $config['per_page'] = 12; 
        $start=$this->input->get('per_page');
        if(empty($start)){
            $start = 1;
        }
        // check role manager users id = 11
        $check = $this->M_user->check_role(11,$user_id);  
        if($check && $data['user_data']['is_admin']==2){
            $config['total_rows'] = $this->db->where('is_admin',0)->get('users')->num_rows();
            $this->load->library('pagination', $config);
            $data['list_users'] =   $this->db->where('is_admin',0)->limit($config['per_page'], $start-1)->get('users')->result_array(); 
            
        }elseif($data['user_data']['is_admin']==1){
            $config['total_rows'] = $this->db->get('users')->num_rows();
            $this->load->library('pagination', $config);
            $data['list_users'] =   $this->db
            ->limit($config['per_page'], $start)->get('users')->result_array();  
        }      
        
        $data['genres'] =  $this->db->get('genres')
            ->result_array();
      
       

        $this->template->load('admin_template', 'users', $data);       
    }
    
    
    /**
    * update users fan
    **/
    public function update_user_fan(){
        $this->load->library('form_validation');     
        $this->form_validation->set_rules('firstname', 'firstname', 'required|max_length[100]');
        $this->form_validation->set_rules('lastname', 'lastname', 'required|max_length[100]');   
        $this->form_validation->set_rules('phone', 'phone', 'max_length[50]');
        $this->form_validation->set_rules('address', 'address', 'max_length[165]');
        $this->form_validation->set_rules('city', 'city', 'required|max_length[50]');
        $this->form_validation->set_rules('fan_name', 'fan_name', 'required|max_length[64]');  
        $this->form_validation->set_rules('zipcode', 'zipcode', 'max_length[50]');
        $this->form_validation->set_rules('state', 'state', 'max_length[50]');      
        if ($this->form_validation->run() != FALSE){
            $birthday = $this->input->post('birthday');
            $updateArr	=array(		
                'firstname'	    => $this->input->post('firstname'),
                'lastname'      => $this->input->post('lastname'),  
                'fan_name'	    => $this->input->post('fan_name'),                          
                'phone'         => $this->input->post('phone'),
                'address'       => $this->input->post('address'),
                'city'          => $this->input->post('city'),
                'birthday'      => strtotime($birthday),
                'zipcode'       => $this->input->post('zipcode'),
                'state'         => $this->input->post('state'),                      
		    );
            $id = $this->input->post('id_update');
            $this->db->update('users',$updateArr,'id='.$id);  
            $this->session->set_flashdata('message_msg', 'success update user');
        }else{
            $errors = $this->form_validation->error_array();
            $msg = "";
            foreach($errors as $error){
                 $msg =  '<br/> - '.$error;
            }
            $this->session->set_flashdata('message_error', $msg);    
        }
        redirect('admin/users');     
    } 
    /**
    * update users artist
    **/
    public function update_user_artist(){
        $this->load->library('form_validation');     
        $this->form_validation->set_rules('firstname', 'firstname', 'required|max_length[100]');
        $this->form_validation->set_rules('lastname', 'lastname', 'required|max_length[100]');    
        $this->form_validation->set_rules('artist_name', 'artist_name', 'required|max_length[128]');   
        $this->form_validation->set_rules('phone', 'phone', 'max_length[50]');
        $this->form_validation->set_rules('address', 'address', 'max_length[128]');
        $this->form_validation->set_rules('city', 'city', 'required|max_length[128]');     
        $this->form_validation->set_rules('genre', 'genre', 'required');   
        $this->form_validation->set_rules('zipcode', 'zipcode', 'max_length[50]');
        $this->form_validation->set_rules('state', 'state', 'max_length[50]');          
        if ($this->form_validation->run() != FALSE){
            $birthday = $this->input->post('birthday');
            $updateArr	=array(		
                'firstname'	    => $this->input->post('firstname'),
                'lastname'      => $this->input->post('lastname'),  
                'artist_name'	=> $this->input->post('artist_name'), 
                'genre'         => $this->input->post('genre'),                        
                'phone'         => $this->input->post('phone'),
                'address'       => $this->input->post('address'),
                'city'          => $this->input->post('city'),
                'birthday'      => strtotime($birthday),
                'zipcode'       => $this->input->post('zipcode'),
                'state'         => $this->input->post('state'),                        
		    );
            $id = $this->input->post('id_update');
            $this->db->update('users',$updateArr,'id='.$id);  
            $this->session->set_flashdata('message_msg', 'success update user');
            
        }else{
            $errors = $this->form_validation->error_array();
            $msg = "";
            foreach($errors as $error){
                 $msg =  '<br/> -'.$error;
            }
            $this->session->set_flashdata('message_error', $msg);    
        }redirect('admin/users');     
    }   
    /**
    * Add new users
    **/
    public function add_user()
    {
        $artist_name = $this->input->post('artist_name');
        $artist_email = $this->input->post('artist_email');
        $home_page = $this->input->post('home_page');
        $genre = $this->input->post('genre');
        $active_since = $this->input->post('active_since');
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');
        $city = $this->input->post('city');
        $birthday = $this->input->post('birthday');
        $zipcode = $this->input->post('zipcode');
        $state = $this->input->post('state');
        
        $this->load->library('form_validation');       
        $account_type = "admin";
        $submit = $this->input->post('type_submit');
        if($account_type == "artist")
        {
            $this->form_validation->set_rules('phone', 'phone', 'max_length[50]');
            $this->form_validation->set_rules('address', 'address', 'max_length[165]');
            $this->form_validation->set_rules('city', 'city', 'required|max_length[50]');
            $this->form_validation->set_rules('artist_name', 'artist_name', 'required|max_length[50]');
            $this->form_validation->set_rules('artist_email', 'artist_email', 'max_length[50]');      
            $this->form_validation->set_rules('genre', 'genre', 'required');            
            if ($this->form_validation->run() != FALSE)
            {
                 if($submit == "update")
                 {
                    $updateArr	=array(		
                        'artist_name'	=> $artist_name,
                        'artist_email'  => $artist_email, 
                        'genre'         => $genre,
                        'active_since'  => $active_since, 
                        'email'         => $email,                           
                        'phone'         => $phone,
                        'address'       => $address,
                        'city'          => $city,
                        'birthday'      => $birthday,
                        'zipcode'       => $zipcode,
                        'state'         => $state,                        
        		    );
                    $id = $this->input->post('id_up');
                    $this->db->update('users',$updateArr,'id='.$id);
                }                    
                
            }                                                                                                      
        }else if($account_type == "admin"){
            if($submit == "update"){
                $this->form_validation->set_rules('firstname', 'firstname', 'required|max_length[100]');
                $this->form_validation->set_rules('lastname', 'lastname', 'required|max_length[100]'); 
                $this->form_validation->set_rules('phone', 'phone', 'max_length[50]');
                $this->form_validation->set_rules('address', 'address', 'max_length[165]');
                $this->form_validation->set_rules('city', 'city', 'required|max_length[50]');
                if ($this->form_validation->run() != FALSE)
                {
                     $home_page = $this->M_user->create_homepage(str_replace (' ','',$firstname.$lastname));
                    $updateArr	=array(		
                        'firstname'	    => $firstname,
                        'lastname'      => $lastname,                                      
                        'email'         => $email,                            
                        'phone'         => $phone,
                        'address'       => $address,
                        'city'          => $city,
                        'birthday'      => strtotime($birthday),
                        'zipcode'       => $zipcode,
                        'state'         => $state,
        		    );
                    $id = $this->input->post('id_up');
                    $this->db->update('users',$updateArr,'id='.$id);
                    redirect('admin/users');    
                }
                    
            }                                         
        }
        $this->index();
    }
    /**
    * Ajax load data user
    **/
    public function get_data_user()
    {
        $id = $this->input->post('user_id');
        $data = $this->db->where('id',$id)->get('users')->row_array();
        
        if(isset($data)){
            $data['birthday'] = date('Y-m-d',$data['birthday']);
            echo json_encode($data);
        } else{
            echo json_encode(array("msg"=> "error"));
        }
    }
    
    public function get_parental_form_details()
    {
        $id = $this->input->post('user_id');
        //$data = $this->db->where('id',$id)->get('users')->row_array();
         $data=$this->db->where('user_id',$id)->get('parental_forms')
                  ->row_array();
         
         if(isset($data)){
           
           $data['dob'] = date('d-m-Y',$data['dob']);
            echo json_encode($data);
        } else{
            echo json_encode(array("id"=>"","user_id"=>"","name_parent"=>"","address_parent"=>"","telephone_parent"=>"","user_name"=>null,"dob"=>"","place_of_birth"=>""));
        } 
    }
    public function update_parental_approve()
    {
        $id = $this->input->post('user_id');
        //$data = $this->db->where('id',$id)->get('users')->row_array();
       $parent_data=array('parental_approve'=>1);
                     $data1= $this->db->where('id', $id); 
                    $data1=  $this->db->update('users', $parent_data);
                  
         
         if($data1==TRUE){
           
          
            echo json_encode("success");
        } else{
            echo json_encode("error");
        } 
    }
    public function update_parental_unapprove()
    {
        $id = $this->input->post('user_id');
        //$data = $this->db->where('id',$id)->get('users')->row_array();
       $parent_data=array('parental_approve'=>0);
                     $data1= $this->db->where('id', $id); 
                    $data1=  $this->db->update('users', $parent_data);
                  
         
         if($data1==TRUE){
           
          
            echo json_encode("success");
        } else{
            echo json_encode("error");
        } 
    }
    /**
    * Lock user
    **/
    public function lock()
    {
        $id = $this->input->post('id_lock');
        $updateArr = array(
            'lock' => 1
        );
        $this->db->update('users',$updateArr,'id='.$id);
        $this->session->set_flashdata('message_msg', 'success lock user');
    }
    /**
    * unlock user
    **/
    public function unlock()
    {
        $id = $this->input->post('id_unlock');
        $updateArr = array(
            'lock' => 0
        );
        $this->db->update('users',$updateArr,'id='.$id);
        $this->session->set_flashdata('message_msg', 'success unlock user');
    }
    /**
    * Change password
    **/
    public function change_password()
    {
        $id = $this->input->post('id_update');
        $old_pass = $this->input->post('old_pass');
        $new_pass = $this->input->post('new_pass');
        $result = $this->model_user->check_password($id,$old_pass);
        if($result){
            if($this->model_user->update_password($new_pass,$id)){
                echo "success";
            }
        }else{
            echo "wrong";
        }
    }
    /**
    * Ajax delete users
    **/
    public function delete()
    {        
        $id = $this->input->post('id_dele');
        if(isset($id))
        {
            $this->model_user->deleteWhere($id,'users');
            echo 'success';
        }
    }
    /**
    * Check email
    * @param sring $email 
    * @return bool
    **/
    public function check_email($str)
	{
	    $result = $this->model_user->check_email_isset($str);        
		if (!empty($result))
		{
			$this->form_validation->set_message('check_email', 'The %s field can not be the word '.$str);
			return FALSE;
		}
		else
		{
			return TRUE;
		}        
	}
    /**
    * Check home page
    * @param sring $str 
    * @return bool
    **/
    public function check_home_page($str)
	{
	    $result = $this->model_user->check_home_page($str);
		if (!empty($result))
		{
			$this->form_validation->set_message('check_home_page', 'The %s field can not be the word '.$str);
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    
    public function upload_background()
    {
        
    }
    
   
}
