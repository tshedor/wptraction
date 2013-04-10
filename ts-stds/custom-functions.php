<?php
function getPostViews($postID){
	$count = get_post_meta($postID, 'post_views_count', true);
	return $count.' Views';
}
function setPostViews($postID) {
	$count = get_post_meta($postID, 'post_views_count', true);
	$count++;
	update_post_meta($postID, 'post_views_count', $count);
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function ifExists($var){
	return ($var || $var != '');
}

function if_paged(){
	if(isset($_GET['paged']) && !empty($_GET['paged'])) {
		echo ' ('.$_GET['paged'].')';
	}
}
function isnt_blank($var){
	if($var){
		if($var != ''){
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

//http://codex.wordpress.org/Function_Reference/the_post_thumbnail
function my_post_image_html( $html, $post_id, $post_image_id ) {
  $html = '<a href="'.get_permalink( $post_id ).'" title="'.esc_attr(get_post_field('post_title', $post_id)).'">'.$html.'</a>';
  return $html;
}
add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );

//http://themeforest.net/forums/thread/get-attachment-id-by-image-url/36381
function get_image_id($image_url) {
    global $wpdb;
    $prefix = $wpdb->prefix;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='" . $image_url . "';"));
    return $attachment[0];
}
function get_image($size = 'medium',$class = '',$attr = NULL, $id = NULL){
	global $post, $a;
	if($id == NULL){
		$id = $post->ID;
	}
	if(function_exists('get_the_image')){
		get_the_image(array('image_scan' => true, 'post_id' => $id, 'size' => $size, 'image_class' => $class, $attr));
	} elseif(has_post_thumbnail($id)) {
		the_post_thumbnail($size, array('class' => $class, $attr));
	} elseif($a['get_first_image']) {
		//http://wpforce.com/automatically-set-the-featured-image-in-wordpress/
		$attached_image = get_children( "post_parent=".$post->ID."&post_type=attachment&post_mime_type=image&numberposts=1" );
		if($attached_image){
			foreach ($attached_image as $attachment_id => $attachment) {
				set_post_thumbnail($id, $attachment_id);
			}
			the_post_thumbnail($size, array('class' => $class, $attr));
		} else {
			$first_img = ''; ob_start(); ob_end_clean();
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
			$first_img = $matches [1] [0];
			if(empty($first_img)){
				return;
			}
			$html = '<a href="'.get_permalink($id).'" title="'.esc_attr(get_post_field('post_title', $id)).'">';
			$html .= wp_get_attachment_image(get_image_id($first_img), $size, array('class' => $class, $attr));
			$html .= '</a>';
			echo $html;
		}
	} else {
		return;
	}
}
class socialshare {
	private $url;
	private $title;
	private $content;
	private $account;
	public function __construct($url,$title,$content,$account) {
		$this->url = $url;
		$this->title = $title;
		$this->content = $content;
		$this->account = $account;
	}
	public function twitter() {
		return '<a href="https://twitter.com/intent/tweet?text='.$this->title.'&url='.$this->url.'&related='.$this->account.'&via='.$this->account.'" title="'.$this->title.'">'.$this->content.'</a>';
	}
	public function facebook() {
		return '<a href="https://www.facebook.com/sharer/sharer.php?u='.$this->url.'&t='.$this->title.'" title="'.$this->title.'">'.$this->content.'</a>';
	}
	public function fblike() {
		return '<iframe src="http://www.facebook.com/plugins/like.php?href='.$this->url.'&layout=button_count&show_faces=false&width=90&action=like&colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:90px; height:20px;"></iframe>';
	}
	public function pinterest() {
		return '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script><a data-pin-config="none" href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" >'.$this->content.'</a>';
	}
	public function googleplus() {
		return '<a href="https://plus.google.com/share?url='.$this->url.'" title="'.$this->title.'">'.$this->content.'</a>';
	}
	public function stumbleupon() {
		return '<a href="http://stumbleupon.com/submit?url='.$this->url.'&title='.$this->title.'" title="'.$this->title.'">'.$this->content.'</a>';
	}
	public function reddit() {
		return '<a href="http://reddit.com/submit?url='.$this->url.'&title='.$this->title.'" title="'.$this->title.'">'.$this->content.'</a>';
	}
	public function linkedin() {
		return '<a href="http://www.linkedin.com/cws/share?url='.$this->url.'&isFramed=false&ts='.time().'" title="'.$this->title.'">'.$this->content.'</a>';
	}
}
function social_single($showNames = true){
	global $post, $a;
	if($a['show_social']){
		$share_array = array('facebook','twitter','pinterest','googleplus','stumbleupon','reddit','linkedin','fblike');
		foreach($share_array as $s){
			if($a['share_icon_style'] == 'round')
				$s = $s.'-2';
			if($a['share_icon_style'] == 'square')
				$s = $s.'-3';
			$content = '<i class="icon-'.$s.'"></i> ';
			if($showNames)
				$content .= $s;
			if($a[$s]){
				$shareinfo = new socialshare(get_permalink(),get_the_title(),$content,$a['twitter_profile']);
				$shareme = $shareinfo->$s();
				echo '<li class="social-list-item">'.$shareme.'</li>';
			}
		}
	}
	if($a['show_print']){
		echo '<li class="social-list-item"><a href="'.get_permalink().'?print='.get_the_ID().'" title="Print '.get_the_title().'"><i class="icon-print"></i>',$showNames ? ' print' : '','</a></li>';
	}
}
function social_header(){
	global $a;
	$social = array('twitter', 'facebook', 'pinterest', 'instagram', 'flickr', 'googleplus', 'github', 'linkedin', 'feed', 'mail');
	foreach($social as $sicon) :
		$op = $a[$sicon.'_profile'];
		if(isset($op) && $op != ''){
			if($sicon == 'twitter')
				$op = 'http://twitter.com/'.$op;
			if($a['share_icon_style'] == 'round')
				$sicon = $sicon.'-2';
			if($a['share_icon_style'] == 'square')
				$sicon = $sicon.'-3';
			if($sicon == 'feed')
				$op = get_bloginfo('rss2_url');
			if($sicon == 'mail')
				$op = 'mailto:'.get_bloginfo('admin_email');
			echo '<a href="'.$op.'" title="'.ucfirst($sicon).'"><i class="icon-'.$sicon.'"></i></a>';
		}
	endforeach;
}
function get_logo(){
	global $a;
	echo '<a href="'.get_bloginfo('url').'" title="'.get_bloginfo('name').'">';
		if($a['logo'] == '')
			echo '<h1>'.get_bloginfo('name').'</h1>';
		else
			echo '<img src="'.$a['logo'].'" alt="'.get_bloginfo('name').'" />';
	echo '</a>';
}
function ts_related($post_count = 5){
	if(function_exists('related_posts'))
		related_posts();
	else {
		if(function_exists('yarpp_related'))
			yarpp_related();
		else {
			global $post;
			$tags = wp_get_post_tags($post->ID);
			if ($tags){
				$first_tag = $tags[0]->term_id;
				$args = array(
					'tag__in' => array($first_tag),
					'post__not_in' => array($post->ID),
					'showposts'=> $post_count,
				);
				$q82 = new WP_Query($args);
				if( $q82->have_posts() ) :
					echo '<ul class="ts-related">';
					while ($q82->have_posts()) : $q82->the_post();
						echo '<li>';
						get_image('thumbnail');
						echo '<a href="'.get_permalink().' title="'.get_the_title().'">'.get_the_title().'</a>';
						echo '</li>';
					endwhile;
					echo '</ul>';
				endif; wp_reset_query();
			} else
				echo 'No related posts';
		}
	}
}
function ts_pagination(){
	if(function_exists('wp_pagenavi'))
		wp_pagenavi();
	else {
		global $wp_query; $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
		echo paginate_links(array(
			'base'      => @add_query_arg( 'paged', '%#%' ),
			'format'	=>	'',
			'total' 	=>	$wp_query->max_num_pages,
			'prev_text'	=>	'&laquo;&nbsp;Previous&nbsp;',
			'next_text'	=>	'&nbsp;Next&nbsp;&raquo;',
			'end_size'	=>	3,
			'current'	=>	$current
		));
	}
}
function ts_breadcrumbs(){
	global $wp_query, $a;
	if(function_exists('bcn_display'))
		bcn_display();
	elseif($a['breadcrumbs_archive']) {
		if(!is_home()){
			echo '<a href="'.get_bloginfo('url').'" title="'.get_bloginfo('name').'">Home</a>';
			if(is_archive()){
				global $wp_query;
				echo '&nbsp;&raquo;&nbsp;';
				if(is_category()){
					echo get_category_parents(get_query_var('cat'), TRUE, ' &raquo; ');
					echo single_cat_title();
				} elseif(is_tag()) {
					echo 'Tagged ';
					echo single_tag_title();
				} elseif(is_tax()) {
					$tax =  get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					echo get_query_var('taxonomy').': '.$tax->name;
				} elseif(is_day() || is_month() || is_year()) {
					echo 'From '.the_time('F j, Y');
				} elseif(is_author()) {
					echo 'By '.the_author_meta('display_name', get_query_var('author'));
				}
				if_paged();
			}
			if(is_single()){
				global $post;
				echo '&nbsp;&raquo;&nbsp;';
				$post_cats = get_the_category($post->ID);
				if($post_cats[0]){
					echo get_category_parents($post_cats[0]->term_id, TRUE, '&nbsp;&raquo;&nbsp;');
					echo '<a href="'.get_category_link($post_cats[0]->term_id ).'">'.$post_cats[0]->cat_name.'</a> &raquo; ';
				}
				the_title();
			}
			if(is_page()){
				global $post;
				echo '&nbsp;&raquo;&nbsp;';
				$parents = get_post_ancestors($post->ID);
				$top_parent = $parents[count($parents)-1];
				if($post->post_parent){
					$parent = get_page($post->post_parent);
					if($parent->post_parent){
						$higher_parent = get_page($parent->post_parent);
						if($higher_parent->post_parent){
							$highest_parent = get_page($higher_parent->post_parent);
							if($highest_parent->post_parent){
								$ultra_parent = get_page($highest_parent->post_parent);
								if($ultra_parent->post_parent){
									$ultimate_parent = get_page($ultra_parent->post_parent);
									echo '<a href="'.get_permalink($ultimate_parent->ID).'" title="'.$ultimage_parent->post_title.'">'.$ultimate_parent->post_title.'</a>&nbsp;&raquo;&nbsp;';
								}
								echo '<a href="'.get_permalink($ultra_parent->ID).'" title="'.$ultra_parent->post_title.'">'.$ultra_parent->post_title.'</a>&nbsp;&raquo;&nbsp;';
							}
							echo '<a href="'.get_permalink($highest_parent->ID).'" title="'.$highest_parent->post_title.'">'.$highest_parent->post_title.'</a>&nbsp;&raquo;&nbsp;';
						}
						echo '<a href="'.get_permalink($higher_parent->ID).'" title="'.$higher_parent->post_title.'">'.$higher_parent->post_title.'</a>&nbsp;&raquo;&nbsp;';
					}
					echo '<a href="'.get_permalink($parent->ID).'" title="'.$parent->post_title.'">'.$parent->post_title.'</a>&nbsp;&raquo;&nbsp;';

				}
				the_title();
			}
		}
	}
}
class adminfield
{
	private $meta;
	private $value;
	private $initial;
	private $finish;
	public function __construct($meta,$value) {
		$this->meta = $meta;
		$this->value = $value;
		$this->initial = '<div class="option '.$this->value['type'].' ';
		if(isset($this->value['class']))
			$this->initial .= $this->value['class'];
		$this->initial .= '">
			<div class="label">'.$this->value['name'].'<span class="desc">'.$this->value['desc'].'</span></div>
			<div class="cell">';
		$this->finish = '</div></div>';
	}
	public function text() {
		$html = $this->initial;
		$html .= '<input name="'.$this->value['id'].'" type="text" value="';
		if ($this->meta != "")
			$html .= stripslashes($this->meta);
		$html .= '" placeholder="'.stripslashes($this->value['std']).'" ';
		if(isset($this->value['required']))
			$html .= 'required';
		$html .= ' />';
		$html .= $this->finish;
		return $html;
	}
	public function number() {
		$html = $this->initial;
		$html .= '<input name="'.$this->value['id'].'" type="number" value="';
		if ($this->meta != "")
			$html .= $this->meta;
		$html .= '" placeholder="'.$this->value['std'].'" ';
		if(isset($this->value['required']))
			$html .= 'required';
		$html .= ' />';
		$html .= $this->finish;
		return $html;
	}
	public function date() {
		$html = $this->initial;
		$html .= '<input name="'.$this->value['id'].'" type="date" value="';
		if ($this->meta != "")
			$html .= $this->meta;
		$html .= '" placeholder="'.$this->value['std'].'" ';
		if(isset($this->value['required']))
			$html .= 'required';
		$html .= ' />';
		$html .= $this->finish;
		return $html;
	}
	public function week() {
		$html = $this->initial;
		$html .= '<input name="'.$this->value['id'].'" type="week" value="';
		if ($this->meta != "")
			$html .= $this->meta;
		$html .= '" placeholder="'.$this->value['std'].'" ';
		if(isset($this->value['required']))
			$html .= 'required';
		$html .= ' />';
		$html .= $this->finish;
		return $html;
	}
	public function month() {
		$html = $this->initial;
		$html .= '<input name="'.$this->value['id'].'" type="month" value="';
		if ($this->meta != "")
			$html .= $this->meta;
		$html .= '" placeholder="'.$this->value['std'].'" ';
		if(isset($this->value['required']))
			$html .= 'required';
		$html .= ' />';
		$html .= $this->finish;
		return $html;
	}
	public function datetime() {
		$html = $this->initial;
		$html .= '<input name="'.$this->value['id'].'" type="datetime" value="';
		if ($this->meta != "")
			$html .= $this->meta;
		$html .= '" placeholder="'.$this->value['std'].'" ';
		if(isset($this->value['required']))
			$html .= 'required';
		$html .= ' />';
		$html .= $this->finish;
		return $html;
	}
	public function url() {
		$html = $this->initial;
		$html .= '<input name="'.$this->value['id'].'" type="url" value="';
		if ($this->meta != "")
			$html .= $this->meta;
		$html .= '" placeholder="'.$this->value['std'].'" ';
		if(isset($this->value['required']))
			$html .= 'required';
		$html .= ' />';
		$html .= $this->finish;
		return $html;
	}
	public function tel() {
		$html = $this->initial;
		$html .= '<input name="'.$this->value['id'].'" type="tel" value="';
		if ($this->meta != "")
			$html .= $this->meta;
		$html .= '" placeholder="'.$this->value['std'].'" ';
		if(isset($this->value['required']))
			$html .= 'required';
		$html .= ' />';
		$html .= $this->finish;
		return $html;
	}
	public function range() {
		$html = $this->initial;
		$html .= '<input name="'.$this->value['id'].'" type="range" min="'.$this->value['min'].'" max="'.$this->value['max'].'" value="';
		if ($this->meta != "")
			$html .= $this->meta;
		$html .= '" placeholder="'.$this->value['std'].'" ';
		if(isset($this->value['required']))
			$html .= 'required';
		$html .= ' />';
		$html .= $this->finish;
		return $html;
	}
	public function color() {
		$html = $this->initial;
		$html .= '<input name="'.$this->value['id'].'" type="count" value="';
		if ($this->meta != "")
			$html .= $this->meta;
		else
			$html .= $this->value['std'];
		$html .= '"';
		if(isset($this->value['required']))
			$html .= ' required';
		$html .= ' />';
		$html .= $this->finish;
		return $html;
	}
	public function textarea(){
		$html = $this->initial;
		$html .= '<textarea name="'.$this->value['id'].'" type="'.$this->value['type'].'" cols="18" rows="5"';
		if(isset($this->value['required']))
			$html .= ' required ';
		if ($this->meta == "")
			$html .= 'placeholder="'.stripslashes($this->value['std']).'"';
		$html .= '>';
		if ($this->meta != "")
			$html .= stripslashes($this->meta);
		$html .= '</textarea>';
		$html .= $this->finish;
		return $html;
	}
	public function textareacode(){
		$html = $this->initial;
		$html .= '<textarea name="'.$this->value['id'].'" type="'.$this->value['type'].'" cols="18" rows="5"';
		if(isset($this->value['required']))
			$html .= ' required';
		$html .= '>';
			if ($this->meta != "")
				$html .= stripslashes($this->meta );
			else
				$html .= stripslashes($this->value['std']);
			$html .= '</textarea>';
			$html .= $this->finish;
		return $html;
	}
	public function tinymce(){
		$html = $this->initial;
			if ($this->meta != "")
				$val = stripslashes($this->meta);
			else
				$val = stripslashes($this->value['std']);
		wp_editor( $val, $this->value['id'], array( 'textarea_name' => $this->value['id'], 'media_buttons' => true, 'textarea_rows' => 12, 'tinymce' => array( 'theme_advanced_buttons1' => 'formatselect,forecolor,|,bold,italic,underline,|,bullist,numlist,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,spellchecker,wp_adv' ) ) );
		$html .= $this->finish;
		return $html;
	}
	public function pages(){
		$html = $this->initial;
		$html .= '<select name="'.$this->value['id'].'"';
		if(isset($this->value['required']))
			$html .= ' required ';
		$html .= '>
			<option value="">Select One</option>';
			$rp = get_pages();
			foreach ($rp as $page) {
				$html .= '<option value="'.$page->ID.'"';
					if($this->meta == $page->ID)
						$html .= 'selected="selected"';
				$html .= '>'.$page->post_title.'</option>';
			}
		$html .= '</select>';
		$html .= $this->finish;
		return $html;
	}
	public function posts(){
		$html = $this->initial;
		$html .= '<select name="'.$this->value['id'].'"';
		if(isset($this->value['required']))
			$html .= ' required ';
		$html .= '>
			<option value="">Select One</option>';
			$rps = wp_get_recent_posts();
			foreach ($rps as $recent) {
				$html .= '<option value="'.$recent["ID"].'"';
					if($this->meta == $recent["ID"])
						$html .= 'selected="selected"';
					$html .= '>'.$recent["post_title"].'
				</option>';
			}
		$html .= '</select>';
		$html .= $this->finish;
		return $html;
	}
	public function categories(){
		$html = $this->initial;
		$html .= '<select name="'.$this->value['id'].'"';
		if(isset($this->value['required']))
			$html .= ' required ';
		$html .= '>
			<option value="">Select One</option>';
			$cats = get_categories();
			foreach ($cats as $cat) {
				$html .= '<option value="'.$cat->cat_ID.'"';
				if($this->meta == $cat->cat_ID)
					$html .= 'selected="selected"';
				$html .= '>'.$cat->cat_name.'</option>';
			}
		$html .= '</select>';
		$html .= $this->finish;
		return $html;
	}
	public function checkbox(){
		if(isset($this->value['class']))
			$class = $this->value['class'];
		else
			$class = '';
		$html = '<div class="option checkbox '.$class.'">
		<div class="cell">
			<label class="label">
				<input type="checkbox" name="'.$this->value['id'].'"';
			if($this->meta)
				$html .= ' checked ';
			$html .= ' />'.$this->value['name'].'<span class="desc">'.$this->value['desc'].'</span>
			</label>
		</div>
		</div>';
		return $html;
	}
	public function socialcheckbox(){
		if(isset($this->value['class']))
			$class = $this->value['class'];
		else
			$class = '';
		$html = '<div class="option checkbox socialbox '.$class.'">
			<div class="cell">
				<label class="label">
					<input type="checkbox" name="'.$this->value['id'].'"';
					if($this->meta)
						$html .= ' checked ';
					$html .= ' />
					<i class="icon-'.$this->value['desc'].'" style="font-size:22px"></i> '.$this->value['name'].'
				</label>
			</div>
		</div>';
		return $html;
	}
	public function radio(){
		$html = $this->initial;
		foreach ($this->value['options'] as $opt) {
			$html .= '<label>';
			$html .= '<input name="'.$this->value['id'].'" type="radio" value="'.$opt['value'].'"';
			if(!$this->meta && $opt['value'] == $this->value['std'])
				$html .= 'checked="checked"';
			if($this->meta == $opt['value'])
				$html .= 'checked="checked"';
			$html .= '/>&nbsp;&nbsp;'.$opt['label'].'</label>&nbsp;&nbsp;';
		}
		$html .= $this->finish;
		return $html;
	}
	public function media(){
		$html = $this->initial;
		$html .= '<input type="button" class="custom_media_upload button button-large" value="Add Media" />
			<img class="custom_media_image" src="';
			if($this->meta)
				$html .= $this->meta;
			$html .= '" />
		<input class="custom_media_url" type="text" name="'.$this->value['id'].'" value="';
		if($this->meta)
			$html .= $this->meta;
		$html .='" placeholder="'.$this->value['std'].'"';
		if(isset($this->value['required']))
			$html .= ' required ';
		$html .= ' />';
		$html .= $this->finish;
		return $html;
	}
	public function map(){
		$html = '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places,geometry"></script>';
		$html .= $this->initial;
		$html .= '<script type="text/javascript">jQuery(document).ready(function(){';
		if($this->meta)
			$html .= 'mapsload('.$this->meta.',"#'.$this->value['id'].'");';
		else
			$html .= 'mapsload();';
		$html .= '});</script><input type="hidden" name="'.$this->value['id'].'" id="'.$this->value['id'].'" value="'.$this->meta.'" />
			<div id="residence_map" style="width:500px; height:200px;"></div>';
		$html .= $this->finish;
		return $html;
	}
	public function icons(){
		$icons = array('quote','cabinet','microphone','checkmark','cancel','location','megaphone','comments','paper-plane','thumbs-up','thumbs-down','user','users','instagram','help','plus','minus','cancel','folder-open','map','spinner','search','reorder','youtube','wordpress','download','tag','tags','pencil','film','pictures','picture','phone','mobile','star','star-2','star-3','export','random','print','repeat','warning','clock','code','home','paperclip','link','earth','calendar','heart-empty','heart','cog','mail','user-add','sound','pencil-2','asterisk','info','megaphoneright','users-2','file','circleinfo','vote','vote-2','lamp','shield','tie','intersection','desklamp','captainamerica','walle','monstersinc','wheelchair','braces','volumefull','volumehalf','volumemute2','bluetooth','record','pocket','podcast','paw','bubbles');
		$html = $this->initial;
		$html .= '<div class="list-icon-wrapper">';
		$html .= '<div class="preview-icons">';
		if($this->meta)
			$html .= '<i class="icon-'.$this->meta.'"></i> '.ucfirst(str_replace('-', ' ', $this->meta));
		else
			$html .= 'Select One';
		$html .= ' <i class="icon-angle-down"></i></div>';
		$html .= '<ul class="list-icons" data-name="'.$this->meta.'"';
		if(isset($this->value['required']))
			$html .= ' required ';
		$html .= '>';
			foreach ($icons as $icon) {
				$html .= '<li data-value="'.$icon.'"';
				if($this->meta == $icon)
					$html .= ' data-selected="selected"';
				$html .= '><i class="icon-'.$icon.'"></i> ' . ucfirst(str_replace('-', ' ', $icon)) . '</li>';
			}
		$html .= '</ul>';
		$html .= '<input class="hidden-icons" type="hidden" name="'.$this->value['id'].'" value="'.$this->meta.'" />';
		$html .= '</div>';
		$html .= $this->finish;
		return $html;
	}
	public function separate(){
		$html = '<div class="postbox clearfix clear">
			<h3 class="hndle">'.$this->value['name'].'</h3>
			<div class="inside">';
		return $html;
	}
	public function endarray(){
		$html = '</div>
		</div>';
		return $html;
	}
}

include_once(get_template_directory().'/lib/ts-stds/theme-hooks-callbacks.php');
include_once(get_template_directory().'/lib/ts-stds/widgets.php');
include_once(get_template_directory().'/lib/ts-stds/shortcodes.php');
include_once(get_template_directory().'/lib/ts-stds/globals.php');
include_once(get_template_directory().'/lib/ts-stds/resume-pt.php');
if(is_user_logged_in()){
	include_once(get_template_directory().'/lib/ts-stds/tinymce/functions.php');
	include_once(get_template_directory().'/lib/ts-stds/ts-admin-options.php');
}

?>