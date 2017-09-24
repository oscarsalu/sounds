<?php
	
	class jChat 
	{
		############################################################################################### 
		#### Properties
		###############################################################################################
		
		public $clientID;
		public $client;
		public $serverID;
		public $server;
		public $attachmentPath;
		public $emoticons;
				
		// users table from same database
		public $users_table;
		public $users_usernameField;
		public $user_idField;
				
		############################################################################################### 
		#### Methods
		###############################################################################################
		
		/******************************************************************
		* Read Context
		*******************************************************************/
		
		public function __construct($db_server, $db_username, $db_password, $db_name, $table) 
		{
			// Set Internal Variables
			$this->db_server = $db_server;	
			$this->db_username = $db_username;
			$this->db_password = $db_password;
			$this->db_name = $db_name;
			$this->table = $table;
			// Connection @params 'Server', 'Username', 'Password'
			$this->connection = mysqli_connect($this->db_server, $this->db_username, $this->db_password, $this->db_name);
			
			// Display Friend Error Message On Connection Failure
			if(!$this->connection) 
			{
				die('Could not connect: ' . mysqli_error());
			}
			
			// Internal UTF-8
			mysqli_query($this->connection, "SET NAMES 'utf8'");
			mysqli_query($this->connection, 'SET character_set_connection=utf8');
			mysqli_query($this->connection, 'SET character_set_client=utf8');
			mysqli_query($this->connection, 'SET character_set_results=utf8');
			
			// Select The Database Name
			$db = mysqli_select_db($this->connection, $this->db_name);
			
			// Display Friend Error Message On Database Select Failure
			if(!$db)
			{
				die('Could not select: ' . mysqli_error());	
			}
			
			$this->result = mysqli_query($this->connection, "SELECT * FROM $this->table ");
			
		}
		
		//////////////////////////
		// Results Transformation
		/////////////////////////
		private function results($result)
		{
			
			$result_array = array();
			
			for ($i = 0; $row = mysqli_fetch_assoc($result); $i++)
			{
			   $result_array[$i] = $row; 
			}
			
			return $result_array;
						
		}
		
		/////////////////////
		// Time Calcuation
		////////////////////
		
		private function time_calculation($timestamp)
		{
		    
            $period  = array(
                "second",
                "minute",
                "hour",
                "day",
                "week",
                "month",
                "year",
                "decade"
            );
            $periods = array(
                "seconds",
                "minutes",
                "hours",
                "days",
                "weeks",
                "months",
                "years",
                "decades"
            );
        
            $lengths    = array(60,60,24,7,4.35,12,10);
            $timenow    = date("Y-m-d H:i:s");
            $now        = strtotime('now');
            $difference = $now - $timestamp;
            $tense      = "ago";
            for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
                $difference /= $lengths[$j];
            }
            $difference = round($difference);
            if ($difference != 1) {
                $per = $periods[$j];
            } else {
                $per = $period[$j];
            }
            
            $string_result = $difference . " " . $per . " ago";
            
            return $string_result;
		}
		
		//////////////////
		// Get Site Title
		/////////////////
		
		private function get_title($url)
		{
			$str = file_get_contents($url);
			if(strlen($str) > 0)
			{
				preg_match("/\<title\>(.*)\<\/title\>/", $str, $title);
				return $title[1];
			}
		}
		
		////////////////////
		// Sanitize Integer
		///////////////////
		public function sanitize_integer($get_id)
		{
			// clean it
			$sanitize = strip_tags($get_id);
			$sanitize = str_replace("'","", $sanitize);
			$sanitize = str_replace('"', "", $sanitize);
			
			$sanitize = (int) $sanitize;
			
			if(is_int($sanitize))
			{
				return $sanitize;
			}
			
			// return all data before a space
			$sanitize = substr($sanitize, 0, strpos($sanitize, ' '));
			
			// get only the numbers
			preg_match("/^\d+$/", $sanitize, $matches);	
			
			if(!empty($matches['0']))
			{
				return $matches['0'];	
			}
		}
		
		///////////////////////////
		// Get Ids os the messages
		//////////////////////////
		public function get_messages_id($sender, $artist_key)
		{
			// Result Query
			$this->result = mysqli_query($this->connection, 
				sprintf(
						"SELECT id, user_id, artist_key, storage_a, storage_b FROM $this->table
						WHERE  artist_key = '%s' ", 
						mysqli_real_escape_string($this->connection, $artist_key) 
					)
			);
			if($this->result) 
			{
				$resultss = $this->results($this->result);
			 
				// filter messages based on its storage
				foreach($resultss as $res)
				{
					// get only messages that are not deleted
					
					// just to order data based on logged_in user
					if($res['artist_key'] == $artist_key )
					{
						{
							$results[] = array(
								'id' => $res['id'],
								'user_id' => $res['user_id'],
								'artist_key' => $res['artist_key'],
								'storage_a' => $res['storage_a'],
								'storage_b' => $res['storage_b']
							);	
						}
					} 
				}
				if(!empty($results))
				{
					return $results;
				} else {
					return false;	
				}
				
			} else {
				return false;	
			}	
		}
		
		//////////////////////////////
		// Get Server/Client Messages
		/////////////////////////////
		public function get_messages($message_ID)
		{
			// Run querys based on weather the client has the message or not
			$this->result = mysqli_query($this->connection, 
				sprintf(
					"SELECT messages FROM $this->table
					WHERE id = %s
					ORDER BY id", 
					mysqli_real_escape_string($this->connection, $message_ID))
			);	
			
			$results = $this->results($this->result);
			
			if($this->result) 
			{
				// Emoticons
				$message = str_replace(array_keys($this->emoticons), array_values($this->emoticons), $results['0']['messages']);
				return $message;
				
			} else {
				return false;	
			}
		}
		
		///////////////
		// Get Message
		//////////////
		public function get_last_message()
		{
			// Run querys based on weather the client has the message or not
			$this->result = mysqli_query($this->connection, 
				sprintf(
					"SELECT id, messages FROM $this->table
					WHERE  artist_key = '%s' 
					ORDER BY id DESC LIMIT 1", 
					mysqli_real_escape_string($this->connection, $this->serverID)
					)
			);	
			
			$result = mysqli_fetch_assoc($this->result);
			if($this->result) 
			{
				return $result;
				
			} else {
				return false;	
			}
		}
		
		/////////////////////
		// Get Messages Time
		////////////////////
		
		public function get_messages_time($ID)
		{
			// Result Query
			$this->result = mysqli_query($this->connection, sprintf("SELECT time FROM $this->table WHERE id = %s", mysqli_real_escape_string($this->connection, $ID)));
			
			$results = mysqli_fetch_assoc($this->result);
			
			if($this->result) 
			{	
				return $this->time_calculation($results['time']);
			} else {
				return false;	
			}
		}
		
		public function get_session_time($serverID)
		{
			// Result Query
			$this->result = mysqli_query($this->connection, sprintf("SELECT session_time FROM $this->users_table WHERE id = %s AND session = 'offline'", mysqli_real_escape_string($this->connection, $serverID)));
			
			$results = mysqli_fetch_assoc($this->result);
			
			if(mysqli_num_rows($this->result) !== 0) 
			{	
				return $this->time_calculation($results['session_time']);
			} else {
				return false;	
			}	
		}
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// Get users from users table excluding the logged user because it does not makes sense chatting or messaging to yourself
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function get_users($clientID)
		{
			// Result Query
			$this->result = mysqli_query($this->connection, sprintf("SELECT $this->users_usernameField, $this->user_idField, status, session FROM $this->users_table WHERE $this->user_idField != %s", mysqli_real_escape_string($this->connection, $clientID)));
			
			if($this->result) 
			{
				return $this->results($this->result);
			} else {
				return false;	
			}	
		}
		
		///////////////////////////////////////
		// Get id, username based on a user id
		//////////////////////////////////////
		public function get_user($serverID, $return)
		{
			// Result Query
			$this->result = mysqli_query($this->connection, sprintf("SELECT $this->users_usernameField, $this->user_idField FROM $this->users_table WHERE $this->user_idField = %s", mysqli_real_escape_string($this->connection, $serverID)));
			
			if($this->result) 
			{
				$res = mysqli_fetch_assoc($this->result);

				switch($return)
				{
					case "ID":
						return $res[$this->user_idField];
						break;
					case "USERNAME":
						return $res[$this->users_usernameField];
						break;
				}
			} else {
				return false;	
			}	
		}
		
		//////////////////////////////
		// find new received messages
		/////////////////////////////
		public function get_unread_messages($serverID, $clientID)
		{
			$this->result = mysqli_query($this->connection, sprintf("SELECT id FROM $this->table WHERE status = '%s' AND user_id = %s AND artist_key = %s", 'unread', mysqli_real_escape_string($this->connection, $serverID), mysqli_real_escape_string($this->connection, $clientID)));
			
			$result = mysqli_num_rows($this->result);
			
			if($result == 0)
			{
				return '';
			} else {
				return mysqli_num_rows($this->result);	
			}
		}
		
		/******************************************************************
		* Write Context
		*******************************************************************/
		
		////////////////
		// Set Messages
		///////////////
		public function set_message($message)
		{
				
			$this->result = mysqli_query($this->connection, 
				sprintf("INSERT INTO $this->table
							SET 
							  messages = '%s',
							  time = %s,
							  user_id = %s,
							  artist_key = '%s',
							  storage_a = %s,
							  storage_b = '%s',
							  status = 'unread'
						", 
						 mysqli_real_escape_string($this->connection, htmlentities($message, ENT_COMPAT, 'UTF-8')),
                         mysqli_real_escape_string($this->connection, strtotime('now')),
						 mysqli_real_escape_string($this->connection, $this->clientID),
						 mysqli_real_escape_string($this->connection, $this->serverID),
						 mysqli_real_escape_string($this->connection, $this->clientID),
						 mysqli_real_escape_string($this->connection, $this->serverID)
				)
			);
			if($this->result)
			{
				return mysqli_insert_id($this->connection);	
			} else {
				return false;	
			}	
		}
		
		////////////////////////
		// Set Messages to read
		///////////////////////
		public function set_messages_read($serverID)
		{
			$this->result = mysqli_query($this->connection, 
				sprintf("UPDATE $this->table 
							SET 
							  status = '%s'
							WHERE
							  user_id = '%s' AND status = 'unread'
						", 
						'read',
						 mysqli_real_escape_string($this->connection, $serverID) 
				)
			);
			
			if($this->result)
			{
				return true;	
			} else {
				return false;	
			}
		}
		
		///////////////////////////
		// Set User Session Status
		//////////////////////////
		public function set_user_sessionStatus($clientID, $status)
		{
			switch($status)
			{
				case "ONLINE":
					
					$this->result = mysqli_query($this->connection, sprintf("SELECT session FROM $this->users_table WHERE $this->user_idField = '%s'", mysqli_real_escape_string($this->connection, $clientID)));
					
					$is_online = mysqli_fetch_assoc($this->result); 
										
					if($is_online['session'] == 'offline') // not online set online
					{
						$this->result = mysqli_query($this->connection, 
							sprintf("UPDATE $this->users_table
										SET 
										  session = '%s',
										  session_time = NOW()
										WHERE
										  $this->user_idField = %s
									", 
									'online',
									 mysqli_real_escape_string($this->connection, $clientID) 
							)
						);
						
						if($this->result)
						{
							return true;	
						} else {
							return false;	
						}
					} else {
						return false;	
					}
					
				break;
				
				case "OFFLINE":
				
					$this->result = mysqli_query($this->connection, 
						sprintf("UPDATE $this->users_table
									SET 
									  session = '%s',
									  session_time = NOW()
									WHERE
									  $this->user_idField = %s
								", 
								'offline',
								 mysqli_real_escape_string($this->connection, $clientID) 
						)
					);
					
					if($this->result)
					{
						return true;	
					} else {
						return false;	
					}
					
				break;
			}
		}
		
		//////////////////////
		// Unregister Message
		/////////////////////
		public function unregister_message($message_id, $clientID, $serverID)
		{
			// Find Owner
			$this->result = mysqli_query($this->connection, 
				sprintf("SELECT user_id, channel, storage_a, storage_b FROM $this->table
							WHERE
							  id = %s
						", 
						 mysqli_real_escape_string($this->connection, $message_id)
				)
			);	
			
			$row = mysqli_fetch_assoc($this->result);
			
			// Delete Magic
			if($row['user_id'] == $clientID )
			{
				if($row['user_id'] == $clientID)
				{
					$internal_storage_a = 0;
					$internal_storage_b = $row['storage_b'];
				}
			} 		
			
			// Register Storages (a => client, b => server)
			$updated = mysqli_query($this->connection, 
				sprintf("UPDATE $this->table
							SET 
							  storage_a = %s,
							  storage_b = %s
							WHERE
							  id = %s
						", 
						 mysqli_real_escape_string($this->connection, $internal_storage_a),
						 mysqli_real_escape_string($this->connection, $internal_storage_b),
						 mysqli_real_escape_string($this->connection, $message_id)
				)
			);	
			
			if($updated)
			{
				// check if both client and server does not have the messages to remove them
				// If you want to never delete messages remove this code and left just return true;
				
				// Look again
				$this->result = mysqli_query($this->connection, 
					sprintf("SELECT storage_a, storage_b FROM $this->table
								WHERE
								  id = %s
							", 
							 mysqli_real_escape_string($this->connection, $message_id)
					)
				);	
				$row = mysqli_fetch_assoc($this->result);
				
				// permanent delete it
				if($row['storage_a'] == 0 && $row['storage_b'] == 0)
				{
					mysqli_query($this->connection, 
						sprintf("DELETE FROM $this->table
									WHERE
									  id = %s
								", 
								 mysqli_real_escape_string($this->connection, $message_id)
						)
					);			
				}
				
				return true;
				
			} else {
				return false;	
			}

		}
		
	}
	
?>