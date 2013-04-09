<?php

add_action('init', 'resume_register');
function resume_register() {
	$labels = array(
		'name' => _x('Resume', 'post type general name'),
		'singular_name' => _x('Resume Item', 'post type singular name'),
		'add_new' => _x('Add New Item', 'resume item'),
		'add_new_item' => 'Add New Resume Item',
		'edit_item' => 'Edit Resume Item',
		'new_item' => 'New Resume Item',
		'view_item' => 'View Resume Item',
		'search_items' => 'Search Resumes',
		'not_found' => 'Nothing found',
		'not_found_in_trash' => 'Nothing found in Trash',
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 3,
		'supports' => array('title','thumbnail')
		);

	register_post_type( 'resume' , $args );

	register_taxonomy("resume_categories", array("resume"), array("hierarchical" => true, "label" => "Resume Categories", "singular_label" => "Resume Category", "rewrite" => true));

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


function show_resume_meta_box() {
	global $post;

$resume_meta_fields = array(
	array(
		'name'	=> 'Display Style',
		'desc'	=> '',
		'id'	=> 'display_style',
		'type'	=> 'radio',
		'class' => '',
		'required' => false,
		'std' => 'normal',
		'options' => array(
			array(
				'label' => 'Normal',
				'value' => 'normal',
			),
			array(
				'label' => 'Chunk 1/3',
				'value' => 'one_third'
			),
			array(
				'label' => 'Chunk 1/4',
				'value' => 'one_fourth'
			),
			array(
				'label' => 'Long',
				'value' => 'just_text'
			),
		)
	),
	array(
		'name'	=> 'Date Begun',
		'desc'	=> '',
		'id'	=> 'date_begun',
		'std'	=>	'May 2012',
		'type'	=> 'date',
		'required' => true,
		'class'	=>	'',
	),
	array(
		'name'	=> 'Position Held',
		'desc'	=> '',
		'id'	=> 'position',
		'std'	=>	'intern',
		'type'	=> 'text',
		'class'	=> '',
		'required'	=>	false,
	),
	array(
		'name'	=> 'Date Completed',
		'desc'	=> '',
		'id'	=> 'date_completed',
		'std'	=>	'August 2013 or Present',
		'type'	=> 'date',
		'class'	=>	'',
		'required'	=>	false
	),
	array(
		'name'	=> 'Description',
		'desc'	=> '',
		'id'	=> 'description',
		'type'	=> 'textarea',
		'class'	=>	'',
		'required'	=>	false,
		'std'	=> 'My job responsibilities included sweeping, smiling and fetching coffee'
	),

);
	wp_nonce_field( basename( __FILE__ ), 'resume_meta_box_nonce' );
	echo '<div class="form-table tsao">';
	foreach ($resume_meta_fields as $value) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $value['id'], true);
		$fieldType = $value['type'];
		$newField = new adminfield($meta,$value);
		echo $newField->$fieldType();
	}
	echo '</div>';
}

// Save the Data
function save_resume_meta($post_id) {

$resume_meta_fields = array(
	array(
		'name'	=> 'Display Style',
		'desc'	=> '',
		'id'	=> 'display_style',
		'type'	=> 'radio',
		'class' => '',
		'required' => false,
		'std' => 'normal',
		'options' => array(
			array(
				'label' => 'Normal',
				'value' => 'normal',
			),
			array(
				'label' => 'Chunk 1/3',
				'value' => 'one_third'
			),
			array(
				'label' => 'Chunk 1/4',
				'value' => 'one_fourth'
			),
			array(
				'label' => 'Long',
				'value' => 'just_text'
			),
		)
	),
	array(
		'name'	=> 'Date Begun',
		'desc'	=> '',
		'id'	=> 'date_begun',
		'std'	=>	'May 2012',
		'type'	=> 'date',
		'required' => true,
		'class'	=>	'',
	),
	array(
		'name'	=> 'Position Held',
		'desc'	=> '',
		'id'	=> 'position',
		'std'	=>	'intern',
		'type'	=> 'text',
		'class'	=> '',
		'required'	=>	false,
	),
	array(
		'name'	=> 'Date Completed',
		'desc'	=> '',
		'id'	=> 'date_completed',
		'std'	=>	'August 2013 or Present',
		'type'	=> 'date',
		'class'	=>	'',
		'required'	=>	false
	),
	array(
		'name'	=> 'Description',
		'desc'	=> '',
		'id'	=> 'description',
		'type'	=> 'textarea',
		'class'	=>	'',
		'required'	=>	false,
		'std'	=> 'My job responsibilities included sweeping, smiling and fetching coffee'
	),

);	if ( !isset( $_POST['resume_meta_box_nonce'] )  || !wp_verify_nonce($_POST['resume_meta_box_nonce'], basename(__FILE__)))
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
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Supervisor/Corporation",
		"date_begun" => "Date Begun",
		"date_completed" => "Date Completed",
		"position" => "Position Held",
		"description" => "Description",
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
}
function generate_resume(){
	$allCats = get_terms('resume_categories', 'orderby=none&hide_empty'); foreach($allCats as $rc){ ?>
	<div class="row clearfix resume-row">
		<div class="large-3 columns">
			<h2><?php echo $rc->name; ?></h2>
		</div>
		<div class="large-9 columns">
			<div class="row clearfix item-row">
			<?php $args = array( 'post_type' => 'resume', 'showposts' => -1, 'resume_categories' => $rc->slug );
			global $wp_query; $wp_query = new WP_Query($args); while($wp_query->have_posts()) : $wp_query->the_post(); ?>
			<?php if(get_post_meta(get_the_ID(), 'resume_style', true) == 'third_chunk'){ ?>
				<div class="large-4 columns">
					<h3><?php the_title(); ?></h3>
					<?php echo get_post_meta(get_the_ID(), 'third_chunk', true); ?>
				</div>
			<?php } elseif (get_post_meta(get_the_ID(), 'resume_style', true) == 'fourth_chunk') { ?>
				<div class="large-3 columns">
					<?php echo get_post_meta(get_the_ID(), 'fourth_chunk', true); ?>
				</div>
			<?php } elseif (get_post_meta(get_the_ID(), 'resume_style', true) == 'just_text') { ?>
				<div class="large-12 columns">
					<?php echo get_post_meta(get_the_ID(), 'just_text', true); ?>
				</div>
			<?php } else { ?>
			<div class="row clearfix item-row">
				<div class="large-4 columns item-details">
					<?php the_title(); echo '<br />';
					if(ifExists(get_post_meta(get_the_ID(), 'position_held', true))) { echo get_post_meta(get_the_ID(), 'position_held', true).'<br />'; }
					echo get_post_meta(get_the_ID(), 'date_begun', true); if(ifExists(get_post_meta(get_the_ID(), 'date_completed', true))) { echo ' - '.get_post_meta(get_the_ID(), 'date_completed', true); }
				echo '</div>';
				echo '<div class="large-8 columns item-desc">';
					echo get_post_meta(get_the_ID(), 'job_description', true); ?>
				</div>
			</div>
			<?php } endwhile; ?>
			</div>
		</div>
	</div>
<?php }
} ?>