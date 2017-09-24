<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_locations extends CI_Model {

	function __construct()
	{
		$this->load->database();
	}
   /**
    * Check location
    * @param string $street1
    * @param string $city
    * @param string $country
    * @return boolean
    **/
   public function check_location($street1,$city,$country){
        $this->db->select("street1,city,country"); 
        $this->db->where('street1',$street1);
        $this->db->where('city', $city);
        $this->db->where('country', $country);           
        $query=$this->db->get("db_locations");   
        if ($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
      
    }
    /**
    * Count total search
    * @param string $match
    * @return int
    **/
    public function sum_search($match){
         
         $query      = $this->db->get_where('db_locations',"company LIKE '%$match%' OR contact LIKE '%$match%' OR email LIKE '%$match%'");
         $sum_row = $query->num_rows();
         return $sum_row;
    }  
    /**
    * Query seach locations
    * @param string $match
    * @param int $limit
    * @param int $start
    * @return int
    **/
    public function search($match,$limit,$start){  
         $this->db->limit($limit, $start);  
         $query      = $this->db->get_where('db_locations',"company LIKE '%$match%' OR contact LIKE '%$match%' OR email LIKE '%$match%'");
         $sum_row = $query->num_rows();
         
         //var_dump($sum_row); exit;
         if($query->num_rows()>0){
              foreach ($query->result() as $row) {
                $data[] = $row;
               } 
               return $data;
         }else{
            return false;
         }
         
     }
    /**
    * count all locations 
    * @return int
    **/
    public function record_count(){
        return $this->db->count_all("db_locations");
    }
    /**
    * Get records location
    * @param int $limit
    * @param int $start
    * @return int
    **/
    public function fetch_records($limit, $start) {
    
        $this->db->limit($limit, $start);  
            
        $query = $this->db ->order_by('id_location', 'DESC')->get("db_locations");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }           
            return $data;
        }
        
        return false;
    }     
  

}
