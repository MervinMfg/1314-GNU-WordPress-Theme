<?php
/*
Template Name: Snowboards Detail Template
*/

	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		$thePostID = $post->ID;
		$slug = $post->post_name;
		// find the associated tax associated with post
		$taxTerms = get_the_terms($thePostID, 'gnu_snowboard_categories');

		// display video if we have an id
		$videoID = get_field('gnu_product_video');
		if( $videoID ){
			$productImagesClass = " video";
		} else {
			$productImagesClass = "";
		}					
?>
		<div id="content">
			<div class="main-column">
				<section class="product-overview <?php echo $slug; ?>">
					<div class="product-images<?php echo $productImagesClass; ?>">
						<ul id="image-list">

							<?php
								$thumbnailImages = Array();
								// get overview image
								$overviewImageID = get_field('gnu_product_image');
								$snowboardImageThumb = wp_get_attachment_image_src($overviewImageID, 'thumbnail', false);
				       			$snowboardImageMedium = wp_get_attachment_image_src($overviewImageID, 'snowboard-detail', false);
				       			$snowboardImageFull = wp_get_attachment_image_src($overviewImageID, 'full', false);
				       			// add image to array
				       			// array_push($thumbnailImages, Array($snowboardImageThumb, "Overview", "", ""));
				       		?>
				       		<!--<li><a href="<?php echo $snowboardImageFull[0]; ?>" title="<?php the_title(); ?>"><img src="<?php echo $snowboardImageMedium[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $snowboardImageMedium[1]; ?>" height="<?php echo $snowboardImageMedium[2]; ?>" /></a></li>-->

				       		<?php
								if(get_field('gnu_snowboard_options')):
									while(the_repeater_field('gnu_snowboard_options')):

										$optionName = get_sub_field('gnu_snowboard_options_name');

										$optionImage = get_sub_field('gnu_snowboard_options_img');
										$optionImageThumb = wp_get_attachment_image_src($optionImage, 'thumbnail', false);
					       				$optionImageMedium = wp_get_attachment_image_src($optionImage, 'snowboard-detail', false);
					       				$optionImageFull = wp_get_attachment_image_src($optionImage, 'full', false);

										// get variations
										$optionVariations = get_sub_field('gnu_snowboard_options_variations');
										$optionVariationSizes = "";
										$optionVariationSKUs = "";
										// loop through variations
										for ($i = 0; $i < count($optionVariations); $i++) {
											$variationWidth = $optionVariations[$i]['gnu_snowboard_options_variations_width'];
											$variationLength = $optionVariations[$i]['gnu_snowboard_options_variations_length'];
											$variationSKU = $optionVariations[$i]['gnu_snowboard_options_variations_sku'];
											// setup readable short form of length and width
											if($variationWidth == "Narrow"){
												$variationLength = $variationLength . "N";
											}else if($variationWidth == "Wide"){
												$variationLength = $variationLength . "W";
											}
											$optionVariationSizes .= $variationLength;
											$optionVariationSKUs .= $variationSKU;
											// add comas except last item
											if($i < count($optionVariations)-1){
												$optionVariationSizes .= ", ";
												$optionVariationSKUs .= ", ";
											}
										}
										array_push($thumbnailImages, Array($optionImageThumb, $optionName, $optionVariationSizes, $optionVariationSKUs, $optionImageMedium));
							?>
							<li><a href="<?php echo $optionImageFull[0]; ?>" title="<?php the_title(); ?> - <?php echo $optionVariationSizes; ?>"><img src="<?php echo $optionImageMedium[0]; ?>" alt="<?php the_title(); ?> - <?php echo $optionVariationSizes; ?>" width="<?php echo $optionImageMedium[1]; ?>" height="<?php echo $optionImageMedium[2]; ?>" /></a></li>
							<?php
									endwhile;
								endif;
							?>
							
						</ul>
						<ul class="image-list-thumbs <?php if(count($thumbnailImages) < 2){ echo 'hidden'; }?>">
							<?php if($thumbnailImages): foreach ($thumbnailImages as $thumbnail) { ?>

							<li><a href="<?php echo $thumbnail[4][0]; ?>" title="<?php the_title(); ?> - <?php echo $thumbnail[2]; ?>" data-sku="<?php echo $thumbnail[3]; ?>"><img src="<?php echo $thumbnail[0][0]; ?>" alt="<?php the_title(); ?> - <?php echo $thumbnail[2]; ?>" width="<?php echo $thumbnail[0][1]; ?>" height="<?php echo $thumbnail[0][2]; ?>" /><?php echo $thumbnail[1] . "<br />" . $thumbnail[2]; ?></a></li>
							
							<?php }; endif; ?>
						</ul>
					</div>

					<?php
						// check for product title image
						$useTitleImage = false;
						if (get_field('gnu_product_title_image')) {
							$useTitleImage = true;
							$productTitleImage = get_field('gnu_product_title_image');
							$productTitleImage = wp_get_attachment_image_src($productTitleImage, 'full', false);

							$productTitleImageStyle = ' style="background-image:url(\'' . $productTitleImage[0] . '\');"';
						}
						// check length of product title
						$titleLength = strlen(get_the_title());
						if ($titleLength >= 36) {
							$titleClass = "extra-small";
						} else if ($titleLength >= 20 && $titleLength < 36) {
							$titleClass = "small";
						} else if ($titleLength >= 14 && $titleLength < 20) {
							$titleClass = "medium";
						} else if ($titleLength >= 8 && $titleLength < 14) {
							$titleClass = "large";
						} else if ($titleLength < 8) {
							$titleClass = "extra-large";
						}
					?>

					<div class="column-right<?php if($useTitleImage){echo ' title-image';}; ?>">
						<div class="breadcrumb">
							<?php
							// Loop over each item since it's an array
							$categoryName = "";
							$categorySlug = "";
							foreach( $taxTerms as $term ) {
								$categoryName = $term->name;
								$categorySlug = $term->slug;
								unset($taxTerms);
							}
							if ($categorySlug == "mens-splitboards" || $categorySlug == "mens-youth") {
								$categoryName = "Mens";
								$categorySlug = "mens";
							} else if ($categorySlug == "womens-splitboards" || $categorySlug == "womens-youth") {
								$categoryName = "Womens";
								$categorySlug = "womens";
							}
							?>
							<a href="/snowboards/">Snowboards</a> • <a href="/snowboards/?gender=<?php echo $categorySlug; ?>"><?php echo $categoryName; ?></a>
						</div>
						<h1 class="<?php echo $titleClass; ?>"<?php if($useTitleImage){echo $productTitleImageStyle;}; ?>><?php the_title(); ?></h1>
						<div class="product-price">
							<?php echo getDisplayPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
						</div>
						<?php
							$snowboards = Array();
							$isProductAvailable = "No";
							if(get_field('gnu_snowboard_options')):
								while(the_repeater_field('gnu_snowboard_options')):
									$optionName = get_sub_field('gnu_snowboard_options_name');
									// get variations
									$optionVariations = get_sub_field('gnu_snowboard_options_variations');
									// loop through variations
									for ($i = 0; $i < count($optionVariations); $i++) {
										$variationWidth = $optionVariations[$i]['gnu_snowboard_options_variations_width'];
										$variationLength = $optionVariations[$i]['gnu_snowboard_options_variations_length'];
										$variationSKU = $optionVariations[$i]['gnu_snowboard_options_variations_sku'];
										if ($GLOBALS['language'] == "ca") {
											$variationAvailable = $optionVariations[$i]['gnu_snowboard_options_variations_availability_ca'];
										} else {
											$variationAvailable = $optionVariations[$i]['gnu_snowboard_options_variations_availability_us'];
										}
										// set overall availability
										if($variationAvailable == "Yes"){
											$isProductAvailable = "Yes";
										}
										// setup readable short form of length and width
										if($variationWidth == "Narrow"){
											$variationLength = $variationLength . "N";
										}else if($variationWidth == "Wide"){
											$variationLength = $variationLength . "W";
										}
										// setup variation name
										if($optionName != ""){
											$variationName = $variationLength . " - " . $optionName;
										}else{
											$variationName = $variationLength;
										}
										

										array_push($snowboards, Array($variationName, $variationSKU, $variationAvailable));
									}
								endwhile;
							endif;
						?>
						<div class="product-variations <?php if($isProductAvailable == "No"){echo 'hide';} ?>">
							<label for="product-variation" id="product-variation-label">Sizes</label>
							<select id="product-variation">
								<option value="-1">Select a Size</option>
								<?php
									// sort by variation name
									asort($snowboards);
									// render out snowboards dropdown
									foreach ($snowboards as $snowboard) {
								?>
								<option value="<?php echo $snowboard[1]; ?>" title="<?php echo $snowboard[0]; ?>"<?php if($snowboard[2] == "No") echo ' disabled="disabled"'; ?>><?php echo $snowboard[0]; ?></option>
								<?php
									}
								?>
							</select>
						</div>
						<div class="product-buy">
							<ul>
								<?php if($isProductAvailable == "Yes"): ?>
								<li class="loading hidden"></li>
								<li class="cart-button visible"><a href="#" class="add-to-cart">Add to Cart</a></li>
								<?php else: ?>
								<li>Item is currently not available online.</li>
								<?php endif; ?>
								<li class="find-dealer"><a href="/store-locator/">Find a Dealer</a></li>
							</ul>
							<div class="cart-success hidden"><p>The item has been added to your cart.<br /><a href="/shopping-cart/">View your shopping cart.</a></p></div>
							<div class="cart-failure hidden"><p>There has been an error adding the item to your cart. Try again later.</p></div>
						</div>
						<?php /*<div class="product-buy-alert">
							<a href="#free-shipping">Free Shipping for orders over $100!</a>
							<div class="alert-details">
								<p>Offer only applies to customers with a valid United States or Canada delivery addresses, we do not deliver to P.O. Boxes. Offer expires March 31, 11:59 PM PST, 2014</p>
								<p>Free shipping applies only to the following products: Any mix of products that aggregates to $100 U.S. Dollars in one order.</p>
							</div>
						</div>*/ ?>
						<h2><?php the_field('gnu_product_slogan'); ?></h2>
						<div class="product-description">
							<?php the_content(); ?>
						</div>
						<ul class="product-share clearfix">
							<li><div class="fb-like" data-href="<? the_permalink(); ?>" data-layout="button_count" data-width="120" data-show-faces="false" data-colorscheme="dark" data-font="trebuchet ms"></div></li>
							<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="GNUsnowboards">Tweet</a></li>
							<li><div class="g-plusone" data-size="medium" data-href="<? the_permalink(); ?>"></div></li>
							<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
						</ul>
						<?php // display highlighted tech if there are any
							$technology = get_field('gnu_product_technology');
							if( $technology ):
						?>
						<div class="product-tech clearfix">
							<ul>
							<?php
								foreach( $technology as $tech):
									//gnu_technology_type
									$imageID = get_field('gnu_technology_icon', $tech->ID);
									$imageFile = wp_get_attachment_image_src($imageID, 'thumbnail');
									echo '<li><a href="#' .$tech->post_name. '"><img src="'.$imageFile[0].'" width="'.$imageFile[1].'" height="'.$imageFile[2].'" /><div class="tool-tip">' . get_the_title($tech->ID) . '</div></a></li>';
								endforeach;
							?>
							</ul>
						</div>
						<? endif; // end highlighted tech ?>
						<?php // display awards if there are any
						$awards = get_field('gnu_product_awards');
						if( $awards ):
						?>
						<div class="product-awards clearfix">
							<ul>
							<?php
								foreach( $awards as $award):
									$imageID = get_field('gnu_award_image', $award->ID);
									$imageFile = wp_get_attachment_image_src($imageID, 'thumbnail');
									echo '<li><img src="'.$imageFile[0].'" width="'.$imageFile[1].'" height="'.$imageFile[2].'" /><div class="tool-tip">' . get_the_title($award->ID) . '</div></li>';
								endforeach;
							?>

							</ul>
						</div>
						<? endif; // end awards ?>
					</div>
					<div class="clearfix"></div>
				</section>
				<nav class="product-navigation">
					<ul>
						<li><h2><a href="#board-details" class="first">Board Details</a></h2></li>
						<li><h2><a href="#weird-science">Weird Science</a></h2></li>
						<li><h2><a href="#board-specs">Board Specs</a></h2></li>
						<?php if (get_field('gnu_snowboard_interview') != ""): ?>
						<li><h2><a href="#interview" class="last"><?php the_field('gnu_snowboard_interview_type'); ?></a></h2></li>
						<?php endif; ?>
					</ul>
					<div class="clearfix"></div>
				</nav>
				<section class="product-details" id="board-details">
					<ul class="quick-specs">
						<?php
							// build array of sizes
							$normalSizes = Array();
							$wideSizes = Array();
							if(get_field('gnu_snowboard_specs')):
								while(the_repeater_field('gnu_snowboard_specs')):
									$snowboardLength = get_sub_field('gnu_snowboard_specs_length');
									$snowboardWidth = get_sub_field('gnu_snowboard_specs_width');
									// add the proper width abbreviation if not standard
									if($snowboardWidth == "Wide"){
										$snowboardLength = $snowboardLength . "W";
										// add size to array
										array_push($wideSizes, $snowboardLength);
									} else {
										array_push($normalSizes, $snowboardLength);
									}
								endwhile;
							endif;
							// sort sizes
							array_multisort($normalSizes, SORT_ASC);
							array_multisort($wideSizes, SORT_ASC);
							// setup sizes text display
							$normalSizesString = "";
							for ($i = 0; $i < count($normalSizes); $i++) {
								$normalSizesString .= $normalSizes[$i];
								if($i < count($normalSizes)-1){
									$normalSizesString .= ", ";
								}
							}
							$wideSizesString = "";
							for ($i = 0; $i < count($wideSizes); $i++) {
								$wideSizesString .= $wideSizes[$i];
								if($i < count($wideSizes)-1){
									$wideSizesString .= ", ";
								}
							}
							// get contour image
							switch (get_field('gnu_snowboard_contour')) {
								case "BTX":
									$contourImage = get_bloginfo('template_directory') . '/_/img/snowboard-contour-BTX.png';
									break;
								case "PBTX":
									$contourImage = get_bloginfo('template_directory') . '/_/img/snowboard-contour-PBTX.png';
									break;
								case "SMART PBTX":
									$contourImage = get_bloginfo('template_directory') . '/_/img/snowboard-contour-SMART-PBTX.png';
									break;
								case "C2 PBTX":
									$contourImage = get_bloginfo('template_directory') . '/_/img/snowboard-contour-C2-PBTX.png';
									break;
								case "C2 BTX":
									$contourImage = get_bloginfo('template_directory') . '/_/img/snowboard-contour-C2-BTX.png';
									break;
								case "XC2 BTX":
									$contourImage = get_bloginfo('template_directory') . '/_/img/snowboard-contour-XC2-BTX.png';
									break;
								case "C3 BTX":
									$contourImage = get_bloginfo('template_directory') . '/_/img/snowboard-contour-C3-BTX.png';
									break;
								case "DC3 BTX":
									$contourImage = get_bloginfo('template_directory') . '/_/img/snowboard-contour-DC3-BTX.png';
									break;
								case "EC2 BTX":
									$contourImage = get_bloginfo('template_directory') . '/_/img/snowboard-contour-EC2-BTX.png';
									break;
								case "EC2 PBTX":
									$contourImage = get_bloginfo('template_directory') . '/_/img/snowboard-contour-EC2-PBTX.png';
									break;
							}
						?>
						<li>
							<div class="contour">
								<img src="<?php echo $contourImage; ?>" alt="<?php the_field('gnu_snowboard_contour'); ?>" />
							</div>
							<span>Contour</span> <?php the_field('gnu_snowboard_contour'); ?>
						</li>
						<li><span>Sizes</span> <?php echo $normalSizesString; ?></li>
						<?php if($wideSizesString !=""): ?><li><span>Wide Sizes</span> <?php echo $wideSizesString; ?></li><?php endif; ?>
						<li><span>Shape</span> <?php the_field('gnu_snowboard_shape'); ?></li>
						<li><span>About the Art</span><?php the_field('gnu_snowboard_about_art'); ?></li>
						<?php
						// display additional products
					    $post_objects = get_field('gnu_snowboard_collab');
					    if( $post_objects ):
					        // get each related product
					        foreach( $post_objects as $post_object):
					            $postType = $post_object->post_type;
					            // get variable values
					            $imageID = get_field('gnu_product_image', $post_object->ID);
					            // check which image size to use based on post type
					            $relatedImage = wp_get_attachment_image_src($imageID, 'overview-thumb');
					            $relatedLink = get_permalink($post_object->ID);
					            $relatedTitle = get_the_title($post_object->ID);
					            // render out co-lab product
					            echo "<li class=\"binding-collab\"><span>Co-Lab Binding</span><div><a href=\"$relatedLink\">$relatedTitle<br /><img src=\"$relatedImage[0]\" width=\"$relatedImage[1]\" height=\"$relatedImage[2]\" /></a></div></li>";
					        endforeach;
					    endif;
						?>
					</ul>
					<div class="product-technology">
						<h3>Board Tech</h3>

						<?php
							$args = array( 'post_type' => 'gnu_technology', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' );
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
								// check if snowbaord is related to the tech
								$relatedItems = get_field('gnu_technology_related_products');
								if( $relatedItems ):
									foreach( $relatedItems as $relatedItem):
										if($relatedItem->ID == $thePostID):
						?>
						<div id="<?php echo $post->post_name; ?>" class="deeplink-top-fix">
							<h4><?php the_title(); ?></h4>
							<?php the_content(); ?>
						</div>
						<?php
										endif;
									endforeach;
								endif;
							endwhile;
							wp_reset_query();
						?>
					</div>
					<div class="clearfix"></div>
					<?php
						// display video if we have an id
						$videoID = get_field('gnu_product_video');
						if( $videoID ):
					?>
					<div class="product-video">
						<h3 id="video" class="deeplink-top-fix">Weird Cinema</h3>
						<iframe src="http://player.vimeo.com/video/<?php echo $videoID; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=fff100" width="932" height="524" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						<a href="#video">Check out the video!</a>
					</div>
					<?php
						endif;
					?>
				</section>

				<section class="weird-science" id="weird-science">
					<div id="science-prev"></div>
					<ul id="science-photos">
						<?php
							if( in_array( 'Weird Science', get_field('gnu_snowboard_science') ) ):
								echo '<li class="science-weird">Weird Science</li>';
							endif;

							if( in_array( 'Construction', get_field('gnu_snowboard_science') ) ):
								echo '<li class="science-construction">Construction - Handbuilt by Snowboarders with Jobs</li>';
							endif;

							if( in_array( 'Magne-Traction', get_field('gnu_snowboard_science') ) ):
								echo '<li class="science-magne-traction">Magne-Traction Edge Grip - "Turns Ice Into Powder"</li>';
							endif;

							if( in_array( 'Pickle Tech', get_field('gnu_snowboard_science') ) ):
								echo '<li class="science-pickle-tech">Pickle Technology - Asymmetric Sidecuts and Construction</li>';
							endif;

							if( in_array( 'ASS Tech', get_field('gnu_snowboard_science') ) ):
								echo '<li class="science-ass-tech">A.S.S. Pickle Technology - Asym. Sym. Synchronization.</li>';
							endif;

							if( in_array( 'Liquid Crystal Polymer', get_field('gnu_snowboard_science') ) ):
								echo '<li class="science-liquid-crystal">Liquid Crystal Polymer - Tempered Polymer</li>';
							endif;

							if( in_array( 'Magnesium', get_field('gnu_snowboard_science') ) ):
								echo '<li class="science-magnesium">Odd Metal - Magnesium</li>';
							endif;

							if( in_array( 'Magic', get_field('gnu_snowboard_science') ) ):
								echo '<li class="science-magic">Make Magic - Magic</li>';
							endif;

							if( in_array( 'Wood Core', get_field('gnu_snowboard_science') ) ):
								echo '<li class="science-wood-core">Weird Wood - GNU Sustainable Natural Fiber or SNF</li>';
							endif;
						?>

					</ul>
					<div id="science-next"></div>
					<div class="clearfix"></div>
				</section>
				<section class="product-specs" id="board-specs">
					<table>
						<thead>
							<tr>
								<th>Model<br />Name</th>
								<th>Contact<br />Length</th>
								<th>Side<br />Cut</th>
								<th>Nose<br />Width</th>
								<th>Waist<br />Width</th>
								<th>Tail<br />Width</th>
								<th>Stance*<br /><span>Min-Max / Set Back</span></th>
								<th>Flex<br /><span>10 = Firm</span></th>
								<th>Weight<br />Range <span>(lbs)</span></th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(get_field('gnu_snowboard_specs')): while(the_repeater_field('gnu_snowboard_specs')):
								$snowboardLength = get_sub_field('gnu_snowboard_specs_length');
								$snowboardWidth = get_sub_field('gnu_snowboard_specs_width');
								if($snowboardWidth == "Narrow"){
									$snowboardLength = $snowboardLength . "N";
								}else if($snowboardWidth == "Wide"){
									$snowboardLength = $snowboardLength . "W";
								}
							?>

							<tr>
								<td><?php echo $snowboardLength; ?></td>
								<td><?php the_sub_field('gnu_snowboard_specs_contact_length'); ?></td>
								<td><?php the_sub_field('gnu_snowboard_specs_sidecut'); ?></td>
								<td><?php the_sub_field('gnu_snowboard_specs_nose_width'); ?></td>
								<td><?php the_sub_field('gnu_snowboard_specs_waist_width'); ?></td>
								<td><?php the_sub_field('gnu_snowboard_specs_tail_width'); ?></td>
								<td><?php the_sub_field('gnu_snowboard_specs_stance_range'); ?></td>
								<td><?php the_sub_field('gnu_snowboard_specs_flex_rating'); ?></td>
								<td><?php the_sub_field('gnu_snowboard_specs_weight_range'); ?> +</td>
							</tr>

							<?php endwhile; endif; ?>
						</tbody>
						<thead>
							<tr>
								<th colspan="7"></th>
								<th colspan="2"><a href="/snowboard-specifications/" class="get_specs">View all specs</a></th>
							</tr>
						</thead>
					</table>
				</section>
				<section class="product-interview" id="interview">
					<?php
						$type = get_field('gnu_snowboard_interview_type');
						$image = get_field('gnu_snowboard_interview_image');
						if($image != "") {
							$image = wp_get_attachment_image_src($image, 'full', false);
							echo "<img src=\"$image[0]\" alt=\"$type\" height=\"$image[1]\" width=\"$image[2]\" />\n";
						}
						the_field('gnu_snowboard_interview');
					?>
					<div class="clear"></div>
				</section>
			</div>
			<div class="purple-divider"></div>
			<div class="main-column">
				<?php
					// display the related products
					display_related_products($GLOBALS['language']);
					// display comments
					comments_template();
				?>
			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php
		endwhile;
	endif;
	get_footer();
?>