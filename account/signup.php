<?php
	//Include configuration file
	include('../config/config.php');
		
	//Connect to the database
	mysql_connect($db_host, $db_user, $db_password) or die('not connecting');
		
	//Select the database
	mysql_select_db($db_name) or die ('no database selected');
	
	//Continue session
	session_start();
	
	//Record error locations
	$location = array();
	
	//Check if user is signed in...
	if($_SESSION['login'])
	{
		$error = 'User is already signed in';
		$location[0] = 'firstname';
		$location[1] = 'lastname';
		$location[2] = 'email';
		$location[3] = 'username';
		$location[4] = 'password';
		$location[5] = 'privacy';
	}
	else if(!$_SESSION['login'])
	{
		//Check if any fields are empty
		if(empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']))
		{
			$error_count = 0;
			
			if(empty($_POST['firstname']))	{	$location[$error_count] = 'firstname';	$error_count++;	}
			if(empty($_POST['lastname']))	{	$location[$error_count] = 'lastname';	$error_count++;	}
			if(empty($_POST['email']))		{	$location[$error_count] = 'email';		$error_count++;	}
			if(empty($_POST['username']))	{	$location[$error_count] = 'username';	$error_count++;	}
			if(empty($_POST['password']))	{	$location[$error_count] = 'password';	$error_count++;	}
			
				 if($error_count==1){	$error = "Field left empty.";	}
			else if($error_count>1)	{	$error = "Fields left empty.";	}
		}
		//If all fields are not empty... 
		else if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']))
		{	
			//Check to see if input fields are too long
			if(strlen($_POST['firstname'])>35)
			{
				$error = "Firstname is too long";
				$location[0] = 'firstname';
			}
			else if(strlen($_POST['lastname'])>35)
			{
				$error = "Lastname is too long";
				$location[0] = 'lastname';
			}
			else if(strlen($_POST['email'])>50)
			{
				$error = "Email is too long";
				$location[0] = 'email';
			}
			else if(strlen($_POST['username'])>15)
			{
				$error = "Username is too long";
				$location[0] = 'username';
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
				//Check to see if email address is unique
				$sql = "select user_id from users where email = '{$_POST['email']}'";
				$result = mysql_query($sql);
				if(mysql_num_rows($result)>0)
				{
					$error = "You have already signed up for an account";
					$location[0] = 'firstname';
					$location[1] = 'lastname';
					$location[2] = 'email';
					$location[3] = 'username';
					$location[4] = 'password';
				}				
			
				//If there are still no errors...
				if($error==null)
				{
					//Check to see if username is unique
					$sql = "select username from users where username = '{$_POST['username']}'";
					$result = mysql_query($sql);
					if(mysql_num_rows($result)>0)
					{
						$error = "This username has already been taken";
						$location[0] = 'username';
					}
				}
			}
							
			//If there are no errors after all checks...
			if($error==null)
			{
				if(isset($_POST['privacy']))
				{
					$privacy=0;
				}
				else
				{
					$privacy=1;
				}
				
				//Insert user into the users table
				$sql = "insert into users (
							user_id, 
							username,
							firstname, 
							lastname, 
							email, 
							password,
							datejoined,
							authorizationcode,
							authorized,
							privacy
						) VALUES (
							null,
							'{$_POST['username']}',
							'{$_POST['firstname']}',
							'{$_POST['lastname']}',
							'{$_POST['email']}',
							sha1('{$_POST['password']}'),
							NOW(),
							sha1('{$_POST['email']}'),
							0,
							'$privacy'
							)";
				$result = mysql_query($sql);
					
				// Obtain user_id from table
				$user_id = mysql_insert_id();
					
				// Send a signup e-mail to user
				$auth_code = sha1($_POST['email']);
				$message = "Dear {$_POST['firstname']} {$_POST['lastname']},\n\n";
				$message = $message . "Email confirmation: http://dynamicwebapplications.net/youngm6/wheresitat/index.php?key=" . $auth_code;
				mail($_POST['email'], 'Sign Up Confirmation from Where\'s it At?', $message, 'From: Where\'s it At?');
					
				$error = 'Check email for user confirmation.';				
			} 
		}
	}
	
	$json = array("error" => $error, "location" => $location); 
	$output = json_encode($json);
	echo $output;	
?>
