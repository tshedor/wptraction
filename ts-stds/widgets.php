<?php
class TS_FBLike extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'ts_fblike',
			__('TS Facebook Like Box', 'tswp'),
			array( 'description' => __( 'Show your Facebook Page or Profile feed', 'tswp' ), )
		);
	}
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$fblike_profile = $instance['fblike_profile'];
		$fblike_height = $instance['fblike_height'];

		echo $before_widget;
		if (!empty($title))
			echo $before_title . $title . $after_title;
			$html = '<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2F'.$fblike_profile.'&amp;width=292&amp;height='.$fblike_height.'&amp;show_faces=';
			if($instance['fblike_show_faces'])
				$html .= 'true';
			else
				$html .= 'false';
			$html .= '&amp;colorscheme='.$instance['fblike_color_scheme'].'&amp;stream=';
			if($instance['fblike_show_stream'])
				$html .= 'true';
			else
				$html .= 'false';
			$html .= '&amp;border_color=%23';
			if($instance['fblike_color_scheme'] == 'light')
				$html .= 'fff';
			else
				$html .= '000';
			$html .= '&amp;header=';
			if($instance['fblike_show_header'])
				$html .= 'true';
			else
				$html .= 'false';
			$html .= '" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:'.$fblike_height.'px;" allowTransparency="true"></iframe>';
			echo $html;
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['fblike_profile'] = strip_tags( $new_instance['fblike_profile'] );
		$instance['fblike_height'] = strip_tags( $new_instance['fblike_height'] );
		$instance['fblike_show_faces'] = strip_tags( $new_instance['fblike_show_faces'] );
		$instance['fblike_color_scheme'] = strip_tags( $new_instance['fblike_color_scheme'] );
		$instance['fblike_show_stream'] = strip_tags( $new_instance['fblike_show_stream'] );
		$instance['fblike_show_header'] = strip_tags( $new_instance['fblike_show_header'] );

		return $instance;
	}

	public function form( $instance ) {
		if(isset($instance[ 'title' ]))
			$title = $instance[ 'title' ];
		else
			$title = __( 'Latest from Facebook', 'tswp' );
		if(isset($instance['fblike_profile']))
			$fblike_profile = $instance['fblike_profile'];
		else
			$fblike_profile = 'platform';
		if(isset($instance['fblike_show_faces']))
			$fblike_show_faces = $instance['fblike_show_faces'];
		if(isset($instance['fblike_show_stream']))
			$fblike_show_stream = $instance['fblike_show_stream'];
		else
			$fblike_show_stream =  'on';
		if(isset($instance['fblike_show_header']))
			$fblike_show_header = $instance['fblike_show_header'];
		if(isset($instance['fblike_height']))
			$fblike_height = $instance['fblike_height'];
		else
			$fblike_height = '350';
		if(isset($instance['fblike_color_scheme']))
			$fblike_color_scheme = $instance['fblike_color_scheme'];
		else
			$fblike_color_scheme = 'light';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'tswp') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'fblike_profile' ); ?>"><?php _e('Facebook Profile', 'tswp') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'fblike_profile' ); ?>" name="<?php echo $this->get_field_name( 'fblike_profile' ); ?>" type="text" value="<?php echo esc_attr( $fblike_profile ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'fblike_show_stream' ); ?>">
				<input id="<?php echo $this->get_field_id( 'fblike_show_stream' ); ?>" name="<?php echo $this->get_field_name( 'fblike_show_stream' ); ?>" type="checkbox" <?php if($fblike_show_stream) { echo ' checked '; } ?> />
				<?php _e('Show Stream', 'tswp') ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'fblike_show_faces' ); ?>">
				<input id="<?php echo $this->get_field_id( 'fblike_show_faces' ); ?>" name="<?php echo $this->get_field_name( 'fblike_show_faces' ); ?>" type="checkbox" <?php if($fblike_show_faces) { echo ' checked '; } ?> />
				<?php _e('Show Faces', 'tswp') ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'fblike_show_header' ); ?>">
				<input id="<?php echo $this->get_field_id( 'fblike_show_header' ); ?>" name="<?php echo $this->get_field_name( 'fblike_show_header' ); ?>" type="checkbox" <?php if($fblike_show_header) { echo ' checked '; } ?> />
				<?php _e('Show Header', 'tswp') ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'fblike_height' ); ?>"><?php _e('Box height', 'tswp') ?></label>
			<input id="<?php echo $this->get_field_id( 'fblike_height' ); ?>" name="<?php echo $this->get_field_name( 'fblike_height' ); ?>" type="number" value="<?php echo esc_attr( $fblike_height ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'fblike_color_scheme' ); ?>"><?php _e('Facebook Color Scheme', 'tswp') ?><br /></label>
			<label for="colorLight">
				<input id="colorLight" name="<?php echo $this->get_field_name( 'fblike_color_scheme' ); ?>" type="radio" <?php if($fblike_color_scheme == 'light') { echo ' checked '; } ?> value="light" />
			&nbsp;<?php _e('Light', 'tswp') ?>&nbsp;
			</label>
			<label for="colorDark">
				<input id="colorDark" name="<?php echo $this->get_field_name( 'fblike_color_scheme' ); ?>" type="radio" <?php if($fblike_color_scheme == 'dark') { echo ' checked '; } ?> value="dark" />
			&nbsp;<?php _e('Dark', 'tswp') ?>&nbsp;
			</label>
		</p>
		<?php
	}

}
add_action( 'widgets_init', create_function( '', 'register_widget( "ts_fblike" );' ) );

