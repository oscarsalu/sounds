<?php include APPPATH.'libraries/jchat/loader.php';    ?>
<link href="<?php echo base_url()?>assets/css/chat/jChat.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo base_url()?>assets/css/chat/user_css.css" rel="stylesheet" media="screen" type="text/css" />
<script type="text/javascript">
    link = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url()?>assets/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/chat/jChat.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/chat/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/chat/custom.js" type="text/javascript"></script> 

<div class="chanenel_wp" >
<input type="hidden" value="<?php echo $with_id ?>" id="with_id"/>
<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" id="csrf" />

<!-- BOX -->
<div class="box">

	<div class="header">
    	<h4><?php echo $chat->server; ?></h4>
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
                <input type="submit" name="send-message" id="sendMessage" class="btn btn-primary" value="Send" />
            </div>
        </div>
        
        <!-- Emoticons Modal -->
        <div id="emoticons" class="modal fade">
        
            <div class="modal-dialog">
                <div class="modal-header"><h4>Emotions</h4></div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
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
</body>
</html>