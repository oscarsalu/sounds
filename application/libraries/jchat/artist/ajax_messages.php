<?php
	
	include("loader.php");

	if(isset($_POST['clientID']))
	{
		// Get The Messages ID of the logged in clientID (user_id) and the one he sends to serverID (receiver)
		$messages_ids = $chat->get_messages_id($chat->clientID, $chat->serverID);
		
		if(!empty($messages_ids))
		{
			foreach($messages_ids as $message_id)
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
				?>
				<li class="<?php echo $class; ?>" id="<?php echo $message_id['id']; ?>">
					<a href="#" title=""><img src="images/avatars/user<?php echo $user_id; ?>.png" alt="" /></a>
					<div class="message-area">
						<span class="pointer"></span>
						<div class="info-row">
							<span class="user-name"><a href="#"><strong><?php echo $username; ?></strong></a> says:</span>
							<span class="time" id="<?php echo $message_id['id']; ?>"><?php echo $chat->get_messages_time($message_id['id']); ?></span>
							<div class="clear"></div>
						</div>
						<p>
							<?php echo $chat->get_messages($message_id['id']); ?>
						</p>
					</div>
					<div class="clear"></div>
				</li>
				<?php
			}
		} 
	}
		
?>