<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Videos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_photo');
        $this->load->model('M_user');
        $this->load->model('M_video');
        if ($this->session->userdata('loged_in') == false) {
            redirect('account/login');
        } else {
            $id = $this->session->userdata('loged_in');
            $user_data = $this->db->where('id='.$id)->get('users')->row_array();
            if ($user_data['role'] != 1) {
                redirect('');
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
     * Upload video on dashboard profile.
     **/
    public function uploadvideo()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_video', 'Name', 'required|max_length[255]');
        $this->form_validation->set_rules('link_video', 'Link', 'required|max_length[255]');
        $user_id = $this->session->userdata('loged_in');
        $data = array();
        $userVedioCount = $this->db->where('user_id='.$user_id)->get('videos')->num_rows();
            
        if($userVedioCount <= 15)
        {
            if ($this->form_validation->run() != false) 
            {
            $post_link = $this->input->post('link_video');
            $parse = parse_url($post_link);
                $userVedioCount = $this->db->where('user_id='.$user_id)->get('videos')->num_rows();
                
              
            if ($parse['host'] == 'www.youtube.com') {
                $insertArr = array(
                    'name_video' => strip_tags($this->input->post('name_video')),
                    'link_video' => strip_tags($this->input->post('link_video')),
                    'user_id' => $user_id,
                    'type' => 'link',
                    'create_date' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('videos', $insertArr);
                    
                     $this->session->set_flashdata('message_msg', 'Upload video completed');
            }

        } else {
            $this->session->set_flashdata('message_error', validation_errors());
        }
        }
        else
        {
                 $this->session->set_flashdata('message_error', 'You�ve reached your max limit of 15 Videos for uploading');
        }
        redirect('artist/profile');
    }
    /**
     * Upload video on manager videos.
     **/
    public function upfile_video()
    {
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_video', 'Name', 'required|max_length[255]');
        $user_id = $this->session->userdata('loged_in');
        $returnCount = $this->set_upload_options();
        $userVedioCount = $this->db->where('user_id='.$user_id)->get('videos')->num_rows();

        if($userVedioCount < 25)
        {
        //var_dump($_FILES['filevideo']['name']);exit;
        if (!empty($_FILES['image_file']['name'])) {
            if ($this->form_validation->run() != false) {
                $this->upload->initialize($this->set_upload_options());
                if (!$this->upload->do_upload('image_file')) {
                    $data['update_error'] = $this->upload->display_errors();
                    echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                    echo  '<h4><strong>Error!</strong></h4>';
                    echo  '<p> '.$data['update_error'].'</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_error', $data['update_error']);
                } else {
                    $datafile = $this->upload->data();
                    $name_file_image = uniqid().'.png';
                    $path_cover_image = FCPATH.'uploads/'.$user_id.'/video/'.$name_file_image;
                    $cmd = '-i '.$datafile['full_path'].' -ss 00:00:03 -vframes 1 '.$path_cover_image;
                    $name = $this->input->post('name_video');
                    //ffmpeg -i input.flv -ss 00:00:14.435 -vframes 1 out.png
                    exec_ffmeg($cmd);
                    $insertArr = array(
                        'name_video' => $name,
                        'name_file' => $datafile['file_name'],
                        'user_id' => $user_id,
                        'type' => 'file',
                        'create_date' => date('Y-m-d H:i:s'),
                        'cover_image' => $name_file_image,
                    );
                    $this->db->insert('videos', $insertArr);
                    echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                    echo  '<h4><strong>Succces!</strong></h4>';
                    echo  '<p> Upload video completed</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_msg', ' Upload video completed');
                }
            } else {
                $this->session->set_flashdata('message_error', validation_errors());
            }
        }
        }else{
            $data['update_error'] = "You�ve reached your max limit of 15 Videos for uploading";
            echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
            echo  '<h4><strong>Error!</strong></h4>';
            echo  '<p> '.$data['update_error'].'</p>';
            echo  '</div>';
            // echo $data['update_error'];
    }
    }
    /**
     * Config upload videos.
     **/
    private function set_upload_options()
    {
        $loged_in = $this->session->userdata('loged_in');
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/'.$loged_in.'/video/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        } else {
            chmod($config['upload_path'], 0777);
        }
        $config['allowed_types'] = 'mp4|avi|mov|flv';
        $config['max_size'] = '150000';
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;
        $config['file_name'] = uniqid();

        return $config;
    }
    /**
     * Upload video on Manager video.
     **/
    public function addvideo()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_video', 'Name', 'required|max_length[255]');
        $this->form_validation->set_rules('link_video', 'Link', 'required|max_length[255]');
        $user_id = $this->session->userdata('loged_in');
        $data = array();
        $userVedioCount = $this->db->where('user_id='.$user_id)->get('videos')->num_rows();

        if($userVedioCount < 25)
        {
        if ($this->form_validation->run() != false) {
            $post_link = $this->input->post('link_video');
            $parse = parse_url($post_link);
               
            if ($parse['host'] == 'www.youtube.com') {
                $updateArr = array(
                    'name_video' => $this->input->post('name_video'),
                    'link_video' => $this->input->post('link_video'),
                    'user_id' => $user_id,
                    'type' => 'link',
                    'create_date' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('videos', $updateArr);
            }
            else if ($parse['host'] == 'vimeo.com' or $parse['host'] == 'www.vimeo.com') {
                $updateArr = array(
                    'name_video' => $this->input->post('name_video'),
                    'link_video' => $this->input->post('link_video'),
                    'user_id' => $user_id,
                    'type' => 'link-vimeo',
                    'create_date' => date('Y-m-d H:i:s'),
                );
                $this->db->insert('videos', $updateArr);
            }
        } else {
            $this->session->set_flashdata('message_error', validation_errors());
        }
        } else{
                 $this->session->set_flashdata('message_error', 'You�ve reached your max limit of 15 Videos for uploading');
            }
       redirect('artist/managervideo');
    }
    /**
     * View manager videos.
     **/
    public function manager()
    {
        $user_id = $this->session->userdata('loged_in');
        $data = array();
        $data['user_data'] = $this->session->userdata('user_data');
        $admin = $this->session->userdata('is_admin');
        if (isset($admin) && $admin == 1) {
            $data['is_admin'] = $admin;
        }

        $config['per_page'] = 12;
        $config['base_url'] = base_url().'artist/managervideo/';
        $start = $this->input->get('per_page');
        if (empty($start)) {
            $start = 0;
        }
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->db->get_where('videos', array('user_id' => $user_id))->num_rows();
        $this->load->library('pagination', $config);
        $this->pagination->initialize($config);
        $data['listvideo'] = $this->db->limit($config['per_page'], $start)->get_where('videos', array('user_id' => $user_id))->result_array();

        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/listvideo', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View all videos.
     *
     * @param int $user_id
     **/
    public function allvideos($user_id)
    {
        $data = array();
        // $data['listvideo'] = $this->db->where('user_id', $user_id)->order_by('id', 'DESC')->get('videos')->result_array();
        $data['info_id'] = $user_id;
        $data['user_data'] = $this->session->userdata('user_data');
        $admin = $this->session->userdata('is_admin');
        if (isset($admin) && $admin == 1) {
            $data['is_admin'] = $admin;
        }
        $config['per_page'] = 6;
        $config['base_url'] = base_url().'artist/allvideos/'.$user_id;
        $start = $this->input->get('per_page');
        if (empty($start)) {
            $start = 0;
        }
        $config['use_page_numbers'] = FALSE;
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->db->get_where('videos', array('user_id' => $user_id))->num_rows();
        $this->load->library('pagination', $config);
        $this->pagination->initialize($config);
        $data['listvideo'] = $this->db->limit($config['per_page'], $start)->get_where('videos', array('user_id' => $user_id))->result_array();

        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/allvideos', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * Edit video.
     **/
    public function editvideo()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name_video', 'Name', 'trim|required');
        if ($this->form_validation->run() != false) {
            $name = $this->input->post('name_video');
            $id = $this->input->post('id');
            $updateArr = array('name_video' => $name);
            $this->db->update('videos', $updateArr, 'id ='.$id);
            $this->session->set_flashdata('message_msg', 'Video Updated Successfully');
        } else {
            $this->session->set_flashdata('message_error', validation_errors());
        }
        redirect('artist/managervideo');
    }
    /**
     * Delete videos.
     **/
    public function deletevideo()
    {
        $user_data = $this->session->userdata('user_data');
        $id = $this->input->post('delete_id');
        $data = $this->db->where('id=', $id)->get('videos')->row_array();
        if ($data['user_id'] == $user_data['id']) {
            if ($data['type'] == 'file') {
                $this->db->delete('videos', array('id' => $id));
                $upload_path = './uploads/'.$data['user_id'].'/video/';
                unlink($upload_path.$data['name_file']);
                unlink($upload_path.$data['cover_image']);
                $this->session->set_flashdata('message_msg', 'Video Deleted successfully');
            } else {
                $this->db->delete('videos', array('id' => $id));
                $this->session->set_flashdata('message_msg', 'Video Deleted successfully');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Can not Delete video!');
        }
        redirect('artist/managervideo');
    }
}
