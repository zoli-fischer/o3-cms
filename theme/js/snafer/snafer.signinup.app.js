/*
* Snafer sign in/up form controller
*/
function snaferSignInUpApp( opts ) {
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

	//show sign in or sign up form
	self.is_show_sign_up_form = ko.observable( false );

	//reset sign in form
	self.form_reset = function() {
		var $username = self.$sign_in_form.find('input[name=username]'),
			$password = self.$sign_in_form.find('input[name=password]');

		$username.val('');
		$password.val('');
		self.sign_in_remember(true);

		var fields = self.sign_up_fields;

		for ( prop in fields )
			if ( fields[prop].value.o3_isValid ) { 
				fields[prop].value(fields[prop].default);
				fields[prop].value.o3_showError( false );
			};
	};

	/*SIGN UP*/

	//form
	self.$sign_up_form = $('#sign-up-form');

	//sign up error message
	self.sign_up_error_msg = ko.observable('');

	//fields
	self.sign_up_fields = {
		username: {
			value: ko.observable(''),
			$: null,
			default: '',
			available: ko.observable( true ),
			validate: function(str){ return jQuery.trim(str).length >= 4 && self.sign_up_fields.username.available(); }
		},
		password: {
			value: ko.observable(''),
			$: null,
			default: '',
			validate: function(str){ return jQuery.trim(str).length >= 4; }
		},
		email: {
			value: ko.observable(''),
			$: null,
			default: '',
			available: ko.observable( true ),
			validate: function(str){ return o3_valid_email(str) && self.sign_up_fields.email.available(); }
		},
		bday_day: {
			value: ko.observable(''),
			$: null,
			default: '',
			validate: function(str){ return parseInt(str) >= 1 && parseInt(str) <= 31; }
		},
		bday_month: {
			value: ko.observable(0),
			$: null,
			default: 0,
			validate: function(str){ return parseInt(str) >= 1 && parseInt(str) <= 12; }
		},
		bday_year: {
			value: ko.observable(''),
			$: null,
			default: '',
			validate: function(str){ return parseInt(str) >= 1900 && parseInt(str) <= (new Date()).getFullYear(); }
		},
		gender: {
			value: ko.observable(''),
			$: null,
			default: '',
			validate: function(str){ return str != ''; }
		}
	};

	//validate sign up form
	self.validate_sign_up_form = function() {
		var fields = self.sign_up_fields, 
			focus = null,
			has_error = false;

		for ( prop in fields )
			if ( fields[prop].value.o3_isValid )
				if ( !fields[prop].value.o3_isValid() ) {	
					if ( focus === null )
						focus = fields[prop];
					fields[prop].value.o3_showError( true );
					has_error = true;
				}

		if ( focus !== null ) {
			focus.$.focus();
			focus.value.o3_showError( true );
		}

		return !has_error;
	};

	//show sign up form
	self.show_sign_up_form = function() {		
		self.is_show_sign_up_form( true ); 
	};

	//do sign up
	self.sign_up_submit = function() {
		if ( self.validate_sign_up_form() ) {
			
			//send ajax request
			o3_cms_user_ajax_call(
				'sign_up',
				{
					username: self.sign_up_fields.username.value(),
					password: self.sign_up_fields.password.value(),
					email: self.sign_up_fields.email.value(),
					bday: self.sign_up_fields.bday_year.value()+'-'+self.sign_up_fields.bday_month.value()+'-'+self.sign_up_fields.bday_day.value(),
					gender: self.sign_up_fields.gender.value()
				},
				function( event ){ 
					//clear error
					self.sign_in_error_msg('');

					//set logged user
					self.parent().logged_user.set( event.data.id, event.data.username );

					//reset sign in/up form
					self.form_reset();

					//got to page top
					$('.logo-holder a').click();
				}, 
				function( data ){ 
					if ( typeof data != 'undefined' && typeof data.data != 'undefined'  )
						if ( typeof data.data.username != 'undefined' ) {
							self.sign_up_fields.username.available( false );
							self.sign_up_fields.username.value.o3_showError( true );
							return;
						} else if ( typeof data.data.email != 'undefined' ) {
							self.sign_up_fields.email.available( false );
							self.sign_up_fields.email.value.o3_showError( true );
							return;
						};

					self.sign_in_error_msg('An error occurred. Please try again.');
				}, 
				function(){ 		
					self.sign_in_error_msg('An error occurred. Please try again.');
				}
			);

		};
		return false;
	};

	//clear sign up available
	self.clear_sign_up_available = function() {
		var fields = self.sign_up_fields;

		//init fields
		for ( prop in fields ) 
			if ( typeof fields[prop].available == 'function' )
				fields[prop].available( true );
	};


	//constructor
	+function(){ 
		var fields = self.sign_up_fields;

		//init fields
		for ( prop in fields ) {
			//bind html elements
			fields[prop].$ = self.$sign_up_form.find("*[name="+prop+"]");			
			if ( typeof fields[prop].$.val() != 'undefined' ) {
				fields[prop].default = fields[prop].$.val();
				fields[prop].value(fields[prop].default);
			};

			//set validation
			if ( fields[prop].validate !== false )
				o3_isValid( fields[prop].value, fields[prop].validate );

			//reset available on change
			if ( typeof fields[prop].available == 'function' )
				fields[prop].value.subscribe(self.clear_sign_up_available);
		};
	}();

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
			'sign_in',
			{
				username: $username.val(),
				password: $password.val(),
				remember: self.sign_in_remember() ? 1 : 0
			},
			function( event ){ 
				self.sign_in_error_msg('');

				//set logged user
				self.parent().logged_user.set( event.data.id, event.data.username );

				//reset sign in/up form
				self.form_reset();

				//got to page top
				$('.logo-holder a').click();
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