<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Text extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_text');
    }
    /**
     * Update text admin change.
     */
    public function update()
    {
        $html_text = $this->input->post('html_text');
        $value = $this->input->post('id');
        //$html = json_encode($html_text,JSON_UNESCAPED_UNICODE);
        //header('Content-Type: text/html; charset=utf-8');     
        //header('Content-Type: application/json');

        $result = $this->M_text->check_value($value);

        if (!empty($result)) {
            $updataArr = array(
                'html_text' => $html_text,
            );

            $query=$this->db->update('text', $updataArr, array('type' => $value));
        } else {
            $insertArr = array(
                'html_text' => $html_text,
                'type' => $value,
            );

          $query=  $this->db->insert('text', $insertArr);
        }
        if($query){
        echo json_encode('Text Saved!!');
        } else {
             echo json_encode('Error!!');
        }

    die;
    }
}
?>
    