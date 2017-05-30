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
 * Myerror.
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
class Myerror extends CI_Controller
{
    /**
     * Myerror construct.
     **/
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Myerror error_404.
     **/
    public function error_404()
    {
        $this->output->set_status_header('404');
        $data['heading'] = '404 Page Not Found';
        $data['message'] = 'The page you requested was not found.'; // View name 
        $this->load->view('errors/html/error_404', $data);//loading in my template 
    }
}
