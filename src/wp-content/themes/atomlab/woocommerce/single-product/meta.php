<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="product-meta-wrap">
	<div class="product-meta">

		<?php do_action( 'woocommerce_product_meta_start' ); ?>

		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
			<div class="sku_wrapper meta-item">
				<h6><?php esc_html_e( 'SKU', 'atomlab' ); ?></h6>
				<span
					class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'atomlab' ); ?></span>
			</div>
		<?php endif; ?>

		<?php if ( Atomlab::setting( 'single_product_categories_enable' ) === '1' ) : ?>
			<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="posted_in meta-item"><h6>' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'atomlab' ) . '</h6>', '</div>' ); ?>
		<?php endif; ?>

		<?php if ( Atomlab::setting( 'single_product_tags_enable' ) === '1' ) : ?>
			<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="tagged_as meta-item"><h6>' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'atomlab' ) . '</h6>', '</div>' ); ?>
		<?php endif; ?>

		<?php if ( Atomlab::setting( 'single_product_sharing_enable' ) === '1' ) : ?>
			<?php Atomlab_Templates::product_sharing(); ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_product_meta_end' ); ?>
	</div>
</div>
