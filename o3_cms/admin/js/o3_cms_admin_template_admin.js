+function ($) {
	'use strict';

	function setLoginMessage( msg ) {
		$('#o3-cms-login-error-msg').html( o3_html(msg) ).slideDown();
	};

	$('form').on('submit',function(){
		var $this = $(this),
			$username = $this.find('input[name="username"]'),
			$password = $this.find('input[name="password"]');

		if ( $.trim($username.val()).length == 0 ) {
			$username.focus();
			return false;
		}

		if ( $.trim($password.val()).length == 0 ) {
			$password.focus();
			return false;
		}

		$this.find('input,button').prop('disabled', true);

		//send ajax request
		o3_cms_user_ajax_call(
			'login',
			{
				username: $username.val(),
				password: $password.val()
			},
			function(){ 
				//no action, system redirect to frontpage
				alert('1');
			}, 
			function(){
				$this.find('input,button').prop('disabled', false);
				setLoginMessage(o3_lang_('o3-cms-login-incorrect-user-pass'));
			}, 
			function(){
				$this.find('input,button').prop('disabled', false);
				setLoginMessage(o3_lang_(O3_ERR_GENERAL));
			}
		);

		return false;
	});

}(jQuery);