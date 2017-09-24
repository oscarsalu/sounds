<?php

class M_template_land extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Data landding.
     *
     * @return array
     **/
    public function data_landing()
    {
        return $this->db->where('type', 'landing')
            ->where('active', 1)
            ->order_by('position', 'ASC')
            ->get('template_lands')
            ->result_array();
    }
}
