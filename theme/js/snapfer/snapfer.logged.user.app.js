/*
* Snapfer logged user controller
*/
function snapferLoggedUserApp( opts ) {
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

	//user id
	self.id = ko.observable( 0 );

	//user name
	self.username = ko.observable( '' );

	//subsciption type
	self.subsciption_type = ko.observable( SNAPFER_NONE );

	//allow trial to user
	self.allow_trial = ko.observable( true );

	//free storage
	self.storage_free = ko.observable( 0 );

	//check if user is logged
	self.is_logged = ko.pureComputed(function() {
		return self.id() > 0;
	});

	//check if user is premium
	self.is_premium = ko.pureComputed(function() {
		return self.subsciption_type() == SNAPFER_PREMIUM;
	});

	//check if user is registered but not premium
	self.is_free = ko.pureComputed(function() {
		return self.subsciption_type() == SNAPFER_FREE;
	});

	//check if user is not registered
	self.is_none = ko.pureComputed(function() {
		return self.subsciption_type() == SNAPFER_NONE;
	});

	//set user data
	self.set = function( id, username, subsciption_type, allow_trial, storage_free ) {
		self.id(id);
		self.username(username);
		self.subsciption_type(subsciption_type);
		self.allow_trial(allow_trial);
		self.storage_free(storage_free);
	};

	//unset user data
	self.unset = function() {
		self.set( 0, '', '', false, 0 );
	};

	//sign out user
	self.signout = function() {
		var uploading = self.parent().upload !== null && self.parent().upload.uploading();
		if ( confirm( uploading ? "Upload is in progress. If you sign out the upload will be canceled.\nAre you sure you want to sign out?" : 'Are you sure you want to sign out?' ) ) {
			//cancel upload if uploading
			if ( uploading )
				self.parent().upload.cancel();

			//trigger mouse out click
			$(document).trigger('mouseup');

			//send ajax request
			o3_cms_user_ajax_call(
				'sign_out',
				{},
				function( event ){
					self.unset();

					//got to page top
					$('.logo-holder a').click();

					//force resize window
					$(window).trigger('resize');
				}, 
				function(){
					window.location = '/index.php?snapfer-sign-out';
				}, 
				function(){
					window.location = '/index.php?snapfer-sign-out';
				}
			);
		};
	};

	//constructor
	+function constructor(){
		var $obj = $('script[data-ref=logged_user]');

		//set user
		if ( $obj.length > 0 )
			self.set( $obj.data('user-id'), $obj.data('user-name'), $obj.data('subsciption-type'), $obj.data('allow-trial'), $obj.data('storage-free') );

	}();
		
};