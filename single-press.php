<?php get_header(); ?>

<?php $id = (isset($id)) ? $id : $post->ID; ?>
		
		<div class="page-header">
				<h2 class="text-frame gold">Press</h2>
		</div>

		<div class="secondary-nav">
			<?php 
				$args = array(
					'theme_location' => 'subnavigation-press',
					'container' => false,
					'items_wrap' => '<ul id = "%1$s" class = "%2$s">%3$s</ul>'
				);
			
				wp_nav_menu( $args ); 
			?>
		</div>

		<?php if(have_posts()): while (have_posts()): the_post(); ?>
		<div id="content">
			<ul class="equal list clearfix">
				<?php if (have_rows('press_release')): while (have_rows('press_release')): the_row(); ?>
				<?php $image = get_sub_field('image'); ?>
				
					<li class=" span one-fourth">
						<a href="<?php echo $image['url']; ?>" class="lightbox-btn">
							<img src="<?php echo $image['sizes']['misc-thumb'];?>" alt="<?php echo $image['alt']; ?>">
							<div class="overlay"></div>
						</a>
						<h3><?php the_sub_field('name'); ?></h3>
					</li>

				<?php endwhile; ?>
				<?php endif; ?>
			</ul>
		</div>
		<?php endwhile;?>
	<?php endif; ?>

<?php get_footer(); ?>