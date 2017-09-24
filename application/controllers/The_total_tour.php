<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Social_media.
 *
 * @author utkarsh
 */
class The_total_tour extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->model('M_tour');
        $this->load->model('M_text');
        $this->load->model('M_channel');
        $this->load->model('M_fan');
        $this->load->model('Events_model');
        $this->load->model('M_schedules');
        $this->load->model('M_invite_user');
        
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

        if ($this->session->userdata('loged_in') == false) {
            redirect('account/login');
        } else {
            $this->user_id = $this->session->userdata('loged_in');
            $user_data = $this->db->where('id='.$this->user_id)->get('users')->row_array();
            $this->user_data = $user_data;
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
    public function index()
    {
        $this->session->set_userdata('target', 'target0');
         $this->config->load('googleplus');
         $this->load->library('googlemaps');
        $data['apikey'] = $this->config->item('googlemap_api_key');
        $config['apikey'] = $this->config->item('googlemap_api_key');
        $admin = $this->session->userdata('is_admin');
        if (isset($admin) && $admin == 1) {
            $data['is_admin'] = $admin;
        }

        $data['countries'] = $this->db->select('country')->from('db_locations')->distinct('country')->get()->result_array();
        $data['events'] = $this->db->select('*')
                ->from('events')
                ->where('user_id', $this->user_id)
                ->order_by('event_id', 'desc')
                ->get()->result_array();

        //$data['tours'] = $this->M_tour->getwheres_orderby('tour',array('user_id'=>$this->user_id),'updated_on desc');

        $data['tours'] = $this->db->select('t.*,u.*,tm.tour_id as t_id')
            ->from('tour as t')
            ->distinct()
            ->or_where('u.id', $this->user_id)
            ->or_where('tm.user_member', $this->user_id)
            //->where('u.is_admin ',0)
            ->where('tm.active ', 1)
            ->join('users as u', 'u.id = t.user_id', 'left')
            ->join('tours_member as tm', 'tm.tour_id = t.tour_id', 'left')
            ->get()->result_array();
        $data['genres'] = $this->db->get('genres')->result_array();
        $data['user_data'] = $this->session->userdata('user_data');
        
        $user_id = $this->session->userdata('loged_in');
        $data['epks'] = $this->db->where('type', 'epk')->where('active', 1)->order_by('position', 'ASC')->get('template_lands')->result_array();
		
        $data['epk'] = $this->db->select('id,tpl_epk')->where('id = ', $user_id)->get('users')->row();
        
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        
        //$this->load->view('ttt/header_index_ttt',$data);
        $this->load->view('ttt_new/ttt', $data);
        $this->load->view('includes/footer', $data);
    }
    public function home()
    {
        $this->load->view('ttt_new/home');
    }
    public function save_tour()
    {
        if ($this->input->post('tour')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('tour', 'tour', 'callback_tour_field_check');
            if ($this->form_validation->run() == false) {
                $data = array(
                    'status' => 0,
                    'msg' => strip_tags(validation_errors()),
                    );
            } else {
                $tour = $this->input->post('tour');
                /* user id would be change at final test*/
                $data_tour = array('tour' => $tour, 'tour_slug' => (str_replace(' ', '-', $tour).'-'.time()), 'updated_on' => time());
                $tour_id = $this->input->post('tour_id');
             
                if (!empty($tour_id)) {
                    $where = array(
                            'tour_id' => $this->input->post('tour_id'),
                        );
                    $udate = $this->M_tour->update_data('tour', $where, $data_tour);
                    if ($udate) {
                        $data = array(
                        'status' => 1,
                        'msg' => 'Tour Updated!!!',
                        );
                    } else {
                        $data = array(
                            'status' => 0,
                            'msg' => 'Server Error!!!',
                            );
                    }
                } else { 
                    $data_tour['user_id'] = $this->user_id;
                    $data_tour['created_on'] = time();

                    $insert = $this->M_tour->insert_data('tour', $data_tour);
					$tour_id = $this->db->insert_id();
                    if ($insert==true) {
                        //$user_data = $this->user_data;

                         $data_tour1['location_id'] = "0";
                        //$data_tour1['tele'] = $user_data['phone'];
                        //$data_tour1['email'] = $user_data['email']; */
                       $data_tour1['date'] = date('Y-m-d');
                       /* $data_tour1['name'] = $user_data['firstname'].' '.$user_data['lastname'];
                        $data_tour1['address'] = $user_data['address'];
                        $data_tour1['reserv'] = '';
                        $data_tour1['press'] = '';
                        $data_tour1['addInfo'] = $user_data['bio']; */

                        $insert1 = $this->M_tour->insert_data('cont_promotor', $data_tour1);

                        $member = array();
                        $member['tour_id'] = $insert;
                        $member['location_id'] = "0";
                        $member['user_create_id'] = $this->user_id;
                        $member['user_member'] = $this->user_id;
                        $member['active'] = 1;
                        $member['press'] = '';
                        $member['manager_member'] = 1;
                        $member['manager_event'] = 1;
                        $member['manager_cacula'] = 1;
                        $member['manager_schedule'] = 1;
                        $member['name'] = '';
                        $member['color_front'] = '#fc0000';
                        $member['create_date'] = date('Y-m-d H:i:s');
                        $member['code_active'] = '';
                        $member['type'] = 'admin';
                        $member['cont_id'] = $insert1;

                        $this->db->insert('tours_member', $member);
                        $channel_name = $this->M_tour->get_tour_name($insert);
                        $dataArray = array('name'=> $channel_name, 'user_id'=> $this->session->userdata('loged_in'), 'type' =>'private', 'time'=> time(), 'is_admin'=> 0, 'group_type'=>'tour', 'group_id'=>$insert);
                        $this->M_channel->save($dataArray);

                        $data = array(
                        'status' => 1,
                        'tour_id' => $tour_id,
                        'msg' => 'Tour Added!!!',
                        );
                    } else {
                        $data = array(
                            'status' => 0,
                            'msg' => 'Server Error!!!',
                            );
                    }
                }
            }
            echo json_encode($data);
            die;
        }
   }
    public function tour_field_check($str)
    {
        if ($str == '') {
            $this->form_validation->set_message('tour_field_check', '<div class="alert alert-danger"> %s field must required.</div>');

            return false;
        } else {
            return true;
        }
    }
    public function get_destinations()
    {
        $tours = $this->M_tour->getwheres_orderby('tour', array('user_id' => $this->user_id), 'updated_on desc');
        $html = '';
        if (isset($tours) and !empty($tours)):
            foreach ($tours as $tour):
                $html .= '<option value="'.$tour['tour_id'].'">'.ucfirst($tour['tour']).'</option> ';
        endforeach; else:
            $html .= '<option value="">No Reocrd Found!!!</option>';
        endif;
        echo $html;
        exit;
    }
    public function delete_tour()
    {
        if ($this->input->post('tour_id')) {
            $where = array(
                            'tour_id' => $this->input->post('tour_id'),
                        );
            $delete = $this->M_tour->delete('tour', $where);
            if ($delete) {
                $data = array(
                'status' => 1,
                'msg' => 'Tour Deleted!!!',
                );
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
    public function find_lag($location)
    {
        $address = urlencode($location);
        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";
        $getmap = file_get_contents($url);
        $googlemap = json_decode($getmap);

        foreach ($googlemap->results as $res) {
            $address = $res->geometry;
            $latlng = $address->location;

           // echo "Latitude: ". $latlng->lat ."<br />". "Longitude:". $latlng->lng;
            return $latlng;
        }
    }
    public function save_location()
    {
        $insert = false;
        $insert2 = false;
        if ($this->input->post('location_name')) 
        {
            $this->form_validation->set_rules('location_name', 'Location', 'callback_tour_field_check');
            $this->form_validation->set_rules('tour_id', 'Tour', 'callback_tour_field_check');
            if ($this->form_validation->run() == false) 
            {
                $data = array(
                    'status' => 0,
                    'msg' => strip_tags(validation_errors()),
                    );
            } 
            else 
            {
				$add = explode(" @ ",$this->input->post('location_name'));

                $adreess = $add[0];
                $oke = $this->M_tour->check_address($adreess);
                $query=$this->db->where('address', $adreess)->get('location')->num_rows();
                
                $get_location = $this->input->post('get_location');

                if ($oke ==true && $get_location != 'get_location' ) {
                    $data = array(
                            'status' => 0,
                            'msg' => 'Duplicate addresses',
                            
                            );
                    echo json_encode($data);
               
                    exit;
                    $this->session->set_flashdata('error_add', 'Duplicate addresses!.');
                    redirect('the_total_tour');
                } else {
                    $location = $add[0].','.$this->input->post('location_city').','.$this->input->post('location_country');
                    $latlng = $this->find_lag($location);

                    if ($latlng == null) {
                        $data = array(
                            'status' => 0,
                            'msg' => "Don't have address correct location !",
                            
                            );
                        echo json_encode($data);
                        exit;
                    }
                    $lat = $latlng->lat;
                    $lng = $latlng->lng;
                 
                        //$lat = ($this->input->post("latitude"))?$this->input->post("latitude"):'';
                        //$lng = ($this->input->post("longitude"))?$this->input->post("longitude"):'';
                    $data_location = array('location' => $location, 'address' => $add[0], 'city' => $this->input->post('location_city'), 'country' => $this->input->post('location_country'), 'location_slug' => (str_replace(' ', '-', $location).'-'.time()), 'updated_on' => time(),'email' => $this->input->post('location_email'));

                
                    $data_location['latitude'] = $lat;
                    $data_location['longitude'] = $lng;
                       

                    if ($this->input->post('location_id')) 
                    {
                       
                        $where = array(
                                    'location_id' => $this->input->post('location_id'),
                            );
                        $udate = $this->M_tour->update_data('location', $where, $data_location);
                         if ($udate) {
                            $this->session->set_flashdata('success_add', 'Location Updated!!!!.');
                         
                               $data = array(
                            'status' => 1,
                            'msg' => "Location Updated !",
                            );
                            redirect('the_total_tour');
                        } else {
                            //$this->session->set_flashdata('error_add', 'Server Error!!!');
                            $data = array(
                            'status' => 0,
                            'msg' => "Error in Location Updation !",
                            );
                            redirect('the_total_tour');
                        }
                          echo json_encode($data);
                              
                    } else {
                        
                        $data_location['tour_id'] = $this->input->post('tour_id');
                        $data_location['created_on'] = time();
                        //print_r($data_location);exit;
                        
                        if($query==0 )
                        {
                            $insert = $this->M_tour->insert_data('location', $data_location);
                        } 
                        if ($get_location != 'get_location') 
                        {
                            $data_insert = array(
                                    'company' => $this->input->post('location_company'),
                                    'email' => $this->input->post('location_email'),
                                    'country' => $this->input->post('location_country'),
                                    'city' => $this->input->post('location_city'),
                                    'lat' => $lat,
                                    'lng' => $lng,
                                    'street1' => $this->input->post('location_name'),
                                    );
                            $insert2 = $this->db->insert('db_locations', $data_insert);
                        }

                        if ($insert == true || $insert2 == true) 
                        {
                            $data1 = array(
                            'status' => 1,
                            'msg' => "Location Added !",
                            'rows' =>$query,   
                            );
                        } else {
                             $data1 = array(
                            'status' => 0,
                            'msg' => "Error in Location Add !",
                            );
                        }
                         echo json_encode($data1); 
                    }
                    
                }
                
            }//end else
          
            //die;
        }
    }

    public function get_tour_chain_data()
    {
        if ($this->input->post('tour_id')) {
            $where = array('tour_id' => $this->input->post('tour_id'));
            $locations = $this->M_tour->getwheres_orderby('location', $where, 'updated_on desc');
            //for locations only
            $location_id_array = array();
            $checking_d = false;
                
            if (!empty($locations)) 
            {
                $i = 0;
                foreach ($locations as  $location) 
                {
                    $where1 = array('location_id' => $location['location_id'], 'expense_type' => 'travel');
                    $locations[$i]['reach_expense'] = $this->M_tour->getwheres('expenses', $where1);

                    $where2 = array('location_id' => $location['location_id'], 'expense_type' => 'at destination');
                    $locations[$i]['destination_expense'] = $this->M_tour->getwheres('expenses', $where2);

                    $where3 = array('location_id' => $location['location_id']);
                    $location_id_array[] =  $location['location_id'];
                    $locations[$i]['income'] = $this->M_tour->getwheres('income', $where3);
                    ++$i;
                }
                $tour_id = $this->input->post('tour_id');

                $checking = $this->db->select('t.*')
                ->from('tour as t')
                ->or_where('t.tour_id', $tour_id)
                ->where('t.user_id ', $this->user_id)
                ->get()->result_array();
                if ($checking && count($checking) > 0) 
                {
                    $checking_d = true;
                }

                $members = $this->db->select('u.*')
                ->from('users as u')
                ->or_where('t.tour_id', $tour_id)
                ->or_where('tm.tour_id', $tour_id)
                //->where('u.is_admin ',0)
                ->where('tm.active ', 1)
                ->join('tour as t', 'u.id = t.user_id', 'left')
                ->join('tours_member as tm', 'tm.user_member = u.id', 'left')
                ->distinct()
                ->order_by('t.tour_id')
                ->get()->result_array();
                $show_member = array();
                foreach ($members as $member) 
                {
                    $check = $this->db->select('t.*')->from('tour as t')->where('t.tour_id', $tour_id)->where('t.user_id', $member['id'])->get()->result_array();
                    if (isset($check) && count($check) > 0) {
                        $member['own'] = 1;
                    } else {
                        $member['own'] = 0;
                    }
                    $show_member[] = $member;
                }
                usort($show_member, array($this, 'cmp'));

                $income_tour = $this->db->select('income_price,amount')
                ->from('income as i')
                ->join('location as l', 'l.location_id = i.location_id', 'left')
                ->join('tour as t', 't.tour_id = l.tour_id', 'left')
                ->where('t.tour_id', $tour_id)
                ->get()->result_array();
                $value_income = 0;
                foreach ($income_tour as $income) 
                {
                    $value_income = $value_income + $income['income_price'] * $income['amount'];
                }
                $income_tour = $value_income;

                $expenses_tour_travel = $this->db->select('expense_price,amount')
                    ->from('expenses as e')
                    ->join('location as l', 'l.location_id = e.location_id', 'left')
                    ->join('tour as t', 't.tour_id = l.tour_id', 'left')
                    ->where('t.tour_id', $tour_id)
                    ->where('expense_type', 'travel')
                    ->get()->result_array();

                $value_income = 0;
                foreach ($expenses_tour_travel as $expense) 
                {
                    $value_income = $value_income + $expense['expense_price'] * $expense['amount'];
                }
                $expenses_tour_travel = $value_income;

                $expenses_tour_des = $this->db->select('expense_price,amount')
                    ->from('expenses as e')
                    ->join('location as l', 'l.location_id = e.location_id', 'left')
                    ->join('tour as t', 't.tour_id = l.tour_id', 'left')
                    ->where('t.tour_id', $tour_id)
                    ->where('expense_type', 'at destination')
                    ->get()->result_array();

                $value_income = 0;
                foreach ($expenses_tour_des as $expense) 
                {
                    $value_income = $value_income + $expense['expense_price'] * $expense['amount'];
                }

                $expenses_tour_des = $value_income;
                $result_ca = $income_tour - $expenses_tour_des;
                if ($result_ca > 0) 
                {
                    $color = 'color-gre';
                } else {
                    $color = 'color-red';
                }
                $caculate = array('color' => $color, 'esult_ca' => $this->M_tour->convertmoney_controler($result_ca), 'income_tour' => $this->M_tour->convertmoney_controler($income_tour), 'expenses_tour_travel' => $this->M_tour->convertmoney_controler($expenses_tour_travel), 'expenses_tour_des' => $this->M_tour->convertmoney_controler($expenses_tour_des));

                $events = $this->db->select('*')
                ->from('events as e')
                ->where('e.tour_id', $tour_id)
                ->join('location as l', 'e.location_id = l.location_id')
                ->join('users as u', 'e.user_id = u.id', 'left')
                ->order_by('e.event_start_date', 'asc')
                ->get()->result_array();
                $date_events = array();
                foreach ($events as $event) 
                {
                    $event['event_start_date'] = date('m/d/Y', strtotime($event['event_start_date']));
                    $event['event_end_date'] = date('m/d/Y', strtotime($event['event_end_date']));
                    $event['url_link'] = base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id']);
                    $date_events[] = $event;
                }
                $schedule_data = array();
                $schedules = $this->M_schedules->get_schedules($tour_id, $location_id_array);
                foreach ($schedules as $schedule) 
                {
                    $schedule['start_time'] = date('h:i A m/d', $schedule['start_time']);
                    $schedule['end_time'] = date('h:i A m/d A', $schedule['end_time']);
                    $schedule_data[] = $schedule;
                }

                $tour_data = $this->db->select('t.*')
                ->from('tour as t')
                ->where('t.tour_id ', $tour_id)
                ->get()->row_array();

                $detail_tours = $this->db->where('tour_id ', $tour_id)->get('tour_detail')->result_array();

                $data = array(
                'status' => true,
                'data' => $locations,
                'member' => $show_member,
                'checking' => $checking_d,
                'caculate' => $caculate,
                'events' => $date_events,
                'schedules' => $schedule_data,
                'tour_data' => $tour_data,
                'detail_tours' => $detail_tours,
                );
            } 
            else 
            {
                //$cal = '<option value="">No Reocrd Found!!!</option>';
                $data = array(
                'status' => 0,
                'data' => false,
                'member' => false,
                'checking' => $checking_d,
                );
            }
        } 
        else
        {
            $data = array(
                'status' => 0,
                'msg' => 'Tour Not Found!!!',
                );
        }
        echo json_encode($data);
    }

    public function cmp($a, $b)
    {
        return -1 * strcmp($a['own'], $b['own']);
    }
    public function delete_location()
    {
        if ($this->input->post('location_id')) {
            $where = array(
                            'location_id' => $this->input->post('location_id'),
                        );

            $delete = $this->M_tour->delete('location', $where);
            if ($delete) {
                $data = array(
                'status' => 1,
                'msg' => 'Location Deleted!!!',
                );
                $delete_schdule = $this->M_schedules->delete_schedule($this->input->post('location_id'));
            } else {
                $data = array(
                    'status' => 0,
                    'msg' => 'Server Error!!!',
                    );
            }

            echo json_encode($data);
        }
    }
    public function get_location_again($tour_id)
    {
        $where = array('tour_id' => $tour_id);
        $locations = $this->M_tour->getwheres_orderby('location', $where, 'updated_on desc');
        $html = '';
        if (isset($locations) and !empty($locations)):
            foreach ($locations as $location):
                $html .= '<option value="'.$location['location_id'].'">'.ucfirst($location['location']).'</option> ';
        endforeach; else:
            $html .= '<option value="">No Reocrd Found!!!</option>';
        endif;
        echo $html;
        exit;
    }

    public function addContPromo()
    {
        if ($this->input->post() != '') {
            $this->form_validation->set_rules('location_id', 'Location', 'required');
            $this->form_validation->set_rules('cont_name', 'Name', 'required');
            if ($this->form_validation->run() == false) {
                echo'Name  & Location must be filled.';
            } else {
                $var = $this->input->post('cont_date');
                $cont_date = date('Y-m-d', strtotime($var));
                $data_tour['location_id'] = $this->input->post('location_id');
                $data_tour['tele'] = $this->input->post('cont_tele');
                $data_tour['email'] = $this->input->post('cont_email');
                $data_tour['date'] = $cont_date;
                $data_tour['name'] = $this->input->post('cont_name');
                $data_tour['address'] = $this->input->post('cont_address');
                $data_tour['reserv'] = $this->input->post('cont_reserv');
                $data_tour['press'] = $this->input->post('cont_press');
                $data_tour['addInfo'] = $this->input->post('cont_addInfo');

                $insert = $this->M_tour->insert_data('cont_promotor', $data_tour);

                $data_tour_save = $this->db->where('tour_id', $this->input->post('tour_id'))->get('tour')->row_array();
                $data_user = $this->db->where('id', $this->user_id)->get('users')->row_array();
                $check = $this->db->where('email', $this->input->post('cont_email'))->get('users')->row_array();
                if ($check && count($check) > 0) {
                    $member = array();
                    $member['tour_id'] = $this->input->post('tour_id');
                    $member['location_id'] = $this->input->post('location_id');
                    $member['user_create_id'] = $this->user_id;
                    $member['user_member'] = $check['id'];
                    $member['active'] = 0;
                    $member['press'] = $this->input->post('cont_press');
                    $member['manager_member'] = $this->input->post('manager_member');
                    $member['manager_event'] = $this->input->post('manager_event');
                    $member['manager_cacula'] = $this->input->post('manager_cacula');
                    $member['manager_schedule'] = $this->input->post('manager_schedule');
                    $member['name'] = $this->input->post('cont_name');
                    $member['color_front'] = $this->input->post('color_front');
                    $member['create_date'] = date('Y-m-d H:i:s');
                    $member['code_active'] = md5(md5($check['email']));
                    $member['cont_id'] = $insert;
					$member['add_expense'] = $this->input->post('add_expense');
                    $this->db->insert('tours_member', $member);
                    //Code to add friends in table
                    $friends = $this->M_fan->check_friends($this->user_id, $check['id']);
                    if(count($friends) == 0)
                    {
                        $this->M_fan->add_friend($this->user_id, $check['id'], 1);
                    }
                   
                    $notifications = array();
                    $notifications['user_id'] = $check['id'];
                    $notifications['is_read'] = "0";
                    $notifications['messages'] = $data_user['firstname'].' '.$data_user['lastname'].' invite join to tour .'.$data_tour_save['tour'];
                    $notifications['time'] = strtotime('now');
                    $notifications['type'] = 'tour_invite';
                    $this->db->insert('notifications', $notifications);
                } else {
                    $member = array();
                    $member['tour_id'] = $this->input->post('tour_id');
                    $member['location_id'] = $this->input->post('location_id');
                    $member['user_create_id'] = $this->user_id;
                    $member['user_member'] = 0;
                    $member['active'] = 0;
                    $member['press'] = $this->input->post('cont_press');
                    $member['manager_member'] = $this->input->post('manager_member');
                    $member['manager_event'] = $this->input->post('manager_event');
                    $member['manager_cacula'] = $this->input->post('manager_cacula');
                    $member['manager_schedule'] = $this->input->post('manager_schedule');
                    $member['color_front'] = $this->input->post('color_front');
                    $member['name'] = $this->input->post('cont_name');
                    $member['create_date'] = date('Y-m-d H:i:s');
                    $member['code_active'] = md5(md5($this->input->post('cont_email')));
                    $member['cont_id'] = $insert;
                    $member['add_expense'] = $this->input->post('add_expense');
                    $this->db->insert('tours_member', $member);

                    $subject = "You've been invited as tour member with ".$data_user['artist_name']." onto 99SOUND.COM, click the below link to login and see the invitation or create an account.";
                    $invite_data = array('name'=> $this->input->post('cont_name'), 'email' =>$this->input->post('cont_email'), 'status' => 0, 'invited_by_user'=> $this->user_id, 'created_at'=>time(), 'message'=> $subject);
                    $user_data = $this->M_invite_user->save($invite_data);
                    $this->send_inivition_mail($this->input->post('cont_email'), $this->input->post('cont_name'),
                       $subject);
                }
                if ($insert) {
                    $data = array(
                        'status' => 1,
                        'msg' => 'Contact  Added !!!',
                    );
                    $this->load->library('email');
                    $config['protocol'] = 'smtp';
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['newline'] = "\r\n";

                    $subject = $data_user['firstname'].' '.$data_user['lastname'].' invite join to tour .'.$data_tour_save['tour'];
                    $data_email['subject'] = $subject;
                    $data_email['code_active'] = $member['code_active'];
                    $data_email['name'] = $data_tour['name'];
                    $message = $this->load->view('email/sent_invite_member_tour', $data_email, true);
                    $email_from = $this->config->item('admin_email');
                    $name_from = $this->config->item('admin_name');
                    $this->email->initialize($config);
                    $this->email->clear();
                    $this->email->from($email_from, $name_from);
                    $this->email->reply_to($email_from, $name_from);
                    $this->email->to($data_tour['email']);
                    $this->email->subject($subject);
                    $this->email->message($message);
                    $this->email->send();
                } else {
                    $data = array(
                        'status' => 1,
                        'msg' => 'Server Error !!!',
                    );
                    echo 'Server Error!!!';
                }
                echo json_encode($data);
            }
        }
    }

     //Function to send invitation mail
    public function send_inivition_mail($email_member, $name, $subject)
    {
        $data['subject'] = $subject;
        $data['name'] = $name;
        $message = $this->load->view('email/send_invite_chat', $data, true);;
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['newline'] = "\r\n";
        //send email
        $this->email->initialize($config);
        $this->email->clear();
        $this->email->from($this->config->item('admin_email'), $this->config->item('admin_name'));
        $this->email->to($email_member);
        $this->email->subject('Join 99 Sound');
        $this->email->message($message);
        $this->email->send();
    }
    public function save_expense()
    {
        //echo json_encode($this->input->post('expense_name'));exit;
       if ($this->input->post('expense_name')) {
           $this->form_validation->set_rules('expense_name', 'Expense', 'callback_tour_field_check');
           $this->form_validation->set_rules('expense_price', 'Price', 'callback_tour_field_check|numeric');
           $this->form_validation->set_rules('location_id', 'Location', 'callback_tour_field_check');

           if ($this->form_validation->run() == false) {
               $data = array(
                    'status' => 0,
                    'msg' => strip_tags(validation_errors()),
                    );
           } else {
               $expense_name = $this->input->post('expense_name');
               $expense_price = $this->input->post('expense_price');
               $expense_type = $this->input->post('expense_type');
               $location_id = $this->input->post('location_id');
                    /* user id would be change at final test*/

                    $data_expense = array('expense_name' => $expense_name, 'expense_price' => $expense_price);

               if ($this->input->post('expense_id')) {
                   $where = array(
                                'id' => $this->input->post('expense_id'),
                            );
                   $udate = $this->M_tour->update_data('expenses', $where, $data_expense);
                   if ($udate) {
                       $data = array(
                            'status' => 1,
                            'msg' => 'Expense Updated!!!',
                            );
                   } else {
                       $data = array(
                                'status' => 0,
                                'msg' => 'Server Error!!!',
                                );
                   }
               } else {
                   $data_expense['user_id'] = $this->user_id;
                   $data_expense['expense_type'] = $expense_type;
                   $data_expense['location_id'] = $location_id;

                   $insert = $this->M_tour->insert_data('expenses', $data_expense);
                   if ($insert) {
                       $data = array(
                            'status' => 1,
                            'msg' => 'Expense Added!!!',
                            );
                   } else {
                       $data = array(
                                'status' => 0,
                                'msg' => 'Server Error!!!',
                                );
                   }
               }
                /* update location */
                $this->M_tour->update_data('location', array('location_id' => $location_id), array('updated_on' => time()));
           }
           echo json_encode($data);
           die;
       }
    }
    public function save_income()
    {
        if ($this->input->post('income_name')) {
            $this->form_validation->set_rules('income_name', 'Income', 'callback_tour_field_check');
            $this->form_validation->set_rules('income_price', 'Price', 'callback_tour_field_check|numeric');
            $this->form_validation->set_rules('location_id', 'Location', 'callback_tour_field_check');

            if ($this->form_validation->run() == false) {
                $data = array(
                    'status' => 0,
                    'msg' => strip_tags(validation_errors()),
                    );
            } else {
                $income_name = $this->input->post('income_name');
                $income_price = $this->input->post('income_price');
                $location_id = $this->input->post('location_id');
                    /* user id would be change at final test*/
                    $user_id = $this->user_id;

                $data_income = array('income_name' => $income_name, 'income_price' => $income_price);

                if ($this->input->post('income_id')) {
                    $where = array(
                                'income_id' => $this->input->post('income_id'),
                            );
                    $udate = $this->M_tour->update_data('income', $where, $data_income);
                    if ($udate) {
                        $data = array(
                            'status' => 1,
                            'msg' => 'Income Updated!!!',
                            );
                    } else {
                        $data = array(
                                'status' => 0,
                                'msg' => 'Server Error!!!',
                                );
                    }
                } else {
                    $data_income['user_id'] = $user_id;
                    $data_income['location_id'] = $location_id;

                    $insert = $this->M_tour->insert_data('income', $data_income);
                    if ($insert) {
                        $data = array(
                            'status' => 1,
                            'msg' => 'Income Added!!!',
                            );
                    } else {
                        $data = array(
                                'status' => 0,
                                'msg' => 'Server Error!!!',
                                );
                    }
                }
                /* update location */
                $this->M_tour->update_data('location', array('location_id' => $location_id), array('updated_on' => time()));
            }
            echo json_encode($data);
            die;
        }
    }
    public function delete_expense()
    {
        if ($this->input->post('json')) {
            if ($this->input->post('expense_id')) {
                $where = array(
                                'id' => $this->input->post('expense_id'),
                            );
                $delete = $this->M_tour->delete('expenses', $where);
                if ($delete) {
                    $data = array(
                    'status' => 1,
                    'msg' => 'Expense Deleted!!!',
                    );
                } else {
                    $data = array(
                        'status' => 0,
                        'msg' => 'Server Error!!!',
                        );
                }
                /* update location */
                $location_id = $this->input->post('location_id');
                $this->M_tour->update_data('location', array('location_id' => $location_id), array('updated_on' => time()));
                echo json_encode($data);
            }
        }
    }
    public function delete_income()
    {
        if ($this->input->post('json')) {
            if ($this->input->post('income_id')) {
                $where = array(
                                'income_id' => $this->input->post('income_id'),
                            );
                $delete = $this->M_tour->delete('income', $where);
                if ($delete) {
                    $data = array(
                    'status' => 1,
                    'msg' => 'Income Deleted!!!',
                    );
                } else {
                    $data = array(
                        'status' => 0,
                        'msg' => 'Server Error!!!',
                        );
                }
                /* update location */

                $location_id = $this->input->post('location_id');
                $this->M_tour->update_data('location', array('location_id' => $location_id), array('updated_on' => time()));

                echo json_encode($data);
            }
        }
    }
    public function get_location_via_id()
    {
        if ($this->input->post('json')) {
            if ($this->input->post('location_id')) {
                $where = array('location_id' => $this->input->post('location_id'));
                $location = $this->M_tour->getSingleRow('location', $where);
                if (!empty($location)) {
                    $where1 = array('location_id' => $location['location_id'], 'expense_type' => 'travel');
                    $location['reach_expense'] = $this->M_tour->getwheres('expenses', $where1);

                    $where2 = array('location_id' => $location['location_id'], 'expense_type' => 'at destination');
                    $location['destination_expense'] = $this->M_tour->getwheres('expenses', $where2);

                    $where3 = array('location_id' => $location['location_id']);
                    $location['income'] = $this->M_tour->getwheres('income', $where3);

                    $data = array(
                    'status' => 1,
                    'location' => $location,
                    );
                } else {
                    $data = array(
                    'status' => 0,

                    );
                }
            } else {
                $data = array(
                    'status' => 0,
                    'msg' => 'Tour Not Found!!!',
                    );
            }
            echo json_encode($data);
        }
    }
    public function edit_location_via_lat_lng()
    {
        if ($this->input->post()) {
            $location = $this->input->post('location_name');
            $lat = $this->input->post('lat');
            $lng = $this->input->post('lng');

            $data_location = array('location' => $location, 'location_slug' => (str_replace(' ', '-', $location).'-'.time()), 'latitude' => $lat, 'longitude' => $lng, 'updated_on' => time());
            $location_datail = $this->get_geo_location($lat, $lng);

            if (!empty($location_datail)) {
                $data_location['address'] = ($location_datail['address']) or '';
                $data_location['city'] = ($location_datail['city']) or '';
                $data_location['state'] = ($location_datail['state']) or '';
                $data_location['country'] = ($location_datail['country']) or '';
                unset($location_datail['state']);
                unset($location_datail['country']);

                 // var_dump($location_datail);
                 // die;
                $location = implode(' ', $location_datail);
                $data_location['location'] = $location;
                $data_location['location_slug'] = (str_replace(' ', '-', $location).'-'.time());
            }

            $where = array(
                        'location_id' => $this->input->post('location_id'),
                    );
            $udate = $this->M_tour->update_data('location', $where, $data_location);
            if ($udate) {
                $data = array(
                    'status' => 1,
                    'msg' => 'Location Updated!!!',
                    );
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
    public function get_geo_location($latitude, $longitude)
    {
        $data = array();
        $geolocation = $latitude.','.$longitude;
        $request = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$geolocation.'&sensor=false';
        $file_contents = file_get_contents($request);
        $json_decode = json_decode($file_contents);

        if (isset($json_decode->results[0])) {
            $response = array();
            foreach ($json_decode->results[0]->address_components as $addressComponet) {
                if (in_array('political', $addressComponet->types)) {
                    $response[] = $addressComponet->long_name;
                }
            }

            if (isset($response[0])) {
                $first = $response[0];
            } else {
                $first = 'null';
            }
            if (isset($response[1])) {
                $second = $response[1];
            } else {
                $second = 'null';
            }
            if (isset($response[2])) {
                $third = $response[2];
            } else {
                $third = 'null';
            }
            if (isset($response[3])) {
                $fourth = $response[3];
            } else {
                $fourth = 'null';
            }
            if (isset($response[4])) {
                $fifth = $response[4];
            } else {
                $fifth = 'null';
            }

            if ($first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth != 'null') {
                // echo "<br/>Address:: ".$first;
                // echo "<br/>City:: ".$second;
                // echo "<br/>State:: ".$fourth;
                // echo "<br/>Country:: ".$fifth; 
                $data = array(
                    'address' => $first,
                    'city' => $second,
                    'state' => $fourth,
                    'country' => $fifth,
                    );
            } elseif ($first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth == 'null') {
                // echo "<br/>Address:: ".$first;
                // echo "<br/>City:: ".$second;
                // echo "<br/>State:: ".$third;
                // echo "<br/>Country:: ".$fourth;

                $data = array(
                    'address' => $first,
                    'city' => $second,
                    'state' => $third,
                    'country' => $fourth,
                    );
            } elseif ($first != 'null' && $second != 'null' && $third != 'null' && $fourth == 'null' && $fifth == 'null') {
                // echo "<br/>City:: ".$first;
                // echo "<br/>State:: ".$second;
                // echo "<br/>Country:: ".$third;

                $data = array(
                    'address' => '',
                    'city' => $first,
                    'state' => $second,
                    'country' => $third,
                    );
            } elseif ($first != 'null' && $second != 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null') {
                // echo "<br/>State:: ".$first;
                // echo "<br/>Country:: ".$second;

                $data = array(
                    'address' => '',
                    'city' => '',
                    'state' => $first,
                    'country' => $second,
                    );
            } elseif ($first != 'null' && $second == 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null') {
                // echo "<br/>Country:: ".$first;

                $data = array(
                    'address' => '',
                    'city' => '',
                    'state' => '',
                    'country' => $first,
                    );
            }

            return $data;
        }
    }
    public function data_event()
    {
        if ($this->input->post()) {
            if ($this->input->post('type') == 'add') {
                $tour_id = $this->input->post('tour_event_id');
                $location_id = $this->input->post('location_event_id');
                $start_day = date('Y-m-d', strtotime($this->input->post('start_event_id')));
                $end_day = date('Y-m-d', strtotime($this->input->post('end_event_id')));
                $title = $this->input->post('event_title');
                $description = $this->input->post('event_desc');
                $post_by = '';
                $location = $this->input->post('location_event_name');
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
                        $insertArr = array(
                                    'tour_id' => $tour_id,
                                    'location_id' => $location_id,
                                    'event_title' => $title,
                                    'event_desc' => $description,
                                    'posted_by' => $post_by,
                                    'event_start_date' => $start_day,
                                    'event_end_date' => $end_day,
                                    'location' => $location,
                                    'user_id' => $this->user_id,
                                    'categories' => $categories,
                                    'event_banner' => $datafile['file_name'],
                        );

                        $this->Events_model->insert('events', $insertArr);
                        redirect('/the_total_tour');
                    }
                }
            }
        }
    }
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
    public function actvie_member($code)
    {
        if (isset($code) && !empty($code)) {
            $data_user = $this->db->where('user_member', $this->user_id)->where('code_active', $code)->get('tours_member')->row_array();
            if (isset($data_user) && count($data_user) > 0) {
                $this->db->where('id', $data_user['id'])
                ->update('tours_member', array('active' => 1, 'code_active' => ''));
            } else {
                redirect('/');
            }
        } else {
            redirect('/');
        }
        redirect('/the_total_tour');
    }
}
