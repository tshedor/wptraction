<?php

//Sample meta box to give user layout option
//If you want to use this, put the whole post-meta folder in inc/ and be the file is included in /functions.php
//^by default, it is


$layout_meta_fields = array(
	array(
		'name'	=> '',
		'desc'	=> '',
		'id'	=> 'post_layout',
		'std'	=> 'default',
		'type'	=> 'radio',
		'options' => array(
			array(
				'label' => __('Right Sidebar', 'trwp'),
				'value' => 'default',
				'image'	=>	get_template_directory_uri().'/inc/post-meta/right-sidebar.png'
			),
			array(
				'label' => __('Left Sidebar', 'trwp'),
				'value' => 'left-sidebar',
				'image'	=>	get_template_directory_uri().'/inc/post-meta/left-sidebar.png'
			),
			array(
				'label' => __('Full Width', 'trwp'),
				'value' => 'full-width',
				'image'	=>	get_template_directory_uri().'/inc/post-meta/full-width.png'
			),
		)
	),
);

$layout_meta_information = array(
	'title' => 'Layouts'
);

new TractionMetaBoxes($layout_meta_fields, $layout_meta_information); ?>