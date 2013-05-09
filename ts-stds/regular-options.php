<?php

//http://stackoverflow.com/questions/8102221/php-multidimensional-array-searching-find-key-by-specific-value
function arrayKey($array, $arrayValue) {
   foreach($array as $key => $item) {
      if($item['id'] === $arrayValue)
         return $key;
   }
   return false;
}

//$archiveBreadcrumbsKey = arrayKey($options,'breadcrumbs_archive');
//$options[$archiveBreadcrumbsKey]['def'] = true;

$social = array(
array(
	'name'	=>	__('Social', 'tswp'),
	'desc'	=>	'',
	'id'	=>	'separate',
	'std'	=>	'',
	'type'	=>	'separate'
),
array(
	'name'	=>	'Twitter',
	'desc'	=>	__('Twitter Profile. No @ sign.', 'tswp'),
	'id'	=>	'twitter_profile',
	'std'	=>	'tshedor',
	'class'	=>	'third',
	'type'	=>	'text'
),
array(
	'name'	=>	'Facebook '.__('Profile', 'tswp'),
	'desc'	=>	__('Include for display in header', 'tswp'),
	'id'	=>	'facebook_profile',
	'std'	=>	'http://facebook.com/tshedor',
	'class'	=>	'third',
	'type'	=>	'text'
),
array(
	'name'	=>	'Pinterest '.__('Profile', 'tswp'),
	'desc'	=>	__('Include for display in header', 'tswp'),
	'id'	=>	'pinterest_profile',
	'std'	=>	'http://pinterest.com/tshedor',
	'class'	=>	'third',
	'type'	=>	'text'
),
array(
	'name'	=>	'Instagram '.__('Profile', 'tswp'),
	'desc'	=>	__('Include for display in header', 'tswp'),
	'id'	=>	'instagram_profile',
	'std'	=>	'http://instagram.com/tshedor',
	'class'	=>	'third',
	'type'	=>	'text'
),
array(
	'name'	=>	'Flickr '.__('Profile', 'tswp'),
	'desc'	=>	__('Include for display in header', 'tswp'),
	'id'	=>	'flickr_profile',
	'std'	=>	'http://www.flickr.com/photos/tshedor/',
	'class'	=>	'third',
	'type'	=>	'text'
),
array(
	'name'	=>	'LinkedIn '.__('Profile', 'tswp'),
	'desc'	=>	__('Include for display in header', 'tswp'),
	'id'	=>	'linkedin_profile',
	'std'	=>	'http://www.linkedin.com/profile/view?id=76301105&trk=hb_tab_pro_top',
	'class'	=>	'third',
	'type'	=>	'text'
),
array(
	'name'	=>	'Google+ '.__('Profile', 'tswp'),
	'desc'	=>	__('Include for display in header', 'tswp'),
	'id'	=>	'googleplus_profile',
	'std'	=>	'https://plus.google.com/u/0/115986805136940069805/posts',
	'class'	=>	'half',
	'type'	=>	'text'
),
array(
	'name'	=>	'Github '.__('Profile', 'tswp'),
	'desc'	=>	__('Include for display in header', 'tswp'),
	'id'	=>	'github_profile',
	'std'	=>	'http://github.com/tshedor',
	'class'	=>	'half',
	'type'	=>	'text'
),
array(
	'name'	=>	__('Show RSS in header', 'tswp'),
	'desc'	=>	'',
	'id'	=>	'feed_profile',
	'std'	=>	'',
	'class'	=>	'third',
	'type'	=>	'checkbox',
	'def'	=>	true,
),
array(
	'name'	=>	__('Show Email in header', 'tswp'),
	'desc'	=>	__('Uses the email set in General settings', 'tswp'),
	'id'	=>	'email_profile',
	'std'	=>	'',
	'class'	=>	'third',
	'type'	=>	'checkbox',
	'def'	=>	true,
),
array(
	'name'	=>	__('Show RSS on Archive pages', 'tswp'),
	'desc'	=>	'',
	'id'	=>	'show_rss_on_archive',
	'std'	=>	'',
	'class'	=>	'third',
	'type'	=>	'checkbox',
	'def'	=>	true,
),
array(
	'name'	=>	__('Show social buttons on posts', 'tswp'),
	'desc'	=>	'',
	'id'	=>	'show_social',
	'std'	=>	'',
	'class'	=>	'half',
	'type'	=>	'checkbox',
	'def'	=>	true,
),
array(
	'name'	=> __('Share icon style', 'tswp'),
	'desc'	=> '',
	'id'	=> 'share_icon_style',
	'std'	=> 'plain',
	'class' => 'half',
	'type'	=> 'radio',
	'options' => array(
		array(
			'label' => 'Plain',
			'value' => 'plain',
		),
		array(
			'label' => 'Round',
			'value' => 'round'
		),
		array(
			'label' => 'Square',
			'value' => 'square'
		),
	)
),
array(
	'name'	=>	'Clear',
	'desc'	=>	'',
	'id'	=>	'clear',
	'std'	=>	'<div class="clear"></div>',
	'type'	=>	'customnotice'
),
array(
	'name'	=>	'Facebook',
	'desc'	=>	'facebook-2',
	'id'	=>	'facebook',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'socialcheckbox',
	'def'	=>	true,
),
array(
	'name'	=>	__('Like button', 'tswp'),
	'desc'	=>	'thumbs-up',
	'id'	=>	'fblike',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'socialcheckbox',
	'def'	=>	true,
),
array(
	'name'	=>	'Twitter',
	'desc'	=>	'twitter-2',
	'id'	=>	'twitter',
	'std'	=>	'',
	'type'	=>	'socialcheckbox',
	'def'	=>	true,
),
array(
	'name'	=>	'Pinterest',
	'desc'	=>	'pinterest-2',
	'id'	=>	'pinterest',
	'std'	=>	'',
	'type'	=>	'socialcheckbox',
),
array(
	'name'	=>	'Google+',
	'desc'	=>	'googleplus-2',
	'id'	=>	'googleplus',
	'std'	=>	'',
	'type'	=>	'socialcheckbox',
),
array(
	'name'	=>	'StumbleUpon',
	'desc'	=>	'stumbleupon-2',
	'id'	=>	'stumbleupon',
	'std'	=>	'',
	'type'	=>	'socialcheckbox',
),
array(
	'name'	=>	'Reddit',
	'desc'	=>	'reddit',
	'id'	=>	'reddit',
	'std'	=>	'',
	'type'	=>	'socialcheckbox',
),
array(
	'name'	=>	'LinkedIn',
	'desc'	=>	'linkedin-2',
	'id'	=>	'linkedin',
	'std'	=>	'',
	'type'	=>	'socialcheckbox',
),
array(
	'name'	=>	__('Print', 'tswp'),
	'desc'	=>	'print',
	'id'	=>	'show_print',
	'std'	=>	'',
	'type'	=>	'socialcheckbox',
),
array(
	'name'	=>	'End array',
	'desc'	=>	'',
	'id'	=>	'endarray',
	'std'	=>	'',
	'type'	=>	'endarray'
),
);
$sitewide = array(
array(
	'name'	=>	__('Sitewide', 'tswp'),
	'desc'	=>	'',
	'id'	=>	'separate',
	'std'	=>	'',
	'type'	=>	'separate'
),
array(
	'name'	=>	__('Logo URL', 'tswp'),
	'desc'	=>	__('The URL to your logo', 'tswp'),
	'id'	=>	'logo',
	'std'	=>	'http://example.com/logo.png',
	'type'	=>	'media'
),
array(
	'name'	=>	__('Favicon URL', 'tswp'),
	'desc'	=>	__('The URL to your favicon, like http://example.com/favicon.ico. Should be 32x32.', 'tswp'),
	'id'	=>	'favicon',
	'std'	=>	'http://timshedor.com/favicon.ico',
	'type'	=>	'media'
),
array(
	'name'	=>	__('Landing/Coming Soon/Splash Page Active', 'tswp'),
	'desc'	=>	__('Show a splash page instead of the actual site unless you\'re logged in', 'tswp'),
	'id'	=>	'maintenance_mode',
	'std'	=>	'',
	'type'	=>	'checkbox'
),
array(
	'name'	=>	__('Show dates', 'tswp'),
	'desc'	=>	__('Have dates appear anywhere arcross the site', 'tswp'),
	'id'	=>	'show_dates',
	'std'	=>	'',
	'type'	=>	'checkbox',
	'def'	=>	true,
),
array(
	'name'	=>	__('Get first post image and set it as the featured image', 'tswp'),
	'desc'	=>	__('In case you don\'t want to use a plugin like Get the Image or similar', 'tswp'),
	'id'	=>	'get_first_image',
	'std'	=>	'',
	'type'	=>	'checkbox',
	'def'	=>	true,
),
array(
	'name'	=>	__('Show breadcrumbs on archive pages', 'tswp'),
	'desc'	=>	'',
	'id'	=>	'breadcrumbs_archive',
	'std'	=>	'',
	'class'	=>	'half',
	'type'	=>	'checkbox'
),
array(
	'name'	=>	__('Show breadcrumbs on single pages', 'tswp'),
	'desc'	=>	'',
	'id'	=>	'breadcrumbs_single',
	'std'	=>	'',
	'class'	=>	'half',
	'type'	=>	'checkbox'
),
array(
	'name'	=>	__('Show related posts at the bottom of posts', 'tswp'),
	'desc'	=>	'',
	'id'	=>	'show_related_on_single',
	'std'	=>	'',
	'class'	=>	'half',
	'type'	=>	'checkbox',
	'def'	=>	true
),
array(
	'name'	=>	__('Show comments on pages', 'tswp'),
	'desc'	=>	'',
	'id'	=>	'comments_on_pages',
	'std'	=>	'',
	'class'	=>	'half',
	'type'	=>	'checkbox'
),
array(
	'name'	=>	__('Use all JS libraries included with theme', 'tswp'),
	'desc'	=>	__('This includes Modernizr, PrismJS, Superfish, bxSlider, hoverIntent and jQuery Easing (with compatibility)', 'tswp'),
	'id'	=>	'use_ts_plugins',
	'std'	=>	'',
	'class'	=>	'half',
	'type'	=>	'checkbox',
	'def'	=>	true
),
array(
	'name'	=>	__('Use builtin Magnific lightbox for single images and galleries', 'tswp'),
	'desc'	=>	__('In case you don\'t use a plugin like NextGEN, or anyother lightbox plugin', 'tswp'),
	'id'	=>	'magnific_lb',
	'std'	=>	'',
	'class'	=>	'half',
	'type'	=>	'checkbox',
	'def'	=>	true
),
array(
	'name'	=>	__('Author credit in footer', 'tswp'),
	'desc'	=>	__('Please leave this credit in the footer', 'tswp'),
	'id'	=>	'footer_credit',
	'std'	=>	'',
	'class'	=>	'half',
	'type'	=>	'checkbox',
	'def'	=>	true
),
array(
	'name'	=>	__('Copyright Text', 'tswp'),
	'desc'	=>	__('Defaults to &copy; Copyright {SITE NAME} {CURRENT YEAR}', 'tswp'),
	'id'	=>	'copyright_text',
	'std'	=>	'',
	'class'	=>	'half',
	'type'	=>	'text'
),
array(
	'name'	=>	__('Default Contact Form Email', 'tswp'),
	'desc'	=>	__('Defaults to the admin email (under Settings > General)', 'tswp'),
	'id'	=>	'contact_form_email',
	'std'	=>	'',
	'class'	=>	'clear',
	'type'	=>	'text'
),
array(
	'name'	=>	__('Analytics Code', 'tswp'),
	'desc'	=>	__('Paste the code from Google Analytics or a similar analytics service here if you don\'t use a plugin', 'tswp'),
	'id'	=>	'analytics_code',
	'std'	=>	'',
	'class'	=>	'two-thirds',
	'type'	=>	'textareacode'
),
array(
	'name'	=>	__('Do not track logged in users', 'tswp'),
	'desc'	=>	'',
	'id'	=>	'do_not_track_users',
	'class'	=>	'third',
	'type'	=>	'checkbox',
	'def'	=>	true
),
array(
	'name'	=>	__('Custom CSS', 'tswp'),
	'desc'	=>	__('Override styles with your own code', 'tswp'),
	'id'	=>	'custom_css',
	'std'	=>	'',
	'class'	=>	'clear',
	'type'	=>	'textareacode'
),
array(
	'name'	=>	'End array',
	'desc'	=>	'',
	'id'	=>	'endarray',
	'std'	=>	'',
	'type'	=>	'endarray'
),
);
$options = array_merge($social,$sitewide);