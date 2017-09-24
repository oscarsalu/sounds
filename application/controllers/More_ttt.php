<?php
/**
 * More_ttt File Doc Comment.
 *
 * @category More_Ttt
 *
 * @author   99sound <admin@99sound.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 *
 * @link     http://www.99Sound.com/
 */
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * More_ttt Class Doc Comment.
 *
 * @category More_Ttt
 *
 * @author   99sound <admin@99sound.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 *
 * @link     http://www.99Sound.com/
 */
class More_ttt extends CI_Controller
{
    /**
     * Function constructor to initiate values & load data.
     * 
     * @return nothing.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->model('M_tour');
        $this->load->model('Events_model');
        $this->load->helper('string');
        $this->load->model('M_tax');
        $ac = $this->session->userdata('access');
         $data['redirect_url']=$this->curPageURL();
        if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }

        if ($this->session->userdata('loged_in') == false) {
            //redirect('account/login');
        } else {
            $this->user_id = $this->session->userdata('loged_in');
            $user_data = $this->db->where('id='.$this->user_id)->get('users')->row_array();
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
     * Function to display schedules.
     * 
     * @param int $tour_id     the tour id
     * @param int $location_id the location_id
     * 
     * @return nothing, loads views.
     */
    public function schedules($tour_id, $location_id)
    {
        $this->session->set_userdata('target', 'target0');
        $member_id = $this->user_id;

        if (isset($tour_id) && $tour_id) {
            $data['check_member'] = $this->db->where('user_member', $this->user_id)->where('tour_id', $tour_id)->get('tours_member')->row_array();
            $tour_data = $this->db->where('tour_id', $tour_id)->get('tour')->row_array();
            
            $locations = $this->db->select('*')
                ->from('location as l')
                ->where('l.tour_id', $tour_id)
                ->distinct()
                ->order_by('l.location_id', 'desc')
                ->get()->result_array();
            if (isset($locations) && count($locations) > 0) {
                if (empty($location_id)) {
                    $location_id = $locations[0]['location_id'];
                }
            } else {
                echo " ";
            }
            $data['schedules'] = $this->db->where('tour_id', $tour_id)->where('location_id', $location_id)->get('schedules')->result_array();
            $data['locations'] = $locations;
            $data['location_id'] = $location_id;
            $data['tour_id'] = $tour_id;
            $data['tour'] = $tour_data;
            $data['user_data'] = $this->session->userdata('user_data');
            $this->load->view('ttt_new/schedule', $data);
        } else {
            echo " ";
        }
        // $this->load->view('includes/header', $data);
        // $this->load->view('includes/navbar', $data);
        // $this->load->view('ttt/header_ttt', $data);
        // $this->load->view('ttt/schedule', $data);
        // $this->load->view('includes/footer', $data);

    }
    /**
     * Function for data schedule.
     * 
     * @return nothing.
     */
    public function data_schedule()
    {
        $time_start = strtotime($this->input->post('start_event_id')) + 4 * 3600;

        $time_end = strtotime($this->input->post('end_event_id')) + 4 * 3600;
        if ($this->input->post()) {
            if ($this->input->post('type') == 'add') {
                $insert = array(
                    'des' => $this->input->post('event_title'),
                    'tour_id' => $this->input->post('tour_event_id'),
                    'location_id' => $this->input->post('location_event_id'),
                    'start_time' => $time_start,
                    'end_time' => $time_end,
                    'color' => $this->input->post('color_front'),
                );
                $this->db->insert('schedules', $insert);
            } elseif ($this->input->post('type') == 'edit') {
                $update = array(
                    'des' => $this->input->post('event_title'),
                    'color' => $this->input->post('color_front'),
                );
                $this->db->where('id', $this->input->post('event_id'));
                $this->db->update('schedules', $update);
                //$this->db->update("schedules",$update,array("id",$this->input->post("event_id")));
            } else {
                $this->db->where('id', $this->input->post('event_id'));
                $this->db->delete('schedules');
            }
            // redirect('the_total_tour/schedules/'.$this->input->post('tour_event_id').'/'.$this->input->post('location_event_id'));
            echo json_encode("success");
        }
    }
    /**
     * Function to get schedule.
     * 
     * @return schedule data.
     */
    public function get_schedule()
    {
        if ($this->input->post('id')) {
            $schedule = $this->db->select('*')->where('id', $this->input->post('id'))->from('schedules')->get()->row_array();
            $data = array(
            'status' => 1,
            'data' => $schedule,
            );
        } else {
            $data = array(
            'status' => 0,
            );
        }
        echo json_encode($data);
        die;
    }
    /**
     * Function to edit des tour.
     * 
     * @return error & success status after edit.
     */
    public function edit_des_tour()
    {
        if ($this->input->post('tour_id')) {
            $update = array(
                'des' => $this->input->post('des'),
            );

            $this->db->where('tour_id', $this->input->post('tour_id'));
            $this->db->update('tour', $update);
            $data = array(
                'status' => 1,
                'msg' => 'Update Description done!',
            );
        } else {
            $data = array(
                'status' => 0,
                'msg' => "Can't Update Description",
            );
        }
        echo json_encode($data);
        die;
    }
    /**
     * Function to edit detail tour.
     * 
     * @return error & success status after insert.
     */
    public function edit_detail_tour()
    {
        if ($this->input->post('tour_id')) {
            $value_detail = $this->input->post('value_detail');
            if ($value_detail == 'Add') {
                $insert = array(
                    'tour_id' => $this->input->post('tour_id'),
                    'detail' => $this->input->post('name_hotel_tour'),
                    'phone' => $this->input->post('phone_hotel_tour'),
                    'address' => $this->input->post('add_hotel_tour'),
                    'website' => $this->input->post('website_hotel_tour'),
                    'type' => $this->input->post('type_detail'),
                    'room' => $this->input->post('room_hotel_tour'),
                );
                $insert_data = $this->db->insert('tour_detail', $insert);
                $data = array(
                    'status' => 1,
                    'msg' => 'Add data done!',
                    'insert' => $this->db->insert_id(),
                );
            } elseif ($value_detail == 'Edit') {
                $update = array(
                    'detail' => $this->input->post('name_hotel_tour'),
                    'phone' => $this->input->post('phone_hotel_tour'),
                    'address' => $this->input->post('add_hotel_tour'),
                    'website' => $this->input->post('website_hotel_tour'),
                    'room' => $this->input->post('room_hotel_tour'),
                );
                $this->db->where('id', $this->input->post('id_detail'));
                $this->db->update('tour_detail', $update);
                $data = array(
                    'status' => 1,
                    'msg' => 'Update Description done!',
                    'insert' => $this->input->post('id_detail'),
                );
            }
        } else {
            $data = array(
                'status' => 0,
                'msg' => "Can't Update Description",
            );
        }
        echo json_encode($data);
        die;
    }
    /**
     * Function to edit detail tour view.
     * 
     * @return status & data related to tour.
     */
    public function edit_detail_tour_view()
    {
        if ($this->input->post('id')) {
            $tour_detail = $this->db->select('*')->where('id', $this->input->post('id'))->from('tour_detail')->get()->row_array();
            $data = array(
                'status' => 1,
                'data' => $tour_detail,
                'msg' => '',
            );
            echo json_encode($data);
            die;
        }
    }
    /**
     * Function to edit_detail_tour_delete.
     * 
     * @return error & success status after delete.
     */
    public function edit_detail_tour_delete()
    {
        if ($this->input->post('id')) {
            $this->db->where('id', $this->input->post('id'));
            $this->db->delete('tour_detail');
            $data = array(
                'status' => 1,
                'msg' => 'Delete finish !',
            );
        } else {
            $data = array(
                'status' => 0,
                'msg' => 'Delete error !',
            );
        }
        echo json_encode($data);
        die;
    }
    /**
     * Function to show location db.
     * 
     * @return error & success status.
     */
    public function show_location_db()
    {
        if ($this->input->post('location_id')) {
            $tour_detail = $this->db->select('*')->where('location_id', $this->input->post('location_id'))->from('location')->get()->row_array();
            $city = $this->db->select('city')->where('country', $tour_detail['country'])->distinct('city')->from('db_locations')->get()->result_array();
            $address = $this->db->select('street1,street2')->where('city', $tour_detail['city'])->from('db_locations')->get()->result_array();
            $data = array(
                'status' => 1,
                'data' => $tour_detail,
                'city' => $city,
                'address' => $address,
                'msg' => '',
            );
        } else {
            $data = array(
                'status' => 0,
                'msg' => 'Delete error !',
            );
        }
        echo json_encode($data);
        die;
    }
    /**
     * Function to get city from country.
     * 
     * @return data and error or success status .
     */
    public function get_city_from_country()
    {
        //$tour_detail = $this->db->select('street1')->where("city",'Berlin')->distinct('street1')->from('db_locations')->get()->result_array();
        if ($this->input->post('value')) {
            if ($this->input->post('data2') == 'city') {
                $tour_detail = $this->db->select('city')->where('country', $this->input->post('value'))->distinct('city')->from('db_locations')->get()->result_array();
            } elseif ($this->input->post('data2') == 'street1') {
                $tour_detail = $this->db->select('street1,street2,email')->where('city', $this->input->post('value'))->from('db_locations')->get()->result_array();
            }

            $data = array(
                'status' => 1,
                'data' => $tour_detail,
                'msg' => '',
            );
        } else {
            $data = array(
                'status' => 0,
                'msg' => 'Delete error !',
            );
        }
        echo json_encode($data);
        die;
    }
    /**
     * Function to caculate tax.
     * 
     * @return nothing.
     */
    public function tax_caculate()
    {
        if ($this->input->post('location')) {
            $update = array(
                    'tax_location_federal' => $this->input->post('tax_location_federal'),
                    'tax_location_state' => $this->input->post('tax_location_state'),
                );
            $this->db->where('location_id', $this->input->post('location'));

            $this->db->update('location', $update);
        }
        redirect('the_total_tour/caculate/'.$this->input->post('tour_id').'/'.$this->input->post('location'));
    }
    /**
     * Function for income tax.
     * 
     * @return nothing.
     */
    public function income_tax()
    {
        if ($this->input->post('tour_id')) {
            $update = array(
                    'income_tax' => $this->input->post('income_tax'),
                );
            $this->db->where('tour_id', $this->input->post('tour_id'));

            $this->db->update('tour', $update);
        }
        redirect('the_total_tour/caculate/'.$this->input->post('tour_id').'/'.$this->input->post('location'));
    }
    /**
     * Function of roadtour.
     *
     * @param int $tour_id the id of tour
     * 
     * @return nothing, loads views.
     */
    public function roadtour($tour_id)
    {
        $this->config->load('googleplus');
        $this->load->library('googlemaps');
        $data['apikey'] = $this->config->item('googlemap_api_key');
        $config['apikey'] = $this->config->item('googlemap_api_key');
        $config['center'] = '88.4419, 87';
        $config['zoom'] = 'auto';
        $config['directions'] = true;
        $config['directionsWaypointArray'] = array('Roncesvalles Village, Toronto, ON, Canada', 'MacEwan Hall, 402 Collegiate Blvd NW, Calgary, AB T2N 4V8, Canada');

        $config['directionsStart'] = 'empire state building';
        $config['directionsEnd'] = 'statue of liberty';
        $config['directionsDivID'] = 'directionsDiv';
        $this->load->library('facebook');
        $this->facebook->roadtourdata_map();
        $this->googlemaps->initialize($config);
        $data['map'] = $this->googlemaps->create_map();

        $data['check_member'] = $this->db->where('user_member', $this->user_id)->where('tour_id', $tour_id)->get('tours_member')->row_array();
        $tour_data = $this->db->where('tour_id', $tour_id)->get('tour')->row_array();

        $locations = $this->db->select('*')
            ->from('location as l')
            ->where('l.tour_id', $tour_id)
            ->distinct()
            ->order_by('l.location_id', 'desc')
            ->get()->result_array();
		
        $query = "SELECT users.email FROM tours_member, users WHERE tours_member.tour_id =  '$tour_id' AND tours_member.user_member = users.id";
        $emailIds = $this->db->query($query)->result_array();
        $data['emailIds'] = $emailIds;

        $data['user_data'] = $this->session->userdata('user_data');
        $data['tour_id'] = $tour_id;
        $data['tour'] = $tour_data;
        $data['name_artist'] = $this->M_tour->name_artist($tour_data['user_id']);

        $data['locations'] = $locations;
        $member_list = $this->M_tour->list_name_memeber($tour_id);
        if ($member_list != false) {
            $tam = array();
            foreach ($member_list as $m_l) {
                $tam[] = ucfirst($m_l['0']['lastname']);
            }
            $show_list = implode(', ', $tam);
            $data['show_list_member'] = $show_list;
        }
        // $this->load->view('includes/header', $data);
        // $this->load->view('includes/navbar', $data);
        // $this->load->view('ttt/header_ttt', $data);
        // $this->load->view('ttt/roadtour', $data);
        // $this->load->view('includes/footer', $data);
        $this->load->view('ttt_new/roadtour', $data);
    }
    /**
     * Function to road tour data.
     *
     * @param int $id the id to read tour data
     * 
     * @return nothing, loads views.
     */
    public function roadtourdata($id)
    {
        $this->load->library('facebook');
        $this->facebook->roadtourdata($id);
    }
    /**
     * Function to send mail for itinerary list to tour members.
     * 
     * @return data.
     */
	public function send_mail_itinerary($data_itinerary)
    {
        $tour_id = $data_itinerary['tour_id'];
        $tour_data = $this->db->where('tour_id', $tour_id)->get('tour')->row_array();
		$member_emails = explode('||', $data_itinerary['email_ids']);
        $data = array();
        if (isset($member_emails)) {
            foreach ($member_emails as $member_email) {
                $this->load->library('email');
                $config['protocol'] = 'smtp';
                $config['charset'] = 'utf-8';
                $config['mailtype'] = 'html';
                $config['newline'] = "\r\n";
                $subject = 'Sent email epk';
                $data_email['subject'] = $subject;
                $data_email['name_artists'] = $this->M_tour->name_artist($tour_data['user_id']);
                $data_email['tour'] = $this->M_tour->choose_tour($tour_id);
                $member_list = $this->M_tour->list_name_memeber($tour_id);
                if ($member_list != false) {
                    $tam = array();
                    foreach ($member_list as $m_l) {
                        $tam[] = ucfirst($m_l['0']['lastname']);
                    }
                    $show_list = implode(', ', $tam);
                    $data_email['show_list_member'] = $show_list;
                }
                $data_email['start'] = $data_itinerary['start'];
                $data_email['end'] = $data_itinerary['end'];
				$data_email['waypoints'] = explode('||',$data_itinerary['waypoints']);
                $message = $this->load->view('email/conten_itinerary_sent_mail', $data_email, true);
                // $message  ="test";
                $email_from = $this->config->item('admin_email');
                $name_from = $this->config->item('admin_name');
                $this->email->initialize($config);
                $this->email->clear();
                $this->email->from($email_from, $name_from);
                $this->email->reply_to($email_from, $name_from);
                $this->email->to($member_email);
                $this->email->subject($subject);
                $this->email->message($message);
                //$this->email->send();
				
                if ($this->email->send()) {
                    $data[] = array(
                        'email_to' => $member_email,
                        'msg_sent' => true,
                    );
                } else {
                    $data[] = array(
                        'email_to' => $member_email,
                        'msg_sent' => false,
                    );
                }
            }
        }
        return $data;
    }
    /**
     * Function to get current date and time.
     * 
     * @return date.
     */
    public function getCurrDateTime()
    {
        $this->load->helper('date');
        return $date = date('Y-m-d H:i:s');
    }
    /**
     * Function to save itinerary list.
     * 
     * @return nothing.
     */
	public function save_itinerary_roadtour()
    {
		if ($this->input->post('start_point')) {
            $waypoints = implode('||',$this->input->post('waypoints'));
                $start_point = $this->input->post('start_point');
                $end_point = $this->input->post('end_point');
                /* user id would be change at final test*/
                $data_itinerary = array('start' => $start_point,
                    'end' => $end_point,
                    'waypoints' => $waypoints,
                    'user_id' => $this->user_id,
                    'created_on' => $this->getCurrDateTime()
                );
                $insert = $this->M_tour->insert_data('itinerary', $data_itinerary);

                if ($insert) {
                    $data = array(
                        'status' => 1,
                        'msg' => 'Itinerary Added!!!',
                    );
					$data_itinerary['tour_id'] = $this->input->post('tour_id');
					$data_itinerary['email_ids'] = implode('||',$this->input->post('email_id'));
					$data['mail_data'] = $this->send_mail_itinerary($data_itinerary);
                } else {
                    $data = array(
                        'status' => 0,
                        'msg' => 'Server Error!!!',
                    );
                }
            echo json_encode($data);
            die;
        }
    }
    /**
     * Function to send mail to roadtour.
     * 
     * @return nothing.
     */
    public function send_mail_roadtour()
    {
        $tour_id = $this->input->post('tour');
        $tour_data = $this->db->where('tour_id', $tour_id)->get('tour')->row_array();
        $member = $this->M_tour->member_tour($tour_id);
        $data = array();
        if (isset($member)) {
            foreach ($member as $m) {
                $this->load->library('email');
                $config['protocol'] = 'smtp';
                $config['charset'] = 'utf-8';
                $config['mailtype'] = 'html';
                $config['newline'] = "\r\n";
                $subject = 'Sent email epk';
                $data_email['subject'] = $subject;
                $data_email['name_artists'] = $this->M_tour->name_artist($tour_data['user_id']);
                $data_email['tour'] = $this->M_tour->choose_tour($tour_id);
                $member_list = $this->M_tour->list_name_memeber($tour_id);
                if ($member_list != false) {
                    $tam = array();
                    foreach ($member_list as $m_l) {
                        $tam[] = ucfirst($m_l['0']['lastname']);
                    }
                    $show_list = implode(', ', $tam);
                    $data_email['show_list_member'] = $show_list;
                }
                $data_email['start'] = $this->input->post('start');
                $data_email['end'] = $this->input->post('end');
                $message = $this->load->view('email/conten_sent_mail', $data_email, true);
                // $message  ="test";
                $email_from = $this->config->item('admin_email');
                $name_from = $this->config->item('admin_name');
                $this->email->initialize($config);
                $this->email->clear();
                $this->email->from($email_from, $name_from);
                $this->email->reply_to($email_from, $name_from);
                $email_to_member = $this->M_tour->member_tour_email($m['user_member']);
                $this->email->to($email_to_member['email']);
                $this->email->subject($subject);
                $this->email->message($message);
                //$this->email->send();
                if ($this->email->send()) {
                    $data[] = array(
                        'email_to' => $email_to_member['email'],
                        'msg_sent' => true,
                    );
                } else {
                    $data[] = array(
                        'email_to' => $email_to_member['email'],
                        'msg_sent' => false,
                    );
                }
            }
        }
        echo json_encode($data);
        die;
    }
    /**
     * Function to book a show.
     *
     * @param int $tour_id     the id of tour
     * @param int $location_id the id of location
     * 
     * @return nothing, loads views.
     */
    public function bookashow($tour_id, $location_id)
    {
        $show = false;
        if (!empty($location_id)) {
            $show = $this->M_tour->show_book_venues($location_id);
        }
        
        if ($show != false) {
            $data['book_venues'] = $show;
        }
        else
        {
            $data['book_venues'] =  'No Requests yet';
        }
        $locations = $this->db->select('*')
            ->from('location as l')
            ->where('l.tour_id', $tour_id)
            ->distinct()
            ->order_by('l.location_id', 'desc')
            ->get()->result_array();

        $data['check_member'] = $this->db->where('user_member', $this->user_id)->where('tour_id', $tour_id)->get('tours_member')->row_array();
        $tour_data = $this->db->where('tour_id', $tour_id)->get('tour')->row_array();
        $data['user_data'] = $this->session->userdata('user_data');
        $data['tour_id'] = $tour_id;
        $data['tour'] = $tour_data;
        $data['locations'] = $locations;
        $data['location_id'] = $location_id;
        // $this->load->view('includes/header', $data);
        // $this->load->view('includes/navbar', $data);
        // $this->load->view('ttt/header_ttt', $data);
        // $this->load->view('ttt/bookashow', $data);
        // $this->load->view('includes/footer', $data);
       $this->load->view('ttt_new/bookashow', $data);
    }
    /**
     * Function to update venues books.
     * 
     * @return nothing.
     */
    public function book_update()
    {
        $id = $this->input->post('update_id');
        $tour = $this->input->post('tour_id');
        $data = array(
         'confirmation' => $this->input->post('tour_id_status'),
        );
        $this->db->where('id', $id);
        $this->db->update('venues_books', $data);
        echo json_encode("success");
        // redirect('the_total_tour/bookashow/'.$tour);
    }
    /**
     * Function to delete venues_books.
     * 
     * @return nothing.
     */
    public function bookashow_delete()
    {
        $id = $this->input->post('delete_id_book');
        if (isset($id)) {
            $this->db->where('id', $id)->delete('venues_books');
        }
        $tour = $this->input->post('tour_id');
        echo json_encode("success");
        // redirect('the_total_tour/bookashow/'.$tour);
    }
	
	
	/**
     * mj_function for getting schedule 
     * 
     * Start Here
     */
	
