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

	//check if user is logged
	self.is_logged = ko.pureComputed(function() {
		return self.id() > 0;
	});

	//set user data
	self.set = function( id, username ) {
		self.id(id);
		self.username(username);
	};

	//unset user data
	self.unset = function() {
		self.set( 0, '' );
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
		var $obj = $('script[ref=logged_user]'),
			id = $obj.data('user-id'),
			username = $obj.data('user-name'); 
		
		//set user
		self.set( id, username );

	}();
		
};