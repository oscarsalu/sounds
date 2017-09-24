<?php
	
	include("loader.php");
		
	if(isset($_POST['update']))
	{
		// Get Last Message
		$message = $chat->get_last_message();
		
		if(!isset($_SESSION['jChat_requested_id']))
		{
			$_SESSION['jChat_requested_id'] = 0;	
		}
					
		if(strlen($message['id']) !== 0 && $_SESSION['jChat_requested_id'] !== $message['id'])
		{
			// Get Messages
			$messages_ids = $chat->get_messages_id($chat->clientID, $chat->serverID);
	
			// Check if is client or server
			if(!empty($messages_ids))
			{
				foreach($messages_ids as $message_id)
				{	
					if($message['id'] == $message_id['id'])
					{
						if($message_id['user_id'] == $chat->clientID)
						{
							$class = "client";
							$user_id = $chat->clientID;	
							$username = $chat->client;
						} elseif($message_id['user_id'] == $chat->serverID) {
							$class = "server";
							$user_id = $chat->serverID;
							$username = $chat->server;
						}	
					}
				}

				echo
				'
				<li class="'.$class.'" id="'.$message['id'].'">
					<a href="#" title=""><img src="images/avatars/user'.$user_id.'.png" alt="'.$username.'" /></a>
					<div class="message-area">
						<span class="pointer"></span>
						<div class="info-row">
							<span class="user-name"><a href="#"><strong>'.$username.'</strong></a> says:</span>
							<span class="time" id="'.$message['id'].'">'.$chat->get_messages_time($message['id']).'</span>
							<div class="clear"></div>
						</div>
						<p>
							'.$chat->get_messages($message['id']).'
						</p>
					</div>
					<div class="clear"></div>
				</li>
				';
			}
		}
		
		$_SESSION['jChat_requested_id'] = $message['id'];

	}
	
?>