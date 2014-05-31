<?php
/*
Template Name: Resume
*/
get_header(); global $a; if(have_posts()) : while(have_posts()) : the_post(); ?>
<div class="row clearfix">
	<article class="large-12 columns" id="<?php the_ID(); ?>">
		<div <?php post_class('entry clearfix'); ?>>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
<?php $allCats = get_terms('resume_categories', 'orderby=none&hide_empty'); foreach($allCats as $rc){ ?>
	<div class="row clearfix resume-row">
		<div class="large-3 columns">
			<h2><?php echo $rc->name; ?></h2>
		</div>
		<div class="large-9 columns">
			<div class="row clearfix item-row">
			<?php $args = array( 'post_type' => 'resume', 'showposts' => -1, 'resume_categories' => $rc->slug );
			$q1 = new WP_Query($args); while($q1->have_posts()) : $q1->the_post();
				$rc = get_post_custom(); ?>
			<?php if($rc['resume_style'][0]) == 'third_chunk'){ ?>
				<div class="large-4 columns">
					<h3><?php the_title(); ?></h3>
					<?php echo $rc['description'][0] ?>
				</div>
			<?php } elseif($rc['resume_style'][0]) == 'fourth_chunk'){ ?>
				<div class="large-3 columns">
					<?php echo $rc['description'][0]; ?>
				</div>
			<?php } elseif($rc['resume_style'][0]) == 'just_text'){ ?>
				<div class="large-12 columns">
					<?php echo $rc['description'][0] ?>
				</div>
			<?php } else { ?>
			<div class="row clearfix item-row">
				<div class="large-4 columns item-details">
					<?php the_title(); echo '<br />';
					if(!empty($rc['position_held'][0])) {
						echo $rc['position_held'][0].'<br />';
					}
					echo $rc['date_begun'][0];
					if(!empty($rc['date_completed'][0])) {
						echo ' - '.$rc['date_completed'][0];
					}
				echo '</div>';
				echo '<div class="large-8 columns item-desc">';
					echo $rc['description'][0]; ?>
				</div>
			</div>
			<?php } endwhile; wp_reset_query() ?>
			</div>
		</div>
	</div>
<?php } ?>
		</div>
	</article>
</div>
<?php endwhile; endif; get_footer();