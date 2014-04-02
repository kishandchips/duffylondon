<?php get_header(); ?>

<?php $id = (isset($id)) ? $id : $post->ID; ?>
		
		<div class="page-header">
				<h2 class="text-frame gold"><?php the_title(); ?></h2>
		</div>
		<div class="secondary-nav">
			<?php the_terms($post->ID,'year','', 'Back to') ?>
		</div>

		<?php if(have_posts()): while (have_posts()): the_post(); ?>
			<div id="content">
				<?php $images = get_field('gallery'); ?> 
			    <?php if( $images ): ?>
			    	<ul class="equal list clearfix">
						<?php foreach( $images as $image ): ?>
							<li class=" span one-fourth">
								<a href="<?php echo $image['url']; ?>" class="lightbox-btn">
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
								</a>
							</li>
						<?php endforeach;?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endwhile;?>
		<?php endif; ?>

<?php get_footer(); ?>