<?php include APPPATH.'libraries/jchat/artist/loader.php';    ?>
<link href="<?php echo base_url()?>assets/css/chat/jChat.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo base_url()?>assets/css/chat/user_css.css" rel="stylesheet" media="screen" type="text/css" />
<script src="<?php echo base_url()?>assets/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/chat/jChat_artist.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/chat/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/chat/custom.js" type="text/javascript"></script> 

<div class="chanenel_wp" >
<input type="hidden" value="<?php echo $with_id ?>" id="with_id"/>
<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" id="csrf" />
<!-- BOX -->
<div class="box">
    
	<div class="header">
            <h4 class="tt"><?php echo $chat->server; ?></h4>
            <span class="liner"></span>
    </div>
    
    <div class="content">
    	
        <span class="session_time">Online</span>
        
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

<script>
	$().Chat();
</script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>