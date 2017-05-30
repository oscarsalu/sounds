<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {
    
    function __construct() {
        parent::__construct();
        $this->is_login();    
    }   
    
    function is_login(){
        if($this->session->userdata('loged_in') == false && $this->session->userdata('is_admin') != 1){
            redirect('login');
		}
    }
    /**
    * Viev dashboard admin
    **/
    public function index()
    {
       
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] =  $this->session->userdata('user_data');
        $Total_balance  = $this->db->select('SUM(amount) as total')->where('type','amp')->get('transactions')->row();
        $data['Total_balance'] = ($Total_balance->total==null)? '0.00' : $Total_balance->total;
        $week_balance  = $this->db->select('SUM(amount) as total')
            ->where('type','amp')
            ->where('time >=',strtotime('monday this week'))
            ->where('time <',strtotime( 'monday next week'))
            ->get('transactions')->result();
        $data['week_balance'] = ($week_balance[0]->total==null)? '0.00' : $week_balance[0]->total;
        $month_balance  = $this->db->select('SUM(amount) as total')
            ->where('type','amp')
            ->where('time >=',strtotime('first day of this month', time()))
            ->where('time <',strtotime('first day of next month'))
            ->get('transactions')->result();
        $data['month_balance'] = ($month_balance[0]->total==null)? '0.00' : $month_balance[0]->total;
        $this->template->load('admin_template', 'dashboard', $data);       
    }
    /**
    *
    * call ajax stats  return json data 
    **/
    public function call_stats(){
        $day_start = $this->input->post('time_start');
        //$day_start = 1465185600; //1465185600','1465790400','2'
        $day_end = $this->input->post('time_end');
        //$day_end = 1465790400;
        $timeDiff = abs($day_end - $day_start);
        $numberDays = $timeDiff/86400;  // 86400 seconds in one day
        // and you might want to convert to integer
        $numberDays = intval($numberDays);
        $i=0;
        $array_res = array();
        $time_start = $day_start;//monday
        $time_end = $day_start + 86400; // +1day
        while($numberDays>0){
            $transaction = $this->db->select('SUM(amount) as total')
                ->where('type','amp')
                ->where('time <',$time_end)
                ->where('time >=',$time_start)
                ->get('transactions')->row(); 
            if(empty($transaction->total)){
                $money = 0;
            }else{
                $money = $transaction->total;
            }  
            $array_res[$i] = array(
                'd' => date('Y-m-d',$time_start),
                'a' => $money
            );
            $time_start += 86400;//+1day
            $time_end += 86400;// +1day
            $i++;
            $numberDays--;
        }
        $datajson = json_encode($array_res);
        echo($datajson) ;  
    }
}
