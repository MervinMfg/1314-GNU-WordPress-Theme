<?php
/*
Template Name: Snowboards Overview
*/
get_header();
?>
        <div id="content">
            <div class="main-column pad-top">

                <div class="product-overview-page snowboards">
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
                    </div>
                    <div class="clear"></div>

                    <?php }; // getMens function ?>

                    <?php function getWomensHeader() { ?>
                    <div class="overview-header womens-snowboards">
                        <div class="header-video">
                            <iframe src="http://player.vimeo.com/video/43508719?title=0&amp;byline=0&amp;portrait=0&amp;color=99cc33" width="462" height="260" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                        </div>
                        <p>From the beginning gnu has focused on working with the world’s best female riders to create snowboards that make every day on edge a magical experience. From 80's World Champion Amy Howat and 90's X Games and US Open champion Barrett Christy to current u-ditch champion Kaitlyn Farrington, GNU ladies have amassed more awards and podium appearances than any other woman's snowboard brand over the past three decades.</p>
                        <p>A family affair, Barrett Christy now oversee's the Gnu Girls Division, working closely with the team riders to give our designers and machinists unmatched insight into the subtle nuances that transform women's snowboards from functional to fantasy.</p>
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
                    </div>
                    <div class="clear"></div>

                    <?php }; // end getWomens function ?>

                </div><!-- end product overview -->
            </div><!-- end .main-column -->
        </div><!-- end #content -->
<?php get_footer(); ?>