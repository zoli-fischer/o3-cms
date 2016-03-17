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
				<section class="parallax top-container" data-mobile="false" data-url="/res/parallax5.jpg" data-speed="3">

					<div class="container">
		        		<div class="row">
		            		<div class="col-md-10 col-md-offset-1">
		            			<h1>Terms & Policies</h1>
		            		</div>
		            	</div>
		            </div>

				</section>
			</div>
		</div>
	</div>  

	<section id="legal-stuff">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
				  

					<br /><br /><br />
					<h3>Cras convallis faucibus ex, sed eleifend elit rhoncus et. Nunc molestie volutpat eleifend. </h3>
					<br />
					<p>Donec volutpat tempus sapien et vehicula. Nullam nec tempus erat. Maecenas vitae egestas velit. Suspendisse potenti. Suspendisse potenti. Sed blandit mauris a felis commodo, eget iaculis ligula gravida. Integer luctus erat purus, et maximus quam facilisis eu.</p>

					
					<div class="clearfix-xl"></div>

				</div>
			</div>
		</div>
	</section>

	<section id="legal-stuff-pdf">
		<div class="container">
			<div class="row">
				<div class="col-md-12">


					<div class="row">
						<div class="col-sm-4 item-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
							<a href="">
								<div class="circle">
									<i class="fa fa-file-pdf-o"></i>
								</div>
								<div class="clearfix-m"></div>
								<h5>Terms of Service</h5>
							</a>
						</div>	
						<div class="col-sm-4 item-2 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
							<a href="">
								<div class="circle">
									<i class="fa fa-file-pdf-o"></i>
								</div>
								<div class="clearfix-m"></div>
								<h5>Privacy Policy</h5>
							</a>
						</div>
						<div class="col-sm-4 item-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".7s">
							<a href="">
								<div class="circle">
									<i class="fa fa-file-pdf-o"></i>
								</div>
								<div class="clearfix-m"></div>
								<h5>Notice and Take Down Policy</h5>
							</a>
						</div>
					</div> 

					<div class="row">
						<div class="col-sm-4 item-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
							<a href="">
								<div class="circle">
									<i class="fa fa-file-pdf-o"></i>
								</div>
								<div class="clearfix-m"></div>
								<h5>Cookie Policy</h5>
							</a>
						</div>	
					</div> 
					

				</div>
			</div>
		</div>
	</section>

	<?php 

		//load header
		$this->view( 'o3_cms_template_view_footer' );

	?>

</body>
</html>