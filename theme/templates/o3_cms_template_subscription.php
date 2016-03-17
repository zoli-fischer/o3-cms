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
 	
 		<div id="subscription">
			
			<div class="container">
				<div class="row">

					<div class="col-md-12">
					
						<h2>Subscription and payment</h2>
						
					</div>

					<div class="clearfix-lg"></div>
	 		
		 			<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 white-box">

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

							<?php
							} else {
 	 						?>
						
								<p>Your subscription will automatically renew on <?php echo o3_html( $this->logged_user()->format_date( $this->logged_user()->get('subsciption_end') ) ); ?> and you'll be charged <?php echo $this->logged_user()->monthly_price() ?></p>

							<?php
							}
							?>	

							<hr> 

							<h6>Payment method</h6>

							<div class="clearfix-sm"></div>
							
							<?php 
							
							switch ($this->logged_user()->get('subscription_pay_type')) {
								case SNAFER_CARD:
									?>
									<p>Your Visa(************<?php echo o3_html($this->logged_user()->get('subscription_pay_card')); ?>) debit/credit card is used for payment.</p>
									<?php		
									break;
								case SNAFER_PAYPAL:
									?>
									<p>Your account at PayPal is used for payment.</p>
									<?php		
									break;
							}

							?>							

							<hr> 

							<a href="/update-payment-method" class="btn"><i class="fa fa-credit-card-alt"></i> Update payment method</a>

							<div class="clearfix-m"></div>

							<p>Would you like to <a href="#">cancel your subscription?</a></p>

							<?php							

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

				</div>
			</div>

		</div>
	
	<?php 

		//load header
		$this->view( 'o3_cms_template_view_footer' );

	?>

</body>
</html>