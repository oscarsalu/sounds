<?php
	if(isset($_GET['action']) && $_GET['action'] == 'logout' && $_GET['token'] == $_SESSION['jChat_token'])
	{
		$chat->set_user_sessionStatus($chat->clientID, 'OFFLINE');
		
		$_SESSION = array();
		session_destroy();
		
		header('Location: login.php');
		exit();
	}
?>