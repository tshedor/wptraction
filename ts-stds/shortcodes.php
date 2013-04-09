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
		'title' => 'My Video',
		'caption' => 'I made this video',
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
		'title' => 'Some Audio',
		'description' => 'A Bit of Audio',
		'src' => '',
		'extension' => 'mp3',
		'author' => 'Me',
		'align' => 'left'
	), $atts ) );
	wp_enqueue_script('mediaelement');
	wp_enqueue_script('custom-media');
	wp_enqueue_style('mediaelement-css');
	return '
		<script src="'. get_template_directory_uri().'/lib/ts-stds/libs/mediaelement/mediaelement-and-player.min.js" type="text/javascript"></script>
		<script src="'. get_template_directory_uri().'/lib/ts-stds/libs/custom-media.min.js" type="text/javascript"></script>
		<link href="'. get_template_directory_uri().'/lib/ts-stds/libs/mediaelement/mediaelementplayer.min.css" rel="stylesheet" type="text/css" />
		<aside class="html5audio align'.esc_attr($align).'">
			<h3 class="inline-title"><i class="icon-sound"></i> '.esc_attr($title).'</h3>
			<div class="inline-caption">'.esc_attr($description).'</div>
			<audio controls="control" preload="none" src="'.esc_attr($src).'" type="audio/'.esc_attr($extension).'"></audio>
		</aside>';
}
add_shortcode( 'html5audio', 'html5audio_shortcode' );

function inline_text_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'More',
		'align' => 'left',
		'text_content' => '',
	), $atts ) );
	if($text_content == '') {
		$text_content = $content;
	}
	return '
		<aside class="inline-text align'.esc_attr($align).'">
			<h3 class="inline-title"><i class="icon-write"></i> '.esc_attr($title).'</h3>'
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
	if($media == 'video'){
		$media_title = '<i class="icon-play"></i> Video';
	} elseif($media == 'audio'){
		$media_title = '<i class="icon-sound"></i> Audio';
	}  elseif($media == 'gallery'){
		$media_title = '<i class="icon-pictures"></i> Gallery';
	} else {
		$media_title = '';
	}
	$p = get_post($post);
	if($description != ''){
		$ct = $description;
	} else {
		$ct = $p->post_excerpt;
	}
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
			<h3 class="inline-title"><i class="icon-clock"></i>'.esc_attr($title).'</h3>
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
		'name' => '',
		'type' => 'vertical',
	), $atts ) );
	$tabContainer = '<div class="tabContainer '.esc_attr($type).' clearfix">
		<ul class="tabNavigator" id="'.get_the_ID().'"></ul>
		'.do_shortcode($content).'
	</div>
	<script type="text/javascript">
		$(function(){
			$(".tabContainer .tab").each(function(){
				var tabID = $(this).attr("id");
				var tabName = $(this).attr("title");
				$("#'.get_the_ID().'").append(\'<li><a href="#\'+tabID+\'" title="\'+tabName+\'">\'+tabName+\'</a></li>\');
			});
			$(".tabContainer .tab").hide();
			$(".tabContainer .tab:first").show();
			$(".tabContainer ul li:first").addClass("active");
			$(".tabContainer ul li").click(function(){
				$(".tabContainer ul li").removeClass("active");
				$(this).addClass("active");
				$(".tab").hide();
				var activeTab = $(this).find("a").attr("href");
				$(activeTab).fadeIn();
				return false;
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