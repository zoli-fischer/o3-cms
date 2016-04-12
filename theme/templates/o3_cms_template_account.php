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

						<a href="<?php echo $this->o3_cms()->page_url( EDIT_PROFILE_PAGE_ID ); ?>" class="btn"><i class="fa fa-pencil"></i> Edit profile</a>

						<div class="clearfix-sm"></div>

						<a href="<?php echo $this->o3_cms()->page_url( CHANGE_PASSWORD_PAGE_ID ); ?>" class="btn"><i class="fa fa-lock"></i> Change password</a>

					</div>

					<div class="hidden-xs payment-history">	
						<h3>Payment history</h3>

						<div class="clearfix-sm"></div>

						<?php
						$payments = $this->logged_user()->get_payments();
						if ( count($payments) > 0 ) {
						?>	
							<ul>
								<li>
									<span class="text-center">ID</span>
									<span>Date</span>
									<span>Amount</span>
									<span>Payment method</span>
									<span class="text-center">Invoice</span>
								</li>
								<?php
								foreach ( $payments as $key => $value ) {
									if ( $value->get('total_incl_vat') > 0 ) {
									?>
									<li>
										<span class="text-center"><?php echo o3_html( $value->get('id') ); ?></span>
										<span><?php echo o3_html( $this->logged_user()->format_date( $value->get('created') ) ); ?></span>
										<span><?php echo o3_html( $value->display_price( $value->get('total_incl_vat') ) ); ?></span>
										<span>
											<?php 
												switch ($value->get('subscription_pay_type')) {
												 	case SNAFER_PAYPAL:
												 		?>
												 		<i class="fa fa-cc-paypal"></i> Paypal
												 		<?php
												 		break;											 	
												 	case SNAFER_CARD:
												 		?>
												 		<i class="fa fa-credit-card"></i> Visa (<?php echo o3_html($value->get('subscription_pay_card')); ?>)
												 		<?php
												 		break;
												 } 
											?>
										</span>
										<span class="text-center"><a href="<?php echo $value->download_url(1); ?>" title="Download invoice"><i class="fa fa-cloud-download"></i></a></span>
									</li>
									<?php	
									}
								}
								?>
							</ul>
						<?php
						} else {
						?>	
							<p>There is no payments to show.</p>
						<?php
						}
						?>
						
					</div>

				</div> 

				<div class="col-md-6 white-box">
					
					<div>	
						<h3>Snafer <?php echo ucfirst($this->logged_user()->get('subsciption_type')); ?></h3>
						
						<hr>
						
						<?php 
						//check for subscripbtion type
						if ( $this->logged_user()->is_premium() ) {

							
							//check if subscribtion has payment
							if ( !$this->logged_user()->has_payment() ) {
							?>
								
								<div class="pay-error-box">
									<p><b>Your subscription payment failed.</b></p>
									<p>You will lose your subscription after the trial period ends if we don't have a working payment method for your account, so please <a href="<?php echo $this->o3_cms()->page_url( UPDATE_PAYMENT_METHOD_PAGE_ID ); ?>">add your payment method</a>.</p>									
								</div>

								<hr>

								<div class="clearfix-sm"></div>

								<a href="<?php echo $this->o3_cms()->page_url( SUBSCRIPTION_PAGE_ID ); ?>" class="btn">Add payment method</a>

							<?php
							} else if ( !$this->logged_user()->is_paid() ) { //check if subscripbtion is not paid
							?>

								<div class="pay-error-box">
									<p><b>Your subscription payment failed.</b></p>
									<p>You will lose your subscription if we don't have a working payment method for your account, so please <a href="<?php echo $this->o3_cms()->page_url( UPDATE_PAYMENT_METHOD_PAGE_ID ); ?>">update your payment method</a>.</p>
									<p>We will retry your payment in a few days.</p>
								</div>

								<hr>

								<div class="clearfix-sm"></div>

								<a href="<?php echo $this->o3_cms()->page_url( SUBSCRIPTION_PAGE_ID ); ?>" class="btn">View details</a>

							<?php
							} else {
							?>

								<p>Your subscription will automatically renew on <?php echo o3_html( $this->logged_user()->format_date( $this->logged_user()->get('subsciption_end') ) ); ?> and you'll be charged <?php echo o3_html($this->logged_user()->monthly_price()); ?></p>
								
								<hr>

								<div class="clearfix-sm"></div>

								<a href="<?php echo $this->o3_cms()->page_url( SUBSCRIPTION_PAGE_ID ); ?>" class="btn">View details</a>

							<?php
							}

						} else {
						?>
						

							<p>You're currently Snafer Free. With Free, your transfers'll have ads, and you won't be able to upload up to 20GB, or customize your transfers. Upgrade to Premium anytime you like. </p>
						
							<hr>

							<div class="clearfix-sm"></div>

							<a href="/#premium" class="btn">Upgrade</a>

						<?php
						}
						?>
						
						
							
					</div>

					<!-- Mobile payment history -->
					<div class="visible-xs-block payment-history"></div>

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

						<a href="<?php echo $this->o3_cms()->page_url( EDIT_BILLING_INFO_PAGE_ID ); ?>" class="btn"><i class="fa fa-pencil"></i> Edit billing information</a>

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