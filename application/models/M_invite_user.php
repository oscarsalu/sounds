<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_invite_user extends CI_Model {
    
    function __construct(){
        parent::__construct();
    }
    
    public function save($data)
    {
        $table = 'invite_user';
        $this->db->insert($table, $data);
        $num = $this->db->insert_id();
        return $num;
    }

    
    
}    