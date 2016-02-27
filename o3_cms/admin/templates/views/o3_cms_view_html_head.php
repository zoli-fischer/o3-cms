<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui" />
<meta name="handheldfriendly" content="true" />

<!--[if IE]>
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<![endif]-->

<title><?php echo o3_html($this->parent->page_title()); ?></title>

<!--[if lt IE 9]> 
	<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script> 
	<script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script> 
<![endif]-->

<link href='https://fonts.googleapis.com/css?family=Lato:700italic,700,400,400italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

<?php
	//inline css
	$this->parent->parent->inlince_css( true );
	
	//require js
	$this->parent->parent->body_res('jquery2,o3_device,o3_valid,o3_no_css,o3_string,knockout,awesome');
	
	//require template js and css/less
	$this->parent->require_js_css();

?>