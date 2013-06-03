<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		This post is password protected. Enter the password to view comments.
	<?php
		return;
	}
?>

<?php if ( comments_open() ) : ?>
	<div class="<?php if (get_post_type() == 'gnu_snowboards' || get_post_type() == 'gnu_bindings' || get_post_type() == 'gnu_weirdwear' || get_post_type() == 'gnu_accessories' ){ echo 'reviews'; }else{ echo 'comments'; } ?>">
		<h2><?php if (get_post_type() == 'gnu_snowboards' || get_post_type() == 'gnu_bindings' || get_post_type() == 'gnu_weirdwear' || get_post_type() == 'gnu_accessories' ){ echo 'Discussion'; }else{ echo 'Comments'; } ?></h2>
		<fb:comments href="<?php the_permalink(); ?>" width="<?php if (get_post_type() == 'gnu_snowboards' || get_post_type() == 'gnu_bindings' || get_post_type() == 'gnu_weirdwear' || get_post_type() == 'gnu_accessories' ){ echo '940'; }else{ echo '640'; } ?>" colorscheme="dark" num_posts="5"></fb:comments>
	</div>
	
<?php endif; ?>