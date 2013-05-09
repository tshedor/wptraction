<?php
/************ CUSTOM SHORTCODES **********/

function html5video_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'src' => '',
		'type' => 'video/mp4',
		'videographer' => 'Me',
		'screenshot' => '',
		'width' => '490',
		'height' => '276',
		'title' => __('My Video', 'tswp'),
		'caption' => __('I made this video', 'tswp'),
		'align' => 'left'
	), $atts ) );
	$width = esc_attr($width);
	$height = esc_attr($height);
	if($width == 640){
		$width = 490;
		$height = 276;
	}
	wp_enqueue_script('mediaelement');
	wp_enqueue_script('custom-media');
	wp_enqueue_style('mediaelement-css');
	$video_statement = '';
	if(esc_attr($class) != 'simple'){
	$video_statement .= '<aside class="html5video align'.esc_attr($align).'">
	<h3 class="inline-title"><i class="icon-play"></i> '.esc_attr($title).' <span class="inline-credit multimedia">'.esc_attr($videographer).'</h3>';
	}
	if($type == 'flash') {
		$video_statement .= '
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />';
		wp_enqueue_script('swfobject');
		$video_statement .= '<object id="PlayFlash" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="300" height="120">
					<param name="movie" value="'.esc_attr($src).'/js/swfobject/test.swf" />
						<!--[if !IE]>--><object type="application/x-shockwave-flash" data="'.esc_attr($src).'" width="'.$width.'" height="'.$height.'"><!--<![endif]-->
						<div>
							<h1>Alternative content</h1>
							<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
						</div>
						<!--[if !IE]>--></object><!--<![endif]-->
					</object>';
	} else {
		$video_statement .= '
			<video width="'.$width.'" height="'.$height.'" poster="'.esc_attr($screenshot).'" controls="controls" preload="none">
				<source type="'.esc_attr($type).'" src="'.esc_attr($src).'" />
				<object width="'.$width.'" height="'.$height.'" type="application/x-shockwave-flash" data="'.get_template_directory_uri().'js/mediaelement/flashmediaelement.swf">
					<param name="movie" value="'.get_template_directory_uri().'/js/mediaelement/flashmediaelement.swf" />
					<param name="flashvars" value="controls=true&file='.esc_attr($src).'" />
					<img src="'.esc_attr($screenshot).'" width="'.$width.'" height="'.$height.'" title="No video playback capabilities" />
				</object>
			</video>';
	}
			$video_statement .= '<div class="inline-caption">'.esc_attr($caption).'</div>';
		 if(esc_attr($class) != 'simple'){ $video_statement .= '</aside>'; }
	return $video_statement;
}
add_shortcode( 'html5video', 'html5video_shortcode' );

function html5audio_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => __('Some Audio', 'tswp'),
		'description' => __('A Bit of Audio', 'tswp'),
		'src' => '',
		'extension' => 'mp3',
		'author' => __('Me', 'tswp'),
		'align' => 'left'
	), $atts ) );
	wp_enqueue_script('mediaelement');
	wp_enqueue_script('custom-media');
	wp_enqueue_style('mediaelement-css');
	return '
		<script src="'. get_template_directory_uri().'/inc/ts-stds/libs/mediaelement/mediaelement-and-player.min.js" type="text/javascript"></script>
		<script src="'. get_template_directory_uri().'/inc/ts-stds/libs/custom-media.min.js" type="text/javascript"></script>
		<link href="'. get_template_directory_uri().'/inc/ts-stds/libs/mediaelement/mediaelementplayer.min.css" rel="stylesheet" type="text/css" />
		<aside class="html5audio align'.esc_attr($align).'">
			<h3 class="inline-title"><i class="icon-sound"></i> '.esc_attr($title).'</h3>
			<div class="inline-caption">'.esc_attr($description).'</div>
			<audio controls="control" preload="none" src="'.esc_attr($src).'" type="audio/'.esc_attr($extension).'"></audio>
		</aside>';
}
add_shortcode( 'html5audio', 'html5audio_shortcode' );

