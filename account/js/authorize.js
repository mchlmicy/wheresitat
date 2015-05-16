$(function() 	{	var	container = $('div#authorize'), 
						email = $('#authorize_email'), 
						password = $('#authorize_password'), 
						allFields = $([]).add(email).add(password), 
						tips = $('#authorize_validateTips');

					//Submit form data on authorize button click
					$('button#authorize').click(function(e) 
					{       
						//Clear errors 
						allFields.parent().parent().removeClass('error');
						
						//Submit form data
						authorize_ajax();						
				    });  
					
					//Submit form data on enter button strike in email field
					$('input#authorize_email').keypress(function(event) 
					{
						if(event.which==13) 
						{
							//Prevent devault behavior
					        event.preventDefault();
						
							//Clear errors 
							allFields.parent().parent().removeClass('error');
						
							//Submit form data
							authorize_ajax();
						}
					});
					
					//Submit form data on enter button strike in password field
					$('input#authorize_password').keypress(function(event) 
					{
						if(event.which==13) 
						{
							//Prevent devault behavior
					        event.preventDefault();
						
							//Clear errors 
							allFields.parent().parent().removeClass('error');
						
							//Submit form data
							authorize_ajax();
						}
					});
					
					//Send data to Ajax (PHP) for error checking
					function authorize_ajax()
					{
						$.ajax({
							type: 'POST',
							url: 'account/authorize.php',
							dataType: 'json',
							data: $('form#authorize_dialog-form').serialize(),
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
												//Prompt user about authorization complete
												tips.text("User authorization complete");
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
						//If email input has error...
						if(jQuery.inArray('email',location)!=-1)
						{
							email.parent().parent().addClass('error');						
						}
						//If password input has error...
						if(jQuery.inArray('password',location)!=-1)
						{
							password.parent().parent().addClass('error');

						}
					}
					
				}
);