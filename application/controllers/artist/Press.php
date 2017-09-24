<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Press extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_photo');
        $this->load->model('M_user');
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
     * create new press on profile dasboard.
     **/
    public function addpress()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('quote', 'quote', 'required|max_length[1000]');
        $this->form_validation->set_rules('name', 'name', 'required|max_length[255]');
        $this->form_validation->set_rules('author', 'author', 'max_length[255]');
        $this->form_validation->set_rules('date_on', 'date_on', 'max_length[255]');
        $this->form_validation->set_rules('link', 'link', 'max_length[255]');
        $user_id = $this->session->userdata('loged_in');
        $data = array();

        if ($this->form_validation->run() != false) {
            $updateArr = array(
                'quote' => strip_tags($this->input->post('quote'), '<p><b>'),
                'name' => strip_tags($this->input->post('name')),
                'author' => strip_tags($this->input->post('author')),
                'date_on' => $this->input->post('date_on'),
                'link' => strip_tags($this->input->post('link')),
                'artist_id' => $user_id,
            );
            $this->db->insert('press', $updateArr);
            redirect('artist/managerpress');
        } else {
            //var_dump(form_error('quote'));exit;

                $this->session->set_flashdata('message_error', validation_errors());
        }
        redirect('artist/profile');
    }
    /**
     * create new press on manager press.
     **/
    public function addnewpress()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('quote', 'quote', 'required|max_length[1000]');
        $this->form_validation->set_rules('name', 'name', 'required|max_length[255]');
        $this->form_validation->set_rules('author', 'author', 'max_length[255]');
        $this->form_validation->set_rules('date_on', 'date_on', 'max_length[255]');
        $this->form_validation->set_rules('link', 'link', 'max_length[255]');
        $user_id = $this->session->userdata('loged_in');
        $data = array();
        if ($this->form_validation->run() != false) {
            $updateArr = array(
                'quote' => $this->input->post('quote'),
                'name' => $this->input->post('name'),
                'author' => $this->input->post('author'),
                'date_on' => $this->input->post('date_on'),
                'link' => $this->input->post('link'),
                'artist_id' => $user_id,
            );
            $this->db->insert('press', $updateArr);
        } else {
            $this->session->set_flashdata('message_error', validation_errors());
        }
        redirect('artist/managerpress');
    }
    /**
     * create new press.
     **/
    public function allpress($user_id)
    {
        $admin = $this->session->userdata('is_admin');
        if (isset($admin) && $admin == 1) {
            $data['is_admin'] = $admin;
        }
        $data = array();
        $data['listpress'] = $this->db->where('artist_id', $user_id)
            ->order_by('id', 'ASC')
            ->get('press')->result_array();
        $data['user_data'] = $this->session->userdata('user_data');
        $data['info_id'] = $user_id;
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/allpress', $data);
        $this->load->view('includes/footer', $data);
    }
     /**
      * View Manager press.
      **/
     public function manager()
     {
         $admin = $this->session->userdata('is_admin');
         if (isset($admin) && $admin == 1) {
             $data['is_admin'] = $admin;
         }
         $user_id = $this->session->userdata('loged_in');
         $data = array();
        //$data['listpress']= $this->db->where('artist_id',$user_id)->order_by('id', 'DESC')->get('press')->result_array();
        $data['user_data'] = $this->session->userdata('user_data');

         $config['per_page'] = 12;
         $config['base_url'] = base_url().'artist/managerpress';
         $start = $this->input->get('per_page');
         if (empty($start)) {
             $start = 0;
         }
         $config['uri_segment'] = 3;
         $config['total_rows'] = $this->db->get_where('press', array('artist_id' => $user_id))->num_rows();
         $this->load->library('pagination', $config);
         $this->pagination->initialize($config);
         $data['listpress'] = $this->db->limit($config['per_page'], $start)->get_where('press', array('artist_id' => $user_id))->result_array();

         $this->load->view('includes/header', $data);
         $this->load->view('includes/navbar', $data);
         $this->load->view('artist/listpress', $data);
         $this->load->view('includes/footer', $data);
     }
    /**
     *  Edit press.
     **/
    public function editpress()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('quote', 'quote', 'required|max_length[1000]');
        $this->form_validation->set_rules('name', 'name', 'required|max_length[255]');
        $this->form_validation->set_rules('author', 'author', 'max_length[255]');
        $this->form_validation->set_rules('date_on', 'date_on', 'max_length[255]');
        $this->form_validation->set_rules('link', 'link', 'max_length[255]');
        if ($this->form_validation->run() != false) {
            $id = $this->input->post('id');
            $updateArr = array(
                'quote' => $this->input->post('quote'),
                'name' => $this->input->post('name'),
                'author' => $this->input->post('author'),
                'date_on' => $this->input->post('date_on'),
                'link' => $this->input->post('link'),
            );
            $this->db->update('press', $updateArr, 'id ='.$id);
            $this->session->set_flashdata('message_msg', ' Updated edit press completed');
        } else {
            $this->session->set_flashdata('message_error', validation_errors());
        }
        redirect('artist/managerpress');
    }
     /**
      * delete press.
      **/
     public function deletepress()
     {
         $id = $this->input->post('id_press');
         $user_id = $this->session->userdata('loged_in');
         $data_press = $this->db->where('id', $id)->where('artist_id', $user_id)->get('press')->row();
         if ($data_press > 0) {
             $this->db->where('id', $id)->delete('press');
             $this->session->set_flashdata('message_msg', ' Delete press completed');
         } else {
             $this->session->set_flashdata('message_error', 'Invalid ID press');
         }
         redirect('artist/managerpress');
     }
}
