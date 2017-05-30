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
 * @copyright 2016 GallerySoft
 * @license   http://www.99SOUND.COM  PHP License 3.01
 *
 * @version   2016
 *
 * @link      http://pear.php.net/package/PackageName
 */
class Home extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * http://example.com/index.php/welcome
     * - or -
     * http://example.com/index.php/welcome/index
     * - or -
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
        $this->load->model('M_user');
        $this->load->model('M_home');
        $this->load->model('M_text');
        $this->load->model('M_audio_song');
        $this->load->model('M_local_featured');
       
    
    }
     /**
     * View Step Current Page Url.
     * 
     * @return Response
     */
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
     * View Step check_access.
     * 
     * @return Response
     */
     public function check_access()
    {
        $password = $this->input->post('pass');
        
        $array_password=$this->config->item('access_password');
       if (in_array($password, $array_password)) {
            $this->session->set_userdata('access', $password);
            echo json_encode("ok");
        } else {
            echo json_encode("fail");
        }
    } 
    /**
     * View Step access.
     * 
     * @return Response
     */
    public function access()
    {
          
        $this->load->view('access');
    } 
    
    
    public function combined_homepage_css(){
        // First of all send css header
header("Content-type: text/css");

// Array of css files
$css = array(
     FCPATH.'assets/css/navbar/color-theme.css',
       FCPATH.'assets/css/navbar/webslidemenu.css',
       FCPATH.'assets/css/navbar/demo.css',
       FCPATH.'assets/css/bootstrap.css' ,
       FCPATH.'assets/css/animate.min.css',
   
    FCPATH.'assets/css/mightyslider.css' ,
    FCPATH.'assets/js/ilightbox/css/ilightbox.css' ,
    FCPATH.'assets/css/bootstrap-social.css' ,
 
     FCPATH. 'assets/css/style.css' ,
     FCPATH. 'assets/css/reponsive.css', 
     FCPATH. 'assets/css/style4.css' ,
     FCPATH. 'assets/css/footer.css' ,
     FCPATH. 'assets/css/new_style.css' ,
     FCPATH. 'assets/css/new_style1.css' ,
     FCPATH. 'assets/css/profile_detail.css' ,
     FCPATH. 'assets/css/bootstrap-dialog.min.css',
  
  
    
); 

// Prevent a notice
$css_content = '';

// Loop the css Array
foreach ($css as $css_file) {
    // Load the content of the css file 
    $css_content .= file_get_contents($css_file);
}
    
// print the css content
echo $css_content;
}

        public function combined_homepage_js(){
        // First of all send  header
header("Content-type: text/javascript");
       
// Array of js files
$js = array(
    
     FCPATH.'assets/js/bootstrap.min.js',
       FCPATH.'assets/js/bootstrap-dialog.min.js',
     
       FCPATH.'assets/js/jquery.mobile.just-touch.js' ,
       FCPATH.'assets/js/tweenlite.js',
   
    FCPATH.'assets/js/mightyslider.min.js' ,
    FCPATH.'assets/js/backgroundVideo.js' ,
    FCPATH.'assets/js/chat/jquery.nicescroll.js' ,
 
     FCPATH. 'assets/js/detail_pages/main.js' ,
     FCPATH. 'assets/js/jquery.parallax-1.1.3.js', 
    
    
);

// Prevent a notice
$js_content = '';

// Loop the css Array
foreach ($js as $js_file) {
    // Load the content of the css file 
    $js_content .= file_get_contents($js_file);
}

// print the css content
echo $js_content;
}
   
   
    /**
     * View Step index.
     * 
     * @return Response
     */
    public function index()
    {
        /*$n="60";
        $this->output->cache($n);*/
        $ac = $this->session->userdata('access');
        
        $data['redirect_url']=$this->curPageURL();
       
        if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }
        
        
        $data['user_data'] = $this->session->userdata('user_data');

        $data['background'] = $this->M_home->get_background();
        $data['videos'] = $this->M_home->get_video_background();
        $data['artists'] = $this->M_home->random_artist(6);
        $data['artist1s'] = $this->M_home->random_artist(9);
        $data['fans'] = $this->M_home->random_fans(12);
        $data['vids'] = $this->M_home->list_videos(10);
        if ($this->getRealIpAddr() != '::1') {
            $this->load->library('geoplugin');
            $this->geoplugin->locate();
            $city = $this->geoplugin->city;
            $data['cityartist'] = $this->geoplugin->city;
            $data['country'] = $this->geoplugin->countryName;
            $data['local_artists'] = $this->M_local_featured->get_all_artist_city($city, 0);
        }
        $data['worldwide_artists'] = $this->M_home->worldwide_artists(12);
        $data['landings'] = $this->M_home->template_lands();
        $data['epks'] = $this->M_home->template_epk();
        
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('home', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View Step getRealIpAddr.
     * 
     * @return Response
     */
    public function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
        $this->index();
    }
    /**
     * View Step post_notify.
     * 
     * @return Response
     */
    public function post_notify()
    {
        $post_id = $this->input->post('user_id');
        if (isset($post_id)) {
            $this->load->model('M_notify');
            $this->M_notify->readnotify($post_id);
        }
    }
    /**
     * View Step coppy_right.
     * 
     * @return Response
     */
    public function coppy_right()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('footer/coppy_right', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View Step refun.
     * 
     * @return Response
     */
    public function refun()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('footer/refun', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View Step privacy_policy.
     * 
     * @return Response
     */
    public function privacy_policy()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('footer/privacy_policy', $data);
        $this->load->view('includes/footer', $data);
    }
     /**
     * View Step abuse_policy.
     * 
     * @return Response
     */
    public function abuse_policy()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('footer/abuse_policy', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View Step terms.
     * 
     * @return Response
     */
    public function terms()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('footer/terms', $data);
        $this->load->view('includes/footer', $data);
    }
    /**
     * View Step our_team.
     * 
     * @return Response
     */
    public function our_team()
    {
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('footer/our_team', $data);
        $this->load->view('includes/footer', $data);
    }
}
