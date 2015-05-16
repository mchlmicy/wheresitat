$(function() 	{	var popupModal = $('#popup'),
							popupSubject = $('#popupSubject'), 
							popupBody = $('#popupBody'),
						email, password, source, form;

					//If signin submitted from desktop form
					$('button#signin_desktop').click(function(e) 
					{       
						//Prevent devault behavior
					    e.preventDefault();
						
						//Set field variable ids
						email 	 = $('#signin_email_desktop');
						password = $('#signin_password_desktop');
						source 	 = $('#signin_source_desktop');
											
						//Submit desktop form data
						signin_ajax("desktop");												
				    });  
					
					//If signin submitted from mobile form
					$('button#signin_mobile').click(function(e) 
					{       
						//Prevent devault behavior
					    e.preventDefault();
						
						//Set field variable ids
						email 	 = $('#signin_email_mobile');
						password = $('#signin_password_mobile'); 
						source 	 = $('#signin_source_mobile');
											
						//Submit mobile form data
						signin_ajax("mobile");												
				    });
					
					//If signin submitted from tablet form
					$('button#signin_tablet').click(function(e) 
					{       
						//Prevent devault behavior
					    e.preventDefault();
						
						//Set field variable ids
						email 	 = $('#signin_email_tablet');
						password = $('#signin_password_tablet');
						source 	 = $('#signin_source_tablet');
						
						//Submit tablet form data
						signin_ajax("tablet");																	
				    });
					
					//Send data to Ajax (PHP) for error checking
					function signin_ajax(formtype)
					{								
							 if(formtype=="desktop"){ 	form = $('form#signin_dialog-form_desktop');}
						else if(formtype=="mobile") { 	form = $('form#signin_dialog-form_mobile');}
						else if(formtype=="tablet") {	form = $('form#signin_dialog-form_tablet');}
						
						if(source.val()=="primary")
						{
							$.ajax({
								type: 'POST',
								url: 'account/signin.php',
								dataType: 'json',
								data: form.serialize(),
								success: 	function (json)
											{
												//If errors returned...
												if(json.error!=null)
												{
													//Display errors and error locations
													signinerror(json.error, json.location);
												}
												//If no errors returned...						
												else if(json.error==null)
												{	
													//Refresh page to show user signed in
													location.reload();
												}				
											}
							});
						}
						else if(source.val()=="secondary")
						{
							$.ajax({
								type: 'POST',
								url: '../account/signin.php',
								dataType: 'json',
								data: $('form#signin_dialog-form').serialize(),
								success: 	function (json)
											{
												//If errors returned...
												if(json.error!=null)
												{
													//Display errors and error locations
													signinerror(json.error, json.location);
												}
												//If no errors returned...						
												else if(json.error==null)
												{	
													//Refresh page to show user signed in
													location.reload();
												}				
											}
							});
						}
					}
					
					//Display errors  
					function signinerror(tip, location) 
					{
						if(tip!=null)
						{
							popupSubject.html("Signin Error");
							popupBody.html(tip);				
							popupModal.modal('show');								
						}						
					}	
					
				}
);