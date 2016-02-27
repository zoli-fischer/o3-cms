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
				<div class="o3-cms-cell o3-cms-bg-light-gray" id="o3-cms-topbar">
					
					<ul>
						<!--
						<li>
							<a href=""><i class="fa fa-bars"></i> <span>Modules</span></a>
						</li>
						<li>
							<a href=""><i class="fa fa-users"></i> <span>Users</span></span></a>
						</li>
						<li>
							<a href=""><i class="fa fa-sitemap"></i> <span>Sitemap</a>
						</li>
						-->
						<li>
							<a href=""><i class="fa fa-user"></i> <span><?php echo o3_html($this->o3_cms->logged_user()->get('name')); ?></span></a>
						</li>
						<li>
							<a href="<?php echo O3_CMS_ADMIN_URL.'?o3-cms-admin-logout'; ?>"><i class="fa fa-sign-out "></i> <span>{o3_lang:o3-cms-sign-out}</span></a>
						</li>
					</ul>

					<ul>
						
						<li>
							<a href="<?php echo $this->o3_cms->page_url(); ?>"><i class="fa fa-globe"></i> <span>{o3_lang:o3-cms-frontpage}</span></a>
						</li>
						<!--
						<li>
							<a href=""><i class="fa fa-lightbulb-o"></i> <span>Highlight</span></a>
						</li>
						<li>
							<a href=""><i class="fa fa-trash-o"></i> <span>Trash</span></a>
						</li>
						<li>
							<a href=""><i class="fa fa-cog"></i> <span>Settings</span></a>
						</li>
						-->
					</ul>

				</div>
			</div>
			<div class="o3-cms-row">
				<div class="o3-cms-cell o3-cms-valign-top o3-cms-bg-light-white" id="o3-cms-content">
					<div>
					
						<div id="o3-cms-frame">
							<!--<iframe src="<?php echo o3_current_url(); ?>?o3_cms_ignore_admin"></iframe>-->
							<iframe src="<?php echo o3_current_url(); ?>?o3_cms_ignore_admin"></iframe>
						</div>

						<div class="o3-cms-bg-light-gray" id="o3-cms-left-menu">
							
						</div>

					</div>
				</div>
			</div>
		</div>	
	</div>

</body>
</html>