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
 * Notices.
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
class Notices extends CI_Controller
{
    /**
     * Notices construct.
     **/
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Notices index.
     **/
    public function index()
    {

        $data['user_data'] = $this->session->userdata('user_data');
        $user_id = $this->session->userdata('loged_in');
        $config['base_url'] = base_url().'notifications/all';
        $config['per_page'] = 12;
        $start = $this->input->get('per_page');
        if (empty($start)) {
            $start = 1;
        }
        $config['total_rows'] = $this->M_notify->num_notices($user_id);
        $this->load->library('pagination', $config);
        $data['notifications'] = $this->M_notify->get_all_notifications($user_id, $config['per_page'], $start - 1);
        $data['register_affiliates'] = $this->M_notify->get_all_notifications_by_type($user_id, $config['per_page'], $start - 1,  'amper_register');
        $data['per_page'] = 12;
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('notices.php', $data);
        $this->load->view('includes/footer', $data);
    }
    //Funtion to delete notice
    public function remove()
    {
        $notice_id = $this->input->post('notification_id');
        $this->M_notify->remove_notifications($notice_id);   
        echo json_encode("success");
    }

    public function get_data_by_type($user_id, $type)
    {
        $config['per_page'] = 12;
        $config['base_url'] = base_url().'notifications/all';
        $start = $this->input->get('per_page');
        if (empty($start)) {
            $start = 1;
        }
        $config['total_rows'] = $this->M_notify->num_notices($user_id);
        
        $this->load->library('pagination', $config);
        $data =  $this->M_notify->get_all_notifications_by_type($user_id, $config['per_page'], $start - 1,  $type);
        $html = "";
        $html .= "<table class='table'><tr>
                                            <th>Sr No.</th>
                                            <th>Message</th>
                                            <th>Read</th>
                                            <th>Delete</th>
                                            <th>Time</th>
                                        </tr>";
         $i = 1;                               
        foreach ($data as $key => $row) {
            $check = '';
            if($row->is_read == '1')
            { 
                $check = 'checked';
            }
            $text ="$row->id, $user_id,'$row->type'";
           $html .= '<tr id="notification_'.$row->id.'">
                        <td>'.$i.'</td>
                        <td>'.$row->messages.'</td>
                        <td><input type="checkbox" name="read" id="'.$row->id.'" '.$check.' onclick="update_notification_read('.$text.');"/></td>
                        <td><a href="javascript:void(0);" onclick="delete_notification('.$text.')" ><i class="fa fa-trash-o"></i></a></td>
                        <td>'.date('H:i, d M Y', $row->time).' </td>
                    </tr>';
            $i++;
        }
        $html .= "</table>";
        $pagination =$this->pagination->create_links();
        
        if (count($data) > $config['per_page']) {
           $html .=  '<div class="text-center">'.$pagination.'</div>';
       }
        echo $html;
    }
    

    public function update_notification_status()
    {
        $post_id = $this->input->post('notification_id');
        $user_id = $this->input->post('user_id');
        if (isset($post_id) &&  isset($user_id)) {
           $data =  $this->M_notify->updadtereadnotify($user_id, $post_id);
        }
        echo json_encode($data);
    }

    public function get_notify_by_type()
    {
        $post_id = $this->input->post('notification_id');
        $user_id = $this->input->post('user_id');
        // $type = $this->input->post('type');
        $data =  $this->M_notify->get_notify_by_type($user_id, "0");
        $returnArray = array('data'=>$data, 'count'=>count($data));
        echo json_encode($returnArray);
    }
}
