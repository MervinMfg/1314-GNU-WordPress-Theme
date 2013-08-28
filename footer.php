		<div class="end-content"></div>
	</div><!-- end .content-wrapper -->
	<footer id="footer">
		<div class="footer-top"></div>
		<div class="footer-content">
			<div class="footer-logo"></div>
			<div class="footer-social">
				<h3>Stay Weird</h3>
				<ul class="social-icons">
					<li><a href="http://www.facebook.com/gnuSnowboards" class="icon-facebook" target="_blank">Facebook</a></li>
					<li><a href="http://twitter.com/GNUsnowboards" class="icon-twitter" target="_blank">Twitter</a></li>
					<li><a href="http://vimeo.com/gnu" class="icon-vimeo" target="_blank">Vimeo</a></li>
					<li><a href="http://instagram.com/GNUsnowboards" class="icon-instagram" target="_blank">Instagram</a></li>
					<li><a href="<?php bloginfo('rss2_url'); ?>" class="icon-rss" target="_blank">RSS</a></li>
				</ul>
				<ul class="social-ctas">
					<li><div class="fb-like" data-href="http://www.facebook.com/gnuSnowboards" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="arial"></div></li>
					<li><a href="https://twitter.com/share" data-url="<?php echo get_option('siteurl'); ?>" data-text="<?php $shareTitle = get_bloginfo('name') . ' - ' . get_bloginfo('description'); echo $shareTitle; ?>" data-via="GNUsnowboards" data-count="none" class="twitter-share-button"></a></li>
					<li><div class="g-plusone" data-size="medium" data-annotation="none" data-href="<?php echo get_option('siteurl'); ?>"></div></li>
					<li><a data-pin-config="none" href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $GLOBALS['pageImage']; ?>&description=<?php echo $GLOBALS['pageTitle']; ?>" data-pin-do="buttonPin" ><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a></li>
				</ul>
			</div>
			<div class="footer-subscribe">
				<h3>Stay Informed</h3>
				<form target="_blank" class="validate clearfix" name="mc-embedded-subscribe-form-2" id="mc-embedded-subscribe-form-2" method="post" action="http://mervin.us1.list-manage1.com/subscribe/post?u=86253f560bfb6feb1f80233bb&amp;id=c0ed21a3a8">
					<fieldset>
						<input type="text" id="mce-EMAIL-2" class="required email" name="EMAIL" value="enter your email..." onfocus="if (this.value == 'enter your email...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'enter your email...';}" />
						<input type="hidden" value="8" name="group[22][32]" />
						<input type="submit" class="btn" id="mc-embedded-subscribe-2" name="subscribe" value="Subscribe" />
					</fieldset>
				</form>
			</div>
			<div class="footer-support">
				<h3>Support</h3>
				<a href="/support/recall/" style="font-size: 12px; font-weight:bold;" class="no-international">12/13 Gnu Ankle Strap Recall Info</a>
				<ul class="support-list-left">
					<li><a href="/support/contact/">Contact</a></li>
					<li><a href="http://www.mervin.com/register/" target="_blank">Register</a></li>
					<li><a href="/support/warranty/">Warranty</a></li>
					<li><a href="http://gnu.shptron.com/home/privacy/4374.6.1.1" target="_blank" id="link-privacy">Privacy</a></li>
					<li><a href="http://gnu.shptron.com/home/policies/4374.6.1.1" target="_blank" id="link-policies">Policies</a></li>
				</ul>
				<ul class="support-list-right">
					<li><a href="http://gnu.shptron.com/account/?mfg_id=4374.6&language_id=1" target="_blank" id="link-login">My Account</a></li>
					<li><a href="http://gnu.shptron.com/home/security/4374.6.1.1" target="_blank" id="link-safety">Safety and Security</a></li>
					<li><a href="http://gnu.shptron.com/home/policies/4374.6.1.1#Returns" target="_blank" id="link-returns">30-Day Returns</a></li>
					<li><a href="http://gnu.shptron.com/home/ordering/4374.6.1.1" target="_blank" id="link-ordering">Ordering Info</a></li>
				</ul>
			</div>
			<div class="footer-region">
				<h3>Region</h3>
				<ul>
                    <li><a href="#" class="country-us"><span></span>UNITED STATES</a></li>
                    <li><a href="#" class="country-ca"><span></span>CANADA</a></li>
                    <li><a href="#" class="country-int"><span></span>INTERNATIONAL</a></li>
                </ul>
                <div class="handbuilt">Handbuilt in the U.S.A. by snowboarders with jobs</div>
			</div>
		</div>
	</footer><!-- END #footer -->
	<!-- Region Selector Overlay -->
	<div class="hidden">
		<div id="region-selector-overlay">
			<div class="choose-region">
				<h4>Choose your region:</h4>
				<ul>
					<li><a href="#" class="usa">USA</a></li>
					<li><a href="#" class="canada">CANADA</a></li>
					<li><a href="#" class="international">INTERNATIONAL</a></li>
				</ul>
			</div>
			<p>GNU does not accept online orders outside of the US and Canada.</p>
		</div>
	</div>
	<?php wp_footer(); ?>

	<!-- JavaScript includes -->
	<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/lib/jquery-1.10.2.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/lib/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/lib/jquery-embedagram.pack.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/lib/jquery.colorbox-min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/lib/jquery.cookie.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/lib/jquery.treeview.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/lib/TimelineMax.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_/js/gnu.main.js"></script>
	<!-- Init the main JS -->
	<script type="text/javascript">
		$(document).ready(function(){
			GNU.main.init();
		});
	</script>
	<!-- Social Media Includes -->
	<div id="fb-root"></div>
	<script type="text/javascript">
		// Facebook
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=217173258409585";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		// Twitter
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
		// Google+
		(function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		})();
	</script>
	<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
	<!-- Google Analytics -->
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-10240628-1']);
		_gaq.push(['_setDomainName', '.gnu.com']);
		_gaq.push(['_setAllowHash', false]);
		_gaq.push(['_setAllowLinker', true]);
		_gaq.push(['_trackPageview']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
</body>
</html>