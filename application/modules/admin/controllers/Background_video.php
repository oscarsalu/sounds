<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Background_video extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('M_user');  
        $this->load->model('M_background_video');  
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
    * VIEW Manager video background
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
						  
        $this->template->load('admin_template', 'background_video', $data); 
    }      
    /**
    * Get all data video background
    **/
    public function get_all_data()
    {
        $results = $this->M_background_video->get_all();                
        echo $results;
    }
    /**
    * Ajax add new Page
    **/
    public function add_page()
    {
        $page_name = $this->input->post('page_name');
        $check_page = $this->M_background_video->check_page($page_name);
        
        if(empty($check_page))
        {
            $insertArr = array(
                "page_name" => $page_name
            );
            $this->db->insert('background_videos',$insertArr);
            echo "success";
        }else{
            echo "fail";
        }        
    }
    /**
    * Update video background
    **/
    public function update()
    {
        $folder = $this->input->post('name_page');
        $id = $this->input->post('idv');        
        $name_file = $this->input->post('video_name');
        $value_text = $this->input->post('background_color');
        
        $config = array();
        $config['upload_path'] = './uploads/'.$folder.'/videos/';
        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0777, true);
        }else{
            chmod($config['upload_path'], 0777);
        }
		$config['allowed_types'] = 'mp3|mp4';
		$config['max_size']	= '5000000';
        $config['overwrite'] = false;
        $config['file_name'] = uniqid().'_vid';
        
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
                $updateArr	=array(		                                        
                                    $name_file	     => $datafile['file_name'],                               	
            				    );            
                $videos = $this->db->where('page_name',$folder)->get('background_videos')->result_array();
               
                if(!empty($videos[0][$name_file]))
                {   
                    $file = FCPATH."uploads/".$folder."/videos/".$videos[0][$name_file];                    
                    if(file_exists($file))
                    {                                        
                        unlink($file);                    
                    }                                                          
                }
                
                $this->db->update('background_videos',$updateArr,'id='.$id);  
            }        
        }else{
            $updateArr	=array(		                                        
                $name_file	     => $value_text,                               	
		    );    
            $videos = $this->db->where('page_name',$folder)->get('background_videos')->result_array();
               
            if(!empty($videos[0][$name_file]))
            {   
                $file = FCPATH."uploads/".$folder."/videos/".$videos[0][$name_file];                    
                if(file_exists($file))
                {                                        
                    unlink($file);                    
                }                                                          
            }
            $this->db->update('background_videos',$updateArr,'id='.$id);     
        }   
        $this->index();         
    }
}    