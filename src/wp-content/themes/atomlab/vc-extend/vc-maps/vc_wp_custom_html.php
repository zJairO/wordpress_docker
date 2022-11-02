<?php

class WPBakeryShortCode_VC_Wp_Custom_HTML extends WPBakeryShortCode {

}

vc_map( array(
	'name'     => esc_html__( 'WP Custom HTML', 'atomlab' ),
	'base'     => 'vc_wp_custom_html',
	'category' => esc_html__( 'WordPress Widgets', 'atomlab' ),
	'icon'     => 'icon-wpb-wp',
	'class'    => 'wpb_vc_wp_widget',
	'params'   => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Widget title', 'atomlab' ),
			'param_name'  => 'title',
			'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'atomlab' ),
		),
		array(
			'type'       => 'textarea_raw_html',
			'holder'     => 'div',
			'heading'    => esc_html__( 'Text', 'atomlab' ),
			'param_name' => 'content',
		),
		Atomlab_VC::extra_id_field(),
		Atomlab_VC::extra_class_field(),
	),
) );
