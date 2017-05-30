<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist extends MX_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('M_features_artist');   
        $this->load->model('M_text');
        $this->load->model('M_user');
        $this->load->model('M_audio_song');
        $ac = $this->session->userdata('access');
        if(!isset($ac)){            
            //redirect('access');           
        } 
    }  
    
    public function index()
    {
        $admin = $this->session->userdata('is_admin');
        if(isset($admin) && $admin == 1){
            $data['is_admin'] = $admin;
        }
        $data['landings'] = $this->db->where('type','landing')
            ->where('active',1)
            ->order_by('position', 'ASC')
            ->get('template_lands')->result_array();   
        $data['epks'] = $this->db->where('type','epk')
            ->where('active',1)
            ->order_by('position', 'ASC')
            ->get('template_lands')->result_array();   
            
        $data['user_data'] = $this->session->userdata('user_data');
        
        $data['background'] = $this->M_features_artist->get_background();
        
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('features/artist', $data);
        $this->load->view('includes/footer', $data);
    }
    public function artist_premium(){
        $data['user_data'] = $this->session->userdata('user_data');  
        $data['worldwide_artists'] = $this->db->select('*,u.id,u.bio,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
            ->from('users as u')
            ->where('u.role',1)
            ->where('u.is_admin != ',1)
            ->where('pk.active',1)
            ->join('premium_pack as pk', 'u.id = pk.user_id','left')
            ->join('photos as p', 'u.id = p.user_id','left')
            ->join('audio_song as a', 'u.id = a.user_id','left')
            ->join('genres as g', 'u.genre = g.id')
            ->join('countries as c', 'u.countries = c.id')
            ->group_by('pk.id')
            ->limit(8)
            ->order_by('pk.id', 'DESC')
            ->get()->result_array();
        
        
        $data['banner_artists'] = $this->db->select('*,u.id,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
            ->from('users as u')
            ->where('u.role',1)
            ->where('u.is_admin != ',1)
            ->where('pk.active',1)
            ->join('premium_pack as pk', 'u.id = pk.user_id','left')
            ->join('photos as p', 'u.id = p.user_id','left')
            ->join('audio_song as a', 'u.id = a.user_id','left')
            ->join('genres as g', 'u.genre = g.id')
            ->join('countries as c', 'u.countries = c.id')
            ->group_by('pk.id')
            ->limit(10)
            ->order_by('pk.id', 'RANDOM')      
            ->get()->result_array();
            
        $data['genres']= $this->db->get('genres')->result_array();
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('features/artist_premium', $data);
        $this->load->view('includes/footer', $data);
    }
    public function artist_premium_load($id){
        $data['user_data'] = $this->session->userdata('user_data');  
        if(isset($id) && !empty($id) && $id != 0){
            $data['worldwide_artists'] = $this->db->select('*,u.id,u.bio,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
                ->from('users as u')
                ->where('u.role',1)
                ->where('u.is_admin != ',1)
                ->where('u.genre ',$id)
                ->where('pk.active',1)
                ->join('premium_pack as pk', 'u.id = pk.user_id','left')
                ->join('photos as p', 'u.id = p.user_id','left')
                ->join('audio_song as a', 'u.id = a.user_id','left')
                ->join('genres as g', 'u.genre = g.id')
                ->join('countries as c', 'u.countries = c.id')
                ->group_by('pk.id')
                ->limit(8,0)
                ->order_by('pk.id', 'DESC')        
                ->get()->result_array();
        }else{
            $data['worldwide_artists'] = $this->db->select('*,u.id,u.bio,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
                ->from('users as u')
                ->where('u.role',1)
                ->where('u.is_admin != ',1)
                ->where('pk.active',1)
                ->join('premium_pack as pk', 'u.id = pk.user_id','left')
                ->join('photos as p', 'u.id = p.user_id','left')
                ->join('audio_song as a', 'u.id = a.user_id','left')
                ->join('genres as g', 'u.genre = g.id')
                ->join('countries as c', 'u.countries = c.id')
                ->group_by('pk.id')
                ->limit(8,0)
                ->order_by('pk.id', 'DESC')        
                ->get()->result_array();
        }
        $this->load->view('features/artist_premium_load', $data);
    }
    public function artist_premium_load_more(){
        $genre = $this->input->post('genre');
        
        $limit = $this->input->post('page') *8;
        if($genre == 0){
            $data['worldwide_artists'] = $this->db->select('*,u.id,u.bio,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
                ->from('users as u')
                ->where('u.role',1)
                ->where('u.is_admin != ',1)
                ->where('pk.active',1)
                ->join('premium_pack as pk', 'u.id = pk.user_id','left')
                ->join('photos as p', 'u.id = p.user_id','left')
                ->join('audio_song as a', 'u.id = a.user_id','left')
                ->join('genres as g', 'u.genre = g.id')
                ->join('countries as c', 'u.countries = c.id')
                ->group_by('pk.id')
                ->limit(8,$limit)
                ->order_by('pk.id', 'DESC')        
                ->get()->result_array();
            $this->load->view('features/artist_premium_load', $data);
        }else{
            $data['worldwide_artists'] = $this->db->select('*,u.id,u.bio,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
                ->from('users as u')
                ->where('u.role',1)
                ->where('u.is_admin != ',1)
                ->where('u.genre ',$genre)
                ->where('pk.active',1)
                ->join('premium_pack as pk', 'u.id = pk.user_id','left')
                ->join('photos as p', 'u.id = p.user_id','left')
                ->join('audio_song as a', 'u.id = a.user_id','left')
                ->join('genres as g', 'u.genre = g.id')
                ->join('countries as c', 'u.countries = c.id')
                ->group_by('pk.id')
                ->limit(8,$limit)
                ->order_by('pk.id', 'DESC')        
                ->get()->result_array();
            $this->load->view('features/artist_premium_load', $data);
        }
        
    }
    public function hot_video_picks(){
        $data['user_data'] = $this->session->userdata('user_data');  
        $date = date('Y-m-d H:i:s',time()-(7*86400));
        $data['vids'] = $this->db->select('*, v.user_id as u_id')
            ->from('videos as v')
            ->where('v.link_video !=',"")
            ->where('v.type !=','file')
            ->join('photos as p', 'v.user_id = p.user_id','left')
            ->join('users as u', 'v.user_id = u.id')
            ->where('u.role',1)
            ->where('u.is_admin != ',1)
            ->where('v.create_date >= ',$date)
            ->group_by('v.user_id')
            ->limit(10,0)
            ->order_by('v.id', 'asc')
            ->get()->result_array();
            
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('features/hot_video_picks', $data);
        $this->load->view('includes/footer', $data);
    }
}
