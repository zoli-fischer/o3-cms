/*
* Snafer create transfer file controller
*/
function snaferUploadFileApp( opts ) {
	var self = this,
		$ = jQuery;

	//options
	self.opts = $.extend( {
		parent: null,
		file: null
	}, opts );

	console.log(self.opts.file);

	//get parent
	self.parent = function() {
		return self.opts.parent;
	};

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

	//upload percent 
	self.percent = ko.observable( 0 );

	//on progress
	self.onprogress = function( event ) {
		if ( event.lengthComputable )
			self.percent( ( event.loaded / event.total ) * 100 );
		console.log(self.percent());
	};

	//on load handler
	self.onload = function( event ) {
		alert('load');
	};

	//on error handler
	self.onerror = function( event ) {
		alert('error');
	};

	//on abort handler
	self.onabort = function( event ) {
		
	};

	//on state change handler
	self.onreadystatechange = function( event ) {

	};

	//XMLHttpRequest
	self.xhr = null;

	//abort upload
	self.abort = function() {
		if ( self.xhr )
			self.xhr.abort();
	};

	//send file to server
	self.send = function() {
		if ( typeof XMLHttpRequest != 'undefined' ) {
			if ( typeof FormData != 'undefined' ) {
				
				//abort request if needed
				self.abort();

				//create form data
				var formData = new FormData();

				//Add the file to the request
				formData.append( 'file', self.file(), self.name() );

				//Add extra fields
				formData.append( 'o3_cms_template_ajax', 'public' );
				formData.append( 'o3_cms_template_ajax_name', 'upload_file' );
				formData.append( 'transfer_id', self.parent().transfer_id() );

				//clear percent
				self.percent( 0 );

				//clear request
				delete self.xhr;
				self.xhr = null;

				//Set up the request
				self.xhr = new XMLHttpRequest();

				//Set up a upload progress
				if ( self.xhr.upload ) {
					self.xhr.upload.onprogress = self.onprogress;
				} else {
					self.xhr.onprogress = self.onprogress;
				};

				//Set up a handler for when the request finishes
				self.xhr.onload = self.onload;

				//Set up error handler
				self.xhr.onerror = self.onfail;

				//Set up abort handler
				self.xhr.onabort = self.onabort;
			
				//Set up state change handler
				self.xhr.onreadystatechange = self.onreadystatechange;

				//Open the connection
				self.xhr.open( 'POST', window.location, true );

				//Send the data
				self.xhr.send( formData );
			} else {
				console.log('O3 Ajax Upload: FormData is missing!');
			}
		} else {
			console.log('O3 Ajax Upload: XMLHttpRequest is missing!');
		};
	};

};