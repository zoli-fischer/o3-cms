/*
* Snafer main controller
*/
function snaferPageApp() {
	var self = this,
		$ = jQuery;

	//sign in/up form
	self.sign_in_up = new snaferSignInUpApp({ parent: self });

	//
	self.logged_user = new snaferLoggedUserApp({ parent: self });

};

/*
* Snafer sign in/up form controller
*/
function snaferLoggedUserApp( opts ) {

	var self = this,
		$ = jQuery;
		
};

/*
* Snafer sign in/up form controller
*/
function snaferSignInUpApp( opts ) {
	var self = this,
		$ = jQuery;

	//show sign in or sign up form
	self.is_show_sign_up_form = ko.observable( false );

	/*SIGN UP*/

	self.sign_up_fields = {
		username: {
			value: ko.observable(''),
		},
		password: {
			value: ko.observable(''),
		},
		email: {
			value: ko.observable(''),
		},
		bday_day: {
			value: ko.observable(''),
		},
		bday_month: {
			value: ko.observable(0),
		},
		bday_year: {
			value: ko.observable(''),
		},
		gender: {
			value: ko.observable(''),
		}
	};

	//show sign up form
	self.show_sign_up_form = function() {		
		self.is_show_sign_up_form( true ); 
	};

	//do sign up
	self.sign_up_submit = function() {

		return false;
	};

	/*SIGN IN*/

	//form
	self.$sign_in_form = $('#sign-in-form');
	
	//remember
	self.sign_in_remember = ko.observable( true );

	//show sign in form
	self.show_sign_in_form = function() {
		self.is_show_sign_up_form( false ); 
	};	

	//sign in error message
	self.sign_in_error_msg = ko.observable('');

	//do sign in
	self.sign_in_submit = function() {
		var $username = self.$sign_in_form.find('input[name=username]'),
			$password = self.$sign_in_form.find('input[name=password]');

		if ( $.trim( $username.val() ).length == 0 ) {
			$username.focus();
			return false;
		}

		if ( $.trim( $password.val() ).length == 0 ) {
			$password.focus();
			return false;
		}
 
		//send ajax request
		o3_cms_user_ajax_call(
			'login',
			{
				username: $username.val(),
				password: $password.val(),
				remember: self.sign_in_remember() ? 1 : 0
			},
			function(){ 
				self.sign_in_error_msg('');

				alert(1);
			}, 
			function(){ 
				self.sign_in_error_msg('Incorrect username or password.');
			}, 
			function(){ 
				self.sign_in_error_msg('An error occurred. Please try again.');
			}
		);

		return false;
	};

};