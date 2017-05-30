<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blogs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->model('M_user');
        $this->load->model('M_audio_song');
        $this->load->model('M_affiliate');
        $this->load->model('M_blog');
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
     * View blogs amper.
     **/
    public function index()
    {
        $data['U_map'] = $this->U_map;
        $data['blogs'] = $this->M_blog->get_blogs_all_amper($data['U_map']['user_id']);
        $data['link_content'] = 'blog.php';
        if ($this->input->is_ajax_request()) {
            // check if request comes from an ajax
            $this->load->view('amper/blog.php', $data);
        } else {
            $data['user_data'] = $this->db->get_where('users', array('id' => $this->U_map['user_id']))->row_array();
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('amper/dashboard_amper.php', $data);
            $this->load->view('includes/footer', $data);
        }
    }
    /**
     * Post new blog.
     **/
    public function upload_blog()
    {
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');
        $this->form_validation->set_rules('introduction', 'introduction', 'required');
        if (!empty($_FILES['image_rep']['name'])) {
            if ($this->form_validation->run() != false) {
                $this->upload->initialize($this->config());
                if (!$this->upload->do_upload('image_rep')) {
                    $this->session->set_flashdata('message_error', $data['update_error']);
                    die;
                } else {
                    $datafile = $this->upload->data();
                    $user_id = $this->session->userdata('loged_in');
                    $insertArr = array(
                        'title' => $this->input->post('title'),
                        'content' => $this->input->post('content'),
                        'introduction' => $this->input->post('introduction'),
                        'image_rep' => $datafile['file_name'],
                        'user_id' => $user_id,
                        'time' => strtotime('now'),
                        'type' => 'Amper',
                    );
                    $this->db->insert('blogs', $insertArr);
                    $this->session->set_flashdata('message_msg', ' Post blog completed');
                }
            } else {
                $this->session->set_flashdata('message_error', $this->form_validation->error_string());
            }
        } else {
            $this->session->set_flashdata('message_error', 'required image blog');
        }
        redirect('amper/blog');
    }
    /**
     * config upload image blog.
     **/
    private function config()
    {
        $loged_in = $this->session->userdata('loged_in');
        $config = array();
        $config['upload_path'] = './uploads/'.$loged_in.'/photo/blogs/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        } else {
            chmod($config['upload_path'], 0777);
        }
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '80000';
        $config['file_name'] = uniqid();

        return $config;
    }
    /**
     * delete blog.
     **/
    public function blog_delete($id_blog)
    {
        $data['U_map'] = $this->U_map;
        $data_blog = $this->db->where('id', $id_blog)->where('user_id', $this->U_map['user_id'])->get('blogs')->row();
        if (!empty($data_blog)) {
            $this->db->where('id', $id_blog)->delete('blogs');
        }
        $this->index();
    }
    /**
     * View read  blog.
     **/
    public function blog_read($id_blog)
    {
        $data['U_map'] = $this->U_map;
        $data['blog'] = $this->db->where('id', $id_blog)->where('user_id', $this->U_map['user_id'])->get('blogs')->row();
        if (!empty($data['blog'])) {
            $this->load->view('amper/read_blog.php', $data);
        }
    }
    /**
     * Edit blog.
     **/
    public function blog_edit()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');
        $this->form_validation->set_rules('introduction', 'introduction', 'required');
        $this->form_validation->set_rules('id', 'id', 'required');
        if ($this->form_validation->run() != false) {
            $user_id = $this->U_map['user_id'];
            $id_blog = $this->input->post('id');
            $data['blog'] = $this->db->where('id', $id_blog)->where('user_id', $user_id)->get('blogs')->row();
            if (!empty($data['blog'])) {
                $updateArr = array(
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'introduction' => $this->input->post('introduction'),
                );
                $this->db->where('id', $id_blog)->update('blogs', $updateArr);
            }
            $this->index();
        }
    }
    /**
     * view 
     * show all comment on FLP.
     **/
    public function allblogs($home_page)
    {
        $data['user_current'] = $this->M_user->get_user_by_homepage($home_page);
        if (!empty($data['user_current'])) {
            $config['per_page'] = 12;
            $config['base_url'] = base_url().'amper/allblogs/'.$home_page;
            $start = $this->input->get('per_page');
            if (empty($start)) {
                $start = 0;
            }
            $config['total_rows'] = $this->M_blog->num_blogs_amper($data['user_current']->id);
            $this->load->library('pagination', $config);
            $this->pagination->initialize($config);
            $data['listblogs'] = $this->M_blog->get_blogs_all_amper($data['user_current']->id, $start, $config['per_page']);
            $data['homepage'] = $home_page;
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('amper/allblogs', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->session->set_flashdata('message_error', 'can not find data'.$home_page);
            redirect();
        }
    }
}
