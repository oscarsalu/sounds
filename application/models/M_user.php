
<?php

class M_user extends CI_Model
{
    public function __construct()
    {

        // Call the Model constructor

        parent::__construct();
    }
    /**
     * @param int $user_id
     *
     * @return array
     **/
    public function get_genres($user_id)
    {
        return $this->db->where('id', $user_id)
            ->get('genres')->result_array();
    }
    /**
     * Get genre name by user_id.
     *
     * @param int $user_id
     *
     * @return string
     **/
    public function get_name_genre($user_id)
    {
        $genre = $this->db->select('genres.name')
            ->where('users.id', $user_id)
            ->join('genres', 'users.genre=genres.id')
            ->get('users')->row();
        if (!empty($genre)) {
            return ucfirst($genre->name);
        } else {
            return 'NULL';
        }
    }
    /**
     * Get city name by user_id.
     *
     * @param int $user_id
     *
     * @return string
     **/
    public function get_city($user_id)
    {
        $user = $this->db->select('city')
            ->where('id', $user_id)
            ->get('users')->row();
        if (!empty($user)) {
            return ucfirst($user->city);
        } else {
            return 'NULL';
        }
    }
    /**
     * Count event.
     *
     * @param int $user_id
     *
     * @return int
     **/
    public function num_events($user_id)
    {
        return $this->db->where('user_id', $user_id)
            ->count_all_results('events');
    }
    /**
     * Get user by homepage.
     *
     * @param int $homepage
     *
     * @return object
     **/
    public function get_user_by_homepage($homepage)
    {
        return  $this->db->where('home_page', $homepage)
            ->get('users')->row();
    }
    /**
     * Get style background.
     *
     * @param int $page
     * @param int $num
     *
     * @return string
     **/
    public function background($page, $num)
    {
        $results = $this->db->where('page_name', $page)->get('backgrounds')->result_array();
        $rs = $results[0]['background_'.$num];
        if ($rs == 'empty') {
            return 'background:#fff;';
        } elseif (strlen(strstr($rs, '_thumb')) == 0) {
            return 'background:'.$rs.';';
        } elseif (strlen(strstr($rs, '_thumb')) > 0) {
            return "background:url('".base_url().'uploads/'.$page.'/'.$rs."') #000 no-repeat;";
        }
    }
    /**
     * Get video background.
     *
     * @param int $page
     * @param int $num
     *
     * @return string
     **/
    public function background_videos($page, $num)
    {
        $results = $this->db->where('page_name', $page)->get('background_videos')->result_array();
        $rs = $results[0]['video_'.$num];
        if ($rs == 'empty') {
            return "<div style='background: #000;'></div>";
        } elseif (strlen(strstr($rs, '_vid')) == 0) {
            return "<div class='video-fade' style='background:".$rs.";'></div>";
        } elseif (strlen(strstr($rs, '_vid')) > 0) {
            return "<video id='my-video' poster='".base_url()."assets/images/bgvideo.jpg' preload='metadata' autoplay='' loop muted>                            
                 <source src='".base_url().'uploads/'.$page.'/videos/'.$rs."' type='video/mp4'>               
            </video>";
        }
    }
    /**
     * Check hash password and user email signin.
     *
     * @param int $page
     * @param int $num
     *
     * @return string
     **/
    public function signin_check($email, $password)
    {
        $user = $this->db->where('email', $email)
            ->get('users')->row_array();
        if (!empty($user)) {
            if (sha1($user['hash'].$password) == $user['password']) {
                return $user;
            }
        }

        return;
    }
    /**
     * Check isset email in table users.
     *
     * @param string $email
     *
     * @return object $users
     **/
    public function check_email_form($email)
    {
        $this->db->where('email', $email);

        return $this->db->get('users')->row_array();
    }
    /**
     * Check name artist.
     *
     * @param string $name
     *
     * @return object $users
     **/
    public function artist_name_check($name)
    {
        $this->db->where('artist_name', $name);

        return $this->db->get('users')->row_array();
    }
    /**
     * Check home page.
     *
     * @param string $name
     * @param  $user_id
     *
     * @return array $users
     **/
    public function home_page_check($name, $user_id)
    {
        $this->db->where('home_page', $name);

        return $this->db->get('users')->row_array();
    }
    /**
     * Get home page by $user_id.
     *
     * @param  $user_id
     *
     * @return string home page
     **/
    public function get_home_page($user_id)
    {
        $data = $this->db->select('home_page')->where('id', $user_id)->get('users')->row();
        if (!empty($data)) {
            return $data->home_page;
        } else {
            return 0;
        }
    }
    /**
     * Get URL ALP of user.
     *
     * @param  $user_id
     *
     * @return string $url_alp
     **/
    public function get_url_alp($user_id)
    {
        $data = $this->db->select('home_page')
            ->where('id', $user_id)->get('users')->row();
        if (!empty($data)) {
            return base_url('amp/'.$data->home_page);
        } else {
            return 0;
        }
    }
    /**
     * Check upgrade plan.
     *
     * @param  $user_id
     *
     * @return bool
     **/
    public function check_upgrade($id)
    {
        $data = $this->db->where('id_user', $id)->get('extrar_users')->num_rows();
        if ($data > 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Create new home page.
     *
     * @param string $str
     *
     * @return string $home_page
     **/
    public function create_homepage($str)
    {
        $row = $this->db->where('home_page', $str)->get('users')->row_array();
        if (empty($row)) {
            return $str;
            if (self::check_isset_homepage($str) == false) {
                return $str;
            } else {
                return self::create_homepage($str.rand(0, 9));
            }
        } else {
            return self::create_homepage($str.rand(0, 9));
        }
    }
    /**
     * Check isset home page.
     *
     * @param string $home_page
     *
     * @return bool
     **/
    public function check_isset_homepage($home_page)
    {
        $file = base_url().$home_page;
        $file_headers = @get_headers($file);

        if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {
            return false;
        } else {
            return true;
        }
    }
    /**
     * Get link avata image.
     *
     * @param int $user_id
     *
     * @return string $url
     **/
    public function get_avata($user_id)
    {
        $this->db->where('id', $user_id);
        $data_user = $this->db->get('users')->row_array();
        if($data_user)
        {
            if (empty($data_user['avata'])) {
            return base_url().'assets/images/user_default.gif';
            } else {
                return  base_url().'uploads/'.$user_id.'/photo/'.$data_user['avata'];
            }
        }else{
            return base_url().'assets/images/user_default.gif';
        }
    }
    /**
     * Get link cover image.
     *
     * @param int $user_id
     *
     * @return string $url
     **/
    public function get_cover($user_id)
    {
        $this->db->where('id', $user_id);
        $data_user = $this->db->get('users')->row_array();
        if (!empty($data_user['banner_image'])) {
            return  base_url().'uploads/'.$user_id.'/photo/banner/'.$data_user['banner_image'];
        }
    }
    /**
     * List Friend users.
     *
     * @param int    $user_id
     * @param string $status
     *
     * @return array $list_friend_id
     **/
    public function list_friends($id, $status = null)
    {
        if ($status != null) {
            $data_user = $this->db
            ->where('status', $status)
            ->group_start()
            ->where('user_id1', $id)
            ->or_where('user_id2', $id)
            ->group_end()
            ->get('friends')->result_array();
        } else {
            $this->db->where('user_id1', $id);
            $this->db->or_where('user_id2', $id);
            $data_user = $this->db->get('friends')->result_array();
        }

        $list_friend_id = array();
        foreach ($data_user as $row) {
            if ($row['user_id1'] == $id) {
                $list_friend_id[] = $row['user_id2'];
            } else {
                $list_friend_id[] = $row['user_id1'];
            }
        }
        if (count($list_friend_id) == 0) {
            $list_friend_id = 0;
        }

        return  $list_friend_id;
    }
    /**
     * Query search chat.
     *
     * @param int    $id
     * @param string $key
     *
     * @return array $data_user
     **/
    public function search_chat($id, $key)
    {
        $friends_id = self::list_friends($id);
        $data_user = $this->db
        ->group_start()
        ->like('artist_name', $key)
        ->or_like('fan_name', $key)
        ->or_like('email', $key)
        ->group_end()
        ->where('id!=', $id)
        ->where_not_in('id', $friends_id)
        ->get('users')->result_array();

        return  $data_user;
    }
    /**
     * my Friends.
     *
     * @param int    $id
     * @param string $key
     *
     * @return array $data_friend
     **/
    public function friends($id)
    {
        $friends_id = self::list_friends($id, 1);
        if (count($friends_id) == 0) {
            $data_user = $this->db
                ->where('id', 0)
                ->get('users')->result_array();

            return  $data_user;
        } else {
            $data_user = $this->db
                ->where_in('id', $friends_id)
                ->get('users')->result_array();

            return  $data_user;
        }
    }
    /**
     * Get Groups Chat.
     *
     * @param int    $id
     * @param string $key
     *
     * @return array $groups_chat
     **/
    public function groups($id)
    {
        $this->db->select('groups_chat.*,');
        $this->db->from('user_group');
        $this->db->join('groups_chat', 'groups_chat.id = user_group.group_id');
        $this->db->where('user_group.member_id', $id);
        $query = $this->db->get()->result_array();

        return  $query;
    }
    /**
     * Get Member group.
     *
     * @param int $group_id
     *
     * @return array $user_group
     **/
    public function member_group($id)
    {
        $this->db->select('member_id');
        $this->db->where('group_id', $id);
        $query = $this->db->get('user_group')->result_array();
        $result = array();
        foreach ($query as $val) {
            $result[] = $val['member_id'];
        }

        return  $result;
    }
    /**
     * Invite contact user chat.
     *
     * @param int    $group_id
     * @param string $status
     *
     * @return array $invite_contact
     **/
    public function invite_contact($id, $status)
    {
        $this->db->where('user_to', $id);
        $this->db->where('status', $status);
        $query = $this->db->get('invite_contact')->result_array();

        return  $query;
    }
    /**
     * Get name user.
     *
     * @param int $id_user
     *
     * @return string $name
     **/
    public function get_name($id)
    {
        $this->db->where('id', $id);
        $row = $this->db->get('users')->row_array();
        if ($row['role'] == 1) {
            return ucfirst($row['artist_name']);
        } elseif ($row['role'] == 2) {
            if (!empty($row['fan_name'])) {
                return ucfirst($row['fan_name']);
            } elseif (!empty($row['lastname'])) {
                return ucfirst($row['firstname']).' '.ucfirst($row['lastname']);
            } else {
                return 'NULL';
            }
        } else {
            return 'Anynamous';
        }
    }
    /**
     * Get Home page user.
     *
     * @param int $id_user
     *
     * @return string $home_page
     **/
    public function get_homepage($id)
    {
        $this->db->where('id', $id);
        $row = $this->db->get('users')->row_array();
        if ($row['role'] == 1) {
            return $row['home_page'];
        } else {
            return 'null';
        }
    }
    /**
     * Time calculation.
     *
     * @param time $timestamp
     *
     * @return string time
     **/
    public function time_calculation($timestamp)
    {
        $period = array(
            'second',
            'minute',
            'hour',
            'day',
            'week',
            'month',
            'year',
            'decade',
        );
        $periods = array(
            'seconds',
            'minutes',
            'hours',
            'days',
            'weeks',
            'months',
            'years',
            'decades',
        );

        $lengths = array(60, 60, 24, 7, 4.35, 12, 10);
        $timenow = date('Y-m-d H:i:s');
        $now = strtotime('now');
        $difference = $now - $timestamp;
        $tense = 'ago';
        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; ++$j) {
            $difference /= $lengths[$j];
        }
        $difference = round($difference);
        if ($difference != 1) {
            $per = $periods[$j];
        } else {
            $per = $period[$j];
        }

        $string_result = $difference.' '.$per.' ago';

        return $string_result;
    }
    /**
     * update password temp.
     *
     * @param string $temp_pass
     * @param email  $email
     **/
    public function temp_reset_password($temp_pass, $email)
    {
        $data = array('reset_pass' => $temp_pass);
        $this->db->where('email', $email);
        $this->db->update('users', $data);
    }
    /**
     * Check reset password.
     *
     * @param string $temp_pass
     * @param int    $user_id
     *
     * @return bool
     **/
    public function check_reset_password($temp_pass, $user_id)
    {
        $data = $this->db->where('id', $user_id)
            ->where('reset_pass', $temp_pass)
            ->get('users')->row_array();
        if (!empty($data)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Check subscription plan.
     *
     * @param int    $id_user
     * @param string $plan_code
     *
     * @return bool
     **/
    public function check_subscription($id_user, $plan_code = null)
    {
        if (isset($plan_code)) {
            $data_subscription = $this->db->where('id_user', $id_user)
            ->where('plan_code', $plan_code)
            ->where('zoho_status', 'live')
            ->get('extrar_users')->num_rows();
        } else {
            $data_subscription = $this->db->where('id_user', $id_user)
            ->where('zoho_status', 'live')
            ->get('extrar_users')->num_rows();
        }
        // demo onto localhost
        $whitelist = array('127.0.0.1', '::1');
        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            return true;
        }
        //onto live
        if ($data_subscription > 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Check subscription featured.
     *
     * @param int $id_user
     *
     * @return bool
     **/
    public function check_subscription_featured($id_user)
    {
        $data_subscription = $this->db
        ->where("id_user = '$id_user' 
            AND (plan_code = 'Artist_basic' OR plan_code = 'Artist_premium' OR plan_code = 'Featured_artist' ) 
            AND zoho_status != 'cancelled'")
        ->where('plan_code', 'Artist_basic')
        ->or_where('plan_code', 'Artist_premium')
        ->or_where('plan_code', 'Featured_artist')
        ->where('zoho_status!=', 'cancelled')
        ->get('extrar_users')->num_rows();
        // demo onto localhost
        $whitelist = array('127.0.0.1', '::1');
        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            return true;
        }
        //onto live
        if ($data_subscription > 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Check subscription artist basic.
     *
     * @param int $id_user
     *
     * @return bool
     **/
    public function check_subscription_artist_basic($id_user)
    {
        $data_subscription = $this->db->where('id_user', $id_user)
        ->where('plan_code', 'Artist_basic')
        ->where('zoho_status!=', 'cancelled')
        ->get('extrar_users')->num_rows();
        // demo onto localhost
        $whitelist = array('127.0.0.1', '::1');
        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            return true;
        }
        //onto live
        if ($data_subscription > 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Check subscription artist premium.
     *
     * @param int $id_user
     *
     * @return bool
     **/
    public function check_subscription_artist_premium($id_user)
    {
        $data_subscription = $this->db->where('id_user', $id_user)
        ->where('plan_code', 'Artist_premium')
        ->where('zoho_status!=', 'cancelled')
        ->get('extrar_users')->num_rows();
        // demo onto localhost
        $whitelist = array('127.0.0.1', '::1');
        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            return true;
        }

        if ($data_subscription > 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Counter hit stats FLP.
     *
     * @param int    $id_user
     * @param string $key_counter
     **/
    public function Counter_hits($id_user, $key_counter = 'flp')
    {
        $data_counter = $this->db->where('user_id', $id_user)->get('stats_counter')->row();
        if (empty($data_counter)) {
            $this->db->insert('stats_counter', array(
                'user_id' => $id_user,
                $key_counter => 1,
                'flp'=>'',
            ));
        } else {
            $counterHits = $data_counter->$key_counter + 1;
            $this->db->where('user_id', $id_user)->update('stats_counter', array($key_counter => $counterHits));
        }
    }
    /**
     * Check role.
     *
     * @param int $id_role
     * @param int $id_user
     * @param  bool
     **/
    public function check_role($id_role, $id_user)
    {
        $user = $this->db->where('id', $id_user)->get('users')->row();
        if ($user->is_admin == 1) {
            return true;
        } elseif ($user->is_admin == 0) {
            return false;
        } elseif ($user->is_admin == 2) {
            $admin_role = $this->db->where('user_id', $id_user)->where('role', $id_role)->get('admin_role')->num_rows();
            if ($admin_role > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
    /**
     * Get genre name.
     *
     * @param int    $genre_id
     * @param object $genre
     **/
    public function get_genre_name($genre_id)
    {
        $res = $this->db->where('id', $genre_id)->get('genres')->row();
        if (isset($res)) {
            return $res->name;
        } else {
            return 'null';
        }
    }
    /**
     * Check subscriptipn artist.
     *
     * @param int $user_id
     * @param  bool
     **/
    public function check_subscription_artist($user_id)
    {
        $user = $this->db->where('id', $user_id)->get('users')->row();
        $data_subscription = $this->db->where('id_user', $user_id)
        ->where('plan_code', 'Artist_basic')
        ->where('zoho_status!=', 'cancelled')
        ->get('extrar_users')->num_rows();
        // demo onto localhost
        $whitelist = array('127.0.0.1', '::1');
        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            return true;
        }
        if ($data_subscription > 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Check notification request on/off.
     *
     * @param int $user_id
     * @param  bool
     **/
    public function check_onoff_request($user_id)
    {
        $res = $this->db->select('onoff_request')->where('id', $user_id)->get('users')->row();
        if (isset($res)) {
            if ($res->onoff_request == '1') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    /**
     * Check notification sales on/off.
     *
     * @param int $user_id
     * @param  bool
     **/
    public function check_onoff_sales($user_id)
    {
        $res = $this->db->select('onoffsales')->where('id', $user_id)->get('users')->row();
        if (isset($res)) {
            if ($res->onoffsales == '1') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    /**
     * Check password.
     *
     * @param int    $id_user
     * @param string $password
     *
     * @return bool
     */
    public function check_password($id, $password)
    {
        $user = $this->db->where('id', $id)
            ->get('users')->row_array();
        if (!empty($user)) {
            if (sha1($user['hash'].$password) == $user['password']) {
                return true;
            }
        }

        return false;
    }
    /**
     * Update password.
     *
     * @param int    $id_user
     * @param string $password
     *
     * @return bool
     */
    public function update_password($password, $id)
    {
        $user = $this->db->where('id', $id)
            ->get('users')->row_array();
        if (!empty($user)) {
            $new_pass = sha1($user['hash'].$password);
            $this->db->update('users', array('password' => $new_pass), 'id='.$id);

            return true;
        }

        return false;
    }
    public function update_status($user, $id_session, $tour)
    {
        $data = array(
        'id_session' => $id_session,
        'status' => '1',
        'time' => time(),
        );
        $this->db->where('user_id', $user)
                 ->where('tour_id', $tour)
                 ->update('groups_chat_tour', $data);
    }
    public function delete_status($user, $id_session, $tour)
    {
        $data = array(
        'id_session' => $id_session,
        'status' => '0',
        'time' => time(),
        );
        $this->db->where('user_id', $user)
                 ->where('tour_id', $tour)
                 ->update('groups_chat_tour', $data);
    }
    
     public function get_avata_flp($user_id)
    {
        $this->db->where('id', $user_id);
        $data_user = $this->db->get('users')->row_array();
        if (empty($data_user['avata_flp'])) {
            return base_url().'assets/images/user_default.gif';
        } else {
            return  base_url().'uploads/'.$user_id.'/photo/'.$data_user['avata_flp'];
        }
    }

    public function get_user_role($user_id)
    {
        $this->db->where('id', $user_id);
        $this->db->select('role');
        $data_user = $this->db->get('users')->row();
        if($data_user)
        {
            return $data_user->role;
        }
        else
        {
            return "user not exists";
        }
        
    }


    public function check_tour_member($user_id)
    {
        $dataReturn = $this->db->where('gm.artist_id', $user_id)->from('groups_member as gm')->select('*')->where('ch.group_type', 'band')->join('channel as ch', 'ch.group_id = gm.artist_id')->get()->result_array();
        return $dataReturn;
        
    }
    //function to update user id's in table after registration for showing band group
    public function update_user_id($user_id, $email)
    {
        $this->db->where('email', $email)->update('invite_user', array('invited_to'=> $user_id, 'status'=>1));
        $this->db->where('email_member', $email)->update('groups_member', array('member_id'=> $user_id));
    }
}

