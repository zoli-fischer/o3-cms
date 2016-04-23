<!DOCTYPE HTML>
<html lang="en">
<head>

	<?php 

		//load html head
		$this->view( 'o3_cms_template_view_html_head' );

		//load file upload app
		$this->parent->body_js(O3_CMS_THEME_DIR.'/js/snafer/snafer.upload.app.js');

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
				<section class="top-container small" style="background-image: url(/res/top-frontpage.jpg)">

					<div class="container">
		        		<div class="row">
		            		<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" id="upload">
		            			
		            			<div id="upload-form" class="form wow fadeIn" data-wow-duration="0.4s" data-wow-delay=".5s">
		            				
		            				<div data-bind="o3_slideVisible: upload.uploading()">
		            					<h2>Transfering</h2>
		            					<span class="clearfix-sm"></span>

		            					<div>

		            						<div class="uploader">
		            							
		            							<span data-bind="html: o3_number_format( upload.uploading_percent(), 0, '.' )+'<small>%</small>'"></span>
		            							<div>
		            								<div data-bind="style: { width: ( 100 - upload.uploading_percent() )+'%' }"></div>
		            							</div>

		            						</div>

		            						<span class="clearfix-sm"></span>

		            					</div>
		            					<div class="align-center">
		            						<button class="btn" data-bind="click: upload.cancel">Cancel</button>
		            					</div>
		            				</div>

		            				<div data-bind="o3_slideVisible: upload.transfered() ">
		            					<h2>Transfer completed</h2>
		            					<span class="clearfix-sm"></span>

		            					<div>	

											<div class="align-center">
		            							<big><i class="fa fa-check-circle"></i> Success!</big>
		            						</div>

		            						<div class="align-center" data-bind="o3_slideVisible: upload.is_type( SNAFER_TRANSFER_EMAIL )">		            						
		            							The download link was sent to the recepients.<br>
		            							<small><i class="fa fa-info-circle"></i> A confirmation email is sent to you.</small>
		            						</div>

		            						<div class="from" data-bind="o3_slideVisible: upload.is_type( SNAFER_TRANSFER_DOWNLOAD )">
				            					<span>Copy your download link:</span>
								 				<div class="form-group">
								 					<input class="form-control" type="input" readonly="readonly" />
												</div>
												<span class="clearfix-sm"></span>
												<div class="align-center">
					            					<button class="btn">Copy link</button>
					            				</div>
				            				</div>

				            				<div class="align-center" data-bind="o3_slideVisible: upload.is_type( SNAFER_TRANSFER_SOCIAL )">
				            					<button class="btn btn-facebook" data-bind="click: function(){ upload.share('facebook') }"><i class="fa fa-facebook"></i> Share on Facebook</button>
												<div class="clearfix-sm"></div>

												<button class="btn btn-google" data-bind="click: function(){ upload.share('google') }"><i class="fa fa-google-plus"></i> Share on Google +</button>										
												<div class="clearfix-sm"></div>

												<button class="btn btn-twitter" data-bind="click: function(){ upload.share('twitter') }"><i class="fa fa-twitter"></i> Share on Twitter</button>
												<div class="clearfix-sm"></div>

												<button class="btn btn-linkedin" data-bind="click: function(){ upload.share('linkedin') }"><i class="fa fa-linkedin"></i> Share on LinkedIn</button>
				            				</div>


		            					</div>
		            					<div class="align-center">
		            						<button class="btn btn-primary" data-bind="click: upload.reset">Okay</button>
		            					</div>
		            				</div>

			            			<div data-bind="o3_slideVisible: !upload.uploading() && !upload.transfered()">
			            				<h2>Send up to 2GB</h2>
			            				<small class="anchors">
			            					<br>
			            					<a href="/#premium">Register free</a> if you want to upload up to 4GB.<br>
			            					<a href="/#premium">Go Premium</a> if you want to upload up to 20GB.
			            				</small>

			            				<span class="clearfix-sm"></span>

			            				<div class="send-type"> 

			            					<div class="form-group">
												<div class="radio-1st">
													<a href="#" class="radio" data-bind="click: function(){ upload.type(SNAFER_TRANSFER_EMAIL); }, css: { 'active': upload.is_type( SNAFER_TRANSFER_EMAIL ) }"><span><i class="fa fa-circle"></i></span> Send by email</a>
												</div>	
												<div class="radio-2nd">
													<a href="#" class="radio" data-bind="click: function(){ upload.type(SNAFER_TRANSFER_DOWNLOAD); }, css: { 'active': upload.is_type( SNAFER_TRANSFER_DOWNLOAD ) }"><span><i class="fa fa-circle"></i></span> Grab a download link</a>
												</div>
												<div class="radio-3rd">
													<a href="#" class="radio" data-bind="click: function(){ upload.type(SNAFER_TRANSFER_SOCIAL); }, css: { 'active': upload.is_type( SNAFER_TRANSFER_SOCIAL ) }"><span><i class="fa fa-circle"></i></span> Share on social media</a>
												</div>

												<div class="clearfix"></div>
											</div>

											<small><i class="fa fa-info-circle"></i> Select the way you want to send your files.</small>

			            				</div>

			            				<div class="files">
			            					
			            					<a href="#" class="btn"><i class="fa fa-plus-square"></i> Add files</a>
			            				</div>

			            				<div class="receivers" data-bind="o3_slideVisible: upload.is_type( SNAFER_TRANSFER_EMAIL )">
			            					<!--<span>Recipients</span>-->
							 				<div class="form-group">
							 					<textarea class="form-control" placeholder="Recipient(s)"
							 						data-bind="value: upload.recipients"></textarea>				
							 					<small><i class="fa fa-info-circle"></i> Type in 1 or more email separated with comma.</small>
											</div>     					
			            				</div>

			            				<div class="from" data-bind="o3_slideVisible: upload.is_type( SNAFER_TRANSFER_EMAIL )">
			            					<!--<span>Your email</span>-->
							 				<div class="form-group">
							 					<input class="form-control" placeholder="Your email" value="" name="email" type="email" 
							 						data-bind="value: upload.email" />
							 					<small><i class="fa fa-info-circle"></i> You receive an email when the files have been downloaded.</small>
											</div>
			            				</div>

			            				<div class="message" data-bind="o3_slideVisible: upload.is_type( SNAFER_TRANSFER_EMAIL )">
			            					<!--<span>Message</span>-->
							 				<div class="form-group">
							 					<textarea class="form-control" placeholder="Message"></textarea>				
							 					<small><i class="fa fa-info-circle"></i> Optional. Send a message along with the files.</small>
											</div>
			            				</div>

			            				<div class="align-center">
		
											<div data-bind="o3_slideVisible: upload.is_type( SNAFER_TRANSFER_EMAIL )">		            					
			            						<button class="btn btn-primary" data-bind="click: upload.submit"><i class="fa fa-paper-plane"></i> Send files</button>
			            					</div>

			            					<div data-bind="o3_slideVisible: upload.is_type( SNAFER_TRANSFER_DOWNLOAD )">
												<button class="btn btn-primary" data-bind="click: upload.submit"><i class="fa fa-link"></i> Get download link</button>
											</div>

											<div data-bind="o3_slideVisible: upload.is_type( SNAFER_TRANSFER_SOCIAL )">
												<button class="btn btn-facebook" data-bind="click: function(){ upload.share('facebook') }"><i class="fa fa-facebook"></i> Share on Facebook</button>
												<div class="clearfix-sm"></div>

												<button class="btn btn-google" data-bind="click: function(){ upload.share('google') }"><i class="fa fa-google-plus"></i> Share on Google +</button>										
												<div class="clearfix-sm"></div>

												<button class="btn btn-twitter" data-bind="click: function(){ upload.share('twitter') }"><i class="fa fa-twitter"></i> Share on Twitter</button>
												<div class="clearfix-sm"></div>

												<button class="btn btn-linkedin" data-bind="click: function(){ upload.share('linkedin') }"><i class="fa fa-linkedin"></i> Share on LinkedIn</button>
											</div>

			            					<div class="clearfix-sm"></div>
			            					<small class="anchors"><i class="fa fa-info-circle"></i> The file(s) will be kept for 7 days. <br>
			            					<a href="/#premium">Register free</a> if you want to keep files up to 14 days.<br>
			            					<a href="/#premium">Go Premium</a> if you want to keep files up to 6 months.</small>
			            				</div>

			            			</div>
			            		</div>

		            		</div>
		            	</div>
		            </div>

				</section>
			</div>
		</div>
	</div>

	<section id="about" class="hash-anchor">

		<div>
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">

						<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in suscipit leo.</h2>
						<br /><br /><br />
						<h3>Cras convallis faucibus ex, sed eleifend elit rhoncus et. Nunc molestie volutpat eleifend. </h3>
						<br />
						<p>Donec volutpat tempus sapien et vehicula. Nullam nec tempus erat. Maecenas vitae egestas velit. Suspendisse potenti. Suspendisse potenti. Sed blandit mauris a felis commodo, eget iaculis ligula gravida. Integer luctus erat purus, et maximus quam facilisis eu.</p>
					
					</div>
				</div>

				<div class="images-group">
	                <div class="image-wrap-1 visible-md visible-lg wow slideInUp" data-wow-duration="1s" data-wow-delay=".8s">
	                    <img src="/res/page-1_img02.png" alt="" />
	                </div>
	                <div class="image-wrap-2 wow slideInUp" data-wow-duration="1s" data-wow-delay=".4s">
	                    <img src="/res/page-1_img03.png" alt="" />
	                </div>
	                <div class="image-wrap-3 visible-md visible-lg wow slideInUp" data-wow-duration="1s" data-wow-delay=".0s">
	                    <img src="/res/page-1_img04.png" alt="" />
	                </div>
	            </div>

			</div>
		</div>

		<div>
			<div class="container">
				<div class="row">
					<div class="col-md-12">

						<h2>Cras consequat aliquam ex sed laoreet. Nunc posuere enim eu rutrum auctor.</h2>
						
						<div class="clearfix-xl"></div>
						<div class="row">
							<div class="col-md-4 item-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
								<div class="circle">
									<i class="fa fa-clock-o"></i>
								</div>
								<div class="clearfix-m"></div>
								<h5>Real-Time Device Intelligence</h5>
							</div>	
							<div class="col-md-4 item-2 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
								<div class="circle">
									<i class="fa fa-cloud"></i>
								</div>
								<div class="clearfix-m"></div>
								<h5>Mobile Publishing</h5>
							</div>
							<div class="col-md-4 item-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".7s">
								<div class="circle">
									<i class="fa fa-list-alt"></i>
								</div>
								<div class="clearfix-m"></div>
								<h5>Mobile Specific Domain</h5>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		
		<div>
			<div class="container">
				<!--
				<div class="row">
					<div class="col-md-10 col-md-offset-1 desc">						
						<p>Works on all major devices and web browsers</p>
					</div>
				</div>
				-->
				<div class="row items">
					<div class="col-xs-1 col-xs-offset-2">
						<i class="fa fa-windows"></i>
					</div>
					<div class="col-xs-1">
						<i class="fa fa-apple"></i>
					</div>
					<div class="col-xs-1">
						<i class="fa fa-android"></i>
					</div>
					<div class="col-xs-1"> 
						<i class="fa fa-edge"></i>
					</div>
					<div class="col-xs-1"> 
						<i class="fa fa-safari"></i>
					</div>
					<div class="col-xs-1"> 
						<i class="fa fa-chrome"></i>
					</div>
					<div class="col-xs-1">
						<i class="fa fa-firefox"></i>
					</div>
					<div class="col-xs-1"> 
						<i class="fa fa-opera"></i>
					</div>
				</div>
			</div>
		</div>

	</section>

	<section id="premium"  class="hash-anchor">
		<div class="container">
			<div class="row">
				
				<div class="col-lg-8 col-lg-offset-2">
					<h2>Upload for <b>free</b> or subscribe to <b>Snafer Premium.</b></h2>
				</div>
			
			</div>
			<div class="row anchors">
				<div class="col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2">

					<div class="plan-box wow flipInX" data-wow-duration="1s" data-wow-delay=".3s">
						<p>Free</p>						
						<b><?php echo o3_html($this->country()->format_price(0)); ?><span>/month</span></b>
						<small data-bind="visible: !logged_user.is_logged() || logged_user.allow_trial()">&nbsp;</small>
						<hr />
						<ul>
							<li class="active"><i class="fa fa-check"></i> Send up to 4GB per upload</li>
							<li><i class="fa fa-check"></i> Transfer expire in 14 days</li>
							<li><i class="fa fa-check"></i> Transfer history up to 2 months</li>
							<li class="hidden-sm"><br></li>
							<li class="hidden-sm"><br></li>
							<li class="hidden-sm"><br></li>
						</ul>
						<hr />
						<a href="/#sign-in" onclick="show_sign_up_form(SNAFER_FREE)" class="btn active" data-bind="visible: !logged_user.is_logged()">Get Free</a>
						
						<!--<a href="<?php echo $this->o3_cms()->page_url( CANCEL_SUBSCRIPTION_PAGE_ID ); ?>" class="btn active" data-bind="visible: logged_user.is_logged() && logged_user.is_premium()">Get back to Free</a>-->

						<span data-bind="visible: logged_user.is_logged() && !logged_user.is_premium()"><i class="fa fa-check"></i> You're currently Snafer Free</span>
					</div>

				</div>

				<div class="clearfix-lg visible-xs"></div>

				<div class="col-md-5 col-lg-4">
					
					<div class="plan-box plan-box-premium wow flipInX" data-wow-duration="1s" data-wow-delay=".5s">
						<p>Premium</p>
						<b><?php echo o3_html($this->country()->monthly_price()); ?><span>/month</span></b>
						<small data-bind="visible: !logged_user.is_logged() || logged_user.allow_trial()">Start your 30 day free trial</small>						
						<hr />
						<ul>
							<li class="active"><i class="fa fa-check"></i> Send up to 20GB per upload</li>
							<li><i class="fa fa-check"></i> Transfer expire in 6 months</li>
							<li><i class="fa fa-check"></i> Transfer history up to 6 months</li>
							<li><i class="fa fa-check"></i> Ad free</li>
							<li><i class="fa fa-check"></i> Secure transfer with password</li>
							<li><i class="fa fa-check"></i> Customize transfer</li>
						</ul>
						<hr />
						<a href="/#sign-in" onclick="show_sign_up_form(SNAFER_PREMIUM)" class="btn btn-primary active" data-bind="visible: !logged_user.is_logged()">Get Premium</a>
						<a href="/#get-premium" class="btn btn-primary active" data-bind="visible: logged_user.is_logged() && !logged_user.is_premium()">Get  Premium</a>
						<span data-bind="visible: logged_user.is_logged() && logged_user.is_premium()"><i class="fa fa-check"></i> You're currently Snafer Premium</span>
					</div>	

				</div>

			</div>
		</div>
	</section>

	<section id="get-premium" class="hash-anchor" data-bind="visible: logged_user.is_logged() && !logged_user.is_premium()">
		<div class="container wow fadeIn" data-wow-duration="1s" data-wow-delay=".5s">
			<div class="row">
				<form id="get-premium-form" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" data-bind="submit: sign_in_up.go_premium_submit">

					<h2>Go Premium</h2>	

					<p>Premium - <?php echo o3_html($this->country()->monthly_price()); ?><small>/month</small></p>

					<div class="clearfix clearfix-sm"></div>					

					<div class="error-msg" data-bind="text: sign_in_up.go_premium_error_msg(), css: { block: sign_in_up.go_premium_error_msg() != '' }"></div>					

					<h3 class="text-left">Billing information</h3>					

					<div class="clearfix clearfix-sm"></div>
					
					<div class="form-group" data-bind="css: { 'has-warning': sign_in_up.go_premium_fields.bil_name.value.o3_showError() }">
						<input class="form-control" placeholder="Name / Company" name="bil_name" type="text" value="<?php echo o3_html($this->logged_user()->get('bil_name')); ?>" 
							data-bind="value: sign_in_up.go_premium_fields.bil_name.value,
									   valueUpdate: 'keyup',
									   o3_validate: sign_in_up.go_premium_fields.bil_name.value">
						<div class="warning" data-bind="visible: sign_in_up.go_premium_fields.bil_name.value.o3_showError()">Please type in your name.</div>
					</div>

					<?php
					if ( $this->country()->has_vat() ) {
					?>
					<div class="form-group">
						<input class="form-control" placeholder="Vat nr." name="bil_vat" type="text" value="<?php echo o3_html($this->logged_user()->get('bil_vat')); ?>" 
							data-bind="value: sign_in_up.go_premium_fields.bil_vat.value,
									   valueUpdate: 'keyup',
									   o3_validate: sign_in_up.go_premium_fields.bil_vat.value">						
					</div>
					<?php
					}
					?>

					<div class="form-group">
						<input class="form-control" placeholder="Country" type="text" readonly="readonly" value="<?php echo ucfirst(strtolower(o3_html($this->country()->get('name')))); ?>">						
					</div>

					<p class="text-left"><small>To changing your country go to <a href="<?php echo $this->o3_cms()->page_url( EDIT_PROFILE_PAGE_ID ); ?>">edit profile page</a>.</small></p>

					<div class="clearfix-xs"></div>

					<div class="form-group" data-bind="css: { 'has-warning': sign_in_up.go_premium_fields.bil_city.value.o3_showError() }">
						<input class="form-control" placeholder="City" name="bil_city" type="text" value="<?php echo o3_html($this->logged_user()->get('bil_city')); ?>" 
							data-bind="value: sign_in_up.go_premium_fields.bil_city.value,
									   valueUpdate: 'keyup',
									   o3_validate: sign_in_up.go_premium_fields.bil_city.value">
						<div class="warning" data-bind="visible: sign_in_up.go_premium_fields.bil_city.value.o3_showError()">Please type in your city.</div>
					</div>

					<div class="form-group" data-bind="css: { 'has-warning': sign_in_up.go_premium_fields.bil_zip.value.o3_showError() }">
						<input class="form-control" placeholder="Postal code" name="bil_zip" type="text" value="<?php echo o3_html($this->logged_user()->get('bil_zip')); ?>" 
							data-bind="value: sign_in_up.go_premium_fields.bil_zip.value,
									   valueUpdate: 'keyup',
									   o3_validate: sign_in_up.go_premium_fields.bil_zip.value">
						<div class="warning" data-bind="visible: sign_in_up.go_premium_fields.bil_zip.value.o3_showError()">Please type in your postal code.</div>
					</div>

					<div class="form-group" data-bind="css: { 'has-warning': sign_in_up.go_premium_fields.bil_address.value.o3_showError() }">
						<input class="form-control" placeholder="Address" name="bil_address" type="text" value="<?php echo o3_html($this->logged_user()->get('bil_address')); ?>" 
							data-bind="value: sign_in_up.go_premium_fields.bil_address.value,
									   valueUpdate: 'keyup',
									   o3_validate: sign_in_up.go_premium_fields.bil_address.value">
						<div class="warning" data-bind="visible: sign_in_up.go_premium_fields.bil_address.value.o3_showError()">Please type in your address.</div>
					</div>


					<p><br></p>

					<p class="text-left"><small>By clicking on Go Premium, you agree to <a href="<?php echo $this->o3_cms()->page_url( TERMS_PAGE_ID ); ?>" target="_blank">Snafer's terms & conditions and privacy policy</a></small></p>

					<p><br></p>

					<button type="submit" class="btn btn-primary">Go Premium</button>

				</form>
			</div>
		</div>
	</section>

	<section id="sign-in" class="hash-anchor" data-bind="visible: !logged_user.is_logged()">
		<div class="container wow fadeIn" data-wow-duration="1s" data-wow-delay=".5s">
			<div class="row" data-bind="visible: !sign_in_up.is_show_sign_up_form()">
					
				<form id="sign-in-form" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" data-bind="submit: sign_in_up.sign_in_submit">

					<h2>Sign in</h2>

					<div class="error-msg" data-bind="text: sign_in_up.sign_in_error_msg(), css: { block: sign_in_up.sign_in_error_msg() != '' }"></div>

					<div class="form-group">
						<input class="form-control" placeholder="Username" name="username" type="text">
					</div>
					
					<div class="form-group">
						<input class="form-control" placeholder="Password" name="password" type="password">
					</div>

					<div class="row">
						<div class="col-md-6 text-left">
							
							<a href="#" data-bind="click: function(){ sign_in_up.sign_in_remember(!sign_in_up.sign_in_remember()); }, css: { 'active': sign_in_up.sign_in_remember() }" class="checkbox"><span><i class="fa fa-check"></i></span>  Remember me</a>
						
						</div>
						<div class="col-md-6 text-right">
						
							<button type="submit" class="btn btn-primary">Sign in</button>
						
						</div>
					</div>

					<p><br><br></p>

					<p><a href="<?php echo $this->o3_cms()->page_url(RESET_PASSWORD_PAGE_ID); ?>">Forgot your username or password?</a></p>
					
					<p><br></p>

					<p>Don't have an account? <a href="#" data-bind="click: show_sign_up_form">Sign Up</a></p>

				</form>
 			</div>

			<div class="row" data-bind="visible: sign_in_up.is_show_sign_up_form()">

				<form id="sign-up-form" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" data-bind="submit: sign_in_up.sign_up_submit">
					
					<h2>Sign up</h2>

					<div class="error-msg" data-bind="text: sign_in_up.sign_up_error_msg(), css: { block: sign_in_up.sign_up_error_msg() != '' }"></div>

					<div class="form-group">
						<div class="float-left radio-1st">
							<a href="#" class="radio" data-bind="click: function(){ sign_in_up.sign_up_form_type(SNAFER_FREE) }, css: { 'active': sign_in_up.sign_up_form_type() != SNAFER_PREMIUM }"><span><i class="fa fa-circle"></i></span> Free - <?php echo o3_html($this->country()->format_price(0)); ?><small>/month</small></a>
						</div>	
						<div class="float-left radio-2nd">
							<a href="#" class="radio" data-bind="click: function(){ sign_in_up.sign_up_form_type(SNAFER_PREMIUM) }, css: { 'active': sign_in_up.sign_up_form_type() == SNAFER_PREMIUM }"><span><i class="fa fa-circle"></i></span> Premium - <?php echo o3_html($this->country()->monthly_price()); ?><small>/month</small></a>
						</div>

						<div class="clearfix"></div>
					</div>

					<div class="form-group" data-bind="css: { 'has-warning': sign_in_up.sign_up_fields.username.value.o3_showError() }">
						<input class="form-control" placeholder="Username" name="username" type="text" 
							data-bind="value: sign_in_up.sign_up_fields.username.value,
									   valueUpdate: 'keyup',
									   o3_validate: sign_in_up.sign_up_fields.username.value" maxlength="32">
						<div class="warning" data-bind="visible: jQuery.trim(sign_in_up.sign_up_fields.username.value()).length == 0">Please choose a username.</div>
						<div class="warning" data-bind="visible: jQuery.trim(sign_in_up.sign_up_fields.username.value()).length > 0 && jQuery.trim(sign_in_up.sign_up_fields.username.value()).length < 4">Your username is too short.</div>
						<div class="warning" data-bind="visible: jQuery.trim(sign_in_up.sign_up_fields.username.value()).length >= 4 && !sign_in_up.sign_up_fields.username.available()">We're sorry, that username is not available.</div>
					</div>
					
					<div class="form-group" data-bind="css: { 'has-warning': sign_in_up.sign_up_fields.password.value.o3_showError() }">
						<input class="form-control" placeholder="Password" name="password" type="password"
							data-bind="value: sign_in_up.sign_up_fields.password.value,
									   valueUpdate: 'keyup',
									   o3_validate: sign_in_up.sign_up_fields.password.value"  maxlength="32">
						<div class="warning" data-bind="visible: jQuery.trim(sign_in_up.sign_up_fields.password.value()).length == 0">Please choose a password.</div>
						<div class="warning" data-bind="visible: jQuery.trim(sign_in_up.sign_up_fields.password.value()).length > 0 && jQuery.trim(sign_in_up.sign_up_fields.password.value()).length < 4">Your password is too short.</div> 
					</div>

					<div class="form-group" data-bind="css: { 'has-warning': sign_in_up.sign_up_fields.email.value.o3_showError() }">
						<input class="form-control" placeholder="Email" name="email" type="email"
							data-bind="value: sign_in_up.sign_up_fields.email.value,
									   valueUpdate: 'keyup',
									   o3_validate: sign_in_up.sign_up_fields.email.value">
						<div class="warning" data-bind="visible: jQuery.trim(sign_in_up.sign_up_fields.email.value()).length == 0">Please enter your email.</div>
						<div class="warning" data-bind="visible: !o3_valid_email(sign_in_up.sign_up_fields.email.value())">The email address you supplied is invalid.</div> 
						<div class="warning" data-bind="visible: o3_valid_email(sign_in_up.sign_up_fields.email.value()) && !sign_in_up.sign_up_fields.email.available()">We're sorry, that email is taken.</div>						
					</div>

					<p class="text-left">Date of birth:</p>
					<div class="form-group form-group-date" data-bind="css: { 'has-warning': sign_in_up.sign_up_fields.bday_day.value.o3_showError() || sign_in_up.sign_up_fields.bday_month.value.o3_showError() || sign_in_up.sign_up_fields.bday_year.value.o3_showError() }">
						<input class="form-control" placeholder="Day" name="bithdate_day" type="text" maxlength="2" 
							data-bind="value: sign_in_up.sign_up_fields.bday_day.value,
									   valueUpdate: 'keyup',
									   o3_validate: sign_in_up.sign_up_fields.bday_day.value">
						<select class="form-control" name="bithdate_month"
							data-bind="value: sign_in_up.sign_up_fields.bday_month.value,
									   valueUpdate: 'keyup',
									   o3_validate: sign_in_up.sign_up_fields.bday_month.value,
									   css: { 'form-control-selected': sign_in_up.sign_up_fields.bday_month.value() > 0 }">
							<option value="0">Month</option>
							<option value="1">January</option>
							<option value="2">February</option>
							<option value="3">March</option>
							<option value="4">April</option>
							<option value="5">May</option>
							<option value="6">June</option>
							<option value="7">July</option>
							<option value="8">August</option>
							<option value="9">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>
						</select>
						<input class="form-control" placeholder="Year" name="bithdate_year" type="text" maxlength="4"
							data-bind="value: sign_in_up.sign_up_fields.bday_year.value,
									   valueUpdate: 'keyup',
									   o3_validate: sign_in_up.sign_up_fields.bday_year.value">
						
						<div class="clearfix"></div>
						
						<div class="warning" data-bind="visible: jQuery.trim(sign_in_up.sign_up_fields.bday_day.value()).length == 0 && sign_in_up.sign_up_fields.bday_month.value() == 0 && jQuery.trim(sign_in_up.sign_up_fields.bday_year.value()).length == 0">When were you born?</div>
						<div class="warning" data-bind="visible: ( jQuery.trim(sign_in_up.sign_up_fields.bday_day.value()).length == 0 && ( sign_in_up.sign_up_fields.bday_month.value() > 0 || jQuery.trim(sign_in_up.sign_up_fields.bday_year.value()).length > 0 ) ) || ( jQuery.trim(sign_in_up.sign_up_fields.bday_day.value()).length > 0 && !sign_in_up.sign_up_fields.bday_day.value.o3_isValid() )">Please enter a valid day of the month.</div>
						<div class="warning" data-bind="visible: sign_in_up.sign_up_fields.bday_day.value.o3_isValid() && ( ( jQuery.trim(sign_in_up.sign_up_fields.bday_year.value()).length > 0 && !sign_in_up.sign_up_fields.bday_year.value.o3_isValid() ) || ( jQuery.trim(sign_in_up.sign_up_fields.bday_year.value()).length == 0 ) )">Please enter a valid year.</div>
						<div class="warning" data-bind="visible: false">Sorry, but you don't meet Spotify's age requirements.</div>
					</div>

					<div class="form-group" data-bind="css: { 'has-warning': sign_in_up.sign_up_fields.gender.value.o3_showError() }">
						<input type="hidden" name="gender"
							   data-bind="value: sign_in_up.sign_up_fields.gender.value,
									   valueUpdate: 'keyup',
									   o3_validate: sign_in_up.sign_up_fields.gender.value">
						<div class="float-left radio-1st">
							<a href="#" class="radio" data-bind="click: function(){ sign_in_up.sign_up_fields.gender.value('male') }, css: { 'active': sign_in_up.sign_up_fields.gender.value() == 'male' }"><span><i class="fa fa-circle"></i></span> Male</a>
						</div>	
						<div class="float-left radio-2nd">
							<a href="#" class="radio" data-bind="click: function(){ sign_in_up.sign_up_fields.gender.value('female') }, css: { 'active': sign_in_up.sign_up_fields.gender.value() == 'female' }"><span><i class="fa fa-circle"></i></span> Female</a>
						</div>

						<div class="clearfix"></div>

						<div class="warning">Please indicate your gender.</div>
					</div>

					<div class="clearfix clearfix-sm"></div>

					<div data-bind="visible: sign_in_up.sign_up_form_type() == SNAFER_PREMIUM">
						<h3 class="text-left">Billing information</h3>
						

						<div class="clearfix clearfix-sm"></div>
						
						<div class="form-group" data-bind="css: { 'has-warning': sign_in_up.sign_up_fields.bil_name.value.o3_showError() }">
							<input class="form-control" placeholder="Name / Company" name="bil_name" type="text" 
								data-bind="value: sign_in_up.sign_up_fields.bil_name.value,
										   valueUpdate: 'keyup',
										   o3_validate: sign_in_up.sign_up_fields.bil_name.value">
							<div class="warning" data-bind="visible: sign_in_up.sign_up_fields.bil_name.value.o3_showError()">Please type in your name.</div>
						</div>

						<?php
						if ( $this->country()->has_vat() ) {
						?>
						<div class="form-group">
							<input class="form-control" placeholder="Vat nr." name="bil_vat" type="text" 
								data-bind="value: sign_in_up.sign_up_fields.bil_vat.value,
										   valueUpdate: 'keyup',
										   o3_validate: sign_in_up.sign_up_fields.bil_vat.value">						
						</div>
						<?php
						}
						?>

						<div class="form-group">
							<input class="form-control" placeholder="Country" type="text" readonly="readonly" value="<?php echo ucfirst(strtolower(o3_html($this->country()->get('name')))); ?>">						
						</div>

						<div class="form-group" data-bind="css: { 'has-warning': sign_in_up.sign_up_fields.bil_city.value.o3_showError() }">
							<input class="form-control" placeholder="City" name="bil_city" type="text" 
								data-bind="value: sign_in_up.sign_up_fields.bil_city.value,
										   valueUpdate: 'keyup',
										   o3_validate: sign_in_up.sign_up_fields.bil_city.value">
							<div class="warning" data-bind="visible: sign_in_up.sign_up_fields.bil_city.value.o3_showError()">Please type in your city.</div>
						</div>

						<div class="form-group" data-bind="css: { 'has-warning': sign_in_up.sign_up_fields.bil_zip.value.o3_showError() }">
							<input class="form-control" placeholder="Postal code" name="bil_zip" type="text" 
								data-bind="value: sign_in_up.sign_up_fields.bil_zip.value,
										   valueUpdate: 'keyup',
										   o3_validate: sign_in_up.sign_up_fields.bil_zip.value">
							<div class="warning" data-bind="visible: sign_in_up.sign_up_fields.bil_zip.value.o3_showError()">Please type in your postal code.</div>
						</div>

						<div class="form-group" data-bind="css: { 'has-warning': sign_in_up.sign_up_fields.bil_address.value.o3_showError() }">
							<input class="form-control" placeholder="Address" name="bil_address" type="text" 
								data-bind="value: sign_in_up.sign_up_fields.bil_address.value,
										   valueUpdate: 'keyup',
										   o3_validate: sign_in_up.sign_up_fields.bil_address.value">
							<div class="warning" data-bind="visible: sign_in_up.sign_up_fields.bil_address.value.o3_showError()">Please type in your address.</div>
						</div>

					</div>

					<p><br></p>

					<p class="text-left"><small>By clicking on Sign up, you agree to <a href="<?php echo $this->o3_cms()->page_url( TERMS_PAGE_ID ); ?>" target="_blank">Snafer's terms & conditions and privacy policy</a></small></p>

					<p><br></p>

					<button type="submit" class="btn btn-primary">Sign up</button>

					<p><br><br></p>

					<p>Already have an account? <a href="#" data-bind="click: show_sign_in_form">Sign In</a></p>

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