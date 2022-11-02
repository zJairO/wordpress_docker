<?php
$section  = 'shortcode_box_icon';
$priority = 1;
$prefix   = 'shortcode_box_icon_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'svg_animation_duration',
	'label'       => esc_html__( 'SVG Animation Duration', 'atomlab' ),
	'description' => esc_html__( 'Leave blank to use default: 800 (ms). Ex: 1000', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
) );
