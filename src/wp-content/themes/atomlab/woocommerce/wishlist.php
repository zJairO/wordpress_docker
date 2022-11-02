<?php
/**
 * Wishlist pages template; load template parts basing on the url
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.5
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly

add_filter( 'woocommerce_add_to_cart_tooltip_position', function ( $position ) {
	return 'none';
} );
?>
<div id="yith-wcwl-messages"></div>

<?php yith_wcwl_get_template( 'wishlist-' . $template_part . '.php', $atts ) ?>
