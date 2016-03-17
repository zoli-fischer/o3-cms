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

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<section class="parallax top-container" data-mobile="false" data-url="/res/parallax1.jpg" data-speed="3">

					<div class="container">
		        		<div class="row">
		            		<div class="col-md-10 col-md-offset-1">
		            			<h1>Great service and expertise<br>in everything we do</h1>
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

	<section id="premium"  class="hash-anchor" data-bind="visible: !logged_user.is_logged()">
		<div class="container">
			<div class="row">
				
				<div class="col-lg-8 col-lg-offset-2">
					<h2>Upload for <b>free</b> or subscribe to <b>Snafer Premium.</b></h2>
				</div>
			
			</div>
			<div class="row anchors">
				<div class="col-md-4 col-md-offset-2 col-sm-5 col-sm-offset-1">

					<div class="plan-box wow flipInX" data-wow-duration="1s" data-wow-delay=".3s">
						<p>Free</p>
						<b>kr 0,00 <span>/month</span></b>
						<small>&nbsp;</small>
						<hr />
						<ul>
							<li class="active"><i class="fa fa-check"></i> Shuffle play</li>
							<li><i class="fa fa-check"></i> Ad free</li>
							<li><i class="fa fa-check"></i> Unlimited skips</li>
							<li><i class="fa fa-check"></i> Listen offline</li>
							<li><i class="fa fa-check"></i> Play any track</li>
							<li><i class="fa fa-check"></i> High quality audio</li>
						</ul>
						<hr />
						<a href="/#sign-in" onclick="show_sign_up_form()" class="btn active">Get free</a>
					</div>

				</div>

				<div class="clearfix-lg visible-xs"></div>

				<div class="col-md-4 col-sm-5">
					
					<div class="plan-box plan-box-premium wow flipInX" data-wow-duration="1s" data-wow-delay=".5s">
						<p>Premium</p>
						<b>kr 99,00 <span>/month</span></b>
						<small>Start your 30 day free trial</small>
						<hr />
						<ul>
							<li class="active"><i class="fa fa-check"></i> Shuffle play</li>
							<li class="active"><i class="fa fa-check"></i> Ad free</li>
							<li class="active"><i class="fa fa-check"></i> Unlimited skips</li>
							<li class="active"><i class="fa fa-check"></i> Listen offline</li>
							<li class="active"><i class="fa fa-check"></i> Play any track</li>
							<li class="active"><i class="fa fa-check"></i> High quality audio</li>
						</ul>
						<hr />
						<a href="/#sign-in" onclick="show_sign_up_form()" class="btn btn-primary active">Get premium</a>
					</div>	

				</div>

			</div>
		</div>
	</section>

	<section id="sign-in" class="hash-anchor" data-bind="visible: !logged_user.is_logged()">
		<div class="container wow fadeIn" data-wow-duration="1s" data-wow-delay=".5s">
			<div class="row" data-bind="visible: !sign_in_up.is_show_sign_up_form()">
					
				<form id="sign-in-form" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" data-bind="submit: sign_in_up.sign_in_submit">

					<h2>Sign in</h2>

					<div class="error-msg" data-bind="text: sign_in_up.sign_in_error_msg(), visible: sign_in_up.sign_in_error_msg() != ''"></div>

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

					<p><a href="#">Forgot your username or password?</a></p>
					
					<p><br></p>

					<p>Don't have an account? <a href="#" data-bind="click: show_sign_up_form">Sign Up</a></p>

				</form>
 			</div>

			<div class="row" data-bind="visible: sign_in_up.is_show_sign_up_form()">

				<form id="sign-up-form" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" data-bind="submit: sign_in_up.sign_up_submit">
					
					<h2>Sign up</h2>

					<div class="error-msg" data-bind="text: sign_in_up.sign_up_error_msg(), visible: sign_in_up.sign_up_error_msg() != ''"></div>

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
						<input class="form-control" placeholder="Day" name="bithdate_day" type="text"
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
						<input class="form-control" placeholder="Year" name="bithdate_year" type="text"
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
						<div class="float-left">
							<a href="#" class="radio" data-bind="click: function(){ sign_in_up.sign_up_fields.gender.value('male') }, css: { 'active': sign_in_up.sign_up_fields.gender.value() == 'male' }"><span><i class="fa fa-circle"></i></span> Male</a>
						</div>	
						<div class="float-left radio-2nd">
							<a href="#" class="radio" data-bind="click: function(){ sign_in_up.sign_up_fields.gender.value('female') }, css: { 'active': sign_in_up.sign_up_fields.gender.value() == 'female' }"><span><i class="fa fa-circle"></i></span> Female</a>
						</div>

						<div class="clearfix"></div>

						<div class="warning">Please indicate your gender.</div>
					</div>

					<div class="clearfix"></div>

					<p><br></p>

					<p class="text-left"><small>By clicking on Sign up, you agree to <a href="/terms-and-policies" target="_blank">Snafer's terms & conditions and privacy policy</a></small></p>

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