/*
* Snafer logged user controller
*/
function snaferLoggedUserApp( opts ) {
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
	self.subsciption_type = ko.observable('free');

	//allow trial to user
	self.allow_trial = ko.observable( true );

	//check if user is logged
	self.is_logged = ko.pureComputed(function() {
		return self.id() > 0;
	});

	//check if user is premium
	self.is_premium = ko.pureComputed(function() {
		return self.subsciption_type() == 'premium';
	});

	//set user data
	self.set = function( id, username, subsciption_type, allow_trial ) {
		self.id(id);
		self.username(username);
		self.subsciption_type(subsciption_type);
		self.allow_trial(allow_trial);
	};

	//unset user data
	self.unset = function() {
		self.set( 0, '', '', false );
	};

	//sign out user
	self.signout = function() {
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
				window.location = '/index.php?snafer-sign-out';
			}, 
			function(){
				window.location = '/index.php?snafer-sign-out';
			}
		);
	};

	//constructor
	+function constructor(){
		var $obj = $('script[data-ref=logged_user]');

		//set user
		if ( $obj.length > 0 )
			self.set( $obj.data('user-id'), $obj.data('user-name'), $obj.data('subsciption-type'), $obj.data('allow-trial') );

	}();
		
};