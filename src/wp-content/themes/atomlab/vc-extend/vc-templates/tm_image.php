<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$el_class = $image = $action = $custom_link = $animation = $output = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-image-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-image ' . $el_class, $this->settings['base'], $atts );

if ( $action === 'popup' ) {
	wp_enqueue_style( 'lightgallery' );
	wp_enqueue_script( 'lightgallery' );
}

if ( $animation === '' ) {
	$animation = Atomlab::setting( 'shortcode_image_css_animation' );
}
$css_class .= Atomlab_Helper::get_animation_classes( $animation );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php if ( $image ) : ?>
		<?php
		$image_full = Atomlab_Helper::get_attachment_info( $image );

		$_image_tmp = Atomlab_Helper::get_lazy_load_image( array(
			'url'       => $image_full['src'],
			'alt'       => isset( $image_full['alt'] ) && $image_full['alt'] !== '' ? $image_full['alt'] : $image_full['title'],
			'crop'      => true,
			'echo'      => false,
			'full_size' => true,
		) );

		$_image = '<div class="image">' . $_image_tmp . '</div>';

		if ( $action === 'custom_link' ) {

			$_link = vc_build_link( $custom_link );
			if ( $_link['url'] !== '' ) {
				$output .= '<a href="' . esc_url( $_link['url'] ) . '"';

				if ( $_link['target'] !== '' ) {
					$output .= ' target="_blank"';
				}
				if ( $_link['title'] !== '' ) {
					$output .= 'title="' . $_link['title'] . '"';
				}

				$output .= ' >' . $_image . '</a>';
			}

		} elseif ( $action === 'popup' ) {
			$output .= '<div class="tm-light-gallery"><a href="' . esc_url( $image_full['src'] ) . '" class="zoom">' . $_image . '</a></div>';
		} else {
			$output .= $_image;
		}

		echo $output;
		?>
	<?php endif; ?>
</div>
