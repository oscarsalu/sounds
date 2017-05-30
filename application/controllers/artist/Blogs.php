
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blogs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_photo');
        $this->load->model('M_user');
        $this->load->model('M_blog');
        $this->load->model('M_text');
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
     * Post blog.
     **/
    public function addblogs()
    {
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'max_length[255]|required');
        $this->form_validation->set_rules('introduction', 'Introduction', 'max_length[1000]|required');
        $this->form_validation->set_rules('content', 'Content', 'max_length[1000]|required');//max_length[1000]|required
        $user_id = $this->session->userdata('loged_in');
        $data = array();
        if (!empty($_FILES['image_rep']['name'])) {
            $this->upload->initialize($this->config());
            if ($this->form_validation->run() != false) {
                if (!$this->upload->do_upload('image_rep')) {
                    $data['update_error'] = $this->upload->display_errors();
                    echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                    echo  '<h4><strong>Error!</strong></h4>';
                    echo  '<p> '.$data['update_error'].'</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_error', $data['update_error']);
                    die;
                } else {
                    $datafile = $this->upload->data();
                    $InsertArr = array(
                        'title' => strip_tags($this->input->post('title')),
                        'introduction' => strip_tags($this->input->post('introduction'), '<p><b>'),
                        'content' => $this->input->post('content'),
                        'time' => time(),
                        'user_id' => $user_id,
                        'image_rep' => $datafile['file_name'],
                        'type' => 'Artist',
                    );
                    $this->db->insert('blogs', $InsertArr);
                    echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                    echo  '<h4><strong>Success!</strong></h4>';
                    echo  '<p> Post blog completed</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_msg', ' Post blog completed');
                }
            }
        } else {
            $this->session->set_flashdata('message_error', 'error');
        }
        redirect('artist/profile');
    }
    /**
     * post blog.
     **/
    public function addnewblogs()
    {
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'max_length[255]|required');
        $this->form_validation->set_rules('introduction', 'Introduction', 'max_length[255]|required');
        $this->form_validation->set_rules('content', 'Content', 'max_length[255]|required');
        $user_id = $this->session->userdata('loged_in');
        $data = array();
        if (!empty($_FILES['image_rep']['name'])) {
            $this->upload->initialize($this->config());
            if ($this->form_validation->run() != false) {
                if (!$this->upload->do_upload('image_rep')) {
                    $data['update_error'] = $this->upload->display_errors();
                    echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                    echo  '<h4><strong>Error!</strong></h4>';
                    echo  '<p> '.$data['update_error'].'</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_error', $data['update_error']);
                    die;
                } else {
                    $datafile = $this->upload->data();
                    $updateArr = array(
                        'title' => $this->input->post('title'),
                        'introduction' => $this->input->post('introduction'),
                        'content' => $this->input->post('content'),
                        'time' => time(),
                        'user_id' => $user_id,
                        'image_rep' => $datafile['file_name'],
                        'type' => 'Artist',
                    );
                    $this->db->insert('blogs', $updateArr);
                    echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                    echo  '<h4><strong>Success!</strong></h4>';
                    echo  '<p> Post blog completed</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_msg', ' Post blog completed');
                }
            }
        } else {
            $this->session->set_flashdata('message_error', validation_errors());
        }
        redirect('artist/blogsmanager');
    }
    /**
     * Config upload image blog.
     **/
    public function config()
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
        //$config['max_width']  = '2000';
        //$config['max_height']  = '1080';
        $config['file_name'] = uniqid();

        return $config;
    }
    /**
     * View all blogs.
     *
     * @param int $user_id
     * @param int $blog_id
     **/
    public function allblogs($user_id, $blog_id = null)
    {
        if (empty($blog_id)) {
            $data['listblogs'] = $this->db->where('user_id', $user_id)->where('blocked', 0)
                ->order_by('id', 'DESC')->get('blogs')->result_array();
            $data['blog_id'] = $user_id;
            $data['info_id'] = $user_id;
            $data['user_data'] = $this->session->userdata('user_data');
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('artist/allblogs', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $data['blog'] = $this->db->where('user_id', $user_id)
                                     ->where('id', $blog_id)
                                     ->where('blocked', 0)
                                     ->get('blogs')->result_array();
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('artist/blog', $data);
            $this->load->view('includes/footer', $data);
        }
    }
     /**
      * View Manager Blog.
      **/
     public function manager()
     {
         $user_id = $this->session->userdata('loged_in');
         $data['user_data'] = $this->session->userdata('user_data');
         $config['per_page'] = 12;
         $config['base_url'] = base_url().'artist/blogsmanager/';
         $start = $this->input->get('per_page');
         if (empty($start)) {
             $start = 0;
         }
         $config['uri_segment'] = 3;
         $config['total_rows'] = $this->db->get_where('blogs', array('user_id' => $user_id))->num_rows();
         $this->load->library('pagination', $config);
         $this->pagination->initialize($config);
         $data['listblogs'] = $this->db->limit($config['per_page'], $start)->get_where('blogs', array('user_id' => $user_id))->result_array();

         $this->load->view('includes/header', $data);
         $this->load->view('includes/navbar', $data);
         $this->load->view('artist/listblogs', $data);
         $this->load->view('includes/footer', $data);
     }
    /**
     * Edit blog.
     **/
    public function editblogs()
    {
        $user_id = $this->session->userdata('loged_in');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'max_length[255]|required');
        $this->form_validation->set_rules('introduction', 'Introduction', 'required|max_length[100]');
        $this->form_validation->set_rules('content', 'Content', 'required');
        if ($this->form_validation->run() != false) {
            $id = $this->input->post('id');
            $blog = $this->db->where('id', $id)->get('blogs')->row();
            if ($blog->user_id == $user_id) {
                $updateArr = array(
                    'title' => $this->input->post('title'),
                    'introduction' => $this->input->post('introduction'),
                    'content' => $this->input->post('content'),
                    'user_id' => $user_id,
                );
                $this->db->update('blogs', $updateArr, 'id ='.$id);
                $this->session->set_flashdata('message_msg', 'edit success blog');
            } else {
                $this->session->set_flashdata('message_error', 'can not edit this blog');
            }
        }
        redirect('artist/blogsmanager');
    }
    /**
     * Delete Blog.
     **/
    public function deleteblogs()
    {
        $user_id = $this->session->userdata('loged_in');
        $id = $this->input->post('id');
        if (isset($id)) {
            $blog = $this->db->where('id', $id)->get('blogs')->row();
            if ($blog->user_id == $user_id) {
                $this->db->where('id', $id)->delete('blogs');
                $this->session->set_flashdata('message_msg', 'edit success blog');
            } else {
                $this->session->set_flashdata('message_error', 'can not delete this blog');
            }
        }
        redirect('artist/blogsmanager');
    }
    /**
     * Comment Blog.
     **/
    public function comment()
    {
        $user_id = $this->session->userdata('loged_in');
        $id = $this->input->post('id');
        if (isset($id)) {
            $updateArr = array(
                'id_blog' => $id,
                'comment' => $this->input->post('comment'),
                'time' => time(),
                'user_id' => $user_id,
            );
            $this->db->insert('blogs_comment', $updateArr);
        }
        redirect('artist/allblogs/'.$user_id);
    }
     /**
      * View List Blog.
      **/
     public function list_blogs()
     {
         $config['base_url'] = base_url().'blogs';
         $config['per_page'] = 12;
         $config['total_rows'] = $this->M_blog->num_blogs_admin();
         $this->load->library('pagination', $config);
         $start = $this->input->get('per_page');
         if (empty($start)) {
             $start = 1;
         }
         $data['user_data'] = $this->session->userdata('user_data');
         $data['listblogs'] = $this->M_blog->list_blog_admin($config['per_page'], $start - 1);
         $data['allblogs'] = $this->M_blog->allblogs();
         $data['featured_post'] = $this->M_blog->featured_post();
         $data['most_popular'] = $this->M_blog->most_popular();
         $this->load->view('includes/header', $data);
         $this->load->view('includes/navbar', $data);
         $this->load->view('blogs/index', $data);
         $this->load->view('includes/footer', $data);
     }
    /**
     * View Blog 99sound.
     **/
    public function read_blog_admin($str)
    {
        $arr = explode('-', $str);
        $id = end($arr);
        $data['blog'] = $this->db->where('id', $id)->get('blogs')->row();
        $data['user_data'] = $this->session->userdata('user_data');
        $data['current_title'] = $str;
        if (isset($data['blog'])) {
            $CounterHits = $this->session->userdata('CounterHits_blog'.$id);
            if (!isset($CounterHits)) {
                $this->session->set_userdata('CounterHits_blog'.$id, true);
                $this->M_blog->Counter_hits($id);
            }
        }
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('blogs/read_more', $data);
        $this->load->view('includes/footer', $data);
    }
}
