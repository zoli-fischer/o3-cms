/*
* Snapfer change logged user profile controller
*/
function snapferFeedbackApp( opts ) {
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
	self.$form = $('#feedback-form');

	//fields
	self.fields = {
		name: {
			value: ko.observable(''),
			$: null,
			validate: function(str){ return jQuery.trim(str).length > 0 },
			error_msg: 'Please type in your name'
		},
		email: {
			value: ko.observable(''),
			$: null,
			validate: function(str){ return o3_valid_email(str); },
			error_msg: 'Please type in your email'
		},
		phone: {
			value: ko.observable(''),
			$: null,
			validate: null,
			error_msg: ''
		},
		message: {
			value: ko.observable(''),
			$: null,
			validate: function(str){ return jQuery.trim(str).length > 0 },
			error_msg: 'Please type in a message'
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
					has_error = true;
				}

		if ( focus !== null ) {
			focus.$.focus();
			alert( focus.error_msg );
		}

		return !has_error;
	};

	//submit 
	self.submit = function() {
		if ( self.validate_form() ) {

			//set loading flag
			self.loading( true );

			

		};
	};

	//reset fields
	self.reset_form = function() {
		var fields = self.fields;

		//init fields
		for ( prop in fields ) {
			if ( typeof self.fields[prop].default !== 'undefined' )
				fields[prop].value( self.fields[prop].default );			
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