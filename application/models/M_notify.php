<?php

class M_notify extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Add new notification.
     *
     * @param int    $user_id
     * @param string $messages
     * @param string $type
     *
     * @return bool
     **/
    public function addnotify($user_id, $messages, $type)
    {
        $insertArr = array(
            'user_id' => $user_id,
            'messages' => $messages,
            'is_read' => '0',
            'time' => time(),
            'type' => $type,
            'active_url'=>''
        );
        $this->db->insert('notifications', $insertArr);

        return true;
    }
    /**
     * Update read notification.
     *
     * @param int $user_id
     *
     * @return bool
     **/
    public function readnotify($user_id)
    {
        $notify = $this->db->where('user_id', $user_id)
            ->get('notifications')->result_array();
        foreach ($notify as $row) {
            $updateArr = array('is_read' => '1');
            $this->db->update('notifications', $updateArr, 'id='.$row['id']);
        }

        return true;
    }
    /**
     * Get notification.
     *
     * @param int $user_id
     * @param int $read
     *
     * @return array $notifications
     **/
    public function getnotify($user_id, $read = null)
    {
        $this->db->where('user_id', $user_id);
        if (!empty($read)) {
            $this->db->where('is_read', $read);
        } else {
            $this->db->limit(12);
        }
        $this->db->order_by('time', 'desc');
        $query = $this->db->get('notifications')->result_array();

        return $query;
    }
    /**
     * count notification.
     *
     * @param int $user_id
     * @param int $read
     *
     * @return array $notifications
     **/
    public function num_notices($user_id)
    {
        $this->db->where('user_id', $user_id);
        $num = $this->db->get('notifications')->num_rows();

        return $num;
    }
    /**
     * Get list all  notification.
     *
     * @param int $user_id
     * @param int $page
     * @param int $offset
     *
     * @return array $notifications
     **/
    public function get_all_notifications($user_id, $page, $offset)
    {
        return $this->db->where('user_id', $user_id)
        ->limit($page, $offset)->order_by('id', 'desc')
        ->get('notifications')->result();
    }
    /**
     * delete   notification
    */
    public function remove_notifications($notice_id)
    {
        $this->db->where('id', $notice_id);
        $this->db->delete('notifications');
    }

    public function get_all_notifications_by_type($user_id, $page, $offset, $type)
    {
        $data = $this->db->where('user_id', $user_id)->where('type', $type)->order_by('id', 'desc')->limit($page, $offset)->get('notifications')->result();
        return $data;
        
    }

    public function updadtereadnotify($user_id, $notification_id)
    {
        $status = $this->db->select("is_read")->where('id', $notification_id)->get('notifications')->row_array();
        if($status['is_read'] == '1')
        {
            $state = '0';
        }else
        {
            $state = '1';
        }
        $updateArr = array('is_read' => $state);
        return $status = $this->db->update('notifications', $updateArr, 'id='.$notification_id);
        
    }

    public function get_notify_by_type($user_id, $read = null)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('is_read', $read);
        $this->db->order_by('time', 'desc');
        $query = $this->db->get('notifications')->result_array();
        
        return $query;
    }

    public function get_notify_count($user_id, $read = null, $type)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('is_read', $read);
        $this->db->order_by('time', 'desc')->where('type', $type);
        $query = $this->db->get('notifications')->num_rows();
        return $query;
    }
}
