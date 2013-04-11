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
	'name'	=>	'Social',
	'desc'	=>	'',
	'id'	=>	'separate',
	'std'	=>	'',
	'type'	=>	'separate'
),
array(
	'name'	=>	'Twitter',
	'desc'	=>	'Twitter Profile. No @ sign.',
	'id'	=>	'twitter_profile',
	'std'	=>	'tshedor',
	'class'	=>	'third',
	'type'	=>	'text'
),
array(
	'name'	=>	'Facebook Profile',
	'desc'	=>	'Include for display in header',
	'id'	=>	'facebook_profile',
	'std'	=>	'http://facebook.com/tshedor',
	'class'	=>	'third',
	'type'	=>	'text'
),
array(
	'name'	=>	'Pinterest Profile',
	'desc'	=>	'Include for display in header',
	'id'	=>	'pinterest_profile',
	'std'	=>	'http://pinterest.com/tshedor',
	'class'	=>	'third',
	'type'	=>	'text'
),
array(
	'name'	=>	'Instagram Profile',
	'desc'	=>	'Include for display in header',
	'id'	=>	'instagram_profile',
	'std'	=>	'http://instagram.com/tshedor',
	'class'	=>	'third',
	'type'	=>	'text'
),
array(
	'name'	=>	'Flickr Profile',
	'desc'	=>	'Include for display in header',
	'id'	=>	'flickr_profile',
	'std'	=>	'http://www.flickr.com/photos/tshedor/',
	'class'	=>	'third',
	'type'	=>	'text'
),
array(
	'name'	=>	'LinkedIn Profile',
	'desc'	=>	'Include for display in header',
	'id'	=>	'linkedin_profile',
	'std'	=>	'http://www.linkedin.com/profile/view?id=76301105&trk=hb_tab_pro_top',
	'class'	=>	'third',
	'type'	=>	'text'
),
array(
	'name'	=>	'Google+ Profile',
	'desc'	=>	'Include for display in header',
	'id'	=>	'googleplus_profile',
	'std'	=>	'https://plus.google.com/u/0/115986805136940069805/posts',
	'class'	=>	'half',
	'type'	=>	'text'
),
array(
	'name'	=>	'Github Profile',
	'desc'	=>	'Include for display in header',
	'id'	=>	'github_profile',
	'std'	=>	'http://github.com/tshedor',
	'class'	=>	'half',
	'type'	=>	'text'
),
array(
	'name'	=>	'Show RSS in header',
	'desc'	=>	'',
	'id'	=>	'feed_profile',
	'std'	=>	'',
	'class'	=>	'third',
	'type'	=>	'checkbox',
	'def'	=>	true,
),
array(
	'name'	=>	'Show Email in header',
	'desc'	=>	'Uses the email set in General settings',
	'id'	=>	'mail_profile',
	'std'	=>	'',
	'class'	=>	'third',
	'type'	=>	'checkbox',
	'def'	=>	true,
),
array(
	'name'	=>	'Show RSS on Archive pages',
	'desc'	=>	'',
	'id'	=>	'show_rss_on_archive',
	'std'	=>	'',
	'class'	=>	'third',
	'type'	=>	'checkbox',
	'def'	=>	true,
),
array(
	'name'	=>	'Show social buttons on posts',
	'desc'	=>	'',
	'id'	=>	'show_social',
	'std'	=>	'',
	'class'	=>	'third',
	'type'	=>	'checkbox',
	'def'	=>	true,
),
array(
	'name'	=> 'Share icon style',
	'desc'	=> '',
	'id'	=> 'share_icon_style',
	'std'	=> 'plain',
	'class' => 'clear',
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
	'name'	=>	'Facebook',
	'desc'	=>	'facebook-2',
	'id'	=>	'facebook',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'socialcheckbox',
	'def'	=>	true,
),
array(
	'name'	=>	'FB Like button',
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
	'name'	=>	'Print',
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
	'name'	=>	'Sitewide',
	'desc'	=>	'',
	'id'	=>	'separate',
	'std'	=>	'',
	'type'	=>	'separate'
),
array(
	'name'	=>	'Logo URL',
	'desc'	=>	'The URL to your logo',
	'id'	=>	'logo',
	'std'	=>	'http://example.com/logo.png',
	'type'	=>	'media'
),
array(
	'name'	=>	'Favicon URL',
	'desc'	=>	'The URL to your favicon, like http://example.com/favicon.ico. Should be 32x32.',
	'id'	=>	'favicon',
	'std'	=>	'http://timshedor.com/favicon.ico',
	'type'	=>	'media'
),
array(
	'name'	=>	'Maintenance Mode Active',
	'desc'	=>	'Show a splash page instead of the actual site unless you\'re logged in',
	'id'	=>	'maintenance_mode',
	'std'	=>	'',
	'type'	=>	'checkbox'
),
array(
	'name'	=>	'Show dates',
	'desc'	=>	'Have dates appear anywhere arcross the site',
	'id'	=>	'show_dates',
	'std'	=>	'',
	'type'	=>	'checkbox',
	'def'	=>	true,
),
array(
	'name'	=>	'Get first post image and set it as the featured image',
	'desc'	=>	'In case you don\'t want to use a plugin like Get the Image or similar',
	'id'	=>	'get_first_image',
	'std'	=>	'',
	'type'	=>	'checkbox',
	'def'	=>	true,
),
array(
	'name'	=>	'Show breadcrumbs on archive pages',
	'desc'	=>	'',
	'id'	=>	'breadcrumbs_archive',
	'std'	=>	'',
	'type'	=>	'checkbox'
),
array(
	'name'	=>	'Show breadcrumbs on single pages',
	'desc'	=>	'',
	'id'	=>	'breadcrumbs_single',
	'std'	=>	'',
	'type'	=>	'checkbox'
),
array(
	'name'	=>	'Show related posts at the bottom of posts',
	'desc'	=>	'',
	'id'	=>	'show_related_on_single',
	'std'	=>	'',
	'type'	=>	'checkbox',
	'def'	=>	true
),
array(
	'name'	=>	'Show comments on pages',
	'desc'	=>	'',
	'id'	=>	'comments_on_pages',
	'std'	=>	'',
	'type'	=>	'checkbox'
),
array(
	'name'	=>	'Use Slimbox lightbox for single images',
	'desc'	=>	'In case you don\'t use a plugin like NextGEN',
	'id'	=>	'slimbox_single',
	'std'	=>	'',
	'class'	=>	'half',
	'type'	=>	'checkbox',
	'def'	=>	true
),
array(
	'name'	=>	'Use Slimbox lightbox for galleries',
	'desc'	=>	'In case you don\'t use a plugin like NextGEN',
	'id'	=>	'slimbox_gallery',
	'std'	=>	'',
	'class'	=>	'half',
	'type'	=>	'checkbox',
	'def'	=>	true
),
array(
	'name'	=>	'Author credit in footer',
	'desc'	=>	'Please leave this credit in the footer',
	'id'	=>	'footer_credit',
	'std'	=>	'',
	'class'	=>	'clear',
	'type'	=>	'checkbox',
	'def'	=>	true
),
array(
	'name'	=>	'Copyright Text',
	'desc'	=>	'Defaults to &copy; Copyright {SITE NAME} {CURRENT YEAR}',
	'id'	=>	'copyright_text',
	'std'	=>	'',
	'class'	=>	'clear',
	'type'	=>	'text'
),
array(
	'name'	=>	'Analytics Code',
	'desc'	=>	'Paste the code from Google Analytics or a similar analytics service here if you don\'t use a plugin',
	'id'	=>	'analytics_code',
	'std'	=>	'',
	'type'	=>	'textareacode'
),
array(
	'name'	=>	'Custom CSS',
	'desc'	=>	'Override styles with your own code',
	'id'	=>	'custom_css',
	'std'	=>	'',
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