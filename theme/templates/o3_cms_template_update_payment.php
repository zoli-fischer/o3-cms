<!DOCTYPE HTML>
<html lang="en">
<head>

	<?php 

		//load html head
		$this->view( 'o3_cms_template_view_html_head' );

		//load update payment app
		$this->parent->body_js(O3_CMS_THEME_DIR.'/js/snapfer/snapfer.update.payment.app.js');		

	?>

</head>
<body class="<?php echo o3_ua_body_classes(); ?>">	
	
	<?php
		
		//insert Google Analytics code
		$this->ga_script();
		
		//load header
		$this->view( 'o3_cms_template_view_header' );

	?>

	<div id="update-payment">
		
		<div class="container">
			<div class="row">

				<div class="col-md-12">
				
					<h2><?php echo !$this->logged_user()->has_payment() ? 'Add payment method' : 'Update payment method'; ?></h2>
				</div>
				
				<div class="clearfix-m"></div>

				<div class="col-md-6 col-md-offset-3">
					
					<p><?php echo $this->logged_user()->monthly_price() ?> per month.</p>

				</div>

				<div class="clearfix-m"></div>
 		
	 			<form id="update-payment-form" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" data-bind="submit: update_payment.submit">	 			

	 				<div class="error-msg" data-bind="text: update_payment.error_msg(), css: { block: update_payment.error_msg() != '' }"></div>

	 				<div data-bind="visible: update_payment.type() == 'card'">

	 					<div class="row">
							<div class="col-sm-9">

			 					<div class="form-group" data-bind="css: { 'has-warning': update_payment.fields.cardnumber.value.o3_showError() }">
			 						
			 						<p class="text-left">Card number</p>

									<input class="form-control lock-input" placeholder="1111222233334444" name="cardnumber" type="text" maxlength="16"
										data-bind="value: update_payment.fields.cardnumber.value,
												   valueUpdate: 'keyup',
												   o3_validate: update_payment.fields.cardnumber.value">
									
									<div class="warning" data-bind="visible: update_payment.fields.cardnumber.value.o3_showError()">Please enter a valid credit card number</div>

								</div>
							</div>
							<div class="col-sm-3 card-logo">


								<div class="clearfix-m hidden-xs"></div>
								<div class="clearfix-xs hidden-xs"></div>

								<img src="/res/visa_mastercard.png" alt="Visa, MasterCard" />								

							</div>
						</div>

						<div class="clearfix-m hidden-xs"></div>


						<div class="row">
							<div class="col-sm-8">
								
								<div class="form-group card-expiry" data-bind="css: { 'has-warning': update_payment.fields.expiry_month.value.o3_showError() || update_payment.fields.expiry_year.value.o3_showError() }">
			 						
			 						<p class="text-left">Expiry date</p>

			 						<div class="clearfix"></div>

									<select class="form-control" name="expiry-month" type="text" 
										data-bind="value: update_payment.fields.expiry_month.value,
												   valueUpdate: 'keyup',
												   o3_validate: update_payment.fields.expiry_month.value,
												   css: { 'form-control-selected': update_payment.fields.expiry_month.value() > 0 }">
										<option value="0">Month</option>	
										<?php 
										for ( $i = 1; $i <= 12;  $i++ ) { 
											echo "<option value='".$i."'>".( $i < 10 ? '0' : '' ).$i."</option>";
										}
										?>
									</select>

									<span>/</span>

									<select class="form-control" name="expiry-year" type="text" 
										data-bind="value: update_payment.fields.expiry_year.value,
												   valueUpdate: 'keyup',
												   o3_validate: update_payment.fields.expiry_year.value,
												   css: { 'form-control-selected': update_payment.fields.expiry_year.value() > 0 }">
										<option value="0">Year</option>	
										<?php 
										for ( $i = date('y'); $i <= date('y') + 29;  $i++ ) { 
											echo "<option value='".$i."'>".( $i < 10 ? '0' : '' ).$i."</option>";
										}
										?>
									</select>


									<div class="warning" data-bind="visible: update_payment.fields.expiry_month.value.o3_showError()">Please enter the expiration month</div>
									<div class="warning" data-bind="visible: update_payment.fields.expiry_year.value.o3_showError()">Please enter the expiration year</div>

								</div>

								


							</div>

							<div class="col-sm-4">

								<div class="clearfix-xs visible-xs-block"></div>

								<div class="form-group" data-bind="css: { 'has-warning': update_payment.fields.security_code.value.o3_showError() }">
			 						
			 						<p class="text-left">Security code</p>

									<input class="form-control lock-input security-code" name="security-code" type="text" maxlength="3"
										data-bind="value: update_payment.fields.security_code.value,
												   valueUpdate: 'keyup',
												   o3_validate: update_payment.fields.security_code.value">									

									<div class="warning" data-bind="visible: update_payment.fields.security_code.value.o3_showError()">Please enter the last 3 numbers on the back of your card.</div>

								</div>

							</div>

						</div>



	 				</div>

	 				<div data-bind="visible: update_payment.type() == 'paypal'">
	 					
	 					<p>Click the button below to login and pay with your Paypal account.</p>

	 				</div>

	 				<div class="clearfix-m"></div>

	 				<button type="submit" class="btn btn-primary"><?php echo !$this->logged_user()->has_payment() ? 'Add payment method' : 'Update payment method'; ?></button>


	 				<div class="clearfix-lg"></div>

					<p class="text-left">
	 					Want to use another payment method?
	 				</p>	

	 				<div class="clearfix-xs"></div>

	 				<p class="text-left" data-bind="visible: update_payment.type() != 'paypal'">
	 					<a href="#" title="Paypal" data-bind="click: function(){ update_payment.set_type('paypal'); }"><img src="/res/paypal.png" alt="Paypal" /></a>
					</p>

					<p class="text-left" data-bind="visible: update_payment.type() != 'card'">
	 					<a href="#" title="Visa, MasterCard" data-bind="click: function(){ update_payment.set_type('card'); }"><img src="/res/visa_mastercard.png" alt="Visa, MasterCard" /></a>
	 				</p>

	 			</form>
	 		</div>
	 	</div>

	</div>

	<div>		
		<div class="container">
			<div class="row">

				<div class="clearfix-lg"></div>

				<div class="col-md-6 col-md-offset-3">

					Snapfer will make an authorization on your card to verify it. This is an authorization only and NOT a charge. You hereby authorise Snapfer to charge you automatically every month until you cancel your subscription. 

					<div class="clearfix-m"></div>

					<p>Would you like to <a href="<?php echo $this->o3_cms()->page_url( CANCEL_SUBSCRIPTION_PAGE_ID ); ?>">cancel your subscription?</a></p>

				</div>

				<div class="clearfix-lg"></div>

			</div>
		</div>
	</div>
 	
	<?php 

		//load header
		$this->view( 'o3_cms_template_view_footer' );

	?>

</body>
</html>