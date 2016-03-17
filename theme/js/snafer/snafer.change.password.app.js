/*
* Snafer change logged user password controller
*/
function snaferChagnePasswordApp( opts ) {
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
	self.$form = $('#change-password-form');

	//error message
	self.error_msg = ko.observable('');

	//success message
	self.success_msg = ko.observable('');

	//fields
	self.fields = {
		password: {
			value: ko.observable(0),
			$: null,
			default: '',
			validate: function(str){ return jQuery.trim(str).length >= 4; },
			error: ko.observable( false )
		},
		password_new: {
			value: ko.observable(''),
			$: null,
			default: '',
			validate: function(str){ return jQuery.trim(str).length >= 4; },
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

	//submit 
	self.submit = function() {
		if ( self.validate_form() ) {

			//set loading flag
			self.loading( true );

			//clear success message
			self.success_msg('');

			//create data
			var data  = {};
			for ( prop in self.fields )
				data[prop] = self.fields[prop].value();

			//send ajax request
			self.parent().ajax(
				'change_password',
				data,
				function( event ){ 
					//clear error
					self.error_msg('');

					//set success message
					self.success_msg('Password is changed.');

					//set loading flag
					self.loading( false );

					//reset form
					self.reset_form();

					//got to page top
					$('.logo-holder a').click();
				}, 
				function( data ){ 
					
					//set loading flag
					self.loading( false );
					
					if ( typeof data != 'undefined' && typeof data.data != 'undefined'  )
						if ( typeof data.data.password != 'undefined' ) {
							self.fields.password.error( true );
							return;
						};

					self.error_msg('An error occurred. Please try again.');
				}, 
				function(){ 		
					self.error_msg('An error occurred. Please try again.');

					//set loading flag
					self.loading( false );
				}
			);

		};
		return false;
	};

	//reset fields
	self.reset_form = function() {
		var fields = self.fields;

		//init fields
		for ( prop in fields ) {
			fields[prop].value('');
			fields[prop].error(false);
			fields[prop].$.blur();	
		} 

	};

	//constructor
	+function constructor(){
		var fields = self.fields;

		//init fields
		for ( prop in fields ) {
			//bind html elements
			fields[prop].$ = self.$form.find("*[name="+prop+"]");			
			if ( typeof fields[prop].$.val() != 'undefined' ) {
				fields[prop].default = fields[prop].$.val();
				fields[prop].value(fields[prop].default);
			};
		};	
	}();
		
};