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
* Snapfer stream file to server with ajax
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