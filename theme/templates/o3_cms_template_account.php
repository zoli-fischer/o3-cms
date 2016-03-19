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

	<div id="account-overview">
		
		<div class="container">
			<div class="row">

				<div class="col-md-12">
				
					<h2>Account overview</h2>
					
				</div>

				<div class="clearfix-lg"></div>

				<div class="col-md-6 white-box">
					
					<div>
						<h3>Profile</h3>

						<div class="clearfix-m"></div>

						<span>Username</span>
						<p><?php echo o3_html($this->logged_user()->get('username')); ?></p>
						
						<div class="clearfix-sm"></div>

						<span>Email</span>
						<p><?php echo o3_html($this->logged_user()->get('email')); ?></p>
							
						<div class="clearfix-sm"></div>
							
						<span>Date of birth</span>
						<p><?php echo o3_html( $this->logged_user()->format_date( $this->logged_user()->get('bday') ) ); ?></p>
						
						<div class="clearfix-sm"></div>

						<span>Country</span>
						<p><?php echo ucfirst(strtolower(o3_html($this->logged_user()->country()->get('name')))); ?></p>
						
						<div class="clearfix-m"></div>

						<a href="/edit-profile" class="btn"><i class="fa fa-pencil"></i> Edit profile</a>

						<div class="clearfix-sm"></div>

						<a href="/change-password" class="btn"><i class="fa fa-lock"></i> Change password</a>

					</div>

					<div class="hidden-sm">	
						<h3>Bills</h3>

						<div class="clearfix-sm"></div>

						<p>There is no bills to show.</p>

					</div>

				</div> 

				<div class="col-md-6 white-box">
					
					<div>	
						<h3>Snafer <?php echo ucfirst($this->logged_user()->get('subsciption_type')); ?></h3>
						
						<hr>
						
						<?php 
						//check for subscripbtion type
						if ( $this->logged_user()->is_premium() ) {

							//check if subscripbtion is paid
							if ( !$this->logged_user()->is_paid() ) {
							?>

								<div class="pay-error-box">
									<p><b>Your subscription payment failed.</b></p>
									<p>You will lose your subscription if we don't have a working payment method for your account, so please <a href="/update-payment-method">update your payment method</a>.</p>
									<p>We will retry your payment in a few days.</p>
								</div>

								<hr>

								<div class="clearfix-sm"></div>

								<a href="/subscription" class="btn">View details</a>

							<?php
							} else {
							?>

								<p>Your subscription will automatically renew on <?php echo o3_html( $this->logged_user()->format_date( $this->logged_user()->get('subsciption_end') ) ); ?> and you'll be charged <?php echo o3_html($this->logged_user()->monthly_price()); ?></p>
								
								<hr>

								<div class="clearfix-sm"></div>

								<a href="/subscription" class="btn">View details</a>

							<?php
							}

						} else {
						?>
						

							<p>TODO: no premium message</p>
						
							<hr>

							<div class="clearfix-sm"></div>

							<a href="/#premium" class="btn">Upgrade</a>

						<?php
						}
						?>
						
						
							
					</div>

					<div>	
						<h3>Billing information</h3>

						<div class="clearfix-m"></div>

						<span>Name / Company</span>
						<p><?php echo o3_html($this->logged_user()->get('bil_name') == '' ? '-' : $this->logged_user()->get('bil_name')); ?></p>
						
						<div class="clearfix-sm"></div>

						<?php
						if ( $this->logged_user()->country()->has_vat() ) {
						?>
							<span>Vat nr.</span>
							<p><?php echo o3_html($this->logged_user()->get('bil_vat') == '' ? '-' : $this->logged_user()->get('bil_vat')); ?></p>
								 
							<div class="clearfix-sm"></div>
						<?php
						}
						?>

						<span>Country</span>
						<p><?php echo ucfirst(strtolower(o3_html($this->logged_user()->country()->get('name')))); ?></p>	

						<div class="clearfix-sm"></div>
							
						<span>City</span>
						<p><?php echo o3_html($this->logged_user()->get('bil_city') == '' ? '-' : $this->logged_user()->get('bil_city')); ?></p>

						<div class="clearfix-sm"></div>
							
						<span>Postal code</span>
						<p><?php echo o3_html($this->logged_user()->get('bil_zip') == '' ? '-' : $this->logged_user()->get('bil_zip')); ?></p>


						<div class="clearfix-sm"></div>
							
						<span>Address</span>
						<p><?php echo o3_html($this->logged_user()->get('bil_address') == '' ? '-' : $this->logged_user()->get('bil_address')); ?></p>						

						<div class="clearfix-m"></div>

						<a href="/edit-billing-information" class="btn"><i class="fa fa-pencil"></i> Edit billing information</a>

					</div>

					<div class="visible-sm-block">	
						<h3>Bills</h3>

						<div class="clearfix-sm"></div>

						<p>There is no bills to show.</p>

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