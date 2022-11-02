<?php
/**
 * Quickview popup template.
 *
 * @package  TM Atomlab
 * @since    1.0
 */

global $post, $product;

add_filter( 'woocommerce_single_product_open_gallery', function () {
	return false;
} );
?>
	<div class="woo-quick-view-popup">
		<div class="woocommerce container single-product woo-quick-view-popup-content">
			<div class="product product-container">
				<div class="row">
					<div class="col-md-6">

						<div class="woo-single-images product-feature">
							<?php
							/**
							 * woocommerce_before_single_product_summary hook.
							 *
							 * @hooked woocommerce_show_product_sale_flash - 10
							 * @hooked woocommerce_show_product_images - 20
							 */
							do_action( 'woocommerce_before_single_product_summary' );
							?>
						</div>

					</div>

					<div class="col-md-6">
						<div class="woo-single-summary summary entry-summary">
							<div class="inner-content">
								<?php do_action( 'woocommerce_single_product_summary' ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
//wp_die();
