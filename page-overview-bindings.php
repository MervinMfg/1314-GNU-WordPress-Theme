<?php
/*
Template Name: Bindings Overview
*/
get_header();
?>
        <div id="content">
            <div class="main-column pad-top">
                <div class="binding-animation">
                    <div class="animation-prev"></div>
                    <ul>
                        <li><img src="<?php bloginfo('template_directory'); ?>/_/img/binding-animation-1.png" alt="GNU Bindings – Easy In, Easy Out!" /></li>
                        <li><img src="<?php bloginfo('template_directory'); ?>/_/img/binding-animation-2.png" alt="Reclining Highback" /></li>
                        <li><img src="<?php bloginfo('template_directory'); ?>/_/img/binding-animation-3.png" alt="Auto Open Lever" /></li>
                        <li><img src="<?php bloginfo('template_directory'); ?>/_/img/binding-animation-4.png" alt="Pressure Relief Button" /></li>
                        <li><img src="<?php bloginfo('template_directory'); ?>/_/img/binding-animation-5.png" alt="Micro Buckle" /></li>
                        <li><img src="<?php bloginfo('template_directory'); ?>/_/img/binding-animation-6.png" alt="Try the Backdoor" /></li>
                    </ul>
                    <div class="animation-next"></div>
                </div>
                <div id="binding-comparison">
                    <div class="binding-compare">
                        <h4>Compare <span>Select bindings to compare</span></h4>
                        <ul>
                            <li><img src="<?php bloginfo('template_directory'); ?>/_/img/binding-compare-blank.png" alt="Comparison Binding 1" /><span></span></li>
                            <li><img src="<?php bloginfo('template_directory'); ?>/_/img/binding-compare-blank.png" alt="Comparison Binding 2" /><span></span></li>
                            <li><img src="<?php bloginfo('template_directory'); ?>/_/img/binding-compare-blank.png" alt="Comparison Binding 3" /><span></span></li>
                        </ul>
                        <a href="/binding-comparison/" class="compare-link">Compare</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="product-overview-page bindings">
                    <?php
                    if (isset($_GET["gender"])) {
                        $gender = $_GET["gender"];
                        if($gender == 'womens' || $gender == 'women' || $gender == 'female'){
                            getWomens();
                            getMens();
                        }else{
                            getMens();
                            getWomens();
                        }
                    }else{
                        getMens();
                        getWomens();
                    }
                    ?>

                    <?php function getMens() { ?>
                    <h1 id="mens" class="deeplink-top-fix">Mens Bindings</h1>
                    <ul class="product-listing">
                        <?php
                            // Get Mens Bindings
                            $args = array(
                                'post_type' => 'gnu_bindings',
                                'posts_per_page' => -1,
                                'orderby' => 'menu_order',
                                'order' => 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'gnu_bindings_categories',
                                        'field' => 'slug',
                                        'terms' => 'mens',
                                        'include_children' => false
                                    )
                                )
                            );
                            $counter = 1;
                            $loop = new WP_Query( $args );
                            while ( $loop->have_posts() ) : $loop->the_post();
                                $imageID = get_field('gnu_product_image');
                                $imageFile = wp_get_attachment_image_src($imageID, 'overview-thumb');
                                $thumbnailFile = wp_get_attachment_image_src($imageID, 'thumbnail');

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
                            <div class="compare" id="compare-<?php echo $loop->post->ID ?>">
                                <label for="checkbox-<?php echo $loop->post->ID ?>">Compare</label>
                                <input class="compare-checkbox" id="checkbox-<?php echo $loop->post->ID ?>" name="checkbox-<?php echo $loop->post->ID ?>" type="checkbox" value="<?php echo $loop->post->ID ?>">
                                <input type="hidden" name="product-image" value="<?php echo $thumbnailFile[0]; ?>" />
                                <input type="hidden" name="product-name" value="<?php the_title(); ?>" />
                            </div>
                        </li>

                        <?
                            endwhile;
                            wp_reset_query();
                        ?>
                    </ul>
                    <div class="clear"></div>

                    <?php }; // getMens function ?>

                    <?php function getWomens() { ?>
                    <h1 id="womens" class="deeplink-top-fix">Womens Bindings</h1>
                    <ul class="product-listing">
                        <?php
                            // Get Womens Bindings
                            $args = array(
                                'post_type' => 'gnu_bindings',
                                'posts_per_page' => -1,
                                'orderby' => 'menu_order',
                                'order' => 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'gnu_bindings_categories',
                                        'field' => 'slug',
                                        'terms' => 'womens',
                                        'include_children' => false
                                    )
                                )
                            );
                            $counter = 1;
                            $loop = new WP_Query( $args );
                            while ( $loop->have_posts() ) : $loop->the_post();
                                $imageID = get_field('gnu_product_image');
                                $imageFile = wp_get_attachment_image_src($imageID, 'overview-thumb');
                                $thumbnailFile = wp_get_attachment_image_src($imageID, 'thumbnail');

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
                            <div class="compare" id="compare-<?php echo $loop->post->ID ?>">
                                <label for="checkbox-<?php echo $loop->post->ID ?>">Compare</label>
                                <input class="compare-checkbox" id="checkbox-<?php echo $loop->post->ID ?>" name="checkbox-<?php echo $loop->post->ID ?>" type="checkbox" value="<?php echo $loop->post->ID ?>">
                                <input type="hidden" name="product-image" value="<?php echo $thumbnailFile[0]; ?>" />
                                <input type="hidden" name="product-name" value="<?php the_title(); ?>" />
                            </div>
                        </li>

                        <?
                            endwhile;
                            wp_reset_query();
                        ?>
                    </ul>
                    <div class="clear"></div>

                    <?php }; // end getWomens function ?>

                    <h1>Youth Bindings</h1>
                    <ul class="product-listing">
                        <?php
                            // Get Mens Youth Bindings
                            $args = array(
                                'post_type' => 'gnu_bindings',
                                'posts_per_page' => -1,
                                'orderby' => 'menu_order',
                                'order' => 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'gnu_bindings_categories',
                                        'field' => 'slug',
                                        'terms' => 'youth',
                                        'include_children' => false
                                    )
                                )
                            );
                            $counter = 1;
                            $loop = new WP_Query( $args );
                            while ( $loop->have_posts() ) : $loop->the_post();
                                $imageID = get_field('gnu_product_image');
                                $imageFile = wp_get_attachment_image_src($imageID, 'overview-thumb');
                                $thumbnailFile = wp_get_attachment_image_src($imageID, 'thumbnail');

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
                            <div class="compare" id="compare-<?php echo $loop->post->ID ?>">
                                <label for="checkbox-<?php echo $loop->post->ID ?>">Compare</label>
                                <input class="compare-checkbox" id="checkbox-<?php echo $loop->post->ID ?>" name="checkbox-<?php echo $loop->post->ID ?>" type="checkbox" value="<?php echo $loop->post->ID ?>">
                                <input type="hidden" name="product-image" value="<?php echo $thumbnailFile[0]; ?>" />
                                <input type="hidden" name="product-name" value="<?php the_title(); ?>" />
                            </div>
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

        <!-- include binding comparison js -->
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/gnu.bindingscompare.js"></script>

<?php get_footer(); ?>