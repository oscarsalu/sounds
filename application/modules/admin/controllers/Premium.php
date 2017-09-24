<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Premium extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->is_login();
        //$this->load->model('M_background');   
    }  
    function is_login(){
        if($this->session->userdata('loged_in') == false && $this->session->userdata('is_admin') != 1){
            redirect('login');
		}
    }
    /**
    * View Plan premium artist
    **/
    public function index()
    {
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] =  $this->session->userdata('user_data');
		
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/premium').'/page/';
        $config['total_rows'] = $this->db->join('users as u', 'u.id = p.user_id','left')->count_all("premium_pack");
        $config['per_page'] = 2; 
        $config['page_query_string'] = FALSE;
        $config["uri_segment"] = 4;
        $config['use_page_numbers'] = TRUE;        
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>'; 
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config); 
        if($this->uri->segment(4)){
            $page = ($this->uri->segment(4)) ;
        }
        else{
            $page = 0;
       }
       if($page > 0){
          $page = ($page - 1)  *  $config['per_page'] ;        
        }
    
        $data['worldwide_artists'] = $this->db->select('p.*,u.firstname,u.lastname,u.id as user_id')
            ->from('premium_pack as p')
            ->where('p.active',1)
            ->join('users as u', 'u.id = p.user_id','left')
            ->group_by('p.user_id')
            ->limit($config["per_page"], $page)            
            ->get()->result_array();
       
         $data["links"] = $this->pagination->create_links();    
        $this->template->load('admin_template', 'premium', $data);
        
        
    }   
    /**
    * List all artist
    **/     
    public function list_artist($id){
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] =  $this->session->userdata('user_data');
		
        $data['worldwide_artists'] = $this->db->select('p.*,u.firstname,u.lastname,u.id as user_id')
            ->from('premium_pack as p')
            ->where('p.user_id',$id)
            ->join('users as u', 'u.id = p.user_id','left')
            ->order_by('p.id', 'DESC')
            ->get()->result_array();
        $this->template->load('admin_template', 'list_artist', $data); 
    }
    
    
    
    
    
    
    public function update()
    {
        $this->load->library('form_validation');
		$this->form_validation->set_rules('amp_fee', 'AMP fee', 'required|numeric');
        $this->form_validation->set_rules('email_support', 'Email Support', 'required');
        $this->form_validation->set_rules('99sound_fee', '99sound fee', 'required|numeric');
        $this->form_validation->set_rules('paypal_clientId', 'paypal clientId', 'required');
        $this->form_validation->set_rules('paypal_clientSecret', 'paypal clientSecret', 'required');
        $this->form_validation->set_rules('zoho_organization_id', 'Email Support', 'required');
        $this->form_validation->set_rules('zoho_authtoken', '99sound fee', 'required');
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
                'amp_fee' => $this->input->post('amp_fee'),
                'premium_artists_fee' => $fee,
                'email_support'=> $this->input->post('email_support'),
                '99sound_fee'=> $this->input->post('99sound_fee'),
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
    public function sent_email_tried_artist(){
        $actives = $this->db->select('p.user_id')
            ->from('premium_pack as p')
            ->where('p.active',1)
            ->group_by('p.user_id')
            ->join('users as u', 'u.id = p.user_id','left')
            ->order_by('p.id', 'DESC')
            ->get()->result_array();
        $id_not = array();
        foreach($actives as $active){
            $id_not[] = $active['user_id'];
        }
        $worldwide_artists = $this->db->select('p.*,u.firstname,u.lastname,u.email,u.id as user_id')
            ->from('premium_pack as p')
            ->where('p.active',0)
            ->join('users as u', 'u.id = p.user_id','left')
            ->group_by('p.user_id')
            ->where_not_in('p.user_id',$id_not)
            ->order_by('p.id', 'DESC')
            ->get()->result_array();
        $admin_name = $this->config->item('admin_name');
        $email_from = $this->config->item('admin_email');
        
        foreach($worldwide_artists as $worldwide_artist){
            $to_email = $worldwide_artist['email'];
            $this->load->library('email');
            
            $this->load->helper('string');
            $data['user'] = $worldwide_artist;
            
            $data['encrypted_string'] = random_string('alpha', 16);
            $message = $this->load->view('email/premium_artists_has_tried',$data,TRUE);
            
            $config['protocol'] = "smtp";
            $config['charset'] = "utf-8";
            $config['mailtype'] = "html";
            $config['newline'] = "\r\n";
            $subject = "Our Featured / Premium Artists has Expires";
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->from($email_from, $admin_name);
             $this->email->reply_to($email_from,$admin_name);
            $this->email->to($to_email);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
        }
        
        echo json_encode('done');exit;
    }
    
    public function premium_expire(){
        $actives = $this->db->select('p.user_id')
            ->from('premium_pack as p')
            ->where('p.active',1)
            ->group_by('p.user_id')
            ->join('users as u', 'u.id = p.user_id','left')
            ->order_by('p.id', 'DESC')
            ->get()->result_array();
        $id_not = array();
        foreach($actives as $active){
            $id_not[] = $active['user_id'];
        }
        
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] =  $this->session->userdata('user_data');
		
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/premium').'/page/';
        $config['total_rows'] = $this->db->join('users as u', 'u.id = p.user_id','left')->count_all("premium_pack");
        $config['per_page'] = 20; 
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>'; 
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config); 
        if($this->uri->segment(4)){
            $page = ($this->uri->segment(4)) ;
        }
        else{
            $page = 0;
        }
        
        $data["links"] = $this->pagination->create_links();
        $data['worldwide_artists'] = $this->db->select('p.*,u.firstname,u.lastname,u.id as user_id')
            ->from('premium_pack as p')
            ->where('p.active',0)
            ->where_not_in('p.user_id',$id_not)
            ->join('users as u', 'u.id = p.user_id','left')
            ->group_by('p.user_id')
            ->limit($config["per_page"], $page)
            ->order_by('p.id', 'DESC')
            ->get()->result_array();
        $this->template->load('admin_template', 'premium_expire', $data);
    }
   
}    