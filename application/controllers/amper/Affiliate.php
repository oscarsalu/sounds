<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Affiliate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->model('M_user');
        $this->load->model('M_audio_song');
        $this->load->model('M_affiliate');
        $this->load->model('M_transaction');
        $this->load->helper('string');
        $ac = $this->session->userdata('access');
         $data['redirect_url']=$this->curPageURL();
        if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }
        $this->U_map = $this->session->userdata('U_map');
        $this->is_login();
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
    public $U_map;
    public function is_login()
    {
        $U_map = $this->U_map;
        $uers_data = $this->session->userdata('user_data');

        if (!$this->input->is_ajax_request()) {
            if (!isset($U_map)) {
                $this->session->set_flashdata('message_error', '<b>Error</b>! You Not Login Account');
                redirect('account/login');
                die;
            } elseif ($uers_data['role'] != 1) {
                redirect('');
                die;
            } elseif ($uers_data['role'] == 1 && $uers_data['plan_status'] != 1) {
                $this->session->set_flashdata('message_error', 'You can subcription Plan Artist');
                redirect('');
                die;
            }
        } else {
            if (!isset($U_map)) {
                header('HTTP/1.1 401 	Unauthorized');
                die;
            } elseif ($uers_data['role'] != 1 || ($uers_data['role'] == 1 && $uers_data['plan_status'] == 0)) {
                header('HTTP/1.1 401 	Unauthorized');
                die;
            }
        }
    }
    /**
     * View affiliates amper.
     **/
    public function dashboard_affiliates()
    {
        $id = $this->session->userdata('loged_in');
        $data['U_map'] = $this->db->where('id', $this->U_map['id'])->get('affiliates')->row_array();
        $data['user_data'] = $this->db->get_where('users', array('id' => $id))->row_array();
        $data['commission_affiliate'] = $this->db->where('id_artist', $id)->get('commission_affiliate')->row_array();
        $data['limit_affiliates'] = $this->db->where('user_id', $id)->get('limit_affiliates')->row_array();
        $settings_global = $this->db->get('settings_global')->row_array();
        $data['commissions_99sound'] = $settings_global['commissions_99sound'];
        $data['list_level_1'] = $this->M_affiliate->get_list_level(1, $id, 12, 0);
        $data['list_level_2'] = $this->M_affiliate->get_list_level(2, $id, 12, 0);
        $data['list_level_3'] = $this->M_affiliate->get_list_level(3, $id, 12, 0);
        $data['list_level_4'] = $this->M_affiliate->get_list_level(4, $id, 12, 0);
        $data['list_new'] = $this->M_affiliate->new_affiliates($id, 12, 0);
        $data['link_content'] = 'affiliates.php';
        if ($this->input->is_ajax_request()) {
            // check if request comes from an ajax
            $this->load->view('amper/settingwitdget', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('includes/navbar', $data);
            $this->load->view('amper/dashboard_amper.php', $data);
            $this->load->view('includes/footer', $data);
        }
    }
    /**
     * artist update commision.
     **/
    public function update_commission()
    {
        $id = $this->session->userdata('loged_in');
        $U_map = $this->U_map;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('aff1', 'Affiliate 1', 'required|numeric');
        $this->form_validation->set_rules('aff2', 'Affiliate 2', 'required|numeric');
        $this->form_validation->set_rules('aff4', 'Affiliate 4', 'required|numeric');
        $this->form_validation->set_rules('aff3', 'Affiliate 3', 'required|numeric');
        if ($this->form_validation->run() != false) {
            $commission1 = $this->input->post('aff1');
            $commission2 = $this->input->post('aff2');
            $commission3 = $this->input->post('aff3');
            $commission4 = $this->input->post('aff4');
            $ArrUpdate = array(
                'commission_1' => $commission1,
                'commission_2' => $commission2,
                'commission_3' => $commission3,
                'commission_4' => $commission4,
                'id_artist' => $id,
                'id_affiliate' => $U_map['affiliate_id'],
            );
            $commission_affiliate = $this->db->where('id_artist', $id)->get('commission_affiliate')->row_array();
            if (!empty($commission_affiliate)) {
                $this->db->update('commission_affiliate', $ArrUpdate, 'id_artist='.$id);
                $this->session->set_flashdata('message_msg', '<b>Success</b>! Updated  Commission Affiliates');
            } else {
                $this->db->insert('commission_affiliate', $ArrUpdate);
                $this->session->set_flashdata('message_msg', '<b>Success</b>! Set  Commission Affiliates');
            }
            redirect('amper/dashboard_affiliates');
        } else {
            $this->dashboard_affiliates();
        }
    }
    /**
     * limit affilaite register.
     **/
    public function update_limit_afiliates()
    {
        $id = $this->session->userdata('loged_in');
        $U_map = $this->U_map;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('limit_aff1', 'Limit Affiliate 1', 'required|numeric');
        $this->form_validation->set_rules('limit_aff2', 'Limit Affiliate 2', 'required|numeric');
        $this->form_validation->set_rules('limit_aff4', 'Limit Affiliate 4', 'required|numeric');
        $this->form_validation->set_rules('limit_aff3', 'Limit Affiliate 3', 'required|numeric');
        if ($this->form_validation->run() != false) {
            $level1 = $this->input->post('limit_aff1');
            $level2 = $this->input->post('limit_aff2');
            $level3 = $this->input->post('limit_aff3');
            $level4 = $this->input->post('limit_aff4');
            $ArrUpdate = array(
                'level_1' => $level1,
                'level_2' => $level2,
                'level_3' => $level3,
                'level_4' => $level4,
                'user_id' => $id,
            );
            $limit_affiliate = $this->db->where('user_id', $id)->get('limit_affiliates')->row_array();
            if (!empty($limit_affiliate)) {
                $this->db->update('limit_affiliates', $ArrUpdate, 'user_id='.$id);
                $this->session->set_flashdata('message_msg', '<b>Success</b>! Updated  limit Affiliates');
            } else {
                $this->db->insert('limit_affiliates', $ArrUpdate);
                $this->session->set_flashdata('message_msg', '<b>Success</b>! Set  limit Affiliates');
            }
            redirect('amper/dashboard_affiliates');
        } else {
            $this->dashboard_affiliates();
        }
    }
    /**
     * Allow affilaite register.
     **/
    public function allow_afiliate($Id_Level)
    {
        $id = $this->session->userdata('loged_in');
        $data['U_map'] = $this->db->where('parent_affiliate', $id)->get('affiliates')->row_array();
        $dataLevel = $this->db->where('id', $Id_Level)->get('affiliate_level')->row();
        if ($dataLevel->artist_id == $id) {
            $this->db->update('affiliate_level', array('status' => 1), 'id ='.$Id_Level);
            // add new notications 
            $id_sub_affilaite = $this->M_affiliate->get_id_user($dataLevel->affiliate_id);
            $check_notifi = $this->M_user->check_onoff_request($id_sub_affilaite);
            if ($check_notifi) {
                $this->M_notify->addnotify($id_sub_affilaite, 'You became afiliate by artist '.$this->M_user->get_name($id), 'amper_allow');
            }
            $this->session->set_flashdata('message_msg', '<b>Success</b>! allowed affiliate');
        } else {
            $this->session->set_flashdata('message_error', '<b>Error</b>! Can not allow affiliate');
        }
        redirect('amper/dashboard_affiliates');
    }
    /**
     * delete affilaite register.
     **/
    public function delete_afiliate($Id_Level)
    {
        $id = $this->session->userdata('loged_in');
        $data['U_map'] = $this->db->where('parent_affiliate', $id)->get('affiliates')->row_array();
        $dataLevel = $this->db->where('id', $Id_Level)->get('affiliate_level')->row();
        if ($dataLevel->artist_id == $id) {
            // add new notications 
            $id_sub_affilaite = $this->M_affiliate->get_id_user($dataLevel->affiliate_id);
            $check_notifi = $this->M_user->check_onoff_request($id_sub_affilaite);
            if ($check_notifi) {
                $this->M_notify->addnotify($id_sub_affilaite, $this->M_user->get_name($id).' not allow you become affilaite', 'amper_not_allow');
            }
            $this->db->where('id', $Id_Level)->delete('affiliate_level');
            $this->db
                ->where('affiliate_id', $dataLevel->affiliate_id)
                ->where('parrent_id', $this->U_map['affiliate_id'])
                ->delete('conect_affiliates');
            $this->session->set_flashdata('message_msg', '<b>Success</b>! delete affiliate');
        } else {
            $this->session->set_flashdata('message_error', '<b>Error</b>! Can not delete affiliate');
        }
        redirect('amper/dashboard_affiliates');
    }
    /**
     * Ajax Load list level.
     **/
    public function load_list_level()
    {
        $id_level = $this->input->post('level');
        $page = $this->input->post('page');
        $user_id = $this->U_map['user_id'];
        $data = $this->M_affiliate->get_list_level($id_level, $user_id, 12, 0);
        $res = array();
        foreach ($data as $row) {
            if ($row->Status == 2) {
                $button = ' <a href="'.base_url('amper/affiliates/unlock/'.$row->ID_level).'" class="btn btn-danger btn-xs" title="Unlock Affiliate">Unlock</a>';
            } elseif ($row->Status == 1) {
                $button = ' <a href="'.base_url('amper/affiliates/lock/'.$row->ID_level).'"  class="btn btn-primary btn-xs" title="Lock Affiliate"> Lock</a>';
            } else {
                $button = '';
            }
            $res[] =
            '<li>'.
                '<a target="_blank" href="'.$this->M_user->get_url_alp($row->id).'">'.$this->M_user->get_name($row->id).'</a>'.
                ' - '.$row->email.
                $button.
            '</li>';
        }
        echo json_encode($res);
    }
    /**
     * Ajax load new affiliate.
     **/
    public function load_new_affiliate()
    {
        $page = $this->input->post('page');
        $user_id = $this->U_map['user_id'];
        $data = $this->M_affiliate->new_affiliates($user_id, 12, $page);
        $res = array();
        foreach ($data as $row) {
            $res[] =
            '<li>'.
                '<a target="_blank" href="'.$this->M_user->get_url_alp($row->id).'">'.$this->M_user->get_name($row->id).'</a>'.
                ' - '.$row->email.' - Level'.$row->LEVEL.
                '<a href="'.base_url('amper/affiliates/allow_afiliate/'.$row->ID_level).'" class="btn btn-success btn-xs" title="Allow Affiliate"> Allow</a>'.
                '<a href="'.base_url('amper/affiliates/delete_afiliate/'.$row->ID_level).'" class="btn btn-danger btn-xs" title="Delete Affiliate"> Delete</a>'.
            '</li>';
        }
        echo json_encode($res);
    }
    /**
     * Lock sub affilaite.
     **/
    public function lock($Id_Level)
    {
        $id = $this->session->userdata('loged_in');
        $data['U_map'] = $this->U_map;
        $dataLevel = $this->db->where('id', $Id_Level)->get('affiliate_level')->row();
        if ($dataLevel->artist_id == $id) {
            //add new noticaion
            $id_sub_affilaite = $this->M_affiliate->get_id_user($dataLevel->affiliate_id);
            $check_notifi = $this->M_user->check_onoff_request($id_sub_affilaite);
            if ($check_notifi) {
                $this->M_notify->addnotify($id_sub_affilaite, $this->M_user->get_name($id).' locked affiliate', 'amper_locked');
            }
            $this->db->update('affiliate_level', array('status' => 2), 'id ='.$Id_Level);
            $this->session->set_flashdata('message_msg', '<b>Success</b>! locked affiliate');
        } else {
            $this->session->set_flashdata('message_error', '<b>Error</b>! Can not lock affiliate');
        }
        redirect('amper/dashboard_affiliates');
    }
    /**
     * Unlock sub affilaite.
     **/
    public function unlock($Id_Level)
    {
        $id = $this->session->userdata('loged_in');
        $data['U_map'] = $this->U_map;
        $dataLevel = $this->db->where('id', $Id_Level)->get('affiliate_level')->row();
        if ($dataLevel->artist_id == $id) {
            //add new noticaion
            $id_sub_affilaite = $this->M_affiliate->get_id_user($dataLevel->affiliate_id);
            $check_notifi = $this->M_user->check_onoff_request($id_sub_affilaite);
            if ($check_notifi) {
                $this->M_notify->addnotify($id_sub_affilaite, $this->M_user->get_name($id).' unlocked affiliate', 'amper_unlocked');
            }
            $this->db->update('affiliate_level', array('status' => 1), 'id ='.$Id_Level);
            $this->session->set_flashdata('message_msg', '<b>Success</b>! unlocked affiliate');
        } else {
            $this->session->set_flashdata('message_error', '<b>Error</b>! Can not unlock affiliate');
        }
        redirect('amper/dashboard_affiliates');
    }
}
