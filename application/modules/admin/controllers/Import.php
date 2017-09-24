<?php
  
   class Import extends CI_Controller {
	
      public function __construct() { 
         parent::__construct(); 
         $this->load->helper(array('form', 'url')); 
      }
	  /**
      * View locations
      **/	
      public function index() { 
         $this->load->view('locations', array('error' => ' ' )); 
      } 
	  /**
      * config uploads file
      **/ 	
      public function do_upload() { 
         $config['upload_path']   = './uploads/files_locations/'; 
         $config['allowed_types'] = 'xml|xls'; 
         $config['max_size']      = 10000;          
         $this->load->library('upload', $config);
			
         if ( ! $this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors()); 
            $this->load->view('locations', $error); 
         }
			
         else { 
            $data = array('locations' => $this->upload->data()); 
            $this->load->view('susse', $data); 
         } 
      } 
   } 
?>