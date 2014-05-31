<?php

add_editor_style('style.css');
add_post_type_support( 'page', 'excerpt' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-formats', array('gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'aside') );
add_theme_support( 'post-thumbnails' );

//Set up the Traction default options on theme change
function traction_initialize_options(){
	global $options;
	$a = get_option('traction_admin_options');
	$admin_options = array();
	foreach ($options as $value) {
		if(!isset($a[$value['id']])){
			if(isset($value['def']))
				$admin_options[$value['id']] = $value['def'];
			else
				$admin_options[$value['id']] = false;
		} elseif(!$a[$value['id']]){
			$admin_options[$value['id']] = false;
		} else {
			$admin_options[$value['id']] = $a[$value['id']];
		}
	}
	update_option('traction_admin_options', $admin_options);
}
add_action('after_switch_theme', 'traction_initialize_options');

/*
* TODO - add internationalization to app
function traction_theme_localization(){
    load_theme_textdomain('trwp', get_template_directory().'/inc/lang');
}
add_action('after_setup_theme', 'traction_theme_localization');
*/

//Load scripts for the media upload TractionInput function
function traction_admin_meta_scripts(){
	if(function_exists( 'wp_enqueue_media' )){
		wp_enqueue_media();
	} else {

		//For legacy versions of WP
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}
}

//Only need these scripts on the custom page; post and page edit screens have these by default
if (isset($_GET['page']) && $_GET['page'] == 'traction-admin-options.php') {
	add_action('admin_enqueue_scripts', 'traction_admin_meta_scripts');
}

//For the options pages and some of the TractionInput fields, JS and CSS magic is required
function custom_admin_swag(){
	global $a;
	wp_register_script('traction-meta', get_template_directory_uri().'/inc/traction-lib/traction-meta.js', array('jquery','media-upload','thickbox'));
	wp_register_script('jquery-validate', get_template_directory_uri().'/inc/traction-lib/libs/jquery.validate.js', array('jquery'));
	wp_enqueue_script('traction-meta');
	wp_register_style('traction-admin-style', get_template_directory_uri().'/inc/traction-lib/traction-admin-style.css');
	wp_register_style('traction-admin-icons', get_template_directory_uri().'/inc/fonts/CG/style.css');

	switch($a['share_icon_style']){
		case 'round':
			$socialStyle = 'Circle';
		break;
		case 'square' :
			$socialStyle = 'Square';
		break;
		default :
			$socialStyle = 'Regular';
	}
	wp_enqueue_style('traction-admin-style');
	wp_enqueue_style('social-style', get_template_directory_uri().'/inc/fonts/CGSocial'.$socialStyle.'/style.css');
	wp_enqueue_style('traction-admin-icons');
    wp_enqueue_script('jquery');
    wp_enqueue_script("jquery-ui-sortable");
    wp_enqueue_script("jquery-ui-datepicker");
}
add_action('admin_enqueue_scripts', 'custom_admin_swag');

//For front-end work on the theme, load in the normal helpers
function traction_scripts(){
	global $a;
	wp_enqueue_script('jquery');

	wp_enqueue_style('foundation', get_template_directory_uri().'/inc/foundation.min.css');

	/**
	* Plugins include
	* bxSlider (Slider)
	* jQuery Easing w/ compatibility (friend to many jQuery plugins)
	* SuperFish (dropdown nav helper)
	* hoverIntent (dependency of superfish and friend to many other jQuery plugins)
	* Modernizr (feature detection)
	*/
	if($a['use_traction_plugins']){
		wp_enqueue_script('traction-plugins', get_template_directory_uri().'/inc/plugins.min.js', array('jquery'), '', true);
		wp_enqueue_script('traction-lib', get_template_directory_uri().'/inc/traction-lib.min.js', array('jquery', 'traction-plugins'), '', true);
	}

	//Lightbox
	if($a['magnific_lb']){
		wp_enqueue_script('magnific', get_template_directory_uri().'/inc/traction-lib/libs/magnific/magnific.min.js', array('jquery'), '', true);
		wp_enqueue_script('magnific-custom', get_template_directory_uri().'/inc/traction-lib/libs/magnific/magnific-custom.js', array('jquery', 'magnific'), '', true);
		wp_enqueue_style('magnific-style', get_template_directory_uri().'/inc/traction-lib/libs/magnific/magnific-custom.css', array('theme-style'));
	}

	switch($a['share_icon_style']) :
		case 'round':
			$socialStyle = 'Circle';
		break;
		case 'square' :
			$socialStyle = 'Square';
		break;
		default :
			$socialStyle = 'Regular';
	endswitch;

	//General icons
	wp_enqueue_style('traction-icons', get_template_directory_uri().'/inc/fonts/CG/style.css');

	//Social set
	wp_enqueue_style('social-style', get_template_directory_uri().'/inc/fonts/CGSocial' . $socialStyle . '/style.css');

	//Theme stylesheet
	wp_enqueue_style('theme-style', get_template_directory_uri().'/style.css', array('foundation'));
}

add_action( 'wp_enqueue_scripts', 'traction_scripts', 0);

//Link to the options page on the WP bar
function traction_add_option_bar() {
	global $wp_admin_bar, $themename;
	$wp_admin_bar->add_menu( array(
		'parent' => false,
		'id' => 'traction_options',
		'title' => $themename.' '.__('Options', 'trwp'),
		'href' => admin_url( 'themes.php?page=traction-admin-options.php'),
		'meta' => false
	));
}
add_action( 'wp_before_admin_bar_render', 'traction_add_option_bar' );

function traction_admin_area_favicon() {
	global $a;
	echo '<link rel="icon" type="image/x-icon" href="'.$a['favicon'].'" />';
}
add_action('admin_head', 'traction_admin_area_favicon');

//Comment function callback
if(!function_exists('traction_comment')) :
function traction_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e('Pingback', 'trwp'); ?>: <?php comment_author_link(); ?> <?php edit_comment_link( '(Edit)', '<span class="edit-link">', '</span>' ); ?></p>
	<?php
		break;
		default :
		global $post;
	?>
	<li <?php comment_class('row clearfix'); ?> id="comment-<?php comment_ID(); ?>">
		<div class="large-2 small-4 columns comment-meta comment-author">
 			<?php echo get_avatar($comment, 60 ); ?>
			<a href="<?php the_permalink(); ?>#comment-<?php comment_ID(); ?>" title="<?php _e('Link to this comment', 'trwp'); ?>">
 				<?php echo get_comment_time('M. j, Y'); ?>
 			</a>
			<span class="edit"><?php edit_comment_link( __('Edit', 'trwp')); ?></span>
 		</div>
 		<div class="large-10 small-8 columns">
 			<h4><?php comment_author_link();
 				if($comment->user_id === $post->post_author)
					echo ' <span class="author">'.__('Author','trwp').'</span>';
 			?>
 			<span class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('Reply','trwp'), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
 			</span></h4>
 			<?php if ('0' == $comment->comment_approved)
			 	echo '<p class="comment-awaiting-moderation">'.__('Comment awaiting moderation', 'trwp').'</p>'; ?>
 			<div class="comment-content">
 				<?php comment_text(); ?>
 			</div>
 		</div>

<?php break; endswitch;
} endif; ?>