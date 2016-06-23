<?php
	function dbConnect($usertype, $connectionType = 'mysqli') {
		$host = 'YOUR HOSTNAME HERE';
		$db = 'DATABASE NAME HERE';
		if ($usertype == 'read') {
			$user = 'USERNAME HERE';
			$pwd = 'PASSWORD';
		} elseif ($usertype == 'write'){
			$user = 'USERNAME HERE';
			$pwd = 'PASSWORD';
		} else {
			exit ('Unrecognized connection type');
		}
		//connection code goes here
		
		 if ($connectionType == 'mysqli') {
			$conn = new mysqli($host, $user, $pwd, $db) or die("Cannot open database");
			return $conn;
		}
				
	}
	
?>