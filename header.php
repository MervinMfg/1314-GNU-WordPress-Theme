<?php
	// GET THE REGION
	getRegionCode();
	// GET THE PAGE TITLE
	$GLOBALS['pageTitle'] = "";
	if (function_exists('is_tag') && is_tag()) {
		$GLOBALS['pageTitle'] .= single_tag_title("Tag Archive for &quot;", false) . '&quot; - ';
	} elseif (is_archive()) {
		$GLOBALS['pageTitle'] .= wp_title('', false) . ' Archive - ';
	} elseif (is_search()) {
		$GLOBALS['pageTitle'] .= 'Search for &quot;'.esc_html($s).'&quot; - ';
	} elseif (!(is_404()) && (is_single()) || (is_page()) && !(is_front_page())) {
		$GLOBALS['pageTitle'] .= wp_title('-',false,'right');
	} elseif (is_404()) {
		$GLOBALS['pageTitle'] .=  'Not Found - ';
	}
	if (is_home() || is_front_page()) {
		$GLOBALS['pageTitle'] .= get_bloginfo('name') . ' - ' . get_bloginfo('description');
	} else {
		$GLOBALS['pageTitle'] .= get_bloginfo('name');
	}
	if ($paged>1) {
		$GLOBALS['pageTitle'] .=  ' - page '. $paged;
	}
	// SET DEFAULT PAGE IMAGE
	$GLOBALS['pageImage'] = get_bloginfo('template_directory') . "/_/img/fb-like.png";
	$pageDescriptionDefault = "GNU speed-entry performance bindings and snowboards handbuilt by snowboarders with jobs in the USA since 1977. Keep snowboarding weird!";
	// GET THE PAGE DESCRIPTION, AND IMAGE IF IT'S SINGLE
	if (is_single()) {
		if (have_posts()) {
			while (have_posts()) {
				the_post();
				$pageDescription = strip_tags(get_the_excerpt());
				// set page thumbnail now that we know we have a single post, used for FB likes
				$GLOBALS['pageImage'] = get_post_image('medium');
				$GLOBALS['pageImage'] = $GLOBALS['pageImage'][0];
			}
		} else {
			$pageDescription = $pageDescriptionDefault;
		}
	}else{
		if (!is_home() && !is_search()) {
			if (has_post_thumbnail($post->ID)) {
				$GLOBALS['pageImage'] = get_post_image('medium');
            	$GLOBALS['pageImage'] = $GLOBALS['pageImage'][0];
			}
        }
        if (have_posts() && !is_home()) {
        	while (have_posts()){
        		the_post();
				$pageDescription = strip_tags(get_the_excerpt());
				if($pageDescription == ""){
					$pageDescription = $pageDescriptionDefault;
				}
				// Check for club weird
				if($post->ID == "11674"):
				   $pageDescription = "Visit us at SIA. Join our experiment in weirdness at the Club Weird Photo Booth.";
				endif;
			}
        } else {
        	$pageDescription = $pageDescriptionDefault;
        }
	}
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?> itemscope itemtype="http://schema.org/Blog" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<!--
                                                                               GGGGGG        GGGGGGG
             GGG                                                               GGGGGG        GGGGGGG
            G GGGG              GGGGGGGGGGGGGGGGGGGGGG   GGGGGG       GGGGGGG  GGGGGG        GGGGGGG
           G   GGGG             GGGGGGGGGGGGGGGGGGGGGG   GGGGGGG      GGGGGGG  GGGGGG        GGGGGGG
         G    GGGGG  GG         GGGGGGGGGGGGGGGGGGGGGG   GGGGGGGG     GGGGGGG  GGGGGG        GGGGGGG
        G   GGGGG   GGGG        GGGGGGGGGGGGGGGGGGGGGG   GGGGGGGGG    GGGGGGG  GGGGGG        GGGGGGG
       G   GGGGG   G  GGGG      GGGGGGGGGGGGGGG          GGGGGGGGGG   GGGGGGG  GGGGGG        GGGGGGG
     G   GGGGG   G   GGGGGGG    GGGGGGG      GGGGGGGGG   GGGGGGGGGGG  GGGGGGG  GGGGGG        GGGGGGG
    G   GGGGG  GG  GGGG GGGGGG  GGGGGGG   GGGGGGGGGGGGG GGGGGGGGGGGGG GGGGGGG  GGGGGG        GGGGGGG
  GG   GGGGG  GG  GGGGG   GGGGGGGGGGGGG   GGGGGGGGGGGGG GGGGGGGGGGGGGGGGGGGG   GGGGGG        GGGGGGG
 G   GGGGG   G   GGGGG GG   GGGGGGGGGGG   GGGGGGGGGGGGG GGGGGGGGGGGGGGGGGGGG   GGGGGG        GGGGGGG
