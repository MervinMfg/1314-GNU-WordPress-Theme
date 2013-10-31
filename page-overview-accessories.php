<?php
/*
Template Name: Accessories Overview
*/
get_header();
?>
        <div id="content">
            <div class="main-column pad-top">
                <div class="product-overview-page accessories">
                    <?php /*<img src="<?php bloginfo('template_directory'); ?>/_/img/free-shipping.png" alt="Free Shipping - For a limited time only!" width="940" height="50" class="free-shipping-banner" />*/ ?>
                    <h1 id="accessories" class="deeplink-top-fix">Accessories</h1>
                    <ul class="product-listing">
                        <?php
                            // Get Snowboard Accessories
                            $args = array(
                                'post_type' => 'gnu_accessories',
                                'posts_per_page' => -1,
                                'orderby' => 'menu_order',
                                'order' => 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'gnu_accessories_categories',
                                        'field' => 'slug',
                                        'terms' => 'snowboard-accessories',
                                        'include_children' => false
                                    )
                                )
                            );
                            $counter = 1;
                            $loop = new WP_Query( $args );
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
                                    <?php echo getDisplayPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
                                </div>
                            </a>
                        </li>

                        <?
                            endwhile;
                            wp_reset_query();
                        ?>
                    </ul>
                    <div class="clear"></div>
                </div><!-- end product overview -->
            </div><!-- end .main-column -->
        </div><!-- end #content -->
<?php get_footer(); ?>