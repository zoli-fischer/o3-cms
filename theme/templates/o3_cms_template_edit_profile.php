<!DOCTYPE HTML>
<html lang="en">
<head>

	<?php 

		//load html head
		$this->view( 'o3_cms_template_view_html_head' );

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
	 		
		 			<form class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 gray-box">

		 				<span>Email</span>
		 				<div class="form-group">
		 					<input class="form-control" placeholder="" value="<?php echo o3_html($this->logged_user()->get('email')); ?>" name="email" type="email">
						</div>

						<div class="clearfix-sm"></div>

						<span>Confirm password</span>
		 				<div class="form-group">
		 					<input class="form-control" placeholder="" value="" name="password" type="password">
						</div>

						<div class="clearfix-sm"></div>

						<span>Mobile phone number</span>
		 				<div class="form-group">
		 					<input class="form-control" placeholder="" value="<?php echo o3_html($this->logged_user()->get('mobile')); ?>" name="mobile" type="text" maxlength="32">
						</div>

						<div class="clearfix-sm"></div>

						<span>Postal code</span>
		 				<div class="form-group">
		 					<input class="form-control" placeholder="" value="<?php echo o3_html($this->logged_user()->get('zip')); ?>" name="zip" type="text" maxlength="16">
						</div>

						<div class="clearfix-sm"></div>

						<span>Country</span>
		 				<div class="form-group">
		 					<input class="form-control" placeholder="" value="<?php echo o3_html($this->logged_user()->get('country')); ?>" name="country" type="text" readonly>
						</div>

						<div class="clearfix-sm"></div>

						<span>Gender</span>
		 				<div class="form-group">
		 					<select class="form-control form-control-selected" name="gender">
		 						<option value="male" <?php echo $this->logged_user()->get('gender') == 'male' ? 'selected' : ''; ?>>Male</option>
		 						<option value="female" <?php echo $this->logged_user()->get('gender') == 'female' ? 'selected' : ''; ?>>Female</option>
		 					</select>
						</div>

						<div class="clearfix-sm"></div>

						<span>Date of birth:</span>
						<div class="form-group form-group-date">
							<select class="form-control form-control-selected" name="bithdate_day">
								<?php
								for ( $i = 1; $i <= 31; $i++ )
									echo '<option value="'.$i.'" '.( $this->bday_day == $i ? 'selected' : '' ).' >'.$i.'</option>';
								?>
							</select>
							<select class="form-control form-control-selected" name="bithdate_month">
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
							<select class="form-control form-control-selected" name="bithdate_year">
								<?php
								for ( $i = date('Y'); $i >= date('Y') - 99; $i-- )
									echo '<option value="'.$i.'" '.( $this->bday_year == $i ? 'selected' : '' ).'>'.$i.'</option>';
								?>
							</select>	
						</div>

						<div class="clearfix-lg"></div>

						<div class="btns">
							<a href="/account">Cancel</a> 
							<button class="btn" type="submit">Save profile</button>
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