function inline_text_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => __('More', 'tswp'),
		'align' => 'left',
		'text_content' => '',
	), $atts ) );
	if($text_content == '') {
		$text_content = $content;
	}
	return '
		<aside class="inline-text align'.esc_attr($align).'">
			<h3 class="inline-title"><i class="icon-pencil-2"></i> '.esc_attr($title).'</h3>'
			.$text_content.
		'</aside>';
}
add_shortcode( 'inline_text', 'inline_text_shortcode' );

function sibling_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'post' => '',
		'description' => '',
		'media' => '',
		'align' => 'left',
	), $atts ) );
	if($media == 'video')
		$media_title = '<i class="icon-play"></i> Video';
	elseif($media == 'audio')
		$media_title = '<i class="icon-sound"></i> Audio';
	elseif($media == 'gallery')
		$media_title = '<i class="icon-pictures"></i> Gallery';
	else
		$media_title = '';
	$p = get_post($post);
	if($description != '')
		$ct = $description;
	else
		$ct = $p->post_excerpt;
	return '
		<aside class="sibling align'.esc_attr($align).' bump'.esc_attr($align).'">
			<h3 class="inline-title">'.$media_title.'</h3>'.thumb_image('thumbnail','',NULL,$post).'<a href="'.get_permalink($post).'" title="'.$p->post_title.'"><h3 class="inline-title">'.$p->post_title.'</h3></a>'.$ct.'</aside>';
}
add_shortcode( 'sibling', 'sibling_shortcode' );

function timeline_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'url' => '',
		'description' => '',
		'title' => '',
	), $atts ) );
	if(substr($url,7,7) == 'storify'){
		$src = $url;
	} else {
		$src = substr($url, 44, 44);
		$src = 'https://docs.google.com/spreadsheet/pub?key='.$src.'&amp;output=html';
	}
	wp_enqueue_script('storyjs');
	return '
		<aside class="timeline">
			<h3 class="inline-title"><i class="icon-clock"></i> '.esc_attr($title).'</h3>
			<div id="timeline-embed"></div>'
			.$description.'
		</aside>

		<script type="text/javascript">
			var timeline_config = {
				width: "100%",
				height: "700",
				source: "'.$src.'"
			}
		</script>';
}
add_shortcode( 'timeline', 'timeline_shortcode' );

function tabbed_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => 'vertical',
	), $atts ) );
	$tabContainer = '<div class="tabContainer '.esc_attr($type).' clearfix" id="tab'.get_the_ID().time().'">
		<ul class="tabNavigator" id="tabNav'.get_the_ID().time().'"></ul>
		'.do_shortcode($content).'
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$("#'.get_the_ID().time().' .tab").each(function(){
				var tabID = $(this).attr("id");
				var tabName = $(this).attr("title");
				$("#tabNav'.get_the_ID().time().'").append(\'<li><a href="#\'+tabID+\'" title="\'+tabName+\'">\'+tabName+\'</a></li>\');
			});
		});
	</script>';
	return $tabContainer;
}
add_shortcode( 'tabbed', 'tabbed_shortcode' );

function tab_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'name' => '',
	), $atts ) );
	$clean_name = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '_', $name), '_'));
	$tab = '<div class="tab" id="'.$clean_name.'" title="'.str_replace('"', "'", $name).'">'.$content.'</div>';
	return $tab;
}
add_shortcode( 'tab', 'tab_shortcode' );

