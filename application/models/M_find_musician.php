<?php
//23/02/2013
class M_find_musician extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert($table, $data)
    {
        $this->db->set($data);
        $this->db->insert($table);

        return $this->db->insert_id();
    }

    public function updateWhere($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }

    public function getItemWithWhere($table, $where)
    {
        return $this->db->get_where($table, $where)->result();
    }

    public function rand_musician($limit)
    {
        $results = $this->db->select('users.id,users.city,users.home_page')
                    ->from('users')
                    ->where('users.role', 1)->where('users.is_admin', 0)->where('users.lock', 0)
                    ->group_by('users.id')
                    ->order_by('users.id', 'RANDOM')
                    ->limit($limit)
                    ->get()
                    ->result_array();

        return $results;
    }
    /**
     * Search find a musican.
     *
     * @param string $city
     * @param int    $genre
     * @param int    $start
     * @param int    $offset
     *
     * @return array $artist
     */
    public function search($city, $genre, $start = 0, $offset = 12)
    {
        $this->db->select('users.id,users.city,users.home_page');
        $this->db->where('users.role', 1)->where('users.is_admin', 0)->where('users.lock', 0);
        if (!empty($city)) {
            $this->db->like('city', $city);
        }
        if (!empty($genre)) {
            $this->db->where('genre', $genre);
        }
        //var_dump($start);die;
        $this->db->limit($start, $offset);
        $results = $this->db->get('users')->result_array();

        return $results;
    }
    /**
     * Count Search find a musican.
     *
     * @param string $city
     * @param int    $genre
     *
     * @return int
     */
    public function num_search($city, $genre)
    {
        $this->db->select('users.id,users.city,users.home_page');
        $this->db->where('users.role', 1)->where('users.is_admin', 0)->where('users.lock', 0);
        if (!empty($city)) {
            $this->db->like('city', $city);
        }
        if (!empty($genre)) {
            $this->db->where('genre', $genre);
        }
        $results = $this->db->get('users')->num_rows();

        return $results;
    }
    public function check_list($user_id, $id)
    {
        $result = $this->db->where('user_id', $user_id)
                    ->where('music_user_id', $id)
                    ->get('music_list')->num_rows();
        if (empty($result)) {
        } else {
            return $result;
        }
    }
}
