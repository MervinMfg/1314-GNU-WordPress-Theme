<?php
/*
Template Name: LBS Template
*/
get_header();
?>

		<!-- Google Tag Manager -->
		<noscript>
			<iframe src="//www.googletagmanager.com/ns.html?id=GTM-MGQ2SK" height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>
		<script>
			(function(w,d,s,l,i){
				w[l]=w[l]||[];
				w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});
				var f=d.getElementsByTagName(s)[0], j=d.createElement(s), dl=l!='dataLayer'?'&l='+l:'';
				j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;
				f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-MGQ2SK');
		</script>
		<!-- End Google Tag Manager -->
		<div id="content">
			<div class="main-column pad-top">
				<section class="lbs-header">
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
					<ul class="entry-share">
						<li><div class="fb-like" data-href="<? the_permalink(); ?>" data-send="true" data-layout="button_count" data-width="150" data-action="like" data-show-faces="false" data-share="true" data-colorscheme="dark"></div></li>
						<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="GNUsnowboards">Tweet</a></li>
						<li><div class="g-plusone" data-size="medium" data-href="<? the_permalink(); ?>"></div></li>
						<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
					</ul>
					<div class="clearfix"></div>
				</section>
				<section class="lbs-updates">
					<?php
						// display video if we have an id
						$videoID = get_field('gnu_lbs_video_id');
						if( $videoID ):
					?>
					<div class="featured-video">
						<h2><?php the_field('gnu_lbs_video_title'); ?></h2>
						<div class="video-player">
							<iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=99CC33" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						</div>
						<div class="video-copy">
							<p><?php the_field('gnu_lbs_video_details'); ?></p>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php
						endif;
					?>
					<div class="blog-posts">
						<h2>Weird LBS Stories</h2>
						<ul class="recent-blog-posts">
							<?php
								$args = array(
									'posts_per_page' => 6,
									'post__in'  => get_option( 'sticky_posts' ),
									'ignore_sticky_posts' => 1,
									'tag' => 'gnulbs'
								);
								$postsQuery = new WP_Query($args);

								$i=1;
								if (have_posts()) :
									while ($postsQuery->have_posts()) :
										$postsQuery->the_post();
										$postImage = get_post_image('blog-thumb');
							?>

							<li>
								<a href="<?php the_permalink(); ?>">
									<img src="<?php echo $postImage[0]; ?>" width="<?php echo $postImage[1]; ?>" height="<?php echo $postImage[2]; ?>" alt="<?php the_title(); ?> blog post thumbnail" />
									<p>
										<?php the_title(); ?>
									</p>
								</a>
							</li>

							<?php
										$post_thumbnail = ""; $i++; // resetting image value, incrementing $i
									endwhile;
								endif;
								// Reset Post Data
								wp_reset_query();
							?>

						</ul>
						<a href="/category/events/mt-baker-lbs/" class="archive-link">View Archived LBS Stories</a>
					</div><!-- END .blog-entries -->
					<div class="clearfix"></div>
				</section><!-- END .lbs-updates -->
				<section class="lbs-demo">
					<div class="demo-info">
						<h2>Demo a Gnu Snowboard at LBS!</h2>
						<p>At the White Salmon base area Gnu's demo tent will be set up all LBS weekend and will have boards from next year's 14/15 line-up to try out. Get Weird with the newest technology, contours, and shapes!</p>
						<img src="<?php bloginfo('template_directory'); ?>/_/img/lbs-demo.jpg" alt="Mervin LBS Demo Crew waiting to assit you" />
					</div>
					<div class="demo-products">
						<?php
							// display additional products
							$post_objects = get_field('gnu_lbs_products');
							if( $post_objects ):
								$relatedProducts = Array();
								// get each related product
								foreach( $post_objects as $post_object):
									$postType = $post_object->post_type;
									// get variable values
									$imageID = get_field('gnu_product_image', $post_object->ID);
									// check which image size to use based on post type
									$relatedImage = wp_get_attachment_image_src($imageID, 'square-medium');
									$relatedLink = get_permalink($post_object->ID);
									$relatedTitle = get_the_title($post_object->ID);
									// get price
									$relatedPrice = getDisplayPrice(get_field('gnu_product_price_us', $post_object->ID), get_field('gnu_product_price_ca', $post_object->ID), get_field('gnu_product_on_sale', $post_object->ID), get_field('gnu_product_sale_percentage', $post_object->ID));
									// add to related product array
									array_push($relatedProducts, Array($relatedTitle, $relatedLink, $relatedImage, $relatedPrice));
								endforeach;
								// randomly sort related products array
								shuffle($relatedProducts);
								// render out related products
								echo "<ul class=\"product-listing\">\n";
								// loop through products
								for($i = 0; $i < count($relatedProducts); ++$i) {
									echo '<li><a href="'. $relatedProducts[$i][1] .'"><img src="'.$relatedProducts[$i][2][0].'" width="'.$relatedProducts[$i][2][1].'" height="'.$relatedProducts[$i][2][2].'" /><h5>' . $relatedProducts[$i][0] . '</h5><div class="price">' . $relatedProducts[$i][3] . '</div></a></li>';
								}
								echo "</ul>\n";
							endif;
						?>
					</div>
					<div class="clearfix"></div>
				</section><!-- END .lbs-demo -->
				<section class="lbs-contest">
					<div class="contest-header">
						<h2 id="hashtag">#GnuLBS Instagram Photo Contest</h2>
						<div class="social-links">
							<h4>Stay Weird</h4>
							<ul class="social-icons">
								<li><a href="http://instagram.com/GNUsnowboards" class="icon-instagram" target="_blank">Instagram</a></li>
								<li><a href="http://www.facebook.com/gnuSnowboards" class="icon-facebook" target="_blank">Facebook</a></li>
								<li><a href="http://twitter.com/GNUsnowboards" class="icon-twitter" target="_blank">Twitter</a></li>
								<li><a href="http://vimeo.com/gnu" class="icon-vimeo" target="_blank">Vimeo</a></li>
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>
					<p>Tag your Weird, Wild, and Magical shots of the 29th Annual Legendary Banked Slalom with #GnuLBS for your chance to win Gnu's Dirty Pillow BTX or B.Nice BTX (winners choice).</p>
					<blockquote class="h5">Starts: Friday February 7th, 2014<br />Ends: Sunday February 9th, 2014 @ 3:00 pm</blockquote>
					<p>Gnu’s world renown lensmen Tim Zimmerman will choose a winner from all Instagram photos tagged #GnuLBS. Winner will be notified via Instagram by <a href="http://www.instagram.com/gnusnowboards" target="_blank">@gnusnowboards</a> before the awards ceremony.</p>
					<!-- START TagBoard -->
					<div id="tagboard-embed"></div>
					<script>
						var tagboardOptions = {tagboard:"GNULbs/154926", darkMode: true};
					</script>
					<script src="https://tagboard.com/public/js/embed.js"></script>
					<!-- END TagBoard -->
				</section><!-- END .lbs-contest -->
				<div class="clearfix"></div>
			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php get_footer(); ?>