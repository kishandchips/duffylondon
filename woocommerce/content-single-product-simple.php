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
								
<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>"  <?php $classes = array('simple'); post_class($classes); ?>>

	<div class="row grey-bg">

	<?php do_action( 'woocommerce_before_single_product_summary' );?>

		<div class="summary entry-summary span five">
				<?php $icon_image = get_field('icon'); ?>
				
				<?php if($icon_image): ?>
					<div class="product-icon black ?>">
						<?php echo file_get_contents($icon_image['url']); ?>
					</div>
				<?php endif; ?>
				
				<?php do_action( 'woocommerce_single_product_summary' ); ?>
		</div><!-- .summary -->

	</div><!-- .row -->

	<?php do_action( 'woocommerce_after_single_product_summary' );?>
	
	<div class="row">
		
		<?php do_action( 'woocommerce_product_thumbnails' );?>

		<div class="content span five right">
			<div class="inner" >
				<?php the_field('product_details'); ?>
				<?php if(get_field('product_video')): ?>
				<div id="video_player">
				    <a href="http://www.facebook.com/video/embed?video_id=<?php the_field('product_video')?>?iframe=true&width=540&height=420" data-rel="prettyPhoto[product-gallery]" title="<?php the_title(); ?> Product Video">
				    	video
				    </a>
				</div>
				<?php endif; ?>
			</div>
		</div>
		
	</div>



</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>

