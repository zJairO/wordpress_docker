<?php
$_color_field                                                = WPBMap::getParam( 'vc_tta_tabs', 'color' );
$_color_field['value'][ esc_html__( 'Primary', 'atomlab' ) ] = 'primary';
$_color_field['std']                                         = 'primary';
vc_update_shortcode_param( 'vc_tta_tabs', $_color_field );

vc_update_shortcode_param( 'vc_tta_tabs', array(
	'param_name' => 'style',
	'value'      => array(
		esc_html__( 'Atomlab 01', 'atomlab' ) => 'atomlab-01',
		esc_html__( 'Atomlab 02', 'atomlab' ) => 'atomlab-02',
		esc_html__( 'Atomlab 03', 'atomlab' ) => 'atomlab-03',
		esc_html__( 'Classic', 'atomlab' )    => 'classic',
		esc_html__( 'Modern', 'atomlab' )     => 'modern',
		esc_html__( 'Flat', 'atomlab' )       => 'flat',
		esc_html__( 'Outline', 'atomlab' )    => 'outline',
	),
) );
