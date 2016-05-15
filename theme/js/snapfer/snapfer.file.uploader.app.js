/*
* Snapfer upload file to server with ajax
*/
function snapferFileUploaderApp( opts ) {
	var self = this,
		$ = jQuery;

	//options
	self.opts = $.extend( {
		onprogress: null,
		onsuccess: null,
		onerror: null
	}, opts );

	//on progress
	self.onprogress = function( event ) {
		if ( event.lengthComputable ) {
			event.percent = ( event.loaded / event.total ) * 100;				
			if ( typeof self.opts.onprogress == 'function' )
				self.opts.onprogress.call( this, event );
		};
	};

	//on load handler - internal
	self.onload = function( event ) {		
		var obj = null;
		try {
			var obj = jQuery.parseJSON(self.xhr.responseText);	

			//add o3 console log
			if ( typeof obj.o3_console != 'undefined' && typeof obj.o3_console != 'undefined' ) 
				for ( var i = 0; i < obj.o3_console.length; i++ ) 
					console.log(obj.o3_console[i]);

		} catch(error) {
			;
		}

		if ( obj && typeof obj.success == 'boolean' && obj.success === true ) {
			if ( typeof self.opts.onsuccess == 'function' )
				self.opts.onsuccess.call( this, event, obj.data );
		} else {
			if ( typeof self.opts.onerror == 'function' )
				self.opts.onerror.call( this, event );
		}
	};

	//on error handler - internal
	self.onerror = function( event ) {		
		if ( typeof self.opts.onerror == 'function' )
			self.opts.onerror.call( this, event );
	};

	//on abort handler - internal
	self.onabort = function( event ) {};

	//on state change handler - internal
	self.onreadystatechange = function( event ) {};

	//XMLHttpRequest
	self.xhr = null;

	//abort upload
	self.abort = function() {
		if ( self.xhr )
			self.xhr.abort();
	};

	//send file to server
	self.send = function( file, name, transfer_id ) {
		if ( typeof XMLHttpRequest != 'undefined' ) {
			if ( typeof FormData != 'undefined' ) {
				
				//abort request if needed
				self.abort();

				//create form data
				var formData = new FormData();

				//Add the file to the request
				formData.append( 'file', file, name );

				//Add extra fields
				formData.append( 'o3_cms_template_ajax', 'public' );
				formData.append( 'o3_cms_template_ajax_name', 'upload_file' );
				formData.append( 'id', transfer_id );
				
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
				self.xhr.onerror = self.error;

				//Set up abort handler
				self.xhr.onabort = self.onabort;
			
				//Set up state change handler
				self.xhr.onreadystatechange = self.onreadystatechange;

				//Open the connection
				self.xhr.open( 'POST', window.location, true );

				//self.xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				console.log('AJAX: file upload');

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