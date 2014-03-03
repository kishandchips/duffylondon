<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<?php do_action( 'woocommerce_before_single_product' );?>
								
<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>"  <?php post_class(); ?>>

	<div class="row grey-bg">
		<?php do_action( 'woocommerce_before_single_product_summary' );?>

		<div class="summary entry-summary span five">
				<?php $icon_image = get_field('icon'); ?>
				
				<?php if($icon_image): ?>
					<div class="product-icon black ?>">
						<?php echo file_get_contents($icon_image['url']); ?>
					</div>
				<?php endif; ?>

		<?php do_action( 'woocommerce_single_product_summary' );?>

		</div><!-- .summary -->
	</div><!-- .row -->

	<?php do_action( 'woocommerce_after_single_product_summary' );?>

		<?php while(has_sub_field("row")): ?>
		<?php if(get_row_layout() == "image_content"):?>
			<?php $image = get_sub_field('image'); ?>
			<?php 
				if(get_sub_field('alignment') == "left") {
					$div_float = "left";
					$image_pos = "right: 0";
				} else {
					$div_float = "right";
					$image_pos = "left: 0";
				}
			?>
			<?php if(get_sub_field('display_text_background')): ?>			
			<div class="content-text row">

						<div class="content span five <?php echo $div_float; ?>" style="background-image:url(<?php echo $image['sizes']['full-width'];?>)">
							<?php $color = get_field('color'); ?>

							<div class="inner <?php the_field('color'); ?>" >
								<?php the_sub_field('content'); ?>
								<?php the_field('product_details'); ?>
								
								<?php if(get_field('product_video')): ?>
								<div id="video_player">
								    <a href="<?php the_field('product_video')?>?iframe=true&width=540&height=420" data-rel="prettyPhoto[product-gallery]" title="My YouTube Video">
								    	video
								    </a>
								</div>
								<?php endif; ?>

							</div>
							<div class="overlay" style="background-color:<?php the_field('overlay'); ?>"></div>
						</div>

						<div class="bg" style="background-image:url(<?php echo $image['sizes']['full-width'];?>);<?php echo $image_pos; ?>">
							<a class="modal" href="<?php echo $image['sizes']['full-width'];?>" title="<?php the_title(); ?>" data-rel="prettyPhoto[product-gallery]"></a>
						</div><!-- content and image -->
			</div><!-- content-text row -->

					<?php else : ?>

						<div class="content-text row" style="background-image:url(<?php echo $image['sizes']['full-width'];?>);">
							<div class="content span five <?php echo $div_float; ?>">
								<?php $color = get_field('color'); ?>
								<div class="inner <?php the_field('color'); ?>" >
									<?php the_sub_field('content'); ?>
									<?php the_field('product_details'); ?>

									<?php if(get_field('product_video')): ?>
									<div id="video_player">
									    <a href="<?php the_field('product_video')?>?iframe=true&width=540&height=420" data-rel="prettyPhoto[product-gallery]" title="My YouTube Video">
									    	video
									    </a>
									</div>
									<?php endif; ?>

								</div>
								<div class="overlay" style="background-color:<?php the_field('overlay'); ?>"></div>
							</div>
						</div><!-- content-text row no-bg -->		

		 	<?php endif; ?>	

			<?php elseif (get_row_layout() == "image") : ?>

				<div class="content-image row">
						<?php $image = get_sub_field('image'); ?>
						<a href="<?php echo $image['sizes']['full-width'];?>" title="<?php the_title(); ?>" data-rel="prettyPhoto[product-gallery]">
							<img src="<?php echo $image['url']; ?>">
						</a>

				</div><!-- image row -->

			<?php endif; ?>
			<?php endwhile; ?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>

