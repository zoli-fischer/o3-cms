/*
* Snafer main controller
*/
function snaferPageApp() {
	var self = this,
		$ = jQuery;

	//sign in/up form
	self.sign_in_up = new snaferSignInUpApp({ parent: self });

	//logged user data
	self.logged_user = new snaferLoggedUserApp({ parent: self });

	//update payment form
	self.update_payment = typeof snaferUpdatePaymentApp == 'function' ? new snaferUpdatePaymentApp({ parent: self }) : null;

	//change password form
	self.change_password = typeof snaferChagnePasswordApp == 'function' ? new snaferChagnePasswordApp({ parent: self }) : null;

	//edit profile form
	self.edit_profile = typeof snaferEditProfileApp == 'function' ? new snaferEditProfileApp({ parent: self }) : null;

	//edit billing info form
	self.edit_billing_information = typeof snaferEditBillingInfoApp == 'function' ? new snaferEditBillingInfoApp({ parent: self }) : null;

	//cancel subsciption form
	self.cancel_subsciption = typeof snaferCancelSubsciptionApp == 'function' ? new snaferCancelSubsciptionApp({ parent: self }) : null;

	//utils

	//ajax call
	self.ajax = function( name, data, success, error, fails ) {
		return o3_cms_ajax_call( name, jQuery.extend( { snafer_logged_user_id: self.logged_user.id() }, data ), success, error, fails );
	};

};