<?php

vc_add_params( 'vc_separator', array(
	array(
		'heading'     => esc_html__( 'Position', 'atomlab' ),
		'description' => esc_html__( 'Make the separator position absolute with column', 'atomlab' ),
		'type'        => 'dropdown',
		'param_name'  => 'position',
		'value'       => array(
			esc_html__( 'None', 'atomlab' )   => '',
			esc_html__( 'Top', 'atomlab' )    => 'top',
			esc_html__( 'Bottom', 'atomlab' ) => 'bottom',
		),
		'std'         => '',
	),
) );
