$(function() 	{	var modal 		=	$('#brickexpanded'),
						subject 	=	$('#brickexpanded .brick_subject	.content'),
						content 	=	$('#brickexpanded .brick_content'),
						upvotes 	=	$('#brickexpanded .brick_stats		.upvotes'),
						downvotes 	= 	$('#brickexpanded .brick_stats		.downvotes'),
						netvotes 	=	$('#brickexpanded .brick_stats		.netvotes'),
						voting	 	=	$('#brickexpanded .brick_stats	 	.voting'),
						timesince 	= 	$('#brickexpanded .brick_timestamp	.timesince'),
						dateposted 	= 	$('#brickexpanded .brick_timestamp	.dateposted'),
						signature 	= 	$('#brickexpanded .brick_timestamp	.signature'),
						ownerlink 	= 	$('#brickexpanded .brick_timestamp	.ownerlink');
					
					
					//Get brick data on brick expand click
					$('.brick.post').click(function(e) 
					{       
						//Prevent devault behavior
					    e.preventDefault();
					
						//Get the id of the brick
						var brick_id = $(this).attr('id');
						var brick_id_formatted = brick_id.replace("brick_", "");
						
						//Get the classes of the brick
						var brick_classes = $('div#' + brick_id).attr('class').split(" ");
																		
						brickexpand_ajax(brick_id_formatted, brick_classes);						
				    });
								
					//Send data to Ajax (PHP)
					function brickexpand_ajax(brick_id_formatted, brick_classes)
					{
						$.ajax({
								type: 'POST',
								url: 'php/brickexpand.php',
								dataType: 'json',
								data: 'brick_id='+brick_id_formatted,
								success: 	function(json)
											{
												writeModal(json, brick_id_formatted);
												styleModal(brick_classes);													
											}
						});
						
					}	
					
					function writeModal(json, brick_id_formatted) 
					{
						subject.html(json.brick_subject);				
						content.html(json.brick_content);
						upvotes.html("upvotes: " + json.brick_upvotes);
						downvotes.html("downvotes: " + json.brick_downvotes);
						netvotes.html("net: " + (json.brick_upvotes - json.brick_downvotes));
						voting.attr("id", brick_id_formatted);
						timesince.html("Added " + json.brick_timesince);
						dateposted.attr("title",json.brick_date_formatted);
						signature.html("by " + json.brick_signature);
						ownerlink.attr("href", "users/?profile=" + json.brick_owner);
						ownerlink.attr("title", json.brick_owner);		
						$('#brickexpanded').modal('show');					
					}	
					
					function styleModal(brick_classes)
					{
						for(var x=0; x<=brick_classes.length; x++)
						{
							if(brick_classes[x].indexOf("color")!==-1)
							{
								modal.addClass(brick_classes[x]);
								upvotes.addClass(brick_classes[x]);
								downvotes.addClass(brick_classes[x]);
								netvotes.addClass(brick_classes[x]);
								voting.addClass(brick_classes[x]);
							}
						}	
						
															
					}
					
					
				}
);