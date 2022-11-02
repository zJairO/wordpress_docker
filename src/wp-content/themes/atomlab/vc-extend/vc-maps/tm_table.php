<?php

class WPBakeryShortCode_TM_Table extends WPBakeryShortCode {

}

vc_map( array(
	'name'     => esc_html__( 'Table', 'atomlab' ),
	'base'     => 'tm_table',
	'category' => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-call-to-action',
	'params'   => array(
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
			'heading'    => esc_html__( 'Content', 'atomlab' ),
			'type'       => 'textarea_html',
			'param_name' => 'content',
		),
		Atomlab_VC::extra_class_field(),
	),
) );

