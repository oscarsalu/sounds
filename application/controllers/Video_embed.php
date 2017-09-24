<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Video_embed extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * View Video enbeb.
     */
    public function index($id)
    {
        $data['video'] = $this->db->where('id', $id)->get('videos')->row_array();

        $this->load->view('video_embed', $data);
    }
}
