<?php
	//Include config file
	include('../config/config.php');
		
	//Connect to the database
	mysql_connect($db_host, $db_user, $db_password) or die('not connecting');
		
	//Select the database
	mysql_select_db($db_name) or die ('no database selected');

	//Continue session
	session_start();
	
	//Get brick information from the bricks table
	$sql = "SELECT subject, content, upvotes, downvotes, category, signature, owner, timestamp FROM bricks WHERE brick_id = '{$_POST['brick_id']}' LIMIT 1";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	
	//Set the default timezone
	date_default_timezone_set('America/New_York');
						
	//Get the brick date
	$brick_date = strtotime($row['timestamp']);
																	
	//Get the time since the brick date
	$time_since = time() - $brick_date;
								
	if($time_since>=31536000){		if($time_since/31536000<2){$time_unit = 'year';}
									else{$time_unit = 'years';}
									$time_since = floor($time_since/31536000);
							}
	else if($time_since>=2592000){	if($time_since/2592000<2){$time_unit = 'month';}
									else{$time_unit = 'months';}
									$time_since = floor($time_since/2592000);
								}
	else if($time_since>=604800){	if($time_since/604800<2){$time_unit = 'week';}
									else{$time_unit = 'weeks';}
									$time_since = floor($time_since/604800);
								}
	else if($time_since>=86400){	if($time_since/86400<2){$time_unit = 'day';}
									else{$time_unit = 'days';}
									$time_since = floor($time_since/86400);
							}
	else if($time_since>=3600){		if($time_since/3600<2){$time_unit = 'hour';}
									else{$time_unit = 'hours';}
									$time_since = floor($time_since/3600);
							}
	else if($time_since>=60){		if($time_since/60<2){$time_unit = 'minute';}
									else{$time_unit = 'minutes';}
									$time_since = floor($time_since/60);
							}
	else if($time_since>=1){		if($time_since/1<2){$time_unit = 'second';}
									else{$time_unit = 'seconds';}
									$time_since = floor($time_since/1);
						}
	else if($time_since<1){			$time_unit = 'seconds';						
									$time_since = 0;
						}
						
	$brick_date_formatted = date('M dS \a\t g:ia', $brick_date);
	$brick_timesince = $time_since . ' ' . $time_unit . ' ago';
		
	$json = array("brick_id" => $_POST['brick_id'], "brick_subject" => $row['subject'], "brick_content" => $row['content'], "brick_upvotes" => $row['upvotes'], "brick_downvotes" => $row['downvotes'], "brick_category" => $row['category'], "brick_signature" => $row['signature'], "brick_owner" => $row['owner'], "brick_date_formatted" => $brick_date_formatted, "brick_timesince" => $brick_timesince); 
	$output = json_encode($json);
	echo $output;		
?>