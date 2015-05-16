$(function() 	{	var	subject = $('#newPost_subject'), 
						content = $('#newPost_content'),
						category = $('select#newPost_category'),
						signature = $('select#newPost_signature'),
						photo = $('#newPost_photo'),
						image,
						preview = $('#preview .photo_preview'),
						photo_error = $('#preview .photo_error'),
						allFields = $([]).add(subject).add(content).add(category).add(signature), 
						tips = $('#newPost_validateTips');
					
					photo.change(function()
					{
						photo.parent().parent().removeClass('error');
						
						if(this.files.length) 
						{
        					for(var i in this.files) 
							{
					            var src = (window.URL) ? window.URL.createObjectURL(this.files[i]) : window.webkitURL.createObjectURL(this.files[i]);
					            image = new Image();
					            image.src = src;
								
								var photo_name = photo.val().split(/(\\|\/)/g).pop();
								var extension  = photo_name.substr((photo_name.lastIndexOf('.')+ 1));
								
								if(extension=="bmp" || extension=="gif" || extension=="jpg" || extension=="png" || extension=="tif")
								{	photo.parent().parent().removeClass('text-error');
									photo_error.css({display: 'none'});
									preview.attr("src", src);								
								}
								else
								{	preview.attr("src", null);
									photo.parent().parent().addClass('text-error');
									photo_error.html("." + extension + " files not supported");									
									photo_error.css({display: 'inherit'});
								}
           					}
					    }						
					});

					//Post on button click
					$('button#newPost').click(function() 
					{   
						//Clear errors 
						allFields.parent().parent().removeClass('error');
																		
						//Submit form data
						post_ajax();					
				    });
					
					//Clear fields on close
					$('button#newPost_close').click(function() 
					{      
						//Clear validate tips
						tips.text('');
					
						//Clear errors 
						allFields.parent().parent().removeClass('error');
						
						//Clear photo preview errors
						photo_error.css({display: 'none'});	
						
						//Clear photo preview
						preview.attr('src', null);
						
						//Clear photo input
						photo.val('');
						
						photo.parent().parent().removeClass('text-error');
						
						//Clear values
						allFields.val('');							
				    });  
					
					//Send data to Ajax (PHP) for error checking
					function post_ajax()
					{
						$.ajax({
							type: 'POST',
							url: 'php/post.php',
							dataType: 'json',
							data: $('#newPost_dialog-form').serialize(),
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
												//Refresh page to show user signed in
												location.reload();
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
							subject.parent().parent().addClass('error');						
						}	
						//If content input has error...
						if(jQuery.inArray('content',location)!=-1)
						{
							content.parent().parent().addClass('error');						
						}	
						//If category input has error...
						if(jQuery.inArray('category',location)!=-1)
						{
							category.parent().parent().addClass('error');						
						}	
						//If signature input has error...
						if(jQuery.inArray('signature',location)!=-1)
						{
							signature.parent().parent().addClass('error');						
						}	
					}
				}
);