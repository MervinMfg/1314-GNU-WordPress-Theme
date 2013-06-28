<?php
/*
Template Name: Team Detail Template
*/

get_header();
if (have_posts()) : while (have_posts()) : the_post();
	$thePostID = $post->ID;
	$slug = $post->post_name;
	$taxTerms = get_the_terms($thePostID, 'gnu_team_categories');		
?>
		<div id="content">
			<?php if(get_field('gnu_team_hero_images')): ?>
			<div class="hero-slider">
				<div class="hero-image-wrapper">
					<ul>
						<?php while(the_repeater_field('gnu_team_hero_images')):
							$heroAreaImage = get_sub_field('gnu_team_hero_images_image');
		       				$heroAreaImage = wp_get_attachment_image_src($heroAreaImage, 'full', false);
						?>

						<li><img src="<?php echo $heroAreaImage[0]; ?>" alt="<?php the_sub_field('gnu_team_hero_images_alt_text'); ?>" width="<?php echo $heroAreaImage[1]; ?>" height="<?php echo $heroAreaImage[2]; ?>" /></li>

						<?php endwhile; ?>

					</ul>
					<div id="hero-prev"></div>
					<div id="hero-next"></div>
				</div>
			</div>
			<div class="purple-divider"></div>
			<div class="main-column team-details">
			<?php else: ?>
			<div class="main-column team-details pad-top">
			<?php endif; ?>
				<div class="left-column">
					
					<?php
						$profilePhoto = get_field('gnu_team_profile_photo'); // gnu_team_related_products
						$profilePhoto = wp_get_attachment_image_src($profilePhoto, 'full', false);
					?>

					<div class="profile-photo">
						<img src="<?php echo $profilePhoto[0]; ?>" alt="<?php the_title(); ?> Team Photo" width="<?php echo $profilePhoto[1]; ?>" height="<?php echo $profilePhoto[1]; ?>" />
					</div>


					<?php
					// Loop over each item since it's an array
					foreach( $taxTerms as $term ) {
						$categoryName = $term->name;
						unset($taxTerms);
					}
					?>

					<h4><?php echo $categoryName; ?> Team</h4>
					<h1><?php the_title(); ?></h1>
					<ul class="social-icons">
						<?php if(get_field('gnu_team_facebook_username')) : ?><li><a href="http://www.facebook.com/<?php the_field('gnu_team_facebook_username'); ?>" class="icon-facebook" target="_blank">Facebook</a></li><?php endif; ?>
						<?php if(get_field('gnu_team_twitter_username')) : ?><li><a href="http://twitter.com/<?php the_field('gnu_team_twitter_username'); ?>" class="icon-twitter" target="_blank">Twitter</a></li><?php endif; ?>
						<?php if(get_field('gnu_team_vimeo_username')) : ?><li><a href="http://vimeo.com/<?php the_field('gnu_team_vimeo_username'); ?>" class="icon-vimeo" target="_blank">Vimeo</a></li><?php endif; ?>
						<?php if(get_field('gnu_team_instagram_username')) : ?><li><a href="http://instagram.com/<?php the_field('gnu_team_instagram_username'); ?>" class="icon-instagram" target="_blank">Instagram</a></li><?php endif; ?>
			        </ul>
					<div class="rider-overview">
						<?php if(get_field('gnu_team_personal_website')) : ?><a href="<?php the_field('gnu_team_personal_website'); ?>" class="personal-site" target="_blank">Personal Website</a><?php endif; ?>
						<?php the_content(); ?>
					</div>

					<?php
					// display riders products
				    $post_objects = get_field('gnu_team_related_products');
				    if( $post_objects ):
				        echo "<div class=\"rider-gear\">\n";
				        $relatedProducts = Array();
				        // get each related product
				        foreach( $post_objects as $post_object):
				            $postType = $post_object->post_type;
				            // get variable values
				            $imageID = get_field('gnu_product_image', $post_object->ID);
				            // check which image size to use based on post type
				            $relatedImage = wp_get_attachment_image_src($imageID, 'thumbnail');
				            $relatedLink = get_permalink($post_object->ID);
				            $relatedTitle = get_the_title($post_object->ID);
				            // get price
				            if($GLOBALS['language'] == "ca"){
				                $relatedPrice = '$' . get_field('gnu_product_price_ca', $post_object->ID) . ' <span>CAD</span>';
				            } else {
				                $relatedPrice = '$' . get_field('gnu_product_price_us', $post_object->ID) . ' <span>USD</span>';
				            }
				            // add to related product array
				            array_push($relatedProducts, Array($relatedTitle, $relatedLink, $relatedImage, $relatedPrice));
				        endforeach;
				        // randomly sort related products array
				        shuffle($relatedProducts);
				        // render out max of 4 related products
				        echo "<h3>Riders Gear</h3>\n<ul class=\"riders-gear\">\n";
				        // loop through products
				        for($i = 0; $i < count($relatedProducts); ++$i) {
				            // give the 2nd products a class of last
				            if(($i + 1) % 2 == 0){
				                $relatedClass = "right";
				            }else{
				                $relatedClass = "";
				            }
				            echo '<li class="'. $relatedClass .'"><a href="'. $relatedProducts[$i][1] .'"><img src="'.$relatedProducts[$i][2][0].'" width="'.$relatedProducts[$i][2][1].'" height="'.$relatedProducts[$i][2][2].'" /><h4>' . $relatedProducts[$i][0] . '</h4><p>' . $relatedProducts[$i][3] . '</p></a></li>';
				        }
				        echo "</ul>\n";
				        echo "</div>\n";
				    endif;
					?>

					<?php
						// get recent blog posts by category slug
						if (get_field('gnu_team_blog_category_slug')) :
							$categoryIDObj = get_category_by_slug(get_field('gnu_team_blog_category_slug'));
							$categoryID = $categoryIDObj->term_id;
					?>
					<h3>Recent Glog Posts</h3>
					<ul class="recent-blog-posts">
						<?php
							$myposts = get_posts('numberposts=3&offset=0&category='. $categoryID .'');
							foreach($myposts as $post) :
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
						<?php endforeach; wp_reset_query(); ?>
					</ul>
					<?php endif; ?>

					<div class="clear"></div>
				</div>
				<div class="right-column">
					<?php
					if (get_field('gnu_team_photo_album_id')) {
						$albumID = get_field('gnu_team_photo_album_id');
					?>

					<h2>Photo Gallery</h2>
					<div class="photo-gallery">
						<!-- START EMBED CODE -->
						<script type="text/javascript" src="http://director.quiksilver.com/m/embed.js"></script>
						<div id="album-<?php echo $albumID; ?>"></div>
						<script type="text/javascript">
							var teamAlbumId = "<?php echo $albumID; ?>";
						</script>
						<!-- END EMBED CODE -->
					</div>

					<?php
					}
					?>

					<?php
						// CHECK FOR VIDEOS
						if(get_field('gnu_team_featured_videos')):
							// build array of videos if they exist
							$videoArray = Array();
							while(the_repeater_field('gnu_team_featured_videos')):
								$videoType = get_sub_field('gnu_team_featured_videos_type');
								$videoID = get_sub_field('gnu_team_featured_videos_id');
								$videoName = get_sub_field('gnu_team_featured_videos_name');
								$videoDetails = get_sub_field('gnu_team_featured_videos_details');
								array_push($videoArray, Array($videoType, $videoID, $videoName, $videoDetails));
							endwhile;
							// render out video area
					?>

					<h2>Weird Cinema</h2>

					<div class="video-player">
						<div class="frame-wrapper"></div>
						<?php
							for ($i = 0; $i < count($videoArray); $i++) {
								echo '<div class="video-info" id="' . $videoArray[$i][1] . '"><h3>' . $videoArray[$i][2] . '</h3>' . $videoArray[$i][3] . '</div>'; // video title
							} // end for loop
						?>
					</div><!-- end .video-player -->

					<ul class="video-thumbnails">

					<?php
							for ($i = 0; $i < count($videoArray); $i++) {
								if($videoArray[$i][0] == "YouTube"){ // check video type
									// youtube
									$apiUrl = "http://gdata.youtube.com/feeds/api/videos/" . $videoArray[$i][1] . "?v=2&alt=jsonc";
									$json = json_decode(file_get_contents($apiUrl));
									$thumbUrl = $json->data->thumbnail->hqDefault; // smaller image is sqDefault
									$videoUrl = "http://www.youtube.com/watch?v=" . $videoArray[$i][1];
								} else if ($videoArray[$i][0] == "Vimeo") {
									// vimeo
									$apiUrl = "http://vimeo.com/api/v2/video/" . $videoArray[$i][1] . ".php";
									$hash = unserialize(file_get_contents($apiUrl));
									$thumbUrl = $hash[0]['thumbnail_medium'];
									$videoUrl = "http://vimeo.com/" . $videoArray[$i][1];
								} // end video type check
								$videoTitle = $videoArray[$i][2]; // video title
								if(($i + 1) % 3 == 0){
					                $thumbClass = "third";
					            }else{
					                $thumbClass = "";
					            }
					?>
						<li class="<?php echo $thumbClass; ?>">
							<a href="<?php echo $videoUrl; ?>" data-video-id="<?php echo $videoArray[$i][1]; ?>" data-video-type="<?php echo $videoArray[$i][0]; ?>" style="background:url('<?php echo $thumbUrl; ?>') center center;<?php if($videoArray[$i][0] == "YouTube"){ echo ' background-size:140%'; }; ?>">
								<!--<img src="<?php echo $thumbUrl; ?>" alt="<?php echo $videoTitle; ?>" />-->
								<p><?php echo $videoTitle; ?></p>
							</a>
						</li>
					<?php	
							} // end for loop
					?>

					</ul><!-- end .video-thumbnails -->

					<?php endif; // end video check ?>


					<?php if (get_field('gnu_team_q_and_a')): ?>

					<h2>Curious Questions and Answers</h2>
					<?php the_field('gnu_team_q_and_a'); ?>

					<? endif; // end q and a check ?>

					<div class="clear"></div>
				</div>

				<?php if(get_field('gnu_team_instagram_username')) : ?>

				<section class="instagram team hidden" data-instagram-username="<?php the_field('gnu_team_instagram_username'); ?>">
					<h4><span>Instagram </span>@<?php the_field('gnu_team_instagram_username'); ?></h4>
					<div class="instagram-slider">
						<div id="insta-prev"></div>
						<div class="insta-photo-wrapper">
							<ul id="instagram-photos"></ul>
						</div>
						<div id="insta-next"></div>
					</div>
				</section>

				<?php endif; ?>

				<div class="clear"></div>
			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php
	endwhile;
endif;
get_footer();
?>