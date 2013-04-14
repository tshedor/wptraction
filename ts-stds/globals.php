<?php
$a = get_option('ts_admin_options');

add_filter( 'wp_footer' , 'custom_footer' );
function custom_footer() {
	global $a;
	echo '<script type="text/javascript" src="'.get_template_directory_uri().'/lib/plugins.min.js"></script><script type="text/javascript">(function(){$(function(){$("#searchIcon").click(function(){$("#searchInput").focus();$("#searchForm").toggleClass("active");return!1});$(".sf-menu").superfish();$("#activateMobile").click(function(){return $("#mobileMenu").slideToggle()});$("#creditsDisplay, #mobileMenu").hide();$("#footerCredits").click(function(){$("#creditsDisplay").fadeToggle();return!1});$(".bxslider").bxSlider({controls:!1,auto:!0,infiniteLoop:!0});';
		if($a['slimbox_gallery'])
			echo '$(\'.gallery .gallery-item .gallery-icon a[href*=".jpg"], .gallery .gallery-item .gallery-icon a[href*=".png"], .gallery .gallery-item .gallery-icon a[href*=".jpeg"]\').attr("rel","lightbox").slimbox();';
		if($a['slimbox_single'])
			echo '$(\'a[href*=".png"], a[href*=".jpg"], a[href*=".jpeg"]\').attr("rel", "lightbox").slimbox();';
	echo '})}).call(this)</script>
	<div class="notice ie-warning">
	<div class="row ie6-warning warning">
		<div class="large-12 columns">
			<div class="alert">
				<i class="icon-alert"></i> <strong>Internet Explorer 6 User</strong>: You are using an outdated and insecure browser. We do not support the use of Internet Explorer 6 and below. Please <a href="http://browsehappy.com/" title="Use an alternative browser">use an alternative browser</a>, install <a href="http://www.google.com/chromeframe/eula.html?prefersystemlevel=true" title="Google Chrome Frame">Google Chrome Frame</a>, or learn about why <a href="http://www.smashingmagazine.com/2012/07/10/dear-web-user-please-upgrade-your-browser/" title="Dear Web User: Please Upgrade Your Browser">using Internet Explorer 6 is dangerous</a>.
			</div>
		</div>
	</div>
	<div class="row ie-warning warning">
		<div class="large-12 columns">
			<div class="alert">
				<i class="icon-alert"></i> <strong>Internet Explorer User</strong>: You are using an outdated and insecure browser. In order to enjoy all the features of '.get_bloginfo('url').', please <a href="http://browsehappy.com/" title="Use an alternative browser">use an alternative browser</a> or install <a href="http://www.google.com/chromeframe/eula.html?prefersystemlevel=true" title="Google Chrome Frame">Google Chrome Frame</a>. <a href="http://www.smashingmagazine.com/2012/07/10/dear-web-user-please-upgrade-your-browser/" title="Dear Web User: Please Upgrade Your Browser">Learn more</a>
			</div>
		</div>
	</div>
	</div>
	<noscript>
		<div class="row warning">
			<div class="large-12 columns">
				<div class="alert">
					<i class="icon-alert"></i> <strong>Javascript Disabled</strong>: Your Javascript is disabled. In order to enjoy all the features of '.get_bloginfo('url').', <a href="http://enable-javascript.com/" title="Enable Javascript">please enable Javascript</a> in your browser\'s settings.
				</div>
			</div>
		</div>
	</noscript>
<!--[if lt IE 9]>
	<script src="'.get_template_directory_uri().'/lib/ts-stds/libs/compatibility/html5.js"></script>
	<script type="text/javascript" src="'.get_template_directory_uri().'/lib/ts-stds/libs/compatibility/respond.min.js"></script>
	<script src="'.get_template_directory_uri().'/lib/ts-stds/libs/compatibility/IE9.js"></script>
<![endif]-->
<!--[if lt IE 8]>
	<script src="'.get_template_directory_uri().'/lib/ts-stds/libs/compatibility/IE8.js"></script>
<![endif]-->
<!--[if lt IE 7]>
	<script src="'.get_template_directory_uri().'/lib/ts-stds/libs/compatibility/IE7.js"></script>
	<script src="'.get_template_directory_uri().'/lib/fonts/CharlieGordon/lte-ie7.js" type="text/javascript"></script>
<![endif]-->';
}
add_filter( 'wp_head' , 'custom_head' );
function custom_head() {
	global $a;
	if(is_single()){
		echo '<meta property="og:title" content="'.get_the_title().'" />';
		echo '<meta property="og:url" content="'.get_permalink().'" />';
		echo '<meta property="og:description" content="'.get_the_excerpt().'" />';
		echo '<meta property="og:type" content="article" />';
	} elseif((is_home()) || (is_archive())){
		echo '<meta property="og:title" content="'.get_bloginfo('name').'" />';
		echo '<meta property="og:url" content="'.get_bloginfo('url').'" />';
		echo '<meta property="og:description" content="'.get_bloginfo('description').'" />';
		echo '<meta property="og:type" content="website" />';
	}
	echo '<meta property="og:site_name" content="'.get_bloginfo('name').'" />';
	echo '<meta name="copyright" content="'.date('Y').' '.get_bloginfo('name').'"><link type="text/plain" rel="author" href="'.get_template_directory_uri().'/humans.txt" />';
	echo '<meta http-equiv="Content-Type" content="'.get_bloginfo('html_type').'; charset='.get_bloginfo('charset').'" /><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><meta name="viewport" content="width=device-width, initial-scale=1.0" /><meta name="description" content="'.get_bloginfo('description').'" /><meta name="robots" content="index,follow" />

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="'.get_bloginfo('rss2_url').'" /><link rel="alternate" type="text/xml" title="RSS .92" href="'.get_bloginfo('rss_url').'" /><link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="'.get_bloginfo('atom_url').'" /><link rel="pingback" href="'.get_bloginfo('pingback_url').'" />';
	if($a['favicon'] != ''){
		echo '<link rel="icon" type="image/x-icon" href="'.$a['favicon'].'" />';
	}

	echo '<link href="'.get_bloginfo('stylesheet_url').'" rel="stylesheet" type="text/css" />
	<style type="text/css">'.stripslashes($a['custom_css']).'</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>';
	if(!is_user_logged_in()){
		echo stripslashes($a['analytics_code']);
	}
	if($a['maintenance_mode'] && !is_user_logged_in()) echo '<style type="text/css">div,hide-for-small,.home .header {display:none!important; }</style><article class="ts-maintenance-mode gradient">'.get_bloginfo('name').'<p class="coming-soon">Coming Soon</p></article>';
}

function get_copyright(){
	global $a;
	echo '<div class="copyright">';
	if(isnt_blank($a['copyright_text'])){
		$copytext = $a['copyright_text'];
		$copytext = str_replace('{SITE NAME}', get_bloginfo('name'), $copytext);
		$copytext = str_replace('{CURRENT YEAR}', date('Y'), $copytext);
		echo $copytext;
	} else {
		echo '&copy; Copyright <a href="'.get_bloginfo('url').'" title="'.get_bloginfo('name').'">'.get_bloginfo('name').'</a> '.date('Y');
	}
	if($a['footer_credit']){
		echo ' | Code and Design by <a href="http://timshedor.com" title="Tim Shedor">Tim Shedor</a>';
	} else {
		echo ' | <div id="creditsDisplay"><div><a href="'.get_template_directory_uri().'/humans.txt" title="Credits">Credits</a></div><div>Code and Design by <a href="http://timshedor.com" title="Tim Shedor">Tim Shedor</a></div></div> <a href="#" title="Tim Shedor" class="cred" id="footerCredits"><i class="icon-asterisk"></i></a>';
	}
	echo '</div>';
}