class TS_Twitter extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'ts_twitter',
			__('TS Twitter', 'tswp'),
			array( 'description' => __( 'Show your latest tweets', 'tswp' ), )
		);
	}
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$twitter_profile = $instance['twitter_profile'];
		$tweet_count = $instance['tweet_count'];

		if($instance['show_retweets'])
			$retweets = 'true';
		else
			$retweets = 'false';

		echo $before_widget;
		if (!empty($title))
			echo '<a href="http://twitter.com/'.$twitter_profile.'" target="_blank" title="'.$twitter_profile.'">'.$before_title . $title . $after_title.'</a>';
		$tweets = json_decode(file_get_contents('https://api.twitter.com/1/statuses/user_timeline.json?screen_name='.$twitter_profile.'&count='.$tweet_count.'&include_entities=false&include_rts='.$retweets));
		if($tweets){
			echo '<ul>';
			foreach ($tweets as $t) {
				echo '<li>'.make_clickable($t->text).'&nbsp<small><a href="http://twitter.com/'.$twitter_profile.'/statuses/'.$t->id_str.'" target="_blank" title="'.__('View on Twitter', 'tswp').'">'.__('View on Twitter', 'tswp').'</a></small></li>';
			}
			echo '</ul>';
		}
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitter_profile'] = strip_tags( $new_instance['twitter_profile'] );
		$instance['tweet_count'] = strip_tags( $new_instance['tweet_count'] );
		$instance['show_retweets'] = strip_tags( $new_instance['show_retweets'] );

		return $instance;
	}

	public function form( $instance ) {
		if(isset($instance[ 'title' ]))
			$title = $instance[ 'title' ];
		else
			$title = __( 'Latest Tweets', 'tswp' );
		if(isset($instance['twitter_profile']))
			$twitter_profile = $instance['twitter_profile'];
		else
			$twitter_profile = 'tshedor';
		if(isset($instance['show_retweets']))
			$show_retweets = $instance['show_retweets'];
		else
			$show_retweets = 'on';
		if(isset($instance['tweet_count']))
			$tweet_count = $instance['tweet_count'];
		else
			$tweet_count = '5';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'tswp') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_profile' ); ?>"><?php _e('Twitter Profile', 'tswp') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter_profile' ); ?>" name="<?php echo $this->get_field_name( 'twitter_profile' ); ?>" type="text" value="<?php echo esc_attr( $twitter_profile ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tweet_count' ); ?>"><?php _e('Tweet Count', 'tswp') ?></label>
			<input id="<?php echo $this->get_field_id( 'tweet_count' ); ?>" name="<?php echo $this->get_field_name( 'tweet_count' ); ?>" type="number" value="<?php echo esc_attr( $tweet_count ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_retweets' ); ?>">
				<input id="<?php echo $this->get_field_id( 'show_retweets' ); ?>" name="<?php echo $this->get_field_name( 'show_retweets' ); ?>" type="checkbox" <?php if($show_retweets) { echo ' checked '; } ?> />
				<?php _e('Show Retweets', 'tswp') ?>
			</label>
		</p>
		<?php
	}

}
add_action( 'widgets_init', create_function( '', 'register_widget( "ts_twitter" );' ) );

