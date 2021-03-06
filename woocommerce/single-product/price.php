<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>

<?php if ( !$product->is_type( array( 'variable', 'grouped' ) ) ) : ?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price-container">

	<?php $free = $product->get_price_html(); ?>
	<?php if($free !== 'Free!'): ?>
		<p itemprop="price" class="price">PRICE: <?php echo $product->get_price_html(); ?></p>
	<?php endif; ?>

</div>
<?php endif; ?>