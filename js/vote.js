$(function() 	{	var popupModal = $('#popup'),
							popupSubject = $('#popupSubject'), 
							popupBody = $('#popupBody');								
						

					$('i.upvote').click(function(e)
					{
						var id = $(this).parent().attr('id');
						
						popupSubject.html("You voted up!");
						popupBody.html("The brick you voted on had the brick_id: " + id);				
						popupModal.modal('show');														
					});
		
					$('i.downvote').click(function(e)
					{
						var id = $(this).parent().attr('id');
						
						popupSubject.html("You voted down!");
						popupBody.html("The brick you voted on had the brick_id: " + id);				
						popupModal.modal('show');
					});			
				}
);