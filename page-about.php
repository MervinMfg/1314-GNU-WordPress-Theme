<?php
/*
Template Name: About Template
*/
get_header();
?>
		<div id="content">
			<div class="main-column pad-top">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<section class="about-content">
					<h1><?php the_title(); ?></h1>
					<h2>Weird times for a long time</h2>
					<?php the_content(); ?>
				</section>
				<div class="about-footer"></div>

				<?php endwhile; endif; ?>

				<div class="clear"></div>
			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php get_footer(); ?>