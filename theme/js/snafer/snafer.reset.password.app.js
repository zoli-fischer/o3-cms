/*
* Snafer sign in/up form controller
*/
function snaferResetPasswordApp( opts ) {
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

	//loading flag
	self.loading = ko.observable( false );

	//form
	self.$form = $('#reset-password-form');

	//error message
	self.error_msg = ko.observable('');

	//success message
	self.success_msg = ko.observable('');

	//fields
	self.fields = {
		username: {
			value: ko.observable(''),
			$: null,
			default: '',
			validate: function(str){ return jQuery.trim(str).length > 0; },
			error: ko.observable( false )
		}
	};

	//validate form
	self.validate_form = function() {
		var fields = self.fields, 
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
	self.reset_form = function() {
		var fields = self.fields;

		//init fields
		for ( prop in fields ) {
			if ( typeof self.fields[prop].default !== 'undefined' )
				fields[prop].value( self.fields[prop].default );
			fields[prop].error(false);
			fields[prop].$.blur();	
		} 

	};

	//submit 
	self.submit = function() {
		if ( self.validate_form() ) {

			//set loading flag
			self.loading( true );

			//clear messages
			self.success_msg('');
			self.error_msg('');

			//create data
			var data  = {};
			for ( prop in self.fields )
				data[prop] = self.fields[prop].value();

			//send ajax request
			self.parent().ajax(
				'reset_password',
				data,
				function( event ){ 
					//clear error
					self.error_msg('');

					//set success message
					self.success_msg('A message has been sent to your email address with instructions on how to reset your password.');

					//set loading flag
					self.loading( false );

					//reset form
					self.reset_form();
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

	//constructor
	+function(){ 
		var fields = self.fields;

		//init fields
		for ( prop in fields ) {
			//bind html elements
			fields[prop].$ = self.$form.find("*[name="+prop+"]");			
			if ( typeof fields[prop].$.val() != 'undefined' ) {
				fields[prop].value(fields[prop].$.val());
			};
		};	
	}();

};