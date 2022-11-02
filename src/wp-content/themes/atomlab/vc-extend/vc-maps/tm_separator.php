<?php

class WPBakeryShortCode_TM_Separator extends WPBakeryShortCode {

}

vc_map( array(
	'name'     => esc_html__( 'Separator', 'atomlab' ),
	'base'     => 'tm_separator',
	'category' => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-call-to-action',
	'params'   => array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Modern Dots', 'atomlab' ) => 'modern-dots',
				esc_html__( 'Single Line', 'atomlab' ) => 'single-line',
			),
			'std'         => 'modern-dots',
		),
		array(
			'heading'     => esc_html__( 'Smooth Scroll', 'atomlab' ),
			'description' => esc_html__( 'Input valid id to smooth scroll to a section on click. ( For Ex: #about-us-section )', 'atomlab' ),
			'type'        => 'textfield',
			'param_name'  => 'smooth_scroll',
		),
		Atomlab_VC::extra_class_field(),
	),
) );

