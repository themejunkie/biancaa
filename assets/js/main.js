var $ = jQuery.noConflict();
$(document).ready(function(){

	// Responsive video
	$("#primary").fitVids();
	
	// Superfish + Supersubs
	$('ul.sf-menu').supersubs({
		minWidth:   14,
		maxWidth:   27,
		extraWidth: 1
	}).superfish({
		delay:      50,
		animation:  {opacity:'show', height:'show'},
		speed:      'fast'
	});

});

$(window).load(function() {

	$(document).imagesLoaded(function(){
		
		// Initialize owl carousel
		$(".slides").owlCarousel({
			slideSpeed: 500,
			paginationSpeed: 500,
			singleItem: true,
			paginationNumbers: true,
			autoPlay: 7000,
			stopOnHover: true
		});

		// Destroy superfish on smaller screen.
		if($('body').width() <= 600) {
			$('ul.sf-menu').superfish('destroy');
		}

		// Superfish on resize event.
		$(window).resize(function() {
			if($('body').width() >= 600 && !$('ul.sf-menu').hasClass('sf-js-enabled')) {
				$('ul.sf-menu').superfish('init');
			} else if($('body').width() < 600) {
				$('ul.sf-menu').superfish('destroy');
			}
		});

	});

});