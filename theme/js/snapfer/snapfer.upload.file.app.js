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

// make sure we have the sendAsBinary method on all browsers
XMLHttpRequest.prototype.snapferSendAsBinary = function(text){
	var data = new ArrayBuffer(text.length);
	var ui8a = new Uint8Array(data, 0);
	for (var i = 0; i < text.length; i++) 
		ui8a[i] = (text.charCodeAt(i) & 0xff);

	if(typeof window.Blob == "function") {
		var blob = new Blob([data]);
	} else {
		var bb = new (window.MozBlobBuilder || window.WebKitBlobBuilder || window.BlobBuilder)();
		bb.append(data);
		var blob = bb.getBlob();
	}
	this.send(blob);
};

/*
* Snapfer uploader
*/
function snapferFileStreamerApp( opts ) {
	var self = this,
		$ = jQuery;

	//options
	self.opts = $.extend( {
		onprogress: null,
		onsuccess: null,
		onerror: null
	}, opts );

	//FileReader object
	self.reader = null;

	//file name
	self.name = '';

	//transfer id
	self.transfer_id = '';

	self.send = function( file, name, transfer_id ) {
		if ( typeof FileReader == 'undefined' ) 
			return console.log('O3 Ajax Upload: FileReader is missing!');
		
		if ( typeof XMLHttpRequest == 'undefined' ) 
			console.log('O3 Ajax Upload: XMLHttpRequest is missing!');

		self.name = name;
		self.transfer_id = transfer_id; 

		if ( self.reader === null )
			self.reader = new FileReader();		

		self.reader.onerror = function() {
			alert('error');
		};

		//file loaded callback
		self.reader.onloadend = function( event ) {
			// create XHR instance
			xhr = new XMLHttpRequest();

			//Open the connection
			xhr.open( 'POST', window.location, true );

			//xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			console.log('AJAX: file upload');

			// let's track upload progress
			var eventSource = xhr.upload || xhr;
			eventSource.addEventListener("progress", function(e) {
				// get percentage of how much of the current file has been sent
				var position = e.position || e.loaded;
				var total = e.totalSize || e.total;
				var percentage = Math.round((position/total)*100);				
				// here you should write your own code how you wish to proces this
			});

			// state change observer - we need to know when and if the file was successfully uploaded
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4)
				{
					if(xhr.status == 200)
					{
						alert('success');// process success
					}else{
						alert('error');// process error
					}
				}
			};

			// start sending
			xhr.snapferSendAsBinary(event.target.result);
		};

		//read file
		self.reader.readAsBinaryString( file );
	};

	/*
	// take the file from the input
	var file = document.getElementById(fileInputId).files[fileIndex]; 
	var reader = new FileReader();

	reader.readAsBinaryString(file); // alternatively you can use readAsDataURL
	reader.onloadend  = function(evt) {
		// create XHR instance
		xhr = new XMLHttpRequest();
		
		// send the file through POST
		xhr.open("POST", 'upload.php', true);

		// make sure we have the sendAsBinary method on all browsers
		XMLHttpRequest.prototype.mySendAsBinary = function(text){
			var data = new ArrayBuffer(text.length);
			var ui8a = new Uint8Array(data, 0);
			for (var i = 0; i < text.length; i++) 
				ui8a[i] = (text.charCodeAt(i) & 0xff);

			if(typeof window.Blob == "function") {
				var blob = new Blob([data]);
			} else {
				var bb = new (window.MozBlobBuilder || window.WebKitBlobBuilder || window.BlobBuilder)();
				bb.append(data);
				var blob = bb.getBlob();
			}
			this.send(blob);
		}

		// let's track upload progress
		var eventSource = xhr.upload || xhr;
		eventSource.addEventListener("progress", function(e) {
			// get percentage of how much of the current file has been sent
			var position = e.position || e.loaded;
			var total = e.totalSize || e.total;
			var percentage = Math.round((position/total)*100);
			
			// here you should write your own code how you wish to proces this
		});

		// state change observer - we need to know when and if the file was successfully uploaded
		xhr.onreadystatechange = function()
		{
			if(xhr.readyState == 4)
			{
				if(xhr.status == 200)
				{
					// process success
				}else{
					// process error
				}
			}
		};
		
		// start sending
		xhr.mySendAsBinary(evt.target.result);
	};
	*/

};

/*
* Snapfer uploader
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