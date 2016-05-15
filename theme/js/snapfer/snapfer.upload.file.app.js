/*
* Snapfer create transfer file controller
*/
function snapferUploadFileApp( opts ) {
	var self = this,
		$ = jQuery;

	//options
	self.opts = $.extend( {
		parent: null,
		file: null
	}, opts );

	//get parent
	self.parent = function() {
		return self.opts.parent;
	};

	//success callback 
	self.onsuccess = null;

	//error callback 
	self.onerror = null;

	//progress callback
	self.onprogress = null;

	//upload percent
	self.percent = ko.observable(0);

	//get file object
	self.file = function() {
		return self.opts.file;
	};

	//get file name
	self.name = function() {
		return self.file().name;
	};

	//get file size
	self.size = function() {
		return self.file().size;
	};

	//get file type
	self.type = function() {
		return self.file().type;
	};

	//uploader instance
	self.uploader = null;

	//abort upload
	self.abort = function() {
		self.percent( 0 );

		if ( self.uploader !== null )
			self.uploader.abort();
	};

	//send file
	self.send = function() {
		//clear percent
		self.percent( 0 );

		//create uploader instance
		if ( self.uploader === null )
			self.uploader = new snapferFileUploaderApp({
				onsuccess: function(event) {
					//call success callback
					if ( typeof self.onsuccess == 'function' )
						self.onsuccess.call( self, event );
				},
				onerror: function(event) {
					//call error callback
					if ( typeof self.onerror == 'function' )
						self.onerror.call( self, event );
				},
				onprogress: function(event) {
					//update percent
					self.percent(event.percent);

					//call progress callback
					if ( typeof self.onprogress == 'function' )
						self.onprogress.call( self, event );
				}
			});

		//send file
		self.uploader.send( self.file(), self.name(), self.parent().transfer_id() );
	};
	
};