	public function mj_schedules($tour_id, $location_id)
    {
        $this->session->set_userdata('target', 'target0');
        $member_id = $this->user_id;
		

        if (isset($tour_id) && $tour_id) {
            $data['check_member'] = $this->db->where('user_member', $this->user_id)->where('tour_id', $tour_id)->get('tours_member')->row_array();
            $tour_data = $this->db->where('tour_id', $tour_id)->get('tour')->row_array();
            //$own = $this->db->where('id',$tour_data['user_id'])->get('users')->row_array();

            $locations = $this->db->select('*')
                ->from('location as l')
                ->where('l.tour_id', $tour_id)
                ->distinct()
                ->order_by('l.location_id', 'desc')
                ->get()->result_array();
            if (isset($locations) && count($locations) > 0) {
                if (empty($location_id)) {
                    $location_id = $locations[0]['location_id'];
}
            } else {
                echo " ";
            }
            $schedules = $this->db->where('tour_id', $tour_id)->where('location_id', $location_id)->get('schedules')->result_array();
            /*$schedules = $this->db->select('*')
                ->from('schedules')
                ->get()->result_array();*/
            $schedule_data = array();
            $schedule1 = array();
            foreach ($schedules as $schedule) {
                    $schedule1['start_time'] = date('M d Y h:i:s A', $schedule['start_time']);
                    $schedule1['end_time'] = date('M d Y h:i:s A', $schedule['end_time']);
                    $schedule1['des'] = $schedule['des'];
                    $schedule1['color'] = $schedule['color'];
                    $schedule_data[] = $schedule1;
                }
            $data['schedules'] = $schedule_data;
            
            
        } else {
            echo " ";
        }
        /*$data['locations'] = $locations;
        $data['location_id'] = $location_id;
        $data['tour_id'] = $tour_id;
        $data['tour'] = $tour_data;
        $data['user_data'] = $this->session->userdata('user_data');*/
		
		$data = array(
		         'status' => 1,
		         'locations' => $locations,
				 'location_id' => $location_id,
				 'tour_id' => $tour_id,
				 'tour' => $tour_data,
			     'schedules' => $data['schedules'],
				 'check_member' => $data['check_member'],  
				 'user_data' => $this->session->userdata('user_data'),
				 );
				 		
		echo json_encode($data);
		
	 }

