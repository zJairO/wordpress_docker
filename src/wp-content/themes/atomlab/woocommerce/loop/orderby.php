<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="shop-filter-right col-md-6">
	<form class="woocommerce-ordering" method="get">
		<select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'atomlab' ); ?>">
			<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
				<option
					value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
		<input type="hidden" name="paged" value="1"/>
		<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
	</form>

	<div class="shop-view-switcher">
		<?php
		$switcher_grid_classes = 'switcher-item grid';
		$switcher_list_classes = 'switcher-item list';

		if ( isset( $_COOKIE['shop_layout'] ) && $_COOKIE['shop_layout'] === 'list' ) {
			$switcher_list_classes .= ' active';
		} else {
			$switcher_grid_classes .= ' active';
		}

		?>

		<div class="<?php echo esc_attr( $switcher_grid_classes ); ?>">
			<span class="ion-android-apps"></span>
		</div>
		<div class="<?php echo esc_attr( $switcher_list_classes ); ?>">
			<span class="ion-android-menu"></span>
		</div>
	</div>
</div>
