<?php

class WPBakeryShortCode_TM_Image extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		global $atomlab_shortcode_md_css;
		global $atomlab_shortcode_sm_css;
		global $atomlab_shortcode_xs_css;
		$tmp = '';

		$tmp .= "text-align: {$atts['align']}";

		if ( $tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector{ $tmp }";
		}

		if ( $atts['md_align'] !== '' ) {
			$atomlab_shortcode_md_css .= "$selector { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$atomlab_shortcode_sm_css .= "$selector { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$atomlab_shortcode_xs_css .= "$selector { text-align: {$atts['xs_align']} }";
		}

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Single Image', 'atomlab' ),
	'base'                      => 'tm_image',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-singleimage',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'    => esc_html__( 'Image', 'atomlab' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
		),
		array(
			'heading'    => esc_html__( 'On Click Action', 'atomlab' ),
			'desc'       => esc_html__( 'Select action for click action.', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'action',
			'value'      => array(
				esc_html__( 'None', 'atomlab' )             => '',
				esc_html__( 'Open Popup', 'atomlab' )       => 'popup',
				esc_html__( 'Open Custom Link', 'atomlab' ) => 'custom_link',
			),
			'std'        => '',
		),
		array(
			'heading'     => esc_html__( 'Link', 'atomlab' ),
			'description' => esc_html__( 'Add a link to image.', 'atomlab' ),
			'type'        => 'vc_link',
			'param_name'  => 'custom_link',
			'dependency'  => array(
				'element' => 'action',
				'value'   => 'custom_link',
			),
		),
	), Atomlab_VC::get_alignment_fields(), array(
		Atomlab_VC::get_animation_field(),
		Atomlab_VC::extra_class_field(),
	), Atomlab_VC::get_vc_spacing_tab() ),

) );
