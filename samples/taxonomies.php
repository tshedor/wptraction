<?php
//Put this file in the inc/ directory


function create_taxonomies() {
	register_taxonomy(
		'client',
		'sample',
		array(
			'hierarchical' => false,
			'label' => 'Client',
			'query_var' => true,
			'rewrite' => array('slug' => 'client'),
		)
	);
}
add_action( 'init', 'create_taxonomies');