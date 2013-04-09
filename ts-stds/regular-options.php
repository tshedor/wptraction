<?php
$social = array(
array(
	'name'	=>	'Social',
	'desc'	=>	'',
	'type'	=>	'separate',
	'id'	=>	'separate',
	'std'	=>	'',
	'class'	=>	'',
	'required' => false
),
array(
	'name'	=>	'Twitter',
	'desc'	=>	'Twitter Profile. No @ sign.',
	'id'	=>	'twitter_profile',
	'std'	=>	'tshedor',
	'class'	=>	'third',
	'type'	=>	'text',
	'required' => false
),
array(
	'name'	=>	'Facebook Profile',
	'desc'	=>	'Include for display in header',
	'id'	=>	'facebook_profile',
	'std'	=>	'http://facebook.com/tshedor',
	'class'	=>	'third',
	'type'	=>	'text',
	'required' => false
),
array(
	'name'	=>	'Pinterest Profile',
	'desc'	=>	'Include for display in header',
	'id'	=>	'pinterest_profile',
	'std'	=>	'http://pinterest.com/tshedor',
	'class'	=>	'third',
	'type'	=>	'text',
	'required' => false
),
array(
	'name'	=>	'Instagram Profile',
	'desc'	=>	'Include for display in header',
	'id'	=>	'instagram_profile',
	'std'	=>	'http://instagram.com/tshedor',
	'class'	=>	'third',
	'type'	=>	'text',
	'required' => false
),
array(
	'name'	=>	'Flickr Profile',
	'desc'	=>	'Include for display in header',
	'id'	=>	'flickr_profile',
	'std'	=>	'http://www.flickr.com/photos/tshedor/',
	'class'	=>	'third',
	'type'	=>	'text',
	'required' => false
),
array(
	'name'	=>	'LinkedIn Profile',
	'desc'	=>	'Include for display in header',
	'id'	=>	'linkedin_profile',
	'std'	=>	'http://www.linkedin.com/profile/view?id=76301105&trk=hb_tab_pro_top',
	'class'	=>	'third',
	'type'	=>	'text',
	'required' => false
),
array(
	'name'	=>	'Google+ Profile',
	'desc'	=>	'Include for display in header',
	'id'	=>	'googleplus_profile',
	'std'	=>	'https://plus.google.com/u/0/115986805136940069805/posts',
	'class'	=>	'half',
	'type'	=>	'text',
	'required' => false
),
array(
	'name'	=>	'Github Profile',
	'desc'	=>	'Include for display in header',
	'id'	=>	'github_profile',
	'std'	=>	'http://github.com/tshedor',
	'class'	=>	'half',
	'type'	=>	'text',
	'required' => false
),
array(
	'name'	=>	'Show RSS in header',
	'desc'	=>	'',
	'id'	=>	'feed_profile',
	'std'	=>	'',
	'class'	=>	'third',
	'type'	=>	'checkbox',
	'def'	=>	true,
	'required' => false
),
array(
	'name'	=>	'Show Email in header',
	'desc'	=>	'Uses the email set in General settings',
	'id'	=>	'mail_profile',
	'std'	=>	'',
	'class'	=>	'third',
	'type'	=>	'checkbox',
	'def'	=>	true,
	'required' => false
),
array(
	'name'	=>	'Show RSS on Archive pages',
	'desc'	=>	'',
	'id'	=>	'show_rss_on_archive',
	'std'	=>	'',
	'class'	=>	'third',
	'type'	=>	'checkbox',
	'def'	=>	true,
	'required' => false
),
array(
	'name'	=>	'Show social buttons on posts',
	'desc'	=>	'',
	'id'	=>	'show_social',
	'std'	=>	'',
	'class'	=>	'third',
	'type'	=>	'checkbox',
	'def'	=>	true,
	'required' => false
),
array(
	'name'	=> 'Share icon style',
	'desc'	=> '',
	'id'	=> 'share_icon_style',
	'std'	=> 'plain',
	'class' => 'clear',
	'type'	=> 'radio',
	'required' => false,
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
	'required' => false
),
array(
	'name'	=>	'FB Like button',
	'desc'	=>	'thumbs-up',
	'id'	=>	'fblike',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'socialcheckbox',
	'def'	=>	true,
	'required' => false
),
array(
	'name'	=>	'Twitter',
	'desc'	=>	'twitter-2',
	'id'	=>	'twitter',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'socialcheckbox',
	'def'	=>	true,
	'required' => false
),
array(
	'name'	=>	'Pinterest',
	'desc'	=>	'pinterest-2',
	'id'	=>	'pinterest',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'socialcheckbox',
	'def'	=>	false,
	'required' => false
),
array(
	'name'	=>	'Google+',
	'desc'	=>	'googleplus-2',
	'id'	=>	'googleplus',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'socialcheckbox',
	'def'	=>	false,
	'required' => false
),
array(
	'name'	=>	'StumbleUpon',
	'desc'	=>	'stumbleupon-2',
	'id'	=>	'stumbleupon',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'socialcheckbox',
	'def'	=>	false,
	'required' => false
),
array(
	'name'	=>	'Reddit',
	'desc'	=>	'reddit',
	'id'	=>	'reddit',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'socialcheckbox',
	'def'	=>	false,
	'required' => false
),
array(
	'name'	=>	'LinkedIn',
	'desc'	=>	'linkedin-2',
	'id'	=>	'linkedin',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'socialcheckbox',
	'def'	=>	false,
	'required' => false
),
array(
	'name'	=>	'Print',
	'desc'	=>	'print',
	'id'	=>	'show_print',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'socialcheckbox',
	'def'	=>	false,
	'required' => false
),
array(
	'name'	=>	'End array',
	'desc'	=>	'',
	'id'	=>	'endarray',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'endarray',
	'required' => false
),
);
$sitewide = array(
array(
	'name'	=>	'Sitewide',
	'desc'	=>	'',
	'id'	=>	'separate',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'separate',
	'required' => false
),
array(
	'name'	=>	'Icons',
	'desc'	=>	'Pick an icon',
	'id'	=>	'home_icon_1',
	'std'	=>	'http://example.com/logo.png',
	'class'	=>	'clear',
	'type'	=>	'icons',
	'required' => false
),
array(
	'name'	=>	'Logo URL',
	'desc'	=>	'The URL to your logo',
	'id'	=>	'logo',
	'std'	=>	'http://example.com/logo.png',
	'class'	=>	'',
	'type'	=>	'media',
	'required' => false
),
array(
	'name'	=>	'Favicon URL',
	'desc'	=>	'The URL to your favicon, like http://example.com/favicon.ico. Should be 32x32.',
	'id'	=>	'favicon',
	'std'	=>	'http://timshedor.com/favicon.ico',
	'class'	=>	'',
	'type'	=>	'media',
	'required' => false
),
array(
	'name'	=>	'Maintenance Mode Active',
	'desc'	=>	'Show a splash page instead of the actual site unless you\'re logged in',
	'id'	=>	'maintenance_mode',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'checkbox',
	'required' => false
),
array(
	'name'	=>	'Show dates',
	'desc'	=>	'Have dates appear anywhere arcross the site',
	'id'	=>	'show_dates',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'checkbox',
	'def'	=>	true,
	'required' => false
),
array(
	'name'	=>	'Get first post image and set it as the featured image',
	'desc'	=>	'In case you don\'t want to use a plugin like Get the Image or similar',
	'id'	=>	'get_first_image',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'checkbox',
	'def'	=>	true,
	'required' => false
),
array(
	'name'	=>	'Show breadcrumbs on archive pages',
	'desc'	=>	'',
	'id'	=>	'breadcrumbs_archive',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'checkbox',
	'required' => false
),
array(
	'name'	=>	'Show breadcrumbs on single pages',
	'desc'	=>	'',
	'id'	=>	'breadcrumbs_single',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'checkbox',
	'required' => false
),
array(
	'name'	=>	'Show related posts at the bottom of posts',
	'desc'	=>	'',
	'id'	=>	'show_related_on_single',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'checkbox',
	'def'	=>	true,
	'required' => false
),
array(
	'name'	=>	'Show comments on pages',
	'desc'	=>	'',
	'id'	=>	'comments_on_pages',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'checkbox',
	'required' => false
),
array(
	'name'	=>	'Analytics Code',
	'desc'	=>	'Paste the code from Google Analytics or a similar analytics service here if you don\'t use a plugin',
	'id'	=>	'analytics_code',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'textareacode',
	'required' => false
),
array(
	'name'	=>	'Custom CSS',
	'desc'	=>	'Override styles with your own code',
	'id'	=>	'custom_css',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'textareacode',
	'required' => false
),
array(
	'name'	=>	'End array',
	'desc'	=>	'',
	'id'	=>	'endarray',
	'std'	=>	'',
	'class'	=>	'',
	'type'	=>	'endarray',
	'required' => false
),
);
$options = array_merge($social,$sitewide);