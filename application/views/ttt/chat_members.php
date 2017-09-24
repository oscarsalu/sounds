<?php include APPPATH.'libraries/jchat/tour_chat/loader.php';    ?>
<link href="<?php echo base_url()?>assets/css/chat/jChat.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo base_url()?>assets/css/chat/user_css.css" rel="stylesheet" media="screen" type="text/css" />

<script src="<?php echo base_url()?>assets/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/chat/jChat_channel.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/chat/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/chat/custom.js" type="text/javascript"></script> 
<style>
.server p{
    color:#440808;
}
</style>
<?php 
   // session_start();
//    $sid = session_id();
//    $CurrentTime = time();
//    $_SESSION['username']=$user_data['id'];
//    $UserName = $_SESSION['username'];
//    $TimeOut = $CurrentTime - 300; // check 5 minutes
//    $this->M_tour->check_session($TimeOut,$UserName);
//    $this->M_tour->check_id_session($sid);
//    $check_sid_exist = $this->M_user->check_sid_exist($sid);
//    if ($check_sid_exist ==true)
//    {
//        //time updates online;
//        $this->M_tour->check_times($sid,$CurrentTime);
//    }
//    else
//    {
//        $this->M_tour->update_status($UserName,$sid,$tour['tour_id']);                                   
//    }
//    
?>
<div class="row">
      <div class="col-md-3">
              
            <div class="box"><!-- box -->
        
            <div class="header" style="z-index: 2">
                <h4 style="color: #fff;">List Member</h4>  
            </div>
            <div class="content">            
                       <div class="list-group-item active">
                           <?php 
                               $chek = $this->M_tour->check_chat_tour($tour['tour_id'], $user_data['id']);
                               if (isset($chek) && $chek != false) {
                                   echo ' <button data-toggle="modal" data-target="#modal_add_fan"  class="btn btn-warning">Add member</button>';
                               }
                            ?>
                        </div>
                      <!---->
                      
                      <ul class="list-group" tabindex="5000" style="overflow-y: hidden;">
                             <?php
                                 if (isset($list_member)) {
                                     foreach ($list_member as $data) {
                                         $name = $this->M_tour->name_show($data['user_member']);
                                         echo '<li class="list-group-item list-group-item-warning" style="height: 46px;">';
                                         echo '<div class="row">';
                                         foreach ($name as $n) {
                                             echo '<a href="'.base_url().$n['lastname'].'" title="'.ucfirst($n['lastname']).'"><img  width="36" height="35" src="'.$this->M_user->get_avata($data['user_member']).'"/></a>';
                                             echo '<a href="'.base_url().$n['lastname'].'" title="'.ucfirst($n['lastname']).'"><span class="userNames">'.ucfirst($n['lastname']).'</span></a>';
                                         }
                                             //if($data['status']==1){
//                                                 echo '<button type="button" class="btn btn-success " title="Online" style="border-radius: 50%;height: 25px;float:right;"></button>';
//                                              }else{
//                                                echo '<button type="button" class="btn btn-success " title="Offline" style="border-radius: 50%;height: 25px;float:right;background: #fff;"></button>';
//                                              }
                                      echo '</div>';
                                         echo '</li>';
                                     }
                                 }
                               ?>
                        </ul>
                      <!---->   
            </div>
        
        </div>
            <!--end box-->
     </div>
     <div class="col-md-9">
            <div class="chanenel_wp" >
                <input type="hidden" value="<?php echo $with_id ?>" id="with_id"/>
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" id="csrf" />
                <!-- BOX -->
                <div class="box">
                    
                	<div class="header" style="z-index: 2">
                            <h4 class="tt"><?php echo $chat->server; ?></h4>
                            <span class="liner"></span>
                    </div>
                    
                    <div class="content">
                    	
                        <?php
                            $current_session_time = $chat->get_session_time($chat->serverID);
                            if ($current_session_time == true) {
                                $session_time = '<span class="session_time">Last seen '.$current_session_time.'</span>';
                            } else {
                                $session_time = '<span class="session_time">Online</span>';
                            }
                        ?>
                        
                		<!-- jChat -->
                        <ul class="messages-layout">
                            <li class="messages"></li>
                        </ul>
                        <!-- Enter message field -->
                         <?php echo $session_time; ?><span id="sample"></span>
                        <div class="message-entry">
                            <input type="text" id="text-input-field" class="input-sm" name="message-entry" /> 
                            <div class="send-group">
                                <a href="#emoticons" data-option="emotions" class="attachEmotions" data-toggle="modal"></a>
                                <input type="submit" name="send-message" id="sendMessage" class="btn myButton" value="Send" />
                            </div>
                        </div>
                        
                        <!-- Emoticons Modal -->
                        <div id="emoticons" class="modal fade">
                        
                            <div class="modal-dialog">
                                <div class="modal-header">
                                    <h4 class="tt" style="color: #000 !important;">Emotions</h4>
                                    <span class="liner"></span>
                                </div>
                                <div class="modal-body"></div>
                                <div class="modal-footer">
                                    <a href="#" class="btn myButton" data-dismiss="modal">Close</a>
                                </div> 
                            </div> 
                        </div>
                        
                        <!-- // jChat -->
                                 
                    </div>
                    
                </div>
                <!-- // END BOX -->
                </div>
                            
     </div>
     
</div>

<script>
	$().Chat();
</script>
  <link rel="stylesheet" href="<?php echo base_url()?>assets/chosen_v5.1/chosen.css">
  
  <script src="<?php echo base_url()?>assets/chosen_v5.1/chosen.jquery.js" type="text/javascript"></script>
  <script type="text/javascript">
     $(document).ready(function(e) {
            $(".add_fan").chosen({
                  width:"100%"
            });
      });
  </script>
<div class="modal fade" id="modal_add_fan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add Fan</h4>
			</div>
			<div class="modal-body">
				<form class="form form-signup" action="<?php echo base_url()?>chat/addgroup" method="post">
                 <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                  <div id="container" style="min-height: 300px;">
                          <em>Choose Member...</em>
                          <select name="members[]" data-placeholder="Please enter your username or email.." class="add_fan" multiple>
                            <?php foreach ($friends as $row) {
    if ($row['role'] == 1) {
        ?><option  value="<?php echo $row['id']?>"><?=$this->M_user->get_name($row['id'])?> (A)</option><?php

    } elseif ($row['role'] == 2) {
        ?><option value="<?php echo $row['id']?>"><?=$this->M_user->get_name($row['id'])?>(F)</option><?php

    }
}?>
                          </select>
                  </div>
                  <div class="modal-footer">
    				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				<button type="submit" class="btn btn-primary">Add</button>
    			</div>
                </form>
                <div class="row">
                   <b>Notes ! Please enter your username or email..!</b>
                </div>
			</div>
		</div>
	</div>
</div>
