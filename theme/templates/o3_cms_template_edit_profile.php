<!DOCTYPE HTML>
<html lang="en">
<head>

	<?php 

		//load html head
		$this->view( 'o3_cms_template_view_html_head' );

		//load change password app
		$this->parent->body_js(O3_CMS_THEME_DIR.'/js/snafer/snafer.edit.profile.app.js');

	?>

</head>
<body class="<?php echo o3_ua_body_classes(); ?>">	
	
	<?php
		
		//load header
		$this->view( 'o3_cms_template_view_header' );

	?>
 	
	 	<div id="edit-profile">
			
			<div class="container">
				<div class="row">

					<div class="col-md-12">
					
						<h2>Edit profile</h2>
						
					</div>

					<div class="clearfix-lg"></div>
	 		
		 			<div id="edit-profile-form" class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 form gray-box">

		 				<div class="success-msg" data-bind="text: edit_profile.success_msg(), css: { 'block': edit_profile.success_msg() != '' }"></div>

		 				<div class="error-msg" data-bind="text: edit_profile.error_msg(), css: { 'block': edit_profile.error_msg() != '' }"></div>
		 				
		 				<span>Email</span>
		 				<div class="form-group" data-bind="css: { 'has-warning': edit_profile.fields.email.error() }">
		 					<input class="form-control" placeholder="Please enter your email" value="<?php echo o3_html($this->logged_user()->get('email')); ?>" name="email" type="email"data-bind="value: edit_profile.fields.email.value,
										   	  valueUpdate: 'keyup'">

							<div class="warning" data-bind="visible: edit_profile.fields.email.error()">The email address you supplied is invalid.</div>
						</div>

						<div class="clearfix-sm"></div>

						<span>Confirm password</span>
		 				<div class="form-group" data-bind="css: { 'has-warning': edit_profile.fields.password.error() }">
		 					<input class="form-control" placeholder="Please enter your current password to confirm the changes" type="password" 
		 						data-bind="value: edit_profile.fields.password.value,
										   valueUpdate: 'keyup'">

							<div class="warning" data-bind="visible: edit_profile.fields.password.error()">Sorry, wrong password.</div>
						</div>


						<div class="clearfix-sm"></div>

						<span>Mobile phone number</span>
		 				<div class="form-group">
		 					<input class="form-control" placeholder="" value="<?php echo o3_html($this->logged_user()->get('mobile')); ?>" name="mobile" type="text" maxlength="32"
		 					data-bind="value: edit_profile.fields.mobile.value,
									   valueUpdate: 'keyup'">
						</div>

						<div class="clearfix-sm"></div> 

						<span>Country</span>
		 				<div class="form-group">
		 					<select class="form-control form-control-selected" name="country_id"
		 						data-bind="value: edit_profile.fields.country_id.value,
									   	   valueUpdate: 'keyup'">
		 						<?php		 						
		 							foreach ( o3_with(new snafer_countries)->select() as $key => $value ) {
		 								echo '<option value="'.$value->id.'" '.( $value->id == $this->logged_user()->country()->get('id') ? 'selected' : '' ).'>'.ucfirst(strtolower(o3_html($value->name))).'</option>';
		 							}
		 						?>
		 					</select>
						</div>

						<div class="clearfix-sm"></div>

						<span>Gender</span>
		 				<div class="form-group">
		 					<select class="form-control form-control-selected" name="gender"
		 						data-bind="value: edit_profile.fields.gender.value,
									   	   valueUpdate: 'keyup'">
		 						<option value="male" <?php echo $this->logged_user()->get('gender') == 'male' ? 'selected' : ''; ?>>Male</option>
		 						<option value="female" <?php echo $this->logged_user()->get('gender') == 'female' ? 'selected' : ''; ?>>Female</option>
		 					</select>
						</div>

						<div class="clearfix-sm"></div>

						<span>Date of birth:</span>
						<div class="form-group form-group-date">
							<select class="form-control form-control-selected" name="bday_day" maxlength="2"
								data-bind="value: edit_profile.fields.bday_day.value,
									   	   valueUpdate: 'keyup'">
								<?php
								for ( $i = 1; $i <= 31; $i++ )
									echo '<option value="'.$i.'" '.( $this->bday_day == $i ? 'selected' : '' ).' >'.$i.'</option>';
								?>
							</select>
							<select class="form-control form-control-selected" name="bday_month"
								data-bind="value: edit_profile.fields.bday_month.value,
									   	   valueUpdate: 'keyup'">
								<option value="1" <?php echo $this->bday_month == 1 ? 'selected' : ''; ?>>January</option>
								<option value="2" <?php echo $this->bday_month == 2 ? 'selected' : ''; ?>>February</option>
								<option value="3" <?php echo $this->bday_month == 3 ? 'selected' : ''; ?>>March</option>
								<option value="4" <?php echo $this->bday_month == 4 ? 'selected' : ''; ?>>April</option>
								<option value="5" <?php echo $this->bday_month == 5 ? 'selected' : ''; ?>>May</option>
								<option value="6" <?php echo $this->bday_month == 6 ? 'selected' : ''; ?>>June</option>
								<option value="7" <?php echo $this->bday_month == 7 ? 'selected' : ''; ?>>July</option>
								<option value="8" <?php echo $this->bday_month == 8 ? 'selected' : ''; ?>>August</option>
								<option value="9" <?php echo $this->bday_month == 9 ? 'selected' : ''; ?>>September</option>
								<option value="10" <?php echo $this->bday_month == 10 ? 'selected' : ''; ?>>October</option>
								<option value="11" <?php echo $this->bday_month == 11 ? 'selected' : ''; ?>>November</option>
								<option value="12" <?php echo $this->bday_month == 12 ? 'selected' : ''; ?>>December</option>
							</select>
							<select class="form-control form-control-selected" name="bday_year" maxlength="4"
								data-bind="value: edit_profile.fields.bday_year.value,
									   	   valueUpdate: 'keyup'">
								<?php
								for ( $i = date('Y'); $i >= date('Y') - 99; $i-- )
									echo '<option value="'.$i.'" '.( $this->bday_year == $i ? 'selected' : '' ).'>'.$i.'</option>';
								?>
							</select>	
						</div>

						<div class="clearfix-lg"></div>

						<div class="btns">
							<a href="<?php echo $this->o3_cms()->page_url( ACCOUNT_PAGE_ID ); ?>">Cancel</a> 
							<button class="btn" data-bind="click: edit_profile.submit">Save profile</button>
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