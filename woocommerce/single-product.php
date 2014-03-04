<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
global $wp_query;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); ?>

		<?php do_action('custom_woocommerce_before_main_content', 'single_product_wrapper_start'); ?>

			<?php while ( have_posts() ) : the_post(); ?>
			 	
			 	<?php $template = get_field('template'); ?>
			 	
			 	<?php 

			 	if($template == "highlight") :
				
				woocommerce_get_template_part( 'content', 'single-product' );

				else :

				woocommerce_get_template_part( 'content', 'single-product-simple' );
				
				endif;
				?>

			<?php endwhile; // end of the loop. ?>

		<?php do_action('custom_woocommerce_after_main_content', 'single_product_wrapper_end'); ?>


<?php get_footer('shop'); ?>