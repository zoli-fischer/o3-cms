<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
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

<!--CONTENT META-->
<meta name="robots" content="nofollow, noindex" />
<meta name="description" content="<?php echo o3_html($this->parent->page_description()); ?>">
<meta name="keywords" content="<?php echo o3_html($this->parent->page_keywords()); ?>">
<meta name="author" content="Snapfer">

<!-- Schema.org markup for Google+ -->
<!--
<meta itemprop="name" content="<?php echo o3_html($this->parent->page_title()); ?>" />
<meta itemprop="description" content="<?php echo o3_html($this->parent->page_description()); ?>" />
<meta itemprop="image" content="<?php echo o3_html($this->parent->page_image()); ?>" /> 
-->

<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@Snapfer" />
<meta name="twitter:title" content="<?php echo o3_html($this->parent->page_title()); ?>" />
<meta name="twitter:description" content="<?php echo o3_html($this->parent->page_description()); ?>" />
<meta name="twitter:creator" content="@Snapfer" />
<!-- Twitter summary card with large image must be at least 280x150px -->
<meta name="twitter:image:src" content="<?php echo o3_html($this->parent->page_image()); ?>" />

<!-- Open Graph data -->
<meta property="og:site_name" content="Snapfer" />
<meta property="og:title" content="<?php echo o3_html($this->parent->page_title()); ?>" />
<meta property="og:image" content="<?php echo o3_html($this->parent->page_image()); ?>" />
<meta property="og:image:width" content="<?php echo o3_html($this->parent->page_image_width()); ?>" />
<meta property="og:image:height" content="<?php echo o3_html($this->parent->page_image_height()); ?>" />
<meta property="og:locale" content="en_US" />
<meta property="og:url" content="<?php echo o3_html($this->parent->page_url()); ?>" />
<meta property="og:description" content="<?php echo o3_html($this->parent->page_description()); ?>" />


<link rel="shortcut icon" href="/res/icons/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="/res/icons/apple-touch-icon.png" />
<link rel="apple-touch-icon" sizes="57x57" href="/res/icons/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="72x72" href="/res/icons/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="76x76" href="/res/icons/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon" sizes="114x114" href="/res/icons/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="120x120" href="/res/icons/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="144x144" href="/res/icons/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="152x152" href="/res/icons/apple-touch-icon-152x152.png" />
<link rel="apple-touch-icon" sizes="180x180" href="/res/icons/apple-touch-icon-180x180.png" />

<!--<link href='https://fonts.googleapis.com/css?family=Slabo+13px%7CMontserrat:400,700' rel='stylesheet' type='text/css'>-->
<link href='https://fonts.googleapis.com/css?family=Slabo+13px|Open+Sans:400,400italic,600,600italic,700,700italic|Montserrat:400,700' rel='stylesheet' type='text/css'>

<script 
	data-ref="logged_user" 
	data-user-id="<?php echo o3_html($this->parent->logged_user()->get('id')); ?>"
	data-user-name="<?php echo o3_html($this->parent->logged_user()->get('username')); ?>"
	data-subsciption-type="<?php echo o3_html($this->parent->logged_user()->get('subsciption_type')); ?>"
	data-allow-trial="<?php echo o3_html($this->parent->logged_user()->allow_trial()); ?>"
	data-storage-free="<?php echo o3_html($this->parent->logged_user()->storage_free()); ?>"></script>

<?php
	
	//inline css
	$this->parent->parent->inlince_css( false );

	//require js
	$this->parent->parent->body_res('jquery2,o3_bootstrap,o3,o3_device,o3_upclick,o3_valid,o3_string,awesome,knockout');

	//parallax
	$this->parent->parent->head_css(O3_CMS_THEME_DIR.'/lib/parallax/jquery.rd-parallax.css');
	$this->parent->parent->body_js(O3_CMS_THEME_DIR.'/lib/parallax/jquery.rd-parallax.js');

	//smooth scroll
	$this->parent->parent->body_js(O3_CMS_THEME_DIR.'/lib/jquery.mousewheel.min.js');
	$this->parent->parent->body_js(O3_CMS_THEME_DIR.'/lib/jquery.smoothscroll.min.js');	

	//mobile nav
	$this->parent->parent->head_css(O3_CMS_THEME_DIR.'/lib/rd-navbar/rd-navbar.css');
	$this->parent->parent->body_js(O3_CMS_THEME_DIR.'/lib/rd-navbar/rd-navbar.js');	

	//wow
	$this->parent->parent->head_css(O3_CMS_THEME_DIR.'/lib/animate.css');
	$this->parent->parent->body_js(O3_CMS_THEME_DIR.'/lib/wow.js');	
	
	//on scroll change hash
	$this->parent->parent->body_js(O3_CMS_THEME_DIR.'/lib/jquery.scroll-anchor.js');	

	//snapfer webpage KO app
	$this->parent->parent->body_js(O3_CMS_THEME_DIR.'/js/snapfer/snapfer.logged.user.app.js');
	$this->parent->parent->body_js(O3_CMS_THEME_DIR.'/js/snapfer/snapfer.signinup.app.js');
	$this->parent->parent->body_js(O3_CMS_THEME_DIR.'/js/snapfer/snapfer.page.app.js');

	//require template and global js and css/less
	$this->parent->require_js_css();

?>

<!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
<script type="text/javascript">
    window.cookieconsent_options = {"message":"This website uses cookies to ensure you get the best experience on our website","dismiss":"Got it!","learnMore":"More info","link":"http://www.snapfer.com/res/pdf/Cookie%20Policy.pdf","theme":"dark-floating"};
</script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>
<!-- End Cookie Consent plugin -->
