<?php
/**
 * Member File Doc Comment.
 *
 * @category Member
 *
 * @author   99sound <admin@99sound.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 *
 * @link     http://www.99Sound.com/
 */
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Member Class Doc Comment.
 *
 * @category Member
 *
 * @author   99sound <admin@99sound.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 *
 * @link     http://www.99Sound.com/
 */
class Member extends CI_Controller
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
     * Function to check user according to tour id.
     * 
     * @param int $tour_id the tour id to check
     * 
     * @return nothing, check using tour id & redirect accordingly.
     */
    public function check_user($tour_id)
    {
        $tour_data = $this->db->where('tour_id', $tour_id)->where('user_member', $this->user_id)->where('active', 1)->get('tours_member')->row_array();
        if (!isset($tour_data)) {
            redirect('the_total_tour');
        }
    }
    /**
     * Function to display tour data & member data.
     * 
     * @param int $tour_id   the tour id to check
     * @param int $member_id the member id
     * 
     * @return nothing, load view to display member & tour data.
     */
    public function index($tour_id, $member_id)
    {
        $this->check_user($tour_id);
        $this->session->set_userdata('target', 'target0');
        $type = $this->input->get('type');

        if (!isset($member_id) && !$member_id) {
            $member_id = $this->user_id;
        }

        if (isset($tour_id) && $tour_id) {
            $tour_data = $this->db->where('tour_id', $tour_id)->get('tour')->row_array();
            //$own = $this->db->where('id',$tour_data['user_id'])->get('users')->row_array();

            $data['check_member'] = $this->db->where('user_member', $this->user_id)->where('tour_id', $tour_id)->get('tours_member')->row_array();
            //var_dump($data['check_member']);exit;
            $members = $this->db->select('tm.*,u.*,u.id as user_id,tm.id as tm_id,tm.active as tm_active')
                ->from('tours_member as tm')
                ->join('users as u', 'tm.user_member = u.id', 'left')
                ->join('tour as t', 'u.id = t.user_id', 'left')
                //->or_where('t.tour_id',$tour_id)
                ->where('tm.tour_id', $tour_id)
                //->where('tm.active ',1)
                ->distinct()
                ->order_by('tm.id')
                ->get()->result_array();
            $show_member = array();
            //var_dump($members);exit;
            foreach ($members as $member) 
            {
                $check = $this->db->select('t.*')->from('tour as t')->where('t.tour_id', $tour_id)->where('t.user_id', $member['user_id'])->get()->result_array();
                if (isset($check) && count($check) > 0) {
                    $member['own'] = 1;
                } else {
                    $member['own'] = 0;
                }
                $show_member[] = $member;
            }
            usort($show_member, array($this, 'cmp'));
            usort($show_member, array($this, 'active_sort'));
        } else {
            echo " ";
        }
        $data['members'] = $show_member;
        $data['tour_id'] = $tour_id;
        $data['tour'] = $tour_data;
        $data['user_data'] = $this->session->userdata('user_data');
        if($type == 'member')
        {
            $this->load->view('ttt_new/member', $data);
        }
        else if($type == 'new_member')
        {
            $this->load->view('ttt_new/add_member', $data);
        
        }
        // $this->load->view('includes/header', $data);
        // $this->load->view('includes/navbar', $data);
        // $this->load->view('ttt/header_ttt', $data);
        // $this->load->view('ttt/main', $data);
        // $this->load->view('includes/footer', $data);
    }
    /**
     * Function to compare srings.
     * 
     * @param int $a string 1
     * @param int $b string 2
     * 
     * @return comparison result.
     */
    public function cmp($a, $b)
    {
        return 1 * strcmp($a['own'], $b['own']);
    }
    /**
     * Function to active sort.
     * 
     * @param int $a string 1
     * @param int $b string 2
     * 
     * @return comparison result.
     */
    public function active_sort($a, $b)
    {
        return -1 * strcmp($a['active'], $b['active']);
    }
    /**
     * Function to delete member.
     * 
     * @return success or error status.
     */
    public function delete_member()
    {
        if ($this->input->post('id')) {
            $this->db->delete('tours_member', array('id' => $this->input->post('id')));
            $data = array(
            'status' => 1,
            'msg' => 'Delete member!!!',
            );
        } else {
            $data = array(
            'status' => 0,
            'msg' => 'Delete Error!!!',
            );
        }
        echo json_encode($data);
        die;
    }
    /**
     * Function to update member.
     * 
     * @return nothing, rediredt according to result.
     */
    public function update_member()
    {
        if ($this->input->post('member_id')) {
            if ($this->input->post('manager_member') == 'on') {
                $manager_member = 1;
            } else {
                $manager_member = 0;
            }
            if ($this->input->post('manager_event') == 'on') {
                $manager_event = 1;
            } else {
                $manager_event = 0;
            }
            if ($this->input->post('manager_cacula') == 'on') {
                $manager_cacula = 1;
            } else {
                $manager_cacula = 0;
            }
            if ($this->input->post('manager_schedule') == 'on') {
                $manager_schedule = 1;
            } else {
                $manager_schedule = 0;
            }
            if ($this->input->post('add_expense') == 'on') {
                $add_expense = 1;
            } else {
                $add_expense = 0;
            }
            $tours_member = array(
                'name' => $this->input->post('cont_name'),
                'press' => $this->input->post('cont_press'),
                'color_front' => $this->input->post('color_front'),
                'manager_member' => $manager_member,
                'manager_event' => $manager_event,
                'manager_cacula' => $manager_cacula,
                'manager_schedule' => $manager_schedule,
                'add_expense' => $add_expense
            );
            $this->db->update('tours_member', $tours_member, 'id='.$this->input->post('member_id'));

            $var = $this->input->post('cont_date');
            $cont_date = date('Y-m-d', strtotime($var));

            $cont_promotor = array(
                'email' => $this->input->post('cont_email'),
                'date' => $cont_date,
                'name' => $this->input->post('cont_name'),
                'address' => $this->input->post('cont_address'),
                'reserv' => $this->input->post('cont_reserv'),
                'press' => $this->input->post('cont_press'),
                'addInfo' => $this->input->post('cont_addInfo'),
            );
            $this->db->update('cont_promotor', $cont_promotor, 'id='.$this->input->post('member_id'));
        } else {
            echo " ";
        }
        echo json_encode("success");
        // redirect('the_total_tour/members/'.$this->input->post('tour_id'));
    }
    /**
     * Function to get data memmber.
     * 
     * @return member data.
     */
    public function getdatamember()
    {
        if ($this->input->post('id_member')) {
            $member_id = $this->input->post('id_member');
            $members = $this->db->select('tm.*,cp.*')
                ->from('tours_member as tm')
                ->join('cont_promotor as cp', 'cp.id = tm.cont_id', 'left')
                ->where('tm.id', $member_id)
                ->get()->row_array();

            $data = array(
                'status' => 1,
                'data' => $members,
            );
        } else {
            $data = array(
                'status' => 0,
                'data' => $members,
            );
        }
        echo json_encode($data);
        die;
    }
    /**
     * Function to calculate.
     * 
     * @param int $tour_id     the tour id
     * @param int $location_id the location id
     * @param int $member_id   the member id
     * 
     * @return nothing, calculate & loads view.
     */
    public function caculate($tour_id, $location_id, $member_id)
    {
		$data['user_data'] = $this->session->userdata('user_data');
        if (isset($tour_id) && $tour_id) {
            $this->check_user($tour_id);

            $locations = $this->db->select('*')
                ->from('location as l')
                ->where('l.tour_id', $tour_id)
                ->distinct()
                ->order_by('l.location_id', 'desc')
                ->get()->result_array();
            if (isset($locations) && count($locations) > 0) 
            {
                if (empty($location_id)) 
                {
                    $location_id = $locations[0]['location_id'];
                }
            } else 
            {
                echo " ";
            }
            $current_location = $this->db->where('location_id', $location_id)->get('location')->row_array();
            if (empty($member_id)) 
            {
                $expenses = $this->db->select('e.*,e.id as expense_id,u.*,tm.id as user_m_id,tm.type,tm.color_front')
                    ->from('expenses as e')
                    ->join('users as u', 'e.user_id = u.id', 'left')
                    ->join('tours_member as tm', 'u.id = tm.user_member', 'left')
                    ->where('e.location_id', $location_id)
                    ->where('tm.tour_id', $tour_id)
                    ->distinct()
                    ->order_by('e.date')
                    ->get()->result_array();

                $incomes = $this->db->select('i.*,u.*,tm.id as user_m_id,tm.type,tm.color_front')
                    ->from('income as i')
                    ->join('users as u', 'i.user_id = u.id', 'left')
                    ->join('tours_member as tm', 'u.id = tm.user_member', 'left')
                    ->where('i.location_id', $location_id)
                    ->where('tm.tour_id', $tour_id)
                    ->distinct()
                    ->order_by('i.date')
                    ->get()->result_array();
            } 
            else 
            {
                $user_data_select = $this->db->select('*')
                    ->from('users')
                    ->where('id', $member_id)
                    ->get()->row_array();

                $data['user_data_select'] = $user_data_select;

                $expenses = $this->db->select('e.*,e.id as expense_id,u.*,tm.id as user_m_id,tm.type,tm.color_front')
                    ->from('expenses as e')
                    ->join('users as u', 'e.user_id = u.id', 'left')
                    ->join('tours_member as tm', 'u.id = tm.user_member', 'left')
                    ->where('e.location_id', $location_id)
                    ->where('tm.tour_id', $tour_id)
                    ->where('e.user_id', $member_id)
                    ->distinct()
                    ->order_by('e.date')
                    ->get()->result_array();

                $incomes = $this->db->select('i.*,u.*,tm.id as user_m_id,tm.type,tm.color_front')
                    ->from('income as i')
                    ->join('users as u', 'i.user_id = u.id', 'left')
                    ->join('tours_member as tm', 'u.id = tm.user_member', 'left')
                    ->where('i.location_id', $location_id)
                    ->where('tm.tour_id', $tour_id)
                    ->where('i.user_id', $member_id)
                    ->distinct()
                    ->order_by('i.date')
                    ->get()->result_array();
            }

            $income_price = $this->db->select('income_price,amount')
                ->where('location_id', $location_id)
                ->get('income')->result_array();
            $value_income = 0;
            foreach ($income_price as $expense) 
            {
                $value_income = $value_income + $expense['income_price'] * $expense['amount'];
            }
            $income_price = $value_income;

            $expenses_price_travel = $this->db->select('expense_price,amount')
                ->where('location_id', $location_id)
                ->where('expense_type', 'travel')
                ->get('expenses')->result_array();
            $value_income = 0;
            foreach ($expenses_price_travel as $expense) 
            {
                $value_income = $value_income + $expense['expense_price'] * $expense['amount'];
            }
            $expenses_price_travel = $value_income;

            $expenses_price_des = $this->db->select('expense_price,amount')
                ->where('location_id', $location_id)
                ->where('expense_type', 'at destination')
                ->get('expenses')->result_array();
            $value_income = 0;
            foreach ($expenses_price_des as $expense) 
            {
                $value_income = $value_income + $expense['expense_price'] * $expense['amount'];
            }
            $expenses_price_des = $value_income;

            $tour_data = $this->db->where('tour_id', $tour_id)->get('tour')->row_array();
            //$own = $this->db->where('id',$tour_data['user_id'])->get('users')->row_array();

            $data['check_member'] = $this->db->where('user_member', $this->user_id)->where('tour_id', $tour_id)->get('tours_member')->row_array();

            $members = $this->db->select('tm.*,u.*,u.id as user_id,tm.id as tm_id,tm.active as tm_active')
                ->from('tours_member as tm')
                ->join('users as u', 'tm.user_member = u.id', 'left')
                ->join('tour as t', 'u.id = t.user_id', 'left')
                ->where('tm.tour_id', $tour_id)
                ->distinct()
                ->order_by('tm.id')
                ->get()->result_array();
            
            $expensePer = $this->db->select('add_expense')
                ->from('tours_member')
                ->where('tour_id', $tour_id)
                ->where('user_member', $data['user_data']['id'])
                ->get()->row_array();
            $data['expensePer'] = $expensePer;
            $show_member = array();
            //var_dump($members);exit;
            foreach ($members as $member) 
            {
                $check = $this->db->select('t.*')->from('tour as t')->where('t.tour_id', $tour_id)->where('t.user_id', $member['user_id'])->get()->result_array();
                if (isset($check) && count($check) > 0) {
                    $member['own'] = 1;
                } else {
                    $member['own'] = 0;
                }
                $show_member[] = $member;
            }
            usort($show_member, array($this, 'cmp'));
            usort($show_member, array($this, 'active_sort'));

            $money = $income_price - $expenses_price_des;
            $taxs = $this->M_tour->getTax('location', $current_location['location_id']);
            $total_after_tax = 0;
            if ($taxs != false) 
            {
                foreach ($taxs as $tax) {
                    $show_tax = $money * $tax['tax'] / 100;
                    $total_after_tax = $total_after_tax + $show_tax;
                }
            }

            $update = array(
                    'tax_location_result' => $money - $total_after_tax,
                );
            $this->db->where('location_id', $location_id);
            $this->db->update('location', $update);

            $location_caculates = $this->db->select()
                ->from('location')
                ->where('location.tour_id', $tour_id)
                ->get()->result_array();

            $data['location_caculates'] = $location_caculates;
        }
        else 
        {
            echo "";
        }
        $data['members'] = $show_member;
        $data['tour_id'] = $tour_id;
        $data['tour'] = $tour_data;
        $data['locations'] = $locations;
        $data['location_id'] = $location_id;
        $data['current_location'] = $current_location;

        $data['expenses_price_travel'] = $expenses_price_travel;
        $data['expenses_price_des'] = $expenses_price_des;
        $data['income_price'] = $income_price;

        $data['expenses'] = $expenses;
        $data['incomes'] = $incomes;
        // $this->load->view('includes/header', $data);
        // $this->load->view('includes/navbar', $data);
        // $this->load->view('ttt/header_ttt', $data);
        // $this->load->view('ttt/caculate', $data);
        // $this->load->view('includes/footer', $data);
        $this->load->view('ttt_new/calculate', $data);
    }
    /**
     * Function to display events.
     * 
     * @param int $tour_id     the tour id
     * @param int $location_id the location id
     * 
     * @return nothing, loads view.
     */
    public function event($tour_id, $location_id)
    {
        $this->session->set_userdata('target', 'target0');
        if (isset($tour_id) && $tour_id) {
            $this->check_user($tour_id);
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
            $data['events'] = $this->db->select('*')
                ->from('events')
                ->where('location_id', $location_id)
                ->where('tour_id', $tour_id)
                ->order_by('event_id', 'desc')
                ->get()->result_array();

            $tour_data = $this->db->where('tour_id', $tour_id)->get('tour')->row_array();
            //$own = $this->db->where('id',$tour_data['user_id'])->get('users')->row_array();

            $data['check_member'] = $this->db->where('user_member', $this->user_id)->where('tour_id', $tour_id)->get('tours_member')->row_array();

            $members = $this->db->select('tm.*,u.*,u.id as user_id,tm.id as tm_id,tm.active as tm_active')
                ->from('tours_member as tm')
                ->join('users as u', 'tm.user_member = u.id', 'left')
                ->join('tour as t', 'u.id = t.user_id', 'left')
                //->or_where('t.tour_id',$tour_id)
                ->where('tm.tour_id', $tour_id)
                //->where('tm.active ',1)
                ->distinct()
                ->order_by('tm.id')
                ->get()->result_array();
            $show_member = array();
            //var_dump($members);exit;
            foreach ($members as $member) {
                $check = $this->db->select('t.*')->from('tour as t')->where('t.tour_id', $tour_id)->where('t.user_id', $member['user_id'])->get()->result_array();
                if (isset($check) && count($check) > 0) {
                    $member['own'] = 1;
                } else {
                    $member['own'] = 0;
                }
                $show_member[] = $member;
            }
            usort($show_member, array($this, 'cmp'));
            usort($show_member, array($this, 'active_sort'));

            $genres = $this->db->select('*')->from('genres')->get()->result_array();
        } else {
            echo " ";
        }

        $data['locations'] = $locations;
        $data['location_id'] = $location_id;
        $data['members'] = $show_member;
        $data['tour_id'] = $tour_id;
        $data['tour'] = $tour_data;
        $data['genres'] = $genres;
        $data['user_data'] = $this->session->userdata('user_data');
        // $this->load->view('includes/header', $data);
        // $this->load->view('includes/navbar', $data);
        // $this->load->view('ttt/header_ttt', $data);
        // $this->load->view('ttt/event', $data);
        // $this->load->view('includes/footer', $data);
        $this->load->view('ttt_new/event', $data);
    }
    /**
     * Function to get events.
     * 
     * @return events.
     */
    public function get_event()
    {
        if ($this->input->post('id')) {
            $genres = $this->db->select('*')->where('event_id', $this->input->post('id'))->from('events')->get()->row_array();
            $data = array(
                'status' => 1,
                'data' => $genres,
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
     * Function to update price.
     * 
     * @return nothing, update price & accordingly redirect.
     */
    public function update_price()
    {
        if ($this->input->post('price_id')) {
            $type = $this->input->post('type');
            $location = $this->input->post('location');
            $tour_id = $this->input->post('tour_id');
            $var = $this->input->post('change_date');
            $cont_date = date('Y-m-d', strtotime($var));
            if ($type == 'expenses') {
                if ($this->input->post('expense_type') == 'travel') {
                    $this->session->set_userdata('target', 'target1');
                } else {
                    $this->session->set_userdata('target', 'target2');
                }

                $this->db->update('expenses', array('expense_name' => $this->input->post('change_name'), 'amount' => $this->input->post('change_amount'), 'date' => $cont_date, 'expense_price' => $this->input->post('change_price')), 'id='.$this->input->post('price_id'));
                echo json_encode("success");
                // redirect('the_total_tour/caculate/'.$tour_id.'/'.$location);
            } else {
                $this->session->set_userdata('target', 'target3');
                $this->db->update('income', array('income_name' => $this->input->post('change_name'), 'amount' => $this->input->post('change_amount'), 'date' => $cont_date, 'income_price' => $this->input->post('change_price')), 'income_id='.$this->input->post('price_id'));
                echo json_encode("success");
                // redirect('the_total_tour/caculate/'.$tour_id.'/'.$location);
            }
        }
    }
    /**
     * Function to delete price.
     * 
     * @return error or success status after deletion.
     */
    public function delete_price()
    {
        if ($this->input->post('price_id')) {
            $type = $this->input->post('type');
            if ($type == 'expenses') {
                $this->db->delete('expenses', array('id' => $this->input->post('price_id')));
                $data = array(
                    'status' => 1,
                    'msg' => 'Delete member!!!',
                    );
            } else {
                $this->db->delete('income', array('income_id' => $this->input->post('price_id')));
                $data = array(
                    'status' => 1,
                    'msg' => 'Delete member!!!',
                    );
            }
        } else {
            $data = array(
                'status' => 0,
                'msg' => 'Error delete !!!',
                );
        }
        echo json_encode($data);
        die;
    }
    /**
     * Function to add calculate.
     * 
     * @return nothing, redirect accordingly.
     */
    public function addcaculate()
    {
        if ($this->input->post('location')) {
            $location = $this->input->post('location');
            $tour_id = $this->input->post('tour_id');
            $type = $this->input->post('type');
            $var = $this->input->post('change_date');
            $cont_date = date('Y-m-d', strtotime($var));

            if ($type == 'expenses') {
				
				$imgFile = "";
				$this->load->library('upload');
                if (!empty($_FILES['receipt']['name'])) {
                    $this->upload->initialize($this->config());
                    if (!$this->upload->do_upload('receipt')) {
                        $data['update_error'] = $this->upload->display_errors();
                        echo $data['update_error'];

                        return 0;
                    } else {
                        $datafile = $this->upload->data();
                        $imgFile = $datafile['file_name'];				
					}
				}
				
                if ($this->input->post('expense_type') == 'travel') {
                    $this->session->set_userdata('target', 'target1');
                } else {
                    $this->session->set_userdata('target', 'target2');
                }

                $insetarray = array(
                    'user_id' => $this->user_id,
                    'expense_name' => $this->input->post('change_name'),
                    'expense_price' => $this->input->post('change_price'),
                    'expense_type' => $this->input->post('expense_type'),
                    'location_id' => $this->input->post('location'),
                    'amount' => $this->input->post('change_amount'),
                    'receipt' => $imgFile,
                    'date' => $cont_date,
                );
                $this->db->insert('expenses', $insetarray);
            } else {
                $imgFile = "";
                $this->load->library('upload');
                if (!empty($_FILES['receipt']['name'])) {
                    $this->upload->initialize($this->config());
                    if (!$this->upload->do_upload('receipt')) {
                        $data['update_error'] = $this->upload->display_errors();
                        echo $data['update_error'];

                        return 0;
                    } else {
                        $datafile = $this->upload->data();
                        $imgFile = $datafile['file_name'];              
                    }
                }
                $this->session->set_userdata('target', 'target3');
                $insetarray = array(
                    'user_id' => $this->user_id,
                    'income_name' => $this->input->post('change_name'),
                    'income_price' => $this->input->post('change_price'),
                    'location_id' => $this->input->post('location'),
                    'amount' => $this->input->post('change_amount'),
                    'date' => $cont_date,
                    'receipt' => $imgFile,
                );
                $this->db->insert('income', $insetarray);
            }
        }
        echo json_encode("success");
        // redirect('the_total_tour/caculate/'.$tour_id.'/'.$location);
    }
    /**
     * Function of data event.
     * 
     * @return nothing, redirect accordingly.
     */
    public function data_event()
    {
        if ($this->input->post()) {
            $tour_id = $this->input->post('tour_event_id');
            $location_id = $this->input->post('location_event_id');
            if ($this->input->post('type') == 'add') {
                $start_day = date('Y-m-d', strtotime($this->input->post('start_event_id')) + 86400);
                $end_day = date('Y-m-d', strtotime($this->input->post('end_event_id')) + 86400);
                $title = $this->input->post('event_title');
                $description = $this->input->post('event_desc');
                $post_by = '';
                $location = $this->input->post('location_event_name');
                $categories = $this->input->post('categories');
                $capacity = $this->input->post('event_capacity');

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
                                    'capacity' => $capacity,
                        );

                        $this->Events_model->insert('events', $insertArr);
                        // redirect('/the_total_tour/event/'.$tour_id.'/'.$location_id);
                    }
                } else {
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
                                    'capacity' => $capacity,
                        );

                    $this->Events_model->insert('events', $insertArr);
                    // redirect('/the_total_tour/event/'.$tour_id.'/'.$location_id);
                }
            } elseif ($this->input->post('type') == 'edit') {
                $title = $this->input->post('event_title');
                $description = $this->input->post('event_desc');
                $categories = $this->input->post('categories');
                $capacity = $this->input->post('event_capacity');

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
                                    'event_title' => $title,
                                    'event_desc' => $description,
                                    'categories' => $categories,
                                    'event_banner' => $datafile['file_name'],
                                    'capacity' => $capacity,
                        );
                        $this->db->where('event_id', $this->input->post('event_id'));
                        $this->db->update('events', $insertArr);

                        // redirect('/the_total_tour/event/'.$tour_id.'/'.$location_id);
                    }
                } else {
                    $insertArr = array(
                                    'event_title' => $title,
                                    'event_desc' => $description,
                                    'categories' => $categories,
                                    'capacity' => $capacity,
                        );
                    $this->db->where('event_id', $this->input->post('event_id'));
                    $this->db->update('events', $insertArr);
                    // redirect('/the_total_tour/event/'.$tour_id.'/'.$location_id);
                }
            } else {
                $this->db->where('event_id', $this->input->post('event_id'));
                $this->db->delete('events');
                // redirect('/the_total_tour/event/'.$tour_id.'/'.$location_id);
            }
        }
        echo json_encode("success");
    }
    /**
     * Function to config.
     * 
     * @return config data.
     */
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
}
