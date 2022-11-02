<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style  = $el_class = $animation = '';
$gutter = 0;

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-categories-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );
$count = count( $items );
if ( $count < 1 ) {
	return;
}

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-categories ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$grid_classes = 'tm-grid';

if ( $animation === '' ) {
	$animation = Atomlab::setting( 'shortcode_portfolio_css_animation' );
}
$grid_classes .= Atomlab_Helper::get_grid_animation_classes( $animation );
?>
<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
	<?php if ( in_array( $style, array( 'grid' ), true ) ) { ?>
		data-type="masonry"
	<?php } ?>

	<?php if ( in_array( $style, array( 'grid' ), true ) && $columns !== '' ): ?>
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

	 data-grid-fitrows="true"
	 data-match-height="true"
>

	<div class="<?php echo esc_attr( $grid_classes ); ?>">
		<?php if ( in_array( $style, array( 'grid' ), true ) ): ?>
			<div class="grid-sizer"></div>
		<?php endif; ?>

		<?php
		foreach ( $items as $item ) {
			$classes = array( 'category-item grid-item' );

			$term = get_term_by( 'slug', $item['category'], 'category' );

			if ( $term === false ) {
				continue;
			}

			$term_link = get_term_link( $term );
			?>
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<div class="cat-wrapper">
					<a href="<?php echo esc_url( $term_link ); ?>">

						<?php
						if ( isset( $item['image'] ) && $item['image'] !== '' ) {
							$full_image_size = wp_get_attachment_image_url( $item['image'], 'full' );

							$image_url = Atomlab_Helper::aq_resize( array(
								'url'    => $full_image_size,
								'width'  => 492,
								'height' => 280,
								'crop'   => true,
							) );
							?>

							<div class="cat-thumbnail">
								<img src="<?php echo esc_url( $image_url ); ?>"
								     alt="<?php esc_attr_e( 'Category Image', 'atomlab' ); ?>">
							</div>
						<?php } ?>

						<div class="cat-content">
							<div class="inner">
								<?php
								$color      = Atomlab_Post::get_category_color( $term->term_id );
								$inline_css = '';
								if ( $color !== '' ) {
									$inline_css .= 'style="color: ' . $color . '"';
								}
								?>
								<h6 class="cat-title"
									<?php echo $inline_css; ?>
								>
									<?php echo esc_html( $term->name ); ?>
								</h6>
							</div>
						</div>
					</a>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
