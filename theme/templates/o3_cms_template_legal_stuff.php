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
		
		//insert Google Analytics code
		$this->ga_script();
		
		//load header
		$this->view( 'o3_cms_template_view_header' );

	?>
	 
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<section class="top-container" style="background-image: url(/res/top-legal.jpg)">

					<div class="container">
		        		<div class="row">
		            		<div class="col-md-10 col-md-offset-1">
		            			<h1>Terms, conditions and policies of use</h1>
		            		</div>
		            	</div>
		            </div>

				</section>
			</div>
		</div>
	</div>  

	<section>
		<div id="legal-stuff">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
					  

						<br /><br /><br />
						<h3>Please download and read Snapfer's terms, conditions and policies of use</h3>
						<div class="clearfix-xl"></div>

					</div>
				</div>
			</div>
		</div>

		<div id="legal-stuff-pdf">
			<div class="container">
				<div class="row">
					<div class="col-md-12">


						<div class="row">
							<div class="col-sm-4 item-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
								<a href="/res/pdf/Terms and conditions of service.pdf" target="_blank">
									<div class="circle-small">
										<i class="fa fa-file-pdf-o"></i>
									</div>
									<div class="clearfix-m"></div>
									<span>Terms and conditions of service</span>
								</a>
							</div>	
							<div class="col-sm-4 item-2 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
								<a href="/res/pdf/Privacy Policy.pdf" target="_blank">
									<div class="circle-small">
										<i class="fa fa-file-pdf-o"></i>
									</div>
									<div class="clearfix-m"></div>
									<span>Privacy Policy</span>
								</a>
							</div>
							<div class="col-sm-4 item-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".7s">
								<a href="/res/pdf/Intellectual Property and Take Down Policy.pdf" target="_blank">
									<div class="circle-small">
										<i class="fa fa-file-pdf-o"></i>
									</div>
									<div class="clearfix-m"></div>
									<span>Intellectual Property and Take Down Policy</span>
								</a>
							</div>
						</div> 

						<div class="row">
							<div class="col-sm-4 item-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
								<a href="/res/pdf/Cookie Policy.pdf" target="_blank">
									<div class="circle-small">
										<i class="fa fa-file-pdf-o"></i>
									</div>
									<div class="clearfix-m"></div>
									<span>Cookie Policy</span>
								</a>
							</div>	
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