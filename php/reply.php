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
	
	//Check if user is signed in...
	if(!$_SESSION['login'])
	{
		$error = 'User not signed in';
		$location[0] = 'subject';
		$location[1] = 'content';
		$location[2] = 'signature';
	}
	else if($_SESSION['login'])
	{
		//Check if any fields are empty
		if(empty($_POST['subject']) || empty($_POST['content']) || empty($_POST['signature']))
		{
			$error_count = 0;
		
			if(empty($_POST['subject']))		{	$location[$error_count] = 'subject';		$error_count++;		}
			if(empty($_POST['content']))		{	$location[$error_count] = 'content';		$error_count++;		}
			if(empty($_POST['signature']))		{	$location[$error_count] = 'signature';		$error_count++;		}
		
				 if($error_count==1){	$error = "Field left empty.";	}
			else if($error_count>1)	{	$error = "Fields left empty.";	}
		}
		else if(!empty($_POST['subject']) && !empty($_POST['content']) && !empty($_POST['signature']))
		{
			//Get the correct signature 
			     if($_POST['signature']=="fullname"){$signature = $_SESSION['fullname'];}
			else if($_POST['signature']=="anonymous"){$signature = "anonymous";}		
			else if($_POST['signature']=="firstname"){$signature = $_SESSION['firstname'];}
			else if($_POST['signature']=="username"){$signature = $_SESSION['username'];}	
						
			//Insert brick into the bricks table
			$sql = "insert into messages (
								message_id, 
								recipient_username,
								subject,
								content,
								timestamp,
								signature,
								owner
							) VALUES (
								null,
								'{$_POST['recipient']}',
								'{$_POST['subject']}',
								'{$_POST['content']}',
								NOW(),
								'$signature',									
								'{$_SESSION['username']}'
								)";

			$result = mysql_query($sql);
		}
	}
						
	$json = array("error" => $error, "location" => $location); 
	$output = json_encode($json);
	echo $output;	
	
?>