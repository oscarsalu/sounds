<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_subscription extends CI_Model {
    
    function __construct(){
        parent::__construct();
    }
    
    /**
     * get all invoice
    **/
    function get_subscriptions($page=1,$filter_by=null) {
        $setting_global = $this->db->get('settings_global')->row_array();	
        $organization_id = $setting_global['zoho_organization_id'];
        $authtoken= $setting_global['zoho_authtoken']; 
        //replace your organization_id , authtoken and subscription_id  with your values
        $hdrarray=array(
            'X-com-zoho-subscriptions-organizationid: '.$organization_id, 
            'Authorization: Zoho-authtoken '.$authtoken,
            "Content-Type: application/json;charset=UTF-8");
        // create a new cURL resource
        $ch = curl_init('https://subscriptions.zoho.com/api/v1/subscriptions?per_page=25&page='.$page.'&filter_by='.$filter_by);
        //$ch = curl_init('https://subscriptions.zoho.com/api/v1/invoices?email=leone@gmail.com');
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
?>