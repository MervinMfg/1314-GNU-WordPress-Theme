<?php
/*
Template Name: Team Template
*/
?>
<?php get_header(); ?>
		<div id="content">
			<div class="main-column pad-top">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div id="mens-pro" class="deeplink-top-fix"></div>
				<div id="womens-pro" class="deeplink-top-fix"></div>
				<section class="team-header">
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</section>
				<section class="mens-team">
					<h2>Mens Pro</h2>
					<ul class="team-list">

						<?php
							$args = array(
								'post_type' => 'gnu_team',
								'posts_per_page' => -1,
								'orderby' => 'menu_order',
								'order' => 'ASC',
								'tax_query' => array(
									array(
										'taxonomy' => 'gnu_team_categories',
										'field' => 'slug',
										'terms' => 'mens-pro',
										'include_children' => false
									)
								)
							);
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
								// check if snowbaord is related to the tech
								$profileName = get_field('gnu_team_profile_name');
								$profileName = wp_get_attachment_image_src($profileName, 'full', false);
								$profilePhoto = get_field('gnu_team_profile_photo'); // gnu_team_related_products
								$profilePhoto = wp_get_attachment_image_src($profilePhoto, 'full', false);
						?>

						<li>
							<a href="<?php the_permalink(); ?>">
								<div class="rider-name" style="background-image: url('<?php echo $profileName[0]; ?>');"><?php the_title(); ?></div>
								<div class="rider-photo" style="background-image: url('<?php echo $profilePhoto[0]; ?>');"></div>
								<div class="rider-photo-border"></div>
							</a>
						</li>

						<?php
							endwhile;
							wp_reset_query();
						?>

					</ul>
					<div class="clear"></div>
					<h2 id="mens-euro-pro" class="deeplink-top-fix">Mens Euro Pro</h2>
					<ul class="team-list">

						<?php
							$args = array(
								'post_type' => 'gnu_team',
								'posts_per_page' => -1,
								'orderby' => 'menu_order',
								'order' => 'ASC',
								'tax_query' => array(
									array(
										'taxonomy' => 'gnu_team_categories',
										'field' => 'slug',
										'terms' => 'mens-euro-pro',
										'include_children' => false
									)
								)
							);
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
								// check if snowbaord is related to the tech
								$profileName = get_field('gnu_team_profile_name');
								$profileName = wp_get_attachment_image_src($profileName, 'full', false);
								$profilePhoto = get_field('gnu_team_profile_photo'); // gnu_team_related_products
								$profilePhoto = wp_get_attachment_image_src($profilePhoto, 'full', false);
						?>

						<li>
							<a href="<?php the_permalink(); ?>">
								<div class="rider-name" style="background-image: url('<?php echo $profileName[0]; ?>');"><?php the_title(); ?></div>
								<div class="rider-photo" style="background-image: url('<?php echo $profilePhoto[0]; ?>');"></div>
								<div class="rider-photo-border"></div>
							</a>
						</li>

						<?php
							endwhile;
							wp_reset_query();
						?>

					</ul>
					<div class="clear"></div>
					<h2 id="mens-ams" class="deeplink-top-fix">Mens Ams</h2>
					<ul class="team-list">

						<?php
							$args = array(
								'post_type' => 'gnu_team',
								'posts_per_page' => -1,
								'orderby' => 'menu_order',
								'order' => 'ASC',
								'tax_query' => array(
									array(
										'taxonomy' => 'gnu_team_categories',
										'field' => 'slug',
										'terms' => 'mens-ams',
										'include_children' => false
									)
								)
							);
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
								// check if snowbaord is related to the tech
								$profileName = get_field('gnu_team_profile_name');
								$profileName = wp_get_attachment_image_src($profileName, 'full', false);
								$profilePhoto = get_field('gnu_team_profile_photo'); // gnu_team_related_products
								$profilePhoto = wp_get_attachment_image_src($profilePhoto, 'full', false);
						?>

						<li>
							<a href="<?php the_permalink(); ?>">
								<div class="rider-name" style="background-image: url('<?php echo $profileName[0]; ?>');"><?php the_title(); ?></div>
								<div class="rider-photo" style="background-image: url('<?php echo $profilePhoto[0]; ?>');"></div>
								<div class="rider-photo-border"></div>
							</a>
						</li>

						<?php
							endwhile;
							wp_reset_query();
						?>

					</ul>
					<div class="clear"></div>
					<h3>Weirder Weirdos</h3>
					<ul class="collab-list">
						<li><a href="/?s=Mark Carter">Mark Carter</a></li>
						<li><a href="/?s=Nick Ennen">Nick Ennen</a></li>
						<li><a href="/?s=Trevor Jacob">Trevor Jacob</a></li>
						<li><a href="/?s=Ross Baker">Ross Baker</a></li>
						<li><a href="/?s=Doran Laybourn">Doran Laybourn</a></li>
						<li><a href="/?s=Nate Farrell">Nate Farrell</a></li>
						<li><a href="/?s=Broc Waring">Broc Waring</a></li>
					</ul>
				</section>
				<section class="womens-team">
					<h2>Womens Pro</h2>
					<ul class="team-list">

						<?php
							$args = array(
								'post_type' => 'gnu_team',
								'posts_per_page' => -1,
								'orderby' => 'menu_order',
								'order' => 'ASC',
								'tax_query' => array(
									array(
										'taxonomy' => 'gnu_team_categories',
										'field' => 'slug',
										'terms' => 'womens-pro',
										'include_children' => false
									)
								)
							);
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
								// check if snowbaord is related to the tech
								$profileName = get_field('gnu_team_profile_name');
								$profileName = wp_get_attachment_image_src($profileName, 'full', false);
								$profilePhoto = get_field('gnu_team_profile_photo'); // gnu_team_related_products
								$profilePhoto = wp_get_attachment_image_src($profilePhoto, 'full', false);
						?>

						<li>
							<a href="<?php the_permalink(); ?>">
								<div class="rider-name" style="background-image: url('<?php echo $profileName[0]; ?>');"><?php the_title(); ?></div>
								<div class="rider-photo" style="background-image: url('<?php echo $profilePhoto[0]; ?>');"></div>
								<div class="rider-photo-border"></div>
							</a>
						</li>

						<?php
							endwhile;
							wp_reset_query();
						?>

					</ul>
					<div class="clear"></div>
					<h2 id="womens-ams" class="deeplink-top-fix">Womens Ams</h2>
					<div class="clear"></div>
					<ul class="team-list">

						<?php
							$args = array(
								'post_type' => 'gnu_team',
								'posts_per_page' => -1,
								'orderby' => 'menu_order',
								'order' => 'ASC',
								'tax_query' => array(
									array(
										'taxonomy' => 'gnu_team_categories',
										'field' => 'slug',
										'terms' => 'womens-ams',
										'include_children' => false
									)
								)
							);
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
								// check if snowbaord is related to the tech
								$profileName = get_field('gnu_team_profile_name');
								$profileName = wp_get_attachment_image_src($profileName, 'full', false);
								$profilePhoto = get_field('gnu_team_profile_photo'); // gnu_team_related_products
								$profilePhoto = wp_get_attachment_image_src($profilePhoto, 'full', false);
						?>

						<li>
							<a href="<?php the_permalink(); ?>">
								<div class="rider-name" style="background-image: url('<?php echo $profileName[0]; ?>');"><?php the_title(); ?></div>
								<div class="rider-photo" style="background-image: url('<?php echo $profilePhoto[0]; ?>');"></div>
								<div class="rider-photo-border"></div>
							</a>
						</li>

						<?php
							endwhile;
							wp_reset_query();
						?>

					</ul>
					<h3>The Gifted</h3>
					<ul class="collab-list">
						<li><a href="/?s=Bryn Valaika">Bryn Valaika</a></li>
						<li><a href="/?s=Maribeth Kramer">Maribeth Kramer</a></li>
						<li><a href="/?s=Sandra Hillen">Sandra Hillen</a></li>
						<li><a href="/?s=Jenna Blasman">Jenna Blasman</a></li>
						<li><a href="/?s=Michelle Zeller">Michelle Zeller</a></li>
						<li><a href="/?s=Ayla Thidling">Ayla Thidling</a></li>
						<li><a href="/?s=Amy Purdy">Amy Purdy</a></li>
						<li><a href="/?s=Meghann Obrien">Meghann Obrien</a></li>
						<li><a href="/?s=Pika">Pika</a></li>
						<li><a href="/?s=Amber Feld">Amber Feld</a></li>
						<li><a href="/?s=Sarah King">Sarah King</a></li>
						<li><a href="/?s=Megan Pischke">Megan Pischke</a></li>
					</ul>
				</section>

				<?php endwhile; endif; ?>

				<div class="clear"></div>
			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php get_footer(); ?>