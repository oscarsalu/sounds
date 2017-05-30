<?php

class M_transaction extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    /**
     *  Count total transactions.
     *
     * @param int $user_id
     *
     * @return int
     **/
    public function total_transactions($id_user)
    {
        $res = $this->db->select('t.*')
            ->where('t.user_id', $id_user)
            ->get('transactions t')->num_rows();

        return $res;
    }
    /**
     *  Get transactions.
     *
     * @param int $user_id
     * @param int $per_page
     * @param int $start
     *
     * @return int
     **/
    public function get_transactions($id_user, $per_page, $start)
    {
        $res = $this->db->select('t.*')
            ->where('t.user_id', $id_user)
            ->limit($per_page, $start)
            ->get('transactions t')->result();

        return $res;
    }
    public function get_transactions_by_user($id_user)
    {
        $res = $this->db->query("select * from transactions where user_id='$id_user' and status=0")
                ->num_rows();
           

        return $res;
    }
}
