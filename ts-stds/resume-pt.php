<?php

add_action('init', 'resume_register');
function resume_register() {
	$labels = array(
		'name'			=>	_x('Resume', 'post type general name'),
		'singular_name'	=>	_x('Resume Item', 'post type singular name'),
		'add_new'		=>	_x('Add New Item', 'resume item'),
		'add_new_item'	=>	__('Add New Resume Item', 'tswp'),
		'edit_item'		=>	__('Edit Resume Item', 'tswp'),
		'new_item'		=>	__('New Resume Item', 'tswp'),
		'view_item'		=>	__('View Resume Item', 'tswp'),
		'search_items'	=>	__('Search Resumes', 'tswp'),
		'not_found'		=>	__('Nothing found', 'tswp'),
		'parent_item_colon'	=>	''
	);

	$args = array(
		'labels'				=>	$labels,
		'public'				=>	true,
		'publicly_queryable'	=>	true,
		'show_ui'				=>	true,
		'query_var'				=>	true,
		'rewrite'				=>	true,
		'capability_type'		=>	'post',
		'hierarchical'			=>	false,
		'menu_position'			=>	3,
		'supports'				=>	array('title','thumbnail')
	);

	register_post_type( 'resume' , $args );

	register_taxonomy("resume_categories", array("resume"), array("hierarchical" => true, "label" => __('Resume Categories', 'tswp'), "singular_label" => __('Resume Category', 'tswp'), "rewrite" => true));

function add_resume_meta_box() {
	add_meta_box(
	'resume_meta_box',
	'Resume Detail',
	'show_resume_meta_box',
	'resume',
	'normal',
	'high');
}
add_action('add_meta_boxes', 'add_resume_meta_box');

$resume_meta_fields = array(
	array(
		'name'	=> __('Display Style', 'tswp'),
		'desc'	=> '',
		'id'	=> 'display_style',
		'type'	=> 'radio',
		'class' => '',
		'required' => false,
		'std' => 'normal',
		'options' => array(
			array(
				'label' => __('Normal', 'tswp'),
				'value' => 'normal',
			),
			array(
				'label' => __('Chunk &#8531;', 'tswp'),
				'value' => 'one_third'
			),
			array(
				'label' => __('Chunk &frac14;', 'tswp'),
				'value' => 'one_fourth'
			),
			array(
				'label' => __('Long', 'tswp'),
				'value' => 'just_text'
			),
		)
	),
	array(
		'name'	=> __('Date Begun', 'tswp'),
		'desc'	=> '',
		'id'	=> 'date_begun',
		'std'	=>	__('May 2012', 'tswp'),
		'type'	=> 'date',
		'required' => true,
		'class'	=>	'',
	),
	array(
		'name'	=> __('Position Held', 'tswp'),
		'desc'	=> '',
		'id'	=> 'position',
		'std'	=>	'intern',
		'type'	=> 'text',
		'class'	=> '',
		'required'	=>	false,
	),
	array(
		'name'	=> __('Date Completed', 'tswp'),
		'desc'	=> '',
		'id'	=> 'date_completed',
		'std'	=>	__('August 2013 or Present', 'tswp'),
		'type'	=> 'date',
		'class'	=>	'',
		'required'	=>	false
	),
	array(
		'name'	=> __('Description', 'tswp'),
		'desc'	=> '',
		'id'	=> 'description',
		'type'	=> 'textarea',
		'class'	=>	'',
		'required'	=>	false,
		'std'	=> __('My job responsibilities included sweeping, smiling and fetching coffee', 'tswp')
	),
);

function show_resume_meta_box() {
	global $post, $resume_meta_fields;
	wp_nonce_field( basename( __FILE__ ), 'resume_meta_box_nonce' );
	echo '<div class="form-table tsao">';
	foreach ($resume_meta_fields as $value) {
		$meta = get_post_meta($post->ID, $value['id'], true);
		$fieldType = $value['type'];
		$newField = new adminfield($meta,$value);
		echo $newField->$fieldType();
	}
	echo '</div>';
}

function save_resume_meta($post_id) {
	global $resume_meta_fields;
	if ( !isset( $_POST['resume_meta_box_nonce'] )  || !wp_verify_nonce($_POST['resume_meta_box_nonce'], basename(__FILE__)))
		return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id))
			return $post_id;
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
	}

	foreach ($resume_meta_fields as $field) {
		if($field['type'] == 'tax_select') continue;
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

}
add_action('save_post', 'save_resume_meta');

add_action("manage_posts_custom_column",	"resume_custom_columns");
add_filter("manage_edit-resume_columns", "resume_edit_columns");

function resume_edit_columns($columns){
	$columns = array(
		"cb"				=>	"<input type=\"checkbox\" />",
		"title"				=>	__('Supervisor/Corporation', 'tswp'),
		"date_begun"		=>	__('Date Begun', 'tswp'),
		"date_completed"	=>	__('Date Completed', 'tswp'),
		"position"			=>	__('Position Held', 'tswp'),
		"description"		=>	__('Description', 'tswp'),
	);
	return $columns;
}
function resume_custom_columns($column){
	global $post;
	$custom = get_post_custom();
	switch ($column) {
		case "description":
			echo $custom["description"][0];
			break;
		case "date_begun":
			echo $custom["date_begun"][0];
			break;
		case "date_completed":
			echo $custom["date_completed"][0];
			break;
		case "position":
			echo $custom["position"][0];
			break;
	}
};
register_post_type( 'resume' , $args );
	flush_rewrite_rules();
} ?>