<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
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
        $this->load->model('M_photo');
        $this->load->model('M_user');
        if ($this->session->userdata('loged_in') == false) {
            redirect('account/login');
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
     * Payout paypal.
     */
    public function payout()
    {
        $id = $this->session->userdata('loged_in');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'AMP fee', 'required|valid_email');
        $this->form_validation->set_rules('email_confirm', 'Email Support', 'required|valid_email|matches[email]');
        $this->form_validation->set_rules('amount', 'Email Support', 'required');
        if ($this->form_validation->run() != false) {
            $EMAIL_paypal = $this->input->post('email');
            $AMOUNT = round($this->input->post('amount'), 2, PHP_ROUND_HALF_DOWN);
            $data_user = $this->db->where('id', $id)->get('users')->row();
            $MONEY_balance = $data_user->balance;
            if ($MONEY_balance > 0 && $AMOUNT <= $MONEY_balance) {
                include APPPATH.'libraries/PayPal-PHP-SDK/vendor/paypal/rest-api-sdk-php/sample/payouts/CreateSingePayout.php';
               /* $balance = round($MONEY_balance - $AMOUNT, 5, PHP_ROUND_HALF_DOWN);
                $this->db->where('id', $data_user->id)->update('users', array('balance' => $balance)); */
                $data_insert = array(
                    'amount	' => $AMOUNT,
                    'user_id' => $data_user->id,
                    'time' => time(),
                    'currency' => 'USD',
                    'type' => 'withdraw',
                    'paypal_email'=>$EMAIL_paypal,
                    'status'=>0,
                 );
                $this->db->insert('transactions', $data_insert);
            }
        } else {
            $error = $this->form_validation->error_array();
            $output = '<ol>';
            foreach ($error as $key => $val) {
                $output .= '<li>'.$key.': '.$val.'</li>';
            }
            $output .= '</ol>';
            $this->session->set_flashdata('message_error', $output);
        }
        redirect('amper/stats');
    }
}
