<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Amp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    
    /**
     * View AMP.
     **/
    public function amp_embed($id_affiliate)
    {
        $data['id_affiliate'] = $id_affiliate;
        $this->load->view('artist/amp/AMP_embed.php', $data);
    }
    public function song_embed($id_affiliate,$songId)
    {
        $data['id_affiliate'] = $id_affiliate;
        $data['song_id'] = $songId;
        $this->load->view('artist/amp/song_embed.php', $data);
    }
}
