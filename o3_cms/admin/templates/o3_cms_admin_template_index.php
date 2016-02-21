<!DOCTYPE HTML>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="utf-8" />
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui" />
	<meta name="handheldfriendly" content="true" />
	
	<!--[if IE]>
		<meta http-equiv="imagetoolbar" content="no" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<![endif]-->

	<!--[if lt IE 9]> 
		<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script> 
		<script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script> 
	<![endif]-->

	<?php

		//global css
		$this->parent->head_less( O3_CMS_ADMIN_DIR.'/css/global.css' );

		//require js
		$this->parent->body_res('jquery,o3_device,o3_valid,o3_no_css,knockout');

		//require template js and css/less
		$this->require_js_css();

	?>

</head>
<body class="<?php echo o3_ua_body_classes(); ?>">	

	<div id="o3-cms-wrapper">
		<div class="o3-cms-table" id="o3-cms-main">
			<div class="o3-cms-row">
				<div class="o3-cms-cell o3-cms-bg-light-gray" id="o3-cms-toolbar">
					<button>Toggle left menu</button>
				</div>
			</div>
			<div class="o3-cms-row">
				<div class="o3-cms-cell o3-cms-valign-top o3-cms-bg-light-white" id="o3-cms-content">
					<div>
					
						<div id="o3-cms-frame">
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