G   GGGGGGG    GG GGG    G  $GGGGGGGGGG   GGGGGGGGGGGGG GGGGGGGGGGGGGGGGGGGG   GGGGGG        GGGGGGG
 GG   GGGGGGG    GG    G   GGGGG GGGGGG         GGGGGGG GGGGGGG GGGGGGGGGGGG   GGGGGGGGGGGGGGGGGGGGG
   GG   GGGGGGO       G  GGGGGG  GGGGGG         GGGGGGG GGGGGGG  GGGGGGGGGGG   GGGGGGGGGGGGGGGGGGGGG
     G    GGGGGGO   GG  GGGGGG   GGGGGGGGGGGGGGGGGGGGGG GGGGGGG  GGGGGGGGGGG   GGGGGGGGGGGGGGGGGGGGG
       G    GGGGGGGG   GGGGG     GGGGGGGGGGGGGGGGGGGGGG GGGGGGG   GGGGGGGGGG   GGGGGGGGGGGGGGGGGGGGG
         G    GGGGGG GGGGGG      GGGGGGGGGGGGGGGGGGGGGG GGGGGGG    GGGGGGGGG   GGGGGGGGGGGGGGG
           G    GGG GGGGG        GGGGGGGGGGGGGGGGGGGGGG GGGGGGG     GGGGGGGG
             G    GGGGGG         GGGGGGGGG              GGGGGGG      GGGGGGG
               G   GGGG
                 G GG
                   G
