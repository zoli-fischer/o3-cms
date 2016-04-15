<!DOCTYPE HTML>
<html lang="en">
<head>

	<?php 

		//load html head
		$this->view( 'o3_cms_template_view_html_head' );

		//load change password app
		$this->parent->body_js(O3_CMS_THEME_DIR.'/js/snafer/snafer.reset.password.app.js');

	?>

</head>
<body class="<?php echo o3_ua_body_classes(); ?>">	
	
	<?php
		
		//load header
		$this->view( 'o3_cms_template_view_header' );

	?> 

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<section class="top-container" style="background-image: url(/res/reset-password.jpg)">

					<div class="container">
		        		<div class="row">
		            		<div class="col-md-10 col-md-offset-1">
		            			<h1>Reset password</h1>
		            		</div>
		            	</div>
		            </div>

				</section>
			</div>
		</div>
	</div>  
	
	<section id="reset-password">
		<div class="container">
			<div class="row">
				
				<form id="reset-password-form" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" data-bind="submit: reset_password.submit">

					<p data-bind="text: reset_password.success_msg(), visible: reset_password.success_msg() != ''"></p>

					<div data-bind="visible: reset_password.success_msg() == ''">
						<p>Enter your Snafer username, or the email address that you used to register. We'll send you an email with a link to reset your password.</p>

						<div class="clearfix clearfix-m"></div>

			 			<div class="error-msg" data-bind="text: reset_password.error_msg(), css: { 'block': reset_password.error_msg() != '' }"></div>

						<div class="form-group" data-bind="css: { 'has-warning': reset_password.fields.username.error() }">
							<input class="form-control" placeholder="Email address or username" type="text"
								data-bind="value: reset_password.fields.username.value,
										   valueUpdate: 'keyup'">

							<div class="warning" data-bind="visible: reset_password.fields.username.error()">Please enter your Snafer username.</div>
						</div>

						<div class="clearfix clearfix-sm"></div>

						<div class="text-center">
							<button type="submit" class="btn btn-primary">Send</button>
						</div>
					</div>

				</form>
			
			</div>
		</div>
	</section>

	<?php 

		//load header
		$this->view( 'o3_cms_template_view_footer' );

	?>

</body>
</html>