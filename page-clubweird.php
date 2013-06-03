<?php
/*
Template Name: Club Weird Template
*/
get_header();
?>
		<div id="content">
			<div class="main-column pad-top">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<section class="club-weird-gallery">
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
					<div class="clearfix"></div>
					<script type="text/javascript" src="http://www.usnaps.com/__static/js/postMessage.js"></script>
					<script type="text/javascript" src="http://www.usnaps.com/__static/js/embed.js"></script>
					<h2>Saturday, February 2, 2013</h2>
					<div class="usnaps">
						<iframe	id="usnapsIframe3" src="http://www.usnaps.com/mb/gnu2013_3" width="752" height="768" frameborder="0" marginheight="0" marginwidth="0" scrolling="no">
							<p>Your browser does not support iframes.</p>
						</iframe>
					</div>
					<h2>Friday, February 1, 2013</h2>
					<div class="usnaps">
						<iframe	id="usnapsIframe2" src="http://www.usnaps.com/mb/gnu2013_2" width="752" height="768" frameborder="0" marginheight="0" marginwidth="0" scrolling="no">
							<p>Your browser does not support iframes.</p>
						</iframe>
					</div>
					<h2>Thursday, January 31, 2013</h2>
					<div class="usnaps">
						<iframe	id="usnapsIframe" src="http://www.usnaps.com/mb/gnu2013_1" width="752" height="768" frameborder="0" marginheight="0" marginwidth="0" scrolling="no">
							<p>Your browser does not support iframes.</p>
						</iframe>
					</div>
				</section>

				<?php endwhile; endif; ?>

				<div class="clear"></div>
			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php get_footer(); ?>