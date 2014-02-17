</main>

<footer id="footer">
    <nav class="main-nav">
        <h3 class="text-center">Menu</h3>

<?php

$menu_args = array(
	'theme_location'  => '',
	'menu'            => 'primary',
	'menu_class'	  => 'menu clearfix',
	'container'       => 'false',
	'items_wrap'      => '<ul id="%1$s" class="equal %2$s">%3$s</ul>'

);

wp_nav_menu( $menu_args );

?>

	<div class="social-links">
		<a href="<?php the_field('brochure', 'option'); ?>"><i class="icon-file"></i>Download our brochure</a>
		<a href="<?php the_field('twitter', 'option'); ?>"><i class="icon-twitter"></i>Follow us on twitter</a>
		<a href="<?php the_field('facebook', 'option'); ?>"><i class="icon-facebook"></i>Find us on facebook</a>
	</div>

</footer>
	<?php wp_footer(); ?>
</body>
</html>