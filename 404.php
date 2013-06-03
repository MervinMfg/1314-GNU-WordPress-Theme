<?php get_header(); ?>
		<div id="content">
			<div class="main-column pad-top">

				<div class="error-page-wrapper">
					<h2>This is not the page you were looking for</h2>
					<img src="<?php bloginfo('template_directory'); ?>/_/img/404.png" width="580" height="563" alt="Stanny fixing it" />
					<h4>We're working on it.</h4>
					<p class="link">While Stanny fixes this up, you may find what you're looking for somewhere else on the <a href="/">site</a>.</p>
				</div>

				<?php get_sidebar(); ?>

			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php get_footer(); ?>