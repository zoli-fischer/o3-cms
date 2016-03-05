jQuery(document).ready(function(){
	var $ = jQuery;

	//smooth scrolling
	/*
	if ( $('body').hasClass('windows') && $('body').hasClass('webkit') ) {
		$.srSmoothscroll({
	        step: 165,
	        speed: 300
	    });
	};
	*/


	//animate on scroll
	if ((navigator.userAgent.toLowerCase().indexOf('msie') == -1 ) || (isIE() && isIE() > 9)) {
        if (!jQuery('body').hasClass('mobile')) {
			new WOW().init();            
        };
    };

});