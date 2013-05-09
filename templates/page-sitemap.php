<?php
/*
Template Name: Sitemap
*/
get_header(); $a = get_option('ts_admin_options'); ?>
<div class="row clearfix">
	<article class="large-12 columns" id="<?php the_ID(); ?>">
		<div <?php post_class('entry clearfix'); ?>>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<div class="row clear">
				<div class="large-4 columns">
					<h2>Pages</h2>
					<ul class="ts-sitemap">
						<?php wp_list_pages('title_li='); ?>
					</ul>
				</div>
				<div class="large-4 columns">
					<h2>Categories</h2>
					<ul class="ts-sitemap">
						<?php wp_list_categories('title_li='); ?>
					</ul>
				</div>
				<div class="large-4 columns">
					<h2>Tags</h2>
					<ul class="ts-sitemap">
						<?php $tag = get_tags(); foreach($tag as $t){
							echo '<li><a href="'.get_tag_link($t->term_id).'" title="'.$t->name.'">'.$t->name.'</a></li>';
						} ?>
					</ul>
				</div>
			</div>
			<ul class="social-single">
				<?php social_single(); ?>
			</ul>
		</div>
		<?php wp_link_pages(); ?>
		<div class="clear"></div>
		<div class="comments">
			<?php if($a['comments_on_pages']) comments_template(); ?>
		</div>
		<div class="clear"></div>
	</article>
</div>