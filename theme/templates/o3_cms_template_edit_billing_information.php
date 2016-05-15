<!DOCTYPE HTML>
<html lang="en">
<head>

	<?php 

		//load html head
		$this->view( 'o3_cms_template_view_html_head' );

		//load change password app
		$this->parent->body_js(O3_CMS_THEME_DIR.'/js/snapfer/snapfer.edit.billing.info.app.js');

	?>

</head>
<body class="<?php echo o3_ua_body_classes(); ?>">	
	
	<?php
		
		//load header
		$this->view( 'o3_cms_template_view_header' );

	?>
 	
	 	<div id="edit-billing-information">
			
			<div class="container">
				<div class="row">

					<div class="col-md-12">
					
						<h2>Edit billing information</h2>
						
					</div>

					<div class="clearfix-lg"></div>
	 		
		 			<div id="edit-billing-information-form" class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 form gray-box">

		 				<div class="success-msg" data-bind="text: edit_billing_information.success_msg(), css: { 'block': edit_billing_information.success_msg() != '' }"></div>

		 				<div class="error-msg" data-bind="text: edit_billing_information.error_msg(), css: { 'block': edit_billing_information.error_msg() != '' }"></div>
		 				

						<span>Name / Company</span>
		 				<div class="form-group" data-bind="css: { 'has-warning': edit_billing_information.fields.bil_name.value.o3_showError() }">
		 					<input class="form-control" placeholder="" value="<?php echo o3_html($this->logged_user()->get('bil_name')); ?>" name="bil_name" type="text"
		 					data-bind="value: edit_billing_information.fields.bil_name.value,
									   valueUpdate: 'keyup',
									   o3_validate: edit_billing_information.fields.bil_name.value">
							<div class="warning" data-bind="visible: edit_billing_information.fields.bil_name.value.o3_showError()">Please type in your name.</div>
						</div>

						<div class="clearfix-sm"></div> 

						<?php
						if ( $this->logged_user()->country()->has_vat() ) {
						?>
						<span>Vat nr.</span>
		 				<div class="form-group">
		 					<input class="form-control" placeholder="" value="<?php echo o3_html($this->logged_user()->get('bil_vat')); ?>" name="bil_vat" type="text" maxlength="32"
		 					data-bind="value: edit_billing_information.fields.bil_vat.value,
									   valueUpdate: 'keyup'">
						</div>
						<?php 
						}
						?>

						<div class="clearfix-sm"></div> 

						<span>Country</span>
		 				<div class="form-group read-only">
		 					<input class="form-control" placeholder="" readonly="readonly" value="<?php echo ucfirst(strtolower(o3_html($this->logged_user()->country()->get('name')))); ?>" >							
						</div>

						<p><small>To changing your country go to <a href="<?php echo $this->o3_cms()->page_url( EDIT_PROFILE_PAGE_ID ); ?>">edit profile page</a>.</small></p>

						<div class="clearfix-m"></div>

						<span>City</span>
		 				<div class="form-group" data-bind="css: { 'has-warning': edit_billing_information.fields.bil_city.value.o3_showError() }">
		 					<input class="form-control" placeholder="" value="<?php echo o3_html($this->logged_user()->get('bil_city')); ?>" name="bil_city" type="text"
		 					data-bind="value: edit_billing_information.fields.bil_city.value,
									   valueUpdate: 'keyup',
									   o3_validate: edit_billing_information.fields.bil_city.value">
							<div class="warning" data-bind="visible: edit_billing_information.fields.bil_city.value.o3_showError()">Please type in your name.</div>
						</div>

						<div class="clearfix-sm"></div>

						<span>Postal code</span>
		 				<div class="form-group" data-bind="css: { 'has-warning': edit_billing_information.fields.bil_zip.value.o3_showError() }">
		 					<input class="form-control" placeholder="" value="<?php echo o3_html($this->logged_user()->get('bil_zip')); ?>" name="bil_zip" type="text"
		 					data-bind="value: edit_billing_information.fields.bil_zip.value,
									   valueUpdate: 'keyup',
									   o3_validate: edit_billing_information.fields.bil_zip.value">
							<div class="warning" data-bind="visible: edit_billing_information.fields.bil_zip.value.o3_showError()">Please type in your name.</div>
						</div>

						<div class="clearfix-sm"></div>

						<span>Address</span>
		 				<div class="form-group" data-bind="css: { 'has-warning': edit_billing_information.fields.bil_address.value.o3_showError() }">
		 					<input class="form-control" placeholder="" value="<?php echo o3_html($this->logged_user()->get('bil_address')); ?>" name="bil_address" type="text"
		 					data-bind="value: edit_billing_information.fields.bil_address.value,
									   valueUpdate: 'keyup',
									   o3_validate: edit_billing_information.fields.bil_address.value">
							<div class="warning" data-bind="visible: edit_billing_information.fields.bil_address.value.o3_showError()">Please type in your name.</div>
						</div>

						<div class="clearfix-lg"></div>

						<div class="btns">
							<a href="<?php echo $this->o3_cms()->page_url( ACCOUNT_PAGE_ID ); ?>">Cancel</a> 
							<button class="btn" data-bind="click: edit_billing_information.submit">Save billing information</button>
						</div>

		 			</div>

				</div>
			</div>

		</div>
	
	<?php 

		//load header
		$this->view( 'o3_cms_template_view_footer' );

	?>

</body>
</html>