<?php

class WPBakeryShortCode_TM_Accordion extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Accordion', 'atomlab' ),
	'base'                      => 'tm_accordion',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-accordion',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Style 01', 'atomlab' ) => '1',
			),
			'std'         => '1',
		),
		array(
			'heading'     => esc_html__( 'Count From', 'atomlab' ),
			'description' => esc_html__( 'Input number that begin counter up for accordions', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'count_from',
			'std'         => 1,
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'dependency'  => array( 'element' => 'style', 'value' => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Multi Open', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'multi_open',
			'value'      => array( esc_html__( 'Yes', 'atomlab' ) => '1' ),
		),
		Atomlab_VC::extra_class_field(),
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
					'heading'    => esc_html__( 'Content', 'atomlab' ),
					'type'       => 'textarea',
					'param_name' => 'content',
				),
			),
		),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );
