<?php

class M_fan extends CI_Model
{
    public function __construct()
    {

        // Call the Model constructor

        parent::__construct();
    }
    /**
     *LIST TOP 100 Fan.
     *
     * @param int
     * @param int
     *
     * @return array
     **/
    public function list_100($page = 0, $offset = 12)
    {
        return $this->db->select('t.user_id,SUM(t.amount) as total')
            ->from('transactions as t')
            ->where('t.type', 'amp')
            ->where('type', 'amp')
            ->where('level_sale!=', null)
            ->group_by('t.user_id')
            ->limit($page, $offset)
            ->order_by('total', 'DESC')
            ->get()->result_array();
    }
    /**
     * Count number Fans.
     *
     * @param int $user_id
     *
     * @return int
     **/
    public function num_fans($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->join('users', 'fans.fan_id = users.id')
            ->group_by('fans.id')
            ->count_all_results('fans');
    }
    /**
     * List  Fans on ALP.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return array
     **/
    public function list_fan_alp($user_id, $limit)
    {
        return $this->db->select('*')
            ->from('fans')
            ->where('fans.user_id', $user_id)
            ->join('users', 'fans.fan_id = users.id')
            ->join('photos', 'fans.fan_id = photos.user_id', 'left')
            ->group_by('fans.id')
            ->limit($limit)->get()->result_array();
    }

    public function check_friends($user_id1, $user_id2)
    {

        $this->db->where("(user_id1 = '$user_id1' AND user_id2 = '$user_id2') OR (user_id1 = '$user_id2' AND user_id2 = '$user_id1')");
        $data_user = $this->db->get('friends')->result_array();
        return $data_user;
    }

    public function add_friend($user_id1, $user_id2, $status = null)
    {
        $table = "friends";
        $data = array('user_id1'=>$user_id1, 'user_id2'=>$user_id2, 'status'=>$status,'date'=>time());
        $this->db->insert($table, $data);
        $num = $this->db->insert_id();
        return $num;
    }
}
