<?php

class M_premium_pack extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Get Pack.
     *
     * @param int $user_id
     *
     * @return object
     **/
    public function get_pack($user_id)
    {
        return $this->db->where('user_id', $user_id)
        ->where('active', 1)
        ->get('premium_pack')->row_array();
    }
}
