<?php
	
	error_reporting(0);
		
	// Database Connection
	include('connection.php');
	// jChat Class
	include('jChat.php');
	// Session Manager
	include('session.php');
	// Starts the jChat Class @params 'DB Server', 'DB Username', 'DB Password', 'DB Name', 'Table Name'
	$chat = new jChat( $this->db->hostname, $this->db->username, $this->db->password, $this->db->database, 'messages_channel');	
		
	///////////////////////////////////////////////////////////////	
	// Configurations - This is were the user configuration starts
	///////////////////////////////////////////////////////////////
	$_SESSION['jChat_authenticated'] = 'true';
	$_SESSION['jChat_token'] = md5(uniqid(mt_rand(), true));
	// Register Database Username Fields
	$chat->users_table = 'users'; // the users table
	$chat->users_usernameField = 'username'; // the username field from users table
	$chat->user_idField = 'id'; // the id (primary key, auto-incremented) field for the users table
	if(isset($with_id)){
		$jChat_with = $chat->sanitize_integer($with_id);	
		$chat->set_messages_read($jChat_with);
	}
	$server_ID =  $with_id;
	$server_CHANNEL = ucfirst($_SESSION['jChat_username']);
	
	// Register Logged in user and the one he is chatting here (Client & Server)
	$chat->clientID =  $_SESSION['jChat_idclient']; // logged user id
	$chat->client = ucfirst( $_SESSION['jChat_nameclient']); // logged username
	$chat->serverID = (int)$server_ID; // client user id
	$chat->server = $server_CHANNEL;	 // client user name
	$chat->attachmentPath = base_url().'assets/emoticons/';
	$chat->type = $_SESSION['jChat_type'];
	$chat->artist_id =  $_SESSION['artist_id'];
   
	// Register Emoticons
	include('emoticons.php');
	$chat->emoticons = $emoticons;

?>