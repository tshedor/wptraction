<?php

add_editor_style();
add_post_type_support( 'page', 'excerpt' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-formats' );
add_theme_support( 'post-thumbnails' );

if ( ! isset( $content_width ) ) $content_width = 1000;

function ts_initialize_options(){
	global $options;
	$a = get_option('ts_admin_options');
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
	update_option('ts_admin_options', $admin_options);
}
add_action('after_switch_theme', 'ts_initialize_options');

function ts_theme_localization(){
    load_theme_textdomain('tswp', get_template_directory().'/inc/lang');
}
add_action('after_setup_theme', 'ts_theme_localization');


function admin_meta_scripts(){
	if(function_exists( 'wp_enqueue_media' )){
		wp_enqueue_media();
	} else {
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}
}
function custom_admin_swag(){
	wp_register_script('ts-meta', get_template_directory_uri().'/inc/ts-stds/ts-meta.js', array('jquery','media-upload','thickbox'));
	wp_register_script('jquery-validate', get_template_directory_uri().'/inc/ts-stds/libs/jquery.validate.js', array('jquery'));
	wp_register_script('parsely', get_template_directory_uri().'/inc/ts-stds/libs/parsley.min.js', array('jquery'));
	wp_enqueue_script('ts-meta');
	wp_enqueue_script('parsely');
	wp_register_style('ts-admin-style', get_template_directory_uri().'/inc/ts-stds/ts-admin-style.css');
	wp_register_style('ts-admin-icons', get_template_directory_uri().'/inc/fonts/CharlieGordon/style.css');
	wp_enqueue_style('ts-admin-style');
	wp_enqueue_style('ts-admin-icons');
    wp_enqueue_script('jquery');
    wp_enqueue_script("jquery-ui-sortable");
}
if (isset($_GET['page']) && $_GET['page'] == 'ts-admin-options.php') {
	add_action('admin_enqueue_scripts', 'admin_meta_scripts');
}
add_action('admin_enqueue_scripts', 'custom_admin_swag');

function ts_scripts(){
	global $a;
	wp_register_script('mediaelement', get_template_directory_uri().'/inc/ts-stds/libs/mediaelement/mediaelement-and-player.min.js', array('jquery'));
	wp_register_script('storyjs', get_template_directory_uri().'/inc/ts-stds/libs/timeline/js/storyjs-embed.js', array('jquery'));
	wp_register_script('custom-media', get_template_directory_uri().'/inc/ts-stds/libs/custom-media.min.js', array('jquery', 'mediaelement'));
	wp_enqueue_script('jquery');

	wp_register_style('mediaelement-css', get_template_directory_uri().'/inc/ts-stds/libs/mediaelement/mediaelementplayer.min.css');

	wp_enqueue_style('foundation', get_template_directory_uri().'/inc/foundation.min.css');
	wp_enqueue_style('theme-style', get_template_directory_uri().'/style.css', array('foundation'));

	if($a['use_ts_plugins']){
		wp_enqueue_script('ts-plugins', get_template_directory_uri().'/inc/plugins.min.js', array('jquery'), '', true);
		wp_enqueue_script('ts-lib', get_template_directory_uri().'/inc/ts-lib.min.js', array('jquery', 'ts-plugins'), '', true);
	}

	if($a['magnific_lb']){
		wp_enqueue_script('magnific', get_template_directory_uri().'/inc/ts-stds/libs/magnific/magnific.min.js', array('jquery'), '', true);
		wp_enqueue_script('magnific-custom', get_template_directory_uri().'/inc/ts-stds/libs/magnific/magnific-custom.min.js', array('jquery', 'magnific'), '', true);
		wp_enqueue_style('magnific-style', get_template_directory_uri().'/inc/ts-stds/libs/magnific/magnific-custom.css', array('theme-style'));
	}
}

add_action( 'wp_enqueue_scripts', 'ts_scripts', 0);

function ts_add_option_bar() {
	global $wp_admin_bar, $themename;
	$wp_admin_bar->add_menu( array(
		'parent' => false,
		'id' => 'ts_options',
		'title' => $themename.' '.__('Options', 'tswp'),
		'href' => admin_url( 'themes.php?page=ts-admin-options.php'),
		'meta' => false
	));
}
add_action( 'wp_before_admin_bar_render', 'ts_add_option_bar' );

//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

function custom_search_template(){
	return '<form method="get" class="search-form" action="'.get_bloginfo('url').'/">
		<input type="text" size="16" placeholder="'.__('Search', 'tswp').'" id="searchInput" onfocus="this.value=(this.value==\'Search\') ? \'\' : this.value;" onblur="this.value=(this.value==\'\') ? \''.__('Search', 'tswp').'\' : this.value;" name="s" id="s" />
		<input type="hidden" size="16" id="searchsubmit"  value="Search" />
		<button type="submit" value="'.__('Search', 'tswp').'"><i class="icon-search"></i></button>
	</form>';
}
add_filter('get_search_form', 'custom_search_template', 1, 0);

function add_print_query_vars($vars) {
	$new_vars = array('print');
	$vars = $new_vars + $vars;
	return $vars;
}
add_action("template_redirect", 'my_template_redirect_2322');

function my_template_redirect_2322() {
	global $wp;
	global $wp_query;
	if (isset($wp->query_vars["print"])) {
		include_once(get_template_directory().'/inc/templates/print-template.php');
		die();
	}
}
add_filter('query_vars', 'add_print_query_vars');

function ts_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php __e('Pingback', 'tswp') ?>: <?php comment_author_link(); ?> <?php edit_comment_link( __('(Edit)', 'tswp'), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
		break;
		default :
		global $post;
	?>
	<li <?php comment_class('row clearfix'); ?> id="comment-<?php comment_ID(); ?>">
			<div class="large-2 small-2 columns comment-meta comment-author">
				<?php echo get_avatar($comment, 60 ); ?>
				<a href="<?php the_permalink(); ?>#comment-<?php comment_ID(); ?>" title="<?php __e('Link to this comment', 'tswp'); ?>">
					<?php echo get_comment_time('M. j, Y'); ?>
				</a>
				<span class="edit"><?php edit_comment_link( __('Edit', 'tswp')); ?></span>
			</div>
			<div class="large-10 small-4 columns">
				<h4><?php comment_author_link();
					if($comment->user_id === $post->post_author)
						echo ' <span class="author">'.__('Author', 'tswp').'</span>';
				?>
				<span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('Reply', 'tswp'), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</span></h4>
				<?php if ('0' == $comment->comment_approved)
				 	echo '<p class="comment-awaiting-moderation">'.__('Comment awaiting moderation', 'tswp').'</p>'; ?>
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>
			</div>
<?php break; endswitch;
}