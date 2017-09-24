<?php
 if (!defined('BASEPATH')) {
     exit('No direct script access allowed');
 }
class M_find_location extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function locations()
    {
        $locations = $this->db->select('street1,city,country,state,company,email,phone,lat,lng')
               ->where('lat !=', '')
               ->where('lng !=', '')
               ->get('db_locations')->result_array();

        return  $locations;
    }
    public function locations_default()
    {
        $locations = $this->db->select('street1,city,country,state,company,email,phone,lat,lng')
               ->where('lat !=', '')
               ->where('lng !=', '')
               ->where('country', 'Canada')
               ->get('db_locations')->result_array();

        return  $locations;
    }
    public function location_country($location_country)
    {
        $location_countrys = $this->db->select('street1,city,country,state,company,email,phone,lat,lng')
                       ->where('lat !=', '')
                       ->where('lng !=', '')
                       ->where('country', $location_country)
                       ->get('db_locations');
        if ($location_countrys->num_rows() > 0) {
            return $location_countrys->result_array();
        } else {
            return false;
        }
    }
    public function location_state($location_country, $location_state)
    {
        $location_states = $this->db->select('street1,city,country,state,company,email,phone,lat,lng')
                               ->where('lat !=', '')
                               ->where('lng !=', '')
                               ->where('country', $location_country)
                               ->where('state', $location_state)
                               ->get('db_locations');
        if ($location_states->num_rows() > 0) {
            return $location_states->result_array();
        } else {
            return false;
        }
    }
    public function location_city1($location_country, $location_city)
    {
        $location_citys = $this->db->select('street1,city,country,state,company,email,phone,lat,lng')
                               ->where('lat !=', '')
                               ->where('lng !=', '')
                               ->where('country', $location_country)
                               ->where('city', $location_city)
                               ->where('city !=', '')
                               ->get('db_locations');
        if ($location_citys->num_rows() > 0) {
            return $location_citys->result_array();
        } else {
            return false;
        }
    }

    public function location_city($location_country, $location_state, $location_city)
    {
        $location_citys = $this->db->select('street1,city,country,state,company,email,phone,lat,lng')
                               ->where('lat !=', '')
                               ->where('lng !=', '')
                               ->where('country', $location_country)
                               ->where('state', $location_state)
                               ->where('city', $location_city)
                               ->where('city !=', '')
                               ->get('db_locations');
        if ($location_citys->num_rows() > 0) {
            return $location_citys->result_array();
        } else {
            return false;
        }
    }

    public function countries()
    {
        $countries = $this->db
      ->distinct()
      ->select('country')
      ->where('country != ', '')
      ->order_by('country', 'ASC')
     ->get('db_locations');
        if ($countries->num_rows() > 0) {
            return $countries->result_array();
        }
    }

    public function location_address_state($provincia)
    {
        $localidades = $this->db
             ->distinct()
             ->select('state')
             ->where('country', $provincia)
             ->where('state !=', '')
             ->order_by('state', 'asc')
             ->get('db_locations');
        if ($localidades->num_rows() > 0) {
            $result = array(
            'status' => 1,
            'locationst' => $localidades->result_array(),
         );

            return $result;
        } else {
            $localidades = $this->db
             ->distinct()
             ->select('city')
             ->where('country', $provincia)
             ->where('city !=', '')
             ->order_by('city', 'asc')
             ->get('db_locations');
            if ($localidades->num_rows() > 0) {
                $result2 = array(
                'status' => 2,
                'locationst' => $localidades->result_array(),
             );

                return $result2;
            } else {
                return false;
            }
        }
    }

    public function location_address_city($provincia)
    {
        $localidades = $this->db
             ->distinct()
             ->select('city')
             ->where('state', $provincia)
             ->where('city !=', '')
             ->order_by('city', 'asc')
             ->get('db_locations');
        if ($localidades->num_rows() > 0) {
            return $localidades->result_array();
        }
    }
    
    public function get_all_countries(){
        $country=$this->db->get('countries')->result();
        return $country;
        
    }
    public function get_country_by_id($id){
        $countryname=$this->db->where(array('id'=>$id))->get('countries')->row_array();
        return $countryname;
    }
}
