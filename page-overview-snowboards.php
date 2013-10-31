<?php
/*
Template Name: Snowboards Overview
*/
get_header();
?>
        <div id="content">
            <div class="main-column pad-top">
                <div class="product-overview-page snowboards">
                    <?php /*<img src="<?php bloginfo('template_directory'); ?>/_/img/free-shipping.png" alt="Free Shipping - For a limited time only!" width="940" height="50" class="free-shipping-banner" />*/ ?>
                    <?php
                    if (isset($_GET["gender"])) {
                        $gender = $_GET["gender"];
                        if($gender == 'womens' || $gender == 'women' || $gender == 'female'){
                            getWomensHeader();
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

                    <h1 id="mens" class="deeplink-top-fix">Mens Snowboards</h1>
                    <ul class="product-listing">
                        <?php
                            // Get Mens
                            $args = array(
                                'post_type' => 'gnu_snowboards',
                                'posts_per_page' => -1,
                                'orderby' => 'menu_order',
                                'order' => 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'gnu_snowboard_categories',
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
                                $imageFile = wp_get_attachment_image_src($imageID, 'medium');

                                if($counter % 4 == 0){
                                    $class = "product-item last ";
                                }else{
                                    $class = "product-item";
                                }
                                $counter++;
                        ?>

                        <li class="<?php echo $class; ?>">
                            <a href="<? the_permalink(); ?>">
                                <div class="vertical-img">
                                    <img src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php the_title(); ?> Image" />
                                </div>
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
                    <div class="splitboards">
                        <h3>Mens Splitboards</h3>
                        <ul class="product-listing">
                            <?php
                                // Get Mens Splitboards
                                $args = array(
                                    'post_type' => 'gnu_snowboards',
                                    'posts_per_page' => -1,
                                    'orderby' => 'menu_order',
                                    'order' => 'ASC',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'gnu_snowboard_categories',
                                            'field' => 'slug',
                                            'terms' => 'mens-splitboards',
                                            'include_children' => false
                                        )
                                    )
                                );
                                $counter = 1;
                                $loop = new WP_Query( $args );
                                while ( $loop->have_posts() ) : $loop->the_post();
                                    $imageID = get_field('gnu_product_image');
                                    $imageFile = wp_get_attachment_image_src($imageID, 'medium');

                                    if($counter % 4 == 0){
                                        $class = "product-item last ";
                                    }else{
                                        $class = "product-item";
                                    }
                                    $counter++;
                            ?>

                            <li class="<?php echo $class; ?>">
                                <a href="<? the_permalink(); ?>">
                                    <div class="vertical-img">
                                        <img src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php the_title(); ?> Image" />
                                    </div>
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
                    </div>
                    <div class="youthboards">
                        <h3>Mens Youth</h3>
                        <ul class="product-listing">
                            <?php
                                // Get Mens Youth
                                $args = array(
                                    'post_type' => 'gnu_snowboards',
                                    'posts_per_page' => -1,
                                    'orderby' => 'menu_order',
                                    'order' => 'ASC',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'gnu_snowboard_categories',
                                            'field' => 'slug',
                                            'terms' => 'mens-youth',
                                            'include_children' => false
                                        )
                                    )
                                );
                                $counter = 1;
                                $loop = new WP_Query( $args );
                                while ( $loop->have_posts() ) : $loop->the_post();
                                    $imageID = get_field('gnu_product_image');
                                    $imageFile = wp_get_attachment_image_src($imageID, 'medium');

                                    if($counter % 4 == 0){
                                        $class = "product-item last ";
                                    }else{
                                        $class = "product-item";
                                    }
                                    $counter++;
                            ?>

                            <li class="<?php echo $class; ?>">
                                <a href="<? the_permalink(); ?>">
                                    <div class="vertical-img">
                                        <img src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php the_title(); ?> Image" />
                                    </div>
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
                    </div>
                    <div class="clear"></div>

                    <?php }; // getMens function ?>

                    <?php function getWomensHeader() { ?>
                    <div class="overview-header">
                        <p><strong>Make Magic!</strong> Gnu is focused on high performance women’s snowboard products; Mt Baker’s World Champion Amy Howatt worked with us in the 80s and super star Barrett Christy pushed design in the 90s. Today Barrett lives 5 miles from the factory and leads the Gnu women’s program. She worked with our design /production crew, her team and artists riding and refining boards to develop every magical board in this years line. Whether you are a first timer, an urban jibber, a freerider or an Olympic athlete; Barrett has put together the perfect combination of Gnu technologies, geometry and flex for you.</p>
                    </div>
                    <?php } // getWomensHeader function ?>

                    <?php function getWomens() { ?>

                    <h1 id="womens" class="deeplink-top-fix">Womens Snowboards</h1>
                    <ul class="product-listing">
                        <?php
                            // Get Womens
                            $args = array(
                                'post_type' => 'gnu_snowboards',
                                'posts_per_page' => -1,
                                'orderby' => 'menu_order',
                                'order' => 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'gnu_snowboard_categories',
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
                                $imageFile = wp_get_attachment_image_src($imageID, 'medium');

                                if($counter % 4 == 0){
                                    $class = "product-item last ";
                                }else{
                                    $class = "product-item";
                                }
                                $counter++;
                        ?>

                        <li class="<?php echo $class; ?>">
                            <a href="<? the_permalink(); ?>">
                                <div class="vertical-img">
                                    <img src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php the_title(); ?> Image" />
                                </div>
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
                    <div class="splitboards">
                        <h3>Womens Splitboards</h3>
                        <ul class="product-listing">
                            <?php
                                // Get Womens
                                $args = array(
                                    'post_type' => 'gnu_snowboards',
                                    'posts_per_page' => -1,
                                    'orderby' => 'menu_order',
                                    'order' => 'ASC',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'gnu_snowboard_categories',
                                            'field' => 'slug',
                                            'terms' => 'womens-splitboards',
                                            'include_children' => false
                                        )
                                    )
                                );
                                $counter = 1;
                                $loop = new WP_Query( $args );
                                while ( $loop->have_posts() ) : $loop->the_post();
                                    $imageID = get_field('gnu_product_image');
                                    $imageFile = wp_get_attachment_image_src($imageID, 'medium');

                                    if($counter % 4 == 0){
                                        $class = "product-item last ";
                                    }else{
                                        $class = "product-item";
                                    }
                                    $counter++;
                            ?>

                            <li class="<?php echo $class; ?>">
                                <a href="<? the_permalink(); ?>">
                                    <div class="vertical-img">
                                        <img src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php the_title(); ?> Image" />
                                    </div>
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
                    </div>
                    <div class="youthboards">
                        <h3>Womens Youth</h3>
                        <ul class="product-listing">
                            <?php
                                // Get Womens Youth
                                $args = array(
                                    'post_type' => 'gnu_snowboards',
                                    'posts_per_page' => -1,
                                    'orderby' => 'menu_order',
                                    'order' => 'ASC',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'gnu_snowboard_categories',
                                            'field' => 'slug',
                                            'terms' => 'womens-youth',
                                            'include_children' => false
                                        )
                                    )
                                );
                                $counter = 1;
                                $loop = new WP_Query( $args );
                                while ( $loop->have_posts() ) : $loop->the_post();
                                    $imageID = get_field('gnu_product_image');
                                    $imageFile = wp_get_attachment_image_src($imageID, 'medium');

                                    if($counter % 4 == 0){
                                        $class = "product-item last ";
                                    }else{
                                        $class = "product-item";
                                    }
                                    $counter++;
                            ?>

                            <li class="<?php echo $class; ?>">
                                <a href="<? the_permalink(); ?>">
                                    <div class="vertical-img">
                                        <img src="<?php echo $imageFile[0]; ?>" width="<?php echo $imageFile[1]; ?>" height="<?php echo $imageFile[2]; ?>" alt="<?php the_title(); ?> Image" />
                                    </div>
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
                    </div>
                    <div class="clear"></div>

                    <?php }; // end getWomens function ?>

                </div><!-- end product overview -->
            </div><!-- end .main-column -->
        </div><!-- end #content -->
<?php get_footer(); ?>