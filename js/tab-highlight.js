$(function() 	{	var desktopfilter			= $('#filter.option-set.nav li'),
						desktopsort		 		= $('#sort.option-set.nav li'),
						mobilefilter			= $('#filter.option-set.dropdown-menu li'),
						mobilefilterselected	= $('.filter-selected'),
						mobilesort	 			= $('#sort.option-set.dropdown-menu li'),						
						mobilesortselected		= $('.sort-selected'),
						tabfilter				= $('#filter.option-set li a'),
						tabsort					= $('#sort.option-set li a');

					tabfilter.click(function(e) 
					{
						var selection = $(this).attr('href');
						
						desktopfilter.removeClass('active');
						desktopfilter.find('[href='+selection+']').parent().addClass('active');											
						
						mobilefilter.removeClass('active');
						mobilefilter.find('[href='+selection+']').parent().addClass('active');
						mobilefilterselected.html($(this).html() + "<b class=\"caret\"></b>");
					});	
										
					tabsort.click(function(e) 
					{
						var selection = $(this).attr('href');
						
						desktopsort.removeClass('active');
						desktopsort.find('[href='+selection+']').parent().addClass('active');											
						
						mobilesort.removeClass('active');
						mobilesort.find('[href='+selection+']').parent().addClass('active');
						mobilesortselected.html($(this).html() + "<b class=\"caret\"></b>");
					});										
				}
);