<?php
	
	include("loader.php");
		
	if(isset($_POST['messageID']))
	{
		echo $chat->unregister_message($_POST['messageID'], $chat->clientID, $chat->serverID);
	}
	
?>