<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Event_search extends CI_Controller
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
        $this->load->model('Events_model');
        $this->load->model('M_user');
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
     * View search event.
     **/
    public function search()
    {
        $data['genres'] = $this->db->get('genres')->result_array();
        $data['user_data'] = $this->session->userdata('user_data');
        $data['list_event'] = null;

        $name_search = $this->input->get('search');
        //var_dump($name_search);exit;
        $start_date = $this->input->get('event_start_date');

        $end_date = $this->input->get('event_end_date');
        //$name_search='z';
        if (!empty($name_search)) {
            if (empty($start_date)) {
                $data['list_event'] = $this->db->select('*')
                ->from('events as e')
                ->join('users as u', 'u.id = e.user_id')
                ->like('e.location', $name_search)
                ->or_like('u.artist_name', $name_search)

                ->get()->result_array();
                //var_dump($data['list_event']);exit;
            } else {
                if (empty($end_date)) {
                    //

                    $data['list_event'] = $this->db->select('*')
                    ->from('events as e')
                           ->join('users as u', 'u.id = e.user_id')
                    ->where('e.event_start_date>=', $start_date)
                    ->like('e.location', $name_search)
                    ->or_like('u.artist_name', $name_search)

                    ->get()->result_array();
                   // var_dump($data['list_event']);exit;
                } else {
                    $data['list_event'] = $this->db->select('*')
                    ->from('events as e')
                           ->join('users as u', 'u.id = e.user_id')
                    ->where('e.event_start_date>=', $start_date)
                    ->where('e.event_end_date<=', $end_date)
                    ->like('e.location', $name_search)
                    ->or_like('u.artist_name', $name_search)

                    ->get()->result_array();
                   // var_dump($data['list_event']);exit;
                }
            }
        } elseif (!empty($start_date)) {
            if (empty($end_date)) {
                $data['list_event'] = $this->db->select('*')
                            ->from('events as e')
                           ->join('users as u', 'u.id = e.user_id')
                            ->where('e.event_start_date>=', $start_date)
                            ->get()->result_array();
                           // var_dump($data['list_event']);exit;
            } else {
                $data['list_event'] = $this->db->select('*')
                            ->from('users as u')
                             ->join('events e', 'u.id=e.user_id')
                            ->where('e.event_start_date>=', $start_date)
                            ->where('e.event_end_date<=', $end_date)

                            ->get()->result_array();
                           // var_dump($data['list_event']);exit;
            }
        } elseif (!empty($end_date)) {
            //var_dump($end_date);exit;
                    $data['list_event'] = $this->db->select('e.*,u.*')
                    ->from('events as e')
                    ->join('users as u', 'u.id = e.user_id')
                    ->where('e.event_end_date<=', $end_date)

                    ->get()->result_array();
                   //var_dump($data['list_event']);exit;
        }

        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/event_search', $data);
        $this->load->view('includes/footer', $data);
    }
}
