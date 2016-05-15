/*
* Snapfer create transfer controller
*/
function snapferUploadApp( opts ) {
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

	//form
	self.$form = $('#upload-form');

	//file selector
	self.$file = self.$form.find("input[type='file']");

	//drop
	self.$drop = $( '<div id="upload-drop"><div><div><div>Drop files to add them</div></div></div></div>' ).appendTo( "body" );

	//loading flag
	self.loading = ko.observable( false );

	//transfer type 
	self.type = ko.observable(SNAPFER_TRANSFER_EMAIL); //SNAPFER_TRANSFER_EMAIL, SNAPFER_TRANSFER_DOWNLOAD, SNAPFER_TRANSFER_SOCIAL

	//check type
	self.is_type = function( type ) { 
		return type == self.type();
	};

	//max upload size in GB
	self.max_upload_size_display = ko.computed(function() {
		switch ( self.parent().logged_user.subsciption_type() ) {
			case SNAPFER_FREE:
				return SNAPFER_TRANSFER_FREE_MAXSIZE_GB;
			case SNAPFER_PREMIUM:
				return SNAPFER_TRANSFER_PREMIUM_MAXSIZE_GB;
		};
		return SNAPFER_TRANSFER_MAXSIZE_GB;
	});

	//max upload size in bytes
	self.max_upload_size = ko.computed(function() {
		switch ( self.parent().logged_user.subsciption_type() ) {
			case SNAPFER_FREE:
				return SNAPFER_TRANSFER_FREE_MAXSIZE;
			case SNAPFER_PREMIUM:
				return SNAPFER_TRANSFER_PREMIUM_MAXSIZE;
		};
		return SNAPFER_TRANSFER_MAXSIZE;
	});

	//uploading files flag
	self.uploading = ko.observable( false );

	//uploading percent
	self.uploading_percent = ko.observable( 0 );

	//set social type
	self.social_type = ko.observable( '' ); //facebook, google, twitter, linkedin

	//sender email
	self.email = ko.observable( '' );

	//message
	self.message = ko.observable( '' );

	//recipients emails
	self.recipients = ko.observable( '' );

	//recipients emails
	self.recipients_array = ko.computed(function() {
		var r = [],
			recipients = self.recipients().split(/[\s,;]+/);

		for ( i in recipients ) {
			var email = $.trim(recipients[i]);
			if ( r.indexOf(email) === -1 && email.length > 0 ) {
				r.push( email ); 
			};
		};		
		return r;
	});

	//transfered flag
	self.transfered = ko.observable(false);

	//transfer url
	self.transfer_url = ko.observable('');

	//transfer title
	self.transfer_title = ko.observable('');

	//transfer desc
	self.transfer_desc = ko.observable('');

	//transfer canonical id
	self.transfer_id = ko.observable(0);

	//files
	self.files = ko.observableArray( [] );

	// Animation callbacks for the files list
    self.showElement = function(elem) { 
    	if (elem.nodeType === 1) 
    		$(elem).hide().slideDown();
    };
    self.hideElement = function(elem) { 
    	if (elem.nodeType === 1) 
    		$(elem).slideUp(function() { $(elem).remove(); }); 
    };

	//select file
	self.select_file = function() {
		self.$file.click();
	};

	//remove file
	self.remove_file = function( data ) {
		self.files.remove( data );
	};

	//check if file is in files
	self.is_in_files = function( file ) {
		for ( var i = 0; i < self.files().length; i++ ) {
			if ( self.files()[i].file().name == file.name )
				return true;
		}
		return false;
	};

	//add files
	self.add_files = function(event){
		//fetch file list
		var files = typeof event.target != 'undefined' && typeof event.target.files != 'undefined' ? event.target.files : ( typeof event.dataTransfer != 'undefined' && typeof event.dataTransfer.files != 'undefined' ? event.dataTransfer.files : [] );
		for ( var i = 0; i < files.length; i++ ) {
			var file = files[i],
				is_file = true;

			//check if is a file or folder
			if (!file.type && file.size%4096 == 0 && file.size <= 102400) {
			    try {
			        reader = new FileReader();
			        reader.readAsBinaryString(f);
			    } catch (NS_ERROR_FILE_ACCESS_DENIED) {
			        is_file = false;
			    };
			};

			//handle only if is file
			if ( is_file ) {
				//check max size
				if ( file.size + self.files_size() > self.max_upload_size() ) {
					alert('Sorry, but you can\'t transfer more than '+self.max_upload_size_display()+' at a time.');
					return;
				} else {
					//ignore files in the list
					if ( !self.is_in_files(file) ) {
						self.files.push( new snapferUploadFileApp({
							file: file,
							parent: self
						}) );
					} else {
						alert('A file with "'+file.name+'" name is allready in the list.');
					};
				};
			} else {
				alert('Uploading folders does not supported yet. Please compress it first.');
			}
		};
	};

	//on files change
	self.$file.on('change',self.add_files);

	//get total files size in byte
	self.files_size = ko.computed(function(){
		var bytes = 0;
		for ( var i = 0; i < self.files().length; i++ )
			bytes += self.files()[i].size();
		return bytes;
	});

	//get upload remianing size in byte
	self.remianing_size = ko.computed(function(){
		return self.max_upload_size() - self.files_size(); 
	});

	//send transfer
	self.submit = function() {

		//check for files
		if ( self.files().length == 0 ) {
			self.select_file();
			return;
		}

		//check for transfer size
		if ( self.files_size() > self.max_upload_size() ) {
			alert('Sorry, but you can\'t transfer more than '+self.max_upload_size_display()+' at a time.');
			return;
		};

		switch ( self.type() ) {
			case SNAPFER_TRANSFER_EMAIL:
				var error = false;

				//recipients email check
				if ( self.recipients_array().length == 0 ) {
					alert('Please enter at least 1 recipient.');
					error = true;
				}

				if ( !error ) 
					for ( i in self.recipients_array() ) {
						if ( !o3_valid_email(self.recipients_array()[i]) ) {
							alert(self.recipients_array()[i]+' appears to be an incorrect email address in the recipients list.');
							error = true;
							break;
						}
					}

				//sender email check
				if ( !error && self.parent().logged_user.is_none() ) {
					if ( $.trim(self.email()).length == 0 ) {
						alert('Please enter your email address.');
						error = true;
					} else if ( !o3_valid_email(self.email()) ) {					
						alert('Your email address appears to be incorrect.');
						error = true;
					}
				}

				if ( !error )
					self.upload();
				break;
			case SNAPFER_TRANSFER_DOWNLOAD:
				self.upload();
				break;
			case SNAPFER_TRANSFER_SOCIAL:
				self.upload();
				break;
		}
	};

	//share files
	self.share = function( social_type ) {
		//set social type
		self.social_type(social_type);

		//if transfered than share else transfer
		if ( self.transfered() ) {
			
			//share url
	    	share( self.transfer_url(), social_type, self.transfer_title(), self.transfer_desc()  );

		} else {
			self.submit();
		};
	};	

	//reset form
	self.reset = function() {
		//clear data
		self.email('');
		self.recipients('');
		self.message('');

		//remove all files
		while ( self.files().length > 0 )
			self.files.pop();

		//clear transfer data
		self.transfer_url('');
		self.transfer_name('');
		self.transfer_desc('');		
		self.transfer_id('');

		//clear uploading
		self.uploading( false );

		//clear transfered
		self.transfered( false );
	};

	//cancel upload
	self.cancel = function() {
		//clear temp interval
		clearInterval(self.uploading_interval);

		//show uploading
		self.uploading( false );

		//clear transfer data
		self.transfer_url('');
		self.transfer_name('');
		self.transfer_desc('');
		self.transfer_id('');

		//cancel uploads
		for ( var i = 0; i < self.files().length; i++ )
			self.files()[i].abort();
	};

	//todo: temp until real upload
	self.uploading_interval = null;

	//current send index
	self.send_index = 0;

	//start uploading files 1 by 1
	self.send_files = function() {
		self.send_index = 0;
		self.send_next_file();
	};

	//send next file
	self.send_next_file = function() {				
		if ( typeof self.files()[self.send_index] != 'undefined' ) {			
			//upload next file

			//get file
			var file = self.files()[self.send_index++];

			//set send callbacks
			file.onsuccess = function(e) {
				self.send_next_file();
			};
			file.onerror = function(e) {
				//show error message
				alert('An error occurred. Please try again.');

				//cancel upload
				self.cancel();
			};

			//send this file
			file.send();
		} else if ( self.send_index == self.files().length )  {
			//all files are uploaded finalize transfer and send email if needed
			self.finalize();			
		} else {
			//there was an error

			//show error message
			alert('An error occurred. Please try again.');

			//cancel upload
			self.cancel();
		}
	};

	//finalize transfer, remove temp flag and send email if needed
	self.finalize = function() {

		//create data
		var data  = {
			id: self.transfer_id()
		};

		//send ajax request
		self.parent().ajax(
			'finalize_transfer',
			data,
			function(event){

				//set title and description
				self.transfer_title(event.data.share_title);
				self.transfer_desc(event.data.share_desc);

				//update storage
				self.parent().logged_user.storage_free(event.data.storage_free);

				//stop interval
				clearInterval(self.uploading_interval);
				
				//set transfered
				self.transfered( true );

				//clear uploading
				self.uploading( false );
			},
			function(){ 
				alert('An error occurred. Please try again.');
				self.cancel();
			},
			function(){ 
				alert('An error occurred. Please try again.');
				self.cancel();
			}
		);
	};

	//start uploading the files
	self.upload = function() {
		//reset upload percent
		self.uploading_percent( 0 );
		
		//show uploading
		self.uploading( true );

		//create data
		var data  = {
			way: self.type(),
			email: self.parent().logged_user.is_none() ? self.email() : '',
			message: self.message(),
			recipients: self.recipients_array(),
			size: self.files_size(),
			files: []
		};

		//send ajax request
		self.parent().ajax(
			'create_transfer',
			data,
			function( event ){ 

				//set transfer url
				self.transfer_url(event.data.url);
				
				//set transfer canonical id
				self.transfer_id(event.data.id);

				//send files to server
				self.send_files();

				//show uploading
				self.uploading_interval = setInterval( function() {
										
					var total = 0,
						percent = 0;
					for ( var i = 0; i < self.files().length; i++ ) {
						var file = self.files()[i];
						total += file.size() * self.files()[i].percent() / 100;
					}
					percent = total * 100 / self.files_size();

					//add speed record
					self.set_speed( ( percent - self.uploading_percent() ) * self.files_size() / 100 );

					//set upload percent
					self.uploading_percent( percent > 100 ? 100 : percent );

				}, 1000 );
				
			}, 
			function( event ){
				if ( typeof event.data.storage_free != 'undefined' ) {
					alert("The "+( self.files().length == 1 ? "file" : "files" )+" can't be uploaded because you only have "+o3_bytes_display(event.data.storage_free,2)+" free storage. Please free up some space.");
				} else {
					alert('An error occurred. Please try again.');
				}
				self.cancel();
			}, 
			function(){
				alert('An error occurred. Please try again.');
				self.cancel();
			}
		);

	};

	//upload / second in bytes
	self.speed = ko.observable( 0 );

	//speed array
	self.speed_array = [];

	//speed index
	self.speed_index = 0;

	//upload estimated time in seconds to finish upload
	self.estimated_seconds = ko.computed(function(){
		if ( self.speed() > 0 ) {
			return ( ( 100 - self.uploading_percent() ) * self.files_size() / 100 ) / self.speed();
		} else {
			return 0;
		}
	});

	//display upload estimated time to finish upload
	self.estimated_display = ko.computed(function() {
		if ( self.estimated_seconds() >= 50 && self.estimated_seconds() < 70 ) {
			return 'About 1 minute remaining';
		} else if ( self.estimated_seconds() >= 70 ) {
			return 'About '+Math.ceil(self.estimated_seconds() / 60)+' minutes remaining';
		} else {
			return 'About less than a miunte remaining';
		}
	});

	//set speed record
	self.set_speed = function( speed ) {
		self.speed_array[self.speed_index++] = speed;
		if ( self.speed_index == 9 )
			self.speed_index = 0;

		self.speed( self.speed_array.reduce(function(a, b) { return a + b; }, 0) / self.speed_array.length );
	};

	//copy link from input
	self.copy = function() {
		try {
			var $d = self.$form.find(".download-link");
			$d.focus();
			$d.select();
			document.execCommand("copy");
			alert('The download link has been copied.');
		} catch (n) {};
	};

	//file drag start
	self.dragover = function( event ) {
		//prevent default
		event.preventDefault();  
   		event.stopPropagation();

   		//show drag box
		self.$drop.addClass( 'show' );
	};

	//file drag end
	self.dragleave = function( event) {
		//prevent default
		event.preventDefault();  
   		event.stopPropagation();

   		//hide drag box
		self.$drop.removeClass( 'show' );
	};

	//file dropped
	self.drop = function( event ) {
		//prevent default
		event.preventDefault();  
   		event.stopPropagation();

   		for( i in event )
   			console.log(i);

		//hide drag box
		self.$drop.removeClass( 'show' );

		//add files
		self.add_files(event);
	};

	//constructor
	+function constructor(){

		//fix jquery event, add dataTransfer to event properties
		jQuery.event.props.push('dataTransfer');

		//add drag and drop events		
		$("html").on("dragover", self.dragover);
		$("html").on("dragleave", self.dragleave);
		$("html").on("drop", self.drop);

		//show alert on navigate or close
		$(window).bind( 'beforeunload', function(e) {
			if ( self.uploading() )
				return 'Upload is in progress. If you continue the upload will be canceled.';
		} );

		//show form
		self.$form.css('visibility','visible'); 

	}(); 


};