<?php

class M_schedules extends CI_Model
{
    public function __construct()
    {

        // Call the Model constructor

        parent::__construct();
    }

    public function delete_schedule($location_id)
    {
        $this->db->where('location_id', $location_id);
        $del = $this->db->delete('schedules');
        if ($del) {
            return true;
        } else {
            return false;
        }
    }

    public function get_schedules($tour_id, $location_id_array)
    {
       return $this->db->where('tour_id', $tour_id)->where_in('location_id', $location_id_array)->order_by('start_time')->get('schedules')->result_array();
    }
    
}
