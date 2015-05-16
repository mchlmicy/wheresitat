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
		<title>Where's It At? | User Profile</title>
  		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 		
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.css">	
			
  	    <link rel="stylesheet" href="../css/bricks.css"/>
		<link rel="stylesheet" href="../css/css.css"/>
        <link rel="stylesheet" href="../css/modal.css"/>
        <link rel="stylesheet" href="../css/signin.css"/>
		
       	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../icon/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../icon/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../icon/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="../icon/favicon.png">		
		
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
    	<div id="profileRedirect" class="modal hide fade">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Profile Redirect</h3>
			</div>
			<div class="modal-body">
				You're looking at your own page, so we're redirecting you to your profile.
			</div>
			<div class="modal-footer">
				<a href="../" class="btn">Okay</a>
			</div>
		</div>
        
        <div id="popup" class="modal hide fade">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="popupSubject"></h3>
			</div>
			<div class="modal-body" id="popupBody">
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Okay</a>
			</div>
		</div>
    
    	<?php
			//If user signed in and looking at own profile...
			if($_GET['profile']==$_SESSION['username'])
			{
				echo "<script>$('#profileRedirect').modal('show');</script>";
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
                            		//If user is logged in...
			       		            if($_SESSION['login']) 
									{
                    					echo "	<div class=\"mobile\">
					                            	<table style=\"width: 100%\">
                    					            	<tr>
                                    						<td><span style=\"float: left\"><a class=\"brand\" href=\"../profile/\">Welcome, {$_SESSION['firstname']}</a></span></td>
															<td><span class=\"pull-right\"><a class=\"brand\" href=\"../account/signout.php\">sign out</a></span></td>
														</tr>
													</table>
												</div>
											";
											
										echo "	<div class=\"tablet\">
					                            	<table style=\"width: 100%\">
                    					            	<tr>
                                    						<td><span style=\"float: left\"><a class=\"brand\" href=\"../profile/\">Welcome, {$_SESSION['firstname']}</a></span></td>
															<td><span class=\"pull-right\"><a class=\"brand\" href=\"../account/signout.php\">sign out</a></span></td>
														</tr>
													</table>
												</div>
											";
									}
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
                            <li><a href="prototype/forum.htm">forum</a></li>
						</ul>
                        <?php 
		                	//If user is logged in...
        		            if($_SESSION['login']) 
							{
								echo "<span class=\"pull-right desktop\">
											<a class=\"brand\" href=\"../profile/\">Welcome, {$_SESSION['firstname']}</a>
											<span class=\"brand\"> | </span>
											<a class=\"brand\" href=\"../account/signout.php\">sign out</a>
										</span>";
								
							}
							//If user isn't logged in...
							else
							{
								echo "	<form class=\"navbar-form pull-right desktop\" id=\"signin_dialog-form_desktop\">
											<label class=\"mobile\">Signin</label>
											<input class=\"span2\" id=\"signin_email_desktop\" name=\"email\" type=\"text\" placeholder=\"email\">
											<input class=\"span2\" id=\"signin_password_desktop\" name=\"password\" type=\"password\" placeholder=\"password\">
											<input id=\"signin_source_desktop\" name=\"source\" type=\"hidden\" value=\"secondary\"/>
											<button class=\"btn\" id=\"signin_desktop\">Sign in</button>
										</form>
									";
									
								echo "	<form class=\"navbar-form pull-right mobile\" id=\"signin_dialog-form_mobile\">
											<label>Signin</label>
											<input class=\"span2\" id=\"signin_email_mobile\" name=\"email\" type=\"text\" placeholder=\"email\">
											<input class=\"span2\" id=\"signin_password_mobile\" name=\"password\" type=\"password\" placeholder=\"password\">
											<input id=\"signin_source_mobile\" name=\"source\" type=\"hidden\" value=\"secondary\"/>
											<button class=\"btn pull-right\" id=\"signin_mobile\">Sign in</button>
										</form>
									";
									
								echo "	<form class=\"navbar-form pull-right tablet\" id=\"signin_dialog-form_tablet\">
											<label>Signin</label>
											<input class=\"inline\" id=\"signin_email_tablet\" name=\"email\" type=\"text\" placeholder=\"email\">
											<input class=\"inline\" id=\"signin_password_tablet\" name=\"password\" type=\"password\" placeholder=\"password\">
											<input id=\"signin_source_tablet\" name=\"source\" type=\"hidden\" value=\"secondary\"/>
											<button class=\"btn pull-right\" id=\"signin_tablet\">Sign in</button>
										</form>
									";
							}
						?>
					</div>
				</div>
			</div>
		</div>
        
        <?php
				//Get profile privacy from the database
				$sql = "SELECT privacy FROM users WHERE username='{$_GET['profile']}'";
				$result = mysql_query($sql);
				$row = mysql_fetch_assoc($result);					
				$profile_privacy = $row['privacy'];
	
				//If privacy is not set...
				if($profile_privacy==0)
				{
					//Get profile from the database
					$sql = "SELECT firstname, lastname, email, datejoined FROM users WHERE username='{$_GET['profile']}'";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);		
					
					$profile_firstname = $row['firstname'];
					$profile_lastname = $row['lastname'];
					$profile_email = $row['email'];
					$profile_username = $_GET['profile'];
					$profile_datejoined = $row['datejoined'];
				}
				
				//If privacy is set...
				else
				{
					//Get profile from the database
					$sql = "SELECT firstname, datejoined FROM users WHERE username='{$_GET['profile']}'";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					
					$profile_firstname = $row['firstname'];
					$profile_lastname = "private";
					$profile_email = "private";
					$profile_username = $_GET['profile'];
					$profile_datejoined = $row['datejoined'];
				}
		?>
		
		<div class="container">
			<div class="row-fluid">
				<div class="offset2 span8" style="margin-top: 50px">
					<div class="well" style="padding: 9px">
						<div>
							<h3 style="margin: 0px">
                            	<b>
									<?php 
										if($profile_privacy==1){$profile_privacy_output="on";}
										else{$profile_privacy_output="off";}
									
										echo "<div>Firstname: " . $profile_firstname . "</div>";
										echo "<div>Lastname: " . $profile_lastname . "</div>";
										echo "<div>Email: " . $profile_email . "</div>";
										echo "<div>Username: " . $profile_username . "</div>";
										echo "<div>Datejoined: " . $profile_datejoined . "</div>";										
										echo "<div>Privacy: " . $profile_privacy_output . "</div>";
									?>
                            	</b>
                            </h3>
						</div>
					</div>	
				</div>
			</div>
		</div>		
		<script src="../account/js/signin.js"></script>	
	</body>
</html>