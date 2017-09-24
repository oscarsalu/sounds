<?php
//23/02/2013
class Musicians_model extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    /**
     * Insert model.
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
     * Update Where.
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
     * Get all Events musicians_bands.
     *
     * @return array $musicians_bands
     **/
    public function getAllEvents()
    {
        $query = $this->db->get('musicians_bands');
        $results = $query->result();

        return $results;
    }
    /**
     * Get Item with where.
     *
     * @param string $table
     * @param array  $where
     *
     * @return array $musicians_bands
     **/
    public function getItemWithWhere($table, $where)
    {
        return $this->db->get_where($table, $where)->result();
    }

    public function deleteWhere($id)
    {
        $this->db->where('musicians_bands_id', $id);
        $this->db->delete('musicians_bands');

        return true;
    }
}
