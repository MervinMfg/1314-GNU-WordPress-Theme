<?php

if ( function_exists( 'add_theme_support' ) ) { 
    // additional image sizes
    // delete the next line if you do not need additional image sizes
    //add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)

    // Add RSS links to <head> section
    add_theme_support( 'automatic-feed-links' );
    // add featured image/thumbnail support
    add_theme_support('post-thumbnails');
    // post formats for blog entries
    add_theme_support( 'post-formats', array('gallery', 'link', 'image', 'quote', 'audio', 'chat', 'video')); // Add 3.1 post format theme support.
}

if ( function_exists( 'add_image_size' ) ) {
    // additional image sizes
    add_image_size('blog-thumb', 300, 170, true);
    add_image_size('home-blog-thumb', 192, 192, true);
    add_image_size('overview-thumb', 220, 220, true);
    add_image_size('snowboard-detail', 340, 715, true);
    add_image_size('square-medium', 300, 300, true);
}

// update auto embed sizes for videos
function new_embed_size() {
    return array( 'width' => 640, 'height' => 600 );
}
add_filter( 'embed_defaults', 'new_embed_size' );

// Clean up the <head>
function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

// register a sidebar for blog
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => __('Sidebar Widgets','gnublog' ),
        'id'   => 'sidebar-widgets',
        'description'   => __( 'These are widgets for the sidebar.','gnublog' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
}

// customize what is searchable
function filter_search($query) {
    if ($query->is_search) {
        $query->set('post_type', array('post')); // set it to blog posts only
    };
    return $query;
};
if(!is_admin()){
    add_filter('pre_get_posts', 'filter_search');
}

// Puts link in excerpts more tag
function new_excerpt_more($more) {
    global $post;
    //return '... <a class="moretag" href="'. get_permalink($post->ID) . '">Continue Reading</a>';
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// default excerpt length
function new_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');
// custom excerpt length for home page
function gnu_excerptlength_home($length) {
    return 30;
}
// custom excerpt length for home page
function gnu_excerptlength_blog($length) {
    return 16;
}
function gnu_excerpt($length_callback='gnu_excerptlength_home', $echo = true) {
    global $post;
    add_filter('excerpt_length', $length_callback);
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    if($echo == true) {
        echo $output;
    }else{
        return $output;
    }
}

// removes auto paragraph wrapper
remove_filter('the_excerpt', 'wpautop');
//remove_filter('the_content', 'wpautop');

// Get Custom Field Template Values
function getCustomField($theField) {
    global $post;
    $block = get_post_meta($post->ID, $theField);
    if($block){
        foreach(($block) as $blocks) {
            return $blocks;
        }
    }
}

// get the featured image of a post in a specified size, if no featured image set grab 1st image in post, if no image return default
function get_post_image($imageSize = "thumbnail", $imageName = "") {
    global $post;
    if ($imageName == "") {
        // just getting default thumbnail for post
        if ( has_post_thumbnail() ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $imageSize);
        }else{
            if ( get_field('gnu_product_image') != "" ) {
                $image = get_field('gnu_product_image');
                $image = wp_get_attachment_image_src($image, $imageSize, false);
            } else {
                $files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image');
                if($files){
                    $keys = array_reverse(array_keys($files));
                    $j=0;
                    $num = $keys[$j];
                    $image = wp_get_attachment_image_src($num, $imageSize, false);
                }else if($imageSize == "blog-thumb"){
                    $image = array(get_bloginfo('template_url')."/_/img/blog-stock-thumb-medium.jpg",300,170);
                }else{
                    // if no image is found and size is anything but the blog-thumb, default to the small thumbnail
                    $image = array(get_bloginfo('template_url')."/_/img/blog-stock-thumb.jpg",100,100);
                }
            }
        }
    } else {
        // getting a specific image for the post
        $image = get_post_meta($post->ID, $imageName, true);
        $image = wp_get_attachment_image_src($image, $imageSize, false);
    }
    return $image;
}

