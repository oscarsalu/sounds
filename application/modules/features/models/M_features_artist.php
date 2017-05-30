<?php
class M_features_artist extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    function get_background()
    {
        $results = $this->db->where('page_name','artist_feature')->get('backgrounds')->result_array();
        return $results;
    }
    function showall()
    {
        $this->db->select('*,u.id as usid,g.name as genre_name')
                ->from('users as u')
                ->where('u.role =',1) ->where('u.lock =',0)
                ->where('u.is_admin =',0)
                ->join('genres as g','g.id = u.genre')
                ->limit(24,0)
                ->order_by('u.artist_name','RANDOM');
        $query = $this->db->get();
        
        if($query->num_rows() >0)
        {
            return $query->result();
        }else{
            return false;
        }
    }
    function top_hot_artist()
    {
        $query = $this->db->where('role =',1) ->where('lock =',0)->where('is_admin =',0)
            ->limit(10)
            ->order_by('artist_name','RANDOM')
            ->get('users');
        if($query->num_rows() >0)
        {
            return $query->result();
        }else{
            return false;
        }
    }
    public function search($key)
    {
        $this->db->select('*,u.id as usid,g.name as genre_name')
                 ->from('users as u')
                 ->join('genres as g','g.id = u.genre')
                 //->where('g.id','u.genre')
                 ->where('u.role =',1)
                 ->where('u.is_admin =',0)
                 ->like('u.artist_name',$key)
                 //->or_like('u.firstname',$key)
                 //->or_like('u.lastname',$key)
                 ->or_like('g.name',$key,'none')
                 ->limit(12,0)
                 ->group_by('u.id')
                 ->order_by('u.id', 'ASC');
        $query= $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return false;
        }
    }
}