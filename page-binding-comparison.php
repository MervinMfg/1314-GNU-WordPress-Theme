<?php
/*
Template Name: Binding Comparison Template
*/
?>
<?php get_header(); ?>
		<div id="content">
			<div class="main-column pad-top">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
				<div class="binding-compare-header">
					<h1><?php the_title(); ?></h1>

					<?php the_content(); ?>

				</div>

				<ul class="product-listing binding-compare-products">
					
					<?php
					if (isset($_COOKIE["GNUBindings"])){
						$bindingIDArray = explode(",", $_COOKIE["GNUBindings"]);
						$args = array(
		                    'post_type' => 'gnu_bindings',
		                    'post__in' => $bindingIDArray,
		                    'orderby' => 'menu_order',
		                    'order' => 'ASC'
		                );
		                $counter = 1;
		                $loop = new WP_Query( $args );
		                while ( $loop->have_posts() ) : $loop->the_post();
		                    $imageID = get_field('gnu_product_image');
		                    $imageFile = wp_get_attachment_image_src($imageID, 'overview-thumb');
		                    $thumbnailFile = wp_get_attachment_image_src($imageID, 'thumbnail');

		                    if($counter % 3 == 0){
		                        $class = "product-item last";
		                    }else{
		                        $class = "product-item";
		                    }
		                    $counter++;

		                    if($GLOBALS['language'] == "ca"){
		                        $price = "$" . get_field('gnu_product_price_ca') . " <span>CAD</span>";
		                    }else{
		                        $price = "$" . get_field('gnu_product_price_us') . " <span>USD</span>";
		                    }
					?>

					<li class="<?php echo $class; ?>">
						<a href="<? the_permalink(); ?>">
							<img src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php the_title(); ?> Image" />
							<h4><?php the_title(); ?></h4>
							<div class="price"><?php echo $price; ?></div>
						</a>
					</li>

					<?
						endwhile;
					}
		            ?>
				</ul>

				<div class="content-divider"></div>

				<div class="binding-compare-row odd-row">
					<h3>Price</h3>
					<ul>
						<?php
						if (isset($loop)){
							$counter = 1;
							while ( $loop->have_posts() ) : $loop->the_post();
								if($GLOBALS['language'] == "ca"){
									$price = "$" . get_field('gnu_product_price_ca') . " <span>CAD</span>";
								}else{
									$price = "$" . get_field('gnu_product_price_us') . " <span>USD</span>";
								}
								if($counter % 3 == 0){
									$class = "last";
								}else{
									$class = " ";
								}
								$counter++;
								echo "<li class=\"$class\"><div>$price</div></li>\n";
							endwhile;
						}
						?>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="binding-compare-row even-row">
					<h3>Flex</h3>
					<ul>
						<?php
						if (isset($loop)){
							$counter = 1;
							while ( $loop->have_posts() ) : $loop->the_post();
								$flex = get_field('gnu_binding_flex');
								if($counter % 3 == 0){
									$class = "last";
								}else{
									$class = " ";
								}
								$counter++;
								echo "<li class=\"$class\"><div>$flex</div></li>\n";
							endwhile;
						}
						?>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="binding-compare-row odd-row">
					<h3>Highback</h3>
					<ul>
						<?php
						if (isset($loop)){
							$counter = 1;
							while ( $loop->have_posts() ) : $loop->the_post();
								$highback = get_field('gnu_binding_highback');
								if($counter % 3 == 0){
									$class = "last";
								}else{
									$class = " ";
								}
								$counter++;
								echo "<li class=\"$class\"><div>$highback</div></li>\n";
							endwhile;
						}
						?>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="binding-compare-row even-row">
					<h3>Forward Lean</h3>
					<ul>
						<?php
						if (isset($loop)){
							$counter = 1;
							while ( $loop->have_posts() ) : $loop->the_post();
								$forwardLean = get_field('gnu_binding_forward_lean');
								if($counter % 3 == 0){
									$class = "last";
								}else{
									$class = " ";
								}
								$counter++;
								echo "<li class=\"$class\"><div>$forwardLean</div></li>\n";
							endwhile;
						}
						?>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="binding-compare-row odd-row">
					<h3>Baseplate</h3>
					<ul>
						<?php
						if (isset($loop)){
							$counter = 1;
							while ( $loop->have_posts() ) : $loop->the_post();
								$baseplate = get_field('gnu_binding_baseplate');
								if($counter % 3 == 0){
									$class = "last";
								}else{
									$class = " ";
								}
								$counter++;
								echo "<li class=\"$class\"><div>$baseplate</div></li>\n";
							endwhile;
						}
						?>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="binding-compare-row even-row">
					<h3>Footbed</h3>
					<ul>
						<?php
						if (isset($loop)){
							$counter = 1;
							while ( $loop->have_posts() ) : $loop->the_post();
								$footbed = get_field('gnu_binding_footbed');
								if($counter % 3 == 0){
									$class = "last";
								}else{
									$class = " ";
								}
								$counter++;
								echo "<li class=\"$class\"><div>$footbed</div></li>\n";
							endwhile;
						}
						?>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="binding-compare-row odd-row">
					<h3>Ankle Strap</h3>
					<ul>
						<?php
						if (isset($loop)){
							$counter = 1;
							while ( $loop->have_posts() ) : $loop->the_post();
								$ankleStrap = get_field('gnu_binding_ankle_strap');
								if($counter % 3 == 0){
									$class = "last";
								}else{
									$class = " ";
								}
								$counter++;
								echo "<li class=\"$class\"><div>$ankleStrap</div></li>\n";
							endwhile;
						}
						?>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="binding-compare-row even-row">
					<h3>Toe Strap</h3>
					<ul>
						<?php
						if (isset($loop)){
							$counter = 1;
							while ( $loop->have_posts() ) : $loop->the_post();
								$toeStrap = get_field('gnu_binding_toe_strap');
								if($counter % 3 == 0){
									$class = "last";
								}else{
									$class = " ";
								}
								$counter++;
								echo "<li class=\"$class\"><div>$toeStrap</div></li>\n";
							endwhile;
						}
						?>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="binding-compare-row odd-row">
					<h3>Buckles</h3>
					<ul>
						<?php
						if (isset($loop)){
							$counter = 1;
							while ( $loop->have_posts() ) : $loop->the_post();
								$buckles = get_field('gnu_binding_buckles');
								if($counter % 3 == 0){
									$class = "last";
								}else{
									$class = " ";
								}
								$counter++;
								echo "<li class=\"$class\"><div>$buckles</div></li>\n";
							endwhile;
						}
						?>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="binding-compare-row even-row">
					<h3>Disks</h3>
					<ul>
						<?php
						if (isset($loop)){
							$counter = 1;
							while ( $loop->have_posts() ) : $loop->the_post();
								$disks = get_field('gnu_binding_disks');
								if($counter % 3 == 0){
									$class = "last";
								}else{
									$class = " ";
								}
								$counter++;
								echo "<li class=\"$class\"><div>$disks</div></li>\n";
							endwhile;
						}
						?>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="binding-compare-row odd-row">
					<h3>Base Buffer</h3>
					<ul>
						<?php
						if (isset($loop)){
							$counter = 1;
							while ( $loop->have_posts() ) : $loop->the_post();
								$baseBuffer = get_field('gnu_binding_base_buffer');
								if($counter % 3 == 0){
									$class = "last";
								}else{
									$class = " ";
								}
								$counter++;
								echo "<li class=\"$class\"><div>$baseBuffer</div></li>\n";
							endwhile;
						}
						?>
					</ul>
					<div class="clearfix"></div>
				</div>

				<?php endwhile; endif; wp_reset_query(); ?>

			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php get_footer(); ?>