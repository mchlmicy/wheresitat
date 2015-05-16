<?php
		//Include MySQL Configuration
		include('../config/config.php');
	 
		//Connect to the database
		mysql_connect($db_host, $db_user, $db_password) or die('not connecting');
	 
		//Select the database
		mysql_select_db($db_name) or die ('no database selected');
				
		//Continue session
		session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Where's It At? | Profile</title>
  		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 		
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.css">	
		
       	<link rel="stylesheet" href="../css/bricks.css"/>
		<link rel="stylesheet" href="../css/css.css"/>
        <link rel="stylesheet" href="../css/modal.css"/>
        <link rel="stylesheet" href="../css/profile.css"/>
        <link rel="stylesheet" href="../css/signin.css"/>
        		
       	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../icon/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../icon/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../icon/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="../icon/favicon.png">		
		
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js">
        </script>
	</head>
	<body>
    	<div id="signinRedirect" class="modal hide fade">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Page Redirect</h3>
			</div>
			<div class="modal-body">
				You aren't signed in, so we're redirecting you to the home page.
			</div>
			<div class="modal-footer">
				<a href="../" class="btn">Okay</a>
			</div>
		</div>
    
    	<div id="reply" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="modalLabel">Reply</h3>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="reply_dialog-form">
					<div class="form-body">
                    	<input id="reply_recipient" name="recipient" type="hidden" value=""/> 
     	               	<div class="control-group error">
                        	<div class="controls">
								<label class="help-block" id="reply_validateTips"></label>
                            </div>
                        </div>
        	            <div class="control-group">
            	    		<label class="control-label">Subject</label>
                	        <div class="controls">
                    	        <input id="reply_subject" name="subject" placeholder="subject" type="text"/>
                        	</div>
	                    </div>
                        <div class="control-group">
        	            	<label class="control-label">Content</label>
            	            <div class="controls">
                	        	<textarea id="reply_content" name="content" placeholder="content" rows="3" style="resize: none"></textarea>
                    	    </div>
                       	</div>
                        <div class="control-group">
        	            	<label class="control-label">Signature</label>
            	            <div class="controls">
                	        	<select id="reply_signature" name="signature">
                                   	<?php 
										//If user logged in...
										if($_SESSION['login'])
										{
											//If privacy is set off...
											if($_SESSION['privacy']==0)
											{
												echo "	<option value=\"username\">username</option>
					                                    <option value=\"anonymous\">anonymous</option>
                    				                    <option value=\"firstname\">firstname</option>
                                       					<option value=\"fullname\">fullname</option>
													";
											}
											//If privacy is set on...
											else
											{
												echo "	<option value=\"username\">username</option>
					                                    <option value=\"anonymous\">anonymous</option>
													";
											}
										}
										else
										{
											echo "		<option value=\"username\">username</option>
					                                    <option value=\"anonymous\">anonymous</option>
                    				                    <option value=\"firstname\">firstname</option>
                                       					<option value=\"fullname\">fullname</option>
													";
										}
									?>													
                                </select>
                    	    </div>
                      	</div>    	
                	</div>
            	</form>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				<button class="btn btn-primary" id="reply">Reply</button>
			</div>
		</div>
       
        <?php
			//If user not signed in...
			if(!$_SESSION['login'])
			{
				echo "<script>$('#signinRedirect').modal('show');</script>";		
			}
		?>
               
    	<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target="#navbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="../">Where's it At?</a>
					<div id="navbar" class="nav-collapse collapse">
						<ul class="nav">
                        	<?php 
		                		//Because the user must be logged in...
		        		        echo "	<div class=\"mobile\">
							               	<table style=\"width: 100%\">
                		    	            	<tr>
                        		   					<td><span style=\"float: left\"><a class=\"brand\" href=\"profile/\">Welcome, {$_SESSION['firstname']}</a></span></td>
													<td><span class=\"pull-right\"><a class=\"brand\" href=\"../account/signout.php\">sign out</a></span></td>
												</tr>
											</table>
										</div>
									";
											
								echo "	<div class=\"tablet\">
							               	<table style=\"width: 100%\">
                		    	            	<tr>
                        		   					<td><span style=\"float: left\"><a class=\"brand\" href=\"profile/\">Welcome, {$_SESSION['firstname']}</a></span></td>
													<td><span class=\"pull-right\"><a class=\"brand\" href=\"../account/signout.php\">sign out</a></span></td>
												</tr>
											</table>
										</div>
									";
							?>
							<li class="active"><a href="../">home</a></li>
							<li><a href="../prototype/calendar.htm">calendar</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">event <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../prototype/events.htm">events</a></li>
									<li><a href="../prototype/event.htm">event details</a></li>
								</ul>
							</li>
                            <li><a href="../prototype/forum.htm">forum</a></li>
						</ul>
                        <?php 
		                	//Because the user must be logged in...
        		           	echo "	<span class=\"pull-right desktop\">
										<a class=\"brand\" href=\"profile/\">Welcome, {$_SESSION['firstname']}</a>
										<span class=\"brand\"> | </span>
										<a class=\"brand\" href=\"../account/signout.php\">sign out</a>
									</span>
								";
						?>                        
					</div>
				</div>
			</div>
		</div>
        
    		
		<div class="container">
			<div class="row-fluid">
	           	<div class="span4">
					<div class="hero-unit banner">
                       	<?php
							//Get user from the database
							$sql = "SELECT firstname, lastname, email, datejoined FROM users WHERE username='{$_SESSION['username']}'";
							$result = mysql_query($sql);
							$row = mysql_fetch_assoc($result);
							
							date_default_timezone_set('America/New_York');
							$join_date = strtotime($row['datejoined']);
									
							echo "	<h5>Firstname: ".$row['firstname']."</h5>
									<h5>Lastname: ".$row['lastname']."</h5>
									<h5>Email: ".$row['email']."</h5>
									<h5>Joined: ".date('M dS \a\t g:ia', $join_date)."</h5>
								";	
						?>
                    </div>					
				</div>
                <div class="span8">
                	<div class="well banner">
						<h2>Messages</h2>
                    </div>
                	<?php
						//Get messages from the database
						$sql = "SELECT message_id, recipient_username, subject, content, timestamp, signature, owner FROM messages WHERE recipient_username = '{$_SESSION['username']}' ORDER BY timestamp";
						$result = mysql_query($sql);
						while($row = mysql_fetch_array($result, MYSQL_ASSOC))
						{
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
								
								
							echo "	<div class=\"well message\">
										<h3 class=\"subject\">{$row['subject']}</h3>
										<h4 class=\"content\">{$row['content']}</h4>
										<h5 class=\"details\">
											Message from 
											<a href=\"../users/?profile={$row['owner']}\">
												{$row['signature']}
											</a>
											<i class=\"icon-user\" title=\"{$row['owner']}\"></i>
											received 
											<span title=\"Added on $brick_date_formatted\">
												$time_since $time_unit ago<i class=\"icon-time\"></i>													
											</span>
											<a class=\"reply\" data-toggle=\"modal\" href=\"#reply\" id=\"{$row['owner']}\">
												reply<i class=\"icon-edit\"></i>
											</a>														
										</h5>
									</div>
								";
						}
	                ?> 
             	</div>   
			</div>
		</div>
        <script type="text/javascript" src="../js/reply.js"></script>		
	</body>
</html>