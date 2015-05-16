$(function() 	{	var	container = $('div#signup'), 
						firstname = $('#signup_firstname'), 
						lastname = $('#signup_lastname'),
						email = $('#signup_email'), 
						username = $('#signup_username'),
						password = $('#signup_password'), 
						privacy = $('signup_privacy'),
						allFields = $([]).add(firstname).add(lastname).add(email).add(username).add(password).add(privacy), 
						tips = $('#signup_validateTips');

					//Submit form data on signin button click
					$('button#signup').click(function(e) 
					{       
						//Clear errors 
						allFields.parent().parent().removeClass('error');
												
						//Submit form data
						signup_ajax();						
				    });  
					
					//Submit form data on enter button strike in firstname field
					$('input#signup_firstname').keypress(function(event) 
					{
						if(event.which==13) 
						{
							//Prevent devault behavior
					        event.preventDefault();
						
							//Clear errors 
							allFields.parent().parent().removeClass('error');
						
							//Submit form data
							signup_ajax();
						}
					});
					
					//Submit form data on enter button strike in lastname field
					$('input#signup_lastname').keypress(function(event) 
					{
						if(event.which==13) 
						{
							//Prevent devault behavior
					        event.preventDefault();
						
							//Clear errors 
							allFields.parent().parent().removeClass('error');
						
							//Submit form data
							signup_ajax();
						}
					});
					
					//Submit form data on enter button strike in email field
					$('input#signup_email').keypress(function(event) 
					{
						if(event.which==13) 
						{
							//Prevent devault behavior
					        event.preventDefault();
						
							//Clear errors 
							allFields.parent().parent().removeClass('error');
						
							//Submit form data
							signup_ajax();
						}
					});
					
					//Submit form data on enter button strike in username field
					$('input#signup_username').keypress(function(event) 
					{
						if(event.which==13) 
						{
							//Prevent devault behavior
					        event.preventDefault();
						
							//Clear errors 
							allFields.parent().parent().removeClass('error');
						
							//Submit form data
							signup_ajax();
						}
					});
					
					//Submit form data on enter button strike in password field
					$('input#signup_password').keypress(function(event) 
					{
						if(event.which==13) 
						{
							//Prevent devault behavior
					        event.preventDefault();
						
							//Clear errors 
							allFields.parent().parent().removeClass('error');
						
							//Submit form data
							signup_ajax();
						}
					});
					
					//Send data to Ajax (PHP) for error checking
					function signup_ajax()
					{
						$.ajax({
							type: 'POST',
							url: 'account/signup.php',
							dataType: 'json',
							data: $('form#signup_dialog-form').serialize(),
							success: 	function (json)
										{
											//If errors returned...
											if(json.error!=null)
											{
												//Display errors and error locations
												updateTips(json.error, json.location);
											}
					
											//If no errors returned...						
											else if(json.error==null)
											{
												//Prompt user to check their email
												tips.text("Check your email for confirmation");
											}					
										}
						});
					}
					
					//Display errors to dialog 
					function updateTips(tip, location) 
					{
						//Show error fields
						revealErrors(location);
						
						//Display errors
						tips.text(tip);				
					}	
					
					//Highlight inputs of errors
					function revealErrors(location)
					{
						//If firstname or lastname input has error...
						if((jQuery.inArray('firstname',location)!=-1)||(jQuery.inArray('lastname',location)!=-1))
						{
							firstname.parent().parent().addClass('error');						
						}						
						//If email or username input has error...
						if((jQuery.inArray('email',location)!=-1)||(jQuery.inArray('username',location)!=-1))
						{
							email.parent().parent().addClass('error');						
						}
						//If password input has error...
						if(jQuery.inArray('password',location)!=-1)
						{
							password.parent().parent().addClass('error');

						}
						//If password input has error...
						if(jQuery.inArray('privacy',location)!=-1)
						{
							privacy.parent().parent().addClass('error');

						}
					}
				}
);