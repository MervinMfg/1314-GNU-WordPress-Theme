<?php
/*
Template Name: Home Template
*/
?>
<?php get_header(); ?>

		<!--<div id="homepage-takeover">
			<div class="forest-bailey-close"></div>
			<div class="forest-bailey"></div>
			<div class="forest-bailey-board-top"></div>
			<div class="forest-bailey-board-base"></div>
			<div class="forest-bailey-name"></div>
			<div class="forest-bailey-cloud-1"></div>
			<div class="forest-bailey-cloud-2"></div>
			<div class="forest-bailey-cloud-3"></div>
			<div class="forest-bailey-bg"></div>
		</div>-->
		<div id="content">
			<div class="hero-slider">
				<div class="hero-image-wrapper">
					<ul>
						<?php if(get_field('gnu_hero_area')): while(the_repeater_field('gnu_hero_area')):
							$heroAreaImage = get_sub_field('gnu_hero_area_image');
		       				$heroAreaImage = wp_get_attachment_image_src($heroAreaImage, 'full', false);
						?>

						<li><a href="<?php the_sub_field('gnu_hero_area_url'); ?>"><img src="<?php echo $heroAreaImage[0]; ?>" alt="<?php the_sub_field('gnu_hero_area_alt'); ?>" width="<?php echo $heroAreaImage[1]; ?>" height="<?php echo $heroAreaImage[2]; ?>" /></a></li>

						<?php endwhile; endif; ?>

					</ul>
					<div id="hero-prev"></div>
					<div id="hero-next"></div>
				</div>
			</div>
			<div class="purple-divider"></div>
			<div class="main-column">
				<h2 class="keep-snowboarding-weird">Keep Snowboarding Weird</h2>
				<section class="facebook-box">
					<div class="fb-like-box" data-href="http://www.facebook.com/gnuSnowboards" data-width="292" data-height="564" data-show-faces="false" data-colorscheme="dark" data-stream="true" data-show-border="false" data-header="false"></div>
				</section>
				<section class="featured-weird-cinema">
					<div class="video">
						<iframe src="http://player.vimeo.com/video/<?php echo get_field('gnu_featured_video'); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=99cc33" width="612" height="344" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
					</div>
				</section>
				<section class="featured-blog">

					<?php
						$args = array(
							'posts_per_page' => 1,
							'post__in'  => get_option( 'sticky_posts' ),
							'ignore_sticky_posts' => 1
						);
						query_posts( $args );
	                	if (have_posts()) : while (have_posts()) : the_post();
	                		$post_thumbnail = get_post_image('home-blog-thumb');
					?>

					<a href="<?php the_permalink() ?>" id="post-<?php the_ID(); ?>">
						<div class="featured-blog-image">
							<h4>Insta-Weird</h4>
							<img src="<?php echo $post_thumbnail[0]; ?>" alt="Image From <?php echo get_the_title(); ?>" />
						</div>
						<div class="featured-blog-content">
							<h3><?php the_title(); ?></h3>
							<p><?php echo strip_tags(gnu_excerpt('gnu_excerptlength_home', false)); ?></p>
							<div class="featured-blog-content-more">Read More</div>
						</div>
					</a>
	                
	                <?php
	                		$post_thumbnail = ""; // resetting image value
	            		endwhile; endif;
	            		wp_reset_query();
	            	?>

				</section>
				<section class="featured-links">
					<ul>
						<?php
							$i = 0;
							if (get_field('gnu_featured_links')): while(the_repeater_field('gnu_featured_links')):
								$i++;
								$featuredImage = get_sub_field('gnu_featured_links_image');
		       					$featuredImage = wp_get_attachment_image_src($featuredImage, 'full', false);
		       					$cssClass = "featured-links-" . get_sub_field('gnu_featured_links_border_color');
		       					if ($i == 3) {
		       						$cssClass .= " featured-links-last";
		       					}
						?>
						<li class="<?php echo $cssClass; ?>"><a href="<?php the_sub_field('gnu_featured_links_url'); ?>"><img src="<?php echo $featuredImage[0]; ?>" alt="<?php the_sub_field('gnu_featured_links_alt'); ?>" width="<?php echo $featuredImage[1]; ?>" height="<?php echo $featuredImage[2]; ?>" /></a></li>

						<?php endwhile; endif; ?>

					</ul>
				</section>
				<section class="instagram">
					<h4>Follow us on Instagram @GNUsnowboards</h4>
					<div class="instagram-slider">
						<div id="insta-prev"></div>
						<div class="insta-photo-wrapper">
							<ul id="instagram-photos"></ul>
						</div>
						<div id="insta-next"></div>
					</div>
				</section>
			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php get_footer(); ?>