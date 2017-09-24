<?php
class M_features_fan extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    function get_background()
    {
        $results = $this->db->where('page_name','fan_feature')->get('backgrounds')->result_array();
        return $results;
    }
    
    public function show_all()
    {   /*
        $this->db->select('*,u.id as usid,g.name as genre_name')
        ->from('users as u')
        //->where('u.role =',2)
        ->join('genres as g','u.genre = g.id')*/
        $this->db->select('*,u.id as usid')
        ->from('users as u')
        ->where('u.role =',2)
        ->limit(12,0);
        $query = $this->db->get();
       	if ($query->num_rows() > 0) {
    	   return $query->result();
    	} else {
    	   return false;
    	}
    }
    
    public function search($key)
    {   
        $this->db->select('*,u.id as usid')//,g.name as genre_name
                 ->from('users as u')
                 //->join('genres as g','g.id = u.genre')
                 ->where('u.role =',2)
                 ->where('u.is_admin =',0)
                 ->like('u.fan_name',$key)
                 //->or_like('g.name',$key,'none')
                 ->limit(12,0)
                 ->group_by('u.id')
                 ->order_by('u.id', 'ASC');
        $query= $this->db->get();
        if ($query->num_rows() > 0) {
    	   return $query->result();
    	} else {
    	   return false;
    	}
    }
    
    public function search_more($key,$limit)
    {   
        $this->db->select('*,u.id as usid,g.name as genre_name')
                ->from('users as u,genres')
                ->join('genres as g','u.genre = g.id')
                ->like('artist_name',$key)
                ->or_like('g.name',$key)
                ->group_by('u.id','DESC')
                ->limit(12,$limit)
                ->order_by('u.id', 'ASC')  ; 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
    	   return $query->result();
    	} else {
    	   return false;
    	}
    }
}