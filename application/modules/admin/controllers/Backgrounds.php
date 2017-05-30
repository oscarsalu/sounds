<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Backgrounds extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('M_background'); 
        $this->load->model('M_user'); 
        $this->check_access();    
    }  
    function check_access(){
        if($this->session->userdata('loged_in') != null){
            $id = $this->session->userdata('loged_in');
            // check role bakground id = 2
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
    * View Backgrounds manager
    **/
    public function index()
    {            
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] =  $this->session->userdata('user_data');
		$data['users'] =    $this->db->select("*,users.id")
                            ->from('users')
                            ->where('users.id', $user_id)    
                            ->join('photos', 'users.id = photos.user_id','left')
                            ->join('countries', 'users.countries = countries.id')
                            ->get()->result_array();
                            
        $data['list_users'] =    $this->db->select("*,users.id")
                                ->from('users')                                                                 
                                ->join('countries', 'users.countries = countries.id')
                                ->join('genres', 'users.genre = genres.id')
                                ->get()->result_array();                            
        
        $data['genres'] =  $this->db->get('genres')
                           ->result_array();
						   
        $this->template->load('admin_template', 'backgrounds', $data); 
    }        
    /**
    * Ajax Add new page
    **/
    public function add_page()
    {
        $page_name = $this->input->post('page_name');
        $check_page = $this->M_background->check_page($page_name);
        echo $check_page;
        if(empty($check_page))
        {
            $insertArr = array(
                "page_name" => $page_name
            );
            $this->db->insert('backgrounds',$insertArr);
            echo "success";
        }else{
            echo "fail";
        }        
    }
    /**
    * Get all data background
    **/
    public function get_all_data()
    {
        $results = $this->M_background->get_all();                
        echo $results;
    }
    /**
    * Update background
    **/
    public function upload_background()
    {
        $folder = $this->input->post('name_page');
        $id = $this->input->post('id_back');
        $name_file = $this->input->post('background_name');
        $config = array();
        $config['upload_path'] = './uploads/'.$folder.'/';
        if(!is_dir($config['upload_path'])){
           mkdir($config['upload_path'], 0777, true);
        }else{
           chmod($config['upload_path'], 0777);
        }
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '8000';
		$config['max_width']  = '8000';
		$config['max_height']  = '4000';
        $config['file_name'] = uniqid();                
        
        $this->load->library('upload');
                
        $this->upload->initialize($config);   
        if(!empty($_FILES[$name_file]['name']))
        {                           
            if (!$this->upload->do_upload($name_file)){                    
                $data['update_error'] = $this->upload->display_errors();
                echo $data['update_error'];            
                return 0;
            } else{                 
                $datafile = $this->upload->data();  
                
                $exp = explode('.',$datafile['file_name']);
                $name = $exp[0];
                $duo = $exp[1];
                $file_name = $name.'_thumb.'.$duo;                
                           
                $updateArr	=array(		                                        
                                    $name_file	     => $file_name,                               	
            				    );            
                $backgrounds = $this->db->where('page_name',$folder)->get('backgrounds')->result_array();
                if(!empty($backgrounds[0][$name_file]))
                {
                    $file = FCPATH."uploads/".$folder."/".$backgrounds[0][$name_file];
                    if(file_exists($file))
                    {                    
                        unlink(FCPATH."uploads/".$folder."/".$backgrounds[0][$name_file]);                    
                    }                                                          
                }
                
                $this->db->update('backgrounds',$updateArr,'id='.$id);  
                
                $this->load->library('image_lib');       
                $config['image_library'] = 'gd2';
                $config['source_image'] = './uploads/'.$folder.'/'.$datafile['file_name'];
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width']     = 1920;                
                $config['file_name'] = $datafile['file_name'];
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if($this->image_lib->resize()){
                    unlink(FCPATH."uploads/".$folder."/".$datafile['file_name']);                
                }                                 
            }
        }else{
            $color = $this->input->post('background_color');
            $updateArr	=array(		                                        
                                $name_file	     => $color,                               	
        				    );
            $backgrounds = $this->db->where('page_name',$folder)->get('backgrounds')->result_array();
                if(!empty($backgrounds[0][$name_file]))
                {
                    $file = FCPATH."uploads/".$folder."/".$backgrounds[0][$name_file];
                    if(file_exists($file))
                    {                    
                        unlink(FCPATH."uploads/".$folder."/".$backgrounds[0][$name_file]);                    
                    }                                                          
                }                
            $this->db->update('backgrounds',$updateArr,'id='.$id);  
        }    
        $this->index();        
    }   
    
}    