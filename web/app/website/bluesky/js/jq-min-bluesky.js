
/* tgomilar.github.io/paroller.js/ */
!function(r){"use strict";"function"==typeof define&&define.amd?define("parollerjs",["jquery"],r):"object"==typeof module&&"object"==typeof module.exports?module.exports=r(require("jquery")):r(jQuery)}(function(m){"use strict";var g=!1,w=function(){g=!1},v=function(r,t){return r.css({"background-position":"center "+-t+"px"})},x=function(r,t){return r.css({"background-position":-t+"px center"})},b=function(r,t,o){return"none"!==o||(o=""),r.css({"-webkit-transform":"translateY("+t+"px)"+o,"-moz-transform":"translateY("+t+"px)"+o,transform:"translateY("+t+"px)"+o,transition:"transform linear","will-change":"transform"})},k=function(r,t,o){return"none"!==o||(o=""),r.css({"-webkit-transform":"translateX("+t+"px)"+o,"-moz-transform":"translateX("+t+"px)"+o,transform:"translateX("+t+"px)"+o,transition:"transform linear","will-change":"transform"})},y=function(r,t,o){var n=r.data("paroller-factor"),a=n||o.factor;if(t<576){var e=r.data("paroller-factor-xs"),i=e||o.factorXs;return i||a}if(t<=768){var c=r.data("paroller-factor-sm"),f=c||o.factorSm;return f||a}if(t<=1024){var u=r.data("paroller-factor-md"),s=u||o.factorMd;return s||a}if(t<=1200){var l=r.data("paroller-factor-lg"),d=l||o.factorLg;return d||a}if(t<=1920){var p=r.data("paroller-factor-xl"),h=p||o.factorXl;return h||a}return a},z=function(r,t){return Math.round(r*t)},M=function(r,t,o,n){return Math.round((r-o/2+n)*t)},X=function(r){return r.css({"background-position":"unset"})},j=function(r){return r.css({transform:"unset",transition:"unset"})};m.fn.paroller=function(d){var p=m(window).height(),h=m(document).height();d=m.extend({factor:0,factorXs:0,factorSm:0,factorMd:0,factorLg:0,factorXl:0,type:"background",direction:"vertical"},d);return this.each(function(){var t=m(this),o=m(window).width(),n=t.offset().top,a=t.outerHeight(),r=t.data("paroller-type"),e=t.data("paroller-direction"),i=t.css("transform"),c=r||d.type,f=e||d.direction,u=y(t,o,d),s=z(n,u),l=M(n,u,p,a);"background"===c?"vertical"===f?v(t,s):"horizontal"===f&&x(t,s):"foreground"===c&&("vertical"===f?b(t,l,i):"horizontal"===f&&k(t,l,i)),m(window).on("resize",function(){var r=m(this).scrollTop();o=m(window).width(),n=t.offset().top,a=t.outerHeight(),u=y(t,o,d),s=Math.round(n*u),l=Math.round((n-p/2+a)*u),g||(window.requestAnimationFrame(w),g=!0),"background"===c?(X(t),"vertical"===f?v(t,s):"horizontal"===f&&x(t,s)):"foreground"===c&&r<=h&&(j(t),"vertical"===f?b(t,l):"horizontal"===f&&k(t,l))}),m(window).on("scroll",function(){var r=m(this).scrollTop();h=m(document).height(),s=Math.round((n-r)*u),l=Math.round((n-p/2+a-r)*u),g||(window.requestAnimationFrame(w),g=!0),"background"===c?"vertical"===f?v(t,s):"horizontal"===f&&x(t,s):"foreground"===c&&r<=h&&("vertical"===f?b(t,l,i):"horizontal"===f&&k(t,l,i))})})}});













$(function(){

	/* semanticsUI general */
	$('.ui.checkbox').checkbox();
	//$('.shape').shape();

	$('.special .image, .special.card .image, .special.cards .image').dimmer({ on:'hover' });
	$('.dopop').click(function(){ $('.ui.modal.dapop').modal('show'); });
	//$('.shapefr').on('click',function(){ $('.shape').shape('flip right'); });

	$('img.ui.image, .ui.image img, .card .image img').visibility({ type: 'image', transition: 'fade in', duration: 2000 });

	$('.ui.dropdown:not(#casefil)').dropdown();
	$('#casefil.ui.dropdown').dropdown({
		onChange:function(val){

			$("#casecon .card").hide();

			if (val == "Start-up Development"){ $("#casecon .card.f_start-updevelopment").show(); }
			else if (val == "System Integration"){ $("#casecon .card.f_systemintegration").show(); }
			else if (val == "App Development"){ $("#casecon .card.f_appdevelopment").show(); }
			else if (val == "Data Science"){ $("#casecon .card.f_datascience").show(); }
			else if (val == "Custom Web Applications"){ $("#casecon .card.f_customwebapplications").show(); }
			else if (val == "Exploring Ideas"){ $("#casecon .card.f_exploringideas").show(); }
			else { $("#casecon .card").show(); }

		}
	});
	$('.casestudies.ui.button').on('click',function(){ $('.ui.dropdown').dropdown('restore defaults') });

	$('.ui.steps.brief .step').tab();





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



	$('.cloud').paroller();



});

