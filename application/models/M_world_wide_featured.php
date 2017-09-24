<?php

class M_world_wide_featured extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Get backgrounds world wide featured page.
     *
     * @return array
     **/
    public function get_background()
    {
        $results = $this->db->where('page_name', 'world_wide_featured')->get('backgrounds')->result_array();

        return $results;
    }
}
