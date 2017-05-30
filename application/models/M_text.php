<?php

class M_text extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Check Value text.
     *
     * @param string $type
     *
     * @return bool
     **/
    public function check_value($type)
    {
        $result = $this->db->where('type', $type)->get('text')->result_array();

        return $result;
    }
    /**
     * Get data Text value.
     *
     * @param string $key
     * @param a      $rraydata
     **/
    public function getdatavalue($key, $data)
    {
        $result = $this->db->where('type', $key)->get('text')->result_array();
        if (!empty($result)) {
            $data = $result[0]['html_text'];
            $data = trim($data);
            $values = json_decode($data, true);
            echo $values['<http://viejs.org/ns/content>'];
        } else {
            echo $data;
        }

//        $result = mysql_query("SELECT * FROM `$table` where type = '$key'");
//        
//        $num_rows = mysql_num_rows($result);
//        if($num_rows > 0){
//            $rows = mysql_fetch_assoc($result);
//            $data = $rows["html_text"];
//            $data = trim($data);
//           // $values = json_decode(utf8_decode($data),true);
//            $values = json_decode($data,true);
//            echo $values["<http://viejs.org/ns/content>"];      
//        }else{
//            echo $data;
//        }
    }
}
