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

    public function save_channel_affilaites($data)
    {
        $table = 'channel_affilates';
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

    public function get_all_public_channels()
    {
        return $this->db->where('type', 'public')->get('channel')->result_array();
    }

    public function get_channel_name($id)
    {
        $data = $this->db->where('id', $id)->select("name")->get('channel')->row_array();  
        return $data['name'];
    }
    public function get_channel_type($id)
    {
        $data = $this->db->where('id', $id)->select("group_type")->get('channel')->row_array();  
        return $data['group_type'];
    }

    public function get_channel_user_id($id)
    {
        $data = $this->db->where('id', $id)->select("user_id")->get('channel')->row_array();  
        return $data['user_id'];
    }
    public function get_private_channel_user_id($user_id, $type, $artist_name = null)
    {
        if($type == 'tour')
        {
            $dataReturn = $this->db->where('tm.user_member', $user_id)->from('tours_member as tm')->select('*')->where('ch.group_type', 'tour')->join('channel as ch', 'ch.group_id = tm.tour_id')->get()->result_array();
        }
        else{
            $user_members = $this->db->select('*')->where('artist_id', $user_id)->or_where('member_id', $user_id)->get('groups_member')->result_array();
            $dataReturn = array();
            $data_return = $this->db->select('*')->where("group_id", $user_id)->where('group_type', 'band')->get('channel')->row_array();
            if(!empty($data_return))
            {
                $dataReturn[] = $data_return;
            }
            foreach ($user_members as $key => $value) {
                $dataReturn[] = $this->db->select('*')->where("group_id", $value['artist_id'])->where('group_type', 'band')->get('channel')->row_array();
            }
            
           $dataReturn = array_map("unserialize", array_unique(array_map("serialize", $dataReturn)));
        }
        
        return $dataReturn;
    }

    public function check_artist_band_channel($artist_name)
    {
        $data = $this->db->where('name', $artist_name)->where('group_type', 'band')->get('channel')->num_rows();
        return $data;
    }

    public function check_artist_affiliates_channel($artist_id)
    {
        $data = $this->db->where('user_id', $artist_id)->where('group_type', 'affiliates')->get('channel')->result_array();
        return $data;
    }

    public function get_affilaiate($id_artist, $level)
    {
       
        $user_affilates = $this->db->select('list_artist')->where('user_id', $id_artist)->get('affiliates')->row();
       
        $listArray = explode('-', $user_affilates->list_artist);
        if (($key = array_search($id_artist, $listArray)) !== false) {
            unset($listArray[$key]);
        }
        $returnData = array();
        
        foreach ($listArray as $key => $value) {
            $dataQuery = $this->db->select('*')->where('c.user_id', $value)->where('c.level', $level)->where('a.level', $level)->where('c.group_type', 'affiliates')->where('c.group_id', $value)->join('channel_affilates as ca', 'ca.channel_id = c.id ')->join('affiliate_level as a', 'ca.affiliate_id = a.affiliate_id and c.user_id = a.artist_id')->get('channel as c')->row_array();
            if(!empty($dataQuery))
            {
                $returnData[] = $dataQuery;
            }
            

        }
        
        return $returnData;
    }    

    public function get_channel_id($artist_id, $level)
    {
       $dataReturn =  $this->db->select('id')->where('user_id', $artist_id)->where('level', $level)->where('group_type', 'affiliates')->get('channel')->row_array();
       if($dataReturn)
       {
            return $dataReturn['id'];
       }
    }

    public function get_channel_type_group_type_name($id)
    {
        return $this->db->where('id', $id)->select("group_type, type, name, group_id")->get('channel')->row_array();  

    }

    public function get_group_name($id)
    {
        return $this->db->where('id', $id)->select("*")->get('groups_chat')->row_array();  
    }


    public function get_group_user_id($user_id, $group_id, $type)
    {
        $result = array();
        if($type == 'tour')
        {
            $data = $this->db->select('user_member')->where("tour_id", $group_id)->get("tours_member")->result_array();
            
            foreach ($data as $key => $value) {
                if($value['user_member'] != 0)
                {
                    $result[] =  $value['user_member'];
                }
            }
            
        }
        elseif($type == 'band'){
            $data = $this->db->select('member_id')->where("artist_id", $user_id)->get("groups_member")->result_array();
            
            foreach ($data as $key => $value) {
                if($value['member_id'] != 0)
                {
                    $result[] =  $value['member_id'];
                }
            }
            if(!in_array($user_id, $result))
            {
                $result[] = $user_id;
            }
            
        }
        return $result;
    }
}    