<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_manager_chat extends CI_Model {
    
    function __construct(){
        parent::__construct();
    }
    
    public function all_spam($per_page,$start){
        $keywords = $this->db->get('chat_keyword')->result_array();
        $this->db->where('accept',0);
        if(!empty($keywords)){
            $this->db->group_start();
            foreach($keywords as $key){
                $this->db->or_like('messages', $key['keyword']);                                            
            }
            $this->db->group_end();    
        }
        $blog_spam = $this->db->limit($per_page,$start)->order_by('time', 'DESC')->get('messages_channel')->result_array();
        return $blog_spam; 
    }
    public function num_spam_chat(){
        $keywords = $this->db->get('chat_keyword')->result_array(); 
        $this->db->where('accept',0);
        if(!empty($keywords)){
            $this->db->group_start();
            foreach($keywords as $key){
                $this->db->or_like('messages', $key['keyword']);                                            
            }
            $this->db->group_end();    
        }
        return $this->db->get('messages_channel')->num_rows();
    }
    public function read_message_current($id_message){
        return $this->db->where('id',$id_message)->get('messages_channel')->row();
    }
    public function read_message_before($id_message,$limit){
        $current = self::read_message_current($id_message);
        $res_array =  $this->db->where('id <',$id_message)
            ->where('channel',$current->channel)
            ->limit($limit)
            ->order_by('time', 'DESC')
            ->get('messages_channel')->result_array();
        arsort($res_array,SORT_NUMERIC );
        $res_oject = array();
        foreach($res_array as $row){
            $res_oject[] = (object)$row;
        }
        return $res_oject;
    }
    public function read_message_last($id_message,$limit){
        $current = self::read_message_current($id_message);
        $res =  $this->db->where('id >',$id_message)
            ->where('channel',$current->channel)
            ->limit($limit)
            ->order_by('time', 'ASC')
            ->get('messages_channel')->result();
        return $res;
    }
    public function users_report($per_page,$start){
        $data = $this->db->where('num_down_chat >',0)
            ->where('lock',0)
            ->order_by('num_down_chat',"DESC")
            ->limit($per_page,$start)
            ->get('users')->result();
        return $data;
    }
    public function num_users_report(){
        $data = $this->db->where('num_down_chat >',0)
            ->where('lock',0)
            ->get('users')->num_rows();
        return $data;
    }
    public function get_keyword(){
        $results = $this->db->get('chat_keyword')->result_array();
        $html = ' ';
        $i = 1;
        foreach($results as $result)
        {  
            $html .= "<tr>
                         <th style='vertical-align: middle;' scope='row'>".$i."</th>
                         <td style='vertical-align: middle;'><input class='form-control' type='text' name='key_' id='key_' value='".$result['keyword']."'></td>
                         <td style='vertical-align: middle;'>
                             <a class='update_key btn btn-primary btn-sm'><i class='fa fa-check'></i></span></a>
                             <a class='delete_key btn btn-danger btn-sm'><i class='fa fa-close'></i></span></a>
                         </td>
                         <input type='hidden' id='id_key' value='".$result['id']."'>
                     </tr>"; 
            $i++;                                                     
        }
        return $html;
    }
    public function delete_mesage($id){
        
        $message = $this->db->where('id',$id)->get('messages_channel')->row();
        if(isset($message)){
            $notiArr = array(
                'user_id'  => $message->user_id,
                'is_read'  => '0', 
                'messages' => $this->input->post('message'),
                'time'     => time(),                     
            );
            $this->db->insert('notifications',$notiArr);
            $user_chat = $this->db->where('id',$message->user_id)->get("users")->row();
            if(isset($user_chat)){
                 $this->db->where('id',$user_chat->id)->update('users',array(
                    'num_down_chat'=> $user_chat->num_down_chat + 1
                )); 
            }
            $this->db->where('id',$id)->delete('messages_channel');     
        }
    }


    
}    