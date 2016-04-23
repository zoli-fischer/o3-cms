/*
* Snafer change logged user profile controller
*/
function snaferUploadApp( opts ) {
	var self = this,
		$ = jQuery;

	//options
	self.opts = $.extend( {
		parent: null
	}, opts );

	//set parent, pt_page object
	self.parent = function() {
		return self.opts.parent;
	};

	//form
	self.$form = $('#upload-form');

	//loading flag
	self.loading = ko.observable( false );

	//transfer type 
	self.type = ko.observable(SNAFER_TRANSFER_DOWNLOAD); //SNAFER_TRANSFER_EMAIL, SNAFER_TRANSFER_DOWNLOAD, SNAFER_TRANSFER_SOCIAL

	//check type
	self.is_type = function( type ) { 
		return type == self.type();
	};

	//uploading files flag
	self.uploading = ko.observable( false );

	//uploading percent
	self.uploading_percent = ko.observable( 0 );

	//set social type
	self.social_type = ko.observable( '' ); //facebook, google, twitter, linkedin

	//sender email
	self.email = ko.observable( '' );

	//recipients emails
	self.recipients = ko.observable( '' );

	//recipients emails
	self.recipients_array = ko.pureComputed(function() {
		var r = [],
			recipients = self.recipients().split(/[\s,;]+/);

		for ( i in recipients ) {
			var email = $.trim(recipients[i]);
			if ( r.indexOf(email) === -1 && email.length > 0 ) {
				r.push( email ); 
			};
		};
		console.log(r);
		return r;
	});

	//transfered flag
	self.transfered = ko.observable(false);

	//upload files
	self.submit = function() {
		switch ( self.type() ) {
			case SNAFER_TRANSFER_EMAIL:
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
				if ( !error ) {
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
			case SNAFER_TRANSFER_DOWNLOAD:
				self.upload();
				break;
			case SNAFER_TRANSFER_SOCIAL:
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
			//todo
		} else {
			self.submit();
		};
	};	

	//reset form
	self.reset = function() {
		//clear data
		self.email('');
		self.recipients('');

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

	};

	//todo: temp until real upload
	self.uploading_interval = null;

	//start uploading the files
	self.upload = function() {
		//reset upload percent
		self.uploading_percent( 0 );
		
		//show uploading
		self.uploading( true );

		self.uploading_interval = setInterval( function() {
			if ( self.uploading_percent() >= 100 ) {
				//stop interval
				clearInterval(self.uploading_interval);
				
				//set transfered
				self.transfered( true );

				//clear uploading
				self.uploading( false );

			} else {
				self.uploading_percent( self.uploading_percent() + 1 );
			};
		}, 10 );

	};


	//constructor
	+function constructor(){
		self.$form.css('visibility','visible'); 
	}(); 


};