// Function to display related products on product detail pages
function display_related_products($language){
    // display additional products
    $post_objects = get_field('gnu_product_related');
    if( $post_objects ):
        echo "<section class=\"product-related clearfix\">\n";
        $relatedProducts = Array();
        // get each related product
        foreach( $post_objects as $post_object):
            $postType = $post_object->post_type;
            // get variable values
            $imageID = get_field('gnu_product_image', $post_object->ID);
            // check which image size to use based on post type
            $relatedImage = wp_get_attachment_image_src($imageID, 'overview-thumb');
            $relatedLink = get_permalink($post_object->ID);
            $relatedTitle = get_the_title($post_object->ID);
            // get price
            $relatedPrice = getDisplayPrice(get_field('gnu_product_price_us', $post_object->ID), get_field('gnu_product_price_ca', $post_object->ID), get_field('gnu_product_on_sale', $post_object->ID), get_field('gnu_product_sale_percentage', $post_object->ID));
            // add to related product array
            array_push($relatedProducts, Array($relatedTitle, $relatedLink, $relatedImage, $relatedPrice));
        endforeach;
        // randomly sort related products array
        shuffle($relatedProducts);
        // render out max of 4 related products
        echo "<h2>Suggested Products</h2>\n<ul>\n";
        // loop through products
        for($i = 0; $i < count($relatedProducts); ++$i) {
            if($i == 4){
                break;
            }
            // give the 4th product a class of last
            if(($i + 1) % 4 == 0){
                $relatedClass = "product-item last";
            }else{
                $relatedClass = "product-item";
            }
            echo '<li class="'. $relatedClass .'"><a href="'. $relatedProducts[$i][1] .'"><img src="'.$relatedProducts[$i][2][0].'" width="'.$relatedProducts[$i][2][1].'" height="'.$relatedProducts[$i][2][2].'" /><h4>' . $relatedProducts[$i][0] . '</h4><p>' . $relatedProducts[$i][3] . '</p></a></li>';
        }
        echo "</ul>\n";
        echo "</section>\n";
    endif;
}

function getRegionCode () {
    if (isset($_COOKIE["GNURegion"])){
        if($_COOKIE["GNURegion"] == "ca"){
            $GLOBALS['language'] = "ca";
        } else if($_COOKIE["GNURegion"] == "int"){
            $GLOBALS['language'] = "int";
        } else{
            $GLOBALS['language'] = "us";
        }
    }else{
        $GLOBALS['language'] = "us";
    }
    return $GLOBALS['language'];
}

