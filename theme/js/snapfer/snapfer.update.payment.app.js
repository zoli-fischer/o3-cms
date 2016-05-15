/*
* Snapfer update logged user payment method controller
*/
function snapferUpdatePaymentApp( opts ) {
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

	//payment type - card or paypal
	self.type = ko.observable('card');

	//set payment type 
	self.set_type = function( type ) {
		if ( !self.loading() )
			self.type( type );
	};

	//loading flag
	self.loading = ko.observable( false );

	//form
	self.$form = $('#update-payment-form');

	//sign up error message
	self.error_msg = ko.observable('');

	//fields
	self.fields = {
		cardnumber: {
			value: ko.observable(''),
			$: null,
			default: '',
			validate: function(str){ return str.match(/^[0-9]{16}$/); }
		},
		expiry_year: {
			value: ko.observable(0),
			$: null,
			default: 0,
			validate: function(str){ return !isNaN(parseInt(str)) && parseInt(str) > 0; }
		},
		expiry_month: {
			value: ko.observable(0),
			$: null,
			default: 0,
			validate: function(str){ return parseInt(str) >= 1 && parseInt(str) <= 12; }
		},
		security_code: {
			value: ko.observable(''),
			$: null,
			default: '',
			validate: function(str){ return str.match(/^[0-9]{3}$/); }
		}
	};

	//validate form
	self.validate_form = function() {
		//on paypal return true
		if ( self.type() == 'paypal' )
			return true;

		var fields = self.fields, 
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

	//submit 
	self.submit = function() {
		if ( self.validate_form() ) {

			//set loading flag
			self.loading( true );

			//create data
			var data = {
				type: self.type()
			};

			//add fields
			if ( self.type() == 'card' )
				for ( prop in self.fields )
					data[prop] = self.fields[prop].value();

			//send ajax request
			self.parent().ajax(
				'update_method',
				data,
				function( event ){ 
					//clear error
					self.error_msg('');

					//set loading flag
					self.loading( false );
				}, 
				function( data ){ 
					self.error_msg('An error occurred. Please try again.');

					//set loading flag
					self.loading( false );
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

			//set validation
			if ( fields[prop].validate !== false )
				o3_isValid( fields[prop].value, fields[prop].validate );

		};	
	}();
		
};