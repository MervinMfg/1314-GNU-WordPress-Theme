<?php
/*
Template Name: Replacement Parts Template
*/
get_header();
?>
		<div id="content">
			<div class="main-column pad-top">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<h3>Binding Replacement Parts</h3>
				
                <?php
                    // Get Replacement Parts
                    $args = array(
                        'post_type' => 'gnu_accessories',
                        'posts_per_page' => -1,
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'gnu_accessories_categories',
                                'field' => 'slug',
                                'terms' => 'binding-parts',
                                'include_children' => false
                            )
                        )
                    );
                    $counter = 1;
                    $loop = new WP_Query( $args );
                    if ($loop->have_posts() == false) {
                        echo "<p>No parts are currently available online. Fill out the <a href=\"/support/replacement-parts/request-form/\">Replacement Parts Request Form</a> if there is a part you're in need of.</p>";
                    } else {
                        echo "<p>Don't see your replacement part below? Fill out the <a href=\"/support/replacement-parts/request-form/\">Replacement Parts Request Form</a>.</p>";
                    }
                ?>

                <ul class="product-listing replacement-parts-list">
                    <?php
                        while ( $loop->have_posts() ) : $loop->the_post();
                            $postType = $post->post_type;
                            $imageID = get_field('gnu_product_image');
                            $imageFile = wp_get_attachment_image_src($imageID, 'overview-thumb');

                            if($counter % 4 == 0){
                                $class = "product-item last ";
                            }else{
                                $class = "product-item";
                            }
                            $counter++;
                    ?>
                    <li class="<?php echo $class; ?>">
                        <a href="<? the_permalink(); ?>">
                            <img src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php the_title(); ?> Image" />
                            <h4><?php the_title(); ?></h4>
                            <div class="price">
                                <?php getDisplayPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
                            </div>
                        </a>
                    </li>

                    <?
                        endwhile;
                        wp_reset_query();
                    ?>
                    
                </ul>

				<?php endwhile; endif; ?>

				<div class="clear"></div>
			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php get_footer(); ?>