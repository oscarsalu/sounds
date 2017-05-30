<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class m_pdf {
    public $CI;
    public function __construct()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
        if ($params == NULL)
        {
            $param = '"en-CA-x","A4","26","DejaVuSansCondensed",5,5,5,5,5,5,"L"';   
        }
         
      // return new mPDF($param);
        return new mPDF('c','A4','','',32,25,27,25,16,13);
    }
}