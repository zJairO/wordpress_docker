<?php

class WPBakeryShortCode_TM_Gradation extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Gradation', 'atomlab' ),
	'base'                      => 'tm_gradation',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-list',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'list_style',
			'value'       => array(
				esc_html__( 'Basic', 'atomlab' ) => 'basic',
			),
			'admin_label' => true,
			'std'         => 'basic',
		),
		array(
			'group'      => esc_html__( 'Items', 'atomlab' ),
			'heading'    => esc_html__( 'Items', 'atomlab' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Title', 'atomlab' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Description', 'atomlab' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
			),

		),

	), Atomlab_VC::get_vc_spacing_tab() ),
) );
