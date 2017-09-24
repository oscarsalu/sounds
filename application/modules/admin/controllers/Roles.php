<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->check_access();
        $this->load->model('model_user');   
        $this->load->model('M_user');  
        $this->load->model('M_photo'); 
        $this->load->model('M_zoho');
        $this->load->model('M_audio_song');
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
    * View Manager roles
    **/ 
    public function index()
    {                
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] =  $this->session->userdata('user_data');   
        $config['base_url'] = base_url()."admin/roles";
        $config['per_page'] = 12; 
        $config['total_rows'] = $this->db->where('is_admin',2)->get('users')->num_rows();
        $this->load->library('pagination', $config);
        $start=$this->input->get('per_page');
        if(empty($start)){
            $start = 1;
        }
        $data['list_admin'] =    $this->db->where('is_admin',2)->limit( $config['per_page'],$start-1)                              
            ->get('users')->result_array();   
        $data['list_roles'] = $this->db->get('list_roles')->result_array();
        $this->template->load('admin_template', 'roles', $data);       
    }
    /**
    * Add new admin
    **/
    public function add_admin()
    {
        $this->load->library('form_validation'); 
        $this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[users.email]|max_length[255]');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[32]');
        $this->form_validation->set_rules('firstname', 'firstname', 'required|max_length[100]');
        $this->form_validation->set_rules('lastname', 'lastname', 'required|max_length[100]'); 
        $this->form_validation->set_rules('address', 'address', 'max_length[255]'); 
        $this->form_validation->set_rules('city', 'city', 'required|max_length[255]'); 
        if ($this->form_validation->run() != FALSE)
        {
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $city = $this->input->post('city');
            $home_page = $this->M_user->create_homepage(str_replace (' ','',$firstname.$lastname));
            $insertArr	=array(		
                'firstname'	    => $firstname,
                'lastname'      => $lastname,                                           
                'email'         => $email,
                'password'      => md5($password),
                'home_page'      => $home_page,
                'phone'         => $phone,
                'address'       => $address,
                'city'          => $city,
                'genre'         => 1,
                'active'        => 1,
                'is_admin'      => 2,
                'role'          => 1,
                'countries'     => 217
                
		    );
            $this->db->insert('users',$insertArr);
            $id = $this->db->insert_id();
            //create new custome zoho api
            $this->M_zoho->create_customer($id);
            //create new amper
            $this->M_audio_song->create_shortcode_AMP($id);
            $this->session->set_flashdata('message_msg', 'success create new admin');
            redirect('admin/roles');
        }else{
            $errors = $this->form_validation->error_array();
            $msg = "";
            foreach($errors as $error){
                 $msg =  '<br/> - '.$error;
            }
            $this->session->set_flashdata('message_error', $msg);
            $this->index();
        }
        
    }
    /**
    * Setting role users
    **/  
    public function setting_role()
    {                
        $user_id = $this->session->userdata('loged_in');
        $user_data =  $this->session->userdata('user_data'); 
        $id_admin = $this->input->post('id_admin');             
        $role_value = $this->input->post('role_value');     
        $this->db->where('user_id',$id_admin)->delete('admin_role'); 
        foreach($role_value as $key=>$val){
            $data_insert = array(
                'user_id' => $id_admin,
                'role'     => $key
            );
            $this->db->insert('admin_role',$data_insert);
        }
        $this->session->set_flashdata('message_msg', 'success setting role');
        redirect('admin/roles');
    } 
    /**
    * Get data role 
    * @return json
    **/
    public function data_role()
    {
        $id_user = $this->input->post('id_user');
        if(isset($id_user)){
            $data_role = $this->db->where('user_id',$id_user)->get('admin_role')->result_array();
            if(!empty($data_role)){
                echo json_encode($data_role);
            }else{
                echo json_encode(array('code'=>403));
            }     
        }
        
    }
    
    
    
}
