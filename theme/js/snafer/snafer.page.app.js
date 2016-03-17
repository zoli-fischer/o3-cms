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

	//utils

	//ajax call
	self.ajax = function( name, data, success, error, fails ) {
		return o3_cms_ajax_call( name, jQuery.extend( { snafer_logged_user_id: self.logged_user.id() }, data ), success, error, fails );
	};

};