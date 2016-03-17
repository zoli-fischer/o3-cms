<!DOCTYPE HTML>
<html lang="en">
<head>

	<!--GOOGLE MAP-->
	<script src="//maps.google.com/maps/api/js?sensor=false"></script>

	<?php 

		//load html head
		$this->view( 'o3_cms_template_view_html_head' );

		//google map
		$this->parent->body_js(O3_CMS_THEME_DIR.'/lib/jquery.rd-google-map.js');

	?>

</head>
<body class="<?php echo o3_ua_body_classes(); ?>">	
	
	<?php
		
		//load header
		$this->view( 'o3_cms_template_view_header' );

	?>

	<form id="feedback">

		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<h1>Feedback</h1>
					<div class="clearfix-xl"></div>
				</div>
				<div class="col-md-4">
					
					<div class="form-group">
						<input class="form-control" placeholder="Your name" name="name" type="text">
					</div>

				</div>
				<div class="col-md-4">
					
					<div class="form-group">
						<input class="form-control" placeholder="Your email address" name="email" type="text">
					</div>

				</div>
				<div class="col-md-4">
					
					<div class="form-group">
						<input class="form-control" placeholder="Your phone" name="phone" type="text">
					</div>

				</div>


				<div class="col-md-12">
					
					<div class="form-group textarea">
						<textarea class="form-control" placeholder="Your message..." name="message"></textarea>
					</div>

					<button type="submit" class="btn">Send</button>

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

	<section id="contact-information">
		<div class="container">	
			<div class="row">
				<div class="col-sm-12">
					<h2>Contact information</h2>
				</div>
				<div class="col-xs-8 col-xs-offset-2 col-lg-4 col-lg-offset-0">
					<h5>8901 Marmora Road, Glasgow, D04 89GR.</h5>
					<p>Freephone: <a href="callto:#">+1 800 559 6580</a></p>
					<p>Telephone: <a href="callto:#">+1 800 603 6035</a></p>
					<p>FAX: <a href="callto:#">+1 800 889 9898</a></p>
					<p>E-mail: <a href="mailto:#" class="text-primary">mail@demolink.org</a></p>

					<div class="clearfix-xl"></div>
				</div>
				<div class="col-xs-8 col-xs-offset-2 col-lg-4 col-lg-offset-0">
					<h5>9863 - 9867 Mill Road, Cambridge, MG09 99HT.</h5>
					<p>Freephone: <a href="callto:#">+1 800 559 6580</a></p>
					<p>Telephone: <a href="callto:#">+1 800 603 6035</a></p>
					<p>FAX: <a href="callto:#">+1 800 889 9898</a></p>
					<p>E-mail: <a href="mailto:#" class="text-primary">mail@demolink.org</a></p>

					<div class="clearfix-xl"></div>
				</div>
				<div class="col-xs-8 col-xs-offset-2 col-lg-4 col-lg-offset-0">
					<h5>9870 St Vincent Place, Glasgow, DC 45 Fr 45. </h5>
					<p>Freephone: <a href="callto:#">+1 800 559 6580</a></p>
					<p>Telephone: <a href="callto:#">+1 800 603 6035</a></p>
					<p>FAX: <a href="callto:#">+1 800 889 9898</a></p>
					<p>E-mail: <a href="mailto:#" class="text-primary">mail@demolink.org</a></p>

					<div class="clearfix-xl"></div>
				</div>
			</div>
		</div>
	</section>

	 <!--Map-->
    <section>
        <div class="map">
            <div id="google-map" class="map_model"></div>
            <ul class="map_locations">
                <li data-x="-73.9874068" data-y="40.643180">
                    <p> 9870 St Vincent Place, Glasgow, DC 45 Fr 45. <span>800 2345-6789</span></p>
                </li>
            </ul>
        </div>
    </section>
    <!--END Map-->

	<?php 

		//load header
		$this->view( 'o3_cms_template_view_footer' );

	?>

</body>
</html>