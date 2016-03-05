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

	<section id="about">

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

	<section id="premium">
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	</section>

	<section id="sign-in">
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	</section>
	
	<?php 

		//load header
		$this->view( 'o3_cms_template_view_footer' );

	?>

</body>
</html>