<!DOCTYPE HTML>
<html lang="en">
<head>

	<?php 

		//load html head
		$this->view( 'o3_cms_view_html_head' );

	?>

</head>
<body class="<?php echo o3_ua_body_classes(); ?>">	

	<div id="o3-cms-wrapper">
		<div class="o3-cms-table" id="o3-cms-main">
			<div class="o3-cms-row">
				<div class="o3-cms-cell o3-cms-top-bar">

					<?php 

						//load topbar
						$this->view( 'o3_cms_view_topbar' );

					?>
				
				</div>
			</div>
			<div class="o3-cms-row">
				<div class="o3-cms-cell o3-cms-valign-top o3-cms-bg-light-white !o3-cms-show-left-menu" id="o3-cms-content">
					<div>
					
						<div id="o3-cms-frame">
							<!--<iframe src="<?php echo o3_current_url(); ?>?o3_cms_ignore_admin"></iframe>-->
							<iframe src="<?php echo o3_current_url(); ?>?o3_cms_ignore_admin"></iframe>
						</div>

						<div class="o3-cms-bg-white" id="o3-cms-left-menu">
							
							<a href=""><span class="fa fa-angle-up"></span>Modules</a>
							<ul>
								<li>
									<a href=""><span></span>New page</a>
								</li>
								<li>
									<a href=""><span></span>Files</a>
								</li>
								<li>
									<a href=""><span></span>Categories</a>
								</li>
								<li>
									<a href=""><span></span>Menu</a>
								</li>
							</ul>

							<a href=""><span class="fa fa-angle-up"></span>System</a>
							<ul>
								<li>
									<a href=""><span></span>Templates</a>
								</li>
							</ul>

						</div>

					</div>
				</div>
			</div>
		</div>	
	</div>

</body>
</html>