<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gigs_Events extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Events_model');
        $this->load->model('M_user');
        $this->load->model('M_tour');
        $this->load->model('M_text');
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
     * View List Event.
     **/
    public function index()
    {
        if ($this->session->userdata('loged_in') == false) {
            redirect('account/login');
        }
        $admin = $this->session->userdata('is_admin');
        if (isset($admin) && $admin == 1) {
            $data['is_admin'] = $admin;
        }

        $user_id = $this->session->userdata('loged_in');
        //$data['rows'] = $this->Events_model->getAllEvents($user_id);
        $data['user_data'] = $this->session->userdata('user_data');

        $config['per_page'] = 12;
        $config['base_url'] = base_url().'artist/managerevent/';
        $start = $this->input->get('per_page');
        if (empty($start)) {
            $start = 0;
        }
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->db->get_where('events', array('user_id' => $user_id))->num_rows();
        $this->load->library('pagination', $config);
        $this->pagination->initialize($config);
        $data['rows'] = $this->db->limit($config['per_page'], $start)->get_where('events', array('user_id' => $user_id))->result_array();

        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/listevent', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View gigs event.
     **/
    public function view_event()
    {
        $user_id = $this->session->userdata('loged_in');
        $data['rows'] = $this->Events_model->getAllEvents($user_id);
        $data['user_data'] = $this->session->userdata('user_data');
        $dt = date('Y-m-d', strtotime('-4 month'));
        $data['just'] = $this->db->select('*')
                ->from('events')
                ->where('post_date >=', $dt)
                ->order_by('event_id', 'desc')
                ->limit(30)
                ->get()->result_array();
                // echo $this->db->last_query();
                // print_r($data['just']);die();
        $data['events'] = $this->db->select('*')
                ->from('events')
                ->order_by('event_id', 'desc')
                ->limit(6)
                ->get()->result_array();

        $data['genres'] = $this->db->select('*')
                ->from('genres')
                ->order_by('id', 'desc')
                ->get()->result_array();

        $data['pops'] = $this->eventByCat(3, 6);

        $data['rocks'] = $this->eventByCat(1, 3);

        $data['dances'] = $this->eventByCat(2, 3);

        $data['rbs'] = $this->eventByCat(4, 3);

        $data['djs'] = $this->eventByCat(5, 3);

        $data['childens'] = $this->eventByCat(6, 3);

        $data['punks'] = $this->eventByCat(8, 3);

        $data['staffs'] = $this->eventByCat(9, 3);

        $data['festivals'] = $this->eventByCat(7, 3);

        $data['commings'] = $this->comming_soon(10);

        $data['event'] = null;
        $data['name_genres'] = null;
        $g = $this->uri->segment(2, 0);
        if (is_numeric($g) && $g > 0) {

      //      $u=$data['user_data']['id'];

            $data['name_genres'] = $this->db->select('*')
                ->from('genres')
                ->where('id', $g)
                ->limit(1)
                ->get()->result_array();

            $data['event'] = $this->eventByCateuser($g);
        //var_dump($data['event']);exit;
        }
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('gigs_events', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View event by cate user.
     *
     * @param string $categories
     *
     * @return array
     **/
    public function eventByCateuser($cat)
    {
        $result = $this->db->select('*')
                ->from('events')
                ->join('users as u', 'u.id  = events.user_id')
                ->where('events.categories', $cat)
                ->order_by('event_id', 'desc')
                ->get()->result_array();

        return  $result;
    }
    /**
     * result event by categories.
     *
     * @param string $categories
     * @param int    $limit
     *
     * @return array
     **/
    public function eventByCat($cat, $limit)
    {
        $result = $this->db->select('*')
                ->from('events')
                ->where('categories', $cat)
                ->order_by('event_id', 'desc')
                ->limit($limit)
                ->get()->result_array();

        return  $result;
    }
   //Comming Soon
   public function comming_soon($limit)
   {
       $result = $this->db->select('*')
                ->from('events')
                ->order_by('event_id', 'desc')
                ->limit($limit)
                ->get()->result_array();

       return  $result;
   }
   //end comming Soon
    /**
    * Create new event.
    **/
    public function create()
    {
        $user_id = $this->session->userdata('loged_in');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('categories', 'categories', 'required');
        $this->form_validation->set_rules('event_title', 'event_title', 'max_length[255]|required');
        $this->form_validation->set_rules('event_desc', 'event_desc', 'max_length[1000]|required');
        $this->form_validation->set_rules('event_start_date', 'event_start_date', 'max_length[255]|required');
        $this->form_validation->set_rules('event_end_date', 'event_end_date', 'max_length[255]|required');
        $this->form_validation->set_rules('location', 'location', 'max_length[255]|required');

        if ($this->form_validation->run() != false) {
            $title = strip_tags($this->input->post('event_title'));
            $description = $this->input->post('event_desc');
            $post_by = strip_tags($this->input->post('posted_by'));
            $start_day = $this->input->post('event_start_date');
            $end_day = $this->input->post('event_end_date');
            $location = strip_tags($this->input->post('location'));
            $categories = $this->input->post('categories');
            $this->load->library('upload');
            if (!empty($_FILES['event_banner']['name'])) {
                $this->upload->initialize($this->config());
                if (!$this->upload->do_upload('event_banner')) {
                    $data['update_error'] = $this->upload->display_errors();
                    $this->session->set_flashdata('message_error', $data['update_error']);
                    die;
                } else {
                    $datafile = $this->upload->data();
                    $insertArr = array(
                        'event_title' => $title,
                        'event_desc' => $description,
                        'posted_by' => $post_by,
                        'event_start_date' => $start_day,
                        'event_end_date' => $end_day,
                        'location' => $location,
                        'user_id' => $user_id,
                        'categories' => $categories,
                        'event_banner' => $datafile['file_name'],
                    );

                    $this->Events_model->insert('events', $insertArr);
                    $this->session->set_flashdata('message_msg', 'create new gigs event success!');
                }
            }
        } else {
            $this->session->set_flashdata('message_error', validation_errors());
        }
        redirect('artist/profile');
    }
    /**
     * View Edit event.
     *
     * @param int $id
     **/
    public function edit($id)
    {
        $data['rows'] = $this->Events_model->getItemWithWhere('events', array('event_id' => $id));
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('gigs_events_edit', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * update event.
     *
     * @param int $id
     **/
    public function update($id)
    {
        $user_id = $this->session->userdata('loged_in');
        $title = $this->input->post('event_title');
        $description = $this->input->post('event_desc');
        $post_by = $this->input->post('posted_by');
        $start_day = $this->input->post('event_start_date');
        $end_day = $this->input->post('event_end_date');
        $location = $this->input->post('location');
        $categories = $this->input->post('categories');
        $this->load->library('upload');
        if (!empty($_FILES['event_banner']['name'])) {
            $this->upload->initialize($this->config());
            if (!$this->upload->do_upload('event_banner')) {
                $data['update_error'] = $this->upload->display_errors();
                echo $data['update_error'];

                return 0;
            } else {
                $datafile = $this->upload->data();
                $updateArr = array(
                            'event_title' => $title,
                            'event_desc' => $description,
                            'posted_by' => $post_by,
                            'event_start_date' => $start_day,
                            'event_end_date' => $end_day,
                            'location' => $location,
                            'user_id' => $user_id,
                            'categories' => $categories,
                            'event_banner' => $datafile['file_name'],

                );

                $this->Events_model->updateWhere('events', $updateArr, array('event_id' => $id));
            }
        }
        $updateArr = array(
                    'event_title' => $title,
                    'event_desc' => $description,
                    'posted_by' => $post_by,
                    'event_start_date' => $start_day,
                    'event_end_date' => $end_day,
                    'location' => $location,
                    'user_id' => $user_id,
                    'categories' => $categories,
        );

        $this->Events_model->updateWhere('events', $updateArr, array('event_id' => $id));
        redirect('artist/managerevent');
    }
    /**
     * Config uploads  image event.
     **/
    public function config()
    {
        $loged_in = $this->session->userdata('loged_in');
        $config = array();
        $config['upload_path'] = './uploads/'.$loged_in.'/photo/banner_events/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        } else {
            //chmod($config['upload_path'], 0777);
        }
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '10000000';
        $config['max_width'] = '10000000';
        $config['max_height'] = '10000000';
        $config['file_name'] = uniqid();

        return $config;
    }
    /**
     * Delete event.
     **/
    public function delete()
    {
        $user_id = $this->session->userdata('loged_in');
        $id = $this->input->post('id');
        if (isset($id) && isset($user_id)) {
            $this->Events_model->deleteWhere($id);
            echo 'success';
        }
    }
    /**
     * Ajax Get data event.
     *
     * @return json
     **/
    public function getdata()
    {
        $id = $this->input->get('id');
        $user_id = $this->session->userdata('loged_in');
        $data_event = $this->Events_model->get_event_data($id, $user_id);
        if (!empty($data_event)) {
            echo json_encode($data_event);
            die;
        }
        header('HTTP/1.1 500 ');
    }
    //read event
    public function read_event($str)
    {
        $arr = explode('_', $str);
        $id = end($arr);
        $data['events'] = $this->db->where('event_id', $id)->get('events')->row();
        $data['comment'] = $this->Events_model->Comment($id);
        $data['user_data'] = $this->session->userdata('user_data');
        $data['current_title'] = $str;
        if ($id % 2 == 0) {
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('gigs_events/read_event', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('gigs_events/read_event_next', $data);
            $this->load->view('includes/footer', $data);
        }
    }
    public function Counter_hits($id)
    {
        $data_read = $this->db->where('id', $id)->get('events')->row();
        $this->db->where('id', $id)->update('blogs', array('count_read' => $data_read->count_read + 1));
    }
    //delete event where gigs_events/read
    public function delete_event()
    {
        $delete = $this->db->where('id', $this->input->post('delete_id_read'))
                ->delete('venues_info');
        if (isset($delete)) {
            $data = array('oke_delete' => 'ok');
        } else {
            $data = array('oke_delete' => 'no');
        }
        echo json_encode($data);
        die;
    }
}
