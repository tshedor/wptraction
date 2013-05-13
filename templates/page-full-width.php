<?php
/*
Template Name: Full Width
*/
get_header(); $a = get_option('ts_admin_options'); if(have_posts()) : while(have_posts()) : the_post(); ?>
<div class="row clearfix">
	<article class="large-12 columns" id="<?php the_ID(); ?>">
		<div <?php post_class('entry clearfix'); ?>>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<ul class="meta">
				<?php if(comments_open()) { ?><li><i class="icon-comments"></i>
				<?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></li><?php } ?>
			</ul>
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
<?php endwhile; endif; ?>