<!DOCTYPE HTML>
<html lang="en">
<head>

	<?php 

		//load html head
		$this->view( 'o3_cms_template_view_html_head' );


		//load cancel subscription app
		$this->parent->body_js(O3_CMS_THEME_DIR.'/js/snapfer/snapfer.cancel.subscription.app.js');		

	?>

</head>
<body class="<?php echo o3_ua_body_classes(); ?>">	
	
	<?php
		
		//load header
		$this->view( 'o3_cms_template_view_header' );

	?>

	<div data-bind="visible: !cancel_subsciption.canceled()">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<section class="top-container" style="background-image: url(/res/top-cancel-sub.jpg)">

						<div class="container">
			        		<div class="row">
			            		<div class="col-md-10 col-md-offset-1">
			            			<h1>We're sorry you're thinking of leaving us</h1>
			            		</div>
			            	</div>
			            </div>

					</section>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-offset-2 text-center"> 

					<div class="clearfix-xl"></div>

					<div class="error-msg" data-bind="text: cancel_subsciption.error_msg(), css: { block: cancel_subsciption.error_msg() != '' }"></div>

					<h3>Are you sure you want to cancel your subsciprion?</h3>				

					<div class="clearfix-m"></div>
				</div>
				<div class="col-sm-2 col-sm-offset-2 col-md-offset-3 text-center"> 

					<a href="<?php echo $this->o3_cms()->page_url(ACCOUNT_PAGE_ID); ?>" data-bind="css: { disabled: cancel_subsciption.loading() }" class="btn btn-primary">Keep subsciption</a>

					<div class="clearfix-m"></div>

				</div>
				<div class="col-sm-2 col-sm-offset-2 text-center">				

					<button class="btn" data-bind="click: cancel_subsciption.cancel, enable: !cancel_subsciption.loading()">Cancel subsciption</button>				

					<div class="clearfix-m"></div>
					
				</div>
				
				<div class="clearfix-m"></div>

			</div>		
		</div>
	</div>

	<div data-bind="visible: cancel_subsciption.canceled()">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<section class="top-container" style="background-image: url(/res/top-canceled-sub.jpg)">

						<div class="container">
			        		<div class="row">
			            		<div class="col-md-10 col-md-offset-1">
			            			<h1>We're sorry you're left us</h1>
			            		</div>
			            	</div>
			            </div>

					</section>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center"> 

					<div class="clearfix-xl"></div>

					<h3>Your Snapfer Premium subscription was cancelled.</h3>	

					<div class="clearfix-m"></div>

					<p>You can come back anytime!</p>

					<div class="clearfix-xl"></div>
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