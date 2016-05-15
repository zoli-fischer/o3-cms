/*
* Snapfer transfer previewer item
*/
function snapferViewerItemApp( opts ) {
	var self = this,
		$ = jQuery;

	//options
	self.opts = $.extend( {
		parent: null,
		$: null
	}, opts );

	//set parent
	self.parent = function() { return self.opts.parent; };	

	//set jquery container
	self.$this = self.opts.$;		

	//preview 1 file url
	self.preview1 = '';

	//preview 2 file url
	self.preview2 = '';

	//download url
	self.url = '';

	//filename
	self.title = '';

	//file type
	self.type = '';

	//Check if file is image
	self.is_image = function() { return self.type == SNAPFER_FILE_IMAGE; };

	//Check if file is video
	self.is_video = function() { return self.type == SNAPFER_FILE_VIDEO; };

	//Check if file is document
	self.is_doc = function() { return self.type == SNAPFER_FILE_DOC; };

	//file size
	self.size = 0;

	//file extension
	self.ext = '';	
	
	//doc pages
	self.pages = ko.observable( 0 );

	//current doc page
	self.current_page = ko.observable( 0 );

	//doc or image preview
	self.image_url = ko.observable( '' );

	//check if allow to show preview page
	self.allow_next_page = ko.computed(function() {
		return self.current_page() + 1 < self.pages();
	});

	//check if allow to show preview page
	self.allow_prev_page = ko.computed(function() {
		return self.current_page() > 0;
	});

	//show next item
	self.next_page = function() {
		if ( self.allow_next_page() )
			self.show_page( self.current_page() + 1 );
	};

	//show prev item
	self.prev_page = function() {
		if ( self.allow_prev_page() )
			self.show_page( self.current_page() - 1 );			
	};

	self.show_page = function( page ){		
		//unload
		self.unload();

		//update page index
		self.current_page( page );	

		//update image url
		self.image_url( self.preview1+( self.current_page() > 0 ? '&p='+self.current_page() : '' ) );

		//load		
		self.load();
	};

	//image width
	self.width = ko.observable(0);

	//image height
	self.height = ko.observable(0);

	//image loaded
	self.loaded = ko.observable( false );

	//image object
	self.img = null;

	//wait a little before load, maybe just quickly going over slided
	self.loadTimeout = null;

	//load image
	self.load = function() {
		if ( ( self.is_image() || self.is_doc() ) && self.img === null && !self.loaded() ) {
			clearTimeout(self.loadTimeout);
			self.loadTimeout = setTimeout(function(){
				self.img = new Image();
				$(self.img).on('load', function(){
					self.width(self.img.width);
					self.height(self.img.height);
					self.loaded(true);
				}).on('error', function(){
					//error
				}).attr('src',self.image_url());
			},100);			
		} else {
			self.loaded(true);
		};
	};

	//unload image
	self.unload = function() {
		//image loaded
		self.loaded( false );

		//image object
		self.img = null;
	};

	//constructor
	+function(){
		if ( self.$this !== null && self.$this.length > 0 ) {
			//set attributes values
			self.preview1 = self.$this.attr('href');
			self.preview2 = self.$this.data('preview'); 
			self.image_url( self.preview1 ); 
			self.url = self.$this.data('download');
			self.title = self.$this.attr('title');
			self.type = self.$this.data('type');
			self.size = self.$this.data('size');
			self.ext = self.$this.data('ext');
			self.pages( self.$this.data('pages') );			

			//add open viewer on click 
			self.$this.click(function(event){
				event.preventDefault();

				//open viewer
				self.parent().show( self );
			});
		};
	}();

};