<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_background extends CI_Model {
    
    function __construct(){
        parent::__construct();
    }
    /**
    *Get all background 
    * @param string
    **/
    function get_all()
    {
        $results = $this->db->get('backgrounds')->result_array();
        $html = ' ';
        $i = 1;
        foreach($results as $result)
        {      
            //var_dump($result['background_9']);
            $set_value = "<input type='hidden' id='id_bg' value='".$result['id']."' /><input type='hidden' id='name_p' value='".$result['page_name']."' />";
            $html .= "<tr>
                    <th scope='row'>".$i."</th>
                    <td>".$result['page_name'];
                    $html .= "</td><td style='vertical-align: middle;'>"; 
                    if($result['background_1'] == 'empty'){
                        $html .= "<a href='#' class='btn btn-primary padding-btna edit_bg' data-toggle='modal' data-target='#modalEditBg'>".$set_value."<input type='hidden' id='name_back' value='background_1' />Upload</a>";
                    }else if(strlen(strstr($result['background_1'], "_thumb")) == 0) {
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg' style='border: 1px solid #000;color:#fff;padding: 9px 20px;background-color:".$result['background_1'].";'>".$this->short_Text($result['background_1']).$set_value."<input type='hidden' id='name_back' value='background_1' /></a>";                                         
                    }else if(!empty($result['background_1'])){
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg'><img width='85' style='height:33.6px;' src='".base_url().'uploads/'.$result['page_name'].'/'.$result['background_1']."'>".$set_value."<input type='hidden' id='name_back' value='background_1' /></a>";
                    }         
                        $html .= "</td><td style='vertical-align: middle;'>";                 
                    if($result['background_2'] == 'empty'){
                        $html .= "<a href='#' class='btn btn-primary padding-btna edit_bg' data-toggle='modal' data-target='#modalEditBg'>".$set_value."<input type='hidden' id='name_back' value='background_2' />Upload</a>";
                    }else if(strlen(strstr($result['background_2'], "_thumb")) == 0) {
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg' style='border: 1px solid #000;color:#fff;padding: 9px 20px;background-color:".$result['background_2'].";'>".$this->short_Text($result['background_2']).$set_value."<input type='hidden' id='name_back' value='background_2' /></a>";                                         
                    }else if(!empty($result['background_2'])){
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg'><img width='85' style='height:33.6px;' src='".base_url().'uploads/'.$result['page_name'].'/'.$result['background_2']."'>".$set_value."<input type='hidden' id='name_back' value='background_2' /></a>";
                    }    
                        $html .= "</td><td style='vertical-align: middle;'>"; 
                    if($result['background_3'] == 'empty'){
                        $html .= "<a href='#' class='btn btn-primary padding-btna edit_bg' data-toggle='modal' data-target='#modalEditBg'>".$set_value."<input type='hidden' id='name_back' value='background_3' />Upload</a>";
                    }else if(strlen(strstr($result['background_3'], "_thumb")) == 0) {
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg' style='border: 1px solid #000;color:#fff;padding: 9px 20px;background-color:".$result['background_3'].";'>".$this->short_Text($result['background_3']).$set_value."<input type='hidden' id='name_back' value='background_3' /></a>";                                         
                    }else if(!empty($result['background_3'])){
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg'><img width='85' style='height:33.6px;' src='".base_url().'uploads/'.$result['page_name'].'/'.$result['background_3']."'>".$set_value."<input type='hidden' id='name_back' value='background_3' /></a>";
                    }    
                        $html .= "</td><td style='vertical-align: middle;'>"; 
                    if($result['background_4'] == 'empty'){
                        $html .= "<a href='#' class='btn btn-primary padding-btna edit_bg' data-toggle='modal' data-target='#modalEditBg'>".$set_value."<input type='hidden' id='name_back' value='background_4' />Upload</a>";
                    }else if(strlen(strstr($result['background_4'], "_thumb")) == 0) {
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg' style='border: 1px solid #000;color:#fff;padding: 9px 20px;background-color:".$result['background_4'].";'>".$this->short_Text($result['background_4']).$set_value."<input type='hidden' id='name_back' value='background_4' /></a>";                                         
                    }else if(!empty($result['background_4'])){
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg'><img width='85' style='height:33.6px;' src='".base_url().'uploads/'.$result['page_name'].'/'.$result['background_4']."'>".$set_value."<input type='hidden' id='name_back' value='background_4' /></a>";
                    }    
                        $html .= "</td><td style='vertical-align: middle;'>"; 
                    if($result['background_5'] == 'empty'){
                        $html .= "<a href='#' class='btn btn-primary padding-btna edit_bg' data-toggle='modal' data-target='#modalEditBg'>".$set_value."<input type='hidden' id='name_back' value='background_5' />Upload</a>";
                    }else if(strlen(strstr($result['background_5'], "_thumb")) == 0) {
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg' style='border: 1px solid #000;color:#fff;padding: 9px 20px;background-color:".$result['background_5'].";'>".$this->short_Text($result['background_5']).$set_value."<input type='hidden' id='name_back' value='background_5' /></a>";                                         
                    }else if(!empty($result['background_5'])){
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg'><img width='85' style='height:33.6px;' src='".base_url().'uploads/'.$result['page_name'].'/'.$result['background_5']."'>".$set_value."<input type='hidden' id='name_back' value='background_5' /></a>";
                    }    
                        $html .= "</td><td style='vertical-align: middle;'>"; 
                    if($result['background_6'] == 'empty'){
                        $html .= "<a href='#' class='btn btn-primary padding-btna edit_bg' data-toggle='modal' data-target='#modalEditBg'>".$set_value."<input type='hidden' id='name_back' value='background_6' />Upload</a>";
                    }else if(strlen(strstr($result['background_6'], "_thumb")) == 0) {
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg' style='border: 1px solid #000;color:#fff;padding: 9px 20px;background-color:".$result['background_6'].";'>".$this->short_Text($result['background_6']).$set_value."<input type='hidden' id='name_back' value='background_6' /></a>";                                         
                    }else if(!empty($result['background_6'])){
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg'><img width='85' style='height:33.6px;' src='".base_url().'uploads/'.$result['page_name'].'/'.$result['background_6']."'>".$set_value."<input type='hidden' id='name_back' value='background_6' /></a>";
                    }    
                        $html .= "</td><td style='vertical-align: middle;'>"; 
                    if($result['background_7'] == 'empty'){
                        $html .= "<a href='#' class='btn btn-primary padding-btna edit_bg' data-toggle='modal' data-target='#modalEditBg'>".$set_value."<input type='hidden' id='name_back' value='background_7' />Upload</a>";
                    }else if(strlen(strstr($result['background_7'], "_thumb")) == 0) {
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg' style='border: 1px solid #000;color:#fff;padding: 9px 20px;background-color:".$result['background_7'].";'>".$this->short_Text($result['background_7']).$set_value."<input type='hidden' id='name_back' value='background_7' /></a>";                                         
                    }else if(!empty($result['background_7'])){
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg'><img width='85' style='height:33.6px;' src='".base_url().'uploads/'.$result['page_name'].'/'.$result['background_7']."'>".$set_value."<input type='hidden' id='name_back' value='background_7' /></a>";
                    }                     
                        $html .= "</td><td style='vertical-align: middle;'>";        
                    if($result['background_8'] == 'empty'){
                        $html .= "<a href='#' class='btn btn-primary padding-btna edit_bg' data-toggle='modal' data-target='#modalEditBg'>".$set_value."<input type='hidden' id='name_back' value='background_8' />Upload</a>";
                    }else if(strlen(strstr($result['background_8'], "_thumb")) == 0) {
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg' style='border: 1px solid #000;color:#fff;padding: 9px 20px;background-color:".$result['background_8'].";'>".$this->short_Text($result['background_8']).$set_value."<input type='hidden' id='name_back' value='background_8' /></a>";                                         
                    }else if(!empty($result['background_8'])){
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg'><img width='85' style='height:33.6px;' src='".base_url().'uploads/'.$result['page_name'].'/'.$result['background_8']."'>".$set_value."<input type='hidden' id='name_back' value='background_8' /></a>";
                    }     
                        $html .= "</td><td style='vertical-align: middle;'>";               
                    if($result['background_9'] == 'empty'){
                        $html .= "<a href='#' class='btn btn-primary padding-btna edit_bg' data-toggle='modal' data-target='#modalEditBg'>".$set_value."<input type='hidden' id='name_back' value='background_9' />Upload</a>";
                    }else if (strlen(strstr($result['background_9'], "_thumb")) == 0) {
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg' style='border: 1px solid #000;color:#fff;padding: 9px 20px;background-color:".$result['background_9'].";'>".$this->short_Text($result['background_9']).$set_value."<input type='hidden' id='name_back' value='background_9' /></a>";                                         
                    }else if(!empty($result['background_9'])){
                        $html .= "<a href='#' class='edit_bg' data-toggle='modal' data-target='#modalEditBg'><img width='85' style='height:33.6px;' src='".base_url().'uploads/'.$result['page_name'].'/'.$result['background_9']."'>".$set_value."<input type='hidden' id='name_back' value='background_9' /></a>";
                    } 
                        $html .= "</td></tr>";
             $i++;       
        }//exit;
        return $html;
    }
    /**
    * Get short text
    * @param string $text
    * @return string
    **/
    function short_Text($text)
    {        
      //$text = trim($text," ");  
      //$text = preg_replace('/\s+/', '', $text);
      $desLength 	=   strlen($text);
      //var_dump($desLength);exit;            
	  $stringMaxLength					= 	7;
	  if($desLength > $stringMaxLength){
      $des			= substr($text,0,$stringMaxLength); 
        $text = $des;		
	  }
    
      return $text;                                        
    }
    /**
    * Check page by name
    * @param string $page_name
    * @return array backgrounds
    **/
    function check_page($page_name)
    {        
        $this->db->where('page_name', $page_name);
        return $this->db->get('backgrounds')->row_array();   
    }
        
}
?>