// function to determine the proper size to display for bindings
function bindingSizeLookup ($sizeString, $verbose = true) {
    $returnString = "";
    switch ($sizeString) {
        case "XS (US 1-4)":
            if ($verbose) {
                $returnString = "XS (US 1-4), (MP 19-22)";
            } else {
                $returnString = "XS";
            }
            break;
        case "S (US W 5-7)":
            if ($verbose) {
                $returnString = "S (US W 5-7), (MP 22-24)";
            } else {
                $returnString = "S";
            }
            break;
        case "S (US M 4-7)":
            if ($verbose) {
                $returnString = "S (US M 4-7), (MP 22-25)";
            } else {
                $returnString = "S";
            }
            break;
        case "S (US M 6-8), S (US W 7-9)":
            if ($verbose) {
                $returnString = "S (US M 6-8), S (US W 7-9)";
            } else {
                $returnString = "S";
            }
            break;
        case "S/M (US W 4-7)":
            if ($verbose) {
                $returnString = "S/M (US W 4-7), (MP 21-24)";
            } else {
                $returnString = "S/M";
            }
            break;
        case "S/M (US M 5-9)":
            if ($verbose) {
                $returnString = "S/M (US M 5-9)";
            } else {
                $returnString = "S/M";
            }
            break;
        case "M (US W 7-9)":
            if ($verbose) {
                $returnString = "M (US W 7-9), (MP 24-26)";
            } else {
                $returnString = "M";
            }
            break;
        case "M (US M 7-9)":
            if ($verbose) {
                $returnString = "M (US M 7-9), (MP 25-27)";
            } else {
                $returnString = "M";
            }
            break;
        case "M (US M 7-10)":
            if ($verbose) {
                $returnString = "M (US M 7-10), (MP 25-28)";
            } else {
                $returnString = "M";
            }
            break;
        case "M (US M 8.5-11), W (US W 8+)":
            if ($verbose) {
                $returnString = "M (US M 8.5-11), W (US W 8+)";
            } else {
                $returnString = "M";
            }
            break;            
        case "M/L (US W 6-9)":
            if ($verbose) {
                $returnString = "M/L (US W 6-9), (MP 23-26)";
            } else {
                $returnString = "M/L";
            }
            break;
        case "M/L (US M 9-14)":
            if ($verbose) {
                $returnString = "M/L (US M 9-14)";
            } else {
                $returnString = "M/L";
            }
            break;
        case "L (US W 9-10)":
            if ($verbose) {
                $returnString = "L (US W 9-10), (MP 26-27)";
            } else {
                $returnString = "L";
            }
            break;
        case "L (US M 9-11)":
            if ($verbose) {
                $returnString = "L (US M 9-11), (MP 27-29)";
            } else {
                $returnString = "L";
            }
            break;
        case "L (US M 9-12)":
            if ($verbose) {
                $returnString = "L (US M 9-12), (MP 27-30)";
            } else {
                $returnString = "L";
            }
            break;
        case "L (US M 11.5-13)":
            if ($verbose) {
                $returnString = "L (US M 11.5-13)";
            } else {
                $returnString = "L";
            }
            break;
        case "XL (US M 11-14)":
            if ($verbose) {
                $returnString = "XL (US M 11-14), (MP 29-32)";
            } else {
                $returnString = "XL";
            }
            break;
    }
    return $returnString;
}

// GET PRICE DISPLAY
function getDisplayPrice ($usPrice, $caPrice, $sale, $salePercent) {
    $price = "";
    if($GLOBALS['language'] == "ca"){
        if ($sale == "Yes") {
            $price = '<p class="ca-price strike"><span>$' . $caPrice . '</span> CAD</p><p class="ca-price"><span>$' . round($caPrice * ((100 - $salePercent) / 100), 2) . '</span> CAD (' . $salePercent . '% off)</p>';
        } else {
            $price = '<p class="ca-price"><span>$' . $caPrice . '</span> CAD</p>';
        }
    } else {
        if ($sale == "Yes") {
            $price = '<p class="us-price strike"><span>$' . $usPrice . '</span> USD</p><p class="us-price"><span>$' . round($usPrice * ((100 - $salePercent) / 100), 2) . '</span> USD (' . $salePercent . '% off)</p>';
        } else {
            $price = '<p class="us-price"><span>$' . $usPrice . '</span> USD</p>';
        }
    }
    return $price;
}

/*
// allow skateboards to be accessed by tag
function rewrite_custom_urls() {  
    //add_rewrite_rule("^skateboards/([^/]+)/([^/]+)/?",'index.php?post_type=libtech_skateboards&libtech_skateboard_categories=$matches[1]&libtech_skateboards=$matches[2]','top');  
    add_rewrite_rule("^weirdwear/(t-shirt-specifications)/?",'index.php?p=10151','top');
}  
add_action('init','rewrite_custom_urls');  
// set up generated permalinks for skateboards to contain category
*/

/******************************
CODE FOR CUSTOM POST TYPES
******************************/
// order menus for custom post types
function set_custom_post_types_admin_order($wp_query) {  
  if (is_admin()) {  
    $post_type = $wp_query->query['post_type'];
    if ( $post_type == 'gnu_snowboards' || $post_type == 'gnu_bindings' || $post_type == 'gnu_accessories' || $post_type == 'gnu_weirdwear' || $post_type == 'gnu_technology' || $post_type == 'gnu_awards' || $post_type == 'gnu_team' ) { 
      $wp_query->set('orderby', 'menu_order');  
      $wp_query->set('order', 'ASC');  
    }  
  }  
}  
add_filter('pre_get_posts', 'set_custom_post_types_admin_order');  

