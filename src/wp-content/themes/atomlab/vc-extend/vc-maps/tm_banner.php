<?php

class WPBakeryShortCode_TM_Banner extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Banner', 'atomlab' ),
	'base'     => 'tm_banner',
	'category' => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-product-categories',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'atomlab' ) => '1',
				esc_html__( '02', 'atomlab' ) => '2',
			),
			'std'         => '1',
		),
		array(
			'heading'    => esc_html__( 'Image', 'atomlab' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
		),
		array(
			'heading'    => esc_html__( 'Text', 'atomlab' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
		array(
			'heading'    => esc_html__( 'Button', 'atomlab' ),
			'type'       => 'vc_link',
			'param_name' => 'button',
		),
		Atomlab_VC::extra_class_field(),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );
