jQuery(document).ready(function(){
	var $ = jQuery;

	//smooth scroll to anchors only desktop and not backend
	/*
	if ( !o3_is_device_mobile() ) {
		$('a[href*="/#"]').click(function() {
			if ( location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {
				var target = this.hash == '' ? $('body') : $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});
	};
	*/

	//navigation
  	var offsetArray = [],
	  	offsetValueArray = [],
	  	_document = $(document),
	  	currHash = '',
	  	isAnim = false;

  	function getPageOffset(){
		offsetArray = [];
		offsetValueArray = [];

		//add page top
		var _item = new Object();
			_item.hashVal = "#";
			_item.offsetVal = 0;
			offsetArray.push(_item);
			offsetValueArray.push(_item.offsetVal);

		jQuery('.hash-anchor').each(function(){
			var _item = new Object();
			_item.hashVal = "#"+jQuery(this).attr('id');
			_item.offsetVal = jQuery(this).offset().top;
			offsetArray.push(_item);
			offsetValueArray.push(_item.offsetVal);
		});
	};
	getPageOffset();

	function offsetListener(scrollTopValue, anim){
		scrolledValue = scrollTopValue;
		var nearIndex = 0;

		nearIndex = findNearIndex(offsetValueArray, scrolledValue);
		currHash = offsetArray[nearIndex].hashVal;
		currHash = currHash == '#' ? '' : currHash; 

		var winHash = window.location.hash;
		winHash = winHash == '#' ? '' : winHash; 

		if ( winHash != currHash ) {
			if ( anim && !o3_is_device_mobile() ) {
				isAnim = true;
				$('html, body').stop().animate( { 'scrollTop': scrolledValue }, 600, function(){
					isAnim = false;
					window.location.hash = currHash;
					$('html, body').stop().animate( { 'scrollTop': scrolledValue }, 0 );
					return false;
				});
			} else {
				window.location.hash = currHash;
				$('html, body').stop().animate( { 'scrollTop': scrolledValue }, 0 );
				return false;
			};
		};
	};

	function findNearIndex(array, targetNumber){
		var currDelta,
			nearDelta,
			nearIndex = -1,	
			i = array.length;

		while (i--){
			currDelta = Math.abs( targetNumber - array[i] );
			if( nearIndex < 0 || currDelta < nearDelta ) {
				nearIndex = i;
				nearDelta = currDelta;
			};
		};
		return nearIndex;
	};

	$(window).on('mousedown',function(){
		isAnim = true;
	});
	$(window).on('mouseup',function(){
		isAnim = false;
		offsetListener(_document.scrollTop(), false);
	});
	$(document).on('mousewheel',function() {
		offsetListener(_document.scrollTop(), false, false);
	});
	$(document).on('scroll',function() {
		
		scrolledValue = _document.scrollTop();
		var nearIndex = 0;
		nearIndex = findNearIndex(offsetValueArray, scrolledValue);
		
		currHash = offsetArray[nearIndex].hashVal;
		currHash = currHash == '' ? '#' : currHash; 
		
		$('.anchors, .rd-mobilemenu_ul, .rd-mobilepanel_title').find('.active').removeClass('active');

		var $link = $('.anchors, .rd-mobilemenu_ul, .rd-mobilepanel_title').find('a[href="' + currHash + '"], a[href="/' + currHash + '"]'),
			link = o3_url_info( $link.attr('href') );
		if ( window.location.pathname == link.path )
			$link.addClass('active');

	});
	$(window).on('resize', function(){
		getPageOffset();
	});	
	$(window).on('hashchange', function() {
		var target = window.location.hash ? window.location.hash : offsetArray[0].hashVal;
		$('.anchors, .rd-mobilemenu_ul, .rd-mobilepanel_title').find('.active').removeClass('active');
		var $link = $('.anchors, .rd-mobilemenu_ul, .rd-mobilepanel_title').find('a[href="' + target + '"], a[href="/' + target + '"]'),
			link = o3_url_info( $link.attr('href') );
		if ( window.location.pathname == link.path )
			$link.addClass('active');
	}).trigger('hashchange');

	//add clicks
	$('.anchors, .rd-mobilemenu_ul, .rd-mobilepanel_title').find('a').each(function(){
		$(this).click(function(e){
			if ( location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {				
				e.preventDefault();

				var target = this.hash;

				offsetListener( target == '' ? 0 : $(target).offset().top, true);

				return false;
			};
		});
	});

});