<?php
function add_tiny_buttons() {
   // Don't bother doing this stuff if the current user lacks permissions
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;

   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "add_tiny_plugin");
     add_filter('mce_buttons', 'register_tiny_buttons');
   }
}

function register_tiny_buttons($buttons) {
  array_push($buttons, "|", "audio");
   array_push($buttons, "", "video");
   array_push($buttons, "", "text");
   array_push($buttons, "", "timeline");
   array_push($buttons, "", "tabs");
   //array_push($buttons, "", "sibling");
   return $buttons;
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_tiny_plugin($plugin_array) {
   $plugin_array['audio'] = get_template_directory_uri().'/inc/ts-stds/tinymce/editor_plugin.js';
   $plugin_array['video'] = get_template_directory_uri().'/inc/ts-stds/tinymce/editor_plugin.js';
   $plugin_array['text'] = get_template_directory_uri().'/inc/ts-stds/tinymce/editor_plugin.js';
   $plugin_array['timeline'] = get_template_directory_uri().'/inc/ts-stds/tinymce/editor_plugin.js';
   $plugin_array['tabs'] = get_template_directory_uri().'/inc/ts-stds/tinymce/editor_plugin.js';
   //$plugin_array['sibling'] = get_template_directory_uri().'/inc/ts-stds/tinymce/editor_plugin.js';
   return $plugin_array;
}

function my_refresh_mce($ver) {
  $ver += 3;
  return $ver;
}

// init process for button control
add_filter( 'tiny_mce_version', 'my_refresh_mce');
add_action('init', 'add_tiny_buttons');
function themeit_mce_buttons_2( $buttons ) {
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
add_filter( 'mce_buttons_2', 'themeit_mce_buttons_2' );
function themeit_tiny_mce_before_init( $settings ) {
  $settings['theme_advanced_blockformats'] = 'p,a,div,span,h1,h2,h3,tr,';
  $style_formats = array(
      array( 'title' => __('Headers', 'tswp') ),
      array( 'title' => __('Subhead', 'tswp'),      'block'    => 'h2',  'classes' => '' ),
      array( 'title' => __('Minor Subhead', 'tswp'),      'block'    => 'h3',  'classes' => '' ),
      array( 'title' => __('Styles', 'tswp') ),
      array( 'title' => __('Button', 'tswp'),         'inline' => 'span',  'classes' => 'button' ),
      array( 'title' => __('Aside Box', 'tswp'),        'block'    => 'aside',  'classes' => 'inline-text' ),
      array( 'title' => __('Columns', 'tswp') ),
      array( 'title' => __('New Row', 'tswp'),            'block'    => 'div',  'classes' => 'row clearfix' ),
      array( 'title' => '&frac12; '.__('Col.', 'tswp'),      'block'    => 'div',  'classes' => 'small-6 large-6 columns' ),
      array( 'title' => '&frac13; '.__('Col.', 'tswp'),      'block'    => 'div',  'classes' => 'large-4 columns' ),
      array( 'title' => '&frac14; '.__('Col.', 'tswp'),      'block'    => 'div',  'classes' => 'large-3 columns' ),
      array( 'title' => '&frac16; '.__('Col.', 'tswp'),      'block'    => 'div',  'classes' => 'large-2 columns' ),
  );
  $settings['style_formats'] = json_encode( $style_formats );
  return $settings;
}
add_filter( 'tiny_mce_before_init', 'themeit_tiny_mce_before_init' );

?>
