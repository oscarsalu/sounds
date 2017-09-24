<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Template extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('M_user');  
        $this->check_access(); 
    }  
    function check_access(){
        if($this->session->userdata('loged_in') != null){
            $id = $this->session->userdata('loged_in');
            // check role template id = 15
            $check = $this->M_user->check_role(15,$id);
            if(!$check){
                $this->session->set_flashdata('message_error', 'account can not access');
                redirect('admin/dashboard');
            }
		}else{
		  redirect('account/logout');
		}
    }
    /**
    * View tempalte alp, flp, epk
    **/
    public function index()
    {            
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] =  $this->session->userdata('user_data');
		$data['template_lands'] = $this->db->get('template_lands')->result_array();
        $this->template->load('admin_template', 'template_lands', $data); 
    }
    /**
    * Add new template
    **/
    public function add(){
		//echo "<pre>";print_r($_POST);echo "</pre>";exit;
        $data['a'] = '';
        $template_type = $this->input->post('template_type');
        $template_name = $this->input->post('template_name');
        $description = $this->input->post('description');
        $template_position = $this->input->post('template_position');
        if($this->input->post('type') == 1)
			$template_type = "landing";
        else if($this->input->post('type') == 2)
			$template_type = "landing_flp";
        else
			$template_type = $this->input->post('template_type');
        
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');   
                        
        $this->form_validation->set_rules('template_name', 'Template name', 'required|max_length[50]');
        $this->form_validation->set_rules('description', 'Description', 'required|max_length[165]');
        $this->form_validation->set_rules('template_position', 'Template Position', 'required|numeric|max_length[10]');
        if($this->form_validation->run() != FALSE){
            $this->load->library('upload'); 
            if(!empty($_FILES['template_image']['name']))
            {
                $this->upload->initialize($this->config($template_type));                              
                if (!$this->upload->do_upload('template_image')){                    
                    $data['update_error'] = $this->upload->display_errors();
                    return 0;
                } else{
                    $datafile = $this->upload->data();
                    $insertArr = array(
                                "name"       =>  $template_name,
                                "des"        =>  $description,
                                "position"   => $template_position,
                                "images"     =>  $datafile['file_name'],
                                "active"     =>  1,
                                "type"       =>  $template_type,
                    );
                    $this->db->insert('template_lands',$insertArr);
                    redirect('admin/template-land');  
                }
            }else{
                $data['update_error'] = 'Please upload image template';
            }
        }
        $this->template->load('admin_template', 'template_lands', $data);
    }
     /**
    * Config upload tempalte
    **/
    public function config($template_type)
    {
        $loged_in = $this->session->userdata('loged_in');
        $config = array();
        $config['upload_path'] = "./uploads/templates/$template_type/";
        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0777, true);
        }else{
            //chmod($config['upload_path'], 0777);
        }
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000000';
		$config['max_width']  = '10000000';
		$config['max_height']  = '10000000';
        $config['file_name'] = uniqid();
        
		return $config;
    }
     /**
    * Lock tempalte
    **/
    public function lock_tempate()
    {
        $id = $this->input->post('id_lock');
        $updateArr = array(
            'active' => 1
        );
        $this->db->update('template_lands',$updateArr,'id='.$id);
    }
    /**
    * unLock tempalte
    **/
    public function unlock_tempate()
    {
        $id = $this->input->post('id_unlock');
        $updateArr = array(
            'active' => 0
        );
        $this->db->update('template_lands',$updateArr,'id='.$id);
    }
    /**
    * delete template
    **/
    public function delete(){
        $id = $this->input->post('id_dele');
        if(isset($id))
        {
            $this->db->where('id',$id);
            $this->db->delete('template_lands');
            echo 'success';
        }
    }
    /**
    * delete update
    **/
    public function update()
    {
        $id = $this->input->post('id');
        $template_type = $this->input->post('type');
        $template_name = $this->input->post('template_name');
        $description = $this->input->post('description');
        $template_position = $this->input->post('template_position');
        
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation'); 
        $this->form_validation->set_rules('template_name', 'Template name', 'required|max_length[50]');
        $this->form_validation->set_rules('description', 'Description', 'required|max_length[165]');
        $this->form_validation->set_rules('template_position', 'Template Position', 'required|numeric|max_length[10]');
        if($this->form_validation->run() != FALSE){
            $this->load->library('upload'); 
            if(!empty($_FILES['template_image']['name']))
            {
                $this->upload->initialize($this->config($template_type));                              
                if (!$this->upload->do_upload('template_image')){                    
                    $data['update_error'] = $this->upload->display_errors();
                    return 0;
                } else{
                    $datafile = $this->upload->data();
                    $updateArr = array(
                                "name"       =>  $template_name,
                                "des"        =>  $description,
                                "position"   => $template_position,
                                "images"     =>  $datafile['file_name'],
                    );
                    $this->db->update('template_lands',$updateArr,'id='.$id);
                    $this->session->set_flashdata('message_success','update data complete');
                    redirect('admin/template-land');  
                }
            }else{
                $datafile = $this->upload->data();
                    $updateArr = array(
                                "name"       =>  $template_name,
                                "des"        =>  $description,
                                "position"   => $template_position,
                    );
                    $this->db->update('template_lands',$updateArr,'id='.$id);
                    $this->session->set_flashdata('message_success','update data complete');
                
            }
        }
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
    
   
}    