     public function add_tax_calculate()
     {
        if($this->input->post())
        {
            $dataArray = array();
            $relate_id = " ";
            $type = '';
            if($this->input->post('type') == 'tour')
            {
                $relate_id = $this->input->post('tour_id');
                $type = 'tour';
            }
            else
            {
                $relate_id = $this->input->post('location');
                $type = 'location';
            }

            $dataArray = array('relate_id' => $relate_id, 'type'=>$type, 'name'=>$this->input->post('change_name'),'tax'=>$this->input->post('change_price'));
            if($this->input->post('type_data') == 'create')
            {
                $insertData = $this->M_tax->insert_data($dataArray);
                if($insertData)
                {
                    echo json_encode(array("msg"=> "Inserted", "status"=>$insertData));
                }
            }
            else
            {
                $updateData = $this->M_tax->update_data($this->input->post('tax_id'), $dataArray);
                if($updateData)
                {
                    echo json_encode(array("msg"=> "Updated", "status"=>$updateData));
                }
                
            }
        }
        else
            {
                echo json_encode(array("msg"=> "No data", "status"=>0));
            }
    }

    public function delete_tax()
    {
        if($this->input->post())
        {
            $tax_id = $this->input->post('tax_id');
            $data = $this->M_tax->delete($tax_id);
            echo json_encode($data);
        }
    }
	
}
