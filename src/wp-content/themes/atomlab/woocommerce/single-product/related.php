<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<div class="related products">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related Products', 'atomlab' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<div class="tm-swiper tm-product style-grid equal-height equal-thumbnail-height"
		     data-lg-items="3"
		     data-md-items="3"
		     data-sm-items="2"
		     data-xs-items="1"
		     data-pagination="1"
		>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php foreach ( $related_products as $related_product ) : ?>

						<?php
						$post_object = get_post( $related_product->get_id() );
						setup_postdata( $GLOBALS['post'] =& $post_object );
						?>
						<div class="swiper-slide">
							<?php wc_get_template_part( 'content', 'product' ); ?>
						</div>

					<?php endforeach; ?>
				</div>
			</div>
		</div>

	</div>

<?php endif;

wp_reset_postdata();
