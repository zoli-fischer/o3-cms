jQuery(document).ready(function(){	

	//if current window is not top window set location to top window
	if ( window.parent != window ) {
		window.parent.location = window.location;		
	} else {
		//init global app
		ko.applyBindings( window.o3_cms = new o3CMSAdminApp(), jQuery('html')[0] );

		//show only after app loaded
		jQuery('body').addClass('visible');
	};

});