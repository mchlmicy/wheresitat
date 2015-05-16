<?php
	//Include config file
	include('../config/config.php');
		
	//Connect to the database
	mysql_connect($db_host, $db_user, $db_password) or die('not connecting');
		
	//Select the database
	mysql_select_db($db_name) or die ('no database selected');

	//Continue session
	session_start();
	
	//Record error locations
	$location = array();
	
	//Check if any fields are empty
	if(empty($_POST['email']) || empty($_POST['password']))
	{
		$error_count = 0;
		
		if(empty($_POST['email']))		{	$location[$error_count] = 'email';		$error_count++;	}
		if(empty($_POST['password']))	{	$location[$error_count] = 'password';	$error_count++;	}
		
			 if($error_count==1){	$error = "Field left empty.";	}
		else if($error_count>1)	{	$error = "Fields left empty.";	}
	}
	//If email and password set...
	else if(!empty($_POST['email']) && !empty($_POST['password']))
	{
		//Check to see if input fields are too long
		if(strlen($_POST['email'])>50)
		{
			$error = "Email is too long";
			$location[0] = 'email';
		}
		else if(strlen($_POST['password'])>15)
		{
			$error = "Password is too long";
			$location[0] = 'password';
		}
		
		//Check to see if email has an @
		else if(strpos($_POST['email'],'@')==false) 
  		{
			$error = "Email formatted incorrectly";
			$location[0] = 'email';
		}
		
		//If there are still no errors...
		if($error==null)
		{
			//Get user information from the users table
			$sql = "SELECT user_id, username, firstname, lastname, email, authorized, privacy FROM users WHERE email = '{$_POST['email']}' AND password = sha1('{$_POST['password']}') LIMIT 1";
			$result = mysql_query($sql);
			$row = mysql_fetch_assoc($result);
			
			//If user information invalid... 
			if(!$row['user_id'])
			{
				$error = "Invalid username and/or password.";
				$location[0] = 'email';
				$location[1] = 'password';
			}		
			//If user not authorized...
			else if($row['authorized']==0)
			{
				$error = "User not authorized at this time.";
				$location[0] = 'email';
				$location[1] = 'password';
			}				
			//If there are still no errors...
			else if($error==null)
			{
				//Sign in user information
				$_SESSION['login'] = "true";
				$_SESSION['privacy'] = $row['privacy'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['firstname'] = $row['firstname'];
				$_SESSION['fullname'] = $row['firstname'] . " " . $row['lastname'];
			} 
		}
	}
		
	$json = array("error" => $error, "location" => $location); 
	$output = json_encode($json);
	echo $output;	
	
?>