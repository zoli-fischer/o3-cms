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

	//set parent
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

			//create data
			var data  = {};
			for ( prop in self.fields )
				data[prop] = self.fields[prop].value();

			//send ajax request
			self.parent().ajax(
				'send_feedback',
				data,
				function( event ){

					//set success message
					alert("Your message was sent. Thank you.");

					//reset form
					self.reset_form();

					//set loading flag
					self.loading( false );
				}, 
				function( data ){ 
					
					//set loading flag
					self.loading( false );					

					alert('An error occurred. Please try again.');
				}, 
				function(){ 		

					//set loading flag
					self.loading( false );

					alert('An error occurred. Please try again.');
				}
			);

		};
	};

	//reset fields
	self.reset_form = function() {
		var fields = self.fields;

		//init fields
		for ( prop in fields ) {
			fields[prop].value( '' );			
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