-->
<head id="www-gnu-com" data-template-set="gnu-wordpress-theme" profile="http://gmpg.org/xfn/11">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"><!-- force latest IE rendering engine -->
	<meta charset="<?php bloginfo('charset'); ?>"><?php if (is_search()) { echo "\n\t"; ?><meta name="robots" content="noindex, nofollow" /><?php } echo "\n"; ?>
	<title><?php echo $GLOBALS['pageTitle']; ?></title>
	<meta name="title" content="<?php echo $GLOBALS['pageTitle']; ?>" />
	<meta name="description" content="<?php echo $pageDescription; ?>" />
	<meta name="keywords" content="GNU, snowboarding, snowboard, snowboards, Outerwear, Clothing, Apparel, Accessories, snow, snowboard technology, technology, mage-traction" />
	<meta name="author" content="GNU" />
	<meta name="Copyright" content="Copyright GNU <?php echo date('Y'); ?>. All Rights Reserved." />
	<!-- FB Meta Data -->
	<meta property="og:title" content="<?php echo $GLOBALS['pageTitle']; ?>" />
	<meta property="og:description" content="<?php echo $pageDescription; ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?php echo $GLOBALS['pageImage']; ?>" />
	<meta property="og:url" content="<? the_permalink(); ?>" />
	<meta property="og:site_name" content="GNU Snowboards" />
	<meta property="fb:app_id" content="217173258409585"/>
	<!-- Google+ Meta Data -->
	<meta itemprop="name" content="<?php echo $GLOBALS['pageTitle']; ?>" />
	<meta itemprop="description" content="<?php echo $pageDescription; ?>" />
	<meta itemprop="image" content="<?php echo $GLOBALS['pageImage']; ?>" />
	<!-- Google Site Verification -->
	<meta name="google-site-verification" content="6YUIRABPjekB2v-5E5jCD-uMTBL0rUjqGsQveG2_BL0" />
	<!--  Mobile Meta Info -->
	<meta name="viewport" content="width=960, maximum-scale=1.0" />
	<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/_/img/apple-touch-icon-precomposed.png" />
	<!-- Fav Icon -->
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/_/img/favicon.ico" />
	<!-- Styles -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
	<!-- Misc. -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<!-- all our JS is at the bottom of the page, except for Modernizr. -->
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/lib/modernizr-2.6.1.min.js"></script>
	<!-- WP Head -->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header id="header">
		<h1>
			<a href="<?php echo get_option('home'); ?>/" id="logo"><?php bloginfo('name'); ?></a>
		</h1>
		<div class="nav-primary-container">
			<nav id="nav-primary">
				<ul>
					<li><a href="/snowboards/" class="snowboards" id="snowboards">Snowboards</a></li>
					<li><a href="/bindings/" class="bindings" id="bindings">Bindings</a></li>
					<li><a href="/weirdwear/" class="weirdwear" id="weirdwear">Weirdwear</a></li>
					<li><a href="/team/" class="weirdos" id="weirdos">Weirdos</a></li>
					<li><a href="/blog/" class="glog" id="glog">Glog</a></li>
					<!--<li><a href="/cinema/" class="cinema">Cinema</a></li>-->
				</ul>
			</nav>
		</div>
		<div class="nav-secondary-container">		
			<nav id="nav-secondary">
				<ul>
					<li><a href="/about/">About</a></li>
					<!--<li><a href="/events/">Events</a></li>
					<li><a href="/environmental/">Environmental</a></li>-->
					<li><a href="/store-locator/">Store Locator</a></li>
				</ul>
				<?php
				/*
					wp_nav_menu(
						array(
							'menu' => 'secondary',
							'container' => 'false',
							'menu_class' => 'utility'
						)
					);
				*/
				?>
				<div id="quick-cart"><a href="/shopping-cart/"><span></span></a></div>
			</nav>
		</div>
		<div class="nav-dropdown-container-hide-overflow">
			<div class="nav-dropdown-container">
				<div class="nav-dropdown">
					<nav class="nav-dropdown-snowboards">
						<div class="nav-column">
							<h3>Mens</h3>
							<a href="/snowboards/?gender=mens" class="view-all">View All</a>
							<ul>
								<?php
									// get navigation for mens snowboards
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
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
							<h4>Splitboards</h4>
							<ul>
								<?php
									// get navigation for mens splitboards snowboards
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
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
							<h4>Youth</h4>
							<ul>
								<?php
									// get navigation for mens youth snowboards
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
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
						</div>
						<div class="nav-column">
							<h3>Womens</h3>
							<a href="/snowboards/?gender=womens" class="view-all">View All</a>
							<ul>
								<?php
									// get navigation for womens snowboards
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
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
							<h4>Splitboards</h4>
							<ul>
								<?php
									// get navigation for womens splitboard snowboards
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
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
							<h4>Youth</h4>
							<ul>
								<?php
									// get navigation for womens youth snowboards
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
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
						</div>
						<div class="nav-column">
							<h3>Accessories</h3>
							<a href="/accessories/" class="view-all">View All</a>
							<ul>
								<?php
									// get navigation for accessories
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
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
						</div>
						<div class="nav-column-featured">
							<?php
								// get random snowboard
								$args = array(
									'post_type' => 'gnu_snowboards',
									'posts_per_page' => 1,
									'orderby' => 'rand'
								);
								$loop = new WP_Query( $args );
								while ( $loop->have_posts() ) : $loop->the_post();
									$title = get_the_title();
									$linkUrl = get_permalink();
									$imageID = get_field('gnu_product_image');
                                	$imageFile = wp_get_attachment_image_src($imageID, 'overview-thumb');
                                	$slogan = get_field('gnu_product_slogan');
									echo "<a href=\"$linkUrl\"><h3>Weird Alert</h3><div class=\"featured-slogan\"><h5>$title</h5>$slogan</div><div class=\"featured-image-container\"><div class=\"featured-image\"><img src=\"$imageFile[0]\" width=\"$imageFile[1]\" height=\"$imageFile[2]\" alt=\"$title Snowboard\" /></div></div></a>";
								endwhile;
								wp_reset_query();
							?>
						</div>
					</nav><!-- end .nav-dropdown-snowboards -->

					<nav class="nav-dropdown-bindings">
						<div class="nav-column">
							<h3>Mens</h3>
							<a href="/bindings/?gender=mens" class="view-all">View All</a>
							<ul>
								<?php
									// get navigation for mens bindings
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
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
						</div>
						<div class="nav-column">
							<h3>Womens</h3>
							<a href="/bindings/?gender=womens" class="view-all">View All</a>
							<ul>
								<?php
									// get navigation for womens womens bindings
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
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
						</div>
						<div class="nav-column">
							<h3>Youth</h3>
							<ul>
								<?php
									// get navigation for youth bindings
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
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
							<h3>Support</h3>
							<ul>
								<li><a href="/support/binding-faqs/">FAQs</a></li>
								<li><a href="/support/videos/">How to Videos</a></li>
								<li><a href="/support/bindings-manual/">Manual</a></li>
								<li><a href="/support/replacement-parts/">Replacement Parts</a></li>
								<li><a href="/support/contact/">Contact</a></li>
								<li><a href="/support/warranty/">Warranty</a>
								<li class="no-international"><a href="/support/recall/">Recall</a>
							</ul>
						</div>
						<div class="nav-column-featured">
							<?php
								// get random binding
								$args = array(
									'post_type' => 'gnu_bindings',
									'posts_per_page' => 1,
									'orderby' => 'rand'
								);
								$loop = new WP_Query( $args );
								while ( $loop->have_posts() ) : $loop->the_post();
									$title = get_the_title();
									$linkUrl = get_permalink();
									$imageID = get_field('gnu_product_image');
                                	$imageFile = wp_get_attachment_image_src($imageID, 'thumbnail');
                                	$slogan = get_field('gnu_product_slogan');
									echo "<a href=\"$linkUrl\"><h3>Weird Alert</h3><div class=\"featured-slogan\"><h5>$title</h5>$slogan</div><div class=\"featured-image-container\"><div class=\"featured-image\"><img src=\"$imageFile[0]\" width=\"$imageFile[1]\" height=\"$imageFile[2]\" alt=\"$title Snowboard\" /></div></div></a>";
								endwhile;
								wp_reset_query();
							?>
						</div>
					</nav><!-- end .nav-dropdown-bindings -->

					<nav class="nav-dropdown-weirdwear">
						<div class="nav-column">
							<h3>Mens Apparel</h3>
							<a href="/weirdwear/#mens-apparel" class="view-all">View All</a>
							<ul>
								<?php
									// get navigation for weirdwear mens apparel
									$args = array(
										'post_type' => 'gnu_weirdwear',
										'posts_per_page' => -1,
										'orderby' => 'menu_order',
										'order' => 'ASC',
										'tax_query' => array(
											array(
												'taxonomy' => 'gnu_weirdwear_categories',
												'field' => 'slug',
												'terms' => 'mens-apparel',
												'include_children' => false
											)
										)
									);
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
						</div>
						<div class="nav-column">
							<h3>Outerwear</h3>
							<a href="/weirdwear/#outerwear" class="view-all">View All</a>
							<ul>
								<?php
									// get navigation for outerwear
									$args = array(
										'post_type' => 'gnu_weirdwear',
										'posts_per_page' => -1,
										'orderby' => 'menu_order',
										'order' => 'ASC',
										'tax_query' => array(
											array(
												'taxonomy' => 'gnu_weirdwear_categories',
												'field' => 'slug',
												'terms' => 'outerwear',
												'include_children' => false
											)
										)
									);
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
						</div>
						<div class="nav-column">
							<h3>Sale Apparel</h3>
							<a href="/weirdwear/#sale-apparel" class="view-all">View All</a>
							<ul>
								<?php
									// get navigation for weirdwear sale apparel
									$args = array(
										'post_type' => 'gnu_weirdwear',
										'posts_per_page' => -1,
										'orderby' => 'menu_order',
										'order' => 'ASC',
										'tax_query' => array(
											array(
												'taxonomy' => 'gnu_weirdwear_categories',
												'field' => 'slug',
												'terms' => 'sale-apparel',
												'include_children' => false
											)
										)
									);
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post();
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
						</div>
						<div class="nav-column-featured">
							<?php
								// get random apparel
								$args = array(
									'post_type' => 'gnu_weirdwear',
									'posts_per_page' => 1,
									'orderby' => 'rand',
									'tax_query' => array(
										array(
											'taxonomy' => 'gnu_weirdwear_categories',
											'field' => 'slug',
											'terms' => 'mens-apparel',
											'include_children' => false
										)
									)
								);
								$loop = new WP_Query( $args );
								while ( $loop->have_posts() ) : $loop->the_post();
									$title = get_the_title();
									$linkUrl = get_permalink();
									$imageID = get_field('gnu_product_image');
                                	$imageFile = wp_get_attachment_image_src($imageID, 'thumbnail');
                                	$slogan = get_field('gnu_product_slogan');
									echo "<a href=\"$linkUrl\"><h3>Weird Alert</h3><div class=\"featured-slogan\"><h5>$title</h5>$slogan</div><div class=\"featured-image-container\"><div class=\"featured-image\"><img src=\"$imageFile[0]\" width=\"$imageFile[1]\" height=\"$imageFile[2]\" alt=\"$title Snowboard\" /></div></div></a>";
								endwhile;
								wp_reset_query();
							?>
						</div>
					</nav><!-- end .nav-dropdown-weirdwear -->

					<nav class="nav-dropdown-weirdos">
						<div class="nav-column">
							<h3>Mens Pro</h3>
							<a href="/team/#mens-pro" class="view-all">View All</a>
							<ul>
								<?php
									// get navigation for outerwear
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
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
							<h3>Mens Euro Pro</h3>
							<a href="/team/#mens-euro-pro" class="view-all">View All</a>
							<ul>
								<?php
									// get navigation for outerwear
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
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
						</div>
						<div class="nav-column">
							<h3>Mens Ams</h3>
							<a href="/team/#mens-ams" class="view-all">View All</a>
							<ul>
								<?php
									// get navigation for outerwear
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
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
						</div>
						<div class="nav-column">
							<h3>Womens Pro</h3>
							<a href="/team/#womens-pro" class="view-all">View All</a>
							<ul>
								<?php
									// get navigation for outerwear
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
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
						</div>
						<div class="nav-column">
							<h3>Womens Ams</h3>
							<a href="/team/#womens-ams" class="view-all">View All</a>
							<ul>
								<?php
									// get navigation for outerwear
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
										echo '<li><a href="'. get_permalink() .'">' . get_the_title() . '</a></li>';
									endwhile;
									wp_reset_query();
								?>
							</ul>
						</div>
					</nav><!-- end .nav-dropdown-weirdos -->

					<div class="clear"></div>
				</div>
				<div class="nav-dropdown-footer">
					<div class="dropdown-close-wrapper"><a href="#">Close</a></div>
				</div>
			</div>
		</div>
	</header><!-- end #header -->
	<div class="content-wrapper">