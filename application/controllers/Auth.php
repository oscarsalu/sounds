<?php
/**
 * PHP_CodeSniffer tokenizes PHP code and detects violations of a
 * defined set of coding standards.
 *
 * PHP version 5
 *
 * @category  PHP
 *
 * @author    sound99 <author@example.com>
 * @copyright 2016 99SOUND
 * @license   http://www.99SOUND.COM  PHP License 3.01   
 *
 * @link      http://pear.php.net/package/PackageName
 */

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Auth.
 * 
 * @category  PHP
 *
 * @author    sound99 <author@example.com>
 * @copyright 2016 99sound
 * @license   http://www.99SOUND.COM  PHP License 3.01
 *
 * @version   2016
 *
 * @link      http://pear.php.net/package/PackageName
 */
class Auth extends CI_Controller
{
    /**
     * Auth construct.
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model('M_photo');
        $this->load->model('M_audio_song');
        $this->load->model('M_zoho');
        $this->load->model('M_user_reset_password');
        $this->load->helper('string');
        $this->load->helper('captcha');  
        $this->load->model('M_album_song'); 
        $this->load->model('M_channel');
        $this->config->load('facebook');
        $this->config->load('googleplus');
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
     * Check login.
     * 
     * @return redirect
     */
    protected function isLogin()
    {
        if ($this->session->userdata('loged_in') == false) {
            redirect('login');
        }
    }
    /**
     * Auth::register().
     * 
     * @param int $data null
     * 
     * @return response
     */
    public function register($data = null)
    {
        include APPPATH.'libraries/Google/autoload.php';
        $config = $this->config->item('facebook_app_id');
        $config_google = $this->config->item('googleplus');
        //Insert your cient ID and secret 
        //You can get it from : https://console.developers.google.com/
        $client_id = $config_google['client_id'];
        $client_secret = $config_google['client_secret'];
        $redirect_uri = base_url().'account/register/gg';
        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope('email');
        $client->addScope('profile');
        $data['authUrl'] = $client->createAuthUrl();
        $data['title'] = 'User | User Sign_up';
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('auth/register', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View Step register.
     * 
     * @param array $date null
     * @param int   $step
     * 
     * @return Response
     */
    public function signup($date = '', $step = 0)
    {
        $data['title'] = 'User | User Sign_up';
        $data['tmp_email'] = $this->session->userdata('tmp_email');
        $data['tmp_password'] = $this->session->userdata('tmp_password');
        $data['tmp_role'] = $this->session->userdata('tmp_role');
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        switch ($step) {
        case 0:
            $this->session->unset_userdata('tmp_email');
            $this->session->unset_userdata('tmp_password');
            include APPPATH.'libraries/Google/autoload.php';
            $config_google = $this->config->item('googleplus');
            //Insert your cient ID and secret 
            //You can get it from : https://console.developers.google.com/
            $client_id = $config_google['client_id'];
            $client_secret = $config_google['client_secret'];
            $redirect_uri = base_url().'account/register/gg';
            $client = new Google_Client();
            $client->setClientId($client_id);
            $client->setClientSecret($client_secret);
            $client->setRedirectUri($redirect_uri);
            $client->addScope('email');
            $client->addScope('profile');
            $data['authUrl'] = $client->createAuthUrl();
            $this->load->view('auth/register', $data);
            break;
        case 1:
            $this->load->view('auth/choosestype', $data);
            break;
        case 2:
            $data['countries'] = $this->db->get('countries')->result_array();
            $data['genres'] = $this->db->get('genres')->result_array();
            $this->viewdetails($data);
            break;
        }
        $this->load->view('includes/footer', $data);
    }
    /**
     * Post Step1  register
     * email - password.
     * 
     * @return response
     */
    public function step1()
    {
        $role = $this->session->userdata('tmp_role');
        if (empty($role)) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[users.email]|max_length[255]');
            $this->form_validation->set_rules('password', 'password', 'trim|required|max_length[64]');
        
            if ($this->form_validation->run() != false) 
            {
                $data['tmp_email'] = $this->session->set_userdata('tmp_email', $this->input->post('email'));
                $data['tmp_password'] = $this->session->set_userdata('tmp_password', $this->input->post('password'));
                //Code added for change flow of verification
                $data['encrypted_string'] = random_string('alpha', 16);
                $data_password = $this->_createNewPassword($this->input->post('password'));
                
                    $insertArr = array(
                        'email'=>$this->input->post('email'),
                        'password' => $data_password['password'],
                        'hash' => $data_password['hash'],
                        'active' => '2',
                        'token'=>$data['encrypted_string']
                    );
                $this->db->insert('users', $insertArr);
                
                $email = $this->input->post('email');
                $this->sendVerificationMail($email, $data['encrypted_string']);
                $this->session->set_flashdata('message_msg', 'Please check your email and verify for further, thank you!');
                $this->session->set_tempdata('email',$email, 0);
                // $this->session->set_tempdata('email', $email);
                redirect('account/signup');
                // $this->signup($data, $step = 1);

                return 1;
            } else {
                $this->signup();
            }
        } else {
            $this->signup($data = '', $step = 1);
        }
    }
    /**
     * Post Step 2  register
     * Role user artist/fans.
     * 
     * @return response
     */
    public function step2()
    {
        $data['tmp_role'] = $this->session->set_userdata('tmp_role', $this->input->post('role'));
        $this->signup($data, $step = 2);
    }
    function checkDateFormat($date) {
    if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date)) {
        if(checkdate(substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4)))
            return true;
        else
            return false;
    } else {
        return false;
    }
}
    /**
     * Post Step 3  register
     * Confirm create new user.
     * 
     * @return response
     */
    public function step3()
    {
        $email = $this->session->userdata('tmp_email');
       
        $tmp_password = $this->session->userdata('tmp_password');
        $role = $this->session->userdata('tmp_role');
        $data_password = $this->_createNewPassword($tmp_password);
        
        switch ($role) {
        case 1:
           
            $this->load->library('form_validation');
            $this->form_validation->set_rules('city', 'city', 'required|max_length[128]');
            $this->form_validation->set_rules('genre', 'genre', 'required');
            $this->form_validation->set_rules('template_landing', 'template_landing', 'required');
            $this->form_validation->set_rules('artist_name', 'Artist name', 'trim|required|max_length[64]');
            $this->form_validation->set_rules('name', 'Name', 'required|max_length[64]');
            $this->form_validation->set_rules('last_name', 'Last name', 'required|max_length[64]');
            $this->form_validation->set_rules('birth_date', 'Birth Date', 'required');
            $this->form_validation->set_rules('agreeCheckbox', 'Please check agree the terms and condition and checkbox', 'required');
            if ($this->form_validation->run() != false) {
                $home_page = $this->m_user->create_homepage(str_replace(' ', '', $this->input->post('artist_name')));
                if (check_live_server()) {
                    $plan_status = '0';
                } else {
                    $plan_status = '1';
                }
                $birthdate=$this->input->post('birth_date');
                
                $newBirthDate = date("Y-m-d", strtotime($birthdate));
                $userDetails = $this->db->where('email', $email)->where('active', 1)->get('users')->row_array();
                $updateArr = array(
                    'artist_name' => $this->input->post('artist_name'),
                    'countries' => 217,
                    'genre' => $this->input->post('genre'),
                    'city' => $this->input->post('city'),
                    'firstname' => $this->input->post('name'),
                    'lastname' => $this->input->post('last_name'),
                    'birthday'=>strtotime($newBirthDate),
                    'role' => $role,
                    'home_page' => $home_page,
                    'plan_status' => $plan_status,
                    'template_landing' => $this->input->post('template_landing'),
                    //'creatdate'      => strtotime("now"),  					
                );
                 $this->db->where('id', $userDetails['id']); 
                $this->db->update('users', $updateArr);
                //$this->db->insert('users', $insertArr);
                $id = $userDetails['id'];
                //create new custome zoho api
                $this->M_zoho->create_customer($id);
                //set session user
                $this->session->set_userdata('loged_in', $id);
                $user_data = $this->db->where('id='.$id)->get('users')->row_array();
                $this->session->set_userdata('user_data', $user_data);

                //create account affiliate level 0
                $this->M_audio_song->create_shortcode_AMP($id);
                $data_Umap = $this->db->where('user_id', $id)->get('affiliates')->row_array();
                $this->session->set_userdata('U_map', $data_Umap);
                 //code to save affiliates channel in database
                $channel_data = $this->M_channel->check_artist_affiliates_channel($id);
                if(empty($channel_data))
                {
                    for ($i=1; $i <= 4; $i++) { 
                        $channel_name = $userDetails['artist_name'].'-Affilaite-Level'.$i;
                        $dataArray = array('name'=> $channel_name, 'user_id'=> $id, 'type' =>'private', 'time'=> time(), 'is_admin'=> 0, 'group_type'=>'affiliates', 'group_id'=>$id, 'level'=>$i);
                       $channel_id = $this->M_channel->save($dataArray);
                       $dataArray = array('channel_id'=> $channel_id, 'affiliate_id'=> $data_Umap['affiliate_id'], 'level' =>$i);
                       $this->M_channel->save_channel_affilaites($dataArray);
                    }
                }
                $from = new DateTime($newBirthDate);
                $to   = new DateTime('today');
                $age= $from->diff($to)->y;
                if (check_live_server()) {
                    if($age<18){
                        redirect('auth/amp_form');
                        
                    } else {
                        $parent_data=array('parental_approve'=>1);
                      $this->db->where('id', $id); 
                      $this->db->update('users', $parent_data);
                      $insertArr = array(
                        'name' => "HIDDEN",
                        'image_file' => 'music.jpg',
                        'genre' => $this->input->post('genre'),
                        'decs' => strip_tags('This Playlist is for uploading songs that only the artist can see and hear.', '<p><b>'),
                        'user_id' => $id,
                        'time' => time(),
                         'attribute'=>0, 
                    );
                    $this->db->insert('album_song', $insertArr);
                    $id_playlist = $this->db->insert_id();
                    $this->M_audio_song->add_new_option_playlist($id, $id_playlist);
                    redirect('subscriptions/checkout/Artist_basic');
                    }
                } else {
                    if($age<18){  redirect('auth/amp_form');} else {
                        $parent_data=array('parental_approve'=>1);
                      $this->db->where('id', $id); 
                      $this->db->update('users', $parent_data);
                      $insertArr = array(
                        'name' => "HIDDEN",
                        'image_file' => 'music.jpg',
                        'genre' => $this->input->post('genre'),
                        'decs' => strip_tags('This Playlist is for uploading songs that only the artist can see and hear.', '<p><b>'),
                        'user_id' =>$id,
                        'time' => time(),
                          'attribute'=>0, 
                    );
                    $this->db->insert('album_song', $insertArr);
                    $id_playlist = $this->db->insert_id();
                    $this->M_audio_song->add_new_option_playlist($id, $id_playlist);
                    redirect('artist/profile');
                }
                
                }
            } else {
                $this->signup($data = '', $step = 2);
            }
            break;
        case 2:
            $this->load->library('form_validation');
            $this->form_validation->set_rules('city', 'city', 'required|max_length[128]');
            $this->form_validation->set_rules('gender', 'gender', 'required');
            $this->form_validation->set_rules('fan_name', 'fan_name', 'required|my_custom_rule|max_length[64]');
            $this->form_validation->set_rules('birth_date', 'Birth Date', 'required');
            $this->form_validation->set_rules('agreeCheckbox', 'Please check agree the terms and condition and checkbox', 'required');
            if ($this->form_validation->run() != false) {
                $home_page = $this->m_user->create_homepage(str_replace(' ', '', $this->input->post('fan_name')));
                $birthdate=$this->input->post('birth_date');
              
                $newBirthDate = date("Y-m-d", strtotime($birthdate));
                $from = new DateTime($newBirthDate);
                $to   = new DateTime('today');
                $age= $from->diff($to)->y;

                $userDetails = $this->db->where('email', $email)->where('active', 1)->get('users')->row_array();
                $updateArr = array(
                    'fan_name' => $this->input->post('fan_name'),
                    'countries' => 217,
                    'gender' => $this->input->post('gender'),
                    'birthday'=>strtotime($newBirthDate),
                    'city' => $this->input->post('city'),
                    'role' => $role,
                    'active' => '1',
                    'home_page' => $home_page,
                    'template_landing' => 1,
                    //'creatdate'      => strtotime("now"),  					
                );

            $this->db->where('id', $userDetails['id']); 
                $this->db->update('users', $updateArr);
                // $this->db->insert('users', $insertArr);
                $id = $userDetails['id'];
                //create new custome zoho api
                $this->M_zoho->create_customer($id);
                //create affilaite
                $insertArr = array(
                    'affiliate_id' => random_string('unique'),
                    'artist_id'=>'0',
                    'paypal' => $email,
                    'active' => 1,
                    'date_create' => time(),
                    'user_id' => $id,
                );
                $this->db->insert('affiliates', $insertArr);
                $this->session->set_userdata('loged_in', $id);
                $user_data = $this->db->where('id='.$id)->get('users')->row_array();
                $this->session->set_userdata('user_data', $user_data);
                $data_Umap = $this->db->where('user_id', $id)->get('affiliates')->row_array();
                $this->session->set_userdata('U_map', $data_Umap);
                  if($age<18){
                        redirect('auth/amp_form');
                  } else {
                      $parent_data=array('parental_approve'=>1);
                      $this->db->where('id', $id); 
                      $this->db->update('users', $parent_data);
                redirect('');
                  }
            } else {
                $this->signup($data = '', $step = 2);
            }
            break;
        }
    }
    /**
     * View Register step 3email - password.
     * 
     * @param int $data dataview
     * 
     * @return response
     */
    public function viewdetails($data)
    {
        $data['landings'] = $this->db->where('type', 'landing')->where('active', 1)->order_by('position', 'ASC')->get('template_lands')->result_array();
        $role = $data['tmp_role'];
        switch ($role) {
        case 1:
            $this->load->view('auth/details/artist', $data);
            break;
        case 2:
            $this->load->view('auth/details/fan', $data);
            break;
        }
    }
    
    /**
     * Creaate password.
     * 
     * @param string $str null
     * 
     * @return array [password][hash]
     **/
    private function _createNewPassword($str = null)
    {
        if (is_null($str)) {
            $str = random_string('alnum', 8);
        }
        $res['hash'] = random_string('alnum', 5);
        $res['password'] = sha1($res['hash'].$str);

        return $res;
    }
    /**
     * View Login.
     * 
     * @param array $data null
     * 
     * @return redirect
     **/
    public function getlogin($data = '')
    {
        $data = $this->session->userdata('login_false');
        include APPPATH.'libraries/Google/autoload.php';
        $config_google = $this->config->item('googleplus');
        //Insert your cient ID and secret 
        //You can get it from : https://console.developers.google.com/
        $client_id = $config_google['client_id'];
        $client_secret = $config_google['client_secret'];
        $redirect_uri = base_url().'account/login/gg';
        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope('email');
        $client->addScope('profile');
        
        $data['authUrl'] = $client->createAuthUrl();
    // Captcha configuration
        $config = array(
            'img_path'      => 'assets/captcha/',
            'img_url'       => base_url().'assets/captcha/',
            'img_width'     => '150',
            'img_height'    => 50,
            'word_length'   => 6,
            'font_path'     => 'assets/captcha/fonts/Anorexia.ttf',
            'font_size'     => 18,
            'expiration' => 3600  ,
             'pool'          => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
        )  
        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // Send captcha image to view
        $data['captchaImg'] = $captcha['image'];
        
        $this->load->view('includes/header');
        $this->load->view('includes/navbar');
        $this->load->view('auth/login', $data);
        $this->load->view('includes/footer');
        $this->session->unset_userdata('login_false');
        if (!empty($_COOKIE['email'])) {
            $email = $_COOKIE['email'];
            $password = $_COOKIE['password'];
          
            $signin_result = $this->M_user->signin_check($email, $password);
            if (!is_null($signin_result)) {
                $this->session->set_userdata('loged_in', $signin_result['id']);
                $this->session->set_userdata('is_admin', $signin_result['is_admin']);
                $user_data = $this->db->where('id', $signin_result['id'])->get('users')->row_array();
                $this->session->set_userdata('user_data', $user_data);
                $data_Umap = $this->db->where('user_id', $signin_result['id'])->get('affiliates')->row_array();
                $this->session->set_userdata('U_map', $data_Umap);
                if ($user_data['role'] == 1 && $user_data['role'] == 2) {
                    redirect('artist/profile');
                } elseif ($user_data['role'] == 1) {
                    redirect('');
                }
            } else {
                redirect('account/logout');
            }
        }
    }
    /**
     * Refresh Captcha.
     * 
     * @return Response
     **/
    
     public function refresh_captcha(){
        // Captcha configuration
        $config = array(
            'img_path'      => 'assets/captcha/',
            'img_url'       => base_url().'assets/captcha/',
            'img_width'     => '150',
            'img_height'    => 50,
            'word_length'   => 6,
            'font_size'     => 18,
             'font_path'     => 'assets/captcha/fonts/Anorexia.ttf',
            'expiration' => 3600  ,
            'pool'          => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
        )


        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // Display captcha image
        echo $captcha['image'];
    }
    
    /**
     * Post Login.
     * 
     * @return Response
     **/
    public function postlogin()
    {
        $this->session->unset_userdata('loged_in');
        $this->session->unset_userdata('user_data');
        $this->session->unset_userdata('U_map');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|max_length[255]');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        if ($this->form_validation->run() != false) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $remember = $this->input->post('remember');
           $inputCaptcha = $this->input->post('captcha');
            $sessCaptcha = $this->session->userdata('captchaCode');
            $signin_result = $this->M_user->signin_check($email, $password);
            $this->checkAccountLogin($signin_result, $inputCaptcha,$sessCaptcha);
        } else {
            $this->getlogin();
        }
    }
    /**
     * Chech account login.
     * 
     * @param array $signin_result mesager signin
     * 
     * @return redirect
     **/
    public function checkAccountLogin($signin_result,$inputCaptcha,$sessCaptcha)
    {
        if (!is_null($signin_result)) {
          if(strtolower($sessCaptcha) == strtolower($inputCaptcha) || strtoupper($sessCaptcha) == strtoupper($inputCaptcha)){
            if ($signin_result['lock'] == 1) {
                $login_false = array(
                    'login_false' => 'Account has been blocked, you can conntact support',
                );
                $this->session->set_userdata('login_false', $login_false);
                redirect('account/login');
            } elseif ($signin_result['is_admin'] == '1' || $signin_result['is_admin'] == '2') {
                $this->session->set_userdata('loged_in', $signin_result['id']);
                $this->session->set_userdata('is_admin', $signin_result['is_admin']);
                $user_data = $this->db->where('id='.$signin_result['id'])->get('users')->row_array();
                $this->session->set_userdata('user_data', $user_data);
                $data_Umap = $this->db->where('user_id', $signin_result['id'])->get('affiliates')->row_array();
                $this->session->set_userdata('U_map', $data_Umap);
                redirect('admin/dashboard');
            } elseif ($signin_result['active'] == '1') {
                if (!empty($signin_result)) {
                    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
                    setcookie('email', $signin_result['email'], time() + 60 * 60 * 24 * 365, '/', $domain, false);
                    setcookie('password', $signin_result['password'], time() + 60 * 60 * 24 * 365, '/', $domain, false);
                }
                $this->session->set_userdata('loged_in', $signin_result['id']);
                $user_data = $this->db->where('id='.$signin_result['id'])->get('users')->row_array();
                $this->session->set_userdata('user_data', $user_data);
                $this->session->set_userdata('login_false', null);
                if ($signin_result['role'] == 1) {
                    $data_Umap = $this->db->where('user_id', $signin_result['id'])->get('affiliates')->row_array();
                    $this->session->set_userdata('U_map', $data_Umap);
                    if ($signin_result['plan_status'] == 0) {
                        redirect('subscriptions/checkout/Artist_basic');
                    } else {
                        //code to save affiliates channel in database
                        $channel_data = $this->M_channel->check_artist_affiliates_channel($signin_result['id']);
                        if(empty($channel_data))
                        {
                            for ($i=1; $i <= 4; $i++) { 
                                $channel_name = $signin_result['artist_name'].'-Affilaite-Level'.$i;
                                $dataArray = array('name'=> $channel_name, 'user_id'=> $signin_result['id'], 'type' =>'private', 'time'=> time(), 'is_admin'=> 0, 'group_type'=>'affiliates', 'group_id'=>$signin_result['id'], 'level'=>$i);
                               $channel_id = $this->M_channel->save($dataArray);
                               $dataArray = array('channel_id'=> $channel_id, 'affiliate_id'=> $data_Umap['affiliate_id'], 'level' =>$i);
                               $this->M_channel->save_channel_affilaites($dataArray);
                            }
                        }
                        redirect('artist/profile');
                    }
                } elseif ($signin_result['role'] == 2) {
                    $data_Umap = $this->db->where('user_id', $signin_result['id'])->get('affiliates')->row_array();
                    $this->session->set_userdata('U_map', $data_Umap);
                    redirect('amper/dashboard');
                }
            } else {
                $login_false = array(
                    'login_false' => 'Account has not been activated ',
                );
                $this->session->set_userdata('login_false', $login_false);
                redirect('account/login');
            }
        } else {
            $login_false = array(
                'login_false' => 'Captcha does not match',
            );
            $this->session->set_userdata('login_false', $login_false);
            redirect('account/login');
        }
        }else {
            $login_false = array(
                'login_false' => 'Wrong email or Password',
            );
            $this->session->set_userdata('login_false', $login_false);
            redirect('account/login');
        }
        
    }
    /**
     * Logout account.
     * 
     * @return redirect
     **/
    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->unset_userdata('loged_in');
        $this->session->unset_userdata('user_data');
        $this->session->unset_userdata('U_map');
        if (isset($_COOKIE['email'])) {
            unset($_COOKIE['email']);
            unset($_COOKIE['password']);
            $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
            setcookie('email', null, time() + 60 * 60 * 24 * 365, '/', $domain, false);
            setcookie('password', null, time() + 60 * 60 * 24 * 365, '/', $domain, false);
        }
        redirect('account/login');
    }
    /**
     * View forget password.
     * 
     * @return response
     **/
    public function forgottenPassword()
    {
        $this->load->view('includes/header');
        $this->load->view('includes/navbar');
        $this->load->view('auth/forgot_pass');
        $this->load->view('includes/footer');
    }
    /**
     * Send email forget password.
     * 
     * @return redirect
     **/
    public function forgotPass()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|max_length[255]');
        $email = $this->input->post('email');
        if ($this->form_validation->run() != false) {
            $user = $this->db->where('email', $email)->get('users')->row_array();

            if (!empty($user)) {
                $data['password'] = $user['password'];
                $data['email'] = $email;
                $data['user_id'] = $user['id'];
                $data['encrypted_string'] = random_string('alpha', 16);
                $message = $this->load->view('email/forgot_pass', $data, true);
                $this->m_user->temp_reset_password($data['encrypted_string'], $email);
                //code to Enter data in reset password table.
                $this->M_user_reset_password->saveTokenEntry($data['encrypted_string'], $data);
                $this->load->library('email');
                $config['protocol'] = 'smtp';
                $config['charset'] = 'utf-8';
                $config['mailtype'] = 'html';
                $config['newline'] = "\r\n";
                //send email
                $this->email->initialize($config);
                $this->email->clear();
                $this->email->from('oscarsalugmail.com', 'Sound');
                $this->email->to($email);
                $this->email->subject('Forgot password');
                $this->email->message($message);
                $this->email->send();
                $this->session->set_flashdata('message_msg', 'Please check your email for instructions, thank you!');
                redirect('account/forgotten_password');
            } else {
                $this->session->set_flashdata('message_error', 'Email address not exist '.$email);
                redirect('account/forgotten_password');
            }
        } else {
            $this->forgottenPassword();
        }
    }
    /**
     * View reset password.
     * 
     * @param string $encrypted_string random string
     * @param int    $user_id          user id
     * 
     * @return response
     **/
    public function resetPassword($encrypted_string, $user_id)
    {
        $data['encrypted_string'] = $encrypted_string;
        $data['user_id'] = $user_id;
        //code for update link working
        $checkValue = $this->M_user_reset_password->checkLinkExpiration($encrypted_string, $user_id);

        $this->load->view('includes/header');
        $this->load->view('includes/navbar');
        if($checkValue)
        {
            $this->load->view('auth/reset_password', $data);
        }
        else{
            $this->session->set_flashdata('message_error', 'Your link is expired please try again!');
            redirect('account/forgotten_password');
        }
        $this->load->view('includes/footer');
    }
    /**
     * Post reset password.
     * 
     * @return response
     **/
    public function postResetPassword()
    {
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[64]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]|max_length[64]');
        $encrypted_string = $this->input->post('encrypted_string');
        $user_id = $this->input->post('user_id');
        if ($this->form_validation->run()) {
            if ($this->m_user->check_reset_password($encrypted_string, $user_id)) {
                $password_tmp = $this->input->post('password');
                $data_password = $this->_createNewPassword($password_tmp);
                $this->db->where('id', $user_id)->update('users', array('password' => $data_password['password'], 'reset_pass' => '', 'hash' => $data_password['hash']));
                $this->session->set_flashdata('message_msg', 'success reset password');
                redirect('account/login');
            } else {
                $this->session->set_flashdata('message_error', 'the key is not valid');
                $this->resetPassword($encrypted_string, $user_id);
            }
        } else {
            $this->resetPassword($encrypted_string, $user_id);
        }
    }
    /**
     * Check Resiter facebook.
     * 
     * @param int $fb_id facebookid
     * 
     * @return bool
     **/
    public function registerFbCheck($fb_id)
    {
        $data = $this->db->where('id_facebook', $fb_id)->get('users')->row_array();
        if (!empty($data)) {
            return false;
        } else {
            return true;
        }
    }
    /**
     * View step 1 Resiter facebook
     * Choose roles artsit/fans.
     * 
     * @return Response
     **/
    public function registerFbSt1()
    {
        $id_fb = $_SESSION['FB_ID'];
        if ($this->registerFbCheck($id_fb)) {
            // 
            $this->load->view('includes/header');
            $this->load->view('includes/navbar');
            $this->load->view('auth/choosestype_fb');
            $this->load->view('includes/footer');
        } else {
            $this->loginFbPost();
        }
    }
    /**
     * View step 2 Resiter facebook.
     * 
     * @return Response
     **/
    public function registerFbSt2()
    {
        $role = $this->input->post('role');
        $data['landings'] = $this->db->where('type', 'landing')->where('active', 1)->order_by('position', 'ASC')->get('template_lands')->result_array();
        if (isset($role)) {
            $data['tmp_role'] = $_SESSION['tmp_role'] = $role;
        } else {
            $data['tmp_role'] = $_SESSION['tmp_role'];
        }
        $data['genres'] = $this->db->get('genres')->result_array();
        $this->load->view('includes/header');
        $this->load->view('includes/navbar');
        if ($data['tmp_role'] == 1) {
            $this->load->view('auth/details/artist_fb', $data);
        } elseif ($data['tmp_role'] == 2) {
            $this->load->view('auth/details/fan_fb', $data);
        }
        $this->load->view('includes/footer');
    }
    /**
     * Confirm register facebook.
     * 
     * @return redirect
     **/
    public function registerFbSt3()
    {
        $fbid = $_SESSION['FB_ID'];
        $fbfirstname = $_SESSION['FB_FIRSTNAME'];
        $fblastname = $_SESSION['FB_LASTSNAME'];
        $fbgender = $_SESSION['FB_GENDER'];
        if ($this->registerFbCheck($fbid)) {
            $role = $this->session->userdata('tmp_role');
            $password_tmp = $this->input->post('password');
            $data_password = $this->_createNewPassword($password_tmp);
            switch ($role) {
            case 1:
                $this->load->library('form_validation');
                $this->form_validation->set_rules('city', 'city', 'required|max_length[128]');
                $this->form_validation->set_rules('genre', 'genre', 'required');
                $this->form_validation->set_rules('template_landing', 'template_landing', 'required');
                $this->form_validation->set_rules('email', 'email', 'valid_email|trim|required|is_unique[users.email]|max_length[255]');
                $this->form_validation->set_rules('pass', 'Password', 'trim|required|max_length[64]');
                $this->form_validation->set_rules('cpass', 'Confirm password', 'trim|required|max_length[64]');
                if ($this->form_validation->run() != false) {
                    $home_page = $this->m_user->create_homepage(str_replace(' ', '', $fbfirstname));
                    check_live_server() ? $plan_status = 0 : $plan_status = 1;
                    $insertArr = array(
                        'password' => $data_password['password'],
                        'hash' => $data_password['hash'],
                        'email' => $this->input->post('email'),
                        'artist_name' => $fbfirstname,
                        'countries' => 217,
                        'genre' => $this->input->post('genre'),
                        'city' => $this->input->post('city'),
                        'firstname' => $fbfirstname,
                        'lastname' => $fblastname,
                        'role' => $role,
                        'home_page' => $home_page,
                        'active' => '1',
                        'plan_status' => $plan_status,
                        'template_landing' => $this->input->post('template_landing'),
                        'id_facebook' => $fbid,
                        'avata' => 'avatar.jpg',
                        'creatdate' => time(),
                    );
                    $this->db->insert('users', $insertArr);
                    $id = $this->db->insert_id();
                    //create new custome zoho api
                    $this->M_zoho->create_customer($id);
                    //Get the file
                    $config['upload_path'] = './uploads/'.$id.'/photo/';
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, true);
                    } else {
                        chmod($config['upload_path'], 0777);
                    }
                    $content = file_get_contents('https://graph.facebook.com/'.$fbid.'/picture?type=normal');
                    //Store in the filesystem.
                    $save_path = './uploads/'.$id.'/photo/avatar.jpg';
                    file_put_contents($save_path, $content);
                    $this->session->set_userdata('loged_in', $id);
                    $user_data = $this->db->where('id='.$id)->get('users')->row_array();
                    $this->session->set_userdata('user_data', $user_data);
                    $this->M_audio_song->create_shortcode_AMP($id);
                    $data_Umap = $this->db->where('user_id', $id)->get('affiliates')->row_array();
                    $this->session->set_userdata('U_map', $data_Umap);
                    if (check_live_server()) {
                        redirect('subscriptions/checkout/Artist_basic');
                    } else {
                        redirect('artist/profile');
                    }
                } else {
                    $this->registerFbSt2();
                }
                break;
            case 2:
                $this->load->library('form_validation');
                $this->form_validation->set_rules('city', 'city', 'required|max_length[128]');
                $this->form_validation->set_rules('email', 'email', 'valid_email|trim|required|is_unique[users.email]|max_length[255]');
                $this->form_validation->set_rules('pass', 'Password', 'trim|required|matches[cpass]|max_length[64]');
                $this->form_validation->set_rules('cpass', 'Confirm password', 'trim|required|max_length[64]');
                if ($this->form_validation->run() != false) {
                    $insertArr = array(
                        'password' => $data_password['password'],
                        'hash' => $data_password['hash'],
                        'email' => $this->input->post('email'),
                        'fan_name' => $fblastname,
                        'countries' => 217,
                        'gender' => $fbgender,
                        'city' => $this->input->post('city'),
                        'role' => $role,
                        'active' => '1',
                        'id_facebook' => $fbid,
                        'avata' => 'avatar.jpg',
                        'creatdate' => time(),
                    );
                    $this->db->insert('users', $insertArr);
                    $id = $this->db->insert_id();
                    //create new custome zoho api
                    $this->M_zoho->create_customer($id);
                    //Get the file
                    $config['upload_path'] = './uploads/'.$id.'/photo/';
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, true);
                    } else {
                        chmod($config['upload_path'], 0777);
                    }
                    $content = file_get_contents('https://graph.facebook.com/'.$fbid.'/picture?type=normal');
                    //Store in the filesystem.
                    $save_path = './uploads/'.$id.'/photo/avatar.jpg';
                    file_put_contents($save_path, $content);
                    $this->session->set_userdata('loged_in', $id);
                    $user_data = $this->db->where('id='.$id)->get('users')->row_array();
                    $this->session->set_userdata('user_data', $user_data);
                    redirect('');
                } else {
                    $this->registerFbSt2();
                }
                break;
            }
        } else {
            $this->session->set_flashdata('message_error', 'can not register. Account faceebook existing!');
            redirect('account/signup');
        }
    }
    /**
     * Login facebook.
     * 
     * @return response
     **/
    public function loginFb()
    {
        include APPPATH.'libraries/facebook-skd/fblogin.php';
    }
    /**
     * Confirm login facebook.
     * 
     * @return redirect
     **/
    public function loginFbPost()
    {
        $fbid = $_SESSION['FB_ID'];
        if (isset($fbid)) {
            $data_user = $this->db->where('id_facebook', $fbid)->get('users')->row_array();
            if (isset($data_user)) {
                $this->checkAccountLogin($data_user);
            } else {
                redirect('account/register/fb/st1');
            }
        }
    }
    /**
     * Register google.
     * 
     * @return redirect
     **/
    public function registerWithGoogle()
    {
        include APPPATH.'libraries/Google/autoload.php';
        $config_google = $this->config->item('googleplus');
        //Insert your cient ID and secret 
        //You can get it from : https://console.developers.google.com/
        $client_id = $config_google['client_id'];
        $client_secret = $config_google['client_secret'];
        $redirect_uri = base_url().'account/register/gg';
        /************************************************
        Make an API request on behalf of a user. In
        this case we need to have a valid OAuth 2.0
        token for the user, so we need to send them
        through a login flow. To do this we need some
        information from our API console project.
        ************************************************/
        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope('email');
        $client->addScope('profile');
        $service = new Google_Service_Oauth2($client);
        if (isset($_GET['code'])) {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            header('Location: '.filter_var($redirect_uri, FILTER_SANITIZE_URL));
            exit;
        }
        /************************************************
        If we have an access token, we can make
        requests, else we generate an authentication URL.
        ************************************************/
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
            $user = $service->userinfo->get();
            $_SESSION['GG']['ID'] = $user->id;
            $_SESSION['GG']['FIRSTNAME'] = $user->familyName;
            $_SESSION['GG']['LASTSNAME'] = $user->givenName;
            $_SESSION['GG']['EMAIL'] = $user->email;
            $_SESSION['GG']['GENDER'] = $user->gender;
            $_SESSION['GG']['AVATA'] = $user->picture;
            if ($this->registerGgCheck($user->email)) {
                $this->registerGgSt1();
            } else {
                $this->session->set_flashdata('message_error', 'Can not register. existing Email Registered!');
                redirect('account/signup');
            }
        }
    }
    /**
     * View Register affilaite.
     * 
     * @return redirect
     **/
    public function registerAffliate()
    {
        $parent_affiliate = $this->input->post('affiliateId');
       if( $this->session->userdata('loged_in')){ 
           redirect('amper/become_affiliate/'.$parent_affiliate);
       } else {
       
        if (isset($parent_affiliate)) {
            $data['parent_affiliate'] = $this->db->select('u.firstname,u.lastname,a.affiliate_id')->where('affiliate_id', $parent_affiliate)->join('users u', 'a.user_id = u.id')->get('affiliates a')->row();
            if (!empty($data['parent_affiliate'])) {
                $this->load->view('includes/header');
                //$this->load->view('includes/navbar');
                $this->load->view('auth/register_affliate', $data);
                $this->load->view('includes/footer');
            } else {
                echo 'Error!!! do not have data affiliate parent';
                die;
            }
        } else {
            echo 'Error!!! do not have data affiliate parent';
        }
    }
    }
    /**
     * Confirm Affiliate login.
     * 
     * @return redirect
     **/
    public function loginAffiliate()
    {
        $this->session->unset_userdata('loged_in');
        $this->session->unset_userdata('user_data');
        $this->session->unset_userdata('U_map');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'trim|valid_email|required|max_length[255]');
        $this->form_validation->set_rules('password', 'password', 'trim|required|max_length[64]');
        $this->form_validation->set_rules('affiliateId', 'affiliateId ', 'required');
        $post_aff = $this->input->post('affiliateId');
        if ($this->form_validation->run() != false) {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $signin_result = $this->m_user->signin_check($email, $password);
            if (!empty($signin_result)) {
                if ($signin_result['lock'] == 1) {
                    $this->session->set_flashdata('message_error', 'Account has been blocked, you can conntact support');
                    $this->registerAffliate();
                    die;
                } else {
                    $this->session->set_userdata('loged_in', $signin_result['id']);
                    $this->session->set_userdata('is_admin', $signin_result['is_admin']);
                    $user_data = $this->db->where('id='.$signin_result['id'])->get('users')->row_array();
                    $this->session->set_userdata('user_data', $user_data);
                    $data_Umap = $this->db->where('user_id', $signin_result['id'])->get('affiliates')->row_array();
                    $this->session->set_userdata('U_map', $data_Umap);
                    redirect('amper/become_affiliate/'.$post_aff);
                }
            } else {
                $this->session->set_flashdata('message_error', 'Wrong email or Password');
                $this->registerAffliate();
            }
        } else {
            $this->registerAffliate();
        }
    }
    /**
     * Confirm register affilaite.
     * 
     * @return redirect
     **/
    public function postRegisterAffliate()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('city', 'city', 'required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[users.email]|max_length[255]|valid_email');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required|matches[cpass]|max_length[64]');
        $this->form_validation->set_rules('cpass', 'Confirm password', 'trim|required|max_length[64]');
        $this->form_validation->set_rules('affiliateId', 'affiliateId ', 'required');
        $post_aff = $this->input->post('affiliateId');
        $playlist = $this->input->post('playlits');
        if ($this->form_validation->run() != false) {
            $home_page = $this->m_user->create_homepage(str_replace(' ', '', $this->input->post('lastname')));
            $password_tmp = $this->input->post('pass');
            $data_password = $this->_createNewPassword($password_tmp);
            $insertArr = array(
                'password' => $data_password['password'],
                'hash' => $data_password['hash'],
                'email' => $this->input->post('email'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'city' => $this->input->post('city'),
                'role' => 2,
                'active' => '1',
                'home_page' => $home_page,
                'template_landing' => 1,
                'creatdate' => time(),
            );
            $this->db->insert('users', $insertArr);
            $id = $this->db->insert_id();
            //create new custome zoho api
            $this->M_zoho->create_customer($id);
            $ID_UNIWUE = random_string('unique');
            $insertArr = array(
                'affiliate_id' => $ID_UNIWUE,
                'paypal' => $this->input->post('paypal'),
                'active' => 1,
                'date_create' => time(),
                'user_id' => $id,
            );
            $this->db->insert('affiliates', $insertArr);
            $this->session->set_userdata('loged_in', $id);
            $user_data = $this->db->where('id='.$id)->get('users')->row_array();
            $this->session->set_userdata('user_data', $user_data);
            $data_Umap = $this->db->where('user_id', $id)->get('affiliates')->row_array();
            $this->session->set_userdata('U_map', $data_Umap);
            redirect('fap/register-affiliate?affiliateId='.$post_aff);
        } else {
            $this->registerAffliate();
        }
    }
    /**
     * View Register google step 1.
     * 
     * @return reponse
     **/
    public function registerGgSt1()
    {
        $this->load->view('includes/header');
        $this->load->view('includes/navbar');
        $this->load->view('auth/choosestype_gg');
        $this->load->view('includes/footer');
    }
    /**
     * View Register google step 2.
     * 
     * @return response
     **/
    public function registerGgSt2()
    {
        $role = $this->input->post('role');
        $data['landings'] = $this->db->where('type', 'landing')->where('active', 1)->order_by('position', 'ASC')->get('template_lands')->result_array();
        if (isset($role)) {
            $data['tmp_role'] = $_SESSION['tmp_role'] = $role;
        } else {
            $data['tmp_role'] = $_SESSION['tmp_role'];
        }
        $data['genres'] = $this->db->get('genres')->result_array();
        $this->load->view('includes/header');
        $this->load->view('includes/navbar');
        if ($data['tmp_role'] == 1) {
            $this->load->view('auth/details/artist_gg', $data);
        } elseif ($data['tmp_role'] == 2) {
            $this->load->view('auth/details/fan_gg', $data);
        }
        $this->load->view('includes/footer');
    }
    /**
     * Confirm  Register google.
     * 
     * @return redirect
     **/
    public function registerGgSt3()
    {
        $ggid = $_SESSION['GG']['ID'];
        $ggfirstname = $_SESSION['GG']['FIRSTNAME'];
        $gglastname = $_SESSION['GG']['LASTSNAME'];
        $ggemail = $_SESSION['GG']['EMAIL'];
        $gggender = $_SESSION['GG']['GENDER'];
        $ggavatar = $_SESSION['GG']['AVATA'];
        if ($this->registerGgCheck($ggemail)) {
            $role = $this->session->userdata('tmp_role');
            $password_tmp = $this->input->post('pass');
            $data_password = $this->_createNewPassword($password_tmp);
            switch ($role) {
            case 1:
                $this->load->library('form_validation');
                $this->form_validation->set_rules('city', 'city', 'required|max_length[128]');
                $this->form_validation->set_rules('genre', 'genre', 'required');
                $this->form_validation->set_rules('template_landing', 'template_landing', 'required');
                $this->form_validation->set_rules('pass', 'Password', 'trim|required|matches[cpass]|max_length[64]');
                $this->form_validation->set_rules('cpass', 'Confirm password', 'trim|required');
                if ($this->form_validation->run() != false) {
                    $home_page = $this->m_user->create_homepage(str_replace(' ', '', $gglastname));
                    if (check_live_server()) {
                        $plan_status = 0;
                    } else {
                        $plan_status = 1;
                    }
                    $insertArr = array(
                        'password' => $data_password['password'],
                        'hash' => $data_password['hash'],
                        'email' => $ggemail,
                        'artist_name' => $gglastname,
                        'countries' => 217,
                        'city' => $this->input->post('city'),
                        'firstname' => $ggfirstname,
                        'lastname' => $gglastname,
                        'role' => $role,
                        'home_page' => $home_page,
                        'active' => '1',
                        'plan_status' => $plan_status,
                        'template_landing' => $this->input->post('template_landing'),
                        'id_google' => $ggid,
                        'avata' => 'avatar.jpg',
                        'creatdate' => time(),
                    );
                    $this->db->insert('users', $insertArr);
                    $id = $this->db->insert_id();
                    //create new custome zoho api
                    $this->M_zoho->create_customer($id);
                    //Get the file
                    $config['upload_path'] = './uploads/'.$id.'/photo/';
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, true);
                    } else {
                        chmod($config['upload_path'], 0777);
                    }
                    $content = file_get_contents($ggavatar);
                    //Store in the filesystem.
                    $save_path = './uploads/'.$id.'/photo/avatar.jpg';
                    file_put_contents($save_path, $content);
                    $this->session->set_userdata('loged_in', $id);
                    $user_data = $this->db->where('id='.$id)->get('users')->row_array();
                    $this->session->set_userdata('user_data', $user_data);
                    // insert data amper
                    $this->M_audio_song->create_shortcode_AMP($id);
                    $data_Umap = $this->db->where('user_id', $id)->get('affiliates')->row_array();
                    $this->session->set_userdata('U_map', $data_Umap);
                    if (check_live_server()) {
                        redirect('subscriptions/checkout/Artist_basic');
                    } else {
                        redirect('artist/profile');
                    }
                } else {
                    $this->registerGgSt2();
                }
                break;
            case 2:
                $this->load->library('form_validation');
                $this->form_validation->set_rules('city', 'city', 'required|max_length[128]');
                $this->form_validation->set_rules('pass', 'Password', 'trim|required|matches[cpass]|max_length[64]');
                $this->form_validation->set_rules('cpass', 'Confirm password', 'trim|required|max_length[64]');
                if ($this->form_validation->run() != false) {
                    $insertArr = array(
                        'password' => $data_password['password'],
                        'hash' => $data_password['hash'],
                        'email' => $ggemail,
                        'fan_name' => $gglastname,
                        'countries' => 217,
                        'city' => $this->input->post('city'),
                        'role' => $role,
                        'active' => '1',
                        'id_google' => $ggid,
                        'avata' => 'avatar.jpg',
                        'creatdate' => time(),
                    );
                    $this->db->insert('users', $insertArr);
                    $id = $this->db->insert_id();
                    //create new custome zoho api
                    $this->M_zoho->create_customer($id);
                    //Get the file
                    $config['upload_path'] = './uploads/'.$id.'/photo/';
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, true);
                    } else {
                        chmod($config['upload_path'], 0777);
                    }
                    $content = file_get_contents($ggavatar);
                    //Store in the filesystem.
                    $save_path = './uploads/'.$id.'/photo/avatar.jpg';
                    file_put_contents($save_path, $content);
                    // insert data amper
                    $insertArr = array(
                        'affiliate_id' => random_string('unique'),
                        'paypal' => $ggemail,
                        'active' => 1,
                        'date_create' => time(),
                        'user_id' => $id,
                    );
                    $this->db->insert('affiliates', $insertArr);
                    $this->session->set_userdata('loged_in', $id);
                    $user_data = $this->db->where('id='.$id)->get('users')->row_array();
                    $this->session->set_userdata('user_data', $user_data);
                    $data_Umap = $this->db->where('user_id', $id)->get('affiliates')->row_array();
                    $this->session->set_userdata('U_map', $data_Umap);
                    redirect('');
                } else {
                    $this->session->set_flashdata('message_error', validation_errors());
                    $this->registerGgSt2();
                }
                break;
            }
        } else {
            $this->session->set_flashdata('message_error', 'can not register. Account Email existing!');
            redirect('account/signup');
        }
    }
    /**
     * Check Register google.
     * 
     * @param int $email email
     *
     * @return bool
     **/
    public function registerGgCheck($email)
    {
        $data = $this->db->where('email', $email)->get('users')->row_array();
        if (!empty($data)) {
            return false;
        } else {
            return true;
        }
    }
    /**
     * Confirm Login google.
     * 
     * @return redirect
     **/
    public function loginGgPost()
    {
        include APPPATH.'libraries/Google/autoload.php';
        $config_google = $this->config->item('googleplus');
        //Insert your cient ID and secret 
        //You can get it from : https://console.developers.google.com/
        $client_id = $config_google['client_id'];
        $client_secret = $config_google['client_secret'];
        $redirect_uri = base_url().'account/login/gg';
        /************************************************
        Make an API request on behalf of a user. In
        this case we need to have a valid OAuth 2.0
        token for the user, so we need to send them
        through a login flow. To do this we need some
        information from our API console project.
        ************************************************/
        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope('email');
        $client->addScope('profile');
        $service = new Google_Service_Oauth2($client);

        if (isset($_GET['code'])) {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            header('Location: '.filter_var($redirect_uri, FILTER_SANITIZE_URL));
            exit;
        }
        /************************************************
        If we have an access token, we can make
        requests, else we generate an authentication URL.
        ************************************************/
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
            $user = $service->userinfo->get();
            $_SESSION['GG']['ID'] = $user->id;
            $_SESSION['GG']['FIRSTNAME'] = $user->familyName;
            $_SESSION['GG']['LASTSNAME'] = $user->givenName;
            $_SESSION['GG']['EMAIL'] = $user->email;
            $_SESSION['GG']['GENDER'] = $user->gender;
            $_SESSION['GG']['AVATA'] = $user->picture;
            $data_user = $this->db->where('email', $user->email)->get('users')->row_array();
            if (isset($data_user)) {
                $this->checkAccountLogin($data_user);
            } else {
                redirect('account/register/gg/st1');
            }
        }
    }
    
    public function amp_form()
    {
        $data['user_data'] = $this->session->userdata('user_data');
   
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('footer/amp_form', $data);
        $this->load->view('includes/footer', $data);
    }
    
    public function amp_form_send(){
       
        $this->load->library('form_validation');
        $this->form_validation->set_rules('parent_name', 'parent_name', 'required');
                $this->form_validation->set_rules('parent_address', 'parent_address', 'required');
                $this->form_validation->set_rules('parent_phone_no', 'parent_phone_no', 'required');
              $this->form_validation->set_rules('dob', 'dob', 'required');
               $this->form_validation->set_rules('place_birth', 'place_birth', 'required');
                $this->form_validation->set_rules('name', 'name', 'required');
                 $this->form_validation->set_rules('sign', 'sign', 'required');
                  if ($this->form_validation->run() != false) {
                      $birthdate=$this->input->post('dob');
                      $newBirthDate = date("Y-m-d", strtotime($birthdate));
         $insertArr = array(
                        'name_parent' => $this->input->post('parent_name'),
                        'address_parent' => $this->input->post('parent_address'),
                        'telephone_parent' => $this->input->post('parent_phone_no'),
                        'dob' => strtotime($newBirthDate),
                        'place_of_birth' => $this->input->post('place_birth'),
                       'user_id'=>$this->input->post('user_id')
                        
                    );
         if( $this->db->insert('parental_forms', $insertArr)) {
             redirect('subscriptions/checkout/Artist_basic');
         }
         else {
              redirect('account/signup');
         }
                  }
    }
    //Function to verification mail
    public function verification($token){
       
        $userDetails = $this->db->where('token', $token)->where('active', 2)->get('users')->row_array();
        if($userDetails){
            $this->M_user->update_user_id($userDetails['id'], $userDetails['email']);
            $updateStatus = array('active' => 1);
            $this->db->where('id', $userDetails['id']); 
            $this->db->update('users', $updateStatus);
            $data['tmp_email'] = $userDetails['email'];
            $this->signup($data, $step = 1);
        }else{
            $this->session->set_flashdata('message_error', 'Invalid link please signup again');
            redirect('/account/signup', 'refresh');
        }
       
    }

    //Function to send mail
    public function sendVerificationMail($email, $token){
        $data['email'] = $email;

        $data['encrypted_string'] = $token;
        $data['subject_main'] = 'Congratulation and welcome to Big music, where both Artists & Fans EARN MONEY by selling Your Music!';
        $data['subject_thank'] = 'Thanks for Joining. Please Take a Moment to Confirm Your Email Address and User login: '.$email;
        
        $message = $this->load->view('email/account_confirmation_mail', $data, true);
        
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['newline'] = "\r\n";
        //send email
        $this->email->initialize($config);
        $this->email->clear();
        $this->email->from('oscarsalu@gmail.com', 'Sound');
        $this->email->to($email);
        $this->email->subject('Verify your e-mail address for your account.');
        $this->email->message($message);
        $this->email->send();
    }

    //function for resend verification mail
    public function resendVerificationMail(){
        $email = $this->input->post('email');
        $userDetails = $this->db->where('email', $email)->where('active', 2)->get('users')->row_array();
        if($userDetails) {
                    $token = $userDetails['token'];
                    $this->sendVerificationMail($email, $token);
       }else{
            $this->session->set_flashdata('message_error', 'Invalid link please signup again');
            redirect('/account/signup', 'refresh');
        }
        $this->session->set_flashdata('message_msg', 'Please check your email and verify for further, thank you!');
       echo 'success';
    }

    
}
