<div id="sidebar">

    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>
    
        <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->

    	<?php get_search_form(); ?>
    
    	<h2>Archives</h2>
    	<ul>
    		<?php wp_get_archives('type=monthly'); ?>
    	</ul>
        
        <h2>Categories</h2>
        <ul>
    	   <?php wp_list_categories('show_count=1&title_li='); ?>
        </ul>
        
    	<?php wp_list_bookmarks(); ?>
    
    	<h2>Meta</h2>
    	<ul>
    		<?php wp_register(); ?>
    		<li><?php wp_loginout(); ?></li>
    		<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
    		<?php wp_meta(); ?>
    	</ul>
    	
    	<h2>Subscribe</h2>
    	<ul>
    		<li><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
    		<li><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></li>
    	</ul>
	
	<?php endif; ?>

    <div class="follow-us">
        <h2>Follow Us</h2>
        <ul class="social-icons">
            <li><a href="http://www.facebook.com/gnuSnowboards" class="icon-facebook" target="_blank">Facebook</a></li>
            <li><a href="http://twitter.com/GNUsnowboards" class="icon-twitter" target="_blank">Twitter</a></li>
            <li><a href="http://vimeo.com/gnu" class="icon-vimeo" target="_blank">Vimeo</a></li>
            <li><a href="http://instagram.com/GNUsnowboards" class="icon-instagram" target="_blank">Instagram</a></li>
            <li><a href="<?php bloginfo('rss2_url'); ?>" class="icon-rss" target="_blank">RSS</a></li>
        </ul>
        <div class="clear"></div>
        <div class="facebook">
            <div class="fb-like-box" data-href="http://www.facebook.com/gnuSnowboards" data-width="240" data-height="80" data-colorscheme="dark" data-show-faces="false" data-stream="false" data-header="false"></div>
            <div class="fb-recommendations" data-site="<?php echo get_option('siteurl'); ?>" data-width="240" data-height="230" data-header="false" data-colorscheme="dark" data-border-color="#2D2D2E" data-font="trebuchet ms"></div>
        </div>
    </div>
    <div class="instagram-feed">
        <h2>Insta-Weird!</h2>
        <div class="instagram-slider">
            <div id="insta-prev"></div>
            <div class="insta-photo-wrapper">
                <ul id="instagram-photos"></ul>
            </div>
            <div id="insta-next"></div>
        </div>
        <div class="clear"></div>
    </div>
    <?php
        // get blog promo banner
        $pageData = get_page_by_path('blog');
        $pageID = $pageData->ID;
        $promoBannerLink = get_field('lt_blog_promo_banner_link', $pageID);
        $promoBannerImage = get_field('lt_blog_promo_banner_image', $pageID);
        $promoBannerImage = wp_get_attachment_image_src($promoBannerImage, 'full', false);
        $promoBannerAlt = get_field('lt_blog_promo_banner_alt', $pageID);
    ?>
</div>