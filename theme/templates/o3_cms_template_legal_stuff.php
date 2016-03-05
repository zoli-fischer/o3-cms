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
	
	<!--
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<section class="parallax top-container" data-mobile="false" data-url="/res/parallax2.jpg" data-speed="3">

					<div class="container">
		        		<div class="row">
		            		<div class="col-md-10 col-md-offset-1">
		            			
		            		</div>
		            	</div>
		            </div>

				</section>
			</div>
		</div>
	</div>
	-->

	<section id="legal-stuff">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
				
					<h1>Legal stuff</h1>
					<div class="clearfix-lg"></div>
				
				</div>
				<div class="col-md-6"> 			
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis porta tortor ut consequat. Fusce dignissim quis nunc nec convallis. Quisque mattis felis interdum, ullamcorper ante non, suscipit risus. Phasellus ultrices tristique massa vitae bibendum. Sed viverra est nisi, sed facilisis dui euismod et. Vivamus sit amet augue ac urna ullamcorper tincidunt non vitae sem. Curabitur mattis diam lacus, nec auctor lectus tincidunt eget. Ut ac rutrum massa, sit amet scelerisque justo. Nam felis tortor, vulputate nec venenatis vel, interdum vestibulum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					<p><br></p>
					<p>Curabitur et ipsum faucibus orci facilisis consequat. Mauris dignissim semper dolor, id aliquet elit accumsan ac. Sed sollicitudin vestibulum metus, eget varius dui rhoncus et. Nullam iaculis suscipit consequat. Phasellus vel dolor dignissim, euismod sapien ut, laoreet sem. Nullam eget pulvinar metus. Ut mauris mauris, accumsan et aliquet quis, sagittis et neque. Etiam eu efficitur dui. Nullam scelerisque tortor tellus, id luctus nisl sagittis lobortis. Cras imperdiet consequat nibh sit amet lobortis.</p>
					
					<div class="clearfix-lg"></div>

				</div>
				<div class="col-md-6">
					
					<ul class="pdf-list">
						<li>
							<a href="#"><i class="fa fa-file-pdf-o"></i>Terms of Service</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-file-pdf-o"></i>Privacy Policy</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-file-pdf-o"></i>Notice and Take Down Policy</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-file-pdf-o"></i>Cookie Policy</a>
						</li>
					</ul>

					<div class="clearfix-lg"></div>

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