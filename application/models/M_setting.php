<?php

class M_setting extends CI_Model
{
    public function __construct()
    {

        // Call the Model constructor

        parent::__construct();
    }
    /**
     * Get Key jwplayer.
     *
     * @param string $key
     **/
    public function get_jwplayer_key()
    {
        return 'E+EPCnVkbJgTbiGNqL8VgOonMFfhcJieOvmuaQ==';
    }
    /**
     * Get Commissions 99sound.
     *
     * @return float
     **/
    public function get_commissions_99sound()
    {
        return $this->db->get('settings_global')->row()->commissions_99sound;
    }
    /**
     * Get Setting 99sound.
     *
     * @param string $value
     *
     * @return object $settings_global
     **/
    public function get_setting_99sound($value = 'id')
    {
        return $this->db->get('settings_global')->row()->$value;
    }
}
