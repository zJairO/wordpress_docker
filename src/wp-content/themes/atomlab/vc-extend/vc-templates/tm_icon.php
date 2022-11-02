<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$el_class = $type = $icon_color = $icon_class = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-icon-' );
$this->get_inline_css( '#' . $css_id, $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-icon ' . $el_class, $this->settings['base'], $atts );

if ( isset( ${"icon_" . $icon_type} ) ) {
	$icon_class = esc_attr( ${"icon_" . $icon_type} );
}

if ( $icon_class !== '' ) {
	if ( $icon_color === 'primary' ) {
		$icon_class .= ' primary-color-important primary-border-color-important';
	} elseif ( $icon_color === 'secondary' ) {
		$icon_class .= ' secondary-color-important secondary-border-color-important';
	}
}

$css_class .= Atomlab_Helper::get_animation_classes( $animation );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="icon">
		<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
	</div>
</div>
