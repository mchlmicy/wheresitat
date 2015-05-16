<?php
		//Include MySQL Configuration
		include('../config/config.php');
	 
		//Connect to the database
		mysql_connect($db_host, $db_user, $db_password) or die('not connecting');
	 
		//Select the database
		mysql_select_db($db_name) or die ('no database selected');
				
		//Continue session
		session_start();
		
		if($_GET['profile']==$_SESSION['username'])
		{
			header('Location: ../profile/');
		}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Where's It At? | About</title>
  		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 		
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.css">	
			
  	    <link rel="stylesheet" href="../css/bricks.css"/>
        <link rel="stylesheet" href="../css/css.css"/>
		
       	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../icon/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../icon/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../icon/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="../icon/favicon.png">		
		
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
    	<div id="error" class="modal hide fade">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="errorLabel"></h3>
			</div>
			<div class="modal-body" id="errorBody">
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Okay</a>
			</div>
		</div>
    
    	<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target="#navbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="../index.php">Where's it At?</a>
					<div id="navbar" class="nav-collapse collapse">
						<ul class="nav">
                        	<?php
                            		//If user is logged in...
			       		            if($_SESSION['login']) 
									{
                    					echo "	<div class=\"signin-mobile\">
					                            	<table style=\"width: 100%\">
                    					            	<tr>
                                    						<td><span style=\"float: left\"><a class=\"brand\" href=\"profile/\">Welcome, {$_SESSION['firstname']}</a></span></td>
															<td><span class=\"pull-right\"><a class=\"brand\" href=\"account/signout.php\">sign out</a></span></td>
														</tr>
													</table>
												</div>
											";
									}
							?>
							<li class="active"><a href="#">Home</a></li>
							<li><a href="#about">About</a></li>
							<li><a href="#contact">Contact</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
									<li><a href="#">Something else here</a></li>
									<li class="divider"></li>
									<li class="nav-header">Nav header</li>
									<li><a href="#">Separated link</a></li>
									<li><a href="#">One more separated link</a></li>
								</ul>
							</li>
						</ul>
                        <?php 
		                	//If user is logged in...
        		            if($_SESSION['login']) 
							{
								echo "<span class=\"pull-right signin-desktop\">
											<a class=\"brand\" href=\"profile/\">Welcome, {$_SESSION['firstname']}</a>
											<span class=\"brand\"> | </span>
											<a class=\"brand\" href=\"account/signout.php\">sign out</a>
										</span>";
								
							}
							//If user isn't logged in...
							else
							{
								echo "	<form class=\"navbar-form pull-right\" id=\"signin_dialog-form\">
											<label class=\"signin-title\">Signin</label>
											<input class=\"span2\" id=\"signin_email\" name=\"email\" type=\"text\" placeholder=\"email\">
											<input class=\"span2\" id=\"signin_password\" name=\"password\" type=\"password\" placeholder=\"password\">
											<input id=\"signin_source\" name=\"source\" type=\"hidden\" value=\"index\"/>
											<button class=\"btn\" id=\"signin\">Sign in</button>
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
			<div class="hero-unit banner">
            	<div><center><h1>About</h1></center></div>
         	</div>
        </div>
     	        
		<div class="container">
			<div class="row-fluid">
				<div class="offset2 span8">
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