<?php

class M_press extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * List Press.
     *
     * @param int $user_id
     *
     * @return array
     **/
    public function list_press_alp($user_id, $limit)
    {
        return $this->db->where('artist_id', $user_id)
            ->limit($limit)
            ->order_by('id', 'DESC')
            ->get('press')->result_array();
    }
    /**
     * List Press EPK.
     *
     * @param int $user_id
     *
     * @return array
     **/
    public function list_press_epk($user_id, $limit)
    {
        $epk_data = $this->db->where('user_id', $user_id)->select('epk_press')->get('customize_epk')->row_array();
        if($epk_data['epk_press'] && ($limit != 0))
        {
            $dataArray = array_reverse(explode(',', $epk_data['epk_press']));
            return $this->db->where('artist_id', $user_id)
            ->limit($limit)
            ->where_in('id', $dataArray)
            ->order_by('id', 'DESC')
            ->get('press')->result_array();
             
        }
        else {
            return $this->db->where('artist_id', $user_id)
            ->order_by('id', 'DESC')
            ->get('press')->result_array();
        }
       
    }

    //Function to get all press
    public function get_all_press($user_id)
    {
        return $this->db->where('artist_id', $user_id)
            ->order_by('id', 'DESC')
            ->get('press')->result_array();
    }
}
