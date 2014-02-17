<?php get_header(); ?>

<?php $id = (isset($id)) ? $id : $post->ID; ?>
		
		<div class="page-header">
				<h2 class="text-frame gold">Testimonials</h2>
		</div>

		<div class="secondary-nav">
			<?php 
				$args = array(
					'theme_location' => 'subnavigation-test',
					'container' => false,
					'items_wrap' => '<ul id = "%1$s" class = "%2$s">%3$s</ul>'
				);
			
				wp_nav_menu( $args ); 
			?>
		</div>
		
		<?php if(have_posts()): while (have_posts()): the_post(); ?>
		<div id="content">
			<article>
				<header class="inner">
					<h4><?php the_field('quote'); ?></h4>
						
					<h2><?php the_field('title'); ?></h2>
						
					<h3><?php the_field('product'); ?></h3>	
				</header>				
			
				<?php the_post_thumbnail(); ?>
				<section class="inner">
					<?php the_content(); ?>
				</section>
			</article>
		</div>
		<?php endwhile;?>
	<?php endif; ?>

<?php get_footer(); ?>