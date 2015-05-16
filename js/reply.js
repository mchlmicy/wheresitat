$(function() 	{	var	container = $('div#reply'), 
						recipient =	$('input#reply_recipient'),
						subject =	$('input#reply_subject'), 
						content = 	$('textarea#reply_content'),
						signature = $('select#reply_signature'),
						allFields = $([]).add(subject).add(content).add(signature), 
						tips = 		$('#reply_validateTips');

					$('.message .reply').click(function() 
					{      
						recipient.val($(this).attr('id'));					
				    });  

					//Open modal on button click
					$('button#reply').click(function() 
					{      
						//Clear errors 
						allFields.removeClass('error');
																		
						//Submit form data
						reply_ajax();						
				    });  
					
					//Send data to Ajax (PHP) for error checking
					function reply_ajax()
					{
						$.ajax({
							type: 'POST',
							url: '../php/reply.php',
							dataType: 'json',
							data: $('#reply_dialog-form').serialize(),
							success: 	function (json)
										{
											//If errors returned...
											if(json.error!=null)
											{
												//Display errors and error locations
												updateTips(json.error, json.location);
											}	
											else
											{
												container.modal('hide');
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
						//If subject input has error...
						if(jQuery.inArray('subject',location)!=-1)
						{
							subject.parent().parent().parent().parent().parent().addClass('error');						
						}	
						//If content input has error...
						if(jQuery.inArray('content',location)!=-1)
						{
							content.parent().parent().parent().parent().parent().addClass('error');						
						}	
						//If category input has error...
						if(jQuery.inArray('category',location)!=-1)
						{
							category.parent().parent().parent().parent().parent().addClass('error');						
						}	
						//If signature input has error...
						if(jQuery.inArray('signature',location)!=-1)
						{
							signature.parent().parent().parent().parent().parent().addClass('error');						
						}	
					}
				}
);