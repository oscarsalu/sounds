<?php

class M_make_money extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Get backgrounds make money page.
     *
     * @return array
     **/
    public function get_background()
    {
        $results = $this->db->where('page_name', 'make_money')->get('backgrounds')->result_array();

        return $results;
    }
}
