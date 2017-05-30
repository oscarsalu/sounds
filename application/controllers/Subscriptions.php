<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Subscriptions extends CI_Controller
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
    public $setting_global;
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('loged_in') == false) {
            redirect('account/login');
        }
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
        $this->load->model('M_user');
        $this->load->model('M_home');
        $this->load->model('M_text');
        $this->load->model('M_notify');
        $this->load->model('M_zoho');
        $this->setting_global = $this->db->get('settings_global')->row_array();
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
     * Show popup subscriptions.
     */
    public function popup()
    {
        #1 top 1
        $user_data = $this->session->userdata('user_data');
        $data['setting_global'] = $this->db->get('settings_global')->row();
        if ($user_data['role'] == 1) {
            //artists
            $basic = $this->M_user->check_subscription_artist_basic($user_data['id']);
            $premium = $this->M_user->check_subscription_artist_basic($user_data['id']);
            if ($basic) {
                $this->load->view('subscriptions/popup/premium', $data);
            } else {
                $this->load->view('subscriptions/popup/basic', $data);
            }
        } else {
            $this->load->view('subscriptions/popup/amper', $data);
        }
    }
    /**
     * View upgrade.
     */
    public function upgrade()
    {
        $data['setting_global'] = $this->db->get('settings_global')->row();
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('subscriptions/upgrade', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View invoice.
     */
    public function view_invoice($invoice_id)
    {
        header('Content-type:  application/pdf');
        $invoice = $this->M_zoho->get_invoice_pdf($invoice_id);
    }
    /**
     * View credit info.
     */
    public function credit_info()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $data['extrar_users'] = $this->db->where('id_user', $data['user_data']['id'])
            ->get('extrar_users')->row_array();
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('subscriptions/credit_info', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View billing history.
     */
    public function billing_history()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $data_zoho = $this->db->where('id_user', $data['user_data']['id'])->get('extrar_users')->row_array();
        $data['billing'] = $this->get_subscriptions($data_zoho['zoho_customer_id']);
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('subscriptions/billing_history', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View checkout card.
     */
    public function checkout_card($plan_code)
    {
        $data['user_data'] = $this->session->userdata('user_data');
        /*if ($this->check_live_server()) { */
            $plan = $this->get_plan($plan_code);
          
            
         
            if ($plan->code == 0) {
               
                
                 
               $data['plan_name']=$plan->plan->name;
               $data['plan_code']=$plan->plan->plan_code;
               $data['plan_price']=$plan->plan->recurring_price;
               $data['interval']=$plan->plan->interval;
               $data['interval_unit']=$plan->plan->interval_unit;
               $data['trial_period']=$plan->plan->trial_period;
            } else {
                $this->session->set_flashdata('message_error', $plan->message);
                echo  $plan->message;
                die;
            }
      /*  } */
        $paymentId = $this->input->get('paymentId');
        $success = $this->input->get('success');
        if (!empty($paymentId) && $success = 'true') {
            $info_payment = require APPPATH.'libraries/PayPal-PHP-SDK/vendor/paypal/rest-api-sdk-php/sample/payments/GetPayment.php';
            $data['email_paypal'] = $info_payment->payer->payer_info->email;
        }
        $data['settings'] = $this->setting_global;
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('subscriptions/checkout_card', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * create hosted pages subscriptions.
     */
    public function create_hostedpages()
    {
        $plan_code = $this->input->post('plancode');

        if (isset($plan_code)) {
            $data['user_data'] = $this->session->userdata('user_data');
            $data_zoho = $this->M_zoho->hostedpages_new_subscription($data['user_data']['id'], $plan_code);
            if ($data_zoho->code == 0) {
                $redirect_url = $data_zoho->hostedpage->url;
                redirect($redirect_url);
            } else {
                $this->session->set_flashdata('message_error', $data_zoho->message);
                redirect('subscriptions/checkout/'.$plan_code);
            }
        } else {
            $this->session->set_flashdata('message_error', 'Invalid Plan code ');
            redirect('subscriptions/upgrade');
        }
    }
    /**
     * confirm create subscriptions.
     */
    public function success_create($plan_code)
    {
        $user_data = $this->session->userdata('user_data');
        $hostedpage_id = $this->input->get('hostedpage_id');
        if (isset($hostedpage_id)) {
            $data_zoho = $this->M_zoho->get_hosted($hostedpage_id);
            if ($data_zoho->code == 0) {
                if ($data_zoho->status == 'success') {
                    $Respone_sub = $data_zoho->data->subscription;
                    
                    
                    $My_subscription = $this->db->where('upgrade_subscription_id', $Respone_sub->subscription_id)
                        ->get('extrar_users')->row();
                    if (empty($My_subscription)) {
                        $this->db->insert(
                            'extrar_users', array(
                                'id_user' => $user_data['id'],
                                'zoho_customer_id' => $Respone_sub->customer->customer_id,
                                'card_id' => $Respone_sub->card->card_id,
                                'upgrade_subscription_id' => $Respone_sub->subscription_id,
                                'zoho_status' => $Respone_sub->status,
                                'payment_amount' => $Respone_sub->amount,
                                'plan_code' => $Respone_sub->plan->plan_code,
                                'zoho_invoice_id'=>$Respone_sub->child_invoice_id,
                            )
                        );
                       
                        //update plan basic
                        if ($plan_code == 'Artist_basic') {
                            //artist plan basic
                            $this->db->where('id', $user_data['id'])->update('users', array('plan_status' => 1));
                        } elseif ($plan_code == 'Featured_Artist_1' || $plan_code == 'Featured_Artist_2' || $plan_code == 'Featured_Artist_3'
                        || $plan_code == 'Featured_Artist_4' || $plan_code == 'Featured_Artist_8') {
                            //$pack = $My_subscription->interval;
                            //$pack_fre = $My_subscription->paymenamount;
                            if($plan_code=='Featured_Artist_1'){
                            $end_day = date('Y-m-d H:i:s', strtotime("+7 days"));
                            } else if ($plan_code=='Featured_Artist_2'){
                                $end_day = date('Y-m-d H:i:s', strtotime("+14 days"));
                            }
                            else if ($plan_code=='Featured_Artist_3'){
                                $end_day = date('Y-m-d H:i:s', strtotime("+21 days"));
                            }
                            else if ($plan_code=='Featured_Artist_4'){
                                $end_day = date('Y-m-d H:i:s', strtotime("+28 days"));
                            }
                            else if ($plan_code=='Featured_Artist_8'){
                                $end_day = date('Y-m-d H:i:s', strtotime("+56 days"));
                            }
                            $insertArr = array(
                                'user_id' => $user_data['id'],
                                'pack' => $Respone_sub->interval,
                                'money' => $Respone_sub->amount,
                                'start_day' => date('Y-m-d H:i:s'),
                                'end_day' => $end_day,
                                'active' => 1,
                            );
                            $this->db->insert('premium_pack', $insertArr);
                            $this->M_notify->addnotify($user_data['id'], $data_zoho->message, 'subscription');
                            $this->session->set_flashdata('message_msg', $data_zoho->message);
                            redirect('subscriptions/featured');
                        }
                        $this->session->set_flashdata('message_msg', $data_zoho->message.'upgrade subscription');
                        redirect('subscriptions/subscriptions_plan');
                    } else {
                        redirect('subscriptions/subscriptions_plan');
                    }
                }
            } else {
                $this->session->set_flashdata('message_error', $data_zoho->message);
                redirect('subscriptions/checkout/'.$plan_code);
            }
        } else {
            $this->session->set_flashdata('message_error', 'Invalid hostedpage_id');
            redirect('subscriptions/upgrade');
        }
    }
    /**
     * post upgrade subscriptions.
     */
    public function postupgrade()
    {
        $user_data = $this->session->userdata('user_data');
        $Arr_card = array(
            'card_number' => $this->input->post('card_number'),
            'expiry_month' => $this->input->post('expiry_month'),
            'expiry_year' => $this->input->post('expiry_year'),
            'cvv_number' => $this->input->post('cvv_number'),
            'street' => $this->input->post('street'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip' => $this->input->post('zip'),
            'country' => $this->input->post('country'),
        );
        $plan_code = $this->input->post('plan_code');
        $zoho_data = $this->M_zoho->create_subscription($user_data['id'], $plan_code, $Arr_card);
        if ($zoho_data->code == 0) {
            $this->db->insert(
                'extrar_users', array(
                    'id_user' => $user_data['id'],
                    'zoho_customer_id' => $zoho_data->subscription->customer->customer_id,
                    'zoho_invoice_id' => $zoho_data->subscription->child_invoice_id,
                    'card_id' => $zoho_data->subscription->card->card_id,
                    'upgrade_subscription_id' => $zoho_data->subscription->subscription_id,
                    'zoho_status' => $zoho_data->subscription->status,
                    'payment_amount' => $zoho_data->subscription->amount,
                    'plan_code' => $zoho_data->subscription->plan->plan_code,
                )
            );
            //update plan basic
            if ($plan_code == 'Artist_basic') {
                if ($this->M_user->check_subscription($user_data['id'], 'Artist_premium')) {
                    //cancel subscription premium
                    $extrar_users = $this->db
                        ->where('id_user', $user_data['id'])
                        ->where('plan_code', 'Artist_premium')
                        ->where('zoho_status', 'live')
                        ->get('extrar_users')->row();
                    $zoho_cancel = $this->M_zoho->cancel_subscription($extrar_users->upgrade_subscription_id, false);
                    if ($zoho_cancel->code == 0) {
                        $this->db->where('id', $extrar_users->id)
                        ->update('extrar_users', array('zoho_status' => $zoho_cancel->subscription->status));
                    }
                }
                //artist plan basic
                $this->db->where('id', $user_data['id'])->update('users', array('plan_status' => 1));
            } elseif ($plan_code == 'Artist_premium') {
                if ($this->M_user->check_subscription($user_data['id'], 'Artist_basic')) {
                    //cancel subscription base
                    $extrar_users = $this->db
                        ->where('id_user', $user_data['id'])
                        ->where('plan_code', 'Artist_basic')
                        ->where('zoho_status', 'live')
                        ->get('extrar_users')->row();
                    $zoho_cancel = $this->M_zoho->cancel_subscription($extrar_users->upgrade_subscription_id, false);
                    if ($zoho_cancel->code == 0) {
                        $this->db->where('id', $extrar_users->id)
                        ->update('extrar_users', array('zoho_status' => $zoho_cancel->subscription->status));
                    }
                }
                $this->db->where('id', $user_data['id'])->update('users', array('plan_status' => 2));
                //artist plan premium
            } elseif ($plan_code == 'Featured_Artist_1' || $plan_code == 'Featured_Artist_2' || $plan_code == 'Featured_Artist_3'
            || $plan_code == 'Featured_Artist_4' || $plan_code == 'Featured_Artist_8') {
                $pack = $zoho_data->subscription->interval;
                $pack_fre = $zoho_data->subscription->amount;
                $end_day = date('Y-m-d H:i:s', strtotime("+$pack days"));
                $insertArr = array(
                    'user_id' => $user_data['id'],
                    'pack' => $pack,
                    'money' => $pack_fre,
                    'start_day' => date('Y-m-d H:i:s'),
                    'end_day' => $end_day,
                    'active' => 1,
                );
                $this->db->insert('premium_pack', $insertArr);
                $this->M_notify->addnotify($user_data['id'], $zoho_data->message, 'subscription');
                $this->session->set_flashdata('message_msg', $zoho_data->message);
                redirect('subscriptions/featured');
            }
            //update plan notify
            $this->M_notify->addnotify($user_data['id'], $zoho_data->message, 'subscription');
            $this->session->set_flashdata('message_msg', $zoho_data->message);
            redirect('subscriptions/subscriptions_plan');
        } else {
            $this->session->set_flashdata('message_error', $zoho_data->message);
            redirect('subscriptions/checkout/'.$plan_code);
        }
    }
    /**
     * View subscriptions plan.
     */
    public function subscriptions_plan()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $extrar_users = $this->db->where('id_user', $data['user_data']['id'])
            ->where('zoho_status!=', 'cancelled')
            ->get('extrar_users')->result_array();
        if (empty($extrar_users)) {
 
            redirect('subscriptions/upgrade');
        }
        $data['subscriptions'] = array();
        foreach ($extrar_users as $row) {
            $datasubscription = $this->M_zoho->get_subscription($row['upgrade_subscription_id']);
        
            if ($datasubscription->code == 0) {
                $data['subscriptions'][] = $datasubscription->subscription;
            }
        }
        
        $id_sub = $this->input->get('plan');
        foreach ($data['subscriptions'] as $row) {
            if (isset($id_sub)) {
                if ($row->subscription_id == $id_sub) {
                    $data['subscription_current'] = $row;
                    $user_extra = $this->db->where('upgrade_subscription_id', $row->subscription_id)->get('extrar_users')->row();
                    if (isset($user_extra)) {
                        $card_id = $user_extra->card_id;
                        $dataCard = $this->M_zoho->get_card($data['user_data']['id_zoho'], $card_id);
                        if ($dataCard->code == 0) {
                            $data['card_current'] = $dataCard->card;
                        }
                    }
                    break;
                }
            } else {
                $data['subscription_current'] = $row;
                $user_extra = $this->db->where('upgrade_subscription_id', $row->subscription_id)->get('extrar_users')->row();
                if (isset($user_extra)) {
                    $card_id = $user_extra->card_id;
                    $dataCard = $this->M_zoho->get_card($data['user_data']['id_zoho'], $card_id);
                    if ($dataCard->code == 0) {
                        $data['card_current'] = $dataCard->card;
                    }
                }
                break;
            }
        }
      
        $settings_global = $this->db->get('settings_global')->row_array();
        $data['settings_global'] = json_decode($settings_global['premium_artists_fee']);
        if ($this->input->post()) {
            $pack = $this->input->post('pack');
            redirect('subscriptions/checkout/Featured_Artist_'.$pack);
        }
        $pack = $this->db->where('user_id', $data['user_data']['id'])->where('active', 1)->where('end_day <', date('Y-m-d H:i:s'))->get('premium_pack')->row_array();
        if (isset($pack) && !empty($pack)) {
            $this->db->where('id', $pack['id'])->update('premium_pack', array('active' => 0));
        }
        $data['data_premium'] = $this->db->where('user_id', $data['user_data']['id'])->where('active', 1)->get('premium_pack')->row_array();
        $data['premiums'] = $this->db->where('user_id', $data['user_data']['id'])->order_by('id', 'DESC')->get('premium_pack')->result_array();
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('subscriptions/billing_subscriptions', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * Update card.
     */
    public function update_card()
    {
        $user_data = $this->session->userdata('user_data');
        $card_id = $this->input->post('card_id');
        $Arr_card = array(
            'card_number' => $this->input->post('ccinput1'),
            'expiry_month' => $this->input->post('ccinput2'),
            'expiry_year' => $this->input->post('ccinput3'),
            'cvv_number' => $this->input->post('ccinput4'),
            'street' => $this->input->post('ccinput7'),
            'city' => $this->input->post('ccinput8'),
            'zip' => $this->input->post('ccinput9'),
            'state' => $this->input->post('ccinput10'),
            'country' => $this->input->post('ccinput11'),
        );
        $dataCard = $this->M_zoho->update_card($user_data['id_zoho'], $card_id, json_encode($Arr_card));
        if ($dataCard->code == 0) {
            $this->session->set_flashdata('message_msg', $dataCard->message);
        } else {
            $this->session->set_flashdata('message_error', $dataCard->message);
        }
        redirect('subscriptions/subscriptions_plan');
    }
    /**
     * cancel subscriptions plan.
     */
    public function cancel()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $id_sub = $this->input->post('id_sub');
        $type_cancel = $this->input->post('type');
        $extrar_users = $this->db->where('id_user', $data['user_data']['id'])
            ->where('upgrade_subscription_id', $id_sub)
            ->get('extrar_users')->row_array();
        if (!empty($extrar_users)) {
            if ($type_cancel == 1) {
                // Cancel on Next Renewal
                $zoho_data = $this->M_zoho->cancel_subscription($extrar_users['upgrade_subscription_id'], true);
                if ($zoho_data->code == 0) {
                    $this->db->update(
                        'extrar_users',
                        array('zoho_status' => $zoho_data->subscription->status),
                        'id ='.$extrar_users['id']
                    );
                    $this->db->where('id', $data['user_data']['id'])->update('users', array('plan_status' => 0));
                    $this->M_notify->addnotify($data['user_data']['id'], $zoho_data->message, 'subscription');
                    $this->session->set_flashdata('message_msg', $zoho_data->message);
                } else {
                    $this->session->set_flashdata('message_error', $zoho_data->message);
                }
            } elseif ($type_cancel == 2) {
                // Cancel Immediately
                $data_sub = $this->get_sub_upgrade($extrar_users['upgrade_subscription_id']);
                $date_1y = strtotime(date('Y-m-d', strtotime($data_sub->activated_at)).' +1 year');
                if ($date_1y <= strtotime('now')) {
                    // After 1 year
                    $zoho_data = $this->M_zoho->cancel_subscription($extrar_users['upgrade_subscription_id']);
                    if ($zoho_data->code == 0) {
                        $this->db->update(
                            'extrar_users',
                            array('zoho_status' => $zoho_data->subscription->status),
                            'id ='.$extrar_users['id']
                        );
                        $this->db->where('id', $data['user_data']['id'])->update('users', array('plan_status' => 0));
                        $this->M_notify->addnotify($data['user_data']['id'], $zoho_data->message, 'subscription');
                        $this->session->set_flashdata('message_msg', $zoho_data->message);
                    } else {
                        $this->session->set_flashdata('message_error', $zoho_data->message);
                    }
                } else {
                    $date_3 = strtotime(date('Y-m-d', strtotime($data_sub->activated_at)).' +3 days');
                    $date_10 = strtotime(date('Y-m-d', strtotime($data_sub->activated_at)).' +10 days');
                    $date_30 = strtotime(date('Y-m-d', strtotime($data_sub->activated_at)).' +30 days');
                    if ($date_3 >= strtotime('now')) {
                        // before 3 days
                        //cancel subcriptions
                        $zoho_data = $this->M_zoho->cancel_subscription($extrar_users['upgrade_subscription_id']);
                        if ($zoho_data->code == 0) {
                            $this->db->update(
                                'extrar_users',
                                array('zoho_status' => $zoho_data->subscription->status),
                                'id ='.$extrar_users['id']
                            );
                            $this->db->where('id', $data['user_data']['id'])->update('users', array('plan_status' => 0));
                            $this->session->set_flashdata('message_msg', $zoho_data->message);
                            $this->M_notify->addnotify($data['user_data']['id'], $zoho_data->message, 'subscription');
                            //refund amount
                            $data_invoice = $this->get_invoice($extrar_users['zoho_invoice_id']);
                            if ($data_invoice->code == 0) {
                                $data_refund = $this->refund_payment($data_invoice->invoice->payments[0]->payment_id, $extrar_users['payment_amount']);
                                if ($data_refund->code == 0) {
                                    $this->session->set_flashdata('message_refund', $data_refund->message);
                                } else {
                                    $this->session->set_flashdata('message_error', $data_refund->message);
                                }
                            } else {
                                $this->session->set_flashdata('message_error', $data_invoice->message);
                            }
                        } else {
                            $this->session->set_flashdata('message_error', $zoho_data->message);
                        }
                    } else {
                        if ($date_10 > strtotime('now')) {
                            // After 10 days
                        }
                        if ($date_30 > strtotime('now')) {
                            // After 30 days
                            $data_plan = $this->penality($extrar_users['zoho_customer_id'], $extrar_users['card_id']);
                            if ($data_plan->code == 0) {
                                $zoho_data = $this->M_zoho->cancel_subscription($extrar_users['upgrade_subscription_id']);
                                if ($zoho_data->code == 0) {
                                    $this->db->update(
                                        'extrar_users',
                                        array('zoho_status' => $zoho_data->subscription->status),
                                        'id ='.$extrar_users['id']
                                    );
                                    $this->db->where('id', $data['user_data']['id'])->update('users', array('plan_status' => 0));
                                    $this->M_notify->addnotify($data['user_data']['id'], $zoho_data->message, 'subscription');
                                    $this->session->set_flashdata('message_msg', $zoho_data->message);
                                } else {
                                    $this->session->set_flashdata('message_error', $zoho_data->message);
                                }
                            } else {
                                $this->session->set_flashdata('message_error', $data_plan->message);
                            }
                        }   //end affter 30 days
                    } //end affter 3 days
                }// end before 1 year
            }//end type cencel 
        }
        redirect('subscriptions/subscriptions_plan?plan='.$id_sub);
    }
    /**
     * reactivate subscriptions.
     *
     * @param $id_subscription
     */
    public function reactivate_subscription($id_sub)
    {
        $user_data = $this->session->userdata('user_data');
        $extrar_users = $this->db->where('id_user', $user_data['id'])
            ->where('upgrade_subscription_id', $id_sub)
            ->get('extrar_users')->row_array();
        if (!empty($extrar_users)) {
            $data_zoho = $this->M_zoho->reactivate_subscription($id_sub);
            if ($data_zoho->code == 0) {
                $this->session->set_flashdata('message_msg', $data_zoho->message);
            } else {
                $this->session->set_flashdata('message_error', $data_zoho->message);
            }
        } else {
            $this->session->set_flashdata('message_error', 'Invalid UserID');
        }
        redirect('subscriptions/subscriptions_plan?plan='.$id_sub);
    }
    /**
     * Post customer.
     *
     * @param array $insert_data
     */
    public function post_customer($insert_data)
    {
        $organization_id = $this->setting_global['zoho_organization_id'];
        $authtoken = $this->setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );
        // create a new cURL resource

        $param_post = '{
            "display_name": "'.$insert_data['firstname'].' '.$insert_data['lastname'].'",
            "first_name": "'.$insert_data['firstname'].'",
            "last_name": "'.$insert_data['lastname'].'",
            "email": "'.$insert_data['email'].'",
            "company_name": "'.$insert_data['company_name'].'"
        }';
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/customers ');
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  ($param_post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $data_json = json_decode($result);
        curl_close($ch);

        return $data_json->customer->customer_id;
        // close cURL resource, and free up system resources
    }
     /**
      * Get invoice.
      *
      * @param int $invoice_id
      */
     public function get_invoice($invoice_id)
     {
         $organization_id = $this->setting_global['zoho_organization_id'];
         $authtoken = $this->setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );

        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/invoices/'.$invoice_id);
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $response = curl_exec($ch);
         $data_json = json_decode($response);
         curl_close($ch);

         return $data_json;
     }
     /**
      * Get plan.
      *
      * @param string $plancode
      */
     public function get_plan($plan_code)
     {
         $organization_id = $this->setting_global['zoho_organization_id'];
         $authtoken = $this->setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );

        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/plans/'.$plan_code);
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $response = curl_exec($ch);
         $data_json = json_decode($response);
         curl_close($ch);

         return $data_json;
     }
    /**
     * Get invoice.
     *
     * @param int $subscriptions_id
     */
    public function get_sub_upgrade($subscriptions_id)
    {
        $organization_id = $this->setting_global['zoho_organization_id'];
        $authtoken = $this->setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );

        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/subscriptions/'.$subscriptions_id);
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);
        if ($data_json->code == 0) {
            return $data_json->subscription;
        } else {
            return 0;
        }
    }
    /**
     * Penality.
     *
     * @param int $customer_id
     * @param int $card_id
     */
    public function penality($customer_id, $card_id)
    {
        $organization_id = $this->setting_global['zoho_organization_id'];
        $authtoken = $this->setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );

        $param_post = '{
            "customer_id": "'.$customer_id.'",
            "card_id": "'.$card_id.'",
            "plan": {
                "plan_code": "Pen50"
               },
        }';
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/subscriptions');
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_post);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);

        return $data_json;
    }
    /**
     * Cancel subscriptions.
     *
     * @param int  $subscriptions_id
     * @param bool $cancel_at_end
     *
     * @return json
     */
    public function cancel_subscription($subscriptions_id, $cancel_at_end = false)
    {
        $organization_id = $this->setting_global['zoho_organization_id'];
        $authtoken = $this->setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );

        // create a new cURL resource
        if ($cancel_at_end) {
            $at_end = 'true';
        } else {
            $at_end = 'false';
        }
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/subscriptions/'.$subscriptions_id.'/cancel?cancel_at_end='.$at_end);
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);

        return $data_json;
    }
    /**
     * recording payment.
     *
     * @param bigint $customer_id
     * @param int    $amount
     *
     * @return json
     */
    public function recording_payment($customer_id, $amount)
    {
        $organization_id = $this->setting_global['zoho_organization_id'];
        $authtoken = $this->setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );
        $param_post = '{
            "customer_id": "'.$customer_id.'",
            "amount": '.$amount.',
            "date": "'.date('Y-m-d').'",
            "payment_mode": "creditcard",
            "description": "Add Payment for Customer: '.$customer_id.'",
        }';
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/payments');
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_post);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);

        return $data_json;
    }
    /**
     * refund payment payment.
     *
     * @param bigint $payment_id
     * @param int    $amount
     *
     * @return json
     */
    public function refund_payment($payment_id, $amount)
    {
        $organization_id = $this->setting_global['zoho_organization_id'];
        $authtoken = $this->setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );
        $param_post = '{
            "amount": '.$amount.',
            "description": "Refund has been added to payment_id: '.$payment_id.'",
        }';
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/payments/'.$payment_id.'/refunds');
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_post);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);

        return $data_json;
    }
    /**
     * Check live or localhost.
     *
     * @return bool
     */
    public function check_live_server()
    {
        $whitelist = array('127.0.0.1', '::1');
        if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Checkout paypal.
     */
    public function checkout_paypal()
    {
        $PlanCode = $this->input->post('plan_code');
        $data_plan = $this->M_zoho->get_plan($PlanCode);
        if ($data_plan->code == 0) {
            $PlanPrice = $data_plan->plan->recurring_price;
            $PlanName = $data_plan->plan->name;
            include APPPATH.'libraries/PayPal-PHP-SDK/vendor/paypal/rest-api-sdk-php/sample/payments/CreatePaymentCheckOut.php';
        }
    }
    /**
     * View subscriptions featured.
     */
    public function featured()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $settings_global = $this->db->get('settings_global')->row_array();
        $data['settings_global'] = json_decode($settings_global['premium_artists_fee']);
        if ($this->input->post()) {
            $pack = $this->input->post('pack');
            redirect('subscriptions/checkout/Featured_Artist_'.$pack);
        }
        $pack = $this->db->where('user_id', $data['user_data']['id'])->where('active', 1)->where('end_day <', date('Y-m-d H:i:s'))->get('premium_pack')->row_array();
        if (isset($pack) && !empty($pack)) {
            $this->db->where('id', $pack['id'])->update('premium_pack', array('active' => 0));
        }
        $data['data_premium'] = $this->db->where('user_id', $data['user_data']['id'])->where('active', 1)->get('premium_pack')->row_array();
        $data['premiums'] = $this->db->where('user_id', $data['user_data']['id'])->order_by('id', 'DESC')->get('premium_pack')->result_array();
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('subscriptions/featured', $data);
        $this->load->view('includes/footer', $data);
    }
}
