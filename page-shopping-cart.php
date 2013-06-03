<?php
/*
Template Name: Shopping Cart Template
*/
?>
<?php get_header(); ?>
		<div id="content">
			<div class="main-column pad-top">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
				<div class="shopping-cart-wrapper">
					<h1><?php the_title(); ?></h1>
					<div id="shopping-cart"><span></span></div>

					<?php the_content(); ?>

				</div>

				<?php endwhile; endif; ?>

			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php get_footer(); ?>