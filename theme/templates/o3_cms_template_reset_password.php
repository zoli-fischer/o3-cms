<!DOCTYPE HTML>
<html lang="en">
<head>

	<?php 

		//load html head
		$this->view( 'o3_cms_template_view_html_head' );

		//load change password app
		$this->parent->body_js(O3_CMS_THEME_DIR.'/js/snapfer/snapfer.reset.password.app.js');

	?>

</head>
<body class="<?php echo o3_ua_body_classes(); ?>">	
	
	<?php
		
		//load header
		$this->view( 'o3_cms_template_view_header' );

		switch ($this->o3_cms()->page()->get('id')) {
			case RESET_PASSWORD_PAGE_ID:
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
						
						<form id="request-password-form" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" data-bind="submit: reset_password.request_submit">

							<p class="text-center" data-bind="text: reset_password.success_msg(), visible: reset_password.success_msg() != ''"></p>

							<div data-bind="visible: reset_password.success_msg() == ''">
								<p class="text-center">Enter your Snapfer username, or the email address that you used to register. We'll send you an email with a link to reset your password.</p>

								<div class="clearfix clearfix-m"></div>

					 			<div class="error-msg" data-bind="text: reset_password.error_msg(), css: { 'block': reset_password.error_msg() != '' }"></div>

								<div class="form-group" data-bind="css: { 'has-warning': reset_password.request_fields.username.error() }">
									<input class="form-control" placeholder="Email address or username" type="text"
										data-bind="value: reset_password.request_fields.username.value,
												   valueUpdate: 'keyup'">

									<div class="warning" data-bind="visible: reset_password.request_fields.username.error()">Please enter your Snapfer username.</div>
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
			break;
		case RESET_USER_PASSWORD_PAGE_ID:
			
	?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12">
						<section class="top-container" style="background-image: url(/res/reset-your-password.jpg)">

							<div class="container">
				        		<div class="row">
				            		<div class="col-md-10 col-md-offset-1">
				            			<h1>Reset your password</h1>
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
						
						<div id="reset-password-form" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 form">
							<input type="hidden" name="id" value="<?php echo $this->reset_password_request->get('id'); ?>" data-bind="value: reset_password.reset_fields.id.value" />
							<input type="hidden" name="expired" value="<?php echo $this->reset_password_request->is_expired() ? 1 : 0; ?>" data-bind="value: reset_password.reset_fields.expired.value" />

							<!--dummy password field to fix complete-->
							<input type="password" class="none"></input>

							<p class="text-center none" data-bind="attr: { 'style': reset_password.reset_is_expired() ? 'display: block !important' : '' }">The password reset request is expired. If you still have problem with signing in <a href="<?php echo $this->o3_cms()->page_url( RESET_PASSWORD_PAGE_ID ); ?>">click here</a> to create a new password reset request.</p>

							<div data-bind="css: { 'none': reset_password.reset_is_expired() }">

								<p data-bind="text: reset_password.success_msg(), visible: reset_password.success_msg() != ''"></p>

								<div data-bind="visible: reset_password.success_msg() == ''">
									<p class="text-center">Type in your new password.</p>

									<div class="clearfix clearfix-m"></div>

						 			<div class="error-msg" data-bind="text: reset_password.error_msg(), css: { 'block': reset_password.error_msg() != '' }"></div>

									<div class="form-group" data-bind="css: { 'has-warning': reset_password.reset_fields.password.error() }">
										<input class="form-control" type="password" value="" placeholder="Password" 
											data-bind="value: reset_password.reset_fields.password.value,
													   valueUpdate: 'keyup'" maxlength="32">

										<div class="warning" data-bind="visible: reset_password.reset_fields.password.error()">Please choose a new password. The password needs to be at least 4 characters long.</div>

									</div>

									<div class="clearfix clearfix-sm"></div>

									<div class="text-center">
										<button type="submit" class="btn btn-primary" data-bind="click: function() { reset_password.reset_submit() }">Save password</button>
									</div>
								</div>

							</div>

						</div>
					
					</div>
				</div>
			</section>

	<?php

			break;
		}

		//load header
		$this->view( 'o3_cms_template_view_footer' );

	?>

</body>
</html>