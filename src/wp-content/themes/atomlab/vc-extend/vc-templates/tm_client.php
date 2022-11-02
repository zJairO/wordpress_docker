<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style = $loop = $auto_play = $el_class = $items = $items_display = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-client-' );
$this->get_inline_css( '#' . $css_id, $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-client tm-swiper equal-height h-center v-center ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$items = (array) vc_param_group_parse_atts( $items );
?>
<?php if ( count( $items ) > 0 ) { ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
		<?php
		if ( $items_display !== '' ) {
			$arr = explode( ';', $items_display );
			foreach ( $arr as $value ) {
				$tmp = explode( ':', $value );
				echo ' data-' . $tmp[0] . '-items="' . $tmp[1] . '"';
			}
		}
		?>

		<?php if ( $gutter > 1 ) : ?>
			data-lg-gutter="<?php echo esc_attr( $gutter ); ?>"
		<?php endif; ?>

		<?php if ( $auto_play !== '' ) : ?>
			data-autoplay="<?php echo esc_attr( $auto_play ); ?>"
		<?php endif; ?>

		<?php if ( $loop === '1' ) : ?>
			data-loop="1"
		<?php endif; ?>

		<?php if ( $style === '2-rows' ): ?>
			data-slide-columns="2"
		<?php endif; ?>
	>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php foreach ( $items as $item ) { ?>
					<div class="swiper-slide">
						<?php
						$inner_classes = 'inner';
						if ( isset( $item['image_hover'] ) ) {
							$inner_classes .= ' has-image-hover';
						}
						?>

						<div class="<?php echo esc_attr( $inner_classes ); ?>">
							<?php
							$_flag = false;
							if ( isset( $item['link'] ) ) {
								$link = vc_build_link( $item['link'] );
								if ( $link['url'] !== '' ) {
									$_target = $link['target'] !== '' ? ' target="_blank"' : '';
									$_title  = $link['title'] !== '' ? ' title="' . esc_attr( $link['title'] ) . '"' : '';
									echo '<a href="' . esc_url( $link['url'] ) . '"' . $_target . $_title . '>';
									$_flag = true;
								}
							}
							?>
							<?php if ( isset( $item['image'] ) ) : ?>
								<div class="image">
									<?php
									$image_url = wp_get_attachment_url( $item['image'] );
									?>
									<img src="<?php echo esc_url( $image_url ); ?>"
									     alt="<?php esc_attr_e( 'Client Logo', 'atomlab' ); ?>"/>
								</div>
							<?php endif; ?>
							<?php if ( isset( $item['image_hover'] ) ) : ?>
								<div class="image-hover">
									<?php
									$image_url = wp_get_attachment_url( $item['image_hover'] );
									?>
									<img src="<?php echo esc_url( $image_url ); ?>"
									     alt="<?php esc_attr_e( 'Client Logo', 'atomlab' ); ?>"/>
								</div>
							<?php endif; ?>
							<?php
							if ( $_flag === true ) {
								echo '</a>';
							}
							?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php }
