<?php
function add_layout_meta_box() {
	add_meta_box(
	'layout_meta_box',
	__('Layouts', 'tswp'),
	'show_layout_meta_box',
	'post',
	'normal',
	'high');
}
add_action('add_meta_boxes', 'add_layout_meta_box');
$layout_meta_fields = array(
array(
	'name'	=> '',
	'desc'	=> '',
	'id'	=> 'post_layout',
	'std'	=> 'default',
	'type'	=> 'radio',
	'options' => array(
		array(
			'label' => __('Right Sidebar', 'tswp'),
			'value' => 'default',
			'image'	=>	get_template_directory_uri().'/inc/ts-stds/post-meta/right-sidebar.png'
		),
		array(
			'label' => __('Left Sidebar', 'tswp'),
			'value' => 'left-sidebar',
			'image'	=>	get_template_directory_uri().'/inc/ts-stds/post-meta/left-sidebar.png'
		),
		array(
			'label' => __('Full Width', 'tswp'),
			'value' => 'full-width',
			'image'	=>	get_template_directory_uri().'/inc/ts-stds/post-meta/full-width.png'
		),
	)
),
);

function show_layout_meta_box() {
	global $layout_meta_fields, $post;
	wp_nonce_field( basename( __FILE__ ), 'layout_meta_box_nonce' );
	echo '<div class="wrap tsao clear clearfix" id="poststuff">';
	$globalMeta = get_post_custom($post->ID);
	foreach ($layout_meta_fields as $value) {
		if(isset($globalMeta[$value['id']][0]))
			$meta = $globalMeta[$value['id']][0];
		else
			$meta = false;
		$fieldType = $value['type'];
		$newField = new adminfield($meta,$value);
		$newField->$fieldType();
	}
	echo '</div>';
}
function save_layout_meta($post_id) {
	global $layout_meta_fields;
	if ( !isset( $_POST['layout_meta_box_nonce'] )  || !wp_verify_nonce($_POST['layout_meta_box_nonce'], basename(__FILE__)))
		return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id))
			return $post_id;
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
	}

	foreach ($layout_meta_fields as $field) {
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
add_action('save_post', 'save_layout_meta');

?>