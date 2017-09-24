<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Map extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_audio_song');
        $this->load->model('M_user');
        $this->load->model('M_affiliate');
        $this->load->helper('string');
        $this->load->model('M_customize_epk');
    }
    //public $Affiliate_id;
    /**
    * Ajax AMP load data songs.
    *
    * @return xml
    **/
    public function get_audio()
    {
        $affiliateId = $this->input->get('affiliateId');
        $playlist_id = $this->input->get('albumId');
        if (isset($playlist_id) && isset($affiliateId)) {
            header('Access-Control-Allow-Origin: *');
            header('Content-type: text/xml; charset=utf-8');
            $data_playlist = $this->db->where('id', $playlist_id)->get('playlist_amp')->row_array();

            $data_song_amp = $this->db
                ->select('au.*,amp.playlist_amp_id')
                ->where('playlist_amp_id', $data_playlist['id'])
                ->group_start()
                    ->or_like('au.availability', '4')
                    ->or_like('au.availability', '1')
                    ->or_like('au.availability', '3')
                ->group_end()
                ->join('audio_song au', 'au.id = amp.audio_song_id')
                ->get('audio_amp amp')->result_array();

            if (!empty($data_song_amp) && !empty($data_playlist)) {
                $xml = '<?xml version="1.0" encoding="UTF-8"?>';
                $data_xml = '';
                $albumprice = $total_listened = 0;
                foreach ($data_song_amp as $row) {
                    if ($this->M_affiliate->check_lock_amp($affiliateId, $row['user_id'])) {
                        if($row['option_type']==2){
                            if($row['video_file1']!=""){
                                                     $path1 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['video_file1'];
                            }  if($row['video_file2']!=""){ 
                                $path2 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['video_file2'];
                            }
                             if($row['video_file3']!=""){ 
                                $path3 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['video_file3'];
                            }
                                                     
                            }
                        else {
                            if($row['audio_file1']!=""){
                         $path1 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file1'];
                        }
                         if($row['audio_file2']!=""){
                         $path2 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file2'];
                        }
                        if($row['audio_file3']!=""){
                         $path3 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file3'];
                        }
                         if($row['audio_file4']!=""){
                         $path4 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file4'];
                        }
                         if($row['audio_file5']!=""){
                         $path5 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file5'];
                        }
                        }
                        $song_listened = $row['listened'];
                        $total_listened += $row['listened'];
                        $song_duration = $row['duration'];
                        $song_id = $row['id'];
                        $song_album_id = $row['playlist_amp_id'];
                        $file_name = $row['song_name'];
                        $lyrics=$row['lyrics'];
                        if($row['option_type']=="1"){
                        $title = $row['song_name'].$row['song_name_auth'];
                        } else {
                           $title = $row['video_name'].$row['video_name_auth']; 
                        }
                        $price = $row['price'];
                        $albumprice += $row['price'];
                        $uid = $row['user_id'];
                        $album = $data_playlist['name'];
                        $composer = $this->M_user->get_name($row['user_id']);
                        $artist = $this->M_user->get_name($row['user_id']);
                        $currency = $row['currency'];
                        $data_xml .= '<song ';
                        if(isset($path1)){
                        $data_xml .= ' path1="'.$path1.'"';
                        }
                        if(isset($path2)){
                           $data_xml .= ' path2="'.$path2.'"'; 
                        }
                        if(isset($path3)){
                           $data_xml .= ' path3="'.$path3.'"'; 
                        }
                        if(isset($path4)){
                           $data_xml .= ' path4="'.$path4.'"'; 
                        }
                        if(isset($path5)){
                           $data_xml .= ' path5="'.$path5.'"'; 
                        }
                        $data_xml .= ' song_listened="'.$song_listened.'"';
                        $data_xml .= ' song_duration="'.$song_duration.'"';
                        $data_xml .= ' song_id="'.$song_id.'"';
                        $data_xml .= ' song_album_id="'.$song_album_id.'"';
                        $data_xml .= ' file_name="'.$file_name.'"';
                        $data_xml .= ' title="'.$title.'"';
                        $data_xml .= ' price="'.$price.'"';
                        $data_xml .= ' uid="'.$uid.'"';
                        $data_xml .= ' album="'.$album.'"';
                        $data_xml .= ' currency="'.$currency.'"';
                        $data_xml .= ' composer="'.$composer.'"';
                        $data_xml .= ' artist="'.$artist.'"';
                         $data_xml .=' lyrics="'.htmlspecialchars($lyrics).'"';
                        $data_xml .= ' />';
                    }
                }
                $img_cover = base_url().'uploads/'.$data_playlist['user_id'].'/img_playlist/'.$data_playlist['image_file'];
                $data_player = '<player showPlaylist="yes" autoStart="no" playlist="'.$data_playlist['name'].'" img_cover="'.$img_cover.'" albumprice="'.$albumprice.'"  total_listened="'.$total_listened.'">';
                echo $xml.$data_player.$data_xml.'</player>';
            }
        }
    }
    
     public function get_epk_audio()
    {
        $user_id = $this->input->get('user_id');
        $playlist_id = $this->input->get('albumId');
        if (isset($playlist_id) && isset($user_id)) {
            header('Access-Control-Allow-Origin: *');
            header('Content-type: text/xml; charset=utf-8');
            $data_playlist = $this->db->where('id', $playlist_id)->get('album_song')->row_array();
            //function to select id 
            $epk_song_id_data = $this->M_audio_song->get_epk_songs_id($user_id);
            $data_album_songs = $this->db->where('album_id', $playlist_id)->get('audio_song')->result_array();
            $data_song_amp = array();
            $songs = $this->M_audio_song->get_data_songs_epk($playlist_id);
            foreach ($songs as $key => $value) {
                if (in_array($value['id'], $epk_song_id_data)) {
                    $select_b = 'true';
                    $data_song_amp[] = $value;
                } 
            }
            if (!empty($data_song_amp) && !empty($data_playlist)) {
                $xml = '<?xml version="1.0" encoding="UTF-8"?>';
                $data_xml = '';
                $albumprice = $total_listened = 0;
                foreach ($data_song_amp as $row) {
                    
                        if($row['option_type']==2)
                        {
                            if($row['video_file1']!=""){
                                                     $path1 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['video_file1'];
                            }  if($row['video_file2']!=""){ 
                                $path2 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['video_file2'];
                            }
                             if($row['video_file3']!=""){ 
                                $path3 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['video_file3'];
                            }
                                                     
                        }
                        else 
                        {
                            if($row['audio_file1']!=""){
                                $path1 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file1'];
                            }
                             if($row['audio_file2']!=""){
                             $path2 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file2'];
                            }
                            if($row['audio_file3']!=""){
                             $path3 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file3'];
                            }
                             if($row['audio_file4']!=""){
                             $path4 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file4'];
                            }
                             if($row['audio_file5']!=""){
                             $path5 = 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file5'];
                            }
                        }
                        $song_listened = $row['listened'];
                        $total_listened += $row['listened'];
                        $song_duration = $row['duration'];
                        $song_id = $row['id'];
                        $song_album_id = $row['album_id'];
                        $file_name = $row['song_name'];
                        $lyrics=$row['lyrics'];
                        if($row['option_type']=="1"){
                        $title = $row['song_name'].$row['song_name_auth'];
                        } else {
                           $title = $row['video_name'].$row['video_name_auth']; 
                        }
                        $price = $row['price'];
                        $albumprice += $row['price'];
                        $uid = $row['user_id'];
                        $album = ($data_playlist['attribute'] != 0 ? $data_playlist['name'] : " ");
                        $composer = $this->M_user->get_name($row['user_id']);
                        $artist = $this->M_user->get_name($row['user_id']);
                        $currency = $row['currency'];
                        $data_xml .= '<song ';
                        if(isset($path1)){
                        $data_xml .= ' path1="'.$path1.'"';
                        }
                        if(isset($path2)){
                           $data_xml .= ' path2="'.$path2.'"'; 
                        }
                        if(isset($path3)){
                           $data_xml .= ' path3="'.$path3.'"'; 
                        }
                        if(isset($path4)){
                           $data_xml .= ' path4="'.$path4.'"'; 
                        }
                        if(isset($path5)){
                           $data_xml .= ' path5="'.$path5.'"'; 
                        }
                        $data_xml .= ' song_listened="'.$song_listened.'"';
                        $data_xml .= ' song_duration="'.$song_duration.'"';
                        $data_xml .= ' song_id="'.$song_id.'"';
                        $data_xml .= ' song_album_id="'.$song_album_id.'"';
                        $data_xml .= ' file_name="'.$file_name.'"';
                        $data_xml .= ' title="'.$title.'"';
                        $data_xml .= ' price="'.$price.'"';
                        $data_xml .= ' uid="'.$uid.'"';
                        $data_xml .= ' album="'.$album.'"';
                        $data_xml .= ' currency="'.$currency.'"';
                        $data_xml .= ' composer="'.$composer.'"';
                        $data_xml .= ' artist="'.$artist.'"';
                        $data_xml .=' lyrics="'.htmlspecialchars($lyrics).'"';
                        $data_xml .= ' />';
                   
                }
                $img_cover = $this->M_audio_song->get_cover_playlist($row['album_id']); ;
                $data_player = '<player showPlaylist="yes" autoStart="no" playlist="'.$album.'" img_cover="'.$img_cover.'" albumprice="'.$albumprice.'"  total_listened="'.$total_listened.'">';
                echo $xml.$data_player.$data_xml.'</player>';
            }
        }
    }
    public function buycart()
    {
        $buy_song_id = $this->input->post('buy_song_id');
        $song_id_arr = explode(',', $buy_song_id);
        $buy_uid = $this->input->post('buy_uid');
        $album_id = $this->input->post('album_id');
        $affiliateid = $this->input->post('affiliateId');
        if (isset($affiliateid) && !empty($affiliateid)) {
            $data['affiliateid'] = $affiliateid;
            $data['data_playlist'] = $this->db->where('id', $album_id)->get('album_song')->row_array();
            $data['data_songs'] = $this->db->select('audio_song.*,album_song.name ')
                ->where_in('audio_song.id', $song_id_arr)
                ->join('album_song', 'album_song.id = audio_song.album_id')->get('audio_song')->result_array();
            $this->load->view('map/buycart', $data);
        }
    }
    public function payment_paypal()
    {
        $song_id_arr = $this->input->post('id_song');
        $affiliateid = $this->input->post('affiliateid');
        if (isset($affiliateid) && !empty($affiliateid) && ($song_id_arr) && !empty($song_id_arr)) {
            $this->session->set_flashdata('affiliateid', $affiliateid);
            $Data_songs = $this->db->where_in('id', $song_id_arr)->get('audio_song')->result_array();
            include APPPATH.'libraries/PayPal-PHP-SDK/vendor/paypal/rest-api-sdk-php/sample/payments/CreatePaymentUsingPayPal.php';
        }
    }
    public function execute_payment()
    {
        $affiliateid = $this->session->flashdata('affiliateid');
        $data_pay = require APPPATH.'libraries/PayPal-PHP-SDK/vendor/paypal/rest-api-sdk-php/sample/payments/GetPayment.php';
        if ($data_pay->state == 'created') {
            $data_pay_new = require APPPATH.'libraries/PayPal-PHP-SDK/vendor/paypal/rest-api-sdk-php/sample/payments/ExecutePayment.php';
            if ($data_pay_new->state == 'approved') {
                //$this->CreatePayout($data_pay->transactions[0]->item_list,1);
                $insertArr = array(
                    'payer_id' => $data_pay->id,
                    'first_name' => $data_pay->payer->payer_info->first_name,
                    'last_name' => $data_pay->payer->payer_info->last_name,
                    'payment_status' => $data_pay_new->state,
                    'mc_gross' => $data_pay->transactions[0]->amount->total,
                    'payer_email' => $data_pay->payer->payer_info->email,
                    'mc_currency' => $data_pay->transactions[0]->amount->currency,
                    'payment_date' => time(),
                    'affiliateid' => $affiliateid,
                );
                $this->db->insert('payment_song', $insertArr);
                $payment_song_id = $this->db->insert_id();
                foreach ($data_pay->transactions[0]->item_list->items as $row) {
                    $insertArr = array(
                        'payer_id'=>$data_pay->id,
                        'payment_song_id' => $payment_song_id,
                        'item_id' => $row->sku,
                        'name_item' => $row->name,
                        'price' => $row->price,
                        'affiliateid' => $affiliateid,
                    );
                    $this->db->insert('map_downloads', $insertArr);
                    //$id_map_downloads = $this->db->insert_id();
                    $this->MakePayment($affiliateid, $row->sku);
                }
                $this->download_songs($data_pay_new);
            } else {
                echo 'Error Execute Payment paypal';
                die;
            }
        } elseif ($data_pay->state == 'approved') {
            $this->download_songs($data_pay);
        }
    }
    public function download_songs($data_pay)
    {
        if ($data_pay->state == 'approved') {
            $data1['data_songs'] = $this->db->select('a.*,p.payer_id')
                ->where('p.payer_id', $data_pay->id)
                ->join('map_downloads m', 'm.item_id = a.id')
                ->join('payment_song p', 'p.id = m.payment_song_id')
                ->get('audio_song a')->result_array();
            $this->load->view('map/download_songs', $data1);
        } else {
        }
    }
    /**
     * calculator payment affiliate 4 level and user artist.
     *
     * @ affiliate seler
     * @ id audio song
     **/
    public function MakePayment($affiliateid, $id_song)
    {
        //get data song 
        $data_song = $this->db->where('id', $id_song)->get('audio_song')->row();
        //get data commision artist
        $data_commission = $this->M_affiliate->get_data_commissions($data_song->user_id);
        $commissions_99sound = $this->M_setting->get_commissions_99sound();
        //get data level affilaite
        $data_level = $this->db->where('affiliate_id', $affiliateid)
            ->where('artist_id', $data_song->user_id)
            ->get('affiliate_level')->row();
        if (!empty($data_level)) {
            $aff_artist = $this->db->where('artist_id', $data_level->artist_id)
                ->where('user_id', $data_level->artist_id)->get('affiliates')->row();
            $PRICE = $data_song->price -($commissions_99sound/100);
            switch ($data_level->level) {
                case 0:
                    //make payment artist
                    $this->Make_payment_aff($aff_artist->affiliate_id, $PRICE, $data_song->id);
                    break;
                case 1:
                    //calculator amount 
                    $amount1 = $PRICE * (($data_commission['commission_1']) / 100);
                    $this->Make_payment_aff($affiliateid, $amount1, $data_song->id);
                    //make payment artist
                    $amountArtist = $PRICE - $amount1;
                    $this->Make_payment_aff($aff_artist->affiliate_id, $amountArtist, $data_song->id, $data_level->level);
                    break;
                case 2:
                  
                    //make paymet affiliate 2
                    //calculator amount  
                    $amount2 = $PRICE * (($data_commission['commission_2']) / 100);
                    $this->Make_payment_aff($affiliateid, $amount2, $data_song->id);

                    //make paymet affiliate 1
                    //calculator amount 
                    $amount1 = $PRICE * (($data_commission['commission_1']) / 100);
                    $this->Make_payment_aff($data_level->affiliate_1, $amount1, $data_song->id, $data_level->level);
                    //make payment artist
                    $amountArtist = $PRICE - $amount1 - $amount2;
                    $this->Make_payment_aff($aff_artist->affiliate_id, $amountArtist, $data_song->id, $data_level->level);
                    break;
                case 3:
                      
                    //make paymet affiliate 3
                    //calculator amount  
                    $amount3 = $PRICE * (($data_commission['commission_3']) / 100);
                    $this->Make_payment_aff($affiliateid, $amount3, $data_song->id);

                    //make paymet affiliate 2
                    //calculator amount  
                    $amount2 = $PRICE * (($data_commission['commission_2']) / 100);
                    $this->Make_payment_aff($data_level->affiliate_2, $amount2, $data_song->id, $data_level->level);

                    //make paymet affiliate 1
                    //calculator amount 
                    $amount1 = $PRICE * (($data_commission['commission_1']) / 100);
                    $this->Make_payment_aff($data_level->affiliate_1, $amount1, $data_song->id, $data_level->level);
                    //make payment artist
                    $amountArtist = $PRICE - $amount1 - $amount2 - $amount3;
                    $this->Make_payment_aff($aff_artist->affiliate_id, $amountArtist, $data_song->id, $data_level->level);
                    break;
                case 4:
                    //make paymet affiliate 4
                    //calculator amount  
                    $amount4 = $PRICE * (($data_commission['commission_4']) / 100);
                    $this->Make_payment_aff($affiliateid, $amount4, $data_song->id, $data_level->level);

                    //make paymet affiliate 3
                    //calculator amount  
                    $amount3 = $PRICE * (($data_commission['commission_3']) / 100);
                    $this->Make_payment_aff($data_level->affiliate_3, $amount3, $data_song->id, $data_level->level);

                    //make paymet affiliate 2
                    //calculator amount  
                    $amount2 = $PRICE * (($data_commission['commission_2']) / 100);
                    $this->Make_payment_aff($data_level->affiliate_2, $amount2, $data_song->id, $data_level->level);

                    //make paymet affiliate 1
                    //calculator amount 
                    $amount1 = $PRICE * (($data_commission['commission_1']) / 100);
                    $this->Make_payment_aff($data_level->affiliate_1, $amount1, $data_song->id, $data_level->level);
                    //make payment artist
                    $amountArtist = $PRICE - $amount1 - $amount2 - $amount3 - $amount4;
                    $this->Make_payment_aff($aff_artist->affiliate_id, $amountArtist, $data_song->id, $data_level->level);
                    break;
            }
        }
    }
    /**
     * Save database stats and update balance.
     *
     * @param string $affiliate seler
     * @param float  $amount    item
     * @param int    $id_audio  song
     * @param int    $level
     **/
    public function Make_payment_aff($affiliate_id, $amount, $item_id, $data_level = null)
    {
        //get data song 
         $data_aff = $this->db->select('a.user_id,u.balance')
            ->where('affiliate_id', $affiliate_id)
            ->join('users u', 'u.id = a.user_id')
            ->get('affiliates a')->row();
        $data_song = $this->db->where('id', $item_id)->get('audio_song')->row();
        $data_insert = array(
            'amount	' => round($amount, 5, PHP_ROUND_HALF_DOWN),
            'user_id' => $data_aff->user_id,
            'item_id' => $item_id,
            'time' => time(),
            'currency' => 'USD',
            'type' => 'amp',
            'level_sale' => $data_level,
            'status'=>1,
         );
        $this->db->insert('transactions', $data_insert);
        $this->db->where('id', $item_id)->update('audio_song', array('sales' => $data_song->sales + 1));
         // update balance
         $amount_balance = $data_aff->balance + round($amount, 5, PHP_ROUND_HALF_DOWN);
        $data_update = array(
            'balance' => $amount_balance,
         );
        $this->db->where('id', $data_aff->user_id)->update('users', $data_update);
        $check_notifi = $this->M_user->check_onoff_sales($data_aff->user_id);
        if ($check_notifi) {
            $message = 'You have received “'.round($amount, 5, PHP_ROUND_HALF_DOWN).'” from the sale of songs.';
            $this->M_notify->addnotify($data_aff->user_id, $message, 'amper_sales');
        }
    }
    /**
     * Create Payout.
     **/
    public function CreatePayout($G_Items, $Level)
    {
        $data = require APPPATH.'libraries/PayPal-PHP-SDK/sample/payouts/CreateBatchPayout.php';
    }
    /**
     * Download audio song.
     *
     * @param string $payer_id
     * @param int    $song_id
     **/
    public function map_download_song($payer_id, $song_id)
    {
        $row = $this->db->select('audio_song.*')
            ->join('map_downloads m', 'm.item_id = audio_song.id')
            ->join('payment_song p', 'p.id = m.payment_song_id')
            ->where('p.payer_id', $payer_id)
            ->where('audio_song.id', $song_id)
            ->get('audio_song')->row_array();
        if (isset($row)) {
            $view_tats = $this->db->where('artist_id', $row['user_id'])
                ->get('stats_presskit')->row_array();
            if (!empty($view_tats) || $view_tats['interactions'] == 0) {
                $updateArr = array(
                    'interactions' => $view_tats['interactions'] + 1,
                );
                $this->db->update('stats_presskit', $updateArr, 'artist_id = '.$row['user_id']);
            } else {
                $updateArr = array(
                    'artist_id' => $row['user_id'],
                    'interactions' => 1,
                );
                $this->db->insert('stats_presskit', $updateArr);
            }
            $this->load->helper('download');
            $type = $this->input->get('type');
            $filename=$this->input->get('filename');
            if ($type == 'audio') {
               
                $data = file_get_contents('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$filename); // Read the file's contents
                $name = $filename;
                force_download($name, $data);
            }
                
             elseif ($type == 'video') {
                
                $data = file_get_contents('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$filename); // Read the file's contents
                $name = $filename;
               force_download($name, $data);
            }
        }
    }
    /**
     * Cancel buy song.
     **/
    public function cancel()
    {
        $this->load->view('map/cancel_buy');
    }
    /**
     * ajax get option widget amp.
     **/
    public function get_option_widget()
    {
        header('Access-Control-Allow-Origin: *');
        $U_map = $this->session->userdata('U_map');
        $data_id = $this->input->get('affiliateid');
        $data_user = $this->db->select('affiliates.option_widget')->where('affiliate_id', $data_id)->get('affiliates')->row_array();
     
        echo $data_user['option_widget'];
        die;
    }
    /**
     * get payment paypal.
     **/
    public function get_payment($payment_id)
    {
        $hdrarray = array(
            'Content-Type:application/json',
            'Authorization: Bearer EI4wWJD-xtA1DPoaRM44NDbPsKFAXVVdikXIm9tpv-XnNcz6Zoo3-1Ch4zxm4PxHqO76ZXn8hsw31E_b',
        );
        $ch = curl_init('https://api.sandbox.paypal.com/v1/payments/payment/'.$payment_id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrarray);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        /* add POST fields parameters */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $data_json = json_decode($response);

        return $data_json;
        curl_close($ch);
    }

    /**
     * ajax get option widget amp with user_id.
     **/
    public function get_option_widget_user_id()
    {
        header('Access-Control-Allow-Origin: *');
        $U_map = $this->session->userdata('U_map');
        $data_id = $this->input->get('user_id');
        $data_user = $this->db->select('affiliates.option_widget')->where('user_id', $data_id)->get('affiliates')->row_array();
       echo $data_user['option_widget'];
        die();
    }
}
