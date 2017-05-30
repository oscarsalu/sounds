<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fan extends MX_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('M_features_fan');   
        $this->load->model('M_text');
        $this->load->model('M_user');
        $ac = $this->session->userdata('access');
        if(!isset($ac)){            
           // redirect('access');           
        } 
    }  
    
    public function index()
    {
        $data['background'] = $this->M_features_fan->get_background();
        
        $admin = $this->session->userdata('is_admin');
        if(isset($admin) && $admin == 1){
            $data['is_admin'] = $admin;
        }
        $data['landings'] = $this->db->where('type','landing')
            ->where('active',1)
            ->order_by('position', 'ASC')
            ->get('template_lands')->result_array();   
        $data['artists'] = $this->db->select('*,u.id,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
            ->from('users as u')
            ->where('u.role',1)
            ->where('u.is_admin != ',1)
            ->join('photos as p', 'u.id = p.user_id','left')
            ->join('audio_song as a', 'u.id = a.user_id','left')
            ->join('genres as g', 'u.genre = g.id')
            ->join('countries as c', 'u.countries = c.id')
            ->group_by('u.id')
            ->order_by('u.id', 'RANDOM')                     
            ->limit(8,0)       
            ->get()->result_array();
        $data['artist1s'] = $this->db->select('*,u.id,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
            ->from('users as u')
            ->where('u.role',1)
            ->where('u.is_admin != ',1)
            ->join('photos as p', 'u.id = p.user_id','left')
            ->join('audio_song as a', 'u.id = a.user_id','left')
            ->join('genres as g', 'u.genre = g.id')
            ->join('countries as c', 'u.countries = c.id')
            ->group_by('u.id')
            ->order_by('u.id', 'RANDOM')                     
            ->limit(12,0)       
            ->get()->result_array();
            
        $data['fans'] = $this->db->select('*,u.id,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
            ->from('users as u')
            ->where('u.role',1)
            ->where('u.is_admin != ',1)
            ->join('photos as p', 'u.id = p.user_id','left')
            ->join('audio_song as a', 'u.id = a.user_id','left')
            ->join('genres as g', 'u.genre = g.id')
            ->join('countries as c', 'u.countries = c.id')
            ->group_by('u.id')
            ->order_by('u.id', 'DESC')                     
            ->limit(12,0)       
            ->get()->result_array();
        //$fans = $this->db->select('DISTINCT(user_id)')
//            ->from('fans')
//            ->limit(4,0)
//            ->get()->result_array();
//            $fandata = '';
//            $i = 0;
//            
//        foreach($fans as $fan){
//            if($i == 0){
//                $fandata .= $fan['user_id'];
//            }else{
//                $fandata .= ",".$fan['user_id'];
//            }
//            $i++;
//        }
//        $data['fans'] = $this->db->select('*,u.id,g.name as genre_name')
//            ->from('users as u')
//            ->where("u.id in ($fandata)")
//            ->join('genres as g', 'u.genre = g.id')    
//            ->get()->result_array();
        
        $data['user_data'] = $this->session->userdata('user_data');
        
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar',$data);
        $this->load->view('features/fan_feature',$data);
        $this->load->view('includes/footer',$data);
    }
    public function fan_feature(){
        
        $data['background'] = $this->M_features_fan->get_background();
        
        $admin = $this->session->userdata('is_admin');
        if(isset($admin) && $admin == 1){
            $data['is_admin'] = $admin;
        }
        $data['landings'] = $this->db->where('type','landing')
            ->where('active',1)
            ->order_by('position', 'ASC')
            ->get('template_lands')->result_array();   
        $data['artists'] = $this->db->select('*,u.id,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
            ->from('users as u')
            ->where('u.role',1)
            ->where('u.is_admin != ',1)
            ->join('photos as p', 'u.id = p.user_id','left')
            ->join('audio_song as a', 'u.id = a.user_id','left')
            ->join('genres as g', 'u.genre = g.id')
            ->join('countries as c', 'u.countries = c.id')
            ->group_by('u.id')
            ->order_by('u.id', 'RANDOM')                     
            ->limit(8,0)       
            ->get()->result_array();
        $data['artist1s'] = $this->db->select('*,u.id,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
            ->from('users as u')
            ->where('u.role',1)
            ->where('u.is_admin != ',1)
            ->join('photos as p', 'u.id = p.user_id','left')
            ->join('audio_song as a', 'u.id = a.user_id','left')
            ->join('genres as g', 'u.genre = g.id')
            ->join('countries as c', 'u.countries = c.id')
            ->group_by('u.id')
            ->order_by('u.id', 'RANDOM')                     
            ->limit(12,0)       
            ->get()->result_array();
            
        $data['fans'] = $this->db->select('*,u.id,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
            ->from('users as u')
            ->where('u.role',1)
            ->where('u.is_admin != ',1)
            ->join('photos as p', 'u.id = p.user_id','left')
            ->join('audio_song as a', 'u.id = a.user_id','left')
            ->join('genres as g', 'u.genre = g.id')
            ->join('countries as c', 'u.countries = c.id')
            ->group_by('u.id')
            ->order_by('u.id', 'DESC')                     
            ->limit(12,0)       
            ->get()->result_array();
            
        $data['fantop'] =$this->db->select('*,u.id,a.filename as filesong, p.filename as filephoto')
            ->from('users as u')
            ->where('u.role != ',1)
            ->where('u.is_admin != ',1)
            ->join('photos as p', 'u.id = p.user_id','left')
            ->join('audio_song as a', 'u.id = a.user_id','left')
            ->join('countries as c', 'u.countries = c.id','left')
            ->group_by('u.id')
            ->order_by('u.id', 'DESC')                     
            ->limit(12,0)
            ->order_by('u.id', 'ASC')    
            ->get()->result_array();
            
        $data['user_data'] = $this->session->userdata('user_data');
        
        
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar',$data);
        $this->load->view('features/fan',$data);
        $this->load->view('includes/footer',$data);
    }
}
