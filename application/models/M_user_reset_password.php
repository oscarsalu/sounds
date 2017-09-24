

<?php

class M_user_reset_password extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('date');
    }

    /*
    *Function to save entry at the time of reset password
    */

    public function saveTokenEntry($token, $data)
    {
    	
    		$insertArray = array(
    			'user_id'=>$data['user_id'],
    			'token'=>$token,
    			'created_at'=>date('Y-m-d H:i:s'),
    			'updated_at'=>date('Y-m-d H:i:s')
    			);
    		$this->db->insert('user_reset_password', $insertArray);
    	
    }
    

    //Function to check link is activated or not
    public function checkLinkExpiration($token, $user_id)
    {
    	$user = $this->db->where('user_id', $user_id)->where('token', $token)->get('user_reset_password')->row();
        if($user)
        {
        	$mysql_timestamp = $user->created_at;
        	if(strtotime($mysql_timestamp) > strtotime("-30 minutes")) {
				 return true;
			}
        	
        }
        else
        {
        	return false;
        }
    }
}

