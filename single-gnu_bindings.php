<?php
/*
Template Name: Bindings Detail Template
*/

	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		$thePostID = $post->ID;
		$slug = $post->post_name;
		// find the associated tax associated with post
		$taxTerms = get_the_terms($thePostID, 'gnu_bindings_categories');

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
						<a href="#hidden-images" class="additional-images">Additional Images</a>
						<ul id="image-list">

							<?php
								$thumbnailImages = Array();

								if(get_field('gnu_binding_options')):
									while(the_repeater_field('gnu_binding_options')):

										$optionColor = get_sub_field('gnu_binding_options_color');

										$optionImage = get_sub_field('gnu_binding_options_img');
										$optionImageThumb = wp_get_attachment_image_src($optionImage, 'thumbnail', false);
					       				$optionImageMedium = wp_get_attachment_image_src($optionImage, 'medium', false);
					       				$optionImageFull = wp_get_attachment_image_src($optionImage, 'full', false);

					       				$additionalImages = get_sub_field('gnu_binding_options_images');
					       				$additionalImagesString = "";
					       				// loop through images
					       				for ($i = 0; $i < count($additionalImages); $i++) {
					       					$additionalImage = $additionalImages[$i]['gnu_binding_options_images_img'];
					       					$additionalImage = wp_get_attachment_image_src($additionalImage, 'full', false);
					       					$additionalImagesString .= $additionalImage[0];
					       					if($i < count($additionalImages)-1){
					       						$additionalImagesString .= ",";
					       					}
					       				}

										// get variations
										$optionVariations = get_sub_field('gnu_binding_options_variations');
										$optionVariationSizes = "";
										$optionVariationSKUs = "";
										// loop through variations
										for ($i = 0; $i < count($optionVariations); $i++) {
											$variationSize = $optionVariations[$i]['gnu_binding_options_variations_size'];
											$variationSize = bindingSizeLookup($variationSize, false);
											$variationSKU = $optionVariations[$i]['gnu_binding_options_variations_sku'];

											$optionVariationSizes .= $variationSize;
											$optionVariationSKUs .= $variationSKU;
											// add comas except last item
											if($i < count($optionVariations)-1){
												$optionVariationSizes .= ", ";
												$optionVariationSKUs .= ", ";
											}
										}
										array_push($thumbnailImages, Array($optionImageThumb, $optionColor, $optionVariationSizes, $optionVariationSKUs, $optionImageMedium, $additionalImagesString));
							?>
							<li><a href="<?php echo $optionImageFull[0]; ?>" title="<?php the_title(); ?> - <?php echo $optionColor; ?> - <?php echo $optionVariationSizes; ?>" data-additional-images="<?php echo $additionalImagesString; ?>"><img src="<?php echo $optionImageMedium[0]; ?>" alt="<?php the_title(); ?> - <?php echo $optionVariationSizes; ?>" width="<?php echo $optionImageMedium[1]; ?>" height="<?php echo $optionImageMedium[2]; ?>" /></a></li>
							<?php
									endwhile;
								endif;
							?>
							
						</ul>
						<ul class="image-list-thumbs <?php if(count($thumbnailImages) < 2){ echo 'hidden'; }?>">
							<?php if($thumbnailImages): foreach ($thumbnailImages as $thumbnail) { ?>

							<li><a href="<?php echo $thumbnail[4][0]; ?>" title="<?php the_title(); ?> - <?php echo $thumbnail[2]; ?>" data-sku="<?php echo $thumbnail[3]; ?>"><img src="<?php echo $thumbnail[0][0]; ?>" alt="<?php the_title(); ?> - <?php echo $thumbnail[2]; ?>" width="<?php echo $thumbnail[0][1]; ?>" height="<?php echo $thumbnail[0][2]; ?>" /><?php echo $thumbnail[1]; ?></a></li>
							
							<?php }; endif; ?>
						</ul>
						<ul id="hidden-images"></ul>
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
							?>
							<a href="/bindings/">Bindings</a> • <a href="/bindings/?gender=<?php echo $categorySlug; ?>"><?php echo $categoryName; ?></a>
						</div>
						<h1 class="<?php echo $titleClass; ?>"<?php if($useTitleImage){echo $productTitleImageStyle;}; ?>><?php the_title(); ?></h1>
						<div class="product-price">
							<?php echo getDisplayPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
						</div>
						<?php
							$products = Array();
							$isProductAvailable = "No";
							if(get_field('gnu_binding_options')):
								while(the_repeater_field('gnu_binding_options')):
									$optionColor = get_sub_field('gnu_binding_options_color');
									// get variations
									$optionVariations = get_sub_field('gnu_binding_options_variations');
									// loop through variations
									for ($i = 0; $i < count($optionVariations); $i++) {
										$variationSize = $optionVariations[$i]['gnu_binding_options_variations_size'];
										$variationSize = bindingSizeLookup($variationSize, false);
										$variationSKU = $optionVariations[$i]['gnu_binding_options_variations_sku'];
										if($GLOBALS['language'] == "ca"){
											$variationAvailable = $optionVariations[$i]['gnu_binding_options_variations_availability_ca'];
										} else {
											$variationAvailable = $optionVariations[$i]['gnu_binding_options_variations_availability_us'];
										}
										// set overall availability
										if($variationAvailable == "Yes"){
											$isProductAvailable = "Yes";
										}
										$variationName = $optionColor . " - " . $variationSize;

										array_push($products, Array($variationName, $variationSKU, $variationAvailable));
									}
								endwhile;
							endif;
						?>
						<div class="product-variations <?php if($isProductAvailable == "No"){echo 'hide';} ?>">
							<label for="product-variation" id="product-variation-label">Color &amp; Size</label>
							<select id="product-variation">
								<option value="-1">Select a Color/Size</option>
								<?php
									// sort by variation name
									//asort($products);
									// render out snowboards dropdown
									foreach ($products as $product) {
								?>
								<option value="<?php echo $product[1]; ?>" title="<?php echo $product[0]; ?>"<?php if($product[2] == "No") echo ' disabled="disabled"'; ?>><?php echo $product[0]; ?></option>
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
						<?php
						/*<div class="product-free-shipping">
							<p>Enjoy Free Shipping for a Limited Time!*</p>
							<div class="free-shipping-details">
								<p>*Free shipping to the U.S. and Canada on orders placed before November 1, 2013</p>
								<p>Only orders over a value of $5.00 will be eligible for free shipping. Must be valid U.S. or Canada address, deliveries will not be made to P.O. Boxes.</p>
							</div>
						</div>*/
						?>
						<h2><?php the_field('gnu_product_slogan'); ?></h2>
						<div class="product-description">
							<?php the_content(); ?>
						</div>
						<ul class="product-share clearfix">
							<li><div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-width="120" data-show-faces="false" data-colorscheme="dark" data-font="trebuchet ms"></div></li>
							<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="GNUsnowboards">Tweet</a></li>
							<li><div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div></li>
							<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
						</ul>
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
									echo '<li><img src="'.$imageFile[0].'" width="'.$imageFile[0].'" height="'.$imageFile[0].'" /><div class="tool-tip">' . get_the_title($award->ID) . '</div></li>';
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
						<li><h2><a href="#binding-details" class="first last selected">Binding Details</a></h2></li>
					</ul>
					<div class="clearfix"></div>
				</nav>
				<section class="product-details" id="binding-details">
					<ul class="quick-specs">
						<?php
							// build array of sizes
							$sizes = Array();
							if(get_field('gnu_binding_options')):
								while(the_repeater_field('gnu_binding_options')):
									// get variations
									$optionVariations = get_sub_field('gnu_binding_options_variations');
									// loop through variations
									for ($i = 0; $i < count($optionVariations); $i++) {
										$variationSize = $optionVariations[$i]['gnu_binding_options_variations_size'];
										$variationSize = bindingSizeLookup($variationSize, true);

										if (!in_array($variationSize, $sizes, true)) {
										    array_push($sizes, $variationSize);
										}
									}
								endwhile;
							endif;
							// sort sizes
							//array_multisort($sizes, SORT_ASC);
							// setup sizes text display
							$sizeString = "";
							for ($i = 0; $i < count($sizes); $i++) {
								$sizeString .= $sizes[$i];
								if($i < count($sizes)-1){
									$sizeString .= "<br />";
								}
							}
						?>
						<li><span>Sizes</span><br /><?php echo $sizeString; ?></li>
						
						<?php
						// display additional products
					    $post_objects = get_field('gnu_binding_collab');
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
					            echo "<li class=\"binding-collab\"><span>Co-Lab Snowboard</span><div><a href=\"$relatedLink\">$relatedTitle<br /><img src=\"$relatedImage[0]\" width=\"$relatedImage[1]\" height=\"$relatedImage[2]\" /></a></div></li>";
					        endforeach;
					    endif;
						?>
					</ul>
					<div class="product-flex flex-<?php the_field('gnu_binding_flex'); ?>">Binding Flex Rating: <?php the_field('gnu_binding_flex'); ?></div>
					<div class="product-technology">
						<h3>Binding Tech</h3>

						<?php
							$args = array( 'post_type' => 'gnu_technology', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' );
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
								// get icon, if there is one
								if(get_field('gnu_technology_icon')) {
									$icon = get_field('gnu_technology_icon');
									$icon = wp_get_attachment_image_src($icon, 'thumbnail', false);
								}
								// check if binding is related to the tech
								$relatedItems = get_field('gnu_technology_related_products');
								if( $relatedItems ):
									foreach( $relatedItems as $relatedItem):
										if($relatedItem->ID == $thePostID):
						?>
						<?php
											if ($icon) {
						?>
						<div class="tech-content">
							<div class="tech-content-icon"><img src="<?php echo $icon[0] ?>" /></div>
							<div class="tech-content-text"><h4><?php the_title(); ?></h4><?php the_content(); ?></div>
							<div class="clearfix"></div>
						</div>
						<?php
											}else{
						?>
						<div class="tech-content">
							<div class="tech-content-icon"></div>
							<div class="tech-content-text"><h4><?php the_title(); ?></h4><?php the_content(); ?></div>
							<div class="clearfix"></div>
						</div>
						<?php
											}
										endif;
									endforeach;
								endif;
								$icon = null;
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
			</div>
			<div class="purple-divider"></div>
			<div class="main-column">
				<?php
					// display the related products
					display_related_products($GLOBALS['language']);
				?>

				<?php comments_template(); ?>

			</div><!-- end .main-column -->
		</div><!-- end #content -->
<?php
		endwhile;
	endif;
	get_footer();
?>