
$(function(){

	/* semantic */
	//$('.ui.dropdown').dropdown();



	/* nav */
	//$('#mnav a, #fot a').each(function(){
	//	if(this.href==window.location.href.split("#")[0]){$(this).addClass("active");}
	//});
	//$('#mnav .ui.dropdown a.active').parents(".ui.dropdown").addClass("active");



	$(window).on('scroll', function(e){

		var $offset = window.pageYOffset || $(window).scrollTop()
		var $btt = $("#backtotop"), $toshow;
		$toshow = 100;
		if( $offset > $toshow){ $btt.addClass("tada"); }
		else { $btt.removeClass("tada"); }

	});

	$('#backtotop').click(function(){ $('html, body').animate({scrollTop:0},'normal'); });



	/* landing */
	$('.masthead').visibility({
		once: false,
		onBottomPassed: function(){
			$('.fixed.menu').transition('fade in');
		},
		onBottomPassedReverse: function(){
			$('.fixed.menu').transition('fade out');
		}
	});

	// create sidebar and attach to menu open
	$('.ui.sidebar').sidebar('attach events', '.toc.item');


});

