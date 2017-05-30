<?php

class M_groups_member extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * List Member.
     *
     * @param int $user_id
     *
     * @return array
     **/
    public function list_member($user_id, $limit)
    {
        return $this->db->where('artist_id', $user_id)
            ->limit($limit)->order_by('id', 'DESC')
            ->get('groups_member')->result_array();
    }
}
