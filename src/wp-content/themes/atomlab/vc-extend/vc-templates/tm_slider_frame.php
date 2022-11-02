<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$loop = $auto_play = $nav = $pagination = $el_class = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-slider-frame-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-slider-frame tm-swiper v-center h-center ' . $el_class, $this->settings['base'], $atts );

if ( $nav !== '' ) {
	$css_class .= " nav-style-$nav";
}

if ( $pagination !== '' ) {
	$css_class .= " pagination-style-$pagination";
}

if ( $images === '' ) {
	return;
}
$images = explode( ',', $images );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
     data-lg-items="auto"
     data-centered="1"

	<?php if ( $nav !== '' ) : ?>
		data-nav="1"
	<?php endif; ?>

	<?php if ( $pagination !== '' ) : ?>
		data-pagination="1"
	<?php endif; ?>

	<?php if ( $auto_play !== '' ) : ?>
		data-autoplay="<?php echo esc_attr( $auto_play ); ?>"
	<?php endif; ?>

	<?php if ( $loop === '1' ) : ?>
		data-loop="1"
	<?php endif; ?>
>
	<div class="swiper-container">
		<div class="static-iphone-frame-layer">
			<img src="<?php echo ATOMLAB_THEME_IMAGE_URI . '/iphone-frame.png'; ?>"
			     alt="<?php esc_html_e( 'Iphone Frame', 'atomlab' ); ?>">
		</div>
		<div class="swiper-wrapper">
			<?php foreach ( $images as $image ) {
				?>
				<div class="swiper-slide">
					<div>
						<?php
						$image_full = Atomlab_Helper::get_attachment_info( $image );

						$image_url = Atomlab_Helper::aq_resize( array(
							'url'    => $image_full['src'],
							'width'  => 286,
							'height' => 512,
							'crop'   => true,
						) );
						?>
						<img src="<?php echo esc_url( $image_url ); ?>"
						     alt="<?php echo esc_attr( $image_full['title'] ); ?>">
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
