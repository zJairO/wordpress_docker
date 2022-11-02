<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style              = $el_class = $columns = $animation = '';
$pagination         = $pagination_align = $pagination_button_text = $pagination_custom_button_id = '';
$gutter             = 0;
$ajax_filter_enable = '';
$filter_wrap        = $filter_enable = $filter_align = $filter_counter = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-product-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$atomlab_post_args = array(
	'post_type'      => 'product',
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
);

if ( in_array( $orderby, array( 'meta_value', 'meta_value_num' ) ) ) {
	$atomlab_post_args['meta_key'] = $meta_key;
}

if ( get_query_var( 'paged' ) ) {
	$atomlab_post_args['paged'] = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$atomlab_post_args['paged'] = get_query_var( 'page' );
}

$atomlab_post_args = Atomlab_VC::get_tax_query_of_taxonomies( $atomlab_post_args, $taxonomies );

$atomlab_query = new WP_Query( $atomlab_post_args );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-grid-wrapper tm-product ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

if ( $filter_wrap === '1' ) {
	$css_class .= ' filter-wrap';
}

if ( $style === 'grid' ) {
	$css_class .= ' equal-thumbnail-height';
}

$grid_classes = 'tm-grid';
$grid_classes .= Atomlab_Helper::get_grid_animation_classes( $animation );

Atomlab_Enqueue::instance()->enqueue_woocommerce_styles_scripts();

if ( Atomlab::setting( 'shop_archive_quick_view' ) === '1' ) {
	wp_enqueue_style( 'magnific-popup' );
	wp_enqueue_script( 'magnific-popup' );
}
?>
<?php if ( $atomlab_query->have_posts() ) : ?>
	<div class="woocommerce">
		<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"

			<?php if ( in_array( $style, array( 'grid', 'grid-simple' ), true ) ) { ?>
				data-type="masonry"
			<?php } ?>

			<?php if ( in_array( $style, array( 'grid', 'grid-simple' ), true ) ) { ?>
				data-grid-fitrows="true"
				data-match-height="true"
			<?php } ?>

			<?php if ( $pagination !== '' && $atomlab_query->found_posts > $number ) : ?>
				data-pagination="<?php echo esc_attr( $pagination ); ?>"
			<?php endif; ?>

			<?php if ( $pagination_custom_button_id !== '' ): ?>
				data-pagination-custom-button-id="<?php echo esc_attr( $pagination_custom_button_id ); ?>"
			<?php endif; ?>

			<?php if ( $columns !== '' && in_array( $style, array( 'grid', 'grid-simple' ), true ) ): ?>
				<?php
				$arr = explode( ';', $columns );
				foreach ( $arr as $value ) {
					$tmp = explode( ':', $value );
					echo ' data-' . $tmp[0] . '-columns="' . esc_attr( $tmp[1] ) . '"';
				}
				?>
			<?php endif; ?>

			<?php if ( $gutter !== '' && $gutter !== 0 ) : ?>
				data-gutter="<?php echo esc_attr( $gutter ); ?>"
			<?php endif; ?>
		>
			<?php
			$count = $atomlab_query->post_count;

			$tm_grid_query                  = $atomlab_post_args;
			$tm_grid_query['action']        = 'product_infinite_load';
			$tm_grid_query['max_num_pages'] = $atomlab_query->max_num_pages;
			$tm_grid_query['found_posts']   = $atomlab_query->found_posts;
			$tm_grid_query['taxonomies']    = $taxonomies;
			$tm_grid_query['style']         = $style;
			$tm_grid_query['pagination']    = $pagination;
			$tm_grid_query['count']         = $count;
			$tm_grid_query                  = htmlspecialchars( wp_json_encode( $tm_grid_query ) );
			?>

			<?php if ( $ajax_filter_enable === '1' ): ?>
				<div class="product-ajax-filter">
					<div class="result-found-text">
						<?php
						printf( wp_kses( __( 'We found <mark>%s</mark> products available for you', 'atomlab' ), array( 'mark' => array() ) ), $atomlab_query->found_posts );
						?>
					</div>

					<div class="filters">
						<?php Atomlab_Woo::get_ajax_filter_template(); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php Atomlab_Templates::grid_filters( 'product', $filter_enable, $filter_align, $filter_counter, $filter_wrap ); ?>

			<input type="hidden" class="tm-grid-query" <?php echo 'value="' . $tm_grid_query . '"'; ?>/>

			<div class="<?php echo esc_attr( $grid_classes ); ?>">
				<?php if ( in_array( $style, array( 'grid', 'grid-simple' ), true ) ): ?>
					<div class="grid-sizer"></div>
				<?php endif; ?>

				<?php if ( $style === 'grid-simple' ) { ?>
					<?php
					/**
					 * Trim zeros in price decimals
					 **/
					add_filter( 'woocommerce_price_trim_zeros', '__return_true' );

					//Change tooltip position of current style.
					add_filter( 'woocommerce_add_to_cart_tooltip_position', function ( $position ) {
						return 'none';
					} );
					?>
					<?php while ( $atomlab_query->have_posts() ) : $atomlab_query->the_post(); ?>
						<?php wc_get_template_part( 'content', 'product-grid-simple' ); ?>
					<?php endwhile; ?>
				<?php } else { ?>
					<?php while ( $atomlab_query->have_posts() ) : $atomlab_query->the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
				<?php } ?>
			</div>

			<?php Atomlab_Templates::grid_pagination( $atomlab_query, $number, $pagination, $pagination_align, $pagination_button_text ); ?>

		</div>
	</div>
<?php endif;
wp_reset_postdata();
