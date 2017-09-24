<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_user extends CI_Model {
	
    function __construct(){
        parent::__construct();
    }
    
    function check_email_isset($email) {
        $this->db->where('email', $email);
        return $this->db->get('users')->row_array();        
    }    
    /**
    * Check password
    * @param int $id_user
    * @param string $password
    * @return boolean
    */
    function check_password($id,$password)
    {
        $user = $this->db->where('id', $id)
            ->get('users')->row_array();
        if(!empty($user)){ 
           if(sha1($user['hash'].$password)==$user['password']){
                return true;
            }
        }
        return false;   
    }
    /**
    * Update password
    * @param int $id_user
    * @param string $password
    * @return boolean
    */
    function update_password($password,$id)
    {
        $user = $this->db->where('id', $id)
            ->get('users')->row_array();
        if(!empty($user)){
            $new_pass = sha1($user['hash'].$password);
            $this->db->update('users',array('password'=>$new_pass),'id='.$id);
            return true;
        }   
        return false;
    }    
    function check_home_page($home_page) {
        $this->db->where('home_page', $home_page);
        return $this->db->get('users')->row_array();
    }
    
    function deleteWhere($id,$table){
		$this->db->where('id',$id);
		$this->db->delete($table);
		return true;
    }
    
    function get_all_users()
    {
       return $this->db->select("*,users.id")
                ->from('users')                                                                 
                ->join('countries', 'users.countries = countries.id')
                ->join('genres', 'users.genre = genres.id')
                ->get()->result_array();         
    }
    
    
    
}
?>