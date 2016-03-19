/*
* Snafer change logged user billing information controller
*/
function snaferEditBillingInfoApp( opts ) {
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
	self.$form = $('#edit-billing-information');

	//error message
	self.error_msg = ko.observable('');

	//success message
	self.success_msg = ko.observable('');

	//fields
	self.fields = {
		bil_name: {
			value: ko.observable(''),
			$: null,
			error: ko.observable( false )
		},
		bil_vat: {
			value: ko.observable(''),
			$: null,
			error: ko.observable( false )
		},
		bil_city: {
			value: ko.observable(''),
			$: null,
			error: ko.observable( false )
		},
		bil_zip: {
			value: ko.observable(''),
			$: null,
			error: ko.observable( false )
		},
		bil_address: {
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
 
			//send ajax request
			self.parent().ajax(
				'edit_billing_information',
				data,
				function( event ){ 
					//clear error
					self.error_msg('');

					//set success message
					self.success_msg('Billing information is saved.');

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