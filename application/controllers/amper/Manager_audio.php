<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manager_audio extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->model('M_user');
        $this->load->model('M_audio_song');
        $this->load->model('M_affiliate');
        $this->load->model('M_transaction');
        $this->load->helper('string');
        $ac = $this->session->userdata('access');
      
         $data['redirect_url']=$this->curPageURL();
        if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }
        $this->U_map = $this->session->userdata('U_map');
        $this->is_login();
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
    public $U_map;
    public function is_login()
    {
        $U_map = $this->U_map;
        $uers_data = $this->session->userdata('user_data');
        if ($this->input->is_ajax_request()) {
            if (!isset($U_map)) {
                $this->session->set_flashdata('message_error', '<b>Error</b>! You Not Login Account');
                redirect('account/login');
                die;
            }
        } else {
            if (!isset($U_map)) {
                header('HTTP/1.1 401 	Unauthorized');
                die;
            }
        }
    }
    /**
     * View manager audio.
     **/
    public function index()
    {
        $data['U_map'] = $this->U_map;
        $data['user_data'] = $this->db->get_where('users', array('id' => $this->U_map['user_id']))->row_array();
        $data['list_artists'] = $this->db->where('affiliate_id', $data['U_map']['affiliate_id'])
            ->get('affiliate_level')->result_array();
        $Data_AMPER = $this->db->where('affiliate_id', $data['U_map']['affiliate_id'])
            ->get('affiliates')->row();
        if (!empty($Data_AMPER)) {
            $data['tree_artist'] = array_unique(explode('-', $Data_AMPER->list_artist));
        } else {
            $data['tree_artist'] = array();
        }
        //$data['my_playlist'] = $this->db->where('user_id', $data['U_map']['user_id'])->get('playlist_amp')->result();

        $config['base_url'] = base_url().'amper/manager_audios';
        $config['per_page'] = 12;
        $config['total_rows'] = $this->M_audio_song->total_my_playlist_amp($data['U_map']['user_id']);
        $this->load->library('pagination', $config);
        $start = $this->input->get('per_page');
        if (empty($start)) {
            $start = 1;
        }
        $data['my_playlist'] = $this->M_audio_song->get_my_playlist_amp($data['U_map']['user_id'], $config['per_page'], $start - 1);
        
        $data['link_content'] = 'manager_audios.php';
        if ($this->input->is_ajax_request()) {
            // check if request comes from an ajax
            $this->load->view('amper/manager_audios', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('amper/dashboard_amper.php', $data);
            $this->load->view('includes/footer', $data);
        }
    }
    /**
     * Delete my playlist.
     **/
    public function delete_my_playlist($playlist_id)
    {
        $user_id = $this->U_map['user_id'];
        $data_playlist = $this->db->where('user_id', $user_id)->where('id', $playlist_id)->get('playlist_amp')->row();
        if (!empty($data_playlist)) {
            //delete songs
            $this->db->where('playlist_amp_id', $playlist_id)->delete('audio_amp');
            //delete playlist image
            $upload_path = './uploads/'.$user_id.'/img_playlist/';
            unlink($upload_path.$data_playlist->image_file);
            //delete data
            $this->db->where('id', $playlist_id)->delete('playlist_amp');
            //delete playlist option widget
            $option = $this->db->where('user_id', $user_id)->get('affiliates')->row()->option_widget;
            $data_json = json_decode($option);
            $option_data = array_filter(explode(',', $data_json->playlistAlbumIds));
            
            $new_string = '';
            foreach ($option_data as $val) {
                if ($playlist_id != $val) {
                    $new_string .= $val;
                    if (end($option_data) != $val) {
                        $new_string .= ',';
                    }
                }
            }
            $data_json->playlistAlbumIds = $new_string;
            $this->db->where('user_id', $user_id)->update('affiliates', array('option_widget' => json_encode($data_json)));
            $this->session->set_flashdata('message_msg', ' Delete playlist completed');
        } else {
            $this->session->set_flashdata('message_error', 'Can not delete playlist!');
        }
        redirect('amper/manager_audios');
    }
    /**
     * Edit Playlist.
     **/
    public function edit_album()
    {
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('playlist_name', 'playlist_name', 'required|max_length[200]');
        $this->form_validation->set_rules('desc', 'desc', 'max_length[1000]');
        $user_id = $this->session->userdata('loged_in');
        if ($this->form_validation->run() != false) {
            $id_playlist = $this->input->post('id_playlist');
            $updateArr = array(
                'name' => $this->input->post('playlist_name'),
                'decs' => $this->input->post('description'),
            );
            $this->db->where('id', $id_playlist)->update('playlist_amp', $updateArr);
            $post_songs_new = $this->input->post('songs');
            $arr_songs_new = explode(',', $post_songs_new);
            //delete data song old
            $this->db->where('playlist_amp_id', $id_playlist)->delete('audio_amp');
            //create new songs
            $data_song_new = $this->db->where_in('id', $arr_songs_new)->get('audio_song')->result();
            foreach ($data_song_new as $row) {
                $data_new = array(
                    'playlist_amp_id' => $id_playlist,
                    'audio_song_id' => $row->id,
                );
                $this->db->insert('audio_amp', $data_new);
            }
            $this->session->set_flashdata('message_msg', ' Edit playlist completed');
        }
        redirect('amper/manager_audios');
    }
    public function tree_json_edit($playlist_id)
    {
        //echo '[{"id":1,"text":"Root node","children":[{"id":2,"text":"Child node 1","children":true},{"id":3,"text":"Child node 2"}]}]';die;
        $user_id = $this->U_map['user_id'];
        $list_artists = $this->db->select('artist_id')
            ->where('affiliate_id', $this->U_map['affiliate_id'])
            ->get('affiliate_level')->result_array();
        $my_songs = $this->M_audio_song->get_my_song_amp($playlist_id);
        $tree_artist = array();
        foreach ($list_artists as $row) {
            $tree_artist[] = $row['artist_id'];
        }
        echo '[';
        foreach ($tree_artist as $artist => $val) {
            $list_albums = $this->M_audio_song->get_data_playlist($val);
            if (!empty($val)) {
                ?>
                    {
                        "text" : "<?=$this->M_user->get_name($val)?>",
                        "state" : { "opened" : true },
                        "children" : [
                        <?php
                        foreach ($list_albums as $albums) {
                            $songs = $this->M_audio_song->get_data_songs($albums['id']); ?>
                            {
                                "text" : "<?=$albums['name']?>",
                                "state" : { "opened" : true },
                                "children" : [
                                <?php
                                foreach ($songs as $song) {
                                    if (in_array($song['id'], $my_songs)) {
                                        $select_b = 'true';
                                    } else {
                                        $select_b = 'false';
                                    }
                                    if ($song['listened'] == 0) {
                                        $rating = 0;
                                    } else {
                                        $rating = $song['sales'] * 100 / $song['listened'];
                                    } ?>
                                    {
                                        "text" : "<?=$song['song_name'].'- Rating ('.$rating.'%)'?>",
                                        "state" : { "selected" : <?=$select_b?> },
                                        "icon" : "jstree-file",
                                        "id": "<?=$song['id']?>"
                                    }
                                    <?php if (end($songs) != $song) {
    echo ',';
}
                                } ?>
                                ]  
                            }
                            <?php if (end($list_albums) != $albums) {
    echo ',';
}
                        } ?> 
                        ]
                    }
                    <?php if (end($tree_artist) != $val) {
    echo ',';
}
            }
        }
        echo ']';
    }
    /**
     * Ajax get Data Playlist.
     **/
    public function get_data_playlist()
    {
        $playlist_id = $this->input->post('id_playlist');
        if (isset($playlist_id)) {
            $data = $this->db->where('id', $playlist_id)->get('playlist_amp')->row();
            echo json_encode($data);
        }
    }
}
