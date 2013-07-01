<?php
/*
Template Name: Accessories Detail Template
*/

get_header();
if (have_posts()) : while (have_posts()) : the_post();
	$thePostID = $post->ID;
	$slug = $post->post_name;			
?>
		<div id="content">
			<div class="main-column">
				<section class="product-overview <?php echo $slug; ?>">
					<div class="product-images">
						<ul id="image-list">
							<?php
								if(get_field('gnu_product_image')):
									$imageID = get_field('gnu_product_image');
				       				$imageMedium = wp_get_attachment_image_src($imageID, 'medium', false);
				       				$imageFull = wp_get_attachment_image_src($imageID, 'full', false);
							?>

							<li><a href="<?php echo $imageFull[0]; ?>" title="<?php the_title(); ?>"><img src="<?php echo $imageMedium[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $imageMedium[1]; ?>" height="<?php echo $imageMedium[2]; ?>" /></a></li>
							
							<?php endif; ?>
						</ul>
					</div>
					
					<?php
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

					<div class="column-right">
						<div class="breadcrumb">
							<?php if (has_term( 'binding-parts', 'gnu_accessories_categories') ) { // check to see if this is a replacement part or accessory ?>
							<a href="/support/replacement-parts/">Replacement Parts</a>

							<?php } else { ?>
							<a href="/accessories/">Accessories</a>

							<?php } ?>

						</div>
						<h1 class="<?php echo $titleClass; ?>"><?php the_title(); ?></h1>
						<div class="product-price">
							<?php echo getDisplayPrice( get_field('gnu_product_price_us'), get_field('gnu_product_price_ca'), get_field('gnu_product_on_sale'), get_field('gnu_product_sale_percentage') ); ?>
						</div>
						<?php
							$isProductAvailable = "No";

							if(get_field('gnu_accessory_sku')):
								$productSKU = get_field('gnu_accessory_sku');
								if($GLOBALS['language'] == "ca"){
									$productAvailable = get_field('gnu_accessory_availability_ca');
								} else {
									$productAvailable = get_field('gnu_accessory_availability_us');
								}
								// set overall availability
								if($productAvailable == "Yes"){
									$isProductAvailable = "Yes";
								}
							endif;
						?>
						<input type="hidden" id="product-sku" value="<?php echo $productSKU; ?>">
						<div class="product-quantity product-variations <?php if($isProductAvailable == "No"){echo 'hidden';} ?>">
							<label for="product-qty">QTY:</label>
							<select id="product-qty">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="20">Party</option>
							</select>
							<div class="clear"></div>
						</div>
						<div class="product-buy">
							<ul>
								<?php if($isProductAvailable == "Yes"): ?>
								<li class="loading hidden"></li>
								<li class="cart-button visible"><a href="#" class="add-to-cart">Add to Cart</a></li>
								<?php else: ?>
								<li>2013/2014 Products available soon.</li>
								<?php endif; ?>
								<li class="find-dealer"><a href="/store-locator/">Find a Dealer</a></li>
							</ul>
							<div class="cart-success hidden"><p>The items has been added to your cart.<br /><a href="/shopping-cart/">View your shopping cart.</a></p></div>
							<div class="cart-failure hidden"><p>There has been an error adding the item to your cart. Try again later.</p></div>
						</div>
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
					</div>
					<div class="clearfix"></div>
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