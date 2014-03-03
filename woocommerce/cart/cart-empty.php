<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

?>
<div class="page-header">
	<h2 class="text-frame gold"><?php _e( 'Your cart is currently empty.', 'woocommerce' ) ?></h2>

	<?php do_action( 'woocommerce_cart_is_empty' ); ?>
	
	<span class="return-to-shop"><a class="button wc-backward" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php _e( 'Return To Shop', 'woocommerce' ) ?></a></span>
</div>


