/*
* Snapfer sign in/up form controller
*/
function snapferResetPasswordApp( opts ) {
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

	//loading flag
	self.loading = ko.observable( false );

	//form
	self.$request_form = $('#request-password-form');

	//form
	self.$reset_form = $('#reset-password-form');

	//error message
	self.error_msg = ko.observable('');

	//success message
	self.success_msg = ko.observable('');

	//fields
	self.request_fields = {
		username: {
			value: ko.observable(''),
			$: null,
			default: '',
			validate: function(str){ return jQuery.trim(str).length > 0; },
			error: ko.observable( false )
		}
	};

	//validate form
	self.validate_request_form = function() {
		var fields = self.request_fields, 
			focus = null,
			has_error = false;

		for ( prop in fields )
			if ( typeof  fields[prop].validate == 'function' )
				if ( !fields[prop].validate( fields[prop].value() ) ) {	
					if ( focus === null )
						focus = fields[prop];
					fields[prop].error( true );
					has_error = true;
				}

		if ( focus !== null ) {
			focus.$.focus();
			focus.error( true );
		}

		return !has_error;
	};

	//reset fields
	self.reset_request_form = function() {
		var fields = self.request_fields;

		//init fields
		for ( prop in fields ) {
			if ( typeof fields[prop].default !== 'undefined' )
				fields[prop].value( fields[prop].default );
			fields[prop].error(false);
			fields[prop].$.blur();	
		} 

	};

	//submit 
	self.request_submit = function() {
		if ( self.validate_request_form() ) {

			//set loading flag
			self.loading( true );

			//clear messages
			self.success_msg('');
			self.error_msg('');

			//create data
			var data  = {};
			for ( prop in self.request_fields )
				data[prop] = self.request_fields[prop].value();

			//send ajax request
			self.parent().ajax(
				'request_password',
				data,
				function( event ){ 
					//clear error
					self.error_msg('');

					//set success message
					self.success_msg('A message has been sent to your email address with instructions on how to reset your password.');

					//set loading flag
					self.loading( false );

					//reset form
					self.reset_request_form();
				}, 
				function( data ){ 
					//set loading flag
					self.loading( false );
									
					self.error_msg('An error occurred. Please try again.');
				},
				function(){ 		
					//set loading flag
					self.loading( false );

					self.error_msg('An error occurred. Please try again.');
				}
			);

		};
		return false;
	};

	//fields
	self.reset_fields = {
		password: {
			value: ko.observable(''),
			$: null,
			default: '',
			validate: function(str){ return jQuery.trim(str).length >= 4; },
			error: ko.observable( false )
		},
		id: {
			value: ko.observable(''),
			$: null,
			default: '',
			validate: false,
			error: ko.observable( false )
		},
		expired: {
			value: ko.observable(''),
			$: null,
			default: '',
			validate: false,
			error: ko.observable( false )
		}
	};
	
	//is request expired
	self.reset_is_expired = ko.pureComputed(function(){
		return self.reset_fields.expired.value() == '1';
	});

	//validate form
	self.validate_reset_form = function() {
		var fields = self.reset_fields, 
			focus = null,
			has_error = false;

		for ( prop in fields )
			if ( typeof  fields[prop].validate == 'function' )
				if ( !fields[prop].validate( fields[prop].value() ) ) {	
					if ( focus === null )
						focus = fields[prop];
					fields[prop].error( true );
					has_error = true;
				}

		if ( focus !== null ) {
			focus.$.focus();
			focus.error( true );
		}

		return !has_error;
	};

	//reset fields
	self.reset_reset_form = function() {
		var fields = self.reset_fields;

		//init fields
		for ( prop in fields ) {
			if ( typeof fields[prop].default !== 'undefined' )
				fields[prop].value( fields[prop].default );
			fields[prop].error(false);
			fields[prop].$.blur();	
		} 

	};

	//submit 
	self.reset_submit = function() {
		if ( self.validate_reset_form() ) {

			//set loading flag
			self.loading( true );

			//clear messages
			self.success_msg('');
			self.error_msg('');

			//create data
			var data  = {};
			for ( prop in self.reset_fields )
				data[prop] = self.reset_fields[prop].value();

			//send ajax reset
			self.parent().ajax(
				'reset_password',
				data,
				function( event ){ 
					//clear error
					self.error_msg('');

					//set success message
					self.success_msg('Succeeded. You can sign in now with your new password.');

					//set loading flag
					self.loading( false );

					//reset form
					self.reset_reset_form();
				}, 
				function( event ){ 
					//set loading flag
					self.loading( false );

					if ( typeof event.data.expired != 'undefined' && event.data.expired == '1' )
						self.reset_fields.expired.value('1');

					self.error_msg('An error occurred. Please try again.');
				},
				function(){ 		
					//set loading flag
					self.loading( false );

					self.error_msg('An error occurred. Please try again.');
				}
			);

		};
		return false;
	};


	//constructor
	+function(){
		var request_fields = self.request_fields,
			reset_fields = self.reset_fields;

		//init request_fields
		for ( prop in request_fields ) {
			//bind html elements
			request_fields[prop].$ = self.$request_form.find("*[name="+prop+"]");			
			if ( typeof request_fields[prop].$.val() != 'undefined' ) {
				request_fields[prop].value(request_fields[prop].$.val());
			};
		};	

		//init request_fields
		for ( prop in reset_fields ) {
			//bind html elements
			reset_fields[prop].$ = self.$reset_form.find("*[name="+prop+"]");			
			if ( typeof reset_fields[prop].$.val() != 'undefined' ) {
				reset_fields[prop].value(reset_fields[prop].$.val());
			};
		};
	}();

};