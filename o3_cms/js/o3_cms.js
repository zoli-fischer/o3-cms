/*
* O3 CMS scripts
*/

//Ajax call served for everyone
function o3_cms_ajax_call( name, data, success, error, fails ) {
	//send ajax request
	return o3_ajax_call( window.location, jQuery.extend( { o3_cms_template_ajax: 'public', 'o3_cms_template_ajax_name': name }, data ), success, error, fails );
};

//Ajax call served only for logged user
function o3_cms_user_ajax_call( name, data, success, error, fails ) {
	//send ajax request
	return o3_cms_ajax_call( name, jQuery.extend( { o3_cms_template_ajax: 'private' }, data ), success, error, fails );
};

//todo move under o3
+function ($) {
	'use strict';

	// OPEN DATA-API
	// =================

	function getTargetFromTrigger($trigger) {
		var href;
		var target = $trigger.attr('data-o3-cms-target') 
					|| (href = $trigger.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, ''); // strip for ie7

		return $(target);
	};

	function show($element) {
		var $target = getTargetFromTrigger($element);

		$element.addClass('open');
    	$target.addClass('open');
    	$element.attr('o3-cms-aria-opened','true');    	
	};

	function hide($element) {
		var $target = getTargetFromTrigger($element);

		$element.removeClass('open');
		$target.removeClass('open');
		$element.attr('o3-cms-aria-opened','false');
	};

	function toggle($element) {
		if ( $element.hasClass('open') ) {
			hide($element);
			$(document).off('mouseup touchend',mouseup);
			jQuery("#o3-cms-frame iframe").contents().find('body').off('mouseup touchend',mouseup);
		} else {    	
			show($element);
			$(document).on('mouseup touchend',mouseup);
			jQuery("#o3-cms-frame iframe").contents().find('body').on('mouseup touchend',mouseup);
		};
	};

	function mouseup(e){
		var $elements = $('[o3-cms-aria-opened="true"]');
		$elements.each(function(){
			var $this = $(this),  			
				etarget = e.target,
				target = getTargetFromTrigger($this)[0],
				inTarget = false;
 
			if ( etarget == $this[0] || etarget == target  )
				inTarget = true;

			if ( !inTarget ) {
				while ( etarget = etarget.parentNode )
					if ( etarget == $this[0] || etarget == target )			
						inTarget = true;
			}
	 
			if ( !inTarget )
				hide($this);  		

		}); 
	}

	$(document).on('click', '[data-o3-cms-toggle="open"]', function (e) {
		var $this = $(this);
			
		if (!$this.attr('data-o3-cms-target')) 
			e.preventDefault();

		toggle($this);

	});


}(jQuery);