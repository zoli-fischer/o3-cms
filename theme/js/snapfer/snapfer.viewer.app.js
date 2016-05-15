/*
* Snapfer transfer previewer
*/
function snapferViewerApp( opts ) {
	var self = this,
		$ = jQuery;

	//options
	self.opts = $.extend( {
		parent: null
	}, opts );

	//set parent
	self.parent = function() {
		return self.opts.parent;
	};

	//loading flag
	self.loading = ko.observable( false );

	//width if the viewer container
	self.width = ko.observable( 0 );

	//height if the viewer container
	self.height = ko.observable( 0 );

	//items
	self.items = ko.observableArray();

	//is viewer visible
	self.visible = ko.observable(false);

	//if toggle beween visible and hidden
	self.visible.subscribe(function(){
		self.visible() ? $('html').addClass('no-scroll') : $('html').removeClass('no-scroll');
	});

	//current element
	self.current = ko.observable(-1);

	//get current item
	self.current_item = ko.computed(function() {
		return typeof self.items()[self.current()] != 'undefined' ? self.items()[self.current()] : new snapferViewerItemApp({ parent: self });
	});

	//check if allow to show preview item
	self.allow_next = ko.computed(function() {
		return self.current() + 1 < self.items().length;
	});

	//check if allow to show preview item
	self.allow_prev = ko.computed(function() {
		return self.current() > 0;
	});

	//show next item
	self.next = function() {
		if ( self.allow_next() )
			self.show( self.current() + 1 );	
	};

	//show prev item
	self.prev = function() {
		if ( self.allow_prev() )
			self.show( self.current() - 1 );	
	};

	//show viewer
	//item - or index of element from items or the item it self
	self.show = function( item ){
		//reset zoom
		self.reset_zoom();

		//set current index
		self.current( typeof item == 'object' ? self.items().indexOf(item) : item );		

		//load item
		self.items()[self.current()].load();

		//check if visible
		if ( !self.visible() ) {
			//show viewer
			self.visible( true );

			//get container width/height
			self.update_size();

			//attach keyboard event
			jQuery(window).on('keyup',self.keyup);

			//resize event
			jQuery(window).on('resize',self.resize);
		}
	};

	//hide viewer	
	self.hide = function(  ){
		//hide viewer
		self.visible( false );

		//clear current
		self.current(-1);

		//remove keyboard event
		jQuery(window).off('keyup',self.keyup);

		//resize event
		jQuery(window).off('resize',self.resize);
	};

	//keyup event
	self.keyup = function( event ) {	
		var prevent = true;
		switch ( event.which ) {
			case 37: //left arrow
				self.prev();
				break; 
			case 39: //right arrow
				self.next();
				break; 
			case 38: //up arrow
				if ( self.current_item().is_doc() )
					self.current_item().prev_page();
				break; 
			case 40: //down arrow
				if ( self.current_item().is_doc() )
					self.current_item().next_page();
				break;   	
			case 27: //escape
				//fix for webkit fullscreen video escape
				if ( !( self.current_item().is_video() && typeof document.webkitFullscreenElement != 'undefined' ) )
					self.hide();				
				break;   	
			default:
				prevent = false;
				break;
		}

		if ( prevent )
			event.preventDefault();
	};

	//resize event
	self.resize = function() {
		self.update_size();
	};

	//get container width/height
	self.update_size = function() {
		if ( self.width() != $('#transfer-viewer .body').width() )
			self.width( $('#transfer-viewer .body').width() );
		if ( self.height() != $('#transfer-viewer .body').height() )
			self.height( $('#transfer-viewer .body').height() );		
	};

	//get current image bg size
	self.image_bg_size = ko.computed(function() {
		return ( self.current_item().is_image() || self.current_item().is_doc() ) && self.current_item().loaded() && ( self.current_item().width() > self.width() || self.current_item().height() > self.height() ) ? 'contain' : 'auto';
	});


	//create video tag
	self.video_tag = ko.computed(function(){
		return self.current_item().is_video() ? "<video src=\""+o3_html(self.current_item().preview1)+"\" poster=\""+o3_html(self.current_item().preview2)+"\" controls=\"\"></video>" : "";
	});

	//document zoom
	self.zoom = ko.observable(1);

	//reset zoom
	self.reset_zoom = function() {
		self.zoom( 1 );	
	};

	//constructor
	+function(){
		var items = [];

		//get all links for transfer viewer and has href
		$('a[data-ref="transfer-viewer"][href!="javascript:{}"][href!="#"]').each(function(){			
			items.push( new snapferViewerItemApp({
				parent: self,
				$: $(this)				
			}) );
		});		
		
		//populate items array
		self.items(items);

	}();

};