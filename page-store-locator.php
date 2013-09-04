<?php
/*
Template Name: Store Locator Template
*/
get_header();
?>
		<div id="content">
			<div class="main-column pad-top">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<section class="store-locator-header content-header">
					<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
				</section>

				<?php endwhile; endif; ?>

				<section class="store-locator-map">
					<iframe src="http://hosted.where2getit.com/mervin/?GNU=1" frameborder="0" height="700" width="920" scrolling="no" allowTransparency="true">You need a Frames Capable browser to view this content.</iframe>
				</section>
				<div class="clear"></div>
			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php get_footer(); ?>