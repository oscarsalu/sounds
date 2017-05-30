<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_channel extends CI_Model {
    
    function __construct(){
        parent::__construct();
    }
    
    public function save($data)
    {
        $table = 'channel';
        $this->db->insert($table, $data);
        $num = $this->db->insert_id();

        return $num;
    }

    public function get_all_channels()
    {
        return $this->db->get('channel')->result_array();
    }
    

    public function update($id, $name, $type)
    {
         $updateArr = array(
            'name'=>$name, 'type'=>$type
        );
       $this->db->where('id', $id)->update('channel', $updateArr);
       return $updateArr;
    }

    public function delete($id)
    {
        if(isset($id)){            
            if($this->db->where('id', $id)->delete('channel')){
                 
            }
        }  
    }
}    