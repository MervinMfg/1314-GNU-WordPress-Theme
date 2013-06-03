<?php get_header(); ?>
		<div id="content">
			<div class="main-column pad-top">
				<div class="posts-wrapper">

				<?php if (have_posts()) : ?>

				<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

					<?php /* If this is a category archive */ if (is_category()) { ?>
						<h2>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>

					<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
						<h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>

					<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
						<h2>Archive for <?php the_time('F jS, Y'); ?></h2>

					<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
						<h2>Archive for <?php the_time('F, Y'); ?></h2>

					<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
						<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>

					<?php /* If this is an author archive */ } elseif (is_author()) { ?>
						<h2 class="pagetitle">Author Archive</h2>

					<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
						<h2 class="pagetitle">Blog Archives</h2>
					
					<?php } ?>

				<?php while (have_posts()) : the_post();
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

				<h2>Nothing found</h2>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>
			
				<div class="clear"></div>
			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php get_footer(); ?>
