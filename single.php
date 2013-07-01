<?php get_header(); ?>
		<div id="content">
			<div class="main-column pad-top">
				<div class="posts-wrapper">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article class="post" id="post-<?php the_ID(); ?>">
						<div class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
							<?php include (TEMPLATEPATH . '/_/inc/meta.php' ); ?>
							<?php //edit_post_link('Edit this entry','','.'); ?>
							<ul class="entry-share">
								<li><div class="fb-like" data-href="<? the_permalink(); ?>" data-send="true" data-layout="button_count" data-width="150" data-show-faces="false" data-colorscheme="dark" data-font="trebuchet ms"></div></li>
								<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="GNUsnowboards">Tweet</a></li>
								<li><div class="g-plusone" data-size="medium" data-href="<? the_permalink(); ?>"></div></li>
								<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
							</ul>
							<div class="clear"></div>
						</div>

						<div class="entry-content">

							<?php the_content(); ?>

							<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

						</div>
						<div class="entry-categories-tags">
							<p class="entry-categories">
								Categories: <?php the_category(', ') ?>
							</p>
							<p class="entry-tags">
								<?php the_tags('Tags: ', ', ', ''); ?>
							</p>
						</div>

					</article>

					

					<?php
					// GET THOSE RELATED POSTS BY CATEGORY YO!
					$orig_post = $post;
					global $post;
					$categories = get_the_category($post->ID);
					if ($categories) {
						$category_ids = array();
						foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
						$args=array(
							'category__in' => $category_ids,
							'post__not_in' => array($post->ID),
							'posts_per_page' => 2, // Number of related posts that will be shown.
							'ignore_sticky_posts' => 1,
							'orderby' => 'rand'
						);
						$my_query = new WP_Query( $args );
						if( $my_query->have_posts() ) {
							echo '<section class="related-posts"><h3>RELATED POSTS:</h3><ul>';
							$i=1;
							while( $my_query->have_posts() ) {
								$my_query->the_post();
								$postImage = get_post_image('blog-thumb');
					?>

								<li<?php if(($i % 2) == 0){ echo " class=\"right\""; } ?>>
									<a href="<? the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
										<div class="related-content">
											<p><?php the_title(); ?></p>
										</div>
										<div class="related-thumb">
											<img src="<?php echo $postImage[0]; ?>" width="<?php echo $postImage[1]; ?>" height="<?php echo $postImage[2]; ?>" />
										</div>
									</a>
								</li>

					<?
								$i++;
							}
							echo '</ul><div class="clear"></div></section>';
						}
					}
					$post = $orig_post;
					wp_reset_query();
					// END RELATED Posts
					?>

					<?php comments_template(); ?>

					<?php endwhile; endif; ?>

				</div>

				<?php get_sidebar(); ?>

				<div class="clear"></div>
			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php get_footer(); ?>