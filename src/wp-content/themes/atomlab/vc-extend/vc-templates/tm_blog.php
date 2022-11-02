<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style              = $el_class = '';
$main_query         = $categories = $meta_key = $pagination = $animation = '';
$carousel_direction = $carousel_items_display = $carousel_gutter = $carousel_nav = $carousel_pagination = $carousel_auto_play = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-blog-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$atomlab_post_args = array(
	'post_type'      => 'post',
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
	'post__not_in'   => get_option( 'sticky_posts' ),
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

if ( $main_query === '1' ) {
	global $wp_query;
	$atomlab_query = $wp_query;
} else {
	$atomlab_query = new WP_Query( $atomlab_post_args );
}

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-blog ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

if ( $skin !== '' ) {
	$css_class .= " skin-$skin";
}

if ( $filter_wrap === '1' ) {
	$css_class .= ' filter-wrap';
}

$grid_classes = 'tm-grid';

if ( in_array( $style, array( 'magazine' ) ) ) {
	$grid_classes .= ' modern-grid';
}

$is_swiper = false;

if ( in_array( $style, array( 'carousel', 'full_wide_slider' ), true ) ) {
	$is_swiper      = true;
	$grid_classes   .= ' swiper-wrapper';
	$slider_classes = 'tm-swiper equal-height';

	if ( $carousel_nav !== '' ) {
		$slider_classes .= " nav-style-$carousel_nav";
	}

	if ( $carousel_pagination !== '' ) {
		$slider_classes .= " pagination-style-$carousel_pagination";
	}
}

if ( $animation === '' ) {
	$animation = Atomlab::setting( 'shortcode_blog_css_animation' );
}
$grid_classes .= Atomlab_Helper::get_grid_animation_classes( $animation );
?>

<?php if ( $atomlab_query->have_posts() ) : ?>
	<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
		<?php if ( $pagination !== '' && $atomlab_query->found_posts > $number ) : ?>
			data-pagination="<?php echo esc_attr( $pagination ); ?>"
		<?php endif; ?>

		<?php if ( in_array( $style, array(
			'grid_masonry',
			'grid_classic',
			'magazine_classic',
			'metro',
			'metro_magazine',
		), true ) ) { ?>
			data-type="masonry"
		<?php } elseif ( in_array( $style, array( 'carousel', 'full_wide_slider' ), true ) ) { ?>
			data-type="swiper"
		<?php } ?>

		<?php if ( in_array( $style, array(
				'grid_masonry',
				'grid_classic',
				'magazine_classic',
				'metro',
				'metro_magazine',
			), true ) && $columns !== '' ) { ?>
			<?php
			$arr = explode( ';', $columns );
			foreach ( $arr as $value ) {
				$tmp = explode( ':', $value );
				echo ' data-' . $tmp[0] . '-columns="' . esc_attr( $tmp[1] ) . '"';
			}
			?>
		<?php } ?>

		<?php if ( in_array( $style, array( 'metro', 'metro_magazine' ) ) ) { ?>
			data-grid-ratio="1:1"
		<?php } ?>

		<?php if ( in_array( $style, array( 'grid_classic', 'magazine_classic' ), true ) ) : ?>
			data-grid-fitrows="true"
			data-match-height="true"
		<?php endif; ?>

		<?php if ( $gutter !== '' && $gutter !== 0 ) : ?>
			data-gutter="<?php echo esc_attr( $gutter ); ?>"
		<?php endif; ?>
	>
		<?php
		$i     = 0;
		$count = $atomlab_query->post_count;

		$tm_grid_query                  = $atomlab_post_args;
		$tm_grid_query['action']        = 'post_infinite_load';
		$tm_grid_query['max_num_pages'] = $atomlab_query->max_num_pages;
		$tm_grid_query['found_posts']   = $atomlab_query->found_posts;
		$tm_grid_query['style']         = $style;
		$tm_grid_query['pagination']    = $pagination;
		$tm_grid_query['count']         = $count;
		$tm_grid_query['taxonomies']    = $taxonomies;
		$tm_grid_query                  = htmlspecialchars( wp_json_encode( $tm_grid_query ) );
		?>

		<?php Atomlab_Templates::grid_filters( $filter_enable, $filter_align, $filter_counter, $filter_wrap ); ?>

		<input type="hidden" class="tm-grid-query" value="<?php echo '' . $tm_grid_query; ?>"/>

		<?php if ( $is_swiper === true ) { ?>
		<div class="<?php echo esc_attr( $slider_classes ); ?>"
			<?php if ( in_array( $style, array( 'carousel' ) ) ) { ?>
				<?php
				if ( $carousel_items_display !== '' ) {
					$arr = explode( ';', $carousel_items_display );
					foreach ( $arr as $value ) {
						$tmp = explode( ':', $value );
						echo ' data-' . $tmp[0] . '-items="' . $tmp[1] . '"';
					}
				}
				?>
			<?php } elseif ( in_array( $style, array( 'full_wide_slider' ) ) ) { ?>
				data-lg-items="1"
			<?php } ?>

			<?php if ( $carousel_gutter > 1 ) : ?>
				data-lg-gutter="<?php echo esc_attr( $carousel_gutter ); ?>"
			<?php endif; ?>

			<?php if ( $carousel_nav !== '' ) : ?>
				data-nav="1"
			<?php endif; ?>

			<?php if ( $carousel_pagination !== '' ) : ?>
				data-pagination="1"
			<?php endif; ?>

			<?php if ( $carousel_auto_play !== '' ) : ?>
				data-autoplay="<?php echo esc_attr( $carousel_auto_play ); ?>"
			<?php endif; ?>
		>
			<div class="swiper-container">
				<?php } ?>

				<div class="<?php echo esc_attr( $grid_classes ); ?>"
					<?php if ( in_array( $style, array( 'list' ), true ) ) : ?>
						data-grid-has-gallery="true"
					<?php endif; ?>
				>

					<?php if ( in_array( $style, array(
						'grid_masonry',
						'grid_classic',
						'magazine_classic',
						'metro',
						'metro_magazine',
					), true ) ) : ?>
						<div class="grid-sizer"></div>
					<?php endif; ?>

					<?php
					set_query_var( 'atomlab_query', $atomlab_query );
					set_query_var( 'count', $count );
					set_query_var( 'metro_layout', $metro_layout );

					get_template_part( 'loop/shortcodes/blog/style', $style );
					?>
				</div>

				<?php if ( $is_swiper === true ) { ?>
			</div>
		</div>
	<?php } ?>

		<?php Atomlab_Templates::grid_pagination( $atomlab_query, $number, $pagination, $pagination_align, $pagination_button_text ); ?>

	</div>
<?php endif; ?>
<?php wp_reset_postdata();
