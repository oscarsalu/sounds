<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin_profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_photo');
        $this->load->model('M_audio_song');
        $this->load->model('M_blog');
        $this->load->model('M_video');
        $this->load->model('M_text');
        $this->load->model('M_comment');
        $this->load->model('M_fan');
        $this->load->model('Events_model');
        $this->load->model('M_genre');
        $this->load->model('M_find_location');
        $this->load->model('M_press');
        $this->load->model('M_groups_member');
        $this->load->model('M_album_song');
        $this->load->model('M_template_land');
        $this->load->model('M_premium_pack');
        if ($this->session->userdata('loged_in') == false) {
            redirect('account/login');
        } else {
            $id = $this->session->userdata('loged_in');
            $user_data = $this->db->where('id='.$id)->get('users')->row_array();
            if ($user_data['role'] != 1) {
                redirect('');
            } elseif ($user_data['plan_status'] == 0) {
                redirect('subscriptions/checkout/Artist_basic');
            }
        }
        $ac = $this->session->userdata('access');
      
         $data['redirect_url']=$this->curPageURL();
        if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }
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
     * View Artist landing page.
     **/
    public function index()
    {
        $user_id = $this->session->userdata('loged_in');
        $user = $this->session->userdata('user_data');

        $data['loged_in'] = $user_id;

        $id_ctry = $user['countries'];
        $id_genre = $user['genre'];

        $admin = $this->session->userdata('is_admin');
        if (isset($admin) && $admin == 1) {
            $data['is_admin'] = $admin;
        }
        $data['num_songs'] = $this->M_audio_song->num_songs($user_id);
        $data['num_videos'] = $this->M_video->num_videos($user_id);
        $data['num_events'] = $this->M_user->num_events($user_id);
        $data['num_blogs'] = $this->M_blog->num_blogs_artist($user_id);
        $data['num_comments'] = $this->M_comment->num_comments_alp($user_id);
        $data['num_fands'] = $this->M_fan->num_fans($user_id);

        $data['genre'] = $this->M_genre->get_genre($id_genre);
        $data['user_data'] = $user;
        $data['songs'] = $this->M_audio_song->list_songs_alp($user_id, 5);
        $data['videos'] = $this->M_video->list_videos_alp($user_id, 1);
        $data['photos'] = $this->M_photo->list_photos_alp($user_id, 3);
        $data['groups_member'] = $this->M_groups_member->list_member($user_id, 5);
        $data['press'] = $this->M_press->list_press_alp($user_id, 5);
        $data['blogs'] = $this->M_blog->get_blogs_less_artist($user_id);
        $data['photo'] = $this->M_photo->getPhotoProfile($user_id);
        $data['list_album'] = $this->M_album_song->list_albums($user_id);
        $users = $this->db->where('id', $user_id)->get('users')->result_array();
        $data['users'] = $users;
        
        $data['type_tpl'] = $users[0]['template_landing'];
        $data['comments'] = $this->M_comment->all_comment_alp($user_id, 0, 5);
        $data['fans'] = $this->M_fan->list_fan_alp($user_id, 8);
        $data['events'] = $this->Events_model->list_event_alp($user_id, 6);
        $data['pack'] = $this->M_premium_pack->get_pack($user_id);
        $data['landings'] = $this->M_template_land->data_landing();
        $data['avatar_position'] = $this->db->where('id', $user_id)->get('users')->row_array();
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/artist_admin', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View All songs.
     **/
    public function allsong($user_id)
    {
        $data = array();

        $admin = $this->session->userdata('is_admin');
        if (isset($admin) && $admin == 1) {
            $data['is_admin'] = $admin;
        }
        $data['var1'] = 654;
        $data['album_songs'] = $this->M_audio_song->get_data_playlist($user_id);
        $data['listsong'] = $this->db->where('user_id', $user_id)->get('audio_song')->result_array();
        $data['user_data'] = $this->session->userdata('user_data');
        $data['info_id'] = $user_id;
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/allsong', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * Add bio.
     **/
    public function addbio()
    {
        $user_id = $this->session->userdata('loged_in');
        $bio = strip_tags($this->input->post('bio'), '<p><b>');
        $updateArr = array('bio' => $bio);
        $this->db->update('users', $updateArr, 'id='.$user_id);
        //reset session user data
        $user_data = $this->db->where('id='.$user_id)->get('users')->row_array();
        $this->session->set_userdata('user_data', $user_data);
        redirect('artist/profile');
    }
    /**
     * View edit information artist.
     **/
    public function basic_info()
    {
        $admin = $this->session->userdata('is_admin');
        if (isset($admin) && $admin == 1) {
            $data['is_admin'] = $admin;
        }
        $user_id = $this->session->userdata('loged_in');
        $data = array();
        $data['genres'] = $this->db->get('genres')->result_array();
        $data['countries'] = $this->db->get('countries')->result_array();
        $data['listsong'] = $this->db->where('user_id', $user_id)->get('audio_song')->result_array();
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/basic_info', $data);
        $this->load->view('includes/footer', $data);
    }
     public function update_social(){
        $this->load->model('m_user');
        $user_id = $this->session->userdata('loged_in');
        $updateArr = array(
            'facebook_username' => $this->input->post('facebook'),
            'twitter_username'  => $this->input->post('twitter'),
            'instagram_username'=> $this->input->post('instagram'),
            'youtube_username'  => $this->input->post('youtube')
        );
        $this->db->update('users', $updateArr, 'id='.$user_id);
        //reset session user data
        $user_data = $this->db->where('id='.$user_id)->get('users')->row_array();

        $this->session->set_userdata('user_data', $user_data);
        redirect('artist/basic_info');

    }
    public function upadate_general()
    {
        $this->load->model('m_user');
        $user_id = $this->session->userdata('loged_in');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('artist_name', 'artist_name', 'required');
        $this->form_validation->set_rules('home_page', 'home_page', 'required|callback_home_page_check|alpha_numeric');
        if ($this->form_validation->run() != false) {
            $active_code = $this->input->post('active_since');
            $updateArr = array(
                'artist_name' => $this->input->post('artist_name'),
                'home_page' => $this->input->post('home_page'),
                'genre' => $this->input->post('genre'),
                'active_since' => strtotime($active_code),
            );
            $this->db->update('users', $updateArr, 'id='.$user_id);
            //reset session user data
            $user_data = $this->db->where('id='.$user_id)->get('users')->row_array();

            $this->session->set_userdata('user_data', $user_data);
            redirect('artist/basic_info');
        } else {
            $this->basic_info();
        }
    }
    public function change_password()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pass_current', 'Password current', 'trim|required');
        $this->form_validation->set_rules('pass_new', 'Password new', 'trim|required|matches[confirm_password]|max_length[32]');
        $this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required|md5|max_length[32]');
        if ($this->form_validation->run() != false) {
            $old_pass = $this->input->post('pass_current');
            $new_pass = $this->input->post('pass_new');
            $user_data = $this->session->userdata('user_data');
            $result = $this->M_user->check_password($user_data['id'], $old_pass);
            if ($result) {
                if ($this->M_user->update_password($new_pass, $user_data['id'])) {
                    $this->session->set_flashdata('message_msg', 'Your password changed success');
                } else {
                    $this->session->set_flashdata('message_error', 'Your password can not change');
                }
            } else {
                $this->session->set_flashdata('message_error', 'password current not correct');
            }
            $redrect = $this->input->post('redirect');
            redirect($redrect);
        } else {
            $this->session->set_flashdata('message_error', validation_errors());
            $this->basic_info();
        }
    }
    public function pass_check($str)
    {
        $this->load->library('form_validation');
        $user_data = $this->session->userdata('user_data');
        if ($user_data['password'] != $str) {
            $this->form_validation->set_message('pass_check', 'password is not correct');

            return false;
        } else {
            return true;
        }
    }
    public function home_page_check($str)
    {
        $user_data = $this->session->userdata('user_data');
        if ($user_data['home_page'] == $str) {
            return true;
        } else {
            $user_result = $this->m_user->home_page_check($str, $user_data['id']);
            if (!empty($user_result)) {
                $this->form_validation->set_message('home_page', 'The %s field can not be the word '.$str);

                return false;
            } else {
                return true;
            }
        }
    }
    /**
     * Update contact.
     **/
    public function upadate_contact()
    {
        $user_id = $this->session->userdata('loged_in');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('city', 'city', 'required|max_length[50]');
        $this->form_validation->set_rules('address', 'address', 'required|max_length[255]');
        $this->form_validation->set_rules('address2', 'address2', 'max_length[255]');
        $this->form_validation->set_rules('zipcode', 'zipcode', 'max_length[50]');
        $this->form_validation->set_rules('state', 'state', 'max_length[255]');
        $this->form_validation->set_rules('phone', 'phone', 'max_length[50]');
        $this->form_validation->set_rules('artist_email', 'artist_email', 'max_length[255]');
        $this->form_validation->set_rules('booking_info_email', 'booking_info_email', 'max_length[255]');
        $this->form_validation->set_rules('management_email', 'management_email', 'max_length[255]');
        $this->form_validation->set_rules('record_label', 'record_label', 'max_length[100]');

        if ($this->form_validation->run() != false) {
            $birthday = $this->input->post('birthday');
            $updateArr = array(
                'countries' => $this->input->post('countries'),
                'city' => $this->input->post('city'),
                'address' => $this->input->post('address'),
                'address2' => $this->input->post('address2'),
                'zipcode' => $this->input->post('zipcode'),
                'state' => $this->input->post('state'),
                'phone' => $this->input->post('phone'),
                'artist_email' => $this->input->post('artist_email'),
                'booking_info_email' => $this->input->post('booking_info_email'),
                'management_email' => $this->input->post('management_email'),
                'manager' => $this->input->post('manager'),
                'birthday' => strtotime($birthday),
            );
            $this->db->update('users', $updateArr, 'id='.$user_id);
            //reset session user data
            $user_data = $this->db->where('id='.$user_id)->get('users')->row_array();

            $this->session->set_userdata('user_data', $user_data);
            redirect('artist/basic_info');
        } else {
            $this->basic_info();
        }
    }
     
    /**
     * Get Bio
     */
    
    public function get_bio(){
        
        $admin = $this->session->userdata('is_admin');
        if (isset($admin) && $admin == 1) {
            $data['is_admin'] = $admin;
        }
        $user_id = $this->session->userdata('loged_in');
        $data = array();

        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/get_bio', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * Update bio.
     **/
    public function upadate_bio()
    {
        $user_id = $this->session->userdata('loged_in');
        $updateArr = array(
            'bio' => $this->input->post('bio'),
        );
        $this->db->update('users', $updateArr, 'id='.$user_id);
        //reset session user data
        $user_data = $this->db->where('id='.$user_id)->get('users')->row_array();
        $this->session->set_userdata('user_data', $user_data);
        redirect('artist/biomanager');
    }
    
     /**
     * Update Lyrics.
     **/
    public function update_lyric()
    {
        $user_id = $this->session->userdata('loged_in');
        $updateArr = array(
            'bio' => $this->input->post('bio'),
        );
        $this->db->update('users', $updateArr, 'id='.$user_id);
        //reset session user data
        $user_data = $this->db->where('id='.$user_id)->get('users')->row_array();
        $this->session->set_userdata('user_data', $user_data);
        redirect('artist/get_bio');
    }
    /**
     * Change landing page.
     **/
    public function changelayout()
    {
        $user_id = $this->session->userdata('loged_in');
        $type = $this->input->post('template_landing');
        if (isset($type)) {
            $updateArr = array('template_landing' => $type);
            $this->db->update('users', $updateArr, 'id='.$user_id);
            //reset session user data
            $user_data = $this->db->where('id='.$user_id)->get('users')->row_array();
            $this->session->set_userdata('user_data', $user_data);
            redirect('artist/profile');
        }
    }
    /**
     * Update banner iamge cover.
     **/
    public function updatebanner()
    {
        $user_data = $this->session->userdata('user_data');
        $user_id = $this->session->userdata('loged_in');
        $this->load->library('upload');
        if (!empty($_FILES['image_background']['name'])) {
            $this->upload->initialize($this->config());
            if (!$this->upload->do_upload('image_background')) {
                $data['update_error'] = $this->upload->display_errors();
                $this->session->set_flashdata('message_error', $data['update_error']);
            } else {
                $datafile = $this->upload->data();
                $updateArr = array(
                                    'banner_image' => $datafile['file_name'],
                                );
                $banner = $this->db->where('id', $user_id)->get('users')->result_array();

                if (!empty($banner[0]['banner_image'])) {
                    $file = FCPATH.'uploads/'.$user_id.'/photo/banner/'.$banner[0]['banner_image'];
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
                $this->db->update('users', $updateArr, 'id='.$user_id);
                $this->load->library('image_lib');
                $config = array();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './uploads/'.$user_id.'/photo/banner/'.$datafile['file_name'];
                $config['new_image'] = './uploads/'.$user_id.'/photo/banner/'.$datafile['file_name'];
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = true;
                $config['master_dim'] = 'width';
                $config['quality'] = '100';
                $config['width'] = 851;
                $config['height'] = 315;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                redirect('artist/profile');
            }
            redirect('artist/profile');
        }
    }
    /**
     * Config upload image cover banner.
     **/
    public function config()
    {
        $loged_in = $this->session->userdata('loged_in');
        $config = array();
        $config['upload_path'] = './uploads/'.$loged_in.'/photo/banner/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        } else {
            chmod($config['upload_path'], 0777);
        }
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '8000';
        $config['max_width'] = '2000';
        $config['max_height'] = '1000';
        $config['file_name'] = uniqid();

        return $config;
    }
    /**
     * create new status.
     **/
    public function newstatus()
    {
        $user_id = $this->session->userdata('loged_in');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('status', 'status', 'required|max_length[1000]');

        if ($this->form_validation->run() != false) {
            $updateArr = array(
                                'status' => strip_tags($this->input->post('status'), '<p><b>'),
                            );
            $this->db->update('users', $updateArr, 'id='.$user_id);
        } else {
            $this->session->set_flashdata('message_error', validation_errors());
        }
        redirect('artist/profile');
    }
    /**
     * add comment.
     **/
    public function addcomment()
    {
        $user_id = $this->session->userdata('loged_in');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('comment', 'comment', 'required|max_length[1000]');
        if ($this->form_validation->run() != false) {
            $insertArr = array(
                    'user_id' => $user_id,
                    'client' => $user_id,
                    'comment' => strip_tags($this->input->post('comment'), '<p><b>'),
                    'approve' => 1,
                    'type' => 'ALP',
                    'time' => time(),
                );
            $this->db->insert('comments', $insertArr);
        } else {
            $this->session->set_flashdata('message_error', validation_errors());
        }

        redirect('artist/profile');
    }
    /**
     * all comment.
     *
     * @param int $id_user
     **/
    public function allcomment($id)
    {
        $admin = $this->session->userdata('is_admin');
        if (isset($admin) && $admin == 1) {
            $data['is_admin'] = $admin;
        }
        $data['comments'] = $this->db->select('*')
            ->from('comments')
            ->where('comments.user_id', $id)
            ->where('comments.type', 'ALP')
            ->order_by('comments.id', 'DESC')->get()->result_array();
        $data['user_data'] = $this->session->userdata('user_data');
        $data['info_id'] = $id;
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/all_comment', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View Manager comment.
     **/
    public function managercomment()
    {
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] = $this->session->userdata('user_data');
        $config['per_page'] = 12;
        $config['base_url'] = base_url().'artist/manager-comment';
        $start = $this->input->get('per_page');
        if (empty($start)) {
            $start = 0;
        }
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->db->get_where('comments', array('user_id' => $user_id, 'type' => 'ALP'))->num_rows();
        $this->load->library('pagination', $config);
        $this->pagination->initialize($config);
        $data['comments'] = $this->db->limit($config['per_page'], $start)->get_where('comments', array('user_id' => $user_id, 'type' => 'ALP'))->result_array();

        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/manager_comment', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * Delete comment.
     *
     * @param int $id_user
     **/
    public function deletecomment($id)
    {
        if (isset($id)) {
            $this->deleteWhere($id, 'comments');
            redirect('artist/profile');
        }
    }
    /**
     * deleteWhere.
     **/
    public function deleteWhere($id, $table)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);

        return true;
    }
    /**
     * all fans.
     **/
    public function allfans($id)
    {
        $admin = $this->session->userdata('is_admin');
        if (isset($admin) && $admin == 1) {
            $data['is_admin'] = $admin;
        }
        $data['fans'] = $this->db->select('*,fans.user_id')
                        ->from('fans')
                        ->where('fans.user_id', $id)
                        ->get()->result_array();
        $data['info_id'] = $id;
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/all_fans', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * Delete fan.
     **/
    public function deletefan($id)
    {
        if (isset($id)) {
            $this->deletefanWhere($id, 'fans');
            redirect('artist/profile');
        }
    }
    public function deletefanWhere($id, $table)
    {
        $this->db->where('fan_id', $id);
        $this->db->delete($table);

        return true;
    }
    
    public function set_draggable_avatar(){
        $this->input->post('x');
        $this->input->post('y');
       $user_id = $this->session->userdata('loged_in');
       $data=array('avatar_position_x'=>$this->input->post('x'),'avatar_position_y'=>$this->input->post('y'));
        $this->db->where(array('id'=>$user_id))->update('users',$data);
        echo json_encode($data);
    }
    
    public function update_about(){
        $firstname=$this->input->post('firstname');
        $lastname=$this->input->post('lastname');
        $name=$firstname." ".$lastname;
        $genre=$this->input->post('genre');
        $city=$this->input->post('city');
        $country=$this->input->post('country');
        $data=array('artist_name'=>$name,'genre'=>$genre,'city'=>$city,'countries'=>$country);
        $id = $this->session->userdata('loged_in');
        $update=$this->db->where('id='.$id)->update('users',$data);
        $user_data = $this->db->where('id='.$id)->get('users')->row_array();
                $this->session->set_userdata('user_data', $user_data);
                redirect('artist/profile');
    }
}

