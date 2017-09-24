<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_photo');
        $this->load->model('M_user');
        $this->load->model('M_notify');
        $this->load->model('M_text');
        $this->load->model('M_affiliate');
        
        $this->load->model('M_channel');
        if ($this->session->userdata('loged_in') == false) {
            redirect('account/login');
        }
        $ac = $this->session->userdata('access');
      
         $data['redirect_url']=$this->curPageURL();
        if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }
        $this->U_map = $this->session->userdata('U_map');
    }
      public function curPageURL() {
 $pageURL = 'http';
 if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) {
    $pageURL .= "s";
}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
 
}
    /**
     * View Dashboard chat.
     *
     * @return response
     */
    public function index()
    {
        $data['data_search'] = $this->session->tempdata('data_search');
        $this->session->unset_tempdata('data_search');
        $data['user_data'] = $this->session->userdata('user_data');
        $data['avata'] = $this->M_user->get_avata($data['user_data']['id']);
        $data['friends'] = $this->M_user->friends($data['user_data']['id']);
        $data['groups'] = $this->M_user->groups($data['user_data']['id']);
        $data['invite_contacts'] = $this->M_user->invite_contact($data['user_data']['id'], 0);
        $data['U_map'] = $this->U_map;
        $data['recent_chat'] = $this->M_affiliate->get_recent_chat($data['user_data']['id']);
        $data['public_channels'] = $this->M_channel->get_all_public_channels();
        $data['tour_channels'] = $this->M_channel->get_private_channel_user_id($data['user_data']['id'], 'tour');
        $data['band_channel'] = $this->M_channel->get_private_channel_user_id($data['user_data']['id'], 'band');
        $data['affiliates_channel'] = $this->M_channel->check_artist_affiliates_channel($data['user_data']['id'], 'affiliates');
        $data['list_artist'] = $this->M_affiliate->get_list_artist($data['U_map']['affiliate_id'], 12, 0);
        $data['list_level_1'] = $this->M_affiliate->get_list_level(1, $data['user_data']['id'], 12, 0);
        $data['list_level_2'] = $this->M_affiliate->get_list_level(2, $data['user_data']['id'], 12, 0);
        $data['list_level_3'] = $this->M_affiliate->get_list_level(3, $data['user_data']['id'], 12, 0);
        $data['list_level_4'] = $this->M_affiliate->get_list_level(4, $data['user_data']['id'], 12, 0);
        $data['list_chat']    = $this->M_affiliate->get_recent_chat($data['user_data']['id']);
        
        $get_affilate = $this->M_affiliate->get_affilaite_id($data['user_data']['id']);
        
        $data['dataChannel1'] = $this->M_channel->get_affilaiate($data['user_data']['id'], 1);
        
        $data['dataChannel2'] = $this->M_channel->get_affilaiate($data['user_data']['id'], 2);
        $data['dataChannel3'] = $this->M_channel->get_affilaiate($data['user_data']['id'], 3);
        $data['dataChannel4'] = $this->M_channel->get_affilaiate($data['user_data']['id'], 4);
        
        $datareturn = array();
        
        $this->load->view('includes/header', $data); 
        $this->load->view('includes/navbar', $data);
        // $this->load->view('chat/chatmanager', $data);
        $this->load->view('chat/new_chat', $data);
        $this->load->view('includes/footer', $data);
    }

    public function get_all_public_channels()
    {
        $data = $this->M_channel->get_all_public_channels();
        echo json_encode($data);
    }

    public function get_all_tours($user_id)
    {

        $data =$this->M_channel->get_private_channel_user_id($user_id, 'tour');
        echo json_encode($data);
    }

    /**
     * Search users chat.
     *
     * @return response
     */
    public function search()
    {
        $user_id = $this->session->userdata('loged_in');
        $key = $this->input->post('key');

        $reponse = $this->M_user->search_chat($user_id, $key);
        $html = '<table>';
        foreach ($reponse as $key => $value) {
            $name = $this->M_user->get_name($value['id']);
            $email = $value['email'];
            if($value['role'] == 1)
            {

                $avata = $this->M_user->get_avata($value['id']);
                $type = "Artist";
            }
            else{
                $avata = $this->M_user->get_avata_flp($value['id']);
                $type = "Fan";
            }
            $html .= '<tr style="border-bottom:2px solid rgba(0, 149, 255, 0.52);">
                            <td>
                            <img class="img-circle" height="40" width="40" src="'.$avata.'">
                            </td>
                            <td><span class="name">'.$name.'</span>&nbsp;('.$type.')&nbsp;<br/>'.$email.'<input type="hidden" name="id" id="id" value="'.$value['id'].'" /><input type="hidden" name="id" id="name_invite" value="'.$name.'" /></td>
                            <td><a href="#" class="link-effect link-effect-2" data-toggle="modal" data-target="#invite-contact"><span data-hover="Add to Contacts" onclick=set_value("'.$name.'","'.$value['id'].'")>Add to Contacts</span></a></td>
                            
                        </tr>';
           // $html .=   '<div class="show" >
           //          <img src="'.$avata.'" style="width:50px; height:50px; margin-right:6px;" /><span class="name">'.$name.'</span>&nbsp;('.$type.')&nbsp;<br/>'.$email.'<input type="hidden" name="id" id="id" value="'.$value['id'].'" /><input type="hidden" name="id" id="name_invite" value="'.$name.'" /><a href="#" class="link-effect link-effect-2" data-toggle="modal" data-target="#invite-contact"><span data-hover="Add to Contacts" onclick=set_value("'.$name.'","'.$value['id'].'")>Add to Contacts</span></a><br/></div>';

             // $html .=   '<div class="col-md-12">
             //                   <div class="col-md-3">
             //                     <img src="'.$avata.'" width="30" height="30" class="img-circle">
             //                   </div>
             //                   <div class="col-md-9">
             //                    <div class="col-md-6">
             //                      <span>'.$name.'</span>('.$type.')
             //                      <p>'.$email.'</p><input type="hidden" name="id" id="id" value="'.$value['id'].'" /><input type="hidden" name="id" id="name_invite" value="'.$name.'" />
             //                    </div>
             //                      <div class="col-md-6">
             //                        <a href="#" class="link-effect link-effect-2" data-toggle="modal" data-target="#invite-contact"><span data-hover="Add to Contacts" onclick=set_value("'.$name.'","'.$value['id'].'")>Add to Contacts</span></a>
             //                      </div>
                                  
             //                   </div>
             //                </div>';
        }
        $html .= '</table>';
        echo json_encode($html);
        // $this->session->set_tempdata('data_search', $reponse);
        // redirect('chat/dashboard');
    }
    /**
     * Accept invite Add friend.
     *
     * @return response
     */
    public function addfriend()
    {
        $id_invite = $this->input->post('id_invite');
        if (!empty($id_invite)) {
            $data_invite = $this->db->where('id', $id_invite)
                ->get('invite_contact')->row_array();
            $datafriend = $this->db->where('user_id1', $data_invite['user_invite'])
                ->where('user_id2', $data_invite['user_to'])
                ->get('friends')->row_array();
            if (isset($datafriend)) {
                $insertArr = array(
                    'user_id1' => $data_invite['user_invite'],
                    'user_id2' => $data_invite['user_to'],
                    'status' => 1,
                    'date' => time(),
                );
                $this->db->update('friends', $insertArr, 'id='.$datafriend['id']);
                //delete table invite_contact
                $this->db->where('id', $id_invite)->delete('invite_contact');
                $name_user_to = $this->M_user->get_name($data_invite['user_to']);
                $messages = 'You have a contact new. '.$name_user_to.' accepted invite';
                $this->M_notify->addnotify($data_invite['user_invite'], $messages, 'invite');
                $this->session->set_flashdata('message_msg', 'add contact complete');
                redirect('chat/dashboard');
            }
        }
        $this->session->set_flashdata('message_error', 'Add contact error');
        redirect('chat/dashboard');
    }
    /**
     * Delete invite.
     *
     * @return response
     */
    public function deleteinvite()
    {
        $id_invite = $this->input->post('id_invite');
        if (!empty($id_invite)) {
            $this->db->delete('invite_contact', 'id='.$id_invite);
            $this->session->set_flashdata('message_error', 'Delete invite successfully');
            redirect('chat/dashboard');
        }
        $this->session->set_flashdata('message_error', 'Delete invite error');
        redirect('chat/dashboard');
    }
    /**
     * send invite contact.
     *
     * @return response
     */
    public function invite_contact()
    {
        $user_invite = $this->input->post('user_invite');
        $user_to = $this->input->post('user_to');
        $messages = $this->input->post('messages_invite');
        if (isset($user_invite) && isset($user_to) && $user_invite != $user_to) {
            $datafriend = $this->db->where('user_id1', $user_invite)
                ->where('user_id2', $user_to)
                ->get('friends')->row_array();
            //check isset contact
            if (empty($datafriend)) {
                $insertArr = array(
                    'user_invite' => $user_invite,
                    'user_to' => $user_to,
                    'status' => 0,
                    'messages' => $messages,
                    'time' => time(),
                );
                $this->db->insert('invite_contact', $insertArr);
                $messages = 'You have a invite add contacts';
                $this->M_notify->addnotify($user_to, $messages, 'invite');
                //insert data friend 
                $insertArr = array(
                    'user_id1' => $user_invite,
                    'user_id2' => $user_to,
                    'status' => 0,
                    'date' => time(),
                );
                $this->db->insert('friends', $insertArr);
                $this->session->set_flashdata('message_msg', 'You invite add contact completed');
                redirect('chat/dashboard');
            }
        }
        $this->session->set_flashdata('message_error', 'You invite add contact error');
        redirect('chat/dashboard');
    }
    /**
     * End contact chat.
     *
     * @param int $id
     *
     * @return response
     */
    public function endcontact($id)
    {
        $user_id = $this->session->userdata('loged_in');
        if (isset($id)) {
            $data_contact = $this->db
                ->group_start()->where('user_id1', $user_id)->where('user_id2', $id)->group_end()
                ->or_where('(user_id2', $user_id)->where('user_id2', $id)->group_end()
                ->get('friends')->result_array();
            if (isset($data_contact)) {
                foreach ($data_contact as $row) {
                    $this->db->where('id', $row['id'])->delete('friends');
                }
                $this->session->set_flashdata('message_msg', 'end contact completed');
                redirect('chat/dashboard');
            }
        }
        $this->session->set_flashdata('message_error', 'end contact error');
        redirect('chat/dashboard');
    }
    /**
     * Add group chat.
     *
     * @return response
     */
    public function addgroup()
    {
        $user_id = $this->session->userdata('loged_in');
        $this->load->library('upload');
        $name = $this->input->post('name');
        $members = $this->input->post('members');
        $members[] = $user_id;
        if (isset($name) && isset($members)) {
            if (!empty($_FILES['avata']['name'])) {
                $this->upload->initialize($this->config());
                if (!$this->upload->do_upload('avata')) {
                    $data['update_error'] = $this->upload->display_errors();
                    $this->session->set_flashdata('message_error', $data['update_error']);
                    redirect('chat/dashboard');
                } else {
                    $datafile = $this->upload->data();
                    $insertArr = array(
                        'name' => $name,
                        'time' => time(),
                        'avata' => $datafile['file_name'],
                        'key_user' => $user_id,
                    );
                    $this->db->insert('groups_chat', $insertArr);
                    $id_group = $this->db->insert_id();
                    foreach ($members as $row) {
                        $insertArr = array(
                            'group_id' => $id_group,
                            'time' => time(),
                            'member_id' => $row,
                        );
                        $this->db->insert('user_group', $insertArr);
                    }
                }
            } else {
                $insertArr = array(
                    'name' => $name,
                    'time' => time(),
                    'avata' => 'default-img.gif',
                    'key_user' => $user_id,
                );
                $this->db->insert('groups_chat', $insertArr);
                $id_group = $this->db->insert_id();
                foreach ($members as $row) {
                    $insertArr = array(
                        'group_id' => $id_group,
                        'time' => time(),
                        'member_id' => $row,
                    );
                    $this->db->insert(' user_group', $insertArr);
                }
            }
            $this->session->set_flashdata('message_msg', 'add new group completed');
            redirect('chat/dashboard');
        }
        $this->session->set_flashdata('message_error', 'add new group error!');
        redirect('chat/dashboard');
    }
    /**
     * Edit group.
     *
     * @param int $id
     */
    public function editgroup()
    {
        $user_id = $this->session->userdata('loged_in');
        $this->load->library('upload');
        $name = $this->input->post('name');
        $members = $this->input->post('members');
        $group_id = $this->input->post('id_group');
        $members[] = $user_id;
        if (isset($name) && isset($members)) {
            if (!empty($_FILES['avata']['name'])) {
                $this->upload->initialize($this->config());
                if (!$this->upload->do_upload('avata')) {
                    $data['update_error'] = $this->upload->display_errors();
                    $this->session->set_flashdata('message_error', $data['update_error']);
                    redirect('chat/dashboard');
                } else {
                    $datafile = $this->upload->data();
                    $upload_path = './uploads/groups/avata/';
                    $result = $this->db->where('id', $group_id)
                        ->get('groups_chat')->row_array();
                    $filename = $result['avata'];
                    unlink($upload_path.$filename);
                    $updatetArr = array(
                        'name' => $name,
                        'avata' => $datafile['file_name'],
                    );
                    $this->db->update('groups_chat', $updatetArr, 'id='.$group_id);
                    $member_old = $this->M_user->member_group($group_id);
                    foreach ($members as $row) {
                        if (!in_array($row, $member_old)) {
                            $updatetArr = array(
                                'group_id' => $group_id,
                                'time' => time(),
                                'member_id' => $row,
                            );
                            $this->db->insert('user_group', $insertArr);
                        }
                    }
                    $member_new = $this->M_user->member_group($group_id);
                    foreach ($member_new as $row) {
                        if (!in_array($row, $members)) {
                            $this->db->where('member_id', $row)
                                ->delete('user_group');
                        }
                    }
                }
            } else {
                $updatetArr = array(
                    'name' => $name,
                );
                $this->db->update('groups_chat', $updatetArr, 'id='.$group_id);
                $member_old = $this->M_user->member_group($group_id);
                foreach ($members as $row) {
                    if (!in_array($row, $member_old)) {
                        $updatetArr = array(
                            'group_id' => $group_id,
                            'time' => time(),
                            'member_id' => $row,
                        );
                        $this->db->insert('user_group', $updatetArr);
                    }
                }
                $member_new = $this->M_user->member_group($group_id);
                foreach ($member_new as $row) {
                    if (!in_array($row, $members)) {
                        $this->db->where('member_id', $row)
                            ->delete('user_group');
                    }
                }
            }
            $this->session->set_flashdata('message_msg', 'Edit group successfully');
            redirect('chat/dashboard');
        }
        $this->session->set_flashdata('message_error', 'Edit group error');
        redirect('chat/dashboard');
    }
    /**
     * Delete group.
     */
    public function delgroup()
    {
        $id = $this->input->post('id');

        if (isset($id)) {
            $upload_path = './uploads/groups/avata/';
            $result = $this->db->where('id', $id)
                ->get('groups_chat')->row_array();
            $filename = $result['avata'];
            unlink($upload_path.$filename);
            $member = $this->M_user->member_group($id);
            foreach ($member as $row) {
                $this->db->where('member_id', $row)
                    ->delete('user_group');
            }
            $this->db->where('id', $id)
                ->delete('groups_chat');
            $this->session->set_flashdata('message_msg', 'Delete group successfully');
            redirect('chat/dashboard');
        }
        $this->session->set_flashdata('message_error', 'Edit group successfully');
        redirect('chat/dashboard');
    }
    /**
     * Config upload iamge groups.
     */
    public function config()
    {
        $loged_in = $this->session->userdata('loged_in');
        $config = array();
        $config['upload_path'] = './uploads/groups/avata/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        } else {
            chmod($config['upload_path'], 0777);
        }
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '8000';
        $config['max_width'] = '2000';
        $config['max_height'] = '1080';
        $config['file_name'] = uniqid();

        return $config;
    }
     /**
      * Ajax load recent chat.
      **/
     public function load_recent_chat()
     {
         $page = $this->input->post('page');
         $user_id = $this->session->userdata('loged_in');
         $data = $this->M_affiliate->get_recent_chat($user_id, $page, 12);
         $res = array();
         foreach ($data as $row) {
             if ($user_id == $row->receiver) {
                 $num_unread = $this->M_affiliate->total_chat_unread($row->user_id, $row->receiver);
                 if ($num_unread > 0) {
                     $badge = '<span class="badge bg-lightred">'.$num_unread.'</span>';
                 } else {
                     $badge = '';
                 }
                 $res[] =
                '<li>'.
                    '<a href="#" class="load_iframe">'.
                    '<input type="hidden" name="link_iframe" value="'.base_url().'chat/'.$row->user_id.'" />'.
                    '<div class="media">'.
                            '<div class="media-left thumb thumb-sm">'.
                                '<img class="media-object img-circle" src="'.$this->M_user->get_avata($row->user_id).'">'.
                            '</div>'.
                            '<div class="media-body">'.
                                '<p class="media-heading">'.
                                    '<span class="text-strong">'.$this->M_user->get_name($row->user_id).'</span>'.
                                    $badge.
                                    '<small class="text-muted pull-right">'.time_calculation($row->max_time).'</small>'.
                                '</p>'.
                            '</div>'.
                        '</div>'.
                    '</a>'.
                '</li>';
             } else {
                 $res[] =
                '<li>'.
                    '<a href="#" class="load_iframe">'.
                    '<input type="hidden" name="link_iframe" value="'.base_url().'chat/'.$row->receiver.'" />'.
                    '<div class="media">'.
                            '<div class="media-left thumb thumb-sm">'.
                                '<img class="media-object img-circle" src="'.$this->M_user->get_avata($row->receiver).'">'.
                            '</div>'.
                            '<div class="media-body">'.
                                '<p class="media-heading">'.
                                    '<span class="text-strong">'.$this->M_user->get_name($row->receiver).'</span>'.
                                    '<small class="text-muted pull-right">'.time_calculation($row->max_time).'</small>'.
                                '</p>'.
                            '</div>'.
                        '</div>'.
                    '</a>'.
                '</li>';
             }
         }
         if (count($res)) {
             echo json_encode($res);
         } else {
             header('HTTP/1.1 500 ');
         }
     }
}
