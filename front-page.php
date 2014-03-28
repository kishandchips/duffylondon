<?php get_header(); ?>

<section class="featured-products">

	<?php $feat_products = get_field('featured_products');
	 
	if( $feat_products ): ?>
	    <?php foreach( $feat_products as $post): // variable must be called $post (IMPORTANT) ?>

		    <?php $img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		    <?php $id = $post->ID; ?>
			<?php $icon_image = get_field('icon'); ?>
		    <?php $color = get_field('color', $id); ?>

				<article class="featured-product">

				        <div class="featured-info no-gutter" style="background-image:url(<?php echo $img_url; ?>);">

							<div class="valign">
								<div class="<?php echo strtolower($color); ?>">
									<?php if($icon_image): ?>
									<div>
										<div class="product-icon <?php echo strtolower($color); ?>">
											<?php echo file_get_contents($icon_image['url']); ?>
										</div>
									</div>
									<?php endif; ?>
					                <h2 class="brandon"><?php the_title(); ?></h2>
					                <p><?php the_field('tagline'); ?></p>
					                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="button <?php echo strtolower($color); ?>">More</a>
					            </div>
							</div>

							<div class="overlay" style="background-color:<?php the_field('overlay'); ?>"></div>
							
				        </div>

						<div class="featured-image no-gutter" style="background-image:url(<?php echo $img_url; ?>);">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
						</div>						

				</article>

	    <?php endforeach; ?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
</section>

<section class="misc-products">

	<?php $products = get_field('selected');
	 
	if( $products ): ?>
	    <?php foreach( $products as $post): // variable must be called $post (IMPORTANT) ?>
	    
	        <div class="misc-product span one-third">
	            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title($post->ID); ?>" class="product">
	            	<?php echo get_the_post_thumbnail($post->ID, 'misc-thumb');?>
	            		<?php $icon_image = get_field('icon'); ?>

						<div class="product-overlay">
							<div class="product-icon white">
		            			<?php if($icon_image): ?>
		            				<p><?php echo file_get_contents($icon_image['url']); ?></p>
								<?php endif; ?>
								<p><?php the_title(); ?></p>
							</div>							
						</div>
	            </a>
	         </div>
	    <?php endforeach; ?>
	<?php endif; ?>

</section>

<div class="promo-text">
    <p class="text-frame gold">Have a look around</p>
</div>

<?php get_footer(); ?>