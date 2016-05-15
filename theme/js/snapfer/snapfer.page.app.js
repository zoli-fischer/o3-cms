/*
* Snapfer main controller
*/
function snapferPageApp() {
	var self = this,
		$ = jQuery;

	//sign in/up form
	self.sign_in_up = new snapferSignInUpApp({ parent: self });

	//logged user data
	self.logged_user = new snapferLoggedUserApp({ parent: self });

	//update payment form
	self.update_payment = typeof snapferUpdatePaymentApp == 'function' ? new snapferUpdatePaymentApp({ parent: self }) : null;

	//change password form
	self.change_password = typeof snapferChagnePasswordApp == 'function' ? new snapferChagnePasswordApp({ parent: self }) : null;

	//edit profile form
	self.edit_profile = typeof snapferEditProfileApp == 'function' ? new snapferEditProfileApp({ parent: self }) : null;

	//edit billing info form
	self.edit_billing_information = typeof snapferEditBillingInfoApp == 'function' ? new snapferEditBillingInfoApp({ parent: self }) : null;

	//cancel subsciption form
	self.cancel_subsciption = typeof snapferCancelSubsciptionApp == 'function' ? new snapferCancelSubsciptionApp({ parent: self }) : null;

	//reset password form
	self.reset_password = typeof snapferResetPasswordApp == 'function' ? new snapferResetPasswordApp({ parent: self }) : null;
	
	//upload file
	self.upload = typeof snapferUploadApp == 'function' ? new snapferUploadApp({ parent: self }) : null;

	//feedback
	self.feedback = typeof snapferFeedbackApp == 'function' ? new snapferFeedbackApp({ parent: self }) : null;
	
	//utils

	//ajax call
	self.ajax = function( name, data, success, error, fails ) {
		return o3_cms_ajax_call( name, jQuery.extend( { snapfer_logged_user_id: self.logged_user.id() }, data ), success, error, fails );
	};

};