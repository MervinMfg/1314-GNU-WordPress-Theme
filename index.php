<?php get_header(); ?>
		<div id="content">
			<div class="main-column pad-top">
				<div class="posts-wrapper">

					<?php
					if (have_posts()) : while (have_posts()) : the_post();
						// get the featured image from the blog post
						$postImage = get_post_image('blog-thumb');
					?>

					<article class="post-list-item" id="post-<?php the_ID(); ?>">
						<a href="<?php the_permalink() ?>">
							<div class="post-image">
								<img src="<?php echo $postImage[0]; ?>" width="<?php echo $postImage[1]; ?>" height="<?php echo $postImage[2]; ?>" />
							</div>
							<div class="post-copy">
								<h2><?php the_title(); ?></h2>
								<?php include (TEMPLATEPATH . '/_/inc/meta.php' ); ?>
								<div class="post-entry">
									<?php echo strip_tags(gnu_excerpt('gnu_excerptlength_blog', false)); ?>
								</div>
								<div class="post-read-more">Read More</div>
							</div>
							<div class="clear"></div>
						</a>
					</article>
				
					<?php endwhile; ?>

					<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

					<?php else : ?>

					<h2>Not Found</h2>

					<?php endif; ?>

				</div>

				<?php get_sidebar(); ?>
				
				<div class="clear"></div>
			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php get_footer(); ?>