<?php

class M_tax extends CI_Model
{
    public function __construct()
    {

        // Call the Model constructor

        parent::__construct();
    }

    /* ************* add insert data *************** */
    public function insert_data($data)
    {
        $table = "tax_tours";
        $this->db->insert($table, $data);
        $num = $this->db->insert_id();

        return $num;
    }
/* ************* add insert num row data *************** */
    /*function insert_data_num($table,$data)
    { 
         $query = $this->db->insert($table,$data);
        $num = $query->num_rows();
        return $num;
    }*/
/* ************* update data *************** */
    public function update_data($tax_id, $data)
    {
        $table = "tax_tours";
        $this->db->where('id', $tax_id);
        $update = $this->db->update($table, $data);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($tax_id)
    {
        $table = "tax_tours";
        
        $this->db->where('id', $tax_id);
        $delete = $this->db->delete($table);
        if ($delete) {
            return true;
        } else {
            return false;
        }
    }

}
