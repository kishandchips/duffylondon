<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>
<div class="page-header">
	<h2 class="text-frame gold"><?php _e( 'My Account', 'woocommerce' ); ?></h2>
</div>

<div class="messages-container my-account clearfix">
	<?php wc_print_notices(); ?>
<header>
	<p class="myaccount_user">
		<?php
		printf(
			__( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
			$current_user->display_name,
			wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) )
		);

		printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
			wc_customer_edit_account_url()
		);
		?>
	</p>
</header>


	<?php do_action( 'woocommerce_before_my_account' ); ?>

	<?php woocommerce_get_template( 'myaccount/my-downloads.php' ); ?>

	<?php woocommerce_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

	<?php woocommerce_get_template( 'myaccount/my-address.php' ); ?>

	<?php do_action( 'woocommerce_after_my_account' ); ?>
</div>