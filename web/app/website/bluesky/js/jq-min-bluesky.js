
$(function(){

	/* semanticsUI general */
	$('.ui.dropdown').dropdown();
	$('.ui.checkbox').checkbox();

	$('.special.card .image, .special.cards .image').dimmer({ on:'hover' });
	$('.dopop').click(function(){ $('.ui.modal.dapop').modal('show'); });



	/* main navigation */
	$('.masthead').visibility({
		once: false,
		onBottomPassed: function(){ $('.fixed.menu').transition('fade in'); },
		onBottomPassedReverse: function(){ $('.fixed.menu').transition('fade out'); }
	});

	$('.ui.sidebar').sidebar('attach events', '.toc.item');

	$('#mnav a, #xnav a, #snav a, #pnav a, #fot a').each(function(){
		if(this.href==window.location.href.split("#")[0]){$(this).addClass("active");}
	});



	/* backtotop */
	$(window).on('scroll', function(e){
		var $offset = window.pageYOffset || $(window).scrollTop()
		var $btt = $("#backtotop"), $toshow;
		$toshow = 100;
		if( $offset > $toshow){ $btt.addClass("tada"); }
		else { $btt.removeClass("tada"); }
	});
	$('#backtotop').click(function(){ $('html, body').animate({scrollTop:0},'normal'); });



	/* casestudies */
	$('.casestudies.ui.button').on('click',function(){ $('.ui.dropdown').dropdown('restore defaults') })




});

