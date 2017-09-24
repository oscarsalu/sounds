<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managermember extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('M_photo');
        $this->load->model('M_user');
        $this->load->model('M_channel');
        $this->load->model('M_invite_user');
        $this->load->model('M_notify');
        if($this->session->userdata('loged_in') == false){
            redirect('account/login');
		}else{
		     $id = $this->session->userdata('loged_in');
             $user_data=$this->db->where('id='.$id)->get('users')->row_array();
             if($user_data['role']!=1) redirect('');
		}				
        $ac = $this->session->userdata('access');
          $data['redirect_url']=$this->curPageURL();
        if (!isset($ac) && !in_array($ac, $this->config->item('access_password'))) {
           
            redirect("access?redirect_url=".$data['redirect_url']);
        }		   
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
    public function addmember_new()
    {
        $user_id = $this->session->userdata('loged_in');
        $this->load->library('form_validation');
		$this->form_validation->set_rules('name_member', 'Name', 'required|max_length[255]');
        $this->form_validation->set_rules('email_member', 'Email', 'required|max_length[255]|callback_email_check');
        $this->form_validation->set_rules('contribution', 'Contribution', 'required');
        $this->form_validation->set_rules('yourname', 'Yourname', 'max_length[255]');
        $you_name = $this->input->post('your_name');
        $email_member = $this->input->post('email_member');
        if ($this->form_validation->run() != FALSE){
            $user = $this->db->where('email', $email_member)
                             ->get('users')
                             ->row_array();
            $member_id =  $user['id'];
            $enc = $this->str();
        
            $message = "<div style='text-align:center;'><h3>".$you_name." invite you become member, click link below to become member: <br/><br/>".base_url('artist/member/'.$enc.'/'.$user_id)."</h3></div>";
            $this->load->library('email');
            $config['protocol'] = 'smtp';
            $config['charset'] = 'utf-8';
            $config['mailtype'] = 'html';
            $config['newline'] = "\r\n";
            //send email
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->from('info@99sound.com', '99 Sound');
            $this->email->to($email_member);
            $this->email->subject('Added Member in band');
            $this->email->message($message);
            $this->email->send();
            $insertArr	=array(		
                'name_member'	=>  $this->input->post('name_member'),
                'email_member'  =>  $email_member,
                'contribution'  =>  $this->input->post('contribution'),
                'your_name'     =>  $this->input->post('your_name'),
                'artist_id'     =>  $user_id,
                'code_active'   =>  $enc,
                'member_id'     =>  $member_id                                
		    );            
            $this->db->insert('groups_member', $insertArr);
            redirect('artist/managermember'); 
        }else{
            redirect('artist/managermember'); 
        }
        
    }
    public function addmember()
    {
        $user_id = $this->session->userdata('loged_in');
        $user_data = $this->session->userdata('user_data');
            
        $this->load->library('form_validation');
		$this->form_validation->set_rules('name_member', 'Name', 'required|max_length[255]');
        $this->form_validation->set_rules('email_member', 'Email', 'required|max_length[255]|callback_email_check');
        $this->form_validation->set_rules('contribution', 'Contribution', 'required');
        $you_name = $user_data['firstname'];
        $email_member = $this->input->post('email_member');
        if ($this->form_validation->run() != FALSE)
        {      
                $user = $this->db->where('email',$email_member)
                             ->get('users')
                             ->row_array();
                $member_id = 0;
                if(empty($user))
                {
                    $subject = "You've been invited to chat with ".$you_name." onto 99SOUND.COM, click the below link to login and see the invitation or create an account.";
                    $invite_data = array('name'=> $this->input->post('name_member'), 'email' =>$email_member, 'status' => 0, 'invited_by_user'=> $user_id, 'created_at'=>time(), 'message'=> $subject);
                    $user_data = $this->M_invite_user->save($invite_data);
                    $this->send_inivition_mail($email_member, $this->input->post('name_member'),
                       $subject);

                }
                else
                {
                    $member_id = $user['id'];
                    $user_to = $member_id;
                    $user_invite = $user_id;
                     if (isset($user_invite) && isset($user_to) && $user_invite != $user_to) {
                        $datafriend = $this->db->where('user_id1', $user_invite)
                            ->where('user_id2', $user_to)
                            ->get('friends')->row_array();
                        $messages = 'You have a invite add contacts';
                           
                        //check isset contact
                        if (empty($datafriend)) {
                            $insertArr = array(
                                'user_invite' => $user_invite,
                                'user_to' => $user_to,
                                'status' => 0,
                                'messages' => $messages,
                                'time' => time(),
                            );
                            $this->db->insert('invite_contact', $insertArr);
                            $this->M_notify->addnotify($user_to, $messages, 'invite');
                            //insert data friend 
                            $insertArr = array(
                                'user_id1' => $user_invite,
                                'user_id2' => $user_to,
                                'status' => 0,
                                'date' => time(),
                            );
                            $this->db->insert('friends', $insertArr);
                        }
                    }
                }
            
                $enc = $this->str();
                $channel_name = $user_data['artist_name']."-band";
                $bandCount = $this->M_channel->check_artist_band_channel($channel_name);
                if($bandCount == 0)
                {
                    $dataArray = array('name'=> $channel_name, 'user_id'=> $this->session->userdata('loged_in'), 'type' =>'private', 'time'=> time(), 'is_admin'=> 0, 'group_type'=>'band', 'group_id'=>$user_id, 'level'=>0);
                    $this->M_channel->save($dataArray);
                }
                define('IMAGE_MEDIUM_DIR',FCPATH.'/uploads/'.$this->session->userdata('loged_in')."/image_member/");
                
                if (!file_exists(IMAGE_MEDIUM_DIR)) {
                    mkdir(IMAGE_MEDIUM_DIR, 0777, true);
                }
                $file = pathinfo($_FILES['member_image']['name']);
                $fileType = $file["extension"];
                $fileNameNew = rand(333, 999) . time() . ".$fileType";
                $config['upload_path']          = IMAGE_MEDIUM_DIR;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                $config['file_name']           = $fileNameNew;
               
                $this->load->library('upload', $config);
                $data=$this->upload->data();
                //var_dump($data);
                $file_name=$data['file_name'];
                if ($this->upload->do_upload('member_image')) {
                    $error = array('error' => $this->upload->display_errors()); 
              
                    $message = "<div style='text-align:center;'><h3>".$you_name." invite you become member, click link below to become member: <br/><br/>".base_url('artist/member/'.$enc.'/'.$user_id)."</h3></div>";
                    $this->load->library('email');
                    $config['protocol'] = 'smtp';
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['newline'] = "\r\n";
                    //send email
                    $this->email->initialize($config);
                    $this->email->clear();
                    $this->email->from('info@99sound.com', '99 Sound');
                    $this->email->to($email_member);
                    $this->email->subject('Added Member in band');
                    $this->email->message($message);
                    $this->email->send();
                    $insertArr	=array(		
                        'name_member'	=>  $this->input->post('name_member'),
                        'email_member'  =>  $this->input->post('email_member'),
                        'contribution'  =>  $this->input->post('contribution'),
                        'your_name'     =>  $you_name,
                        'artist_id'     =>  $user_id,
                        'code_active'   =>  $enc,
                        'member_id'     =>  $member_id,
                        'member_image'  =>  $file_name
        		    );    
                //     $data_invite = $this->db->where('id', $id_invite)
                // ->get('invite_contact')->row_array();
                    $messages = '“'.$you_name.'” invite you become a band member';
                    $this->M_notify->addnotify($member_id, $messages, 'band_invite');        
                    $this->db->insert('groups_member',$insertArr);
                }
              $this->session->set_flashdata('message_msg', 'Band Member Added');
                redirect('artist/profile'); 
        }else{
            redirect('artist/profile'); 
        }
        
    }

    //Function to send invitation mail
    public function send_inivition_mail($email_member, $name, $subject)
    {
        $data['subject'] = $subject;
        $data['name'] = $name;
        $message = $this->load->view('email/send_invite_chat', $data, true);;
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['newline'] = "\r\n";
        //send email
        $this->email->initialize($config);
        $this->email->clear();
        $this->email->from($this->config->item('admin_email'), '99 Sound');
        $this->email->to($email_member);
        $this->email->subject('Join 99 Sound');
        $this->email->message($message);
        $this->email->send();
    }
    public function active_member($enc,$id_a){
        $result = $this->db->where('artist_id',$id_a)
                           ->where('code_active',$enc)
                           ->get('groups_member')
                           ->row_array();
        $id = $result['id'];                                                                                        
        if(!empty($result)){
            $updateArr = array(
                                'status' => 1
                            );
            $this->db->update('groups_member',$updateArr,'id ='.$id);
            
            redirect(base_url());
        }                           
    }    
    private function str(){
		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$str = '';
		for ($i = 0; $i < 8; $i++){
			$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
		}
		return $str;
	}
    public function email_check($str)
	{
	    $user_id = $this->session->userdata('loged_in');
	    $user_result = $this->db
            ->where('email_member', $str)
            ->where('artist_id', $user_id)
            ->get('groups_member')
            ->row_array();
        if (!empty($user_result))
		{
			$this->form_validation->set_message('email_member', 'The %s field can not be the word '.$str);
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    public function manager(){ 
        $admin = $this->session->userdata('is_admin');
        if(isset($admin) && $admin == 1){
            $data['is_admin'] = $admin;
        }
        $user_id = $this->session->userdata('loged_in');
        $data = array();
        //$data['listmember']= $this->db->where('artist_id',$user_id)->order_by('id', 'DESC')->get('groups_member')->result_array();
        $data['user_data'] = $this->session->userdata('user_data'); 
        
        $config['per_page'] = 12;
        $config['base_url'] = base_url()."artist/managermember/";
        $start = $this->input->get('per_page');
        if(empty($start))
        {
            $start = 0;
        }
        $config['uri_segment'] = 3;  
        $config['total_rows'] = $this->db->get_where('groups_member',array('artist_id' => $user_id))->num_rows();
        $this->load->library('pagination', $config);
        $this->pagination->initialize($config);  
        $data['listmember'] = $this->db->limit($config['per_page'], $start)->get_where('groups_member',array('artist_id' => $user_id))->result_array();
          
        $this->load->view('includes/header',$data);
        $this->load->view('includes/navbar',$data);
        $this->load->view('artist/listmember', $data); 
        $this->load->view('includes/footer', $data);                    
    }
    public function editmember()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('contribution', 'Contribution', 'required');
        if ($this->form_validation->run() != FALSE){
            $id    =   $this->input->post('id');
            $updateArr = array(
                'startdate_m'	=>  $this->input->post('startdate_m'),
                'startdate_y'  =>  $this->input->post('startdate_y'),
                'contribution'  =>  $this->input->post('contribution'),
                'contribution2'     =>  $this->input->post('contribution2'),
                'er_member'     =>  $this->input->post('er_member')
            
            );  
            $this->db->update('groups_member',$updateArr,'id ='.$id);
        }
        redirect('artist/managermember');      
                       
    }
     public function cancel($id)
    {
        if(isset($id))
        {
            $this->db->where('id',$id)->delete('groups_member');
            redirect('artist/managermember');
        }
    }
}    