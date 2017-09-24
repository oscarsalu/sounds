<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Locations extends CI_Controller {
       // var_dump($page);exit;
    function __construct() {
        parent::__construct();
        $this->is_login();
        $this->load->model('M_locations');
        //..............
         $this->load->helper(array('form', 'url'));    
    }  
    function is_login(){
        if($this->session->userdata('loged_in') == false && $this->session->userdata('is_admin') != 1){
            redirect('login');
		}
    }
    public function index()
    {
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] =  $this->session->userdata('user_data');		
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/locations').'/page/';
        $sub_search =$this->input->post('sub_search');
        if(isset($sub_search)&&!empty($sub_search)){
                 $search = $this->input->post('search');                 
                 $config['total_rows'] = $this->M_locations->sum_search($search);
        }else{
                $config['total_rows'] = $this->M_locations->record_count();
        }
        
        $config['per_page'] = 20; 
        $config['page_query_string'] = FALSE;
        $config["uri_segment"] = 4;
        $config['use_page_numbers'] = TRUE;        
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>'; 
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; 
        if($page > 0){
            $page = ($page - 1)  *  $config['per_page'] ;        
        }
 
        if(isset($sub_search)&&!empty($sub_search)){
               $search = $this->input->post('search');
               if($this->M_locations->search($search,$config['per_page'], $page)==false){
                     $this->session->set_flashdata('message_error1','Your search - '.$search.' - did not match any documents.');
                     redirect('admin/locations');
               }else{
                  $data["results"] = $this->M_locations->search($search,$config['per_page'], $page);
                  $this->session->set_flashdata('message_success','About : '.$this->M_locations->sum_search($search).' results');
               }
                
               // $this->session->set_flashdata('message_error1','oke');
                
            } else{
                $data["results"] = $this->M_locations->fetch_records($config['per_page'], $page);
            }     
        $data["links"] = $this->pagination->create_links();   
        
               
        $this->template->load('admin_template', 'locations', $data);    
       
    }        
   
    public function do_upload() {  
        $config['upload_path']   = realpath(APPPATH."../uploads/files_locations/"); 
        $config['allowed_types'] = 'xml|xls|xlsx|csv'; 
        $config['max_size']      = 1024*1000; 
        $this->load->library('upload', $config);			
        if ( ! $this->upload->do_upload('file')) {
            $data['error'] = $this->upload->display_errors();          
            $this->session->set_flashdata('message_error1', $this->upload->display_errors());
            redirect('admin/locations');
        }else {
            //show name link
            $data['upload_data'] = $this->upload->data();          
            $this->load->library('PHPExcel');
            $objPHPExcel = PHPExcel_IOFactory::load(APPPATH.'../uploads/files_locations/'.$data['upload_data']['file_name']);
            $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();           
            $header = array();
            $arr_datas =array(); 
            // read column :ABCD
            foreach ($cell_collection as $cell) {
                $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                if ($row == 1) {
                    $header[$row][$column] = $data_value;
                } else {
                    $arr_datas[$row][$column] = $data_value;
                
                }            
            }
            
            foreach($arr_datas as $arr_data){
               
                        $insert = array();
                        if(isset($arr_data['A']) && !empty($arr_data['A'])){
                            $insert['company'] = $this->replaces($arr_data['A']);
                        }
                        if(isset($arr_data['B']) && !empty($arr_data['B'])){
                            $insert['contact'] = $this->replaces($arr_data['B']);
                        }
                         if(isset($arr_data['C']) && !empty($arr_data['C'])){
                            $insert['type'] =    $this->replaces($arr_data['C']);
                        }
                        if(isset($arr_data['D']) && !empty($arr_data['D'])){
                            $insert['email'] =   $this->replaces($arr_data['D']);
                        }
                         if(isset($arr_data['E']) && !empty($arr_data['E'])){
                            $insert['street1'] = $this->replaces($arr_data['E']);
                        }
                        if(isset($arr_data['F']) && !empty($arr_data['F'])){
                            $insert['street2'] = $this->replaces($arr_data['F']);
                        }
                        if(isset($arr_data['G']) && !empty($arr_data['G'])){
                            $insert['city'] =   $this->replaces($arr_data['G']);
                        }
                         if(isset($arr_data['H']) && !empty($arr_data['H'])){
                            $insert['state'] = $this->replaces($arr_data['H']);
                        }
                         if(isset($arr_data['I']) && !empty($arr_data['I'])){
                            $insert['zip'] = $this->replaces($arr_data['I']);
                        }
                          if(isset($arr_data['J']) && !empty($arr_data['J'])){
                            $insert['country'] = $this->replaces($arr_data['J']);
                        }
                         if(isset($arr_data['K']) && !empty($arr_data['K'])){
                            $insert['phone'] = $this->replaces2($arr_data['K']);
                        }
                        if(isset($arr_data['L']) && !empty($arr_data['L'])){
                            $insert['fax'] = $this->replaces($arr_data['L']);
                        }
                        if(isset($arr_data['M']) && !empty($arr_data['M'])){
                            $insert['webSite'] = $this->replaces($arr_data['M']);
                        }
                        if(isset($arr_data['N']) && !empty($arr_data['N'])){
                            $insert['genre'] = $this->replaces($arr_data['N']);
                        }
                        if(isset($arr_data['O']) && !empty($arr_data['O'])){
                            $insert['resource'] = $this->replaces($arr_data['O']);
                        }
                        if(isset($arr_data['P']) && !empty($arr_data['P'])){
                            $insert['notes'] = $this->replaces($arr_data['P']);
                        }
                        $this->db->insert('db_locations',$insert);
               } //end  foreach
            $data['header'] = $header;
            $data['valuest'] = $arr_data;            
            $this->session->set_flashdata('message_success', 'Import ');         
            redirect('admin/locations');
        
        } 
   } 
   public function view_location($id){
        $user_id = $this->session->userdata('loged_in');
        $data['user_data'] =  $this->session->userdata('user_data');		
        $data['list_location'] = $this->db->select('*')
            ->from('db_locations')
            ->where('id_location',$id)                     
            ->get()->result_array();
        $this->template->load('admin_template', 'list_location', $data); 
    }
   
   public function delete_location(){   
        $id = $this->input->get_post('id');
        if(isset($id))
        {
            $this->db->where('id_location',$id)->delete('db_locations');
            $this->session->set_flashdata('message_success', 'delete locations');
        }else{
            $this->session->set_flashdata('message_error1', ' delete');   
        }redirect('admin/locations');   
    } 
  public function edit_location(){
        $id    =   $this->input->post('location_id');
        $updateArr	=array(		                                        
                'country'	     => $this->replaces($this->input->post('country')),
                'contact'	     => $this->replaces($this->input->post('contact')),
                'city'		     => $this->replaces($this->input->post('city')),
                'email'		     => $this->input->post('email'),
                'phone'		     => $this->replaces2($this->input->post('phone')),
                'company'		 => $this->replaces($this->input->post('company')),
		    );
         $this->db->where('id_location', $id);
         $this->db->update('db_locations',$updateArr);   
        
         $this->session->set_flashdata('message_success', 'Edit');    
         redirect('admin/locations');    
    }
   public function replaces($str){
             $char =array('?','%','$' , '!','>','<','"','/','#','&','*','|',')','(','}','{','[',']','-',';',','); 
             $str_chane = '';
             $str_replace = str_replace($char, $str_chane, $str);
             return $str_replace;
        
    }
     public function replaces2($str){
             $char =array('?','%','$' , '!','>','<','"','/','#','&','*','|',')','(','}','{','[',']',';',','); 
             $str_chane = '';
             $str_replace = str_replace($char, $str_chane, $str);
             return $str_replace;
        
    }
 
   public function add_location(){
   
        $updateArr	=array(		                                        
                'country'	     => $this->replaces($this->input->post('country')),
                'contact'	     => $this->replaces($this->input->post('contact')),
                'city'		     => $this->replaces($this->input->post('city')),
                'email'		     => $this->input->post('email'),
                'phone'		     => $this->replaces2($this->input->post('phone')),
                'company'		 => $this->replaces($this->input->post('company')),
		    );
       
         $this->db->insert('db_locations', $updateArr); 
         $this->session->set_flashdata('message_success', 'Edit');    
         redirect('admin/locations');    
    }
    public function creater_lat_lng(){
       $locations =  $this->db->select("id_location,street1,city,country,state,company,email,phone,lat,lng")
           ->where('lat', "")
           ->where('lng',"")
           ->where('street1 !=',"")
           ->where('city !=',"")
           ->where('country !=',"")
           ->where('state !=',"")            
           ->limit(100)
           ->get('db_locations')->result_array(); 
        if(!empty($locations))
        {         
        $data_locations = array();
        $i= 0;    
        $data_result  =array();
        if(isset($locations)){
         foreach($locations as $location){
            $check = true;
            if($location['street1'] != ''){
                $address = $location['street1'].", ";
            }else{
                $check = false;
            }
            if($location['city'] != ''){
                $city = $location['city'].", ";
            }else{
                $check = false;
            }
            if($location['state'] != ''){
                $state = $location['state'].", ";
            }else{
                $check = false;
            }
            if($location['country'] != ''){
                $country = $location['country'].".";
            }else{
                $check = false;
            }
                    
            if($check){
                $data_locations = $location;              
                $string =    $address.$city.$state.$country;     
                $latlng = $this->find_lag_create($string); 
                if(!empty($latlng)){
                    $data = array(
                      'lat' =>$latlng->lat,
                      'lng' => $latlng->lng                     
                  );                
                //update lat and lng
                $this->db->where('id_location', $data_locations['id_location']);
                $show_data = $this->db->update('db_locations', $data);
              //  var_dump($data_locations['id_location']);   
                $this->session->set_flashdata('message_success', 'create lat and lng success');     
                                             
                $i++;
                }else{
                    $this->session->set_flashdata('message_error1', 'Can not lat and lng '); 
                }                
                
            }
          }
         }
        
        }else{
            $this->session->set_flashdata('message_error1', 'Can not create lat ,lng. '); 
           
        }
         $this->index(); 
    }
      public function find_lag_create($string){
        
         $address =   urlencode($string);      
         $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";
         $getmap = file_get_contents($url);
         $googlemap = json_decode($getmap);      
         foreach($googlemap->results as $res){
            $address = $res->geometry;            
            $latlng = $address->location;            
            //echo "Latitude: ". $latlng->lat ."<br />". "Longitude:". $latlng->lng;
            return $latlng;       
        }
    }
    
    
    
}    