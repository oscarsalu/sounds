<?php

class M_comment extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * List Comment on FLP.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return array
     **/
    public function list_comment_flp($user_id, $limit)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('type', 'FLP')
            ->limit($limit)->order_by('id', 'DESC')
            ->get('comments')->result_array();
    }
    /**
     * Count number comment flp.
     *
     * @param int $user_id
     *
     * @return int
     **/
    public function num_comments_flp($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('type', 'FLP')
            ->count_all_results('comments');
    }
    /**
     * List all comment on FLP.
     *
     * @param int $user_id
     * @param int $page
     * @param int $offset
     *
     * @return array
     **/
    public function all_comment_flp($user_id, $page = 0, $offset = 12)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('type', 'FLP')
            ->limit($page, $offset)
            ->order_by('id', 'DESC')->get('comments')->result();
    }
    /**
     * Count number comment alp.
     *
     * @param int $user_id
     *
     * @return int
     **/
    public function num_comments_alp($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('type', 'ALP')
            ->count_all_results('comments');
    }
    /**
     * List all comment on ALP.
     *
     * @param int $user_id
     * @param int $page
     * @param int $offset
     *
     * @return array
     **/
    public function all_comment_alp($user_id, $page = 0, $offset = 12)
    {
        return  $this->db
            ->where('user_id', $user_id)
            ->where('type', 'ALP')
            ->limit($page, $offset)->order_by('id', 'DESC')
            ->get('comments')->result_array();
    }
    /**
     * List all comments on FLP.
     *
     * @param int $user_id
     * @param int $page
     * @param int $offset
     *
     * @return array
     **/
    public function all_comments_flp($user_id, $page = 0, $offset = 12)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('type', 'FLP')
            ->limit($page, $offset)
            ->order_by('id', 'DESC')->get('comments')->result_array();
    }

}
