<?php
		//Include MySQL Configuration
		include('config/config.php');
	 
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
		<title>Where's It At?</title>
  		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 		
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css">	
			
        <link rel="stylesheet" href="isotope/css/isotope.css">  
            
  		<link rel="stylesheet" href="css/bricks.css"/>
		<link rel="stylesheet" href="css/css.css"/>
        <link rel="stylesheet" href="css/index.css"/>
        <link rel="stylesheet" href="css/modal.css"/>
        <link rel="stylesheet" href="css/signin.css"/>
		
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="icon/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="icon/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="icon/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="icon/favicon.png">		
		
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="isotope/js/jquery.isotope.min.js"></script>
	</head>
	<body>
    	<div id="signup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="modalLabel">Sign up</h3>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="signup_dialog-form">
                	<div class="form-body">
                        <div class="control-group error">
                        	<div class="controls">
								<label class="help-block" id="signup_validateTips"></label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Name</label>
                            <div class="controls">
                                <input class="inline" id="signup_firstname" name="firstname" placeholder="firstname" type="text"/>
                                <input class="inline" id="signup_lastname" name="lastname" placeholder="lastname" type="text"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Account</label>
                            <div class="controls">
                                <input class="inline" id="signup_email" name="email" placeholder="email" type="text"/>
                                <input class="inline" id="signup_username" name="username" placeholder="username" type="text"/>
                            </div>
                        </div> 
                        <div class="control-group">
                            <label class="control-label">Password</label>
                            <div class="controls">
                                <input id="signup_password" name="password" placeholder="password" type="password"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Privacy</label>
                            <div class="controls">
                                <label class="checkbox"><input id="signup_privacy" name="privacy" type="checkbox">Allow others to see my full name.</label>
                            </div>
                        </div>  
                	</div> 
                </form>    
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				<button class="btn btn-primary" id="signup">Sign up</button>
			</div>
		</div>  
               
        <div id="authorize" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="modalLabel">Authorize Account</h3>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="authorize_dialog-form">
					<div class="form-body">
						<div class="control-group error">
                        	<div class="controls">
								<label class="help-block" id="authorize_validateTips"></label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Email</label>
                            <div class="controls">
                                <input id="authorize_email" name="email" placeholder="email" type="text"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Password</label>
                            <div class="controls">
                                <input id="authorize_password" name="password" placeholder="password" type="password"/>
                            </div>
                        </div>
                        <input id="authorize_key" name="key" type="hidden" value="<?php echo $_GET['key']; ?>"/>
                	</div>
                </form>    
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
				<button class="btn btn-primary" id="authorize">Authorize</button>
			</div>
		</div>     
        
		<div id="newPost" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="modalLabel">New Post</h3>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="newPost_dialog-form">
					<div class="form-body">
     	               	<div class="control-group error">
                        	<div class="controls">
								<label class="help-block" id="newPost_validateTips"></label>
                            </div>
                        </div>
        	            <div class="control-group">
            	    		<label class="control-label">Subject</label>
                	        <div class="controls">
                    	        <input id="newPost_subject" name="subject" placeholder="subject" type="text"/>
                        	</div>
	                    </div>
                        <div class="control-group">
        	            	<label class="control-label">Content</label>
            	            <div class="controls">
                	        	<textarea id="newPost_content" name="content" placeholder="content" rows="3" style="resize: none"></textarea>
                    	    </div>
                       	</div>
                        <div class="control-group">
        	            	<label class="control-label">Category</label>
            	            <div class="controls">
                	        	<select id="newPost_category" name="category">
                                	<option value="">Select one...</option>
                                    <option value="artanddesign">art & design</option>
									<option value="education">education</option>
                                    <option value="environment">environment</option>
                                    <option value="other">other</option>
                                </select>
                    	    </div>
                        </div>
                        <div class="control-group">
        	            	<label class="control-label">Signature</label>
            	            <div class="controls">
                	        	<select id="newPost_signature" name="signature">
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
                        <div class="control-group">
        	            	<label class="control-label">Optional Photo</label>
            	            <div class="controls">            	           
		                        <input id="newPost_photo" name="photo" type="file"/>
								<div id="preview" style="display: hidden">
									<img class="photo_preview" width="75%"/>
                                    <div class="photo_error text-error"></div>                                    
								</div>
                      		</div>        
              			</div>
                	</div>
            	</form>
			</div>
			<div class="modal-footer">
				<button aria-hidden="true" class="btn" data-dismiss="modal" id="newPost_close">Cancel</button>
				<button class="btn btn-primary" id="newPost">Post</button>
			</div>
		</div>
               
        <div class="modal hide fade" id="credentials">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    			<h3>Guest Credentials</h3>
    		</div>
    		<div class="modal-body">
    			<p>Username: username@tcnj.edu</p>
                <p>Password: guest</p>
    		</div>
    		<div class="modal-footer">
    			<a href="#" class="btn" data-dismiss="modal">Close</a>
    		</div>
    	</div>
        
        <div class="modal hide fade brick" id="brickexpanded">
    		<div class="brick_subject">
          		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            	<div class="content">
                </div>
    		</div>
    		<div class="brick_content">
            </div>
            <div class="brick_stats">
            	<span class="label upvotes"></span>
				<span class="label downvotes"></span>
				<span class="label netvotes"></span>
				<span class="label voting">
					<i class="icon-arrow-up icon-white upvote"></i>
					<i class="icon-arrow-down icon-white downvote"></i>
				</span>	
      
            </div>
            <div class="brick_timestamp">
				<span class="timesince"></span>									
				<span class="dateposted">
					<i class="icon-time icon-white"></i>													
				</span> 
                <a class="ownerlink" title="{$row['owner']}" href="users/?profile={$row['owner']}">
					<span class="signature"></span>
                	<i class="icon-user icon-white"></i>
				</a>
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
			if($_GET['key']!=null)
			{
				echo "<script>$('#authorize').modal('show');</script>";				
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
					<a class="brand" href="index.php">Where's it At?</a>
					<div id="navbar" class="nav-collapse collapse">
						<ul class="nav">
							<?php
                            		//If user is logged in...
			       		            if($_SESSION['login']) 
									{
                    					echo "	<div class=\"mobile\">
					                            	<table style=\"width: 100%\">
                    					            	<tr>
                                    						<td><span style=\"float: left\"><a class=\"brand\" href=\"profile/\">Welcome, {$_SESSION['firstname']}</a></span></td>
															<td><span class=\"pull-right\"><a class=\"brand\" href=\"account/signout.php\">sign out</a></span></td>
														</tr>
													</table>
												</div>
											";
											
										echo "	<div class=\"tablet\">
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
							<li class="active"><a href="/">home</a></li>
                            <li><a href="about/">about</a></li>
							<li><a href="prototype/calendar.htm">calendar</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">event <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="prototype/events.htm">events</a></li>
									<li><a href="prototype/event.htm">event details</a></li>
								</ul>
							</li>
                            <li><a href="prototype/forum.htm">forum</a></li>
						</ul>
                        <?php 
		                	//If user is logged in...
        		            if($_SESSION['login']) 
							{
								echo "<span class=\"pull-right desktop\">
											<a class=\"brand\" href=\"profile/\">Welcome, {$_SESSION['firstname']}</a>
											<span class=\"brand\"> | </span>
											<a class=\"brand\" href=\"account/signout.php\">sign out</a>
										</span>";
								
							}
							//If user isn't logged in...
							else
							{
								echo "	<form class=\"navbar-form pull-right desktop\" id=\"signin_dialog-form_desktop\">
											<label class=\"mobile\">Signin</label>
											<input class=\"span2\" id=\"signin_email_desktop\" name=\"email\" type=\"text\" placeholder=\"email\">
											<input class=\"span2\" id=\"signin_password_desktop\" name=\"password\" type=\"password\" placeholder=\"password\">
											<input id=\"signin_source_desktop\" name=\"source\" type=\"hidden\" value=\"primary\"/>
											<button class=\"btn\" id=\"signin_desktop\">Sign in</button>
										</form>
									";
									
								echo "	<form class=\"navbar-form pull-right mobile\" id=\"signin_dialog-form_mobile\">
											<label>Signin</label>
											<input class=\"span2\" id=\"signin_email_mobile\" name=\"email\" type=\"text\" placeholder=\"email\">
											<input class=\"span2\" id=\"signin_password_mobile\" name=\"password\" type=\"password\" placeholder=\"password\">
											<input id=\"signin_source_mobile\" name=\"source\" type=\"hidden\" value=\"primary\"/>
											<button class=\"btn pull-right\" id=\"signin_mobile\">Sign in</button>
										</form>
									";
									
								echo "	<form class=\"navbar-form pull-right tablet\" id=\"signin_dialog-form_tablet\">
											<label>Signin</label>
											<input class=\"inline\" id=\"signin_email_tablet\" name=\"email\" type=\"text\" placeholder=\"email\">
											<input class=\"inline\" id=\"signin_password_tablet\" name=\"password\" type=\"password\" placeholder=\"password\">
											<input id=\"signin_source_tablet\" name=\"source\" type=\"hidden\" value=\"primary\"/>
											<button class=\"btn pull-right\" id=\"signin_tablet\">Sign in</button>
										</form>
									";
							}
						?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container">
			<section id="content">
				<div class="hero-unit banner">
                	<div class="banner-logo"></div>
                    <p class="banner-text">
                    	Building Trenton brick by brick.<br/>
                      	Sign up 
                        <a style="text-decoration: underline" href="#signup" data-toggle="modal">here</a>
                        or use our 
    		            <a style="text-decoration: underline" href="#credentials" role="button" data-toggle="modal">guest credentials</a>
                    </p>
                </div>                   
                            
				<div class="navbar">
					<div class="navbar-inner">
                    	<div class="container">
                        	<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target="#organizebar">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>                           
                            <button class="btn btn-inverse mobile pull-right" href="#newPost" data-toggle="modal">New Post</button>
                            <button class="btn btn-inverse tablet pull-right" href="#newPost" data-toggle="modal">New Post</button>
                            <div id="organizebar" class="nav-collapse collapse">
                            	<section id="options" class="clearfix desktop">
                                	<ul class="option-set clearfix nav" data-option-key="filter" id="filter">
										<li><span class="brand">Filter:</span></li>
                                    	<li class="divider-vertical"></li>
										<li class="tab active"><a href="#none" data-option-value="*">show all</a></li>
										<li class="tab"><a href="#artanddesign" data-option-value=".artanddesign">by art & design</a></li>
                                        <li class="tab"><a href="#education" data-option-value=".education">by education</a></li>
										<li class="tab"><a href="#environment" data-option-value=".environment">by environment</a></li>
										<li class="tab"><a href="#other" data-option-value=".other">by other</a></li>
                                    </ul>    
                                    <span class="nav pull-right">
	                                    <a class="btn btn-inverse" href="#newPost" data-toggle="modal">New Post</a>
                                    </span>  
								</section>
                               	<section id="options" class="clearfix desktop">
                                	<ul class="option-set clearfix nav" data-option-key="sortBy" id="sort">
										<li><span class="brand desktop" style="padding-right: 27px">Sort:</span></li>
                                		<li class="divider-vertical"></li>
										<li class="tab active"><a href="#none" data-option-value="original-order">by date</a></li>
										<li class="tab"><a href="#popularity" data-option-value="popularity">by popularity</a></li>
                                        <li class="tab"><a href="#upvotes" data-option-value="upvotes">by upvotes</a></li>
										<li class="tab"><a href="#downvotes" data-option-value="downvotes">by downvotes</a></li>
										<li class="tab"><a href="#netvotes" data-option-value="netvotes">by net votes</a></li>
                                        <li class="tab"><a href="#totalvotes" data-option-value="totalvotes">by total votes</a></li>
                                    </ul>  
								</section>
                            	<section id="options" class="clearfix mobile tablet">
									<ul class="nav">
                                    	<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="filtering">Filter <span class="filter-selected pull-right">show all <b class="caret"></b></span></a>
											<ul class="option-set clearfix dropdown-menu" data-option-key="filter" id="filter">
												<li class="tab active"><a href="#show-all" data-option-value="*">show all</a></li>
											    <li class="tab"><a href="#artanddesign" data-option-value=".artanddesign">by art & design</a></li>
								    			<li class="tab"><a href="#education" data-option-value=".education">by education</a></li>
											    <li class="tab"><a href="#environment" data-option-value=".environment">by environment</a></li>
                                                <li class="tab"><a href="#other" data-option-value=".other">by other</a></li>    
											</ul>
										</li>
                                        <li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="sorting">Sort <span class="sort-selected pull-right">by date <b class="caret"></b></span></a>
											<ul class="option-set clearfix dropdown-menu" data-option-key="sortBy" id="sort">
												<li class="tab active"><a href="#none" data-option-value="original-order">by date</a></li>
												<li class="tab"><a href="#popularity" data-option-value="popularity">by popularity</a></li>
                                        		<li class="tab"><a href="#upvotes" data-option-value="upvotes">by upvotes</a></li>
												<li class="tab"><a href="#downvotes" data-option-value="downvotes">by downvotes</a></li>
												<li class="tab"><a href="#netvotes" data-option-value="netvotes">by net votes</a></li>
                                        		<li class="tab"><a href="#totalvotes" data-option-value="totalvotes">by total votes</a></li> 
											</ul>
										</li>
									</ul>            
                                </section>
							</div>
						</div>
					</div>
				</div>
				
				<div id="container" class="super-list variable-sizes clearfix" style="padding: 0px; margin: 0px">
					<?php
							//Get bricks from the database.
							$sql = "SELECT brick_id, subject, upvotes, downvotes, category, timestamp, signature, owner FROM bricks ORDER BY timestamp";
							$result = mysql_query($sql);
							while($row = mysql_fetch_array($result, MYSQL_ASSOC))
							{
								//Set the default timezone
								date_default_timezone_set('America/New_York');
						
								//Get the brick date
								$brick_date = strtotime($row['timestamp']);
																	
								//Get the time since the brick date
								$time_since = time() - $brick_date;
								
								$netvotes = $row['upvotes'] - $row['downvotes'];
								$totalvotes = $row['upvotes'] + $row['downvotes'];
								
								//Cancel out hidden possible division by zero when post is first made.
								     if($time_since>1){$popularity = ($totalvotes/($time_since/604800));}
								else if($time_since<1){$time_since = $time_since + 1; $totalvotes/($time_since/604800);}
												
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
								$brick_css = rand(1, 20);
								
								echo "	<div class=\"brick color".$brick_css." ".$row['category']." post\" id=\"brick_{$row['brick_id']}\">";
								
								echo "	<div class=\"brick_content\">
											{$row['subject']}
										</div>
										<div class=\"brick_timestamp\">
											Added $time_since $time_unit ago
											<i class=\"icon-time icon-white\" title=\"Added on $brick_date_formatted\"></i>													
										</div>
										<div class=\"brick_hidden\">
											<span class=\"popularity\">
												$popularity
											</span>
											<span class=\"upvotes\">
												{$row['upvotes']}
											</span>
											<span class=\"downvotes\">
												{$row['downvotes']}
											</span>
											<span class=\"netvotes\">
												$netvotes
											</span>
											<span class=\"totalvotes\">
												$totalvotes
											</span>
										</div>
											
									";
								
								echo "</div>";								
							}							
					?>
				</div> 
			</section>
		</div>
		<script src="account/js/authorize.js"></script>
		<script src="account/js/signin.js"></script>
		<script src="account/js/signup.js"></script>		
		<script src="js/brick-expand.js"></script>
		<script src="js/post.js"></script>
        <script src="js/tab-highlight.js"></script>
        <script src="js/vote.js"></script>		
        <script>
			$(function()
			{
				var $container = $('#container');
					
				$container.isotope(
				{
					masonry: {columnWidth: 194},
					sortBy: 'number',
					cornerStampSelector: '.corner-stamp',
					sortAscending : false,
					getSortData: 
					{
						popularity: function( $elem ) 
						{
							var popularity = $elem.hasClass('brick')?$elem.find('.popularity').text():$elem.attr('data-number');
							return parseInt(popularity, 10);
						},
						upvotes: function( $elem ) 
						{
							var upvotes = $elem.hasClass('brick')?$elem.find('.upvotes').text():$elem.attr('data-number');
							return parseInt(upvotes, 10);
						},
						downvotes: function( $elem ) 
						{
							var downvotes = $elem.hasClass('brick')?$elem.find('.downvotes').text():$elem.attr('data-number');
							return parseInt(downvotes, 10);
						},
						netvotes: function( $elem ) 
						{
							var netvotes = $elem.hasClass('brick')?$elem.find('.net').text():$elem.attr('data-number');
							return parseInt(netvotes, 10);
						},
						totalvotes: function( $elem ) 
						{
							var totalvotes = $elem.hasClass('brick')?$elem.find('.totalvotes').text():$elem.attr('data-number');
							return parseInt(totalvotes, 10);
						}
					}
				});
						
				var $optionSets = $('#options .option-set'), $optionLinks = $optionSets.find('a');

				$optionLinks.click(function()
				{
					var $this = $(this);

					// don't proceed if already selected
					if($this.hasClass('selected')){return false;}
			
					var $optionSet = $this.parents('.option-set');
					$optionSet.find('.selected').removeClass('selected');
					$this.addClass('selected');
	  
					// make option object dynamically, i.e. { filter: '.my-filter-class' }
					var options = {}, key = $optionSet.attr('data-option-key'), value = $this.attr('data-option-value');

					// parse 'false' as false boolean
					value = value === 'false' ? false : value;

					options[ key ] = value;
			
					if(key==='layoutMode' && typeof changeLayoutMode ==='function') 
					{
						// changes in layout modes need extra logic
						changeLayoutMode( $this, options )
					} 
					else 
					{
						// otherwise, apply new options
						$container.isotope( options );
					}
			
					return false;
				});
			});
		</script>		
        <!-- Analytics -->
        <script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-61605716-1', 'auto'); ga('send', 'pageview');</script>
	</body>
</html>