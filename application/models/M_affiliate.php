<?php

class M_affiliate extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * get id_user by id_affiliate.
     *
     * @param int $id_affiliate
     *
     * @return int $id_user 
     **/
    public function get_id_user($id_affiliate)
    {
        $row = $this->db->where('affiliate_id', $id_affiliate)->get('affiliates')->row();
        if (isset($row)) {
            return $row->user_id;
        } else {
            return 0;
        }
    }
    /**
     * get list all artist of affliate.
     *
     * @param int $affiliate_id
     * @param int $page
     * @param int $offset
     *
     * @return array $artist 
     **/
    public function get_list_artist($affiliate_id, $page, $offset)
    {
        $data = $this->db->select('artist_id')
            ->where('status', '1')
            ->where('affiliate_id', $affiliate_id)
            ->limit($page, $offset)
            ->order_by('id', 'DESC')
            ->get('affiliate_level')
            ->result();
        $arr_artist = array();
        foreach ($data as $artist) {
            $arr_artist[] = $artist->artist_id;
        }
        $result = array_unique($arr_artist);

        return $result;
    }
    /**
     * get ID key affiliate by user_id.
     *
     * @param int $user_id
     *
     * @return string ID key
     **/
    public function get_affilaite_id($user_id)
    {
        $row = $this->db->where('user_id', $user_id)->get('affiliates')->row();
        if (isset($row)) {
            return $row->affiliate_id;
        } else {
            return 0;
        }
    }
    /**
     * get data affilaite by affiliate_id.
     *
     * @param int $id_affiliate
     *
     * @return array affiliates
     **/
    public function get_affiliate($id_affiliate)
    {
        $this->db->where('affiliate_id', $id_affiliate);

        return $this->db->get('affiliates')->row_array();
    }
    /**
     * get data affilaite by affiliate_id.
     *
     * @param int $id_affiliate
     *
     * @return array affiliates
     **/
    public function get_sub_affiliates($id_affiliate)
    {
        $affiliate = self::get_affiliate($id_affiliate);
        if (!empty($affiliate) && $affiliate['level'] <= 3) {
            return $this->db->select('id,affiliate_id,first_name,last_name,email,paypal,parent_affiliate,active,level,commission')
            ->where('parent_affiliate', $id_affiliate)->get('affiliates')->result_array();
        } else {
            return 0;
        }
    }
    public function get_connect_affiliate($id_affiliate)
    {
        return $this->db->where('affiliate_id', $id_affiliate)->get('conect_affiliates')->result_array();
    }
    public function get_level_affiliate($id_affiliate)
    {
        $resull = array();
        $parrents['lv1'] = $this->db
            ->where('affiliate_id', $id_affiliate)
            ->get('conect_affiliates')->result_array();
        foreach ($parrents['lv1'] as $parrent1) {
            $aff_current = self::get_affiliate($parrent1['parrent_id']);//level 0 69b9e56b6e42eccac8bfe573acc6b913
            if ($aff_current['parent_affiliate'] == $aff_current['user_id']) {
                $resull['level2'][] = array(
                    'artist' => $aff_current['user_id'],
                    'affiliate1' => $parrent1['affiliate_id'],
                    'affiliate2' => null,
                    'affiliate3' => null,
                );
            } else {
                $parrents['lv2'] = $this->db->where('affiliate_id', $aff_current['affiliate_id'])
                    ->get('conect_affiliates')->result_array();
                foreach ($parrents['lv2'] as $parrent2) {
                    $aff_current = self::get_affiliate($parrent2['parrent_id']);
                    if ($aff_current['parent_affiliate'] == $aff_current['user_id']) {
                        $resull['level3'][] = array(
                            'artist' => $aff_current['user_id'],
                            'affiliate1' => $parrent1['affiliate_id'],
                            'affiliate2' => $parrent2['affiliate_id'],
                            'affiliate3' => null,
                        );
                    } else {
                        $parrents['lv3'] = $this->db->where('affiliate_id', $aff_current['affiliate_id'])
                            ->get('conect_affiliates')->result_array();
                        foreach ($parrents['lv3'] as $parrent3) {
                            $aff_current = self::get_affiliate($parrent3['parrent_id']);
                            if ($aff_current['parent_affiliate'] == $aff_current['user_id']) {
                                $resull['level4'][] = array(
                                    'artist' => $aff_current['user_id'],
                                    'affiliate1' => $parrent1['affiliate_id'],
                                    'affiliate2' => $parrent2['affiliate_id'],
                                    'affiliate3' => $parrent3['affiliate_id'],
                                );
                            }
                        }
                    }
                }
            }
        }

        return $resull;
    }
    public function sub_affiliates($artist_id, $level = null)
    {
        if (isset($level)) {
            $data_affiliates = $this->db->select('u.*,a.affiliate_id,lv.status as Status,lv.id as ID_level')
                ->where('lv.artist_id', $artist_id)
                ->where('lv.level', $level)
                ->join('affiliates a', 'lv.affiliate_id = a.affiliate_id')
                ->join('users u', 'u.id = a.user_id')
                ->get('affiliate_level lv')->result_array();
        } else {
            $data_affiliates = $this->db->select('u.*,a.affiliate_id,lv.status as Status,lv.id as ID_level')
                ->where('lv.artist_id', $artist_id)
                ->join('affiliates a', 'lv.affiliate_id = a.affiliate_id')
                ->join('users u', 'u.id = a.user_id')
                ->get('affiliate_level lv')->result_array();
        }

        return $data_affiliates;
    }
    public function get_commission($artist_id, $level)
    {
        $data_commission = $this->db
            ->where('id_artist', $artist_id)
            ->get('commission_affiliate')->row();
        if (!empty($data_commission)) {
            switch ($level) {
                case 1:
                    return $data_commission->commission_1;
                case 2:
                    return $data_commission->commission_2;
                case 3:
                    return $data_commission->commission_3;
                case 4:
                    return $data_commission->commission_4;
                default:
                    return 0;
            }
        } else {
            return 0;
        }
    }

    public function check_connect_affiliate($artist_id, $user_id)
    {
        if ($artist_id == $user_id) {
            return true;
        } else {
            $data_artist = $this->db->select('affiliate_id')->where('user_id', $artist_id)->get('affiliates')->row();
            $data_user = $this->db->select('affiliate_id')->where('user_id', $user_id)->get('affiliates')->row();
            if (!empty($data_artist) && !empty($data_user)) {
                $data_conect = $this->db->where('affiliate_id', $data_user->affiliate_id)
                    ->where('parrent_id', $data_artist->affiliate_id)
                    ->get('conect_affiliates')->row();
                if (!empty($data_conect)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
    public function update_list_artist($id, $artist_id)
    {
        $str_list_artist = $this->db->select('list_artist')->where('id', $id)->get('affiliates')->row()->list_artist;
        if (empty($str_list_artist)) {
            $str_list_artist = $artist_id;
        } else {
            $arr_list_artist = explode('-', $str_list_artist);
            if (!in_array($artist_id, $arr_list_artist)) {
                $arr_list_artist[] = $artist_id;
            }
            $result = array_unique($arr_list_artist);
            $str_list_artist = implode('-', $result);
        }
        $this->db->where('id', $id)->update('affiliates', array('list_artist' => $str_list_artist));
    }
    public function check_connect($affiliate_sub, $affiliate_parrent)
    {
        $check_connect = $this->db
            ->where('affiliate_id', $affiliate_sub)
            ->where('parrent_id', $affiliate_parrent)
            ->get('conect_affiliates')->num_rows();
       
        if ($check_connect > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function count_amp_samples($affiliate_id)
    {
        $count = $this->db->where('id_affiliate', $affiliate_id)->get('stats_samples')->num_rows();

        return $count;
    }
    public function top_popular($user_id, $affiliate_id)
    {
        $array_song = self::get_list_songs($user_id);
        $res = array();
        foreach ($array_song as $row) {
            $res[$row] = $this->db->where('song_id', $row)
            ->where('id_affiliate', $affiliate_id)
            ->get('stats_samples')->num_rows();
        }
        asort($res, SORT_NUMERIC);
        $res = array_reverse($res, true);
        $array_list = array();
        $i = 0;
      
        foreach ($res as $k => $num) {
            if ($i < 10) {
                $song = $this->db->where('id', $k)->get('audio_song')->row();
              if (isset($song)){
               $array_list[] = array(
                    'id_song' => $song->id,
                    'name' => $song->song_name,
                    'filename' => $song->filename,
                    'user_id' => $song->user_id,
                    'counter' => $num,
                ); 
              }
                ++$i;
            } else {
                break;
            }
        }
        
        return $array_list;
        
    }
    public function get_list_songs($user_id)
    {
        $res = $this->db
            ->select('a.audio_song_id as song_id')
            ->where('p.user_id', $user_id)
            ->join('audio_amp a', 'a.playlist_amp_id = p.id')
            ->get('playlist_amp p')->result();
        $array_song = array();
        foreach ($res as $song) {
            $array_song[] = $song->song_id;
        }

        return $array_song;
    }
    public function count_amp_sales($user_id)
    {
        $count_sales = $this->db->where('user_id', $user_id)
        ->where('type', 'amp')->where('level_sale', null)
        ->get('transactions')->num_rows();

        return $count_sales;
    }
    public function get_switch_stats($user_id)
    {
        $res = $this->db->select('stats_flp')
            ->where('user_id', $user_id)
            ->get('affiliates')->row()->stats_flp;

        return $res;
    }
    public function check_limit_affiliate($id_affiliate)
    {
        
       
       $affliate_limit=$this->db->where('affiliate_id', $id_affiliate)->get('affiliates')->row();  
       $affliate_limit1=$this->db->where('affiliate_id', $id_affiliate)->get('affiliate_level')->row(); 
       $user_id=$affliate_limit->list_artist;
       $level=$affliate_limit1->level;
       
       switch($level){
           case "":
           case 0 :
                $level=$level+1;
               $where=array("level"=>$level,"artist_id"=>$user_id);
              
      $get_level_count=$this->db->where($where)->get('affiliate_level')->num_rows();
               $Limit=$this->db->where('user_id', $user_id)->get('limit_affiliates')->row();  
        if(!empty($Limit)){
         $count_limit= $Limit->level_1;
        }
        else {
            
            $count_limit=0;
        }
       
           if($get_level_count<=$count_limit){
             return true;  
           }
           else {
            return false;
           }
           break;
           case 1:
               $Limit=$this->db->where('user_id', $user_id)->get('limit_affiliates')->row();  
                $level=$level+1;
                $where=array("level"=>$level,"artist_id"=>$user_id);
      $get_level_count=$this->db->where($where)->get('affiliate_level')->num_rows();
             $count_limit= $Limit->level_2;
                    if($get_level_count<=$count_limit){
            return true;
        }
           else {
               return false;
    }
          break;
           case 2:
                $Limit=$this->db->where('user_id', $user_id)->get('limit_affiliates')->row();  
                $level=$level+1;
                $where=array("level"=>$level,"artist_id"=>$user_id);
      $get_level_count=$this->db->where($where)->get('affiliate_level')->num_rows();
           
                   
             $count_limit= $Limit->level_3;
             
            if($get_level_count<=$count_limit){
             return true;  
           }
           else {
               return false;
           }
           break;
           case 3:
                $Limit=$this->db->where('user_id', $user_id)->get('limit_affiliates')->row();  
                $level=$level+1;
                 $where=array("level"=>$level,"artist_id"=>$user_id);
      $get_level_count=$this->db->where($where)->get('affiliate_level')->num_rows();
             $count_limit= $Limit->level_4;
          if($get_level_count<=$count_limit){
             return true;  
           }
           else {
               return false;
           }
       }
    }
    public function get_data_commissions($user_id)
    {
        $data = $this->db->where('id_artist', $user_id)->get('commission_affiliate')->row_array();
        if (isset($data)) {
            return $data;
        } else {
            $data = array(
                'id_artist' => $user_id,
                'commission_1' => 0,
                'commission_2' => 0,
                'commission_3' => 0,
                'commission_4' => 0,
            );

            return $data;
        }
    }
    public function get_commission_by_level($user_id, $level)
    {
        $data = $this->db->where('id_artist', $user_id)->get('commission_affiliate')->row_array();
        if (isset($data)) {
            switch ($level) {
                case 1: return $data['commission_1']; break;
                case 2: return $data['commission_2']; break;
                case 3: return $data['commission_3']; break;
                case 4: return $data['commission_4']; break;
            }
        } else {
            return 0;
        }
    }
    public function check_limit_affiliates($user_id, $level)
    {
        $data_limit = $this->db->where('user_id', $user_id)->get('limit_affiliates')->row_array();
        if (isset($data_limit)) {
            $num_affiliate = $this->db->where('artist_id', $user_id)
                ->where('level', $level)
                ->get('affiliate_level')->num_rows();
            $level=$level+1;
            switch ($level) {
                case 1:
                    if ($data_limit['level_1'] >= $num_affiliate) {
                        return true;
                    } else {
                        return false;
                    }
                case 2:
                    if ($data_limit['level_2'] >= $num_affiliate) {
                        return true;
                    } else {
                        return false;
                    }
                case 3:
                    if ($data_limit['level_3'] >= $num_affiliate) {
                        return true;
                    } else {
                        return false;
                    }
                case 4:
                    if ($data_limit['level_4'] >= $num_affiliate) {
                        return true;
                    } else {
                        return false;
                    }
            }
        } else {
            return true;
        }
    }
    public function get_list_level($level, $id_artist, $page, $offset)
    {
        $data = $this->db->select('u.id,u.email,l.id as ID_level,l.status as Status')
            ->where('l.artist_id', $id_artist)
            ->where('l.level', $level)
            ->where('l.status!=', 0)
            ->limit($page, $offset)
            ->join('affiliates a', 'l.affiliate_id=a.affiliate_id')
            ->join('users u', 'a.user_id=u.id')
            ->get('affiliate_level l')->result();

        return $data;
    }
    public function count_list_level($level, $id_artist)
    {
        $num = $this->db
            ->where('l.artist_id', $id_artist)
            ->where('l.level', $level)
            ->where('l.status!=', 0)
            ->get('affiliate_level l')->num_rows();

        return $num;
    }
    public function new_affiliates($artist_id, $per_page, $page)
    {
        return $this->db->select('u.id,u.email,lv.level as LEVEL,lv.id as ID_level')
            ->where('lv.artist_id', $artist_id)
            ->where('lv.status', 0)
            ->join('affiliates a', 'lv.affiliate_id = a.affiliate_id')
            ->join('users u', 'u.id = a.user_id')
            ->limit($per_page, $page)
            ->get('affiliate_level lv')->result();
    }
    public function count_level_new($id_artist)
    {
        $num = $this->db
            ->where('lv.artist_id', $id_artist)
            ->where('lv.status', 0)
            ->get('affiliate_level lv')->num_rows();

        return $num;
    }
    public function check_lock_amp($id_affiliate, $id_artist)
    {
        $data = $this->db->select()
            ->where('artist_id', $id_artist)
            ->where('affiliate_id', $id_affiliate)
            ->get('affiliate_level ')->row();
        if (isset($data)) {
            if ($data->status == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    /**
     * return array sub affiliate.
     **/
    public function get_array_sub_affiliate($affiliateID_parent)
    {
        $data_list = $this->db
            ->where('parrent_id', $affiliateID_parent)
            ->get('conect_affiliates')->result();
        $array_res = array();
        foreach ($data_list as $row) {
            $array_res[] = $row->affiliate_id;
        }

        return $array_res;
    }
    /**
     * @param  level
     * @param  affiliate ID parent
     * return array id sub affiliate
     **/
    public function get_affiliate_level($level, $affiliateID_parent)
    {
        switch ($level) {
            case 1:
                $data_level = $this->db
                    ->where('affiliate_1', $affiliateID_parent)
                    ->where('status', 1)
                    ->get('affiliate_level')->result();
                break;
            case 2:
                $data_level = $this->db
                    ->where('affiliate_2', $affiliateID_parent)
                    ->where('status', 1)
                    ->get('affiliate_level')->result();
                break;
            case 3:
                $data_level = $this->db
                    ->where('affiliate_3', $affiliateID_parent)
                    ->where('status', 1)
                    ->get('affiliate_level')->result();
                break;
            case 4:
                $data_level = $this->db
                    ->where('affiliate_4', $affiliateID_parent)
                    ->where('status', 1)
                    ->get('affiliate_level')->result();
                break;
            default:
                $data_level = null;
        }
        $response = array();
        foreach ($data_level as $row) {
            $response[] = $data_level->affiliate_id;
        }
        if (empty($response)) {
            $response = array(0);
        }

        return $response;
    }
    /**
     * @param  level
     * @param  affiliate ID parent
     * return array id user sub affiliate
     **/
    public function get_affiliate_sub_user($level, $affiliateID_parent)
    {
        switch ($level) {
            case 1:
                $data_level = $this->db
                    ->where('affiliate_1', $affiliateID_parent)
                    ->where('status', 1)
                    ->get('affiliate_level')->result();
                break;
            case 2:
                $data_level = $this->db
                    ->where('affiliate_2', $affiliateID_parent)
                    ->where('status', 1)
                    ->get('affiliate_level')->result();
                break;
            case 3:
                $data_level = $this->db
                    ->where('affiliate_3', $affiliateID_parent)
                    ->where('status', 1)
                    ->get('affiliate_level')->result();
                break;
            case 4:
                $data_level = $this->db
                    ->where('affiliate_4', $affiliateID_parent)
                    ->where('status', 1)
                    ->get('affiliate_level')->result();
                break;
            default:
                $data_level = null;
        }
        $response = array();
        foreach ($data_level as $row) {
            $response[] = self::get_id_user($data_level->affiliate_id);
        }
        if (empty($response)) {
            $response = array(0);
        }

        return $response;
    }
    /**
     * @param  int 
     * return total num rows history chat
     **/
    public function total_chat($id_user)
    {
        $res = $this->db
            ->where('receiver', $id_user)
            ->or_where('user_id', $id_user)
            ->group_by('user_id,receiver')
            ->get('messages')->num_rows();

        return $res;
    }
    /**
     * recent chat.
     *
     * @param  int
     * @param  int
     * @param  int
     *
     * @return array
     **/
    public function get_recent_chat($id_user, $page = 0, $offset = 12)
    {
        $res = $this->db->select('user_id,receiver,time')
            ->select_max('time', 'max_time')
            ->where('receiver', $id_user)
            ->or_where('user_id', $id_user)
            ->limit($page, $offset)
            ->order_by('max_time', 'DESC')
            ->group_by('user_id,receiver', true)
            ->get('messages')->result();
        $receiver = $result = array();
        foreach ($res as $row) {
            if (!in_array($row->receiver, $receiver)) {
                $result[] = $row;
            }
            $receiver[] = $row->user_id;
        }

        return $result;
    }
    /**
     * total chat num rows stats unread.
     *
     * @param  int
     * @param  int
     *
     * @return array
     **/
    public function total_chat_unread($id_user, $receiver)
    {
        $res = $this->db
            ->where('receiver', $receiver)
            ->where('user_id', $id_user)
            ->where('status', 'unread')
            ->get('messages')->num_rows();

        return $res;
    }


    public function get_connected_affilates_user_id($artist_id)
    {
        $artist_affiliates_id = $this->get_affilaite_id($artist_id);
        $allaffiliatesdata = $this->db->select('affiliate_id')->where("parrent_id", $artist_affiliates_id)->get("conect_affiliates")->result_array();
        $result = array();
        foreach ($allaffiliatesdata as $key => $value) {
            $result[] =  $this->db->where("affiliate_id", $value['affiliate_id'])->get("affiliates")->row()->user_id;
        }
        return $result;
    }
}
