<?php
//23/02/2013
class Events_model extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    /**
     * List  event on ALP.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return array
     **/
    public function list_event_alp($user_id, $limit)
    {
        return $this->db->select('*')
            ->from('events')
            ->where('user_id', $user_id)
            ->order_by('events.event_id', 'DESC')
            ->limit($limit)
            ->get()->result_array();
    }
    /**
     * Get event data.
     *
     * @param int $event_id
     * @param int $user_id
     *
     * @return object
     **/
    public function get_event_data($event_id, $user_id)
    {
        return $this->db->select('events.*, genres.name as genre')
            ->where('event_id', $event_id)
            ->where('user_id', $user_id)
            ->join('genres', 'genres.id= events.categories')
            ->order_by('event_id', 'DESC')
            ->get('events')->row();
    }
    /**
     * Insert data.
     *
     * @param string $table
     * @param array  $data
     *
     * @return int $id
     **/
    public function insert($table, $data)
    {
        $this->db->set($data);
        $this->db->insert($table);

        return $this->db->insert_id();
    }
    /**
     * Update data where.
     *
     * @param string $table
     * @param array  $data
     * @param array  $where
     **/
    public function updateWhere($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }
    /**
     * List all event.
     *
     * @param string $id_user
     *
     * @return array
     **/
    public function getAllEvents($id)
    {
        $results = $this->db->select('*')->from('events')->where('user_id', $id)->get()->result_array();

        return $results;
    }
    /**
     * get Item event With Where.
     *
     * @param string $table
     * @param array  $where
     *
     * @return array
     **/
    public function getItemWithWhere($table, $where)
    {
        return $this->db->get_where($table, $where)->result();
    }
    /**
     * delete Item event With Where.
     *
     * @param int $event_id
     *
     * @return bool
     **/
    public function deleteWhere($id)
    {
        $this->db->where('event_id', $id);
        $this->db->delete('events');

        return true;
    }
    public function Categories($id)
    {
        return $this->db->select('name')
                ->from('genres')
                ->where('id', $id)
                ->get()->result_array();
    }
    public function Comment($id)
    {
        return $this->db->select('*')
                ->from('venues_info')
                ->where('event_id', $id)
                ->where('status', '1')
                ->get()->result_array();
    }
    public function get_genres($id)
    {
        return  $this->db->select('name')
                ->where('id', $id)
                ->get('genres')->result_array();
    }

    
    //Code added to display Selected Events on Dashboard
    public function get_select_show_epk($user_id)
    {
        //Fetching code from customize_epk
        $user_data = $this->db->select('epk_shows')->where('user_id', $user_id)->get('customize_epk')->row_array();
        if($user_data['epk_shows'])
        {
            $event_ids = array_reverse(explode(',', $user_data['epk_shows']));
            $events = $this->db->where_in('event_id', $event_ids)->where('user_id', $user_id)->select('*')->order_by('event_id', 'DESC')->get('events')->result_array();
        
            return $events;
        }
        else
        {
            $events = $this->db->where('user_id', $user_id)->select('*')->order_by('event_id', 'DESC')->get('events')->result_array();
        
            return $events;
        }
    }

    //Code added for displaying event counts
    public function num_events($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->count_all_results('events');
    }
}
