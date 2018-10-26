
$(function(){

	$('.masthead').visibility({
		once: false,
		onBottomPassed: function(){ $('.fixed.menu').transition('fade in'); },
		onBottomPassedReverse: function(){ $('.fixed.menu').transition('fade out'); }
	});

	$('.ui.sidebar').sidebar('attach events', '.toc.item');

	$('#mnav a, #xnav a, #snav a, #fot a').each(function(){
		if(this.href==window.location.href.split("#")[0]){$(this).addClass("active");}
	});

	$(window).on('scroll', function(e){

		var $offset = window.pageYOffset || $(window).scrollTop()
		var $btt = $("#backtotop"), $toshow;
		$toshow = 100;
		if( $offset > $toshow){ $btt.addClass("tada"); }
		else { $btt.removeClass("tada"); }

	});

	$('#backtotop').click(function(){ $('html, body').animate({scrollTop:0},'normal'); });






});

