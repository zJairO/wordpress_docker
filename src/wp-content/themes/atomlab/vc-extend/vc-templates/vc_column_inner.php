<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 *
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this    WPBakeryShortCode_VC_Column_Inner
 */
$el_class = $width = $css = $offset = '';
$output   = '';
$atts     = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
);

if ( $background_color === 'primary' ) {
	$css_classes[] = 'primary-background-color';
} elseif ( $background_color === 'secondary' ) {
	$css_classes[] = 'secondary-background-color';
}
if ( $overlay_background !== '' ) {
	$css_classes[] = 'vc_column-has-overlay';
}

if ( vc_shortcode_custom_css_has_property( $css, array( 'border', 'background' ) ) ) {
	$css_classes[] = 'vc_col-has-fill';
}

$wrapper_attributes = array();
// build attributes for wrapper.

if ( Atomlab::setting( 'lazy_load_images' ) && $atts['background_image'] !== '' ) {
	$_url                 = wp_get_attachment_image_url( $atts['background_image'], 'full' );
	$css_classes[]        = 'tm-lazy-load';
	$wrapper_attributes[] = 'data-src="' . $_url . '"';
}

$css_id = uniqid( 'tm-column-inner-' );
Atomlab_VC::get_vc_column_css( '#' . $css_id, $atts );
$wrapper_attributes[] = 'id="' . esc_attr( $css_id ) . '"';

$css_class            = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';

if ( $overlay_background !== '' ) {
	$_overlay_row_style   = '';
	$_overlay_row_classes = 'vc_column-overlay';
	if ( $overlay_background === 'primary' ) {
		$_overlay_row_classes .= ' primary-background-color';
	} elseif ( $overlay_background === 'secondary' ) {
		$_overlay_row_classes .= ' secondary-background-color';
	} elseif ( $overlay_background === 'overlay_custom_background' ) {
		$_overlay_row_style .= 'background-color: ' . $overlay_custom_background . ';';
	}
	$_overlay_row_style .= 'opacity: ' . $overlay_opacity / 100 . ';';

	$output .= sprintf( '<div class="%s" style="%s"></div>', esc_attr( $_overlay_row_classes ), esc_attr( $_overlay_row_style ) );
}

$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '">';
$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo '' . $output;
