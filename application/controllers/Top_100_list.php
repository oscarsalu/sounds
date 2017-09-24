<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Top_100_list extends CI_Controller
{
    public function __contruct()
    {
        parent::__construct();
        $this->load->model('features/M_features_fan');
        $this->load->model('features/M_text');
    }
    public function index()
    {
        $data['fans'] = $this->db->select('*,u.id,a.filename as filesong,g.name as genre_name, p.filename as filephoto')
            ->from('users as u')
            ->where('u.role', 1)
            ->where('u.is_admin != ', 1)
            ->join('photos as p', 'u.id = p.user_id', 'left')
            ->join('audio_song as a', 'u.id = a.user_id', 'left')
            ->join('genres as g', 'u.genre = g.id')
            ->join('countries as c', 'u.countries = c.id')
            ->group_by('u.id')
            ->order_by('u.id', 'DESC')
            ->limit(12, 0)
            ->get()->result_array();
        $list_users = $this->db->select('user_id')
            ->where('time >=', strtotime('monday this week'))
            ->where('time <', strtotime('next monday'))
            ->where('type', 'amp')
            ->where('level_sale!=', null)
            ->get('transactions')->result();
        $users_array = array();
        $count = 1;
        foreach ($list_users as $user) {
            if ($count < 100) {
                if (!in_array($user->user_id, $users_array)) {
                    $users_array[] = $user->user_id;
                    ++$count;
                }
            } else {
                break;
            }
        }
        $data['top_list_100'] = $this->db->where_in('id', $users_array)->get('users')->result();
        $this->load->view('includes/header', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('top_100_list', $data);
        $this->load->view('includes/footer', $data);
    }
}
