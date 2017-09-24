<?php
	
	include("loader.php");
	
	if(isset($_POST['message']))
	{
		// Insert Message
		$message = $_POST['message'];
		$message_set_id = $chat->set_message($_POST['message']);
		
		// Get Messages
		$messages_ids = $chat->get_messages_id($chat->clientID, $chat->serverID);

		// Check if is client or server
		if(!empty($messages_ids))
		{
			foreach($messages_ids as $message_id)
			{	
				if($message_id['id'] == $message_set_id)
				{
					if($message_id['user_id'] == $chat->clientID)
					{
						$class = "client";
						$user_id = $chat->clientID;	
						$username = $chat->client;
					} elseif($message_id['user_id'] == $chat->serverID) {
						$class = "server";
						$user_id = 	$chat->serverID;
						$username = $chat->server;
					}	
				}
			}
	
			echo
			'
			<li class="'.$class.'" id="'.$message_set_id.'">
				<a href="#" title=""><img src="images/avatars/user'.$user_id.'.png" alt="'.$username.'" /></a>
				<div class="message-area">
					<span class="pointer"></span>
					<div class="info-row">
						<span class="user-name"><a href="#"><strong>'.$username.'</strong></a> says:</span>
						<span class="time" id="'.$message_set_id.'">'.$chat->get_messages_time($message_set_id).'</span>
						<div class="clear"></div>
					</div>
					<p>
						'.$chat->get_messages($message_set_id).'
					</p>
				</div>
				<div class="clear"></div>
			</li>
			';
		}
	}
	
?>