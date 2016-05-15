/*
* Snapfer change logged user profile controller
*/
function snapferEditProfileApp( opts ) {
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
	self.$form = $('#edit-profile-form');

	//error message
	self.error_msg = ko.observable('');

	//success message
	self.success_msg = ko.observable('');

	//fields
	self.fields = {
		email: {
			value: ko.observable(''),
			$: null,
			validate: function(str){ return o3_valid_email(str); },
			error: ko.observable( false )
		},
		password: {
			value: ko.observable(''),
			$: null,
			default: '',
			validate: function(str){ return jQuery.trim(str).length >= 4; },
			error: ko.observable( false )
		},
		mobile: {
			value: ko.observable(''),
			$: null,
			error: ko.observable( false )
		},
		country_id: {
			value: ko.observable(''),
			$: null,
			error: ko.observable( false )
		},
		gender: {
			value: ko.observable(''),
			$: null,
			error: ko.observable( false )
		},
		bday_day: {
			value: ko.observable(''),
			$: null,
			error: ko.observable( false )
		},
		bday_month: {
			value: ko.observable(''),
			$: null, 
			error: ko.observable( false )
		},
		bday_year: {
			value: ko.observable(''),
			$: null, 
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

			//clear messages
			self.success_msg('');
			self.error_msg('');

			//create data
			var data  = {};
			for ( prop in self.fields )
				data[prop] = self.fields[prop].value();

			//concat bday
			data.bday = self.fields.bday_year.value()+'-'+self.fields.bday_month.value()+'-'+self.fields.bday_day.value();

			//send ajax request
			self.parent().ajax(
				'edit_profile',
				data,
				function( event ){ 
					//clear error
					self.error_msg('');

					//set success message
					self.success_msg('Profile changes are saved.');

					//reset form
					self.reset_form();

					//set loading flag
					self.loading( false );

					//got to document top
					scrollTop();
				}, 
				function( data ){ 
					
					//set loading flag
					self.loading( false );
					
					if ( typeof data != 'undefined' && typeof data.data != 'undefined' && typeof data.data.password != 'undefined' ) {
						self.fields.password.error( true );
						return;
					} else {
						self.fields.password.error( false );						
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
			if ( typeof self.fields[prop].default !== 'undefined' )
				fields[prop].value( self.fields[prop].default );
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
				fields[prop].value(fields[prop].$.val());
			};
		};	
	}(); 

};