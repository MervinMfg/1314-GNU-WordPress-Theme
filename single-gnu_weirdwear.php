<?php
/*
Template Name: Weirdwear Detail Template
*/

	get_header();
	if (have_posts()) : while (have_posts()) : the_post();
		$thePostID = $post->ID;
		$slug = $post->post_name;
		// find the associated tax associated with post
		$taxTerms = get_the_terms($thePostID, 'gnu_weirdwear_categories');
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
					<div class="product-images">
						<ul id="image-list">
							<?php
							$thumbnailImages = Array();
							if(get_field('gnu_weirdwear_images')): while(the_repeater_field('gnu_weirdwear_images')):
								$image = get_sub_field('gnu_weirdwear_images_img');
			       				$imageMedium = wp_get_attachment_image_src($image, 'medium', false);
			       				$imageFull = wp_get_attachment_image_src($image, 'full', false);
			       				$imageThumb = wp_get_attachment_image_src($image, 'thumbnail', false);
			       				$imageColor = get_sub_field('gnu_weirdwear_images_color');
			       				array_push($thumbnailImages, Array($imageThumb, $imageColor));
							?>

							<li><a href="<?php echo $imageFull[0]; ?>" title="<?php the_title(); ?> - <?php echo $imageColor; ?>"><img src="<?php echo $imageMedium[0]; ?>" alt="<?php the_title(); ?> - <?php echo $imageColor; ?>" width="<?php echo $imageMedium[1]; ?>" height="<?php echo $imageMedium[2]; ?>" /></a></li>
							
							<?php endwhile; endif; ?>
						</ul>
						<ul class="image-list-thumbs <?php if(count($thumbnailImages) < 2){ echo 'hidden'; }?>">
							<?php if($thumbnailImages): foreach ($thumbnailImages as $thumbnail) { ?>

							<li><a href="<?php echo $thumbnail[0][0]; ?>" title="<?php the_title(); ?> - <?php echo $thumbnail[1]; ?>" data-color="<?php echo $thumbnail[1]; ?>"><img src="<?php echo $thumbnail[0][0]; ?>" alt="<?php the_title(); ?> - <?php echo $thumbnail[1]; ?>" width="<?php echo $thumbnail[0][1]; ?>" height="<?php echo $thumbnail[0][2]; ?>" /></a></li>
							
							<?php }; endif; ?>
						</ul>
					</div>
					
					<?php
						$titleLength = strlen(get_the_title());
						if ($titleLength >= 36) {
							$titleClass = "extra-small";
						} else if ($titleLength >= 20 && $titleLength < 36) {
							$titleClass = "small";
						} else if ($titleLength >= 11 && $titleLength < 20) {
							$titleClass = "medium";
						} else if ($titleLength >= 8 && $titleLength < 11) {
							$titleClass = "large";
						} else if ($titleLength < 8) {
							$titleClass = "extra-large";
						}
					?>

					<div class="column-right">
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
							<a href="/weirdwear/">Weirdwear</a> • <a href="/weirdwear/#<?php echo $categorySlug; ?>"><?php echo $categoryName; ?></a>
						</div>
						<h1 class="<?php echo $titleClass; ?>"><?php the_title(); ?></h1>
						<div class="product-price">
							<?php echo getDisplayPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
						</div>
						<?php
							$products = Array();
							$isProductAvailable = "No";
							if(get_field('gnu_weirdwear_variations')):
								while(the_repeater_field('gnu_weirdwear_variations')):
									$variationColor = get_sub_field('gnu_weirdwear_variations_color');
									$variationSize = get_sub_field('gnu_weirdwear_variations_size');
									$variationSKU = get_sub_field('gnu_weirdwear_variations_sku');
									if($GLOBALS['language'] == "ca"){
										$variationAvailable = get_sub_field('gnu_weirdwear_variations_availability_ca');
									} else {
										$variationAvailable = get_sub_field('gnu_weirdwear_variations_availability_us');
									}
									// set overall availability
									if($variationAvailable == "Yes"){
										$isProductAvailable = "Yes";
									}
									$variationName = $variationColor . " - " . $variationSize;
									array_push($products, Array($variationName, $variationSKU, $variationAvailable, $variationColor));
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
								<option value="<?php echo $product[1]; ?>" title="<?php echo $product[0]; ?>"<?php if($product[2] == "No") echo ' disabled="disabled"'; ?> data-color="<?php echo $product[3]; ?>"><?php echo $product[0]; ?></option>
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

							<?php
							$postTitle = get_the_title();
							if (strpos($postTitle,'Tee') !== false) {
							?>

							<a href="/t-shirt-specifications/" class="get_specs">View t-shirt specs</a>
							
							<?php
							}
							?>
							
						</div>
						<ul class="product-share clearfix">
							<li><div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-width="120" data-show-faces="false" data-colorscheme="dark" data-font="trebuchet ms"></div></li>
							<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="GNUsnowboards">Tweet</a></li>
							<li><div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div></li>
							<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
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