<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_background_video extends CI_Model {
    
    function __construct(){
        parent::__construct();
    }
    /**
    *Get all video backgrounds 
    * @return string
    **/
    function get_all()
    {
        $results = $this->db->get('background_videos')->result_array();
        $html = ' ';
        $i = 1;
        foreach($results as $result)
        {
            $set_value = "<input type='hidden' id='id_video' value='".$result['id']."' /><input type='hidden' id='name_p' value='".$result['page_name']."' />";            
            
            $html .= "<tr>
                    <th scope='row'>".$i."</th>
                    <td>".$result['page_name'];
                    $html .= "</td><td>";                     
                    if($result['video_1'] == 'empty'){
                        $html .= "<a href='#' class='btn btn-primary padding-btna edit_video' data-toggle='modal' data-target='#modalEditVideo' style='padding: 0px 10px;'>".$set_value."<input type='hidden' id='name_video' value='video_1' />Change</a>";
                    }else if(!empty($result['video_1'])){
                        $html .= "<a href='#' class='edit_video' data-toggle='modal' data-target='#modalEditVideo'>".$this->short_Text($result['video_1']).$set_value."<input type='hidden' id='name_video' value='video_1' /></a>";
                    }         
                        $html .= "</td><td>";                 
                    if($result['video_2'] == 'empty'){
                        $html .= "<a href='#' class='btn btn-primary padding-btna edit_video' data-toggle='modal' data-target='#modalEditVideo' style='padding: 0px 10px;'>".$set_value."<input type='hidden' id='name_video' value='video_2' />Change</a>";
                    }else if(!empty($result['video_2'])){
                        $html .= "<a href='#' class='edit_video' data-toggle='modal' data-target='#modalEditVideo'>".$this->short_Text($result['video_2']).$set_value."<input type='hidden' id='name_video' value='video_2' /></a>";
                    }         
                        $html .= "</td><td>";   
                    if($result['video_3'] == 'empty'){
                        $html .= "<a href='#' class='btn btn-primary padding-btna edit_video' data-toggle='modal' data-target='#modalEditVideo' style='padding: 0px 10px;'>".$set_value."<input type='hidden' id='name_video' value='video_3' />Change</a>";
                    }else if(!empty($result['video_3'])){
                        $html .= "<a href='#' class='edit_video' data-toggle='modal' data-target='#modalEditVideo'>".$this->short_Text($result['video_3']).$set_value."<input type='hidden' id='name_video' value='video_3' /></a>";
                    }         
                        $html .= "</td><td>";   
                    if($result['video_4'] == 'empty'){
                        $html .= "<a href='#' class='btn btn-primary padding-btna edit_video' data-toggle='modal' data-target='#modalEditVideo' style='padding: 0px 10px;'>".$set_value."<input type='hidden' id='name_video' value='video_4' />Change</a>";
                    }else if(!empty($result['video_4'])){
                        $html .= "<a href='#' class='edit_video' data-toggle='modal' data-target='#modalEditVideo'>".$this->short_Text($result['video_4']).$set_value."<input type='hidden' id='name_video' value='video_4' /></a>";
                    }         
                        $html .= "</td><td>";   
                    if($result['video_5'] == 'empty'){
                        $html .= "<a href='#' class='btn btn-primary padding-btna edit_video' data-toggle='modal' data-target='#modalEditVideo' style='padding: 0px 10px;'>".$set_value."<input type='hidden' id='name_video' value='video_5' />Change</a>";
                    }else if(!empty($result['video_5'])){
                        $html .= "<a href='#' class='edit_video' data-toggle='modal' data-target='#modalEditVideo'>".$this->short_Text($result['video_5']).$set_value."<input type='hidden' id='name_video' value='video_5' /></a>";
                    }                                                                                                
                        $html .= "</td></tr>";
             $i++;       
        }
        return $html;
    }
    /**
    * Get short text
    * @param string $text
    * @return string
    **/
    function short_Text($text)
    {              
      $desLength 	=   strlen($text);       
	  $stringMaxLength					= 	20;
	  if($desLength > $stringMaxLength){
      $des			= substr($text,0,$stringMaxLength); 
		$text = $des.'...';
	  }
    
      return $text;                                        
    }
    /**
    * Check page by page name
    * @param string $page_name
    * @return array video_backgrounds
    **/
    function check_page($page_name)
    {        
        $this->db->where('page_name', $page_name);
        return $this->db->get('background_videos')->row_array();   
    }
    
}
?>    