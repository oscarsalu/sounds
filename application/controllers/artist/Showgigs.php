<?php

class Showgigs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->model('M_tour');
        $this->load->model('Events_model');
        $ac = $this->session->userdata('access');
      
         $data['redirect_url']=$this->curPageURL();
        if (!isset($ac)) {
            redirect("access?redirect_url=".$data['redirect_url']);
        }
        if ($this->session->userdata('loged_in') == false) {
            redirect('account/login');
        } else {
            $this->user_id = $this->session->userdata('loged_in');
            $user_data = $this->db->where('id='.$this->user_id)->get('users')->row_array();
        }
        $this->config->load('googleplus');
        $this->load->library('googlemaps');
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
     * Check location.
     **/
    public function checklocation()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        if(!isset($details->loc))
			return false;
		else
        $data = explode(',', $details->loc);

        return $data;
    }
    /**
     * View show gigs.
     **/
    public function index($a, $b)
    {
        $lag_data = $this->checklocation();
        $data['map'] = null;
        $data['ra'] = null;
        $la = $this->input->get('la');
        $lo = $this->input->get('lo');
        $ra = $this->input->get('a');
		$sort = $this->input->get('sortVenue');
		$condition = "";
		if($sort == "rating")
		{
			$condition = "e.sum_star desc";			
		}
		else if($sort == "seating")
		{
			$condition = "e.capacity desc";
		}
		else if($sort == "nma")
		{
			$condition = "e.event_title asc";
		}
		else if($sort == "nmd")
		{
			$condition = "e.event_title desc";
		}
		else
		{
			$condition = "e.event_id desc";
		}
        $ck_genres = $this->input->get('ckGenges');
        $ck_similar = $this->input->get('ckSimilar');
        $ck_where = $this->input->get('ckWhere');

        $opt_genres = $this->input->get('genres');
        $opt_similar = $this->input->get('similar');
        $art_name = $this->input->get('aName');
		if(!empty($lag_data[0]) && !empty($lag_data[1]))
		{
        $a = $lag_data[0];
        $b = $lag_data[1];
		}
        if ($la != null && $lo != null) {
            $a = $la;
            $b = $lo;
        }

        $admin = $this->session->userdata('is_admin');
        $radius = 25;
        if ($ra != null && $ra != 0) {
            if (is_numeric($ra)) {
                $radius = $ra;
            }
        }

        if ($this->input->get('pac-input')) {
            //var_dump($this->input->get('pac-input'));exit;
            $this->session->set_userdata('data_show_location', $this->input->get('pac-input'));
        } else {
            $this->session->set_userdata('data_show_location', '');
            //var_dump(2);exit;
        }//exit;

        $data['ra'] = $radius;
        $date = new DateTime();
        $center_la = $a;
        $center_lo = $b;

        //$artist_la = 21.024239301125256;$artist_lo= 105.84308619160151;//ha noi    
        if (isset($admin) && $admin == 1) {
            $data['is_admin'] = $admin;
        }

        $data['events'] = $this->db->select('*')
                ->from('events as e')
                ->join('location as l', 'l.location_id = e.location_id')
                ->order_by('e.capacity', 'desc')
                ->get()->result_array();
        if ($ck_similar == null && $ck_genres == null && $ck_where == null) {
            $data['events'] = $this->db->select('*')
                    ->from('events as e')
                    ->join('location as l', 'l.location_id = e.location_id')
                    ->order_by($condition)
                    ->get()->result_array();
        } elseif ($ck_similar != null && $ck_genres == null && $ck_where == null) {
            if ($opt_similar == 'sort_time') {
                $data['events'] = $this->db->select('*')
                        ->from('events as e')
                        ->join('location as l', 'l.location_id = e.location_id')
                        ->order_by('e.event_start_date', 'desc')
                        ->order_by($condition)
                        ->get()->result_array();
            } elseif ($opt_similar == 'new_event') {
                $data['events'] = $this->db->select('*')
                        ->from('events as e')
                        ->join('location as l', 'l.location_id = e.location_id')
                        ->order_by('e.event_id', 'desc')
                        ->order_by($condition)
                        ->get()->result_array();
            } else {
                $data['events'] = $this->db->select('*')
                                    ->from('events as e')
                                    ->join('location as l', 'l.location_id = e.location_id')
                                    ->order_by($condition)
                                    ->get()->result_array();
            }
        } elseif ($ck_similar == null && $ck_genres != null && $ck_where == null) {
            $data['events'] = $this->db->select('*')
                    ->from('events as e')
                    ->join('location as l', 'l.location_id = e.location_id')
                    ->join('users as u', 'u.id = e.user_id')
                    ->join('genres as g', 'g.id = e.categories')
                    ->where('g.id', $opt_genres)
                    ->order_by($condition)
                    ->get()->result_array();
        } elseif ($ck_similar == null && $ck_genres == null && $ck_where != null) {
            $data['events'] = $this->db->select('*')
                    ->from('events as e')
                    ->join('location as l', 'l.location_id = e.location_id')
                    ->join('users as u', 'u.id = e.user_id')
                    ->join('genres as g', 'g.id = e.categories')
                    ->like('u.artist_name', $art_name)
                    ->order_by($condition)
                    ->get()->result_array();
                //var_dump($data['events']);exit;
        } elseif ($ck_similar != null && $ck_genres != null && $ck_where == null) {
            if ($opt_similar == 'sort_time') {
                $data['events'] = $this->db->select('*')
                        ->from('events as e')
                        ->join('location as l', 'l.location_id = e.location_id')
                        ->join('users as u', 'u.id = e.user_id')
                        ->join('genres as g', 'g.id = e.categories')
                        ->where('g.id', $opt_genres)
                        ->order_by('e.event_start_date', 'asc')
                        ->order_by($condition)
                        ->get()->result_array();
                        //var_dump($data['events']);exit;
            } elseif ($opt_similar == 'new_event') {
                $data['events'] = $this->db->select('*')
                        ->from('events as e')
                        ->join('users as u', 'u.id = e.user_id')
                        ->join('location as l', 'l.location_id = e.location_id')
                        ->join('genres as g', 'g.id = e.categories')
                        ->where('g.id', $opt_genres)
                        ->order_by($condition)
                        ->get()->result_array();
                        // var_dump($data['events']);exit;
            } else {
                $data['events'] = $this->db->select('*')
                                    ->from('events as e')
                                    ->join('location as l', 'l.location_id = e.location_id')
                                    ->join('users as u', 'u.id = e.user_id')
                                    ->join('genres as g', 'g.id = e.categories')
                                    ->where('g.id', $opt_genres)
                                    ->order_by('e.capacity', 'desc')
                                    ->order_by($condition)
                                    ->get()->result_array();
            }
        } elseif ($ck_similar != null && $ck_genres != null && $ck_where != null) {
            if ($opt_similar == 'sort_time') {
                $data['events'] = $this->db->select('*')
                        ->from('events as e')
                        ->join('location as l', 'l.location_id = e.location_id')
                        ->join('users as u', 'u.id = e.user_id')
                        ->join('genres as g', 'g.id = e.categories')
                        ->where('g.id', $opt_genres)
                        ->like('u.artist_name', $art_name)
                        ->order_by('e.event_start_date', 'asc')
                        ->order_by($condition)
                        ->get()->result_array();
                        //var_dump($data['events']);exit;
            } elseif ($opt_similar == 'new_event') {
                $data['events'] = $this->db->select('*')
                        ->from('events as e')
                        ->join('users as u', 'u.id = e.user_id')
                        ->join('location as l', 'l.location_id = e.location_id')
                        ->join('genres as g', 'g.id = e.categories')
                        ->where('g.id', $opt_genres)
                        ->order_by($condition)
                        ->like('u.artist_name', $art_name)
                        ->get()->result_array();
                        // var_dump($data['events']);exit;
            } else {
                $data['events'] = $this->db->select('*')
                                    ->from('events as e')
                                    ->join('location as l', 'l.location_id = e.location_id')
                                    ->join('users as u', 'u.id = e.user_id')
                                    ->join('genres as g', 'g.id = e.categories')
                                    ->where('g.id', $opt_genres)
                                    ->like('u.artist_name', $art_name)
                                    ->order_by('e.capacity', 'desc')
                                    ->order_by($condition)
                                    ->get()->result_array();
            }
        } elseif ($ck_similar == null && $ck_genres != null && $ck_where != null) {
            $data['events'] = $this->db->select('*')
                                ->from('events as e')
                                ->join('location as l', 'l.location_id = e.location_id')
                                ->join('users as u', 'u.id = e.user_id')
                                ->join('genres as g', 'g.id = e.categories')
                                ->where('g.id', $opt_genres)
                                ->like('u.artist_name', $art_name)
                                ->order_by($condition)
                                ->get()->result_array();
        } else {
            $data['events'] = $this->db->select('*')
                ->from('events as e')
                ->join('location as l', 'l.location_id = e.location_id')
                ->order_by($condition)
                ->get()->result_array();
        }

        $data['genres'] = $this->db->get('genres')->result_array();
        $listE = array();

        if ($data['events'] != null) {
            foreach ($data['events'] as $e) {
                $d = $this->distance($center_la, $center_lo, $e['latitude'], $e['longitude'], 'K');

                if ($d <= $radius) {
                    $d = round($d, 2);
                    //$sum_start= $this->M_tour->check_user_event_star($e['event_id'],$e['user_id']);
                    //var_dump($sum_start);exit;
                    $insertArr = array(
                                'event_id' => $e['event_id'],
                                'tour_id' => $e['tour_id'],
                                'location_id' => $e['location_id'],
                                'event_title' => $e['event_title'],
                                'sum_star' => $e['sum_star'],
                                'event_desc' => $e['event_desc'],
                                'posted_by' => $e['posted_by'],
                                'event_start_date' => $e['event_start_date'],
                                'event_end_date' => $e['event_end_date'],
                                'location' => $e['location'],
                                'user_id' => $e['user_id'],
                                'categories' => $e['categories'],
                                'latitude' => $e['latitude'],
                                'longitude' => $e['longitude'],
                                'distance' => $d,
                                'capacity' => $e['capacity'],
                                'address' => $e['address'],
                                'city' => $e['city'],
                                'state' => $e['state'],
                                'country' => $e['country'],
                                'event_banner' => $e['event_banner'],
                    );

                    array_push($listE, $insertArr);
                }
            }//exit;
        }
        $data['posi'] = array(
            'la' => $center_la,
            'lo' => $center_lo,
        );
        //var_dump($listE); exit; 

        $data['events'] = $listE;
        $data['map'] = $this->loadMap($center_la, $center_lo, $radius, $data['events']);
        //$data['map']=$this->loadMapSearch();
         //loadMapSearch
		$data['sort'] = $this->input->get('sortVenue');
        $data['tours'] = $this->M_tour->getwheres_orderby('tour', array('user_id' => $this->user_id), 'updated_on desc');
        $data['genres'] = $this->db->get('genres')->result_array();
        $data['user_data'] = $this->session->userdata('user_data');
		$data['apikey'] = $this->config->item('googlemap_api_key');
		$user_id = $this->session->userdata('loged_in');
		$data['epks'] = $this->db->where('type', 'epk')->where('active', 1)->order_by('position', 'ASC')->get('template_lands')->result_array();
		
        $data['epk'] = $this->db->select('id,tpl_epk')->where('id = ', $user_id)->get('users')->row();
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('artist/showgigs', $data);
        $this->load->view('includes/footer', $data);
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        if (empty($lat2)) {
            $lat2 = 0;
        }
        if (empty($lon2)) {
            $lon2 = 0;
        }
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit == 'K') {
            return $miles * 1.609344;
        } elseif ($unit == 'N') {
            return $miles * 0.8684;
        } else {
            return $miles;
        }
    }

    /**
     * Load Map.
     **/
    public function loadMap($lat, $lon, $setRadius, $dataEvent)
    {
        $config['apikey'] = $this->config->item('googlemap_api_key');
        //$config['center'] = '37.4419, -122.1419';
        //var_dump($dataEvent);exit;
        $config['center'] = $lat.', '.$lon;
        $config['zoom'] = 'auto';
        $config['places'] = true;
        $config['placesAutocompleteInputID'] = 'pac-input';
        $config['placesAutocompleteBoundsMap'] = true; // set results biased towards the maps viewport
        $config['placesAutocompleteOnChange'] = '
                markers_map[0].setVisible(false);
                var place = placesAutocomplete.getPlace();
                if (!place.geometry) {
                  return;
                }
                
                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                  map.fitBounds(place.geometry.viewport);
                  map.setZoom(15);
                } else {
                  map.setCenter(place.geometry.location);
                  map.setZoom(15);
                }
                
                markers_map[0].setPosition(place.geometry.location);
                markers_map[0].setIcon("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000");
                markers_map[0].setDraggable(true);
                markers_map[0].setVisible(true);
                $(\'#a1\').find("#search").find("#la").val(place.geometry.location.lat());
                                $(\'#a1\').find("#search").find("#lo").val(place.geometry.location.lng());
                ';
        $this->googlemaps->initialize($config);
        $marker = array();
        $marker['infowindow_content'] = 'Current Location';
        $marker['position'] = $lat.', '.$lon;
        
        //$marker['infowindow_content'] ='<h2>'.$location['company'].'</h2><br><h3> Address:'.$Address.'</h3><div class="row text-right" id="content_send"><input type="hidden" value="'.$location['company'].'" class="val_company" /><a id="'.$location['email'].'" class="btn btn-info" onclick="set_val(this.id,$(this))"  data-toggle="modal" href="#modal-id">Email<input type="hidden" class="email_to" value="'.$location['email'].'"/></a></div>';

        //$marker['title'] = 'Your location';
        $marker['draggable'] = true;
        $marker['ondragend'] = '$(\'#a1\').find("#search").find("#la").val(event.latLng.lat());
                                $(\'#a1\').find("#search").find("#lo").val(event.latLng.lng());    
                                alert(\'You just dropped me at: \' + event.latLng.lat() + \', \' + event.latLng.lng())';
        $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
       // $marker['onclick'] = 'alert("You just clicked me!!")';
        $this->googlemaps->add_marker($marker);
        if ($dataEvent != null) {
            foreach ($dataEvent as $e) {
                $marker = array();
                $marker['position'] = $e['latitude'].', '.$e['longitude'];
                    //$marker['infowindow_content'] = $e['event_title'].', '.$e['location'];
                    if (!empty($e['event_banner'])) {
                        $url_image = base_url().'uploads/'.$e['user_id'].'/photo/banner_events/'.$e['event_banner'];
                    } else {
                        $url_image = base_url().'assets/images/icon/manager_git_event.png';
                    }
                if (!empty($e['tour_id'])) {
                    $tour = $e['tour_id'];
                } else {
                    $tour = '';
                }
                if (!empty($e['location_id'])) {
                    $location = $e['location_id'];
                } else {
                    $location = '';
                }
                if (!empty($e['user_id'])) {
                    $user = $e['user_id'];
                } else {
                    $user = '';
                }
                if (!empty($e['event_id'])) {
                    $event = $e['event_id'];
                } else {
                    $event = '';
                }
                $sum_star = 20 * $e['sum_star'];
                //$marker['infowindow_content'] = 'Hello....';
                $marker['infowindow_content'] = '<div class="row"><div class="col-md-4"><img src="'.$url_image.'" alt="" width="100%"></div><div class="col-md-8"><div class="row"><h3>'.$e['location'].'</h3><p class="fa fa-map-pin"> + '.$e['distance'].' Km away</p></div><div class="row"><div class="col-sm-6"><div class="rating-container rating-xs rating-animate"><div class="rating"><span class="empty-stars"><span class="star"><i class="glyphicon glyphicon-star-empty"></i></span><span class="star"><i class="glyphicon glyphicon-star-empty"></i></span><span class="star"><i class="glyphicon glyphicon-star-empty"></i></span><span class="star"><i class="glyphicon glyphicon-star-empty"></i></span><span class="star"><i class="glyphicon glyphicon-star-empty"></i></span></span><span class="filled-stars" style="width: '.$sum_star.'%;"><span class="star"><i class="glyphicon glyphicon-star"></i></span><span class="star"><i class="glyphicon glyphicon-star"></i></span><span class="star"><i class="glyphicon glyphicon-star"></i></span><span class="star"><i class="glyphicon glyphicon-star"></i></span><span class="star"><i class="glyphicon glyphicon-star"></i></span></span></div></div><input type="hidden" value="'.$location.'" class="val_location" /><input type="hidden" value="'.$user.'" class="val_user" /><input type="hidden" value="'.$tour.'" class="val_tour" /><a id="'.$user.'" class="btn btn-info" onclick="set_val_book(this.id,$(this))"  data-toggle="modal" href="#booking_request">Book Venue</a></div><div class="col-sm-6 text-center"><input type="hidden" value="'.$e['location'].'" class="location_val" /><input type="hidden" value="'.$e['event_title'].'" class="val_title" /><input type="hidden" value="'.$e['event_end_date'].'" class="val_end" /><input type="hidden" value="'.$e['event_start_date'].'" class="val_start" /><a id="'.$event.'" style="margin-bottom: 20px;" class="btn btn-default" onclick="set_val_info(this.id,$(this))"  data-toggle="modal" href="#venue_info">Venue Info</a><input type="hidden" class="tour_comment_val"  value="'.$user.'"/><input type="hidden" class="location_comment_val" value="'.$location.'"/><a id="'.$event.'" class="btn btn-default" onclick="set_val_add_venues(this.id,$(this))"  data-toggle="modal" href="#rate_venue">ADD Venue Info</a></div></div></div></div>';
                $marker['title'] = $e['event_title'];
                $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
                    //$marker['onclick'] = 'alert("You just clicked me!!")';

                    $this->googlemaps->add_marker($marker);
            }//exit;
        }
        //var_dump($this->googlemaps->create_map());exit;
        return $this->googlemaps->create_map();
    }

    public function get_star()
    {
        $event = $this->input->post('event_star');
        $user_id = $this->input->post('user');
        //var_dump($this->M_tour->check_user_event($event));exit;      
        if ($this->M_tour->check_user_event($event) == true) {
			echo "inside";
            $updateArr = array(
                    'user_id' => $this->input->post('user'),
                    'event_id' => $event,
                    'location_id' => $this->input->post('location_star'),
                    'tour_id' => $this->input->post('tour_star'),
                    'start' => $this->input->post('star_oke'),
                    'rate' => $this->input->post('rate'),
                 );
			
			if($this->M_tour->check_user_event_star($event,$user_id) == "no")
			{
				$condition = array(
							'user_id' => $user_id,
							'event_id' => $event,
							);
				$this->db->where($condition);
				$this->db->update('venues_info',$updateArr);
			}
			else
			{
            $this->db->insert('venues_info', $updateArr);
			}
            $data2 = array(
                        'sum_star' => $this->M_tour->calculate_star($event),

                 );
            $this->M_tour->sum_star($event, $data2);

            $data = array('status' => true,
                          'star' => $this->M_tour->calculate_star($event),
                 );
           
        } else {
            $data = array('status' => false,
                           'star' => $this->M_tour->calculate_star($event),
              );

            $data2 = array(
                        'sum_star' => $this->M_tour->calculate_star($event),

                 );
            $this->M_tour->sum_star($event, $data2);
        }
        echo json_encode($data);
        die;
    }
    public function sum_star($event, $data)
    {
        $update = $this->db->where('event_id', $event)
                           ->update('events', $data);
    }
    //commentting
    public function rate_venue()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('comment_rate', 'comment_rate', 'required|trim|min_length[13]|max_length[500]');
        if ($this->form_validation->run() != false) {
            $var = array('info_venues' => $this->input->post('comment_rate'),
                          'event_id' => $this->input->post('event_comment'),
                          'user_id' => $this->input->post('user_comment'),
                          'location_id' => $this->input->post('location_comment'),
                          'tour_id' => $this->input->post('tour_comment'),
                          'status' => '1',
                        );
            $check = $this->M_tour->insert_info('venues_info', $var);
            if ($check != false) {
                $name = $this->M_tour->name_show($this->input->post('user_comment'));
                foreach ($name as $n) {
                    $names = $n['lastname'];
                }
                $data = array('status' => 'oke_comment_rate',
                               'comment' => htmlentities($this->input->post('comment_rate')),
                               'name' => $names,
                               'event' => $this->input->post('event_comment'),
                               'user' => $this->input->post('user_comment'),
                               'stt' => $check,
                  );
            } else {
                $data = array('status' => 'not_insert',
                                'comment' => 'not',

                  );
            }
        } else {
            $data = array('status' => 'not_comment_rate',
                           'comment' => 'not',
              );
        }
        echo json_encode($data);
        die;
    }
    public function booking_request()
    {
		$this->load->model('M_photo');
        $this->load->model('Member_model');
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email_booking', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('expected_draw', 'Expected Draw', 'required|trim');
        $this->form_validation->set_rules('date_booking_from', 'date - from', 'required');
        $this->form_validation->set_rules('date_booking_to', 'date - to', 'required');
        $this->form_validation->set_rules('message_booking', 'message_booking', 'trim|max_length[1000]');
        if ($this->form_validation->run() != false) {
			if($this->input->post('email_book') == "")
			{
            $var = array('location_id' => $this->input->post('location_booking'),
                          'tour_id' => $this->input->post('tour_booking'),
                          'email_from' => $this->input->post('email_booking'),
                          'expected_draw' => $this->input->post('expected_draw'),
                          'message' => $this->input->post('message_booking'),
                          'contact_info' => $this->input->post('contact_booking'),
                          'date_from' => $this->input->post('date_booking_from'),
                          'date_to' => $this->input->post('date_booking_to'),
                        );
            $check = $this->M_tour->insert_info('venues_books', $var);
			}
			else
				$check = true;
            if ($check == true) {
                //sent mail              
                // Storing submitted values   
                    $email = $this->M_tour->name_show($this->input->post('user_booking'));
                if ($email != false) {
                    foreach ($email as $e) {
                        $email_to = $e['email'];
                    }
                }
				if($this->input->post('email_book') != "")
				{
					$email_to = $this->input->post('email_book');
				}
				//$email_to = "johnlast98765@gmail.com";
                $email_from = $this->input->post('email_booking');
                //echo $email_to; exit;
              /*   $config = Array(
'protocol' => 'smtp',
'smtp_host' => 'smtp.gmail.com',
'smtp_port' => 465,
'smtp_user' => '99sound.info@gmail.com',// your mail name
'smtp_pass' => '99sound.com',
'mailtype'  => 'html', 
'charset'   => 'iso-8859-1',
 'wordwrap' => TRUE
);*/
                
                
                $this->load->library('email');
                $config['protocol'] = 'smtp';
                $config['charset'] = 'utf-8';
                $config['mailtype'] = 'html';
                $config['newline'] = "\r\n";
                $subject = 'Book Show';
                //$message = $this->input->post('message_booking');
                $message_body = $this->input->post('message_booking');
                $tpl_email = $this->input->post('template_num');
                $email_from = $this->config->item('admin_email');
                $name_from = $this->config->item('admin_name');
                
                $message_body = $message_body."<br>Available Dates:".$this->input->post('date_booking_from')." to ".
                $this->input->post('date_booking_to')."<br>Expected Draw:".$this->input->post('expected_draw')."<br>Contact Info:".$this->input->post('contact_booking')."<br>Please check Below EPK";
                $user_id = $this->session->userdata('loged_in');
				$user_data = $this->session->userdata('user_data');
                $data['avata'] = $this->M_user->get_avata($user_id);
            $data['country_code'] = $this->db->where('id', $user_data['countries'])->get('countries')->row_array();
            $data['genres'] = $this->db->where('id', $user_data['genre'])->get('genres')->row_array();
            $data['user_data'] = $user_data;
            $data['message_body'] = $message_body;
            $data['songs'] = $this->db->where('user_id', $user_id)->limit(5)->order_by('id', 'DESC')->get('audio_song')->result_array();
            $data['photos'] = $this->db->where('user_id', $user_id)->limit(5)->order_by('id', 'DESC')->get('photos')->result_array();
            $data['press'] = $this->db->where('artist_id', $user_id)->limit(5)->order_by('id', 'DESC')->get('press')->result_array();
            $data['videos'] = $this->db->where('user_id', $user_id)->order_by('id', 'DESC')->get('videos')->result_array();
            $data['customize'] = $this->db->where('user_id', $user_id)->get('customize_epk')->row_array();
            $data['country'] = $this->db->where('id', $user_data['countries'])->get('countries')->row_array();
            $data['genre'] = $this->db->where('id', $user_data['genre'])->get('genres')->row_array();
            $data['groups_member'] = $this->db->where('artist_id', $user_id)->order_by('id', 'DESC')->get('groups_member')->result_array();
            $data['num_songs'] = $this->db->where('user_id', $user_id)->count_all_results('audio_song');
            $data['songs'] = $this->db->where('user_id', $user_id)->order_by('id', 'DESC')->get('audio_song')->result_array();
            $data['videos'] = $this->db->where('user_id', $user_id)->order_by('id', 'DESC')->get('videos')->result_array();
            $data['num_video'] = $this->db->where('user_id', $user_id)->count_all_results('videos');
            $data['photos'] = $this->db->where('user_id', $user_id)->limit(4)->order_by('id', 'DESC')->get('photos')->result_array();
            $data['fans'] = $this->db->select('fans.* ,users.birthday,users.gender')->from('fans')->where('fans.user_id', $user_id)->join('users', 'fans.fan_id = users.id')->join('photos', 'fans.fan_id = photos.user_id', 'left')->get()->result_array();
            $data['press'] = $this->db->where('artist_id', $user_id)->order_by('id', 'DESC')->get('press')->result_array();
			
            

			$data['photo'] = $this->M_photo->getPhotoProfile($user_id);
            $results = $this->db->get_where('users', array(
                'home_page' => $user_data['home_page'],
            ))->row_array();
			
			
            $data['res_data_artist'] = $results;
            $message = $message_body;
            if ($tpl_email == 1) {
                $message = $this->load->view('email/presskit1', $data, true);
            } elseif ($tpl_email == 2) {
                $message = $this->load->view('email/presskit2', $data, true);
            } elseif ($tpl_email == 3) {
                $message = $this->load->view('email/presskit3', $data, true);
            } elseif ($tpl_email == 4) {
                $message = $this->load->view('email/presskit4', $data, true);
            } elseif ($tpl_email == 5) {
                $message = $this->load->view('email/presskit5', $data, true);
            } elseif ($tpl_email == 6) {
                $message = $this->load->view('email/presskit6', $data, true);
            }
            $this->init_customize_epk($user_id);
            $message_body = $message_body."<br>".$message;    
            //echo $message;exit;    
                //$email_to = "johnlast98765@gmail.com"; 
                $this->email->initialize($config);
                $this->email->clear();
                $this->email->from($email_from, $name_from);
                $this->email->reply_to($email_from, $name_from);
                $this->email->to($email_to);
                $this->email->subject($subject);
                $this->email->message($message_body);
                if ($this->email->send()) {
                    $data = array('status' => 'success_sent_email',
                           );
                } else {
					 print_r($this->email->print_debugger());  
                    $data = array('status' => 'error_sent_email',
                            );
                }
              //end sent mail
            } else {
                $data = array('status' => 'error_data',
                  );
            }
        } else {
            $data = array('status' => 'error_form',
              );
        }
        echo json_encode($data);
        die;
    }
        /**
     * create new custommize epk.
     *
     * @param int $user_id
     **/
    public function init_customize_epk($user_id)
    {
        $arr_json = array(
            'photo' => 'on',
            'video' => 'on',
            'stats' => 'on',
            'song' => 'on',
            'press' => 'on',
            'show' => 'on',
            'dw_photo' => 'on',
            'dw_bios' => 'on',
            'dw_song' => 'on',
            'email_artist' => null,
            'email_booking' => null,
            'email_manager' => null,
        );
        $json = json_encode($arr_json);
        $data_custom = $this->db->where('user_id', $user_id)->get('customize_epk')->row_array();
        if (empty($data_custom)) {
            $insertArr = array(
                'user_id' => $user_id,
                'data_customize' => $json,
                'email_artist' =>'',
            'email_booking' =>'',
            'email_manager' => '',
            );
            $this->db->insert('customize_epk', $insertArr);
        }
    }
    public function delete_comment()
    {
        if ($this->input->post('user_delete') == $this->input->post('user_dele')) {
            $check = $this->M_tour->delete_comment($this->input->post('event_delete'), $this->input->post('user_delete'), $this->input->post('id_delete'));
            if ($check == true) {
                $data = array('status' => 'oke_delete',
                  'event' => $this->input->post('id_delete'),
                );
            } else {
                $data = array('status' => 'no',
                  'event' => '',
                );
            }
        } else {
            $data = array('status' => 'no',
                  'event' => '',
                );
        }
        echo json_encode($data);
        die;
    }
}
