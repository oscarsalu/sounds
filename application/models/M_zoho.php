<?php

class M_zoho extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    /**
     * Create a Customer zoho.
     *
     * @param int $id_user
     **/
    public function create_customer($id_user)
    {
        $whitelist = array('127.0.0.1', '::1');
        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            return 1;
        }
        $setting_global = $this->db->get('settings_global')->row_array();
        $data_user = $this->db->where('id', $id_user)->get('users')->row();
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken = $setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );
        // create a new cURL resource
        if ($data_user->role == 1) {
            $display_name = $data_user->firstname.' '.$data_user->lastname;
        } elseif ($data_user->role == 2) {
            $display_name = $data_user->fan_name;
            if (empty($display_name)) {
                $display_name = $data_user->firstname.' '.$data_user->lastname;
            }
        }
        $param_post = '{
            "display_name": "'.$display_name.'",
            "first_name": "'.$data_user->firstname.'",
            "last_name": "'.$data_user->lastname.'",
            "email": "'.$data_user->email.'",
            "company_name": ""
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
        if ($data_json->code == 0) {
            //The customer has been created
            $customer_id = $data_json->customer->customer_id;
            $this->db->where('id', $id_user)->update('users', array('id_zoho' => $customer_id));
        }
    }
    /**
     * Create a subscription hosted page.
     *
     * @param int    $user_id
     * @param string $plan_code
     *
     * @return json
     **/
    public function hostedpages_new_subscription($id_user, $plan_code)
    {
        $data_user = $this->db->where('id', $id_user)->get('users')->row();

        if (!empty($data_user->id_zoho)) {
            $setting_global = $this->db->get('settings_global')->row_array();
            $organization_id = $setting_global['zoho_organization_id'];
            $authtoken = $setting_global['zoho_authtoken'];
            //replace your organization_id , authtoken and subscription_id  with your values
            $hdrarray = array(
                'X-com-zoho-subscriptions-organizationid: '.$organization_id,
                'Authorization: Zoho-authtoken '.$authtoken,
                'Content-Type: application/json;charset=UTF-8',
            );
            $param_post = '{
                "customer_id": "'.$data_user->id_zoho.'",
                "plan": {
                    "plan_code": '.$plan_code.'
                },
                "redirect_url": "'.base_url('subscriptions/success/'.$plan_code).'"
            }';
            // create a new cURL resource
            $ch = curl_init('https://subscriptions.zoho.com/api/v1/hostedpages/newsubscription');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param_post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $data_json = json_decode($response);
            curl_close($ch);

            return $data_json;
        }
    }
    /**
     * Create a subscription.
     *
     * @param int    $user_id
     * @param string $plan_code
     * @param string $card
     *
     * @return json
     **/
    public function create_subscription($id_user, $plan_code, $card)
    {
        $data_user = $this->db->where('id', $id_user)->get('users')->row();
        if (!empty($data_user->id_zoho)) {
            $setting_global = $this->db->get('settings_global')->row_array();
            $organization_id = $setting_global['zoho_organization_id'];
            $authtoken = $setting_global['zoho_authtoken'];
            //replace your organization_id , authtoken and subscription_id  with your values
            $hdrarray = array(
                'X-com-zoho-subscriptions-organizationid: '.$organization_id,
                'Authorization: Zoho-authtoken '.$authtoken,
                'Content-Type: application/json;charset=UTF-8', );
            $param_post = '{
                "customer_id": "'.$data_user->id_zoho.'",
                "plan": {
                    "plan_code": '.$plan_code.'
                },
                "payment_terms":10,
                "card": {
                    "card_number": "'.$card['card_number'].'",
                    "cvv_number": "'.$card['cvv_number'].'",
                    "expiry_year": '.$card['expiry_year'].',
                    "expiry_month": '.$card['expiry_month'].',
                    "street": "'.$card['street'].'",
                    "city": "'.$card['city'].'",
                    "state": "'.$card['state'].'",
                    "zip": "'.$card['zip'].'",
                    "country": "'.$card['country'].'",
                    "payment_gateway": "test_gateway",
                },
            }';
            //"payment_gateway": "payments_pro", test_gateway
            // create a new cURL resource
            $ch = curl_init('https://subscriptions.zoho.com/api/v1/subscriptions');
            // set URL and other appropriate options
            curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param_post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $data_json = json_decode($response);
            curl_close($ch);

            return $data_json;
        }
    }
    /**
     * Get Subcription by ID.
     *
     * @param int $id
     *
     * @return json
     **/
    public function get_subscription($id)
    {
        $setting_global = $this->db->get('settings_global')->row_array();
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken = $setting_global['zoho_authtoken'];
        $hdrarray = array(
                'X-com-zoho-subscriptions-organizationid: '.$organization_id,
                'Authorization: Zoho-authtoken '.$authtoken,
                'Content-Type: application/json;charset=UTF-8', );
        //replace your organization_id , authtoken and subscription_id  with your values3.
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/subscriptions/'.$id);
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);

        return $data_json;
    }
    /**
     * Get Subcription by customer ID.
     *
     * @param int $id_customer
     *
     * @return json
     **/
    public function get_subscriptions($id)
    {
        $setting_global = $this->db->get('settings_global')->row_array();
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken = $setting_global['zoho_authtoken'];
        $hdrarray = array(
                'X-com-zoho-subscriptions-organizationid: '.$organization_id,
                'Authorization: Zoho-authtoken '.$authtoken,
                'Content-Type: application/json;charset=UTF-8', );
        //replace your organization_id , authtoken and subscription_id  with your values3.
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/subscriptions?filter_by=SubscriptionStatus.All&customer_id='.$id);
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);

        return $data_json;
    }
    /**
     * Cancel Subcription.
     *
     * @param string $subscriptions_id
     * @param bool   $cancel_at_end
     *
     * @return json
     **/
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
     * Reactive Subcription.
     *
     * @param string $subscription_id
     *
     * @return json
     **/
    public function reactivate_subscription($id)
    {
        $setting_global = $this->db->get('settings_global')->row_array();
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken = $setting_global['zoho_authtoken'];
        $hdrarray = array(
                'X-com-zoho-subscriptions-organizationid: '.$organization_id,
                'Authorization: Zoho-authtoken '.$authtoken,
                'Content-Type: application/json;charset=UTF-8', );
        //replace your organization_id , authtoken and subscription_id  with your values3.
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/subscriptions/'.$id.'/reactivate');
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
     * update price subscription.
     *
     * @param string $plan_code
     * @param string $recurring_price
     **/
    public function update_price_plan($plan_code, $recurring_price)
    {
        $setting_global = $this->db->get('settings_global')->row_array();
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken = $setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );
        $data_plan = self::get_plan($plan_code);
        $param_post = '{
            "name": "'.$data_plan->plan->name.'",
            "recurring_price": '.$recurring_price.',
            "interval": '.$data_plan->plan->interval.',
            "interval_unit": "'.$data_plan->plan->interval_unit.'",
        }';
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/plans/'.$plan_code);
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        //curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);

        return $data_json;
    }
    /**
     * Update Plan  artist subscription.
     *
     * @param string $price
     * @param string $day_trial
     *
     * @return json
     **/
    public function update_plan_artist($price, $day_trial)
    {
        $setting_global = $this->db->get('settings_global')->row_array();
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken = $setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );
        $data_plan = self::get_plan('Artist_basic');
        $param_post = '{
            "name": "'.$data_plan->plan->name.'",
            "recurring_price": '.$price.',
            "trial_period": '.$day_trial.',
            "interval": '.$data_plan->plan->interval.',
            "interval_unit": "'.$data_plan->plan->interval_unit.'"
        }';
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/plans/Artist_basic');
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        //curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);

        return $data_json;
    }
    /**
     * Get plan.
     *
     * @param string $plan_code
     *
     * @return json
     **/
    public function get_plan($plan_code)
    {
        $setting_global = $this->db->get('settings_global')->row_array();
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken = $setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/plans/'.$plan_code);
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        //curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,array());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);

        return $data_json;
    }
    /**
     * Get a hosted page subscriptions.
     *
     * @param string $hostedpage_id
     *
     * @return json
     **/
    public function get_hosted($hostedpage_id)
    {
        $setting_global = $this->db->get('settings_global')->row_array();
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken = $setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/hostedpages/'.$hostedpage_id);
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        //curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,array());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);

        return $data_json;
    }
    /**
     * Get a card.
     *
     * @param string $customer_id
     * @param string $id_card
     *
     * @return json
     **/
    public function get_card($customer_id, $id_card)
    {
        $setting_global = $this->db->get('settings_global')->row_array();
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken = $setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/customers/'.$customer_id.'/cards/'.$id_card);
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        //curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,array());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);

        return $data_json;
    }
    /**
     * Update a card.
     *
     * @param string $customer_id
     * @param string $card_id
     * @param string $param_post
     *
     * @return json
     **/
    public function update_card($customer_id, $card_id, $param_post)
    {
        $setting_global = $this->db->get('settings_global')->row_array();
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken = $setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/customers/'.$customer_id.'/cards/'.$card_id);
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        //curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);

        return $data_json;
    }
    /**
     * Get a invoice pdf.
     *
     * @param string $invoice_id
     **/
    public function get_invoice_pdf($invoice_id)
    {
        $setting_global = $this->db->get('settings_global')->row_array();
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken = $setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Accept: application/pdf', );
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/invoices/'.$invoice_id.'');
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        //curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,array());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        curl_close($ch);
        //return($data_json);
    }
    
      /**
     * Get plan List.
     *
     * @param string $plan_code
     *
     * @return json
     **/
    public function get_plan_list()
    {
        $setting_global = $this->db->get('settings_global')->row_array();
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken = $setting_global['zoho_authtoken'];
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray = array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id,
            'Authorization: Zoho-authtoken '.$authtoken,
            'Content-Type: application/json;charset=UTF-8', );
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/plans/');
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        //curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,array());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        $data_json = json_decode($response);
        
        curl_close($ch);

        return $data_json;
    }
}
