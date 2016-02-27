jQuery(document).ready(function(){
		
	//todo only test
	jQuery("#o3-cms-frame iframe").load(function() {
		document.title = jQuery(this)[0].contentWindow.document.title;
	});
	jQuery("#o3-cms-frame iframe").attr('src',window.location+'?o3_cms_ignore_admin');

	jQuery("button").click(function(){
		if ( jQuery("body").hasClass('o3-cms-show-left-menu') ) {
			jQuery("body").removeClass('o3-cms-show-left-menu');
		} else {
			jQuery("body").addClass('o3-cms-show-left-menu');
		}

	});

});