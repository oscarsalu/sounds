<?php
/**
 * Locations File Doc Comment.
 *
 * @category Locations
 *
 * @author   99sound <admin@99sound.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 *
 * @link     http://www.99Sound.com/
 */
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Locations Class Doc Comment.
 *
 * @category Locations
 *
 * @author   99sound <admin@99sound.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 *
 * @link     http://www.99Sound.com/
 */
class Locations extends MX_Controller
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
        $this->load->model('M_find_location');
        $this->load->model('Events_model');

        $this->load->helper('string');
       $ac = $this->session->userdata('access');
         $data['redirect_url']=$this->curPageURL();
        if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }

        if ($this->session->userdata('loged_in') == false) {
            redirect('account/login');
        } else {
            $this->user_id = $this->session->userdata('loged_in');
            $user_data = $this->db->where('id='.$this->user_id)->get('users')->row_array();
        }
        if (!isset($ac)) {
            //redirect('access');
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
     * Function to check user.
     *
     * @param int $tour_id the id of tour
     * 
     * @return nothing, checks for tour & redirect accordingly.
     */
    public function check_user($tour_id)
    {
        $tour_data = $this->db->where('tour_id', $tour_id)->where('user_member', $this->user_id)->where('active', 1)->get('tours_member')->row_array();
        if (!isset($tour_data)) {
            redirect('the_total_tour');
        }
    }
    /**
     * Function to get locations.
     *
     * @param int $tour_id the id of tour
     * 
     * @return nothing, loads views of location.
     */
    public function locations($tour_id)
    {
        $this->check_user($tour_id);
        $this->session->set_userdata('target', 'target0');
        $member_id = $this->user_id;

        $this->load->library('googlemaps');

        $sub_find = $this->input->post('submit_form_find');
        if (isset($sub_find) && !empty($sub_find)) 
        {
            $location_country = $this->input->post('location_country');
            $location_state = $this->input->post('location_state');
            $location_city = $this->input->post('location_city');

            if (($location_country == '--Select--') && ($location_state == '--Select--') && ($location_city == '--Select--')) 
            {
                $locations = $this->M_find_location->locations_default();
                $this->session->set_flashdata('email_sent', 'The default address is canada');
                $returnData = array('msg'=>'The default address is canada');
                echo json_encode($returnData);
                die();
            }
            if (isset($location_country) && ($location_state == '--Select--') && ($location_city != '--Select--')) 
            {
                $locations = $this->M_find_location->location_city1($location_country, $location_city);
                if ($locations == false) {
                    $locations = $this->M_find_location->locations();

                    $this->session->set_flashdata('email_sent_err', 'No address found at: '.$location_city.'-'.$location_country);
                } else {
                    $locations = $this->M_find_location->location_city1($location_country, $location_city);
                }
            }
            if (isset($location_country) && ($location_country != '--Select--') && (($location_state == '--Select--') || ($location_state == null)) && ($location_city == '--Select--' || $location_city == null)) 
            {
                $locations = $this->M_find_location->location_country($location_country);
                if ($locations == false) {
                    $locations = $this->M_find_location->locations();

                    $this->session->set_flashdata('email_sent_err', 'No address found at: '.$location_country);
                } else {
                    $locations = $this->M_find_location->location_country($location_country);
                }
            }
            if (isset($location_country) && isset($location_state) && ($location_state != '--Select--') && (($location_city == '--Select--') || ($location_city == null))) 
            {
                $locations = $this->M_find_location->location_state($location_country, $location_state);
                if ($locations == false) {
                    $locations = $this->M_find_location->locations();
                    $this->session->set_flashdata('email_sent_err', 'No address found at .'.$location_state.'-'.$location_country);
                } else {
                    $locations = $this->M_find_location->location_state($location_country, $location_state);
                }
            }

            if (isset($location_country) && isset($location_state) && ($location_state != '--Select--') && isset($location_city) && $location_city != '--Select--') 
            {
                $locations = $this->M_find_location->location_city($location_country, $location_state, $location_city);
                if ($locations == false) {
                    $locations = $this->M_find_location->locations();
                    $this->session->set_flashdata('email_sent_err', 'No address found at:'.$location_city.'-'.$location_state.'-'.$location_country);
                } else {
                    $locations = $this->M_find_location->location_city($location_country, $location_state, $location_city);
                }
            }

            $config['zoom'] = 'auto';
            $this->googlemaps->initialize($config);
            if (isset($locations)) 
            {
                foreach ($locations as $location) {
                    $marker = array();
                    $lat = $location['lat'];
                    $lon = $location['lng'];
                    $marker['position'] = $lat.', '.$lon;
                    $marker['draggable'] = true;
                    $Address = $location['street1'].', '.$location['city'].', '.$location['state'].', '.$location['country'].'.';
                    $marker['infowindow_content'] = '<h2>'.$location['company'].'</h2><br><h3> Address:'.$Address.'</h3><div class="row text-right" id="content_send"><input type="hidden" value="'.$location['company'].'" class="val_company" /><a id="'.$location['email'].'" class="btn btn-info" onclick="set_val(this.id,$(this))"  data-toggle="modal" href="#modal-id">Email</a><a id="'.$location['email'].'" class="btn btn-info" onclick="set_book_val(this.id,$(this))"  data-toggle="modal" href="#bookShow" style="margin-left:20px">Book Show</a></div>';
                    $marker['animation'] = 'DROP';
                    $this->googlemaps->add_marker($marker);
                }
            }
        } else {
            $config['center'] = '43.66244420631505,-79.42328490422972';
            $config['zoom'] = 5;
            $this->googlemaps->initialize($config);
            $locations = $this->M_find_location->locations();
            if (isset($locations)) 
            {
                foreach ($locations as $location) {
                    $marker = array();
                    $lat = $location['lat'];
                    $lon = $location['lng'];
                    $marker['position'] = $lat.', '.$lon;
                    $marker['draggable'] = true;
                    $Address = $location['street1'].', '.$location['city'].', '.$location['state'].', '.$location['country'].'.';
                    $marker['infowindow_content'] = '<h2>'.$location['company'].'</h2><br><h3> Address:'.$Address.'</h3><div class="row text-right" id="content_send"><input type="hidden" value="'.$location['company'].'" class="val_company" /><a id="'.$location['email'].'" class="btn btn-info" onclick="set_val(this.id,$(this))"  data-toggle="modal" href="#modal-id">Email<input type="hidden" class="email_to" value="'.$location['email'].'"/></a><a id="'.$location['email'].'" class="btn btn-info" onclick="set_book_val(this.id,$(this))"  data-toggle="modal" href="#bookShow" style="margin-left:20px">Book Show</a></div>';
                    $marker['animation'] = 'DROP';
                    $this->googlemaps->add_marker($marker);
                }
            }
                   //location now and here
                   //  $lag_data = $this->checklocation();
                    // var_dump($lag_data[0]);exit;
                    $marker = array();
                $marker['position'] = '43.66244420631505,-79.42328490422972';
                $marker['infowindow_content'] = 'Hello World ! Your location!';
                $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
             $this->googlemaps->add_marker($marker);
        }
        $data['map'] = $this->googlemaps->create_map();

        if (isset($tour_id) && $tour_id) 
        {
            $data['check_member'] = $this->db->where('user_member', $this->user_id)->where('tour_id', $tour_id)->get('tours_member')->row_array();
            $tour_data = $this->db->where('tour_id', $tour_id)->get('tour')->row_array();
        }
        $data['user_data'] = $this->session->userdata('user_data');
        $data['tour'] = $tour_data;
        $data['countries'] = $this->M_find_location->countries();
        
        $data['tour_id'] = $tour_id;
        $user_id = $this->session->userdata('loged_in');
        $data['epks'] = $this->db->where('type', 'epk')->where('active', 1)->order_by('position', 'ASC')->get('template_lands')->result_array();
		
        $data['epk'] = $this->db->select('id,tpl_epk')->where('id = ', $user_id)->get('users')->row();
    //     $this->load->view('includes/header', $data);
    //     $this->load->view('includes/navbar', $data);
    //     $this->load->view('ttt/header_ttt', $data);
    //     $this->load->view('ttt/find_locations.php', $data);
    //     $this->load->view('includes/footer', $data);
            $this->load->view('ttt_new/find_locations.php', $data);
    }
    /**
     * Function to get lat & lang from loction.
     *
     * @param string $location the location
     * 
     * @return lat & lang of location.
     */
    public function find_lag($location)
    {
        $location = str_replace('#', '', $location);
        $address = urlencode($location);
        $googlemap_api_key = $this->config->item('googlemap_api_key');
        $url = "https://maps.googleapis.com/maps/api/geocode/json?key=$googlemap_api_key&address=$address&sensor=false";
        $getmap = file_get_contents($url);
        $googlemap = json_decode($getmap);
        foreach ($googlemap->results as $res) {
            $address = $res->geometry;
            $latlng = $address->location;
            //echo "Latitude: ". $latlng->lat ."<br />". "Longitude:". $latlng->lng;
            return $latlng;
        }
    }
    /**
     * Function to test ip location here and now.
     * 
     * @return ip location.
     */
    public function checklocation()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        $data = explode(',', $details->loc);

        return $data;
    }
    /**
     * Function to send mail.
     * 
     * @return nothing, send mail & redirect.
     */
    public function send_mail()
    {
        // Check for validation
            $this->form_validation->set_rules('mail_sent', 'Email sent', 'trim|required');
        $this->form_validation->set_rules('company', 'Company name', 'trim|required');
        $this->form_validation->set_rules('email_tos', 'Email to', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('email_sent_err', 'Please enter email.');
            $this->locations($this->input->post('id_tour'));
        } else {

                    // Storing submitted values
                    $email_from = $this->input->post('mail_sent');
            $company = $this->input->post('company');
            $email_to = $this->input->post('email_tos');
            $tour_id = $this->input->post('tour_id');

            $this->load->library('email');
            $config['protocol'] = 'smtp';
            $config['charset'] = 'utf-8';
            $config['mailtype'] = 'html';
            $config['newline'] = "\r\n";

            $subject = 'Sent email epk';
            $data_email['subject'] = $subject;
            $data_email['company'] = $company;
            $message = $this->load->view('email/epk_location', $data_email, true);
            
            
            //$email_from = $this->config->item('admin_email');
            $name_from = $this->config->item('admin_name');
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->from($email_from, $name_from);
            $this->email->reply_to($email_from, $name_from);
            $this->email->to($email_to);
            $this->email->subject($subject);
            $this->email->message($message);

            if ($this->email->send()) {
                $this->session->set_flashdata('email_sent', 'Email is send.');
                echo json_encode("success");
            } else {
                $this->session->set_flashdata('email_sent_err', 'Error sent email.');
                echo json_encode("failed");
            }
            
        }
        // redirect('/the_total_tour/find_locations/'.$tour_id);

    }
    /**
     * Function to get location state.
     * 
     * @return location state.
     */
    public function find_locations_state()
    {
        $options = '';
        if ($this->input->post('location_country')) {
            $provincia = $this->input->post('location_country');
                    //var_dump($provincia);exit;
                     $localidades = $this->M_find_location->location_address_state($provincia);
        }
        echo json_encode($localidades);
        die;
    }
    /**
     * Function to get location city.
     * 
     * @return location city.
     */
    public function find_locations_city()
    {
        $options = '';
        if ($this->input->post('location_state')) {
            $provincia = $this->input->post('location_state');
            //var_dump($provincia);exit;
            $localidades = $this->M_find_location->location_address_city($provincia);
            //var_dump($localidades);exit;
            foreach ($localidades as $fila) {
                echo '<option value='.$fila['city'].'>';
                echo $fila['city'];
                echo '</option>';
            }
        }
    }
    /**
     * Function to find locations.
     * 
     * @return locations.
     */
    public function find_locations()
    {
        $location_country = $this->input->post('location_country');
        $location_state = $this->input->post('location_state');
        $location_city = $this->input->post('location_city');
        if (isset($location_country) && (($location_state == '--Select--') || ($location_state == null)) && ($location_city == '--Select--' || $location_city == null)) {
            $locations = $this->M_find_location->location_country($location_country);
            if ($locations == false) {
                $locations = $this->M_find_location->locations();

                $this->session->set_flashdata('email_sent_err', 'Can not find address 1 .');
            } else {
                $locations = $this->M_find_location->location_country($location_country);
            }
        }
        if (isset($location_country) && isset($location_state) && (($location_city == '--Select--') || ($location_city == null))) {
            $locations = $this->M_find_location->location_country($location_country, $location_state);
            if ($locations == false) {
                $locations = $this->M_find_location->locations();
                $this->session->set_flashdata('email_sent_err', 'Can not find address  2.');
            } else {
                $locations = $this->M_find_location->location_country($location_country, $location_state);
            }
        }
        //var_dump($locations);exit;
        if (isset($location_country) && isset($location_state) && isset($location_city)) {
            $locations = $this->M_find_location->location_city($location_country, $location_state, $location_city);
            if ($locations == false) {
                $locations = $this->M_find_location->locations();
                $this->session->set_flashdata('email_sent_err', 'Can not find address 3 .');
            } else {
                $locations = $this->M_find_location->location_city($location_country, $location_state, $location_city);
            }
        }
        // var_dump($locations);exit;
        return $locations;
        //$this->text();  
    }
}
