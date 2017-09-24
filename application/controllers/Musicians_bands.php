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
class Musicians_Bands extends MX_Controller
{
    /**
     * Musicians_Bands::__construct().
     * 
     * @return
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->model('Musicians_model');
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
     * Musicians_Bands::index().
     */
    public function index()
    {
        $data['rows'] = $this->Musicians_model->getAllEvents();
        //var_dump($datass);exit;
        $data['user_data'] = $this->session->userdata('user_data');
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('musicians_bands', $data);
        $this->load->view('includes/footer', $data);
    }

    /**
     * Musicians_Bands::create().
     */
    public function create()
    {
        $profession = $this->input->post('profession');
        $genre = $this->input->post('genre');
        $year = $this->input->post('years_of_experiences');
        $instruments = $this->input->post('instruments');
        $availabilities = $this->input->post('availabilities');
        $location = $this->input->post('location');

        $insertArr = array(
            'profession' => $profession,
            'genre' => $genre,
            'years_of_experiences' => $year,
            'instruments' => $instruments,
            'availabilities' => $availabilities,
            'location' => $location,
            );

        $this->Musicians_model->insert('musicians_bands', $insertArr);

        redirect('musicians_bands');
    }

    /**
     * Musicians_Bands::edit().
     * 
     * @param mixed $id id
     */
    public function edit($id)
    {
        $data['rows'] = $this->Musicians_model->getItemWithWhere('musicians_bands', array('musicians_bands_id' => $id));
        $this->load->view('includes/header');
        $this->load->view('includes/navbar');
        $this->load->view('musicians_bands_edit', $data);
        $this->load->view('includes/footer');
    }

    /**
     * Musicians_Bands::update().
     * 
     * @param mixed $id id
     */
    public function update($id)
    {
        $profession = $this->input->post('profession');
        $genre = $this->input->post('genre');
        $year = $this->input->post('years_of_experiences');
        $instruments = $this->input->post('instruments');
        $availabilities = $this->input->post('availabilities');
        $location = $this->input->post('location');

        $updateArr = array(
            'profession' => $profession,
            'genre' => $genre,
            'years_of_experiences' => $year,
            'instruments' => $instruments,
            'availabilities' => $availabilities,
            'location' => $location,
            );

        $this->Musicians_model->updateWhere('musicians_bands', $updateArr, array('musicians_bands_id' => $id));
        redirect('musicians_bands');
    }

    /**
     * Musicians_Bands::delete().
     * 
     * @param mixed $id id
     */
    public function delete($id)
    {
        if (isset($id)) {
            $this->Musicians_model->deleteWhere($id);
            redirect('musicians_bands');
        }
    }
}
