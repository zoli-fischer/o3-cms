<!DOCTYPE HTML>
<html lang="en">
<head>

	<!--GOOGLE MAP-->
	<script src="//maps.google.com/maps/api/js?sensor=false"></script>

	<?php 

		//load html head
		$this->view( 'o3_cms_template_view_html_head' );

		//load feedback app
		$this->parent->body_js(O3_CMS_THEME_DIR.'/js/snapfer/snapfer.feedback.app.js');

		//google map
		$this->parent->body_js(O3_CMS_THEME_DIR.'/lib/jquery.rd-google-map.js');

	?>

</head>
<body class="<?php echo o3_ua_body_classes(); ?>">	
	
	<?php
		
		//insert Google Analytics code
		$this->ga_script();
		
		//load header
		$this->view( 'o3_cms_template_view_header' );

	?>
 
	<form id="feedback-form" data-bind="submit: feedback.submit">

		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<h1>Contact us</h1>
					<p>If you have any question or feedback don't hesitate to write to us.</p>
					<div class="clearfix-xl"></div>
				</div>
				<div class="col-md-4">
					
					<div class="form-group">
						<input class="form-control" placeholder="Your name" name="name" type="text" value="<?php echo o3_html($this->logged_user()->get('username') ); ?>" 
							data-bind="value: feedback.fields.name.value"  />
					</div>

				</div>
				<div class="col-md-4">
					
					<div class="form-group">
						<input class="form-control" placeholder="Your email address" name="email" type="text" value="<?php echo o3_html($this->logged_user()->get('email') ); ?>" 
							data-bind="value: feedback.fields.email.value" />
					</div>

				</div>
				<div class="col-md-4">
					
					<div class="form-group">
						<input class="form-control" placeholder="Your phone" name="phone" type="text" 
							data-bind="value: feedback.fields.phone.value" />
					</div>

				</div>


				<div class="col-md-12">
					
					<div class="form-group textarea">
						<textarea class="form-control" placeholder="Your message..." name="message" data-bind="value: feedback.fields.message.value"><?php echo isset($_GET['tr']) ? "Hello Snapfer,\n\nI found some problem with the transfer on ".o3_html(o3_get('tr'))."\n\nThe problem is about..." : ''; ?></textarea>
					</div>

					<button type="submit" class="btn" data-bind="enable: !feedback.loading()">Send</button>

				</div>
			</div>			
		</div>

	</form>

	<!--
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<section class="parallax top-container" data-mobile="false" data-url="/res/parallax6.jpg" data-speed="3">

					<div class="container">
		        		<div class="row">
		            		<div class="col-md-10 col-md-offset-1">
		            			<h1>Contact</h1>
		            		</div>
		            	</div>
		            </div>

				</section>
			</div>
		</div>
	</div> 
	-->

	<section>
		<div id="contact-information">
			<div class="container">	
				<div class="row">
					<div class="col-sm-12">
						<h2>Contact information</h2>
					</div>
					<div class="col-xs-8 col-xs-offset-2 col-lg-4 col-lg-offset-4">
						<h5>Snapfer</h5>
						<address>Lumbyvej 11C, Odense 5250, Denmark</address>
						<p>Phone: <a href="callto:#">+40 33 33 555</a></p>
						<p>E-mail: <a href="mailto:contact@snapfer.com" class="text-primary">contact@snapfer.com</a></p>

						<div class="clearfix-xl"></div>
					</div>				
				</div>
			</div>
		</div>

	 	<!--Map-->
	    <div>
	        <div class="map">
	            <div id="google-map" class="map_model"></div>
	            <ul class="map_locations">
	                <li data-y="55.417861" data-x="10.376450">
	                    <p>Lumbyvej 11C, Odense 5250, Denmark</p>
	                </li>
	            </ul>
	        </div>
	    </div>
    	<!--END Map-->
    </section>

	<?php 

		//load header
		$this->view( 'o3_cms_template_view_footer' );

	?>

</body>
</html>