function contact_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'email' =>	'',
		'label'	=>	__('Get in touch', 'tswp'),
	), $atts ) );
	$a = get_option('ts_admin_options');
	$contactme = '';
	if(isnt_blank($email)){
		if(isnt_blank($a['contact_form_email']))
			$email = $a['contact_form_email'];
		else
			$email = get_option('admin_email');
	}
	if(isset($_POST['ts_contact_shortcode'])){
		wp_mail($email, __('Contact Form from ', 'tswp').$_POST['ts_name'], esc_attr(strip_tags($_POST['ts_message'])));
		$contactme .= '<div class="notice success">Thank you for your message</div>';
	}
	$contactme .= '<h3>'.$label.'</h3>';
	$contactme .= '<form method="post" class="ts-contact">
		<input type="text" placeholder="'.__('Name', 'tswp').'" name="ts_name"/>
		<input type="text" placeholder="'.__('Email', 'tswp').'" name="ts_email"/>
		<textarea placeholder="'.__('Your message', 'tswp').'" name="ts_message"></textarea>
		<input type="hidden" name="ts_contact_shortcode"/>
		<input type="submit" class="button" value="'.__('Contact', 'tswp').'" />
	</form>';
	return $contactme;
}
add_shortcode( 'contact', 'contact_shortcode' );
function loop_sitemap_args($arg, $array){
	if($arg == 'true')
		array_push($array, $arg);
}
function sitemap_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'pages' =>	'true',
		'categories'	=>	'true',
		'tags'	=>	'true',
	), $atts ) );
	$smarr = array();
	$sitemap = '';
	if($pages == 'true')
		array_push($smarr, 'pages');
	if($categories == 'true')
		array_push($smarr, 'categories');
	if($tags == 'true')
		array_push($smarr, 'tags');
	if(count($smarr) == 3)
		$divclass = '4';
	elseif(count($smarr) == 2)
		$divclass = '6';
	else
		$divclass = '12';
	if($pages == 'true'){
		$page = get_pages();
		$sitemap .= '<ul class="ts-sitemap large-'.$divclass.' columns"><li>'.__('Pages', 'tswp').'</li>';
		foreach($page as $p){
			$sitemap .= '<li><a href="'.get_page_link($p->ID).'" title="'.$p->post_title.'">'.$p->post_title.'</a></li>';
		}
		$sitemap .= '</ul>';
	}
	if($categories == 'true'){
		$cat = get_categories();
		$sitemap .= '<ul class="ts-sitemap large-'.$divclass.' columns"><li>'.__('Categories', 'tswp').'</li>';
		foreach($cat as $c){
			$sitemap .= '<li><a href="'.get_category_link($c->term_id).'" title="'.$c->name.'">'.$c->name.'</a></li>';
		}
		$sitemap .= '</ul>';
	}
	if($tags == 'true'){
		$tag = get_tags();
		$sitemap .= '<ul class="ts-sitemap large-'.$divclass.' columns"><li>'.__('Tags', 'tswp').'</li>';
		foreach($tag as $t){
			$sitemap .= '<li><a href="'.get_tag_link($t->term_id).'" title="'.$t->name.'">'.$t->name.'</a></li>';
		}
		$sitemap .= '</ul>';
	}
	return '<div class="row clear">'.$sitemap.'</div>';
}
add_shortcode( 'sitemap', 'sitemap_shortcode' );

function example_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'just_code' => 'false',
		'lang' => 'markup',
	), $atts ) );
	$code = strip_tags($content, '<!doctype><a><img><div><body><html><head><script><style><h1><h2><h3><h4><h5><h6><hr><video><audio><ul><ol><li><table><tbody><tr><td><th><link><strong><em><code><pre><span><embed><b><i><dd><dt><dl><blockquote><header><footer><article><aside><form><input><textarea><button><section><address><cite><embed><object>');
	$code = str_replace('<p>', '', $code);
	$code = str_replace('</p>', '', $code);
	$code = str_replace('<', '&lt;', $code);
	$code = '<pre><code class="language-'.$lang.'">'.$code.'</code></pre>';
	$code_and_example = '<div class="large-6 columns code-block">'.$content.'</div><div class="large-6 columns">'.$code.'</div>';
	if($just_code == 'true'){
		return '<div class="row clearfix md-margin full-code-row"><div class="span12 full-code">'.$code.'</div></div>';
	} else {
		return '<div class="row example-row clearfix md-margin">'.$code_and_example.'</div>';
	}
}
add_shortcode( 'example', 'example_shortcode' );

function notice_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'bonus' => false,
		'tip' => false,
	), $atts ) );
	if($bonus){
		$wsc = '<span class="label label-success">'.__('Bonus', 'tswp').'</span>';
	} elseif ($tip) {
		$wsc = '<span class="label label-info">'.esc_attr($tip).'</span>';
	} else {
		$wsc = '<span class="label label-important">'.__('Heads up', 'tswp').'</span>';
	}
	return '<p>'.$wsc.' '.$content.'</p>';
}
add_shortcode( 'notice', 'notice_shortcode' );