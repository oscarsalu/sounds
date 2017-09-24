<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Stats extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->model('M_user');
        $this->load->model('M_audio_song');
        $this->load->model('M_affiliate');
        $this->load->model('M_transaction');
        $this->load->helper('string');
        $ac = $this->session->userdata('access');
      
         $data['redirect_url']=$this->curPageURL();
        if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }
        $this->U_map = $this->session->userdata('U_map');
        $this->is_login();
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
    public $U_map;
    public function is_login()
    {
        $U_map = $this->U_map;
        $uers_data = $this->session->userdata('user_data');
        if ($this->input->is_ajax_request()) {
            if (!isset($U_map)) {
                $this->session->set_flashdata('message_error', '<b>Error</b>! You Not Login Account');
                redirect('account/login');
                die;
            }
        } else {
            if (!isset($U_map)) {
                header('HTTP/1.1 401 	Unauthorized');
                die;
            }
        }
    }
    /**
     * View stats amper.
     **/
    public function index()
    {
        $data['U_map'] = $this->db->where('id', $this->U_map['id'])->get('affiliates')->row_array();
        $data['user_data'] = $this->db->get_where('users', array('id' => $this->U_map['user_id']))->row_array();
        $data['Total_balance'] = round($data['user_data']['balance'], 2, PHP_ROUND_HALF_DOWN);
      
        $data['stats_counter'] = $this->db->get_where('stats_counter', array('user_id' => $this->U_map['user_id']))->row();
        $data['amp_samples'] = $this->M_affiliate->count_amp_samples($data['U_map']['affiliate_id']);
        $data['amp_sales'] = $this->M_affiliate->count_amp_sales($data['U_map']['user_id']);
        $data['top_popular'] = $this->M_affiliate->top_popular($data['U_map']['user_id'], $data['U_map']['affiliate_id']);
        $config['base_url'] = base_url().'amper/stats';
        $config['per_page'] = 12;
        $config['total_rows'] = $this->M_transaction->total_transactions($data['U_map']['user_id']);
        $this->load->library('pagination', $config);
        $start = $this->input->get('per_page');
        if (empty($start)) {
            $start = 1;
        }
        $data['transactions'] = $this->M_transaction->get_transactions($data['U_map']['user_id'], $config['per_page'], $start - 1);
        $data_week = $this->db->select('time,amount')
            ->where('time >=', strtotime('monday this week'))
            ->where('time <', strtotime('next monday'))
            ->where('type', 'amp')
            ->where('user_id', $this->U_map['user_id'])
            ->get('transactions')->result_array();
        $data['money_week'] = 0.0;
        $data['num_items_week'] = 0;
        foreach ($data_week as $row) {
            $data['money_week'] += $row['amount'];
            ++$data['num_items_week'];
        }
        if($data['money_week'] == 0)
        {
            $data['money_week'] = 0.0;
        }
        $data['link_content'] = 'stats.php';
        if ($this->input->is_ajax_request()) {
            // check if request comes from an ajax
            $this->load->view('amper/stats.php', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('amper/dashboard_amper.php', $data);
            $this->load->view('includes/footer', $data);
        }
    }
    /**
     * call ajax stats  return json data current account.
     **/
    public function call_stats()
    {
        $day_start = $this->input->post('time_start');
        //$day_start = 1465185600; //1465185600','1465790400','2'
        $day_end = $this->input->post('time_end');
        //$day_end = 1465790400;
        $type = $this->input->post('type');
        //$type = '1';
        $data['U_map'] = $this->db->where('id', $this->U_map['id'])->get('affiliates')->row_array();

        $timeDiff = abs($day_end - $day_start);
        $numberDays = $timeDiff / 86400;  // 86400 seconds in one day
        // and you might want to convert to integer
        $numberDays = intval($numberDays);

        $i = 0;
        $array_res = array();
        $time_start = $day_start;//monday
        $time_end = $day_start + 86400; // +1day
        while ($numberDays > 0) {
            if ($type == '1') {
                $my_playbacks = $this->db
                    ->where('time <', $time_end)
                    ->where('time >=', $time_start)
                    ->where('id_affiliate', $this->U_map['affiliate_id'])
                    ->get('stats_samples')
                    ->num_rows();

                $array_res['my_user'][$i] = array(
                    'd' => date('Y-m-d', $time_start),
                    'a' => $my_playbacks,
                );
                $sub_affiliate_1 = $this->M_affiliate->get_affiliate_level(1, $this->U_map['affiliate_id']);
                $sub_playbacks1 = $this->db
                    ->where('time <', $time_end)
                    ->where('time >=', $time_start)
                    ->where_in('id_affiliate', $sub_affiliate_1)
                    ->get('stats_samples')
                    ->num_rows();
                $sub_affiliate_2 = $this->M_affiliate->get_affiliate_level(2, $this->U_map['affiliate_id']);
                $sub_playbacks2 = $this->db
                    ->where('time <', $time_end)
                    ->where('time >=', $time_start)
                    ->where_in('id_affiliate', $sub_affiliate_2)
                    ->get('stats_samples')
                    ->num_rows();
                $sub_affiliate_3 = $this->M_affiliate->get_affiliate_level(3, $this->U_map['affiliate_id']);
                $sub_playbacks3 = $this->db
                    ->where('time <', $time_end)
                    ->where('time >=', $time_start)
                    ->where_in('id_affiliate', $sub_affiliate_3)
                    ->get('stats_samples')
                    ->num_rows();
                $sub_affiliate_4 = $this->M_affiliate->get_affiliate_level(4, $this->U_map['affiliate_id']);
                $sub_playbacks4 = $this->db
                    ->where('time <', $time_end)
                    ->where('time >=', $time_start)
                    ->where_in('id_affiliate', $sub_affiliate_4)
                    ->get('stats_samples')
                    ->num_rows();
                $array_res['sub_affiliate'][$i] = array(
                    'd' => date('Y-m-d', $time_start),
                    'a1' => $sub_playbacks1,
                    'a2' => $sub_playbacks2,
                    'a3' => $sub_playbacks3,
                    'a4' => $sub_playbacks4,
                );
            } else {
                $transaction = $this->db->select('amount')
                    ->where('time <', $time_end)
                    ->where('time >=', $time_start)
                    ->where('user_id', $this->U_map['user_id'])
                    ->get('transactions')->result();
                $money = 0;
                foreach ($transaction as $transaction) {
                    $money += $transaction->amount;
                }
                $array_res['my_user'][$i] = array(
                    'd' => date('Y-m-d', $time_start),
                    'a' => $money,
                );
                $sub_affiliate_1 = $this->M_affiliate->get_affiliate_sub_user(1, $this->U_map['affiliate_id']);
                $transaction_l1 = $this->db->select('amount')
                    ->where('time <', $time_end)
                    ->where('time >=', $time_start)
                    ->where('type', 'amp')
                    ->where_in('user_id', $sub_affiliate_1)
                    ->get('transactions')->result();
                $money_l1 = $money_l2 = $money_l3 = $money_l4 = 0;
                foreach ($transaction_l1 as $transaction) {
                    $money_l1 += $transaction->amount;
                }
                $sub_affiliate_2 = $this->M_affiliate->get_affiliate_sub_user(2, $this->U_map['affiliate_id']);
                $transaction_l2 = $this->db->select('amount')
                    ->where('time <', $time_end)
                    ->where('time >=', $time_start)
                    ->where('type', 'amp')
                    ->where_in('user_id', $sub_affiliate_1)
                    ->get('transactions')->result();
                foreach ($transaction_l2 as $transaction) {
                    $money_l2 += $transaction->amount;
                }
                $sub_affiliate_l3 = $this->M_affiliate->get_affiliate_sub_user(3, $this->U_map['affiliate_id']);
                $transaction_l3 = $this->db->select('amount')
                    ->where('time <', $time_end)
                    ->where('time >=', $time_start)
                    ->where('type', 'amp')
                    ->where_in('user_id', $sub_affiliate_1)
                    ->get('transactions')->result();
                foreach ($transaction_l3 as $transaction) {
                    $money_l3 += $transaction->amount;
                }
                $sub_affiliate_4 = $this->M_affiliate->get_affiliate_sub_user(4, $this->U_map['affiliate_id']);
                $transaction_l4 = $this->db->select('amount')
                    ->where('time <', $time_end)
                    ->where('time >=', $time_start)
                    ->where('type', 'amp')
                    ->where_in('user_id', $sub_affiliate_1)
                    ->get('transactions')->result();
                foreach ($transaction_l4 as $transaction) {
                    $money_l4 += $transaction->amount;
                }
                $array_res['sub_affiliate'][$i] = array(
                    'd' => date('Y-m-d', $time_start),
                    'a1' => $money_l1,
                    'a2' => $money_l2,
                    'a3' => $money_l3,
                    'a4' => $money_l4,
                );
            }
            $time_start += 86400;//+1day
            $time_end += 86400;// +1day
            ++$i;
            --$numberDays;
        }
        $datajson = json_encode($array_res);
        echo $datajson;
    }
     /**
      * on off stats flp.
      **/
     public function onoffswitch()
     {
         $page = $this->input->post('checked');
         if ($page == 'true') {
             $update['stats_flp'] = '1';
         } else {
             $update['stats_flp'] = '0';
         }
         $this->db->where('id', $this->U_map['id'])
            ->update('affiliates', $update);
     }
    /**
     * Counter song sample.
     **/
    public function counter_song()
    {
        $songId = $this->input->get('songId');
        $id_affiliate = $this->input->get('id_affiliate');
        $CounterHits = $this->session->userdata('CounterHits_song'.$songId);
        if (!isset($CounterHits)) {
            $this->session->sess_expiration = '60';
            $this->session->set_userdata('CounterHits_song'.$songId, true);
            $song = $this->db->where('id', $songId)->get('audio_song')->row();
            $num_count = $song->listened + 1;
            $this->db->where('id', $songId)->update('audio_song', array('listened' => $num_count));
            $array_insert = array(
                'song_id' => $songId,
                'time' => time(),
                'id_affiliate' => $id_affiliate,
            );
            $this->db->insert('stats_samples', $array_insert);
        }
    }
}
