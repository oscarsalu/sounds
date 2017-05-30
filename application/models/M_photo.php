
<?php

class M_photo extends CI_Model
{
    public function __construct()
    {

        // Call the Model constructor

        parent::__construct();
    }
    /**
     * Get a photo.
     *
     * @param int $id
     *
     * @return object
     **/
    public function get_photo($id)
    {
        return $this->db->where('id', $id)
            ->get('photos')->row();
    }
    /**
     * List photos on FLP.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return array
     **/
    public function list_photos_flp($user_id, $limit)
    {
        return $this->db->where('user_id', $user_id)
            ->limit($limit)->order_by('id', 'DESC')
            ->get('photos')->result_array();
    }
    /**
     * List photos on ALP.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return array
     **/
    public function list_photos_alp($user_id, $limit)
    {
        return $this->db->where('user_id', $user_id)
            ->limit($limit)->order_by('id', 'DESC')
            ->get('photos')->result_array();
    }
    /**
     * List photos on EPK.
     *
     * @param int $user_id
     * @param int $limit
     *
     * @return array
     **/
    public function list_photos_epk($user_id, $limit)
    {
        //code added to get photos for epk
        $epk_data = $this->db->where('user_id', $user_id)->select('epk_photo')->get('customize_epk')->row_array();
        if($epk_data['epk_photo']  && ($limit != 0))
        {
            $dataArray = array_reverse(explode(',', $epk_data['epk_photo']));
            return $this->db->where('user_id', $user_id)
                ->where_in('id', $dataArray)
            ->limit($limit)->order_by('id', 'DESC')
            ->get('photos')->result_array();
        }
        else
        {
            return $this->db->where('user_id', $user_id)
            ->limit($limit)->order_by('id', 'DESC')
            ->get('photos')->result_array();
        }
        
    }
    /**
     * Get item photo where.
     *
     * @param int   $table
     * @param array $where
     *
     * @return object photos
     **/
    public function getItemWithWhere($table, $where)
    {
        return $this->db->get_where($table, $where)->result();
    }
    /**
     * Get books photos.
     *
     * @param int $perpage
     * @param int $offset
     *
     * @return object photos
     **/
    public function GetBooks($perpage, $offset)
    {
        $a_User = $this->db->select()
            ->order_by('id')->limit($perpage, $offset)
            ->get('photos')->result();

        return $a_User;
    }
    /**
     * Update  photos where.
     *
     * @param string $table
     * @param array  $data
     * @param array  $where
     **/
    public function updateWhere($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }
    /**
     * Delete  photos where.
     *
     * @param int $id
     * @param bool
     **/
    public function deleteWhere($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('photos');

        return true;
    }
    /**
     * Get photo profile.
     *
     * @param int $user_id
     * @param object
     **/
    public function getPhotoProfile($user_id)
    {
         //$query = $this->db->query("SELECT * FROM photos where id = $user_id");
		 $query = $this->db->query("select photos.filename,photos.caption,photos.user_id,users.profile_photo from users join photos on users.profile_photo=photos.id where users.id=$user_id");
		 
         if ($query->num_rows() > 0) {
            $row = $query->last_row('array');
            $row['filename'];
            $row['user_id'];

            return $row;
        } else {
            return 'notfound';
        }
    }
	
	 
	
	 /*added by sunil*/
	
   public function changePhotoProfile($id,$userid)
   {
		 $data = array(
				   'profile_photo' => $id
				);
	    $array = array('id' => $userid);
		$this->db->where($array);
		$this->db->update('users',$data);
   		
   }	
	
	
	
	
	
}//main function 
