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

    //init global app
	ko.applyBindings( window.snafer = new snaferPageApp(), jQuery('html')[0] );

});

//show sign in form
function show_sign_in_form() {
	if ( typeof window.snafer != 'undefined' )
		window.snafer.sign_in_up.show_sign_in_form();
};

//show sign up form
function show_sign_up_form() {
	if ( typeof window.snafer != 'undefined' )
		window.snafer.sign_in_up.show_sign_up_form();
};

//scroll to top
function scrollTop() {
	jQuery("html, body").scrollTop(0);
};