<!DOCTYPE HTML>
<html lang="en">
<head>

	<?php 

		//load html head
		$this->view( 'o3_cms_template_view_html_head' );

		//load change password app
		$this->parent->body_js(O3_CMS_THEME_DIR.'/js/snafer/snafer.change.password.app.js');	

	?>

</head>
<body class="<?php echo o3_ua_body_classes(); ?>">	
	
	<?php
		
		//load header
		$this->view( 'o3_cms_template_view_header' );

	?>
 	
	 	<div id="change-password">
			
			<div class="container">
				<div class="row">

					<div class="col-md-12">
					
						<h2>Change password</h2>
						
					</div>

					<div class="clearfix-lg"></div>
	 		
		 			<form id="change-password-form" class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 gray-box" data-bind="submit: change_password.submit" autocomplete="nope">

			 			<div class="success-msg" data-bind="text: change_password.success_msg(), visible: change_password.success_msg() != ''"></div>

		 				<div class="error-msg" data-bind="text: change_password.error_msg(), visible: change_password.error_msg() != ''"></div>

		 				<input type="text" name="username" value="<?php echo o3_html($this->logged_user()->get('username')); ?>" style="display: none" />

		 				<span>Current password</span>
		 				<div class="form-group" data-bind="css: { 'has-warning': change_password.fields.password.error() }">
		 					<input class="form-control" value="" name="password" type="password" 
		 						data-bind="value: change_password.fields.password.value,
										   valueUpdate: 'keyup'" autocomplete="nope">

							<div class="warning" data-bind="visible: change_password.fields.password.error()">Sorry, wrong password.</div>
						</div>

						<div class="clearfix-sm"></div>

						<span>New password</span>
		 				<div class="form-group" data-bind="css: { 'has-warning': change_password.fields.password_new.error() }">
		 					<input class="form-control" value="" name="password_new" type="password" 
		 						data-bind="value: change_password.fields.password_new.value,
										   valueUpdate: 'keyup'" autocomplete="nope">
						
							<div class="warning" data-bind="visible: change_password.fields.password_new.error()">Please choose a new password.</div>
						</div>

						<div class="clearfix-lg"></div>

						<div class="btns">
							<a href="/account">Cancel</a> 
							<button class="btn" type="submit">Set new password</button>
						</div>

		 			</form>

				</div>
			</div>

		</div>
	
	<?php 

		//load header
		$this->view( 'o3_cms_template_view_footer' );

	?>

</body>
</html>