// SET UP CUSTOM POST TYPES
function register_custom_post_types() {
    // START SNOWBOARDS
    $labels = array(
        'name' => _x('Snowboards', 'post type general name'),
        'singular_name' => _x('Snowboard', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_snowboards'),
        'add_new_item' => __('Add New Snowboard'),
        'edit_item' => __('Edit Snowboard'),
        'new_item' => __('New Snowboard'),
        'all_items' => __('All Snowboards'),
        'view_item' => __('View Snowboard'),
        'search_items' => __('Search Snowboards'),
        'not_found' =>  __('No Snowboard Found'),
        'not_found_in_trash' => __('No Snowbaords Found In Trash'), 
        'parent_item_colon' => '',
        'menu_name' => 'Snowboards'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => array("slug" => "snowboards"),
        'capability_type' => 'page',
        'has_archive' => false, 
        'hierarchical' => true,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes', 'comments' )
    ); 
    register_post_type('gnu_snowboards',$args);
    // start taxonamy for Snowboards
    $labels = array(
        'name'                          => 'Categories',
        'singular_name'                 => 'Category',
        'search_items'                  => 'Search Category',
        'popular_items'                 => 'Popular Categories',
        'all_items'                     => 'All Categories',
        'parent_item'                   => 'Parent Category',
        'edit_item'                     => 'Edit Category',
        'update_item'                   => 'Update Category',
        'add_new_item'                  => 'Add New Category',
        'new_item_name'                 => 'New Category',
        'separate_items_with_commas'    => 'Separate Categories with commas',
        'add_or_remove_items'           => 'Add or remove Categories',
        'choose_from_most_used'         => 'Choose from most used Categories'
    );
    $args = array(
        'label'                         => 'Categories',
        'labels'                        => $labels,
        'public'                        => true,
        'hierarchical'                  => true,
        'show_ui'                       => true,
        'show_in_nav_menus'             => true,
        'args'                          => array( 'orderby' => 'term_order' ),
        'query_var'                     => true
    );
    register_taxonomy( 'gnu_snowboard_categories', 'gnu_snowboards', $args );
    // END SNOWBOARDS

    // START BINDINGS
    $labels = array(
        'name' => _x('Bindings', 'post type general name'),
        'singular_name' => _x('Binding', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_bindings'),
        'add_new_item' => __('Add New Binding'),
        'edit_item' => __('Edit Binding'),
        'new_item' => __('New Binding'),
        'all_items' => __('All Bindings'),
        'view_item' => __('View Binding'),
        'search_items' => __('Search Bindings'),
        'not_found' =>  __('No Binding Found'),
        'not_found_in_trash' => __('No Bindings Found In Trash'), 
        'parent_item_colon' => '',
        'menu_name' => 'Bindings'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => array("slug" => "bindings"),
        'capability_type' => 'page',
        'has_archive' => false, 
        'hierarchical' => true,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes', 'comments' )
    ); 
    register_post_type('gnu_bindings',$args);
    // start taxonamy for Bindings
    $labels = array(
        'name'                          => 'Categories',
        'singular_name'                 => 'Category',
        'search_items'                  => 'Search Category',
        'popular_items'                 => 'Popular Categories',
        'all_items'                     => 'All Categories',
        'parent_item'                   => 'Parent Category',
        'edit_item'                     => 'Edit Category',
        'update_item'                   => 'Update Category',
        'add_new_item'                  => 'Add New Category',
        'new_item_name'                 => 'New Category',
        'separate_items_with_commas'    => 'Separate Categories with commas',
        'add_or_remove_items'           => 'Add or remove Categories',
        'choose_from_most_used'         => 'Choose from most used Categories'
    );
    $args = array(
        'label'                         => 'Categories',
        'labels'                        => $labels,
        'public'                        => true,
        'hierarchical'                  => true,
        'show_ui'                       => true,
        'show_in_nav_menus'             => true,
        'args'                          => array( 'orderby' => 'term_order' ),
        'query_var'                     => true
    );
    register_taxonomy( 'gnu_bindings_categories', 'gnu_bindings', $args );
    // END BINDINGS

    // START ACCESSORIES
    $labels = array(
        'name' => _x('Accessories', 'post type general name'),
        'singular_name' => _x('Accessory', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_accessories'),
        'add_new_item' => __('Add New Accessory'),
        'edit_item' => __('Edit Accessory'),
        'new_item' => __('New Accessory'),
        'all_items' => __('All Accessories'),
        'view_item' => __('View Accessory'),
        'search_items' => __('Search Accessories'),
        'not_found' =>  __('No Accessories Found'),
        'not_found_in_trash' => __('No Accessories Found In Trash'), 
        'parent_item_colon' => '',
        'menu_name' => 'Accessories'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => array("slug" => 'accessories'),
        'capability_type' => 'page',
        'has_archive' => false, 
        'hierarchical' => true,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes', 'comments' )
    ); 
    register_post_type('gnu_accessories',$args);
    // start taxonamy for Accessories
    $labels = array(
        'name'                          => 'Categories',
        'singular_name'                 => 'Category',
        'search_items'                  => 'Search Category',
        'popular_items'                 => 'Popular Categories',
        'all_items'                     => 'All Categories',
        'parent_item'                   => 'Parent Category',
        'edit_item'                     => 'Edit Category',
        'update_item'                   => 'Update Category',
        'add_new_item'                  => 'Add New Category',
        'new_item_name'                 => 'New Category',
        'separate_items_with_commas'    => 'Separate Categories with commas',
        'add_or_remove_items'           => 'Add or remove Categories',
        'choose_from_most_used'         => 'Choose from most used Categories'
    );
    $args = array(
        'label'                         => 'Categories',
        'labels'                        => $labels,
        'public'                        => true,
        'hierarchical'                  => true,
        'show_ui'                       => true,
        'show_in_nav_menus'             => true,
        'args'                          => array( 'orderby' => 'term_order' ),
        //'rewrite'                       => array( 'slug' => 'outerwear' ),
        'query_var'                     => true
    );
    register_taxonomy( 'gnu_accessories_categories', 'gnu_accessories', $args );
    // END ACCESSORIES

    // START WEIRDWEAR
    $labels = array(
        'name' => _x('Weirdwear', 'post type general name'),
        'singular_name' => _x('Weirdwear', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_weirdwear'),
        'add_new_item' => __('Add New Weirdwear'),
        'edit_item' => __('Edit Weirdwear'),
        'new_item' => __('New Weirdwear'),
        'all_items' => __('All Weirdwear'),
        'view_item' => __('View Weirdwear'),
        'search_items' => __('Search Weirdwear'),
        'not_found' =>  __('No Weirdwear Found'),
        'not_found_in_trash' => __('No Weirdwear Found In Trash'), 
        'parent_item_colon' => '',
        'menu_name' => 'Weirdwear'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => array("slug" => 'weirdwear'),
        'capability_type' => 'page',
        'has_archive' => false, 
        'hierarchical' => true,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes', 'comments' )
    ); 
    register_post_type('gnu_weirdwear',$args);
    // start taxonamy for Weirdwear
    $labels = array(
        'name'                          => 'Categories',
        'singular_name'                 => 'Category',
        'search_items'                  => 'Search Category',
        'popular_items'                 => 'Popular Categories',
        'all_items'                     => 'All Categories',
        'parent_item'                   => 'Parent Category',
        'edit_item'                     => 'Edit Category',
        'update_item'                   => 'Update Category',
        'add_new_item'                  => 'Add New Category',
        'new_item_name'                 => 'New Category',
        'separate_items_with_commas'    => 'Separate Categories with commas',
        'add_or_remove_items'           => 'Add or remove Categories',
        'choose_from_most_used'         => 'Choose from most used Categories'
    );
    $args = array(
        'label'                         => 'Categories',
        'labels'                        => $labels,
        'public'                        => true,
        'hierarchical'                  => true,
        'show_ui'                       => true,
        'show_in_nav_menus'             => true,
        'args'                          => array( 'orderby' => 'term_order' ),
        //'rewrite'                       => array( 'slug' => 'outerwear' ),
        'query_var'                     => true
    );
    register_taxonomy( 'gnu_weirdwear_categories', 'gnu_weirdwear', $args );
    // END WEIRDWEAR

    // START TECHNOLOGY
    $labels = array(
        'name' => _x('Technology', 'post type general name'),
        'singular_name' => _x('Technology', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_technology'),
        'add_new_item' => __('Add New Tech Item'),
        'edit_item' => __('Edit Tech Item'),
        'new_item' => __('New Technology'),
        'all_items' => __('All Technology'),
        'view_item' => __('View Tech Item'),
        'search_items' => __('Search Technology'),
        'not_found' =>  __('No Tech Item Found'),
        'not_found_in_trash' => __('No Technology Found In Trash'), 
        'parent_item_colon' => '',
        'menu_name' => 'Technology'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => array("slug" => "technology"),
        'capability_type' => 'page',
        'has_archive' => false, 
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes' )
    ); 
    register_post_type('gnu_technology',$args);
    // END TECHNOLOGY

    // START AWARDS
    $labels = array(
        'name' => _x('Awards', 'post type general name'),
        'singular_name' => _x('Award', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_awards'),
        'add_new_item' => __('Add New Award'),
        'edit_item' => __('Edit Award'),
        'new_item' => __('New Award'),
        'all_items' => __('All Awards'),
        'view_item' => __('View Award'),
        'search_items' => __('Search Awards'),
        'not_found' =>  __('No Award Found'),
        'not_found_in_trash' => __('No Awards Found In Trash'), 
        'parent_item_colon' => '',
        'menu_name' => 'Awards'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => array("slug" => "awards"),
        'capability_type' => 'page',
        'has_archive' => false, 
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'page-attributes' )
    ); 
    register_post_type('gnu_awards',$args);
    // END AWARDS

    // START TEAM
    $labels = array(
        'name' => _x('Team', 'post type general name'),
        'singular_name' => _x('Team Member', 'post type singular name'),
        'add_new' => _x('Add Team Member', 'gnu_team'),
        'add_new_item' => __('Add New Team Member'),
        'edit_item' => __('Edit Team Member'),
        'new_item' => __('New Team Member'),
        'all_items' => __('All Team Members'),
        'view_item' => __('View Team Member'),
        'search_items' => __('Search Team'),
        'not_found' =>  __('No Team Member Found'),
        'not_found_in_trash' => __('No Team Member Found In Trash'), 
        'parent_item_colon' => '',
        'menu_name' => 'Team'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => array("slug" => "team"),
        'capability_type' => 'page',
        'has_archive' => false, 
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes' )
    ); 
    register_post_type('gnu_team',$args);
    // start taxonamy for Team
    $labels = array(
        'name'                          => 'Team Categories',
        'singular_name'                 => 'Team Category',
        'search_items'                  => 'Search Team Catagories',
        'popular_items'                 => 'Popular Team Categories',
        'all_items'                     => 'All Team Categories',
        'parent_item'                   => 'Parent Team Category',
        'edit_item'                     => 'Edit Team Category',
        'update_item'                   => 'Update Team Category',
        'add_new_item'                  => 'Add New Team Category',
        'new_item_name'                 => 'New Team Category',
        'separate_items_with_commas'    => 'Separate Team Categories with commas',
        'add_or_remove_items'           => 'Add or remove Team Categories',
        'choose_from_most_used'         => 'Choose from most used Team Categories'
    );
    $args = array(
        'label'                         => 'Team Categories',
        'labels'                        => $labels,
        'public'                        => true,
        'hierarchical'                  => true,
        'show_ui'                       => true,
        'show_in_nav_menus'             => true,
        'args'                          => array( 'orderby' => 'term_order' ),
        //'rewrite'                       => array( 'slug' => 'outerwear' ),
        'query_var'                     => true
    );
    register_taxonomy( 'gnu_team_categories', 'gnu_team', $args );
    // END TEAM
}
// run the registration
add_action( 'init', 'register_custom_post_types' );
?>