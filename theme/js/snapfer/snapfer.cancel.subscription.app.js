/*
* Snapfer update logged user payment method controller
*/
function snapferCancelSubsciptionApp( opts ) {
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

	//error message
	self.error_msg = ko.observable('');

	//loading flag
	self.loading = ko.observable( false );

	//canceled flag
	self.canceled = ko.observable( false );

	//send cancel request
	self.cancel = function() { 
		if ( confirm('Are you sure you want to cancel your subsciprion?') ) {
			
			//set loading flag
			self.loading( true );

			//send ajax request
			self.parent().ajax(
				'cancel_subscription',
				{},
				function( event ){ 

					//set logged user to free
					if ( self.parent().logged_user.is_premium() )
						self.parent().logged_user.subsciption_type( SNAPFER_FREE );

					//clear error
					self.error_msg('');

					//set loading flag
					self.loading( false );

					//is canceled
					self.canceled( true );
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

		}
	};

	//constructor
	+function constructor(){}();

};