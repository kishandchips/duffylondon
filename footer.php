</main>

<footer id="footer">
    <nav class="main-nav">

        <h3 class="text-center"><?php _e("Menu", THEME_NAME); ?></h3>

		<?php

		$menu_args = array(
			'theme_location'  => '',
			'menu'            => 'primary',
			'menu_class'	  => 'menu clearfix',
			'container'       => 'false',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>'

		);

		wp_nav_menu( $menu_args );

		?>
	</nav>
	
	<div class="footer-secondary">
		<div class="social-links">
			<p>Find Us On:</p>
			
			<a href="<?php the_field('twitter', 'option'); ?>" target="_blank"><i class="icon-twitter"></i></a>
			<a href="<?php the_field('facebook', 'option'); ?>" target="_blank"><i class="icon-facebook"></i></a>
			<a href="<?php the_field('pinterest', 'option'); ?>" target="_blank"><i class="icon-pinterest"></i></a>
		</div>

		<div class="other-links">
			<a href="<?php the_field('brochure', 'option'); ?>" target="_blank"><i class="icon-file"></i>Download Our Brochure</a>
			<?php

			$menu_args = array(
				'theme_location'  => 'footer',
				'menu_class'	  => 'menu clearfix',
				'container'       => 'false',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>'
			);

			wp_nav_menu( $menu_args );

			?>
		</div><!--  other links -->
	</div><!-- footer secondary -->

</footer>
</div><!-- wrap -->
	<?php wp_footer(); ?>
</body>
</html>