class TS_Related extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'ts_related',
			__('TS Related Posts', 'tswp'),
			array( 'description' => __( 'Display related posts', 'tswp' ), )
		);
	}
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$post_count = $instance['post_count'];

		echo $before_widget;
		if (!empty($title))
			echo $before_title . $title . $after_title;
			TSThemes::related($post_count);
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_count'] = strip_tags( $new_instance['post_count'] );

		return $instance;
	}

	public function form( $instance ) {
		if(isset($instance[ 'title' ]))
			$title = $instance[ 'title' ];
		else
			$title = __( 'Related Posts', 'tswp' );
		if(isset($instance['post_count']))
			$post_count = $instance['post_count'];
		else
			$post_count = '5';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'tswp') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_count' ); ?>"><?php _e('Post Count', 'tswp') ?></label>
			<input id="<?php echo $this->get_field_id( 'post_count' ); ?>" name="<?php echo $this->get_field_name( 'post_count' ); ?>" type="number" value="<?php echo esc_attr( $post_count ); ?>" />
		</p>
		<?php
	}

}
add_action( 'widgets_init', create_function( '', 'register_widget( "ts_related" );' ) );

class TS_Popular extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'ts_popular',
			__('TS Popular Posts', 'tswp'),
			array( 'description' => __( 'Display most popular posts', 'tswp' ), )
		);
	}
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$post_count = $instance['post_count'];

		echo $before_widget;
		if (!empty($title))
			echo $before_title . $title . $after_title;
			echo '<ul class="ts-popular">';
			$q1 = new WP_Query('meta_key=post_views_count&orderby=meta_value_num&order=DESC&showposts='.$post_count.'&w='.date('W')); while ($q1->have_posts()) : $q1->the_post();
				echo '<li><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></li>';
			endwhile;
			echo '</ul>';
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_count'] = strip_tags( $new_instance['post_count'] );

		return $instance;
	}

	public function form( $instance ) {
		if(isset($instance[ 'title' ]))
			$title = $instance[ 'title' ];
		else
			$title = __( 'Popular Posts', 'tswp' );
		if(isset($instance['post_count']))
			$post_count = $instance['post_count'];
		else
			$post_count = '5';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'tswp') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_count' ); ?>"><?php _e('Post Count', 'tswp') ?></label>
			<input id="<?php echo $this->get_field_id( 'post_count' ); ?>" name="<?php echo $this->get_field_name( 'post_count' ); ?>" type="number" value="<?php echo esc_attr( $post_count ); ?>" />
		</p>
		<?php
	}

}
add_action( 'widgets_init', create_function( '', 'register_widget( "ts_popular" );' ) );
class TS_Contact extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'ts_contact',
			__('TS Contact', 'tswp'),
			array( 'description' => __( 'Display a contact form', 'tswp' ), )
		);
	}
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$email_please = $instance['contact_email'];
		$a = get_option('ts_admin_options');
		$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(!isset($email_please)){
			if(!$email_please){
				if(!empty($a['contact_form_email']))
					$email_please = $a['contact_form_email'];
				else
					$email_please = get_option('admin_email');
			}
		}
		$contact_form = '<form method="post" class="ts-contact">
			<input type="text" placeholder="'.__('Name', 'tswp').'" name="ts_name"/>
			<input type="text" placeholder="'.__('Email', 'tswp').'" name="ts_email"/>
			<textarea placeholder="'.__('Your message', 'tswp').'" name="ts_message"></textarea>
			<input type="hidden" name="ts_contact"/>
			<input type="submit" class="button" value="'.__('Contact', 'tswp').'" />
		</form>';
		echo $before_widget;
		if (!empty($title))
			echo $before_title . $title . $after_title;
		if(isset($_POST['ts_contact'])){
			wp_mail($email, __('Contact Form from', 'tswp').' '.$_POST['ts_name'], esc_attr(strip_tags($_POST['ts_message'])));
			echo '<div class="notice success">'.__('Thank you for your message', 'tswp').'</div>';
		}
		echo $contact_form;
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['contact_email'] = strip_tags( $new_instance['contact_email'] );

		return $instance;
	}

	public function form( $instance ) {
		if(isset($instance[ 'title' ]))
			$title = $instance[ 'title' ];
		else
			$title = __( 'Contact', 'tswp' );
		if(isset($instance['contact_email']))
			$contact_email = $instance['contact_email'];
		else
			$contact_email = __('name@example.com', 'tswp');
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'tswp') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'contact_email' ); ?>"><?php _e('Send to Email', 'tswp') ?></label>
			<input id="<?php echo $this->get_field_id( 'contact_email' ); ?>" name="<?php echo $this->get_field_name( 'contact_email' ); ?>" type="text" value="<?php echo esc_attr( $contact_email ); ?>" placeholder="<?php _e('name@example.com', 'tswp') ?>" class="widefat" />
		</p>
		<?php
	}

}
add_action( 'widgets_init', create_function( '', 'register_widget( "ts_contact" );' ) );
class TS_Mailchimp extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'ts_mailchimp',
			__('TS Mailchimp', 'tswp'),
			array( 'description' => __( 'Display a Mailchimp subscribe form', 'tswp' ), )
		);
	}
	public function widget( $args, $instance ) {
		extract( $args );
		include_once(get_template_directory().'/inc/ts-stds/libs/mailchimp/MCAPI.class.php');
		$title = apply_filters( 'widget_title', $instance['title'] );
		$mc_api_key = $instance['mc_api_key'];
		$mc_list_id = $instance['mc_list_id'];
		if($instance['double_optin'])
			$double_optin = true;
		else
			$double_optin = false;
		if($instance['send_welcome'])
			$send_welcome = true;
		else
			$send_welcome = false;
		$get_name = $instance['get_name'];
		$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		echo $before_widget;
		if (!empty($title))
			echo $before_title . $title . $after_title;
		if(isset($_POST['ts_mailchimp'])){
			$merges = array();
			if($get_name)
				$merges = array('FNAME' => $_POST['fname'], 'LNAME'=>$_POST['lname'],);
			$api = new MCAPI($mc_api_key);
			$retval = $api->listSubscribe( $mc_list_id, $_POST['email'], $merges, 'html', $double_optin, false, true, $send_welcome );
			if ($api->errorCode){
				echo '<div class="notice error">'.$api->errorMessage.'\n</div>';
			} else {
				echo '<div class="notice success">';
				if($double_optin)
					_e('Success. Look for the confirmation message in your inbox.', 'tswp');
				else
					_e('Success. Stay tuned.', 'tswp');
				echo '</div>';
			}
		} else {
			echo '<form method="post" class="ts-contact ts-mailchimp">
			<input type="text" name="email" placeholder="'.__('Email', 'tswp').'" />';
			if($get_name)
				echo '<input type="text" name="fname" placeholder="'.__('First Name', 'tswp').'" />
				<input type="text" name="lname" placeholder="'.__('Last Name', 'tswp').'" />';
			echo '<input type="hidden" name="ts_mailchimp" />
			<input type="submit" class="button" value="'.__('Subscribe', 'tswp').'" />
			</form>';
		}
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['mc_api_key'] = strip_tags( $new_instance['mc_api_key'] );
		$instance['mc_list_id'] = strip_tags( $new_instance['mc_list_id'] );
		$instance['double_optin'] = strip_tags( $new_instance['double_optin'] );
		$instance['send_welcome'] = strip_tags( $new_instance['send_welcome'] );
		$instance['get_name'] = strip_tags( $new_instance['get_name'] );

		return $instance;
	}

	public function form( $instance ) {
		if(isset($instance[ 'title' ]))
			$title = $instance[ 'title' ];
		else
			$title = __( 'Subscribe', 'tswp' );
		if(isset($instance['mc_api_key']))
			$mc_api_key = $instance['mc_api_key'];
		else
			$mc_api_key = __('YOUR API KEY', 'tswp');
		if(isset($instance['mc_list_id']))
			$mc_list_id = $instance['mc_list_id'];
		else
			$mc_list_id = false;
		if(isset($instance['double_optin']))
			$double_optin = $instance['double_optin'];
		else
			$double_optin = 'on';
		if(isset($instance['send_welcome']))
			$send_welcome = $instance['send_welcome'];
		else
			$send_welcome = false;
		if(isset($instance['get_name']))
			$get_name = $instance['get_name'];
		else
			$get_name = false;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'tswp') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'mc_api_key' ); ?>"><?php _e('API Key', 'tswp') ?> <a href="http://admin.mailchimp.com/account/api" target="_blank"><?php _e('Get an API Key', 'tswp') ?></a>:</label>
			<input id="<?php echo $this->get_field_id( 'mc_api_key' ); ?>" name="<?php echo $this->get_field_name( 'mc_api_key' ); ?>" type="text" value="<?php echo esc_attr( $mc_api_key ); ?>" placeholder="<?php _e('YOUR API KEY', 'tswp') ?>" class="widefat" />
		</p>
		<?php if($mc_api_key != 'YOUR API KEY'){ ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'mc_list_id' ); ?>"><?php _e('Your lists (please add API key, save and refresh)', 'tswp') ?></label>
			<?php
			include_once(get_template_directory().'/inc/ts-stds/libs/mailchimp/MCAPI.class.php');
			$api = new MCAPI($mc_api_key);
			$getlists = $api->lists();
			if ($api->errorCode){
				_e('No lists available', 'tswp');
			} else { ?>
			<select id="<?php echo $this->get_field_id( 'mc_list_id' ); ?>" name="<?php echo $this->get_field_name( 'mc_list_id' ); ?>" placeholder="<?php _e('YOUR API KEY', 'tswp') ?>" class="widefat">
				<option><?php _e('Select One', 'tswp') ?></option>
				<?php foreach ($getlists['data'] as $list) {
					echo '<option value="'.$list['id'].'" ',$mc_list_id == $list['id'] ? 'selected' : '','>'.$list['name'].'</option>';
				} ?>
			</select>
			<?php }
		echo '</p>';
		} ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'double_optin' ); ?>">
				<input id="<?php echo $this->get_field_id( 'double_optin' ); ?>" name="<?php echo $this->get_field_name( 'double_optin' ); ?>" type="checkbox" <?php if($double_optin) { echo ' checked '; } ?> />
				<?php _e('Send a confirmation email', 'tswp') ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'send_welcome' ); ?>">
				<input id="<?php echo $this->get_field_id( 'send_welcome' ); ?>" name="<?php echo $this->get_field_name( 'send_welcome' ); ?>" type="checkbox" <?php if($send_welcome) { echo ' checked '; } ?> />
				<?php _e('Send welcome email (no effect if confirmation email is checked)', 'tswp') ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'get_name' ); ?>">
				<input id="<?php echo $this->get_field_id( 'get_name' ); ?>" name="<?php echo $this->get_field_name( 'get_name' ); ?>" type="checkbox" <?php if($get_name) { echo ' checked '; } ?> />
				<?php _e('Get first and last name', 'tswp') ?>
			</label>
		</p>
		<?php
	}

}
add_action( 'widgets_init', create_function( '', 'register_widget( "ts_mailchimp" );' ) );