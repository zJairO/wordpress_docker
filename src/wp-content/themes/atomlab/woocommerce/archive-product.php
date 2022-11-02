<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$page_sidebar_position = Atomlab::setting( 'product_archive_page_sidebar_position' );
$page_sidebar1         = Atomlab::setting( 'product_archive_page_sidebar_1' );
$page_sidebar2         = Atomlab::setting( 'product_archive_page_sidebar_2' );

$category_per_page = 4;
if ( $page_sidebar1 !== 'none' || $page_sidebar2 !== 'none' ) {
	$category_per_page = 3;
}
?>

<?php get_template_part( 'components/title-bar' ); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Atomlab_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'left' ); ?>

				<div class="page-main-content">

					<?php
					/**
					 * woocommerce_archive_description hook.
					 *
					 * @hooked woocommerce_taxonomy_archive_description - 10
					 * @hooked woocommerce_product_archive_description - 10
					 */
					do_action( 'woocommerce_archive_description' );
					?>

					<?php
					$shop_page_display = get_option( 'woocommerce_shop_page_display' );

					if ( $shop_page_display !== '' ) {
						woocommerce_output_product_categories( array(
							'before' => '<div class="cats tm-swiper" data-lg-items="' . $category_per_page . '" data-sm-items="2" data-xs-items="1" data-lg-gutter="30" data-nav="1" data-loop="1"><div class="swiper-container"><div class="swiper-wrapper">',
							'after'  => '</div></div></div>',
						) );
					}
					?>

					<?php if ( woocommerce_product_loop() ) : ?>

						<div class="archive-shop-actions row row-xs-center">
							<?php
							/**
							 * woocommerce_before_shop_loop hook.
							 *
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );
							?>
						</div>

						<?php
						if ( isset( $_COOKIE['shop_layout'] ) && $_COOKIE['shop_layout'] === 'list' ) {
							$_lg_columns = 1;
							$_md_columns = 1;

							$_grid_classes = 'style-list';
						} else {
							$_lg_columns = 3;
							$_md_columns = 2;
							if ( $page_sidebar1 !== 'none' || $page_sidebar2 !== 'none' ) {
								$_lg_columns = 2;
							}

							$_grid_classes = 'style-grid';
						}
						?>
						<div
							class="tm-grid-wrapper tm-product equal-thumbnail-height <?php echo esc_attr( $_grid_classes ); ?>"
							data-type="masonry"
							data-lg-columns="<?php echo esc_attr( $_lg_columns ); ?>"
							data-md-columns="<?php echo esc_attr( $_md_columns ); ?>"
							data-sm-columns="1"
							data-gutter="30"
							data-grid-fitrows="true"
							data-match-height="true"
						>

							<div class="tm-grid has-animation move-up products">

								<div class="grid-sizer"></div>

								<?php while ( have_posts() ) : the_post(); ?>
									<?php if ( isset( $_COOKIE['shop_layout'] ) && $_COOKIE['shop_layout'] === 'list' ) { ?>
										<?php wc_get_template_part( 'content', 'product-list' ); ?>
									<?php } else { ?>
										<?php wc_get_template_part( 'content', 'product' ); ?>
									<?php } ?>

								<?php endwhile; // end of the loop. ?>
							</div>

						</div>

						<?php
						/**
						 * woocommerce_after_shop_loop hook.
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
						?>

					<?php else : ?>

						<?php
						/**
						 * woocommerce_no_products_found hook.
						 *
						 * @hooked wc_no_products_found - 10
						 */
						do_action( 'woocommerce_no_products_found' );
						?>

					<?php endif; ?>
				</div>

				<?php Atomlab_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'right' ); ?>

			</div>
		</div>
	</div>
<?php
get_footer( 'shop' );

