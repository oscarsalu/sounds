<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Photos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_photo');
        $this->load->model('M_user');
        $this->load->model('M_text');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
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
     * Upload new photo.
     **/
    public function uploadphoto()
    {
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('caption', 'caption', 'trim|required');
        $this->form_validation->set_rules('check', 'check', 'required');
        $user_id = $this->session->userdata('loged_in');
        $data = array();
        if (!empty($_FILES['photo']['name'])) {
            if ($this->form_validation->run() != false) {
                $this->upload->initialize($this->config());
                if (!$this->upload->do_upload('photo')) {
                    $data['update_error'] = $this->upload->display_errors();
                    echo $data['update_error'];

                    return 0;
                } else {
                    $datafile = $this->upload->data();
                    $caption = $this->input->post('caption');
                    $updateArr = array(
                        'filename' => $datafile['file_name'],
                        'user_id' => $user_id,
                        'caption' => $caption,
                    );
                    $this->db->insert('photos', $updateArr);
                }
            }
        }
        redirect('artist/profile');
    }
    /**
     * New Photo.
     **/
    public function newphoto()
    {
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('caption', 'caption', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('check', 'check', 'required');
        $user_id = $this->session->userdata('loged_in');
        $data = array();

        if (!empty($_FILES['photo']['name'])) {
            if ($this->form_validation->run() != false) {
                $this->upload->initialize($this->config());
                if (!$this->upload->do_upload('photo')) {
                    $data['update_error'] = $this->upload->display_errors();
                    echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                    echo  '<h4><strong>Error!</strong></h4>';
                    echo  '<p> '.$data['update_error'].'</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_error', $data['update_error']);
                    die;
                } else {
                    $datafile = $this->upload->data();
                    $caption = $this->input->post('caption');
                    $updateArr = array(
                        'filename' => $datafile['file_name'],
                        'user_id' => $user_id,
                        'caption' => strip_tags($caption, '<p><b>'),
                    );
                    $this->db->insert('photos', $updateArr);
                    echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                    echo  '<h4><strong>Succces!</strong></h4>';
                    echo  '<p> Upload photo completed</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_msg', 'Photo uploaded successfully');
                }
            }
        } else {
            $this->session->set_flashdata('message_error', 'error');
        }
    }
    /**
     * Config upload image.
     **/
    public function config()
    {
        $loged_in = $this->session->userdata('loged_in');
        $config = array();
        $config['upload_path'] = './uploads/'.$loged_in.'/photo/';
        
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
     * View Manager photo.
     **/
    public function manager()
    {
        $admin = $this->session->userdata('is_admin');
        if (isset($admin) && $admin == 1) {
            $data['is_admin'] = $admin;
        }
        $user_id = $this->session->userdata('loged_in');
        $data = array();
        $data['listphotos'] = $this->M_photo->getItemWithWhere('photos', array('user_id' => $user_id));
        $data['user_data'] = $this->session->userdata('user_data');
        $config['per_page'] = 100;
        $config['base_url'] = base_url().'artist/managerphoto/';
        $start = $this->input->get('per_page');
        if (empty($start)) {
            $start = 0;
        }
        $config['use_page_numbers'] = FALSE;
        //$config['page_query_string']  = FALSE;
        //$config['query_string_segment'] = 'per_page';
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->db->get_where('photos', array('user_id' => $user_id))->num_rows();
        $this->load->library('pagination', $config);
        $this->pagination->initialize($config);
     
      
   $data['listphoto'] = $this->db->limit($config['per_page'], $start)->order_by("id", "asc")->where( array('user_id' => $user_id))->get('photos');     
 $data['listphoto'] = $this->db->limit($config['per_page'], $start)->order_by("id", "asc")->where( array('user_id' => $user_id))->get('photos')->result() ;
   //print "SQL Query: ".$this->db->last_query();
               /*
        $this->load->library('pagination'); 
        $config['total_rows'] 		= 	$this->db->get('photos')->num_rows();
        $config['per_page'] 		= 	3;  
        $config['uri_segment'] = 2;  
        $offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0; 
        $config['base_url']			= 	base_url().'artist/managerphoto';
        $this->pagination->initialize($config);  	
        $data['listphoto']	
                * 		= 	$this->M_photo->GetBooks($config['per_page'] , $offset);*/
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/listphoto', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * Update photo.
     **/
    public function update($id)
    {
        if (isset($id)) {
            $this->load->library('form_validation');
            $this->load->library('upload');
            $this->form_validation->set_rules('caption', 'caption', 'trim|required');

            if ($this->form_validation->run() != false) {
                $caption = $this->input->post('caption');
                if(!empty ($_FILES['photo']['name'])){
               $this->upload->initialize($this->config());
                if (!$this->upload->do_upload('photo')) {
                    $data['update_error'] = $this->upload->display_errors();
                    echo  '<div class="alert alert-big alert-lightred alert-dismissable fade in">';
                    echo  '<h4><strong>Error!</strong></h4>';
                    echo  '<p> '.$data['update_error'].'</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_error', $data['update_error']);
                    die;
                } else {
                    $datafile = $this->upload->data();
                   $photo= $datafile['file_name'];
                    echo  '<div class="alert alert-big alert-success alert-dismissable fade in">';
                    echo  '<h4><strong>Succces!</strong></h4>';
                    echo  '<p> Upload photo completed</p>';
                    echo  '</div>';
                    $this->session->set_flashdata('message_msg', 'Upload photo completed');
                }
            }
                if(empty ($_FILES['photo']['name'])){
                   $photo=$this->input->post('image');
               }
              
                $updateArr = array('caption' => $caption,'filename'=>$photo);
                $this->M_photo->updateWhere('photos', $updateArr, array('id' => $id));
                $this->session->set_flashdata('message_msg', ' Photo Update Completed');
            } else {
                $this->session->set_flashdata('message_error', validation_errors());
            }
if(!empty($this->input->post('url'))){ redirect($this->input->post('url')); } else {
            redirect('artist/managerphoto');
        }
    }
    }
    /**
     * Delete photo.
     **/
    public function delete($id)
    {
        if (isset($id)) {
            $user_id = $this->session->userdata('loged_in');
            $data_photo = $this->M_photo->get_photo($id);
            if (isset($data_photo)) {
                $upload_path = './uploads/'.$user_id.'/img_playlist/';
                unlink($upload_path.$data_photo->filename);
                $this->M_photo->deleteWhere($id);
                $this->session->set_flashdata('message_msg', ' Delete photo completed');
            } else {
                $this->session->set_flashdata('message_error', 'Can not delete photo!');
            }
            redirect('artist/managerphoto');
        }
    }
    /**
     * Ajax loaf data photo.
     *
     * @return json
     **/
    public function load_data_photo()
    {
        $id_photo = $this->input->post('id_photo');
        $data_photo = $this->M_photo->get_photo($id_photo);
        if (isset($data_photo)) {
            echo json_encode($data_photo);
            die;
        } else {
            header('HTTP/1.1 500 data bad');
            die;
        }
    }
}
