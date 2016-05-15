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

	<div id="styleguide-top" class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1>Style Guide</h1>
				</div>
			</div>
		</div>
	</div>

	<div class="clearfix-m"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				
				<h3>Color palette</h3>
				<div class="clearfix-xs"></div>
				<p>This is the list of colors as described in the PSD.</p>

			</div>
		</div>		
	</div>
	<div class="clearfix-m"></div>

	<div class="container-fluid gray-bar colors">		
		<div class="container">
			<div class="clearfix-m"></div>
			<div class="row">			
				<div class="col-sm-2">
					<div style="background: #a9cf54">#a9cf54</div>
					<span class="clearfix-m"></span>
				</div>
				<div class="col-sm-2">
					<div style="background: #51545a; color: #fff;">#51545a</div>
					<span class="clearfix-m"></span>
				</div>
				<div class="col-sm-2">
					<div style="background: #f0f0f0">#f0f0f0</div>
					<span class="clearfix-m"></span>
				</div>
				<div class="col-sm-2">
					<div style="background: #ff9800">#ff9800</div>
					<span class="clearfix-m"></span>
				</div>
				<div class="col-sm-2">
					<div style="background: #00bff3">#00bff3</div>
					<span class="clearfix-m"></span>
				</div>
				<div class="col-sm-2">
					<div style="background: #ffffff">#ffffff</div>
					<span class="clearfix-m"></span>
				</div>
				<div class="col-sm-2">
					<div style="background: #c85305">#c85305</div>
					<span class="clearfix-m"></span>
				</div>
				<div class="col-sm-2">
					<div style="background: #990000">#990000</div>
					<span class="clearfix-m"></span>
				</div>


			</div>		
		</div>
	</div>
	
	<div class="clearfix-lg"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				
				<h3>Logo</h3>
				<div class="clearfix-xs"></div>
				<p>This 3 variation of logo: for light background, for dark backgrund and wihout product name.</p>

			</div>
		</div>		
	</div>
	<div class="clearfix-m"></div>

	<div class="container-fluid gray-bar">		
		<div class="container">
			<div class="clearfix-m"></div>
			<div class="row">
				<div class="col-sm-4">
					<img src="/res/styleguide/logo.png" alt="" />
					<span class="clearfix-m"></span>
				</div>
				<div class="col-sm-4">
					<img src="/res/styleguide/logo-light.png" alt="" />
					<span class="clearfix-m"></span>
				</div>
				<div class="col-sm-4">
					<img src="/res/styleguide/icon.png" alt="" />
					<span class="clearfix-m"></span>
				</div>
			</div>
		</div>
	</div>


	<div class="clearfix-lg"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				
				<h3>Typography</h3>
				<div class="clearfix-xs"></div>
				<p>Typographic elements do not come with any margins attached to them in order to make them more flexible in where they can be used.</p>				

			</div>
		</div>		
	</div>
	<div class="clearfix-m"></div>

	<div class="container-fluid gray-bar">		
		<div class="container">
			<div class="clearfix-m"></div>
			<div class="row">			
				<div class="col-sm-12">
					<h4>Headings</h4>
				</div>
				<span class="clearfix-m"></span>

				<div class="col-xs-1">
					<code>h1</code>
				</div>
				<div class="col-xs-11">
					<h1>The quick, brown fox</h1>					
				</div>
				<span class="clearfix-m"></span>

				<div class="col-xs-1">
					<code>h2</code>
				</div>
				<div class="col-xs-11">
					<h2>The quick, brown fox</h2>
				</div>
				<span class="clearfix-m"></span>

				<div class="col-xs-1">
					<code>h3</code>
				</div>
				<div class="col-xs-11">
					<h3>The quick, brown fox</h3>
				</div>
				<span class="clearfix-m"></span>

				<div class="col-xs-1">
					<code>h4</code>
				</div>
				<div class="col-xs-11">
					<h4>The quick, brown fox</h4>
				</div>
				<span class="clearfix-m"></span>

				<div class="col-xs-1">
					<code>h5</code>
				</div>
				<div class="col-xs-11">
					<h5>The quick, brown fox</h5>
				</div>
				<span class="clearfix-m"></span>

				<div class="col-xs-1">
					<code>h6</code>
				</div>
				<div class="col-xs-11">
					<h6>The quick, brown fox</h6>
				</div>
				
				<span class="clearfix-lg"></span>

				<div class="col-sm-12">
					<h4>Other</h4>
				</div>
				<span class="clearfix-m"></span>

				<div class="col-xs-1">
					<code>p</code>
				</div>
				<div class="col-xs-11">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id odio pellentesque, rhoncus est a, volutpat orci. Ut accumsan lorem sit amet lorem laoreet, eleifend elementum purus dictum. Donec eget lorem vitae orci finibus sagittis.</p>
				</div>
				<span class="clearfix-m"></span>

				<div class="col-xs-1">
					<code>a</code>
				</div>
				<div class="col-xs-11">
					<ul>
						<a href="javascript:{}">Lorem ipsum dolor sit amet</a>
					</ul>
				</div>
				<span class="clearfix-m"></span>

				<div class="col-xs-1">
					<code>li</code>
				</div>
				<div class="col-xs-11">
					<ul>
						<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id odio pellentesque, rhoncus est a, volutpat orci. Ut accumsan lorem sit amet lorem laoreet, eleifend elementum purus dictum. Donec eget lorem vitae orci finibus sagittis.</li>
					</ul>
				</div>
				<span class="clearfix-m"></span>

			</div>
		</div>
	</div>


	<div class="clearfix-lg"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				
				<h3>Icons</h3>
				<div class="clearfix-xs"></div>
				<p>Font Awesome's font icons are used for icons. More info about Font Awesome on <a href="http://fontawesome.io" target="_blank">fontawesome.io</a></p>

			</div>
		</div>		
	</div>
	<div class="clearfix-m"></div>

	<div class="container-fluid gray-bar icons">		
		<div class="container">
			<div class="clearfix-m"></div>
			<div class="row">
				<div class="col-sm-2">
					<i class="fa fa-user"></i>
					User
					<div class="clearfix-m"></div>
				</div>
				<div class="col-sm-2">
					<i class="fa fa-paper-plane"></i>
					Send
					<div class="clearfix-m"></div>
				</div>
				<div class="col-sm-2">
					<i class="fa fa-plus-square"></i>
					Add
					<div class="clearfix-m"></div>
				</div>
				<div class="col-sm-2">
					<i class="fa fa-cloud-download"></i>
					Download
					<div class="clearfix-m"></div>
				</div>
				<div class="col-sm-2">
					<i class="fa fa-cloud-upload"></i>
					Upload
					<div class="clearfix-m"></div>
				</div>
				<div class="col-sm-2">
					<i class="fa fa-link"></i>
					Open
					<div class="clearfix-m"></div>
				</div>
				<div class="col-sm-2">
					<i class="fa fa-trash"></i>
					Delete
					<div class="clearfix-m"></div>
				</div>	
				<div class="col-sm-2">
					<i class="fa fa-facebook"></i>
					Facebook
					<div class="clearfix-m"></div>
				</div>
				<div class="col-sm-2">
					<i class="fa fa-google-plus"></i>
					Google
					<div class="clearfix-m"></div>
				</div>
				<div class="col-sm-2">
					<i class="fa fa-twitter"></i>
					Twitter
					<div class="clearfix-m"></div>
				</div>
				<div class="col-sm-2">
					<i class="fa fa-linkedin"></i>
					LinkedIn
					<div class="clearfix-m"></div>
				</div>
				<div class="col-sm-2">	
					<i class="fa fa-picture-o"></i>
					Image file
					<div class="clearfix-m"></div>
				</div>
				<div class="col-sm-2">
					<i class="fa fa-video-camera"></i>
					Video file
					<div class="clearfix-m"></div>
				</div>
				<div class="col-sm-2">
					<i class="fa fa-headphones"></i>
					Audio file
					<div class="clearfix-m"></div>
				</div>
				<div class="col-sm-2">
					<i class="fa fa-book"></i>
					Document file
					<div class="clearfix-m"></div>
				</div>

			</div>
		</div>
	</div>


	<div class="clearfix-lg"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				
				<h3>Form elements</h3>
				<div class="clearfix-xs"></div>
				<p>You can include the form elements includes as detailed below. Form element can either be fixed or flexible width.</p>

			</div>
		</div>		
	</div>
	<div class="clearfix-m"></div>

	<div class="container-fluid components gray-bar">		
		<div class="container">
			<div class="clearfix-m"></div>
			<div class="row">

				<div class="col-sm-6">
					<a href="#" class="btn">Link button</a>
				</div>
				<div class="col-sm-6">
					<code>
						<?php echo o3_html('<a href="#" class="btn">Link button</a>'); ?>
					</code>
				</div>
				<div class="clearfix-m"></div>

				<div class="col-sm-6">
					<button class="btn">Simple button</button>
				</div>
				<div class="col-sm-6">
					<code>
						<?php echo o3_html('<button class="btn">Button</button>'); ?>
					</code>
				</div>
				<div class="clearfix-m"></div>

				<div class="col-sm-6">
					<a href="#" class="btn btn-primary">Important link button</a>
				</div>
				<div class="col-sm-6">
					<code>
						<?php echo o3_html('<a href="#" class="btn btn-primary">Important link button</a>'); ?>
					</code>
				</div>
				<div class="clearfix-m"></div>

				<div class="col-sm-6">
					<a href="#" class="btn btn-primary">Submit button</a>
				</div>
				<div class="col-sm-6">
					<code>
						<?php echo o3_html('<a href="#" class="btn btn-primary">Submit button</a>'); ?>
					</code>
				</div>
				<div class="clearfix-m"></div>

				<div class="col-sm-6">
					<div class="form">
						<div class="form-group">
							<input class="form-control" placeholder="Input field" value="" name="text" />
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<code>
						<?php echo nl2br(o3_html('<div class="form">
						<div class="form-group">
							<input class="form-control" placeholder="Input field" value="" name="text" />
						</div>
					</div>') ); ?>
					</code>
				</div>
				<div class="clearfix-m"></div>

				<div class="col-sm-6">
					<div class="form">
						<div class="form-group has-warning">
							<input class="form-control" placeholder="Input field with error" value="" name="text" />
							<div class="warning">Something wrong with the inserted value.</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<code>
						<?php echo nl2br(o3_html('<div class="form">
						<div class="form-group has-warning">
							<input class="form-control" placeholder="Input field with error" value="" name="text" />
							<div class="warning">Something wrong with the inserted value.</div>
						</div>
					</div>') ); ?>
					</code>
				</div>
				<div class="clearfix-m"></div>


				<div class="col-sm-6">
					<div class="form">
						<div class="success-msg block">Success message</div>				
					</div>
				</div>
				<div class="col-sm-6">
					<code>
						<?php echo nl2br(o3_html('<div class="form">
						<div class="success-msg block">Success message</div>				
					</div>') ); ?>
					</code>
				</div>
				<div class="clearfix-m"></div>

				<div class="col-sm-6">
					<div class="form">
						<div class="error-msg block">Error message</div>				
					</div>
				</div>
				<div class="col-sm-6">
					<code>
						<?php echo nl2br(o3_html('<div class="form">
						<div class="error-msg block">Error message</div>				
					</div>') ); ?>
					</code>
				</div>
				<div class="clearfix-m"></div>
				
			</div>
		</div>
	</div>

	<div class="clearfix-lg"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				
				<h3>UI Components</h3>
				<div class="clearfix-xs"></div>
				<p>UI components should be included as components where possible. You can include the UI component includes as detailed below. UI components can either be fixed or flexible width.</p>

			</div>
		</div>		
	</div>
	<div class="clearfix-m"></div>

	<div class="container-fluid components gray-bar">		
		<div class="container">
			<div class="clearfix-m"></div>
			<div class="row">

				<div class="col-sm-12">					
					<h6>Price box</h6>
					<div class="clearfix-xs"></div>
				</div>

				<div class="col-sm-6">					
					<div class="plan-box plan-box-premium">
						<p>Premium</p>
						<b>€8.99<span>/month</span></b>
						<small>Start your 30 day free trial</small>
						<hr>
						<ul>
							<li><i class="fa fa-check"></i> Send up to 25GB per upload</li>
							<li><i class="fa fa-check"></i> Transfer never expires</li>
							<li><i class="fa fa-check"></i> 125GB cloud storage</li>
							<li><i class="fa fa-check"></i> Transfer history</li>
							<li><i class="fa fa-check"></i> Ad free</li>
						</ul>
						<hr>
						<a href="/#sign-in" class="btn btn-primary">Get Premium</a>
					</div>
				</div>
				<div class="col-sm-6">
					<code>
						<?php echo nl2br(o3_html('<div class="plan-box plan-box-premium">
						<p>Premium</p>
						<b>€8.99<span>/month</span></b>
						<small>Start your 30 day free trial</small>
						<hr>
						<ul>
							<li><i class="fa fa-check"></i> Send up to 25GB per upload</li>
							<li><i class="fa fa-check"></i> Transfer never expires</li>
							<li><i class="fa fa-check"></i> 125GB cloud storage</li>
							<li><i class="fa fa-check"></i> Transfer history</li>
							<li><i class="fa fa-check"></i> Ad free</li>
						</ul>
						<hr>
						<a href="/#sign-in" class="btn btn-primary">Get Premium</a>
					</div>')); ?>
					</code>
				</div>
				<div class="clearfix-m"></div>


				<div class="col-sm-12">					
					<h6>Feature highligh</h6>
					<div class="clearfix-xs"></div>
				</div>

				<div class="col-sm-6">	

					<div class="text-center">
						<div class="circle">
							<i class="fa fa-cloud"></i>
						</div>
						<div class="clearfix-m"></div>
						<h5>125GB long term cloud storage</h5>
					</div>				
				</div>
				<div class="col-sm-6">
					<code>
						<?php echo nl2br(o3_html('<div class="text-center">
						<div class="circle">
							<i class="fa fa-cloud"></i>
						</div>
						<div class="clearfix-m"></div>
						<h5>125GB long term cloud storage</h5>
					</div>')); ?>
					</code>
				</div>
				<div class="clearfix-m"></div>


				<div class="col-sm-12">					
					<h6>Image/Document preview box</h6>
					<div class="clearfix-xs"></div>
				</div>

				<div class="col-sm-6">	
					<div class="files-list">						
						<ul class="list-icons list-images">
							<li class="item">
								<div>
									<div class="head">
										<div>jpg</div>
										<div>2.77MB</div>
										<span class="clearfix"></span>
									</div>
									<div class="body">
										<div>
											<a href="#" title="20140608_133718.jpg" style="background-image: url('/res/styleguide/preview.jpg')">
												<i class="fa fa-picture-o"></i>
											</a>
										</div>
									</div>
									<div class="foot">
										<div>
											<span>20140608_133718.jpg</span>
											<a href="#" title="Download 20140608_133718.jpg"><i class="fa fa-cloud-download"></i></a>
										</div>
									</div>	
								</div>	
							</li>
						</ul>			
					</div>
				</div>
				<div class="col-sm-6">
					<code>
						<?php echo nl2br(o3_html('<div class="files-list">						
						<ul class="list-icons list-images">
							<li class="item">
								<div>
									<div class="head">
										<div>jpg</div>
										<div>2.77MB</div>
										<span class="clearfix"></span>
									</div>
									<div class="body">
										<div>
											<a href="#" title="20140608_133718.jpg" style="background-image: url(\'\')">
												<i class="fa fa-picture-o"></i>
											</a>
										</div>
									</div>
									<div class="foot">
										<div>
											<span>20140608_133718.jpg</span>
											<a href="#" title="Download 20140608_133718.jpg"><i class="fa fa-cloud-download"></i></a>
										</div>
									</div>	
								</div>	
							</li>
						</ul>			
					</div>')); ?>
					</code>
				</div>
				<div class="clearfix-m"></div>

				<div class="col-sm-12">					
					<h6>Video preview box</h6>
					<div class="clearfix-xs"></div>
				</div>

				<div class="col-sm-6">	
					<div class="files-list">						
						<ul class="list-icons list-video">
							<li class="item">
								<div>
									<div class="head">
										<div>mp4</div>
										<div>2.77MB</div>
										<span class="clearfix"></span>
									</div>
									<div class="body">
										<div>
											<a href="#" title="20140608_133718.mp4" style="background-image: url('/res/styleguide/video.jpg')">
												<i class="fa fa-picture-o"></i>
												<u></u>
												<b></b>
												<span style="background-image: url('/res/styleguide/video.gif')"></span>
											</a>
										</div>
									</div>
									<div class="foot">
										<div>
											<span>20140608_133718.mp4</span>
											<a href="#" title="Download 20140608_133718.mp4"><i class="fa fa-cloud-download"></i></a>
										</div>
									</div>	
								</div>	
							</li>
						</ul>			
					</div>
				</div>
				<div class="col-sm-6">
					<code>
						<?php echo nl2br(o3_html('<div class="files-list">						
						<ul class="list-icons list-images">
							<li class="item">
								<div>
									<div class="head">
										<div>jpg</div>
										<div>2.77MB</div>
										<span class="clearfix"></span>
									</div>
									<div class="body">
										<div>
											<a href="#" title="20140608_133718.jpg" style="background-image: url(\'\')">
												<i class="fa fa-picture-o"></i>
											</a>
										</div>
									</div>
									<div class="foot">
										<div>
											<span>20140608_133718.jpg</span>
											<a href="#" title="Download 20140608_133718.jpg"><i class="fa fa-cloud-download"></i></a>
										</div>
									</div>	
								</div>	
							</li>
						</ul>			
					</div>')); ?>
					</code>
				</div>
				<div class="clearfix-m"></div>

				<div class="col-sm-12">					
					<h6>Files list</h6>
					<div class="clearfix-xs"></div>
				</div>

				<div class="col-sm-6">	
					<div class="files-list">						
						<ul class="list-detail">
							<li class="item">
								<div>
									<div class="head">
										<div>ttf</div>
										<div>619.32KB</div>
										<span class="clearfix"></span>
									</div>
									<div class="body">
										<div></div>
									</div>
									<div class="foot">
										<div>
											<span>DejaVuSans-Bold.ttf</span>
											<a href="#" title="Download DejaVuSans-Bold.ttf"><i class="fa fa-cloud-download"></i></a>
										</div>
									</div>
								</div>
							</li>
							<li class="item">
								<div>
									<div class="head">
										<div>ttf</div>
										<div>619.32KB</div>
										<span class="clearfix"></span>
									</div>
									<div class="body">
										<div></div>
									</div>
									<div class="foot">
										<div>
											<span>DejaVuSans-BoldOblique.ttf</span>
											<a href="#" title="Download DejaVuSans-BoldOblique.ttf"><i class="fa fa-cloud-download"></i></a>
										</div>
									</div>
								</div>
							</li>
							<li class="item">
								<div>
									<div class="head">
										<div>ttf</div>
										<div>619.32KB</div>
										<span class="clearfix"></span>
									</div>
									<div class="body">
										<div></div>
									</div>
									<div class="foot">
										<div>
											<span>DejaVuSans-Oblique.ttf</span>
											<a href="#" title="Download DejaVuSans-Oblique.ttf"><i class="fa fa-cloud-download"></i></a>
										</div>
									</div>
								</div>
							</li>
						</ul>			
					</div>
				</div>
				<div class="col-sm-6">
					<code>
						<?php echo nl2br(o3_html('<div class="files-list">						
						<ul class="list-detail">
							<li class="item">
								<div>
									<div class="head">
										<div>ttf</div>
										<div>619.32KB</div>
										<span class="clearfix"></span>
									</div>
									<div class="body">
										<div></div>
									</div>
									<div class="foot">
										<div>
											<span>DejaVuSans-Bold.ttf</span>
											<a href="#" title="Download DejaVuSans-Bold.ttf"><i class="fa fa-cloud-download"></i></a>
										</div>
									</div>
								</div>
							</li>
							<li class="item">
								<div>
									<div class="head">
										<div>ttf</div>
										<div>619.32KB</div>
										<span class="clearfix"></span>
									</div>
									<div class="body">
										<div></div>
									</div>
									<div class="foot">
										<div>
											<span>DejaVuSans-BoldOblique.ttf</span>
											<a href="#" title="Download DejaVuSans-BoldOblique.ttf"><i class="fa fa-cloud-download"></i></a>
										</div>
									</div>
								</div>
							</li>
							<li class="item">
								<div>
									<div class="head">
										<div>ttf</div>
										<div>619.32KB</div>
										<span class="clearfix"></span>
									</div>
									<div class="body">
										<div></div>
									</div>
									<div class="foot">
										<div>
											<span>DejaVuSans-Oblique.ttf</span>
											<a href="#" title="Download DejaVuSans-Oblique.ttf"><i class="fa fa-cloud-download"></i></a>
										</div>
									</div>
								</div>
							</li>
						</ul>			
					</div>')); ?>
					</code>
				</div>
				<div class="clearfix-m"></div>



				
				
			</div>
		</div>
	</div>

	<div class="clearfix-lg"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				
				<h3>Layout</h3>
				<div class="clearfix-xs"></div>
				<p>The layout is based on Boostrap's responsive 12 columns grid system. More info about Boostrap on <a href="http://getbootstrap.com" target="_blank">getbootstrap.com</a></p>


			</div>
		</div>		
	</div>
	<div class="clearfix-m"></div>

	<div class="container-fluid gray-bar">		
		<div class="container">
			<div class="clearfix-m"></div>
			
			<div class="row">
				<div class="col-xs-1"><div class="box">1</div></div>
				<div class="col-xs-1"><div class="box">1</div></div>
				<div class="col-xs-1"><div class="box">1</div></div>
				<div class="col-xs-1"><div class="box">1</div></div>
				<div class="col-xs-1"><div class="box">1</div></div>
				<div class="col-xs-1"><div class="box">1</div></div>
				<div class="col-xs-1"><div class="box">1</div></div>
				<div class="col-xs-1"><div class="box">1</div></div>
				<div class="col-xs-1"><div class="box">1</div></div>
				<div class="col-xs-1"><div class="box">1</div></div>
				<div class="col-xs-1"><div class="box">1</div></div>
				<div class="col-xs-1"><div class="box">1</div></div>
			</div>
			<div class="clearfix-m"></div>
			<div class="row">
				<div class="col-xs-8"><div class="box">8</div></div>
				<div class="col-xs-4"><div class="box">4</div></div>
			</div>
			<div class="clearfix-m"></div>
			<div class="row">
				<div class="col-xs-4"><div class="box">4</div></div>
				<div class="col-xs-4"><div class="box">4</div></div>
				<div class="col-xs-4"><div class="box">4</div></div>
			</div>
			<div class="clearfix-m"></div>
			<div class="row">
				<div class="col-xs-6"><div class="box">6</div></div>
				<div class="col-xs-6"><div class="box">6</div></div>
			</div>
			<div class="clearfix-m"></div>
			<div class="row">
				<div class="col-xs-12"><div class="box">6</div></div>
			</div>
			<div class="clearfix-m"></div>

		</div>
	</div>

	<div class="clearfix-xl"></div>

 
	<?php

		//load header
		$this->view( 'o3_cms_template_view_footer' );

	?>

</body>
</html>